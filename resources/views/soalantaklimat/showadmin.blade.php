@extends('layouts.app-all')

@section('title', 'Show Soalan')

@section('content')

<?php
$pagename = "Show Soalan";
?>

<div class="pagetitle">
  <h1>Show Soalan</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">Show Soalan</li>
    </ol>
  </nav>
</div><!-- End Page Title -->





<section class="section profile">

  <!-- QO Table -->
  <div class="col-12">
                        
    <div class="card recent-sales">

      <div class="card-body">
        <div  style="padding-top: 10px;">
            <a href="{{ route('st.soalantaklimat.indexadmin') }}" class= "btn btn-primary text-right">
                Back 
            </a>
        </div>
        <div class="profile-overview pt-3">
          
          <br>
          <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                <h3 class="card-title"style="padding: 0px;">Review Soalan</i></h3>
                <hr>
                <br>

                @foreach($soalantaklimat as $st)

                <div class="row">
                    <div class="col-lg-4 col-md-3  label">Perkara: </div>
                    <div class="col-lg-8 col-md-9">{{$st->perkara}}</div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-3  label">Tarikh: </div>
                    <div class="col-lg-8 col-md-9">{{$st->tarikh_st}}</div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-3  label">Soalan </div>
                    <div class="col-lg-8 col-md-9">{{$st->soalan}} </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-3  label">Nama </div>
                    <div class="col-lg-8 col-md-9">{{$st->nama}} </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-3  label">Organisation </div>
                    <div class="col-lg-8 col-md-9">{{$st->organisation}} </div>
                </div>
                
                @endforeach
            </div>
        </div>
    </div>
</div><!-- End Recent Sales -->
</div>

  
</section>
@endsection