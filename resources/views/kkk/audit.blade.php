@extends('layouts.kkk')

@section('title', 'Log Audit')

@section('content')
@php $t = fn ($s) => \App\Support\KkkLang::t($s); @endphp

<div class="kkk-page-head">
    <div class="kkk-page-head-row">
        <div>
            <h1>{{ $t('Log Audit') }}</h1>
            <p>{{ $t('Siapa mengubah apa, dan bila') }}</p>
        </div>
        <a class="kkk-icon-btn" href="{{ route('kkk.audit.export') }}" title="{{ $t('Muat Turun') }}" aria-label="{{ $t('Muat Turun') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                <polyline points="7 10 12 15 17 10" />
                <line x1="12" y1="15" x2="12" y2="3" />
            </svg>
        </a>
    </div>
</div>

<div class="kkk-card" style="padding:0">
    @if ($log->isEmpty())
        <div class="kkk-empty">{{ $t('Belum ada aktiviti lagi.') }}</div>
    @else
        <table class="kkk-table">
            <thead>
                <tr>
                    <th>{{ $t('Tarikh dan Masa') }}</th>
                    <th>{{ $t('Pengguna') }}</th>
                    <th>{{ $t('No. Borang') }}</th>
                    <th>{{ $t('Nama Sekolah') }}</th>
                    <th>{{ $t('Tindakan') }}</th>
                    <th>{{ $t('Butiran') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($log as $entry)
                    <tr>
                        <td class="kkk-muted">{{ $entry->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $entry->pengguna_nama }}</td>
                        <td>{{ $entry->peminjaman?->no_borang ?? '—' }}</td>
                        <td>{{ $entry->namaSekolah() ?? '—' }}</td>
                        <td>{{ $t($entry->tindakan) }}</td>
                        <td class="kkk-muted">{{ $entry->butiran }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding:12px">{{ $log->links() }}</div>
    @endif
</div>
@endsection
