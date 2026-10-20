<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Borang Pengeluaran</title>
</head>

<body style="font-family: Tahoma, sans-serif; margin: 0;">

@php
    $purple = "#4c00b0";
@endphp

<table cellspacing="0" cellpadding="0" style="width: 100%; height: 100vh; table-layout: fixed; padding: 0; margin: 0 0 0 0;">
    <tr>
        <td valign="top" colspan="2" style="padding-bottom: 5em;">
            <table cellspacing="0" cellpadding="0" style="border: 1px solid {{ $purple }}; border-radius: 0px; overflow: hidden; margin-left: auto; margin-right: auto;">
                
                <div style="margin-top: 1em;"></div>

                <!-- Header -->
                <tr>
                    <td>
                        <table cellspacing="0" cellpadding="0" align="center" width="100%" style="background-color: {{ $purple }}; color: white; padding: 0.7em 0;">
                            <tr>
                                <td>
                                    <div style="display: block; text-align: left; padding: 0 30px;">
                                        <p style="font-weight: 600; font-size: 40px; padding:0; margin:0; line-height: 1;">MESH</p>
                                        <p style="font-size: 10px; padding:0; margin:0; line-height: 1.2;">MOE Employee and Services Hub</p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Content -->
                <tr>
                    <td style="background-color: #ffffff; padding: 30px 30px 20px 30px; max-width: 500px; text-align: justify;" align="center">
                        
                        <p>Yang Mulia Pengiran / Tuan / Puan,</p>

                        <div style="text-align: left;">
                            <p style="font-weight: 600; padding:0; margin:0; line-height: 1.5;">{{$notf_namagb}}</p>
                            <p style="font-weight: 600; padding:0; margin:0; line-height: 1.5;">{{$notf_sekolah}}</p>
                        </div> 

                        <div style="margin-top: 2em;">
                            <p>Dengan hormat, Borang Pengeluaran bahan-bahan kurikulum telah <strong>diterima dan diambil</strong> seperti maklumat di bawah ini.</p>

                            <!-- Details Table -->
                            <table style="border-collapse: collapse; color: rgb(92, 92, 92); text-align: left;">
                                <tr>
                                    <td>
                                        <p style="font-weight: 600; padding:0 5em 0 0; margin:0; line-height: 2.5;">Rujukan Permohonan</p>
                                    </td>
                                    <td>
                                        <p style="padding:0; margin:0; line-height: 2.5;">{{ $notf_date->format('Y') }}/SP/BBK-{{ $notf_id }}</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p style="font-weight: 600; margin:0; line-height: 2.5;">Tarikh Diambil</p>
                                    </td>
                                    <td>
                                        <p style="padding:0; margin:0; line-height: 2.5;">{{$notf_recieve_date}}</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p style="font-weight: 600; margin:0; line-height: 2.5;">Diterima Oleh</p>
                                    </td>
                                    <td>
                                        <p style="padding:0; margin:0; line-height: 2.5;">{{$notf_recieve_nama}}</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p style="font-weight: 600; margin:0; line-height: 2.5;">No. Kad Pengenalan</p>
                                    </td>
                                    <td>
                                        <p style="padding:0; margin:0; line-height: 2.5;">{{$notf_recieve_icno}}</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p style="font-weight: 600; margin:0; line-height: 2.5;">Jawatan</p>
                                    </td>
                                    <td>
                                        <p style="padding:0; margin:0; line-height: 2.5;">{{$notf_recieve_jawatan}}</p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin-top: 2em;">Untuk sebarang maklumat lanjut atau susulan aduan sila hubungi Jabatan Perkembangan Kurikulum dengan menyatakan rujukan permohonan.</p>
                            
                            <p style="margin-top: 2em; text-align: center;">
                                Layari portal kami di 
                                <a href="http://127.0.0.1:8000/" style="color: {{ $purple }}; font-weight: bold; text-decoration: none;">
                                    http://127.0.0.1:8000/
                                </a>
                            </p>

                            <div style="margin-top: 3em; line-height: 1.5; color: gray;">
                                <p>Notifikasi e-mel ini dihantar menggunakan sistem. Sebarang balasan mesej tidak akan diterima.</p>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>