<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Permohonan Peranan</title>
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

  {{-- #========== NEWLY ADDED ============ --}}
  {{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026. Only applies when the sun/moon is on dark; --}}
  {{-- light mode is unchanged. The blue page becomes the dark indigo used on the other forms. --}}
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
      <a href="https://mesh.moe.gov.bn/servicesdashboard" class="btn btn-primary">
        <i class="bi bi-arrow-left"></i>
      </a>
      @endauth
      @include('inc.standalone-switches')
    </div>
  </div>
</div>
{{-- #================================ --}}
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
              Upload Validation Error<br><br>
              <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif

          <form class="" method="post" action="{{ route('permohonanrole.permohonanrole.store') }}" enctype="multipart/form-data">
          @csrf

            <br>


              <center><img src="img\moe-logo-latest-compressed.png" class="d-block w-75" alt="MOE LOGO"></center>
              <br>
              <header class="card-title" style="padding: 0px; font-size: 18px;">Permohonan Peranan MESH</header>
          
              <hr>
              <form>

              <div class="row mb-3">
                  <label for="inputNama" class="col-lg-4 col-form-label">Nama:<i style="color:red;">*</i></label>
                  <div class="col-lg-8">
                    <input type="nama" name="nama" class="form-control" placeholder="Nama penuh" required>

                    {!! $errors->first('nama', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

                <div class="row mb-3">
                <label class="col-lg-4 col-form-label">Jabatan:<i style="color:red;">*</i></label>
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
                  <label for="inputNama" class="col-lg-4 col-form-label">No. Kad Pengenalan:<i style="color:red;">*</i></label>
                  <div class="col-lg-8">
                    <input type="text" name="icno" class="form-control" placeholder="Example : 00123456" required pattern="[0-9]+" required>

                    {!! $errors->first('No Kad Pengenalan', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputTel" class="col-lg-4 col-form-label">Nombor telefon:</label>
                  <div class="col-lg-8">
                    <input type="tel" name="no_tel" class="form-control" placeholder="Eg. 8888888" pattern="[0-9]{7}">

                    {!! $errors->first('telefon', '<p class="help-block text-danger">:message</p>') !!}
                  </div>
                </div>


              <div class="row mb-3">
                  <label class="col-lg-4 col-form-label">Peranan:<i style="color:red;">*</i></label>
                  <div class="col-lg-8">
                    <select class="form-select" name="peranan" aria-label="Default select example" required>
                      <option selected hidden>Pilih Peranan</option>
                      @foreach ($peranan as $item)
                      <option value="{{ $item->label}}">
                          {{ $item->desc }}
                      </option>
                      @endforeach
                    </select>
                    
                    {!! $errors->first('peranan', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div> 
              
             
                <!-- <div class="row mb-3">
                  <label for="inputNama" class="col-lg-4 col-form-label">Peranan:</label>
                    <div class="col-lg-8">
                      <select class="form-select" name="rolelabel" aria-label="Default select example" id="myselect2">
                        <option selected hidden></option>
                        <option value="Pengerusi">Pengerusi</option>
                        <option value="Ahli">Ahli</option>
                        <option value="Setiausaha">Setiausaha</option>
                        <option value="Urusetia">Urusetia</option>
                        <option value="Ketua Jabatan">Ketua Jabatan</option>
                        <option value="Pengerusi">Wakil Jabatan</option>
                      </select>
                    </div>
                </div> -->



                <div class="row mb-3">
                  <label for="inputHurai" class="col-lg-4 col-form-label">Catatan:</label>
                  <div class="col-lg-8">
                    <textarea type="text" name="catatan" class="form-control" style="height: 100px" placeholder="..." ></textarea>
                    
                    {!! $errors->first('catatan', '<p class="help-block text-danger">:message</p>')!!}
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
