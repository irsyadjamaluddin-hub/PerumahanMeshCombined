@extends('layouts.app-all')

@section('title', 'Selected Candidates ')

@section('content')

<?php
$pagename = "Selected Candidates ";
?>

<div class="pagetitle">
  <h1>Selected Candidates </h1>
  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('attendance.attendances.indexchosen', $events->id) }}">Candidates</a></li>
        <li class="breadcrumb-item active">Selected Candidates </li>
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
    <i class="fa fa-exclamation-triangle"></i>
    {!! session('error_message') !!}
</div>
@endif

<section class="section profile">

    <div class="col-12">
        <div class="card recent-sales">

            <div class="card-body">

                <div class="profile-overview pt-3">
                    <form method="post" action="{{ route('attendance.attendances.formchosenstore') }}" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                            <h3 class="card-title"style="padding: 0px; text-align: center;">Selected Candidates</h3>
                            <hr>
                            <br>
                            <input name="events" value="{{ $events->id }}" hidden />
                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3 label">Category</label>
                                <div class="col-lg-9 col-md-9">
                                    <select class="form-select" name="category" id="categorySelect" aria-label="Default select example" required>
                                        <option selected disabled>-- Pilih Satu --</option>
                                        <option value="Pengawas">Pengawas</option>
                                        <option value="Pelajar">Pelajar</option>
                                    </select>
                                </div>
                            </div>
                            <div id="pelajarRow" style="display:none;">
                                <div class="row">
                                    <label for="inputText" class="col-lg-2 col-md-3 label">Name</label>
                                    <div class="col-lg-9 col-md-9">
                                        <select class="form-select" id="myselectname" name="idstudent" aria-label="Default select example" required>
                                            @foreach ($attendst as $attendsts)
                                                <option value="{{ $attendsts->id }}">
                                                    {{ $attendsts->name }} , {{ $attendsts->ic_no }} , {{ $attendsts->school }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="pegawasRow" style="display:none;">
                                <div class="row">
                                    <label for="inputText" class="col-lg-2 col-md-3 label">Name</label>
                                    <div class="col-lg-9 col-md-9">
                                        <select class="form-select" id="myselect" name="idstaff" aria-label="Default select example" required>
                                            @foreach ($attendsf as $attendsfs)
                                                <option value="{{ $attendsfs->id }}">
                                                    {{ $attendsfs->name }} , {{ $attendsfs->ic_no }} , {{ $attendsfs->school }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
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
    document.getElementById('categorySelect').addEventListener('change', function() {
        var category = this.value;
        if (category === 'Pengawas') {
            document.getElementById('pegawasRow').style.display = 'block';
            document.getElementById('pelajarRow').style.display = 'none';
        } else if (category === 'Pelajar') {
            document.getElementById('pegawasRow').style.display = 'none';
            document.getElementById('pelajarRow').style.display = 'block';
        }
    });
</script>
<script>
    $('#myselect').select2({
      width: '100%',
      placeholder: "Pilih Calonan",
      allowClear: true
    });
  </script>

<script>
    $('#myselectname').select2({
      width: '100%',
      placeholder: "Pilih Calonan",
      allowClear: true
    });
  </script>
@endsection