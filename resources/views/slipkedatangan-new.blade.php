<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Slip Kedatangan</title>
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

    html, body {
      height: 100%;
    }

    body {
      margin: 0;
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
      /* #==== ORI CODE ====
      background: #0c2f5e;
      background-image:
        radial-gradient(circle, rgba(255, 255, 255, 0.07) 1px, transparent 1px),
        linear-gradient(155deg, #081f42 0%, #0c2f5e 45%, #144d8f 100%);
      background-size: 24px 24px, cover;
      background-attachment: fixed;
      */
      /* #==== NEWLY ADDED ==== */
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

    #====== NEWLY ADDED (this section spans the full viewport with z-index above the particles canvas, so it was silently blocking hover/click from ever reaching the particles behind it — pointer-events:none lets those pass through, restored only on the actual content column) ==== */
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
    /* #====== ========. */

    /* #==========ORI CODE=========
    .section.register .form-control,
    .section.register .form-select {
      background: #e6f1fb;
      border: 1.5px solid #c9def2;
      border-radius: 8px;
      padding: 10px 14px;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    #==========NEWLY ADDED======== (darker field background/border, matching the DRF form) */
    .section.register .form-control,
    .section.register .form-select {
      background: #cfe2f5;
      border: 1.5px solid #a9c9e8;
      border-radius: 8px;
      padding: 10px 14px;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    /* =========================== */

    /* #==========NEWLY ADDED======== (explicit black field text, matching drf/dsd/mea forms) */
    .section.register .form-control,
    .section.register .form-select {
      color: #000000;
    }
    /* =========================== */

    /* #==========NEWLY ADDED======== (browser dims ::placeholder text by default regardless of the input's own color) */
    .section.register ::placeholder { color: #000000; opacity: 1; }
    .section.register .form-select option { color: #000000; }
    /* =========================== */

    /* #==========ORI CODE=========
    .section.register .form-control:-webkit-autofill,
    .section.register .form-control:-webkit-autofill:hover,
    .section.register .form-control:-webkit-autofill:focus {
      -webkit-text-fill-color: #000000;
      box-shadow: 0 0 0 1000px #cfe2f5 inset;
      transition: background-color 5000s ease-in-out 0s;
    }
    #==========NEWLY ADDED======== (Chrome's autofill styling wins over an un-!important override, and can persist through :active too — this is the standard "!important on every autofill pseudo-class" fix) */
    .section.register .form-control:-webkit-autofill,
    .section.register .form-control:-webkit-autofill:hover,
    .section.register .form-control:-webkit-autofill:focus,
    .section.register .form-control:-webkit-autofill:active {
      -webkit-text-fill-color: #000000 !important;
      -webkit-box-shadow: 0 0 0 1000px #cfe2f5 inset !important;
      box-shadow: 0 0 0 1000px #cfe2f5 inset !important;
      caret-color: #000000;
      transition: background-color 5000s ease-in-out 0s;
    }
    /* =========================== */

    .section.register .form-control:focus,
    .section.register .form-select:focus {
      border-color: #144d8f;
      box-shadow: 0 0 0 4px rgba(20, 77, 143, 0.15);
    }

    /* #====== NEWLY ADDED (Select2 replaces the native Jabatan <select> with its own markup that bypasses .form-select entirely, so it rendered as a plain white box instead of matching the light-blue fill/border every other field uses — this repaints the Select2 widget to match) ==== */
    /* #====== ========. */

    /* #==========ORI CODE=========
    .section.register .select2-container--default .select2-selection--single {
      background: #e6f1fb;
      border: 1.5px solid #c9def2;
      border-radius: 8px;
      height: calc(1.5em + 0.75rem + 3px);
      padding: 5px 14px;
    }
    #==========NEWLY ADDED======== (darker field background/border, matching the DRF form) */
    .section.register .select2-container--default .select2-selection--single {
      background: #cfe2f5;
      border: 1.5px solid #a9c9e8;
      border-radius: 8px;
      height: calc(1.5em + 0.75rem + 3px);
      padding: 5px 14px;
    }
    /* =========================== */

    /* #==========ORI CODE=========
    .section.register .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: #212529;
      line-height: 1.9;
    }
    #==========NEWLY ADDED======== (pure black, matching the rest of the field text) */
    .section.register .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: #000000;
      line-height: 1.9;
    }
    /* =========================== */

    .section.register .select2-container--default.select2-container--focus .select2-selection--single,
    .section.register .select2-container--default.select2-container--open .select2-selection--single {
      border-color: #144d8f;
      box-shadow: 0 0 0 4px rgba(20, 77, 143, 0.15);
    }

    .section.register .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 100%;
    }
    /* #====== ========. */

    /* #==========NEWLY ADDED======== (select2.min.css ships its own gray for the empty/placeholder state via a separate .select2-selection__placeholder class, which our .select2-selection__rendered override above doesn't match, so "Pilih Jabatan"/"Pilih Peranan" stayed gray until a value was picked) */
    .section.register .select2-container--default .select2-selection--single .select2-selection__placeholder {
      color: #000000;
    }
    /* =========================== */

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

    /* #==== NEWLY ADDED (the back button sits outside .section.register, so it missed the navy styling above and used Bootstrap's default blue instead) ==== */
    .btn-primary {
      background: #0c2f5e;
      /* #==== NEWLY ADDED (white border for visibility) ==== */
      border: 1.5px solid #ffffff;
      border-radius: 8px;
    }

    .btn-primary:hover {
      background: #144d8f;
    }

    .btn-primary:focus {
      box-shadow: 0 0 0 4px rgba(240, 180, 41, 0.35);
    }

    .section.register hr {
      opacity: 0.12;
    }

    /* #==== NEWLY ADDED ==== */
    @media (max-width: 991px) {
      .section.register .container { padding-left: 10px; padding-right: 10px; }
      .section.register .card { margin: 0; }
    }

    /* #==== NEWLY ADDED ==== */
    @media (max-width: 560px) {
      .section.register .container { padding-left: 6px; padding-right: 6px; }
      .section.register .col-12 .card { padding-left: 10px !important; padding-right: 10px !important; }
      .section.register .card-body { padding: 12px; }
      .section.register .card-title { font-size: 16px; }
      .section.register center img { width: 55% !important; max-width: 150px !important; }
      .section.register .row.mb-3 { margin-bottom: 10px !important; }
      .section.register .col-form-label { padding-bottom: 4px; }
      .section.register .form-control,
      .section.register .form-select,
      .section.register .select2-container { font-size: 16px !important; }
      .section.register .btn-primary { width: 100%; }
    }

    /* #==== ORI CODE ====
    (no rule existed for keeping the label and field side by side below the lg breakpoint)
    */
    /* #==== NEWLY ADDED (the label and its field only carry col-lg-* classes, which Bootstrap only applies at the lg breakpoint and up — below that, with no base width, they were shrinking to their content's width and wrapping onto separate lines instead of sitting side by side like on desktop; this keeps them on one row at every width, label taking a third, field taking the rest) ==== */
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
      .section.register .form-select,
      .section.register .select2-container { width: 100% !important; }
    }
  </style>

  {{-- #========== NEWLY ADDED ============ --}}
  {{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026. Only applies when the sun/moon is on dark; --}}
  {{-- light mode is unchanged. Same page background design, a little darker. --}}
  <style>
    html[data-mesh-theme="dark"] body {
      background-image:
        radial-gradient(circle, rgba(255, 255, 255, 0.07) 1px, transparent 1.4px),
        radial-gradient(ellipse 900px 600px at 20% 10%, rgba(79, 70, 229, 0.14), transparent 60%),
        radial-gradient(ellipse 800px 700px at 85% 85%, rgba(206, 17, 38, 0.08), transparent 55%),
        linear-gradient(150deg, #060414 0%, #080618 45%, #0e0b2c 100%);
      background-color: #060414;
    }
    html[data-mesh-theme="dark"] .mesh-sa-row .btn-primary { background-color: #6d4bc4; border-color: #6d4bc4; }
    html[data-mesh-theme="dark"] .mesh-sa-row .btn-primary:hover { background-color: #7c5cdb; border-color: #7c5cdb; }
    html[data-mesh-theme="dark"] .section.register .card { background: #1c1340; border: 1px solid #3a2768; color: #e8eaf4; box-shadow: 0 1px 2px rgba(0,0,0,.3), 0 8px 24px rgba(0,0,0,.35); }
    html[data-mesh-theme="dark"] .section.register center img { background: #ffffff; border-radius: 12px; padding: 10px 14px; }
    html[data-mesh-theme="dark"] .section.register .card-title { color: #f3c35f; }
    /* #============= ORI CODE ============== */
    /* html[data-mesh-theme="dark"] .section.register hr { border-top-color: #3a2768; opacity: 1; } */
    /* #================================ */
    /* Bootstrap draws this line with a background colour, so it is set too */
    html[data-mesh-theme="dark"] .section.register hr { border-top-color: #3a2768; color: #3a2768; background-color: #3a2768; opacity: 1; }
    /* #================================ */
    html[data-mesh-theme="dark"] .section.register .col-form-label { color: #c4b5fd; }
    html[data-mesh-theme="dark"] .section.register .col-form-label i { color: #f87171 !important; }
    html[data-mesh-theme="dark"] .section.register .form-control,
    html[data-mesh-theme="dark"] .section.register .form-select { background-color: #140d30; border-color: #3a2768; color: #e8eaf4; color-scheme: dark; }
    html[data-mesh-theme="dark"] .section.register .form-select { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23c4b5fd' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e"); }
    html[data-mesh-theme="dark"] .section.register .form-select option { background: #1c1340; color: #e8eaf4; }
    html[data-mesh-theme="dark"] .section.register .form-control::placeholder { color: #7d84a3; }
    html[data-mesh-theme="dark"] .section.register .form-control:hover,
    html[data-mesh-theme="dark"] .section.register .form-select:hover,
    html[data-mesh-theme="dark"] .section.register .form-control:focus,
    html[data-mesh-theme="dark"] .section.register .form-select:focus { border-color: #6d4bc4; }
    html[data-mesh-theme="dark"] .section.register .form-control:focus,
    html[data-mesh-theme="dark"] .section.register .form-select:focus { box-shadow: 0 0 0 4px rgba(109, 75, 196, 0.3); }
    html[data-mesh-theme="dark"] .section.register .form-check-input { background-color: #140d30; border-color: #4a3590; }
    html[data-mesh-theme="dark"] .section.register .form-check-input:checked { background-color: #6d4bc4; border-color: #6d4bc4; }
    html[data-mesh-theme="dark"] .section.register .form-check-label { color: #9aa2bd; }
    html[data-mesh-theme="dark"] .section.register .btn-primary { background: #6d4bc4; }
    html[data-mesh-theme="dark"] .section.register .btn-primary:hover { background: #7c5cdb; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4); }
    html[data-mesh-theme="dark"] .section.register .help-block.text-danger { color: #f87171 !important; }
    html[data-mesh-theme="dark"] .alert-success { background: rgba(52, 211, 153, 0.12); color: #6ee7b7; border-color: rgba(52, 211, 153, 0.45); }
    html[data-mesh-theme="dark"] .alert-danger { background: rgba(248, 113, 113, 0.12); color: #fca5a5; border-color: rgba(248, 113, 113, 0.45); }
    /* Jabatan / Peranan dropdowns (select2) */
    html[data-mesh-theme="dark"] .section.register .select2-container--default .select2-selection--single { background-color: #140d30; border-color: #3a2768; }
    html[data-mesh-theme="dark"] .section.register .select2-container--default .select2-selection--single .select2-selection__rendered { color: #e8eaf4; }
    html[data-mesh-theme="dark"] .section.register .select2-container--default .select2-selection--single .select2-selection__placeholder { color: #7d84a3; }
    html[data-mesh-theme="dark"] .section.register .select2-container--default .select2-selection--single .select2-selection__arrow b { border-top-color: #c4b5fd; }
    html[data-mesh-theme="dark"] .section.register .select2-container--default.select2-container--disabled .select2-selection--single { background-color: #1f1548; }
    html[data-mesh-theme="dark"] .select2-dropdown { background: #1c1340; border-color: #3a2768; color: #e8eaf4; }
    html[data-mesh-theme="dark"] .select2-search--dropdown .select2-search__field { background: #140d30; border-color: #3a2768; color: #e8eaf4; }
    html[data-mesh-theme="dark"] .select2-container--default .select2-results__option[aria-selected=true] { background: #2a1d5c; }
    html[data-mesh-theme="dark"] .select2-container--default .select2-results__option--highlighted[aria-selected] { background: #6d4bc4; color: #ffffff; }
  </style>
  @include('inc.standalone-theme-head')
  {{-- #================================ --}}

</head>

<body>

  {{-- Particles JS --}}
  <div id="particles-js"></div>

  {{-- Particles JS CDN --}}
  <script src="{{ asset('js/particles.min.js') }}"></script>

  {{-- Particles JS Initializer --}}
  <script>
    particlesJS("particles-js", {"particles":{"number":{"value":100,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});
  </script>

{{-- #============= ORI CODE ============== --}}
{{--  <!-- Back Button - Only visible when user is logged in --> --}}
{{--  @auth   --}}
{{--         <div class="container" style="padding-top: 20px;"> --}}
{{--           <div class="row justify-content-center"> --}}
{{--             <div class="col-lg-8"> --}}
{{--               <a href="https://mesh.moe.gov.bn/servicesdashboard" class="btn btn-primary" style="margin-bottom: 10px;"> --}}
{{--                 <i class="bi bi-arrow-left"></i>  --}}
{{--               </a> --}}
{{--             </div> --}}
{{--           </div> --}}
{{--         </div> --}}
{{--         @endauth --}}
{{-- #================================ --}}
{{-- Row above the form: back button on the left (logged-in users only, as before), EN/BM + sun/moon on the right (everyone) --}}
<div class="container" style="padding-top: 20px; position: relative; z-index: 2;">
  <div class="row justify-content-center">
    <div class="col-lg-8 mesh-sa-row d-flex align-items-center" style="margin-bottom: 10px;">
      @auth
      <a href="{{ route('sk.slipkedatangan.indexadmin') }}" class="btn btn-primary">
        <i class="bi bi-arrow-left"></i>
      </a>
      @endauth
      @include('inc.standalone-switches')
    </div>
  </div>
</div>
{{-- #================================ --}}
{{-- #==== ORI CODE ====
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
--}}
{{-- #==== NEWLY ADDED (dropped justify-content-center, the vertical-centering axis in a flex-column, so tall form never clips at the top on short/laptop viewports) ==== --}}
<section class="section register min-vh-100 d-flex flex-column align-items-center py-4">
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
              Upload Validation Error<br><br>
              <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif

          <form class="" method="post" action="{{ route('sk.slipkedatangan.store') }}" enctype="multipart/form-data">
          @csrf

            <br>


            <!-- <div class="col profile-overview" style="border: 8px solid #012970; padding: 20px; border-radius: 25px;"> -->
              <center><img src="img\moe-logo-latest-compressed.png" class="d-block" style="max-width: 190px; width: 60%; margin: 0 auto;" alt="MOE LOGO"></center>
              <br>
              <div style="text-align: center;">
                <header class="card-title" style="padding: 0px; font-size: 18px;">Slip Kehadiran</header>
              </div>
              
              <!-- <p style="text-align: justify;">Jabatan Pentadbiran dan Perkhidmatan-Perkhidmatan memohon kerjasama Pengiran / Tuan / Puan untuk 
              membuat pengemaskinian atau menghadapakan inisiatif / projek pendigitalan perkhidmatan yang dapat 
              ditawarkan oleh Jabatan - Jabatan di bawah Kementerian Pendidikan secara dalaman (internal services) 
              atau kepada orang awam. Pihak Jabatan boleh menghadapkan lebih dari satu inisitif atau projek pendigitalan 
              perkhidmatan yang diperlukan.</p> -->
              <hr>
              <form>

              <div class="row mb-3">
                  <label class="col-lg-4 col-form-label">Perkara:<i style="color:red;">*</i></label>
                  <div class="col-lg-8">
                    <select class="form-select" name="perkara" aria-label="Default select example" required>
                      <option value="">Pilih Perkara</option>
                      @foreach ($skperkaras as $skperkara)
                      <option value="{{ $skperkara['label'] }}">
                          {{ $skperkara['label'] }}
                      </option>
                      @endforeach
                    </select>
                    
                    {!! $errors->first('perkara', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

     <div class="row mb-3">
    <label class="col-lg-4 col-form-label">Jabatan:<i style="color:red;">*</i></label>
    <div class="col-lg-8">
        <select class="form-select" name="jabatan" aria-label="Default select example" id="myselect">
            <option value="">Pilih Jabatan</option>
            @foreach ($departments as $department)
                <option value="{{ $department['label'] }}">{{ $department['label'] }}</option>
            @endforeach
        </select>
       
        <input class="form-check-input" type="checkbox" name="other_jabatan_checkbox" id="otherJabatanCheckbox">
            <label class="form-check-label" for="otherJabatanCheckbox"><i>Kementerian Lain (others)</i></label>

            <div id="otherJabatanInput" style="display: none;">
            <input type="text" class="form-control" name="jabatan" placeholder="Enter Other Kementerian">
        </div>
         {!! $errors->first('jabatan', '<p class="help-block text-danger">:message</p>') !!}
    </div>
</div>


<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Checkbox for "Others" option
    var otherJabatanCheckbox = document.getElementById("otherJabatanCheckbox");
    // Div containing the input field for "Others"
    var otherJabatanInput = document.getElementById("otherJabatanInput");
    // Select dropdown for "Jabatan"
    var jabatanSelect = document.getElementById("myselect");

    // Function to toggle visibility and disable input field
    function toggleOtherJabatanInput() {
      if (otherJabatanCheckbox.checked) {
        otherJabatanInput.style.display = "block";
        otherJabatanInput.querySelector("input").removeAttribute("disabled"); // Enable input field
        jabatanSelect.setAttribute("disabled", "disabled"); // Disable select dropdown
      } else {
        otherJabatanInput.style.display = "none";
        otherJabatanInput.querySelector("input").setAttribute("disabled", "disabled"); // Disable input field
        jabatanSelect.removeAttribute("disabled"); // Enable select dropdown
      }
    }

    // Initial call to set input field state based on checkbox state
    toggleOtherJabatanInput();

    otherJabatanCheckbox.addEventListener("change", toggleOtherJabatanInput);
  });
</script>

              <div class="row mb-3">
                  <label for="inputNama" class="col-lg-4 col-form-label">Nama:<i style="color:red;">*</i></label>
                  <div class="col-lg-8">
                    <input type="nama" name="nama" class="form-control" placeholder="Nama penuh" required>

                    {!! $errors->first('nama', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputNama" class="col-lg-4 col-form-label">Peranan:<i style="color:red;">*</i></label>
                    <div class="col-lg-8">
                      <select class="form-select" name="rolelabel" aria-label="Default select example" id="myselect2" required>
                        <option value="">---Pilih Peranan---</option>
                        @foreach ($peranans as $peranan)
                            <option value="{{ $peranan }}">{{ $peranan }}</option>
                        @endforeach
                      </select>
                    </div>
                </div>

     <!--            <div class="row mb-3">
                  <label for="inputJawatan" class="col-lg-4 col-form-label">Jawatan:<i style="color:red;">*</i></label>
                  <div class="col-lg-8">
                    <input type="jawatan" name="jawatan" class="form-control" placeholder="Jawatan" >

                    {!! $errors->first('jawatan', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div> -->

                <div class="row mb-3">
                  <label for="email" class="col-lg-4 col-form-label">Emel:</label>
                  <div class="col-lg-8">
                    <input type="email" name="email" class="form-control" placeholder="example@moe.gov.bn" >

                    {!! $errors->first('email', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div> 

                <div class="row mb-3">
                  <label for="telefon" class="col-lg-4 col-form-label">Nombor telefon:</label>
                  <div class="col-lg-8">
                    <input type="tel" name="telefon" class="form-control" placeholder="Eg. 8888888" pattern="[0-9]{7}">

                    {!! $errors->first('telefon', '<p class="help-block text-danger">:message</p>') !!}
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="remark" class="col-lg-4 col-form-label">Catatan:</label>
                  <div class="col-lg-8">
                    <textarea name="remark" class="form-control" style="height: 100px" placeholder="..." ></textarea>
                    
                    {!! $errors->first('remark', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>


            
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Hantar</button>
            </div>

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


</section>

{{-- #========== NEWLY ADDED ============ --}}
{{-- English / Malay switch (the word list is inside this file) --}}
<script src="{{ asset('js/mesh-lang.js') }}?v={{ filemtime(public_path('js/mesh-lang.js')) }}"></script>
{{-- #================================ --}}

</body>

</html>
