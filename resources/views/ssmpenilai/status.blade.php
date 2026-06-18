<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Borang Pertukaran Pegawai Penilai SSM</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


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

   <!-- Bootstrap JS -->
   <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>



  <style>
    p {
      font-size: 14px;
    }
    body {
      background: #4f77aa;
    }

    .centered-button {
        display: flex;
        justify-content: center;
        margin-top: 10px; /* Optional: Adds some space above the button */
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
                                    
                                    @if(Session::has('error_message'))
                                    <div class="alert alert-danger">
                                        <i class=" fas fa-fw fa-check"></i>
                                        {!! session('error_message') !!}
                                    </div>
                                    @endif

                                    <br>

                                    <center><img src="{{ asset('img/moe-logo-latest-compressed.png') }}" class="d-block w-50" alt="MOE LOGO"></center>

                                    <br>
                                
                                    <header class="card-title" style="padding: 0px; font-size: 18px;">Maklumat Pemohon Pegawai Penilai SSM</header>

                                    <hr>

                                    <div class="row mb-3">
                                        <label for="inputNama" class="col-lg-2 label">Nama:<i style="color:red;">*</i></label>
                                        <div class="col-lg-4">
                                                <input type="text" class="form-control" name="name" value="{{ $ssmp->name }}" readonly>
                                        </div>
                                        <label for="inputNama" class="col-lg-2 label">Email:<i style="color:red;">*</i></label>
                                        <div class="col-lg-4">
                                                <input type="email" class="form-control" name="email" value="{{ $ssmp->email }}" readonly>
                                        </div>
                                    </div>
                                    
                                    <!--<div class="row mb-3">
                                        <label for="inputNama" class="col-lg-2 label">No. IC:<i style="color:red;">*</i></label>
                                        <div class="col-lg-4">
                                                <input type="text" class="form-control" name="ic_no" value="{{ $ssmp->ic_no }}" readonly>
                                        </div>
                                        <label for="inputNama" class="col-lg-2 label">No. Telefon:<i style="color:red;">*</i></label>
                                        <div class="col-lg-4">
                                                <input type="text" class="form-control" name="phone_number" value="{{ $ssmp->phone_number }}" readonly>
                                        </div>
                                    </div> -->

                                    <!-- Button to open dialog -->
                                    <button type="button" class="btn btn-primary" id="openModalButton" data-bs-toggle="modal" data-bs-target="#verticalycentered" style="position: absolute; top: 10px; right: 10px;">
                                        <i class="bi bi-people-fill"></i>
                                    </button>

                                    <div class="modal fade" id="verticalycentered" tabindex="-1">
                                        <div class="modal-dialog modal-lg"> <!-- Use modal-lg for a larger modal -->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="min-height: auto;">
                                                    <div class="table-responsive"> <!-- Add responsive class -->
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Nama Pegawai Yang Dinilai</th>
                                                                    <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Nama Pegawai Penilai</th>
                                                                    <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-center">
                                                                @foreach($ssmpp as $ssmpps)
                                                                <tr>
                                                                    <td>{{ $ssmpps->name_peg }}</td>
                                                                    <td>{{ $ssmpps->name_pen }}</td>
                                                                    @if($ssmpps->status == 'Submitted')
                                                                      <td><span class="badge bg-primary">Submitted</span></td>
                                                                    @elseif($ssmpps->status == 'Selesai')
                                                                      <td><span class="badge bg-success">Selesai</span></td>
                                                                    @endif
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        @if($ssmp->status == 'Submitted')
                                            <div class="text-center">
                                                <label for="inputNama" class="col-lg-12 label"><span style="font-size:18px;">
                                                  <b>
                                                    Rujukan No: PP{{ $ssmp->id}}
                                                    <br>
                                                    Status: {{ $ssmp->status }}
                                                  </b></span></label>
                                            </div>
                                        @elseif($ssmp->status == 'Selesai')
                                            <div class="text-center">
                                                <label for="inputNama" class="col-lg-12 label"><span style="font-size:18px;">
                                                  <b>
                                                    Rujukan No: PP{{ $ssmp->id}}
                                                    <br>
                                                    Status: {{ $ssmp->status }}
                                                  </b>
                                                  </span>
                                                </label>
                                            </div>
                                        @endif   
                                    </div>
                                    
                                    <div class="text-center">
                                        <a href="{{ route('ssms.penilai.create') }}" class="btn btn-primary">
                                            Back to form
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>              
        </div>

    </section>
</body>

</html>