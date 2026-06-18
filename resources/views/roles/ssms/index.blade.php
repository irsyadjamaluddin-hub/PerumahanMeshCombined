@extends('layouts.app-all')

@section('title', 'SSM Index')

@section('content')

<?php
$pagename = "SSMS";
?>

<div class="pagetitle">
    <h1>SSM</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">SSM</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <div class="col-md-12">

        @if(Session::has('success_message'))
        <div class="alert alert-success">
            <i class=" fas fa-fw fa-check"></i>
            {!! session('success_message') !!}


        </div>
        @endif

        <div class="row mb-2">

            @if(count($ssms) == 0)

            <div class="col-md-1">

                <a href="{{ route('ssms.ssm.create') }}" class="btn btn-primary text-right">

                    <i class="bi bi-plus-lg"></i>
                </a>
            </div>
            @else

            <div></div>
            @endif
        </div>


        <!-- ART Table -->
        <div class="col-12">
            <div class="card recent-sales">



                <div class="card-body overflow-auto">
                    <!-- <h5 class="card-title">Recent Sales <span>| Today</span></h5> -->

                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">IC No.</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @if(isset($ssms) == 0)

                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>

                            @else
                            @foreach($ssms as $ssm)

                            <tr>
                                <td>{{ $ssm->name }}</td>
                                <td>{{ $ssm->ic_no }}</td>
                                @if($ssm->status_ssm == null)
                                <td>Dihadapkan Ke JPA</td>
                                @else
                                <td>{{ $ssm->status_ssm }}</td>
                                @endif


                                <td>

                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">


                                        <!----Show Button----->
                                        <form method="get" action="{{ route('ssms.ssm.show', $ssm->id) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </button>

                                        </form>


                                        <!----Delete Button----->
                                        <!-- <form method="post" action="{{ route('ssms.ssm.destroy', $ssm->id ) }}">
                                            @csrf

                                            @method('delete')
                                            <a onclick='return confirm("Confirm to delete data?")'>

                                                <button type="submit" class="btn btn-outline-danger">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>

                                        </form> -->

                                    </div>



                                </td>

                            </tr>

                            @endforeach
                            @endif

                        </tbody>
                    </table>

                </div>

            </div>
        </div><!-- End Recent Sales -->

    </div>


    @endsection