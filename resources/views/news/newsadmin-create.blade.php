
@extends('layouts.app-all')

@section('title', 'News-Create')

@section('content')

    @php $pagename = "newsadmin"; @endphp

    {{-- Breadcrumbs / Page Title --}}
    <div class="pagetitle">
        <h1>News - Create</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('news.newsadmin') }}">News-Admin</a></li>
                <li class="breadcrumb-item active">Create</li>
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

    <!----- Back out Button  ----->
    <div class="col-md-1 text-left">
        <a href="{{ route('news.newsadmin') }}" class="btn btn-primary text-right" style="margin-bottom: 10px;">
        <i class="bi bi-arrow-left"></i>
        </a>
    </div>  


        <div class="grid grid-cols-6 gap-5">

            {{-- ------------------------------------------------------------------ --}}
            {{-- News --}}
            {{-- ------------------------------------------------------------------ --}}

            <div class="col-span-12 lg:col-span-6 mt-7" id="announcementgap">

                {{-- Section Title --}}
                <div class="col-lg-12 profile-edit bg-white" style="border: 2px solid #012970; padding: 20px; border-radius: 0px 0px 25px 25px  ;">

                    <div class="flex flex-col md:flex-row md:items-center gap-1.5">
                        <p class="text-lg font-semibold text-blue-900" id="pgap">News</p>
                        <p class="text-sm text-blue-900 hidden md:block" id="pgap">|</p>
                        <p class="text-sm text-gray-400" id="pgap">Create New</p>
                    </div>

                    <hr style="margin-bottom: 20px;">

            <form method="POST" action="{{ route('news.store') }}" id="news_form" enctype="multipart/form-data">
            @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="flex flex-col md:flex-row md:items-center gap-1.5">
                                <p class="text-md font-semibold" id="pgap">IMAGE/FILE</p>
                                <p class="text-sm text-blue-900 hidden md:block" id="pgap">|</p>
                                <p class="text-sm text-gray-400" id="pgap">Optional Image/File Size up to 2MB</p>
                            </div>
                        </div>
                    </div>

                    <div id="file-input-container">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input class="form-control news-file-input" type="file" name="news_file[]" accept=".jpg, .jpeg, .png, .pdf">                 
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary add-file-input">Add</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-md font-semibold">TITLE</label>
                            <textarea name="news_title" type="text" spellcheck="false" rows="1" autocomplete="off" cols="50" class="form-control" required></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="text-md font-semibold">DATE</label>
                            <input name="news_date" type="date" value="" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="text-md font-semibold">JOURNALIST NAME</label>
                            <input name="news_name" type="text" value="" spellcheck="false" rows="1" autocomplete="off" cols="50" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="text-md font-semibold">NEWS CONTENT</label>
                            <textarea class="w-full border-2 border-gray-300 p-2 rounded" spellcheck="false" rows="1" autocomplete="off" name="news_content" cols="50" required></textarea>
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
            var form = document.getElementById('news_form');
            
            form.addEventListener('submit', function(event) {
                if (this.getAttribute('data-submitted') !== null) {
                    event.preventDefault();
                } else {                    
                    submitButton.disabled = true;
                    submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                    this.setAttribute('data-submitted', 'true');
                }
            });

            $(document).ready(function() {
                // Add new file input field when the "Add" button is clicked
                $(document).on("click", ".add-file-input", function() {
                    var fileInputContainer = $(this).closest("#file-input-container"); // Get the closest file input container
                    var clonedFileInput = fileInputContainer.find(".news-file-input").first().clone(); // Clone the first file input field
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

