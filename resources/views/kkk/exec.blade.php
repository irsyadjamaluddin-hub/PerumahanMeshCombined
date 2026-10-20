@extends('layouts.kkk')

@section('title', 'Dashboard Eksekutif')

@section('content')
@php
    $t = fn ($s) => \App\Support\KkkLang::t($s);
    $locale = \App\Support\KkkLang::locale();
@endphp

<div class="kkk-page-head">
    <h1>{{ $t('Dashboard Eksekutif') }}</h1>
    <p>{{ $tahun }}</p>
</div>

<div class="kkk-grid cols-3">
    <div class="kkk-card kkk-kpi"><div class="n">{{ $tiles['jumlahSekolah'] }}</div><div class="l">{{ $t('Jumlah sekolah') }}</div></div>
    <div class="kkk-card kkk-kpi"><div class="n">{{ $tiles['sekolahDipinjam'] }}</div><div class="l">{{ $t('Sekolah dengan dokumen dipinjam') }}</div></div>
    <div class="kkk-card kkk-kpi"><div class="n">{{ $tiles['permohonan'] }}</div><div class="l">{{ $t('Permohonan peminjaman tahun ini') }}</div></div>
</div>

<div class="kkk-grid cols-2" style="align-items:stretch;margin-top:6px">
    <div class="kkk-card">
        <h2>{{ $t('Dokumen sekolah') }}</h2>
        @if ($tiles['jumlahSekolah'])
            <div style="position:relative;height:280px"><canvas id="kkkSekolahPie"></canvas></div>
        @else
            <div class="kkk-empty">{{ $t('Tiada rekod bagi tempoh ini.') }}</div>
        @endif
    </div>

    <div class="kkk-card">
        <h2>{{ $t('Permohonan mengikut bulan') }}</h2>
        @if ($tiles['permohonan'])
            <div style="position:relative;height:280px"><canvas id="kkkKategoriBar"></canvas></div>
        @else
            <div class="kkk-empty">{{ $t('Tiada rekod bagi tempoh ini.') }}</div>
        @endif
    </div>
</div>

<div class="kkk-card" style="margin-top:16px;padding:0">
    <table class="kkk-table">
        <thead>
            <tr>
                <th>{{ $t('Sekolah') }}</th>
                <th>{{ $t('Peringkat') }}</th>
                <th>{{ $t('Kluster') }}</th>
                <th>{{ $t('Pemimpin semasa') }}</th>
                <th>{{ $t('Kantin') }}</th>
                <th>{{ $t('Yuran') }}</th>
                <th>{{ $t('Rampaian') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sekolahs as $s)
                <tr>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $t($s->peringkat) }}</td>
                    <td>{{ $s->kluster }}</td>
                    <td>{{ $s->pemimpinSemasa->nama ?? '—' }}</td>
                    @foreach (['Kantin', 'Yuran', 'Rampaian'] as $kat)
                        @php $b = $diLuar[$s->id][$kat] ?? null; @endphp
                        <td>
                            @if ($b)
                                @php $m = $b->meta($locale); @endphp
                                <span class="kkk-badge" style="background:{{ $m['bg'] }};color:{{ $m['fg'] }}" title="{{ $b->no_borang }}"><span class="dot" style="background:{{ $m['dot'] }}"></span>{{ $m['label'] }}</span>
                            @else
                                <span class="kkk-muted">{{ $t('Dalam stor') }}</span>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@php
    $bulanLabels = array_map($t, ['Jan', 'Feb', 'Mac', 'Apr', 'Mei', 'Jun', 'Jul', 'Ogo', 'Sep', 'Okt', 'Nov', 'Dis']);
@endphp
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
    (function () {
        const dark = document.documentElement.dataset.theme === 'dark';
        const grid = dark ? 'rgba(255,255,255,.1)' : 'rgba(30,27,58,.08)';
        Chart.defaults.font.family = "'Barlow', system-ui, sans-serif";
        Chart.defaults.color = dark ? '#ECEAF9' : '#1E1B3A';

        const sekolah = @json($sekolahChart);
        const pie = document.getElementById('kkkSekolahPie');
        if (pie) {
            new Chart(pie, {
                type: 'pie',
                data: {
                    labels: sekolah.map(s => s.label),
                    datasets: [{
                        data: sekolah.map(s => s.jumlah),
                        backgroundColor: sekolah.map(s => s.colour),
                        borderColor: dark ? '#1E1B3A' : '#fff',
                        borderWidth: 2,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'right', labels: { usePointStyle: true, padding: 14 } } },
                },
            });
        }

        const bar = document.getElementById('kkkKategoriBar');
        if (bar) {
            new Chart(bar, {
                type: 'bar',
                data: {
                    labels: @json($bulanLabels),
                    datasets: [{ label: @json($t('Permohonan')), data: @json($bulanan), backgroundColor: dark ? '#8B86E0' : '#2E2A7A', borderRadius: 6 }],
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: grid } },
                    },
                    plugins: { legend: { display: false } },
                },
            });
        }
    })();
</script>
@endsection
