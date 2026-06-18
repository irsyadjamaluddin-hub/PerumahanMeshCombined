<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event PDF</title>
</head>
<body>

<div class="card-body">



@php
    $logoPath = public_path('img/moe-logo-latest-compressed.png');

    $logoData = '';
    if (file_exists($logoPath)) {
        $logoData = base64_encode(file_get_contents($logoPath));
    }
@endphp

@if ($logoData)
    <center>
        <img src="data:image/png;base64,{{ $logoData }}" style="width: 400px; height: auto;" alt="MOE LOGO">
    </center>
@else
    <p>Logo not found</p>
@endif







</div>

<br>


    <div style="text-align: center;">
        <br>
        <h1 class="card-subtitle"><strong>Title:</strong> {{ $eventlabel->eventlabel }}</h1>
        <h1><strong>Date:</strong> {{ date('d/m/Y', strtotime($eventlabel->eventdate)) }}</h1>
        <br>
        <br>
        <h2><strong>Please scan the QR Code below</strong></h2>
    </div>

    <div style="text-align: center;">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('qrcodes/' . $eventlabel->id . '.png'))) }}" alt="QR Code" class="mx-auto d-block">
    </div>
</div>

</body>
</html>
