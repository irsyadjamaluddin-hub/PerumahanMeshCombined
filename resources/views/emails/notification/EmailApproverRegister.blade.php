<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Two</title>

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
    $purple = "#4c00b0";
@endphp

<!-- Use table for layout -->
<table cellspacing="0" cellpadding="0" align="center"
style="
    width: 100%;
    table-layout: fixed;
    padding: 0;
    margin: 0 0 0 0;

">

    <tr>
        <td align="center" valign="top" colspan="2">

            <table class="" cellspacing="0" cellpadding="0" align="center" style="
                overflow: hidden;
            ">

                {{-- Spacer --}}
                <div style="margin-top: 0em;"></div>

                {{-- Card --}}
                <tr>
                    <td
                    style="
                        background-color: #ffffff;
                        padding: 30px;
                        max-width: 500px;
                        text-align: left;
                        line-height: 1.5;
                        border: 1px solid {{ $purple }};
                    "
                    align="center">

                        <!-- MESH Logo -->
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

                        {{-- Spacer --}}
                        <div style="margin-top: 2em;"></div>

                        {{-- Greetings --}}
                        <p style="padding:0; margin:0;">Yang Mulia Pengiran / Tuan / Puan,</p>

                        {{-- Name and Department --}}
                        <div style="text-align: left;">
                            <p style="font-weight: 600; padding:0; margin:0; line-height: 1.5;">{{ ucwords($notf_NamaApprover) }}</p>
                        </div>

                        {{-- Main Message --}}
                        <div style="margin-top: 3em">
                            <p>Your assistance is needed to <span style="text-decoration: underline; font-weight: 600;">verify the status</span> of a user account. Kindly review the account details and confirm the user's validity.</p>

                            {{-- New User Detail --}}
                            <table style="border-collapse: collapse; color: rgb(92, 92, 92); text-align: left; margin-top: 2em;">

                                <tr class="">
                                    <td class="">
                                        <p style="
                                            font-weight: 600;
                                            padding:0 5em 0 0;
                                            margin:0;
                                            line-height: 2;
                                        ">Name</p>
                                    </td>

                                    <td class="">
                                        <p style="
                                            padding:0;
                                            margin:0;
                                            line-height: 2;
                                        ">{{  ucwords($notf_Nama)}}</p>
                                    </td>
                                </tr>

                                <tr class="">
                                    <td class="">
                                        <p style="
                                            font-weight: 600;
                                            /* padding:0 5em 0 0; */
                                            margin:0;
                                            line-height: 2;
                                        ">Jabatan</p>
                                    </td>

                                    <td class="">
                                        <p style="
                                            padding:0;
                                            margin:0;
                                            line-height: 2;
                                        ">{{ $notf_jabatan}}</p>
                                    </td>
                                </tr>

                            </table>

                            <!-- Button -->
                            <div style="margin: 2em auto 0em auto;">
                                <a href= "http://127.0.0.1:8000/approververify/{{ $notf_id }}" style="text-decoration: none;">
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
                                        REVIEW & VERIFY
                                    </p>
                                </a>
                            </div>

                            <p style="margin-top: 3em;">
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

                        {{-- Footer --}}
                        <div style="margin-top: 3em; line-height: 1.5; color: gray; text-align: center; display: none;">
                            <p>
                                Please do not reply to this email. For assistance, contact us at 
                                <span style="text-decoration: underline; color: blue;">tpp@moe.gov.bn</span>
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
