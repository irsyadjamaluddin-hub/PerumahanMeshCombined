<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Card for Email</title>

    <style>
        .check {
            border: 1px solid red;
        }
    </style>
</head>

<body style="
    font-family: Tahoma, sans-serif;
    /* background-color: #f0f0f0; */
    margin: 0;
">

@php
    // Light Purple = #B19cd9
    // Dark Purple:
        #4c00b0
        #7600bc
        #8a00c2
        #a000c8
        #b100cd
    $purple = "#4c00b0";
@endphp

<!-- Use table for layout -->
<table cellspacing="0" cellpadding="0"
{{-- align="center" --}}
style="
    width: 100%;
    height: 100vh;
    table-layout: fixed;
    /* background-color: #f0f0f0; */
    padding: 0;
    margin: 0 0 0 0;

">

    {{-- https://upload.wikimedia.org/wikipedia/commons/0/09/Emblem_of_Brunei.svg --}}

    <tr>
        <td
        {{-- align="center"  --}}
        valign="top" colspan="2" style="padding-bottom: 5em;">

            <table class="" cellspacing="0" cellpadding="0"
            {{-- align="center"  --}}
            style="
                border: 1px solid {{ $purple }};
                border-radius: 20px;
                border-top-left-radius: 0px;
                border-top-right-radius: 0px;
                border-bottom-left-radius: 0px;
                border-bottom-right-radius: 0px;
                overflow: hidden;

                /* Centered Card */
                margin-left: auto;
                margin-right: auto;
            ">

                {{-- Spacer --}}
                <div style="margin-top: 1em;"></div>

                {{-- Top: MESH and MOE Logo --}}
                <tr>
                    <td>

                        <table cellspacing="0" cellpadding="0" align="center" width="100%" style="background-color: {{ $purple }}; color: white; padding: 0.7em 0;">

                            <tr>
                                <td class="">

                                    {{-- MESH Logo --}}
                                    <div style="
                                        display: block;
                                        text-align: left;
                                        padding: 0 30px;
                                        text-align: left;
                                    "
                                    class="">
                                        <p style="
                                            font-weight: 600;
                                            font-size: 40px;
                                            padding:0;
                                            margin:0;
                                            line-height: 1;
                                        ">MESH</p>

                                        <p style="
                                            font-size: 10px;
                                            padding:0;
                                            margin:0;
                                            line-height: 1.2;
                                        ">MOE Employee and Services Hub</p>
                                    </div>

                                </td>

                                <td class="" style="display: none;">

                                    {{-- MOE Logo --}}
                                    <div style="
                                        padding: 0 30px;
                                        text-align: right;
                                    "
                                    class="">

                                        <p style="
                                            font-weight: 600;
                                            font-size: 20px;
                                            padding: 0;
                                            margin: 0;
                                            font-family: Arial, Helvetica, sans-serif;
                                            line-height: 1;
                                        ">كمنترين ڤنديديقن</p>

                                        <p style="
                                            font-size: 10px;
                                            line-height: 1;
                                            padding: 0;
                                            margin: 0.2em 0 0 0;
                                        ">
                                            Ministry of Education
                                        </p>

                                    </div>

                                </td>
                            </tr>

                        </table>

                    </td>
                </tr>

                {{-- Card --}}
                <tr>
                    <td
                    style="
                        background-color: #ffffff;
                        padding: 30px 30px 20px 30px;
                        max-width: 500px;
                        text-align: justify;
                        /* line-height: 1.5; */
                    "
                    align="center">

                        {{-- Title --}}
                        {{-- Greetings --}}
                        <p>Yang Mulia Pengiran / Tuan / Puan,</p>

                        {{-- Name and Department --}}
                        <div style="text-align: left;">
                            <p style="font-weight: 600; padding:0;   margin:0; line-height: 1.5;">{{$notf_namagb}}</p>
                            <p style="font-weight: 600; padding:0;   margin:0; line-height: 1.5;">{{$notf_sekolah}}</p>

                        </div> 

                        {{-- Main Message --}}
                        <div style="margin-top: 2em;">

                        <p>Dengan hormat, Permohonan bahan-bahan kurikulum telah direkodkan seperti maklumat di bawah ini dan memerlukan pengesahan selanjutnya.</p>


                            {{-- Receipt Data  --}}
                            <table style="border-collapse: collapse; color: rgb(92, 92, 92); text-align: left;">

                                <tr class="">
                                    <td class="">
                                        <p style="
                                            font-weight: 600;
                                            padding:0 5em 0 0;
                                            margin:0;
                                            line-height: 2.5;
                                        ">Nama Pemohon</p>
                                    </td>

                                    <td class="">
                                        <p style="
                                            padding:0;
                                            margin:0;
                                            line-height: 2.5;
                                        ">{{$notf_nama}}</p>
                                    </td>
                                </tr>

                                <tr class="">
                                    <td class="">
                                        <p style="
                                            font-weight: 600;
                                            /* padding:0 5em 0 0; */
                                            margin:0;
                                            line-height: 2.5;
                                        "> Rujukan Permohonan</p>
                                    </td>

                                    <td class="">
                                        <p style="
                                            padding:0;
                                            margin:0;
                                            line-height: 2.5;
                                        ">{{ $notf_date->format('Y') }}/SP/BBK-{{ $notf_id }}</p>

                                    </td>
                                </tr>

                                <tr class="">
                                    <td class="">
                                        <p style="
                                            font-weight: 600;
                                            /* padding:0 5em 0 0; */
                                            margin:0;
                                            line-height: 2.5;
                                        "> Tarikh Permohonan</p>
                                    </td>

                                    <td class="">
                                        <p style="
                                            padding:0;
                                            margin:0;
                                            line-height: 2.5;
                                        ">{{$notf_date->format('d-m-y H:i:s')}}</p>
                                    </td>
                                </tr>

                               

                            </table>

                            {{-- HIDDEN : Buttons --}}
                            <table style="display: none;" width="100%">
                                <tr>
                                    <td>
                                        {{-- Button --}}
                                        <div style="margin-top: 2em;" class="">
                                            <a href="https://your-login-link.com" style="text-decoration: none;">
                                                <p style="
                                                    padding: 12px 24px;
                                                    background-color: {{ $purple }};
                                                    color:white;
                                                    border-radius: 5px;
                                                    text-decoration: none;
                                                    text-align: center;
                                                    font-weight: bold;
                                                ">
                                                    Download
                                                </p>
                                            </a>
                                        </div>
                                    </td>

                                    <td>
                                        {{-- Button --}}
                                        <div style="margin-top: 2em;" class="">
                                            <a href="https://your-login-link.com" style="text-decoration: none;">
                                                <p style="
                                                    padding: 12px 24px;
                                                    background-color: {{ $purple }};
                                                    color:white;
                                                    border-radius: 5px;
                                                    text-decoration: none;
                                                    text-align: center;
                                                    font-weight: bold;
                                                ">
                                                    OK
                                                </p>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                           <!-- Message and Footer (Outlook-safe) -->
                                <table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 2em; text-align: center;">
                                    <tr>
                                        <td style="text-align: justify; color: #000;">
                                            <p>Untuk sebarang maklumat lanjut atau susulan aduan sila hubungi Jabatan Perkembangan Kurikulum dengan menyatakan rujukan permohonan.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center; padding-top: 1.5em;">
                                            <p style="margin: 0;">
                                                Layari portal kami di 
                                                <a href="http://127.0.0.1:8000/" 
                                                style="color: {{ $purple }}; font-weight: bold; text-decoration: none; white-space: nowrap;">
                                                http://127.0.0.1:8000/
                                                </a>

                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 3em; line-height: 1.5; color: gray; text-align: center;">
                                            <p style="margin: 0;">
                                                Notifikasi e-mel ini dihantar menggunakan sistem. Sebarang balasan mesej tidak akan diterima.
                                            </p>
                                        </td>
                                    </tr>
                                </table>


        </td>

    </tr>

</table>

</body>
</html>
