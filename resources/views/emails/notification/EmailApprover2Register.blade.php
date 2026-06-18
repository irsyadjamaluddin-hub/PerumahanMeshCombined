@extends('emails.notification.layouts.Mailcss')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>

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

<table cellspacing="0" cellpadding="0" align="center"
style="
    width: 100%;
    table-layout: fixed;
    padding: 0;
    margin: 0;
    color: black;
">
    <tr>
        <td align="center" valign="top" colspan="2">
            <table cellspacing="0" cellpadding="0" align="center" style="overflow:hidden;">
                {{-- Card --}}
                <tr>
                    <td
                        style="
                            background-color: #ffffff;
                            padding: 30px;
                            max-width: 600px;
                            text-align: justify;
                            line-height: 1.5;
                            border: 1px solid {{ $purple }};
                        "
                        align="center">

                        <!-- MESH Header -->
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

                        {{-- Greeting --}}
                        <p style="padding:0; margin:0;">Yang Mulia DevOps Team,</p>

                        {{-- Recipient name --}}
                        <p style="color:#2b2a2a; text-align:center; margin-top:0.5rem;">
                            <b>{{ $notf_NamaApprover2 ?? 'Yang Berkenaan' }}</b>
                        </p>

                        <p style="color:#2b2a2a; text-align:center; margin-top:0.5rem;">
                            <b>{{ $notf_jabatan }}</b>
                        </p>

                        {{-- Spacer --}}
                        <div style="margin-top:1.5rem;"></div>

                        {{-- Body --}}
                        <div style="text-align:left;">
                            <p style="color:#2b2a2a; margin:0 0 1rem 0;">
                            Your assistance is needed to verify the account. The user has been verified by the verifier. Kindly review the account details and confirm the users'validity

                            </p>

                            <p style="margin:0 0 .5rem 0;">
                                <strong>Name:</strong> {{ ucwords($notf_Nama ?? '—') }}<br>
                                <strong>Jabatan:</strong> <span style="color:#6b6b6b;">{{ $notf_jabatan ?? '—' }}</span>
                            </p>

                        </div>

                        {{-- Verification button --}}
                        <div style="margin: 2em auto 0em auto;">
                                <a href= "{{ url('meshverify/' . $notf_id) }}" style="text-decoration: none;">
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

                        {{-- Footer / note --}}
                        <div style="margin-top:2.5rem;">
                            <p style="color:#2b2a2a; margin:0 0 .6rem 0;">
                                Best Regard,
                            </p>

                            <p style="color:#2b2a2a; margin:0 0 .6rem 0;">
                                MESH Auto-Generated Email
                            </p>

                            <p style="color:#2b2a2a; margin:1rem 0 0 0;">
                                Mesh: <a href="https://mesh.moe.gov.bn" style="color: {{ $purple }}; text-decoration: none;">https://mesh.moe.gov.bn</a>
                            </p>

                            <p style="color:#232425; margin-top:0.5rem;"><i>Ministry of Education, Brunei Darussalam</i></p>
                        </div>

                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

@endsection
