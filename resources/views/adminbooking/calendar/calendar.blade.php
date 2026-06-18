@extends('layouts.app-all')
@section('title', 'Booking Schedule')
@section('content')

<?php 
    $pagename = "Booking Schedule";
?>

<h3 class="page-title" id="bookingtitlefont">Booking Schedule</h3>

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
                Booking Schedule
                @foreach($roomname as $rn)
                {{$rn->label}}
                @endforeach
            </div>  
            <div class="col-md-2" style="text-align:right;" >
                <a href="{{ route('adminbooking.searchroom') }}" class= "btn btn-primary ">
                Book Room
                </a>
            </div>
        </div>
    </div>
    
    <div class="card-body">
    <form id="filterForm" action="{{ route('adminbooking.systemcalendar') }}" method="GET">
        <div class="row mb-3 mt-3">
            <label class="col-lg-1 col-form-label">Room:</label>
            <div class="col-lg-6 mt-1">
                <select class="form-control select2" name="room_id" id="room_id">
                    <option selected disabled>Please select a Room</option>
                    @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3">
                <button type="submit" class="btn btn-primary">
                    Filter
                </button>
            </div>
        </div>
    </form>
    <div id="calendarWrapper" style="padding-top:10px; display:none;">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css" />
        <div id='calendar'></div>
    </div>
</div>
    <div class="card-footer">
        <div class="row mb-2 mt-3">
            <div class="col-lg-1"><b>Legend:</b></div>
            <div class="col-lg-1"> Start:</div>
            <div class="col-lg-1 color-start"></div>
            <div class="col-lg-1"> End:</div>
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

#bookingtitlefont {
    font-family: 'Nunito', sans-serif !important;
    font-size: 28px;
    font-weight: 500;
    line-height: 1.2;
}

h1, h2, h3, h4, h5, h6 {
    font-family: 'Nunito', sans-serif !important;
    font-size: 32px !important;
    font-weight: 500;
}
</style>

@endsection

@section('scripts')
@parent
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function () {
        var roomId = getUrlParameter('room_id');
        if (roomId) {
            $('#calendarWrapper').show();
            initCalendar(roomId);
        }

        $('#filterForm').submit(function (e) {
            e.preventDefault();
            var roomId = $('#room_id').val();
            window.location.href = "{{ route('adminbooking.systemcalendar') }}?room_id=" + roomId;
        });

        function initCalendar(roomId) {
            events = {!! json_encode($events) !!};
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events: events,
            });
        }

        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }
    });
</script>
@stop
