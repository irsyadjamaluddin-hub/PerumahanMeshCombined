@extends('layouts.app-all')
@section('title', 'Details Room')
@section('content')

<?php 
    $pagename = "Rooms";
?>

<div class="card">
    <div class="card-header">
        Room Details
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-success" href="{{ route('adminbooking.rooms.index') }}">
                    Back
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    @foreach( $room as $rooms)
                    <tr>
                        <th>
                            ID
                        </th>
                        <td>
                            {{ $rooms->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            {{ $rooms->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Capacity
                        </th>
                        <td>
                            {{ $rooms->capacity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Description
                        </th>
                        <td>
                            {{ $rooms->description }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>



@endsection