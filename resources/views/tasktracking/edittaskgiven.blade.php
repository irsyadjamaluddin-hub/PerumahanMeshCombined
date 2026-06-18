@extends('layouts.app-all')

@section('title', 'Edit Task')

@section('content')

<?php
$pagename = "TaskTracking";
?>

<div class="pagetitle">
    <h1>Edit Task Tracking</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item"><a href="{{ route('tasktracking.indextasktracking') }}">Task Tracking (MEC)</a></li>
            @if($taskgiven->task_int_ext == "Internal")
                <li class="breadcrumb-item active">Edit Delegated Task ID: INT {{ $taskgiven->id }}</li>
            @else
                <li class="breadcrumb-item active">Edit Delegated Task ID: EXT {{ $taskgiven->id }}</li>
            @endif
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
    <a href="{{ route('tasktracking.indextasktracking') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 10px;">
    <i class="bi bi-arrow-left-circle"></i>
    </a>
</div>

<section class="section profile">
<div class="col-12">
    <div class="card recent-sales">
        <div class="card-body">
            <div class="profile-overview">
                <br>
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Edit Task</h5>
                <br>
                <input type="text" name="task_int_ext" class="form-control" value="Internal" hidden>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 label">Master Task ID</label>
                    <div class="col-sm-8">
                        <input type="text" class="bg-gray-200 form-control" name="ref_id" value="MTID {{ $taskgiven->ref_id }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 label">Daripada</label>
                    <div class="col-sm-8">
                        <input type="text" class="bg-gray-200 form-control" name="task_ic_no_giver" value="{{ $taskgiven->staffkodgiver->kod }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 label">Tarikh</label>
                    <div class="col-sm-8">
                        <input type="date" name="task_date" class="form-control" value="{{ $taskgiven->taskCreated->task_date ?? 'N/A' }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 label">Kategori</label>
                    <div class="col-sm-8">
                        <select name="task_kategori" id="task_kategori" class="form-control" readonly>
                            <option value="">{{ $taskgiven->taskCreated->task_kategori }}</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 label">Jabatan</label>
                    <div class="col-sm-8">
                        <input type="text" class="bg-gray-200 form-control" name="task_jabatan" value="{{ optional($taskgiven->taskCreated->department)->label }}" readonly>
                    </div>
                </div>

                <div class="mb-3 border-bottom"></div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 label">Perkara</label>
                    <div class="col-sm-8">
                        <input type="text" class="bg-gray-200 form-control" name="task_perkara" value="{{ $taskgiven->task_perkara }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 label">Tindakan</label>
                    <div class="col-sm-8">
                        <input type="text" class="bg-gray-200 form-control" name="task_tindakan" value="{{ $taskgiven->task_tindakan }}" readonly>
                    </div>
                </div>

                <div id="file-input-container">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-4 label">Dokumen</label>
                        <div class="col-sm-4">
                            @if(isset($taskgiven) && isset($taskgiven->task_file) && is_array($taskgiven->task_file) && count($taskgiven->task_file) > 0)
                                <div class="d-flex flex-wrap" style="width: 27rem;">
                                    @foreach ($taskgiven->task_file as $index => $file)
                                        @php
                                            // Determine file type
                                            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                            $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                                        @endphp
                                        <div class="file-container mb-2 me-2 d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <a href="{{ asset('storage/task_files/' . $file) }}" target="_blank">
                                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $file }}">
                                                        @if ($isImage)
                                                            <i class="bi bi-file-image"></i>
                                                        @else
                                                            <i class="bi bi-file-text"></i>
                                                        @endif
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 label">Catatan Task</label>
                    <div class="col-sm-8">
                        <textarea type="text" class="bg-gray-200 form-control" name="task_catatan" readonly>{{ $taskgiven->task_catatan }}</textarea>
                    </div>
                </div>
                <br>
                <form class="" method="post" action="{{  route('tasktracking.updatetaskuser', $taskgiven->id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $taskgiven->id }}">
                    <div style="width: 100%; margin-bottom: 20px;">
                        <table class="table-achiev" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="background-color: rgb(144, 147, 225); width: 20%;">Status</th>
                                    <th class="text-center border-start" style="background-color: rgb(144, 147, 225);">Cacatan User</th>
                                    <th class="text-center border-end" style="background-color: rgb(144, 147, 225);">Submit_at</th>
                                    <th class="text-center border-start" style="background-color: rgb(144, 147, 225);">Catatan Staff</th>
                                    <th class="text-center  border-end" style="background-color: rgb(144, 147, 225);">Staff Submit_at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-select" id="task_status" name="task_userstatus" aria-label="Default select example" required>
                                            <option value="" disabled selected>Status Task</option>
                                            @foreach ($status as $value)
                                                <option value="{{ $value['text'] }}" {{ $taskgiven->task_userstatus == $value['text'] ? 'selected' : '' }}>
                                                    {{ $value['text'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <script>
                                            $('#task_status').select2({
                                                width: '100%',
                                                placeholder: "Status Task",
                                                allowClear: true
                                            });
                                        </script>
                                    <td>
                                        <textarea type="text" class="form-control" name="task_catatanuser" value="{{ $taskgiven->task_catatanuser ?? "" }}">{{ $taskgiven->task_catatanuser ?? "" }}</textarea>
                                    </td>
                                    <td>
                                        <input type="timestamp" name="task_date" class="form-control" value="{{ $taskgiven->task_catatanuser_submit_at ?? 'N/A' }}" readonly>
                                    </td>
                                    <td>
                                        <textarea type="text" class="bg-gray-200 form-control" name="task_catatanstaff" readonly>{{ $taskgiven->task_catatanstaff ?? "" }}</textarea>
                                    </td>
                                    <td>
                                        <input type="timestamp" name="task_date" class="form-control" value="{{ $taskgiven->task_catatanstaff_submit_at ?? 'N/A' }}" readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Hantar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>
@endsection

<!-- Include Dropzone.css in the head of your layout file -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">

<!-- Include Dropzone.js at the bottom of your layout file, after jQuery or any other dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

<!-- Your JavaScript code -->
<script>
    Dropzone.options.fileDropzone = {
        paramName: "dc_file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        init: function () {
            this.on("success", function (file, response) {
                // Handle the success response, if needed
                console.log(response);
            });

            this.on("removedfile", function (file) {
                // Handle the file removal, if needed
                console.log(file);
            });
        },
    };
</script>

<!-- Include Dropzone.css in the head of your layout file -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">

<!-- Include Dropzone.js at the bottom of your layout file, after jQuery or any other dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

<style>
    #file-dropzone {
        border: 3px dashed #ccc;
        border-radius: 4px;
        padding: 10px;
        text-align: center;
        cursor: pointer;
    }

    .dropzone {
        min-height: 60px;
    }

    .file-preview {
        display: flex;
        align-items: center;
        margin-top: 10px;
        position: relative;
    }
    .file-preview img {
        max-width: 100px;
        max-height: 100px;
        margin-right: 10px;
    }
    .file-preview .file-icon {
        font-size: 50px;
        margin-right: 10px;
    }
    .file-preview .remove-btn {
        position: absolute;
        top: 0;
        right: 0;
        background: red;
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        line-height: 20px;
    }
</style>
