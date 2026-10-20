@extends('layouts.housing2')
@section('title', $cfg['title'])

@php
    $t = fn ($s) => \App\Support\Housing2Lang::t($s);
    $imejRujukanFailTitle = $jenis === 'pemilik-rs' ? 'Gambar Rumah Pemilik' : 'Gambar Perumahan (IQ)';
@endphp

@section('content')
    <div class="row" style="align-items:flex-end">
        <div style="margin-right:auto">
            <h6>{{ $t('Senarai') }}</h6>
            <h1 style="font-size:34px">{{ $t($cfg['title']) }}</h1>
        </div>
        <a class="btn btn-primary"
           href="{{ ($cfg['choose'] ?? false) ? route('housing2.choose', $jenis) : route('housing2.create', $jenis) }}">
            {{ $t('+ Tambah Rekod') }}
        </a>
    </div>

    <div class="card">
        <div class="row" style="padding:12px 16px;border-bottom:1px solid var(--divider)">
            <span class="h" style="font-size:15px">{{ $rekods->total() }} {{ $t('rekod') }}</span>
            <span class="muted" style="font-size:12px;margin-right:auto">{{ $t('Klik satu baris untuk melihat rekod penuh') }}</span>
            <form method="GET" action="{{ route('housing2.list', $jenis) }}" style="display:flex;gap:6px">
                @if (isset($cfg['jenis_permohonan']))
                    <select class="input" name="jenis_permohonan" style="max-width:200px" onchange="this.form.submit()">
                        <option value="">{{ $t('Semua Jenis Permohonan') }}</option>
                        @foreach (array_keys($cfg['jenis_permohonan']) as $option)
                            <option value="{{ $option }}" {{ $jenisPermohonan === $option ? 'selected' : '' }}>{{ $t($option) }}</option>
                        @endforeach
                    </select>
                @endif
                @if ($jenis !== 'menunggu')
                    <select class="input" name="status" style="max-width:170px" onchange="this.form.submit()">
                        <option value="">{{ $t('Semua Status') }}</option>
                        @foreach (config('housing2.statuses') as $option)
                            <option value="{{ $option }}" {{ $statusFilter === $option ? 'selected' : '' }}>{{ $t($option) }}</option>
                        @endforeach
                    </select>
                @endif
                <input class="input" type="search" name="q" value="{{ $q }}" placeholder="{{ $t('Cari nama, daerah…') }}" style="max-width:230px">
                <button class="btn btn-ghost" type="submit">{{ $t('Cari') }}</button>
            </form>
        </div>

        <div style="overflow-x:auto">
            <table class="table">
                <thead>
                <tr>
                    @foreach ($cfg['cols'] as $col)
                        <th>{{ $col === 'Imej Rujukan Fail' ? $t($imejRujukanFailTitle) : $t($col) }}</th>
                    @endforeach
                    <th>{{ $t('Status') }}</th>
                    <th style="text-align:right">{{ $t('Tindakan') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($rekods as $rekod)
                    <tr>
                        @foreach ($cfg['cols'] as $col)
                            <td>
                                @if ($col === 'Nama')
                                    {{ $rekod->tajuk() }}
                                @elseif ($col === 'Jenis Permohonan')
                                    {{ $t($rekod->jenis_permohonan) ?? '—' }}
                                @elseif ($col === 'Imej Rujukan Fail')
                                    @php $rujukanImej = $rekod->field('Imej Rujukan Fail', ''); @endphp
                                    @if ($rujukanImej && preg_match('/\.(jpe?g|png|gif|webp)$/i', $rujukanImej))
                                        <a href="{{ \Illuminate\Support\Facades\Storage::url($rujukanImej) }}" target="_blank">
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($rujukanImej) }}" alt="{{ $t($imejRujukanFailTitle) }}"
                                                 style="width:44px;height:44px;object-fit:cover;border-radius:4px;border:1px solid var(--divider)">
                                        </a>
                                    @else
                                        —
                                    @endif
                                @else
                                    {{ $rekod->field($col) }}
                                @endif
                            </td>
                        @endforeach
                        <td>
                            <span class="tag">{{ $t($rekod->status) ?? '—' }}</span>
                            @if ($rekod->field('Status Permohonan', '') === 'Kuiri')
                                <span class="tag" style="background:#fff3cd;color:#8a6d1d;margin-left:4px">{{ $t('Kuiri') }}</span>
                            @endif
                        </td>
                        <td style="text-align:right;white-space:nowrap">
                            <a class="btn btn-ghost btn-icon" href="{{ route('housing2.show', [$jenis, $rekod]) }}" title="{{ $t('Lihat') }}" aria-label="{{ $t('Lihat') }}">
                                <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 5C7 5 2.73 8.11 1 12.5c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5C21.27 8.11 17 5 12 5zm0 12a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9zm0-2a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($cfg['cols']) + 2 }}">
                            <div class="empty">
                                <span class="h" style="font-size:19px">{{ $t('Tiada rekod ditemui') }}</span>
                                <span class="muted" style="font-size:13px">{{ $t('Cuba kata carian lain, atau kosongkan ruang carian.') }}</span>
                                <a class="btn" href="{{ route('housing2.list', $jenis) }}">{{ $t('Kosongkan Carian') }}</a>
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
