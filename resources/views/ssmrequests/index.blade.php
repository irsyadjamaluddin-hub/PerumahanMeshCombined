@extends('layouts.app-all')

@section('title', 'SSM Request Index')

@section('content')

<!-- <style>
.label {
  color: white;
  padding: 7px;
  font-family: Arial;
}
.success {background-color: #04AA6D;} /* Green */
.warning {background-color: #ff9800;} /* Orange */
.danger {background-color: #f44336;} /* Red */ 
.other {background-color: #e7e7e7; color: black;} /* Gray */ 
    </style> -->

<?php
$pagename = "SSM_Request";
?>

<div class="pagetitle">
    <h1>SSM Request</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">SSM Request</li>
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

                <a href="{{ route('ssmrequests.ssmrequest.create') }}" class="btn btn-primary text-right">

                    <i class="bi bi-plus-lg"></i>
                </a>
            </div>
            @else

            <div class="col-md-1">

                <a href="{{ route('ssmrequests.ssmrequest.create') }}" class="btn btn-primary text-right">

                    <i class="bi bi-plus-lg"></i>
                </a>
            </div>
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
                                <th scope="col">Ref. No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">IC No.</th>
                                <th scope="col">Approver Name</th>
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
                                <td>{{ $ssm->id }}</td>
                                <td>{{ $ssm->name }}</td>
                                <td>0{{ $ssm->ic }}</td>
                                <td>{{ $ssm->approver_name}}</td>
                                @if($ssm->status == null)
                                <td ><span class="badge rounded-pill bg-secondary">Permohonan telah dihantar</span></td>
                                @elseif($ssm->status=="Selesai")
                                <td><span class="badge rounded-pill bg-success" title="Approved by {{$ssm->approver_name}} &nbsp;{{$ssm->approver_ic}}">{{ $ssm->status}}</span></td>
                                @elseif($ssm->status=="DiTolak")
                                <td><span class="badge rounded-pill bg-danger" title="Declined by {{$ssm->approver_name}} &nbsp; {{$ssm->approver_ic}}">{{ $ssm->status}}</span></td>
                                @elseif($ssm->status=="Sedang Diproses")
                                <td><span class="badge rounded-pill bg-primary" title="Permohonan sedang diproses">{{ $ssm->status}}</span></td>
                                @endif
                                
                                
		

                                <td>

                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">


                                        <!----Show Button----->
                                        <form method="get" action="{{ route('ssmrequests.ssmrequest.show', $ssm->id) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </button>

                                        </form>

                                        <!-- <form method="get" action="{{ route('ssmrequests.ssmrequest.editadmin', $ssm->id ) }}">
                                        @csrf

                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>

                                        </form> -->



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