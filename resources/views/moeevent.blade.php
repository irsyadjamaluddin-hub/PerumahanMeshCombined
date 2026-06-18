<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MESH Pengurusan Majlis KP</title>
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

   <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
  <script src="{{ asset('assets/js/apexcharts-bundle.js') }}"></script>


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
 <!-- Back Button - Only visible when user is logged in -->
 @auth  
        <div class="container" style="padding-top: 20px;">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <a href="https://mesh.moe.gov.bn/servicesdashboard" class="btn btn-primary" style="margin-bottom: 10px;">
                <i class="bi bi-arrow-left"></i> 
              </a>
            </div>
          </div>
        </div>
        @endauth
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

        @if (count($errors) > 0)
          <div class="alert alert-danger">
             
              <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif

          <form class="" method="post" action="{{ route('moeevent.moeevent.store') }}" enctype="multipart/form-data">
          @csrf

            <br>

            <!-- <div class="col profile-overview" style="border: 8px solid #012970; padding: 20px; border-radius: 25px;"> -->
              <center><img src="img\newmoelogo.png" class="d-block w-75" alt="MOE LOGO"></center>
              <br>
              <header class="card-title" style="padding: 0px; font-size: 18px;">MESH Pengurusan Majlis KP</header>
              
   
              <hr>
              <form>

              <div class="row mb-3">
                <label class="col-lg-4 col-form-label">Acara<i style="color:red;">*</i></label>
                <div class="col-lg-8">
                  <select class="form-select" name="event" aria-label="Default select example">
                      <option selected hidden>Pilih Acara</option>
                      @foreach ($perkaraevent as $event)
                          @php
                              // Check if eventtime has not passed by a day
                              $eventTime = \Carbon\Carbon::parse($event['eventdate']);
                              $isEventInFuture = $eventTime->isAfter(now()->subDay());
                          @endphp
              
                          @if ($isEventInFuture)
                              <option value="{{ $event['id'] }}">
                                  {{ $event['eventlabel'] }}
                              </option>
                          @endif
                      @endforeach
                  </select>
                  {!! $errors->first('event', '<p class="help-block text-danger">:message</p>') !!}
                </div>                         
              </div>



                <div class="row mb-3">
                  <label for="inputnama" class="col-lg-4 col-form-label">Nama Penuh<i style="color:red;">*</i></label>
                  <div class="col-lg-8">
                    <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                    {!! $errors->first('nama', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

           

                <div class="row mb-3">
				    <label for="inputtel" class="col-lg-4 col-form-label">IC No.<i style="color:red;">*</i></label>
				    <div class="col-lg-8">
				        <input type="text" name="icno" class="form-control" pattern="\d{8}" title="Please enter IC No in digits only" placeholder="example: 00123456" required>
				        {!! $errors->first('icno', '<p class="help-block text-danger">:message</p>') !!}
				    </div>
				</div>

                <div class="row mb-3">
                <label class="col-lg-4 col-form-label">Jabatan<i style="color:red;">*</i></label>
                <div class="col-lg-8">
                  <select class="form-select" name="jabatan" aria-label="Default select example" id="myselect" required>
                  <option selected hidden>Pilih Jabatan</option>
                      @foreach ($departments as $key => $value)
                      <option value="{{ $value }}">
                          {{ $value }}
                      </option>
                      @endforeach
                  </select>

                  {!! $errors->first('jabatan', '<p class="help-block text-danger">:message</p>')!!}
                </div>
              </div>

              <div class="row mb-3">
                  <label for="inputnama" class="col-lg-4 col-form-label">Bahagian<i style="color:red;">*</i></label>
                  <div class="col-lg-8">
                    <input type="text" name="bhg" class="form-control" placeholder="Bahagian">
                    {!! $errors->first('bhg', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

              <div class="row mb-3">
    <label class="col-lg-4 col-form-label">Jawatan:<i style="color:red;">*</i></label>
    <div class="col-lg-8">
        <select class="form-select" name="jawatan" id="myselectjawatan" required>
            <option value="" selected disabled>Pilih Perkara</option>
            @foreach ($jawatanlist as $key => $value)
                <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
        </select>

        <div class="mt-2">
            <input class="form-check-input" type="checkbox" id="otherJawatanCheckbox">
            <label class="form-check-label" for="otherJawatanCheckbox"><i>Jawatan Lain (Others)</i></label>
        </div>

        <div id="otherJawatanInput" style="display: none;" class="mt-2">
            <input type="text" class="form-control" name="jawatan_lain" id="otherJawatanText" placeholder="Masukkan Jawatan Lain">
        </div>

        <p id="jawatanError" class="text-danger" style="display: none;">Sila pilih atau masukkan jawatan.</p>
    </div>
</div>

<script>
    // Checkbox event to show input and disable/enable dropdown
    document.getElementById('otherJawatanCheckbox').addEventListener('change', function() {
        var inputField = document.getElementById('otherJawatanInput');
        var textInput = document.getElementById('otherJawatanText');
        var selectField = document.getElementById('myselectjawatan');
        
        if (this.checked) {
            inputField.style.display = 'block'; // Show the input field
            textInput.setAttribute('required', 'required');
            selectField.setAttribute('disabled', 'disabled'); // Disable dropdown options
            selectField.value = ''; // Clear the dropdown value
        } else {
            inputField.style.display = 'none'; // Hide the input field
            textInput.removeAttribute('required');
            selectField.removeAttribute('disabled'); // Enable dropdown options again
        }
    });

    // Clear checkbox if dropdown is selected and vice versa
    document.getElementById('myselectjawatan').addEventListener('change', function() {
        var selectField = document.getElementById('myselectjawatan');
        var checkbox = document.getElementById('otherJawatanCheckbox');
        var inputField = document.getElementById('otherJawatanInput');
        var textInput = document.getElementById('otherJawatanText');

        // If dropdown value is selected, uncheck checkbox and hide input field
        if (selectField.value !== '') {
            checkbox.checked = false; // Uncheck the checkbox
            inputField.style.display = 'none'; // Hide input field
            textInput.value = ''; // Clear text input value
        }
    });
</script>

              
            

                <div class="row mb-3">
                    <label class="col-lg-4 col-form-label">Jantina</label>
                    <div class="col-lg-8">
                        <select class="form-select" name="gender" aria-label="Default select example">
                            <option selected hidden></option>
                            <option value="Male">Lelaki</option>
                            <option value="Female">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                  <label for="inputtel" class="col-lg-4 col-form-label">No Tel:<i style="color:red;">*</i></label>
                  <div class="col-lg-8">
                    <input type="text" name="no_tel" class="form-control" placeholder="example: 8881234" required>
                    {!! $errors->first('no_tel', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

              <div class="row mb-3">
				    <label for="inputtel" class="col-lg-4 col-form-label">Emel:<i style="color:red;"></i></label>
				    <div class="col-lg-8">
				        <input type="email" name="email" class="form-control" placeholder="example: mesh.moe@moe.gov.bn">
				        {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
				    </div>
				</div>

        <div class="row mb-3">
    <label for="inputtel" class="col-lg-4 col-form-label">
        Captcha:<br>
        <i style="color:blue;">{{ $captchaQuestion }}</i>
    </label>
    <div class="col-lg-8">
        <div class="captcha-numbers">
            @foreach ($numbers as $number)
                <button type="button" class="btn btn-outline-primary number-btn" data-number="{{ $number }}">
                    {{ $number }}
                </button>
            @endforeach
        </div>
        <input type="hidden" name="captcha" id="captcha" required>
        @if ($errors->has('captcha'))
            <span class="text-danger">{{$errors->first('captcha')}}</span>
        @endif
    </div>
</div>

<style>
    .captcha-numbers {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 10px;
    }
    .number-btn {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    .number-btn.active {
        background-color: blue;
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const numberButtons = document.querySelectorAll('.number-btn');
        const captchaInput = document.getElementById('captcha');

        numberButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Remove 'active' class from all buttons
                numberButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add 'active' class to the clicked button
                this.classList.add('active');
                
                // Set the value of the clicked button to the hidden input
                captchaInput.value = this.dataset.number;
            });
        });
    });
</script>


        
      





            
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
  
</section>

   
</body>

</html>
