{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode + English/Malay for the standalone forms that don't use app-all (Oct 2026): --}}
{{-- slipkedatangan-new (/sk), support_center/create-new (/dsd), devopsrequest/drf-create-new (/drf), permohonanrole. --}}
{{-- Include as the LAST thing before </head>. Applies the saved sun/moon choice (localStorage 'mesh-theme', the same --}}
{{-- one app-all uses) before the page paints, holds the page for a moment while mesh-lang.js translates (inc/lang-head), --}}
{{-- and styles the switches from inc/standalone-switches.blade.php. Each form has its own dark styles. --}}
<script>
  try {
    if (window.localStorage && localStorage.getItem('mesh-theme') === 'dark') {
      document.documentElement.setAttribute('data-mesh-theme', 'dark');
    }
  } catch (e) {}
</script>
@include('inc.lang-head')
<link href="https://fonts.googleapis.com/css2?family=Figtree:wght@600;700&display=swap" rel="stylesheet">
<style>
  /* EN/BM + sun/moon, same look as the header buttons on the other MESH pages */
  .mesh-sa-switches { margin-left: auto; display: flex; align-items: center; gap: 10px; }
  .mesh-sa-switches .mesh-lang-toggle { display: flex; align-items: center; gap: 2px; height: 40px; padding: 3px; border: 1px solid #e3e4f0; border-radius: 12px; background: #ffffff; box-sizing: border-box; }
  .mesh-sa-switches .mesh-lang-toggle button { height: 32px; min-width: 34px; width: auto; padding: 0 8px; border: 0; border-radius: 9px; background: none; cursor: pointer; font: 700 12px/1 "Figtree", system-ui, sans-serif; letter-spacing: .06em; color: #5b6188; }
  .mesh-sa-switches .mesh-lang-toggle button[aria-pressed="true"] { background: #3730a3; color: #ffffff; }
  .mesh-sa-theme { width: 40px; height: 40px; border-radius: 12px; border: 1px solid #e3e4f0; background: #ffffff; color: #5b6188; display: grid; place-items: center; cursor: pointer; padding: 0; box-sizing: border-box; }
  .mesh-sa-theme svg { width: 18px; height: 18px; }
  .mesh-sa-switches button:focus-visible { outline: 2px solid #f59e0b; outline-offset: 2px; }
  .mesh-sa-moon { display: none; }
  html[data-mesh-theme="dark"] .mesh-sa-sun { display: none; }
  html[data-mesh-theme="dark"] .mesh-sa-moon { display: block; }
  html[data-mesh-theme="dark"] .mesh-sa-switches .mesh-lang-toggle,
  html[data-mesh-theme="dark"] .mesh-sa-theme { background: transparent; border-color: #3a2768; color: #b8bfd6; }
  html[data-mesh-theme="dark"] .mesh-sa-switches .mesh-lang-toggle button { color: #b8bfd6; }
  html[data-mesh-theme="dark"] .mesh-sa-switches .mesh-lang-toggle button[aria-pressed="true"] { background: rgba(243, 195, 95, .16); color: #f3c35f; }
</style>
{{-- #================================ --}}
