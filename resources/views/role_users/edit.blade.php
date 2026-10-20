@extends('layouts.app-all')

@section('title', 'Super Admin Edit Role User')

@section('content')

<?php
    $pagename = "Super_Admin_Role_User";
  ?>

    <div class="pagetitle">
      <h1>Role User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Role User</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

      
                    <a href="{{ route('role_users.role_user.index') }}" class= "btn btn-primary text-right mb-2">
                    <i class="bi bi-arrow-left-circle"></i> 
                    </a>
           

       

         <!-- ART Table -->
         <div class="col-12">
              <div class="card recent-sales">

             

                <div class="card-body">

                <div class="profile-overview pt-3">

                  <h3 class="card-title">Edit Role User Form</h3>

                

                  {!! Form::model($roleUser, [
                    'method' => 'PUT',
                    'route' => ['role_users.role_user.update', $roleUser->id],
                    'class' => 'form-horizontal',
                    'name' => 'edit_role_user_form',
                    'id' => 'edit_role_user_form',
                    
                ]) !!}

                @include ('role_users.form', ['roleUser' => $roleUser,])

                <br>
                <br>
                <br>

                <div class="text-center">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}


                  </div>

                </div>
                 

                </div>

              </div>
            </div><!-- End Recent Sales -->

        </div>


    </section>
@endsection