<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makluman Kuiri Baharu</title>

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
">

    <tr>
        <td align="center" valign="top" colspan="2">

            <table cellspacing="0" cellpadding="0" align="center" style="overflow: hidden;">

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
                        <div style="text-align: center; margin: 0 0 3em 0;">
                            <p style="font-weight:600; font-size: 51px; margin:0; line-height: 1; color: {{ $purple }};">MESH</p>
                            <p style="font-size: 10px; margin:0; line-height: 1.2;">MOE Employee and Services Hub</p>
                        </div>

                        {{-- Spacer --}}
                        <div style="margin-top: 2em;"></div>

                        {{-- Greeting --}}
                        @if($inventory && isset($inventory->nama))
                            <p>Salam Sejahtera <strong>{{ $inventory->nama }}</strong>,</p>
                        @else
                            <p>Salam Sejahtera,</p>
                        @endif

                        {{-- Main Message --}}
                        <div style="margin-top: 2em">
                            <p>
                                Anda telah menerima satu <strong>kuiri baharu</strong> berkaitan permohonan bahan kurikulum anda. Sila semak kandungan kuiri di bawah dan ambil tindakan yang sewajarnya.
                            </p>

                            {{-- Application Details --}}
                            @if($inventory)
                            <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px; margin: 1.5em 0;">
                                <h4 style="margin: 0 0 10px 0; color: {{ $purple }};">Maklumat Permohonan:</h4>
                                <table style="width: 100%; font-size: 14px;">
                                    <tr>
                                        <td style="padding: 5px 0;"><strong>No. Rujukan:</strong></td>
                                        <td style="padding: 5px 0;">
                                            @php
                                                $createdAt = is_string($inventory->created_at) ? \Carbon\Carbon::parse($inventory->created_at) : $inventory->created_at;
                                                $year = $createdAt->format('Y');
                                            @endphp
                                            {{ $year }}/{{ isset($inventory->nama_sch) ? 'SP' : 'UP' }}/BBK-{{ $inventory->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 5px 0;"><strong>Jenis Permohonan:</strong></td>
                                        <td style="padding: 5px 0;">{{ isset($inventory->nama_sch) ? 'Sekolah' : 'Unit' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 5px 0;"><strong>{{ isset($inventory->nama_sch) ? 'Nama Sekolah' : 'Nama Unit' }}:</strong></td>
                                        <td style="padding: 5px 0;">{{ $inventory->nama_sch ?? $inventory->unit ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 5px 0;"><strong>Tarikh Permohonan:</strong></td>
                                        <td style="padding: 5px 0;">
                                            @php
                                                $formattedDate = $createdAt->format('d/m/Y');
                                            @endphp
                                            {{ $formattedDate }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            @endif

                            {{-- Query Content --}}
                            <div style="background-color: #f8f8f8; padding: 15px; border-left: 4px solid {{ $purple }}; margin-top: 1.5em;">
                                <h4 style="margin: 0 0 10px 0; color: #333;">Mesej Kuiri:</h4>
                                <p style="margin: 0; white-space: pre-wrap;">{{ $messageContent }}</p>
                            </div>

                            <p style="margin-top: 2em; padding: 15px; background-color: #fff3cd; border-left: 4px solid #ffc107; color: #856404;">
                                <strong>Tindakan Diperlukan:</strong> Sila log masuk ke sistem untuk melihat dan mengemaskini permohonan anda.
                            </p>

                            <p style="margin-top: 2em;">
                                Sekiranya anda mempunyai sebarang pertanyaan lanjut, sila hubungi pihak pentadbiran kami di
                                <span style="text-decoration: underline; color: blue;">tpp@moe.gov.bn</span>.
                            </p>
                        </div>

                        {{-- Regards --}}
                        <div style="margin-top: 3em;">
                            <p style="margin:0; line-height: 1.5;">Sekian, terima kasih.</p>
                            <p style="margin:0; line-height: 1.5;">Pasukan Sokongan MESH</p>
                        </div>

                        {{-- Footer --}}
                        <div style="margin-top: 3em; padding-top: 2em; border-top: 1px solid #e0e0e0; font-size: 12px; color: #666;">
                            <p style="margin: 0;">
                                <em>Ini adalah emel automatik. Sila jangan balas kepada emel ini.</em>
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