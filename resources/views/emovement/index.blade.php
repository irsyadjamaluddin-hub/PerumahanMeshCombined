@extends('layouts.app-all')

@section('title', 'Index ')

@section('content')

<?php
$pagename = "EM";
?>

<div class="pagetitle">
    <h1>Pergerakan Pekerja</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Pergerakan Pekerja</li>
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
        <span><b>Total Records: {{ $countAll }}</b>

        <div class="row mb-2" style="text-align: right;">
            <div class="col">
                <a href="" class="btn btn-primary">
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
                                <th scope="col">IC No.</th>
                                <th scope="col">Jabatan Asal</th>
                                <th scope="col">Bahagian/Unit</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                           
                        
                        @if(count($employment) == null)
                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>

                        @else
                         @foreach($employment as $emp)   

                            <tr>
                                
                                <td>{{ $emp->ic_no }}</td>
                                <td>{{ $emp->label }}</td>
                                <td>{{ $emp->unit_id }}</td>
                                <td class="text-success">{{ $emp->status_penempatan}}</td>
                               
                                <td>

                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                    <!----Edit Button----->
                                    <form method="get" action="{{ route('emovements.emovement.edit', $emp->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                            </form>

                                        <!----View Button----->
                                        <form method="get" action="{{ route('emovements.emovement.view',  $emp->id)}}">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye-fill"></i>
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