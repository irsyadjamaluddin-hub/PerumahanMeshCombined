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
            <li class="breadcrumb-item active">File Storage Management</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

@if(Session::has('success_message'))
<div class="alert alert-success">
    <i class=" fas fa-fw fa-check"></i>
    {!! session('success_message') !!}
</div>
@endif

    <!----- Back out Button  ----->
    <div class="col-md-1 text-left">
        <a href="{{ route('fsm.fsm.index') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem;">
        <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div>   


<!-- uploadfile.blade.php -->
<div class="col-12">
    <div class="card recent-sales">
        <div class="card-body overflow-auto">
            <form method="post" action="{{ route('fsm.fsm.storefsm') }}" enctype="multipart/form-data">
                @csrf <!-- Add CSRF token -->
                <br>
                <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">File Storage Management</h5><hr>
                    <br>

                    @foreach($biodatas as $biodata)
                    <div class="row">
                        <div class="col-lg-4 label">Name</div>
                        <div class="col-lg-8">
                            <input type="text" class="bg-gray-200 form-control" name="name" value="{{$biodata->name}}" readonly>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-4 label">IC No.</div>
                        <div class="col-lg-8">
                            <input type="text" class="bg-gray-200 form-control" name="ic_no" value="{{$biodata->ic_no}}" readonly>
                        </div>
                    </div>
                    @endforeach

                    <br>

                    <!-- Below IC No. input field -->
                    <div class="row">
                        <div class="col-lg-4 label">Folder Name</div>
                        <div class="col-lg-8">
                            <!-- Modify the folder name input field -->
                            <input type="text" class="form-control" name="folder" id="folder" placeholder="Enter folder name">

                        </div>
                    </div>

                    <br>

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

                    <div id="file-input-container">
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
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Recent Sales -->

<script>
    // JavaScript to update folder name dynamically
    $('#folder_name').on('input', function() {
        var folderName = $(this).val();
        $('#folderName').text(folderName);
        $('#folderLink').attr('href', "{{ route('fsm.fsm.createfsm') }}?folder=" + folderName);
    });
</script>

@endsection
