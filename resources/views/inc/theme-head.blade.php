{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode, <head> part (Oct 2026). Include this as the LAST thing before </head> in a layout --}}
{{-- (currently layouts/app-all.blade.php and layouts/app-pdms.blade.php). --}}
{{-- 1. Applies the saved choice (localStorage 'mesh-theme') before the page body paints, so it doesn't flash light first. --}}
{{--    Default is light; dark only turns on after the user picks it with the sun/moon switch (inc/theme-toggle.blade.php). --}}
{{-- 2. Loads public/css/mesh-dark.css last, so its dark styles win over Bootstrap, admin.css and the plugins loaded above. --}}
{{-- Dark styles only apply on pages whose <body> has the mesh-dark-ready class (every page, unless it declares --}}
{{-- @section('mesh_dark_off')). --}}
<script>
  try {
    if (window.localStorage && localStorage.getItem('mesh-theme') === 'dark') {
      document.documentElement.setAttribute('data-mesh-theme', 'dark');
    }
  } catch (e) {}
</script>
<link href="{{ asset('css/mesh-dark.css') }}?v={{ filemtime(public_path('css/mesh-dark.css')) }}" rel="stylesheet">
{{-- #================================ --}}
