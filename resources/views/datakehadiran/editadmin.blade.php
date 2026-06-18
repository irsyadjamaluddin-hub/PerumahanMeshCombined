@extends('layouts.app-all')

@section('title', 'Admin edit')

@section('content')

<?php
$pagename = "Edit_Admin_Data_kehadiran";
?>

<div class="pagetitle">
    <h1>Edit Admin Data Kehadiran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">User</li>
            <li class="breadcrumb-item active">Edit Admin Data Kehadiran</li> <!-- Removed extra "<" character -->
        </ol>
    </nav>
</div>

@if(Session::has('success_message'))
<div class="alert alert-success">
    <i class=" fas fa-fw fa-check"></i>
    {!! session('success_message') !!}
</div>
@endif

<!-- <div class="col-md-1 text-left">
    <button onclick="goBack()" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem;">
        <i class="bi bi-arrow-left-circle"></i>
    </button>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script> -->

<div class="col-md-1 text-left">
    <a href="https://mesh.moe.gov.bn/datakehadiran/indexadmin" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem;">
    <i class="bi bi-arrow-left-circle"></i>
    </a>
</div> 

<section class="section profile">

<div class="col-12">
        <div class="card recent-sales">
            <div class="card-body">
    <div class="profile-overview">
        <!-- Removed empty <h3> element -->
        @foreach($datakehadirans as $datakehadiran)

        <form class="" method="post" action="{{ route('datakehadiran.datakehadiran.updateadmin') }}" enctype="multipart/form-data">
            @csrf

            <br>

            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Data Kehadiran</h5>

            <input type="text" name="id" class="form-control" value="{{$datakehadiran->id}}" hidden>

            <div class="row mb-3">
                <div class="col-sm-4 label">Kategori</div>
                <div class="col-sm-8">
                    <select name="kategori" class="form-control">
                        <option value="MOE PENDIDIKAN TERAS" @if($datakehadiran->kategori == "MOE PENDIDIKAN TERAS") selected @endif>MOE PENDIDIKAN TERAS</option>
                        <option value="MOE PENGAJIAN TINGGI" @if($datakehadiran->kategori == "MOE PENGAJIAN TINGGI") selected @endif>MOE PENGAJIAN TINGGI</option>
                        <option value="MORA" @if($datakehadiran->kategori == "MORA") selected @endif>MORA</option>
                        <option value="PASUKAN BERUNIFORM" @if($datakehadiran->kategori == "PASUKAN BERUNIFORM") selected @endif>PASUKAN BERUNIFORM</option>
                        <option value="SEKOLAH-SEKOLAH SWASTA" @if($datakehadiran->kategori == "SEKOLAH-SEKOLAH SWASTA") selected @endif>SEKOLAH-SEKOLAH SWASTA</option>
                        <option value="INSTITUT PENGAJIAN TINGGI SWASTA" @if($datakehadiran->kategori == "INSTITUT PENGAJIAN TINGGI SWASTA") selected @endif>INSTITUT PENGAJIAN TINGGI SWASTA</option>
                        <option value="PEGAWAI & KAKITANGAN" @if($datakehadiran->kategori == "PEGAWAI & KAKITANGAN") selected @endif>PEGAWAI & KAKITANGAN</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-4 label">Sekolah/Institusi</div> <!-- Removed extra ">" character -->
                <div class="col-sm-8">
                    <select id="sekolah_institusi" class="form-select" name="sekolah_institusi" aria-label="Default select example" style="width: 100%;">
                        <option value="" disabled selected></option>
                        @foreach ($dkschools as $key => $value)
                            <option value="{{ $value }}" {{ $datakehadiran->sekolah_institusi == $value ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>

                </div>
            </div>
            <script>
                $('#sekolah_institusi').select2({
                    width: '100%',
                    placeholder: "{{$datakehadiran->sekolah_institusi}}",
                    allowClear: true
                });
            </script>

            <div class="row mb-3">
                <label class="col-sm-4 label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" name="nama_pelajar_pengawas" value="{{$datakehadiran->nama_pelajar_pengawas}}" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-4 label">IC No./SKB No.</label>
                <div class="col-sm-8">
                    <input type="text" name="icno_skbno" value="{{$datakehadiran->icno_skbno}}" class="form-control">
                </div>
            </div>


            <div class="row mb-3">
                <label for="inputText" class="col-sm-4 label">Pelajar / Pengawas</label>
                <div class="col-sm-8">
                    <select class="form-select" name="type_pelajar_pengawas" aria-label="Default select example">
                        <option selected hidden value="">-- Pilih --</option>
                        <option value="G" {{ strtoupper($datakehadiran->type_pelajar_pengawas) === 'G' || strtoupper($datakehadiran->type_pelajar_pengawas) === 'GH' || strtoupper($datakehadiran->type_pelajar_pengawas) === 'GP' ? 'selected' : '' }}>Pengawas</option>
                        <option value="P" {{ strtoupper($datakehadiran->type_pelajar_pengawas) === 'P' || strtoupper($datakehadiran->type_pelajar_pengawas) === 'PH' ? 'selected' : '' }}>Pelajar</option>
                        <option value="PU" {{ strtoupper($datakehadiran->type_pelajar_pengawas) === 'PU' ? 'selected' : '' }}>Pegawai Uniform</option>
                    </select>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-sm-4 label">Status</div>
                <div class="col-sm-8">
                    <select name="hadir" class="form-control">
                        <option value="">-- Pilih Status --</option>
                        <option value="X" @if($datakehadiran->hadir == "X") selected @endif>Tidak Hadir</option>
                        <option value="1" @if($datakehadiran->hadir == "1") selected @endif>Hadir</option>
                    </select>
                </div>
            </div>


            <div class="row mb-3">
                <label for="inputText" class="col-sm-4 label">Pasukan (<i>Jika berkenaan</i>)</label>
                <div class="col-sm-8">
                    <select class="form-select" name="pasukan" aria-label="Default select example">
                        <option selected hidden value="">Pilih Pasukan</option>
                        <option value="Kadet Polis" {{ $datakehadiran->pasukan == 'Kadet Polis' ? 'selected' : '' }}>Kadet Polis</option>
                        <option value="Kadet Tentera" {{ $datakehadiran->pasukan == 'Kadet Tentera' ? 'selected' : '' }}>Kadet Tentera</option>
                        <option value="Pandu Puteri" {{ $datakehadiran->pasukan == 'Pandu Puteri' ? 'selected' : '' }}>Pandu Puteri</option>
                        <option value="Pasukan Hadrah" {{ $datakehadiran->pasukan == 'Pasukan Hadrah' ? 'selected' : '' }}>Pasukan Hadrah</option>
                        <option value="Pengakap" {{ $datakehadiran->pasukan == 'Pengakap' ? 'selected' : '' }}>Pengakap</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-4 label">Pindah sekolah / Institusi?</label>
                <div class="col-sm-8">
                    <select class="form-select" name="pindah" aria-label="Default select example">
                        <option value="" {{ $datakehadiran->pindah == '' ? 'selected' : '' }}>Pilih</option>
                        <option value="Tidak" {{ $datakehadiran->pindah == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        <option value="Ya" {{ $datakehadiran->pindah == 'Ya' ? 'selected' : '' }}>Ya</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-4 label">Catatan</label>
                <div class="col-lg-8">
                    <textarea type="text" name="catatan" class="form-control">{{$datakehadiran->catatan}}</textarea> <!-- Removed unnecessary value attribute -->
                </div>
            </div>

            <br>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        @endforeach
    </div>
</div>
</div>
</section>
@endsection
