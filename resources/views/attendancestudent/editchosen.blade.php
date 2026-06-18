@extends('layouts.app-all')

@section('title', 'Edit Candidates')

@section('content')

<?php
$pagename = "Edit Candidates";
?>

<div class="pagetitle">
  <h1>Edit Candidates</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('attendance.attendances.indexchosen', $events->id ) }}">Candidates</a></li>
      <li class="breadcrumb-item active">Edit Candidates</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <div class="col-12">
        <div class="row mb-2">
            <div class="col-md-10">
                <form method="get" action="{{ route('attendance.attendances.indexchosen', $events->id ) }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left-square"></i>
                    </button>
                </form>
            </div>
            <div class="col-md-2" style="text-align:center;">
            </div>
        </div>

        <div class="card recent-sales">

            <div class="card-body">

                <div class="profile-overview pt-3">
                    <form method="post" action="{{ route('attendance.attendances.updatechosen') }}" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                            <h3 class="card-title"style="padding: 0px;">Candidate Information</i></h3>
                            <hr>
                            <br>

                            <input type="text" name="id" value="{{ $attenduser->id }}" class="form-control" hidden>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">Name</label>
                                <div class="col-lg-9 col-md-9">
                                    <input type="text" name="name" value="{{ $attenduser->name }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">Birth Cert</label>
                                <div class="col-lg-9 col-md-9">
                                    <input type="text" name="birth_cert" value="{{ $attenduser->birth_cert }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">IC No</label>
                                <div class="col-lg-9 col-md-9">
                                    <input type="text" name="ic_no" value="{{ $attenduser->ic_no }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">Year</label>
                                <div class="col-lg-9 col-md-9">
                                    <input type="text" name="year" value="{{ $attenduser->year }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">School Category</label>
                                <div class="col-lg-9 col-md-9">
                                    <select class="form-select" name="school_category" aria-label="Default select example" id="myselect" required>
                                        <option value="{{ $attenduser->school_category }}">{{ $attenduser->school_category }}</option>
                                        <option value="JSS">Jabatan Sekolah-Sekolah</option>
                                        <option value="JPS">Jabatan Pendidikan Swasta</option>
                                        <option value="JPKK">Jabatan Pendidikan Ko-kurikulum</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">Category</label>
                                <div class="col-lg-9 col-md-9">
                                    <select class="form-select" name="category" aria-label="Default select example" id="myselect" required>
                                        <option value="{{ $attenduser->category }}">{{ $attenduser->category }}</option>
                                        <option value="Pelajar">Pelajar</option>
                                        <option value="Guru Pengawas">Guru Pengawas</option>
                                        <option value="Guru Fokal">Guru Fokal</option>
                                        <option value="Hadrah">Hadrah</option>
                                        <option value="Kadet Tentera">Kadet Tentera</option>
                                        <option value="Kadet Polis Diraja Brunei">Kadet Polis Diraja Brunei</option>
                                        <option value="Kadet Bomba Dan Penyelamat">Kadet Bomba Dan Penyelamat</option>
                                        <option value="Pengakap">Pengakap</option>
                                        <option value="Bulan Sabit Merah">Bulan Sabit Merah</option>
                                        <option value="Pandu Puteri">Pandu Puteri</option>
                                        <option value="Persembahan Khas">Persembahan Khas</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">School</label>
                                <div class="col-lg-9 col-md-9">
                                    <select class="form-select" name="school" aria-label="Default select example" id="myselect" required>
                                        <option value="{{ $attenduser->school }}">{{ $attenduser->school }}</option>
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
                                        <option value= "{{ $attenduser->district }}" selected>{{ $attenduser->district }}</option>
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