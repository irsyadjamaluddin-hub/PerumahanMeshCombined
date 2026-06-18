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
<div class="pagetitle">
  <h1></h1>

  <!-- <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">Feedback</li>
    </ol>
  </nav> -->
</div><!-- End Page Title -->



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

          <form class="" method="post" action="{{ route('devops-request.store') }}" enctype="multipart/form-data">
          @csrf

            <br>


            <!-- <div class="col profile-overview" style="border: 8px solid #012970; padding: 20px; border-radius: 25px;"> -->
              <h3 class="card-title" style="padding: 0px;">DevOps Request Form</i></h3>
              <p style="text-align: justify;">Jabatan Teknologi Maklumat memohon kerjasama Pengiran / Tuan / Puan untuk 
              membuat pengemaskinian atau menghadapakan inisiatif / projek pendigitalan perkhidmatan yang dapat 
              ditawarkan oleh Jabatan - Jabatan di bawah Kementerian Pendidikan secara dalaman (internal services) 
              atau kepada orang awam. Pihak Jabatan boleh menghadapkan lebih dari satu inisiatif atau projek pendigitalan 
              perkhidmatan yang diperlukan.</p>
              <hr>

              <div>
                <a href="https://mesh.moe.gov.bn/DevOpsRequestForm(DRF).docx">Muat Turun Borang DevOps</a>
              </div>
                <br>
              
              <form>
                   
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

                <div class="row mb-3">
                  <label for="bahagian_unit" class="col-sm-4 col-form-label">Bahagian/Unit:</label>
                  <div class="col-sm-8">
                    <input type="text" name="bahagian_unit" class="form-control" placeholder="Bahagian/Unit">
                  </div>
                </div>

                <div class="row mb-3">
                    <label for="nama_projek" class="col-sm-4 col-form-label">Nama Projek:</label>
                    <div class="col-sm-8">
                      <input type="text" name="nama_projek" class="form-control" placeholder="Nama Projek">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="jawatan" class="col-sm-4 col-form-label">Jawatan:</label>
                    <div class="col-sm-8">
                      <input type="text" name="jawatan" class="form-control" placeholder="Jawatan">
                    </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Perkhidmatan: </label>
                  <div class="col-sm-8">
                    <select class="form-select" name="perkhidmatan" aria-label="Default select example" required>
                      <option selected hidden>Pilih Perkhidmatan</option>
                      <option value="Awam">Awam</option>
                      <option value="Internal">Internal</option>
                    </select>
                    
                    {!! $errors->first('perkhidmatan', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="huraian" class="col-sm-4 col-form-label">Huraian:</label>
                  <div class="col-sm-8">
                      <textarea 
                          name="huraian" 
                          id="huraian" 
                          class="form-control" 
                          style="height: 100px" 
                          placeholder="Huraian projek" 
                          maxlength="3000"
                          required
                          oninput="updateCharCount()"
                      ></textarea>
                      
                      <small id="charCount" class="text-muted">0 / 3000 characters used (including spaces and punctuation)</small>

                      {!! $errors->first('huraian', '<p class="help-block text-danger">:message</p>') !!}
                  </div>
                </div>

                <script>
                  function updateCharCount() {
                      const textarea = document.getElementById('huraian');
                      const charCount = document.getElementById('charCount');
                      const currentLength = textarea.value.length;
                      charCount.textContent = `${currentLength} / 3000 characters used (including spaces and punctuation)`;
                  }

                  // Initialize on page load (in case user has old input)
                  document.addEventListener('DOMContentLoaded', updateCharCount);
                </script>


           


                <div class="row mb-3">
                    <label for="tarikh_diperlukan" class="col-sm-4 col-form-label">Tarikh Diperlukan:</label>
                    <div class="col-sm-8">
                      <input type="date" name="tarikh_diperlukan" class="form-control">
                    </div>
                </div>

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

                <br>

                {{-- <a href="{{url('assets/img/Contoh_Borang.png')}}" style="color:blue; font-size: 14px;" target="_blank"><u>Sila Klik untuk contoh maklumat yang diperlukan</u></a> --}}

                <hr>

                <div class="row mb-3">
                  <label for="penyelaras_projek" class="col-sm-4 col-form-label">Penyelaras Projek:</label>
                  <div class="col-sm-8">
                    <input type="text" name="penyelaras_projek" class="form-control" placeholder="Nama Penyelaras Projek" required>

                    {!! $errors->first('penyelaras_projek', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="emel" class="col-sm-4 col-form-label">Emel:</label>
                  <div class="col-sm-8">
                    <input type="email" name="emel" class="form-control" placeholder="example@moe.gov.bn" required>

                    {!! $errors->first('emel', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="tel_no" class="col-sm-4 col-form-label">Nombor telefon:</label>
                  <div class="col-sm-8">
                    <input type="tel" name="tel_no" class="form-control" placeholder="Eg. 8888888" pattern="[0-9]{7}">

                    {!! $errors->first('tel_no', '<p class="help-block text-danger">:message</p>') !!}
                  </div>
                </div>



            <!-- take hidden ic_no so that easy to identify data belong/from who -->
            
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Hantar</button>
            </div>

            <br>
            

          </form>

            <!-- Include Dropzone.css in the head of your layout file -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">

              <!-- Include Dropzone.js at the bottom of your layout file, after jQuery or any other dependencies -->
              <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

              <!-- Your JavaScript code -->
              <script>
                    Dropzone.options.fileDropzone = {
                      paramName: "dc_file", // The name that will be used to transfer the file
                      maxFilesize: 2, // MB
                      addRemoveLinks: true,
                      init: function () {
                          this.on("success", function (file, response) {
                              // Handle the success response, if needed
                              console.log(response);
                          });

                          this.on("removedfile", function (file) {
                              // Handle the file removal, if needed
                              console.log(file);
                          });
                      },
                  };
              </script>


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
  
</section>

   
</body>

</html>