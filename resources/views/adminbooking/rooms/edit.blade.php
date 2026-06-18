@extends('layouts.app-all')
@section('title', 'Edit Room')
@section('content')

<?php 
    $pagename = "Rooms";
?>

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.room.title_singular') }}
    </div>

    <div class="card-body">
        <form  method="post" action="{{ route('adminbooking.rooms.update') }}" enctype="multipart/form-data">
            @csrf
            @foreach($room as $rooms)

            <input class="form-control" type="text" name="id" id="id" value="{{ old('namide', $rooms->id) }}" hidden>

            <div class="form-group">
                <label class="required" for="label">Name</label>
                <input class="form-control" type="text" name="label" id="label" value="{{ old('label', $rooms->label) }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="capacity">Capacity</label>
                <input class="form-control" type="text" name="capacity" id="capacity" value="{{ old('capacity', $rooms->capacity) }}" required>
            </div>


            <div class="form-group">
                <label class="required" for="description">Description</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $rooms->description) }}</textarea>

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