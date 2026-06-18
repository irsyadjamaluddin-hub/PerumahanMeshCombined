@extends('layouts.app-all')

@section('title', 'Staff Form')

@section('content')

<?php
$pagename = "Staff Form";
?>

<div class="pagetitle">
  <h1>Staff Form</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('attendance.attendances.indexstaff') }}">Staff List</a></li>
      <li class="breadcrumb-item active">Staff Form</li>
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
        <div class="row mb-2">
            <div class="col-md-10">
                <a href="{{ route('attendance.attendances.indexstaff') }}" class="btn btn-primary text-right">
                    <i class="bi bi-arrow-left-circle"></i>
                </a>
            </div>
            <div class="col-md-2" style="text-align:center;">
            </div>
        </div>

        <div class="card recent-sales">

            <div class="card-body">

                <div class="profile-overview pt-3">
                    <form method="post" action="{{ route('attendance.attendances.storestaff') }}" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                            <h3 class="card-title"style="padding: 0px;">Staff Information</i></h3>
                            <hr>
                            <br>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">Name</label>
                                <div class="col-lg-9 col-md-9">
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">IC No</label>
                                <div class="col-lg-9 col-md-9">
                                    <input type="text" name="ic_no" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">School</label>
                                <div class="col-lg-9 col-md-9">
                                    <select class="form-select" name="school" aria-label="Default select example" id="myselect" required>
                                    @foreach ($departments as $key => $value)
                                        <option value="{{ $value }}">
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">Year</label>
                                <div class="col-lg-9 col-md-9">
                                    <input type="text" name="year" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">Classroom</label>
                                <div class="col-lg-9 col-md-9">
                                    <input type="text" name="classroom_name" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">District</label>
                                <div class="col-lg-9 col-md-9">
                                    <select class="form-select" name="district" id="myselection" required>
                                        <option selected disabled>Choose District</option>
                                        <option value= "BRUNEI MUARA">BRUNEI MUARA</option>
                                        <option value= "TUTONG">TUTONG</option>
                                        <option value= "BELAIT">BELAIT</option>
                                        <option value= "TEMBURONG">TEMBURONG</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">Classroom Name</label>
                                <div class="col-lg-9 col-md-9">
                                    <input type="text" name="classroom_name" class="form-control">
                                </div>
                            </div>
                            <br>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</section>

<script>
    $('#myselect').select2({
      width: '100%',
      placeholder: "Pilih Jabatan",
      allowClear: true
    });
  </script>
@endsection