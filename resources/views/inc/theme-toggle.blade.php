{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode, sun/moon switch (Oct 2026). Included in the header of layouts/app-all.blade.php and --}}
{{-- layouts/app-pdms.blade.php, just left of the announcements bell, so it is on every page that uses those layouts. --}}
{{-- Sun shows in light mode, moon in dark mode (styles: "Dark mode" section of public/css/mesh-v4.css). --}}
{{-- Click handler + saving the choice: public/js/mesh-v4.js. Hidden on pages that declare @section('mesh_dark_off'). --}}
@sectionMissing('mesh_dark_off')
  <button type="button" class="mesh-bell-btn mesh-theme-btn" id="meshThemeToggle" aria-label="Switch to dark mode" aria-pressed="false" title="Switch to dark mode">
    <i class="bi bi-sun mesh-theme-sun"></i>
    <i class="bi bi-moon-stars mesh-theme-moon"></i>
  </button>
@endif
{{-- #================================ --}}
