@extends('layouts.app-all')

@section('title', 'Indeks SSM')

@section('content')

<?php
$pagename = "SSMS";
?>

{{-- #============= ORI CODE ============== --}}
{{-- <div class="pagetitle"> --}}
{{-- #================================ --}}
{{-- mesh-ssms-page: hook for this page's dark mode styles (see the <style> block below) --}}
<div class="pagetitle mesh-ssms-page">
{{-- #================================ --}}
    <h1>SSM</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Laman Utama</a></li>
            <li class="breadcrumb-item">Pengguna</li>
            <li class="breadcrumb-item active">SSM</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

{{-- #============= ORI CODE ============== --}}
{{-- <section class="section profile"> --}}
{{-- #================================ --}}
<section class="section profile mesh-ssms-page">
{{-- #================================ --}}

{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode for this page in the Home page theme (Oct 2026), same design as linkup/index.blade.php: deep purple card --}}
{{-- with a violet border, gold active tab, purple title bars with gold text, lavender table headings, violet "+" button, --}}
{{-- gold outlined edit/view buttons. Only applies when the sun/moon switch is on dark; light mode is unchanged. --}}
{{-- !important is needed where the page uses inline styles (title bars) or app-all has global !important rules (.btn-primary). --}}
<style>
  /* Breadcrumb: no light grey bar in dark mode, current page in gold */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .breadcrumb { background: transparent; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .breadcrumb .breadcrumb-item.active { color: #f3c35f; }

  /* "+" (new SSM) button */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .btn-primary {
    background-color: #6d4bc4 !important; border-color: #6d4bc4; color: #ffffff;
  }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .btn-primary:hover { background-color: #7c5cdb !important; border-color: #7c5cdb; }

  /* Card */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .card {
    background: #1c1340; border: 1px solid #3a2768;
    box-shadow: 0 1px 2px rgba(0,0,0,.3), 0 8px 24px rgba(0,0,0,.35);
  }

  /* Utama / Sejarah tabs */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .nav-tabs-bordered { border-bottom-color: #3a2768; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .nav-tabs-bordered .nav-link { color: #9aa2bd; background: transparent; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .nav-tabs-bordered .nav-link:hover { color: #e8eaf4; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .nav-tabs-bordered .nav-link.active {
    color: #f3c35f; background: transparent; border-bottom: 2px solid #f3c35f;
  }

  /* Title bars ("Utama" was steel blue, "Sejarah" green, both inline) */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .card-title[style] {
    background-color: #2a1d5c !important; color: #f3c35f !important; border-radius: 10px !important; letter-spacing: .02em;
  }

  /* Table (simple-datatables: "20 rekod setiap halaman", "Cari...", "Memaparkan 1 hingga 1 daripada 1 rekod") */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .table th { color: #c4b5fd; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .table th,
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .table td { border-bottom: 1px solid #3a2768; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .dataTable-input,
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .dataTable-selector {
    background-color: #140d30; border-color: #3a2768; color: #e8eaf4;
  }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .dataTable-top,
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .dataTable-bottom,
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .dataTable-table > thead > tr > th { border-color: #3a2768; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .dataTable-info { color: #9aa2bd; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .dataTable-pagination .active a { background-color: #6d4bc4; color: #ffffff; }

  /* Edit / view buttons */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .btn-outline-primary { border-color: #f3c35f; color: #f3c35f; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-ssms-page .btn-outline-primary:hover { background-color: #f3c35f; color: #1c1340; }
</style>
{{-- #================================ --}}

    <div class="col-md-12">

        @if(Session::has('success_message'))
        <div class="alert alert-success">
            <i class=" fas fa-fw fa-check"></i>
            {!! session('success_message') !!}


        </div>
        @endif

        <div class="row mb-2">

            @if(count($ssms) == 0)

            <div class="col-md-1">

                <a href="{{ route('ssms.ssm.create') }}" class="btn btn-primary text-right">

                    <i class="bi bi-plus-lg"></i>
                </a>
            </div>
            @else

            <div class="col-md-1">

                <a href="{{ route('ssms.ssm.create') }}" class="btn btn-primary text-right">

                    <i class="bi bi-plus-lg"></i>
                </a>
            </div>
            @endif
        </div>


        <!-- ART Table -->
        <div class="col-12">
            <div class="card recent-sales">

                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#in">Utama</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#out">Sejarah</button>
                    </li>
                </ul>
                <br>
                <div class ="tab-content pt-2">
                    <!-- first tab -->
                    <div class="tab-pane fade show active in" id="in">
                        <div class="card-body overflow-auto">
                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Utama</h5>
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">No. KP</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tindakan</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($ssmsone) == 0)

                                    <tr class="text-center">
                                        <td colspan="8">
                                            <h5>Tiada rekod dijumpai</h5>
                                        </td>
                                    </tr>

                                    @else

                                    <tr>
                                        <td>{{ $ssmsone->name }}</td>
                                        <td>{{ $ssmsone->ic_no }}</td>
                                        @if($ssmsone->status_ssm == null)
                                        <td>Permohonan Diterima</td>
                                        @else
                                        <td>{{ $ssmsone->status_ssm }}</td>
                                        @endif


                                        <td>

                                            <div class="btn-group gap-2" role="group" aria-label="Contoh Asas">


                                            <!----Edit Button----->
                                            <!-- <form method="get" action="{{ route('ssms.ssm.edituser', $ssmsone->id ) }}"> -->
                                               <form method ="get" action="{{ route('ssms.ssm.edituser', ['ssm' => Crypt::encryptString($ssmsone->id)])}}">
                                                    @csrf

                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>

                                                </form>


                                                <!----Show Button----->
                                                <form method="get" action="{{ route('ssms.ssm.show', $ssmsone->id) }}">
                                                    @csrf

                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </button>

                                                </form>
                                                <!----Delete Button----->
                                                <!-- <form method="post" action="{{ route('ssms.ssm.destroy', $ssmsone->id ) }}">
                                                    @csrf

                                                    @method('delete')
                                                    <a onclick='return confirm("Sahkan untuk padam data?")'>

                                                        <button type="submit" class="btn btn-outline-danger">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>

                                                </form> -->
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- second tab -->
                    <div class="tab-pane fade out" id="out">
                        <div class="card-body overflow-auto">
                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #006A4E;">Sejarah</h5>
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">No. KP</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tindakan</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($ssms) == 0)

                                    <tr class="text-center">
                                        <td colspan="8">
                                            <h5>Tiada rekod dijumpai</h5>
                                        </td>
                                    </tr>

                                    @else
                                    @foreach($ssms as $ssm)

                                    <tr>
                                        <td>{{ $ssm->name }}</td>
                                        <td>{{ $ssm->ic_no }}</td>
                                        @if($ssm->status_ssm == null)
                                        <td>Permohonan Diterima</td>
                                        @else
                                        <td>{{ $ssm->status_ssm }}</td>
                                        @endif


                                        <td>

                                            <div class="btn-group gap-2" role="group" aria-label="Contoh Asas">


                                            <!----Edit Button----->
                                            <form method="get" action="{{ route('ssms.ssm.editoneuser', $ssm->id ) }}">
                                                    @csrf

                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>

                                                </form>


                                                <!----Show Button----->
                                                <form method="get" action="{{ route('ssms.ssm.show', $ssm->id) }}">
                                                    @csrf

                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </button>

                                                </form>


                                                <!----Delete Button----->
                                                <!-- <form method="post" action="{{ route('ssms.ssm.destroy', $ssm->id ) }}">
                                                    @csrf

                                                    @method('delete')
                                                    <a onclick='return confirm("Sahkan untuk padam data?")'>

                                                        <button type="submit" class="btn btn-outline-danger">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>

                                                </form> -->

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
            </div><!-- End Recent Sales -->
        </div>
    </div>
</section>


    @endsection