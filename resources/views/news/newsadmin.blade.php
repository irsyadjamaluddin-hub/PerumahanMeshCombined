@extends('layouts.app-all')

@section('title', 'MOE MESH - Announcement Admin')

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" sections; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
<div class="mesh-home-theme">
{{-- #================================ --}}

    @php $pagename = "News Admin"; @endphp

    {{-- Breadcrumbs / Page Title --}}
            <div class="pagetitle">
                <h1>News</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">News-Admin</li>
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

                <!-- Create Button -->
                <div class="col-md-1 text-left">
                    <a href="{{ route('news.newsadmin-create') }}" class="btn btn-primary text-right" style="margin-bottom: 10px;">
                        <i class="bi bi-plus-lg"></i>
                    </a>
                </div>

            @if ($newsExist)
                <!-- News Sections -->
                <div class="row">
                    @foreach($news as $item)
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-center news-title">{{ $item->news_title }}</h5>
                                <hr class="custom-hr" style="width: 100%; margin: 0;">
                                @if ($item->news_name)
                                <p class="custom-p card-text text-center" style="font-style: italic;">{{ $item->news_name }} - {{ $item->news_date->format('j/n/Y') }}</p>
                                @else
                                <p class="custom-p card-text text-center" style="font-style: italic;">{{ $item->news_date->format('j/n/Y') }}</p>
                                @endif                                   <hr class="custom-hr" style="width: 100%; margin: 0;">
                                <p class="custom-newscontent card-text">
                                    <?php
                                        $content = nl2br($item->news_content); // Convert newlines to <br> tags
                                        $words = explode(' ', $content);
                                        $limitedContent = implode(' ', array_slice($words, 0, 40)); // Change '40' to the desired word limit
                                        echo $limitedContent . '...';
                                    ?>
                                </p>

                                <div class="card-footer text-right mt-auto">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="d-flex">
                                                <form method="get" action="{{ route('news.newsadmin-edit', $item->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary mr-2">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                </form>
                                                
                                                <div class="icon-gap">
                                                    <form method="post" action="{{ route('news.destroy', $item->id) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" value="delete" class="btn btn-outline-primary" onclick="return confirm('Delete News?')">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <a href="#" class="read-more-link" data-toggle="modal" data-target="#newsModal{{$item->id}}">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                    <p class="card-text custom-newscontent" style="text-align: justify; padding-bottom: 10px;">{!! nl2br($item->news_content) !!}</p>
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
                                                            <a href="{{ Storage::url($filePath) }}" target="_blank" style="border: 1px solid #ddd;">
                                                                <img src="{{ Storage::url($filePath) }}" alt="Thumbnail" class="thumbnail">
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

                <!-- Pagination -->
                <div class="pagination-container">
                    <div class="pagination-buttons">
                        {{ $news->links() }}
                    </div>
                </div>
            @else
                {{-- News Slider --}}
                <div class="NoNewsbox">
                    There are Currently No News!
                </div>
            @endif
            </section>

    <style>
    .custom-hr {
        margin: 0.2rem !important;
        /* Add your desired styles for the hr element */
    }

    .custom-p {
        margin: 0rem !important;
    }

    .custom-newscontent {
        text-align: justify;
        text-justify: inter-word;
        padding-top: 20px;
        word-wrap: break-word;
        overflow-y: auto;
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

    .card-body{
        height: 30rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
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

    #custom-modal-content{
        max-width: 1000px !important;
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

    .icon-gap {
        padding-left: 5px;
    }
    </style>

{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
@endsection
