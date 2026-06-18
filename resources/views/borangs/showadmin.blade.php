@extends('layouts.app-all')

@section('title', 'Admin Show Borang')

@section('content')

<?php
$pagename = "Borang";
?>

<div class="pagetitle">
    <h1>Borang</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Borang</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <a href="{{ route('borang.borangs.indexadmin') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-12">
        <div class="card recent-sales">
            <div class="card-body">

                <div class="profile-overview pt-3">

                    <div class="col profile-overview" style="padding-top: 18px; padding-left: 18px; padding-right: 18px;">

                    <h4>Keterangan Inisiatif/Projek Pendigitalan Perkhidmatan Dalaman</h4>
                    <hr>

                        <div class="row">
                            <div class="col-lg-4 label">Jabatan:</div>
                            <div class="col-lg-8">{{ ($borangs->jabatan) }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Bahagian/Unit:</div>
                            <div class="col-lg-8">{{ ($borangs->bahagian) }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Jenis Perkhidmatan:</div>
                            <div class="col-lg-8">{{ ($borangs->perkhidmatan) }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Huraian Inisiatif:</div>
                            <div class="col-lg-8">{{ ($borangs->huraian) }}</div>
                        </div>

                        @if ($borangs->file_image == '')

                        @else

                        <div class="row">
                            <div class="col-lg-4 label">Nama Fail:</div>
                            <div class="col-lg-8">{{ ($borangs->file_name) }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-8">             
                                <a href='{{Storage::url("$borangs->file_image") }}' target="_blank">
                                <p>View Uploaded File</p>
                                </a>
                            </div>
                        </div>

                        @endif

                        <div class="row">
                            <div class="col-lg-4 label">Nama:</div>
                            <div class="col-lg-8">{{ ($borangs->nama) }}</div>
                        </div>

                        <div class="row">                        
                            <div class="col-lg-4 label">Emel:</div>
                            <div class="col-lg-8">{{ ($borangs->email) }}</div>
                        </div>

                        <div class="row">                        
                            <div class="col-lg-4 label">No.Telefon:</div>
                            <div class="col-lg-8">{{ ($borangs->telefon) }}</div>
                        </div>
                          
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>
@endsection