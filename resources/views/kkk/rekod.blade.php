@extends('layouts.kkk')

@section('title', 'Peminjaman Kunci Kira-Kira')

@section('content')
@php
    $t = fn ($s) => \App\Support\KkkLang::t($s);
    $role = session('kkk_role');
    $locale = \App\Support\KkkLang::locale();
    $Borang = \App\Models\Kkk\KkkPeminjaman::class;
    $roleNama = \App\Http\Controllers\KkkController::ROLES;

    // Heading for each signature block on the borang.
    $stepLabel = [
        'benarkan' => 'Dibenarkan oleh',
        'tolak' => 'Ditolak oleh',
        'keluarkan' => 'Dikeluarkan oleh',
        'terima' => 'Dokumen diterima dengan sempurna oleh pemohon',
        'kembalikan' => 'Dikembalikan oleh',
        'terima-stor' => 'Pemulangan diterima oleh',
    ];
@endphp

{{-- Stage timeline: school submission -> borang statuses (KkkPeminjaman::META order). Click a stage to filter the table. --}}
@php
    // Circles: white fill + purple outline; a finished stage turns green fill + purple outline.
    // --c fill, --b border/line/ring, --fg number colour
    $warnaBelum   = '--c:#ffffff;--b:#2E2A7A;--fg:#2E2A7A';
    $warnaSelesai = '--c:#1E8A4F;--b:#2E2A7A;--fg:#ffffff';

    $alur = [['key' => null, 'label' => $t('Diterima'), 'sub' => $t('Borang sekolah'), 'n' => $alurDiterima, 'href' => '#penerimaan']];
    foreach ($Borang::META as $key => $m) {
        if ($key === 'ditolak') continue;
        $alur[] = ['key' => $key, 'label' => $m['label'][$locale === 'en' ? 1 : 0], 'sub' => null, 'n' => $alurKiraan[$key] ?? 0,
                   'href' => route('kkk.rekod', array_filter(['tahun' => $tahun, 'status' => $status === $key ? null : $key, 'jenis' => $jenis]))];
    }

    // The timeline follows ONE record: every stage up to its current status is green, the rest white.
    //  - a borang is selected            -> that borang
    //  - a new school submission arrived -> all white (reset) until a borang is made from it
    //  - otherwise                        -> the newest borang (all green once it is Selesai)
    $ikut = $selected ?: ($alurBaharu ? null : $alurBorang);
    $kedudukan = $ikut && $ikut->status !== 'ditolak'
        ? collect($alur)->search(fn ($s) => $s['key'] === $ikut->status)
        : false;
    foreach ($alur as $i => &$s) {
        $s['siap'] = $kedudukan !== false && $i <= $kedudukan;
        $s['warna'] = $s['siap'] ? $warnaSelesai : $warnaBelum;
    }
    unset($s);

    // Caption: which record is being followed
    if ($ikut) {
        $ikutLabel = $ikut->no_borang.' · '.($ikut->items->first()?->sekolah?->nama ?? '');
        $ikutStatus = $ikut->meta($locale)['label'];
    } elseif ($alurBaharu) {
        $ikutLabel = $alurPenerimaan->nama_sekolah;
        $ikutStatus = $t('Rekod baharu');
    } else {
        $ikutLabel = null;
    }
    $ditolak = $Borang::META['ditolak'];
@endphp
<nav class="kkk-alur" aria-label="{{ $t('Aliran Peminjaman') }}">
    <div class="kkk-alur-head">
        <span>
            {{ $t('Aliran Peminjaman') }} · {{ $tahun }}
            @if ($ikutLabel)
                <span class="kkk-alur-ikut">{{ $t('Mengikut') }}: <b>{{ $ikutLabel }}</b> — {{ $ikutStatus }}</span>
            @endif
        </span>
        <a href="{{ route('kkk.rekod', array_filter(['tahun' => $tahun, 'status' => $status === 'ditolak' ? null : 'ditolak', 'jenis' => $jenis])) }}"
           class="kkk-alur-tolak {{ $status === 'ditolak' ? 'is-on' : '' }}" style="--c: {{ $ditolak['dot'] }}">
            &times; {{ $ditolak['label'][$locale === 'en' ? 1 : 0] }} <b>{{ $alurKiraan['ditolak'] ?? 0 }}</b>
        </a>
    </div>
    <ol class="kkk-alur-steps">
        @foreach ($alur as $i => $s)
            <li class="{{ $s['n'] > 0 ? 'has' : '' }} {{ $s['siap'] ? 'siap' : '' }} {{ $s['key'] && $status === $s['key'] ? 'is-on' : '' }}" style="{{ $s['warna'] }}">
                <a href="{{ $s['href'] }}" title="{{ $s['label'] }}: {{ $s['n'] }}">
                    <span class="kkk-alur-dot">{{ $s['n'] }}</span>
                    <span class="kkk-alur-lbl">{{ $i + 1 }}. {{ $s['label'] }}</span>
                    @if ($s['sub'])<span class="kkk-alur-sub">{{ $s['sub'] }}</span>@endif
                </a>
            </li>
        @endforeach
    </ol>
</nav>

<div class="kkk-page-head">
    <h1>{{ $t('Peminjaman Kunci Kira-Kira') }}</h1>
    <p>{{ $t('Borang Permohonan Peminjaman Dokumen Kunci Kira-Kira Kewangan Sekolah (FRRV)') }}</p>
</div>

<div class="kkk-grid cols-2" style="align-items:start">
    <div>
        <form method="GET" action="{{ route('kkk.rekod') }}" class="kkk-card" style="display:flex;gap:14px;flex-wrap:wrap;align-items:flex-end">
            <div class="kkk-field" style="margin:0">
                <label>{{ $t('Tahun') }}</label>
                <select name="tahun" class="kkk-input" onchange="this.form.submit()">
                    @foreach ($tahunPilihan as $y)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div class="kkk-field" style="margin:0">
                <label>{{ $t('Status') }}</label>
                <select name="status" class="kkk-input" onchange="this.form.submit()">
                    <option value="">{{ $t('Semua') }}</option>
                    @foreach ($Borang::META as $key => $m)
                        <option value="{{ $key }}" {{ $status === $key ? 'selected' : '' }}>{{ $m['label'][$locale === 'en' ? 1 : 0] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="kkk-field" style="margin:0">
                <label>{{ $t('Jenis KKK') }}</label>
                <select name="jenis" class="kkk-input" onchange="this.form.submit()">
                    <option value="">{{ $t('Semua') }}</option>
                    @foreach ($Borang::JENIS as $j)
                        <option value="{{ $j }}" {{ $jenis === $j ? 'selected' : '' }}>{{ $t($j) }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <div>
        @if ($selected)
            @php $m = $selected->meta($locale); @endphp
            <div class="kkk-card">
                <a href="{{ route('kkk.borang', ['pilih' => $selected->id]) }}" target="_blank" class="kkk-btn kkk-btn-ghost" style="float:right">{{ $t('Cetak Borang') }}</a>
                <h2>{{ $selected->no_borang }}</h2>
                <p class="kkk-muted" style="margin:-8px 0 12px">
                    {{ collect($selected->jenis)->map($t)->implode(', ') }} · {{ $t($selected->tujuanLabel()) }} · {{ $selected->tarikh_permohonan->format('d/m/Y') }}
                </p>
                <span class="kkk-badge" style="background:{{ $m['bg'] }};color:{{ $m['fg'] }}"><span class="dot" style="background:{{ $m['dot'] }}"></span>{{ $m['label'] }}</span>

                <table class="kkk-table" style="margin-top:14px">
                    <thead><tr><th>{{ $t('Bil') }}</th><th>{{ $t('Nama Sekolah') }}</th><th>{{ $t('Tempoh dan Tahun KKK') }}</th></tr></thead>
                    <tbody>
                        @foreach ($selected->items as $item)
                            <tr><td>{{ $item->bil }}</td><td>{{ $item->sekolah?->nama }}</td><td>{{ $t($item->tempoh()) }}</td></tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="kkk-timeline" style="margin-top:16px">
                    @php
                        $timeline = [
                            ['Dipohon oleh', $selected->pemohon_nama, $selected->tarikh_permohonan],
                            [$selected->status === 'ditolak' ? 'Ditolak oleh' : 'Dibenarkan oleh', $selected->dibenarkan_nama, $selected->tarikh_dibenarkan],
                            ['Dikeluarkan oleh', $selected->dikeluarkan_nama, $selected->tarikh_dikeluarkan],
                            ['Diterima oleh pemohon', $selected->diterima_nama, $selected->tarikh_diterima],
                            ['Dikembalikan oleh', $selected->dikembalikan_nama, $selected->tarikh_dikembalikan],
                            ['Pemulangan diterima oleh', $selected->diterima_stor_nama, $selected->tarikh_diterima_stor],
                        ];
                        if ($selected->status === 'ditolak') {
                            $timeline = array_slice($timeline, 0, 2);
                        }
                    @endphp
                    @foreach ($timeline as [$label, $nama, $tarikh])
                        <div class="step {{ $tarikh ? 'done' : '' }}">
                            <span class="pt"></span>
                            <span><span class="lbl">{{ $t($label) }}</span> — <span class="dt">{{ $tarikh ? $nama.' · '.$tarikh->format('d/m/Y') : '—' }}</span></span>
                        </div>
                    @endforeach
                </div>

                @if ($selected->sebab_ditolak)
                    <p style="font-size:12.5px"><strong>{{ $t('Sebab ditolak') }}:</strong> {{ $selected->sebab_ditolak }}</p>
                @endif
                @if ($selected->catatan_semakan)
                    <p style="font-size:12.5px"><strong>{{ $t('Semakan atau catatan') }}:</strong> {{ $selected->catatan_semakan }}</p>
                @endif

                @php
                    $bolehLangkah = collect($steps)->filter(fn ($s) => $s['from'] === $selected->status);
                    $langkahSaya = $bolehLangkah->filter(fn ($s) => $s['role'] === $role);
                    $langkah = $langkahSaya->keys()->first();
                @endphp

                @if ($langkah)
                    @php
                        $s = $steps[$langkah];
                        $p = $s['prefix'];
                        $namaLalai = $role === 'pemohon' ? $selected->pemohon_nama : '';
                        $jawatanLalai = $role === 'pemohon' ? $selected->pemohon_jawatan : $roleNama[$role];
                    @endphp
                    <form method="POST" action="{{ route('kkk.rekod.langkah', [$selected, $langkah]) }}" style="margin-top:14px;border-top:1px solid var(--kkk-border);padding-top:14px">
                        @csrf
                        <h2>{{ $t($stepLabel[$langkah]) }}</h2>
                        <div class="kkk-grid cols-2">
                            <div class="kkk-field">
                                <label>{{ $t('Nama') }}</label>
                                <input type="text" name="{{ $p }}_nama" class="kkk-input" value="{{ old($p.'_nama', $namaLalai) }}" required>
                            </div>
                            <div class="kkk-field">
                                <label>{{ $t('Jawatan') }}</label>
                                <input type="text" name="{{ $p }}_jawatan" class="kkk-input" value="{{ old($p.'_jawatan', $jawatanLalai) }}">
                            </div>
                        </div>
                        <div class="kkk-field">
                            <label>{{ $t('Tarikh') }}</label>
                            <input type="date" name="{{ $s['tarikh'] }}" class="kkk-input" value="{{ old($s['tarikh'], now()->toDateString()) }}"
                                   min="{{ $selected->{$s['selepas']}?->toDateString() }}" max="{{ now()->toDateString() }}" required>
                        </div>

                        @if ($langkah === 'benarkan')
                            <div class="kkk-field">
                                <label>{{ $t('Sebab ditolak (jika ditolak)') }}</label>
                                <textarea name="sebab_ditolak" class="kkk-input">{{ old('sebab_ditolak') }}</textarea>
                            </div>
                            <button type="submit" class="kkk-btn kkk-btn-primary">{{ $t('Benarkan') }}</button>
                            <button type="submit" class="kkk-btn kkk-btn-danger" formaction="{{ route('kkk.rekod.langkah', [$selected, 'tolak']) }}">{{ $t('Tolak') }}</button>
                        @elseif ($langkah === 'terima-stor')
                            <div class="kkk-field">
                                <label>{{ $t('Semakan atau catatan') }}</label>
                                <textarea name="catatan_semakan" class="kkk-input">{{ old('catatan_semakan') }}</textarea>
                            </div>
                            <button type="submit" class="kkk-btn kkk-btn-accent">{{ $t('Sahkan pemulangan') }}</button>
                        @else
                            <button type="submit" class="kkk-btn kkk-btn-primary">{{ $t('Sahkan') }}</button>
                        @endif
                    </form>
                @elseif ($bolehLangkah->isNotEmpty())
                    <p class="kkk-muted" style="margin-top:14px;border-top:1px solid var(--kkk-border);padding-top:14px;font-size:12.5px">
                        {{ $t('Menunggu tindakan') }}: {{ $t($roleNama[$bolehLangkah->first()['role']]) }}
                    </p>
                @endif
            </div>
        {{-- "Borang Peminjaman Kunci Kira-Kira" placeholder card (shown when no borang is selected) -- hidden 20/10/2026.
             The printable borang is still at route('kkk.borang') and via "Cetak Borang" on a selected borang.
        @else
            <div class="kkk-card kkk-empty">
                @if ($role === 'pemohon')
                    <a href="{{ route('kkk.borang') }}" target="_blank" class="kkk-btn kkk-btn-primary">{{ $t('Borang Peminjaman Kunci Kira-Kira') }}</a>
                @else
                    <a href="{{ route('kkk.borang') }}" target="_blank" class="kkk-btn kkk-btn-primary">{{ $t('Borang Peminjaman Kunci Kira-Kira') }}</a>
                @endif
            </div>
        --}}
        @endif
    </div>
</div>

{{-- Submissions from the public form /borangkuncikirakira (kkk_pengesahan_penerimaan) --}}
@php
    $kategoriWarna = fn ($k) => $k === 'Baru'
        ? ['bg' => '#e6f4ea', 'fg' => '#1e6b3a', 'dot' => '#2e9b57']
        : ['bg' => '#fff4e0', 'fg' => '#8a5300', 'dot' => '#e08a00'];
@endphp
<div class="kkk-card" id="penerimaan" style="max-width:960px;margin:20px auto 0">
    <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:12px;flex-wrap:wrap">
        <div>
            <h2 style="margin-bottom:4px">{{ $t('Penerimaan Kunci Kira-Kira') }}</h2>
            <p class="kkk-muted" style="margin:0;font-size:12.5px">
                {{ $t('Rekod daripada borang sekolah') }} ·
                <a href="{{ route('kkk.pengesahan') }}" target="_blank">{{ $t('Buka borang') }}</a> ·
                {{ $penerimaan->total() }} {{ $t('rekod') }}
            </p>
        </div>
        <form method="GET" action="{{ route('kkk.rekod') }}#penerimaan" style="display:flex;gap:10px;flex-wrap:wrap;align-items:flex-end">
            {{-- keep the peminjaman filters when filtering this box --}}
            @foreach (array_filter(['tahun' => $tahun, 'status' => $status, 'jenis' => $jenis, 'pilih' => request('pilih')]) as $k => $v)
                <input type="hidden" name="{{ $k }}" value="{{ $v }}">
            @endforeach
            <div class="kkk-field" style="margin:0">
                <label>{{ $t('Kluster') }}</label>
                <select name="p_kluster" class="kkk-input" onchange="this.form.submit()">
                    <option value="">{{ $t('Semua') }}</option>
                    @foreach ($klusterPilihan as $k)
                        <option value="{{ $k }}" {{ $pKluster === $k ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
            </div>
            <div class="kkk-field" style="margin:0">
                <label>{{ $t('Cari') }}</label>
                <input type="search" name="p_cari" class="kkk-input" value="{{ $pCari }}" placeholder="{{ $t('Sekolah atau penghantar') }}">
            </div>
            <button type="submit" class="kkk-btn kkk-btn-ghost">{{ $t('Cari') }}</button>
        </form>
    </div>

    {{-- Validation errors from a row's "Hantar permohonan" (the layout only shows kkk_ralat) --}}
    @if ($errors->any())
        <div class="kkk-alert err" style="margin-top:12px">
            @foreach ($errors->all() as $e)
                <div>&times; {{ $e }}</div>
            @endforeach
        </div>
    @endif

    @if ($penerimaan->isEmpty())
        <div class="kkk-empty">{{ $t('Tiada rekod penerimaan.') }}</div>
    @else
        <div style="overflow-x:auto;margin-top:14px">
            <table class="kkk-table">
                <thead>
                    <tr>
                        <th>{{ $t('Tarikh Diterima') }}</th>
                        <th>{{ $t('Sekolah') }}</th>
                        <th>{{ $t('Kategori') }}</th>
                        <th>{{ $t('Jenis KKK') }}</th>
                        <th>{{ $t('Tempoh dan Tahun KKK') }}</th>
                        <th>{{ $t('Penghantar') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penerimaan as $r)
                        @php $w = $kategoriWarna($r->kategori); @endphp
                        <tr>
                            <td style="white-space:nowrap">{{ $r->created_at->format('d/m/Y') }}<br><span class="kkk-muted">{{ $r->created_at->format('h:i A') }}</span></td>
                            <td>{{ $r->nama_sekolah }}<br><span class="kkk-muted">{{ $r->kluster }}</span></td>
                            <td><span class="kkk-badge" style="background:{{ $w['bg'] }};color:{{ $w['fg'] }}"><span class="dot" style="background:{{ $w['dot'] }}"></span>{{ $t($r->kategori) }}</span></td>
                            <td>{{ $t($r->jenis) }}</td>
                            <td style="white-space:nowrap">{{ $t($r->tempoh) }}<br><span class="kkk-muted">{{ $r->tahun }}</span></td>
                            <td>{{ $r->nama_penghantar }}<br><span class="kkk-muted">{{ $r->jawatan }} · {{ $r->no_tel }}</span></td>
                            <td style="text-align:right;white-space:nowrap">
                                {{-- Same action as "Hantar permohonan" below: posts a peminjaman for this school/period --}}
                                @if ($role !== 'pemohon')
                                    <span class="kkk-btn kkk-btn-primary" style="opacity:.45;cursor:not-allowed" title="{{ $t('Tukar peranan kepada Pemohon untuk menghantar permohonan') }}">{{ $t('Hantar permohonan') }}</span>
                                @elseif (! $r->sekolah_id)
                                    <span class="kkk-btn kkk-btn-primary" style="opacity:.45;cursor:not-allowed" title="{{ $t('Sekolah tiada dalam senarai sekolah KKK') }}">{{ $t('Hantar permohonan') }}</span>
                                @else
                                    <form method="POST" action="{{ route('kkk.rekod.store') }}" style="margin:0" onsubmit="return kkkPemohon(this)">
                                        @csrf
                                        @foreach ($r->jenis_list as $j)
                                            <input type="hidden" name="jenis[]" value="{{ $j }}">
                                        @endforeach
                                        <input type="hidden" name="items[0][sekolah_id]" value="{{ $r->sekolah_id }}">
                                        <input type="hidden" name="items[0][penggal]" value="{{ $r->penggal }}">
                                        <input type="hidden" name="items[0][tahun_kewangan]" value="{{ $r->tahun }}">
                                        <input type="hidden" name="tujuan" value="semakan">
                                        <input type="hidden" name="tarikh_permohonan" value="{{ now()->toDateString() }}">
                                        {{-- Pemohon = the school's sender on this record --}}
                                        <input type="hidden" name="pemohon_nama" value="{{ $r->nama_penghantar }}">
                                        <input type="hidden" name="pemohon_jawatan" value="{{ $r->jawatan }}">
                                        <button type="submit" class="kkk-btn kkk-btn-primary">{{ $t('Hantar permohonan') }}</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
            // Row "Hantar permohonan": confirm the applicant's name (pre-filled with the record's Penghantar)
            function kkkPemohon(form) {
                var nama = prompt(@json($t('Nama Pemohon')), form.pemohon_nama.value || '');
                if (nama === null || !nama.trim()) return false;
                form.pemohon_nama.value = nama.trim();
                return true;
            }
        </script>

        @if ($penerimaan->hasPages())
            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:12px;font-size:12.5px">
                <span class="kkk-muted">{{ $penerimaan->firstItem() }}–{{ $penerimaan->lastItem() }} / {{ $penerimaan->total() }}</span>
                <span style="display:flex;gap:8px">
                    @if ($penerimaan->onFirstPage())
                        <span class="kkk-btn kkk-btn-ghost" style="opacity:.45;pointer-events:none">‹ {{ $t('Sebelum') }}</span>
                    @else
                        <a href="{{ $penerimaan->previousPageUrl() }}" class="kkk-btn kkk-btn-ghost">‹ {{ $t('Sebelum') }}</a>
                    @endif
                    @if ($penerimaan->hasMorePages())
                        <a href="{{ $penerimaan->nextPageUrl() }}" class="kkk-btn kkk-btn-ghost">{{ $t('Seterusnya') }} ›</a>
                    @else
                        <span class="kkk-btn kkk-btn-ghost" style="opacity:.45;pointer-events:none">{{ $t('Seterusnya') }} ›</span>
                    @endif
                </span>
            </div>
        @endif
    @endif
</div>

<div class="kkk-card" style="padding:0;max-width:960px;margin:20px auto 0">
    @if ($peminjaman->isEmpty())
        <div class="kkk-empty">{{ $t('Tiada rekod bagi tempoh ini.') }}</div>
    @else
        <table class="kkk-table">
            <thead>
                <tr>
                    <th>{{ $t('No. Borang') }}</th>
                    <th>{{ $t('Sekolah') }}</th>
                    <th>{{ $t('Jenis KKK') }}</th>
                    <th>{{ $t('Tarikh Permohonan') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman as $b)
                    <tr class="clickable {{ $selected && $selected->id === $b->id ? 'is-selected' : '' }}"
                        onclick="window.location='{{ route('kkk.rekod', array_filter(['tahun' => $tahun, 'status' => $status, 'jenis' => $jenis, 'pilih' => $b->id])) }}'">
                        <td>{{ $b->no_borang }}</td>
                        <td>
                            {{ $b->items->first()?->sekolah?->nama }}
                            @if ($b->items->count() > 1)
                                <span class="kkk-muted">+{{ $b->items->count() - 1 }}</span>
                            @endif
                        </td>
                        <td>{{ collect($b->jenis)->map($t)->implode(', ') }}</td>
                        <td>{{ $b->tarikh_permohonan->format('d/m/Y') }}</td>
                        <td>
                            @php $m = $b->meta($locale); @endphp
                            <span class="kkk-badge" style="background:{{ $m['bg'] }};color:{{ $m['fg'] }}"><span class="dot" style="background:{{ $m['dot'] }}"></span>{{ $m['label'] }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

{{-- "+ Permohonan peminjaman baharu" form -- hidden 19/10/2026. Applications are now sent with the
     "Hantar permohonan" button on each Penerimaan row (same kkk.rekod.store action). Remove this comment to restore.
@if ($role === 'pemohon')
    <form method="POST" action="{{ route('kkk.rekod.store') }}" id="borang-baharu" class="kkk-card" style="max-width:960px;margin:20px auto 0">
        @csrf
        <h2>{{ $t('+ Permohonan peminjaman baharu') }}</h2>

        <div class="kkk-field">
            <label>{{ $t('Jenis KKK') }}</label>
            <div style="display:flex;gap:22px;flex-wrap:wrap;padding:6px 0">
                @foreach ($Borang::JENIS as $j)
                    <label style="display:inline-flex;align-items:center;gap:8px;font-size:13px;color:inherit;letter-spacing:0">
                        <input type="checkbox" name="jenis[]" value="{{ $j }}" {{ in_array($j, old('jenis', []), true) ? 'checked' : '' }}> {{ $t($j) }}
                    </label>
                @endforeach
            </div>
        </div>

        <table class="kkk-table" style="margin-bottom:12px">
            <thead><tr><th style="width:50px">{{ $t('Bil') }}</th><th>{{ $t('Nama Sekolah') }}</th><th colspan="2">{{ $t('Tempoh dan Tahun KKK') }}</th></tr></thead>
            <tbody>
                @for ($i = 0; $i < 5; $i++)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>
                            <select name="items[{{ $i }}][sekolah_id]" class="kkk-input" {{ $i === 0 ? 'required' : '' }}>
                                <option value="">—</option>
                                @foreach ($sekolahs as $s)
                                    <option value="{{ $s->id }}" {{ old("items.$i.sekolah_id") == $s->id ? 'selected' : '' }}>{{ $s->nama }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="items[{{ $i }}][penggal]" class="kkk-input">
                                <option value="">{{ $t('Setahun') }}</option>
                                <option value="1" {{ old("items.$i.penggal") == '1' ? 'selected' : '' }}>{{ $t('Penggal 1 · Jan-Jun') }}</option>
                                <option value="2" {{ old("items.$i.penggal") == '2' ? 'selected' : '' }}>{{ $t('Penggal 2 · Jul-Dis') }}</option>
                            </select>
                        </td>
                        <td>
                            <select name="items[{{ $i }}][tahun_kewangan]" class="kkk-input">
                                @foreach ($tahunPilihan as $y)
                                    <option value="{{ $y }}" {{ old("items.$i.tahun_kewangan", now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>

        <div class="kkk-field">
            <label>{{ $t('Tujuan KKK') }}</label>
            <div style="display:flex;gap:22px;flex-wrap:wrap;align-items:center;padding:6px 0">
                @foreach ($Borang::TUJUAN as $key => $label)
                    <label style="display:inline-flex;align-items:center;gap:8px;font-size:13px;color:inherit;letter-spacing:0">
                        <input type="radio" name="tujuan" value="{{ $key }}" {{ old('tujuan', 'semakan') === $key ? 'checked' : '' }} required> {{ $t($key === 'lain' ? 'Sila nyatakan' : $label) }}
                    </label>
                @endforeach
                <input type="text" name="tujuan_lain" class="kkk-input" style="flex:1;min-width:200px" value="{{ old('tujuan_lain') }}" placeholder="{{ $t('Sila nyatakan') }}">
            </div>
        </div>

        <div class="kkk-grid cols-3">
            <div class="kkk-field">
                <label>{{ $t('Tarikh Permohonan') }}</label>
                <input type="date" name="tarikh_permohonan" class="kkk-input" value="{{ old('tarikh_permohonan', now()->toDateString()) }}" max="{{ now()->toDateString() }}" required>
            </div>
            <div class="kkk-field">
                <label>{{ $t('Nama Pemohon') }}</label>
                <input type="text" name="pemohon_nama" class="kkk-input" value="{{ old('pemohon_nama') }}" required>
            </div>
            <div class="kkk-field">
                <label>{{ $t('Jawatan') }}</label>
                <input type="text" name="pemohon_jawatan" class="kkk-input" value="{{ old('pemohon_jawatan') }}">
            </div>
        </div>
        <button type="submit" class="kkk-btn kkk-btn-primary">{{ $t('Hantar permohonan') }}</button>
    </form>
@endif
--}}
@endsection
