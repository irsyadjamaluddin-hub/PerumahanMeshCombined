@extends('layouts.app-all')

@section('title', 'Admin Edit List User')

@section('content')

<?php
	$pagename = "Edit User List";
?>


<!-- Start Page Title -->
	<div class="pagetitle">
		<h1>Edit User Information</h1>
			<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.html">Home</a></li>
			<li class="breadcrumb-item active"><a href="{{ route('users.user.index') }}">Users</a></li>  
		</ol>
		</nav>
	</div><!-- End Page Title -->

<section class="section profile">
	<a href="{{ route('users.user.index') }}" class= "btn btn-primary text-right mb-2">
		<i class="bi bi-arrow-left-circle"></i> 
	</a>
	
	{{-- User Table --}}
	<div class ="col-12">
		<div class="card recent-sales">
			<div class="card-body">
				<div class="profile-overview pt-3">
					<!-- <h3 class= "card-title"> Edit User Account</h3> -->

					{!! Form::model($user, [
						'method' => 'PUT',
						'route' => ['users.user.update', $user->id],
						'class' => 'form-horizontal',
						'name' => 'edit_user_form',
						'id' => 'edit_user_form',
						
					]) !!}
					@include ('users.formedit', ['role' => $user,])
					<div class="text-center">
						{!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>      
	</div>
</section>

@endsection

