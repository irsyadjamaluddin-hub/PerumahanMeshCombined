<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Notification Email</title>
</head>
<body style="font-family: Tahoma, sans-serif; margin: 0;">

@php
    $purple = "#4c00b0";
@endphp

<table cellspacing="0" cellpadding="0" style="width: 100%; height: 100vh; table-layout: fixed; margin: 0; padding: 0;">
    <tr>
        <td valign="top" colspan="2" style="padding-bottom: 5em;">
            <table cellspacing="0" cellpadding="0" style="
                border: 1px solid {{ $purple }};
                border-radius: 20px;
                margin-left: auto;
                margin-right: auto;
                max-width: 600px;
                overflow: hidden;
            ">
                <!-- Header -->
                <tr>
                    <td style="background-color: {{ $purple }}; color: white; padding: 1.5em 2em; text-align: left;">
                        <h1 style="
                            margin: 0;
                            font-weight: 900;
                            font-size: 36px;
                            color: #fff;
                            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
                        ">
                            MESH
                        </h1>
                        <p style="margin: 0; font-size: 12px; color: #eee;">MOE Employee and Services Hub</p>
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="background-color: #ffffff; padding: 30px 30px 20px 30px; text-align: justify;">
                        <p>Yang Mulia Pengiran / Tuan / Puan,</p>

                        <div style="text-align: left;">
  <p style="font-weight: 600; margin: 0 0 0.3em 0; line-height: 1.5;">
    Pihak {{ $inventory->nama_sch ?? 'N/A' }}
  </p>
</div>


                        <p>Dengan hormat, permohonan bahan-bahan kurikulum telah direkodkan seperti maklumat dibawah.</p>

                        <table style="border-collapse: collapse; color: #5c5c5c; text-align: left; width: 100%;">
                            <tr>
                                <td style="font-weight: 600; padding-right: 2em; line-height: 2.5;">Inventory ID</td>
                                <td style="line-height: 2.5;">{{ $inventory->id }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: 600; padding-right: 2em; line-height: 2.5;">School Name</td>
                                <td style="line-height: 2.5;">{{ $inventory->nama_sch ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: 600; padding-right: 2em; line-height: 2.5;">Subject</td>
                                <td style="line-height: 2.5;">{{ $inventory->matapelajaran ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: 600; padding-right: 2em; line-height: 2.5;">Title</td>
                                <td style="line-height: 2.5;">{{ $inventory->judulbahan ?? 'N/A' }}</td>
                            </tr>
                        </table>

                        <hr style="margin: 20px 0;" />

                        <p><strong>Message:</strong></p>
                        <p>{{ $messageBody }}</p>

                        <p style="margin-top: 2em;">Untuk sebarang maklumat lanjut atau susulan aduan sila hubungi Jabatan Perkembangan Kurikulum dengan menyatakan rujukan permohonan.</p>

                        <div style="margin-top: 3em; line-height: 1.5; color: gray;">
                            <p>Notifikasi e-mel ini dihantar menggunakan sistem. Sebarang balasan mesej tidak akan diterima.</p>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
