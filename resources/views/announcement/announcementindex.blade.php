@extends('layouts.app-all')

@section('title', 'MOE MESH - Announcements')

@section('content')

    @php $pagename = "announcement"; @endphp

    {{-- Breadcrumbs / Page Title --}}
            <div class="pagetitle">
                <h1>Main Announcement Page</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Announcements</li>
                    </ol>
                </nav>
            </div>

            <section class="mt-7" id="announcementgap">

                <div class="grid grid-cols-6 gap-5">

                    <div class="col-span-12 lg:col-span-6 mt-7" id="announcementgap">

                        {{-- Section Title --}}
                        <div class="border-b-2 px-4 py-6 bg-white rounded-t-md flex items-center justify-between shadow-md">
                            <div class="flex flex-col md:flex-row md:items-center gap-1.5">
                                <p class="text-lg font-semibold text-blue-900" id="pgap">Announcements</p>
                                <p class="text-sm text-blue-900 hidden md:block" id="pgap">|</p>
                                <p class="text-sm text-gray-400" id="pgap">Important</p>
                            </div>
                            <div class="flex justify-end">
                                @if ($announcements->currentPage() > 2)
                                    <a href="{{ $announcements->url(1) }}" class="mr-2"><i class="bi bi-chevron-double-left"></i></a>
                                @endif
                                @if ($announcements->previousPageUrl())
                                    <a href="{{ $announcements->previousPageUrl() }}" class="mr-2"><i class="bi bi-caret-left-fill"></i></a>
                                @endif

                                <span>Page {{ $announcements->currentPage() }} of {{ $announcements->lastPage() }}</span>

                                @if ($announcements->nextPageUrl())
                                    <a href="{{ $announcements->nextPageUrl() }}" class="ml-2"><i class="bi bi-caret-right-fill"></i></a>
                                @endif
                                @if ($announcements->currentPage() < $announcements->lastPage())
                                    <a href="{{ $announcements->url($announcements->lastPage()) }}" class="ml-2"><i class="bi bi-chevron-double-right"></i></a>
                                @endif
                            </div>
                        </div>

                    @if ($announcementExist)
                        <div class="bg-white overflow-y-auto shadow-md rounded-b-md">
                            @foreach ($announcements as $announcement)
                                <div class="grid grid-cols-12 gap-4 p-4 border-b-2">
                                    <div class="col-span-12 sm:col-span-2" style="height: 200px; width: 150px;">
                                        <!-- Image -->
                                        @if ($announcement->announcement_file_path)
                                            <a href="{{ asset($announcement->announcement_file_path) }}" target="_blank">
                                                <img src="{{ asset($announcement->announcement_file_path) }}" alt="Image" class="custom-image">
                                            </a>
                                        @else
                                            <img src="{{ asset('img/Announcement.png') }}" class="custom-image" >
                                        @endif
                                    </div>
                                    <div class="col-span-12 sm:col-span-10">
                                        <!-- Announcement Information -->
                                        <div class="flex items-center justify-between">
                                            <div>
                                            <p class="text-md font-semibold" style="font-size: 18px; font-family: Roboto; text-decoration: underline; display: inline-block;">
                                                {{$announcement->announcement_title}}
                                            </p>                                                
                                            </div>
                                            <!-- File -->
                                            @if (!empty($announcement->pdf_file_path))
                                                @if (count($announcement->pdf_file_path) === 1)
                                                    <a href="{{ asset($announcement->pdf_file_path[0]) }}" target="_blank">
                                                        <i class="btn btn-outline-primary mr-2 bi bi-file-earmark-arrow-down-fill"></i>
                                                    </a>
                                                @else
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#documentsModal{{$announcement->id}}">
                                                    <i class="btn btn-outline-primary mr-2 bi bi-file-earmark-arrow-down-fill"></i>
                                                </a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="documentsModal{{$announcement->id}}" tabindex="-1" aria-labelledby="documentsModalLabel{{$announcement->id}}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title mx-auto" id="documentsModalLabel">Documents Posted</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Loop through the documents and display them in a grid -->
                                                                <div class="grid {{ count($announcement->pdf_file_path) === 1 ? 'grid-cols-1 justify-center' : (count($announcement->pdf_file_path) === 2 ? 'grid-cols-2 justify-center' : 'grid-cols-3') }} gap-4">
                                                                    @foreach ($announcement->pdf_file_path as $filePath)
                                                                        @php
                                                                            $filenameWithoutExtension = pathinfo($filePath, PATHINFO_FILENAME);
                                                                            $nameParts = explode('_', $filenameWithoutExtension);
                                                                            $documentName = implode(' ', array_slice($nameParts, 1));
                                                                        @endphp
                                                                        <div class="text-center">
                                                                            <a href="{{ Storage::url($filePath) }}" target="_blank">
                                                                                <i class="btn btn-outline-primary mb-2 bi bi-file-earmark-arrow-down-fill"></i>
                                                                            </a>
                                                                            <p class="text-xs">{{ $documentName }}</p>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-custom-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <p class="text-gray-400 my-2">{{ $announcement->announcement_date }}</p>
                                            @php
                                                $icons = json_decode($announcement->announcement_icon, true);
                                            @endphp
                                            @if(in_array("info", $icons))
                                                <div class="text-sm px-2 py-1 bg-green-300 rounded-md" title="Information">
                                                    <i class="bi bi-info-circle"></i>
                                                </div>
                                            @endif
                                            @if(in_array("maintenance", $icons))
                                                <div class="text-sm px-2 py-1 bg-yellow-300 rounded-md" title="Maintenance">
                                                    <i class="bi bi-wrench"></i>
                                                </div>
                                            @endif
                                            @if(in_array("update", $icons))
                                                <div class="text-sm px-2 py-1 bg-gray-300 rounded-md" title="Update">
                                                    <i class="bi bi-gear"></i>
                                                </div>
                                            @endif
                                            @if(in_array("urgent", $icons))
                                                <div class="text-sm px-2 py-1 bg-red-300 rounded-md" title="Urgent">
                                                    <i class="bi bi-exclamation-triangle"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="overflow-hidden" id="justify" style="font-family: Open Sans; padding-top: 10px; font-size: 0.9rem; line-height: 1.2;">             
                                            <?php
                                            $contentWithLinks = preg_replace(
                                                '/\b(?:https?:\/\/|www\.)\S+\b/',
                                                '<a href="$0" target="_blank">$0</a>',
                                                nl2br(e($announcement->announcement_content))
                                            );
                                            echo $contentWithLinks;
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        {{-- Announcement Slider --}}
                        <div class="NoNewsbox">
                            There are Currently No Announcement!
                        </div>
                    @endif
                    </div>
                </div>
            </section>

    <style>
        #editgapbelow {
            padding-bottom: 10px;
        }

        .modal-dialog{
            max-width: 20%;
            min-width: 15%;
        }

        .modal-header{
            padding-left: 20%;
        }

        .modal-title{
            /* Text */
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Roboto", sans-serif;
        }

        .btn-custom-secondary {
            background-color: #007bff;
            border-color: #007bff;
            color: #ffffff; /* Text color (white in this example) */
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-custom-secondary:hover {
            background-color: #ffffff;
            border-color: #007bff;
            color: #007bff;
        }

        .custom-image {
            width: 150px; /* Adjust the width as needed */
            height: 200px; /* Let the height adjust automatically */
            object-fit: scale-down; /* Adjust the object-fit property as needed */
            border-radius: 5px; /* Add border-radius for rounded corners if desired */
        }

        .NoNewsbox {
            height:8rem; 
            background-color:white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  

            /* Text */
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Roboto", sans-serif;
        }

        @media (max-width: 1980px) {
            .sm\:col-span-10 {
                margin-left: 2rem;
            }
        }
        @media (max-width: 1480px) {
            .sm\:col-span-10 {
                margin-left: 3rem;
            }
        }
        @media (max-width: 1080px) {
            .sm\:col-span-10 {
                margin-left: 3rem;
            }
        }

        /* Media query for smaller screens */
        @media (max-width: 768px) {
            .sm\:col-span-10 {
                margin-left: 3rem;
            }

            .col-span-2 {
                margin-left: 0;
                margin-bottom: 10px; /* Add some space below the image */
            }
        }
    </style>

@endsection
