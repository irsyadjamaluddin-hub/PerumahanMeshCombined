<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register - Staff</title>
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
            <div class="col-lg-5 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo_2.png" alt="">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">MESH Registration</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  @if ($errors->any())
                    <div class="alert alert-danger">
                    <ul>  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                    </ul>
                    </div>
                  @endif

                  <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    
                      <div class="col-12">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>				

                      <div class="col-12">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('IC Number') }}</label>
                        <input id="ic_no" type="ic_no" class="form-control @error('ic_no') is-invalid @enderror" name="ic_no" value="{{ old('ic_no') }}" placeholder="Eg. 00123456" required autocomplete="ic_no">

                        @error('ic_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                              {{-- <div class="col-12">
                      <div class="input-group has-validation">	
                                  <span class="input-group-text" id="inputGroupPrepend">@</span>
                                  <input type="email" name="email" class="form-control" id="yourEmail" placeholder="Your Email" required>
                                  <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                      </div>
                      </div> --}}

                      <div class="col-12">
                        <label for="email" class="col-md-6 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-12">
                          <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                      <label for="department_id" class="col-md-6 col-form-label text-md-right">{{ __('Jabatan') }}</label>

                      <div class="col-md-12">
                        <div class="col-md-12">

                          <select class ="form-select" name="department_id" id="myselect">
                            <option value ="" ></option>
                            <?php
                              $departments =DB::select(DB::raw('select * from departments'));

                            ?>

                            @if (count ($departments)>0)
                            @foreach($departments as $department)
                            <option value= "{{$department->id}}"> {{$department->label}}</option>
                            @endforeach
                            @endif
                        </select>
                        </div>
                      </div>
                  </div>

                   <div class="col-12">
                        <label for="department_id" class="col-md-6 col-form-label text-md-right">{{ __('Jenis Perkhidmatan') }}</label>

                        <div class="col-md-12">
                          <div class="col-md-12">

                            <select class="form-select" name="employment_status_id" id="employment_status_id">
                              <option value=""></option>
                              <?php
                              $employments = DB::select(DB::raw('select * from employment_statuss'));

                              ?>

                              @if (count ($employments)>0)
                              @foreach($employments as $employment)
                              <option value="{{$employment->id}}"> {{$employment->label}}</option>
                              @endforeach
                              @endif
                            </select>
                          </div>
                        </div>
                      </div>


                      <div class="col-12">
                        <label for="bahagian_id" class="col-md-4 col-form-label text-md-right">{{ __('Bahagian/Unit') }}</label>
                        <input id="bahagian_id" type="text" class="form-control @error('bahagian_id') is-invalid @enderror" name="bahagian_id" value="{{ old('bahagian_id') }}" required autocomplete="bahagian_id" autofocus>

                        @error('bahagian_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>        
                      
                      <div class="col-12">
                        <label for="division_id" class="col-md-6 col-form-label text-md-right">{{ __('Bahagian (Tanggagaji)') }}</label>

                        <div class="col-md-12">
                          <div class="col-md-12">

                            <select class="form-select" name="division_id" id="division_id">
                              <option value=""></option>
                              <?php
                              $divisions = DB::select(DB::raw('select * from divisions'));

                              ?>

                              @if (count ($divisions)>0)
                              @foreach($divisions as $division)
                              <option value="{{$division->id}}"> {{$division->label}}</option>
                              @endforeach
                              @endif
                            </select>
                          </div>
                        </div>
                      </div>                      

                      <div class="row">
                          <div class="col-lg-12 col-form-label">Phone Number</div>
                      </div>
                      <div class="row">
                        <div class="col-lg-2 col-form-label">
                          +673
                        </div>
                        <div class="col-lg-10">
                          <input id="telephone_mobile" type="telephone_mobile" class="form-control @error('telephone_mobile') is-invalid @enderror" name="telephone_mobile" value="{{ old('telephone_mobile') }}" placeholder="Eg. 8888888" required autocomplete="telephone_mobile">
                        </div>
                          @error('telephone_mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>

                    <div class="col-12">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                        <div class="input-group has-validation">
                        <input class="form-control" type="password" id="password" name="password" required autocomplete="new-password">
                        <span class="btn btn-primary" id="inputGroupPrepend">
                          <i class="bi bi-eye" id="eyeSlash" onclick="visibility3()"></i>
                          <i class="bi bi-eye" id="eyeShow" style="display: none;" class="" onclick="visibility3()"></i>
                        </span>
                      </div>
                      </div>


                      <div class="col-12">
                        <label for="password-confirm" class="col-md-6 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                        <div class="input-group has-validation">
                        <input class="form-control" type="password" id="password-confirm" name="password_confirmation" required autocomplete="new-password">
                        <span class="btn btn-primary" id="inputGroupPrepend">
                          <i class="bi bi-eye" id="eyeSlash" onclick="visibility4()"></i>
                          <i class="bi bi-eye" id="eyeShow" style="display: none;" class="" onclick="visibility4()"></i>
                        </span>
                        </div>
                      </div>
<br>
            
                       <div class="col-12">
                        <div class="form-check">
                          <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                          <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="/terms">terms and conditions</a></label>
                          <div class="invalid-feedback">You must agree before submitting.</div>
                        </div>
                      </div> 

                      <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">
                          {{ __('Register') }}
                      </button>
                      </div>
                      <div class="col-12">
                        <p class="small mb-0">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
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
      <span style="color:black" title="Developed by: Saidatul Ekma (MESH Lead Developer), Laila Khamis(EASE Lead Developer), Nurul Hasinah(Database Administrator), Nadzirah Ali Hassim(Programmer), Wan Arif(Project Officer), Lyanna Karim (MESH Layout & Design)">
		Ministry of Education &copy; 2021 All Rights Reserved</span>
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

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

  <script>
    $('#myselect').select2({
      width: '100%',
      placeholder: "Pilih Jabatan",
      allowClear: true
    });
  </script>

<!-- eye toogle-->

  <script>

    function visibility3() {
    var x = document.getElementById('password');
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


<script>

  function visibility4() {
  var x = document.getElementById('password-confirm');
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