@extends('layouts.app-all')

@section('title', 'File Storage Management')

@section('content')

<?php
$pagename = "fsm";
?>

<div class="pagetitle">
    <h1>File Storage Management</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Folder Access</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

@if(session('success_message'))
<div class="alert alert-success" role="alert">
    {{ session('success_message') }}
</div>
@endif

    <!----- Back out Button  ----->
    <div class="col-md-1 text-left">
        <a href="{{ route('fsm.fsm.index') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem;">
        <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div>   

<!-- Display folder information -->
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">Folder: {{ $folder->folder }}</h5>
        <p class="card-text">Created At: {{ $folder->created_at }}</p>
    </div>
</div>

<!-- Display shared users -->
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Users with Access</h5>
        <table class="table-achiev">
            <thead>
                <tr>
                    <th class="text-center">IC No.</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sharedUsers as $icNo)
                <tr>
                    <td class="text-center">{{ $icNo }}</td>
                    <td class="text-center">
                        <form method="post" action="{{ route('fsm.revokeAccess', ['folderId' => $folder->id, 'icNo' => $icNo]) }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

