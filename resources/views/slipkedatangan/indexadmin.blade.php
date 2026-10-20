@extends('layouts.app-all')

@section('title', 'Hadir @MOEBN')

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- #============= ORI CODE ============== --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: shared styles in public/css/mesh-home-theme.css, --}}
{{-- applied to everything inside the mesh-home-theme wrapper below. Light mode is unchanged. --}}
{{-- <link href="{{ asset('css/mesh-home-theme.css') }}?v={{ filemtime(public_path('css/mesh-home-theme.css')) }}" rel="stylesheet"> --}}
{{-- #================================ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" section; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
{{-- #================================ --}}
<style>
  /* Status text (set inline as green / red) */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-home-theme td[style*="green"] { color: #6ee7b7 !important; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-home-theme td[style*="red"] { color: #fca5a5 !important; }
</style>
<div class="mesh-home-theme">
{{-- #================================ --}}

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
            <div class="col-md-6">
            </div>
            <div class="col-md-6 d-flex flex-nowrap justify-content-end gap-2">
                <a href="{{ route('sk.slipkedatangan.createevent') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                </a>
                {{-- <a href="http://127.0.0.1:8000/sk"  target="_blank" class= "btn btn-primary">
                    <i class="bi bi-link"></i>
                </a> --}}
                <a href="{{ route('slipkehadiran') }}"  target="_blank" class= "btn btn-primary">
                    <i class="bi bi-link"></i>
                </a>

                <a href="/assets/img/qrcode/SlipKehadiran.jpg"  target="_blank" class= "btn btn-primary text-right">
                    <i class="bi bi-qr-code"></i>
                </a>

                {{-- ====== NEWLY ADDED ======== --}}
                {{-- Share Perkara by IC No. feature: shows every Perkara that has been shared with the logged-in user's IC No. (SKController@sharedWithMe) --}}
                <a href="{{ route('sk.slipkedatangan.sharedwithme') }}" class="btn btn-primary" title="Shared With Me">
                    <i class="ri-user-received-2-fill"></i>
                </a>
                {{-- ====== ========. --}}
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

{{-- <form method="GET" action="{{ route('export.excel') }}" class="form-inline" id="exportForm">
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
</script> --}}

<!-- export excel -->



            <table class="table table-borderless datatable mt-3">
              <thead>
                <tr>
                  <th scope="col">Jabatan</th>               <!-- NEWLY ADDED -->
                  <th scope="col">Perkara</th>
                  <th scope="col">Tarikh Bermula</th>
                  <th scope="col">Tarikh Berakhir</th>
                  <th scope="col">Status</th>
                  <th scope="col">Tindakan</th>
                </tr>
              </thead>
              <tbody>
  
              @if(count($skperkaras) == 0)

                <tr class="text-center">
                    <td colspan="8">
                        <h5>No records found</h5>
                    </td>
                </tr>

              @else

              @foreach($skperkaras as $skperkara)
              <tr>
                <td>{{ $skperkara['jabatan'] }}</td>
                <td>{{ $skperkara['label'] }}</td>
                <td>{{ $skperkara['tarikh_bermula'] }}</td>
                <td>{{ $skperkara['tarikh_berakhir'] }}</td>
                <td style="color: {{ $skperkara['status'] == 'active' ? 'green' : ($skperkara['status'] == 'inactive' ? 'red' : 'inherit') }}">
                    {{ $skperkara['status'] }}
                </td>

                
                <td>

                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                <!----show Button----->
                <form method="get" action="{{ route('sk.slipkedatangan.showslip', $skperkara['id']) }}">
                    @csrf

                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-eye-fill"></i>
                    </button>

                </form>
                
                <form method="GET" action="{{ route('export.excel') }}" class="form-inline" id="exportForm">
                    <div class="form-group">
                        <input type="hidden" name="filter" id="filterSelect" class="form-control" value="{{ $skperkara['label'] }}">
                    </div>
                    <button class="btn btn-success" type="submit" id="excelButton">Export Excel</button>
                </form>

                <form method="GET" action="{{ route('export.pdf') }}" class="form-inline" id="exportForm">
                    <div class="form-group">
                        <input type="hidden" name="filter" id="filterSelect" class="form-control" value="{{ $skperkara['label'] }}">
                    </div>
                    <button class="btn btn-primary" type="submit" id="pdfButton">Export PDF</button>
                </form>

                {{-- ====== NEWLY ADDED ======== --}}
                {{-- Share Perkara by IC No. feature: opens the Grant Access form for this Perkara (SKController@grantAccess -> accessske.blade.php) --}}
                <!----Grant Access Button----->
                <form method="post" action="{{ route('sk.slipkedatangan.accessske', $skperkara['id']) }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary" title="Add IC No.">
                        <i class="ri-user-add-fill"></i>
                    </button>
                </form>
                {{-- ====== ========. --}}

                <script>
                    document.getElementById('excelButton').addEventListener('click', function() {
                        document.getElementById('exportForm').action = "{{ route('export.excel') }}";
                    });
                
                    document.getElementById('pdfButton').addEventListener('click', function() {
                        document.getElementById('exportForm').action = "{{ route('export.pdf') }}";
                    });
                </script>
              
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

</section>

{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
@endsection
