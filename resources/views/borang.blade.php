<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PDT</title>
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
  </style>

</head>

<body>

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

          <form class="" method="post" action="{{ route('borang.borangs.store') }}" enctype="multipart/form-data">
          @csrf

            <br>


            <!-- <div class="col profile-overview" style="border: 8px solid #012970; padding: 20px; border-radius: 25px;"> -->
              <h3 class="card-title" style="padding: 0px;">Pengemaskinian Projek/Inisiatif Pendigitalan Perkhidmatan Kementerian Pendidikan</i></h3>
              <p style="text-align: justify;">Jabatan Pentadbiran dan Perkhidmatan-Perkhidmatan memohon kerjasama Pengiran / Tuan / Puan untuk 
              membuat pengemaskinian atau menghadapakan inisiatif / projek pendigitalan perkhidmatan yang dapat 
              ditawarkan oleh Jabatan - Jabatan di bawah Kementerian Pendidikan secara dalaman (internal services) 
              atau kepada orang awam. Pihak Jabatan boleh menghadapkan lebih dari satu inisitif atau projek pendigitalan 
              perkhidmatan yang diperlukan.</p>
              <hr>
              <form>
                   
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Jabatan:</label>
                <div class="col-sm-8">
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
                  <label for="inputBahagian" class="col-sm-4 col-form-label">Bahagian/Unit:</label>
                  <div class="col-sm-8">
                    <input type="bahagian" name="bahagian" class="form-control" placeholder="Bahagian/Unit">
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
                  <label for="inputHurai" class="col-sm-4 col-form-label">Huraian:</label>
                  <div class="col-sm-8">
                    <textarea type="hurai" name="huraian" class="form-control" style="height: 100px" placeholder="Pengemaskinian inisiatif/projek pendigitalan perkhidmatan dalaman." required></textarea>
                    
                    {!! $errors->first('huraian', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-3  label">Muat Naik Fail<br><i style="color:black; font-size: 13px;">*Saiz maksimum bagi setiap fail / gambar: 2MB</i> </div>
                    <div class="col-lg-8 col-md-9">
                        <input type="file" name="file_image" class="form-control">
                    </div>
                </div>

                <br>

                <a href="{{url('assets/img/Contoh_Borang.png')}}" style="color:blue; font-size: 14px;" target="_blank"><u>Sila Klik untuk contoh maklumat yang diperlukan</u></a>

                <hr>

                <div class="row mb-3">
                  <label for="inputNama" class="col-sm-4 col-form-label">Nama Fokal:</label>
                  <div class="col-sm-8">
                    <input type="nama" name="nama" class="form-control" placeholder="Nama penuh" required>

                    {!! $errors->first('nama', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputEmel" class="col-sm-4 col-form-label">Emel Fokal:</label>
                  <div class="col-sm-8">
                    <input type="emel" name="email" class="form-control" placeholder="example@moe.gov.bn" required>

                    {!! $errors->first('email', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputTel" class="col-sm-4 col-form-label">Nombor telefon Fokal mudah dihubungi:</label>
                  <div class="col-sm-8">
                    <input type="tel" name="telefon" class="form-control" placeholder="Eg. 8888888" pattern="[0-9]{7}">

                    {!! $errors->first('telefon', '<p class="help-block text-danger">:message</p>') !!}
                  </div>
                </div>



            <!-- take hidden ic_no so that easy to identify data belong/from who -->
            
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Hantar</button>
            </div>

            <br>
            

            <p><i><b>***Untuk sebarang maklumat lanjut, sila hubungi +673 8282800 atau emel ke tpp@moe.gov.bn</b></i></p>


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