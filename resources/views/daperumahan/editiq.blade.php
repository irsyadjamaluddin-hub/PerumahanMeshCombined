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
                        <form class="" id="updateiq" method="post" enctype="multipart/form-data" action="{{ route('daperumahan.daperumahan.updateiq', ['daiq' => $daiq]) }}">
                            @csrf
                            @method('PUT')
                        
                            <br>

                            <div style="padding: 0 24px 0 24px;">


                                <div class="row mb-2">
                                    <div class="col-md-3 label">Rujukan Fail</div>
                                    <div class="col-md-9">
                                        <input type="text" name="rujukan_fail" id="rujukan_fail" value="{{$daiq->rujukan_fail}}" placeholder="DA / AKR /..." class="form-control">
                                    </div>

                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Alamat Perumahan Kerjaan (IQ)</div>
                                    <div class="col-md-9">
                                        <input type="text" name="alamat_perumahan_kerjaaniq" id="alamat_perumahan_kerjaaniq" value="{{$daiq->alamat_perumahan_kerjaaniq}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Daerah</div>
                                    <div class="col-md-9">
                                    <select class="form-control" name="daerah" required>
                                    <option value="BRUNEI MUARA" {{ $daiq->daerah == 'BRUNEI MUARA' ? 'selected' : '' }}>BRUNEI MUARA</option>
                                    <option value="TUTONG" {{ $daiq->daerah == 'TUTONG' ? 'selected' : '' }}>TUTONG</option>
                                    <option value="TEMBURONG" {{ $daiq->daerah == 'TEMBURONG' ? 'selected' : '' }}>TEMBURONG</option>
                                    <option value="BELAIT" {{ $daiq->daerah == 'BELAIT' ? 'selected' : '' }}>BELAIT</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Blok</div>
                                    <div class="col-md-9">
                                    <input type="text" name="blok" id="blok" value="{{$daiq->blok}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kelas</div>
                                    <div class="col-md-9">
                                     <input type="text" name="kelas" id="kelas" value="{{$daiq->kelas}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Sewa Sebulan</div>
                                    <div class="col-md-9">
                                    <input type="text" name="sewa_sebulan" id="sewa_sebulan" value="{{$daiq->sewa_sebulan}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Pembekalan Perobot</div>
                                    <div class="col-md-9">
                                    <select class="form-control" name="pembekalan_perabot">
                                        <option disabled>--Pilih--</option>
                                        <option value="lengkap">LENGKAP</option>
                                        <option value="sebahagian">SEBAHAGIAN</option>
                                        <option value="tiada">TIADA</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Jenis IQ</div>
                                    <div class="col-md-9">
                                    <select class="form-control" name="jenis_iq">
                                        <option disabled>--Pilih--</option>
                                        <option value="individu">INDIVIDU</option>
                                        <option value="keluarga">KELUARGA</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Jumlah Bilik</div>
                                    <div class="col-md-9">
                                    <input type="number" name="jumlah_bilik" id="jumlah_bilik" value="{{$daiq->jumlah_bilik}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Jumlah Tandas</div>
                                    <div class="col-md-9">
                                    <input type="number" name="jumlah_tandas" id="jumlah_tandas" value="{{$daiq->jumlah_tandas}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Nama Penuh Penghuni</div>
                                    <div class="col-md-9">
                                    <input type="text" name="nama_penghuni" id="nama_penghuni" value="{{$daiq->nama_penghuni}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">No. KPP Penghuni / Warna</div>
                                    <div class="col-md-9">
                                    <input type="text" name="no_kp_penghuni" id="no_kp_penghuni" value="{{$daiq->no_kp_penghuni}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Jawatan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="jawatan_penghuni" id="jawatan_penghuni" value="{{$daiq->jawatan_penghuni}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tempat bertugas</div>
                                    <div class="col-md-9">
                                        <input type="text" name="tempat_bertugas" id="tempat_bertugas" value="{{$daiq->tempat_bertugas}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Taraf Kelamin</div>
                                    <div class="col-md-9">
                                    <select class="form-control" name="taraf_kelamin">
                                        <option disabled>--Pilih--</option>
                                        <option value="Lelaki">LELAKI</option>
                                        <option value="Perempuan">PEREMPUAN</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tanggungan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="tanggungan" id="tanggungan" value="{{$daiq->tanggungan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Mendiami</div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_mendiami" id="tarikh_mendiami" value="{{$daiq->tarikh_mendiami}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Mengosongkan</div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_mengosongkan" id="tarikh_mengosongkan" value="{{$daiq->tarikh_mengosongkan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Bersara</div>
                                    <div class="col-md-9">
                                    <input type="date" name="tarikh_bersara" id="tarikh_bersara" value="{{$daiq->tarikh_bersara}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Status</div>
                                    <div class="col-md-9">
                                        <select name="status_rumahtangga" id="status_rumahtangga" class="form-control">
                                            <option value="">--Pilih Status--</option>
                                            @foreach ($statusList as $status)
                                                <option value="{{ $status }}"
                                                    {{ $daiq->status_rumahtangga == $status ? 'selected' : '' }}>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <br>
                                <br>
                            </div>
                        
                    </div>
                </div>
                <br>
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

                            <br>

                            <div style="padding: 0 24px 0 24px;">


                                 <div class="row mb-2">
                                    <div class="col-md-3 label">Gambar IQ / NO. Alamat Pintu</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="gambar_iq" id="gambar_iq">
                                        <span id="file-name-gambar_iq" class="file-name-inside">
                                             @if(!empty($daiq->gambar_iq))
                                                <a href="{{ asset('storage/' . $daiq->gambar_iq) }}" target="_blank">
                                                    📄 {{ basename($daiq->gambar_iq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kad Pengenalan Penghuni Dan Atau Sumai / Isteri</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="kad_pengenalan_iq" id="kad_pengenalan_iq">
                                        <span id="file-name-kad_pengenalan_iq" class="file-name-inside">
                                             @if(!empty($daiq->kad_pengenalan_iq))
                                                <a href="{{ asset('storage/' . $daiq->kad_pengenalan_iq) }}" target="_blank">
                                                    📄 {{ basename($daiq->kad_pengenalan_iq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Surat / Dokumen Tarikh Mula Mendiami</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="dokumen_mendiami_iq" id="dokumen_mendiami_iq">
                                        <span id="file-name-dokumen_mendiami_iq" class="file-name-inside">
                                             @if(!empty($daiq->dokumen_mendiami_iq))
                                                <a href="{{ asset('storage/' . $daiq->dokumen_mendiami_iq) }}" target="_blank">
                                                    📄 {{ basename($daiq->dokumen_mendiami_iq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Surat / Dokumen Mengosongkan</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="dokumen_kosong_iq" id="dokumen_kosong_iq">
                                        <span id="file-name-dokumen_kosong_iq" class="file-name-inside">
                                             @if(!empty($daiq->dokumen_kosong_iq))
                                                <a href="{{ asset('storage/' . $daiq->dokumen_kosong_iq) }}" target="_blank">
                                                    📄 {{ basename($daiq->dokumen_kosong_iq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Lain - lain Dokumen (jika ada)</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="dokumen_lain_iq" id="dokumen_lain_iq">
                                        <span id="file-dokumen_lain_iq" class="file-name-inside">
                                             @if(!empty($daiq->dokumen_lain_iq))
                                                <a href="{{ asset('storage/' . $daiq->dokumen_lain_iq) }}" target="_blank">
                                                    📄 {{ basename($daiq->dokumen_lain_iq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
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

                            document.addEventListener('DOMContentLoaded', function () {
                                const inputs = document.querySelectorAll('.file-input');

                                inputs.forEach(input => {
                                    const display = document.getElementById('file-name-' + input.id);

                                    if (!display) return;

                                    input.addEventListener('change', function () {
                                        if (input.files.length > 0) {
                                            display.textContent = input.files[0].name;
                                        } else {
                                            display.textContent = 'No file selected';
                                        }
                                    });
                                });
                                
                                document.querySelectorAll('.file-name-inside a').forEach(link => {
                                    link.addEventListener('click', function(e) {
                                        e.stopPropagation();
                                    });
                                });
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

<style>
.file-input {
    position: relative;
    z-index: 1;
    font-size: 0;
    background-color: transparent;
    height: 38px;
    padding: 6px 12px;
}

.file-input::file-selector-button {
    height: calc(1.6em + .75rem + 2px); /* match Bootstrap input height */
    padding: .5rem 1rem;
    font-size: 14px;
}

/* For older browsers */
.file-input::-webkit-file-upload-button {
    height: 100%;
    padding: .5rem 1rem;
    font-size: 14px;
}

.file-name-inside {
    position: absolute;
    top: 50%;
    left: 120px;
    transform: translateY(-50%);
    z-index: 3;
    font-size: 15px;
    color: #6c757d;
    max-width: 60%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    pointer-events: auto;
    color: #000;
}

.file-name-inside a {
    color: #0d6efd;
    text-decoration: none;
}

.file-name-inside a:hover {
    text-decoration: underline;
}
</style>

@endsection