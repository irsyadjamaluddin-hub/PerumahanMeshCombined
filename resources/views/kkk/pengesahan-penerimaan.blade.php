<!DOCTYPE html>
<html lang="ms">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Pengesahan Penerimaan Kunci Kira-Kira</title>

  <link href="{{ asset('assets/img/logo.png') }}" rel="icon">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

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

    .section.register {
      position: relative;
      z-index: 1;
      pointer-events: none;
    }

    .section.register .container {
      pointer-events: auto;
    }

    .section.register .card {
      border: none;
      background: #ffffff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 20px 45px rgba(4, 18, 40, 0.45);
      padding: 32px 36px 36px;
    }

    .section.register .card-body {
      padding: 0;
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
      color: #0c2f5e;
    }

    /* #==========ORI CODE=========
    .section.register .form-control,
    .section.register .form-select {
      background: #cfe2f5;
      border: 1.5px solid #a9c9e8;
      border-radius: 8px;
      padding: 10px 14px;
      color: #000000;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    #==========NEWLY ADDED======== (split .form-select out: the shorthand "background" above was wiping Bootstrap's own chevron background-image, and Bootstrap's .form-select also sets appearance:none, so a plain (non-select2) select was left with no arrow at all — Peranan, which isn't select2-enhanced, rendered as a blank box; Jabatan looked fine only because select2 draws its own separate arrow) */
    .section.register .form-control {
      background: #cfe2f5;
      border: 1.5px solid #a9c9e8;
      border-radius: 8px;
      padding: 10px 14px;
      color: #000000;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .section.register .form-select {
      background-color: #cfe2f5;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%230c2f5e' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 14px center;
      background-size: 14px 14px;
      border: 1.5px solid #a9c9e8;
      border-radius: 8px;
      padding: 10px 34px 10px 14px;
      color: #000000;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    /* =========================== */

    .section.register ::placeholder { color: #000000; opacity: 1; }
    .section.register .form-select option { color: #000000; }

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

    .section.register .form-control:focus,
    .section.register .form-select:focus {
      border-color: #144d8f;
      box-shadow: 0 0 0 4px rgba(20, 77, 143, 0.15);
    }

    .section.register .select2-container--default .select2-selection--single {
      background: #cfe2f5;
      border: 1.5px solid #a9c9e8;
      border-radius: 8px;
      height: calc(1.5em + 0.75rem + 3px);
      padding: 5px 14px;
    }

    .section.register .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: #000000;
      line-height: 1.9;
    }

    .section.register .select2-container--default.select2-container--focus .select2-selection--single,
    .section.register .select2-container--default.select2-container--open .select2-selection--single {
      border-color: #144d8f;
      box-shadow: 0 0 0 4px rgba(20, 77, 143, 0.15);
    }

    .section.register .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 100%;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%230c2f5e' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: center;
      background-size: 14px 14px;
    }

    .section.register .select2-container--default .select2-selection--single .select2-selection__arrow b {
      display: none;
    }

    .section.register .select2-container--default .select2-selection--single .select2-selection__placeholder {
      color: #000000;
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

    .section.register hr {
      opacity: 0.12;
    }

    @media (max-width: 991px) {
      .section.register .container { padding-left: 10px; padding-right: 10px; }
      .section.register .card { margin: 0; }
    }

    @media (max-width: 560px) {
      .section.register .container { padding-left: 6px; padding-right: 6px; }
      .section.register .card { padding: 24px 20px 28px; border-radius: 14px; }
      .section.register .card-title { font-size: 16px; }
      .section.register center img { width: 55% !important; max-width: 150px !important; }
      .section.register .row.mb-3 { margin-bottom: 10px !important; }
      .section.register .col-form-label { padding-bottom: 4px; }
      .section.register .form-control,
      .section.register .form-select,
      .section.register .select2-container { font-size: 16px !important; }
      .section.register .btn-primary { width: 100%; }
    }

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
  <style>
    .section.register .form-intro { font-size: 14px; color: #0c2f5e; text-align: center; margin: 10px 0 0; }
    .section.register .form-check-input { border: 1.5px solid #a9c9e8; background-color: #cfe2f5; }
    .section.register .form-check-input:checked { background-color: #0c2f5e; border-color: #0c2f5e; }
    .section.register .form-check-input:focus { box-shadow: 0 0 0 4px rgba(20, 77, 143, 0.15); }
    .section.register .form-check-label { color: #000000; }
    .section.register .select2-container--default.select2-container--disabled .select2-selection--single { background: #e3edf8; }
  </style>
</head>

<body>

<div id="particles-js"></div>
<script src="{{ asset('js/particles.min.js') }}"></script>
<script>
  particlesJS("particles-js", {"particles":{"number":{"value":100,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle"},"opacity":{"value":0.5,"random":false},"size":{"value":3,"random":true},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4}}},"retina_detect":true});
</script>

{{-- Back button, logged-in users only (same as borangpermohonanperanan) --}}
@auth
<div class="container" style="padding-top: 20px; position: relative; z-index: 2;">
  <div class="row justify-content-center">
    <div class="col-lg-8 d-flex justify-content-between align-items-center" style="margin-bottom: 10px;">
      <a href="{{ url()->previous() !== url()->current() ? url()->previous() : url('/home') }}" class="btn btn-primary" title="Kembali">
        <i class="bi bi-arrow-left"></i>
      </a>
      {{-- Right arrow: jump to the records page, where this submission appears under "Penerimaan Kunci Kira-Kira" --}}
      <a href="{{ route('kkk.rekod') }}#penerimaan" class="btn btn-primary" title="Rekod Kunci Kira-Kira" aria-label="Rekod Kunci Kira-Kira">
        <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
</div>
@endauth

<section class="section register min-vh-100 d-flex flex-column align-items-center py-4">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 d-flex flex-column align-items-center justify-content-center">

        <div class="col-12">

          @if (Session::has('success_message'))
            <div class="alert alert-success text-center">{{ Session::get('success_message') }}</div>
          @endif

          <div class="card">
            <div class="card-body">
              <div class="profile-overview pt-3">

                @if (count($errors) > 0)
                  <div class="alert alert-danger">
                    <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                <form method="post" action="{{ route('kkk.pengesahan.store') }}">
                  @csrf
                  <br>
                  <center><img src="{{ asset('img/moe-logo-latest-compressed.png') }}" class="d-block" style="max-width: 190px; width: 60%; margin: 0 auto;" alt="MOE LOGO"></center>
                  <br>
                  <div style="text-align: center;">
                    <header class="card-title" style="padding: 0px; font-size: 18px;">(KKK1) Pengesahan Penerimaan Kunci Kira-Kira</header>
                  </div>
                  <p class="form-intro">Sila lengkapkan borang pengesahan ini <strong>SEMASA</strong> pihak sekolah menghantar Laporan Kunci Kira-Kira.</p>

                  <hr>

                  <div class="row mb-3">
                    <label class="col-lg-4 col-form-label">Dari Kluster:<i style="color:red;">*</i></label>
                    <div class="col-lg-8">
                      <select class="form-select" name="kluster" id="kluster" required>
                        <option value="" hidden {{ old('kluster') ? '' : 'selected' }}>Pilih Kluster</option>
                        @foreach (array_keys($opsyen['sekolah']) as $k)
                          <option value="{{ $k }}" {{ old('kluster') === $k ? 'selected' : '' }}>{{ $k }}</option>
                        @endforeach
                      </select>
                      {!! $errors->first('kluster', '<p class="help-block text-danger">:message</p>') !!}
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-lg-4 col-form-label">Nama Sekolah:<i style="color:red;">*</i></label>
                    <div class="col-lg-8">
                      <select class="form-select" name="nama_sekolah" id="sekolah" required disabled>
                        <option value=""></option>
                      </select>
                      <input type="text" name="nama_sekolah_lain" id="sekolahLain" class="form-control mt-2 d-none" placeholder="Nyatakan nama sekolah" maxlength="200" value="{{ old('nama_sekolah_lain') }}">
                      {!! $errors->first('nama_sekolah', '<p class="help-block text-danger">:message</p>') !!}
                      {!! $errors->first('nama_sekolah_lain', '<p class="help-block text-danger">:message</p>') !!}
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-lg-4 col-form-label">Kategori Kunci Kira-Kira:<i style="color:red;">*</i></label>
                    <div class="col-lg-8">
                      <select class="form-select" name="kategori" required>
                        <option value="" hidden {{ old('kategori') ? '' : 'selected' }}>Pilih Kategori</option>
                        @foreach ($opsyen['kategori'] as $v)
                          <option value="{{ $v }}" {{ old('kategori') === $v ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                      </select>
                      {!! $errors->first('kategori', '<p class="help-block text-danger">:message</p>') !!}
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-lg-4 col-form-label">Jenis Kunci Kira-Kira Yang Dihadapkan:<i style="color:red;">*</i></label>
                    <div class="col-lg-8">
                      <select class="form-select" name="jenis" required>
                        <option value="" hidden {{ old('jenis') ? '' : 'selected' }}>Pilih Jenis</option>
                        @foreach ($opsyen['jenis'] as $v)
                          <option value="{{ $v }}" {{ old('jenis') === $v ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                      </select>
                      {!! $errors->first('jenis', '<p class="help-block text-danger">:message</p>') !!}
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-lg-4 col-form-label">Tempoh Kunci Kira-Kira:<i style="color:red;">*</i></label>
                    <div class="col-lg-8 pt-2">
                      @foreach ($opsyen['tempoh'] as $i => $v)
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="tempoh" id="tempoh{{ $i }}" value="{{ $v }}" {{ old('tempoh') === $v ? 'checked' : '' }} required>
                          <label class="form-check-label" for="tempoh{{ $i }}">{{ $v }}</label>
                        </div>
                      @endforeach
                      {!! $errors->first('tempoh', '<p class="help-block text-danger">:message</p>') !!}
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-lg-4 col-form-label">Laporan Kunci Kira-Kira Bagi Tahun:<i style="color:red;">*</i></label>
                    <div class="col-lg-8">
                      <select class="form-select" name="tahun" required>
                        <option value="" hidden {{ old('tahun') ? '' : 'selected' }}>Pilih Tahun</option>
                        @for ($y = $opsyen['tahun_hingga']; $y >= $opsyen['tahun_dari']; $y--)
                          <option value="{{ $y }}" {{ (string) old('tahun') === (string) $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                      </select>
                      {!! $errors->first('tahun', '<p class="help-block text-danger">:message</p>') !!}
                    </div>
                  </div>

                  <hr>

                  <div class="row mb-3">
                    <label class="col-lg-4 col-form-label">Nama Penghantar Laporan:<i style="color:red;">*</i></label>
                    <div class="col-lg-8">
                      <input type="text" name="nama_penghantar" class="form-control" placeholder="Nama penuh" maxlength="150" value="{{ old('nama_penghantar') }}" required>
                      {!! $errors->first('nama_penghantar', '<p class="help-block text-danger">:message</p>') !!}
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-lg-4 col-form-label">Jawatan:<i style="color:red;">*</i></label>
                    <div class="col-lg-8">
                      <input type="text" name="jawatan" class="form-control" placeholder="Jawatan" maxlength="150" value="{{ old('jawatan') }}" required>
                      {!! $errors->first('jawatan', '<p class="help-block text-danger">:message</p>') !!}
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-lg-4 col-form-label">Nombor Telefon:<i style="color:red;">*</i></label>
                    <div class="col-lg-8">
                      {{-- 7 digits only: maxlength stops the 8th, oninput strips anything that isn't 0-9 (also on paste) --}}
                      <input type="tel" name="no_tel" class="form-control" placeholder="Eg. 8888888"
                             inputmode="numeric" pattern="[0-9]{7}" minlength="7" maxlength="7" autocomplete="tel"
                             title="Nombor telefon mestilah 7 digit"
                             oninput="this.value = this.value.replace(/\D/g, '').slice(0, 7)"
                             value="{{ old('no_tel') }}" required>
                      {!! $errors->first('no_tel', '<p class="help-block text-danger">:message</p>') !!}
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
  </div>

</section>

<script>
  const SEKOLAH = @json($opsyen['sekolah']);
  const LAIN = @json($opsyen['lain_lain']);
  const OLD_SEKOLAH = @json(old('nama_sekolah'));

  const $sekolah = $('#sekolah').select2({ width: '100%', placeholder: 'Pilih kluster dahulu' });

  function isiSekolah(kluster, pilih) {
    $sekolah.empty().append('<option value=""></option>');
    (SEKOLAH[kluster] || []).concat(LAIN).forEach(n => $sekolah.append(new Option(n, n, false, n === pilih)));
    $sekolah.prop('disabled', false).select2({ width: '100%', placeholder: 'Pilih Sekolah (' + kluster + ')', allowClear: true });
    togolLain();
  }

  function togolLain() {
    const other = $sekolah.val() === LAIN;
    $('#sekolahLain').toggleClass('d-none', !other).prop('required', other);
  }

  $('#kluster').on('change', function () {
    $('#sekolahLain').val('');
    isiSekolah(this.value, null);
  });
  $sekolah.on('change', togolLain);

  // Restore the school list after a failed validation
  if ($('#kluster').val()) isiSekolah($('#kluster').val(), OLD_SEKOLAH);
</script>

</body>
</html>
