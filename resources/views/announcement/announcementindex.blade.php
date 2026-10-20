@extends('layouts.app-all')

@section('title', 'MOE MESH - Announcements')

@section('content')

    @php $pagename = "announcement"; @endphp

    <div class="mesh-breadcrumb">
      <a href="{{ route('home') }}">HOME</a><span>/</span><span class="mesh-breadcrumb-current">ANNOUNCEMENTS</span>
    </div>

    <section style="padding:24px 0 70px; display:flex; flex-direction:column; gap:26px;">

      <div style="display:flex; align-items:flex-end; gap:18px; flex-wrap:wrap;">
        <h1 class="mesh-archive-title">Announcements</h1>
        <span class="mesh-section-accent" style="margin-bottom:12px;"></span>
        <span class="mesh-archive-sub">Official notices for Ministry of Education staff, newest first</span>
      </div>

      <form method="GET" action="{{ route('announcement.announcementindex') }}" style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
        @if($search)<input type="hidden" name="q" value="{{ $search }}">@endif
        <a href="{{ route('announcement.announcementindex', array_filter(['q' => $search])) }}" class="mesh-filter-pill @if(!$kind) active @endif">All</a>
        <a href="{{ route('announcement.announcementindex', array_filter(['q' => $search, 'kind' => 'urgent'])) }}" class="mesh-filter-pill @if($kind === 'urgent') active @endif">Urgent</a>
        <a href="{{ route('announcement.announcementindex', array_filter(['q' => $search, 'kind' => 'info'])) }}" class="mesh-filter-pill @if($kind === 'info') active @endif">Information</a>
        <a href="{{ route('announcement.announcementindex', array_filter(['q' => $search, 'kind' => 'update'])) }}" class="mesh-filter-pill @if($kind === 'update') active @endif">New update</a>
        <a href="{{ route('announcement.announcementindex', array_filter(['q' => $search, 'kind' => 'maintenance'])) }}" class="mesh-filter-pill @if($kind === 'maintenance') active @endif">Maintenance</a>
        @if($kind)<input type="hidden" name="kind" value="{{ $kind }}">@endif
        <input type="search" name="q" value="{{ $search }}" placeholder="Search" class="mesh-search-input" style="margin-left:auto; width:200px;">
      </form>

      @if ($announcementExist && $announcements->count() > 0)
        <div class="mesh-announce-list">
          @foreach ($announcements as $announcement)
            @php
              $icons = json_decode($announcement->announcement_icon, true) ?: [];
              // Linkify before nl2br — see home.blade.php for why the reverse
              // order corrupts the href whenever a URL sits right before a
              // blank line.
              $contentWithLinks = nl2br(preg_replace(
                  '/\b(?:https?:\/\/|www\.)\S+\b/',
                  '<a href="$0" target="_blank">$0</a>',
                  e($announcement->announcement_content)
              ));
              $isNew = $announcement->created_at && $announcement->created_at->gt(now()->subDays(7));
            @endphp
            <div class="mesh-announce-row" data-bs-toggle="modal" data-bs-target="#announcementDetail{{ $announcement->id }}" style="cursor:pointer;">
              <span class="mesh-announce-thumb @if($announcement->announcement_file_path) mesh-lightbox-trigger @endif" role="button" tabindex="0"
                    @if($announcement->announcement_file_path)
                    data-lightbox-src="{{ asset($announcement->announcement_file_path) }}"
                    data-lightbox-title="{{ $announcement->announcement_title }}"
                    data-lightbox-meta="{{ $announcement->announcement_date }}"
                    @endif>
                @if ($announcement->announcement_file_path)
                  <img src="{{ asset($announcement->announcement_file_path) }}" alt="{{ $announcement->announcement_title }}">
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
                  @if ($isNew)
                    <span style="font-size:11px; font-weight:700; letter-spacing:0.06em; color:#241f9e;">NEW</span>
                  @endif
                </div>
                <h3 class="mesh-announce-title">{{ $announcement->announcement_title }}</h3>
                <p class="mesh-announce-desc">{!! $contentWithLinks !!}</p>
              </div>

              <div class="mesh-announce-actions">
                @if (!empty($announcement->pdf_file_path))
                  @if (count($announcement->pdf_file_path) === 1)
                    <a href="{{ asset($announcement->pdf_file_path[0]) }}" target="_blank" class="mesh-icon-btn" title="Download attachment" onclick="event.stopPropagation()">
                      <i class="bi bi-download"></i>
                    </a>
                  @else
                    <a href="#" data-bs-toggle="modal" data-bs-target="#documentsModal{{ $announcement->id }}" class="mesh-icon-btn" title="Download attachments" onclick="event.stopPropagation()">
                      <i class="bi bi-download"></i>
                    </a>

                    <!-- Modal -->
                    <div class="modal fade mesh-modal" id="documentsModal{{ $announcement->id }}" tabindex="-1" aria-labelledby="documentsModalLabel{{ $announcement->id }}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header mesh-modal-header">
                            <h5 class="mesh-modal-title" id="documentsModalLabel{{ $announcement->id }}" style="font-size:20px;">Documents Posted</h5>
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
          @endforeach
        </div>

        <div style="display:flex; align-items:center; gap:20px; flex-wrap:wrap;">
          @if ($announcements->hasMorePages())
            <a href="{{ $announcements->nextPageUrl() }}" class="mesh-pill-btn" style="background:#241f9e; color:#ffffff; box-shadow:none;">Show more</a>
          @endif
          <span class="mesh-showing-count">SHOWING {{ $announcements->count() }} OF {{ $announcements->total() }}</span>

          <form method="POST" action="{{ route('subscribeannouncement') }}" style="margin-left:auto;">
            @csrf
            @php
              $userEmail = Auth::user()->email;
              $userIC = Auth::user()->ic_no;
              $subscription = \App\Models\Announcementnotification::where('email', $userEmail)
                  ->where('ic_no', $userIC)
                  ->first();
            @endphp
            @if (!$subscription || ($subscription && !$subscription->notification))
              <button type="submit" class="mesh-pill-btn" title="Get new announcements delivered to your MOE email">
                <i class="bi bi-envelope"></i> Subscribe by email
              </button>
            @else
              <button type="submit" formaction="{{ route('unsubscribeannouncement') }}" class="mesh-pill-btn" title="Click to disable receiving notification in email">
                <i class="bi bi-envelope"></i> Unsubscribe
              </button>
            @endif
          </form>
        </div>

        @php $flatAnnouncements = $announcements->getCollection()->values(); @endphp
        @foreach ($flatAnnouncements as $index => $announcement)
          @php
            $icons = json_decode($announcement->announcement_icon, true) ?: [];
            $contentWithLinks = nl2br(preg_replace(
                '/\b(?:https?:\/\/|www\.)\S+\b/',
                '<a href="$0" target="_blank">$0</a>',
                e($announcement->announcement_content)
            ));
            $nextAnnouncement = $flatAnnouncements[($index + 1) % $flatAnnouncements->count()];
          @endphp
          <div class="modal fade mesh-modal" id="announcementDetail{{ $announcement->id }}" tabindex="-1" aria-labelledby="announcementDetailLabel{{ $announcement->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
              <div class="modal-content">
                <div class="mesh-modal-body" style="padding:34px 38px 30px;">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position:absolute; top:16px; right:16px;"></button>

                  <div class="mesh-detail-grid">
                    <article style="display:flex; flex-direction:column; gap:20px; min-width:0;">
                      <div class="mesh-announce-meta">
                        @if(in_array("urgent", $icons))
                          <span class="mesh-badge" style="background:#ffcc00; color:#3d2f00;"><i class="bi bi-exclamation-triangle"></i> Urgent</span>
                        @endif
                        @if(in_array("info", $icons))
                          <span class="mesh-badge mesh-badge-info"><i class="bi bi-info-circle"></i> Information</span>
                        @endif
                        @if(in_array("update", $icons))
                          <span class="mesh-badge mesh-badge-update"><i class="bi bi-gear"></i> New update</span>
                        @endif
                        @if(in_array("maintenance", $icons))
                          <span class="mesh-badge mesh-badge-maintenance"><i class="bi bi-wrench"></i> Maintenance</span>
                        @endif
                        <span class="mesh-mono-date" style="font-family:inherit; letter-spacing:normal;">{{ $announcement->announcement_date }}</span>
                      </div>
                      <h1 class="mesh-modal-title" id="announcementDetailLabel{{ $announcement->id }}" style="font-size:30px;">{{ $announcement->announcement_title }}</h1>
                      <div style="height:1px; background:#dfe1ee;"></div>
                      <div class="mesh-modal-content-text" style="max-width:66ch;">{!! $contentWithLinks !!}</div>
                      <div style="padding-top:6px;">
                        <button type="button" data-bs-dismiss="modal" class="mesh-pill-btn"><i class="bi bi-arrow-left"></i> All announcements</button>
                      </div>
                    </article>

                    <aside class="mesh-detail-sidebar">
                      @if ($announcement->announcement_file_path)
                        <button type="button" class="mesh-detail-poster mesh-lightbox-trigger" title="View poster"
                                data-lightbox-src="{{ asset($announcement->announcement_file_path) }}"
                                data-lightbox-title="{{ $announcement->announcement_title }}"
                                data-lightbox-meta="{{ $announcement->announcement_date }}">
                          <img src="{{ asset($announcement->announcement_file_path) }}" alt="{{ $announcement->announcement_title }}">
                          <span class="mesh-detail-poster-tag"><i class="bi bi-zoom-in"></i> View poster</span>
                        </button>
                      @endif
                      <div class="mesh-detail-attach-panel">
                        <span class="mesh-detail-attach-label">Attachments</span>
                        @if (!empty($announcement->pdf_file_path))
                          @foreach ($announcement->pdf_file_path as $filePath)
                            @php
                              $filenameWithoutExtension = pathinfo($filePath, PATHINFO_FILENAME);
                              $nameParts = explode('_', $filenameWithoutExtension);
                              $documentName = implode(' ', array_slice($nameParts, 1)) ?: basename($filePath);
                            @endphp
                            <a href="{{ Storage::url($filePath) }}" target="_blank" class="mesh-detail-attach-item">
                              <span class="mesh-detail-attach-icon"><i class="bi bi-download"></i></span>{{ $documentName }}
                            </a>
                          @endforeach
                        @else
                          <span style="font-size:13px; color:#8b8da6;">No documents attached.</span>
                        @endif
                      </div>
                    </aside>
                  </div>

                  @if ($flatAnnouncements->count() > 1)
                    <div class="mesh-modal-next" style="margin:22px -38px -30px; border-radius:0 0 8px 8px;">
                      <span>NEXT NOTICE</span>
                      <button type="button" data-mesh-next-modal="#announcementDetail{{ $nextAnnouncement->id }}" data-bs-dismiss="modal">
                        {{ $nextAnnouncement->announcement_title }} <i class="bi bi-arrow-right"></i>
                      </button>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div style="display:flex; flex-direction:column; gap:8px; align-items:flex-start; padding:56px 4px; border-top:1px solid #e4e6f0;">
          @if ($search || $kind)
            <span style="font-size:17px; font-weight:700;">No announcements match your filters</span>
            <a href="{{ route('announcement.announcementindex') }}" style="font-size:13.5px; font-weight:700; color:#241f9e; text-decoration:none;">Clear filters &rarr;</a>
          @else
            <span style="font-size:17px; font-weight:700;">There are currently no announcements</span>
          @endif
        </div>
      @endif
    </section>

    <!-- Shared poster/image lightbox (see public/js/mesh-v4.js) -->
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

@endsection
