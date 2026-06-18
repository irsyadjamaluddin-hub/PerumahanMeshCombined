<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <title>Permohonan Diluluskan</title>
</head>
<body style="font-family: Tahoma, sans-serif; background-color: #f0f0f0; margin: 0;">

@php $purple = "#4c00b0"; @endphp

<table align="center" style="width:100%; padding:0; margin:0;">
<tr>
<td align="center">

<table style="background:#ffffff; padding:30px; max-width:500px; border:1px solid {{ $purple }};">

<!-- HEADER -->
<tr>
<td style="text-align:center;">
    <h1 style="color:{{ $purple }}; margin:0;">MESH</h1>
    <small>MOE Employee and Services Hub</small>
</td>
</tr>

<tr><td style="padding-top:20px;">

<p>Salam Sejahtera {{ $inventory->nama }},</p>

<p>Permohonan berikut telah <strong>DILULUSKAN</strong>:</p>

<!-- INFO BOX -->
<div style="background:#f9f9f9; padding:15px; margin:15px 0;">
<table style="width:100%;">
<tr>
<td><strong>No Rujukan:</strong></td>
<td>
@php
$year = \Carbon\Carbon::parse($inventory->created_at)->format('Y');
@endphp
{{ $year }}/SP/BBK-{{ $inventory->id }}
</td>
</tr>

<tr>
<td><strong>Nama Sekolah/Unit:</strong></td>
<td>{{ $inventory->nama_sch ?? $inventory->unit }}</td>
</tr>

<tr>
<td><strong>Nama Pemohon:</strong></td>
<td>{{ $inventory->nama }}</td>
</tr>
</table>
</div>

<p style="margin-top:20px;">
Sila log masuk ke sistem untuk tindakan lanjut.
</p>

<!-- BUTTON -->
<div style="text-align:center; margin:25px 0;">
<a href="https://mesh.moe.gov.bn"
   style="background:{{ $purple }};
          color:white;
          padding:12px 25px;
          text-decoration:none;
          border-radius:5px;">
Log Masuk ke MESH
</a>
</div>

<p style="font-size:13px; color:#666;">
Notifikasi ini dihantar secara automatik oleh sistem.
</p>

<p>Sekian, terima kasih.</p>

<p>Pasukan Sokongan MESH</p>

</td></tr>
</table>

</td>
</tr>
</table>

</body>
</html>