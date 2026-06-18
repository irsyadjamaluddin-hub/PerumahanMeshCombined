@extends('layouts.app-all')

@section('title', 'Edit')

@section('content')

<?php
$pagename = "Pemilik";
?>

<div class="pagetitle">
    <h1>Edit Pemilik</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('daperumahan.daperumahan.indexpemilik') }}">Senarai Pemilik</a></li>
            <li class="breadcrumb-item"><a href="{{ route('daperumahan.daperumahan.showpemilik', $dapemilik->id) }}">Show Pemilik</a></li>  
            <li class="breadcrumb-item active">Edit Pemilik</li>  
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="pagetitle">

    <a href="{{ route('daperumahan.daperumahan.showpemilik', $dapemilik->id) }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Pemilik Form</h5>

                        {{-- HERE --}}
                        <form class="" id="updatepemilik" method="post" action="{{ route('daperumahan.daperumahan.updatepemilik', ['dapemilik' => $dapemilik]) }}" enctype="multipart/form-data">
                            @csrf
                        
                            <br>

                            <div style="padding: 0 24px 0 24px;">

                                {{-- nama penghuni, nokp2, lokasi, mukim, rujukan fail --}}

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Nama Pemilik</div>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_pemilik" id="nama_pemilik" value="{{$dapemilik->nama_pemilik}}" class="form-control">
                                    </div>
                                </div>

                                <br>
                                <strong class="text-lg">Penghuni-penghuni</strong>
                                <br>

                                @foreach ($rumah2_pemilik as $index => $data_penghuni)
                                <br>
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Rujukan Fail</div>
                                    <div class="col-md-9">
                                        <input type="text" name="rujukan_jpm[]" id="rujukan_jpm" value="{{$data_penghuni->rujukan_jpm}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Nama Penghuni</div>
                                    <div class="col-md-9">
                                    <input type="text" name="nama_penghuni[]" id="nama_penghuni" value="{{$data_penghuni->nama_penghuni}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">NO KP</div>
                                    <div class="col-md-9">
                                    <input type="text" name="no_kp2[]" id="no_kp2" value="{{$data_penghuni->no_kp2}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Lokasi</div>
                                    <div class="col-md-9">
                                    <input type="text" name="lokasi[]" id="lokasi" value="{{$data_penghuni->lokasi}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Mukim</div>
                                    <div class="col-md-9">
                                    <input type="text" name="mukim[]" id="mukim" value="{{$data_penghuni->mukim}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Status</div>
                                    <div class="col-md-9">
                                        <select name="status_rumah[]" id="status_rumah" class="form-control">
                                            <option value="" {{ $data_penghuni->status_rumah == null ? 'selected' : '' }}>--Pilih Status--</option>
                                            @foreach ($statusList as $status)
                                                <option value="{{ $status }}" {{ $data_penghuni->status_rumah == $status ? 'selected' : '' }}>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Gambar rumah</div>
                                    <div class="col-md-9">
                                        <input type="file" name="image[{{ $index }}]" id="image" class="form-control">
                                        @if ($data_penghuni->image)
                                            <p>Current image:</p>
                                            <img src="{{ asset('storage/' . $data_penghuni->image) }}" alt="Current image" width="100">
                                            <br>
                                            <label>
                                                <input type="checkbox" name="remove_image[{{ $index }}]" id="remove_image">
                                                Remove current image
                                            </label>
                                        @else
                                            <p>No image uploaded</p>
                                        @endif
                                    </div>
                                </div>

                                <br><hr>
                                @endforeach
                                
                                <br>
                                <hr>
                                <br>
                            </div>
                            <div class="text-center">
                                <button id="submit-button" type="submit" class="btn btn-primary">Submit</button>
                            </div>
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