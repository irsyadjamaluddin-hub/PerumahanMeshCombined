{{-- #========== NEWLY ADDED ============ --}}
{{-- EN/BM + sun/moon for the standalone forms (Oct 2026), placed on the right of the row with the back button, --}}
{{-- above the form card. Styles: inc/standalone-theme-head.blade.php. EN/BM is translated by public/js/mesh-lang.js --}}
{{-- (loaded at the end of each form's <body>). The sun/moon saves the same choice as the switch on app-all pages. --}}
<div class="mesh-sa-switches">
  @include('inc.lang-toggle')
  <button type="button" class="mesh-sa-theme" id="meshSaTheme" aria-label="Switch to dark mode" title="Switch to dark mode">
    <svg class="mesh-sa-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
    <svg class="mesh-sa-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
  </button>
</div>
<script>
  (function () {
    var root = document.documentElement, btn = document.getElementById('meshSaTheme');
    function label() {
      var t = root.getAttribute('data-mesh-theme') === 'dark' ? 'Switch to light mode' : 'Switch to dark mode';
      btn.setAttribute('aria-label', t); btn.setAttribute('title', t);
    }
    btn.addEventListener('click', function () {
      var dark = root.getAttribute('data-mesh-theme') !== 'dark';
      if (dark) { root.setAttribute('data-mesh-theme', 'dark'); } else { root.removeAttribute('data-mesh-theme'); }
      try { if (window.localStorage) { localStorage.setItem('mesh-theme', dark ? 'dark' : 'light'); } } catch (e) {}
      label();
    });
    label();
  })();
</script>
{{-- #================================ --}}
