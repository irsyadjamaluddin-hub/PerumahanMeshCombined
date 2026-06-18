@extends('layouts.app-all')

@section('title', 'Admin Create New List User')

@section('content')

<?php
    $pagename = "Create New User ";
  ?>

<!-- Start Page Title -->
<div class="pagetitle">
	<h1>Create New User </h1>
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

		@if(Session::has('success_message'))
				  <div class="alert alert-success">
					  <i class=" fas fa-fw fa-check"></i>
					  {!! session('success_message') !!}
				  </div>
			  @endif

			<div class="card recent-sales">

		      <div class="card-body">

				 <div class="profile-overview pt-3">

					<h3 class= "card-title"> Create User Account</h3>

                {!! Form::open([
                    'route' => 'users.user.store',
                    'class' => 'form-horizontal',
                    'name' => 'create_user_form',
                    'id' => 'create_user_form',
                    
                    ])
                !!}

                @include ('users.form', ['user' => null,])

                <div class="text-center">
                    {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
		
            </div>

		</div>
			</div>


	</div>
</div><!-- End Recent Sales -->
  </section>

@endsection

