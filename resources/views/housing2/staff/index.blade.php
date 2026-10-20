@extends('layouts.housing2')
@section('title', 'Senarai Kakitangan — Pengurusan Perumahan')

@php $t = fn ($s) => \App\Support\Housing2Lang::t($s); @endphp

@section('content')
    <a class="btn btn-ghost" href="{{ route('housing2.zon.index') }}" style="align-self:flex-start">&larr; {{ $t('Senarai Zone mengikut Mukim dan Kakitangan Bertanggungjawab') }}</a>

    <div class="row" style="align-items:flex-end">
        <div style="margin-right:auto">
            <h6>{{ $t('Senarai') }}</h6>
            <h1 style="font-size:34px">{{ $t('Senarai Kakitangan, Kod dan Tugas') }}</h1>
        </div>
        <a class="btn btn-primary" href="{{ route('housing2.staff.create') }}">{{ $t('+ Tambah Rekod') }}</a>
    </div>

    <div class="card">
        <div class="row" style="padding:12px 16px;border-bottom:1px solid var(--divider)">
            <span class="h" style="font-size:15px">{{ $staff->total() }} {{ $t('rekod') }}</span>
            <span class="muted" style="font-size:12px;margin-right:auto">{{ $t('Klik satu baris untuk melihat rekod penuh') }}</span>
            <form method="GET" action="{{ route('housing2.staff.index') }}" style="display:flex;gap:6px">
                <input class="input" type="search" name="q" value="{{ $q }}" placeholder="{{ $t('Cari nama, daerah…') }}" style="max-width:230px">
                <button class="btn btn-ghost" type="submit">{{ $t('Cari') }}</button>
            </form>
        </div>

        <div style="overflow-x:auto">
            <table class="table">
                <thead>
                <tr>
                    <th>{{ $t('Kod') }}</th>
                    <th>{{ $t('Nama') }}</th>
                    <th>No. KPP</th>
                    <th>{{ $t('Tugas') }}</th>
                    <th style="text-align:right">{{ $t('Tindakan') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($staff as $person)
                    <tr>
                        <td>{{ $person->kod }}</td>
                        <td>{{ $person->nama }}</td>
                        <td>{{ $person->no_kpp ?? '—' }}</td>
                        <td>{{ $person->tugas ?? '—' }}</td>
                        <td style="text-align:right;white-space:nowrap">
                            <a class="btn btn-ghost btn-icon" href="{{ route('housing2.staff.edit', $person) }}" title="{{ $t('Sunting') }}" aria-label="{{ $t('Sunting') }}">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                                    <path d="M12 20h9" />
                                    <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('housing2.staff.destroy', $person) }}" style="display:inline"
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
                        <td colspan="5">
                            <div class="empty">
                                <span class="h" style="font-size:19px">{{ $t('Tiada rekod ditemui') }}</span>
                                <a class="btn" href="{{ route('housing2.staff.index') }}">{{ $t('Kosongkan Carian') }}</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $staff->links() }}
@endsection
