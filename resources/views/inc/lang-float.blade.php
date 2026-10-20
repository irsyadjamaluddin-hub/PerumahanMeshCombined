{{-- #========== NEWLY ADDED ============ --}}
{{-- English / Malay switch for layouts that have no MESH v4 header (layouts/app, app2, app3, hrs/layouts/app, --}}
{{-- hrs/layouts/app-minimal). Same buttons as inc/lang-toggle.blade.php, floating at the bottom left so it stays clear --}}
{{-- of the Smart Bot button (bottom right). Styled here because these layouts don't all load public/css/mesh-v4.css. --}}
{{-- Needs public/js/mesh-lang.js loaded after it (end of <body>). --}}
<style>
  .mesh-lang-float { position: fixed; left: 16px; bottom: 16px; z-index: 1040; }
  .mesh-lang-float .mesh-lang-toggle { display: flex; gap: 2px; padding: 3px; background: #ffffff; border: 1px solid #e3e6f0; border-radius: 12px; box-shadow: 0 4px 14px rgba(15, 23, 42, .12); }
  .mesh-lang-float .mesh-lang-toggle button { height: 30px; min-width: 34px; padding: 0 8px; border: 0; border-radius: 9px; background: none; color: #5b6275; font: 600 12px/1 system-ui, -apple-system, "Segoe UI", sans-serif; letter-spacing: .04em; cursor: pointer; }
  .mesh-lang-float .mesh-lang-toggle button:hover { background: #f2f3fa; color: #1c1934; }
  .mesh-lang-float .mesh-lang-toggle button[aria-pressed="true"] { background: #3730a3; color: #ffffff; }
  @media print { .mesh-lang-float { display: none; } }
</style>
<div class="mesh-lang-float">
  @include('inc.lang-toggle')
</div>
{{-- #================================ --}}
