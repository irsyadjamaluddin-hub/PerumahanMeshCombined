<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Carbon\Carbon;

class GenAIController extends Controller
{
    // Must match the QR URL exactly:
    private string $publicName = 'GenAIGuidanceforEducationHandbook(English).pdf';

    private function filePath(): string
    {
        // Put the real file here (not public):
        // storage/app/private/GenAIGuidanceforEducationHandbook(English).pdf
        return storage_path('app/private/'.$this->publicName);
    }

    private function noCache(array $extra = []): array
    {
        return array_merge([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
            'X-Frame-Options' => 'SAMEORIGIN',
            'Content-Security-Policy' => "frame-ancestors 'self'",
        ], $extra);
    }

    private function isBot(?string $ua): bool
    {
        $ua = strtolower($ua ?? '');
        $bots = [
            'bot','crawler','spider','preview','facebookexternalhit','whatsapp','slackbot','telegrambot','linkpreview',
            'twitterbot','discordbot','skypeuripreview','linkedinbot','headlesschrome','okhttp','curl','wget',
            'axios','postman','yandex','petalbot','embedly','quora link preview','pinterest'
        ];
        foreach ($bots as $k) {
            if (str_contains($ua, $k)) return true;
        }
        return false;
    }

    private function logAction(string $action, Request $req): void
    {
        $ua = $req->userAgent();
        $finalAction = $this->isBot($ua) ? "bot_{$action}" : $action;

        DB::table('genai_analytics')->insert([
            'pdf_name'    => $this->publicName,
            'action_type' => $finalAction,
            'user_ip'     => $req->ip(),
            'user_agent'  => substr($ua ?? '', 0, 1000),
            'user_type'   => auth()->check() ? 'user' : 'public',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }

    /**
     * Single URL handler (exact QR path):
     *   - ?inline=1&vt=... → inline preview (logs 'view' once per vt)
     *   - ?download=1      → force download (logs 'download')
     *   - no params        → preview page with iframe (and a download button)
     */
    public function handle(Request $request)
    {
        $path = $this->filePath();
        abort_unless(is_file($path), 404, 'PDF not found');

        // Inline preview (browser PDF viewer)
        if ($request->boolean('inline')) {
            $isRange = $request->headers->has('Range');    // byte-range requests
            $vt      = (string) $request->query('vt', ''); // view token tied to this page render

            $shouldLog = true;

            // If a vt exists, only log once (idempotent)
            if ($vt !== '') {
                $cacheKey  = 'genai:view:'.$this->publicName.':'.$vt;
                $shouldLog = Cache::add($cacheKey, 1, now()->addHours(6)); // true only on first hit
            } else {
                // No vt: avoid counting byte-range re-requests
                if ($isRange) $shouldLog = false;
            }

            if ($shouldLog) {
                $this->logAction('view', $request);
            }

            // Add Accept-Ranges for streaming support (faster loading)
            return Response::file($path, array_merge($this->noCache([
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$this->publicName.'"',
            ]), [
                'Accept-Ranges' => 'bytes', // Enable byte-range requests for streaming
            ]));
        }

        // Force download (always 1 log per click)
        if ($request->boolean('download')) {
            $this->logAction('download', $request);

            return Response::download($path, $this->publicName, $this->noCache([
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="'.$this->publicName.'"',
            ]));
        }

        // First visit → preview Blade (generates a unique vt for this page)
        $cb = (string) Carbon::now()->getTimestampMs();
        $vt = (string) Str::uuid();

        return response()
            ->view('genai_preview', [
                'title'       => 'GenAI Guidance for Education Handbook (English)',
                'inlineUrl'   => route('genai.handle', ['inline' => 1, 'cb' => $cb, 'vt' => $vt]),
                'downloadUrl' => route('genai.handle', ['download' => 1, 'cb' => $cb]),
                'filename'    => $this->publicName,
            ])
            ->withHeaders($this->noCache());
    }

    // === Dashboard: top counters ===
    public function report(Request $request)
    {
        $today = now()->toDateString();

        $views = DB::table('genai_analytics')
            ->where('pdf_name', $this->publicName)
            ->where('action_type', 'view')
            ->count();

        $downloads = DB::table('genai_analytics')
            ->where('pdf_name', $this->publicName)
            ->where('action_type', 'download')
            ->count();

        $todayViews = DB::table('genai_analytics')
            ->where('pdf_name', $this->publicName)
            ->where('action_type', 'view')
            ->whereDate('created_at', $today)
            ->count();

        $todayDownloads = DB::table('genai_analytics')
            ->where('pdf_name', $this->publicName)
            ->where('action_type', 'download')
            ->whereDate('created_at', $today)
            ->count();

        return response()
            ->view('genai', compact('views','downloads','todayViews','todayDownloads'))
            ->withHeaders($this->noCache());
    }

    // === Stats API for charts (day | week | month) ===
    public function stats(Request $request)
    {
        $group = in_array($request->query('group'), ['day','week','month']) ? $request->query('group') : 'day';

        $start = $request->query('start');
        $end   = $request->query('end');

        if ($start && $end) {
            $startDate = Carbon::parse($start)->startOfDay();
            $endDate   = Carbon::parse($end)->endOfDay();
        } else {
            $range = (int)($request->query('range', 30));
            $endDate   = now()->endOfDay();
            $startDate = now()->subDays(max(1, $range - 1))->startOfDay();
        }

        // SQL Server-friendly label expressions
        switch ($group) {
            case 'week':
                $labelSql = "CONCAT(DATEPART(year, created_at), '-', RIGHT(CONCAT('0', DATEPART(ISO_WEEK, created_at)), 2))";
                break;
            case 'month':
                $labelSql = "CONCAT(DATEPART(year, created_at), '-', RIGHT(CONCAT('0', DATEPART(month, created_at)), 2))";
                break;
            default:
                $labelSql = "CONVERT(varchar(10), created_at, 23)"; // YYYY-MM-DD
        }

        $rows = DB::table('genai_analytics')
            ->selectRaw("$labelSql AS label, action_type, COUNT(*) AS total, MIN(created_at) AS m")
            ->where('pdf_name', $this->publicName)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->whereIn('action_type', ['view','download']) // exclude bot_* from charts
            ->groupByRaw("$labelSql, action_type")
            ->orderBy('m')
            ->get();

        // Dense axis build
        $labels = [];
        $views  = [];
        $downs  = [];
        $ticks  = [];

        $cursor = $startDate->copy();
        if ($group === 'day') {
            while ($cursor <= $endDate) { $ticks[] = $cursor->format('Y-m-d'); $cursor->addDay(); }
        } elseif ($group === 'week') {
            while ($cursor <= $endDate) { $ticks[] = $cursor->format('Y').'-'.$cursor->format('W'); $cursor->addWeek(); }
        } else {
            while ($cursor <= $endDate) { $ticks[] = $cursor->format('Y-m'); $cursor->addMonth(); }
        }

        $map = [];
        foreach ($rows as $r) {
            $label = $r->label;
            if (!isset($map[$label])) $map[$label] = ['view' => 0, 'download' => 0];
            $map[$label][$r->action_type] = (int) $r->total;
        }

        foreach ($ticks as $t) {
            $labels[] = $t;
            $views[]  = $map[$t]['view']     ?? 0;
            $downs[]  = $map[$t]['download'] ?? 0;
        }

        return response()
            ->json(['labels' => $labels, 'views' => $views, 'downloads' => $downs])
            ->withHeaders($this->noCache());
    }
}