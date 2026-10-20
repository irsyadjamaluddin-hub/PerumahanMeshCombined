{{-- #========== NEWLY ADDED ============ --}}
{{-- English / Malay switch (Oct 2026). Included in the header of layouts/app-all.blade.php and layouts/app-pdms.blade.php, --}}
{{-- left of the sun/moon switch. The translating is done in the browser by public/js/mesh-lang.js (word list inside it); --}}
{{-- the choice is saved in localStorage 'mesh-lang'. Styles: "Language switch" section of public/css/mesh-v4.css. --}}
<div class="mesh-lang-toggle" role="group" aria-label="Language">
  <button type="button" data-mesh-lang="en" aria-pressed="true" title="English">EN</button>
  <button type="button" data-mesh-lang="ms" aria-pressed="false" title="Bahasa Melayu">BM</button>
</div>
{{-- #================================ --}}
