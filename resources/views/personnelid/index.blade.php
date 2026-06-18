@extends('layouts.app-all')

@section('title', 'Personnel ID')

@section('content')


<?php
$pagename = "Data_kehadiran";
?>

<div class="pagetitle">
    <h1>Personnel ID</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Personnel ID</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif

    <br>

    <form action="{{ route('personnelid.personnelids.search') }}" method="GET">
        <div class="flex justify-between mb-3 rounded-lg overflow-hidden">
        <input type="text" name="query" id="term" placeholder="Search Nama / Jawatan / IC No / Personnel ID" class="w-full px-10 focus:outline-none">

        <button type="submit" class="p-3 bg-blue-500 hover:bg-blue-600" style="transition: 0.4s;">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>
        </div>
    </form>




    <div class="col-md-12">
        <br>
        <div class="col-12">
            <div class="card recent-sales">
                <br>
                <div class="card-body overflow-auto">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; color: black; background-color: #FFFF00;">Personnel ID</h5>
                    <table class="table table-borderless datatable mt-3">                         
                        <thead>
                            <tr>
                                <th scope="col">Name</th> 
                                <th scope="col">No. Kad Pengenalan</th>
                                <th scope="col">Jawatan</th>
                                <th scope="col">Department</th>
                                <th scope="col">Personnel ID</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($pi) == 0)
                            <tr class="text-center">
                            <td colspan="8">
                                <h5>No records found</h5>
                            </td>
                            </tr>
                        @else
                        @foreach($pi as $pis)
                            <tr>                                   
                                <td>{{ $pis->name }}</td>
                                <td>{{ $pis->ic_no }}</td>
                                <td>{{ $pis->position }}</td>
                                <td>{{ $pis->department }}</td>
                                <td>{{ $pis->personnel_id }}</td>
                                <td>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#updatedata{{ $pis->id }}" class="btn btn-primary">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>

                                    <!-- Basic Modal -->
                                    <div class="modal fade" id="updatedata{{ $pis->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="min-height: auto;">
                                                    <form class="" id="storebooksubject" method="post" action="{{ route('personnelid.personnelids.update') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="text" name="id" value="{{ $pis->id }}" class="form-control" hidden>

                                                        <div class="row mb-3" style="margin-left: 0px; align-items: center;">
                                                            <label class="col-lg-4 col-form-label" >Name:</label>
                                                            <div class="col-lg-8">
                                                                <input type="text" name="name" class="form-control" value="{{ $pis->name }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3" style="margin-left: 0px; align-items: center;">
                                                            <label class="col-lg-4 col-form-label" >No. Kad Pengenalan:</label>
                                                            <div class="col-lg-8">
                                                                <input type="text" name="ic_no" class="form-control" value="{{ $pis->ic_no }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3" style="margin-left: 0px; align-items: center;">
                                                            <label class="col-lg-4 col-form-label" >Jawatan:</label>
                                                            <div class="col-lg-8">
                                                                <input type="text" name="position" class="form-control" value="{{ $pis->position }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3" style="margin-left: 0px; align-items: center;">
                                                            <label class="col-lg-4 col-form-label" >Department:</label>
                                                            <div class="col-lg-8">
                                                                <input type="text" name="department" class="form-control" value="{{ $pis->department }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3" style="margin-left: 0px; align-items: center;">
                                                            <label class="col-lg-4 col-form-label" >Personnel ID:</label>
                                                            <div class="col-lg-8">
                                                                <input type="text" name="personnel_id" class="form-control" value="{{ $pis->personnel_id }}" required>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="row mb-3" style="">
                                                            <div class="col-lg-12" style="text-align:center;">
                                                                <button id="submit-button" type="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                            <script>
                                                                var submitButton = document.getElementById('submit-button');
                                                                var form = document.getElementById('storebooksubject');
                                                            
                                                                form.addEventListener('submit', function(event) {
                                                                    if (submitButton.getAttribute('data-submitted') !== null) {
                                                                        event.preventDefault();
                                                                    } else {
                                                                        submitButton.disabled = true;
                                                                        submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                                                                        submitButton.setAttribute('data-submitted', 'true');
                                                                    }
                                                                });
                                                            </script>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @endif             
                        </tbody>
                    </table>
                    @if (!empty($pi))
                        {{ $pi->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

   