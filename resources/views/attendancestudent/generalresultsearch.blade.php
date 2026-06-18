<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>General Search Result</title>
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
<link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

<link href="{{ asset('assets/vendors/animate.css/animate.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
<link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>



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

        .table-container {
            max-height: 400px; /* Adjust the height as needed */
            overflow-y: auto;
            overflow-x: auto;
        }
    </style>

</head>
<body>

       

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        

        <!-- Borang Table -->
        <div class="container">
            @if(Session::has('success_message'))
            <div class="alert alert-success">
                {{Session::get('success_message')}}
            </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-lg-8 d-flex flex-column align-items-center justify-content-center">

                    <div class="col-12">
                        <div class="card" style="padding-left: 20px; padding-right: 20px;">
                                          
                            <div class="card-body">
                            
                                <div class="profile-overview pt-3">

                                    <center><img src="{{ asset('img/moe-logo-latest-compressed.png') }}" class="d-block w-75" alt="MOE LOGO"></center>

                                    @if(Session::has('success_message'))
                                    <div class="alert alert-success">
                                        <i class=" fas fa-fw fa-check"></i>
                                        {!! session('success_message') !!}
                                    </div>
                                    @endif

                                    @if(Session::has('error_message'))
                                    <div class="alert alert-danger">
                                        <i class=" fas fa-fw fa-check"></i>
                                        {!! session('error_message') !!}
                                    </div>
                                    @endif

                                    <br>
                                    <form method="get" action="{{ route('attendance.attendances.generalsearch') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-caret-left-square"></i>
                                        </button>
                                    </form>        

                                    <br>
                                
                                    <center class="card-title" style="padding: 0px; font-size: 18px;">Kehadiran Majlis </center>

                                    <!-- Custom Search Input and Button -->
                                    <form action="{{ route('attendance.attendances.searchlist') }}" method="GET">
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <input type="text" id="term" class="form-control" name="query" placeholder="Search">
                                                <input type="text" id="searchInput" class="form-control" name="roles" value="{{ $roles }}">
                                            </div>
                                            <div class="col-md-2">
                                                <button id="searchButton" type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                    

                                    <hr>

                                    <!-- Add an onchange event to the select element -->
                                    <div class="table-container">
                                        <table id="myTable" class="table table-borderless datatable mt-3">                         
                                            <thead>
                                                <tr>
                                                    <th scope="col">Name</th> 
                                                    <th scope="col">IC/Birth Cert</th>
                                                    <th scope="col">District</th>
                                                    <th scope="col" style="text-align: center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($result) == 0)
                                                <tr class="text-center">
                                                    <td colspan="8">
                                                        <h5>No records found</h5>
                                                    </td>
                                                </tr>
                                                @else
                                                @foreach($result as $results)
                                                <tr>
                                                    <td>{{ $results->name }}</td>
                                                    @if($roles == 'Pelajar')
                                                        @if($results->ic_no != null)
                                                            <td>{{ $results->ic_no }}</td>
                                                        @else
                                                            <td>{{ $results->birth_cert }}</td>
                                                        @endif
                                                    @else
                                                    <td>{{ $results->ic_no }}</td>
                                                    @endif
                                                    <td>{{ $results->district }}</td>
                                                    @if($results->hadir ==null )
                                                    <td style="text-align: center">
                                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                                            <form method="post" action="{{ route('attendance.attendances.hadirupdate') }}"  enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="text" name="id" value="{{ $results->id }}" class="form-control" hidden>

                                                                <input type="text" name="roles" value="{{ $roles }}" class="form-control" hidden>
                                                                
                                                                <button type="submit" class="btn btn-outline-success">
                                                                    <i class="bi bi-check-square"></i>
                                                                </button>
                                                            </form>                                               
                                                        </div> 
                                                    </td>
                                                    @else
                                                    <td style="text-align: center;">
                                                        <b style="color: green;">Hadir</b>
                                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                                            <form method="post" action="{{ route('attendance.attendances.hadirrefresh') }}"  enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="text" name="id" value="{{ $results->id }}" class="form-control" hidden>

                                                                <input type="text" name="roles" value="{{ $roles }}" class="form-control" hidden>
                                                                
                                                                <button type="submit" class="btn btn-outline-primary">
                                                                    <i class="bi bi-arrow-repeat"></i>
                                                                </button>
                                                            </form>                                               
                                                        </div>
                                                    </td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                                
                                                @endif        
                                            </tbody>
                                        </table>
                                    </div>

                                    <script>
                                        $(document).ready(function() {
                                            var table = $('.datatable').DataTable({
                                                "searching": true,
                                                "paging": true,
                                                "info": true,
                                                "autoWidth": false
                                            });

                                            // Add event listener for custom search button
                                            $('#searchButton').on('click', function() {
                                                var searchTerm = $('#searchInput').val();
                                                table.search(searchTerm).draw();
                                            });
                                        });
                                    </script>

                                    
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>              
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