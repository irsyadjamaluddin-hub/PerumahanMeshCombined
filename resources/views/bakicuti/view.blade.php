@extends('layouts.app-all')

@section('title', 'Borang Baki Cuti')

@section('content')

<?php
$pagename = "Online Notification Service";
?>

<div class="pagetitle">
    <h1>Send a Notification</h1>
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
                                <input type="text" name="name" class="form-control" value="{{$bc->name}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">No. Kad Pengenalan</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="text" name="ic_no" class="form-control" value="{{$bc->ic_no}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">Jabatan</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="text" name="department" class="form-control" value="{{$bc->department}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">No. Fail</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="text" name="file_no" class="form-control" value="{{$bc->file_no}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">No. Telefon</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="text" name="phone_number" class="form-control" value="{{$bc->phone_number}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">Status</label>
                            <div class="col-lg-9 col-md-9">
                            @if($bc->status == 'Submitted')
                                <span class="badge bg-primary">{{$bc->status}}</span>
                            @elseif($bc->status == 'Selesai')
                                <span class="badge bg-success">{{$bc->status}}</span>
                            @endif
                            </div>
                        </div>

                        @if($bc->status != 'Submitted')
                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">Tarikh Baki Cuti</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="text" name="tarikh_baki_cuti" class="form-control" value="{{$bc->tarikh_baki_cuti}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">Baki Cuti</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="text" name="baki_cuti" class="form-control" value="{{$bc->baki_cuti}}" readonly>
                            </div>
                        </div>
                        @endif

                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection