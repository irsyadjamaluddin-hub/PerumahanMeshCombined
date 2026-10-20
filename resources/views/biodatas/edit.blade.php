@extends('layouts.app-all')

@section('title', 'Edit Profile')

@section('content')

  <?php
    $pagename = "Profile";
  ?>
  
    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center text-center">

              <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
              <h2>{{ Auth::user()->name }}</h2>
              <h3>{{ Auth::user()->ic_no }}</h3>
              
              @foreach($employments as $employment)
              <h3>{{ optional($employment->department)->label }}</h3>
              @endforeach
              
              <!-- <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div> -->
            </div>
          </div>

        </div>

        <div class="col-xl-8">
        <!-- Success message -->
          @if(Session::has('success_message'))
              <div class="alert alert-success">
                  <i class=" fas fa-fw fa-check"></i>
                  {!! session('success_message') !!}
              </div>
          @endif
        </div>

        <div class="col-xl-8">
          <!-- Card start -->
          <div class="card mt-3">

            <div class="card-body pt-3">
              
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link w-100" onclick = "toggle1()" data-bs-toggle="tab" data-bs-target="#profile-overview">Personal Information</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link w-100" onclick = "toggle2()" data-bs-toggle="tab" data-bs-target="#profile-edit">Contact</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link w-100" onclick = "toggle3()" data-bs-toggle="tab" data-bs-target="#profile-settings">Employment</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link w-100" onclick = "toggle4()" data-bs-toggle="tab" data-bs-target="#profile-change-password">Education</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link w-100" onclick = "toggle5()" data-bs-toggle="tab" data-bs-target="#profile-salary">Salary</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link w-100" onclick = "toggle6()" data-bs-toggle="tab" data-bs-target="#profile-achiev">Achievement</button>
                </li>

                 <li class="nav-item">
                  <button class="nav-link w-100" onclick = "toggle7()" data-bs-toggle="tab" data-bs-target="#profile-files">Files</button>
                </li>

              </ul>

              

                {!! Form::model($biodata, [
                'method' => 'PUT',
                'route' => ['biodatas.biodata.update', $biodata->ic_no],
                'class' => 'form-horizontal',
                'name' => 'edit_biodata_form',
                'id' => 'edit_biodata_form',
                'enctype' => "multipart/form-data"
                ]) !!}

                {{ csrf_field() }}

            	<div class="d-grid gap-2 d-md-flex justify-content-md-end">
            	<button class="btn btn-primary" id="btn-submit" text-align="right"><i class="ri-save-3-line"></i></button>
            	</div>


          {{-- Error Message --}}
          @if ($errors->any())
            @foreach ($errors->all() as $error)

              <div class="ErrorMessage p-2 w-full bg-red-200 rounded-md mb-5 flex flex-row items-center justify-between text-red-800">
                
                <div class="flex flex-row items-center">

                  <p class="ml-3">{{ $errors }}</p>
                </div>

                <button onclick="closeErrorMessage()" class="" data-dismiss="alert" aria-label="Close">
                </button>

              </div>

            @endforeach
          @endif

                   
              <div class="tab-content pt-2"><!-- Start Bordered Tabs -->

                @include ('biodatas.form-new', ['biodata' => $biodata,])

                {!! Form::close() !!}

                @include ('biodatas.achievement')
                
              </div><!-- End Bordered Tabs -->

            </div>

          </div>
          <!-- Card end -->

        </div>
      </div>
    </section>
@endsection