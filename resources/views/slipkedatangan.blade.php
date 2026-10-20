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
      background: #0c2f5e;
      background-image:
        radial-gradient(circle, rgba(255, 255, 255, 0.07) 1px, transparent 1px),
        linear-gradient(155deg, #081f42 0%, #0c2f5e 45%, #144d8f 100%);
      background-size: 24px 24px, cover;
      background-attachment: fixed;
      font-family: "Poppins", "Open Sans", sans-serif;
    }

    #particles-js {
      position: fixed;
      inset: 0;
      z-index: 0;
    }

    .section.register {
      position: relative;
      z-index: 1;
    }

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
      padding-bottom: 10px;
      position: relative;
    }

    .section.register .card-title::after {
      content: "";
      position: absolute;
      left: 0;
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

    .section.register .form-control,
    .section.register .form-select {
      border: 1.5px solid #dde3ea;
      border-radius: 8px;
      padding: 10px 14px;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

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
  </style>

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

          <form class="" method="post" action="{{ route('sk.slipkedatangan.store') }}" enctype="multipart/form-data">
          @csrf

            <br>


            <!-- <div class="col profile-overview" style="border: 8px solid #012970; padding: 20px; border-radius: 25px;"> -->
              <center><img src="img\moe-logo-latest-compressed.png" class="d-block w-75" alt="MOE LOGO"></center>
              <br>
              <header class="card-title" style="padding: 0px; font-size: 18px;">Slip Kehadiran</header>
              
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

   
</body>

</html>
