<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login - PPS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/vendors/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendors/aos/aos.css" rel="stylesheet">
  <link href="assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendors/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendors/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendors/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendors/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
  
  <!-- Template Main CSS File -->
  <link href="assets/css/styles.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Pop Up -->
  <!-- <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" /> -->
  <link href="assets/css/tailwind.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

</head>

<body>

  <main>
    <div class="borang">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo_2.png" alt="">
                  <!-- <span class="d-none d-lg-block">NiceAdmin</span> -->
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-2 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Enter The Password</h5>
                  </div>

                  @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                    @endif

                  
                <form method="POST" action="{{ route('pps.pps.post') }}">
                    @csrf

                      <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <div class="input-group has-validation">
                      
                        <input class="form-control" type="password" id="login_password" name="password" value="{{ old('password') }}" required>
                        <span class="btn btn-primary" id="inputGroupPrepend">
                          <i class="bi bi-eye" id="eyeSlash" onclick="visibility3()"></i>
                          <i class="bi bi-eye" id="eyeShow" style="display: none;" class="" onclick="visibility3()"></i>
                        </span>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <!-- <button class="btn btn-primary w-100" type="submit"><a style="color:white">Login</a></button> -->
                      <input type="submit" class="btn btn-primary w-100" style="vertical-align:middle" {{ __('Login') }} value="Submit"/>
                    </div>
                    
                  </form>

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
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- ======= Footer ======= -->
  <footer id="footer" style="background-color:#d5d9f7">
    <div class="container">
      <div class="copyright">
      <span style="color:black" title="Developed by: Saidatul Ekma (MESH Lead Developer), Laila Khamis(EASE Lead Developer), Nurul Hasinah(Database Administrator), Nadzirah Ali Hassim(Programmer), Wan Arif(Project Officer), Lyanna Karim (MESH Layout & Design)">
    Ministry of Education &copy; 2021 All Rights Reserved</span>
      </div>  
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- JS -->
<script src="{{ asset ('vendor/vendor1/jquery/jquery.min.js') }}"></script>
<script src="{{ asset ('js/main.js') }}"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />





 <script>

  function visibility3() {
  var x = document.getElementById('login_password');
  if (x.type === 'password') {
    x.type = "text";
    $('#eyeShow').show();
    $('#eyeSlash').hide();
  }else {
    x.type = "password";
    $('#eyeShow').hide();
    $('#eyeSlash').show();
  }
}

</script>





</body>

</html>