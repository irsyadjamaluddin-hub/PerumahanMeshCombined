@extends('layouts.app-all')

@section('title', 'Task Tracking Status')

@section('content')

<?php
$pagename = "TaskTracking";
?>

<div class="pagetitle">
    <h1>Task Tracking Status</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item"><a href="{{ route('tasktracking.indextasktracking') }}">Task Tracking (MEC)</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tasktracking.statustindakan') }}">Status/Tindakan</a></li>
            <li class="breadcrumb-item active">Edit Status</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<!----- Back out Button  ----->
<div class="col-md-1 text-left">
    <a href="{{ route('tasktracking.statustindakan') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 10px;">
        <i class="bi bi-arrow-left-circle"></i>
    </a>
</div>

<section class="section profile">
    <div class="col-12">
        <div class="card recent-sales">
            <div class="card-body">
                <div class="profile-overview">
                    <form class="" method="post" action="{{ route('tasktracking.updatestatus') }}" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <br>
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Edit Status</h5>
                        <br>
                        <div class="row mb-3">
                            <label class="col-lg-1 col-form-label" style="width: 10rem;">Status:</label>
                            <div class="col-lg-6">
                                <input type="text" name="text" class="form-control" value="{{ $statuss->text }}">
                                <input name="id" value="{{ $statuss->id }}" hidden>
                                {!! $errors->first('nama', '<p class="help-block text-danger">:message</p>')!!}
                            </div>
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-outline-success" >
                                Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<!-- Include Dropzone.css in the head of your layout file -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">

<!-- Include Dropzone.js at the bottom of your layout file, after jQuery or any other dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

<!-- Your JavaScript code -->
<script>
    Dropzone.options.fileDropzone = {
        paramName: "dc_file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        init: function () {
            this.on("success", function (file, response) {
                // Handle the success response, if needed
                console.log(response);
            });

            this.on("removedfile", function (file) {
                // Handle the file removal, if needed
                console.log(file);
            });
        },
    };
</script>

<script>
    $('#myselect').select2({
    width: '100%',
    placeholder: "Pilih Jabatan",
    allowClear: true
    });
</script>
