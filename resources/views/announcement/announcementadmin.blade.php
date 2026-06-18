@extends('layouts.app-all')

@section('title', 'MOE MESH - Pemberitahuan')

@section('content')

    @php $pagename = "announcementadmin"; @endphp

{{-- Breadcrumbs / Page Title --}}
<div class="pagetitle">
    <h1>Pemberitahuan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">MESH - Pemberitahuan</li>
        </ol>
    </nav>
</div>

<section class="mt-7" id="announcementgap">

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <i class="fas fa-fw fa-check"></i>
            {!! session('success_message') !!}
        </div>
    @endif

    @if(Session::has('error_message'))
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-triangle"></i>
        {!! session('error_message') !!}
    </div>
    @endif

    <div class="row">
        <!----- Announcement Button  ----->
        <div class="col-sm-1 text-left" style="padding-right: 140px !important;">
            <button id="announcement-button" class="btn btn-primary active-button">Pemberitahuan</button>
        </div>
        <!----- Subscription Button  ----->
        <div class="col-sm-9 text-left" style="padding-right: 140px !important;">
            <button id="subscription-button" type="submit" class="btn btn-primary inactive-button">Langganan</button>
             <button id="subscription-button2" type="submit" class="btn btn-primary inactive-button">Langganan (EASE)</button>
        </div>
        <!----- Create Button  ----->
         <div class="col-sm-1 text-left" style="flex: 0 0 5% !important;">
    <a id="announcementButton" href="{{ route('announcement.announcementadmin-create') }}" class="btn btn-primary text-right" style="margin-bottom: 10px;">
        <i class="bi bi-plus-lg"></i>
    </a>
    <span id="countdownTimer" style="margin-left: 10px;"></span>
</div>
    </div>

    <div class="grid grid-cols-6 gap-5" id="announcement-content">
        <div class="col-span-12 lg:col-span-6 mt-7" id="announcementgap">

            {{-- Section Title --}}
            <div class="border-b-2 px-4 py-6 bg-white rounded-t-md flex items-center justify-between shadow-md">
                <div class="flex flex-col md:flex-row md:items-center gap-1.5">
                    <p class="text-lg font-semibold text-blue-900" id="pgap">Pemberitahuan</p>
                    <p class="text-sm text-blue-900 hidden md:block" id="pgap">|</p>
                    <p class="text-sm text-gray-400" id="pgap">Penting</p>
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
                                <a href="{{ Storage::url($announcement->announcement_file_path) }}" target="_blank">
                                    <img src="{{ Storage::url($announcement->announcement_file_path) }}" alt="Image" class="custom-image">
                                </a>
                            @else
                                <img src="{{ asset('img/Announcement.png') }}" class="custom-image" >
                            @endif
                        </div>
                        <div class="col-span-12 sm:col-span-10">
                            <!-- Announcement Information -->
                            <div class="flex justify-end">
                                <!-- File -->
                                @if (!empty($announcement->pdf_file_path))
                                    @if (count($announcement->pdf_file_path) === 1)
                                        <a href="{{ Storage::url($announcement->pdf_file_path[0]) }}" target="_blank">
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
                                <form method="get" action="{{ route('announcement.announcementadmin-edit', $announcement->created_at) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary mr-2">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                </form>
                                <form method="post" action="{{ route('announcement.destroy', $announcement->created_at) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" value="delete" class="btn btn-outline-primary" onclick="return confirm('Delete Announcement?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                            <p class="text-md font-semibold" style="font-size: 18px; font-family: Roboto; text-decoration: underline; display: inline-block;">
                                {{$announcement->announcement_title}}
                            </p>
                            <div class="flex items-center gap-2">
                                <p class="text-gray-400 my-2">{{$announcement->announcement_date}}</p>
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
                                @if(in_array("ease", $icons))
                                    <div class="text-sm px-2 py-1 bg-blue-300 rounded-md" title="This information send to EASE">
                                    <i class="bi bi-arrow-right-square-fill"></i> <span>EASE</span>
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

    <div class="grid grid-cols-6 gap-5" id="subscription-content">
        <div class="col-12">
            <div class="card recent-sales">
                <div class="card-body overflow-auto">

                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Ic_no</th>
                                <th scope="col">Email</th>
                                <th scope="col">Notification</th>
                                <th scope="col">Updated_at</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($notification as $notifications)
                        <tr>
                            <td style="text-align: center;">{{ $notifications->id }}</td>
                            <td>{{ $notifications->ic_no }}</td>
                            <td>{{ $notifications->email }}</td>
                            <td>
                                @if ($notifications->notification == 1)
                                     <div style="display: flex; align-items: center;">
    <span class="badge badge-success mr-2" style="width: 50%;">True</span>
    <form method="POST" action="{{ route('notification.toggle') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $notifications->id }}">
        <button title="Change Notification" type="submit" class="btn btn-link p-0 m-0" style="border: none; background-color: transparent;">
            <i class="fas fa-toggle-on" style="color: #28a745; font-size: 20px;"></i>
        </button>
    </form>
</div>
                                @else
                                <div style="display: flex; align-items: center;">
    <span class="badge badge-warning mr-2" style="width: 50%;">False</span>
    
    <form method="POST" action="{{ route('notification.toggle') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $notifications->id }}">
        
        <button title="Change Notification" type="submit" class="btn btn-link p-0 m-0" style="border: none; background-color: transparent;">
            <i class="fas fa-toggle-off" style="color: #28a745; font-size: 20px;"></i>
        </button>
    </form>
</div>
                                @endif
                            </td>
                            <td>{{ $notifications->updated_at }}</td>
                            <td>{{ $notifications->created_at }}</td>
                            <td>
                                <!----Buttons----->
                                <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                                    <form method="post" action="{{  route('notification.destroy', $notifications->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" value="delete" class="btn btn-outline-primary" onclick="return confirm('Delete User notification?')">
                                        <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
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

    .active-button {
    background-color: #0d6efd !important;
    border-color: #3490dc !important;
    }

    .inactive-button {
    background-color: #7393B3 !important;
    border-color: #7a96b4 !important;
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

<script>
    // Get references to the buttons and content divs
    const announcementButton = document.getElementById('announcement-button');
    const subscriptionButton = document.getElementById('subscription-button');
    const subscriptionButton2 = document.getElementById('subscription-button2');
    const announcementContent = document.getElementById('announcement-content');
    const subscriptionContent = document.getElementById('subscription-content');
    const subscriptionContent2 = document.getElementById('subscription-content2');

    // Initially hide the subscriptionContent
    subscriptionContent.style.display = 'none';
    subscriptionContent2.style.display = 'none';

    // Initially, set the Announcement button as active
    announcementButton.classList.add('active-button');
    subscriptionButton.classList.remove('active-button');
    subscriptionButton2.classList.remove('active-button');

    // Function to toggle active and inactive buttons
    function toggleActiveButton(activeButton, inactiveButton, inactiveButton2) {
        activeButton.classList.add('active-button');
        activeButton.classList.remove('inactive-button');
        inactiveButton.classList.remove('active-button');
        inactiveButton.classList.add('inactive-button');
        inactiveButton2.classList.remove('active-button');
        inactiveButton2.classList.add('inactive-button');
    }

    // Function to toggle content visibility
    function toggleContent(activeContent, inactiveContent, inactiveContent2) {
        activeContent.style.display = 'block';
        inactiveContent.style.display = 'none';
        inactiveContent2.style.display = 'none';
    }

    // Add click event listeners to the buttons
    announcementButton.addEventListener('click', () => {
        toggleContent(announcementContent, subscriptionContent, subscriptionContent2);
        toggleActiveButton(announcementButton, subscriptionButton, subscriptionButton2);
    });

    subscriptionButton.addEventListener('click', () => {
        toggleContent(subscriptionContent, subscriptionContent2, announcementContent);
        toggleActiveButton(subscriptionButton, subscriptionButton2, announcementButton);
    });

    subscriptionButton2.addEventListener('click', () => {
        toggleContent(subscriptionContent2, subscriptionContent, announcementContent);
        toggleActiveButton(subscriptionButton2, subscriptionButton, announcementButton);
    });

    document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('announcementButton');
    const countdownTimer = document.getElementById('countdownTimer');
    const lastClickTimeKey = 'lastAnnouncementClickTime';
    const cooldownPeriod = 60 * 1000; // 1 minute in milliseconds

    function disableButton() {
        button.setAttribute('disabled', 'disabled');
        button.classList.add('disabled');
    }

    function enableButton() {
        button.removeAttribute('disabled');
        button.classList.remove('disabled');
        countdownTimer.textContent = ''; // Clear countdown timer
    }

    function updateCountdown(remainingTime) {
        const seconds = Math.ceil(remainingTime / 1000);
        countdownTimer.textContent = `(${seconds}s)`;
    }

    function checkButtonState() {
        const lastClickTime = localStorage.getItem(lastClickTimeKey);
        if (lastClickTime) {
            const timeElapsed = Date.now() - parseInt(lastClickTime);
            if (timeElapsed < cooldownPeriod) {
                disableButton();
                updateCountdown(cooldownPeriod - timeElapsed);
                const interval = setInterval(() => {
                    const remainingTime = cooldownPeriod - (Date.now() - parseInt(lastClickTime));
                    if (remainingTime <= 0) {
                        clearInterval(interval);
                        enableButton();
                    } else {
                        updateCountdown(remainingTime);
                    }
                }, 1000);
                return;
            }
        }
        enableButton();
    }

    // Check if the announcement was just added
    @if(session('announcement_added'))
        localStorage.setItem(lastClickTimeKey, Date.now().toString());
        disableButton();
        const interval = setInterval(() => {
            const remainingTime = cooldownPeriod - (Date.now() - parseInt(localStorage.getItem(lastClickTimeKey)));
            if (remainingTime <= 0) {
                clearInterval(interval);
                enableButton();
            } else {
                updateCountdown(remainingTime);
            }
        }, 1000);
    @endif

    checkButtonState();
});

</script>

@endsection
