@extends('layouts.app-all')

@section('title', 'Edit File Storage Management')

@section('content')

<?php
$pagename = "fsm";
?>

<div class="pagetitle">
    <h1>Edit File Storage Management</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fsm.fsm.index') }}">File Storage Management</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

    <!----- Back out Button  ----->
    <div class="col-md-1 text-left">
        <a href="{{ route('fsm.fsm.index') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem;">
        <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div>   

<section class="section profile">
    <div class="col-md-12">
        <div class="card recent-sales">
            <div class="card-body overflow-auto">
                <div class="profile-overview pt-3">
                    <table class="table table-borderless datatable mt-3">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Edit File Storage Management</h5>
                        <hr>
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">File Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($files as $file)
                            <tr>
                                <td>{{ $file->id }}</td>
                                <td><a href="{{ Storage::url($file->file_path) }}" target="_blank">{{ $file->filename }}</a></td>
                                <td>{{ $file->created_at }}</td>
                                <td>

                                    <!----Delete Button----->
                                    <form method="POST" action="{{ route('fsm.fsm.destroyfile', ['id' => $file->id]) }}">
                                        @csrf
                                        @method('delete')
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
        </div>
    </div>


<style>
    #file-dropzone {
    border: 3px dashed #ccc;
    border-radius: 4px;
    padding: 10px;
    text-align: center;
    cursor: pointer;
    margin-bottom: 10px;
}
</style>


    <!-- Upload Files Section -->
    <div class="col-md-12">
        <div class="card recent-sales">
            <div class="card-body overflow-auto">
                <div class="profile-overview pt-3">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Upload New Documents</h5>
                    <hr>
                    <br>
                    <!-- Add the createfsm content here -->

                    <form method="post" action="{{ route('fsm.fsm.addDocumentsfsm', ['folderId' => $folder_id]) }}" enctype="multipart/form-data">

                        @csrf <!-- Add CSRF token -->
                        <input type="hidden" name="folder_id" value="{{ $folder_id }}"> <!-- Add hidden input for folder_id -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 label">Document</label>
                            <div class="col-lg-8" id="file-dropzone" class="dropzone">
                                <span>Drag and drop files here or click to browse</span>
                                <input name="file[]" type="file" multiple /> <!-- Add 'name="file[]"' for multiple file uploads -->
                            </div>
                        </div>
                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
