<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ pathinfo($originalFilename, PATHINFO_FILENAME) }}</title>

    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            justify-content: center;
            margin-top: 30%;
        }

        img {
            max-width: 100%;
            max-height: 80vh; /* Adjust the height as needed */
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ pathinfo($originalFilename, PATHINFO_FILENAME) }}</h1>
        <br>
        <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
    </div>
</body>
</html>
