{{-- #========== NEWLY ADDED ============ --}}
{{-- English / Malay switch, <head> part (Oct 2026). Included at the end of <head> in layouts/app-all.blade.php and --}}
{{-- layouts/app-pdms.blade.php, after inc/theme-head. If the user picked BM, the page is kept hidden for a moment until --}}
{{-- public/js/mesh-lang.js has swapped the text, so it doesn't flash English first. Shown anyway after 1.5 s in case --}}
{{-- mesh-lang.js fails to load. --}}
<style>html.mesh-lang-pending body{ visibility:hidden; }</style>
{{-- #============= ORI CODE ============== --}}
{{-- <script> --}}
{{--   try { --}}
{{--     if (window.localStorage && localStorage.getItem('mesh-lang') === 'ms') { --}}
{{--       document.documentElement.setAttribute('lang', 'ms'); --}}
{{--       document.documentElement.classList.add('mesh-lang-pending'); --}}
{{--       setTimeout(function () { document.documentElement.classList.remove('mesh-lang-pending'); }, 1500); --}}
{{--     } --}}
{{--   } catch (e) {} --}}
{{-- </script> --}}
{{-- #================================ --}}
{{-- EN now translates too (Malay pages into English), so the page is held back briefly in both languages. --}}
<script>
  (function () {
    var lang = 'en';
    try { if (window.localStorage && localStorage.getItem('mesh-lang') === 'ms') { lang = 'ms'; } } catch (e) {}
    document.documentElement.setAttribute('lang', lang);
    document.documentElement.classList.add('mesh-lang-pending');
    setTimeout(function () { document.documentElement.classList.remove('mesh-lang-pending'); }, 1500);
  })();
</script>
{{-- #================================ --}}
{{-- #================================ --}}
