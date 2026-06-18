<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MESH Email</title>
</head>

<body style="margin:0; padding:0; font-family:Tahoma, sans-serif; background:#f0f0f0;">

@php
    $purple = "#4c00b0";
@endphp

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f0f0; padding:20px;">
    <tr>
        <td align="center">

            <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; padding:30px; border:1px solid {{ $purple }};">

                <!-- HEADER -->
                <tr>
                    <td align="center" style="padding-bottom:20px;">
                        <div style="font-size:40px; font-weight:bold; color:{{ $purple }};">MESH</div>
                        <div style="font-size:12px;">MOE Employee and Services Hub</div>
                    </td>
                </tr>

                <!-- GREETING -->
                <tr>
                    <td style="padding:10px 0;">
                        Salam Sejahtera {{ $recipientName }},
                    </td>
                </tr>

                <tr>
                    <td style="padding-bottom:15px;">
                        Pengesahan penerimaan bahan telah berjaya dihantar.
                    </td>
                </tr>

                <!-- DATA BOX -->
                <tr>
                    <td>
                        <table width="100%" cellpadding="6" cellspacing="0" style="background:#f9f9f9; font-size:14px;">

                            <tr>
                                <td><b>Bilangan Sebutharga:</b></td>
                                <td>{{ $inventory->inventorysebutharga->bil_sh ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td><b>Bilangan Purchase Order:</b></td>
                                <td>{{ $inventory->inventorysebutharga->bil_po ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td><b>Pembekal:</b></td>
                                <td>{{ $inventory->inventorysebutharga->pembekal ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td><b>Nama Sekolah/Unit:</b></td>
                                <td>{{ $inventory->department->label ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td><b>Nama Penerima:</b></td>
                                <td>{{ $inventory->penerima ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td><b>No Kad Pintar:</b></td>
                                <td>{{ $inventory->penerima_icno ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td><b>No DO:</b></td>
                                <td>{{ $inventory->no_do ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td><b>Tarikh:</b></td>
                                <td>{{ $inventory->date_recieve ?? '-' }}</td>
                            </tr>

                        </table>
                    </td>
                </tr>

                <!-- BUTTON -->
                <tr>
                    <td align="center" style="padding:20px;">
                        <a href="https://mesh.moe.gov.bn"
                           style="background:{{ $purple }};
                                  color:#fff;
                                  padding:12px 20px;
                                  text-decoration:none;
                                  display:inline-block;
                                  border-radius:5px;">
                            Log Masuk ke MESH
                        </a>
                    </td>
                </tr>

                <!-- FOOTER -->
                <tr>
                    <td style="font-size:12px; text-align:center; color:#666;">
                        Sekian, terima kasih.<br>
                        Pasukan Sokongan MESH
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>