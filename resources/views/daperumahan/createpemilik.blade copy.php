@extends('layouts.app-all')

@section('title', 'Add')

@section('content')

<?php
$pagename = "Add Pemilik";
?>

<div class="pagetitle">
    <h1>Add Pemilik</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('daperumahan.daperumahan.indexpemilik') }}">Senarai Pemilik</a></li>  
        <li class="breadcrumb-item active">Add Pemilik</li>  
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
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Pemilik Form</h5>

                        {{-- HERE --}}
                        <form class="" id="createmenunggu" method="post" action="{{ route('daperumahan.daperumahan.storepemilik') }}" enctype="multipart/form-data">
                            @csrf
                        
                            <br>

                            <div style="padding: 0 24px 0 24px;">

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Rujukan Fail</div>
                                    <div class="col-md-9">
                                        <input type="text" name="rujukan_fail" id="rujukan_fail"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Nama</div>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_pemilik" id="nama_pemilik"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">No Kad Pintar</div>
                                    <div class="col-md-9">
                                        <input type="text" name="no_kp1" id="no_kp1"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Gantinama</div>
                                    <div class="col-md-9">
                                        <input type="text" name="gantinama" id="gantinama"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Gelaran</div>
                                    <div class="col-md-9">
                                        <input type="text" name="gelaran" id="gelaran"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Alamat Persuratan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="alamat_persuratan" id="alamat_persuratan"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Lokasi</div>
                                    <div class="col-md-9">
                                        <input type="text" name="lokasi" id="lokasi"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kampung</div>
                                    <div class="col-md-9">
                                        <input type="text" name="kampung" id="kampung"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Mukim</div>
                                    <div class="col-md-9">
                                        <input type="text" name="mukim" id="mukim"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tel No</div>
                                    <div class="col-md-9">
                                        <input type="text" name="mob1" id="mob1"  class="form-control" >
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kelas</div>
                                    <div class="col-md-9">
                                        <input type="text" name="kelas" id="kelas"  class="form-control" >
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kadar Sewa Awal</div>
                                    <div class="col-md-9">
                                        <input type="text" name="kadar_sewa_awal" id="kadar_sewa_awal"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kadar Sewa Minima</div>
                                    <div class="col-md-9">
                                        <input type="text" name="kadar_sewa_minima" id="kadar_sewa_minima"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kadar Sewa Potongan Sebulan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="kadar_sewa_potongan_sebulan" id="kadar_sewa_potongan_sebulan"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Mula Disewa</div>
                                    <div class="col-md-9">
                                        <input type="text" name="tarikh_mula_disewa" id="tarikh_mula_disewa"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Bermula</div>
                                    <div class="col-md-9">
                                        <input type="text" name="bermula" id="bermula"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Berakhir</div>
                                    <div class="col-md-9">
                                        <input type="text" name="berakhir" id="berakhir"  class="form-control" >
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Gambar Rumah</div>
                                    <div class="col-md-9">
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Status Rumah</div>
                                    <div class="col-md-9">
                                        <select name="status_rumah" id="status_rumah" class="form-control">
                                            <option value="">--Pilih Status--</option>
                                            @foreach ($statusList as $status)
                                                <option value="{{ $status }}">{{ $status }}</option>
                                            @endforeach
                                        </select>
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
                            var form = document.getElementById('updatemenunggu');
                            
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