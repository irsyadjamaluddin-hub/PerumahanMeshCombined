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

                @if ($errors->any())
                  <div class="alert alert-danger">
                      <strong>Ralat:</strong>
                      <ul class="mb-0">
                          @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                @endif

                <h3 class="card-title" style="padding: 0px;">DevOps Service Desk Form</h3>
                <p style="text-align: justify;">
                  Sila lengkapkan borang ini untuk menghantar aduan atau permohonan bantuan kepada pihak DevOps.
                </p>
                <hr>

                <form method="POST" action="{{ route('support-center.store') }}" enctype="multipart/form-data" novalidate>
                  @csrf

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label required">Nama:</label>
                    <div class="col-sm-8">
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                             placeholder="Nama penuh" value="{{ old('name') }}" required>
                      @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label required">Emel:</label>
                    <div class="col-sm-8">
                      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                             placeholder="example@moe.gov.bn" value="{{ old('email') }}" required>
                      @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label required">No. Telefon:</label>
                    <div class="col-sm-8">
                      <input type="tel" name="contact" class="form-control @error('contact') is-invalid @enderror"
                             placeholder="8881234" inputmode="numeric"
                             pattern="^(?:\+?673)?\d{7}$"
                             title="Masukkan 7 digit (cth: 8881234) atau +673 diikuti 7 digit (cth: +6738881234)"
                             value="{{ old('contact') }}" required>
                      @error('contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                  </div>

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

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Unit:</label>
                    <div class="col-sm-8">
                      <input type="text" name="unit" class="form-control @error('unit') is-invalid @enderror"
                             value="{{ old('unit') }}">
                      @error('unit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label required">Perkara:</label>
                    <div class="col-sm-8">
                      <input type="text" name="perkara" class="form-control @error('perkara') is-invalid @enderror"
                             placeholder="Contoh: Masalah login sistem"
                             value="{{ old('perkara') }}" required>
                      @error('perkara') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label required">Huraian:</label>
                    <div class="col-sm-8">
                      <textarea name="huraian" class="form-control @error('huraian') is-invalid @enderror"
                                style="height: 100px;" placeholder="Huraian masalah / permintaan" required>{{ old('huraian') }}</textarea>
                      @error('huraian') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label required">Kepentingan:</label>
                    <div class="col-sm-8">
                      <select name="priority" class="form-select @error('priority') is-invalid @enderror" required>
                        <option value="" selected hidden>Pilih Keutamaan</option>
                        <option value="Rendah"    {{ old('priority')==='Rendah' ? 'selected' : '' }}>Rendah</option>
                        <option value="Sederhana" {{ old('priority')==='Sederhana' ? 'selected' : '' }}>Sederhana</option>
                        <option value="Tinggi"    {{ old('priority')==='Tinggi' ? 'selected' : '' }}>Tinggi</option>
                      </select>
                      @error('priority') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                  </div>

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

                  <hr>

                  <!-- CAPTCHA: Pilih nombor (always on) -->
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

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary" id="submit-btn">Hantar</button>
                  </div>
                </form>

                <!-- Footer dikemas kini -->
                <div class="support-footer text-center mt-4">
                  <h6>Bahagian DevOps</h6>
                  <p>Jejantas penghubung tingkat 1, Block B/C</p>
                  <p>Kementerian Pendidikan</p>
                  <p><i class="bi bi-envelope-fill"></i> <a href="mailto:devops@moe.edu.bn">devops@moe.edu.bn</a></p>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    // Select2 (placeholder & allow clear)
    $('#myselect').select2({
      width: '100%',
      placeholder: "Pilih Jabatan",
      allowClear: true
    });

    // File add/remove + file size guard (10MB)
    document.addEventListener('DOMContentLoaded', function () {
      const addButton = document.getElementById('add-file');
      const container = document.getElementById('file-container');

      addButton?.addEventListener('click', function () {
        const div = document.createElement('div');
        div.classList.add('input-group', 'mb-2');
        div.innerHTML = `
          <input type="file" name="attachments[]" class="form-control"
                 accept=".pdf,.doc,.docx,.ppt,.pptx,.png,.jpg,.jpeg">
          <button type="button" class="btn btn-danger remove-file">Remove</button>
        `;
        container.appendChild(div);
      });

      container?.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-file')) {
          e.target.closest('.input-group').remove();
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
      // fix untuk Select2 (jabatan)
      $('#myselect').on('change.select2', function(){ this.setCustomValidity(''); });

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
          btn.className = 'btn btn-outline-primary captcha-btn';
          btn.textContent = n;
          btn.dataset.val = n;
          btn.addEventListener('click', function(){
            if (parseInt(this.dataset.val,10) === requiredNumber) {
              captchaPassed = true;
              helpEl.style.display = 'none';
              optionsEl.querySelectorAll('button').forEach(b=>b.classList.remove('btn-success','btn-danger'));
              this.classList.add('btn-success');
            } else {
              captchaPassed = false;
              helpEl.style.display = 'block';
              optionsEl.querySelectorAll('button').forEach(b=>b.classList.remove('btn-success','btn-danger'));
              this.classList.add('btn-danger');
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

</section>

</body>
</html>