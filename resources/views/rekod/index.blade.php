@extends('layouts.app')
@section('title', 'Papan Utama — Pengurusan Perumahan')

@section('content')
    <div>
        <h6>Papan Utama</h6>
        <h1>Ringkasan Rekod</h1>
        <p class="muted" style="max-width:60ch;margin:4px 0 0">
            Pemohon, pemilik dan penghuni rumah sewa (RS), kuarters kerajaan (IQ) serta senarai menunggu.
        </p>
    </div>

    <div class="grid cols-stat">
        @foreach ($groups as $groupTitle => $keys)
            <div class="card pad lift">
                <span class="kicker">{{ $groupTitle }}</span>
                <span class="figure">{{ collect($keys)->sum(fn ($k) => $counts[$k] ?? 0) }}</span>
                <span class="muted" style="font-size:13px">
                    {{ collect($keys)->map(fn ($k) => $types[$k]['short'])->join(' · ') }}
                </span>
            </div>
        @endforeach
        <div class="card pad lift">
            <span class="kicker">Jumlah</span>
            <span class="figure">{{ $counts->sum() }}</span>
            <span class="muted" style="font-size:13px">rekod dalam sistem</span>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(290px,1fr));gap:16px;align-items:start">
        <div class="card">
            <div style="padding:13px 16px;border-bottom:1px solid var(--divider)">
                <span class="h" style="font-size:16px">Rekod Terkini</span>
            </div>
            @forelse ($recent as $item)
                <a href="{{ route('perumahan.show', [$item->jenis, $item]) }}"
                   style="display:flex;align-items:baseline;gap:10px;padding:11px 16px;text-decoration:none;color:var(--ink);border-bottom:1px solid color-mix(in srgb, var(--ink) 8%, transparent)">
                    <span style="flex:1;min-width:0;font-size:14px">{{ $item->tajuk() }}</span>
                    <span class="kicker">{{ $types[$item->jenis]['short'] ?? $item->jenis }}</span>
                    <span class="muted" style="font-size:12px">{{ $item->created_at?->format('d.m.Y') }}</span>
                </a>
            @empty
                <div class="empty muted">Tiada rekod lagi. Jalankan <code>php artisan db:seed</code> untuk data demo.</div>
            @endforelse
        </div>

        <div class="card pad" style="gap:12px">
            <span class="h" style="font-size:16px">Status Rekod</span>
            @php $total = max($statusTally->sum(), 1); @endphp
            @foreach ($statusTally as $status => $n)
                <div style="display:flex;flex-direction:column;gap:4px">
                    <div style="display:flex;justify-content:space-between;font-size:13px">
                        <span>{{ $status }}</span>
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
        <h6 style="margin-bottom:10px">Semua Daftar</h6>
        <div class="grid cols-card">
            @foreach ($types as $key => $cfg)
                <a class="card pad lift" href="{{ route('perumahan.list', $key) }}"
                   style="text-decoration:none;color:var(--ink);min-height:104px">
                    <span class="kicker">Senarai</span>
                    <span class="h" style="font-size:19px">{{ $cfg['title'] }}</span>
                    <span class="muted" style="font-size:13px;margin-top:auto">{{ $counts[$key] ?? 0 }} rekod · {{ $cfg['kicker'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
@endsection
