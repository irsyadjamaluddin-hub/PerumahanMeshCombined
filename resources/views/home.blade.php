@extends('layouts.app-all')

@section('title', 'MOE MESH - Dashboard')

@section('content')

  <?php
    $pagename = "Dashboard";
  ?>

<style>

.carousel-control-next, .carousel-control-prev {
  width: 8%;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
  height: 35px;
  width: 35px;
  background-size: 40%, 40%;
  border-radius: 100%;
  background-color: grey;
}

.carousel-indicators {
    margin-bottom: 0rem;
}

</style>

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner ">
          @foreach($banners as $bns)
          <div class="carousel-item @if($loop->first) active @endif">
                <div class="slider-image text-center">
                    <img src="{{ asset($bns->bn_image_path) }}" style="width:100%; height:300px;" class="d-inline-block border text-center rounded" alt="{{ $bns->bn_image }}">
                </div>
            </div>
          @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
      </button>
    </div>

            {{-- ------------------------------------------------------------------ --}}
            {{-- Announcements --}}
            {{-- ------------------------------------------------------------------ --}}

    @if(session('success'))
    <div class="alert alert-success" style="margin-top: 20px">
        {{ session('success') }}
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="col-span-12 lg:col-span-6 mt-7">

                {{-- Section Title --}}
                <div class="border-b-2 px-4 py-2 bg-white rounded-t-md flex items-center justify-between shadow-md">

                    <div class="flex flex-col md:flex-row md:items-center gap-1.5">
                        <p class="text-lg font-semibold text-blue-900" id="pgap">Announcements</p>
                        <p class="text-sm text-blue-900 hidden md:block" id="pgap">|</p>
                        <p class="text-sm text-gray-400" id="pgap" title="Only the latest 4 Announcement are shown">Latest Announcements<span class="required-symbol">*</span></p>
                        <p class="text-sm text-blue-900 hidden md:block" id="pgap">|</p>
                            <form method="POST" action="{{ route('subscribeannouncement') }}">
                                @csrf

                                {{-- Check if the user's data exists in the Sremailnotification model and notification is true --}}
                                @php
                                    $userEmail = Auth::user()->email;
                                    $userIC = Auth::user()->ic_no;
                                    $subscription = \App\Models\Announcementnotification::where('email', $userEmail)
                                        ->where('ic_no', $userIC)
                                        ->first();
                                @endphp

                                {{-- Display "Subscribe" or "Unsubscribe" based on the subscription --}}
                                @if (!$subscription || ($subscription && !$subscription->notification))
                                    <p class="text-sm cursor-pointer" style="color:#006cbf;" id="pgap" title="Click to receive notification in email">
                                        <button type="submit">Subscribe</button>
                                    </p>
                                @else
                                    <p class="text-sm cursor-pointer" style="color:#006cbf;" id="pgap" title="Click to disable receiving notification in email">
                                        <button type="submit" formaction="{{ route('unsubscribeannouncement') }}">Unsubscribe</button>
                                    </p>
                                @endif
                            </form>
                    </div>

                    <div class="hover:text-blue-400 cursor-pointer flex items-center gap-2 text-sm lg:text-md">
                        <a href="{{ route('announcement.announcementindex') }}">View All</a>
                        <div class="bi bi-chevron-right"></div>
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
                                        <img src="{{ asset($announcement->announcement_file_path) }}" alt="Image" class="custom-imageannouncement">
                                    </a>
                                @else
                                    <img src="{{ asset('img/Announcement.png') }}" class="custom-imageannouncement" >
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
                                                                    <a href="{{ asset($filePath) }}" target="_blank">
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
                    There are currently no announcement!
                </div>
            @endif
            </div>
        </div>
    </div>

        {{-- ------------------------------------------------------------------ --}}
        {{-- News --}}
        {{-- ------------------------------------------------------------------ --}}

        <div class="row">
            <div class="col-span-12 lg:col-span-6 mt-7">
                {{-- Section Title --}}
                <div class="border-b-2 px-4 py-2 bg-white rounded-t-md flex items-center justify-between shadow-md">
                    <div class="flex flex-col md:flex-row md:items-center gap-1.5">
                        <p class="text-lg font-semibold text-blue-900" id="pgap">News</p>
                        <p class="text-sm text-blue-900 hidden md:block" id="pgap">|</p>
                        <p class="text-sm text-gray-400"  id="pgap" title="Only the latest 3 News are shown">Latest News<span class="required-symbol">*</span></p>
                    </div>

                    <div class="hover:text-blue-400 cursor-pointer flex items-center gap-2 text-sm lg:text-md">
                        <a href="{{ route('news.newsindex') }}">View All</a>
                        <div class="bi bi-chevron-right"></div>
                    </div>
                </div>

                @if ($newsExist)
                    {{-- News Slider --}}
                    <div class="bg-white overflow-y-auto shadow-md rounded-b-md">
                        {{-- Slider Content --}}
                        <div class="sliderItems flex" style="justify-content: center;">
                            @foreach($news as $item)
                                <div class="mx-10 w-80 newsborder">
                                    {{-- News Image --}}
                                    <div class="h-32 middleimage">
                                        @if (is_array($item->news_file_path) && count($item->news_file_path) > 0)
                                            @php
                                                $imagePath = null;
                                                foreach ($item->news_file_path as $file) {
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                                                        $imagePath = $file;
                                                        break;
                                                    }
                                                }
                                            @endphp

                                            @if ($imagePath)
                                                <a href="{{ asset($imagePath) }}" target="_blank">
                                                    <img src="{{ asset($imagePath) }}" alt="Image" class="custom-imagenews">
                                                </a>
                                            @else
                                                <img src="{{ asset('simpur/img/LatestNewswhite.png') }}" class="custom-altimagenews">
                                            @endif
                                        @else
                                            <img src="{{ asset('simpur/img/LatestNewswhite.png') }}" class="custom-altimagenews">
                                        @endif
                                    </div>

                                    <div class="mt-4">
                                        {{-- Title --}}
                                        <p class="text-md font-semibold hover:text-indigo-500 cursor-pointer" style="height:30px;text-align: center; " title="{{ $item->news_title }}">
                                        <?php
                                            $content = nl2br($item->news_title); // Convert newlines to <br> tags
                                            $words = explode(' ', $content);
                                            $limitedContent = implode(' ', array_slice($words, 0, 10)); // Change '10' to the desired word limit
                                            echo $limitedContent . '...';
                                        ?>
                                        </p>
                                        {{-- Name and Date --}}
                                        @if ($item->news_name)
                                        <div class="gap-2" style="text-align: center; padding-top:20px;">
                                        <hr class="custom-hr" style="width: 100%; margin: 0;">
                                            <p class="text-gray-400 my-2">{{ $item->news_name }} - {{ $item->news_date->format('j M Y') }}</p>
                                        <hr class="custom-hr" style="width: 100%; margin: 0;">
                                        </div>
                                        @else
                                        <div class="gap-2" style="text-align: center; padding-top:20px;">
                                        <hr class="custom-hr" style="width: 100%; margin: 0;">
                                            <p class="text-gray-400 my-2">{{ $item->news_date->format('j M Y') }}</p>
                                        <hr class="custom-hr" style="width: 100%; margin: 0;">
                                        </div>
                                        @endif                                        {{-- Content --}}
                                        <p class="line-clamp-4 overflow-hidden mt-2" style="text-align: justify;">{{ $item->news_content }}</p>
                                    </div>
                                    {{-- Footer --}}
                                    <div class="card-footer font-semibold text-right">
                                        <a href="#" class="read-more-link" data-toggle="modal" data-target="#newsModal{{$item->id}}">Read more</a>
                                    </div>
                                </div>

                                <!-- News Modal -->
                                <div class="modal fade" id="newsModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel{{$item->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered custom-modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title news-title-modal" id="newsModalLabel{{$item->id}}">{{ $item->news_title }}</h5>
                                            </div>
                                            <div class="modal-body">
                                                @if ($item->news_name)
                                                <p class="card-text" style="font-style: italic; padding-bottom: 10px;">{{ $item->news_name }} - {{ $item->news_date->format('j/n/Y') }}</p>
                                                @else
                                                <p class="card-text" style="font-style: italic; padding-bottom: 10px;">{{ $item->news_date->format('j/n/Y') }}</p>
                                                @endif
                                                <hr>
                                                <p class="card-text custom-newscontent" style="text-align: justify;">{!! nl2br($item->news_content) !!}</p>
                                                @if (!empty($item->news_file_path))
                                                    {{-- Display images --}}
                                                    @php
                                                        $hasImage = false;
                                                        foreach ($item->news_file_path as $filePath) {
                                                            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                                            if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                                                                $hasImage = true;
                                                                break;
                                                            }
                                                        }
                                                    @endphp

                                                    @if ($hasImage)
                                                        <hr>
                                                        <div class="thumbnail-gallery text-center" style="padding-bottom:20px;">
                                                            <div class="thumbnail-gallery-inner">
                                                                @foreach ($item->news_file_path as $filePath)
                                                                    @php
                                                                        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                                                    @endphp

                                                                    @if (in_array($extension, ['jpg', 'jpeg', 'png']))
                                                                        <a href="{{ asset($filePath) }}" target="_blank" style="border: 1px solid #ddd;">
                                                                            <img src="{{ asset($filePath) }}" alt="Thumbnail" class="thumbnail">
                                                                        </a>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif

                                                    {{-- Display PDF files --}}
                                                    @php
                                                        $hasPdf = false;
                                                        foreach ($item->news_file_path as $filePath) {
                                                            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                                            if ($extension === 'pdf') {
                                                                $hasPdf = true;
                                                                break;
                                                            }
                                                        }
                                                    @endphp

                                                    @if ($hasPdf)
                                                        <hr>
                                                        <div class="thumbnail-gallery text-center">
                                                            <div class="thumbnail-gallery-inner">
                                                                @foreach ($item->news_file_path as $filePath)
                                                                    @php
                                                                        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                                                    @endphp

                                                                    @if ($extension === 'pdf')
                                                                        <div class="text-center">
                                                                            <a href="{{ asset($filePath) }}" target="_blank">
                                                                                <i class="btn btn-outline-primary mr-2 bi bi-file-earmark-arrow-down-fill"></i>
                                                                            </a>
                                                                            <p class="text-xs">
                                                                            <?php
                                                                                $content = basename($filePath); // Convert newlines to <br> tags
                                                                                $words = explode(' ', $content);
                                                                                $limitedContent = implode(' ', array_slice($words, 0, 3)); // Change '10' to the desired word limit
                                                                                echo $limitedContent . '...';
                                                                            ?>
                                                                            </p>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- End of Slider Content --}}
                @else
                    {{-- News Slider --}}
                    <div class="NoNewsbox">
                        There are Currently No News!
                    </div>
                @endif
            </div>
        </div>

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

        .newsallbox {
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

            background-color: white;
        }

        .custom-hr {
            margin: 0.2rem !important;
            /* Add your desired styles for the hr element */
        }

        .newsborder {
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

            background-color: white;
            padding: 10px 10px 10px 10px;
            display: flex;
            flex-direction: column;
            margin: 15px 40px 15px 40px;
        }

        .card-footer {
            padding-top:10px;
            padding-bottom:5px !important;
            margin-top: auto;
        }

        .custom-imageannouncement {
            width: 150px; /* Adjust the width as needed */
            height: 200px; /* Let the height adjust automatically */
            object-fit: scale-down; /* Adjust the object-fit property as needed */
            border-radius: 5px; /* Add border-radius for rounded corners if desired */
        }

        .custom-imagenews {
            height: 8rem;
            object-fit: scale-down; /* Adjust the object-fit property as needed */
            border-radius: 5px; /* Add border-radius for rounded corners if desired */
        }

        .custom-altimagenews {
            height: 8rem;
            width: 100%;
            object-fit: scale-down; /* Adjust the object-fit property as needed */
            border-radius: 5px; /* Add border-radius for rounded corners if desired */
        }

        .middleimage {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .read-more-link {
            color: blue;
            cursor: pointer;
        }

        .news-title {
            font-size: 23px;
            font-weight: bold;
            font-family: Gelasio !important;
            line-height: 1.1 !important;
            font-weight: 600 !important;
        }

        .news-title-modal {
            font-size: 41px;
            font-weight: bold;
            font-family: Gelasio !important;
            line-height: 1.1 !important;
            font-weight: 600 !important;
        }

        .custom-modal-dialog {
            max-width: 1000px !important; /* Adjust the width as needed */
            margin: 0 auto;
        }

        /* Thumbnail Gallery Styles */
        .thumbnail-gallery {
            margin-top: 20px;
        }

        .thumbnail-gallery-inner {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center; /* Center the thumbnails */
        }

        .thumbnail-gallery .thumbnail {
            width: 70px;
            height: 70px;
            object-fit: cover;
            cursor: pointer;
        }

        /* Section Heading Styles */
        .section-heading {
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Line Styles */
        .line {
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }

        .NoNewsbox {
            height:8rem; 
            background-color:white;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
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

            .modal-dialog{
                max-width: 60%;
                min-width: 15%;
            }

            .modal-header{
                padding-left: 20%;
            }
        }
    </style>

@endsection