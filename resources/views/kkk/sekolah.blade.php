@extends('layouts.kkk')

@section('title', 'Sekolah & Pemimpin')

@section('content')
@php
    $t = fn ($s) => \App\Support\KkkLang::t($s);
    $role = session('kkk_role');
@endphp

<div class="kkk-page-head">
    <h1>{{ $t('Sekolah & Pemimpin') }}</h1>
    <p>{{ $t('Data induk sekolah, kluster dan sejarah pemimpin') }}</p>
</div>

<form method="GET" action="{{ route('kkk.sekolah') }}" class="kkk-card" style="display:flex;gap:14px;flex-wrap:wrap;align-items:flex-end">
    <div class="kkk-field" style="margin:0">
        <label>{{ $t('Kluster') }}</label>
        <select name="kluster" class="kkk-input" onchange="this.form.submit()">
            <option value="">{{ $t('Semua') }}</option>
            @foreach ($klusterPilihan as $k)
                <option value="{{ $k }}" {{ (string) $kluster === (string) $k ? 'selected' : '' }}>K{{ $k }}</option>
            @endforeach
        </select>
    </div>
    <span class="kkk-muted" style="font-size:12.5px;padding-bottom:10px">{{ $sekolahs->count() }} {{ $t('sekolah') }}</span>
</form>

<div class="kkk-grid cols-2" style="align-items:start;margin-top:6px">
    <div class="kkk-card" style="padding:0">
        <table class="kkk-table">
            <thead>
                <tr><th>{{ $t('Kluster') }}</th><th>{{ $t('Kod') }}</th><th>{{ $t('Sekolah') }}</th><th>{{ $t('Rujukan Fail') }}</th></tr>
            </thead>
            <tbody>
                @foreach ($sekolahs as $s)
                    <tr class="clickable {{ $selected && $selected->id === $s->id ? 'is-selected' : '' }}" onclick="window.location='{{ route('kkk.sekolah', array_filter(['kluster' => $kluster, 'pilih' => $s->id])) }}'">
                        <td>K{{ $s->kluster }}</td>
                        <td>{{ $s->kod ?? '—' }}</td>
                        <td>{{ $s->nama }}</td>
                        <td style="white-space:nowrap">{{ $s->rujukan_fail ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        @if ($selected)
            <div class="kkk-card">
                <h2>{{ $selected->nama }}</h2>
                <p class="kkk-muted" style="margin-top:-8px">{{ $t($selected->peringkat) }} · {{ $t('Kluster') }} {{ $selected->kluster }}@if ($selected->kod) · {{ $t('Kod') }} {{ $selected->kod }}@endif</p>
                @if ($selected->rujukan_fail)
                    <p style="font-size:13px;margin:0 0 4px"><strong>{{ $t('Rujukan Fail') }}:</strong> {{ $selected->rujukan_fail }}</p>
                @endif

                <h2 style="margin-top:18px">{{ $t('SEJARAH PEMIMPIN SEKOLAH') }}</h2>
                @forelse ($selected->pemimpin as $p)
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:8px 0;border-bottom:1px solid var(--kkk-border)">
                        <div>
                            <div style="font-weight:600;font-size:13px">{{ $p->nama }}</div>
                            <div class="kkk-muted" style="font-size:11.5px">{{ $t($p->jawatan) }} · {{ $t('dilantik') }} {{ $p->tarikh_lantikan?->format('d/m/Y') }}</div>
                        </div>
                        <span class="kkk-badge" style="background:{{ $p->semasa ? '#DDEFE4' : '#ECEBF2' }};color:{{ $p->semasa ? '#175636' : '#4A4766' }}">{{ $p->semasa ? $t('Semasa') : $t('Terdahulu') }}</span>
                    </div>
                @empty
                    <div class="kkk-empty">—</div>
                @endforelse

                @if ($role === 'pengawas')
                    <form method="POST" action="{{ route('kkk.leader.store', $selected) }}" style="margin-top:16px;border-top:1px solid var(--kkk-border);padding-top:14px">
                        @csrf
                        <h2>{{ $t('Tambah pemimpin baharu') }}</h2>
                        <div class="kkk-field">
                            <label>{{ $t('Nama') }}</label>
                            <input type="text" name="nama" class="kkk-input" placeholder="{{ $t('Nama penuh') }}" required>
                        </div>
                        <div class="kkk-field">
                            <label>{{ $t('Jawatan') }}</label>
                            <select name="jawatan" class="kkk-input" required>
                                <option value="Pengetua">{{ $t('Pengetua') }}</option>
                                <option value="Guru Besar">{{ $t('Guru Besar') }}</option>
                            </select>
                        </div>
                        <div class="kkk-field">
                            <label>{{ $t('Tarikh lantikan') }}</label>
                            <input type="date" name="tarikh_lantikan" class="kkk-input" max="{{ now()->toDateString() }}" required>
                        </div>
                        <button type="submit" class="kkk-btn kkk-btn-primary">{{ $t('Simpan pemimpin') }}</button>
                    </form>
                @endif
            </div>
        @else
            <div class="kkk-card kkk-empty">{{ $t('Pilih satu rekod untuk lihat butiran.') }}</div>
        @endif
    </div>
</div>
@endsection
