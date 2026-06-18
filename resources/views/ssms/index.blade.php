@extends('layouts.app-all')

@section('title', 'Indeks SSM')

@section('content')

<?php
$pagename = "SSMS";
?>

<div class="pagetitle">
    <h1>SSM</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Laman Utama</a></li>
            <li class="breadcrumb-item">Pengguna</li>
            <li class="breadcrumb-item active">SSM</li>
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