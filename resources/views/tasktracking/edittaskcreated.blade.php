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
            @if($taskcreated->task_int_ext == "Internal")
                <li class="breadcrumb-item active">Edit Delegated Task ID: INT {{ $taskcreated->id }}</li>
            @else
                <li class="breadcrumb-item active">Edit Delegated Task ID: EXT {{ $taskcreated->id }}</li>
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
                        <input type="text" class="bg-gray-200 form-control" name="ref_id" value="MTID {{ $taskcreated->ref_id }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 label">Kepada</label>
                    <div class="col-sm-8">
                        <input type="text" class="bg-gray-200 form-control" name="task_ic_no_giver" value="{{ $taskcreated->staffkodreceiver->kod }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 label">Tarikh</label>
                    <div class="col-sm-8">
                        <input type="date" name="task_date" class="form-control" value="{{ $taskcreated->taskCreated->task_date ?? 'N/A' }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 label">Kategori</label>
                    <div class="col-sm-8">
                        <select name="task_kategori" id="task_kategori" class="form-control" readonly>
                            <option value="">{{ $taskcreated->taskCreated->task_kategori }}</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 label">Jabatan</label>
                    <div class="col-sm-8">
                        <input type="text" class="bg-gray-200 form-control" name="task_jabatan" value="{{ optional($taskcreated->taskCreated->department)->label }}" readonly>
                    </div>
                </div>

                <div class="mb-3 border-bottom"></div>

                <form class="" method="post" action="{{  route('tasktracking.updatetaskcreated', $taskcreated->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-4 label">Perkara</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="task_perkara" value="{{ $taskcreated->task_perkara }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-4 label">Tindakan</label>
                        <div class="col-sm-8">
                            <select class="form-select" id="task_tindakan" name="task_tindakan" aria-label="Default select example" required>
                                <option value="" selected>Pilih Tindakan</option>
                                @foreach ($tindakans as $value)
                                    <option value="{{ $value['text'] }}" {{ $taskcreated->task_tindakan == $value['text'] ? 'selected' : '' }}>
                                    {{ $value['text'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <script>
                        $('#task_tindakan').select2({
                            width: '100%',
                            placeholder: "Task Tindakan",
                            allowClear: true
                        });
                    </script>

                    <div id="file-input-container">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 label">Muat Naik Dokumen</label>
                            <div class="col-sm-4">
                                <div id="file-dropzone" class="dropzone">
                                    <span>Drag and drop files here or click to browse</span>
                                    <input name="task_file[]" type="file" multiple id="file-input" style="display:none;"/>
                                    <div id="file-previews"></div>
                                </div>
                                <br>
                                @if(isset($taskcreated) && isset($taskcreated->task_file) && is_array($taskcreated->task_file) && count($taskcreated->task_file) > 0)
                                    <div class="d-flex flex-wrap" style="width: 27rem;"">
                                        @foreach ($taskcreated->task_file as $index => $file)
                                            @php
                                                // Determine file type
                                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                                $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                                            @endphp
                                            <div class="file-container mb-2 me-2 d-flex align-items-center">
                                                <div div class="flex-grow-1">
                                                    <a href="{{ asset('storage/task_files/' . $file) }}" target="_blank">
                                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ $file }}">
                                                            <i class="bi bi-file-image"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                                <div>
                                                    <label style="padding-left: 10px; margin-bottom: 0px;"> : </label> <label style="padding-left: 20px; margin-bottom: 0px;"  title="{{ $file }}"> {{ Str::limit($file, 15) }} </label>
                                                </div>
                                                <div class="checkbox-container" style="margin-left: 20px"> <!-- Added margin start (ms-2) -->
                                                    <input type="checkbox" name="remove_file[]" value="{{ $index }}" id="removeFile{{ $index }}" class="form-check-input">
                                                    <label class="form-check-label" for="removeFile{{ $index }}">Remove File {{ $index + 1 }}</label>
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
                            <textarea type="text" class="form-control" name="task_catatan">{{ $taskcreated->task_catatan }}</textarea>
                        </div>
                    </div>
                    <br>

                    <input type="hidden" name="id" value="{{ $taskcreated->id }}">
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
                                        <select class="form-select" id="task_status" name="task_userstatus" aria-label="Default select example" disabled>
                                            <option value="" selected>Status Task</option>
                                            @foreach ($status as $value)
                                                <option value="{{ $value['text'] }}" {{ $taskcreated->task_userstatus == $value['text'] ? 'selected' : '' }}>
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
                                        <textarea type="text" class="form-control" name="task_catatanuser" value="{{ $taskcreated->task_catatanuser ?? "" }}" readonly>{{ $taskcreated->task_catatanuser ?? "" }}</textarea>
                                    </td>
                                    <td>
                                        <input type="timestamp" name="task_date" class="form-control" value="{{ $taskcreated->task_catatanuser_submit_at ?? 'N/A' }}" readonly>
                                    </td>
                                    <td>
                                        <textarea type="text" class="form-control" name="task_catatanstaff" value="{{ $taskcreated->task_catatanstaff ?? "" }}">{{ $taskcreated->task_catatanstaff ?? "" }}</textarea>
                                    </td>
                                    <td>
                                        <input type="timestamp" name="task_date" class="form-control" value="{{ $taskcreated->task_catatanstaff_submit_at ?? 'N/A' }}" readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Staff</h5>
                    <div class="row mb-3" style="padding-top: 15px;">
                        <label for="inputText" class="col-sm-4 col label" style="padding-left: 20px;">Status</label>
                        <div class="col-sm-6">
                            <select name="task_staffstatus" class="form-control">
                                <option value="">Null</option>
                                <option value="Selesai" {{ $taskcreated->task_staffstatus == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            {!! $errors->first('status', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
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


<!-- Include Dropzone.css in the head of your layout file -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">

<!-- Include Dropzone.js at the bottom of your layout file, after jQuery or any other dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var fileDropzone = document.getElementById('file-dropzone');
        var fileInput = document.getElementById('file-input');
        var filePreviews = document.getElementById('file-previews');
        var filesList = []; // Array to store files

        fileDropzone.addEventListener('click', function(event) {
            if (event.target === fileDropzone) {
                fileInput.click();
            }
        });

        fileInput.addEventListener('change', function(event) {
            handleFiles(event.target.files);
        });

        fileDropzone.addEventListener('dragover', function(event) {
            event.preventDefault();
            fileDropzone.classList.add('dragging');
        });

        fileDropzone.addEventListener('dragleave', function() {
            fileDropzone.classList.remove('dragging');
        });

        fileDropzone.addEventListener('drop', function(event) {
            event.preventDefault();
            fileDropzone.classList.remove('dragging');
            handleFiles(event.dataTransfer.files);
        });

        function handleFiles(files) {
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                filesList.push(file); // Add files to the list
                createPreview(file, filesList.length - 1); // Pass the index of the file
            }
            updateFileInput();
        }

        function createPreview(file, index) {
            var preview = document.createElement('div');
            preview.classList.add('file-preview');
            preview.setAttribute('data-index', index); // Set the index as a data attribute

            if (file.type.startsWith('image/')) {
                var img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                preview.appendChild(img);
            } else {
                var fileIcon = document.createElement('span');
                fileIcon.classList.add('file-icon');
                fileIcon.innerHTML = '&#128196;'; // Unicode character for a generic file icon
                preview.appendChild(fileIcon);
            }

            var fileName = document.createElement('span');
            fileName.textContent = file.name;
            preview.appendChild(fileName);

            var removeBtn = document.createElement('button');
            removeBtn.classList.add('remove-btn');
            removeBtn.innerHTML = '&times;';
            removeBtn.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevents the file input click event
                removeFile(index);
            });
            preview.appendChild(removeBtn);

            filePreviews.appendChild(preview);
        }

        function removeFile(index) {
            filesList.splice(index, 1); // Remove the file from the list
            updatePreviews();
            updateFileInput();
        }

        function updatePreviews() {
            filePreviews.innerHTML = '';
            filesList.forEach(function(file, index) {
                createPreview(file, index);
            });
        }

        function updateFileInput() {
            var dataTransfer = new DataTransfer();
                filesList.forEach(function(file) {
                    dataTransfer.items.add(file);
                });
                fileInput.files = dataTransfer.files;
                        }
                    });
</script>

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
