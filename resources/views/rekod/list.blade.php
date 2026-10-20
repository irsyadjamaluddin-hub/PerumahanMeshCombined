@extends('layouts.app')
@section('title', $cfg['title'])

@section('content')
    <div class="row" style="align-items:flex-end">
        <div style="margin-right:auto">
            <h6>Senarai</h6>
            <h1 style="font-size:34px">{{ $cfg['title'] }}</h1>
        </div>
        <a class="btn btn-primary"
           href="{{ ($cfg['choose'] ?? false) ? route('perumahan.choose', $jenis) : route('perumahan.create', $jenis) }}">
            + Tambah Rekod
        </a>
    </div>

    <div class="card">
        <div class="row" style="padding:12px 16px;border-bottom:1px solid var(--divider)">
            <span class="h" style="font-size:15px">{{ $rekods->total() }} rekod</span>
            <span class="muted" style="font-size:12px;margin-right:auto">Klik satu baris untuk melihat rekod penuh</span>
            <form method="GET" action="{{ route('perumahan.list', $jenis) }}" style="display:flex;gap:6px">
                <input class="input" type="search" name="q" value="{{ $q }}" placeholder="Cari nama, daerah…" style="max-width:230px">
                <button class="btn btn-ghost" type="submit">Cari</button>
            </form>
        </div>

        <div style="overflow-x:auto">
            <table class="table">
                <thead>
                <tr>
                    @foreach ($cfg['cols'] as $col)
                        <th>{{ $col }}</th>
                    @endforeach
                    <th>Status</th>
                    <th style="text-align:right">Tindakan</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($rekods as $rekod)
                    <tr>
                        @foreach ($cfg['cols'] as $col)
                            <td>
                                @if ($col === 'Jenis Permohonan')
                                    {{ $rekod->jenis_permohonan ?? '—' }}
                                @else
                                    {{ $rekod->field($col) }}
                                @endif
                            </td>
                        @endforeach
                        <td><span class="tag">{{ $rekod->status ?? '—' }}</span></td>
                        <td style="text-align:right;white-space:nowrap">
                            <a class="btn btn-ghost" href="{{ route('perumahan.show', [$jenis, $rekod]) }}">Lihat</a>
                            <a class="btn btn-ghost" href="{{ route('perumahan.edit', [$jenis, $rekod]) }}">Sunting</a>
                            <form method="POST" action="{{ route('perumahan.destroy', [$jenis, $rekod]) }}"
                                  style="display:inline" onsubmit="return confirm('Hapus rekod ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-ghost" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($cfg['cols']) + 2 }}">
                            <div class="empty">
                                <span class="h" style="font-size:19px">Tiada rekod ditemui</span>
                                <span class="muted" style="font-size:13px">Cuba kata carian lain, atau kosongkan ruang carian.</span>
                                <a class="btn" href="{{ route('perumahan.list', $jenis) }}">Kosongkan Carian</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $rekods->links() }}
@endsection
