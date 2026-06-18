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
                                        <input type="text" name="rujukan_fail" id="rujukan_fail" placeholder="DA / AKR /..." class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Nama Penuh Pemilik</div>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_pemilik" id="nama_pemilik"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">No. KPP Pemilik</div>
                                    <div class="col-md-9">
                                        <input type="text" name="no_kp1" id="no_kp1"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Alamat Rumah Sewa</div>
                                    <div class="col-md-9">
                                        <input type="text" name="alamat_rumah_sewa" id="alamat_rumah_sewa"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Alamat Persuratan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="alamat_persuratan" id="alamat_persuratan"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">No. Perhubungan</div>
                                    <div class="col-md-9">
                                        <input type="tel" name="mob1" id="mob1"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Mukim</div>
                                    <div class="col-md-9">
                                        <input type="text" name="mukim" id="mukim"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Daerah</div>
                                    <div class="col-md-9">
                                    <select class="form-control" name="daerah" required>
                                        <option value="">--Pilih Daerah--</option>
                                        <option value="brunei_muara">BRUNEI MUARA</option>
                                        <option value="tutong">TUTONG</option>
                                        <option value="temburung">TEMBURONG</option>
                                        <option value="belait">BELAIT</option>
                                     <select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Sewa Sebulan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="sewa_sebulan" id="sewa_sebulan"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Sewa Perabot Sebulan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="sewa_perabot" id="sewa_perabot"  class="form-control" >
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Mula Disewa</div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_mula_disewa" id="tarikh_mula_disewa"  class="form-control" >
                                    </div>
                                </div>
                    
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Penyambungan TA</div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_penyambungan_ta" id="tarikh_penyambungan_ta"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Mansuh TA</div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_mansuh_ta" id="tarikh_mansuh_ta"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Nama Penghuni</div>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_penghuni" id="nama_penghuni"  class="form-control" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Mula Mendiami</div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_mula_mendiami" id="tarikh_mula_mendiami"  class="form-control" >
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Mengosongkan</div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_mengosongkan" id="tarikh_mengosongkan" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Status</div>
                                    <div class="col-md-9">
                                    <select class="form-control" name="status" required>
                                        <option value="">--Pilih Status--</option>
                                        <option value="kahwin">KAHWIN</option>
                                        <option value="bujang">BUJANG</option>
                                        <option value="janda">JANDA</option>
                                        <option value="duda">DUDA</option>
                                        <option value="balu">BALU</option>
                                     <select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Status Permohonan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="status_permohonan" id="status_permohonan" class="form-control">
                                    </div>
                                </div>
                                
                                <br>
                                <hr>
                                <br>
                          
                        
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Muat Naik Dokumen</h5>

                        {{-- HERE --}}
                        <form class="" id="createmenunggu" method="post" action="{{ route('daperumahan.daperumahan.storepemilik') }}" enctype="multipart/form-data">
                            @csrf
                        
                            <br>

                            <div style="padding: 0 24px 0 24px;">

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Borang Penyambungan</div>
                                    <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Surat / Dokumen perjanjian mula hingga terkini</div>
                                    <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Laporan Teknikal</div>
                                    <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Insuren yang masih sah laku</div>
                                    <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Resit pembayaran pemadam kebakaran</div>
                                    <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">KPP Pemilik</div>
                                    <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Geran Tanah</div>
                                    <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Surat Kesiapan Rumah (OP)</div>
                                    <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Gambar Rumah Terkini</div>
                                    <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Pengesah Penomboran Rumah</div>
                                    <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
                                    </div>
                                </div>
                    
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Senarai Perabot Yang Dibekalkan</div>
                                    <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Memorandum taksiran Perabot</div>
                                    <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Surat Kebenaran Pihak ABCi Jika Terdapat</div>
                                    <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Surat 'Sale Dan Purchase Agreement' (jika ada)</div>
                                    <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Permohonan Berkhidmat Dengan Kerjaan</div>
                                    <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Lain - lain Dokumen (jika ada)</div>
                                    <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
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