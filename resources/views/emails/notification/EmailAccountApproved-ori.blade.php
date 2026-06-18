<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Account Approved</title>

    <style>
        .check {
            border: 1px solid red;
        }
    </style>
</head>

<body style="
    font-family: Tahoma, sans-serif;
    background-color: #f0f0f0;
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
<table cellspacing="0" cellpadding="0" align="center"
style="
    width: 100%;
    height: 100vh;
    table-layout: fixed;
    padding: 0;
    margin: 0 0 5em 0;

">

    {{-- https://upload.wikimedia.org/wikipedia/commons/0/09/Emblem_of_Brunei.svg --}}

    <tr>
        <td align="center" valign="top" colspan="2">

            <table class="" cellspacing="0" cellpadding="0" align="center" style="
                overflow: hidden;
            ">

                {{-- Spacer --}}
                <div style="margin-top: 0em;"></div>

                {{-- Top: MOE LOGO --}}
                <tr>
                    <td>
                        <div style="
                            padding: 1em 0;
                            text-align: center;
                        "
                        class="">
                            <!-- <img src="{{ asset('imgs/panji-panji.svg.png') }}" style="
                                width: 4em;
                                margin-bottom: 5px;
                            "> -->

                            <p style="
                                font-weight: 600;
                                font-size: 25px;
                                padding: 0;
                                margin: 0;
                                font-family: Arial, Helvetica, sans-serif;
                                line-height: 1;
                            ">كمنترين ڤنديديقن</p>

                            <p style="
                                line-height: 1;
                                padding: 0;
                                margin: 0.4em 0;
                                font-size: 10px;
                            ">
                                Ministry of Education
                            </p>

                        </div>
                    </td>
                </tr>

                {{-- Card --}}
                <tr>
                    <td
                    style="
                        background-color: #ffffff;
                        padding: 30px;
                        max-width: 500px;
                        text-align: justify;
                        line-height: 1.5;
                        border: 1px solid {{ $purple }};
                    "
                    align="center">

                        <div style="
                            display: block;
                            text-align: center;
                            padding: 0;
                            margin: 0 0 3em 0;
                        " class="">
                            <p style="
                                font-weight:600;
                                font-size: 51px;
                                padding:0;
                                margin:0;
                                line-height: 1;
                                color: {{ $purple }};
                                /* color: #301934; */
                            ">MESH</p>

                            <p style="
                                font-size: 10px;
                                padding:0;
                                margin:0;
                                line-height: 1.2;
                            ">MOE Employee and Services Hub</p>
                        </div>


                        {{-- Greetings --}}
                        <p>Yang Mulia Pengiran / Tuan / Puan,</p>

                        {{-- Name and Department --}}
                        <div style="text-align: left;">
                            <p style="font-weight: 600; padding:0;   margin:0; line-height: 1.5;">{{  ucwords($notf_Nama)}}</p>
                            <p style="padding:0; margin:0; line-height: 1.5;">{{ $notf_jabatan}}</p>
                        </div>

                        {{-- Main Message --}}
                        <div style="margin-top: 3em">
                            <p>Your registration account has been successfully verified and approved. You may now begin using our services.</p>

                            <div style="margin: 2em auto;">
                                <a href="https://mesh.moe.gov.bn" style="text-decoration: none;">
                                    <p style="
                                        display: block;
                                        padding: 12px 24px;
                                        background-color: {{ $purple }};
                                        color:white;
                                        border: 2px solid {{ $purple }};
                                        border-radius: 5px;
                                        text-decoration: none;
                                        text-align: center;
                                        font-weight: bold;
                                    ">
                                        ACCESS MESH
                                    </p>
                                </a>
                            </div>

                            <p style="margin-top: 1em;">
                                If you have any questions or require further assistance, feel free to reach out to our support team at
                                <span style="text-decoration: underline; color: blue;">tpp@moe.gov.bn</span>.
                            </p>
                        </div>

                        {{-- Regards --}}
                        <div style="
                            margin-top: 3em;
                        ">
                            <p style="
                                padding:0;
                                margin:0;
                                line-height: 1.5;
                            ">Best Regards,</p>
                            <p style="
                                padding:0;
                                margin:0;
                                line-height: 1.5;
                            ">MESH Support Team</p>
                        </div>
                    </td>
                </tr>

            </table>

        </td>

    </tr>

</table>

</body>
</html>
