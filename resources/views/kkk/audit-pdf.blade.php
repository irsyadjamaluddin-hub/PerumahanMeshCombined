<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    body { font-family: sans-serif; font-size: 11px; color: #1E1B3A; }
    h6 { font-size: 10px; letter-spacing: 1px; text-transform: uppercase; color: #6B6892; margin: 0 0 4px; }
    h1 { font-size: 20px; margin: 0 0 14px; color: #2E2A7A; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #2E2A7A; color: #fff; text-align: left; padding: 6px 8px; font-size: 10px; text-transform: uppercase; letter-spacing: .5px; }
    td { border-bottom: 1px solid #E4E2F2; padding: 6px 8px; vertical-align: top; }
    tr:nth-child(even) td { background: #F7F6FD; }
    .footer { margin-top: 16px; font-size: 9px; color: #6B6892; }
</style>
</head>
<body>
    @php $t = fn ($s) => \App\Support\KkkLang::t($s); @endphp

    <h6>{{ $t('Sistem Kunci Kira-Kira') }}</h6>
    <h1>{{ $t('Log Audit') }}</h1>

    <table>
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
            @foreach ($entries as $entry)
                <tr>
                    <td>{{ $entry->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $entry->pengguna_nama }}</td>
                    <td>{{ $entry->peminjaman?->no_borang ?? '—' }}</td>
                    <td>{{ $entry->namaSekolah() ?? '—' }}</td>
                    <td>{{ $t($entry->tindakan) }}</td>
                    <td>{{ $entry->butiran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">{{ $t('Dijana pada') }} {{ now()->format('d/m/Y H:i') }} · {{ count($entries) }} {{ $t('rekod') }}</div>
</body>
</html>
