@extends('layouts.app-pdms')

{{-- =============== ORIGINAL CODE =============== --}}
{{-- @section('title', 'MESH - Dashboard') --}}
{{-- =============== NISAH =============== --}}
@section('title', 'MOE MESH - PDMS Home')
{{-- =============================================== --}}

@section('content')

  <?php
    $pagename = " PDMS Home";
  ?>

{{-- ============ OLD PDMS HOME (pre MESH v4 redesign) — kept for reference, do not delete ============
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
                  <img src='{{Storage::url("$bns->bn_image_path") }}' style="width:100%; height:300px;"  class="d-inline-block border text-center rounded" alt="{{ $bns->bn_image }}">
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

            <!-- ------------------------------------------------------------------ -->
            <!-- Announcements -->
            <!-- ------------------------------------------------------------------ -->

    @if(session('success'))
    <div class="alert alert-success" style="margin-top: 20px">
        {{ session('success') }}
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="col-span-12 lg:col-span-6 mt-7">

                <!-- Section Title -->
                <div class="border-b-2 px-4 py-2 bg-white rounded-t-md flex items-center justify-between shadow-md">

                    <div class="flex flex-col md:flex-row md:items-center gap-1.5">
                        <p class="text-lg font-semibold text-blue-900" id="pgap">Announcements</p>
                        <p class="text-sm text-blue-900 hidden md:block" id="pgap">|</p>
                        <p class="text-sm text-gray-400" id="pgap" title="Only the latest 4 Announcement are shown">Latest Announcements<span class="required-symbol">*</span></p>
                        <p class="text-sm text-blue-900 hidden md:block" id="pgap">|</p>
                            <form method="POST" action="{{ route('subscribeannouncement') }}">
                                @csrf

                                <!-- Check if the user's data exists in the Sremailnotification model and notification is true -->
                                @php
                                    $userEmail = Auth::user()->email;
                                    $userIC = Auth::user()->ic_no;
                                    $subscription = \App\Models\Announcementnotification::where('email', $userEmail)
                                        ->where('ic_no', $userIC)
                                        ->first();
                                @endphp

                                <!-- Display "Subscribe" or "Unsubscribe" based on the subscription -->
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
                                    <a href="{{ Storage::url($announcement->announcement_file_path) }}" target="_blank">
                                        <img src="{{ Storage::url($announcement->announcement_file_path) }}" alt="Image" class="custom-imageannouncement">
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
                <!-- Announcement Slider -->
                <div class="NoNewsbox">
                    There are currently no announcement!
                </div>
            @endif
            </div>
        </div>
    </div>

        <!-- ------------------------------------------------------------------ -->
        <!-- News -->
        <!-- ------------------------------------------------------------------ -->

        <div class="row">
            <div class="col-span-12 lg:col-span-6 mt-7">
                <!-- Section Title -->
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
                    <!-- News Slider -->
                    <div class="bg-white overflow-y-auto shadow-md rounded-b-md">
                        <!-- Slider Content -->
                        <div class="sliderItems flex" style="justify-content: center;">
                            @foreach($news as $item)
                                <div class="mx-10 w-80 newsborder">
                                    <!-- News Image -->
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
                                                <a href="{{ Storage::url($imagePath) }}" target="_blank">
                                                    <img src="{{ Storage::url($imagePath) }}" alt="Image" class="custom-imagenews">
                                                </a>
                                            @else
                                                <img src="{{ asset('simpur/img/LatestNewswhite.png') }}" class="custom-altimagenews">
                                            @endif
                                        @else
                                            <img src="{{ asset('simpur/img/LatestNewswhite.png') }}" class="custom-altimagenews">
                                        @endif
                                    </div>

                                    <div class="mt-4">
                                        <!-- Title -->
                                        <p class="text-md font-semibold hover:text-indigo-500 cursor-pointer" style="height:30px;text-align: center; " title="{{ $item->news_title }}">
                                        <?php
                                            $content = nl2br($item->news_title); // Convert newlines to <br> tags
                                            $words = explode(' ', $content);
                                            $limitedContent = implode(' ', array_slice($words, 0, 10)); // Change '10' to the desired word limit
                                            echo $limitedContent . '...';
                                        ?>
                                        </p>
                                        <!-- Name and Date -->
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
                                        @endif                                        <!-- Content -->
                                        <p class="line-clamp-4 overflow-hidden mt-2" style="text-align: justify;">{{ $item->news_content }}</p>
                                    </div>
                                    <!-- Footer -->
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
                                                    <!-- Display images -->
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
                                                                        <a href="{{ Storage::url($filePath) }}" target="_blank" style="border: 1px solid #ddd;">
                                                                            <img src="{{ Storage::url($filePath) }}" alt="Thumbnail" class="thumbnail">
                                                                        </a>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <!-- Display PDF files -->
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
                                                                            <a href="{{ Storage::url($filePath) }}" target="_blank">
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
                    <!-- End of Slider Content -->
                @else
                    <!-- News Slider -->
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
============ END OLD PDMS HOME ============ --}}

    {{-- =============== NISAH (MESH v4 design, ported from home.blade.php) =============== --}}
    <div class="pagetitle">
      <h1>PDMS Home</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">PDMS Home</li>
        </ol>
      </nav>
    </div>

    <div id="meshHeroCarousel" class="carousel slide mesh-hero" data-bs-ride="carousel">
      <div class="mesh-hero-frame">
        <div class="carousel-inner h-100">
          @foreach($banners as $bns)
          <div class="carousel-item h-100 @if($loop->first) active @endif">
            <img src="{{ Storage::url($bns->bn_image_path) }}" alt="{{ $bns->bn_image }}">
          </div>
          @endforeach
        </div>
      </div>

      @if ($banners->count() > 1)
      <div class="mesh-hero-controls">
        <div class="mesh-hero-dots" data-mesh-hero-dots>
          @foreach($banners as $bns)
            <button type="button" data-bs-target="#meshHeroCarousel" data-bs-slide-to="{{ $loop->index }}" class="@if($loop->first) active @endif" aria-label="Slide {{ $loop->iteration }}"></button>
          @endforeach
        </div>
        <span class="mesh-hero-count" data-mesh-hero-count>{{ sprintf('%02d', 1) }} / {{ sprintf('%02d', $banners->count()) }}</span>
        <div class="mesh-hero-arrows">
          <button type="button" data-bs-target="#meshHeroCarousel" data-bs-slide="prev" aria-label="Previous slide"><i class="bi bi-chevron-left"></i></button>
          <button type="button" data-bs-target="#meshHeroCarousel" data-bs-slide="next" aria-label="Next slide"><i class="bi bi-chevron-right"></i></button>
        </div>
      </div>
      @endif
    </div>

    @if(session('success'))
    <div class="alert alert-success" style="margin-top: 20px">
        {{ session('success') }}
    </div>
    @endif

    <section class="mesh-section">
      <div class="mesh-section-head">
        <h2 class="mesh-section-title">Announcements</h2>
        <span class="mesh-section-accent"></span>
        <span class="mesh-section-tag" title="Only the latest 4 Announcements are shown">*Latest Announcements</span>

        <div class="mesh-section-actions">
          <form method="POST" action="{{ route('subscribeannouncement') }}">
            @csrf
            @php
                $userEmail = Auth::user()->email;
                $userIC = Auth::user()->ic_no;
                $subscription = \App\Models\Announcementnotification::where('email', $userEmail)
                    ->where('ic_no', $userIC)
                    ->first();
            @endphp
            @if (!$subscription || ($subscription && !$subscription->notification))
              <button type="submit" class="mesh-pill-btn" title="Click to receive notification in email">
                <i class="bi bi-envelope"></i> Subscribe
              </button>
            @else
              <button type="submit" formaction="{{ route('unsubscribeannouncement') }}" class="mesh-pill-btn" title="Click to disable receiving notification in email">
                <i class="bi bi-envelope"></i> Unsubscribe
              </button>
            @endif
          </form>
          <a href="{{ route('announcement.announcementindex') }}" class="mesh-view-all">View all <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>

      @if ($announcementExist)
      <div class="mesh-announce-list">
        @foreach ($announcements as $announcement)
          @php
            $icons = json_decode($announcement->announcement_icon, true) ?: [];
            $contentWithLinks = nl2br(preg_replace(
                '/\b(?:https?:\/\/|www\.)\S+\b/',
                '<a href="$0" target="_blank">$0</a>',
                e($announcement->announcement_content)
            ));
          @endphp
          <div class="mesh-announce-row" @if(!empty($announcement->announcement_content)) data-bs-toggle="modal" data-bs-target="#pdmsAnnouncementModal{{ $announcement->id }}" style="cursor:pointer;" @endif>
            <span class="mesh-announce-thumb @if($announcement->announcement_file_path) mesh-lightbox-trigger @endif" role="button" tabindex="0"
                  @if($announcement->announcement_file_path)
                  data-lightbox-src="{{ Storage::url($announcement->announcement_file_path) }}"
                  data-lightbox-title="{{ $announcement->announcement_title }}"
                  data-lightbox-meta="{{ $announcement->announcement_date }}"
                  @endif>
              @if ($announcement->announcement_file_path)
                <img src="{{ Storage::url($announcement->announcement_file_path) }}" alt="{{ $announcement->announcement_title }}">
                <span class="mesh-zoom-badge"><i class="bi bi-zoom-in"></i></span>
              @else
                <img src="{{ asset('img/Announcement.png') }}" alt="{{ $announcement->announcement_title }}">
              @endif
            </span>

            <div class="mesh-announce-body">
              <div class="mesh-announce-meta">
                @if(in_array("info", $icons))
                  <span class="mesh-badge mesh-badge-info"><i class="bi bi-info-circle"></i> Information</span>
                @endif
                @if(in_array("maintenance", $icons))
                  <span class="mesh-badge mesh-badge-maintenance"><i class="bi bi-wrench"></i> Maintenance</span>
                @endif
                @if(in_array("update", $icons))
                  <span class="mesh-badge mesh-badge-update"><i class="bi bi-gear"></i> Update</span>
                @endif
                @if(in_array("urgent", $icons))
                  <span class="mesh-badge mesh-badge-urgent"><i class="bi bi-exclamation-triangle"></i> Urgent</span>
                @endif
                <span class="mesh-mono-date">{{ $announcement->announcement_date }}</span>
              </div>
              <h3 class="mesh-announce-title">{{ $announcement->announcement_title }}</h3>
              <p class="mesh-announce-desc">{!! $contentWithLinks !!}</p>
            </div>

            <div class="mesh-announce-actions">
              @if (!empty($announcement->pdf_file_path))
                @if (count($announcement->pdf_file_path) === 1)
                  <a href="{{ Storage::url($announcement->pdf_file_path[0]) }}" target="_blank" class="mesh-icon-btn" title="Download attachment" onclick="event.stopPropagation()">
                    <i class="bi bi-download"></i>
                  </a>
                @else
                  <a href="#" data-bs-toggle="modal" data-bs-target="#pdmsDocumentsModal{{ $announcement->id }}" class="mesh-icon-btn" title="Download attachments" onclick="event.stopPropagation()">
                    <i class="bi bi-download"></i>
                  </a>

                  <!-- Modal -->
                  <div class="modal fade mesh-modal" id="pdmsDocumentsModal{{ $announcement->id }}" tabindex="-1" aria-labelledby="pdmsDocumentsModalLabel{{ $announcement->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header mesh-modal-header">
                          <h5 class="mesh-modal-title" id="pdmsDocumentsModalLabel{{ $announcement->id }}" style="font-size:20px;">Documents Posted</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mesh-modal-body">
                          <div class="grid {{ count($announcement->pdf_file_path) === 1 ? 'grid-cols-1 justify-center' : (count($announcement->pdf_file_path) === 2 ? 'grid-cols-2 justify-center' : 'grid-cols-3') }} gap-4">
                            @foreach ($announcement->pdf_file_path as $filePath)
                              @php
                                $filenameWithoutExtension = pathinfo($filePath, PATHINFO_FILENAME);
                                $nameParts = explode('_', $filenameWithoutExtension);
                                $documentName = implode(' ', array_slice($nameParts, 1));
                              @endphp
                              <div class="text-center">
                                <a href="{{ Storage::url($filePath) }}" target="_blank" class="mesh-icon-btn">
                                  <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                </a>
                                <p class="text-xs">{{ $documentName }}</p>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
              @endif
              <span class="mesh-icon-btn mesh-icon-btn-solid"><i class="bi bi-arrow-right"></i></span>
            </div>
          </div>

          <!-- Announcement detail modal (MESH v4, single-column layout — poster in-flow, footer download/link) -->
          <div class="modal fade mesh-modal" id="pdmsAnnouncementModal{{ $announcement->id }}" tabindex="-1" aria-labelledby="pdmsAnnouncementModalLabel{{ $announcement->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="mesh-modal-body" style="padding:34px 38px 24px;">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position:absolute; top:16px; right:16px;"></button>

                  <div class="mesh-announce-meta">
                    @if(in_array("info", $icons))
                      <span class="mesh-badge mesh-badge-info"><i class="bi bi-info-circle"></i> Information</span>
                    @endif
                    @if(in_array("maintenance", $icons))
                      <span class="mesh-badge mesh-badge-maintenance"><i class="bi bi-wrench"></i> Maintenance</span>
                    @endif
                    @if(in_array("update", $icons))
                      <span class="mesh-badge mesh-badge-update"><i class="bi bi-gear"></i> Update</span>
                    @endif
                    @if(in_array("urgent", $icons))
                      <span class="mesh-badge mesh-badge-urgent"><i class="bi bi-exclamation-triangle"></i> Urgent</span>
                    @endif
                    <span class="mesh-mono-date" style="font-family:inherit; letter-spacing:normal;">{{ $announcement->announcement_date }}</span>
                  </div>
                  <h1 class="mesh-modal-title" id="pdmsAnnouncementModalLabel{{ $announcement->id }}" style="font-size:30px; margin-top:8px;">{{ $announcement->announcement_title }}</h1>
                  <div style="height:1px; background:#dfe1ee; margin:18px 0;"></div>
                  <div class="mesh-modal-content-text" style="max-width:66ch;">{!! $contentWithLinks !!}</div>

                  @if ($announcement->announcement_file_path)
                    <button type="button" class="mesh-detail-poster-inline mesh-lightbox-trigger" title="View poster"
                            data-lightbox-src="{{ Storage::url($announcement->announcement_file_path) }}"
                            data-lightbox-title="{{ $announcement->announcement_title }}"
                            data-lightbox-meta="{{ $announcement->announcement_date }}">
                      <img src="{{ Storage::url($announcement->announcement_file_path) }}" alt="{{ $announcement->announcement_title }}">
                      <span class="mesh-detail-poster-tag"><i class="bi bi-zoom-in"></i> View poster</span>
                    </button>
                  @endif
                </div>

                <div class="mesh-modal-footer">
                  @if (!empty($announcement->pdf_file_path))
                    @foreach ($announcement->pdf_file_path as $filePath)
                      @php
                        $filenameWithoutExtension = pathinfo($filePath, PATHINFO_FILENAME);
                        $nameParts = explode('_', $filenameWithoutExtension);
                        $documentName = implode(' ', array_slice($nameParts, 1)) ?: basename($filePath);
                      @endphp
                      <a href="{{ Storage::url($filePath) }}" target="_blank" class="mesh-pill-btn">
                        <i class="bi bi-download"></i> {{ $documentName }}
                      </a>
                    @endforeach
                  @endif
                  <a href="{{ route('announcement.announcementindex') }}" class="mesh-view-all" style="margin-left:auto;">All announcements <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mesh-section-footer">
        <span class="mesh-showing-count">SHOWING {{ $announcements->count() }} OF {{ $announcements->total() }}</span>
        @if ($announcements->total() > $announcements->count())
          <a href="{{ route('announcement.announcementindex') }}" class="mesh-show-more-btn">Show more</a>
        @endif
      </div>
      @else
        <div class="mesh-empty-box">There are currently no announcements.</div>
      @endif
    </section>

    <section class="mesh-section">
      <div class="mesh-section-head mesh-section-head-light">
        <h2 class="mesh-section-title">News</h2>
        <span class="mesh-section-accent"></span>
        <span class="mesh-section-tag" title="Only the latest 3 News are shown" style="text-transform:none;">Latest News</span>
        <a href="{{ route('news.newsindex') }}" class="mesh-view-all" style="margin-left:auto;">View all <i class="bi bi-arrow-right"></i></a>
      </div>

      @if ($newsExist)
      <div class="mesh-news-grid">
        @foreach($news as $item)
          @php
            $imagePath = null;
            $hasImage = false;
            $hasPdf = false;
            if (is_array($item->news_file_path)) {
              foreach ($item->news_file_path as $file) {
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                  if (!$imagePath) { $imagePath = $file; }
                  $hasImage = true;
                }
                if ($extension === 'pdf') { $hasPdf = true; }
              }
            }
            $wordCount = str_word_count(strip_tags($item->news_content));
            $readMins = max(1, (int) ceil($wordCount / 200));
          @endphp
          <div class="mesh-news-card">
            <div class="mesh-news-thumb">
              @if ($imagePath)
                <img src="{{ Storage::url($imagePath) }}" alt="{{ $item->news_title }}">
              @else
                <img src="{{ asset('simpur/img/LatestNewswhite.png') }}" alt="{{ $item->news_title }}">
              @endif
            </div>
            <span class="mesh-news-meta">{{ strtoupper($item->news_date->format('j M Y')) }} &middot; {{ $readMins }} MIN READ</span>
            <h3 class="mesh-news-title" title="{{ $item->news_title }}">{{ $item->news_title }}</h3>
            @if ($item->news_name)
              <span class="mesh-news-byline">{{ $item->news_name }}</span>
            @endif
            <div class="mesh-news-footer">
              <a href="#" data-bs-toggle="modal" data-bs-target="#pdmsNewsModal{{ $item->id }}">Read more</a>
            </div>
          </div>

          <!-- News Modal (MESH v4 — image panel on the left, single-column-style header/divider on the right) -->
          <div class="modal fade mesh-modal" id="pdmsNewsModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="pdmsNewsModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
                <div class="mesh-modal-grid">
                  <div>
                    @if ($hasImage)
                      @php
                        $allNewsImageUrls = collect($item->news_file_path)
                          ->filter(fn ($f) => in_array(pathinfo($f, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                          ->map(fn ($f) => Storage::url($f))
                          ->values();
                      @endphp
                      @if ($allNewsImageUrls->count() > 1)
                        <div data-mesh-carousel data-mesh-gallery="{{ $allNewsImageUrls->toJson() }}">
                          <div class="mesh-modal-image-panel mesh-lightbox-trigger" data-mesh-carousel-image
                               data-lightbox-src="{{ $allNewsImageUrls->first() }}" data-lightbox-title="{{ $item->news_title }}" data-lightbox-meta="{{ $item->news_date->format('j M Y') }}"
                               style="background-image:url('{{ $allNewsImageUrls->first() }}');">
                            <button type="button" class="mesh-carousel-arrow mesh-carousel-prev" data-mesh-carousel-prev aria-label="Previous photo"><i class="bi bi-chevron-left"></i></button>
                            <button type="button" class="mesh-carousel-arrow mesh-carousel-next" data-mesh-carousel-next aria-label="Next photo"><i class="bi bi-chevron-right"></i></button>
                            <span class="mesh-carousel-counter" data-mesh-carousel-counter>1 / {{ $allNewsImageUrls->count() }}</span>
                            <span class="mesh-zoom-badge"><i class="bi bi-zoom-in"></i></span>
                          </div>
                          <div class="mesh-carousel-dots">
                            @foreach ($allNewsImageUrls as $i => $url)
                              <button type="button" class="mesh-carousel-dot @if($i === 0) active @endif" data-mesh-carousel-dot data-index="{{ $i }}" aria-label="Photo {{ $i + 1 }}"></button>
                            @endforeach
                          </div>
                        </div>
                      @else
                        <div class="mesh-modal-image-panel mesh-lightbox-trigger"
                             data-lightbox-src="{{ $allNewsImageUrls->first() }}" data-lightbox-title="{{ $item->news_title }}" data-lightbox-meta="{{ $item->news_date->format('j M Y') }}"
                             style="background-image:url('{{ $allNewsImageUrls->first() }}');">
                          <span class="mesh-zoom-badge"><i class="bi bi-zoom-in"></i></span>
                        </div>
                      @endif
                    @else
                      <div class="mesh-modal-cover">
                        <svg class="mesh-modal-cover-pattern" aria-hidden="true"><use href="#netmesh"></use></svg>
                        <span class="mesh-modal-cover-tag">MOE NEWS</span>
                        <span class="mesh-modal-cover-title">{{ $item->news_title }}</span>
                        <span class="mesh-modal-cover-meta">{{ strtoupper($item->news_date->format('j M Y')) }}</span>
                      </div>
                    @endif
                  </div>

                  <div style="position:relative; min-height:0;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position:absolute; top:14px; right:14px; z-index:2; background-color:rgba(255,255,255,.92); border-radius:99px; padding:8px;"></button>

                    <div class="mesh-modal-text-panel">
                      <h1 class="mesh-modal-title" id="pdmsNewsModalLabel{{ $item->id }}" style="font-size:26px;">{{ $item->news_title }}</h1>
                      <span class="mesh-mono-date" style="font-family:inherit; letter-spacing:normal; display:block; margin-top:8px;">
                        {{ strtoupper($item->news_date->format('j M Y')) }}
                        @if ($item->news_name) &middot; {{ $item->news_name }} @endif
                      </span>
                      <div style="height:1px; background:#dfe1ee; margin:16px 0;"></div>
                      <div class="mesh-modal-content-text">{!! nl2br($item->news_content) !!}</div>
                    </div>
                  </div>
                </div>

                <div class="mesh-modal-footer">
                  @if ($hasPdf)
                    @foreach ($item->news_file_path as $filePath)
                      @php $extension = pathinfo($filePath, PATHINFO_EXTENSION); @endphp
                      @if ($extension === 'pdf')
                        <a href="{{ Storage::url($filePath) }}" target="_blank" class="mesh-pill-btn">
                          <i class="bi bi-download"></i> {{ basename($filePath) }}
                        </a>
                      @endif
                    @endforeach
                  @endif
                  <a href="{{ route('news.newsindex') }}" class="mesh-view-all" style="margin-left:auto;">All news <i class="bi bi-arrow-right"></i></a>
                </div>

              </div>
            </div>
          </div>
        @endforeach
      </div>
      @else
        <div class="mesh-empty-box">There are currently no news.</div>
      @endif
    </section>

    <!-- Shared poster/image lightbox for Announcements + News (see public/js/mesh-v4.js) -->
    <div class="mesh-lightbox">
      <div class="mesh-lightbox-backdrop" style="position:absolute; inset:0;"></div>
      <div class="mesh-lightbox-inner">
        <div class="mesh-lightbox-top">
          <div>
            <p class="mesh-lightbox-title"></p>
            <p class="mesh-lightbox-meta"></p>
          </div>
          <button type="button" class="mesh-lightbox-close" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>
        <img class="mesh-lightbox-image" alt="">
      </div>
    </div>
    {{-- =============================================== --}}

@endsection
