@extends('layouts.app-all')

@section('title', 'Booking')

@section('content')

<?php
$pagename = "Booking";
?>

<img src="/img/bmr.png">

<div class="pagetitle">

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Meeting Room Booking System</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <div class="col-md-12">

        @if(Session::has('success_message'))
        <div class="alert alert-success">
            <i class=" fas fa-fw fa-check"></i>
            {!! session('success_message') !!}


        </div>
        @endif




        <!-- ART Table -->
        <div class="col-12">
            <div class="card recent-sales">



                <div class="card-body overflow-auto">
                    <!-- <h5 class="card-title">Recent Sales <span>| Today</span></h5> -->

                    <table class="table table-borderless mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>

                                <th scope="col">Jawatan</th>
                                <th scope="col">Jabatan</th>

                                <th scope="col">Tel.No</th>

                                <th scope="col">Agenda</th>
                                <th scope="col">Anjuran</th>
                                <th scope="col">Tarikh</th>
                                <th scope="col">Hadir</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if(count($bookingmr) == 0)

                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>

                            @else
                            @foreach($bookingmr as $booking)

                            <tr>
                                <td>{{ $booking->name }}</td>

                                <td>{{ $booking->jawatan }}</td>
                                <td>{{ $booking->dept }}</td>

                                <td>{{ $booking->tel_no }}</td>
                                <td>{{ $booking->agenda }}</td>
                                <td>{{ $booking->anjuran }}</td>

                                <td>{{ date('d-m-Y', strtotime($booking->date_no)) }}</td>
                                <td>{{ $booking->hadir }}</td>

                                @if ($booking->booking_recieved_at == null)
                                <td> <a href="{{ route('bookings.booking.terima', $booking->id) }}"
                                        class="btn btn-success">Verify</a>

                                </td>
                                @else
                                <td>{{ date('d/m/Y', strtotime($dispatch->dispatch_recieved_at)) }}</td>
                                @endif


                                <td>

                                    <!----Delete Button----->
                                    <form method="post" action="{{ route('bookings.booking.index' ) }}">
                                        @csrf

                                        @method('delete')

                                        <button type="submit" class="btn btn-outline-danger">
                                            <i> End </i>
                                        </button>

                                    </form>



                                </td>

                            </tr>

                            @endforeach
                            @endif

                        </tbody>
                    </table>

                </div>

            </div>
        </div><!-- End Recent Sales -->

    </div>


    @endsection