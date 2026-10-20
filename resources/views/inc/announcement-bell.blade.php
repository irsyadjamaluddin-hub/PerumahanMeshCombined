{{-- =============== NISAH =============== --}}
{{-- Header bell: announcements dropdown. Included by layouts/app-all.blade.php on EVERY page (Sept 2026). --}}
{{-- Needs $meshBellAnnouncements (set in the layout just before this include). --}}
{{-- The popups these items open, and the script that drives this dropdown, are in inc/announcement-bell-modals.blade.php --}}
{{-- (they have to sit at <body> level, outside the fixed header, or the popup ends up behind its own dark backdrop). --}}
{{-- =============================================== --}}
@php
  $meshBellBadges = [
    'info'        => ['class' => 'mesh-badge-info',        'label' => 'Information'],
    'maintenance' => ['class' => 'mesh-badge-maintenance', 'label' => 'Maintenance'],
    'update'      => ['class' => 'mesh-badge-update',      'label' => 'Update'],
    'urgent'      => ['class' => 'mesh-badge-urgent',      'label' => 'Urgent'],
  ];
  $meshBellSubscription = \App\Models\Announcementnotification::where('email', Auth::user()->email)
      ->where('ic_no', Auth::user()->ic_no)
      ->first();
@endphp

<style>
  .mesh-annbell{ position:relative; }
  .mesh-annbell .mesh-bell-btn{ font:inherit; }
  .mesh-annbell-count{
    position:absolute; top:-5px; right:-5px; min-width:19px; height:19px; padding:0 5px; box-sizing:border-box;
    border-radius:99px; background:#d4372c; color:#fff; font-size:11px; font-weight:700; line-height:16px; text-align:center;
    border:1.5px solid #fff;
  }
  .mesh-annbell-panel{
    position:absolute; top:calc(100% + 10px); right:0; width:400px; max-height:70vh; overflow-y:auto;
    background:#fff; border:1px solid #e3e4f0; border-radius:14px; box-shadow:0 18px 44px rgba(28,25,52,.2);
    z-index:1100; text-align:left; font-family:'Figtree', Helvetica, sans-serif;
  }
  .mesh-annbell-panel[hidden]{ display:none; }
  .mesh-annbell-head{ display:flex; align-items:center; gap:10px; padding:14px 18px; border-bottom:1px solid #e9ecf5; }
  .mesh-annbell-title{ font-size:15.5px; font-weight:700; color:#1c1934; }
  .mesh-annbell-new{ padding:2px 9px; border-radius:99px; background:#d4372c; color:#fff; font-size:11.5px; font-weight:700; }
  .mesh-annbell-markall{ margin-left:auto; border:0; background:none; padding:6px 0; font-size:12.5px; font-weight:600; color:var(--mesh-accent,#3730a3); cursor:pointer; }
  .mesh-annbell-item{
    display:flex; gap:12px; align-items:flex-start; width:100%; padding:13px 18px; border:0;
    border-bottom:1px solid #f0f2f8; background:#fff; text-align:left; font:inherit; color:#1c1934; cursor:pointer;
  }
  .mesh-annbell-item:hover{ background:#f5f7fd; }
  .mesh-annbell-item.is-unread{ background:#f5f8fe; }
  .mesh-annbell-dot{ width:8px; height:8px; flex-shrink:0; margin-top:7px; border-radius:50%; background:transparent; }
  .mesh-annbell-item.is-unread .mesh-annbell-dot{ background:#d4372c; }
  .mesh-annbell-text{ flex:1; min-width:0; display:flex; flex-direction:column; gap:4px; }
  .mesh-annbell-meta{ display:flex; align-items:center; gap:6px; flex-wrap:wrap; }
  .mesh-annbell-meta .mesh-badge{ padding:3px 8px; font-size:10px; }
  .mesh-annbell-date{ font-size:11.5px; color:var(--mesh-faint,#949dbc); }
  .mesh-annbell-item-title{ font-size:14px; font-weight:500; line-height:1.35; }
  .mesh-annbell-item.is-unread .mesh-annbell-item-title{ font-weight:700; }
  .mesh-annbell-preview{ font-size:12.5px; color:var(--mesh-muted,#5b6188); line-height:1.45; }
  .mesh-annbell-thumb{ width:56px; height:56px; flex-shrink:0; border-radius:8px; object-fit:cover; background:#eef1f8; }
  .mesh-annbell-empty{ padding:24px 18px; font-size:13.5px; color:var(--mesh-muted,#5b6188); text-align:center; }
  .mesh-annbell-foot{ display:flex; align-items:center; gap:12px; padding:12px 18px; }
  .mesh-annbell-foot form{ margin:0; }
  .mesh-annbell-link{ border:0; background:none; padding:6px 0; font-size:12.5px; font-weight:600; color:var(--mesh-muted,#5b6188); cursor:pointer; }
  .mesh-annbell-link:hover{ color:var(--mesh-accent,#3730a3); }
  .mesh-annbell-foot .mesh-view-all{ margin-left:auto; }
  @media (max-width: 576px){
    .mesh-annbell-panel{ position:fixed; top:100px; left:12px; right:12px; width:auto; }
  }
</style>

<div class="mesh-annbell" id="meshAnnBell">
  <button type="button" class="mesh-bell-btn" id="meshAnnBellBtn" aria-label="Announcements" aria-expanded="false" aria-controls="meshAnnBellPanel">
    <i class="bi bi-bell"></i>
    <span class="mesh-annbell-count" id="meshAnnBellCount" hidden>0</span>
  </button>

  <div class="mesh-annbell-panel" id="meshAnnBellPanel" hidden>
    <div class="mesh-annbell-head">
      <span class="mesh-annbell-title">Announcements</span>
      <span class="mesh-annbell-new" id="meshAnnBellNew" hidden></span>
      <button type="button" class="mesh-annbell-markall" id="meshAnnBellMarkAll" hidden>Mark all as read</button>
    </div>

    @if ($meshBellAnnouncements->count())
      <div>
        @foreach ($meshBellAnnouncements as $announcement)
          @php $icons = json_decode($announcement->announcement_icon, true) ?: []; @endphp
          <button type="button" class="mesh-annbell-item"
                  data-ann-id="{{ $announcement->id }}"
                  data-ann-created="{{ optional($announcement->created_at)->timestamp ?? 0 }}"
                  data-bs-toggle="modal" data-bs-target="#meshBellAnnModal{{ $announcement->id }}">
            <span class="mesh-annbell-dot" aria-hidden="true"></span>
            <span class="mesh-annbell-text">
              <span class="mesh-annbell-meta">
                @foreach ($icons as $icon)
                  @if (isset($meshBellBadges[$icon]))
                    <span class="mesh-badge {{ $meshBellBadges[$icon]['class'] }}">{{ $meshBellBadges[$icon]['label'] }}</span>
                  @endif
                @endforeach
                <span class="mesh-annbell-date">{{ $announcement->announcement_date }}</span>
              </span>
              <span class="mesh-annbell-item-title">{{ $announcement->announcement_title }}</span>
              @if (!empty($announcement->announcement_content))
                <span class="mesh-annbell-preview">{{ \Illuminate\Support\Str::limit(strip_tags($announcement->announcement_content), 90) }}</span>
              @endif
            </span>
            @if ($announcement->announcement_file_path)
              <img class="mesh-annbell-thumb" src="{{ asset($announcement->announcement_file_path) }}" alt="">
            @endif
          </button>
        @endforeach
      </div>
    @else
      <div class="mesh-annbell-empty">There are currently no announcements.</div>
    @endif

    <div class="mesh-annbell-foot">
      {{-- Same subscribe/unsubscribe form the old homepage had in its Announcements section --}}
      <form method="POST" action="{{ route('subscribeannouncement') }}">
        @csrf
        @if (!$meshBellSubscription || ($meshBellSubscription && !$meshBellSubscription->notification))
          <button type="submit" class="mesh-annbell-link" title="Click to receive notification in email"><i class="bi bi-envelope"></i> Email me new announcements</button>
        @else
          <button type="submit" formaction="{{ route('unsubscribeannouncement') }}" class="mesh-annbell-link" title="Click to disable receiving notification in email"><i class="bi bi-envelope"></i> Stop email notifications</button>
        @endif
      </form>
      <a href="{{ route('announcement.announcementindex') }}" class="mesh-view-all">View all <i class="bi bi-arrow-right"></i></a>
    </div>
  </div>
</div>
