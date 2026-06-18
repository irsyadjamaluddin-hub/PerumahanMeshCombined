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

        @if(Session::has('error_message'))
        <div class="alert alert-danger">
            <i class=" fas fa-fw fa-check"></i>
            {!! session('error_message') !!}
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

                                <!-- Button to open dialog -->
                                <button type="button" class="btn btn-primary" id="openModalButton" data-bs-toggle="modal" data-bs-target="#verticalycentered" style="position: absolute; top: 10px; right: 10px;">
                                    Rujukan Borang
                                </button>

                                <!-- Your form and other content -->

                                <div class="modal fade" id="verticalycentered" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Rujukan Borang</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form class="" method="post" action="{{ route('ssms.penilai.status') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row mb-3" style="margin-left: 0px; align-items: center;">
                                                    <label class="col-lg-1 col-form-label" style="width: 10rem;"> Rujukan ID</label>
                                                    <div class="col-lg-2">
                                                        <input type="text" class="form-control" value="PP" readonly>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <input type="text" name="id" class="form-control" required>
                                                            {!! $errors->first('id', '<p class="help-block text-danger">:message</p>')!!}
                                                    </div>
                                                </div>
                                                
                                                <div class="row mb-3" style="">
                                                    <div class="col-lg-12" style="text-align:center;">
                                                        <button id="submit-button" type="submit" class="btn btn-primary">Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Vertically centered Modal-->

                                    
                                    

                                    <br>

                                    <center><img src="{{ asset('img/moe-logo-latest-compressed.png') }}" class="d-block w-50" alt="MOE LOGO"></center>

                                    <br>
                                
                                    <header class="card-title" style="padding: 0px; font-size: 18px;">Borang Pertukaran Pegawai Penilai SSM</header>

                                    <hr>

                                    <header class="card-title" style="padding: 0px; font-size: 18px;">Requestor Details</header>
                                    <!-- Add an onchange event to the select element -->
                                    <form method="post" action="{{ route('ssms.penilai.store') }}"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="inputNama" class="col-lg-2 label">Nama:<i style="color:red;">*</i></label>
                                            <div class="col-lg-4">
                                                 <input type="text" class="form-control" name="name" required>
                                            </div>
                                            <label for="inputNama" class="col-lg-2 label">Email:<i style="color:red;">*</i></label>
                                            <div class="col-lg-4">
                                                 <input type="email" class="form-control" name="email" required>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <label for="inputNama" class="col-lg-2 label">No. IC:<i style="color:red;">*</i></label>
                                            <div class="col-lg-4">
                                                 <input type="text" class="form-control" name="ic_no" required>
                                            </div>
                                            <label for="inputNama" class="col-lg-2 label">No. Telefon:<i style="color:red;">*</i></label>
                                            <div class="col-lg-4">
                                                 <input type="text" class="form-control" name="phone_number" required>
                                            </div>
                                        </div>

                                        <div id="sectionsContainer">
                                            
                                        </div>  

                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="dynamic-ar">
                                            <i class="bi bi-plus-lg"></i> Tambah Pegawai
                                        </button>
                                        
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Hantar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>              
        </div>
        <script type="text/javascript">
            
            let sectionCount = 0;

            // Function to handle adding new sections
            $("#dynamic-ar").click(function () {
                sectionCount++;
                $("#sectionsContainer").append(`
                    <div class="section" id="section_${sectionCount}">
                        <hr>
                        <header class="card-title" style="padding: 0px; font-size: 18px;">Maklumat Pegawai Penilai</header>
                        <div class="row mb-3">
                            <label for="inputNama" class="col-lg-2 label">Nama Pegawai Penilai<i style="color:red;">*</i></label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" name="sections[${sectionCount}][nama_pegawai_penilai]" required>
                            </div>
                            <label for="inputNama" class="col-lg-2 label">No. Kad Pengenalan (Pegawai Penilai)<i style="color:red;">*</i></label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" name="sections[${sectionCount}][no_kad_pengenalan_penilai]" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Nama Pegawai Yang Dinilai</th>
                                        <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Jawatan</th>
                                        <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">No. Kad Pengenalan</th>
                                        <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="dynamicTable_${sectionCount}">
                                    <tr>
                                        <td><input type="text" name="sections[${sectionCount}][rows][0][nama_pegawai]" class="form-control" required></td>
                                        <td><input type="text" name="sections[${sectionCount}][rows][0][jawatan]" class="form-control" required></td>
                                        <td><input type="text" name="sections[${sectionCount}][rows][0][no_kad_pengenalan]" class="form-control" required></td>
                                        <td><button type="button" class="btn btn-primary" onclick="addRow(${sectionCount})"><i class="bi bi-person-plus"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="centered-button"> <!-- Centering the button -->
                            <button type="button" class="btn btn-danger" onclick="removeSection(${sectionCount})">Remove Section</button>
                        </div>
                    </div>
                `);
            });

            // Function to add rows to a specific section
            function addRow(sectionIndex) {
                const rowId = `dynamicTable_${sectionIndex}`;
                const rowCount = $(`#${rowId} tr`).length;
                $(`#${rowId}`).append(`
                    <tr>
                        <td><input type="text" name="sections[${sectionIndex}][rows][${rowCount}][nama_pegawai]" class="form-control"></td>
                        <td><input type="text" name="sections[${sectionIndex}][rows][${rowCount}][jawatan]" class="form-control"></td>
                        <td><input type="text" name="sections[${sectionIndex}][rows][${rowCount}][no_kad_pengenalan]" class="form-control"></td>
                        <td><button type="button" class="btn btn-danger" onclick="removeRow(this)"><i class="bi bi-person-dash"></i></button></td>
                    </tr>
                `);
            }

            // Function to remove a row
            function removeRow(button) {
                $(button).closest('tr').remove();
            }

            // Function to remove an entire section
            function removeSection(sectionIndex) {
                $(`#section_${sectionIndex}`).remove();
            }

        </script>

    </section>
</body>

</html>