<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tanya MOEBN</title>
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
      background: #D7EAFF;
    }

  </style>

</head>

<body>

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

          <form class="" method="post" action="{{ route('soalanbiskita.soalanbiskita.store') }}" enctype="multipart/form-data">
          @csrf

            <br>


            <!-- <div class="col profile-overview" style="border: 8px solid #012970; padding: 20px; border-radius: 25px;"> -->
              <center><img src="/img/tanya-moebn-logo1.png" class="d-block w-75" alt="MOE LOGO" ></center>
              <br>

              
              <form>

              <div class="row mb-3">
                <label class="col-lg-3 col-form-label">Kepada:</label>
                <div class="col-lg-9">
                <input type="text" name="kpd_jabatan" class="form-control" value="Jabatan Pentadbiran dan Perkhidmatan-Perkhidmatan" readonly>
                               
             <!--      <select class="form-select" name="kpd_jabatan" aria-label="Default select example" id="myselect">
                  <option selected hidden>Pilih Jabatan</option>
                      @foreach ($sbdepartments as $key => $value)
                      <option value="{{ $value }}">
                          {{ $value }}
                      </option>
                      @endforeach
                  </select>
 -->
                  {!! $errors->first('kpd_jabatan', '<p class="help-block text-danger">:message</p>')!!}
                </div>
              </div>

             <!--  <div class="row mb-3">
                  <label for="inputTajuk" class="col-lg-3 col-form-label">Perkara:</label>
                  <div class="col-lg-9">
                   
                    <select class="form-select" name="tajuk">
                                  <option value=" "></option>
                                  <option value="Cuti">Cuti</option>
                                  <option value="Elaun Cuti">Elaun Cuti</option>
                                  <option value="Kaunseling">Kaunseling</option>
                                  <option value="Latihan Dalam Perkhidmatan(LDP)">Latihan Dalam Perkhidmatan(LDP)</option> 
                                  <option value="Memangku">Memangku</option>
                                  <option value="CSLP">CSLP</option>
                                  <option value="Persaraan">Persaraan</option>
                                  <option value="Pinjaman Pegawai">Pinjaman Pegawai</option>
                                  <option value="Sebulan Ke Sebulan">Sebulan Ke Sebulan</option>
                                  <option value="Sekatan Kecekapan">Sekatan Kecekapan</option>
                                  <option value="Skim-Skim Perkhidmatan">Skim-Skim Perkhidmaatan</option>
                                  <option value="Tambang">Tambang</option>
                                  <option value="Tatatertib">Tatatertib</option>
                                  <option value="Audit Tenaga Manusia">Audit Tenaga Manusia</option>
                                  <option value="Open Vote & Gaji Hari">Open Vote & Gaji Hari</option>
                                
                                             
                    </select>
                              {!! $errors->first('tajuk', '<p class="help-block text-danger">:message</p>') !!}
                  </div>

                </div> -->

                <div class="row mb-3">
                  <label class="col-lg-3 col-form-label">Perkara:<i style="color:red;">*</i></label>
                  <div class="col-lg-9">
                    <select class="form-select" name="tajuk" aria-label="Default select example" required>
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
                  <label for="inputAduan" class="col-lg-3 col-form-label">Pertanyaan:</label>
                  <div class="col-lg-9">
                    <textarea type="text" name="aduan" class="form-control" style="height: 100px" placeholder="" ></textarea>
                    
                    {!! $errors->first('aduan', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>
                <br>

                <hr>

                <p style="text-align: justify;">Maklumat yang mudah dihubungi. <i style="color:blue;"> Jika Perlu*</i></p>

                  
              <div class="row mb-3">
                  <label for="inputnama" class="col-lg-3 col-form-label">Nama:</label>
                  <div class="col-lg-9">
                    <input type="text" name="nama" class="form-control" placeholder="Nama" required>

                    {!! $errors->first('nama', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputtel" class="col-lg-3 col-form-label">No Tel:</label>
                  <div class="col-lg-9">
                    <input type="text" name="no_tel" class="form-control" placeholder="Nombor Telefon" required>

                    {!! $errors->first('no_tel', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

                 <div class="row mb-3">
                  <label for="inputtel" class="col-lg-3 col-form-label">Email:</label>
                  <div class="col-lg-9">
                    <input type="text" name="emel" class="form-control" placeholder="(Example: tanya.moe@moe.gov.bn)" required>

                    {!! $errors->first('emel', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>
                <br>
            
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