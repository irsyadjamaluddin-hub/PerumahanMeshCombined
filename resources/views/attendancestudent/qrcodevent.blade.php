<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Attendance {{ $event->name }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <link href="assets/vendors/animate.css/animate.min.css" rel="stylesheet">
  
  <!-- Template Main CSS File -->
  <link href="assets/css/admin.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

   <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
  <script src="{{ asset('assets/js/apexcharts-bundle.js') }}"></script>


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

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">

  <!-- Borang Table -->
  <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 d-flex flex-column align-items-center justify-content-center">

  <div class="col-12">
    <div class="card" style="padding-left: 20px; padding-right: 20px;">



      <div class="card-body">

        <div class="profile-overview pt-3">

        @if(Session::has('success_message'))
        <div class="alert alert-success">
            {{Session::get('success_message')}}
        </div>
        @endif

        @if(Session::has('error_message'))
        <div class="alert alert-danger">
            <i class=" fas fa-fw fa-check"></i>
            {!! session('error_message') !!}
        </div>
        @endif

          <form class="" method="post" action="{{ route('attendance.attendances.qrcodeeventstore') }}" enctype="multipart/form-data">
          @csrf

            <br>

            <!-- <div class="col profile-overview" style="border: 8px solid #012970; padding: 20px; border-radius: 25px;"> -->
              <center><img src="{{ asset('img/newmoelogo.png') }}" class="d-block w-50" alt="MOE LOGO"></center>
              <br>
              <header class="card-title" style="padding: 0px; font-size: 18px;">MOE Attendance {{ $event->name }}</header>
              
   
              <hr>
              <form>

              <input type="text" name="event" class="form-control" placeholder="Event" value="{{ $event->name }}" hidden>


              <div class="row mb-3">
                    <label class="col-lg-4 col-form-label">District<i style="color:red;">*</i></label>
                    <div class="col-lg-8">
                        <select class="form-select" name="district" aria-label="Default select example" id="myselectjawatan" required>
                            <option selected hidden>Pilih District</option>
                            <option value="Brunei Muara">Brunei Muara</option>
                            <option value="Tutong">Tutong</option>
                            <option value="Belait">Belait</option>
                            <option value="Temburong">Temburong</option>
                        </select>

                        {!! $errors->first('district', '<p class="help-block text-danger">:message</p>')!!}
                    </div>
                </div>

                   <div class="row mb-3">
                <label class="col-lg-4 col-form-label">Sekolah<i style="color:red;">*</i></label>
                <div class="col-lg-8">
                  <select class="form-select" name="school" aria-label="Default select example" id="myselect" required>
                  <option selected hidden disabled>Pilih Sekolah</option>
                        @foreach ($departments as $key => $value)
                        <option value="{{ $value }}">
                            {{ $value }}
                        </option>
                        @endforeach
                  </select>

                  {!! $errors->first('school', '<p class="help-block text-danger">:message</p>')!!}
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-lg-4 col-form-label">Sekolah Kategori<i style="color:red;">*</i></label>
                <div class="col-lg-8">
                  <select class="form-select" name="school_category" aria-label="Default select example" id="myselect" required>
                  <option selected hidden disabled>Pilih Kategori Sekolah</option>
                        <option value="JSS">Jabatan Sekolah-Sekolah</option>
                        <option value="JPS">Jabatan Pendidikan Swasta</option>
                        <option value="JPKK">Jabatan Pendidikan Ko-kurikulum</option>
                  </select>

                  {!! $errors->first('school', '<p class="help-block text-danger">:message</p>')!!}
                </div>
              </div>
              
                <div class="row mb-3">
                    <label class="col-lg-4 col-form-label">Category<i style="color:red;">*</i></label>
                    <div class="col-lg-8">
                        <select class="form-select" name="category" aria-label="Default select example" id="myselectjawatan" required>
                            <option selected hidden disabled>Pilih category</option>
                            <option value="Pelajar">Pelajar</option>
                            <option value="Guru Pengawas">Guru Pengawas</option>
                            <option value="Guru Fokal">Guru Fokal</option>
                            <option value="Hadrah">Hadrah</option>
                            <option value="Kadet Tentera">Kadet Tentera</option>
                            <option value="Kadet Polis Diraja Brunei">Kadet Polis Diraja Brunei</option>
                            <option value="Kadet Bomba Dan Penyelamat">Kadet Bomba Dan Penyelamat</option>
                            <option value="Pengakap">Pengakap</option>
                            <option value="Bulan Sabit Merah">Bulan Sabit Merah</option>
                            <option value="Pandu Puteri">Pandu Puteri</option>
                            <option value="Persembahan Khas">Persembahan Khas</option>
                        </select>

                        {!! $errors->first('category', '<p class="help-block text-danger">:message</p>')!!}
                    </div>
                </div>

                <div class="row mb-3">
                  <label for="inputnama" class="col-lg-4 col-form-label">Full Name<i style="color:red;">*</i></label>
                  <div class="col-lg-8">
                    <input type="text" name="name" class="form-control" placeholder="Nama" required>
                    {!! $errors->first('nama', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
                </div>

           

                <div class="row mb-3">
            <label for="inputtel" class="col-lg-4 col-form-label">IC No.</label>
            <div class="col-lg-8">
                <input type="text" name="ic_no" class="form-control" pattern="\d{8}" title="Please enter IC No in digits only" placeholder="example: 00123456">
                {!! $errors->first('icno', '<p class="help-block text-danger">:message</p>') !!}
            </div>
        </div>

                <div class="row mb-3">
            <label for="inputtel" class="col-lg-4 col-form-label">Birth Cert<i style="color:black;"> (If Available) </i></label>
            <div class="col-lg-8">
                <input type="text" name="birth_cert" class="form-control">
                {!! $errors->first('birth_cert', '<p class="help-block text-danger">:message</p>') !!}
            </div>
        </div>

                <div class="row mb-3">
                    <label class="col-lg-4 col-form-label">Year</label>
                    <div class="col-lg-8">
                        <input type="text" name="year" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-4 col-form-label">Classroom Name</label>
                    <div class="col-lg-8">
                        <input type="text" name="classroom_name" class="form-control">
                    </div>
                </div>
            
          <div class="text-center">
              <button type="submit" id="submitBtn" class="btn btn-primary">Hantar</button>
          </div>

          <script>
              // Disable the submit button after it's clicked
              document.getElementById('submitBtn').addEventListener('click', function() {
                  this.disabled = true; // Disable the button
                  this.form.submit(); // Submit the form
              });
          </script>


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
