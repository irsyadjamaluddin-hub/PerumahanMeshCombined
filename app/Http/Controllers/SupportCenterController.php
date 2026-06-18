<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DevopsSupportRequest;
use App\Models\DevopsSupportAttachment;
use App\Models\DevopsSupportRemark;
use App\Models\Department;
use App\Models\DevopsSupportAdmin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Mail\SupportRequestMail;
use App\Mail\UserRequestSubmitted;
use App\Mail\UserRequestUpdated;

class SupportCenterController extends Controller
{
    // list semua request
    public function index()
    {
        $supportRequests = DevopsSupportRequest::with(['attachments', 'remarks'])
            ->latest()
            ->paginate(10);

        $pagename = "SupportCenter";
        return view('support_center.index', compact('supportRequests', 'pagename'));
    }

    // paparkan form create
    public function create()
    {
        $departments = Department::orderBy('label', 'asc')->get();
        $pagename = "SupportCenter";

        return view('support_center.create', compact('departments', 'pagename'));
    }

    // simpan request baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'contact'       => 'nullable|string|max:255',
            'department'    => 'required|string|max:255',
            'unit'          => 'nullable|string|max:255',
            'perkara'       => 'required|string',
            'huraian'       => 'required|string',
            'priority'      => 'required|in:Rendah,Sederhana,Tinggi',
            'attachments'   => 'nullable|array',
            'attachments.*' => 'file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png|max:10240',
        ], [
            'attachments.*.mimes' => 'Fail mesti PDF/Word/PowerPoint/JPG/PNG (maks 10MB setiap fail).'
        ]);

        $savedAttachments = [];

        try {
            // buat request utama
            $supportRequest = DevopsSupportRequest::create(collect($validated)->only([
                'name','email','contact','department','unit','perkara','huraian','priority'
            ])->toArray());

            Log::info('SupportRequest created', [
                'id' => $supportRequest->id,
                'db' => DB::connection()->getDatabaseName(),
                'table' => $supportRequest->getTable()
            ]);

            // simpan attachments (kalau ada)
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $path = $file->store('support_attachments', 'public');
                    DevopsSupportAttachment::create([
                        'request_id' => $supportRequest->id,
                        'file_name'  => $file->getClientOriginalName(),
                        'file_path'  => $path,
                    ]);
                    $savedAttachments[] = $file->getClientOriginalName();
                }
            }
        } catch (\Throwable $e) {
            Log::error('Store support request failed: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->withErrors('Gagal menyimpan permohonan. Sila cuba lagi.')->withInput();
        }

        // hantar email kepada admin
        try {
            $adminEmails = DevopsSupportAdmin::query()
                ->whereNotNull('email')
                ->pluck('email')
                ->map(fn($e) => strtolower(trim($e)))
                ->filter()
                ->unique()
                ->values()
                ->all();

            foreach ($adminEmails as $addr) {
                Mail::to($addr)->send(new SupportRequestMail($supportRequest, $savedAttachments));
            }
        } catch (\Throwable $e) {
            Log::error('Support request email to admins failed: '.$e->getMessage(), [
                'request_id' => $supportRequest->id,
                'trace'      => $e->getTraceAsString(),
            ]);
        }

        // emel kepada user
        try {
            Mail::to($supportRequest->email)->send(
                new UserRequestSubmitted($supportRequest, $savedAttachments)
            );
        } catch (\Throwable $e) {
            Log::error('Support request email to user (submitted) failed: '.$e->getMessage(), [
                'request_id' => $supportRequest->id,
                'trace'      => $e->getTraceAsString(),
            ]);
        }

        // hantar WhatsApp template (dsd_sub)
        try {
            $instanceId = '448643';
            $token      = '7hpe9bwi2bl1k5ja';
            $namespace  = '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8';
            $url        = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;

            $template = 'dsd_sub';
            $language = ['code' => 'ms', 'policy' => 'deterministic'];
            $ticketNumeric = preg_replace('/^DSD/i', '', (string)($supportRequest->ticket_id ?? ''));

            $adminPhones = DevopsSupportAdmin::query()
                ->whereNotNull('tel_no')
                ->pluck('tel_no')
                ->filter()
                ->values()
                ->all();

            $recipients = [];
            if (!empty($supportRequest->contact)) {
                $recipients[] = $supportRequest->contact;
            }
            $recipients = array_values(array_unique(array_merge($recipients, $adminPhones)));

            $normalizeBn = function ($raw) {
                if (!$raw) return null;
                $p = preg_replace('/\D+/', '', $raw);
                if ($p === '') return null;
                if (str_starts_with($p, '673')) return '+'.$p;
                if ($p[0] === '0') $p = ltrim($p, '0');
                if (strlen($p) >= 7 && strlen($p) <= 11) {
                    return '+673'.$p;
                }
                return '+'.$p;
            };

            foreach ($recipients as $rawPhone) {
                $phone = $normalizeBn($rawPhone);
                if (!$phone) continue;

                $payload = [
                    'phone'     => $phone,
                    'template'  => $template,
                    'namespace' => $namespace,
                    'language'  => $language,
                    'params'    => [[
                        'type' => 'body',
                        'parameters' => [
                            ['type' => 'text', 'text' => (string) $supportRequest->name],
                            ['type' => 'text', 'text' => (string) $supportRequest->department],
                            ['type' => 'text', 'text' => (string) $supportRequest->perkara],
                            ['type' => 'text', 'text' => (string) $ticketNumeric],
                        ],
                    ]],
                ];

                $json = json_encode($payload);
                $options = stream_context_create([
                    'http' => [
                        'method'  => 'POST',
                        'header'  => 'Content-type: application/json',
                        'content' => $json,
                        'timeout' => 10,
                    ]
                ]);

                try {
                    $resp = file_get_contents($url, false, $options);
                    Log::info('WhatsApp dsd_sub sent', ['to' => $phone, 'resp' => $resp]);
                } catch (\Throwable $e) {
                    Log::error('WhatsApp dsd_sub FAILED: '.$e->getMessage(), [
                        'to'   => $phone,
                        'url'  => $url,
                        'body' => $json,
                    ]);
                }
            }
        } catch (\Throwable $e) {
            Log::error('WhatsApp submission block error: '.$e->getMessage());
        }

        // mesej success
        $ticketId = $supportRequest->ticket_id;
        $message = "Tuan/Puan {$supportRequest->name},\n\n".
           "Dengan hormat dimaklumkan bahawa aduan berkaitan \"{$supportRequest->perkara}\" telah berjaya direkodkan ".
           "di dalam sistem DevOps Service Desk.\n\n".
           "Nombor rujukan tiket aduan Tuan/Puan adalah: {$ticketId}.\n\n".
           "Sekian, terima kasih.";

        $pagename = "SupportCenter";
        return view('support_center.success', compact('message', 'ticketId', 'pagename'));
    }

    // edit form untuk admin
    public function edit($id)
    {
        $supportRequest = DevopsSupportRequest::with(['attachments', 'remarks'])->findOrFail($id);

        $statuses = DevopsSupportRequest::STATUS_ALLOWED;
        $pagename = "SupportCenter";

        return view('support_center.edit', compact('supportRequest', 'statuses', 'pagename'))
            ->with([
                'attachments' => $supportRequest->attachments,
                'remarks'     => $supportRequest->remarks,
                'ticketId'    => $supportRequest->ticket_id,
            ]);
    }

    // update status / remarks
    public function update(Request $request, $id)
    {
        $supportRequest = DevopsSupportRequest::findOrFail($id);

        $validated = $request->validate([
            'status'           => 'nullable|in:Tertunda,Sedang Diproses,Selesai,Ditangguh',
            'remarks'          => 'array',
            'remarks.*.remark' => 'nullable|string|max:2000',
        ]);

        $oldStatus = $supportRequest->status;

        DB::beginTransaction();
        try {
            if (array_key_exists('status', $validated) && $validated['status'] !== null && $validated['status'] !== $oldStatus) {
                $supportRequest->status = $validated['status'];
            }

            if (!empty($validated['remarks'])) {
                $rows = [];
                $now  = now();
                foreach ($validated['remarks'] as $r) {
                    $text = trim($r['remark'] ?? '');
                    if ($text !== '') {
                        $rows[] = [
                            'request_id' => $supportRequest->id,
                            'remark'     => $text,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                }
                if ($rows) {
                    DevopsSupportRemark::insert($rows);
                }
            }

            $supportRequest->save();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Update support request failed: '.$e->getMessage(), [
                'request_id' => $supportRequest->id,
                'trace'      => $e->getTraceAsString(),
            ]);
            return back()->withErrors('Gagal mengemaskini permohonan.')->withInput();
        }

        $supportRequest->refresh();
        $newStatus = $supportRequest->status;

        if ($oldStatus !== $newStatus) {
            try {
                Mail::to($supportRequest->email)->send(
                    new UserRequestUpdated($supportRequest, $oldStatus ?? 'N/A', $newStatus)
                );
                Log::info('Status update email sent to user', [
                    'request_id' => $supportRequest->id,
                    'old'        => $oldStatus,
                    'new'        => $newStatus
                ]);
            } catch (\Throwable $e) {
                Log::error('Support request email to user (status updated) failed: '.$e->getMessage(), [
                    'request_id' => $supportRequest->id,
                    'trace'      => $e->getTraceAsString(),
                ]);
            }
        }

        // hantar WhatsApp status update (dsd_stat)
        try {
            $instanceId = '448643';
            $token      = '7hpe9bwi2bl1k5ja';
            $namespace  = '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8';
            $url        = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;

            $template   = 'dsd_stat';
            $language   = ['code' => 'ms', 'policy' => 'deterministic'];
            $ticketNumeric = preg_replace('/^DSD/i', '', (string)($supportRequest->ticket_id ?? ''));

            $phone = $supportRequest->contact;
            if ($phone) {
                $p = preg_replace('/\D+/', '', $phone);
                if (str_starts_with($p, '673')) {
                    $phone = '+'.$p;
                } else {
                    $p = ltrim($p, '0');
                    $phone = '+673'.$p;
                }

                $payload = [
                    'phone'     => $phone,
                    'template'  => $template,
                    'namespace' => $namespace,
                    'language'  => $language,
                    'params'    => [[
                        'type' => 'body',
                        'parameters' => [
                            ['type' => 'text', 'text' => (string) $supportRequest->name],
                            ['type' => 'text', 'text' => (string) $supportRequest->department],
                            ['type' => 'text', 'text' => (string) $supportRequest->perkara],
                            ['type' => 'text', 'text' => (string) $ticketNumeric],
                            ['type' => 'text', 'text' => (string) $newStatus],
                        ],
                    ]],
                ];

                $json = json_encode($payload);
                $options = stream_context_create([
                    'http' => [
                        'method'  => 'POST',
                        'header'  => 'Content-type: application/json',
                        'content' => $json,
                        'timeout' => 10,
                    ]
                ]);

                $resp = file_get_contents($url, false, $options);
                Log::info('WhatsApp dsd_stat sent', ['to' => $phone, 'resp' => $resp]);
            } else {
                Log::warning('No user phone found for WA status update', [
                    'request_id' => $supportRequest->id,
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('WhatsApp dsd_stat FAILED: '.$e->getMessage(), [
                'request_id' => $supportRequest->id,
                'trace'      => $e->getTraceAsString(),
            ]);
        }

        return redirect()
            ->route('support-center.edit', $supportRequest->id)
            ->with('success', 'Support Request updated successfully.');
    }

    // download attachment
    public function downloadDocument($id)
    {
        $attachment = DevopsSupportAttachment::findOrFail($id);
        return Storage::disk('public')->download($attachment->file_path, $attachment->file_name);
    }

    // delete remark
    public function deleteRemark($id)
    {
        $remark = DevopsSupportRemark::findOrFail($id);
        $remark->delete();
        return back()->with('success', 'Remark deleted successfully.');
    }

    // admin emails
    public function adminEmails()
    {
        $devopsAdminEmails = DevopsSupportAdmin::orderByDesc('created_at')->get();
        $pagename = "DevOps Admin Email";
        return view('support_center.dsdemail', compact('devopsAdminEmails', 'pagename'));
    }

    public function storeAdminEmails(Request $request)
    {
        $validated = $request->validate([
            'moreFields'              => ['required', 'array', 'min:1'],
            'moreFields.*.ic_no'      => ['required', 'string', 'max:30'],
            'moreFields.*.email'      => ['required', 'email', 'max:255', 'distinct'],
            'moreFields.*.tel_no'     => ['nullable', 'string', 'max:30'],
        ]);

        $rows = [];
        $now  = now();
        foreach ($validated['moreFields'] as $row) {
            if (empty($row['ic_no']) && empty($row['email']) && empty($row['tel_no'])) {
                continue;
            }
            $rows[] = [
                'ic_no'      => trim($row['ic_no']),
                'email'      => strtolower(trim($row['email'])),
                'tel_no'     => $row['tel_no'] ? trim($row['tel_no']) : null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (!empty($rows)) {
            DB::table('devops_support_admin')->upsert(
                $rows,
                ['ic_no', 'email'],
                ['tel_no', 'updated_at']
            );
        }

        return back()->with('success_message', count($rows) . ' record(s) saved/updated.');
    }

    public function deleteAdminEmail(DevopsSupportAdmin $adminEmail)
    {
        $adminEmail->delete();
        return back()->with('success_message', 'Record deleted.');
    }
}
