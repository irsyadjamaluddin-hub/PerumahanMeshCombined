@extends('layouts.app-all')

@section('title', 'Create Booking')

@section('content')

<?php
$pagename = "BookingSystem";
?>

<div class="pagetitle">
  <h1>Add Booking</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">Booking System</li>
    </ol>
  </nav>
</div><!-- End Page Title -->





<section class="section profile">


  <a href="{{ route('bookings.booking.indexR') }}" class="btn btn-primary text-right mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>


  <!-- QO Table -->
  <div class="col-12">
    <div class="card recent-sales">



      <div class="card-body">

        <div class="profile-overview pt-3">



          <form class="" method="post" action="{{ route('bookings.booking.store') }}" enctype="multipart/form-data">
          @csrf

            <br>


            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
              <h3 class="card-title" style="padding: 0px;">Booking System</i></h3>
              <hr>
              <br>


              <div class="row">
                <label for="inputText" class="col-lg-4 col-md-3  label">Name </label>
                <div class="col-lg-8 col-md-9">
                  <input type="text" name="name" class="form-control">
                </div>
              </div>

              <div class="row">
                <label for="inputText" class="col-lg-4 col-md-3  label">IC Number</label>
                <div class="col-lg-8 col-md-9">
                  <input type="text" name="ic_no" class="form-control">
                </div>
              </div>

              <div class="row">
                <label for="inputText" class="col-lg-4 col-md-3  label">Jabatan</label>
                <div class="col-lg-8 col-md-9">
                  <input type="text" name="dept" class="form-control">
                </div>
              </div>

              <div class="row">
                <label for="inputText" class="col-lg-4 col-md-3  label">Room No.</label>
                <div class="col-lg-8 col-md-9">
                  <input type="text" name="room_no" class="form-control">
                </div>
              </div>

              <div class="row">
                <label for="inputText" class="col-lg-4 col-md-3  label">Que No.</label>
                <div class="col-lg-8 col-md-9">
                  <input type="text" name="que_no" class="form-control">
                </div>
              </div>

              <div class="row">
                  <label for="inputTime" class="col-lg-4 col-md-3  label">Time</label>
                  <div class="col-lg-8 col-md-9">
                    <input type="time" name="time_no" class="form-control">
                  </div>
                </div>

              <div class="row">
                  <label for="inputDate" class="col-lg-4 col-md-3  label">Date</label>
                  <div class="col-lg-8 col-md-9">
                    <input type="date" name="date_no" class="form-control">
                  </div>
                </div>
                

            

            <!-- take hidden ic_no so that easy to identify data belong/from who -->

            <input type="text" name="ic_no" class="bg-gray-200 form-control" value="{{Auth::user()->ic_no}}" hidden>

            <br>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

          </form>


        </div>

      </div>


    </div>

  </div>
  </div><!-- End Recent Sales -->

  </div>

  
</section>
@endsection