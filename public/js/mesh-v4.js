/* ==========================================================================
   MESH v4 visual redesign — sidebar collapse + poster lightbox.
   Fully additive: does not touch the existing `.toggle-sidebar-btn` /
   `body.toggle-sidebar` mechanism in assets/js/main.js — uses its own
   button id + body class so the two systems can never collide.
   Every selector is guarded so this script is a no-op on pages that don't
   have these elements (same defensive pattern as assets/js/main.js).
   ========================================================================== */
(function ($) {
  'use strict';

  var STORAGE_KEY = 'mesh-sidebar-collapsed';

  $(function () {

    // #============= ORI CODE ==============
    // =============== NISAH ===============
    // ---------------- Light/dark mode switch (Oct 2026) ----------------
    // Button only exists on pages that declare @section('mesh_dark_ready') (see layouts/app-all.blade.php).
    // The saved choice is applied in the layout <head> before paint; this just flips it and remembers it.
    // Default is light: dark mode only turns on when the user picks it.
    // (closing line of this block was: =====================================)
    // #================================
    // ---------------- Light/dark mode switch (Oct 2026) ----------------
    // Button comes from resources/views/inc/theme-toggle.blade.php (header of layouts/app-all and app-pdms;
    // missing on pages that declare @section('mesh_dark_off')). The saved choice is applied before paint by
    // resources/views/inc/theme-head.blade.php; this just flips it and remembers it (localStorage 'mesh-theme').
    // Default is light: dark mode only turns on when the user picks it.
    var $themeBtn = $('#meshThemeToggle');
    if ($themeBtn.length) {
      var root = document.documentElement;
      var syncThemeBtn = function () {
        var dark = root.getAttribute('data-mesh-theme') === 'dark';
        $themeBtn.attr('aria-pressed', dark ? 'true' : 'false')
                 .attr('aria-label', dark ? 'Switch to light mode' : 'Switch to dark mode')
                 .attr('title', dark ? 'Switch to light mode' : 'Switch to dark mode');
      };
      $themeBtn.on('click', function () {
        var next = root.getAttribute('data-mesh-theme') === 'dark' ? 'light' : 'dark';
        if (next === 'dark') { root.setAttribute('data-mesh-theme', 'dark'); }
        else { root.removeAttribute('data-mesh-theme'); }
        try { if (window.localStorage) { window.localStorage.setItem('mesh-theme', next); } } catch (e) { /* ignore */ }
        syncThemeBtn();
      });
      syncThemeBtn();
    }
    // #================================

    // ---------------- Sidebar: desktop collapse/expand vs mobile off-canvas ----------------
    // Below 992px the sidebar is an off-canvas panel (body.mesh-sidebar-mobile-open)
    // instead of the desktop icon-rail/labeled toggle (body.mesh-sidebar-collapsed) —
    // same button, different behavior depending on viewport width.

    var $body = $('body');
    var $toggleBtn = $('#meshSidebarToggle');
    var MOBILE_QUERY = '(max-width: 991.98px)';
    var isMobile = function () {
      return window.matchMedia ? window.matchMedia(MOBILE_QUERY).matches : window.innerWidth < 992;
    };

    if ($toggleBtn.length) {
      // Restore persisted desktop collapse state (mobile panel never persists —
      // it should always start closed on a fresh page load).
      try {
        if (window.localStorage && window.localStorage.getItem(STORAGE_KEY) === '1') {
          $body.addClass('mesh-sidebar-collapsed');
        }
      } catch (e) { /* localStorage unavailable — ignore, default to expanded */ }

      $toggleBtn.on('click', function () {
        if (isMobile()) {
          $body.toggleClass('mesh-sidebar-mobile-open');
          return;
        }
        $body.toggleClass('mesh-sidebar-collapsed');
        hideMeshNavTooltip();
        try {
          if (window.localStorage) {
            window.localStorage.setItem(STORAGE_KEY, $body.hasClass('mesh-sidebar-collapsed') ? '1' : '0');
          }
        } catch (e) { /* ignore */ }
      });

      // Backdrop click / Escape closes the mobile off-canvas panel.
      $(document).on('click', '[data-mesh-sidebar-backdrop]', function () {
        $body.removeClass('mesh-sidebar-mobile-open');
      });
      $(document).on('keydown', function (e) {
        if (e.key === 'Escape') { $body.removeClass('mesh-sidebar-mobile-open'); }
      });

      // Tapping an actual nav link (not a submenu toggle) on mobile should
      // close the panel afterward instead of leaving it covering the page.
      $('.mesh-v4-sidebar').on('click', 'a.mesh-nav-link[href]:not([data-bs-toggle="collapse"])', function () {
        if (isMobile()) { $body.removeClass('mesh-sidebar-mobile-open'); }
      });

      // Collapsed-rail submenu fix (desktop only): a group parent with no
      // real href (data-bs-toggle="collapse") is unreachable once its label
      // text is hidden by the icon-rail CSS. Expand the sidebar first so the
      // submenu it reveals is actually visible, then let Bootstrap's own
      // collapse handler run as normal. Irrelevant on mobile, where the
      // panel already shows full labels whenever it's open.
      $('.mesh-v4-sidebar').on('click', 'a[data-bs-toggle="collapse"]', function () {
        if (!isMobile() && $body.hasClass('mesh-sidebar-collapsed')) {
          $body.removeClass('mesh-sidebar-collapsed');
          try {
            if (window.localStorage) { window.localStorage.setItem(STORAGE_KEY, '0'); }
          } catch (e) { /* ignore */ }
        }
      });

      // If the window is resized/rotated across the breakpoint, drop
      // whichever state belongs to the mode we just left.
      $(window).on('resize', function () {
        if (isMobile()) {
          $body.removeClass('mesh-sidebar-collapsed');
        } else {
          $body.removeClass('mesh-sidebar-mobile-open');
        }
        hideMeshNavTooltip();
      });
    }

    // ---------------- Sidebar: icon-rail tooltips (collapsed mode) ----------------
    // Reveals each icon's label on hover/focus once the rail is collapsed to
    // icons-only. Positioned as a fixed-position element computed from the
    // icon's own bounding box rather than nested inside the sidebar, because
    // .sidebar's overflow-y:auto forces overflow-x to clip too — anything
    // absolutely positioned past the sidebar's right edge would be cut off.

    var $meshTooltip = null;

    function hideMeshNavTooltip() {
      if ($meshTooltip) { $meshTooltip.removeClass('is-visible'); }
    }

    var $meshSidebar = $('.mesh-v4-sidebar');

    if ($meshSidebar.length) {
      $meshTooltip = $('<div class="mesh-nav-tooltip" aria-hidden="true"></div>').appendTo(document.body);

      // Label text = the link's own text minus its icon glyphs, so this
      // stays correct automatically if labels or role-gated items change —
      // nothing to keep in sync by hand.
      $meshSidebar.find('.mesh-nav-link').each(function () {
        var $link = $(this);
        var label = $link.clone().children('i').remove().end().text().replace(/\s+/g, ' ').trim();
        if (label) { $link.attr('data-mesh-label', label); }
      });

      $meshSidebar.on('mouseenter focus', '.mesh-nav-link', function () {
        if (!$body.hasClass('mesh-sidebar-collapsed')) { return; }
        var label = this.getAttribute('data-mesh-label');
        if (!label) { return; }
        var rect = this.getBoundingClientRect();
        $meshTooltip
          .text(label)
          .css({ top: (rect.top + rect.height / 2) + 'px', left: (rect.right + 10) + 'px' })
          .addClass('is-visible');
      });

      $meshSidebar.on('mouseleave blur', '.mesh-nav-link', hideMeshNavTooltip);
      $meshSidebar.on('scroll', hideMeshNavTooltip);
      $meshSidebar.on('click', '.mesh-nav-link', hideMeshNavTooltip);
    }

    // ---------------- Sidebar: full-height particle background ----------------
    // Same particles.js config as welcome-new.blade.php's hero, tuned down
    // for a narrow 266px canvas. No-op if particles.min.js failed to load
    // or the container isn't on the page.

    if (window.particlesJS && document.getElementById('mesh-sidebar-particles')) {
      window.particlesJS('mesh-sidebar-particles', {
        particles: {
          number: { value: 45, density: { enable: true, value_area: 800 } },
          color: { value: '#ffffff' },
          shape: { type: 'circle', stroke: { width: 0, color: '#000000' }, polygon: { nb_sides: 5 } },
          opacity: { value: 0.5, random: false, anim: { enable: false, speed: 1, opacity_min: 0.1, sync: false } },
          size: { value: 3, random: true, anim: { enable: false, speed: 40, size_min: 0.1, sync: false } },
          line_linked: { enable: true, distance: 120, color: '#ffffff', opacity: 0.4, width: 1 },
          move: { enable: true, speed: 2, direction: 'none', random: false, straight: false, out_mode: 'out', bounce: false, attract: { enable: false, rotateX: 600, rotateY: 1200 } }
        },
        interactivity: {
          detect_on: 'canvas',
          events: { onhover: { enable: false }, onclick: { enable: false }, resize: true },
          modes: {}
        },
        retina_detect: true
      });
    }

    // ---------------- Hero carousel: dot + counter sync ----------------
    // Custom dots (not Bootstrap's .carousel-indicators) so we control the
    // visual style outright; Bootstrap's carousel still drives navigation
    // via the standard data-bs-slide-to/data-bs-slide click delegation,
    // we just also need to toggle "active" + update the counter ourselves.

    var $heroCarousel = $('#meshHeroCarousel');

    if ($heroCarousel.length) {
      $heroCarousel.on('slid.bs.carousel', function (e) {
        var activeIndex = $(e.relatedTarget).index();
        var $dots = $heroCarousel.find('[data-mesh-hero-dots] button');
        $dots.removeClass('active').eq(activeIndex).addClass('active');

        var total = $dots.length;
        var pad2 = function (n) { return (n < 10 ? '0' : '') + n; };
        $heroCarousel.find('[data-mesh-hero-count]').text(pad2(activeIndex + 1) + ' / ' + pad2(total));
      });
    }

    // ---------------- Archive page: year-filter dropdown ----------------

    var $yearDropdown = $('[data-mesh-year-dropdown]');

    if ($yearDropdown.length) {
      $(document).on('click', '[data-mesh-year-toggle]', function (e) {
        e.stopPropagation();
        var $panel = $(this).siblings('[data-mesh-year-panel]');
        var willOpen = $panel.prop('hidden');
        $('[data-mesh-year-panel]').prop('hidden', true);
        $panel.prop('hidden', !willOpen);
      });

      $(document).on('click', function (e) {
        if (!$(e.target).closest('[data-mesh-year-dropdown]').length) {
          $('[data-mesh-year-panel]').prop('hidden', true);
        }
      });
    }

    // ---------------- News modal: "Next article" navigation ----------------
    // The button itself already carries data-bs-dismiss="modal" so Bootstrap
    // closes the current modal on click; once it's fully hidden we open the
    // next one so there's never two modal backdrops stacked at once.

    $(document).on('click', '[data-mesh-next-modal]', function () {
      var targetSelector = $(this).data('mesh-next-modal');
      var $currentModal = $(this).closest('.modal');

      $currentModal.one('hidden.bs.modal', function () {
        var target = document.querySelector(targetSelector);
        if (target && window.bootstrap && window.bootstrap.Modal) {
          window.bootstrap.Modal.getOrCreateInstance(target).show();
        }
      });
    });

    // ---------------- News modal: multi-image carousel ----------------
    // Each [data-mesh-carousel] carries its full photo list as a JSON array
    // in data-mesh-gallery; arrows/dots just move an index and repaint the
    // one background-image, so this scales to any photo count with no
    // per-item markup beyond the dots themselves.

    // Arrow/dot clicks must not also open the lightbox — they share the same
    // poster element, since the poster itself is a [data-mesh-carousel-image]
    // AND (below) a .mesh-lightbox-trigger.
    $(document).on('click', '[data-mesh-carousel-prev], [data-mesh-carousel-next]', function (e) {
      e.preventDefault();
      e.stopPropagation();
      var $carousel = $(this).closest('[data-mesh-carousel]');
      var gallery = $carousel.data('mesh-gallery') || [];
      if (gallery.length < 2) { return; }

      var index = $carousel.data('mesh-index') || 0;
      var direction = $(this).is('[data-mesh-carousel-next]') ? 1 : -1;
      index = (index + direction + gallery.length) % gallery.length;

      setMeshCarouselIndex($carousel, index, gallery);
    });

    $(document).on('click', '[data-mesh-carousel-dot]', function (e) {
      e.preventDefault();
      e.stopPropagation();
      var $carousel = $(this).closest('[data-mesh-carousel]');
      var gallery = $carousel.data('mesh-gallery') || [];
      var index = parseInt($(this).data('index'), 10) || 0;

      setMeshCarouselIndex($carousel, index, gallery);
    });

    function setMeshCarouselIndex($carousel, index, gallery) {
      $carousel.data('mesh-index', index);
      var $image = $carousel.find('[data-mesh-carousel-image]');
      $image.css('background-image', 'url("' + gallery[index] + '")');
      // Keep the lightbox trigger's own data in sync so clicking the poster
      // always opens whichever photo the carousel is currently showing.
      $image.data('lightbox-src', gallery[index]).attr('data-lightbox-src', gallery[index]);
      $carousel.find('[data-mesh-carousel-counter]').text((index + 1) + ' / ' + gallery.length);
      $carousel.find('[data-mesh-carousel-dot]').removeClass('active')
        .filter('[data-index="' + index + '"]').addClass('active');
    }

    // ---------------- Poster / image lightbox ----------------

    var $lightbox = $('.mesh-lightbox');

    if ($lightbox.length) {
      // Re-parent to <body> so nothing in its original position in the
      // page (an announcement card, a modal it was opened from, etc.) can
      // ever constrain its position:fixed sizing to less than the full
      // viewport — this is the standard fix for a fixed-position overlay
      // that renders confined to a smaller box instead of full-screen.
      $lightbox.appendTo(document.body);

      var $lightboxImg = $lightbox.find('.mesh-lightbox-image');
      var $lightboxTitle = $lightbox.find('.mesh-lightbox-title');
      var $lightboxMeta = $lightbox.find('.mesh-lightbox-meta');

      $(document).on('click', '.mesh-lightbox-trigger', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var src = $(this).data('lightbox-src');
        if (!src) { return; }
        $lightboxImg.attr('src', src);
        $lightboxTitle.text($(this).data('lightbox-title') || '');
        $lightboxMeta.text($(this).data('lightbox-meta') || '');
        $lightbox.addClass('show');
      });

      $lightbox.on('click', '.mesh-lightbox-close, .mesh-lightbox-backdrop', function () {
        $lightbox.removeClass('show');
      });

      $(document).on('keydown', function (e) {
        if (e.key === 'Escape') { $lightbox.removeClass('show'); }
      });
    }
  });
})(jQuery);
