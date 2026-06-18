@extends('layouts.app-all')

@section('title', 'Admin Show Slip Kehadiran')

@section('content')

<?php
$pagename = "Slip Kehadiran";
?>

<div class="pagetitle">
    <h1>Slip Kehadiran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Slip Kehadiran Ref. No.{{ ($borangs->id) }}</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <a href="{{ route('sk.slipkedatangan.indexadmin') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-12">
        <div class="card recent-sales">
            <div class="card-body">

                <div class="profile-overview pt-3">

                    <div class="col profile-overview" style="padding-top: 18px; padding-left: 18px; padding-right: 18px;">

                    <h4>Keterangan Slip Kehadiran</h4>
                    <hr>

                        <div class="row">
                            <div class="col-lg-4 label">Perkara:</div>
                            <div class="col-lg-8">{{ ($borangs->perkara) }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Jabatan:</div>
                            <div class="col-lg-8">{{ ($borangs->jabatan) }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Nama:</div>
                            <div class="col-lg-8">{{ ($borangs->nama) }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Role:</div>
                            <div class="col-lg-8">{{ ($borangs->rolelabel) }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Jawatan:</div>
                            <div class="col-lg-8">{{ ($borangs->jawatan) }}</div>
                        </div>

                        <div class="row">                        
                            <div class="col-lg-4 label">Emel:</div>
                            <div class="col-lg-8">{{ ($borangs->email) }}</div>
                        </div>

                        <div class="row">                        
                            <div class="col-lg-4 label">No.Telefon:</div>
                            <div class="col-lg-8">{{ ($borangs->telefon) }}</div>
                        </div>
      
                        <div class="row">
                            <div class="col-lg-4 label">Catatan:</div>
                            <div class="col-lg-8">{{ ($borangs->remark) }}</div>
                        </div>   

                    </div>

                </div>
            </div>
        </div>
    </div>

</section>
@endsection