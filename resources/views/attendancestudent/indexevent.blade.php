@extends('layouts.app-all')

@section('title', 'Event List')

@section('content')


<?php
$pagename = "Data_kehadiran";
?>

<div class="pagetitle">
    <h1>Event List</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Event List</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif

    <br>

    <div class="col-12 mb-2 mt-2" style="text-align: right;">
        <!-- Added by Amal 'Izzah (PB) -->
        <a href="https://mesh.moe.gov.bn/ratingopenform"  target="_blank" class= "btn btn-primary" hidden>
            <i class="bi bi-send"></i>
        </a>
        <!------ ==========  ------>
        <a href="{{ route('attendance.attendances.generalsearch') }}" class="btn btn-primary">
            <i class="bi bi-link"></i>
        </a>
    </div>
@if (Auth::check())
    @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        @php
            $route = route('attendance.attendances.laporan', encrypt(''));
        @endphp
        <a href="{{ $route }}">Go to Laporan</a>
    @endif
@endif
    <div class="col-lg-12">
        <div class="card">
        
            <div class="card-body mt-3 overflow-auto">
                <h5 class="card-title">Event Details</h5>
                <form class="" method="post" action="{{ route('attendance.attendances.storeevent') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-lg-1 col-form-label">Nama:</label>
                        <div class="col-lg-3">
                            <input type="text" name="name" class="form-control">
                            {!! $errors->first('name', '<p class="help-block text-danger">:message</p>')!!}
                        </div>
                        <label class="col-lg-1 col-form-label">Date:</label>
                        <div class="col-lg-2">
                            <input type="date" name="date" class="form-control" placeholder="Date">
                            {!! $errors->first('date', '<p class="help-block text-danger">:message</p>')!!}
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-outline-success" >
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
                <table class="table table-borderless datatable mt-3">
                    <thead>
                        <tr>
                            <th scope="col">QR Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                            <th scope="col">Submitted At</th>
                        </tr>
                    </thead>

                    <tbody>

                        @if(count($event) == 0)

                        <tr class="text-center">
                            <td colspan="8"><h5>No records found</h5></td>
                        </tr>
                                
                        @else
                        @foreach($event as $events)
                        
                            <tr>
                                <td>
                                    <a href="{{ route('attendance.attendances.qrcodeevent', $events->name) }}">
                                        {{ QrCode::size(100)->generate(route('attendance.attendances.qrcodeevent', $events->name)) }}
                                    </a>                       
                                </td>
                                <td>{{ $events->name }}</td>
                                <td>{{ $events->date }}</td>
                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example"> 

                                        <form method="get" action="{{ route('attendance.attendances.indexchosen', $events->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                            <i class="bi bi-card-checklist"></i>
                                            </button>
                                        </form>
                                    
                                        <form method="post" action="{{ route('attendance.attendances.destroyevent', $events->id ) }}">
                                        @csrf  @method('delete')
                                            <a onclick='return confirm("Confirm to delete data?")'> <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash-fill"></i></button></a>
                                        </form>

                                        <form method="get" action="{{ route('attendance.attendances.laporanevent', $events->name ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                            <i class="bi bi-bar-chart-line-fill"></i>
                                            </button>
                                        </form>

                                        <form method="get" action="{{ route('attendance.attendances.dynamiclaporanevent', $events->name ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                            <i class="bi bi-bar-chart-line-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td>{{ $events->created_at }}</td>
                            </tr>
                        @endforeach
                        @endif
                            
                    </tbody>
                </table>
        </div>
        </div>
      </div>
    </div>
</section>


@endsection

   
    