@extends('layouts.kkk')

@section('title', 'Pencapaian Pemeriksaan')

@section('content')
@php
    $t = fn ($s) => \App\Support\KkkLang::t($s);
    $bulan = $t('Jan|Feb|Mac|Apr|Mei|Jun|Jul|Ogo|Sep|Okt|Nov|Dis');
    $bulan = explode('|', $bulan);
    $sehingga = now()->day.' '.$bulan[now()->month - 1].' '.now()->year;

    // The slide's four cards: colour, heading and icon.
    $kadMeta = [
        'Yuran' => ['tajuk' => 'Akaun Yuran', 'warna' => '#1E7B3A', 'ikon' => 'yuran'],
        'Kantin' => ['tajuk' => 'Akaun Kantin', 'warna' => '#1F5FC4', 'ikon' => 'kantin'],
        'Rampaian' => ['tajuk' => 'Akaun Rampaian', 'warna' => '#E8641C', 'ikon' => 'rampaian'],
        'Jumlah' => ['tajuk' => 'Jumlah Keseluruhan', 'warna' => '#14234B', 'ikon' => 'jumlah'],
    ];

    // The slide's four rows.
    $baris = [
        'tfv' => ['label' => 'True & Fair View', 'warna' => '#1E6B45', 'ikon' => 'tfv'],
        'kueri' => ['label' => 'Kueri', 'warna' => '#E8641C', 'ikon' => 'kueri'],
        'belum' => ['label' => 'Belum Diperiksa', 'warna' => '#1F4FBF', 'ikon' => 'belum'],
        'tidak' => ['label' => 'Tidak Diterima', 'warna' => '#D7261E', 'ikon' => 'tidak'],
    ];

    $ikon = [
        'yuran' => '<path d="M12 3 2 8l10 5 10-5-10-5Z"/><path d="M6 10.5V14c0 1.5 2.7 3 6 3s6-1.5 6-3v-3.5"/><path d="M22 8v5"/>',
        'kantin' => '<path d="M3 18h13"/><path d="M4 16a5.5 5.5 0 0 1 11 0"/><path d="M9.5 9V8"/><path d="M17 8h4l-1 12h-2.5"/><path d="M19 8l1-4"/>',
        'rampaian' => '<path d="M3 7.5 12 3l9 4.5v9L12 21l-9-4.5v-9Z"/><path d="m3 7.5 9 4.5 9-4.5M12 12v9"/><path d="m7.5 5.2 9 4.6"/>',
        'jumlah' => '<path d="M3 21h18M5 21V10h14v11"/><path d="M3 10 12 4l9 6"/><path d="M12 4V1.5h3"/><path d="M10 21v-4h4v4"/><circle cx="12" cy="11.5" r="1.6"/><path d="M7 13h1.5M15.5 13H17M7 16h1.5M15.5 16H17"/>',
        'tfv' => '<circle cx="11" cy="11" r="6"/><path d="m20 20-4.2-4.2"/>',
        'kueri' => '<path d="M9.2 9a3 3 0 1 1 4.3 2.7c-.9.4-1.5 1.2-1.5 2.1v.4"/><path d="M12 17.5h.01"/>',
        'belum' => '<rect x="6" y="4" width="12" height="17" rx="2"/><path d="M9 4V2.5h6V4"/><path d="M9 10h6M9 13.5h6M9 17h4"/>',
        'tidak' => '<path d="m8 8 8 8M16 8l-8 8"/>',
    ];
@endphp

<div class="kkk-page-head">
    <h1>{{ $t('Pencapaian') }} : {{ $t('Pemeriksaan Kunci Kira-kira Sekolah') }} ({{ $dari }}{{ $dari !== $hingga ? ' – '.$hingga : '' }}) : {{ $t('Kluster') }} {{ $klusterDari }}{{ $klusterDari !== $klusterHingga ? ' - '.$klusterHingga : '' }}</h1>
    <p>({{ $t('Sehingga Pada') }} {{ $sehingga }})</p>
</div>

<form method="GET" action="{{ route('kkk.pencapaian') }}" class="kkk-card" style="display:flex;gap:14px;flex-wrap:wrap;align-items:flex-end">
    <div class="kkk-field" style="margin:0">
        <label>{{ $t('Tahun dari') }}</label>
        <select name="dari" class="kkk-input" onchange="this.form.submit()">
            @foreach ($tahunPilihan as $y)
                <option value="{{ $y }}" {{ $dari == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
        </select>
    </div>
    <div class="kkk-field" style="margin:0">
        <label>{{ $t('Tahun hingga') }}</label>
        <select name="hingga" class="kkk-input" onchange="this.form.submit()">
            @foreach ($tahunPilihan as $y)
                <option value="{{ $y }}" {{ $hingga == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
        </select>
    </div>
    <div class="kkk-field" style="margin:0">
        <label>{{ $t('Kluster dari') }}</label>
        <select name="kluster_dari" class="kkk-input" onchange="this.form.submit()">
            @foreach ($klusterPilihan as $k)
                <option value="{{ $k }}" {{ $klusterDari == $k ? 'selected' : '' }}>{{ $k }}</option>
            @endforeach
        </select>
    </div>
    <div class="kkk-field" style="margin:0">
        <label>{{ $t('Kluster hingga') }}</label>
        <select name="kluster_hingga" class="kkk-input" onchange="this.form.submit()">
            @foreach ($klusterPilihan as $k)
                <option value="{{ $k }}" {{ $klusterHingga == $k ? 'selected' : '' }}>{{ $k }}</option>
            @endforeach
        </select>
    </div>
</form>

<div class="kkk-grid cols-4 kkk-capai" style="margin-top:6px">
    @foreach ($kadMeta as $key => $meta)
        @php $d = $kad[$key]; @endphp
        <div class="kkk-card kkk-capai-kad" style="--warna: {{ $meta['warna'] }}">
            <div class="kkk-capai-head">
                <span class="kkk-capai-ikon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="34" height="34">{!! $ikon[$meta['ikon']] !!}</svg>
                </span>
                <div class="kkk-capai-jumlah">
                    <div class="tajuk">{{ $t($meta['tajuk']) }}</div>
                    <div class="sub">{{ $t('Jumlah Akaun') }}</div>
                    <div class="n">{{ number_format($d['jumlah']) }}</div>
                </div>
            </div>

            @foreach ($baris as $bKey => $b)
                @php $pct = $d['jumlah'] ? (int) round($d[$bKey] / $d['jumlah'] * 100) : 0; @endphp
                <div class="kkk-capai-baris" style="--baris: {{ $b['warna'] }}">
                    <div class="atas">
                        <span class="ikon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" width="14" height="14">{!! $ikon[$b['ikon']] !!}</svg></span>
                        <span class="label">{{ $t($b['label']) }}</span>
                        <span class="kira">{{ number_format($d[$bKey]) }}</span>
                        <span class="pct">{{ $pct }}%</span>
                    </div>
                    <div class="bar"><span style="width: {{ $pct }}%"></span></div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection
