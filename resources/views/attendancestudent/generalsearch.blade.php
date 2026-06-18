<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>General Search</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

<link href="{{ asset('assets/vendors/animate.css/animate.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">


  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>


  <style>
    p {
      font-size: 14px;
    }
    body {
      background: #4f77aa;
    }

  </style>

</head>

@if (Auth::check())
<body>

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        @if(Session::has('success_message'))
        <div class="alert alert-success">
            {{Session::get('success_message')}}
        </div>
        @endif

        <!-- Borang Table -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 d-flex flex-column align-items-center justify-content-center">

                    <div class="col-12">
                        <div class="card" style="padding-left: 20px; padding-right: 20px;">
                        
                            <div class="card-body">

                                <div class="profile-overview pt-3">

                                    
                                    @if(Session::has('error_message'))
                                    <div class="alert alert-danger">
                                        <i class=" fas fa-fw fa-check"></i>
                                        {!! session('error_message') !!}
                                    </div>
                                    @endif

                                    <br>

                                    <center><img src="{{ asset('img/moe-logo-latest-compressed.png') }}" class="d-block w-75" alt="MOE LOGO"></center>

                                    <br>
                                
                                    <header class="card-title" style="padding: 0px; font-size: 18px;">Kehadiran Majlis</header>

                                    <hr>

                                    <!-- Add an onchange event to the select element -->
                                    <form method="post" action="{{ route('attendance.attendances.generalresult') }}"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                          <label for="inputNama" class="col-lg-4 label">Jabatan/Sekolah:<i style="color:red;">*</i></label>
                                          <div class="col-lg-8">
                                              <select class="form-select" name="school" aria-label="Default select example" id="myselect" required>
                                                  <option selected hidden></option>
                                                  @foreach ($departments as $key => $value)
                                                  <option value="{{ $value }}">
                                                      {{ $value }}
                                                  </option>
                                                  @endforeach
                                              </select>
                                          </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                          <label for="inputNama" class="col-lg-4 label">Pengawas/Pelajar<i style="color:red;">*</i></label>
                                          <div class="col-lg-8">
                                              <select class="form-select" name="role" aria-label="Default select example" id="myselect" required>
                                                  <option selected hidden>Pilih Peranan</option>
                                                  <option value="Guru Pengawas">Guru Pengawas</option>
                                                  <option value="Guru Fokal">Guru Fokal</option>
                                                  <option value="Pelajar">Pelajar</option>
                                                  <option value="Kakitangan">Kakitangan</option>
                                                  <option value="Persembahan Khas">Persembahan Khas</option>
                                                  <option value="Hadrah">Hadrah</option>
                                                  <option value="Kadet Tentera">Kadet Tentera</option>
                                                  <option value="Kadet Polis Diraja Brunei">Kadet Polis Diraja Brunei</option>
                                                  <option value="Kadet Bomba Dan Penyelamat">Kadet Bomba Dan Penyelamat</option>
                                                  <option value="Pengakap">Pengakap</option>
                                                  <option value="Bulan Sabit Merah">Bulan Sabit Merah</option>
                                                  <option value="Pandu Puteri">Pandu Puteri</option>
                                              </select>
                                          </div>
                                        </div>

                                        <div class="row mb-3">
                                          <label for="inputNama" class="col-lg-4 label">Event<i style="color:red;">*</i></label>
                                          <div class="col-lg-8">
                                              <select class="form-select" name="event" aria-label="Default select example" id="myselectevent" required>
                                                  <option selected hidden></option>
                                                  @foreach ($event as $events)
                                                  <option value="{{ $events->name }}">
                                                    {{ $events->name }}
                                                  </option>
                                                  @endforeach
                                              </select>
                                          </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Hantar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>              
        </div>

        <script>
            $('#myselect').select2({
            width: '100%',
            placeholder: "Pilih Jabatan",
            allowClear: true
            });
        </script>

        <script>
            $('#myselectevent').select2({
            width: '100%',
            placeholder: "Pilih Majlis",
            allowClear: true
            });
        </script>
    
        
    </section>
</body>
@else
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
                    <h5 class="card-title text-center pb-0 fs-4">Enter your credentials to login</h5>
                  </div>

                  @if(session()->has('verification_message'))
                    <div class="alert alert-danger">
                        {{ session()->get('verification_message') }}
                    </div>
                @endif

                  
                  <form method="POST" class="row g-3" id="login-form" action="{{ route('attendance.attendances.generallogin') }}">
                    @csrf
                    {{-- <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                          <input type="text" name="email"  value="{{ old('email') }}" class="form-control" id="email">
                          @error('email')
                                      <div class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </div>
                          @enderror
                      </div>
                    </div> --}}


                    {{-- Ekma Try to do Login by Ic No --}}
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">IC No</label>
                      <div class="input-group">
                        {{-- <span class="input-group-text" id="inputGroupPrepend">@</span> --}}
                          <input type="text" name="ic_no"  value="{{ old('ic_no') }}" class="form-control" id="ic_no "placeholder="Eg. 00123456">
                          @error('ic_no')
                                      <div class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </div>
                          @enderror
                      </div>
                    </div>

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
                      <!-- <button class="btn btn-primary w-100" type="submit"><a style="color:white">Login</a></button> -->
                      <input type="submit" class="btn btn-primary w-100" style="vertical-align:middle" {{ __('Login') }} value="Log in"/>
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
@endif

</html>