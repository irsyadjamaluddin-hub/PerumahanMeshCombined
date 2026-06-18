@extends('layouts.app-all')
@section('title', 'Jadual Tempahan Admin')
@section('content')

<?php 
    $pagename = "Jadual Tempahan Admin";
?>

<h3 class="page-title">Jadual Tempahan</h3>

@if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
@endif

<div class="card">
    <div class="card-header">
        <div class="row mb-2">
            <div class="col-md-10" style="padding-top:10px">
                Jadual Tempahan
                @foreach($roomname as $rn)
                {{$rn->label}}
                @endforeach
            </div>  
            <div class="col-md-2" style="text-align:right;" >
                <a href="{{ route('adminbooking.searchroomadmin') }}" class= "btn btn-primary">
                Tempah Bilik
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css" />
        <form>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="room_id">Bilik</label>
                        <select class="form-control select2" name="room_id" id="room_id">
                        	<option selected disabled>Sila pilih Bilik</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="user_id">Pengguna</label>
                        <select class="form-control select2" name="user_id" id="user_id">
                            @foreach($users as $id => $user)
                                <option value="{{ $id }}" {{ request()->input('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary mt-4">
                        Tapis
                    </button>
                </div>
            </div>
        </form>

        <div id='calendar'></div>
    </div>
    <div class="card-footer">
        <div class="row mb-2 mt-3">
            <div class="col-lg-1"><b>Legenda:</b></div>
            <div class="col-lg-1"> Mula:</div>
            <div class="col-lg-1 color-start"></div>
            <div class="col-lg-1"> Tamat:</div>
            <div class="col-lg-1 color-end"></div>
        </div>
    </div>
</div>

<style>
.card-footer{
    border-color:
}
.color-start{
    background-color: #F9E795;
    border-color: #F9E795;
    padding-top:25px;
    height:10px;
    width:1px;
}
.color-end{
    background-color: #E2D1F9;
    border-color: #E2D1F9;
    padding-top:25px;
    height:10px;
    width:1px;
}
a.fc-event, .fc-event-dot {
    background-color: #F9E795;
    border-color: #F9E795;
    }
span.fc-time, span.fc-title {
    color: black;
}
</style>

@endsection

@section('scripts')
@parent
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function () {
            // page is now ready, initialize the calendar...
            events={!! json_encode($events) !!};
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events: events,


            })
        });
</script>
@stop