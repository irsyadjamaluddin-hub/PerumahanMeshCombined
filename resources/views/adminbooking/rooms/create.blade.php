@extends('layouts.app-all')
@section('title', 'Create Room')
@section('content')

<?php 
    $pagename = "Rooms";
?>

<div class="card">
    <div class="card-header">
        Create Room
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('adminbooking.rooms.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="label">Name</label>
                <input class="form-control {{ $errors->has('label') ? 'is-invalid' : '' }}" type="text" name="label" id="label" value="{{ old('label', '') }}" required>
            </div>
            <div class="form-group">
                <label for="capacity">Capacity</label>
                <input class="form-control {{ $errors->has('capacity') ? 'is-invalid' : '' }}" type="number" name="capacity" id="capacity" value="{{ old('capacity', '') }}" step="1">
                
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>



@endsection