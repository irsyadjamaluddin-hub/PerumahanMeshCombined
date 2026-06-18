@extends('layouts.app-all')

@section('title', 'PPS')

@section('content')

<?php
$pagename = "PPS";
?>

<section class="section profile">

    <div class="col-lg-12">

        @if(Session::has('success_message'))
        <div class="alert alert-success">
            <i class=" fas fa-fw fa-check"></i>
            {!! session('success_message') !!}
        </div>
        @endif

        <div class="card">
    <div class="card-body mt-3 overflow-auto">
        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Pusat Perkhidmatan Setempat (PPS)<br> Number of Visitors</h5>

        <table class="table table-striped table-bordered mt-3 text-center">
            <thead>
                <tr>
                    <th scope="col">Counter</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <!-- ==================================================================================================== -->
            <!-- Added by Amal 'Izzah (PB) -->

            <tbody>
                @if($ppsvisitors->isEmpty())
                    <tr class="text-center">
                        <td colspan="8">
                            <h5>No records found</h5>
                        </td>
                    </tr>
                @else
                @foreach($ppsvisitors->unique('counter') as $ppsvisitor)
                    <tr>
                        <td>{{ $ppsvisitor->counter }}</td>
                        <td>{{ $latestUpdateTimes[$ppsvisitor->counter] }}</td>
                        <td>
                            <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                <form method="get" action="{{ route('pps.pps.editpps', $ppsvisitor->id ) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="bi bi-list-ul"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>

            <!-- ==================================================================================================== -->
        </table>
    </div>
</div>


    </div>

</section>
@endsection