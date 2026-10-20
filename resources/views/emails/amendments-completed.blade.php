<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pindaan Telah Dilaksanakan</title>
</head>
<body style="font-family: Tahoma, sans-serif; background-color: #f0f0f0; margin: 0;">

@php
    $purple = "#4c00b0";
@endphp

<table cellspacing="0" cellpadding="0" align="center" style="width: 100%; table-layout: fixed; padding: 0; margin: 0;">
    <tr>
        <td align="center" valign="top" colspan="2">
            <table cellspacing="0" cellpadding="0" align="center" style="overflow: hidden;">
                <tr>
                    <td style="background-color: #ffffff; padding: 30px; max-width: 500px; text-align: left; line-height: 1.5; border: 1px solid {{ $purple }};" align="center">
                        
                        <!-- MESH Logo -->
                        <div style="text-align: center; margin: 0 0 3em 0;">
                            <p style="font-weight:600; font-size: 51px; margin:0; line-height: 1; color: {{ $purple }};">MESH</p>
                            <p style="font-size: 10px; margin:0; line-height: 1.2;">MOE Employee and Services Hub</p>
                        </div>

                        <p>Salam Sejahtera {{ $inventory->kgp_nama }},</p>

                        <p>Pemohon telah melaksanakan pindaan yang diminta untuk permohonan berikut:</p>

                        <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px; margin: 1.5em 0;">
                            <table style="width: 100%; font-size: 14px;">
                                <tr>
                                    <td style="padding: 5px 0;"><strong>No. Rujukan:</strong></td>
                                    <td>
                                        @php
                                            // Fix for date parsing
                                            $createdAt = is_string($inventory->created_at) 
                                                ? \Carbon\Carbon::parse($inventory->created_at) 
                                                : $inventory->created_at;
                                            $year = $createdAt->format('Y');
                                        @endphp
                                        {{ $year }}/SP/BBK-{{ $inventory->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0;"><strong>Nama Sekolah/Unit:</strong></td>
                                    <td>{{ $inventory->nama_sch ?? $inventory->unit ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0;"><strong>Nama Pemohon:</strong></td>
                                    <td>{{ $inventory->nama }}</td>
                                </tr>
                            </table>
                        </div>

                        @if($responseMessage)
                        <div style="background-color: #e3f2fd; padding: 15px; border-left: 4px solid #2196f3; margin: 1.5em 0;">
                            <h4 style="margin: 0 0 10px 0; color: #333;">Maklum Balas Pemohon:</h4>
                            <p style="margin: 0;">{{ $responseMessage }}</p>
                        </div>
                        @endif

                        <p style="margin-top: 2em; padding: 15px; background-color: #fff3cd; border-left: 4px solid #ffc107; color: #856404;">
                            <strong>Tindakan Diperlukan:</strong> Sila log masuk ke sistem untuk menyemak permohonan yang telah dikemaskini.
                        </p>

                        <!-- Add clickable button/link to MESH -->
                        <div style="text-align: center; margin: 2em 0;">
                            <a href="http://127.0.0.1:8000" 
                               style="display: inline-block; 
                                      padding: 12px 30px; 
                                      background-color: {{ $purple }}; 
                                      color: white; 
                                      text-decoration: none; 
                                      border-radius: 5px; 
                                      font-weight: bold;">
                                Log Masuk ke MESH
                            </a>
                        </div>

                        <p style="text-align: center; color: #666; font-size: 13px;">
                            atau salin pautan ini: 
                            <a href="http://127.0.0.1:8000" style="color: {{ $purple }};">http://127.0.0.1:8000</a>
                        </p>

                        <div style="margin-top: 3em;">
                            <p style="margin:0; line-height: 1.5;">Sekian, terima kasih.</p>
                            <p style="margin:0; line-height: 1.5;">Pasukan Sokongan MESH</p>
                        </div>

                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>