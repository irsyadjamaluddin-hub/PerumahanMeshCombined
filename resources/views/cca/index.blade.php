@extends('layouts.app-all')

@section('title', 'Pengurusan Aktiviti Ko-Kurikulum')

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
<div class="mesh-home-theme">
{{-- #================================ --}}

<?php
$pagename = "CCA";
?>




<div class="pagetitle">
    <h1>Pengurusan Aktiviti Ko-Kurikulum</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Pengurusan Aktiviti Ko-Kurikulum </li>
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
            <div class="col-lg-10">


            </div>

        <!--     <div class="col-lg-2" style="text-align: right;">
                <a href="{{ route('cca.cca.create') }}" class="btn btn-primary text-right">
                 <i class="bi bi-file-earmark-plus"></i>
                </a>
            </div> -->
        </div>


        <!-- W.A>L Table -->
        <div class="col-12">
            <div class="card recent-sales">



                <div class="card-body overflow-auto">


                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Nama Sekolah</th>
                                <th scope="col">Kluster</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Dikemasikini Oleh</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @if(count($ccas) == 0)

                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>

                            @else
                            @foreach($ccas as $cca)

                            <tr>

                                <td>{{ optional($cca->schools)->label }}</td>
                                <td>{{ $cca->kluster}}</td>
                                <td>{{ $cca->year }}</td>
                                <td>{{ $cca->created_by_ic_no }}</td>

                                <td>

                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('cca.cca.edit', $cca->id ) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>

                                        </form>

                                        <!----show Button----->
                                        <form method="get" action="{{ route('cca.cca.show', $cca->id ) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>

                                        </form>

                                        <!----dashboard Button----->
                                        <form method="get" action="{{ route('cca.cca.dashboard', $cca->id ) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-bar-chart-line"></i>
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
        </div><!-- End Recent Sales -->

    </div>


{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
    @endsection