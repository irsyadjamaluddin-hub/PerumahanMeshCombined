@extends('layouts.app-all')
@section('title', 'Admin Edit Booking')
@section('content')

<?php 
    $pagename = "Edit Booking";
?>

<div class="card">
    <div class="card-header">
    Edit Booking
    </div>

    <div class="card-body">
        <form method="post" action="{{ route('adminbooking.booking.update')}}" enctype="multipart/form-data">
            @csrf

            @foreach ($event as $events)

            <input class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" type="text" name="id" id="id" value="{{ old('id', $events->id) }}" hidden>

            <div class="form-group">
                <label class="required" for="name">Nama</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $events->name) }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="name">Bilik</label>
                <select class="form-select" name="room_id" id="myselect">
                    <option value="{{ $events->room_id}}"> {{$events->label}}</option>
                    @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">
                        {{ $room->label }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="required" for="jawatan">Jawatan</label>
                <input class="form-control" type="text" name="jawatan" id="jawatan" value="{{ old('jawatan', $events->jawatan) }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="tel_no">No Telefon</label>
                <input class="form-control" type="text" name="tel_no" id="tel_no" value="{{ old('tel_no', $events->tel_no) }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="agenda">Tajuk</label>
                <input class="form-control" type="text" name="agenda" id="agenda" value="{{ old('agenda', $events->agenda) }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="anjuran">Anjuran</label>
                <input class="form-control" type="text" name="anjuran" id="anjuran" value="{{ old('anjuran', $events->anjuran) }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="pengerusi">Pengerusi</label>
                <input class="form-control" type="text" name="pengerusi" id="pengerusi" value="{{ old('pengerusi', $events->pengerusi) }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="dept">Jabatan</label>
                <input class="form-control" type="text" name="dept" id="dept" value="{{ old('dept', $events->dept) }}" required>
            </div>

            
            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.event.fields.start_time') }}</label>
                <input class="form-control datetime {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time', $events->start_time) }}" required>
                @if($errors->has('start_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_time">{{ trans('cruds.event.fields.end_time') }}</label>
                <input class="form-control datetime {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ old('end_time', $events->end_time) }}" required>
                @if($errors->has('end_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.end_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.event.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $events->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.description_helper') }}</span>
            </div>
            @endforeach
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
