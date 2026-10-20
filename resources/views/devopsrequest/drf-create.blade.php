<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DevOps Request Form</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">

  {{-- #==== ORI CODE ====

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
  </style>

  #====== NEWLY ADDED (dropped the NiceAdmin dashboard chrome/select2/jQuery in favour of a standalone navy-particle page, matching drf-create-new.blade.php) ==== --}}
  <style>
    * { box-sizing: border-box; }

    p { font-size: 14px; margin: 0 0 8px; }

    html, body { height: 100%; }

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
      font-family: -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      display: flex;
      align-items: flex-start;
      justify-content: center;
      padding: 40px 16px;
    }

    #particles-js {
      position: fixed;
      inset: 0;
      z-index: 0;
    }

    .page-col {
      position: relative;
      z-index: 1;
      width: 100%;
      max-width: 680px;
      display: flex;
      flex-direction: column;
    }

    .back-link {
      align-self: flex-start;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 38px;
      height: 38px;
      border-radius: 10px;
      background: #0c2f5e;
      border: 1.5px solid #ffffff;
      color: #ffffff;
      text-decoration: none;
      font-size: 18px;
      margin-bottom: 12px;
      transition: background-color 0.2s ease;
    }

    .back-link:hover { background: #144d8f; }

    .card {
      width: 100%;
      background: #ffffff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 20px 45px rgba(4, 18, 40, 0.45);
      padding: 32px 36px 36px;
    }

    .logo-row { text-align: center; margin-bottom: 18px; }

    .moe-logo { max-width: 190px; width: 60%; height: auto; margin: 0 auto; }

    .title-row { text-align: center; }

    .card-title {
      display: inline-block;
      font-weight: 700;
      font-size: 18px;
      color: #0c2f5e;
      letter-spacing: 0.3px;
      text-transform: uppercase;
      padding-bottom: 10px;
      position: relative;
    }

    .card-title::after {
      content: "";
      position: absolute;
      left: 50%;
      bottom: 0;
      width: 46px;
      height: 3px;
      border-radius: 2px;
      background: #f0b429;
      transform: translateX(-50%);
    }

    .intro-text {
      text-align: justify;
      color: #5b6188;
      font-size: 13.5px;
      line-height: 1.6;
      margin-top: 16px;
    }

    .download-row {
      text-align: center;
      margin-bottom: 8px;
    }

    .download-row a {
      color: #144d8f;
      font-weight: 600;
      font-size: 13.5px;
      text-decoration: underline;
    }

    hr { border: none; border-top: 1px solid rgba(12, 47, 94, 0.12); margin: 18px 0 22px; }

    .field-row {
      display: flex;
      gap: 16px;
      align-items: flex-start;
      margin-bottom: 16px;
      flex-wrap: wrap;
    }

    .field-label {
      flex: 0 0 170px;
      padding-top: 9px;
      font-weight: 600;
      font-size: 14px;
      color: #4a90d9;
    }

    .field-label .req { color: #dc2626; margin-left: 2px; }

    .field-control { flex: 1 1 260px; }

    .field-hint {
      display: block;
      font-size: 12px;
      color: #5b6188;
      margin-top: 4px;
    }

    input, select, textarea {
      width: 100%;
      font: inherit;
      font-size: 14px;
      border: 1.5px solid #c9def2;
      border-radius: 8px;
      padding: 10px 14px;
      color: #1f2d3d;
      background: #e6f1fb;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    textarea { height: 90px; resize: vertical; font-family: inherit; }

    input:focus, select:focus, textarea:focus {
      outline: none;
      border-color: #144d8f;
      box-shadow: 0 0 0 4px rgba(20, 77, 143, 0.15);
    }

    input[type="file"] {
      background: transparent;
      border: none;
      padding: 0;
    }

    #file-dropzone {
      border: 1.5px dashed #9fc2ea;
      border-radius: 8px;
      background: #e6f1fb;
      padding: 18px 14px;
      text-align: center;
      cursor: pointer;
      transition: border-color 0.2s ease, background-color 0.2s ease;
    }

    #file-dropzone:hover { border-color: #144d8f; background: #dcecfb; }

    #file-dropzone span {
      display: block;
      font-size: 13px;
      color: #5b6188;
      margin-bottom: 10px;
    }

    .submit-row { text-align: center; margin-top: 24px; }

    button[type="submit"] {
      background: #0c2f5e;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 10px 36px;
      font: inherit;
      font-weight: 600;
      font-size: 15px;
      letter-spacing: 0.3px;
      cursor: pointer;
      transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    }

    button[type="submit"]:hover { background: #144d8f; transform: translateY(-1px); box-shadow: 0 10px 20px rgba(4, 18, 40, 0.3); }
    button[type="submit"]:focus { box-shadow: 0 0 0 4px rgba(240, 180, 41, 0.35); }

    .alert {
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 13.5px;
      margin-bottom: 16px;
    }

    .alert-success { background: #e7f7ee; color: #146c43; border: 1px solid #bfe8d1; }
    .alert-danger { background: #fdecec; color: #b42318; border: 1px solid #f7c6c2; }
    .alert-danger ul { margin: 6px 0 0; padding-left: 18px; }
    .help-block { color: #dc2626; font-size: 12px; margin: 4px 0 0; }

    @media (max-width: 560px) {
      body { padding: 24px 12px; }

      .card { padding: 24px 20px 28px; border-radius: 14px; }

      .card-title { font-size: 16px; }

      .field-row { flex-direction: column; gap: 6px; }

      .field-label { flex: none; padding-top: 0; }

      .field-control { flex: 1 1 auto; }

      input, select, textarea { font-size: 16px; }

      button[type="submit"] { width: 100%; }
    }
  </style>
  {{-- #====== ========. --}}

</head>

<body>

  {{-- #====== NEWLY ADDED (particles background to match drf-create-new.blade.php) ==== --}}
  <div id="particles-js"></div>

  <div class="page-col">
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
    <div class="pagetitle">
      <h1></h1>
    </div><!-- End Page Title -->

    #====== NEWLY ADDED (back button now leads to the DRF admin index, styled to match drf-create-new.blade.php) ==== --}}
    @auth
      <a href="{{ route('devops-request.indexadmin') }}" class="back-link">&larr;</a>
    @endauth
    {{-- #====== ========. --}}

  <div class="card">
    {{-- #====== NEWLY ADDED (real MOE logo + gold-underlined title, replacing the plain dashboard h3) ==== --}}
    <div class="logo-row">
      <img src="{{ asset('img/moe-logo-latest-compressed.png') }}" alt="MOE Logo" class="moe-logo">
    </div>

    <div class="title-row">
      <header class="card-title">DevOps Request Form</header>
    </div>
    {{-- #====== ========. --}}

    {{-- #==== ORI CODE ====

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
        <div class="card recent-sales" style="padding-left: 20px; padding-right: 20px;">

          <div class="card-body">

            <div class="profile-overview pt-3">

    #====== NEWLY ADDED --}}
    @if (Session::has('success_message'))
      <div class="alert alert-success">
        {{ Session::get('success_message') }}
      </div>
    @endif
    {{-- #====== ========. --}}

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

          <form method="post" action="{{ route('devops-request.store') }}" enctype="multipart/form-data">
          @csrf

            {{-- #==== ORI CODE ====

            <!-- <div class="col profile-overview" style="border: 8px solid #012970; padding: 20px; border-radius: 25px;"> -->
              <h3 class="card-title" style="padding: 0px;">DevOps Request Form</i></h3>

            #====== NEWLY ADDED (title moved above the form into the new logo/title block) ==== --}}
            {{-- #====== ========. --}}
            <p class="intro-text">Jabatan Teknologi Maklumat memohon kerjasama Pengiran / Tuan / Puan untuk
              membuat pengemaskinian atau menghadapakan inisiatif / projek pendigitalan perkhidmatan yang dapat
              ditawarkan oleh Jabatan - Jabatan di bawah Kementerian Pendidikan secara dalaman (internal services)
              atau kepada orang awam. Pihak Jabatan boleh menghadapkan lebih dari satu inisiatif atau projek pendigitalan
              perkhidmatan yang diperlukan.</p>

            <div class="download-row">
              <a href="http://127.0.0.1:8000/DevOpsRequestForm(DRF).docx">Muat Turun Borang DevOps</a>
            </div>

            <hr>

            {{-- #==== ORI CODE ====

              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Jabatan:</label>
                <div class="col-sm-8">
                  <select class="form-select" name="jabatan" aria-label="Default select example" id="myselect" required>
                  <option selected hidden>Pilih Jabatan</option>
                      @foreach ($departments as $department)
                      <option value="{{ $department['label'] }}">
                          {{ $department['label'] }}
                      </option>
                      @endforeach
                  </select>

                  {!! $errors->first('jabatan', '<p class="help-block text-danger">:message</p>')!!}
                </div>
              </div>

            #====== NEWLY ADDED (row/col-sm layout swapped for the field-row/field-label/field-control layout; select2 dropped in favour of the plain styled select) ==== --}}
            <div class="field-row">
              <label class="field-label">Jabatan<span class="req">*</span></label>
              <div class="field-control">
                <select name="jabatan" required>
                  <option value="" selected hidden>Pilih Jabatan</option>
                  @foreach ($departments as $department)
                    <option value="{{ $department['label'] }}">{{ $department['label'] }}</option>
                  @endforeach
                </select>
                {!! $errors->first('jabatan', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            {{-- #====== ========. --}}

            <div class="field-row">
              <label class="field-label">Bahagian/Unit</label>
              <div class="field-control">
                <input type="text" name="bahagian_unit" placeholder="Bahagian/Unit">
              </div>
            </div>

            <div class="field-row">
              <label class="field-label">Nama Projek</label>
              <div class="field-control">
                <input type="text" name="nama_projek" placeholder="Nama Projek">
              </div>
            </div>

            <div class="field-row">
              <label class="field-label">Jawatan</label>
              <div class="field-control">
                <input type="text" name="jawatan" placeholder="Jawatan">
              </div>
            </div>

            <div class="field-row">
              <label class="field-label">Perkhidmatan<span class="req">*</span></label>
              <div class="field-control">
                <select name="perkhidmatan" required>
                  <option value="" selected hidden>Pilih Perkhidmatan</option>
                  <option value="Awam">Awam</option>
                  <option value="Internal">Internal</option>
                </select>
                {!! $errors->first('perkhidmatan', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="field-row">
              <label class="field-label">Huraian<span class="req">*</span></label>
              <div class="field-control">
                <textarea
                  name="huraian"
                  id="huraian"
                  placeholder="Huraian projek"
                  maxlength="3000"
                  required
                  oninput="updateCharCount()"
                ></textarea>
                <span class="field-hint" id="charCount">0 / 3000 characters used (including spaces and punctuation)</span>
                {!! $errors->first('huraian', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="field-row">
              <label class="field-label">Tarikh Diperlukan</label>
              <div class="field-control">
                <input type="date" name="tarikh_diperlukan">
              </div>
            </div>

            {{-- #==== ORI CODE ====

                <div class="row">
                    <div class="col-lg-4 col-md-3  label">Muat Naik Fail<br><i style="color:black; font-size: 13px;">*.PDF, .DOC, .DOCX, .PPT atau .PPTX</i> </div>
                    <div class="col-lg-8 col-md-9" id="file-dropzone" class="dropzone">
                        <span>Drag and drop files here or click to browse</span>
                        <input type="file" name="uploaded_doc[]" accept=".pdf,.doc,.docx,.ppt,.pptx" multiple>
                    </div>
                </div>

                <style>
                    #file-dropzone {
                        border: 3px dashed #ccc;
                        border-radius: 4px;
                        padding: 10px;
                        text-align: center;
                        cursor: pointer;
                        margin-bottom: 10px;
                    }
                </style>

            #====== NEWLY ADDED (dropzone box moved into the field-row layout; its styling now lives in the shared <style> block above) ==== --}}
            <div class="field-row">
              <label class="field-label">Muat Naik Fail
                <span class="field-hint">*.PDF, .DOC, .DOCX, .PPT atau .PPTX</span>
              </label>
              <div class="field-control">
                <div id="file-dropzone" class="dropzone">
                  <span>Drag and drop files here or click to browse</span>
                  <input type="file" name="uploaded_doc[]" accept=".pdf,.doc,.docx,.ppt,.pptx" multiple>
                </div>
              </div>
            </div>
            {{-- #====== ========. --}}

            <hr>

            <div class="field-row">
              <label class="field-label">Penyelaras Projek<span class="req">*</span></label>
              <div class="field-control">
                <input type="text" name="penyelaras_projek" placeholder="Nama Penyelaras Projek" required>
                {!! $errors->first('penyelaras_projek', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="field-row">
              <label class="field-label">Emel<span class="req">*</span></label>
              <div class="field-control">
                <input type="email" name="emel" placeholder="example@moe.gov.bn" required>
                {!! $errors->first('emel', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="field-row">
              <label class="field-label">Nombor telefon</label>
              <div class="field-control">
                <input type="tel" name="tel_no" placeholder="Eg. 8888888" pattern="[0-9]{7}">
                {!! $errors->first('tel_no', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="submit-row">
              <button type="submit">Hantar</button>
            </div>
          </form>
  </div>
  </div>

  {{-- #==== ORI CODE ====
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

</section>
  #====== NEWLY ADDED (select2 initializer dropped along with select2/jQuery in the head) ==== --}}
  {{-- #====== ========. --}}

  <!-- Dropzone.js for the file upload field -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
  <script>
    Dropzone.options.fileDropzone = {
      paramName: "dc_file",
      maxFilesize: 2,
      addRemoveLinks: true,
      init: function () {
        this.on("success", function (file, response) {
          console.log(response);
        });
        this.on("removedfile", function (file) {
          console.log(file);
        });
      },
    };

    function updateCharCount() {
      const textarea = document.getElementById('huraian');
      const charCount = document.getElementById('charCount');
      const currentLength = textarea.value.length;
      charCount.textContent = `${currentLength} / 3000 characters used (including spaces and punctuation)`;
    }

    document.addEventListener('DOMContentLoaded', updateCharCount);
  </script>

  {{-- Particles JS --}}
  <script src="{{ asset('js/particles.min.js') }}"></script>
  <script>
    particlesJS("particles-js", {"particles":{"number":{"value":100,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});
  </script>

</body>

</html>
