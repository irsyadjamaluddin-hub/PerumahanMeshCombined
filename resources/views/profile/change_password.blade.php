@extends('layouts.app-all')

@section('title', 'Change Password')

@section('content')

  <?php
    $pagename = "Dashboard";
  ?>

<!-- <div class="pagetitle">
      <h1>Change Password</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Change Password</li>
        </ol>
      </nav>
</div> -->

<div class="container">
<div class="row justify-content-center">

<div class="col-lg-6">

<div class="card mb-3">

<div class="card-body">

  <div class="pt-4 pb-2">
	<h5 class="card-title text-center pb-0 fs-4">Change Password</h5>
	<!-- <p class="text-center small">Enter your username & password to login</p> -->
  </div>

	<form action="{{route('update_password')}}" id="change_password_form" method="post">
		@csrf
	   <div class="form-group">
		<label for="old_password">Old Password</label>
		<input type="password" name="old_password" class="form-control" id="old_password" >
	
		@if($errors->any('old_password'))
		  <span class="text-danger">{{$errors->first('old_password')}}</span>
		@endif
	  </div>
	  <br>
	  <div class="form-group">
		<label for="password">New Password</label>
		<input type="password" name="new_password" class="form-control" id="new_password" >
		@if($errors->any('new_password'))
		  <span class="text-danger">{{$errors->first('new_password')}}</span>
		@endif
	  </div>
	  <br>
	  <div class="form-group">
		<label for="confirm_password">Confirm Password</label>
		<input type="password" name="confirm_password" class="form-control" id="confirm_password" >
		@if($errors->any('confirm_password'))
		  <span class="text-danger">{{$errors->first('confirm_password')}}</span>
		@endif
	  </div>
	  <br>
	  <div class="text-center mt-2 mb-2">
	  <button type="submit" class="btn btn-primary">Update Password</button>
		</div>
	</form>

</div>
</div>

</div>
</div>
</div>

@endsection