<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aduan Diterima</title>
</head>
@php
    $purple = "#4c00b0";
    $ticket = $support->ticket_id ?? ('DSD' . str_pad($support->id ?? 0, 5, '0', STR_PAD_LEFT));
    $submittedAt = optional($support->created_at)->timezone(config('app.timezone'))->format('d M Y, h:i A');
@endphp
<body style="font-family: Tahoma, sans-serif; background-color:#f0f0f0; margin:0;">
<table cellspacing="0" cellpadding="0" align="center" style="width:100%; table-layout:fixed; padding:0; margin:0;">
    <tr>
        <td align="center" valign="top" colspan="2">
            <table cellspacing="0" cellpadding="0" align="center" style="overflow:hidden;">
                <tr>
                    <td align="center" style="background-color:#ffffff; padding:30px; max-width:500px; text-align:left; line-height:1.5; border:1px solid {{ $purple }};">

                        <!-- MESH Logo -->
                        <div style="text-align:center; margin:0 0 3em 0;">
                            <p style="font-weight:600; font-size:51px; margin:0; line-height:1; color:{{ $purple }};">MESH</p>
                            <p style="font-size:10px; margin:0; line-height:1.2;">MOE Employee and Services Hub</p>
                        </div>

                        <!-- Greetings -->
                        <p style="margin:0;">Yang Mulia Pengiran / Tuan / Puan,</p>

                        <!-- Main Message -->
                        <div style="margin-top:3em;">
                            <p style="margin:0 0 1em 0;">
                                Tuan/Puan telah berjaya menghantar permohonan. Berikut disertakan ringkasan permohonan tuan/puan:
                            </p>

                            <!-- Summary Table -->
                            <table cellpadding="5" style="border-collapse:collapse; color:#5c5c5c; text-align:left; margin-top:2em; width:100%;">
                                <tr>
                                    <td style="width:45%;"><p style="font-weight:600; margin:0; line-height:1;">Tiket Aduan</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $ticket }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">Tarikh Hantar</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $submittedAt }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">Nama</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $support->name }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">Emel</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $support->email }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">No. Telefon</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $support->contact ?: '-' }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">Jabatan</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $support->department }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">Unit</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $support->unit ?: '-' }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">Perkara</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $support->perkara }}</p></td>
                                </tr>
                                <tr>
                                    <td valign="top"><p style="font-weight:600; margin:0; line-height:1;">Huraian</p></td>
                                    <td><p style="margin:0; line-height:1.4; white-space:pre-wrap;">{{ $support->huraian }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">Keutamaan</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $support->priority }}</p></td>
                                </tr>
                                @if(!empty($attachmentsNames))
                                    <tr>
                                        <td valign="top"><p style="font-weight:600; margin:0; line-height:1;">Lampiran</p></td>
                                        <td>
                                            <ul style="margin:0; padding-left:18px;">
                                                @foreach($attachmentsNames as $fn)
                                                    <li style="line-height:1.4;">{{ $fn }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @endif
                            </table>

                            <p style="margin-top:3em;">
                               Untuk sebarang maklumat lanjut atau susulan aduan sila emel ke devops@moe.gov.bn dengan menyatakan No Tiket aduan.
                            </p>
                            </p>
                        </div>

                        <!-- Regards -->
                        <div style="margin-top:3em;">
                            <p style="margin:0; line-height:1.5;">Best Regards,</p>
                            <p style="margin:0; line-height:1.5;">MESH support Team</p>
                            <p style="margin:0; line-height:1.5; color:#666; font-size:12px;">
                                Emel ini dijana secara automatik. Sila jangan balas emel ini.
                            </p>
                        </div>

                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
