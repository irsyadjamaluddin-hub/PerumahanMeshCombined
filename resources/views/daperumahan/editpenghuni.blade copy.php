@extends('layouts.app-all')

@section('title', 'Edit')

@section('content')

<?php
$pagename = "Penghuni List";
?>

<div class="pagetitle">
    <h1>Penghuni List</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('daperumahan.daperumahan.indexpenghuni') }}">Senarai Penghuni</a></li>  
        <li class="breadcrumb-item active">Edit Penghuni</li>  
      </ol>
    </nav>
</div><!-- End Page Title -->

<div class="pagetitle">

    <a href="{{ route('daperumahan.daperumahan.indexpenghuni') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Penghuni Form</h5>

                        {{-- HERE --}}
                        <form class="" id="updatepenghuni" method="post" action="{{ route('daperumahan.daperumahan.updatepenghuni', ['dapenghuni' => $dapenghuni]) }}">
                            @csrf
                        
                            <br>

                            <div style="padding: 0 24px 0 24px;">


                                <div class="row mb-2">
                                    <div class="col-md-3 label">Rujukan JPM</div>
                                    <div class="col-md-9">
                                        <input type="text" name="rujukan_jpm" id="rujukan_jpm" value="{{$dapenghuni->rujukan_jpm}}" placeholder="Rujukan JPM" class="form-control">
                                    </div>
                                </div>


                                <div class="row mb-2">
                                    <div class="col-md-3 label">Nama</div>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_penghuni" id="nama_penghuni" value="{{$dapenghuni->nama_penghuni}}" placeholder="Nama Penghuni" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Jawatan</div>
                                    <div class="col-md-9">
                                    <input type="text" name="jawatan" id="jawatan" value="{{$dapenghuni->jawatan}}" class="form-control">

                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tel No</div>
                                    <div class="col-md-9">
                                        <input type="text" name="mob2" id="mob2" value="{{$dapenghuni->mob2}}" placeholder="Tel No" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kampung</div>
                                    <div class="col-md-9">
                                        <input type="text" name="kampung" id="kampung" value="{{$dapenghuni->kampung}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Lokasi</div>
                                    <div class="col-md-9">
                                        <input type="text" name="lokasi" id="lokasi" value="{{$dapenghuni->lokasi}}" placeholder="" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Mendiami</div>
                                    <div class="col-md-9">
                                        <input type="text" name="tarikh_mendiami" id="tarikh_mendiami" value="{{$dapenghuni->tarikh_mendiami}}" placeholder="" class="form-control">
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
                            var form = document.getElementById('updatepenghuni');
                            
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