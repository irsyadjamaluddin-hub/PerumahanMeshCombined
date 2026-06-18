@extends('layouts.app-all')

@section('title', 'e-Despatch')

@section('content')

<?php
$pagename = "DIS";
?>

<img src="/img/med.jpeg">

<div class="pagetitle">

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">MED</li>
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
            <div class="col-md-11">


            </div>

            <div class="col-md-1">
                <a href="{{ route('dispatchs.dis.create') }}" class="btn btn-primary text-right">
                    <i class="bi bi-plus-lg"></i>
                </a>
            </div>
        </div>


        <!-- W.A>L Table -->
        <div class="col-12">
            <div class="card recent-sales">



                <div class="card-body overflow-auto">


                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>

                                <th scope="col">Jenis</th>
                                <th scope="col">Daripada</th>
                                <th scope="col">Kepada</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @if(count($dispatchs) == 0)

                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>

                            @else
                            @foreach($dispatchs as $dispatch)

                            @php $kpds=$dispatch->kpd ? json_decode($dispatch->kpd, true) : []; @endphp
                            <tr>

                                <td>{{ optional($dispatch->jenis) ->label }}</td>
                                <td>{{ optional($dispatch->Daripada)->label }}</td>
                                <td>{{ optional($dispatch->kepada)->label }}

                                    @foreach($kpds as $kpd) {{($kpd)}} @endforeach



                                </td>

                                <br>




                                @if ($dispatch ->dispatch_recieved_at==null)
                                <td><span class="badge bg-danger"> Belum Diterima</span></td>
                                @else

                                <td> <span class="badge bg-success"> Diterima</span> </td>

                                @endif
                                <td>

                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('dispatchs.dis.edit', $dispatch->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('dispatchs.dis.show', $dispatch->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye-fill"></i>
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
        </div><!-- End Recent Sales -->

    </div>


    @endsection