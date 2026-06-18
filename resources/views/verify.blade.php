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
  <link href=" {{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href=" {{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href=" {{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href=" {{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href=" {{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href=" {{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href=" {{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href=" {{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href=" {{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

<style>
main {
  background: #f6f9ff;
}
h1 {
  font-size: 18px;
  font-weight: 700;
  color: #012970;
  font-family: "Nunito", sans-serif;
  text-align: center;
}
h2 {
  font-size: 16px;
  color: #f6f9ff;
  font-family: "Nunito", sans-serif;
  text-align: center;
}</style>

  <main>
    <div class="container">

      <section class="min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center">
                <a href="/" class="logo d-flex align-items-center w-auto">
                  <img src=" {{ asset('assets/img/download1.png') }}" alt="" style="width: 300px">
                </a>
              </div><!-- End Logo -->
<br>
              <div class="card">
          <!-- Card with an image overlay -->
          <div class="card">
            <img src=" {{ asset('assets/img/Untitled-2.png') }}" class="card-img-top" alt="...">
            <div class="card-img-overlay">

              <h2>
              <i class="bi-check-circle-fill"></i> Valid
              <br>
              Surat Kebenaran Bertugas
              </h2>
<hr>
                  <div class="row" style= "font-size: 12px;">
                    <div class="col">Name:</div>
                  </div>
		@foreach($biodatas as $biodata)
                  <div class="row" style= "font-size: 14px; font-weight: bold; text-transform: capitalize;">
                    <div class="col">{{$biodata->name}}</div>
                  </div>
<hr>
                  <div class="row" style= "font-size: 12px;">
                    <div class="col">IC Number:</div>
                    <div class="col">Created at:</div>
                  </div>

                  <div class="row" style= "font-size: 14px; font-weight: bold;">
                    <div class="col">{{$biodata->ic_no}}</div>
		@foreach($qo as $qos)
                    <div class="col">{{$qos->created_at}}</div>
		@endforeach
                  </div>
		@endforeach

              </div>
          </div><!-- End Card with an image overlay -->

            <div class="card-body">

            <h1>M E S H
              <br>
              MOE EMPLOYEE & SERVICES HUB
            </h1>


                </div>
              </div>


            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>