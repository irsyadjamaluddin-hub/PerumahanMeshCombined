<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    body { font-family: sans-serif; font-size: 12px; color: #191631; }
    h6 { font-size: 10px; letter-spacing: 1px; text-transform: uppercase; color: #5d5b73; margin: 0 0 4px; }
    h1 { font-size: 22px; margin: 0 0 8px; }
    .status { display: inline-block; padding: 3px 12px; border: 1px solid #332c7a; color: #2a2466; font-size: 11px; margin-bottom: 16px; }
    .section-title { background: #140f36; color: #fff; padding: 6px 10px; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; margin-top: 16px; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 4px; }
    td { border: 1px solid #d5d1ec; padding: 6px 8px; width: 33.33%; vertical-align: top; }
    .label { display: block; font-size: 9px; text-transform: uppercase; color: #5d5b73; margin-bottom: 2px; }
    .value { font-size: 12px; }
    .footer { margin-top: 24px; font-size: 9px; color: #5d5b73; }
</style>
</head>
<body>
    @php $t = fn ($s) => \App\Support\Housing2Lang::t($s); @endphp

    <h6>{{ $t($rekod->jenis_permohonan) ?? $t($cfg['short']) }}</h6>
    <h1>{{ $rekod->tajuk() }}</h1>
    <span class="status">{{ $t($rekod->status) ?? '—' }}</span>

    @foreach ($cfg['sections'] as $section)
        <div class="section-title">{{ $t($section['title']) }}</div>
        <table>
            <tr>
                @foreach ($section['fields'] as $i => $field)
                    @if ($i > 0 && $i % 3 === 0)
                        </tr><tr>
                    @endif
                    <td>
                        <span class="label">{{ $t($field['label']) }}</span>
                        <span class="value">{{ $rekod->field($field['label']) }}</span>
                    </td>
                @endforeach
                @for ($i = count($section['fields']) % 3; $i > 0 && $i < 3; $i++)
                    <td></td>
                @endfor
            </tr>
        </table>
    @endforeach

    <div class="footer">{{ $t('Dijana pada') }} {{ now()->format('d.m.Y H:i') }}</div>
</body>
</html>
