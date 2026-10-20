@extends('layouts.app-all')

@section('title', 'Event')

@section('content')

<?php
$pagename = "Event";
?>


<style>                
.dataTable-info{
    color: white;
}
</style>

<section class="section">
<div class="row">

    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif

 
    <div class="col-12 mb-2 mt-2" style="text-align: right;">
        <a href="{{ route('sk.slipkedatangan.createevent') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    <div class="col-12">
        <div class="card">

            <div class="card-body overflow-auto">

                <table class="table table-borderless datatable mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Perkara</th>
                            <th scope="col">Tempat</th>
                            <th scope="col">Jam/Masa</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        @if(count($skevent) == 0)
                        <tr class="text-center">
                            <td colspan="8">
                                <h5>No records found</h5>
                            </td>
                        </tr>

                        @else

                        @foreach($skevent as $skevent)

                            <tr>

                                <td>{{ $skevent->perkara }}</td>
                                <td>{{ $skevent->tempat}}</td>
                                <td>{{ date('H:i:s', strtotime($skevent->masa)) }}</td>
                                <td>{{ optional($skevent->Department)->label }}</td>

                              
                                <td>

                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('sk.slipkedatangan.editevent', $skevent->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </form>

                                
                                                                                
                                    </div>

                                </td>

                            </tr>

                        @endforeach
                        @endif

                    </tbody>
                </table>

            </div>

        </div>
    </div>

</div>
</section>
@endsection
