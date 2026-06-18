<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Dikemaskini</title>
</head>
@php
    $purple    = "#4c00b0";
    $ticket    = $req->ticket_id ?? ('DSD' . str_pad($req->id ?? 0, 5, '0', STR_PAD_LEFT));
    $updatedAt = now()->timezone(config('app.timezone'))->format('d M Y, h:i A');

    // untuk update status
    $old = $oldStatus ?? 'N/A';
    $new = $newStatus ?? ($req->status ?? 'N/A');

    // remarks list (safe default)
    $remarksList = isset($remarks) && $remarks ? collect($remarks) : collect();
@endphp
<body style="font-family: Tahoma, sans-serif; background-color:#f0f0f0; margin:0;">
<table role="presentation" cellpadding="0" cellspacing="0" border="0" align="center" style="width:100%; table-layout:fixed; margin:0; padding:0;">
    <tr>
        <td align="center" valign="top" style="padding:16px;">
            <!-- Card wrapper -->
            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="500" style="background-color:#ffffff; border:1px solid {{ $purple }};">
                <tr>
                    <td style="padding:30px; text-align:left; line-height:1.5;">
                        <!-- Header / Logo -->
                        <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td align="center" style="padding:0 0 24px 0;">
                                    <p style="font-weight:600; font-size:51px; margin:0; line-height:1; color:{{ $purple }};">MESH</p>
                                    <p style="font-size:10px; margin:0; line-height:1.2;">MOE Employee and Services Hub</p>
                                </td>
                            </tr>
                        </table>

                        <!-- Greeting -->
                        <p style="margin:0;">Yang Mulia Pengiran / Tuan / Puan,</p>

                        <!-- Body -->
                        <div style="margin-top:24px;">
                            <p style="margin:0 0 12px 0;">
                                Status permohonan tuan/puan telah dikemaskini. Maklumat lanjut adalah seperti berikut:
                            </p>

                            <!-- Summary table -->
                            <table role="presentation" cellpadding="5" cellspacing="0" border="0" width="100%" style="border-collapse:collapse; color:#5c5c5c; text-align:left; margin-top:12px;">
                                <tr>
                                    <td style="width:45%;"><p style="font-weight:600; margin:0; line-height:1;">Tiket Aduan</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $ticket }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">Tarikh Kemaskini</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $updatedAt }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">Status dikemaskini</p></td>
                                    <td><p style="margin:0; line-height:1;"><strong>{{ $new }}</strong></p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-weight:600; margin:0; line-height:1;">Perkara</p></td>
                                    <td><p style="margin:0; line-height:1;">{{ $req->perkara }}</p></td>
                                </tr>
                                <tr>
                                    <td valign="top"><p style="font-weight:600; margin:0; line-height:1;">Huraian</p></td>
                                    <td><p style="margin:0; line-height:1.4; white-space:pre-wrap;">{{ $req->huraian }}</p></td>
                                </tr>

                                @if($remarksList->count())
                                    <tr>
                                        <td valign="top"><p style="font-weight:600; margin:0; line-height:1;">Catatan Terkini</p></td>
                                        <td>
                                            <ul style="margin:0; padding-left:18px;">
                                                @foreach($remarksList as $r)
                                                    <li style="line-height:1.4;">
                                                        <span style="font-size:12px; color:#888;">
                                                            {{ optional($r->created_at)->timezone(config('app.timezone'))->format('d M Y, h:i A') }}
                                                        </span>
                                                        <div style="white-space:pre-wrap;">{{ $r->remark }}</div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @endif
                            </table>

                            <p style="margin-top:24px;">
                                Untuk sebarang maklumat lanjut atau susulan aduan sila emel ke devops@moe.gov.bn dengan menyatakan No Tiket aduan.
                            </p>
                        </div>

                        <!-- Footer -->
                        <div style="margin-top:24px;">
                            <p style="margin:0; line-height:1.5;">Best Regards,</p>
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
