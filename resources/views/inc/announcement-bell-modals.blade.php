{{-- =============== NISAH =============== --}}
{{-- Announcement popups + script for the header bell (inc/announcement-bell.blade.php). Included once by --}}
{{-- layouts/app-all.blade.php at <body> level, just before mesh-v4.js, so the bell works on every page (Sept 2026). --}}
{{-- Popup IDs use a meshBellAnnModal prefix so they never clash with the announcementModal IDs other pages already use. --}}
{{-- =============================================== --}}
@foreach ($meshBellAnnouncements as $announcement)
  @php
    $icons = json_decode($announcement->announcement_icon, true) ?: [];
    // Linkify URLs before nl2br (not after) — running nl2br first lets
    // the URL-matching regex's \S+ swallow an adjacent injected <br />
    // tag straight into the href, producing malformed HTML whenever a
    // URL is immediately followed by a blank line.
    $contentWithLinks = nl2br(preg_replace(
        '/\b(?:https?:\/\/|www\.)\S+\b/',
        '<a href="$0" target="_blank">$0</a>',
        e($announcement->announcement_content)
    ));
  @endphp
  <div class="modal fade mesh-modal" id="meshBellAnnModal{{ $announcement->id }}" tabindex="-1" aria-labelledby="meshBellAnnModalLabel{{ $announcement->id }}" aria-hidden="true">
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
          <h1 class="mesh-modal-title" id="meshBellAnnModalLabel{{ $announcement->id }}" style="font-size:30px; margin-top:8px;">{{ $announcement->announcement_title }}</h1>
          <div style="height:1px; background:#dfe1ee; margin:18px 0;"></div>
          <div class="mesh-modal-content-text" style="max-width:66ch;">{!! $contentWithLinks !!}</div>

          @if ($announcement->announcement_file_path)
            <button type="button" class="mesh-detail-poster-inline mesh-lightbox-trigger" title="View poster"
                    data-lightbox-src="{{ asset($announcement->announcement_file_path) }}"
                    data-lightbox-title="{{ $announcement->announcement_title }}"
                    data-lightbox-meta="{{ $announcement->announcement_date }}">
              <img src="{{ asset($announcement->announcement_file_path) }}" alt="{{ $announcement->announcement_title }}">
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
              <a href="{{ asset($filePath) }}" target="_blank" class="mesh-pill-btn">
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

<template id="meshBellLightboxTpl">
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
</template>

<script>
(function () {
  // "View poster" needs the shared lightbox. Some pages (announcements, news, admin home) already have one —
  // only add it where it's missing, so mesh-v4.js (which loads right after this) never finds two.
  if (!document.querySelector('.mesh-lightbox')) {
    var tpl = document.getElementById('meshBellLightboxTpl');
    if (tpl) document.body.appendChild(tpl.content.cloneNode(true));
  }

  // Header bell: dropdown + unread count.
  // "Read" state is kept per user in this browser (localStorage) — no database change needed.
  // An announcement counts as new if this user hasn't opened it yet and it was posted in the last 30 days.
  var bell = document.getElementById('meshAnnBell');
  if (!bell) return;
  var btn = document.getElementById('meshAnnBellBtn');
  var panel = document.getElementById('meshAnnBellPanel');
  var countEl = document.getElementById('meshAnnBellCount');
  var newEl = document.getElementById('meshAnnBellNew');
  var markAllBtn = document.getElementById('meshAnnBellMarkAll');
  var items = Array.prototype.slice.call(panel.querySelectorAll('.mesh-annbell-item'));
  var KEY = 'meshReadAnnouncements:{{ Auth::id() }}';
  var NEW_WITHIN_MS = 30 * 24 * 60 * 60 * 1000;

  function loadRead() {
    try { return JSON.parse(localStorage.getItem(KEY)) || []; } catch (e) { return []; }
  }
  function saveRead(ids) {
    try { localStorage.setItem(KEY, JSON.stringify(ids.slice(-100))); } catch (e) {}
  }
  function markRead(ids) {
    var read = loadRead();
    ids.forEach(function (id) { if (read.indexOf(id) === -1) read.push(id); });
    saveRead(read);
    refresh();
  }
  function refresh() {
    var read = loadRead();
    var now = Date.now();
    var unread = 0;
    items.forEach(function (item) {
      var created = (parseInt(item.getAttribute('data-ann-created'), 10) || 0) * 1000;
      var isNew = read.indexOf(item.getAttribute('data-ann-id')) === -1 && (now - created) < NEW_WITHIN_MS;
      item.classList.toggle('is-unread', isNew);
      if (isNew) unread++;
    });
    countEl.textContent = unread;
    countEl.hidden = unread === 0;
    newEl.textContent = unread + ' new';
    newEl.hidden = unread === 0;
    markAllBtn.hidden = unread === 0;
    btn.setAttribute('aria-label', unread ? 'Announcements, ' + unread + ' new' : 'Announcements');
  }
  function setOpen(open) {
    panel.hidden = !open;
    btn.setAttribute('aria-expanded', open ? 'true' : 'false');
  }

  btn.addEventListener('click', function (e) {
    e.stopPropagation();
    setOpen(panel.hidden);
  });
  document.addEventListener('click', function (e) {
    if (!bell.contains(e.target)) setOpen(false);
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') setOpen(false);
  });
  items.forEach(function (item) {
    item.addEventListener('click', function () {
      markRead([item.getAttribute('data-ann-id')]);
      setOpen(false);
    });
  });
  markAllBtn.addEventListener('click', function (e) {
    e.stopPropagation();
    markRead(items.map(function (item) { return item.getAttribute('data-ann-id'); }));
  });
  // Another tab marked something read — keep this tab's count in step
  window.addEventListener('storage', function (e) { if (e.key === KEY) refresh(); });

  refresh();
})();
</script>
