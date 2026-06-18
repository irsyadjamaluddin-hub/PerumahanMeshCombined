@extends('layouts.app-all')
@section('content')

<?php 
    $pagename = "Events Show";
?>

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.event.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    @foreach($event as $events)
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.id') }}
                        </th>
                        <td>
                            {{ $events->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.room') }}
                        </th>
                        <td>
                        @foreach($eventroom as $eventrooms)
                                    {{ $eventrooms->label }}
                                @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            IC No
                        </th>
                        <td>
                            {{ $events-> user_id}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.title') }}
                        </th>
                        <td>
                            {{ $events->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.start_time') }}
                        </th>
                        <td>
                            {{ $events->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.end_time') }}
                        </th>
                        <td>
                            {{ $events->end_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.description') }}
                        </th>
                        <td>
                            {{ $events->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Jawatan
                        </th>
                        <td>
                            {{ $events->jawatan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Jabatan
                        </th>
                        <td>
                            {{ $events->dept }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Telephone No.
                        </th>
                        <td>
                            {{ $events->tel_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Agenda
                        </th>
                        <td>
                            {{ $events->agenda }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Anjuran
                        </th>
                        <td>
                            {{ $events->anjuran }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Pengerusi
                        </th>
                        <td>
                            {{ $events->pengerusi }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-xs btn-primary" href="{{ route('adminbooking.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection