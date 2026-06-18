@extends('layouts.app-all')

@section('title', 'Add PPS Visitors')

@section('content')

<?php
$pagename = "";
?>

<section class="section profile">
  <div class="row">

    <div class="col-lg-12">
      <!-- Back button to go back to the index page -->
      <a href="{{ route('pps.pps.index') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i> Back
      </a>
    </div>

    <!-- Success message if any -->
    @if(Session::has('success_message'))
    <div class="alert alert-success">
      <i class="bi bi-patch-check"> {!! session('success_message') !!}</i>
    </div>
    @endif

    <div class="card">
      <div class="card-body mt-3 overflow-auto">
        <!-- Title -->
        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Pusat Perkhidmatan Setempat (PPS)<br> Add Visitors</h5>

        <br>
        <!-- Form for adding a new entry -->
        <form class="" method="post" action="{{ route('pps.pps.storepps', ['counter' => $counter]) }}" enctype="multipart/form-data">
          @csrf

          <!-- Hidden input field to store the counter -->
          <input type="hidden" name="counter" value="{{ $counter }}">

          <div class="row">
            <div class="col-lg-3 label">Year</div>
            <div class="col-lg-9"><input type="number" name="year" class="form-control text-center"></div>
          </div>

          <br>

          <!-- Input fields for adding visitor count for each month -->
          <div class="row">
            <div class="col-lg-3 label">January</div>
            <div class="col-lg-9"><input type="number" name="january" class="form-control text-center"></div>
          </div>

          <br>

          <div class="row">
            <div class="col-lg-3 label">February</div>
            <div class="col-lg-9"><input type="number" name="february" class="form-control text-center"></div>
          </div>

          <br>

          <div class="row">
            <div class="col-lg-3 label">March</div>
            <div class="col-lg-9"><input type="number" name="march" class="form-control text-center"></div>
          </div>

          <br>

          <div class="row">
            <div class="col-lg-3 label">April</div>
            <div class="col-lg-9"><input type="number" name="april" class="form-control text-center"></div>
          </div>

          <br>

          <div class="row">
            <div class="col-lg-3 label">May</div>
            <div class="col-lg-9"><input type="number" name="may" class="form-control text-center"></div>
          </div>

          <br>

          <div class="row">
            <div class="col-lg-3 label">June</div>
            <div class="col-lg-9"><input type="number" name="june" class="form-control text-center"></div>
          </div>

          <br>

          <div class="row">
            <div class="col-lg-3 label">July</div>
            <div class="col-lg-9"><input type="number" name="july" class="form-control text-center"></div>
          </div>

          <br>

          <div class="row">
            <div class="col-lg-3 label">August</div>
            <div class="col-lg-9"><input type="number" name="august" class="form-control text-center"></div>
          </div>

          <br>

          <div class="row">
            <div class="col-lg-3 label">September</div>
            <div class="col-lg-9"><input type="number" name="september" class="form-control text-center"></div>
          </div>

          <br>

          <div class="row">
            <div class="col-lg-3 label">October</div>
            <div class="col-lg-9"><input type="number" name="october" class="form-control text-center"></div>
          </div>

          <br>

          <div class="row">
            <div class="col-lg-3 label">November</div>
            <div class="col-lg-9"><input type="number" name="november" class="form-control text-center"></div>
          </div>

          <br>

          <div class="row">
            <div class="col-lg-3 label">December</div>
            <div class="col-lg-9"><input type="number" name="december" class="form-control text-center"></div>
          </div>

          <!-- Repeat the above row for other months -->

          <br>
          <!-- Button to submit the form and add the entry -->
          <div class="col" style="text-align: center;">
            <button type="submit" class="btn btn-primary">Add</button>
          </div>

        </form>

      </div>
    </div>

  </div>
</section>
@endsection
