
@extends('layouts.app-all')

@section('title', 'Announcement-Edit')

@section('content')

    @php $pagename = "announcementadmin"; @endphp

    {{-- Breadcrumbs / Page Title --}}
    <div class="pagetitle">
        <h1>Announcement - Edit</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Announcement-Admin</li>
            </ol>
        </nav>
    </div>
    
    <section class="mt-7" id="announcementgap">

    @if ($errors->has('file_size'))
        <div class="alert alert-danger">
            <i class="fas fa-fw fa-exclamation-circle"></i>
            {{ $errors->first('file_size') }}
        </div>
    @endif

    @if (Session::has('success_message'))
        <div class="alert alert-success">
            <i class="fas fa-fw fa-check"></i>
            {{ session('success_message') }}
        </div>
    @endif

    <!----- Create Button  ----->
    <div class="col-md-1 text-left">
        <a href="{{ route('announcement.announcementadmin') }}" class="btn btn-primary text-right" style="margin-bottom: 10px;">
        <i class="bi bi-arrow-left"></i>
        </a>
    </div>  


        <div class="grid grid-cols-6 gap-5">

            {{-- ------------------------------------------------------------------ --}}
            {{-- Announcements --}}
            {{-- ------------------------------------------------------------------ --}}

            <div class="col-span-12 lg:col-span-6 mt-7" id="announcementgap">

                {{-- Section Title --}}
                <div class="col-lg-12 profile-edit bg-white" style="border: 2px solid #012970; padding: 20px; border-radius: 0px 0px 25px 25px  ;">

                    <div class="flex flex-col md:flex-row md:items-center gap-1.5">
                        <p class="text-lg font-semibold text-blue-900" id="pgap">Announcements</p>
                        <p class="text-sm text-blue-900 hidden md:block" id="pgap">|</p>
                        <p class="text-sm text-gray-400" id="pgap">Edit Announcement</p>
                    </div>

                    <hr style="margin-bottom: 20px;">

            <form method="POST" action="{{ route('announcement.update', $announcement->id) }}" id="announcement_form" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="flex flex-col md:flex-row md:items-center gap-1.5">
                                <p class="text-md font-semibold" id="pgap">PICTURE</p>
                                <p class="text-sm text-blue-900 hidden md:block" id="pgap">|</p>
                                <p class="text-sm text-gray-400" id="pgap">Optional Image Size up to 2MB</p>
                            </div>
                            <input class="form-control" type="file" name="announcement_file" accept=".jpg, .jpeg, .png" id="file">
                            {!! $errors->first('profilename', '<p class="help-block text-danger">:message</p>') !!} 
                            <div class="d-flex align-items-center">
                                @if ($announcement->announcement_file_path)
                                    @php
                                        $fileName = basename($announcement->announcement_file_path);
                                    @endphp
                                    <p>View current image: <a href="{{ Storage::url($announcement->announcement_file_path) }}" target="_blank">{{ $fileName }}</a></p>
                                @else
                                    <p>No image chosen</p>
                                @endif
                                <div class="form-check ml-auto">
                                    <input type="checkbox" name="remove_image" id="remove_image_checkbox" value="1" class="form-check-input">
                                    <label for="remove_image_checkbox" class="remove-image-label" title="Does not require to be checked when replacing the current image">Remove image<span class="required-symbol">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="flex flex-col md:flex-row md:items-center gap-1.5">
                                <p class="text-md font-semibold" id="pgap">FILE</p>
                                <p class="text-sm text-blue-900 hidden md:block" id="pgap">|</p>
                                <p class="text-sm text-gray-400" id="pgap">Optional File Size up to 2MB</p>
                            </div>
                        </div>
                    </div>

                    <div id="file-input-container">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input class="form-control pdf-file-input" type="file" name="pdf_file[]" accept=".pdf, .doc, .docx, .jpg, .jpeg, .png">                 
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary add-file-input">Add</button>
                            </div>
                        </div>
                    </div>

                    @if($announcement->pdf_file)
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="text-md font-semibold" id="margin-bottombegone">CURRENT FILES</label>
                            </div>
                        </div>
                        @foreach($announcement->pdf_file as $index => $filename)
                            <p id="margin-bottombegone">View current files: <a href="{{ Storage::url($announcement->pdf_file_path[$index]) }}" target="_blank">{{ $filename }}</a></p>
                            <div class="form-check ml-auto" style="margin-bottom: 1rem;">
                                <input type="checkbox" name="remove_file[]" id="remove_file_checkbox_{{ $index }}" value="{{ $index }}" class="form-check-input">
                                <label for="remove_file_checkbox_{{ $index }}" class="remove-file-label" title="Check to remove chosen file">Remove file<span class="required-symbol">*</span></label>
                            </div>
                        @endforeach
                    @else
                        <p>No file chosen</p>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-md font-semibold">TITLE</label>
                            <textarea name="announcement_title" type="text" spellcheck="false" rows="1" autocomplete="off" cols="50" class="form-control">{{ $announcement -> announcement_title }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="text-md font-semibold">DATE</label>
                            <input name="announcement_date" type="date" value="{{ date('Y-m-d', strtotime($announcement->announcement_date)) }}" class="form-control" disabled>
                            <input name="announcement_date" type="date" value="{{ date('Y-m-d', strtotime($announcement->announcement_date)) }}" class="form-control" hidden>
                        </div>

                        <div class="col-md-4">
                            <label class="text-md font-semibold" title="At least 1 Icon are required to be checked">NECESSARY ICONS<span class="required-symbol">*</span></label>
                            <br>
                            <div class="form-check" id="announcement_icons">
                                <input type="checkbox" class="form-check-input" name="announcement_icon[]" id="announcement_icon_info" value="info" {{ in_array("info", json_decode($announcement->announcement_icon, true)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="announcement_icon_info">Information</label> <i class="bi bi-info-circle"></i>
                            </div>
                            <div class="form-check" id="announcement_icons">
                                <input type="checkbox" class="form-check-input" name="announcement_icon[]" id="announcement_icon_maintenance" value="maintenance" {{ in_array('maintenance', json_decode($announcement->announcement_icon, true )) ? 'checked' : '' }}>
                                <label class="form-check-label" for="announcement_icon_maintenance">Maintenance</label> <i class="bi bi-wrench"></i>
                            </div>
                            <div class="form-check" id="announcement_icons">
                                <input type="checkbox" class="form-check-input" name="announcement_icon[]" id="announcement_icon_update" value="update" {{ in_array('update', json_decode($announcement->announcement_icon, true )) ? 'checked' : '' }}>
                                <label class="form-check-label" for="announcement_icon_update">New Update/Feature</label> <i class="bi bi-gear"></i>
                            </div>
                            <div class="form-check" id="announcement_icons">
                                <input type="checkbox" class="form-check-input" name="announcement_icon[]" id="announcement_icon_urgent" value="urgent" {{ in_array('urgent', json_decode($announcement->announcement_icon, true )) ? 'checked' : '' }}>
                                <label class="form-check-label" for="announcement_icon_urgent">Urgent</label> <i class="bi bi-exclamation-triangle"></i>
                            </div>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="text-md font-semibold">ANNOUNCEMENT CONTENT</label>
                            <textarea class="w-full border-2 border-gray-300 p-2 rounded" spellcheck="false" rows="1" autocomplete="off" name="announcement_content" cols="50">{{ $announcement -> announcement_content }}</textarea>
               
                        </div>
                    </div>

                <div class="text-center mt-3">
                    <button id="submit-button" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

                </div>
            </div>
        </div>
    </section>

        <style>
            #editgapbelow {
            padding-bottom: 10px;
            }

            .required-symbol {
                color: red;
            }
        </style>

        <script>
            var submitButton = document.getElementById('submit-button');
            var form = document.getElementById('announcement_form');
            
            form.addEventListener('submit', function(event) {
                if (this.getAttribute('data-submitted') !== null) {
                    event.preventDefault();
                } else {
                    // Check if at least one checkbox is checked
                    var icons = document.getElementsByName('announcement_icon[]');
                    var isChecked = false;
                    for (var i = 0; i < icons.length; i++) {
                        if (icons[i].checked) {
                            isChecked = true;
                            break;
                        }
                    }
                    
                    if (!isChecked) {
                        alert('Please select at least one icon.');
                        event.preventDefault();
                        return;
                    }
                    
                    submitButton.disabled = true;
                    submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                    this.setAttribute('data-submitted', 'true');
                }
            });

            var form = document.getElementById('pdf_form');

            $(document).ready(function() {
                // Add new file input field when the "Add" button is clicked
                $(document).on("click", ".add-file-input", function() {
                    var fileInputContainer = $(this).closest("#file-input-container"); // Get the closest file input container
                    var clonedFileInput = fileInputContainer.find(".pdf-file-input").first().clone(); // Clone the first file input field
                    var removeButton = "<button type='button' class='btn btn-primary remove-file-input'>Remove</button>"; // Create the remove button
                    var newRow = $("<div class='row mb-3'><div class='col-md-6'>" + clonedFileInput[0].outerHTML + "</div><div class='col-md-6'>" + removeButton + "</div></div>"); // Create the new row with the cloned file input and remove button
                    newRow.appendTo(fileInputContainer); // Append the new row to the file input container
                });

                // Remove file input field when the "Remove" button is clicked
                $(document).on("click", ".remove-file-input", function() {
                    $(this).closest(".row.mb-3").remove(); // Remove the closest file input container
                });
            });
        </script>

@endsection