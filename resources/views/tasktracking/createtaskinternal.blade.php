@extends('layouts.app-all')

@section('title', 'Create Task')

@section('content')

<?php
$pagename = "TaskTracking";
?>

<div class="pagetitle">
    <h1>Create Task</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item"><a href="{{ route('tasktracking.indextasktracking') }}">Task Tracking (MEC)</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

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
                <form class="" method="post" action="{{ route('tasktracking.storetask') }}" enctype="multipart/form-data">
                    @csrf
                    <br>
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Create Task (Internal)</h5>
                    <br>
                    <input type="text" name="task_int_ext" class="form-control" value="Internal" hidden>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-4 label">Tarikh</label>
                        <div class="col-sm-8">
                            <input type="date" name="task_date" class="form-control" value="{{ old('task_date', $today) }}" readonly>
                            {!! $errors->first('task_date', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-4 label">Kategori</label>
                        <div class="col-sm-8">
                            <select name="task_kategori" id="task_kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Biasa">Biasa</option>
                                <option value="Sulit">Sulit</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-4 label">Jabatan</label>
                        <div class="col-sm-8">
                                <input type="text" class="bg-gray-200 form-control" name="task_jabatan" value="{{ optional($employments->department)->label }}" readonly>
                                <input type="hidden" name="task_jabatan" class="bg-gray-200 form-control" value="{{ $employments->department_id }}" hidden>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end" style="">
                        <button type="button" class="btn mt-2 mb-2 btn-sm" id="addbtn" href="#" style="background-color: rgb(144, 147, 225);"">
                            <i class="bi bi-plus-lg" style="color: white;"></i>
                        </button>
                    </div>

                    <div style="width: 100%; margin-bottom: 20px;">
                        <table class="table-achiev" id="tableinternaltask" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="background-color: rgb(144, 147, 225);">Perkara</th>
                                    <th class="text-center" style="background-color: rgb(144, 147, 225); width: 14%;">Kod</th>
                                    <th class="text-center" style="background-color: rgb(144, 147, 225); width: 15%;">Tindakan</th>
                                    <th class="text-center" style="background-color: rgb(144, 147, 225);">Catatan Task</th>
                                    <th class="text-center" style="background-color: rgb(144, 147, 225); width: 20%;">File</th>
                                    <th class="text-center" style="background-color: rgb(144, 147, 225);">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" placeholder="Name perkara" class="form-control" name="task_perkara[]" value="" autofocus required>
                                    </td>
                                    <td>
                                        <select class="form-select" id="task_kod" name="task_kod[]" aria-label="Default select example" required>
                                            <option value="" disabled selected>Pilih Kod</option>
                                            @foreach ($staffkod as $value)
                                                <option value="{{ $value['ic_no'] }}">
                                                {{ $value['kod'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <script>
                                            $('#task_kod').select2({
                                                width: '100%',
                                                placeholder: "Pilih Kod",
                                                allowClear: true
                                            });
                                        </script>
                                    </td>
                                    <td>
                                        <select class="form-select" name="task_tindakan[]" aria-label="Default select example" required>
                                            <option value="" disabled selected>Pilih Tindakan</option>
                                            @foreach ($tindakans as $value)
                                                <option value="{{ $value['text'] }}">
                                                {{ $value['text'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <!-- Basic Modal -->
                                        <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#task_catatan">
                                        </button>
                                        <div class="modal fade" id="task_catatan" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Catatan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <textarea class="form-control" style="height: 150px" name="task_catatan[]"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #f75f6e; border-color: #f75f6e;">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Basic Modal-->
                                    </td>
                                    <td>
                                        <div id="file-dropzone_0" class="dropzone" style="border: 3px dashed #ccc; border-radius: 4px; padding: 10px; text-align: center; cursor: pointer;">
                                            <span>Drag and drop files here or click to browse</span>
                                            <input name="task_file[0][]" type="file" multiple id="file-input_0" style="display:none;"/>
                                            <div id="file-previews_0" class="file-previews"></div>
                                        </div>
                                    </td>
                                    <td style="text-align:center;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                var staffkodOptions = `
                                    @foreach ($staffkod as $value)
                                        <option value="{{ $value['ic_no'] }}">{{ $value['kod'] }}</option>
                                    @endforeach
                                `;

                                var tindakansOptions = `
                                    @foreach ($tindakans as $value)
                                        <option value="{{ $value['text'] }}">{{ $value['text'] }}</option>
                                    @endforeach
                                `;

                                let counter = 0;  // Initialize a counter

                                // Initialize file upload functionality for the initial row
                                initializeFileUpload('file-dropzone_0', 'file-input_0', 'file-previews_0');

                                $('#addbtn').off().on('click', function() {
                                    counter++;  // Increment the counter for each new row
                                    var uniqueSelectId = 'task_kod_' + counter;  // Generate a unique ID for select
                                    var uniqueModalId = 'task_catatan_' + counter;  // Generate a unique ID for modal
                                    var uniqueFileDropId = 'file-dropzone_' + counter;  // Generate a unique ID for dropzone
                                    var uniqueFileInputId = 'file-input_' + counter;  // Generate a unique ID for input
                                    var uniqueFilePreviewId = 'file-previews_' + counter;  // Generate a unique ID for previews

                                    var html = `
                                        <tr>
                                            <td>
                                                <input type="text" placeholder="Name perkara" class="form-control" name="task_perkara[]" value="" autofocus required>
                                            </td>
                                            <td>
                                                <select class="form-select" id="${uniqueSelectId}" name="task_kod[]" aria-label="Default select example" required>
                                                    <option value="" disabled selected>Pilih Kod</option>
                                                    ${staffkodOptions}
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select" name="task_tindakan[]" aria-label="Default select example" required>
                                                    <option value="" disabled selected>Pilih Tindakan</option>
                                                    ${tindakansOptions}
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#${uniqueModalId}">
                                                </button>
                                                <div class="modal fade" id="${uniqueModalId}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Catatan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" style="height: 150px" name="task_catatan[]"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #f75f6e; border-color: #f75f6e;">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>
                                            <td>
                                                <div id="${uniqueFileDropId}" class="dropzone" style="border: 3px dashed #ccc; border-radius: 4px; padding: 10px; text-align: center; cursor: pointer;">
                                                    <span>Drag and drop files here or click to browse</span>
                                                    <input name="task_file[${counter}][]" type="file" multiple id="${uniqueFileInputId}" style="display:none;"/>
                                                    <div id="${uniqueFilePreviewId}" class="file-previews"></div>
                                                </div>
                                            </td>
                                            <td style="text-align:center;">
                                                <button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button>
                                            </td>
                                        </tr>
                                    `;

                                    $('#tableinternaltask tbody').append(html);

                                    // Call function to initialize file upload functionality for the newly added row
                                    initializeFileUpload(uniqueFileDropId, uniqueFileInputId, uniqueFilePreviewId);
                                });

                                $(document).on('click', '.removeDeclare', function() {
                                    $(this).closest('tr').remove();
                                });

                                // Function to initialize file upload functionality
                                function initializeFileUpload(fileDropzoneId, fileInputId, filePreviewsId) {
                                    var fileDropzone = document.getElementById(fileDropzoneId);
                                    var fileInput = document.getElementById(fileInputId);
                                    var filePreviews = document.getElementById(filePreviewsId);
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
                                }
                            });
                        </script>
                    </div>

                    <br>

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
