@extends('layouts.app-all')

@section('title', 'Index PJK')

@section('content')

<?php
$pagename = "PJK";
?>

<div class="pagetitle">
    <h1>Permohonan Jawatan Kosong</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">PJK</li>
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

        <div class="row mb-2" style="text-align: right;">
            <div class="col">
                <a href="{{ route('permohonans.permohonan.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                </a>
            </div>
        </div>


        <div class="col-12">
            <div class="card recent-sales">



                <div class="card-body overflow-auto">


                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">IC No.</th>
                                <th scope="col">Permohonan Jawatan</th>
                                <th scope="col">Tarikh Tutup Iklan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if(count($permohonans) == 0)

                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>

                            @else
                            @foreach($permohonans as $permohonan)

                            <tr>
                                <td>{{ $permohonan->name }}</td>
                                <td>{{ $permohonan->ic_no }}</td>
                                <td>{{ $permohonan->nama_jawatan }}</td>
                                @if ($permohonan ->tarikh_tutup==null)
                                <td></td>
                                @else
                                <td>{{ date('d/m/Y', strtotime($permohonan->tarikh_tutup)) }}</td>
                                @endif


                                <td>

                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('permohonans.permohonan.edit', $permohonan->id ) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>

                                        </form>


                                        <!----Delete Button----->
                                        <form method="post" action="{{ route('permohonans.permohonan.destroy', $permohonan->id ) }}">
                                            @csrf

                                            @method('delete')
                                             <a onclick='return confirm("Confirm to delete data?")'>

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


    @endsection