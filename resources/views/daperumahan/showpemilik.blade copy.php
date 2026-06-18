@extends('layouts.app-all')

@section('title', 'Edit')

@section('content')

<?php
$pagename = "Pemilik";
?>

<div class="pagetitle">
    <h1>Show Pemilik</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('daperumahan.daperumahan.indexpemilik') }}">Senarai Pemilik</a></li>  
        <li class="breadcrumb-item active">Show Pemilik</li>  
      </ol>
    </nav>
</div><!-- End Page Title -->

<div class="pagetitle">

    <a href="{{ route('daperumahan.daperumahan.indexpemilik') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Pemilik: {{ $dapemilik['nama_pemilik'] }}</h5>

                            <br>

                            <div style="padding: 0 24px 0 24px;">

                                {{-- nama penghuni, nokp2, lokasi, mukim, rujukan fail --}}

                                @foreach ($rumah2_pemilik as $data_penghuni)
                                <br>
                                <div class="row mb-2">
                                    <div class="col-lg-4 col-md-3  label"><strong>Rujukan JPM:</strong><br></div>
                                    <div class="col-lg-8 col-md-9">
                                        {{ $data_penghuni['rujukan_jpm'] == null ? '-' : $data_penghuni['rujukan_jpm'] }}
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-lg-4 col-md-3  label"><strong>Nama Penghuni:</strong><br></div>
                                    <div class="col-lg-8 col-md-9">
                                        {{ $data_penghuni['nama_penghuni'] == null ? '-' : $data_penghuni['nama_penghuni'] }}
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-lg-4 col-md-3  label"><strong>NO KP:</strong><br></div>
                                    <div class="col-lg-8 col-md-9">
                                        {{ $data_penghuni['no_kp2'] == null ? '-' : $data_penghuni['no_kp2'] }}
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-4 col-md-3  label"><strong>Lokasi:</strong><br></div>
                                    <div class="col-lg-8 col-md-9">
                                        {{ $data_penghuni['lokasi'] == null ? '-' : $data_penghuni['lokasi'] }}
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-4 col-md-3  label"><strong>Mukim:</strong><br></div>
                                    <div class="col-lg-8 col-md-9">
                                        {{ $data_penghuni['mukim'] == null ? '-' : $data_penghuni['mukim'] }}
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-4 col-md-3  label"><strong>Status:</strong><br></div>
                                    <div class="col-lg-8 col-md-9">
                                        {{ $data_penghuni['status_rumah'] == null ? '-' : $data_penghuni['status_rumah']  }}
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-4 col-md-3  label"><strong>Gambar rumah:</strong><br></div>
                                    <div class="col-lg-8 col-md-9">
                                        <img src="{{ $data_penghuni['image'] ? asset('storage/' . $data_penghuni['image']) : asset('storage/images/image_not_available.png') }}" alt="{{ $data_penghuni['image'] ? 'Uploaded image' : 'Image not available' }}" width="200">
                                    </div>
                                </div>

                                <br><hr>
                                @endforeach

                                <br>
                                <br>
                            </div>
                            <div class="text-center">
                                <form method="get" action="{{ route('daperumahan.daperumahan.editpemilik', $dapemilik['id'] ) }}">
                                    @csrf
                                <button id="submit-button" type="submit" class="btn btn-primary">Edit</button>
                            </form>
                            </div>
                            
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