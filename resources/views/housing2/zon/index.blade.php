@extends('layouts.housing2')
@section('title', 'Senarai Zone — Pengurusan Perumahan')

@php $t = fn ($s) => \App\Support\Housing2Lang::t($s); @endphp

@section('content')
    <div class="row" style="align-items:flex-end">
        <div style="margin-right:auto">
            <h6>{{ $t('Senarai') }}</h6>
            <h1 style="font-size:34px">{{ $t('Senarai Zone mengikut Mukim dan Kakitangan Bertanggungjawab') }}</h1>
        </div>
        <a class="btn btn-ghost" href="{{ route('housing2.staff.index') }}">{{ $t('Senarai Kakitangan') }}</a>
        <a class="btn btn-primary" href="{{ route('housing2.zon.mukim.create') }}">{{ $t('+ Tambah Mukim') }}</a>
    </div>

    @foreach ($zones as $zone)
        <div class="card">
            <div style="padding:13px 16px;border-bottom:1px solid var(--divider)">
                <span class="h" style="font-size:16px">{{ $zone->nama }}</span>
                <span class="muted" style="font-size:13px;margin-left:8px">
                    {{ $t('Ketua') }}: {{ $zone->ketuaStaff?->nama ?? '—' }}
                    @if ($zone->ketuaStaff) ({{ $zone->ketuaStaff->kod }}) @endif
                </span>
            </div>
            <div style="overflow-x:auto">
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{ $t('Daerah') }}</th>
                        <th>{{ $t('Mukim') }}</th>
                        <th>{{ $t('Rumah sewa') }}</th>
                        <th>IQ</th>
                        <th style="text-align:right">{{ $t('Tindakan') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($zone->mukims as $mukim)
                        <tr>
                            <td>{{ $mukim->daerah }}</td>
                            <td>{{ $mukim->mukim }}</td>
                            <td>{{ $mukim->rsStaff ? "{$mukim->rsStaff->kod} — {$mukim->rsStaff->nama}" : '—' }}</td>
                            <td>{{ $mukim->iqStaff ? "{$mukim->iqStaff->kod} — {$mukim->iqStaff->nama}" : '—' }}</td>
                            <td style="text-align:right;white-space:nowrap">
                                <a class="btn btn-ghost btn-icon" href="{{ route('housing2.zon.mukim.edit', $mukim) }}" title="{{ $t('Sunting') }}" aria-label="{{ $t('Sunting') }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                                        <path d="M12 20h9" />
                                        <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('housing2.zon.mukim.destroy', $mukim) }}" style="display:inline"
                                      onsubmit="return confirm('{{ $t('Hapus rekod ini?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-ghost btn-icon" type="submit" title="{{ $t('Hapus') }}" aria-label="{{ $t('Hapus') }}">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                                            <polyline points="3 6 5 6 21 6" />
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"><div class="empty muted">{{ $t('Tiada rekod ditemui') }}</div></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
@endsection
