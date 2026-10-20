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
      /* #==== ORI CODE ====
      align-items: center;
      */
      /* #==== NEWLY ADDED (top-align so tall forms never clip on short/laptop viewports) ==== */
      align-items: flex-start;
      justify-content: center;
      padding: 40px 16px;
    }

    #particles-js {
      position: fixed;
      inset: 0;
      z-index: 0;
    }

    .back-link {
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 2;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 38px;
      height: 38px;
      border-radius: 999px;
      border: 1.5px solid rgba(255, 255, 255, 0.55);
      color: #ffffff;
      text-decoration: none;
      font-size: 18px;
      transition: background-color 0.2s ease, color 0.2s ease;
    }

    .back-link:hover { background: #ffffff; color: #0c2f5e; }

    .card {
      position: relative;
      z-index: 1;
      width: 100%;
      max-width: 680px;
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

    /* #==== ORI CODE ====
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
    */
    /* #==========ORI CODE=========
    input, select, textarea {
      width: 100%;
      font: inherit;
      font-size: 14px;
      border: 1.5px solid #a9c9e8;
      border-radius: 8px;
      padding: 10px 14px;
      color: #1f2d3d;
      background: #cfe2f5;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    #==========NEWLY ADDED======== */
    input, select, textarea {
      width: 100%;
      font: inherit;
      font-size: 14px;
      border: 1.5px solid #a9c9e8;
      border-radius: 8px;
      padding: 10px 14px;
      color: #000000;
      background: #cfe2f5;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    /* =========================== */

    /* #==========NEWLY ADDED======== (browser dims ::placeholder text by default regardless of the input's own color, which is why placeholders/empty selects still looked grey after the color:#000000 change above) */
    ::placeholder { color: #000000; opacity: 1; }
    select { color: #000000; }
    select option { color: #000000; }
    /* =========================== */

    /* #==========NEWLY ADDED======== (Chrome's autofill/autocomplete-suggestion styling uses -webkit-text-fill-color, which overrides the plain color property, and needs !important on every autofill pseudo-class or Chrome's own internal autofill style still wins — this is why a value picked from the browser's suggestion dropdown rendered gray while manually-typed text stayed black) */
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
      -webkit-text-fill-color: #000000 !important;
      -webkit-box-shadow: 0 0 0 1000px #cfe2f5 inset !important;
      box-shadow: 0 0 0 1000px #cfe2f5 inset !important;
      caret-color: #000000;
      transition: background-color 5000s ease-in-out 0s;
    }
    /* =========================== */

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

    /* #==== ORI CODE ====
    #file-dropzone {
      border: 1.5px dashed #9fc2ea;
      border-radius: 8px;
      background: #e6f1fb;
      padding: 18px 14px;
      text-align: center;
      cursor: pointer;
      transition: border-color 0.2s ease, background-color 0.2s ease;
    }
    */
    /* #==== NEWLY ADDED (matches the darker field background above) ==== */
    #file-dropzone {
      border: 1.5px dashed #7fabd9;
      border-radius: 8px;
      background: #cfe2f5;
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

      /* #==== ORI CODE ====
      .field-row { flex-direction: column; gap: 6px; }

      .field-label { flex: none; padding-top: 0; }

      #====== NEWLY ADDED (260px flex-basis is read as a forced HEIGHT once flex-direction is column, leaving a blank box under each field) ====
      .field-control { flex: 1 1 auto; }
      */
      /* #==== NEWLY ADDED (label and field kept side by side on mobile instead of stacking, matching slipkedatangan-new.blade.php) ==== */
      .field-row { flex-wrap: nowrap; gap: 8px; }

      .field-label { flex: 0 0 34%; max-width: 34%; padding-top: 9px; font-size: 12.5px; }

      .field-control { flex: 1 1 auto; }

      input, select, textarea { font-size: 16px; }

      button[type="submit"] { width: 100%; }
    }
  </style>

  {{-- #========== NEWLY ADDED ============ --}}
  {{-- Row above the card: back button on the left (logged-in users), EN/BM + sun/moon on the right; replaces the --}}
  {{-- round back arrow that was fixed in the top-left corner. Plus dark mode in the Home page theme (purple/gold), --}}
  {{-- chosen Oct 2026: only applies when the sun/moon is on dark. Same page background design, a little darker. --}}
  <style>
    body { flex-direction: column; align-items: center; }
    .card { flex-shrink: 0; }
    .mesh-sa-toprow { position: relative; z-index: 2; display: flex; align-items: center; gap: 10px; width: 100%; max-width: 680px; margin: 0 0 14px; flex-shrink: 0; }
    .mesh-sa-back { width: 46px; height: 40px; border-radius: 8px; background: #0c2f5e; color: #ffffff; display: grid; place-items: center; font-size: 18px; text-decoration: none; flex: none; transition: background-color 0.2s ease; }
    .mesh-sa-back:hover { background: #144d8f; color: #ffffff; }

    html[data-mesh-theme="dark"] body {
      background-image:
        radial-gradient(circle, rgba(255, 255, 255, 0.07) 1px, transparent 1.4px),
        radial-gradient(ellipse 900px 600px at 20% 10%, rgba(79, 70, 229, 0.14), transparent 60%),
        radial-gradient(ellipse 800px 700px at 85% 85%, rgba(206, 17, 38, 0.08), transparent 55%),
        linear-gradient(150deg, #060414 0%, #080618 45%, #0e0b2c 100%);
      background-color: #060414;
    }
    html[data-mesh-theme="dark"] .mesh-sa-back { background: #6d4bc4; }
    html[data-mesh-theme="dark"] .mesh-sa-back:hover { background: #7c5cdb; }
    html[data-mesh-theme="dark"] .card { background: #1c1340; border: 1px solid #3a2768; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3), 0 8px 24px rgba(0, 0, 0, 0.35); color: #e8eaf4; }
    html[data-mesh-theme="dark"] .moe-logo { background: #ffffff; border-radius: 12px; padding: 10px 14px; box-sizing: content-box; }
    html[data-mesh-theme="dark"] .card-title { color: #f3c35f; }
    html[data-mesh-theme="dark"] .intro-text, html[data-mesh-theme="dark"] .field-hint { color: #9aa2bd; }
    html[data-mesh-theme="dark"] .download-row a { color: #f3c35f; }
    html[data-mesh-theme="dark"] hr { border-top-color: #3a2768; }
    html[data-mesh-theme="dark"] .field-label { color: #c4b5fd; }
    html[data-mesh-theme="dark"] .field-label .req { color: #f87171; }
    html[data-mesh-theme="dark"] .field-control > span:not(.field-hint) { color: #e8eaf4; }
    html[data-mesh-theme="dark"] #captcha-target { color: #f3c35f; }
    html[data-mesh-theme="dark"] .card input, html[data-mesh-theme="dark"] .card select, html[data-mesh-theme="dark"] .card textarea { background: #140d30; border-color: #3a2768; color: #e8eaf4; color-scheme: dark; }
    html[data-mesh-theme="dark"] .card input::placeholder, html[data-mesh-theme="dark"] .card textarea::placeholder { color: #7d84a3; }
    html[data-mesh-theme="dark"] .card select option { background: #1c1340; color: #e8eaf4; }
    html[data-mesh-theme="dark"] .card input:hover, html[data-mesh-theme="dark"] .card select:hover, html[data-mesh-theme="dark"] .card textarea:hover,
    html[data-mesh-theme="dark"] .card input:focus, html[data-mesh-theme="dark"] .card select:focus, html[data-mesh-theme="dark"] .card textarea:focus { border-color: #6d4bc4; }
    html[data-mesh-theme="dark"] .card input:focus, html[data-mesh-theme="dark"] .card select:focus, html[data-mesh-theme="dark"] .card textarea:focus { box-shadow: 0 0 0 4px rgba(109, 75, 196, 0.3); }
    html[data-mesh-theme="dark"] input.field-invalid, html[data-mesh-theme="dark"] select.field-invalid, html[data-mesh-theme="dark"] textarea.field-invalid { border-color: #f87171; }
    html[data-mesh-theme="dark"] .field-error, html[data-mesh-theme="dark"] .invalid-msg, html[data-mesh-theme="dark"] .help-block { color: #f87171; }
    html[data-mesh-theme="dark"] .card input[type="file"] { background: transparent; border: none; }
    html[data-mesh-theme="dark"] .card .file-row input[type="file"] { background: #140d30; border: 1.5px solid #3a2768; }
    html[data-mesh-theme="dark"] input[type="file"]::file-selector-button { background: #2a1d5c; color: #f3c35f; border: 1px solid #4a3590; border-radius: 6px; padding: 4px 10px; margin-right: 10px; cursor: pointer; }
    html[data-mesh-theme="dark"] #file-dropzone { background: #140d30; border-color: #4a3590; }
    html[data-mesh-theme="dark"] #file-dropzone:hover { background: #1f1548; border-color: #6d4bc4; }
    html[data-mesh-theme="dark"] #file-dropzone span { color: #9aa2bd; }
    html[data-mesh-theme="dark"] .btn-remove-file { background: transparent; color: #f87171; border-color: #f87171; }
    html[data-mesh-theme="dark"] .btn-add-file { background: transparent; color: #f3c35f; border-color: #f3c35f; }
    html[data-mesh-theme="dark"] .captcha-btn { background: #140d30; border-color: #3a2768; color: #e8eaf4; }
    html[data-mesh-theme="dark"] .captcha-btn.is-correct { background: #6d4bc4; border-color: #6d4bc4; color: #ffffff; box-shadow: 0 0 0 4px rgba(243, 195, 95, 0.35); }
    html[data-mesh-theme="dark"] .captcha-btn.is-wrong { background: transparent; border-color: #f87171; color: #f87171; }
    html[data-mesh-theme="dark"] button[type="submit"] { background: #6d4bc4; }
    html[data-mesh-theme="dark"] button[type="submit"]:hover { background: #7c5cdb; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4); }
    html[data-mesh-theme="dark"] .alert-success { background: rgba(52, 211, 153, 0.12); color: #6ee7b7; border-color: rgba(52, 211, 153, 0.45); }
    html[data-mesh-theme="dark"] .alert-danger { background: rgba(248, 113, 113, 0.12); color: #fca5a5; border-color: rgba(248, 113, 113, 0.45); }
    html[data-mesh-theme="dark"] .support-footer { background: #140d30; border-color: #3a2768; }
    html[data-mesh-theme="dark"] .support-footer h6 { color: #f3c35f; }
    html[data-mesh-theme="dark"] .support-footer p { color: #9aa2bd; }
    html[data-mesh-theme="dark"] .support-footer a { color: #f3c35f; }
  </style>
  @include('inc.standalone-theme-head')
  {{-- #================================ --}}
</head>

<body>

  {{-- #============= ORI CODE ============== --}}
  {{--   @auth --}}
  {{--     <a href="https://mesh.moe.gov.bn/servicesdashboard" class="back-link">&larr;</a> --}}
  {{--   @endauth --}}
  {{-- #================================ --}}
  {{-- Back button moved into the row above the card (with the EN/BM + sun/moon), see .mesh-sa-toprow --}}
  {{-- #================================ --}}

  <div id="particles-js"></div>

  {{-- #========== NEWLY ADDED ============ --}}
  <div class="mesh-sa-toprow">
    @auth
      <a href="{{ route('devops-request.indexadmin') }}" class="mesh-sa-back" aria-label="Back">&larr;</a>
    @endauth
    @include('inc.standalone-switches')
  </div>
  {{-- #================================ --}}

  <div class="card">
    <div class="logo-row">
      <img src="{{ asset('img/moe-logo-latest-compressed.png') }}" alt="MOE Logo" class="moe-logo">
    </div>

    <div class="title-row">
      <header class="card-title">DevOps Request Form</header>
    </div>

    <p class="intro-text">Jabatan Teknologi Maklumat memohon kerjasama Pengiran / Tuan / Puan untuk membuat pengemaskinian atau menghadapakan inisiatif / projek pendigitalan perkhidmatan yang dapat ditawarkan oleh Jabatan - Jabatan di bawah Kementerian Pendidikan secara dalaman (internal services) atau kepada orang awam. Pihak Jabatan boleh menghadapkan lebih dari satu inisiatif atau projek pendigitalan perkhidmatan yang diperlukan.</p>

    <div class="download-row">
      <a href="https://mesh.moe.gov.bn/DevOpsRequestForm(DRF).docx">Muat Turun Borang DevOps</a>
    </div>

    <hr>

    @if (Session::has('success_message'))
      <div class="alert alert-success">
        {{ Session::get('success_message') }}
      </div>
    @endif

    @if (count($errors) > 0)
      <div class="alert alert-danger">
        Upload Validation Error
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="post" action="{{ route('devops-request.store') }}" enctype="multipart/form-data">
      @csrf

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

  {{-- #========== NEWLY ADDED ============ --}}
  {{-- English / Malay switch (the word list is inside this file) --}}
  <script src="{{ asset('js/mesh-lang.js') }}?v={{ filemtime(public_path('js/mesh-lang.js')) }}"></script>
  {{-- #================================ --}}

</body>

</html>
