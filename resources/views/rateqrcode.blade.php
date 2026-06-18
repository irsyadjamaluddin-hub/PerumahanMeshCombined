<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event PDF</title>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <!-- Display the generated QR code -->
                    <center>{!! QrCode::size(300)->generate($url) !!}</center>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
