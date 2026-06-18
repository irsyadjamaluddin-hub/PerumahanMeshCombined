@extends('layouts.app-all')

@section('title', 'Edit')

@section('content')

<?php
$pagename = "IQ List";
?>

<div class="pagetitle">
    <h1>IQ List</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('daperumahan.daperumahan.indexiq') }}">Senarai IQ</a></li>  
        <li class="breadcrumb-item active">Edit IQ</li>  
      </ol>
    </nav>
</div><!-- End Page Title -->

<div class="pagetitle">

    <a href="{{ route('daperumahan.daperumahan.indexiq') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">IQ Form</h5>

                        {{-- HERE --}}
                        <form class="" id="updateiq" method="post" action="{{ route('daperumahan.daperumahan.updateiq', ['daiq' => $daiq]) }}">
                            @csrf
                        
                            <br>

                            <div style="padding: 0 24px 0 24px;">


                                <div class="row mb-2">
                                    <div class="col-md-3 label">Rujukan Fail</div>
                                    <div class="col-md-9">
                                        <input type="text" name="rujukan_fail" id="rujukan_fail" value="{{$daiq->rujukan_fail}}" placeholder="" class="form-control">
                                    </div>
                                </div>


                                <div class="row mb-2">
                                    <div class="col-md-3 label">Daerah</div>
                                    <div class="col-md-9">
                                        <input type="text" name="daerah" id="daerah" value="{{$daiq->daerah}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Nama</div>
                                    <div class="col-md-9">
                                    <input type="text" name="nama_penghuni" id="nama_penghuni" value="{{$daiq->nama_penghuni}}" class="form-control">

                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Jawatan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="jawatan_penghuni" id="jawatan_penghuni" value="{{$daiq->jawatan_penghuni}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tel No.</div>
                                    <div class="col-md-9">
                                        <input type="text" name="no_tel" id="no_tel" value="{{$daiq->no_tel}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Lokasi</div>
                                    <div class="col-md-9">
                                        <input type="text" name="alamat_1" id="alamat_1" value="{{$daiq->alamat_1}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Mendiami</div>
                                    <div class="col-md-9">
                                        <input type="text" name="tarikh_mendiami" id="tarikh_mendiami" value="{{$daiq->tarikh_mendiami}}" placeholder="" class="form-control">
                                    </div>
                                </div>


                                <br>
                                <hr>
                                <br>
                            </div>
                            <div class="text-center">
                                <button id="submit-button" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <script>
                            var submitButton = document.getElementById('submit-button');
                            var form = document.getElementById('updateiq');
                            
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
                        </form>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include other necessary JS libraries here (e.g., Bootstrap) -->


<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    });
</script>


<script>
$(document).ready(function(){

    // Initialize select2
    $("#myselection").select2();

    // Read selected option
    $('#but_read').click(function(){
    var username = $('#myselection option:selected').text();
    var userid = $('#myselection').val();

    $('#result').html("id : " + userid + ", name : " + username);

    });
    });
</script>

<style>
    .removeDeclare:hover {
        background-color: #dc3545 !important;
    }
</style>

@endsection