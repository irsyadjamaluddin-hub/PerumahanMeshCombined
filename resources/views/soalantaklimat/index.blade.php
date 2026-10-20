<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Soalan Taklimat</title>
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

</head>

<body>
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

          <form class="" method="post" action="{{ route('st.soalantaklimat.store') }}" enctype="multipart/form-data">
          @csrf

            <br>


            <!-- <div class="col profile-overview" style="border: 8px solid #012970; padding: 20px; border-radius: 25px;"> -->
              <center><img src="img\moe-logo-latest-compressed.png" class="d-block w-75" alt="MOE LOGO"></center>
              <br>
              <header class="card-title" style="padding: 0px; font-size: 18px;">Pertanyaan</header>
              
              <!-- <p style="text-align: justify;">Jabatan Pentadbiran dan Perkhidmatan-Perkhidmatan memohon kerjasama Pengiran / Tuan / Puan untuk 
              membuat pengemaskinian atau menghadapakan inisiatif / projek pendigitalan perkhidmatan yang dapat 
              ditawarkan oleh Jabatan - Jabatan di bawah Kementerian Pendidikan secara dalaman (internal services) 
              atau kepada orang awam. Pihak Jabatan boleh menghadapkan lebih dari satu inisitif atau projek pendigitalan 
              perkhidmatan yang diperlukan.</p> -->
              <hr>
              <form>

              <div class="row mb-3">
                  <label class="col-lg-4 col-form-label">Perkara: </label>
                  <div class="col-lg-8">
                    <select class="form-select" name="perkara" aria-label="Default select example" required>
                      <option selected hidden>Pilih Perkara</option>
                      @foreach ($perkara as $key => $value)
                      <option value="{{ $value }}">
                          {{ $value }}
                      </option>
                      @endforeach
                      
                    </select>
                    
                    {!! $errors->first('perkara', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

              
              <div class="row mb-3">
                  <label class="col-lg-4 col-form-label">Tarikh</label>
                  <div class="col-lg-8">
                  <input type="text" name="tarikh_st" class="form-control" placeholder="example@moe.gov.bn" value="{{$currentdate}}" readonly>
                    {!! $errors->first('nama', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-lg-4 col-form-label">Soalan:</label>
                  <div class="col-lg-8">
                    <textarea type="soalan" name="soalan" class="form-control" style="height: 100px" placeholder="..." ></textarea>
                    
                    {!! $errors->first('remark', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-lg-4 col-form-label">Nama:(Optional)</label>
                  <div class="col-lg-8">
                    <input type="text" name="nama" class="form-control">
                    
                    {!! $errors->first('remark', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-lg-4 col-form-label">Organisation:(Optional)</label>
                  <div class="col-lg-8">
                    <input type="text" name="organisation" class="form-control">
                    
                    {!! $errors->first('remark', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

                <div class="row mb-3">
				    <label for="inputtel" class="col-lg-4 col-form-label">Captcha:<br><i style="color:grey;">please solve this </i>{{$captchaQuestion}}</label>
				    <div class="col-lg-8">
				        <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Enter the answer" required>
                @if ($errors->has('captcha'))
                <span class="text-danger">{{$errors->first('captcha')}}</span>
                @endif
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
  
</section>

   
</body>

</html>