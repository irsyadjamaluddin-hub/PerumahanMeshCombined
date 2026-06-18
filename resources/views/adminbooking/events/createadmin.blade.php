@extends('layouts.app-all')
@section('content')

<?php 
    $pagename = "Events Create";
?>

@if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
@endif

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('adminbooking.events.storeadmin') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="room_id">Room</label>
                <select class="form-control select2 {{ $errors->has('room') ? 'is-invalid' : '' }}" name="room_id" id="room_id" required>
                <option>Select a Room</option>
                    @foreach($rooms as $id => $room)
                        <option value="{{ $id }}">{{ $room }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="required" for="name">Nama</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.event.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title')}}" required>
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
                <label class="required" for="pengerusi">Pengerusi</label>
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
            
            <div class="form-group">
                <label for="recurring_until">Recurring until</label>
                <input class="form-control date " type="text" name="recurring_until" id="recurring_until" value="{{ old('recurring_until') }}">
            </div>
            
            
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
