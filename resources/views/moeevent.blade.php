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

  
  {{-- #==== ORI CODE ====

  <style>
    p {
      font-size: 14px;
    }
    body {
      background: #4f77aa;
    }

  </style>

  #====== NEWLY ADDED (keeps all vendor CSS/JS active, exactly like slipkedatangan-new.blade.php does — only the inline <style> block is replaced with the navy-particle design) ==== --}}
  <style>
    p {
      font-size: 14px;
    }
    html, body {
      height: 100%;
    }

    body {
      margin: 0;
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
      background-image:
        radial-gradient(circle, rgba(255, 255, 255, 0.12) 1px, transparent 1.4px),
        radial-gradient(ellipse 900px 600px at 20% 10%, rgba(79, 70, 229, 0.35), transparent 60%),
        radial-gradient(ellipse 800px 700px at 85% 85%, rgba(206, 17, 38, 0.18), transparent 55%),
        linear-gradient(150deg, #0f0b2e 0%, #140f34 45%, #201a5c 100%);
      background-size: 22px 22px, cover, cover, cover;
      background-position: 0 0, center, center, center;
      background-repeat: repeat, no-repeat, no-repeat, no-repeat;
      background-attachment: fixed;
      font-family: "Poppins", "Open Sans", sans-serif;
    }

    #particles-js {
      position: fixed;
      inset: 0;
      z-index: 0;
    }

    /* #====== ORI CODE ====

    .section.register {
      position: relative;
      z-index: 1;
    }

    #====== NEWLY ADDED (this section spans the full viewport with z-index above the particles canvas, silently blocking hover/click from ever reaching the particles behind it — pointer-events:none lets those pass through, restored only on the actual content column, matching the same fix in slipkedatangan-new.blade.php) ==== */
    .section.register {
      position: relative;
      z-index: 1;
      pointer-events: none;
    }

    .section.register .container {
      pointer-events: auto;
    }
    /* #====== ========. */

    .section.register .card {
      border: none;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 20px 45px rgba(4, 18, 40, 0.45);
    }

    .section.register .card-title {
      display: inline-block;
      font-weight: 700;
      color: #0c2f5e;
      letter-spacing: 0.3px;
      text-transform: uppercase;
      padding-bottom: 10px;
      position: relative;
    }

    .section.register .card-title::after {
      content: "";
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      bottom: 0;
      width: 46px;
      height: 3px;
      border-radius: 2px;
      background: #f0b429;
    }

    .section.register .col-form-label {
      font-weight: 600;
      color: #4a90d9;
    }

    /* #====== ORI CODE ====

    .section.register .form-control,
    .section.register .form-select {
      border: 1.5px solid #dde3ea;
      border-radius: 8px;
      padding: 10px 14px;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    #====== NEWLY ADDED (light-blue field background, matching the DevOps Service Desk / DRF forms) ==== */
    .section.register .form-control,
    .section.register .form-select {
      background: #e6f1fb;
      border: 1.5px solid #c9def2;
      border-radius: 8px;
      padding: 10px 14px;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    /* #====== ========. */

    /* #==========NEWLY ADDED======== (explicit black field text, matching the drf/dsd/mea "createevent-new" forms) */
    .section.register .form-control,
    .section.register .form-select {
      color: #000000;
    }
    /* =========================== */

    /* #==========NEWLY ADDED======== (browser dims ::placeholder text by default regardless of the input's own color, and select2 was already dropped here in favour of the plain .form-select, so the empty/hidden option text just needs the same explicit black) */
    .section.register ::placeholder { color: #000000; opacity: 1; }
    .section.register .form-select option { color: #000000; }
    /* =========================== */

    /* #==========NEWLY ADDED======== (Chrome's autofill/autocomplete-suggestion styling uses -webkit-text-fill-color, which overrides the plain color property, and needs !important on every autofill pseudo-class or Chrome's own internal autofill style still wins — this is why a value picked from the browser's suggestion dropdown rendered gray while manually-typed text stayed black) */
    .section.register .form-control:-webkit-autofill,
    .section.register .form-control:-webkit-autofill:hover,
    .section.register .form-control:-webkit-autofill:focus,
    .section.register .form-control:-webkit-autofill:active {
      -webkit-text-fill-color: #000000 !important;
      -webkit-box-shadow: 0 0 0 1000px #e6f1fb inset !important;
      box-shadow: 0 0 0 1000px #e6f1fb inset !important;
      caret-color: #000000;
      transition: background-color 5000s ease-in-out 0s;
    }
    /* =========================== */

    .section.register .form-control:focus,
    .section.register .form-select:focus {
      border-color: #144d8f;
      box-shadow: 0 0 0 4px rgba(20, 77, 143, 0.15);
    }

    .section.register .btn-primary {
      background: #0c2f5e;
      border: none;
      border-radius: 8px;
      padding: 10px 36px;
      font-weight: 600;
      letter-spacing: 0.3px;
      transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    }

    .section.register .btn-primary:hover {
      background: #144d8f;
      transform: translateY(-1px);
      box-shadow: 0 10px 20px rgba(4, 18, 40, 0.3);
    }

    .section.register .btn-primary:focus {
      box-shadow: 0 0 0 4px rgba(240, 180, 41, 0.35);
    }

    .section.register hr {
      opacity: 0.12;
    }

    .btn-primary {
      background: #0c2f5e;
      border: 1.5px solid #ffffff;
      border-radius: 8px;
    }

    .btn-primary:hover {
      background: #144d8f;
    }

    .btn-primary:focus {
      box-shadow: 0 0 0 4px rgba(240, 180, 41, 0.35);
    }

    @media (max-width: 991px) {
      .section.register .container { padding-left: 10px; padding-right: 10px; }
      .section.register .card { margin: 0; }
    }

    @media (max-width: 560px) {
      .section.register .container { padding-left: 6px; padding-right: 6px; }
      .section.register .col-12 .card { padding-left: 10px !important; padding-right: 10px !important; }
      .section.register .card-body { padding: 12px; }
      .section.register .card-title { font-size: 16px; }
      .section.register center img { width: 55% !important; max-width: 150px !important; }
      .section.register .row.mb-3 { margin-bottom: 10px !important; }
      .section.register .col-form-label { padding-bottom: 4px; }
      .section.register .form-control,
      .section.register .form-select { font-size: 16px !important; }
      .section.register .btn-primary { width: 100%; }
    }

    /* #==== NEWLY ADDED (label/field only carry col-lg-* classes, which Bootstrap only widths at the lg breakpoint and up — below that they had no width at all and wrapped onto separate lines instead of sitting side by side like on desktop; matches the same fix applied to slipkedatangan-new.blade.php) ==== */
    @media (max-width: 991px) {
      .section.register .row.mb-3 {
        flex-wrap: nowrap;
      }
      .section.register .row.mb-3 > .col-form-label {
        flex: 0 0 34%;
        max-width: 34%;
        width: 34%;
      }
      .section.register .row.mb-3 > [class*="col-lg-8"] {
        flex: 0 0 66%;
        max-width: 66%;
        width: 66%;
      }
    }
    @media (max-width: 560px) {
      .section.register .row.mb-3 > .col-form-label {
        flex: 0 0 38%;
        max-width: 38%;
        width: 38%;
        font-size: 13px;
      }
      .section.register .row.mb-3 > [class*="col-lg-8"] {
        flex: 0 0 62%;
        max-width: 62%;
        width: 62%;
      }
      .section.register .form-control,
      .section.register .form-select { width: 100% !important; }
    }
  </style>
  {{-- #====== ========. --}}

</head>

<body>

  {{-- #====== NEWLY ADDED (particles background to match slipkedatangan-new.blade.php) ==== --}}
  <div id="particles-js"></div>
  <script src="{{ asset('js/particles.min.js') }}"></script>
  <script>
    particlesJS("particles-js", {"particles":{"number":{"value":100,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});
  </script>
  {{-- #====== ========. --}}

  {{-- #==== ORI CODE ====

  <!-- Back Button - Only visible when user is logged in -->
  @auth
  <div class="container" style="padding-top: 20px;">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <a href="http://127.0.0.1:8000/servicesdashboard" class="btn btn-primary" style="margin-bottom: 10px;">
          <i class="bi bi-arrow-left"></i>
        </a>
      </div>
    </div>
  </div>
  @endauth

  #====== NEWLY ADDED (back button now leads to the Majlis KP admin index, styled to match slipkedatangan-new.blade.php) ==== --}}
  @auth
  <div class="container" style="padding-top: 20px; position: relative; z-index: 2;">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <a href="{{ route('moeevent.moeevent.indexadmin') }}" class="btn btn-primary" style="margin-bottom: 10px;">
          <i class="bi bi-arrow-left"></i>
        </a>
      </div>
    </div>
  </div>
  @endauth
  {{-- #====== ========. --}}

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
              {{-- #==== ORI CODE ====

              <center><img src="img\newmoelogo.png" class="d-block w-75" alt="MOE LOGO"></center>
              <br>
              <header class="card-title" style="padding: 0px; font-size: 18px;">MESH Pengurusan Majlis KP</header>

              #====== NEWLY ADDED (title wrapped in a centered div; logo swapped to the same crest used in SKTEST/slipkedatangan-new/drf-create/support_center, resized to match) ==== --}}
              <center><img src="img\moe-logo-latest-compressed.png" class="d-block" style="max-width: 190px; width: 60%; margin: 0 auto;" alt="MOE LOGO"></center>
              <br>
              <div style="text-align: center;">
                <header class="card-title" style="padding: 0px; font-size: 18px;">MESH Pengurusan Majlis KP</header>
              </div>
              {{-- #====== ========. --}}

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
                  {{-- #==== ORI CODE ====

                  <select class="form-select" name="jabatan" aria-label="Default select example" id="myselect" required>

                  #====== NEWLY ADDED (select2 dropped in favour of the plain styled select) ==== --}}
                  <select class="form-select" name="jabatan" aria-label="Default select example" required>
                  {{-- #====== ========. --}}
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
        {{-- #==== ORI CODE ====

        <select class="form-select" name="jawatan" id="myselectjawatan" required>

        #====== NEWLY ADDED (select2 dropped in favour of the plain styled select) ==== --}}
        <select class="form-select" name="jawatan" id="myselectjawatan" required>
        {{-- #====== ========. --}}
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

        
        {{-- #==== ORI CODE ====
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
        --}}
        {{-- #==== NEWLY ADDED (captcha ported from support_center/create-new.blade.php (DSD): the old version never actually verified the pick against $correctAnswer anywhere, client or server, so any click submitted successfully; this version regenerates a fresh random target+options in JS, visibly flags right/wrong on click, auto-regenerates on a wrong pick, and blocks form submission until the correct number is picked) ==== --}}
        {{-- #==== ORI CODE ====
        <div class="row mb-3">
    <label class="col-lg-4 col-form-label">
        Captcha:<br>
        <i style="color:blue;">Please select the number: <strong id="captcha-target">?</strong></i>
    </label>
    <div class="col-lg-8">
        <div id="captcha-options" class="captcha-grid"></div>
        <input type="hidden" name="captcha" id="captcha">
        <small id="captcha-help" class="invalid-msg">Wrong number selected. Please try again.</small>
        @if ($errors->has('captcha'))
            <span class="text-danger">{{$errors->first('captcha')}}</span>
        @endif
    </div>
</div>
        --}}
        {{-- #==== NEWLY ADDED (matches DSD's captcha layout: the target-number line moves into the field column instead of the narrow label column, where it was wrapping awkwardly onto two lines on mobile) ==== --}}
        <div class="row mb-3">
    <label class="col-lg-4 col-form-label">Captcha<i style="color:red;">*</i></label>
    <div class="col-lg-8">
        <span style="color:#144d8f; font-weight:600;">Please select the number: <strong id="captcha-target">?</strong></span>
        <div id="captcha-options" class="captcha-grid"></div>
        <input type="hidden" name="captcha" id="captcha">
        <small id="captcha-help" class="invalid-msg">Wrong number selected. Please try again.</small>
        @if ($errors->has('captcha'))
            <span class="text-danger">{{$errors->first('captcha')}}</span>
        @endif
    </div>
</div>

<style>
    .captcha-grid { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px; }

    .captcha-btn {
        min-width: 44px;
        height: 42px;
        padding: 0 12px;
        border-radius: 8px;
        border: 1.5px solid #c9def2;
        background: #e6f1fb;
        color: #0c2f5e;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.15s ease, background-color 0.15s ease, border-color 0.15s ease, color 0.15s ease;
    }

    .captcha-btn:hover { transform: translateY(-1px); }

    .captcha-btn.is-correct {
        background: #0c2f5e;
        border-color: #0c2f5e;
        color: #ffffff;
        box-shadow: 0 0 0 4px rgba(240, 180, 41, 0.35);
    }

    .captcha-btn.is-wrong {
        background: #fdecec;
        border-color: #f7c6c2;
        color: #b42318;
    }

    .invalid-msg { color: #dc2626; font-size: 12.5px; display: none; margin-top: 6px; }

    /* #==== NEWLY ADDED (with the field column now only ~62% wide on mobile, 5 fixed-min-width captcha buttons no longer fit on one line and wrapped to a second row — shrinking the min-width/padding/gap lets all of them sit in a single row) ==== */
    @media (max-width: 560px) {
        .captcha-grid { flex-wrap: nowrap; gap: 5px; }
        .captcha-btn { min-width: 0; flex: 1 1 0; padding: 0 4px; font-size: 13px; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const targetEl = document.getElementById('captcha-target');
        const optionsEl = document.getElementById('captcha-options');
        const helpEl = document.getElementById('captcha-help');
        const captchaInput = document.getElementById('captcha');
        let requiredNumber = null;
        let captchaPassed = false;

        function rand(min, max) { return Math.floor(Math.random() * (max - min + 1)) + min; }

        function newCaptcha() {
            captchaPassed = false;
            captchaInput.value = '';
            requiredNumber = rand(1, 10);
            targetEl.textContent = requiredNumber;

            const set = new Set([requiredNumber]);
            while (set.size < 5) set.add(rand(1, 10));
            const options = Array.from(set).sort(() => Math.random() - 0.5);

            optionsEl.innerHTML = '';
            options.forEach(n => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'captcha-btn';
                btn.textContent = n;
                btn.dataset.val = n;
                btn.addEventListener('click', function () {
                    if (parseInt(this.dataset.val, 10) === requiredNumber) {
                        captchaPassed = true;
                        captchaInput.value = this.dataset.val;
                        helpEl.style.display = 'none';
                        optionsEl.querySelectorAll('button').forEach(b => b.classList.remove('is-correct', 'is-wrong'));
                        this.classList.add('is-correct');
                    } else {
                        captchaPassed = false;
                        helpEl.style.display = 'block';
                        optionsEl.querySelectorAll('button').forEach(b => b.classList.remove('is-correct', 'is-wrong'));
                        this.classList.add('is-wrong');
                        setTimeout(newCaptcha, 400);
                    }
                });
                optionsEl.appendChild(btn);
            });
        }
        newCaptcha();

        const form = document.querySelector('form[action="{{ route('moeevent.moeevent.store') }}"]');
        if (form) {
            form.addEventListener('submit', function (e) {
                if (!captchaPassed) {
                    e.preventDefault();
                    helpEl.style.display = 'block';
                    newCaptcha();
                    return false;
                }
            });
        }
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

  {{-- #==== ORI CODE ====

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

  #====== NEWLY ADDED (select2 initializers dropped along with select2/jQuery in the head) ==== --}}
  {{-- #====== ========. --}}

</section>


</body>

</html>
