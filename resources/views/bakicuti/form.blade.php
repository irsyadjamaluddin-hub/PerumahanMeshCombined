@extends('layouts.app-all')

@section('title', 'Borang Baki Cuti')

@section('content')

<?php
$pagename = "Borang Baki Cuti";
?>

<div class="pagetitle">
    <h1>Borang Baki Cuti</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('bakicuti.bakicutis.index') }}">Baki Cuti</a></li>  
            <li class="breadcrumb-item active">Borang Baki Cuti</li>  
        </ol>
    </nav>
</div><!-- End Page Title -->

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




<section class="section profile">

    <div class="col-12">

        <div class="card recent-sales">

            <div class="card-body">

                <div class="profile-overview pt-3">
                    <form method="post" action="{{ route('bakicuti.bakicutis.store') }}" enctype="multipart/form-data">
                    @csrf
                    <br>
                        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h3 class="card-title"style="padding: 0px;">Borang Baki Cuti</i></h3>
                        <hr>
                        <br>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">Nama</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="text" name="name" class="form-control" value="{{$bio->name}}">
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">No. Kad Pengenalanyou</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="text" name="ic_no" class="form-control" value="{{$bio->ic_no}}">
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">Jabatan</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="text" name="department" class="form-control" value="{{$empinfo->current_service_place}}">
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">No. Fail</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="text" name="file_no" class="form-control" value="{{$empinfo->personnel_file}}">
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">No. Telefon</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="text" name="phone_number" class="form-control" value="{{$empcontact->telephone_mobile}}">
                            </div>
                        </div>

                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Hantar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection