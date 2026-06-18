@extends('layouts.app-all')

@section('title', 'Hadir @MOEBN')

@section('content')

  <?php 
    $pagename = "Slip Kehadiran";
  ?>

    <div class="pagetitle">
      <h1>Hadir @MOEBN</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Hadir @MOEBN</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

<section class="section profile">

  <div class="col-md-12">

    @if(Session::has('success_message'))
      <div class="alert alert-success">
          <i class=" fas fa-fw fa-check"></i>
          {!! session('success_message') !!}
      </div>
    @endif

    <!-- ACT Table -->
     <div class="row mb-2">
            <div class="col-md-10">
            </div>
            <div class="col-md-2" style="text-align:center;">
                <a href="https://mesh.moe.gov.bn/sk"  target="_blank" class= "btn btn-primary">
                    <i class="bi bi-link"></i>
                </a>
                <a href="/assets/img/qrcode/SlipKehadiran.jpg"  target="_blank" class= "btn btn-primary text-right">
                    <i class="bi bi-qr-code"></i>
                </a>
            </div>
        </div>
    <div class="col-12">
      <div class="card recent-sales">
        <div class="card-body overflow-auto">

<!-- start export excel script -->
 <script>
    $(document).ready(function () {
        // When the user types in the filterInput, update the value of the hiddenFilter
        $("#filterInput").on("keyup", function () {
            var value = $(this).val();
            $("#hiddenFilter").val(value);
        });

        // Existing JavaScript for filtering...

        $("#exportToExcel").click(function () {
            $("#exportForm").submit();
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#exportToExcel").click(function (e) {
            e.preventDefault(); // Prevent the default form submission

            var filterValue = $("#filterInput").val(); // Get the filter value

            // Add the filter value to the form as a hidden input
            $("#exportForm").append('<input type="hidden" name="filter" value="' + filterValue + '">');

            // Submit the form
            $("#exportForm").submit();
        });
    });
</script>

<!-- end export excel script -->

<br>

<!-- export excel -->

<form method="GET" action="{{ route('export.excel') }}" class="form-inline" id="exportForm">
    <div class="form-group">
        <select name="filter" id="filterSelect" class="form-control">
            <option value="" disabled selected style="display:none;">Please Select</option>
            @foreach ($perkaradropdown as $key => $value)
                <option value="{{ $key }}"> 
                    {{ $value }} 
                </option>
            @endforeach    
        </select>
    </div>
    <button class="btn btn-success" type="submit" id="excelButton">Export Excel</button>
    <button class="btn btn-primary" type="submit" id="pdfButton">Export PDF</button>
</form>

<script>
    document.getElementById('excelButton').addEventListener('click', function() {
        document.getElementById('exportForm').action = "{{ route('export.excel') }}";
    });

    document.getElementById('pdfButton').addEventListener('click', function() {
        document.getElementById('exportForm').action = "{{ route('export.pdf') }}";
    });
</script>

<!-- export excel -->




            <table class="table table-borderless datatable mt-3">
              <thead>
                <tr>
                  <th scope="col">Perkara</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Jabatan</th>
                  <th scope="col">Tarikh</th>
                  <th scope="col">Catatan</th>
                  <th scope="col">Tindakan</th>
                </tr>
              </thead>
              <tbody>
  
              @if(count($borangs) == 0)

                <tr class="text-center">
                    <td colspan="8">
                        <h5>No records found</h5>
                    </td>
                </tr>

              @else

              @foreach($borangs as $borang)
              <tr>
                <td>{{ $borang->perkara }}</td>
                <td>{{ $borang->nama }}</td>
                <td>{{ $borang->jabatan }}</td>
                <td>{{ $borang->created_at }}</td>
                <td>{{ $borang->remark }}</td>
                <td>

                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                <!----show Button----->
                <form method="get" action="{{ route('sk.slipkedatangan.showadmin' , $borang->id) }}">
                    @csrf

                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-eye-fill"></i>
                    </button>

                </form>
              
                </td>
              </tr>
              @endforeach
              @endif

              </tbody>
            </table>

        </div>
      </div>
    </div><!-- End Recent Sales -->
    <div class="col-12">

<div class="card recent-sales">

  <div class="card-body">

    <div class="profile-overview pt-3">
        <h5 class="card-title">Perkara Baru</h5>
        <form class="" method="post" action="{{ route('sk.slipkedatangan.storeperkara') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-lg-1 col-form-label">Perkara:</label>
                <div class="col-lg-6">
                    <input type="text" name="label" class="form-control" placeholder="Perkara">
                        {!! $errors->first('nama', '<p class="help-block text-danger">:message</p>')!!}
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-outline-success" >
                       Update
                    </button>
                </div>
            </div>
        </form>

        <div class="card-body overflow-auto">


                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Perkara</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                           
                        
                        @if(count($skperkara) == null)
                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>

                        @else
                         @foreach($skperkara as $skp)   

                            <tr>
                                
                                <td>{{ $skp->label }}</td>
                                <td>{{ $skp->created_at }}</td>
                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example"> 
                                        <!----Delete Button----->
                                        <form method="post" onclick="return confirm('Are you sure?')" action="{{ route('sk.slipkedatangan.destroy', $skp->id ) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger" >
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                            @endif

                            
                           

                        </tbody>
                    </table>
                    
                </div>
    </div>

  </div>

  </div>

</section>

@endsection