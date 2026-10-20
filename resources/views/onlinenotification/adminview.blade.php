@extends('layouts.app-all')

@section('title', 'Review Message')

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" sections; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
<div class="mesh-home-theme">
{{-- #================================ --}}

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
            <a href="{{ route('onlinenotifications.onlinenotification.index') }}" class= "btn btn-primary text-right">
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
                <div class="col-lg-8">{{$msgdts->phone_number}} {{$msgdts->phone_number2}} {{$msgdts->phone_number3}} {{$msgdts->phone_number4}} 
                {{$msgdts->phone_number5}} {{$msgdts->phone_number6}} {{$msgdts->phone_number7}} {{$msgdts->phone_number8}}
                {{$msgdts->phone_number9}} {{$msgdts->phone_number10}} {{$msgdts->phone_number11}} {{$msgdts->phone_number12}}
                {{$msgdts->phone_number13}} {{$msgdts->phone_number14}} {{$msgdts->phone_number15}} {{$msgdts->phone_number16}}
                {{$msgdts->phone_number17}} {{$msgdts->phone_number18}} {{$msgdts->phone_number19}} {{$msgdts->phone_number20}}
                {{$msgdts->phone_number21}} {{$msgdts->phone_number22}} {{$msgdts->phone_number23}} {{$msgdts->phone_number24}}
                {{$msgdts->phone_number25}} {{$msgdts->phone_number26}} {{$msgdts->phone_number27}} {{$msgdts->phone_number28}} 
                {{$msgdts->phone_number29}} {{$msgdts->phone_number30}} {{$msgdts->phone_number31}} {{$msgdts->phone_number32}}
                {{$msgdts->phone_number33}} {{$msgdts->phone_number34}} {{$msgdts->phone_number35}} {{$msgdts->phone_number36}}
		{{$msgdts->phone_number37}} {{$msgdts->phone_number38}} {{$msgdts->phone_number39}} {{$msgdts->phone_number40}}
		{{$msgdts->phone_number41}} {{$msgdts->phone_number42}} {{$msgdts->phone_number43}} {{$msgdts->phone_number44}}
                {{$msgdts->phone_number45}} {{$msgdts->phone_number46}} {{$msgdts->phone_number47}} {{$msgdts->phone_number48}}
		{{$msgdts->phone_number49}} {{$msgdts->phone_number50}} {{$msgdts->phone_number51}} {{$msgdts->phone_number52}}
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
		
            <div class="row">
                <div class="col-lg-4 label">Tarikh & Masa:</div>
                <div class="col-lg-8">{{$msgdts->updated_at}}</div>
            </div>
            @endforeach
        </div>

    </div>


    </div>

  </div>
  </div><!-- End Recent Sales -->

  </div>

  
</section>
{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
@endsection