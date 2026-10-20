{{-- OLD VERSION (oldver-2025-2026septver): full copy of resources/views/news/newsindex.blade.php taken on 29 Sept 2026, just before the old code was --}}
{{-- removed from it. Old code is in the "ORIGINAL CODE" / "OLD ... kept for reference" blocks. Not used by any route. --}}
@extends('layouts.app-all')

@section('title', 'MOE MESH - News')

@section('content')

    @php $pagename = "newsindex"; @endphp

{{-- ============ OLD NEWS INDEX PAGE (pre MESH v4 redesign) — kept for reference, do not delete ============
    <!-- Breadcrumbs / Page Title -->
            <div class="pagetitle">
                <h1>News</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">News-Index</li>
                    </ol>
                </nav>
            </div>

            <section class="mt-7" id="announcementgap">

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
                                @endif                                <hr class="custom-hr" style="width: 100%; margin: 0;">
                                <p class="custom-newscontent card-text"> 
                                <!-- {{ $item->news_content }} -->
                                    <?php
                                        $content = nl2br($item->news_content); // Convert newlines to <br> tags
                                        $words = explode(' ', $content);
                                        $limitedContent = implode(' ', array_slice($words, 0, 40)); // Change '40' to the desired word limit
                                        echo $limitedContent . '...';
                                    ?>
                                </p>

                                <div class="card-footer text-right mt-auto">
                                    <a href="#" class="read-more-link" data-toggle="modal" data-target="#newsModal{{$item->id}}">Read more</a>
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
                                                            <a href="{{ asset($filePath) }}" target="_blank" style="border: 1px solid #ddd;">
                                                                <img src="{{ asset($filePath) }}" alt="Thumbnail" class="thumbnail">
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

                <!-- Pagination -->
                <div class="pagination-container">
                    <div class="pagination-buttons">
                        {{ $news->links() }}
                    </div>
                </div>
            @else
                <!-- News Slider -->
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
    </style>
============ END OLD NEWS INDEX PAGE ============ --}}

    <div class="mesh-breadcrumb">
      <a href="{{ route('home') }}">HOME</a><span>/</span><span class="mesh-breadcrumb-current">NEWS</span>
    </div>

    <section style="padding:24px 4px 6px; display:flex; flex-direction:column; gap:18px;">
      <div style="display:flex; align-items:flex-end; gap:22px; flex-wrap:wrap;">
        <h1 class="mesh-archive-title">News archive</h1>
        <span class="mesh-archive-sub">Everything published by the Ministry, newest first</span>
      </div>
    </section>

    <form method="GET" action="{{ route('news.newsindex') }}" class="mesh-filter-bar">
      @if($year)<input type="hidden" name="year" value="{{ $year }}">@endif
      <input type="search" name="q" value="{{ $search }}" placeholder="Search the archive" class="mesh-search-input">

      <div style="display:flex; align-items:center; gap:16px; font-size:13.5px;">
        <span style="font-weight:700; color:#241f9e; border-bottom:2px solid #241f9e; padding-bottom:2px;">All</span>
      </div>

      <div style="margin-left:auto; position:relative;" data-mesh-year-dropdown>
        <button type="button" class="mesh-year-btn" data-mesh-year-toggle>
          {{ $year ? $year : 'All Years' }}
          <i class="bi bi-chevron-down" style="font-size:11px;"></i>
        </button>
        <div class="mesh-year-panel" data-mesh-year-panel hidden>
          @forelse($availableYears as $yr => $count)
            <a href="{{ route('news.newsindex', array_filter(['year' => $yr, 'q' => $search])) }}" class="mesh-year-option @if((string) $year === (string) $yr) active @endif">
              @if((string) $year === (string) $yr)
                <span style="display:flex; align-items:center; justify-content:center; width:17px; height:17px; border-radius:4px; background:#241f9e; flex:none;">
                  <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 13 4 4L19 7"></path></svg>
                </span>
              @else
                <span style="display:inline-block; width:17px; height:17px; border-radius:4px; box-shadow:inset 0 0 0 1.5px #d3d5e6; flex:none;"></span>
              @endif
              {{ $yr }}
              <span class="mesh-year-count">{{ $count }}</span>
            </a>
          @empty
            <span style="padding:9px 14px; font-size:13px; color:#8b8da6;">No articles yet</span>
          @endforelse
          @if($year)
            <div style="height:1px; background:#eceef6; margin:6px 0;"></div>
            <a href="{{ route('news.newsindex', array_filter(['q' => $search])) }}" class="mesh-year-clear">Clear filter</a>
          @endif
        </div>
      </div>
    </form>

    <section style="display:flex; flex-direction:column; padding:0 0 56px;">
      @if ($newsExist && $news->count() > 0)
        @php
          $flatNews = $news->getCollection()->values();
          $groups = $flatNews->groupBy(function ($item) { return $item->news_date->format('Y'); });
          $globalIndex = 0;
        @endphp
        @foreach($groups as $groupYear => $itemsInYear)
          <div class="mesh-year-group-header">
            <span class="mesh-year-label">{{ $groupYear }}</span>
            @php $groupTotal = $availableYears[$groupYear] ?? $itemsInYear->count(); @endphp
            <span style="font-family:ui-monospace,Menlo,monospace; font-size:10.5px; letter-spacing:0.12em; color:#8b8da6;">
              {{ $groupTotal }} {{ $groupTotal == 1 ? 'ARTICLE' : 'ARTICLES' }}
            </span>
            <span class="mesh-year-line"></span>
          </div>

          @foreach($itemsInYear as $item)
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
              $nextNewsItem = $flatNews[($globalIndex + 1) % $flatNews->count()];
              $globalIndex++;
            @endphp
            <button type="button" class="mesh-archive-row" data-bs-toggle="modal" data-bs-target="#newsModal{{ $item->id }}">
              <span class="mesh-archive-thumb">
                @if ($imagePath)
                  <img src="{{ Storage::url($imagePath) }}" alt="{{ $item->news_title }}">
                @else
                  <img src="{{ asset('simpur/img/LatestNewswhite.png') }}" alt="{{ $item->news_title }}">
                @endif
              </span>
              <span style="display:flex; flex-direction:column; gap:6px; min-width:0;">
                <span class="mesh-archive-meta">
                  <span class="mesh-archive-date">{{ $item->news_date->format('j M Y') }}</span>
                  @if ($item->news_name)
                    <span class="mesh-dot"></span>
                    <span class="mesh-archive-byline">{{ $item->news_name }}</span>
                  @endif
                </span>
                <span class="mesh-archive-title-row">{{ $item->news_title }}</span>
                <span class="mesh-archive-desc">{{ \Illuminate\Support\Str::limit(strip_tags($item->news_content), 140) }}</span>
              </span>
              <span class="mesh-archive-read">{{ $readMins }} MIN</span>
            </button>

            <!-- News Modal (MESH v4 — image carousel on the left, single-column-style header/divider on the right; mirrors home.blade.php) -->
            <div class="modal fade mesh-modal" id="newsModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel{{ $item->id }}" aria-hidden="true">
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
                        <h1 class="mesh-modal-title" id="newsModalLabel{{ $item->id }}" style="font-size:26px;">{{ $item->news_title }}</h1>
                        <span class="mesh-mono-date" style="font-family:inherit; letter-spacing:normal; display:block; margin-top:8px;">
                          {{ strtoupper($item->news_date->format('j M Y')) }}
                          @if ($item->news_name) &middot; {{ $item->news_name }} @endif
                        </span>
                        <div style="height:1px; background:#dfe1ee; margin:16px 0;"></div>
                        <div class="mesh-modal-content-text">{!! nl2br($item->news_content) !!}</div>
                      </div>
                    </div>
                  </div>

                  @if ($hasPdf)
                    <div class="mesh-modal-footer">
                      @foreach ($item->news_file_path as $filePath)
                        @php $extension = pathinfo($filePath, PATHINFO_EXTENSION); @endphp
                        @if ($extension === 'pdf')
                          <a href="{{ Storage::url($filePath) }}" target="_blank" class="mesh-pill-btn">
                            <i class="bi bi-download"></i> {{ basename($filePath) }}
                          </a>
                        @endif
                      @endforeach
                    </div>
                  @endif

                  {{-- =============== ORIGINAL CODE =============== --}}
                  {{--
                  @if ($flatNews->count() > 1)
                    <div class="mesh-modal-next">
                      <span>NEXT</span>
                      <button type="button" data-mesh-next-modal="#newsModal{{ $nextNewsItem->id }}" data-bs-dismiss="modal">
                        {{ $nextNewsItem->news_title }} <i class="bi bi-arrow-right"></i>
                      </button>
                    </div>
                  @endif
                  --}}
                  {{-- =============== NISAH =============== --}}
                  {{-- Removed the "NEXT" jump-to-next-article button per request —
                       the news detail modal should end at the article footer. --}}
                  {{-- =============================================== --}}
                </div>
              </div>
            </div>
          @endforeach
        @endforeach

        <div class="mesh-archive-footer">
          <span style="font-family:ui-monospace,Menlo,monospace; font-size:11.5px; color:#8b8da6;">
            SHOWING {{ $news->count() }} OF {{ $news->total() }}
          </span>
          @if ($news->hasMorePages())
            <a href="{{ $news->nextPageUrl() }}" class="mesh-load-more-btn">Load earlier articles</a>
          @endif
        </div>
      @else
        <div style="display:flex; flex-direction:column; gap:8px; align-items:flex-start; padding:56px 4px; border-top:1px solid #e4e6f0; margin-top:26px;">
          @if ($search || $year)
            <span style="font-size:17px; font-weight:700;">No articles match your filters</span>
            <a href="{{ route('news.newsindex') }}" style="border:none; background:transparent; padding:0; cursor:pointer; font-family:inherit; font-size:13.5px; font-weight:700; color:#241f9e; text-decoration:none;">Clear filters &rarr;</a>
          @else
            <span style="font-size:17px; font-weight:700;">There are currently no news</span>
          @endif
        </div>
      @endif
    </section>

    <!-- Shared poster/image lightbox for News (see public/js/mesh-v4.js) -->
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
        {{-- =============== ORIGINAL CODE =============== --}}
        {{-- <div class="mesh-lightbox-image"></div> --}}
        {{-- =============== NISAH =============== --}}
        {{-- Was a <div>, not an <img> — mesh-v4.js sets .attr('src', ...) on this
             element to show the clicked poster, which does nothing on a <div>
             (no src rendering), leaving only the CSS's white background box.
             announcementindex.blade.php/home.blade.php already use <img> correctly. --}}
        <img class="mesh-lightbox-image" alt="">
        {{-- =============================================== --}}
      </div>
    </div>

@endsection
