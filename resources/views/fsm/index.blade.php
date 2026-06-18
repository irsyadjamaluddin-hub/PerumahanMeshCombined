@extends('layouts.app-all')

@section('title', 'File Storage Management')

@section('content')

<?php
$pagename = "fsm";
?>

<style>

</style>

<!-- FILE STORAGE MANAGEMENT -->

<div class="pagetitle">
    <h1>File Storage Management</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">File Storage Management</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="row mb-2">
    <div class="col-md-1">
        <a href="{{ route('fsm.fsm.createfsm') }}" class="btn btn-primary text-right">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>
</div>

<!-- Container for upload file form -->
<div id="upload-file-container"></div>

<!-- Bordered Tabs -->
<div class="alert alert-secondary bg-light text-light border-0 alert-dismissible fade show" role="alert">
    <ul class="nav nav-tabs d-flex">
        <li class="nav-item flex-fill">
            <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#userFolders">User-Created Folders</button>
        </li>
        <li class="nav-item flex-fill">
            <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#sharedFolders">Shared Folders</button>
        </li>
    </ul>
</div>

<!-- Tabbed content for user-created folders and shared folders -->
<div class="tab-content">

    <!-- User-Created Folders Tab -->
    <div class="tab-pane fade show active" id="userFolders" role="tabpanel" aria-labelledby="userFolders-tab">
        <div class="col-md-12">

            @if(Session::has('success_message'))
            <div class="alert alert-success">
                <i class=" fas fa-fw fa-check"></i>
                {!! session('success_message') !!}
            </div>
            @endif

            @if(Session::has('error_message'))
            <div class="alert alert-danger">
                <i class="fas fa-fw fa-exclamation-circle"></i>
                {!! session('error_message') !!}
            </div>
            @endif

            <div class="col-12" style="padding: 0px;">
                <div class="card recent-sales">
                    <div class="card-body overflow-auto">
                        <div class="profile-overview pt-3">
                            <table class="table table-borderless datatable mt-3">
                                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">User-Created Folders</h5><hr>
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Folder Name</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($folders->isEmpty())
                                    <tr class="text-center">
                                        <td colspan="4">
                                            <h5>No folders found</h5>
                                        </td>
                                    </tr>
                                    @else
                                    @foreach($folders as $folder)
                                    <tr>
                                        <td>{{ $folder->id }}</td>
                                        <td>{{ $folder->folder }}</td>
                                        <td>{{ $folder->created_at }}</td>
                                        <td>

                                            <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                            <!----Edit Button----->
                                                <form method="get" action="{{ route('fsm.fsm.editfsm', ['id' => $folder->id]) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                </form>

                                                <style>
                                                    .btn-outline-blue {
                                                        color: #007bff;
                                                        border-color: #007bff;
                                                    }

                                                    .btn-outline-blue:hover {
                                                        background-color: #007bff;
                                                        color: #fff; /* Change text color to white when hovering */
                                                    }
                                                </style>

                                            <!-- Grant Access Button -->
                                                <form method="post" action="{{ route('fsm.accessfsm',$folder->id) }}">
                                                    @csrf

                                                    <button type="submit" class="btn btn-outline-blue">
                                                        <i class="bi bi-person-fill"></i>
                                                    </button>
                                                </form>

                                            <!-- View Users with Access Button -->
                                            <a class="btn btn-outline-blue" href="{{ route('fsm.showAccessUsers', $folder->id) }}">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>

                                             <!----Delete Button----->
                                             <form method="post" onclick="return confirm('Are you sure?')" action="{{ route('fsm.destroy', $folder->id ) }}">
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
                </div>
            </div>
        </div><!-- End Recent Sales -->
    </div>

    <!-- Shared Folders Tab -->
    <div class="tab-pane fade" id="sharedFolders" role="tabpanel" aria-labelledby="sharedFolders-tab">
        @include('fsm.sharedfolder')
    </div>

</div>




@endsection
