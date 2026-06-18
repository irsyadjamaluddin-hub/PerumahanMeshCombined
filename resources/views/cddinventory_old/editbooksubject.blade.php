@extends('layouts.app-all')

@section('title', 'Edit Subjek')

@section('content')

<?php
$pagename = "Book List";
?>

<div class="pagetitle">
  <h1>Book List</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('cddinventory.cddinventory.indexbook') }}">Inventory</a></li>  
      <li class="breadcrumb-item active">Edit Subjek</li>  
    </ol>
  </nav>
</div><!-- End Page Title -->

<!----- Back out Button  ----->
<div class="col-md-1 text-left">
  <a href="{{ route('ssmrequests.ssmrequest.indexjenispermohonan') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 10px;">
  <i class="bi bi-arrow-left-circle"></i>
  </a>
</div> 

<section class="section profile">

  <div class="col-12">
    <div class="card recent-sales">
      <div class="card-body">
        <div class="profile-overview">

          <form class="" id="updatebooksubject" method="post" action="{{ route('cddinventory.cddinventory.updatebooksubject') }}" enctype="multipart/form-data">
            @csrf
            <br>
            <br>
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Edit Subjek</h5>
            <br>
            <div class="row mb-3">
                <label class="col-lg-1 col-form-label" style="width: 10rem;">Subjek Buku:</label>
                <div class="col-lg-6">
                    <input type="text" name="kategori" class="form-control" value="{{ $booksubjects->kategori }}">
                    <input name="id" value="{{ $booksubjects->id }}" hidden>
                      {!! $errors->first('nama', '<p class="help-block text-danger">:message</p>')!!}
                </div>
                <div class="col-lg-3">
                  <button id="submit-button" type="submit" class="btn btn-primary">Hantar</button>
                </div>
                <script>
                  var submitButton = document.getElementById('submit-button');
                  var form = document.getElementById('updatebooksubject');
                
                  form.addEventListener('submit', function(event) {
                      if (submitButton.getAttribute('data-submitted') !== null) {
                          event.preventDefault();
                      } else {
                          submitButton.disabled = true;
                          submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                          submitButton.setAttribute('data-submitted', 'true');
                      }
                  });
                </script>
            </div>          
          </form>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection
