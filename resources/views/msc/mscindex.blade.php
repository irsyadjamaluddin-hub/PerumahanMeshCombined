@extends('layouts.app-all')

@section('title', 'Indeks Tegahan')

@section('content')

<?php
$pagename = "Suspended Company Report";
?>


<div class="pagetitle">
    <h1>Tegahan</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Laman Utama</a></li>
        <li class="breadcrumb-item active">Indeks Tegahan</li>  
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <div class="row mb-2" style="padding-left: 15px;">
        <div class="col-md-2" style="width: 10%; padding-right: 0px;">
            <label class="col-form-label">Tarikh Hari Ini: </label>
        </div>
        <div class="col-md-3" style="padding-left: 10px;">
            <input type="text" class="form-control" value="{{ now()->format('jS F Y') }}" disabled>
        </div>
    </div>

    <div class="col-12" id="MSC-content">
        <div class="card recent-sales">
            <div class="card-body overflow-auto">

                <table class="table table-borderless datatable mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Bil</th>
                            <th scope="col">Nama Syarikat</th>
                            <th scope="col">Kementerian</th>
                            <th scope="col">Tempoh Bulanan</th>
                            <th scope="col">Bil.Rujukan</th>
                            <th scope="col">Sebab Tegahan</th>
                            <th scope="col">Tarikh Mula</th>
                            <th scope="col">Tarikh Tamat</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($suspendedcompany as $suspendedcompanys)
                    <tr>
                        <td style="text-align: center;">{{ $suspendedcompanys->id }}</td>
                        <td>{{ $suspendedcompanys->nama_syarikat }}</td>
                        <td>{{ $suspendedcompanys->kementerian }}</td>
                        <td style="text-align: center;">{{ $suspendedcompanys->tempoh_bulanan }}</td>
                        <td>{{ $suspendedcompanys->bil_rujukan }}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#sebabModal-{{ $suspendedcompanys->id }}" data-bs-tooltip="tooltip" data-bs-placement="top">
                                <i class="bi bi-card-text"></i>
                            </button>
                        </td>
                        <div class="modal fade" id="sebabModal-{{ $suspendedcompanys->id }}" tabindex="-1" aria-labelledby="sebabModalLabel-{{ $suspendedcompanys->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center">
                                        <h5 class="modal-title" id="sebabModalLabel-{{ $suspendedcompanys->id }}" style="text-align: center;"><b>Sebab</b></h5>
                                    </div>
                                    <div class="modal-body">
                                        <textarea placeholder="{{ $suspendedcompanys->sebab }}" class="form-control" disabled></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #f75f6e; border-color: #f75f6e;">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <td>{{ $suspendedcompanys->date_start->format('jS F Y') }}</td>
                        <td>{{ $suspendedcompanys->date_end->format('jS F Y') }}</td>
                        @php
                            $currentDate = \Carbon\Carbon::now(); // Get the current date
                            $startDate = $suspendedcompanys->date_start;
                            $endDate = $suspendedcompanys->date_end;
                        @endphp
                        <td>
                            @if ($currentDate >= $startDate && $currentDate <= $endDate)
                                <span class="badge badge-danger">Ditegah</span>
                            @elseif ($currentDate > $endDate)
                                <span class="badge badge-success">Selesai</span>
                            @elseif ($currentDate < $startDate)
                                <span class="badge badge-warning">Belum Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>
@endsection