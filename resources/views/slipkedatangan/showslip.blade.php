@extends('layouts.app-all')

{{-- #==========ORI CODE=========
@section('title', 'Admin Show Slip Kehadiran')
===========================--}}
{{-- #==========NEWLY ADDED======== --}}
@section('title', 'Admin Show MESH Attendance Slip')
{{-- ===========================--}}

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" sections; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
<div class="mesh-home-theme">
{{-- #================================ --}}

<?php
$pagename = "Slip Kehadiran";
?>

<div class="pagetitle">
    {{-- #==========ORI CODE=========
    <h1>Slip Kehadiran</h1>
    ===========================--}}
    {{-- #==========NEWLY ADDED======== --}}
    <h1>MESH Attendance Slip</h1>
    {{-- ===========================--}}
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Perkara: {{ $skperkara['label'] }}</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <a href="{{ route('sk.slipkedatangan.indexadmin') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    @if(Session::has('success_message'))
      <div class="alert alert-success">
          <i class=" fas fa-fw fa-check"></i>
          {!! session('success_message') !!}
      </div>
    @endif

    <div class="col-12">
        <div class="card pt-3">
            <div class="card-body overflow-auto">

                <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Perkara Details</h5>
                    <br>

                        <form action="{{ route('sk.slipkedatangan.updateslip', $skperkara['id']) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-lg-4 label d-flex align-items-center">Perkara</div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="label" value="{{ $skperkara['label'] }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 label d-flex align-items-center">Jabatan</div>
                                <div class="col-lg-8">
                                    <div class="form-control">{{ $skperkara['jabatan'] }}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 label d-flex align-items-center">Tarikh Bermula</div>
                                <div class="col-lg-8">
                                    <input class="form-control" type="datetime-local" name="tarikh_bermula" id="tarikh_bermula" value="{{ $skperkara['tarikh_bermula'] }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 label d-flex align-items-center">Tarikh Berakhir</div>
                                <div class="col-lg-8">
                                    <input class="form-control" type="datetime-local" name="tarikh_berakhir" id="tarikh_berakhir" value="{{ $skperkara['tarikh_berakhir'] }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 label d-flex align-items-center">Status</div>
                                <div class="col-lg-8">
                                    <select name="status" id="status" class="form-control">
                                        <option value="" {{ $skperkara->status == null ? 'selected' : '' }}>--Pilih Status--</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status }}" {{ $skperkara->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>

                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card pt-3">
            <div class="card-body">
                <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Keterangan Slip Kehadiran</h5>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-borderless datatable mt-3" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Tarikh</th>
                                    <th scope="col">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($slips) == 0)
                                    <tr class="text-center">
                                        <td colspan="8">
                                            <h5>No records found</h5>
                                        </td>
                                    </tr>
                                @else
                                @foreach($slips as $slip)
                                    <tr>
                                        <td>{{ $slip['nama']}}</td>
                                        <td>{{ $slip['jabatan']}}</td>
                                        <td>{{ $slip['created_at']}}</td>
                                        <td>{{ $slip['remark'] != null ? $slip['remark'] : '-'}}</td>

                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
@endsection
