<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Verification</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
  <main>
    <div class="container">
      <section class="min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              
              <div class="qr-code-container">
                <div class="qr-code">
                  <!-- Place your QR code image or generation code here -->
                </div>
                <img src="{{ asset('assets/img/download1.png') }}" class="card-img-top smaller-image" alt="...">
              </div>
              
              <div class="card">
              <div class="card-header text-center"> MOE Event</div>
                <div class="card-body text-center">

                @foreach ($perkaraevent as $perkaraevent)

                   

                    @foreach ($moeevent as $moeevent)
                      <p> <b> {{$moeevent->nama}} </b></p>
                      <i><p> No kad Pengenalan : {{$moeevent->icno}} </p></i>
                    

                    @endforeach

                    
                 
                    
                  <p> Rekod kedatangan berhasil disimpan bagi perkara dibawah ini:</p>

                    <b><p>Event: {{ $perkaraevent->eventlabel }}</p>
                    <p>Event Date: {{ $perkaraevent->eventtime }}</p></b>

                  <p> <i>Terima kasih diatas kesudian Tuan/Puan menghadiri taklimat ini.</i> </p>

                @endforeach
              </div>
                </div>
              
              </div>

           
        
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

  <style>
    /* Reduce the gap between the card and the download logo */
    .qr-code-container {
      margin-bottom: 20px; /* Adjust this value to reduce or increase the gap */
    }
    
    /* Resize the image and add more spacing around it */
    .smaller-image {
      max-width: 80%; /* Adjust the maximum width to control the image size */
      margin: 20px auto; /* Add margin for spacing around the image */
    }
  </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/instascan/2.0.1/instascan.min.js"></script>
  <script src="https://cdn.rawgit.com/cozmo/jsQR/master/dist/jsQR.js"></script>



</body>
</html>
