@extends('layouts.housing2')
@section('title', $rekod->tajuk())

@php $t = fn ($s) => \App\Support\Housing2Lang::t($s); @endphp

@section('content')
    <a class="btn btn-ghost" href="{{ route('housing2.list', $jenis) }}" style="align-self:flex-start">&larr; {{ $t($cfg['title']) }}</a>

    <div class="row" style="align-items:flex-end">
        <div style="margin-right:auto">
            <h6>{{ $t($rekod->jenis_permohonan) ?? $t($cfg['kicker']) }}</h6>
            <h1 style="font-size:34px">{{ $rekod->tajuk() }}</h1>
        </div>
        <span class="tag">{{ $t($rekod->status) ?? '—' }}</span>
        @if ($rekod->field('Status Permohonan', '') === 'Kuiri')
            <span class="tag" style="background:#fff3cd;color:#8a6d1d">{{ $t('Kuiri') }}</span>
        @endif
        <a class="btn btn-icon" href="{{ route('housing2.download', [$jenis, $rekod]) }}" title="{{ $t('Muat Turun') }}" aria-label="{{ $t('Muat Turun') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                <polyline points="7 10 12 15 17 10" />
                <line x1="12" y1="15" x2="12" y2="3" />
            </svg>
        </a>
        @php
            $shareEmailField = collect($cfg['sections'])->flatMap(fn ($s) => $s['fields'])->first(fn ($f) => $f['label'] === 'E-mel');
            $shareEmail = $shareEmailField ? $rekod->field('E-mel', '') : '';
            $sharePhoneField = collect($cfg['sections'])->flatMap(fn ($s) => $s['fields'])->first(fn ($f) => $f['label'] === 'No. Perhubungan');
            $sharePhoneRaw = $sharePhoneField ? $rekod->field('No. Perhubungan', '') : '';
            $sharePhoneDigits = $sharePhoneRaw ? preg_replace('/^0+/', '', preg_replace('/\D/', '', $sharePhoneRaw)) : '';
        @endphp
        <form id="share-form" method="POST" action="{{ route('housing2.share', [$jenis, $rekod]) }}">
            @csrf
            <button class="btn btn-icon @if (! $shareEmail && ! $sharePhoneDigits) disabled @endif" type="button"
                    id="share-btn"
                    data-whatsapp="{{ $sharePhoneDigits ? 'https://wa.me/673'.$sharePhoneDigits : '' }}"
                    data-has-email="{{ $shareEmail ? '1' : '0' }}"
                    data-confirm="{{ $t('Kongsikan rekod ini kepada') }} {{ $shareEmail ?: $sharePhoneRaw }} {{ $t('melalui e-mel dan WhatsApp?') }}"
                    title="{{ ($shareEmail || $sharePhoneDigits) ? $t('Kongsi melalui E-mel & WhatsApp') : $t('Tiada e-mel atau no. perhubungan direkodkan untuk perkongsian.') }}"
                    aria-label="{{ $t('Kongsi melalui E-mel & WhatsApp') }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                    <path d="M4 4h16v16H4z" />
                    <path d="m4 6 8 7 8-7" />
                </svg>
            </button>
        </form>
        <a class="btn btn-icon" href="{{ route('housing2.edit', [$jenis, $rekod]) }}" title="{{ $t('Sunting') }}" aria-label="{{ $t('Sunting') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                <path d="M12 20h9" />
                <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z" />
            </svg>
        </a>
        <form method="POST" action="{{ route('housing2.destroy', [$jenis, $rekod]) }}"
              onsubmit="return confirm('{{ $t('Hapus rekod ini?') }}')">
            @csrf
            @method('DELETE')
            <button class="btn btn-icon" type="submit" title="{{ $t('Hapus') }}" aria-label="{{ $t('Hapus') }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                    <line x1="10" y1="11" x2="10" y2="17" />
                    <line x1="14" y1="11" x2="14" y2="17" />
                </svg>
            </button>
        </form>
    </div>

    @foreach ($cfg['sections'] as $section)
        @php
            $nonAreaCount = collect($section['fields'])->filter(fn ($f) => ($f['type'] ?? null) !== 'area')->count();
            $cols = ($nonAreaCount > 0 && $nonAreaCount <= 6) ? $nonAreaCount : null;
        @endphp
        <section style="display:flex;flex-direction:column;gap:10px">
            <h6 style="color:var(--accent-700)">{{ $t($section['title']) }}</h6>
            <div class="definition" @if ($cols) style="grid-template-columns:repeat({{ $cols }}, 1fr)" @endif>
                @foreach ($section['fields'] as $field)
                    <div @if (($field['type'] ?? null) === 'area') style="grid-column:1/-1" @endif>
                        <span class="muted" style="font-size:11px">{{ $t($field['label']) }}</span>
                        @if ($field['label'] === 'Status Permohonan' && ($field['type'] ?? null) === 'select')
                            @php $statusPermohonanValue = $rekod->field('Status Permohonan', ''); @endphp
                            <form method="POST" action="{{ route('housing2.status-permohonan', [$jenis, $rekod]) }}" style="display:flex;flex-direction:column;gap:6px;align-items:flex-start;margin-top:4px">
                                @csrf
                                @method('PATCH')
                                <select class="input" name="status_permohonan" aria-label="{{ $t('Status Permohonan') }}">
                                    <option value="" {{ $statusPermohonanValue === '' ? 'selected' : '' }}>{{ $t('--Pilih ') }}{{ $t('Status Permohonan') }}--</option>
                                    @foreach ($field['options'] as $option)
                                        <option value="{{ $option }}" {{ $statusPermohonanValue === $option ? 'selected' : '' }}>{{ $t($option) }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary" type="submit" style="padding:6px 16px;font-size:13px">{{ $t('Simpan') }}</button>
                            </form>
                        @elseif (($field['type'] ?? null) === 'file' && $rekod->field($field['label'], ''))
                            @php $filePath = $rekod->field($field['label']); @endphp
                            <span style="font-size:15px">
                                <a href="{{ \Illuminate\Support\Facades\Storage::url($filePath) }}" target="_blank">
                                    @if (preg_match('/\.(jpe?g|png|gif|webp)$/i', $filePath))
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($filePath) }}" alt="{{ $t($field['label']) }}"
                                             style="display:block;max-width:220px;max-height:160px;border-radius:6px;border:1px solid var(--divider);margin-top:4px">
                                    @else
                                        {{ basename($filePath) }}
                                    @endif
                                </a>
                            </span>
                        @else
                            <span style="font-size:15px;overflow-wrap:anywhere">{{ $t($rekod->field($field['label'])) }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const shareBtn = document.getElementById('share-btn');
                if (shareBtn && !shareBtn.classList.contains('disabled')) {
                    shareBtn.addEventListener('click', () => {
                        if (shareBtn.dataset.whatsapp) {
                            window.open(shareBtn.dataset.whatsapp, '_blank');
                        }
                        if (shareBtn.dataset.hasEmail === '1' && confirm(shareBtn.dataset.confirm)) {
                            document.getElementById('share-form').submit();
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
