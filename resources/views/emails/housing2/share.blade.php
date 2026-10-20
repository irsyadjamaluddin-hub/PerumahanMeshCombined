<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: Arial, sans-serif; color: #191631; line-height: 1.6; font-size: 14px; margin:0; padding:0; background:#f5f5fa;">
    <div style="max-width:640px;margin:0 auto;padding:24px 20px;">
        <p>Assalamualaikum / Salam Sejahtera,</p>

        <p>Berikut adalah salinan rekod perumahan anda daripada Kementerian Pendidikan, Negara Brunei Darussalam:</p>

        <table cellpadding="6" style="border-collapse: collapse; margin: 12px 0;">
            <tr>
                <td style="color:#5d5b73;">Nama</td>
                <td><strong>{{ $rekod->tajuk() }}</strong></td>
            </tr>
            <tr>
                <td style="color:#5d5b73;">No. KPP</td>
                <td>{{ $ic }}</td>
            </tr>
            <tr>
                <td style="color:#5d5b73;">Status</td>
                <td>{{ $rekod->status ?? '—' }}</td>
            </tr>
        </table>

        @foreach ($cfg['sections'] as $section)
            @php $displayFields = array_values(array_filter($section['fields'], fn ($f) => ($f['type'] ?? null) !== 'file')); @endphp
            @continue(empty($displayFields))
            <div style="background:#140f36;color:#fff;padding:8px 12px;font-size:13px;text-transform:uppercase;letter-spacing:1px;margin-top:18px;">
                {{ $section['title'] }}
            </div>
            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                @foreach (array_chunk($displayFields, 2) as $row)
                    <tr>
                        @foreach ($row as $field)
                            <td width="50%" style="border:1px solid #d5d1ec;padding:8px 10px;vertical-align:top;">
                                <span style="display:block;font-size:9px;text-transform:uppercase;color:#5d5b73;margin-bottom:2px;">{{ $field['label'] }}</span>
                                <span style="font-size:13px;">{{ $rekod->field($field['label']) }}</span>
                            </td>
                        @endforeach
                        @if (count($row) === 1)
                            <td width="50%" style="border:1px solid #d5d1ec;"></td>
                        @endif
                    </tr>
                @endforeach
            </table>
        @endforeach

        <p style="margin-top:20px;">Salinan penuh rekod ini turut disertakan dalam lampiran PDF e-mel ini.</p>

        <p>Sekiranya terdapat sebarang pertanyaan, sila hubungi Bahagian Perumahan, Kementerian Pendidikan.</p>

        <p>Terima kasih.<br>Kementerian Pendidikan, Negara Brunei Darussalam</p>
    </div>
</body>
</html>
