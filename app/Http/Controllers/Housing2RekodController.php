<?php

namespace App\Http\Controllers;

use App\Models\Housing2Rekod as Rekod;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Housing2RekodController extends Controller
{
    /** Register config or 404. */
    protected function config(string $jenis): array
    {
        return config("housing2.types.$jenis") ?? abort(404);
    }

    /**
     * The sections to use for a register, given the chosen Jenis Permohonan.
     * Falls back to the register's default 'sections' when it has no
     * per-application-type override (or none was chosen).
     */
    protected function sectionsFor(array $cfg, ?string $jenisPermohonan): array
    {
        return $cfg['sections_by_jenis_permohonan'][$jenisPermohonan] ?? $cfg['sections'];
    }

    /** All labels of a set of sections, flattened. */
    protected function labels(array $sections): array
    {
        return collect($sections)->flatMap(fn ($s) => collect($s['fields'])->pluck('label'))->all();
    }

    /** All fields of a set of sections, flattened. */
    protected function fields(array $sections): array
    {
        return collect($sections)->flatMap(fn ($s) => $s['fields'])->all();
    }

    public function index()
    {
        if (session('housing2_view_mode', 'user') === 'user') {
            return redirect()->route('housing2.choose', 'pemohon');
        }

        $types = config('housing2.types');
        $counts = Rekod::selectRaw('jenis, count(*) as total')->groupBy('jenis')->pluck('total', 'jenis')
            ->map(fn ($n) => (int) $n);

        return view('housing2.index', [
            'types' => $types,
            'groups' => config('housing2.groups'),
            'counts' => $counts,
            'recent' => Rekod::latest()->take(6)->get(),
            'statusTally' => Rekod::selectRaw('status, count(*) as total')
                ->whereNotNull('status')->groupBy('status')->pluck('total', 'status')
                ->map(fn ($n) => (int) $n),
            'daerahTally' => Rekod::selectRaw("JSON_VALUE(data, '$.daerah') as daerah, count(*) as total")
                ->whereIn(\Illuminate\Support\Facades\DB::raw("JSON_VALUE(data, '$.daerah')"), ['Brunei dan Muara', 'Tutong', 'Belait', 'Temburong'])
                ->groupBy(\Illuminate\Support\Facades\DB::raw("JSON_VALUE(data, '$.daerah')"))
                ->pluck('total', 'daerah')
                ->map(fn ($n) => (int) $n),
        ]);
    }

    public function list(Request $request, string $jenis)
    {
        $cfg = $this->config($jenis);

        $rekods = Rekod::jenis($jenis)
            ->when($jenis === 'menunggu', fn ($query) => $query->where('status', 'Menunggu'))
            ->when($jenis !== 'menunggu' && $request->filled('status'), fn ($query) => $query->where('status', $request->query('status')))
            ->when($request->filled('jenis_permohonan'), fn ($query) => $query->where('jenis_permohonan', $request->query('jenis_permohonan')))
            ->cari($request->query('q'))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('housing2.list', compact('jenis', 'cfg', 'rekods') + [
            'q' => $request->query('q', ''),
            'jenisPermohonan' => $request->query('jenis_permohonan', ''),
            'statusFilter' => $request->query('status', ''),
        ]);
    }

    public function choose(string $jenis)
    {
        $cfg = $this->config($jenis);
        abort_unless($cfg['choose'] ?? false, 404);

        return view('housing2.choose', compact('jenis', 'cfg'));
    }

    public function create(Request $request, string $jenis)
    {
        $cfg = $this->config($jenis);

        if (($cfg['choose'] ?? false) && blank($request->query('jenis_permohonan'))) {
            return redirect()->route('housing2.choose', $jenis);
        }

        $jenisPermohonan = $request->query('jenis_permohonan');
        $cfg['sections'] = $this->sectionsFor($cfg, $jenisPermohonan);

        return view('housing2.form', [
            'jenis' => $jenis,
            'cfg' => $cfg,
            'rekod' => new Rekod(['jenis' => $jenis, 'jenis_permohonan' => $jenisPermohonan]),
        ]);
    }

    public function show(string $jenis, Rekod $rekod)
    {
        $cfg = $this->config($jenis);
        $cfg['sections'] = $this->sectionsFor($cfg, $rekod->jenis_permohonan);

        return view('housing2.show', ['jenis' => $jenis, 'cfg' => $cfg, 'rekod' => $rekod]);
    }

    public function edit(string $jenis, Rekod $rekod)
    {
        $cfg = $this->config($jenis);
        $cfg['sections'] = $this->sectionsFor($cfg, $rekod->jenis_permohonan);

        return view('housing2.form', ['jenis' => $jenis, 'cfg' => $cfg, 'rekod' => $rekod]);
    }

    public function download(string $jenis, Rekod $rekod)
    {
        $cfg = $this->config($jenis);
        $cfg['sections'] = $this->sectionsFor($cfg, $rekod->jenis_permohonan);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('housing2.pdf', compact('jenis', 'cfg', 'rekod'));

        return $pdf->download(Str::slug($rekod->tajuk()).'.pdf');
    }

    public function share(string $jenis, Rekod $rekod)
    {
        $cfg = $this->config($jenis);
        $cfg['sections'] = $this->sectionsFor($cfg, $rekod->jenis_permohonan);
        $fields = $this->fields($cfg['sections']);

        $emailField = collect($fields)->first(fn ($f) => $f['label'] === 'E-mel');
        $email = $emailField ? $rekod->field('E-mel', '') : '';

        if (! $email) {
            return back()->with('ralat', 'Tiada alamat e-mel direkodkan untuk perkongsian.');
        }

        $icField = collect($fields)->first(fn ($f) => str_contains($f['label'], 'KPP'));
        $ic = $icField ? $rekod->field($icField['label']) : '—';

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('housing2.pdf', compact('jenis', 'cfg', 'rekod'));

        \Illuminate\Support\Facades\Mail::to($email)->send(
            new \App\Mail\Housing2RekodShared($rekod, $ic, $pdf->output(), $cfg)
        );

        return back()->with('berjaya', 'Rekod telah dikongsikan melalui e-mel');
    }

    /** Quick inline update of Status Permohonan from the show page, without touching any other field. */
    public function updateStatusPermohonan(Request $request, string $jenis, Rekod $rekod)
    {
        $validated = $request->validate(['status_permohonan' => ['required', 'in:Disokong,Tidak Disokong,Kuiri']]);

        $data = $rekod->data ?? [];
        $data['status_permohonan'] = $validated['status_permohonan'];
        $rekod->data = $data;

        // Kuiri means the meeting needs more information before it can decide —
        // the record stays exactly where it is (still Menunggu/active), with no
        // downstream sync, so it keeps showing in its origin list awaiting a
        // follow-up decision ("Masih dalam senarai permohonan").
        if ($validated['status_permohonan'] === 'Kuiri') {
            $rekod->save();

            return back()->with('berjaya', 'Rekod kekal dalam senarai — kuiri dihantar');
        }

        // Once a Menunggu or Pemohon record has been dispositioned (Disokong or
        // Tidak Disokong), it's no longer waiting, so drop it out of that list.
        if (in_array($jenis, ['menunggu', 'pemohon'], true)) {
            $rekod->status = 'Selesai';
        }

        $rekod->save();
        $this->syncMenunggu($rekod);
        $this->syncArkib($rekod);
        $this->syncPenghuniRs($rekod);
        $this->syncPemilikRs($rekod);

        if (in_array($jenis, ['menunggu', 'pemohon'], true) && $validated['status_permohonan'] === 'Disokong') {
            return redirect()->route('housing2.list', 'penghuni-rs')->with('berjaya', 'Rekod Berjaya Disimpan');
        }

        if (in_array($jenis, ['menunggu', 'pemohon'], true) && $validated['status_permohonan'] === 'Tidak Disokong') {
            return redirect()->route('housing2.list', 'arkib')->with('berjaya', 'Rekod Berjaya Disimpan');
        }

        return back()->with('berjaya', 'Rekod Berjaya Disimpan');
    }

    public function store(Request $request, string $jenis)
    {
        $rekod = Rekod::create($this->payload($request, $jenis));
        $this->syncMenunggu($rekod);
        $this->syncArkib($rekod);
        $this->syncPenghuniRs($rekod);
        $this->syncPemilikRs($rekod);

        return redirect()
            ->route('housing2.show', [$jenis, $rekod])
            ->with('berjaya', 'Rekod Berjaya Disimpan');
    }

    public function update(Request $request, string $jenis, Rekod $rekod)
    {
        $rekod->update($this->payload($request, $jenis, $rekod));
        $this->syncMenunggu($rekod);
        $this->syncArkib($rekod);
        $this->syncPenghuniRs($rekod);
        $this->syncPemilikRs($rekod);

        if ($jenis === 'pemohon') {
            return redirect()->route('housing2.list', 'menunggu')->with('berjaya', 'Rekod Berjaya Disimpan');
        }

        return redirect()
            ->route('housing2.show', [$jenis, $rekod])
            ->with('berjaya', 'Rekod Berjaya Disimpan');
    }

    /**
     * Once a Pemohon's Status Rekod is set to "Menunggu", or its Status
     * Permohonan is set to "Disokong", keep a matching Menunggu (waiting
     * list) record in step with it — matched by IC number, since the two
     * registers share no foreign key. Only copies fields the two registers
     * share by identical label; Menunggu-only fields (Kategori Permohonan,
     * Kelayakan Perumahan/Kelas, Tarikh Diterima) are left for staff to fill
     * in separately.
     */
    protected function syncMenunggu(Rekod $pemohon): void
    {
        $isMenungguStatus = $pemohon->status === 'Menunggu';
        $isDisokong = $pemohon->field('Status Permohonan', '') === 'Disokong';

        // The Rumah Sewa (RS) branch has its own Disokong outcome (syncPemilikRs)
        // — only the Mendapatkan Perumahan branch feeds the waiting list.
        if ($pemohon->jenis !== 'pemohon' || $pemohon->jenis_permohonan === 'Rumah Sewa (RS)' || (! $isMenungguStatus && ! $isDisokong)) {
            return;
        }

        $ic = $pemohon->field('No. KPP Pemilik', '');

        if (! $ic) {
            return;
        }

        $menunggu = Rekod::where('jenis', 'menunggu')
            ->whereRaw("JSON_VALUE(data, '$.no_kpp_pemohon') = ?", [$ic])
            ->first() ?? new Rekod(['jenis' => 'menunggu', 'status' => 'Menunggu']);

        // Maps Pemohon's label (left) to Menunggu's label (right). Almost every
        // field shares an identical label across both registers; the name and
        // IC fields diverge, since Pemohon's were relabelled to "Nama Pemilik /
        // Geran Tanah" and "No. KPP Pemilik".
        $sharedLabels = [
            'Nama Pemilik / Geran Tanah' => 'Nama Penuh Pemohon',
            'No. KPP Pemilik' => 'No. KPP Pemohon',
            'Warna' => 'Warna',
            'No. Perhubungan' => 'No. Perhubungan',
            'E-mel' => 'E-mel',
            'Tarikh Lahir' => 'Tarikh Lahir',
            'Tarikh Bersara' => 'Tarikh Bersara',
            'Taraf Kelamin' => 'Taraf Kelamin',
            'Tanggungan' => 'Tanggungan',
            'Tempat Bertugas Pemohon' => 'Tempat Bertugas Pemohon',
            'Jawatan' => 'Jawatan',
            'Bahagian' => 'Bahagian',
            'Tanggagaji' => 'Tanggagaji',
            'Daerah' => 'Daerah',
            'Tarikh Permohonan' => 'Tarikh Permohonan',
            'Muat Naik Dokumen' => 'Muat Naik Dokumen',
        ];

        $data = $menunggu->data ?? [];
        foreach ($sharedLabels as $fromLabel => $toLabel) {
            $value = $pemohon->field($fromLabel, '');

            // Don't blank out a document the Menunggu register may already have of its own.
            if ($toLabel === 'Muat Naik Dokumen' && $value === '') {
                continue;
            }

            $data[Str::slug($toLabel, '_')] = $value;
        }

        $menunggu->jenis = 'menunggu';
        $menunggu->status = $menunggu->status ?? 'Menunggu';
        $menunggu->data = $data;
        $menunggu->save();
    }

    /**
     * Once a Pemohon's Rumah Sewa (RS) application is Disokong, the offered
     * house becomes available for allocation — keep a matching Pemilik RS
     * record in step with it (status "Kosong", i.e. not yet assigned a
     * tenant), matched by owner IC number. Only copies fields the two
     * registers share by identical or equivalent label; Pemilik RS-only
     * fields (Mukim, Daerah, Sewa Sebulan, etc.) are left for staff to fill
     * in separately.
     */
    protected function syncPemilikRs(Rekod $pemohon): void
    {
        if ($pemohon->jenis !== 'pemohon'
            || $pemohon->jenis_permohonan !== 'Rumah Sewa (RS)'
            || $pemohon->field('Status Permohonan', '') !== 'Disokong') {
            return;
        }

        $ic = $pemohon->field('No. KPP Pemilik', '');

        if (! $ic) {
            return;
        }

        $pemilikRs = Rekod::where('jenis', 'pemilik-rs')
            ->whereRaw("JSON_VALUE(data, '$.no_kpp_pemilik') = ?", [$ic])
            ->first() ?? new Rekod(['jenis' => 'pemilik-rs', 'status' => 'Kosong']);

        $labelMap = [
            'Nama Pemilik / Geran Tanah' => 'Nama Penuh Pemilik',
            'No. KPP Pemilik' => 'No. KPP Pemilik',
            'Alamat Rumah Sewa Ditawarkan' => 'Alamat Rumah Sewa',
            'Alamat Persuratan' => 'Alamat Persuratan',
            'No. Perhubungan' => 'No. Perhubungan',
            'Muat Naik Dokumen' => 'Muat Naik Dokumen',
        ];

        $data = $pemilikRs->data ?? [];
        foreach ($labelMap as $fromLabel => $toLabel) {
            $value = $pemohon->field($fromLabel, '');

            if ($toLabel === 'Muat Naik Dokumen' && $value === '') {
                continue;
            }

            $data[Str::slug($toLabel, '_')] = $value;
        }

        $pemilikRs->jenis = 'pemilik-rs';
        $pemilikRs->status = $pemilikRs->status ?? 'Kosong';
        $pemilikRs->data = $data;
        $pemilikRs->save();
    }

    /**
     * Once a Pemohon's or a Menunggu's Status Permohonan is set to "Tidak
     * Disokong", archive it into the Arkib register — matched by IC number.
     * Arkib shares the Penghuni IQ field shape, so fields are mapped by
     * meaning rather than identical label, and the mapping (including which
     * field holds the IC) differs slightly per source register. Arkib-only
     * fields (Alamat Perumahan Kerajaan (IQ), Kelas, Bayaran Sebulan, etc.)
     * are left for staff to fill in separately.
     */
    protected function syncArkib(Rekod $rekod): void
    {
        $sourceConfig = [
            'pemohon' => $rekod->jenis_permohonan === 'Rumah Sewa (RS)' ? [
                'ic' => 'No. KPP Pemilik',
                'fields' => [
                    'Nama Pemilik / Geran Tanah' => 'Nama Penuh Penghuni',
                    'No. Perhubungan' => 'No. Perhubungan',
                ],
            ] : [
                'ic' => 'No. KPP Pemilik',
                'fields' => [
                    'Nama Pemilik / Geran Tanah' => 'Nama Penuh Penghuni',
                    'No. Perhubungan' => 'No. Perhubungan',
                    'Tarikh Lahir' => 'Tarikh Lahir',
                    'Tarikh Bersara' => 'Tarikh Bersara',
                    'Taraf Kelamin' => 'Taraf Kelamin',
                    'Tanggungan' => 'Tanggungan',
                    'Tempat Bertugas Pemohon' => 'Tempat Bertugas',
                    'Jawatan' => 'Jawatan',
                    'Bahagian' => 'Bahagian',
                    'Tanggagaji' => 'Tanggagaji',
                    'Gaji Terkini' => 'Gaji Terkini',
                    'Tarikh Lantikan' => 'Tarikh Lantikan',
                    'Status Lantikan' => 'Status Lantikan',
                    'Daerah' => 'Daerah',
                ],
            ],
            'menunggu' => [
                'ic' => 'No. KPP Pemohon',
                'fields' => [
                    'Nama Penuh Pemohon' => 'Nama Penuh Penghuni',
                    'No. Perhubungan' => 'No. Perhubungan',
                    'Tarikh Lahir' => 'Tarikh Lahir',
                    'Tarikh Bersara' => 'Tarikh Bersara',
                    'Taraf Kelamin' => 'Taraf Kelamin',
                    'Tanggungan' => 'Tanggungan',
                    'Tempat Bertugas Pemohon' => 'Tempat Bertugas',
                    'Jawatan' => 'Jawatan',
                    'Bahagian' => 'Bahagian',
                    'Tanggagaji' => 'Tanggagaji',
                    'Daerah' => 'Daerah',
                ],
            ],
        ];

        $config = $sourceConfig[$rekod->jenis] ?? null;

        if (! $config || $rekod->field('Status Permohonan', '') !== 'Tidak Disokong') {
            return;
        }

        $ic = $rekod->field($config['ic'], '');

        if (! $ic) {
            return;
        }

        $arkib = Rekod::where('jenis', 'arkib')
            ->whereRaw("JSON_VALUE(data, '$.no_kpp_penghuni_warna') LIKE ?", ["%{$ic}%"])
            ->first() ?? new Rekod(['jenis' => 'arkib', 'status' => 'Aktif']);

        $data = $arkib->data ?? [];
        foreach ($config['fields'] as $fromLabel => $toLabel) {
            $data[Str::slug($toLabel, '_')] = $rekod->field($fromLabel, '');
        }

        $warna = $rekod->field('Warna', '');
        $data['no_kpp_penghuni_warna'] = trim($ic.($warna ? " / {$warna}" : ''));

        $arkib->jenis = 'arkib';
        $arkib->status = $arkib->status ?? 'Aktif';
        $arkib->data = $data;
        $arkib->save();
    }

    /**
     * Once a Menunggu record's Status Permohonan is set to "Disokong", move
     * it into the Penghuni RS register — matched by IC number. Only copies
     * fields the two registers share by identical or equivalent label (e.g.
     * Nama Penuh Pemohon -> Nama Penuh Penghuni); Penghuni RS-only fields
     * (Alamat Rumah Sewa, Nama Pemilik, Kelas, Sewa Sebulan, Tarikh Mula
     * Mendiami, etc.) are left for staff to fill in separately.
     */
    protected function syncPenghuniRs(Rekod $menunggu): void
    {
        if ($menunggu->jenis !== 'menunggu' || $menunggu->field('Status Permohonan', '') !== 'Disokong') {
            return;
        }

        $ic = $menunggu->field('No. KPP Pemohon', '');

        if (! $ic) {
            return;
        }

        $penghuniRs = Rekod::where('jenis', 'penghuni-rs')
            ->whereRaw("JSON_VALUE(data, '$.no_kpp_penghuni') = ?", [$ic])
            ->first() ?? new Rekod(['jenis' => 'penghuni-rs', 'status' => 'Aktif']);

        $labelMap = [
            'Nama Penuh Pemohon' => 'Nama Penuh Penghuni',
            'No. KPP Pemohon' => 'No. KPP Penghuni',
            'Warna' => 'Warna',
            'No. Perhubungan' => 'No. Perhubungan',
            'Tarikh Lahir' => 'Tarikh Lahir',
            'Tarikh Bersara' => 'Tarikh Bersara',
            'Taraf Kelamin' => 'Taraf Kelamin',
            'Tempat Bertugas Pemohon' => 'Tempat Bertugas',
            'Jawatan' => 'Jawatan',
            'Bahagian' => 'Bahagian',
            'Tanggagaji' => 'Tanggagaji',
            'Daerah' => 'Daerah',
        ];

        $data = $penghuniRs->data ?? [];
        foreach ($labelMap as $fromLabel => $toLabel) {
            $data[Str::slug($toLabel, '_')] = $menunggu->field($fromLabel, '');
        }

        $penghuniRs->jenis = 'penghuni-rs';
        $penghuniRs->status = $penghuniRs->status ?? 'Aktif';
        $penghuniRs->data = $data;
        $penghuniRs->save();
    }

    public function destroy(string $jenis, Rekod $rekod)
    {
        $rekod->delete();

        return redirect()->route('housing2.list', $jenis)->with('berjaya', 'Rekod telah dihapuskan');
    }

    /** Validate against the config and fold the fields into the JSON column. */
    protected function payload(Request $request, string $jenis, ?Rekod $rekod = null): array
    {
        $cfg = $this->config($jenis);
        $sections = $this->sectionsFor($cfg, $request->input('jenis_permohonan'));
        $labels = $this->labels($sections);
        $fields = $this->fields($sections);

        $rules = ['status' => ['nullable', 'string', 'max:80'], 'jenis_permohonan' => ['nullable', 'string', 'max:120']];
        $attributes = [];

        foreach ($fields as $field) {
            $name = Str::slug($field['label'], '_');

            if (($field['type'] ?? null) === 'file') {
                $attributes["files.$name"] = $field['label'];
                $rules["files.$name"] = ['nullable', 'file', 'max:5120', 'mimes:pdf,jpg,jpeg,png,doc,docx'];
                continue;
            }

            $attributes["fields.$name"] = $field['label'];
            $max = ($field['type'] ?? null) === 'area' ? 2000 : 255;
            // First field of the first section is required; everything else optional.
            $rules["fields.$name"] = [$field['label'] === $labels[0] ? 'required' : 'nullable', 'string', "max:$max"];

            if (($field['rule'] ?? null) === 'digits') {
                $rules["fields.$name"][] = 'regex:/^[0-9]+$/';
            }

            if (in_array($name, ['no_kpp_pemohon', 'no_kpp_pemilik', 'no_kpp_penghuni'], true)) {
                $rules["fields.$name"][] = function ($attribute, $value, $fail) use ($request, $field) {
                    $lengthByWarna = ['Kuning' => 8, 'Merah' => 12, 'Hijau' => 12];
                    $warna = $request->input('fields.warna');
                    $required = $lengthByWarna[$warna] ?? null;

                    if ($required && ! preg_match("/^\d{{$required}}$/", (string) $value)) {
                        $fail(\App\Support\Housing2Lang::t("{$field['label']} mestilah tepat {$required} digit apabila Warna dipilih {$warna}."));
                    }
                };
            }

            if ($name === 'no_kpp_pasangan') {
                $rules["fields.$name"][] = function ($attribute, $value, $fail) use ($request) {
                    $lengthByWarna = ['Kuning' => 8, 'Merah' => 12, 'Hijau' => 12];
                    $warna = $request->input('fields.warna_kpp_pasangan');
                    $required = $lengthByWarna[$warna] ?? null;

                    if ($required && ! preg_match("/^\d{{$required}}$/", (string) $value)) {
                        $fail(\App\Support\Housing2Lang::t("No. KPP Pasangan mestilah tepat {$required} digit apabila Warna Pasangan dipilih {$warna}."));
                    }
                };
            }
        }

        $validated = $request->validate($rules, ['regex' => \App\Support\Housing2Lang::t('Ruangan :attribute hanya boleh mengandungi nombor.')], $attributes);

        $data = array_filter($validated['fields'] ?? [], fn ($v) => $v !== null);

        foreach ($fields as $field) {
            if (($field['type'] ?? null) !== 'file') {
                continue;
            }

            $name = Str::slug($field['label'], '_');

            if ($request->hasFile("files.$name")) {
                $data[$name] = $request->file("files.$name")->store("housing2/$jenis", 'public');
            } elseif ($rekod && isset($rekod->data[$name])) {
                $data[$name] = $rekod->data[$name];
            }
        }

        return [
            'jenis' => $jenis,
            'jenis_permohonan' => $validated['jenis_permohonan'] ?? $request->input('jenis_permohonan'),
            'status' => $validated['status'] ?? $request->input('fields.status') ?? 'Dalam Proses',
            'data' => $data,
        ];
    }
}
