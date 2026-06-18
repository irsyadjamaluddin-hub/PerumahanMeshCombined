@extends('layouts.app-all')

@section('title', 'Participant Event')

@section('content')

<?php
$pagename = "Participant Event";
?>

<div class="pagetitle">
    <h1>MOE Event</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('moeevent.moeevent.indexadmin') }}">MOE Event</a></li>
        <li class="breadcrumb-item active">Approved Participants</li>
    </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

  <a href="{{ route('moeevent.moeevent.indexadmin') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>


  <!-- start new div -->


    <div class="card pt-3">
        <div class="card-body" style="padding: 20px;">
            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">
                    List Approved Participant
                </h5>

                <br>

                <!-- Export to Excel - Fira -->
                <div style="text-align: right;">
                    @foreach ($events as $event)
                        <a href="{{ route('export.to.excel', ['id' => $event->id]) }}" class="btn btn-success">Export Excel</a>
                    @endforeach
                </div>

                <table class="table table-borderless datatable mt-3" style="width: 100%; margin: 0;">
                    <thead>
                        <tr>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Jawatan</th>
                            <th scope="col">Nama</th>
                            <th scope="col">IC.No</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(count($moeevent) == 0)
                            <tr class="text-center">
                                <td colspan="7">
                                    <h5>No records found</h5>
                                </td>
                            </tr>
                        @else
                            @foreach($moeevent as $moeevent)
                                <tr>
                                    <td>{{ $moeevent->jabatan}}</td>
                                    <td>{{ $moeevent->jawatan}}</td>
                                    <td>{{ $moeevent->nama}}</td>
                                    <td>{{ $moeevent->icno}}</td>
                                    <td>{{ $moeevent->email}}</td>
                                    <td>
                                        @if ($moeevent->attend == "yes")
                                            <span class="badge bg-success">Hadir</span>
                                            <a href="{{ route('moeevent.moeevent.resubmitattendant', $moeevent->id) }}" class="btn btn-outline-primary">
                                                <i class="bi bi-arrow-counterclockwise"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('moeevent.moeevent.attended', $moeevent->id) }}" class="btn btn-outline-primary">
                                                <i class="bi bi-check-circle-fill"></i>
                                            </a>
                                            <a href="{{ route('moeevent.moeevent.resubmitattendant', $moeevent->id) }}" class="btn btn-outline-primary">
                                                <i class="bi bi-arrow-counterclockwise"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                            <form method="get" action="{{ route('moeevent.moeevent.showevent', $moeevent->id ) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary">
                                                    <i class="bi bi-eye-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>




  <!-- end new div -->

</section>
@endsection