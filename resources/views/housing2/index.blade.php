@extends('layouts.housing2')
@section('title', 'Papan Utama — Pengurusan Perumahan')

@php $t = fn ($s) => \App\Support\Housing2Lang::t($s); @endphp

@section('content')
    <div>
        <h6>{{ $t('Papan Utama') }}</h6>
        <h1>{{ $t('Ringkasan Rekod') }}</h1>
        <p class="muted" style="max-width:100ch;margin:4px 0 0">
            {{ $t('Pemohon, pemilik dan penghuni rumah sewa (RS), kuarters kerajaan (IQ) serta senarai menunggu.') }}
        </p>
    </div>

    <div class="grid cols-stat">
        @foreach ($groups as $groupTitle => $keys)
            <div class="card pad lift">
                <span class="kicker">{{ $t($groupTitle) }}</span>
                <span class="figure">{{ collect($keys)->sum(fn ($k) => $counts[$k] ?? 0) }}</span>
                <span class="muted" style="font-size:13px">
                    {{ collect($keys)->map(fn ($k) => $t($types[$k]['short']))->join(' · ') }}
                </span>
            </div>
        @endforeach
        <div class="card pad lift">
            <span class="kicker">{{ $t('Jumlah') }}</span>
            <span class="figure">{{ $counts->sum() }}</span>
            <span class="muted" style="font-size:13px">{{ $t('rekod dalam sistem') }}</span>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:16px;align-items:start">
        <div class="card pad">
            <span class="h" style="font-size:16px">{{ $t('Bilangan Rekod mengikut Jenis') }}</span>
            <div id="recordsBarChart" style="min-height:300px"></div>
        </div>
        <div class="card pad">
            <span class="h" style="font-size:16px">{{ $t('Pecahan Status Rekod') }}</span>
            <div id="statusPieChart" style="min-height:300px"></div>
        </div>
        <div class="card pad">
            <span class="h" style="font-size:16px">{{ $t('Pecahan Rekod mengikut Daerah') }}</span>
            <div id="daerahPieChart" style="min-height:300px"></div>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(290px,1fr));gap:16px;align-items:start">
        <div class="card">
            <div style="padding:13px 16px;border-bottom:1px solid var(--divider)">
                <span class="h" style="font-size:16px">{{ $t('Rekod Terkini') }}</span>
            </div>
            @forelse ($recent as $item)
                <a href="{{ route('housing2.show', [$item->jenis, $item]) }}"
                   style="display:flex;align-items:baseline;gap:10px;padding:11px 16px;text-decoration:none;color:var(--ink);border-bottom:1px solid color-mix(in srgb, var(--ink) 8%, transparent)">
                    <span style="flex:1;min-width:0;font-size:14px">{{ $item->tajuk() }}</span>
                    <span class="kicker">{{ $t($types[$item->jenis]['short'] ?? $item->jenis) }}</span>
                    <span class="muted" style="font-size:12px">{{ $item->created_at?->format('d.m.Y') }}</span>
                </a>
            @empty
                <div class="empty muted">{{ $t('Tiada rekod lagi. Jalankan') }} <code>php artisan db:seed</code> {{ $t('untuk data demo.') }}</div>
            @endforelse
        </div>

        <div class="card pad" style="gap:12px">
            <span class="h" style="font-size:16px">{{ $t('Status Rekod') }}</span>
            @php $total = max($statusTally->sum(), 1); @endphp
            @foreach ($statusTally as $status => $n)
                <div style="display:flex;flex-direction:column;gap:4px">
                    <div style="display:flex;justify-content:space-between;font-size:13px">
                        <span>{{ $t($status) }}</span>
                        <span class="muted">{{ $n }}</span>
                    </div>
                    <div style="height:7px;border:1px solid var(--divider)">
                        <div style="height:100%;background:var(--accent);width:{{ round($n / $total * 100) }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div>
        <h6 style="margin-bottom:10px">{{ $t('Semua Daftar') }}</h6>
        <div class="grid cols-card">
            @foreach ($types as $key => $cfg)
                <a class="card pad lift" href="{{ route('housing2.list', $key) }}"
                   style="text-decoration:none;color:var(--ink);min-height:104px">
                    <span class="kicker">{{ $t('Senarai') }}</span>
                    <span class="h" style="font-size:19px">{{ $t($cfg['title']) }}</span>
                    <span class="muted" style="font-size:13px;margin-top:auto">{{ $counts[$key] ?? 0 }} {{ $t('rekod ·') }} {{ $t($cfg['kicker']) }}</span>
                </a>
            @endforeach
        </div>
    </div>

    @php
        $barLabels = collect($types)->pluck('short')->map($t)->values();
        $barData = collect($types)->keys()->map(fn ($k) => $counts[$k] ?? 0)->values();
        $statusLabels = collect($statusTally->keys())->map($t)->values();
        $daerahLabels = collect($daerahTally->keys())->map($t)->values();
    @endphp

    @push('scripts')
        <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                new ApexCharts(document.querySelector('#recordsBarChart'), {
                    chart: { type: 'bar', height: 300, toolbar: { show: false } },
                    series: [{ name: '{{ $t('Rekod') }}', data: @json($barData) }],
                    xaxis: { categories: @json($barLabels) },
                    colors: ['#241e6a'],
                    plotOptions: { bar: { borderRadius: 4, columnWidth: '55%' } },
                    dataLabels: { enabled: true },
                }).render();

                new ApexCharts(document.querySelector('#statusPieChart'), {
                    chart: { type: 'pie', width: 320, height: 320 },
                    series: @json($statusTally->values()),
                    labels: @json($statusLabels),
                    colors: ['#2ecc71', '#f1c40f', '#3498db', '#9b59b6', '#e67e22'],
                    legend: { position: 'bottom' },
                }).render();

                new ApexCharts(document.querySelector('#daerahPieChart'), {
                    chart: { type: 'pie', width: 320, height: 320 },
                    series: @json($daerahTally->values()),
                    labels: @json($daerahLabels),
                    colors: ['#241e6a', '#f2c245', '#2ecc71', '#e67e22', '#3498db', '#9b59b6', '#e74c3c', '#1abc9c'],
                    legend: { position: 'bottom' },
                }).render();
            });
        </script>
    @endpush
@endsection
