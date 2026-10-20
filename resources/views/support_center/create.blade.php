<!DOCTYPE html>
<html lang="ms">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DevOps Service Desk</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">

  {{-- #==== ORI CODE ====

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Raleway:300,400,600,700|Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <link href="{{ asset('assets/vendors/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

  <!-- Select2 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

  <style>
    p { font-size: 14px; }
    .support-footer {
      background: #f8f9fa;
      border-top: 1px solid #e0e0e0;
      margin-top: 25px;
      padding: 15px 10px;
      border-radius: 0 0 8px 8px;
    }
    .support-footer h6 { font-weight: 600; color: #012970; margin-bottom: 10px; }
    .support-footer p { margin: 0; font-size: 14px; color: #333; }
    .support-footer i { color: #4154f1; margin-right: 8px; }

    /* Asterisk merah automatik untuk label required */
    label.required::after {
      content: " *";
      color: #dc3545;
    }

    /* Captcha buttons */
    .captcha-grid { display:flex; gap:.5rem; flex-wrap:wrap; margin-top:.5rem; }
    .captcha-btn  { min-width:48px; }
    .invalid-msg  { color:#dc3545; font-size:13px; display:none; margin-top:4px; }
  </style>

  #====== NEWLY ADDED (dropped the NiceAdmin dashboard chrome/select2/jQuery in favour of a standalone navy-particle page, matching support_center/create-new.blade.php) ==== --}}
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

    hr { border: none; border-top: 1px solid rgba(12, 47, 94, 0.12); margin: 18px 0 22px; }

    .field-row {
      display: flex;
      gap: 16px;
      align-items: flex-start;
      margin-bottom: 16px;
      flex-wrap: wrap;
    }

    .field-label {
      flex: 0 0 160px;
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

    input.field-invalid, select.field-invalid, textarea.field-invalid {
      border-color: #dc2626;
    }

    .field-error {
      color: #dc2626;
      font-size: 12px;
      margin-top: 4px;
    }

    input[type="file"] {
      background: transparent;
      border: none;
      padding: 0;
    }

    .file-row {
      display: flex;
      gap: 8px;
      align-items: center;
      margin-bottom: 8px;
    }

    .file-row input[type="file"] {
      flex: 1 1 auto;
      background: #e6f1fb;
      border: 1.5px solid #c9def2;
      border-radius: 8px;
      padding: 8px 10px;
    }

    .btn-remove-file {
      flex: 0 0 auto;
      background: #fdecec;
      color: #b42318;
      border: 1.5px solid #f7c6c2;
      border-radius: 8px;
      padding: 8px 12px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
    }

    .btn-add-file {
      background: #e6f1fb;
      color: #144d8f;
      border: 1.5px solid #c9def2;
      border-radius: 8px;
      padding: 8px 16px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      margin-top: 4px;
    }

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
    button[type="submit"]:disabled { opacity: 0.7; cursor: not-allowed; }

    .alert {
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 13.5px;
      margin-bottom: 16px;
    }

    .alert-success { background: #e7f7ee; color: #146c43; border: 1px solid #bfe8d1; }
    .alert-danger { background: #fdecec; color: #b42318; border: 1px solid #f7c6c2; }
    .alert-danger ul { margin: 6px 0 0; padding-left: 18px; }

    .support-footer {
      background: #eef4fb;
      border: 1px solid #cdd9f0;
      border-radius: 12px;
      margin-top: 26px;
      padding: 16px 18px;
      text-align: center;
    }

    .support-footer h6 { font-weight: 700; color: #0c2f5e; margin: 0 0 8px; font-size: 14px; }
    .support-footer p { margin: 0; font-size: 13px; color: #5b6188; }
    .support-footer a { color: #144d8f; font-weight: 600; text-decoration: underline; }

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

  {{-- #====== NEWLY ADDED (particles background to match support_center/create-new.blade.php) ==== --}}
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

    #====== NEWLY ADDED (back button now leads to the Support Center index, styled to match support_center/create-new.blade.php) ==== --}}
    @auth
      <a href="{{ route('support-center.index') }}" class="back-link">&larr;</a>
    @endauth
    {{-- #====== ========. --}}

  <div class="card">
    {{-- #====== NEWLY ADDED (real MOE logo + gold-underlined title, replacing the plain dashboard h3) ==== --}}
    <div class="logo-row">
      <img src="{{ asset('img/moe-logo-latest-compressed.png') }}" alt="MOE Logo" class="moe-logo">
    </div>

    <div class="title-row">
      <header class="card-title">DevOps Service Desk Form</header>
    </div>
    {{-- #====== ========. --}}

    {{-- #==== ORI CODE ====

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">

      @if(Session::has('success_message'))
        <div class="alert alert-success">
          {{ Session::get('success_message') }}
        </div>
      @endif

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

    @if ($errors->any())
      <div class="alert alert-danger">
        <strong>Ralat:</strong>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- #==== ORI CODE ====

                    <h3 class="card-title" style="padding: 0px;">DevOps Service Desk Form</h3>
                    <p style="text-align: justify;">
                      Sila lengkapkan borang ini untuk menghantar aduan atau permohonan bantuan kepada pihak DevOps.
                    </p>

    #====== NEWLY ADDED (title moved above the form into the new logo/title block) ==== --}}
    <p class="intro-text">Sila lengkapkan borang ini untuk menghantar aduan atau permohonan bantuan kepada pihak DevOps.</p>
    {{-- #====== ========. --}}

    <hr>

    <form method="POST" action="{{ route('support-center.store') }}" enctype="multipart/form-data" novalidate>
      @csrf

      {{-- #==== ORI CODE ====

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label required">Nama:</label>
                    <div class="col-sm-8">
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                             placeholder="Nama penuh" value="{{ old('name') }}" required>
                      @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                  </div>

      #====== NEWLY ADDED (row/col-sm layout swapped for the field-row/field-label/field-control layout; is-invalid/invalid-feedback swapped for field-invalid/field-error) ==== --}}
      <div class="field-row">
        <label class="field-label">Nama<span class="req">*</span></label>
        <div class="field-control">
          <input type="text" name="name" class="{{ $errors->has('name') ? 'field-invalid' : '' }}"
                 placeholder="Nama penuh" value="{{ old('name') }}" required>
          @error('name') <div class="field-error">{{ $message }}</div> @enderror
        </div>
      </div>
      {{-- #====== ========. --}}

      <div class="field-row">
        <label class="field-label">Emel<span class="req">*</span></label>
        <div class="field-control">
          <input type="email" name="email" class="{{ $errors->has('email') ? 'field-invalid' : '' }}"
                 placeholder="example@moe.gov.bn" value="{{ old('email') }}" required>
          @error('email') <div class="field-error">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="field-row">
        <label class="field-label">No. Telefon<span class="req">*</span></label>
        <div class="field-control">
          <input type="tel" name="contact" class="{{ $errors->has('contact') ? 'field-invalid' : '' }}"
                 placeholder="8881234" inputmode="numeric"
                 pattern="^(?:\+?673)?\d{7}$"
                 title="Masukkan 7 digit (cth: 8881234) atau +673 diikuti 7 digit (cth: +6738881234)"
                 value="{{ old('contact') }}" required>
          @error('contact') <div class="field-error">{{ $message }}</div> @enderror
        </div>
      </div>

      {{-- #==== ORI CODE ====

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label required">Jabatan:</label>
                    <div class="col-sm-8">
                      <select class="form-select @error('department') is-invalid @enderror"
                              name="department" id="myselect" required>
                        <option value="" selected hidden>Pilih Jabatan</option>
                        @foreach ($departments as $department)
                          <option value="{{ $department->label }}" {{ old('department')===$department->label ? 'selected' : '' }}>
                            {{ $department->label }}
                          </option>
                        @endforeach
                      </select>
                      @error('department') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                  </div>

      #====== NEWLY ADDED (select2/#myselect dropped in favour of the plain styled select) ==== --}}
      <div class="field-row">
        <label class="field-label">Jabatan<span class="req">*</span></label>
        <div class="field-control">
          <select name="department" class="{{ $errors->has('department') ? 'field-invalid' : '' }}" required>
            <option value="" hidden>Pilih Jabatan</option>
            @foreach ($departments as $department)
              <option value="{{ $department->label }}" {{ old('department')===$department->label ? 'selected' : '' }}>
                {{ $department->label }}
              </option>
            @endforeach
          </select>
          @error('department') <div class="field-error">{{ $message }}</div> @enderror
        </div>
      </div>
      {{-- #====== ========. --}}

      <div class="field-row">
        <label class="field-label">Unit</label>
        <div class="field-control">
          <input type="text" name="unit" class="{{ $errors->has('unit') ? 'field-invalid' : '' }}"
                 value="{{ old('unit') }}">
          @error('unit') <div class="field-error">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="field-row">
        <label class="field-label">Perkara<span class="req">*</span></label>
        <div class="field-control">
          <input type="text" name="perkara" class="{{ $errors->has('perkara') ? 'field-invalid' : '' }}"
                 placeholder="Contoh: Masalah login sistem"
                 value="{{ old('perkara') }}" required>
          @error('perkara') <div class="field-error">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="field-row">
        <label class="field-label">Huraian<span class="req">*</span></label>
        <div class="field-control">
          <textarea name="huraian" class="{{ $errors->has('huraian') ? 'field-invalid' : '' }}"
                    placeholder="Huraian masalah / permintaan" required>{{ old('huraian') }}</textarea>
          @error('huraian') <div class="field-error">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="field-row">
        <label class="field-label">Kepentingan<span class="req">*</span></label>
        <div class="field-control">
          <select name="priority" class="{{ $errors->has('priority') ? 'field-invalid' : '' }}" required>
            <option value="" hidden>Pilih Keutamaan</option>
            <option value="Rendah"    {{ old('priority')==='Rendah' ? 'selected' : '' }}>Rendah</option>
            <option value="Sederhana" {{ old('priority')==='Sederhana' ? 'selected' : '' }}>Sederhana</option>
            <option value="Tinggi"    {{ old('priority')==='Tinggi' ? 'selected' : '' }}>Tinggi</option>
          </select>
          @error('priority') <div class="field-error">{{ $message }}</div> @enderror
        </div>
      </div>

      {{-- #==== ORI CODE ====

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Muat Naik Fail:</label>
                    <div class="col-sm-8">
                      <div id="file-container">
                        <div class="input-group mb-2">
                          <input type="file" name="attachments[]" class="form-control"
                                 accept=".pdf,.doc,.docx,.ppt,.pptx,.png,.jpg,.jpeg">
                          <button type="button" class="btn btn-danger remove-file">Remove</button>
                        </div>
                      </div>
                      <button type="button" id="add-file" class="btn btn-secondary mt-2">+ Tambah Fail</button>
                      <small class="text-muted d-block mt-1">Boleh muat naik lebih dari satu fail (maks 10MB setiap satu)</small>
                    </div>
                  </div>

      #====== NEWLY ADDED (input-group/btn-danger/btn-secondary swapped for file-row/btn-remove-file/btn-add-file) ==== --}}
      <div class="field-row">
        <label class="field-label">Muat Naik Fail</label>
        <div class="field-control">
          <div id="file-container">
            <div class="file-row">
              <input type="file" name="attachments[]" accept=".pdf,.doc,.docx,.ppt,.pptx,.png,.jpg,.jpeg">
              <button type="button" class="btn-remove-file remove-file">Remove</button>
            </div>
          </div>
          <button type="button" id="add-file" class="btn-add-file">+ Tambah Fail</button>
          <span class="field-hint">Boleh muat naik lebih dari satu fail (maks 10MB setiap satu)</span>
        </div>
      </div>
      {{-- #====== ========. --}}

      <hr>

      {{-- #==== ORI CODE ====

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label required">Pengesahan:</label>
                    <div class="col-sm-8">
                      <div>
                        <span>Sila pilih nombor: <strong id="captcha-target">?</strong></span>
                        <div id="captcha-options" class="captcha-grid mt-2"></div>
                        <small id="captcha-help" class="invalid-msg">Nombor yang dipilih tidak betul. Sila cuba lagi.</small>
                      </div>
                    </div>
                  </div>

      #====== NEWLY ADDED --}}
      <div class="field-row">
        <label class="field-label">Pengesahan<span class="req">*</span></label>
        <div class="field-control">
          <span>Sila pilih nombor: <strong id="captcha-target">?</strong></span>
          <div id="captcha-options" class="captcha-grid"></div>
          <small id="captcha-help" class="invalid-msg">Nombor yang dipilih tidak betul. Sila cuba lagi.</small>
        </div>
      </div>
      {{-- #====== ========. --}}

      <div class="submit-row">
        <button type="submit" id="submit-btn">Hantar</button>
      </div>
    </form>

    <div class="support-footer">
      <h6>Bahagian DevOps</h6>
      <p>Jejantas penghubung tingkat 1, Block B/C</p>
      <p>Kementerian Pendidikan</p>
      <p><a href="mailto:devops@moe.edu.bn">devops@moe.edu.bn</a></p>
    </div>
  </div>
  </div>

  {{-- #==== ORI CODE ====

                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

  #====== NEWLY ADDED (extra dashboard/card wrapper divs dropped along with the NiceAdmin chrome) ==== --}}
  {{-- #====== ========. --}}

  <script>
    {{-- #==== ORI CODE ====

    // Select2 (placeholder & allow clear)
    $('#myselect').select2({
      width: '100%',
      placeholder: "Pilih Jabatan",
      allowClear: true
    });

    #====== NEWLY ADDED (select2 initializer dropped along with select2/jQuery in the head) ==== --}}
    {{-- #====== ========. --}}

    // File add/remove + file size guard (10MB)
    document.addEventListener('DOMContentLoaded', function () {
      const addButton = document.getElementById('add-file');
      const container = document.getElementById('file-container');

      addButton?.addEventListener('click', function () {
        const div = document.createElement('div');
        div.classList.add('file-row');
        div.innerHTML = `
          <input type="file" name="attachments[]"
                 accept=".pdf,.doc,.docx,.ppt,.pptx,.png,.jpg,.jpeg">
          <button type="button" class="btn-remove-file remove-file">Remove</button>
        `;
        container.appendChild(div);
      });

      container?.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-file')) {
          e.target.closest('.file-row').remove();
        }
      });

      function checkFileSize(input){
        const maxBytes = 10 * 1024 * 1024;
        if (input?.files?.[0] && input.files[0].size > maxBytes){
          input.value = '';
          alert('Saiz fail melebihi 10MB. Sila pilih fail yang lebih kecil.');
        }
      }
      container?.addEventListener('change', (e)=>{
        if (e.target.matches('input[type="file"]')) checkFileSize(e.target);
      });
    });
  </script>

  <script>
    // Malay validation + CAPTCHA pilih nombor + lock submit
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.querySelector('form[action="{{ route('support-center.store') }}"]');
      if (!form) return;

      // Custom Malay messages (HTML5)
      const fields = [
        'name','email','contact','department','perkara','huraian','priority'
      ].map(n => form.querySelector(`[name="${n}"]`)).filter(Boolean);

      fields.forEach(el => {
        el.oninvalid = function () {
          el.setCustomValidity('');
          if (!el.validity.valid) {
            if (el.type === 'email' && el.value.trim() !== '' && el.validity.typeMismatch) {
              el.setCustomValidity('Sila masukkan emel yang sah.');
            } else if (el.tagName === 'SELECT') {
              el.setCustomValidity('Sila buat pilihan.');
            } else if (el.name === 'contact' && el.value.trim() !== '') {
              el.setCustomValidity('Format nombor tidak sah. 7 digit (cth: 8881234) atau +673 diikuti 7 digit.');
            } else {
              el.setCustomValidity('Sila isi ruangan ini.');
            }
          }
        };
        el.oninput  = () => el.setCustomValidity('');
        el.onchange = () => el.setCustomValidity('');
      });

      {{-- #==== ORI CODE ====
      // fix untuk Select2 (jabatan)
      $('#myselect').on('change.select2', function(){ this.setCustomValidity(''); });
      #====== NEWLY ADDED (no select2 to patch anymore, plain <select> already fires a normal change event) ==== --}}
      {{-- #====== ========. --}}

      // CAPTCHA: pilih nombor (auto-refresh on wrong)
      const targetEl  = document.getElementById('captcha-target');
      const optionsEl = document.getElementById('captcha-options');
      const helpEl    = document.getElementById('captcha-help');
      let requiredNumber = null;
      let captchaPassed  = false;

      function rand(min,max){ return Math.floor(Math.random()*(max-min+1))+min; }

      function newCaptcha(){
        captchaPassed = false;
        requiredNumber = rand(1,10);
        targetEl.textContent = requiredNumber;

        const set = new Set([requiredNumber]);
        while (set.size < 5) set.add(rand(1,10));
        const options = Array.from(set).sort(()=>Math.random()-0.5);

        optionsEl.innerHTML = '';
        options.forEach(n => {
          const btn = document.createElement('button');
          btn.type = 'button';
          btn.className = 'captcha-btn';
          btn.textContent = n;
          btn.dataset.val = n;
          btn.addEventListener('click', function(){
            if (parseInt(this.dataset.val,10) === requiredNumber) {
              captchaPassed = true;
              helpEl.style.display = 'none';
              optionsEl.querySelectorAll('button').forEach(b=>b.classList.remove('is-correct','is-wrong'));
              this.classList.add('is-correct');
            } else {
              captchaPassed = false;
              helpEl.style.display = 'block';
              optionsEl.querySelectorAll('button').forEach(b=>b.classList.remove('is-correct','is-wrong'));
              this.classList.add('is-wrong');
              setTimeout(newCaptcha, 400); // regenerate
            }
          });
          optionsEl.appendChild(btn);
        });
      }
      newCaptcha();

      // Lock submit (prevent double click)
      const submitBtn = document.getElementById('submit-btn');
      form.addEventListener('submit', function (e) {
        if (!form.checkValidity()){
          e.preventDefault();
          form.reportValidity();
          return false;
        }
        if (!captchaPassed){
          e.preventDefault();
          helpEl.style.display = 'block';
          newCaptcha();
          return false;
        }
        if (submitBtn.disabled){
          e.preventDefault();
          return false;
        }
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Menghantar…';
      });
    });
  </script>

  {{-- Particles JS --}}
  <script src="{{ asset('js/particles.min.js') }}"></script>
  <script>
    particlesJS("particles-js", {"particles":{"number":{"value":100,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});
  </script>

</body>
</html>
