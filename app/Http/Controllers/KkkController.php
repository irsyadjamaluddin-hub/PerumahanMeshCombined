<?php

namespace App\Http\Controllers;

use App\Models\Kkk\KkkLogAudit;
use App\Models\Kkk\KkkPeminjaman;
use App\Models\Kkk\KkkPengesahanPenerimaan;
use App\Models\Kkk\KkkRekod;
use App\Models\Kkk\KkkSekolah;
use App\Support\KkkLang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KkkController extends Controller
{
    /** Example code mapping for the legacy Excel register (Logik.dc.html's migration plan). Illustrative only. */
    protected const IMPORT_MAPPING = [
        ['kod' => 'R', 'sel' => 'Lajur tarikh diterima', 'status' => 'Diterima', 'sahkan' => false],
        ['kod' => 'Q1 / Q2 / Q3', 'sel' => 'Lajur kuiri pusingan 1-3', 'status' => 'Dalam kuiri', 'sahkan' => false],
        ['kod' => 'J1 / J2 / J3', 'sel' => 'Lajur jawapan kuiri pusingan 1-3', 'status' => 'Jawapan diterima', 'sahkan' => false],
        ['kod' => 'TFV', 'sel' => 'Lajur tarikh Fairview', 'status' => 'Selesai · TFV', 'sahkan' => false],
        ['kod' => '- (kosong)', 'sel' => 'Sel kosong', 'status' => 'Belum diterima', 'sahkan' => false],
        ['kod' => '?', 'sel' => 'Kod tidak dikenali', 'status' => '[sahkan]', 'sahkan' => true],
    ];

    /** The three parties on the Borang Peminjaman KKK. */
    public const ROLES = [
        'pemohon' => 'Pemohon',
        'ketua_sub' => 'Ketua Sub Unit Pentadbiran dan Perkhidmatan Korporat',
        'pengawas' => 'Pengawas Bilik dan Stor KKK',
    ];

    /**
     * Borang workflow, one entry per signature block:
     * who signs it, which status it moves from/to, the field prefix
     * (<prefix>_nama, <prefix>_jawatan) and its date column, plus the
     * earlier date it may not precede.
     */
    protected const STEPS = [
        'benarkan' => ['role' => 'ketua_sub', 'from' => 'dipohon', 'to' => 'dibenarkan', 'prefix' => 'dibenarkan', 'tarikh' => 'tarikh_dibenarkan', 'selepas' => 'tarikh_permohonan', 'audit' => 'Permohonan dibenarkan'],
        'tolak' => ['role' => 'ketua_sub', 'from' => 'dipohon', 'to' => 'ditolak', 'prefix' => 'dibenarkan', 'tarikh' => 'tarikh_dibenarkan', 'selepas' => 'tarikh_permohonan', 'audit' => 'Permohonan ditolak'],
        'keluarkan' => ['role' => 'pengawas', 'from' => 'dibenarkan', 'to' => 'dikeluarkan', 'prefix' => 'dikeluarkan', 'tarikh' => 'tarikh_dikeluarkan', 'selepas' => 'tarikh_dibenarkan', 'audit' => 'Dokumen dikeluarkan'],
        'terima' => ['role' => 'pemohon', 'from' => 'dikeluarkan', 'to' => 'dipinjam', 'prefix' => 'diterima', 'tarikh' => 'tarikh_diterima', 'selepas' => 'tarikh_dikeluarkan', 'audit' => 'Dokumen diterima oleh pemohon'],
        'kembalikan' => ['role' => 'pemohon', 'from' => 'dipinjam', 'to' => 'dikembalikan', 'prefix' => 'dikembalikan', 'tarikh' => 'tarikh_dikembalikan', 'selepas' => 'tarikh_diterima', 'audit' => 'Dokumen dikembalikan'],
        'terima-stor' => ['role' => 'pengawas', 'from' => 'dikembalikan', 'to' => 'selesai', 'prefix' => 'diterima_stor', 'tarikh' => 'tarikh_diterima_stor', 'selepas' => 'tarikh_dikembalikan', 'audit' => 'Pemulangan disahkan'],
    ];

    protected function role(): ?string
    {
        return session('kkk_role');
    }

    protected function roleLabel(): string
    {
        return self::ROLES[$this->role()] ?? 'Tetamu';
    }

    /** Redirects away if the current session role isn't one of $roles; otherwise null. */
    protected function guard(array $roles)
    {
        // No dedicated login step — a first visit (or a session still holding
        // a role from the old workflow) defaults to the store keeper, and the
        // topbar's role pills switch from there.
        if (! array_key_exists((string) $this->role(), self::ROLES)) {
            session(['kkk_role' => 'pengawas']);
        }

        if (! in_array($this->role(), $roles, true)) {
            return redirect()->route('kkk.rekod')->with('kkk_ralat', KkkLang::t('Anda tiada kebenaran untuk tindakan ini.'));
        }

        return null;
    }

    protected function audit(?int $peminjamanId, string $tindakan, ?string $butiran = null, ?int $rekodId = null): void
    {
        KkkLogAudit::create([
            'peminjaman_id' => $peminjamanId,
            'rekod_id' => $rekodId,
            'pengguna_nama' => $this->roleLabel(),
            'tindakan' => $tindakan,
            'butiran' => $butiran,
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('kkk_role');

        return redirect()->route('kkk.login');
    }

    public function setLang(Request $request, string $locale)
    {
        $request->session()->put('kkk_locale', $locale === 'en' ? 'en' : 'ms');

        return back();
    }

    public function setTheme(Request $request, string $mode)
    {
        $request->session()->put('kkk_theme', $mode === 'dark' ? 'dark' : 'light');

        return back();
    }

    /**
     * Quick role switch from the topbar pill group. If the page being viewed
     * isn't reachable under the new role, that page's own guard() redirects.
     */
    public function switchRole(Request $request, string $peranan)
    {
        if (! array_key_exists($peranan, self::ROLES)) {
            abort(404);
        }

        $request->session()->put('kkk_role', $peranan);

        return back();
    }

    /** Senarai borang peminjaman + butiran borang dipilih. */
    public function rekod(Request $request)
    {
        if ($redirect = $this->guard(array_keys(self::ROLES))) {
            return $redirect;
        }

        $tahun = (int) $request->query('tahun', now()->year);
        $status = $request->query('status', '');
        $jenis = $request->query('jenis', '');

        $peminjaman = KkkPeminjaman::with('items.sekolah')
            ->whereYear('tarikh_permohonan', $tahun)
            ->when($status !== '', fn ($q) => $q->where('status', $status))
            ->when($jenis !== '', fn ($q) => $q->whereJsonContains('jenis', $jenis))
            ->orderByDesc('tarikh_permohonan')->orderByDesc('id')
            ->get();

        $selected = $request->filled('pilih') ? KkkPeminjaman::with('items.sekolah')->find($request->query('pilih')) : null;

        // Submissions from the public form /borangkuncikirakira (KkkPengesahanController).
        // Own p_* query params so they don't clash with the peminjaman filters above.
        $pKluster = $request->query('p_kluster', '');
        $pCari = trim((string) $request->query('p_cari', ''));
        $penerimaan = KkkPengesahanPenerimaan::query()
            ->when($pKluster !== '', fn ($q) => $q->where('kluster', $pKluster))
            ->when($pCari !== '', fn ($q) => $q->where(fn ($w) => $w
                ->where('nama_sekolah', 'like', "%{$pCari}%")
                ->orWhere('nama_penghantar', 'like', "%{$pCari}%")))
            ->orderByDesc('created_at')->orderByDesc('id')
            ->paginate(15, ['*'], 'p_page')
            ->withQueryString()
            ->fragment('penerimaan');

        // Pre-fill for each row's "Hantar permohonan" button, which posts to storeRekod.
        // School names are matched ignoring case/punctuation ("Pusat Tingkatan Enam, Tutong").
        $norm = fn ($s) => preg_replace('/[^a-z0-9]/', '', mb_strtolower((string) $s));
        $sekolahId = KkkSekolah::pluck('id', 'nama')->mapWithKeys(fn ($id, $nama) => [$norm($nama) => $id]);
        $alias = config('kkk_pengesahan.alias_kkk', []);
        $penerimaan->getCollection()->transform(function ($r) use ($norm, $sekolahId, $alias) {
            $r->sekolah_id = $sekolahId[$norm($alias[$r->nama_sekolah] ?? $r->nama_sekolah)] ?? null;
            $r->jenis_list = array_values(array_filter(KkkPeminjaman::JENIS, fn ($j) => stripos($r->jenis, $j) !== false));
            $r->penggal = str_starts_with($r->tempoh, 'Julai') ? 2 : 1;

            return $r;
        });

        // Stage counts for the timeline above the page title (selected year, ignoring the status/jenis filters)
        $alurKiraan = KkkPeminjaman::whereYear('tarikh_permohonan', $tahun)
            ->selectRaw('status, count(*) as n')->groupBy('status')->pluck('n', 'status')->map(fn ($n) => (int) $n);
        $alurDiterima = KkkPengesahanPenerimaan::whereYear('created_at', $tahun)->count();

        // The record the timeline follows when no borang is selected: the newest borang,
        // unless a school submission has come in after it (= a new record, timeline resets to white).
        $alurBorang = KkkPeminjaman::with('items.sekolah')->orderByDesc('created_at')->orderByDesc('id')->first();
        $alurPenerimaan = KkkPengesahanPenerimaan::orderByDesc('created_at')->orderByDesc('id')->first();
        $alurBaharu = $alurPenerimaan && (! $alurBorang || $alurPenerimaan->created_at->gt($alurBorang->created_at));

        return view('kkk.rekod', [
            'alurKiraan' => $alurKiraan,
            'alurDiterima' => $alurDiterima,
            'alurBorang' => $alurBorang,
            'alurPenerimaan' => $alurPenerimaan,
            'alurBaharu' => $alurBaharu,
            'penerimaan' => $penerimaan,
            'pKluster' => $pKluster,
            'pCari' => $pCari,
            'klusterPilihan' => array_keys(config('kkk_pengesahan.sekolah', [])),
            'peminjaman' => $peminjaman,
            'selected' => $selected,
            'sekolahs' => KkkSekolah::where('aktif', true)->orderBy('nama')->get(),
            'tahun' => $tahun,
            'status' => $status,
            'jenis' => $jenis,
            'tahunPilihan' => range(now()->year - 2, now()->year + 1),
            'steps' => self::STEPS,
        ]);
    }

    /** Pemohon submits a new borang. */
    public function storeRekod(Request $request)
    {
        if ($redirect = $this->guard(['pemohon'])) {
            return $redirect;
        }

        $data = $request->validate([
            'jenis' => ['required', 'array', 'min:1'],
            'jenis.*' => [Rule::in(KkkPeminjaman::JENIS)],
            'tujuan' => ['required', Rule::in(array_keys(KkkPeminjaman::TUJUAN))],
            'tujuan_lain' => ['nullable', 'required_if:tujuan,lain', 'string', 'max:255'],
            'tarikh_permohonan' => ['required', 'date', 'before_or_equal:today'],
            'pemohon_nama' => ['required', 'string', 'max:150'],
            'pemohon_jawatan' => ['nullable', 'string', 'max:150'],
            'items' => ['required', 'array', 'max:5'],
            'items.*.sekolah_id' => ['nullable', 'exists:kkk_sekolah,id'],
            'items.*.penggal' => ['nullable', 'in:1,2'],
            'items.*.tahun_kewangan' => ['nullable', 'integer', 'min:2000', 'max:2100'],
        ], [
            'jenis.required' => KkkLang::t('Sila pilih sekurang-kurangnya satu Jenis KKK.'),
            'tujuan_lain.required_if' => KkkLang::t('Sila nyatakan tujuan.'),
        ]);

        $items = collect($data['items'])->filter(fn ($i) => ! empty($i['sekolah_id']))->values();
        if ($items->isEmpty()) {
            return back()->withInput()->with('kkk_ralat', KkkLang::t('Sila isi sekurang-kurangnya satu sekolah.'));
        }

        $borang = KkkPeminjaman::create([
            'no_borang' => KkkPeminjaman::nextNoBorang(),
            'jenis' => array_values(array_intersect(KkkPeminjaman::JENIS, $data['jenis'])),
            'tujuan' => $data['tujuan'],
            'tujuan_lain' => $data['tujuan'] === 'lain' ? $data['tujuan_lain'] : null,
            'tarikh_permohonan' => $data['tarikh_permohonan'],
            'pemohon_nama' => $data['pemohon_nama'],
            'pemohon_jawatan' => $data['pemohon_jawatan'] ?? null,
            'status' => 'dipohon',
        ]);

        foreach ($items as $i => $item) {
            $borang->items()->create([
                'bil' => $i + 1,
                'sekolah_id' => $item['sekolah_id'],
                'penggal' => $item['penggal'] ?: null,
                'tahun_kewangan' => $item['tahun_kewangan'] ?: now()->year,
            ]);
        }

        $this->audit($borang->id, 'Permohonan peminjaman dihantar', $borang->no_borang);

        return redirect()->route('kkk.rekod', ['tahun' => $borang->tarikh_permohonan->year, 'pilih' => $borang->id])
            ->with('kkk_berjaya', KkkLang::t('Rekod Berjaya Disimpan'));
    }

    /** Signs the next block of the borang (see STEPS). */
    public function advance(Request $request, KkkPeminjaman $peminjaman, string $langkah)
    {
        $step = self::STEPS[$langkah] ?? abort(404);

        if ($redirect = $this->guard([$step['role']])) {
            return $redirect;
        }

        if ($peminjaman->status !== $step['from']) {
            return back()->with('kkk_ralat', KkkLang::t('Borang ini tidak berada pada peringkat tersebut.'));
        }

        $p = $step['prefix'];
        $rules = [
            $p.'_nama' => ['required', 'string', 'max:150'],
            $p.'_jawatan' => ['nullable', 'string', 'max:150'],
            $step['tarikh'] => ['required', 'date', 'before_or_equal:today', 'after_or_equal:'.$peminjaman->{$step['selepas']}?->toDateString()],
        ];
        if ($langkah === 'tolak') {
            $rules['sebab_ditolak'] = ['required', 'string', 'max:1000'];
        }
        if ($langkah === 'terima-stor') {
            $rules['catatan_semakan'] = ['nullable', 'string', 'max:2000'];
        }

        $data = $request->validate($rules, [
            'after_or_equal' => KkkLang::t('V2: Turutan tarikh tidak sah.'),
            'sebab_ditolak.required' => KkkLang::t('Sebab ditolak wajib diisi.'),
        ]);

        // The same school / period / KKK type can't be issued twice at once.
        if ($langkah === 'keluarkan' && ($bertindih = $this->dokumenSedangDipinjam($peminjaman))) {
            return back()->withInput()->with('kkk_ralat', KkkLang::t('Dokumen sedang dipinjam di bawah borang').' '.$bertindih);
        }

        $peminjaman->update($data + ['status' => $step['to']]);

        $this->audit($peminjaman->id, $step['audit'], $peminjaman->no_borang.($langkah === 'tolak' ? ' — '.$data['sebab_ditolak'] : ''));

        return back()->with('kkk_berjaya', KkkLang::t('Rekod Berjaya Disimpan'));
    }

    /** No. borang of another loan that currently holds any of this borang's documents out of the store, else null. */
    protected function dokumenSedangDipinjam(KkkPeminjaman $peminjaman): ?string
    {
        $peminjaman->loadMissing('items');

        $lain = KkkPeminjaman::with('items')
            ->whereIn('status', KkkPeminjaman::DI_LUAR_STOR)
            ->whereKeyNot($peminjaman->id)
            ->get();

        foreach ($lain as $b) {
            if (! array_intersect($b->jenis, $peminjaman->jenis)) {
                continue;
            }
            foreach ($b->items as $x) {
                foreach ($peminjaman->items as $y) {
                    $tempohBertindih = ! $x->penggal || ! $y->penggal || $x->penggal == $y->penggal;
                    if ($x->sekolah_id == $y->sekolah_id && $x->tahun_kewangan == $y->tahun_kewangan && $tempohBertindih) {
                        return $b->no_borang;
                    }
                }
            }
        }

        return null;
    }

    // ---------------------------------------------------------------------
    // Pemeriksaan KKK: one rekod per school / financial year / penggal /
    // kategori, moving Tidak diterima → Diterima → Kueri ⇄ Jawapan → TFV.
    // ---------------------------------------------------------------------

    protected const PEMERIKSA = ['ketua_sub', 'pengawas'];

    public function pemeriksaan(Request $request)
    {
        if ($redirect = $this->guard(self::PEMERIKSA)) {
            return $redirect;
        }

        $tahun = (int) $request->query('tahun_kewangan', now()->year);
        $penggal = $request->query('penggal', '');
        $kategori = $request->query('kategori', '');

        $rekods = KkkRekod::with(['sekolah', 'kuiri'])
            ->where('tahun_kewangan', $tahun)
            ->when($penggal !== '', fn ($q) => $q->where('penggal', $penggal))
            ->when($kategori !== '', fn ($q) => $q->where('kategori', $kategori))
            ->whereHas('sekolah')
            ->get()
            ->sortBy(fn ($r) => $r->sekolah->nama)
            ->values();

        $selected = $request->filled('pilih') ? KkkRekod::with(['sekolah', 'kuiri'])->find($request->query('pilih')) : null;

        return view('kkk.pemeriksaan', [
            'rekods' => $rekods,
            'selected' => $selected,
            'sekolahs' => KkkSekolah::where('aktif', true)->orderBy('nama')->get(),
            'tahun' => $tahun,
            'penggal' => $penggal,
            'kategori' => $kategori,
            'tahunPilihan' => range(2022, now()->year + 1),
        ]);
    }

    /** Registers one account; without a received date it is an expected account still "Tidak diterima". */
    public function storePemeriksaan(Request $request)
    {
        if ($redirect = $this->guard(self::PEMERIKSA)) {
            return $redirect;
        }

        $data = $request->validate([
            'sekolah_id' => ['required', 'exists:kkk_sekolah,id'],
            'tahun_kewangan' => ['required', 'integer', 'min:2000', 'max:2100'],
            'penggal' => ['required', 'in:1,2'],
            'kategori' => ['required', 'in:Kantin,Yuran,Rampaian'],
            'tarikh_diterima' => ['nullable', 'date', 'before_or_equal:today'],
        ]);

        $wujud = KkkRekod::where('sekolah_id', $data['sekolah_id'])
            ->where('tahun_kewangan', $data['tahun_kewangan'])
            ->where('penggal', $data['penggal'])
            ->where('kategori', $data['kategori'])
            ->exists();

        if ($wujud) {
            return back()->withInput()->with('kkk_ralat', KkkLang::t('V1: Rekod bagi sekolah, tempoh dan kategori ini sudah wujud.'));
        }

        $rekod = KkkRekod::create($data + ['pegawai_nama' => $this->roleLabel()]);
        $rekod->refreshStatus();

        $this->audit(null, $rekod->tarikh_diterima ? 'KKK diterima' : 'Akaun dijangka didaftar', $rekod->sekolah->nama.' · '.$rekod->kategori.' · '.$rekod->tahun_kewangan, $rekod->id);

        return redirect()->route('kkk.pemeriksaan', ['tahun_kewangan' => $data['tahun_kewangan'], 'pilih' => $rekod->id])
            ->with('kkk_berjaya', KkkLang::t('Rekod Berjaya Disimpan'));
    }

    /** Creates the missing "expected" accounts (all 3 kategori) for every active school in one tahun/penggal. */
    public function janaPemeriksaan(Request $request)
    {
        if ($redirect = $this->guard(self::PEMERIKSA)) {
            return $redirect;
        }

        $data = $request->validate([
            'tahun_kewangan' => ['required', 'integer', 'min:2000', 'max:2100'],
            'penggal' => ['required', 'in:1,2'],
        ]);

        $baru = 0;
        foreach (KkkSekolah::where('aktif', true)->get() as $sekolah) {
            foreach (KkkPeminjaman::JENIS as $kategori) {
                $rekod = KkkRekod::firstOrCreate(
                    ['sekolah_id' => $sekolah->id, 'tahun_kewangan' => $data['tahun_kewangan'], 'penggal' => $data['penggal'], 'kategori' => $kategori],
                    ['status' => 'belum_diterima']
                );
                $baru += $rekod->wasRecentlyCreated ? 1 : 0;
            }
        }

        $this->audit(null, 'Akaun dijangka dijana', "{$data['tahun_kewangan']} · Penggal {$data['penggal']} · {$baru} akaun");

        return redirect()->route('kkk.pemeriksaan', ['tahun_kewangan' => $data['tahun_kewangan'], 'penggal' => $data['penggal']])
            ->with('kkk_berjaya', KkkLang::t('Rekod Berjaya Disimpan').' ('.$baru.')');
    }

    public function terimaPemeriksaan(Request $request, KkkRekod $rekod)
    {
        if ($redirect = $this->guard(self::PEMERIKSA)) {
            return $redirect;
        }

        if ($rekod->tarikh_diterima) {
            return back()->with('kkk_ralat', KkkLang::t('Anda tiada kebenaran untuk tindakan ini.'));
        }

        $data = $request->validate(['tarikh_diterima' => ['required', 'date', 'before_or_equal:today']]);

        $rekod->update($data);
        $rekod->refreshStatus();

        $this->audit(null, 'KKK diterima', $rekod->sekolah->nama, $rekod->id);

        return back()->with('kkk_berjaya', KkkLang::t('Rekod Berjaya Disimpan'));
    }

    public function issueKuiri(Request $request, KkkRekod $rekod)
    {
        if ($redirect = $this->guard(self::PEMERIKSA)) {
            return $redirect;
        }

        $terakhir = $rekod->kuiri()->reorder('pusingan', 'desc')->first();

        if ($rekod->locked || ! $rekod->tarikh_diterima) {
            return back()->with('kkk_ralat', KkkLang::t('Anda tiada kebenaran untuk tindakan ini.'));
        }

        if ($terakhir && ! $terakhir->tarikh_jawapan) {
            return back()->with('kkk_ralat', KkkLang::t('V3: Kuiri pusingan sebelumnya belum berjawab.'));
        }

        if ($rekod->kuiri()->count() >= 3) {
            return back()->with('kkk_ralat', KkkLang::t('V3: Had 3 pusingan kuiri telah dicapai.'));
        }

        $data = $request->validate([
            'tarikh_dihadapkan' => ['required', 'date', 'before_or_equal:today', 'after_or_equal:'.($terakhir?->tarikh_jawapan ?? $rekod->tarikh_diterima)->toDateString()],
            'keterangan' => ['nullable', 'string', 'max:1000'],
        ], ['after_or_equal' => KkkLang::t('V2: Turutan tarikh tidak sah.')]);

        $rekod->kuiri()->create($data + ['pusingan' => ($terakhir->pusingan ?? 0) + 1]);
        $rekod->refreshStatus();

        $this->audit(null, 'Kuiri dihadapkan', 'Pusingan '.(($terakhir->pusingan ?? 0) + 1), $rekod->id);

        return back()->with('kkk_berjaya', KkkLang::t('Rekod Berjaya Disimpan'));
    }

    public function recordJawapan(Request $request, KkkRekod $rekod)
    {
        if ($redirect = $this->guard(self::PEMERIKSA)) {
            return $redirect;
        }

        $terakhir = $rekod->kuiri()->reorder('pusingan', 'desc')->first();

        if (! $terakhir || $terakhir->tarikh_jawapan) {
            return back()->with('kkk_ralat', KkkLang::t('Anda tiada kebenaran untuk tindakan ini.'));
        }

        $data = $request->validate([
            'tarikh_jawapan' => ['required', 'date', 'before_or_equal:today', 'after_or_equal:'.$terakhir->tarikh_dihadapkan->toDateString()],
        ], ['after_or_equal' => KkkLang::t('V2: Turutan tarikh tidak sah.')]);

        $terakhir->update($data);
        $rekod->refreshStatus();

        $this->audit(null, 'Jawapan kuiri diterima', 'Pusingan '.$terakhir->pusingan, $rekod->id);

        return back()->with('kkk_berjaya', KkkLang::t('Rekod Berjaya Disimpan'));
    }

    public function confirmTfv(Request $request, KkkRekod $rekod)
    {
        if ($redirect = $this->guard(self::PEMERIKSA)) {
            return $redirect;
        }

        $terakhir = $rekod->kuiri()->reorder('pusingan', 'desc')->first();

        if (! $rekod->tarikh_diterima || $rekod->locked) {
            return back()->with('kkk_ralat', KkkLang::t('Anda tiada kebenaran untuk tindakan ini.'));
        }

        if ($terakhir && ! $terakhir->tarikh_jawapan) {
            return back()->with('kkk_ralat', KkkLang::t('V4: Fairview tidak boleh disahkan semasa kuiri masih terbuka.'));
        }

        $data = $request->validate([
            'tarikh_tfv' => ['required', 'date', 'before_or_equal:today', 'after_or_equal:'.($terakhir?->tarikh_jawapan ?? $rekod->tarikh_diterima)->toDateString()],
        ], ['after_or_equal' => KkkLang::t('V2: Turutan tarikh tidak sah.')]);

        $rekod->update($data + ['locked' => true, 'pegawai_nama' => $this->roleLabel()]);
        $rekod->refreshStatus();

        $this->audit(null, 'True & Fair View disahkan', null, $rekod->id);

        return back()->with('kkk_berjaya', KkkLang::t('Rekod Berjaya Disimpan'));
    }

    public function reopen(Request $request, KkkRekod $rekod)
    {
        if ($redirect = $this->guard(['ketua_sub'])) {
            return $redirect;
        }

        $data = $request->validate(['sebab' => ['required', 'string', 'max:1000']], [
            'sebab.required' => KkkLang::t('V5: Sebab buka semula wajib diisi.'),
        ]);

        $rekod->update(['tarikh_tfv' => null, 'locked' => false]);
        $rekod->refreshStatus();

        $this->audit(null, 'Buka semula rekod', $data['sebab'], $rekod->id);

        return back()->with('kkk_berjaya', KkkLang::t('Rekod Berjaya Disimpan'));
    }

    public function updateCatatan(Request $request, KkkRekod $rekod)
    {
        if ($redirect = $this->guard(self::PEMERIKSA)) {
            return $redirect;
        }

        $data = $request->validate(['catatan' => ['nullable', 'string', 'max:2000']]);
        $rekod->update($data);

        return back()->with('kkk_berjaya', KkkLang::t('Rekod Berjaya Disimpan'));
    }

    /** "Pencapaian: Pemeriksaan Kunci Kira-kira Sekolah" — the slide's four cards, live. */
    public function pencapaian(Request $request)
    {
        if ($redirect = $this->guard(self::PEMERIKSA)) {
            return $redirect;
        }

        $tahunAda = KkkRekod::query()->distinct()->pluck('tahun_kewangan')->map(fn ($y) => (int) $y)->sort()->values();
        $klusterAda = KkkSekolah::query()->distinct()->pluck('kluster')->map(fn ($k) => (int) $k)->sort()->values();

        $dari = (int) $request->query('dari', $tahunAda->first() ?? now()->year);
        $hingga = (int) $request->query('hingga', $tahunAda->last() ?? now()->year);
        $klusterDari = (int) $request->query('kluster_dari', $klusterAda->first() ?? 1);
        $klusterHingga = (int) $request->query('kluster_hingga', $klusterAda->last() ?? 1);

        $rekods = KkkRekod::query()
            ->whereBetween('tahun_kewangan', [min($dari, $hingga), max($dari, $hingga)])
            ->whereHas('sekolah', fn ($q) => $q->whereBetween('kluster', [min($klusterDari, $klusterHingga), max($klusterDari, $klusterHingga)]))
            ->get(['kategori', 'status']);

        $kiraan = fn ($set) => [
            'jumlah' => $set->count(),
            'tfv' => $set->filter(fn ($r) => KkkRekod::kumpulanPencapaian($r->status) === 'tfv')->count(),
            'kueri' => $set->filter(fn ($r) => KkkRekod::kumpulanPencapaian($r->status) === 'kueri')->count(),
            'belum' => $set->filter(fn ($r) => KkkRekod::kumpulanPencapaian($r->status) === 'belum')->count(),
            'tidak' => $set->filter(fn ($r) => KkkRekod::kumpulanPencapaian($r->status) === 'tidak')->count(),
        ];

        $kad = [];
        foreach (['Yuran', 'Kantin', 'Rampaian'] as $k) {
            $kad[$k] = $kiraan($rekods->where('kategori', $k));
        }
        $kad['Jumlah'] = $kiraan($rekods);

        return view('kkk.pencapaian', [
            'kad' => $kad,
            'dari' => min($dari, $hingga),
            'hingga' => max($dari, $hingga),
            'klusterDari' => min($klusterDari, $klusterHingga),
            'klusterHingga' => max($klusterDari, $klusterHingga),
            'tahunPilihan' => $tahunAda->isEmpty() ? collect([now()->year]) : $tahunAda,
            'klusterPilihan' => $klusterAda->isEmpty() ? collect([1]) : $klusterAda,
        ]);
    }

    public function dashboard()
    {
        if ($redirect = $this->guard(['ketua_sub', 'pengawas'])) {
            return $redirect;
        }

        $tahun = now()->year;
        $semua = KkkPeminjaman::with('items.sekolah')->whereYear('tarikh_permohonan', $tahun)->get();

        $kpi = [
            'jumlah' => $semua->count(),
            'dipohon' => $semua->where('status', 'dipohon')->count(),
            'diLuarStor' => $semua->whereIn('status', KkkPeminjaman::DI_LUAR_STOR)->count(),
            'dikembalikan' => $semua->where('status', 'dikembalikan')->count(),
            'selesai' => $semua->where('status', 'selesai')->count(),
        ];

        $byJenis = collect(KkkPeminjaman::JENIS)->mapWithKeys(fn ($j) => [$j => [
            'jumlah' => $semua->filter(fn ($b) => in_array($j, $b->jenis, true))->count(),
            'selesai' => $semua->filter(fn ($b) => in_array($j, $b->jenis, true) && $b->status === 'selesai')->count(),
        ]]);

        $locale = KkkLang::locale();
        $byStatus = collect(KkkPeminjaman::META)->map(fn ($m, $status) => [
            'label' => $m['label'][$locale === 'en' ? 1 : 0],
            'colour' => $m['dot'],
            'jumlah' => $semua->where('status', $status)->count(),
        ])->values();

        $susulan = $semua->whereNotIn('status', ['selesai', 'ditolak'])
            ->sortBy(fn ($b) => $b->tarikh_permohonan)
            ->take(10);

        return view('kkk.dashboard', compact('kpi', 'byJenis', 'byStatus', 'susulan', 'tahun'));
    }

    /** Printable borang — filled from a saved borang (?pilih=id) or blank. */
    public function borangPeminjaman(Request $request)
    {
        if ($redirect = $this->guard(array_keys(self::ROLES))) {
            return $redirect;
        }

        $borang = $request->filled('pilih') ? KkkPeminjaman::with('items.sekolah')->find($request->query('pilih')) : null;

        return view('kkk.borang-peminjaman', compact('borang'));
    }

    public function executive()
    {
        if ($redirect = $this->guard(['ketua_sub', 'pengawas'])) {
            return $redirect;
        }

        $tahun = now()->year;
        $sekolahs = KkkSekolah::with('pemimpinSemasa')->where('aktif', true)->orderBy('nama')->get();
        $borangTahunIni = KkkPeminjaman::whereYear('tarikh_permohonan', $tahun)->get();

        // Which school/type documents are out of the store right now, and under which borang.
        $diLuar = [];
        KkkPeminjaman::with('items')->whereIn('status', KkkPeminjaman::DI_LUAR_STOR)->get()
            ->each(function ($b) use (&$diLuar) {
                foreach ($b->items as $item) {
                    foreach ($b->jenis as $j) {
                        $diLuar[$item->sekolah_id][$j] = $b;
                    }
                }
            });

        $tiles = [
            'jumlahSekolah' => $sekolahs->count(),
            'sekolahDipinjam' => count($diLuar),
            'permohonan' => $borangTahunIni->count(),
        ];

        $sekolahChart = [
            ['label' => KkkLang::t('Semua dokumen dalam stor'), 'colour' => '#1E6B45', 'jumlah' => $tiles['jumlahSekolah'] - $tiles['sekolahDipinjam']],
            ['label' => KkkLang::t('Ada dokumen dipinjam'), 'colour' => '#D4C820', 'jumlah' => $tiles['sekolahDipinjam']],
        ];

        $bulanan = collect(range(1, 12))->map(fn ($m) => $borangTahunIni->filter(fn ($b) => $b->tarikh_permohonan->month === $m)->count())->all();

        return view('kkk.exec', compact('sekolahs', 'tiles', 'diLuar', 'sekolahChart', 'bulanan', 'tahun'));
    }

    public function sekolah(Request $request)
    {
        if ($redirect = $this->guard(['ketua_sub', 'pengawas'])) {
            return $redirect;
        }

        $kluster = $request->query('kluster', '');
        $sekolahs = KkkSekolah::query()
            ->when($kluster !== '', fn ($q) => $q->where('kluster', $kluster))
            ->orderBy('kluster')->orderByRaw('CASE WHEN kod IS NULL THEN 1 ELSE 0 END')->orderBy('kod')->orderBy('nama')
            ->get();
        $klusterPilihan = KkkSekolah::query()->distinct()->orderBy('kluster')->pluck('kluster');
        $selected = null;

        if ($request->filled('pilih')) {
            $selected = KkkSekolah::with(['pemimpin' => fn ($q) => $q->orderByDesc('tarikh_lantikan')])->find($request->query('pilih'));
        }

        return view('kkk.sekolah', compact('sekolahs', 'selected', 'kluster', 'klusterPilihan'));
    }

    public function storeLeader(Request $request, KkkSekolah $sekolah)
    {
        if ($redirect = $this->guard(['pengawas'])) {
            return $redirect;
        }

        $data = $request->validate([
            'nama' => ['required', 'string', 'max:200'],
            'jawatan' => ['required', 'in:Pengetua,Guru Besar'],
            'tarikh_lantikan' => ['required', 'date', 'before_or_equal:today'],
        ]);

        $sekolah->pemimpin()->where('semasa', true)->update([
            'semasa' => false,
            'tarikh_tamat' => $data['tarikh_lantikan'],
        ]);

        $sekolah->pemimpin()->create($data + ['semasa' => true]);

        $this->audit(null, KkkLang::t('Tambah pemimpin baharu'), $sekolah->nama.' — '.$data['nama']);

        return redirect()->route('kkk.sekolah', ['pilih' => $sekolah->id])->with('kkk_berjaya', KkkLang::t('Rekod Berjaya Disimpan'));
    }

    public function import()
    {
        if ($redirect = $this->guard(['pengawas'])) {
            return $redirect;
        }

        $preview = null;
        $previewError = null;

        if (session('kkk_import_langkah', 1) === 2 && session('kkk_import_path')) {
            try {
                $preview = $this->readExcelPreview(session('kkk_import_path'));
            } catch (\Throwable $e) {
                $previewError = $e->getMessage();
            }
        }

        return view('kkk.import', [
            'langkah' => session('kkk_import_langkah', 1),
            'fail' => session('kkk_import_fail'),
            'mapping' => self::IMPORT_MAPPING,
            'preview' => $preview,
            'previewError' => $previewError,
            'result' => session('kkk_import_result'),
        ]);
    }

    public function uploadImport(Request $request)
    {
        if ($redirect = $this->guard(['pengawas'])) {
            return $redirect;
        }

        $data = $request->validate(['fail' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:10240']]);

        $path = $data['fail']->store('kkk/import', 'public');
        session([
            'kkk_import_langkah' => 2,
            'kkk_import_fail' => $data['fail']->getClientOriginalName(),
            'kkk_import_path' => $path,
        ]);

        return redirect()->route('kkk.import');
    }

    public function runImport(Request $request)
    {
        if ($redirect = $this->guard(['pengawas'])) {
            return $redirect;
        }

        $path = session('kkk_import_path');
        $sheetCount = 0;
        $rowCount = 0;

        if ($path) {
            try {
                $preview = $this->readExcelPreview($path, 10000);
                $sheetCount = count($preview);
                $rowCount = collect($preview)->sum(fn ($sheet) => count($sheet['rows']));
            } catch (\Throwable $e) {
                // Leave counts at 0 — the done screen reports what was readable.
            }
        }

        // The file is genuinely opened and read (sheets/rows above are real
        // counts from the uploaded workbook). Mapping those rows into
        // kkk_rekod records is still deferred until the legacy code meanings
        // are confirmed against a real file, so no records are written yet.
        session(['kkk_import_result' => ['sheets' => $sheetCount, 'rows' => $rowCount]]);
        $this->audit(null, KkkLang::t('Import fail lain'), session('kkk_import_fail')." ({$sheetCount} sheet, {$rowCount} baris dibaca)");

        session(['kkk_import_langkah' => 3]);

        return redirect()->route('kkk.import');
    }

    /** Open an uploaded workbook from the public disk and return a bounded preview per sheet. */
    protected function readExcelPreview(string $storagePath, int $maxRowsPerSheet = 15, int $maxCols = 8): array
    {
        $fullPath = \Illuminate\Support\Facades\Storage::disk('public')->path($storagePath);

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($fullPath);
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($fullPath);

        $preview = [];

        foreach ($spreadsheet->getAllSheets() as $sheet) {
            $highestRow = min($sheet->getHighestDataRow(), $maxRowsPerSheet);
            $highestCol = min(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($sheet->getHighestDataColumn()), $maxCols);

            $rows = [];
            for ($r = 1; $r <= $highestRow; $r++) {
                $row = [];
                for ($c = 1; $c <= $highestCol; $c++) {
                    $row[] = (string) $sheet->getCellByColumnAndRow($c, $r)->getFormattedValue();
                }
                $rows[] = $row;
            }

            $preview[] = [
                'name' => $sheet->getTitle(),
                'rows' => $rows,
                'totalRows' => $sheet->getHighestDataRow(),
            ];
        }

        return $preview;
    }

    public function resetImport(Request $request)
    {
        if ($redirect = $this->guard(['pengawas'])) {
            return $redirect;
        }

        $request->session()->forget(['kkk_import_langkah', 'kkk_import_fail', 'kkk_import_path', 'kkk_import_result']);

        return redirect()->route('kkk.import');
    }

    public function auditLog()
    {
        if ($redirect = $this->guard(['ketua_sub', 'pengawas'])) {
            return $redirect;
        }

        $log = KkkLogAudit::with(['rekod.sekolah', 'peminjaman.items.sekolah'])->latest('created_at')->paginate(50);

        return view('kkk.audit', compact('log'));
    }

    public function exportAudit()
    {
        if ($redirect = $this->guard(['ketua_sub', 'pengawas'])) {
            return $redirect;
        }

        $entries = KkkLogAudit::with(['rekod.sekolah', 'peminjaman.items.sekolah'])->latest('created_at')->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('kkk.audit-pdf', compact('entries'));

        return $pdf->download('log-audit-kkk-'.now()->format('Y-m-d').'.pdf');
    }
}
