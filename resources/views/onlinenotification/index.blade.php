@extends('layouts.app-all')

@section('title', 'Mesh Perkhidmatan Notifikasi ')

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" sections; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
<div class="mesh-home-theme">
{{-- #================================ --}}

<?php
$pagename = "OnlineNotification";
?>

<div class="pagetitle">
    <h1>Mesh Perkhidmatan Notifikasi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Mesh Perkhidmatan Notifikasi</li>
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

        <form action="{{ route('onlinenotifications.onlinenotification.sendons') }}" method="GET">
            <div class="flex justify-between mb-3 rounded-lg overflow-hidden">

                <input type="text" name="query" id="term" placeholder="Search Bar" class="w-full px-10 focus:outline-none" style="background-color:white;">

                <button type="submit" class="p-3 bg-blue-500 hover:bg-blue-600" style="transition: 0.4s;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

            </div>
        </form>


        <div class="row mb-2" style="text-align: right;">
            <div class="col">
                <a href="{{ route('onlinenotifications.onlinenotification.form') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                </a>
            </div>
        </div>


        <div class="col-12">
            <div class="card recent-sales">
                <div class="card-body overflow-auto">


                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Jabatan</th>
                                <th scope="col">No Penerima</th>
                                <th scope="col">Perkara</th>
                                <th scope="col">No IC Pengirim</th>
                                 <th scope="col">Tarikh</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                           
                        
                        @if(count($onlinenotif) == null)
                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>

                        @else
                         @foreach($onlinenotif as $ons)   

                            <tr>
                                
                                <td>{{ $ons->jabatan }}</td>
                                <td>{{ $ons->phone_number }}, {{ $ons->phone_number2 }}, {{ $ons->phone_number3 }}</td>
                                <td>{{ $ons->title }}</td>
                                <td>{{ $ons->sender_icno }}</td>
                                <td>{{ $ons->updated_at }}</td>

                                <td>

                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                        <!----View Button----->
                                        <form method="get" action="{{ route('onlinenotifications.onlinenotification.adminview',  $ons->id)}}">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">   
                                        <!----Delete Button----->
                                        <form method="post" onclick="return confirm('Are you sure?')" action="{{ route('onlinenotifications.onlinenotification.destroy', $ons->id ) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger" >
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
                    {{ $onlinenotif->links() }}

                </div>

            </div>
        </div><!-- End Recent Sales -->

    </div>


{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
    @endsection