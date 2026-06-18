@extends('layouts.app-all')

@section('title', 'Admin e-Despatch')

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



        <!-- W.A>L Table -->
        <div class="col-12">
            <div class="card recent-sales">



                <div class="card-body overflow-auto">


                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>

                                <th scope="col">Jenis</th>
                                <th scope="col">Perkara</th>
                                <th scope="col">Ruj.Persuratan</th>
                                <th scope="col">Daripada</th>
                                <th scope="col">Kepada</th>
                                <th scope="col">Tarikh Menerima</th>
                                <th scope="col"> Action</th>

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
                                <td>{{ optional($dispatch->jenis)->label }}</td>
                                <td>{{$dispatch->perkara}}</td>
                                <td>{{ $dispatch->rp }}</td>
                                <td>{{ optional($dispatch->Daripada)->label }}</td>
                                <td>{{ optional($dispatch->kepada)->label }}

                                    @foreach($kpds as $kpd)
                                    {{($kpd)}}


                                    @endforeach


                                </td>


                                @if ($dispatch->dispatch_recieved_at == null)
                                <td> <a href="{{ route('dispatchs.dis.terima', $dispatch->id) }}"
                                        class="btn btn-success">Terima</a>
                                </td>
                                @else
                                <td>{{ date('d/m/Y', strtotime($dispatch->dispatch_recieved_at)) }}</td>
                                @endif





                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                        <!----Edit Button----->
                                        <form method="get"
                                            action="{{ route('dispatchs.dis.editadmin', $dispatch->id ) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>

                                        </form>

                                        <!----Show Button----->
                                        <form method="get"
                                            action="{{ route('dispatchs.dis.showadmin', $dispatch->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </form>



                                        <!----Delete Button----->

                                        <form method="post"
                                            action="{{ route('dispatchs.dis.destroy', $dispatch->id ) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="bi bi-trash-fill"></i>
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