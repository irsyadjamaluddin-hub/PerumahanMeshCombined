@extends('layouts.app-all')

@section('title', 'Admin Settings Dashboard')

@section('content')

<?php $pagename = "AdminSettingsDashboard"; ?>

    <div class="pagetitle">
    <h1>Services</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Admin Settings Dashboard</li>
        </ol>
    </nav>
    </div>

    <section class="section dashboard">
    <div class="row">

        <!-- 1. Tambah Jenis -->
        <div class="col-lg-4">
        <a href="{{ route('adminsettings.editjenis') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 15px;">
                <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-list-task"></i>
                </div>
                <div class="ps-3">
                    <h6 style="font-size: 22px;">Jenis</h6>
                    <span>Senarai Jenis E-memo</span>
                </div>
                </div>
            </div>
            </div>
        </a>
        </div>

        <!-- 2. Tambah jenis tindakan -->
        <div class="col-lg-4">
        <a href="{{ route('adminsettings.editjenistindakan') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 15px;">
                <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-list-check"></i>
                </div>
                <div class="ps-3">
                    <h6 style="font-size: 22px;">Jenis Tindakan</h6>
                    <span>Senarai Jenis Tindakan E-Memo</span>
                </div>
                </div>
            </div>
            </div>
        </a>
        </div>

        <!-- 3. Tambah tindakan -->
        <div class="col-lg-4">
        <a href="{{ route('adminsettings.edittindakandiperlukan') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 15px;">
                <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-lines-fill"></i>
                </div>
                <div class="ps-3">
                    <h6 style="font-size: 22px;">Tindakan Diperlukan</h6>
                    <span>Senarai Kakitangan Jabatan</span>
                </div>
                </div>
            </div>
            </div>
        </a>
        </div>

                <!-- 3. tambah untuk perhatian -->
        <div class="col-lg-4">
        <a href="{{ route('adminsettings.edituntukperhatian') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 15px;">
                <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-check"></i>
                </div>
                <div class="ps-3">
                    <h6 style="font-size: 22px;">Untuk Perhatian</h6>
                    <span>Senarai UP: Ketua Bahagian Mengikut Jabatan</span>
                </div>
                </div>
            </div>
            </div>
        </a>
        </div>

        <div class="col-lg-4">
        <a href="{{ route('adminsettings.adminnotificationpush') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 15px;">
                <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-check"></i>
                </div>
                <div class="ps-3">
                    <h6 style="font-size: 22px;">Admin Notifikasi</h6>
                    <span>Senarai Admin Notifikasi</span>
                </div>
                </div>
            </div>
            </div>
        </a>
        </div>

    </div>
    </section>

@endsection
