@extends('layouts.app-all')

@section('title', 'Create Event')

@section('content')

<?php
$pagename = "Event";
?>

@if (count($errors) > 0)
          <div class="alert alert-danger">
            Upload Validation Error<br><br>
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

<section class="section profile">

  <a href="{{ route('moeevent.moeevent.indexadmin') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">

      <div class="card-body">

          <form class="" method="post" action="{{ route('moeevent.moeevent.storeevent') }}" enctype="multipart/form-data"  >
            @csrf

            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Event</h5>
<br>

            <div class="row">
                <label for="inputText" class="col-lg-4 label d-flex align-items-center">Event</label>
                <div class="col-lg-8">
                <input type="text" name="eventlabel" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <label for="inputText" class="col-lg-4 label d-flex align-items-center">Event Date</label>
                <div class="col-lg-8">
                <input type="date" name="eventdate" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <label for="inputText" class="col-lg-4 label d-flex align-items-center">Event Date End</label>
                <div class="col-lg-8">
                <input type="date" name="eventdateend" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <label for="inputText" class="col-lg-4 label d-flex align-items-center">Event Time</label>
                <div class="col-lg-8">
                <input type="time" name="eventtime" class="form-control" required>
                </div>
            </div>

            <div class="row">
              <label for="inputText" class="col-lg-4 label d-flex align-items-center">Event Venue</label>
              <div class="col-lg-8">
              <input type="text" name="eventvenue" class="form-control" required>
              </div>
            </div>
              
            <div class="row">
                <label class="col-lg-4 label d-flex align-items-center">Jabatan</label>
                <div class="col-lg-8">
                @foreach($employments as $employment)
                <input type="text" class="bg-gray-200 form-control" name="jabatan" value="{{ optional($employment->department)->label }}" readonly>
                <input type="hidden" name="jabatan" class="bg-gray-200 form-control" value="{{ $employment->department_id }}" hidden>
                @endforeach
                </div>
            </div>


                @foreach($biodatas as $biodata)

                <div class="row">
                    <div class="col-lg-4 label d-flex align-items-center">Nama</div>
                    <div class="col-lg-8">
                        <input type="text" class="bg-gray-200 form-control" name="nama" value="{{$biodata->name}}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 label d-flex align-items-center">IC No.</div>
                    <div class="col-lg-8">
                        <input type="text" class="bg-gray-200 form-control" name="icno" value="{{$biodata->ic_no}}" readonly>
                    </div>
                </div>

                @endforeach

                 
<br>

            <div class="text-center">
              <button id ="submit-button" type="submit" class="btn btn-primary">Submit</button>
            </div>

          </form>

    </div>
    </div>
    </div>






  
</section>
@endsection