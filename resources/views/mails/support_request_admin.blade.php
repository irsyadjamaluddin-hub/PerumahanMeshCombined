<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Baharu – DevOps Service Desk</title>
</head>
@php
    $purple = "#4c00b0";
    $ticket = $supportRequest->ticket_id ?? ('DSD' . str_pad($supportRequest->id ?? 0, 5, '0', STR_PAD_LEFT));
@endphp
<body style="font-family: Tahoma, sans-serif; background-color:#f0f0f0; margin:0;">
<table role="presentation" cellpadding="0" cellspacing="0" border="0" align="center" style="width:100%; table-layout:fixed; margin:0; padding:0;">
    <tr>
        <td align="center" valign="top" style="padding:16px;">
            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="500" style="background-color:#ffffff; border:1px solid {{ $purple }};">
                <tr>
                    <td style="padding:30px; text-align:left; line-height:1.5;">
                        <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td align="center" style="padding:0 0 24px 0;">
                                    <p style="font-weight:600; font-size:51px; margin:0; line-height:1; color:{{ $purple }};">MESH</p>
                                    <p style="font-size:10px; margin:0; line-height:1.2;">MOE Employee and Services Hub</p>
                                </td>
                            </tr>
                        </table>


                        <!-- Body -->
                        <div style="margin-top:24px;">
                            <p style="margin:0 0 12px 0;">
                                <strong>Permohonan baharu telah dihantar ke DevOps Service Desk.</strong><br>
                                Ringkasan maklumat adalah seperti berikut:
                            </p>

                            <!-- Summary table -->
                            <table role="presentation" cellpadding="5" cellspacing="0" border="0" width="100%" style="border-collapse:collapse; color:#5c5c5c; text-align:left; margin-top:12px;">
                                <tr>
                                    <td style="width:45%;"><p style="font-weight:600; margin:0; line-height:1;">Nama</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $supportRequest->name ?? '-' }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">Jabatan</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $supportRequest->department ?? '-' }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">Unit</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $supportRequest->unit ?? '-' }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">Email</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $supportRequest->email ?? '-' }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">No Tel</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $supportRequest->contact ?? '-' }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">Perkara</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $supportRequest->perkara ?? '-' }}</p></td>
                                </tr>
                                <tr>
                                    <td valign="top"><p style="font-weight:600; margin:0; line-height:1;">Huraian</p></td>
                                    <td><p style="margin:0; line-height:1.4; white-space:pre-wrap;">{{ $supportRequest->huraian ?? '-' }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">Keutamaan</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $supportRequest->priority_label ?? '-' }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">Tiket Aduan</p></td>
                                    <td><p style="margin:0; line-height:1;"><strong>{{ $ticket }}</strong></p></td>
                                </tr>
                            </table>

                            <p style="margin-top:24px;">
                                Sekian, terima kasih.
                            </p>
                        </div>

                        <!-- Footer -->
                        <div style="margin-top:24px;">
                            <p style="margin:0; line-height:1.5;">MESH Support Team</p>
                            <p style="margin:0; line-height:1.5; color:#666; font-size:12px;">
                                Emel ini dijana secara automatik. Sila jangan balas emel ini.
                            </p>
                        </div>
                    </td>
                </tr>
            </table>
            <!-- /Card -->
        </td>
    </tr>
</table>
</body>
</html>
