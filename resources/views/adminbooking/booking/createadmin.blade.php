@extends('layouts.app-all')
@section('title', 'Create Booking Admin')
@section('content')

<?php 
    $pagename = "Booking Room";
?>

<div class="card">
    <div class="card-header">
    Booking Room
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('adminbooking.booking.storeadmin') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="room_id">Room</label>
                <select class="form-control select2 {{ $errors->has('room') ? 'is-invalid' : '' }}" name="room_id" id="room_id" required>
                <option>Select a Room</option>
                    @foreach($rooms as $id => $room)
                        <option value="{{ $room }}">{{ $room }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="required" for="name">Nama</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>
   
            <div class="form-group">
                <label class="required" for="jawatan">Jawatan</label>
                <input class="form-control" type="text" name="jawatan" id="jawatan" value="{{ old('jawatan') }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="tel_no">No Telefon</label>
                <input class="form-control" type="text" name="tel_no" id="tel_no" value="{{ old('tel_no') }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="agenda">Tajuk</label>
                <input class="form-control" type="text" name="agenda" id="agenda" value="{{ old('agenda') }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="anjuran">Anjuran</label>
                <input class="form-control" type="text" name="anjuran" id="anjuran" value="{{ old('anjuran') }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="pengerusi">Pengerusi/Tetamu Hormat</label>
                <input class="form-control" type="text" name="pengerusi" id="pengerusi" value="{{ old('pengerusi') }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="dept">Jabatan</label>
                <input class="form-control" type="text" name="dept" id="dept" value="{{ old('dept') }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.event.fields.start_time') }}</label>
                <input class="form-control datetime " type="text" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="end_time">{{ trans('cruds.event.fields.end_time') }}</label>
                <input class="form-control datetime " type="text" name="end_time" id="end_time" value="{{ old('end_time') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control " name="description" id="description">{{ old('description') }}</textarea>
            </div>
            
            <input class="form-control date {{ $errors->has('recurring_until') ? 'is-invalid' : '' }}" type="text" name="recurring_until" id="recurring_until" value="{{ old('end_time') }}" hidden>
            
            
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
