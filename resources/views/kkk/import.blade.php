@extends('layouts.kkk')

@section('title', 'Import Excel')

@section('content')
@php $t = fn ($s) => \App\Support\KkkLang::t($s); @endphp

<div class="kkk-page-head">
    <h1>{{ $t('Import Excel') }}</h1>
    <p>{{ $t('Pindahkan daftar lama ke pangkalan data') }}</p>
</div>

<div class="kkk-card" style="max-width:{{ $langkah === 2 ? '960px' : '720px' }}">
    <div class="kkk-steps">
        <span class="{{ $langkah >= 1 ? 'on' : '' }}"></span>
        <span class="{{ $langkah >= 2 ? 'on' : '' }}"></span>
        <span class="{{ $langkah >= 3 ? 'on' : '' }}"></span>
    </div>

    @if ($langkah === 1)
        <h2>{{ $t('Muat naik daftar Excel lama') }}</h2>
        <p class="kkk-muted" style="margin-top:-6px">{{ $t('Satu fail setiap kluster · satu sheet setiap sekolah') }}</p>
        <form method="POST" action="{{ route('kkk.import.upload') }}" enctype="multipart/form-data" style="margin-top:14px">
            @csrf
            <div class="kkk-field">
                <input type="file" name="fail" class="kkk-input" accept=".xlsx,.xls,.csv" required>
            </div>
            <button type="submit" class="kkk-btn kkk-btn-primary">{{ $t('Pilih fail') }}</button>
        </form>
    @elseif ($langkah === 2)
        <h2>{{ $t('Pratonton fail') }}</h2>
        <p class="kkk-muted" style="margin-top:-6px">{{ $fail }}</p>

        @if ($previewError)
            <div class="kkk-alert err">{{ $t('Fail tidak dapat dibaca') }}: {{ $previewError }}</div>
        @elseif ($preview)
            @foreach ($preview as $sheet)
                <div style="margin-top:14px">
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px">
                        <span class="kkk-badge" style="background:#ECE6F5;color:#4F3680">{{ $sheet['name'] }}</span>
                        <span class="kkk-muted" style="font-size:12px">{{ $sheet['totalRows'] }} {{ $t('baris') }}</span>
                    </div>
                    <div style="overflow-x:auto;border:1px solid var(--kkk-border);border-radius:8px">
                        <table class="kkk-table" style="margin:0">
                            <tbody>
                                @foreach ($sheet['rows'] as $row)
                                    <tr>
                                        @foreach ($row as $cell)
                                            <td style="white-space:nowrap;font-size:12px">{{ $cell !== '' ? $cell : '—' }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        @endif

        <h2 style="margin-top:20px">{{ $t('Panduan pemetaan kod (contoh)') }}</h2>
        <table class="kkk-table" style="margin-top:10px">
            <thead>
                <tr><th>{{ $t('Kod dalam Excel') }}</th><th>{{ $t('Sel') }}</th><th>{{ $t('Dipetakan ke') }}</th></tr>
            </thead>
            <tbody>
                @foreach ($mapping as $row)
                    <tr>
                        <td><code>{{ $row['kod'] }}</code></td>
                        <td class="kkk-muted">{{ $row['sel'] }}</td>
                        <td>
                            @if ($row['sahkan'])
                                <span class="kkk-badge" style="background:#FBEAD6;color:#8A4308">{{ $t('[sahkan]') }}</span>
                            @else
                                {{ $t($row['status']) }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="kkk-muted" style="font-size:12px;margin-top:10px">{{ $t('Kod bertanda [sahkan] tidak diimport sehingga maksudnya disahkan.') }}</p>
        <form method="POST" action="{{ route('kkk.import.run') }}" style="margin-top:14px;display:flex;gap:10px">
            @csrf
            <button type="submit" class="kkk-btn kkk-btn-primary">{{ $t('Jalankan import') }}</button>
            <button type="submit" formaction="{{ route('kkk.import.reset') }}" class="kkk-btn kkk-btn-ghost">{{ $t('Batal') }}</button>
        </form>
    @else
        <div class="kkk-alert ok">&check; {{ $t('Fail telah dibaca.') }}</div>
        @if ($result)
            <p class="kkk-muted" style="font-size:12.5px">{{ $result['sheets'] }} {{ $t('sheet') }} · {{ $result['rows'] }} {{ $t('baris dibaca') }}</p>
        @endif
        <p class="kkk-muted" style="font-size:12.5px">{{ $t('Memetakan baris ini kepada rekod kkk_rekod belum dijalankan — maksud kod lama perlu disahkan dahulu sebelum pengimportan sebenar dibina.') }}</p>
        <form method="POST" action="{{ route('kkk.import.reset') }}" style="margin-top:12px">
            @csrf
            <button type="submit" class="kkk-btn kkk-btn-ghost">{{ $t('Import fail lain') }}</button>
        </form>
    @endif
</div>
@endsection
