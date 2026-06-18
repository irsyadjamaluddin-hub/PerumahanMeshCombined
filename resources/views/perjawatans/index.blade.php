@extends('layouts.app-all')

@section('title', 'Admin Perjawatan')

@section('content')

<?php
$pagename = "Admin_Perjawatan";
?>

<div class="pagetitle">
    <h1>Perjawatan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Perjawatan</li>
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
            <div class="col-md-10">

                <div class="search-bar">
                    <!-- Start Search Bar -->
                    <!-- <form class="search-form d-flex align-items-center" method="get" action="{{ route('perjawatan.perjawatan.searchIC') }}">
                        @csrf
                        <input class="form-control" type="text" name="ic_no" placeholder="Search by Name / IC Number (Eg. 00123456)">
                        <button type="submit" class="btn btn-primary" title="Search"><i class="bi bi-search"></i></button>
                    </form>
                </div> -->
                    <!-- End Search Bar -->

                </div>
                <div class="col-md-2">
                    <a href="{{ route('perjawatan.perjawatan.create') }}" class="btn btn-primary text-right">
                        Add New
                    </a>
                </div>
            </div>



            <!-- ART Table -->
            <div class="col-12">
                <div class="card recent-sales">



                    <div class="card-body overflow-auto">
                        <!-- <h5 class="card-title">Recent Sales <span>| Today</span></h5> -->

                        <table class="table table-borderless datatable mt-3">
                            <thead>
                                <tr>

                                    <th scope="col">No.Folio</th>
                                    <th scope="col">Kenaikan Bulan</th>
                                    <th scope="col">Tarikh Kenaikan</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">IC No</th>
                                    <th scope="col">Tanggagaji</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @if(count($jawatans) == 0)

                                <tr class="text-center">
                                    <td colspan="8">
                                        <h5>No records found</h5>
                                    </td>
                                </tr>

                                @else
                                @foreach($jawatans as $jawatan)

                                <tr>
                                    <td>{{ $jawatan->nofolio }}</td>
                                    @if ($jawatan ->appt_date==null)
                                    <td> </td>
                                    @else
                                    <td>{{ date('d/m/Y', strtotime($jawatan->appt_date)) }}</td>
                                    @endif

                                    @if ($jawatan ->promoted_date==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('d/m/Y', strtotime($jawatan->promoted_date))  }}</td>
                                    @endif

                                    <td>{{ $jawatan->name }}</td>
                                    <td>{{ $jawatan->ic_no }}</td>
                                    <td>{{ optional($jawatan->salaryScale)->label }}</td>

                                    <td>

                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                            <!----Show Button----->
                                            <form method="get" action="{{ route('perjawatan.perjawatan.show', $jawatan->ic_no) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary">
                                                    <i class="bi bi-eye-fill"></i>
                                                </button>
                                            </form>

                                            <!----Edit Button----->
                                            <form method="get" action="{{ route('perjawatan.perjawatan.edit', $jawatan->ic_no ) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                            </form>


                                            <!----Delete Button----->
                                            <form method="post" action="{{ route('perjawatan.perjawatan.destroy', $jawatan->id ) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-outline-danger">
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
            </div><!-- End Recent Sales -->

        </div>


</section>
@endsection