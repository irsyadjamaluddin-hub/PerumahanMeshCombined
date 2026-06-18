@extends('layouts.app-all')

@section('title', 'Staff Edit')

@section('content')

<?php
$pagename = "Staff Edit";
?>

<div class="pagetitle">
  <h1>Staff Edit</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('attendance.attendances.indexstaff') }}">Staff List</a></li>
      <li class="breadcrumb-item active">Staff Edit</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

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
                    <form method="post" action="{{ route('attendance.attendances.updatestaff') }}" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                            <h3 class="card-title"style="padding: 0px;">Staff Information</i></h3>
                            <hr>
                            <br>

                            <input type="text" name="id" value="{{ $attendsf->id }}" class="form-control" hidden>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">Name</label>
                                <div class="col-lg-9 col-md-9">
                                    <input type="text" name="name" value="{{ $attendsf->name }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">IC no / Birth Cert</label>
                                <div class="col-lg-9 col-md-9">
                                    <input type="text" name="identification" value="{{ $attendsf->identification }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">School</label>
                                <div class="col-lg-9 col-md-9">
                                    <select class="form-select" name="school" aria-label="Default select example" id="myselect" required>
                                        <option value="{{ $attendsf->school }}">{{ $attendsf->school }}</option>
                                        @foreach ($departments as $key => $value)
                                            <option value="{{ $value }}">
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">District</label>
                                <div class="col-lg-9 col-md-9">
                                    <select class="form-select" name="district" id="myselection">
                                        <option value= "{{ $attendsf->district }}" selected>{{ $attendsf->district }}</option>
                                        <option value= "Brunei Muara">Brunei Muara</option>
                                        <option value= "Tutong">Tutong</option>
                                        <option value= "Belait">Belait</option>
                                        <option value= "Temburong">Temburong</option>
                                    </select>
                                </div>
                            </div>

                            <br>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
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