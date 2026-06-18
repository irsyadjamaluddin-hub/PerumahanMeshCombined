@extends('layouts.app-all')

@section('title', 'Create Message')

@section('content')

<?php
$pagename = "Online Notification Service";
?>

<div class="pagetitle">
  <h1>Review Message</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">Review Message</li>
    </ol>
  </nav>
</div><!-- End Page Title -->





<section class="section profile">

    <div class="row mb-2">

                <div class="col-md-12" style="padding-left: 30px;">    
                    <a href="{{ route('onlinenotifications.onlinenotification.indexuser') }}" class= "btn btn-primary text-right">
                        Back 
                    </a>
                </div>  
            </div>
  <!-- QO Table -->
  <div class="col-12">

    <div class="card recent-sales">

      <div class="card-body">

        <div class="profile-overview pt-3">

        <div class="col profile-overview" style="padding-top: 18px; padding-left: 18px; padding-right: 18px;">

            <h4 class="card-title" style="padding: 0px;">Message Details</h4>
            <hr>
            @foreach($messagedetails as $msgdts)

            <div class="row">
                <div class="col-lg-4 label">Jabatan:</div>
                <div class="col-lg-8">{{$msgdts->jabatan}}</div>
            </div>

            <div class="row">
                <div class="col-lg-4 label">No Penerima:</div>
                <div class="col-lg-8">{{$msgdts->phone_number}}
		</div>
            </div>

            <div class="row">
                <div class="col-lg-4 label">Perkara:</div>
                <div class="col-lg-8">{{$msgdts->title}}</div>
            </div>

            <div class="row">
                <div class="col-lg-4 label">Mesej:</div>
                <div class="col-lg-8">{{$msgdts->message}}</div>
            </div>

            <div class="row">
                <div class="col-lg-4 label">Mesej:</div>
                <div class="col-lg-8">{{$msgdts->additionalmessage}}</div>
            </div>
            @endforeach
        </div>

    </div>


    </div>

  </div>
  </div><!-- End Recent Sales -->

  </div>

  
</section>
@endsection