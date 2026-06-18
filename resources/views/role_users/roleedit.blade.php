@extends('layouts.app-all')

@section('title', 'Edit Role')

@section('content')

  <?php
    $pagename = "Super_Admin_Role_User";
  ?>

<div class="pagetitle">
  <h1>Edit Role</h1>
  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item"><a href="{{ route('role_users.role_user.index') }}">Role User</a></li>
        <li class="breadcrumb-item"><a href="{{ route('role_users.role_user.roleindex') }}">Role List</a></li>
        <li class="breadcrumb-item active">Edit Role</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

@if(Session::has('success_message'))
<div class="alert alert-success">
    <i class=" fas fa-fw fa-check"></i>
    {!! session('success_message') !!}
</div>
@endif

<!----- Back out Button  ----->
<div class="col-md-1 text-left">
  <a href="{{ route('role_users.role_user.roleindex') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 10px;">
  <i class="bi bi-arrow-left-circle"></i>
  </a>
</div> 

<section class="section profile">

  <div class="col-12">
    <div class="card recent-sales">
      <div class="card-body">
        <div class="profile-overview">

          <form class="" method="post" action="{{ route('role_users.role_user.roleupdate') }}" enctype="multipart/form-data">
            @csrf
            <br>
            <br>
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Edit Role</h5>
            <br>
            <div class="row mb-3">
                <label class="col-sm-1 col-form-label pe-2 w-14">Role:</label>
                <div class="col-sm-3">
                    <input type="text" name="name" class="form-control" value="{{ $roles->name }}">
                    <input name="id" value="{{ $roles->id }}" hidden>
                </div>

                <label class="col-sm-1 col-form-label w-32">Description:</label>
                <div class="col-sm-4">
                    <textarea type="text" name="description" class="form-control" style="height:24px;" value="{{ $roles->description }}">{{ $roles->description }}</textarea>
                </div>
                <div class="col-sm-1">
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