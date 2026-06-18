<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register MESH</title>
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
  <link href="assets/css/admin.css" rel="stylesheet">


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

            @if ($errors->any())
            <div class="alert alert-danger">
            <ul>  @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
            </ul>
            </div>
          @endif

          <form class="" method="post" action="{{ route('registerverify.registerverify.store') }}" enctype="multipart/form-data">
          @csrf

            <br>

            <!-- <div class="col profile-overview" style="border: 8px solid #012970; padding: 20px; border-radius: 25px;"> -->
              <center><img src="img\newmoelogo.png" class="d-block w-60" alt="MOE LOGO"></center>
              <br>
              <header class="card-title" style="padding: 0px; font-size: 18px;">REGISTRATION MESH ACCOUNT</header>


              <hr>

              <form>
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
                        <select class="form-select" name="department_id" id="myselect">
                          <option value="" ></option>
                          <?php
                            $departments = DB::select(DB::raw('select * from departments'));
                          ?>

                          @if (count($departments) > 0)
                            @foreach($departments as $department)
                              <option value="{{ $department->id }}"
                                {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->label }}
                              </option>
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
                      <option value="{{ $employment->id }}"
                        {{ old('employment_status_id') == $employment->id ? 'selected' : '' }}>
                        {{ $employment->label }}
                      </option>

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

                      @if (count($divisions) > 0)
                        @foreach($divisions as $division)
                          <option value="{{ $division->id }}"
                            {{ old('division_id') == $division->id ? 'selected' : '' }}>
                            {{ $division->label }}
                          </option>
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
                  <input class="form-control" type="password" id="password" name="password" required autocomplete="new-password"
                         pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{15,}"
                         title="Password must be at least 15 characters long, include an uppercase letter, a lowercase letter, a number, and a special character.">
                  <span class="btn btn-primary" id="inputGroupPrepend">
                    <i class="bi bi-eye" id="eyeSlash" onclick="visibility3()"></i>
                    <i class="bi bi-eye" id="eyeShow" style="display: none;" onclick="visibility3()"></i>
                  </span>
                </div>
                  {{-- Display error message for password --}}
                @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>


              <div class="col-12">
                <label for="password-confirm" class="col-md-6 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                <div class="input-group has-validation">
                  <input class="form-control" type="password" id="password-confirm" name="password_confirmation" required autocomplete="new-password"
                         pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{15,}"
                         title="Password must be at least 15 characters long, include an uppercase letter, a lowercase letter, a number, and a special character.">
                  <span class="btn btn-primary" id="inputGroupPrepend">
                    <i class="bi bi-eye" id="eyeSlash" onclick="visibility4()"></i>
                    <i class="bi bi-eye" id="eyeShow" style="display: none;" onclick="visibility4()"></i>
                  </span>
                </div>
                 {{-- Display error message for password confirmation --}}
  @error('password_confirmation')
  <div class="text-danger mt-1">{{ $message }}</div>
@enderror
              </div>
<br>

              <header class="card-title" style="padding: 0px; font-size: 18px;">VERIFIER DETAILS</header>
              <hr>

              <div class="col-12">
                <label for="fullnameapprover1" class="col-md-4 col-form-label text-md-right">{{ __('Approver1: Full Name') }}</label>
                <input id="fullnameapprover1" type="text" class="form-control @error('ap1_name') is-invalid @enderror" name="ap1_name" value="{{ old('ap1_name') }}" required autocomplete="fullnameapprover1" autofocus>

                @error('ap1_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-12">
                <label for="ap1_email" class="col-md-6 col-form-label text-md-right">{{ __('Approver 1: E-Mail Address') }}</label>
                <div class="col-md-12">
                    <input id="ap1_email" type="email" class="form-control @error('ap1_email') is-invalid @enderror" name="ap1_email" value="{{ old('ap1_email') }}" required autocomplete="email" pattern="[a-zA-Z0-9._%+-]+@moe\.gov\.bn$" title="Please enter a valid moe.gov.bn email address">

                    @error('ap1_email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- <div class="col-12">
                <label for="fullnameapprover2" class="col-md-4 col-form-label text-md-right">{{ __('Approver2: Full Name') }}</label>
                <input id="fullnameapprover2" type="text" class="form-control @error('ap2_name') is-invalid @enderror" name="ap2_name" value="{{ old('ap2_name') }}" required autocomplete="fullnameapprover2" autofocus>

                @error('ap2_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-12">
                <label for="ap2_email" class="col-md-6 col-form-label text-md-right">{{ __('Approver 2: E-Mail Address') }}</label>
                <div class="col-md-12">
                    <input id="ap2_email" type="email" class="form-control @error('ap2_email') is-invalid @enderror" name="ap2_email" value="{{ old('ap2_email') }}" required autocomplete="email" pattern="[a-zA-Z0-9._%+-]+@moe\.gov\.bn$" title="Please enter a valid moe.gov.bn email address">

                    @error('ap2_email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div> -->


              <hr>



<br>

               <div class="col-12">
                <div class="form-check">
                  <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                  <label class="form-check-label" for="acceptTerms">I agree and accept the <a  href="/terms">terms and conditions</a></label>
                  <div class="invalid-feedback">You must agree before submitting.</div>
                </div>
              </div>



          <div class="text-center">
              <button type="submit" id="submitBtn" class="btn btn-primary">Hantar</button>
          </div>

          <script>
              // Disable the submit button after it's clicked
              document.getElementById('submitBtn').addEventListener('click', function() {
                  this.disabled = true; // Disable the button
                  this.form.submit(); // Submit the form
              });
          </script>


            <br>



          </form>


        </div>

      </div>

      </div>

</div>


    </div>

  </div>
  </div><!-- End Recent Sales -->

  </div>

  <script>
    $('#myselect').select2({
      width: '100%',
      placeholder: "Pilih Jabatan",
      allowClear: true
    });
  </script>
    <script>
    $('#myselect2').select2({
      width: '100%',
      placeholder: "",
      allowClear: true
    });
  </script>

<script>
    $('#myselectjawatan').select2({
      width: '100%',
      placeholder: "",
      allowClear: true
    });
  </script>

  <!-- eye toogle-->

  <script>
   function visibility3() {
  var password = document.getElementById("password");
  var eyeSlash = document.getElementById("eyeSlash");
  var eyeShow = document.getElementById("eyeShow");

  if (password.type === "password") {
    password.type = "text";
    eyeSlash.style.display = "none";
    eyeShow.style.display = "inline";
  } else {
    password.type = "password";
    eyeSlash.style.display = "inline";
    eyeShow.style.display = "none";
  }
}

function visibility4() {
  var passwordConfirm = document.getElementById("password-confirm");
  var eyeSlash = document.getElementById("eyeSlash");
  var eyeShow = document.getElementById("eyeShow");

  if (passwordConfirm.type === "password") {
    passwordConfirm.type = "text";
    eyeSlash.style.display = "none";
    eyeShow.style.display = "inline";
  } else {
    passwordConfirm.type = "password";
    eyeSlash.style.display = "inline";
    eyeShow.style.display = "none";
  }
}

</script>



</section>


</body>

</html>
