@extends('layouts.kkk')

@section('title', 'Dashboard Pegawai')

@section('content')
@php $t = fn ($s) => \App\Support\KkkLang::t($s); @endphp

<div class="kkk-page-head">
    <h1>{{ $t('Dashboard Pegawai') }}</h1>
    <p>{{ $tahun }}</p>
</div>

<div class="kkk-grid cols-5">
    <div class="kkk-card kkk-kpi"><div class="n">{{ $kpi['jumlah'] }}</div><div class="l">{{ $t('Jumlah permohonan') }}</div></div>
    <div class="kkk-card kkk-kpi"><div class="n">{{ $kpi['dipohon'] }}</div><div class="l">{{ $t('Menunggu kelulusan') }}</div></div>
    <div class="kkk-card kkk-kpi"><div class="n">{{ $kpi['diLuarStor'] }}</div><div class="l">{{ $t('Dokumen di luar stor') }}</div></div>
    <div class="kkk-card kkk-kpi"><div class="n">{{ $kpi['dikembalikan'] }}</div><div class="l">{{ $t('Menunggu pengesahan pemulangan') }}</div></div>
    <div class="kkk-card kkk-kpi"><div class="n">{{ $kpi['selesai'] }}</div><div class="l">{{ $t('Selesai') }}</div></div>
</div>

<div class="kkk-grid cols-2" style="align-items:stretch;margin-top:6px">
    <div class="kkk-card">
        <h2>{{ $t('Mengikut status') }}</h2>
        @if ($kpi['jumlah'])
            <div style="position:relative;height:280px"><canvas id="kkkStatusPie"></canvas></div>
        @else
            <div class="kkk-empty">{{ $t('Tiada rekod bagi tempoh ini.') }}</div>
        @endif
    </div>

    <div class="kkk-card">
        <h2>{{ $t('Jenis KKK: dipohon vs selesai') }}</h2>
        @if ($kpi['jumlah'])
            <div style="position:relative;height:280px"><canvas id="kkkKategoriBar"></canvas></div>
        @else
            <div class="kkk-empty">{{ $t('Tiada rekod bagi tempoh ini.') }}</div>
        @endif
    </div>
</div>

<div class="kkk-grid cols-2" style="align-items:start;margin-top:16px">
    <div class="kkk-card">
        <h2>{{ $t('Mengikut jenis KKK') }}</h2>
        @forelse ($byJenis as $kategori => $data)
            @php $pct = $data['jumlah'] ? round($data['selesai'] / $data['jumlah'] * 100) : 0; @endphp
            <div style="margin-bottom:14px">
                <div style="display:flex;justify-content:space-between;font-size:12.5px;margin-bottom:5px">
                    <span>{{ $t($kategori) }}</span>
                    <span class="kkk-muted">{{ $data['selesai'] }}/{{ $data['jumlah'] }}</span>
                </div>
                <div style="background:var(--kkk-border);border-radius:6px;height:8px;overflow:hidden">
                    <div style="width:{{ $pct }}%;background:var(--kkk-primary);height:100%"></div>
                </div>
            </div>
        @empty
            <div class="kkk-empty">{{ $t('Tiada rekod bagi tempoh ini.') }}</div>
        @endforelse
    </div>

    <div class="kkk-card">
        <h2>{{ $t('Perlu tindakan susulan') }}</h2>
        @forelse ($susulan as $r)
            @php $m = $r->meta(\App\Support\KkkLang::locale()); @endphp
            <div style="display:flex;justify-content:space-between;align-items:center;padding:8px 0;border-bottom:1px solid var(--kkk-border)">
                <div>
                    <div style="font-weight:600;font-size:13px">{{ $r->no_borang }} · {{ $r->items->first()?->sekolah?->nama }}@if ($r->items->count() > 1) <span class="kkk-muted">+{{ $r->items->count() - 1 }}</span>@endif</div>
                    <div class="kkk-muted" style="font-size:11.5px">{{ collect($r->jenis)->map($t)->implode(', ') }} · {{ $m['label'] }} · {{ $r->tarikh_permohonan->format('d/m/Y') }}</div>
                </div>
                <a href="{{ route('kkk.rekod', ['tahun' => $r->tarikh_permohonan->year, 'pilih' => $r->id]) }}" class="kkk-btn kkk-btn-ghost">{{ $t('Borang') }}</a>
            </div>
        @empty
            <div class="kkk-empty">{{ $t('Tiada tindakan tertunggak.') }}</div>
        @endforelse
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
    (function () {
        const dark = document.documentElement.dataset.theme === 'dark';
        const ink = dark ? '#ECEAF9' : '#1E1B3A';
        const grid = dark ? 'rgba(255,255,255,.1)' : 'rgba(30,27,58,.08)';
        Chart.defaults.font.family = "'Barlow', system-ui, sans-serif";
        Chart.defaults.color = ink;

        const status = @json($byStatus);
        const pie = document.getElementById('kkkStatusPie');
        if (pie) {
            new Chart(pie, {
                type: 'pie',
                data: {
                    labels: status.map(s => s.label),
                    datasets: [{
                        data: status.map(s => s.jumlah),
                        backgroundColor: status.map(s => s.colour),
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

        @php $kategoriChart = $byJenis->map(fn ($d, $k) => ['label' => $t($k)] + $d)->values(); @endphp
        const kategori = @json($kategoriChart);
        const bar = document.getElementById('kkkKategoriBar');
        if (bar) {
            new Chart(bar, {
                type: 'bar',
                data: {
                    labels: kategori.map(k => k.label),
                    datasets: [
                        { label: @json($t('Jumlah permohonan')), data: kategori.map(k => k.jumlah), backgroundColor: dark ? '#8B86E0' : '#2E2A7A', borderRadius: 6 },
                        { label: @json($t('Selesai')), data: kategori.map(k => k.selesai), backgroundColor: '#D4C820', borderRadius: 6 },
                    ],
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: grid } },
                    },
                    plugins: { legend: { position: 'bottom', labels: { usePointStyle: true } } },
                },
            });
        }
    })();
</script>
@endsection
