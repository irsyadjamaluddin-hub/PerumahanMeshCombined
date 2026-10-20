{{-- =============== NISAH =============== --}}
{{-- Homepage greeting card + all homepage styles, moved out of home.blade.php (29 Sept 2026) so the MESH Home --}}
{{-- (home.blade.php) and PDMS Home (pdmshome.blade.php) show exactly the same thing. Change it here, not in the pages. --}}
{{-- =============================================== --}}
  <?php
    /* =============== NISAH =============== */
    // Fix: "Good evening / Selamat malam" was showing from 4 PM. Petang now runs until 6:59 PM, malam from 7 PM.
    // Also picks a sun/moon icon (Bootstrap Icons) for the eyebrow line.
    $homeHour = now()->hour;
    if ($homeHour < 12) {
        $homeGreeting = 'Good morning';
        $homeGreetingMy = 'Selamat pagi';
        $homeGreetingIcon = 'bi-sunrise';
    } elseif ($homeHour < 19) {
        $homeGreeting = 'Good afternoon';
        $homeGreetingMy = 'Selamat petang';
        $homeGreetingIcon = 'bi-sun';
    } else {
        $homeGreeting = 'Good evening';
        $homeGreetingMy = 'Selamat malam';
        $homeGreetingIcon = 'bi-moon-stars';
    }
    /* =============================================== */

    /* =============== NISAH =============== */
    // Greeting banner (Option A) shows the user's jabatan + bahagian; either is simply hidden when not set
    $homeUser = Auth::user();
    $homeJabatan = $homeUser->department_id
        ? optional(\App\Models\Department::find($homeUser->department_id))->label
        : null;
    // bahagian_id is saved from dropdowns keyed by code (Bahagian::pluck('label','code')), so try code first, then id
    $homeBahagian = $homeUser->bahagian_id
        ? (\App\Models\Bahagian::where('code', $homeUser->bahagian_id)->value('label')
            ?? optional(\App\Models\Bahagian::find($homeUser->bahagian_id))->label)
        : null;
    /* =============================================== */
  ?>

    <style>
      /* =============== NISAH =============== */
      /* "Proposed B": the original three-line layout, jabatan + bahagian in place of "Welcome to MESH",
         indigo gradient with moving gold + white particles (particles.js, same library as the sidebar) */
      .home-greet{
        position:relative; overflow:hidden; border-radius:20px; color:#fff; padding:28px 32px; margin-bottom:28px;
        background:
          radial-gradient(520px 260px at 100% 0%, rgba(242,194,69,.16), transparent 60%),
          linear-gradient(120deg, #1f1c55, var(--mesh-sidebar-2,#312e81) 70%);
      }
      .home-greet-particles{
        position:absolute; inset:0; z-index:0; pointer-events:none;
        /* fade the particles out towards the text on the left so the name stays easy to read */
        -webkit-mask-image:linear-gradient(90deg, rgba(0,0,0,.3) 0%, #000 55%); mask-image:linear-gradient(90deg, rgba(0,0,0,.3) 0%, #000 55%);
      }
      .home-greet-particles canvas{ display:block; }
      .home-greet-main{ position:relative; z-index:1; display:flex; flex-direction:column; gap:6px; }
      .home-greet-eyebrow{
        display:inline-flex; align-items:center; gap:7px;
        font-size:12px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--mesh-yellow,#f2c245);
      }
      .home-greet-eyebrow i{ font-size:14px; line-height:1; }
      .home-greet-title{
        margin:0; font-family:'Figtree', Helvetica, sans-serif; font-weight:700; line-height:1.12; letter-spacing:-.015em;
        font-size:clamp(26px, 3.2vw, 36px); color:#fff; overflow-wrap:anywhere; text-wrap:balance;
      }
      .home-greet-title em{ font-style:normal; color:var(--mesh-yellow,#f2c245); }
      .home-greet-sub{ margin:4px 0 0; display:flex; align-items:center; flex-wrap:wrap; gap:4px 8px; font-size:15.5px; color:rgba(255,255,255,.85); }
      .home-greet-sub i{ color:var(--mesh-yellow,#f2c245); font-size:15px; line-height:1; }
      .home-greet-sub-sep{ color:rgba(255,255,255,.45); }
      .home-greet-sub-bhg{ color:rgba(255,255,255,.7); }
      @media (max-width:760px){
        .home-greet{ padding:22px 20px; }
      }
      /* =============================================== */

      .home-svc-head{ display:flex; align-items:center; gap:16px; flex-wrap:wrap; margin-bottom:18px; }
      .home-svc-title{ margin:0; font-size:20px; font-weight:700; color:#1c1934; }
      .home-svc-head .svc-search-wrap{ margin:0 0 0 auto; flex:1 1 260px; }

      /* ======= Services — copied from servicesdashboard.blade.php (svc- prefixed so it can't clash with
         admin.css's bare .card/.grid rules used everywhere else in the app) ======= */
      .svc-search-wrap{ position:relative; max-width:420px; margin:0 0 16px auto; }
      .svc-search-wrap input{
        width:100%; padding:11px 14px 11px 40px; border-radius:10px;
        border:1px solid #e6e9f2; background:#fff; font-size:14px; color:#1c1934;
        outline:none; transition:border-color .15s ease, box-shadow .15s ease;
      }
      .svc-search-wrap input:focus{ border-color:#1e40af; box-shadow:0 0 0 3px rgba(30,64,175,.1); }
      .svc-search-wrap svg{ position:absolute; left:13px; top:50%; transform:translateY(-50%); width:16px; height:16px; stroke:#5b6188; pointer-events:none; }

      .svc-dashboard{ margin-top:6px; }
      .svc-category{ margin-bottom:34px; }
      .svc-cat-head{
        display:flex; align-items:center; gap:10px;
        margin-bottom:16px; padding-left:13px; border-left:3px solid var(--svc-accent,#4154f1);
      }
      .svc-cat-head > i{ color:var(--svc-accent,#4154f1); font-size:18px; }
      .svc-cat-title{
        font-size:14px; font-weight:700; letter-spacing:.03em; text-transform:uppercase; color:#1c1934;
      }

      .svc-grid{ display:grid; grid-template-columns:repeat(auto-fill, minmax(260px, 1fr)); gap:14px; }

      .svc-card{
        position:relative; background:#fff; border:1px solid #e6e9f2; border-radius:13px; padding:16px;
        display:flex; flex-direction:column; gap:10px; text-decoration:none; color:inherit;
        box-shadow:0 1px 3px rgba(30,64,175,.06);
        transition:box-shadow .15s ease, transform .12s ease;
      }
      .svc-card:hover{ box-shadow:0 10px 26px rgba(30,64,175,.18); transform:translateY(-2px); color:inherit; text-decoration:none; }
      .svc-card-icon{
        width:38px; height:38px; border-radius:10px; background:var(--svc-accent,#4154f1); color:#fff;
        display:flex; align-items:center; justify-content:center; font-size:17px;
      }
      .svc-card-title{ font-size:15.5px; font-weight:700; color:#1c1934; }
      .svc-card-sub{ font-size:12.5px; color:#5b6188; margin-top:-6px; }
      .svc-card-desc{ font-size:12.5px; color:#5b6188; line-height:1.55; flex:1; }
      .svc-cta{
        align-self:flex-start; font-size:12.5px; font-weight:600; color:var(--svc-accent,#4154f1);
        background:var(--svc-tint,#eef0fb); padding:6px 14px; border-radius:8px;
      }
      /* homepage-only: pending E-Memo action count on the D Flow card */
      .home-svc-badge{
        position:absolute; top:16px; right:16px; padding:3px 10px; border-radius:99px;
        background:var(--mesh-yellow,#f2c245); color:#1c1934; font-size:12px; font-weight:700;
      }

      /* coming-soon / access-required disabled state, same tooltip mechanic as before */
      .svc-card--disabled{ opacity:.6; cursor:not-allowed; box-shadow:none; }
      .svc-card--disabled:hover{ transform:none; box-shadow:none; }
      .svc-card-tooltip{
        position:absolute; top:10px; right:10px; background:#fff; color:#1c1934; padding:5px 12px;
        border-radius:4px; font-size:12.5px; white-space:nowrap; opacity:0; visibility:hidden;
        transition:opacity .2s ease; pointer-events:none; z-index:5; box-shadow:0 2px 8px rgba(0,0,0,.15);
        border:1px solid #f0f0f0;
      }
      .svc-card--disabled:hover .svc-card-tooltip{ opacity:1; visibility:visible; }

      /* filtered-out state used by the search box below */
      .svc-card[hidden], .svc-category[hidden]{ display:none; }

      .coming-soon-card{ position:relative; }
      .custom-tooltip{
        position:absolute; background-color:white; color:red; padding:5px 12px; border-radius:4px; font-size:14px;
        white-space:nowrap; opacity:0; visibility:hidden; transition:opacity 0.3s; pointer-events:none; z-index:1000;
        top:10px; right:10px; box-shadow:0 2px 8px rgba(0,0,0,0.15); border:1px solid #f0f0f0;
      }
      .coming-soon-card:hover .custom-tooltip{ opacity:1; visibility:visible; }
    </style>

    {{-- ================= Greeting ================= --}}
    {{-- =============== NISAH =============== --}}
    {{-- "Proposed B" greeting with option 14 (gold + white particles): same three lines as the original card, --}}
    {{-- "Welcome to MESH" replaced by the user's jabatan · bahagian (the whole line is hidden if neither is set) --}}
    <section class="home-greet">
      <div id="home-greet-particles" class="home-greet-particles" aria-hidden="true"></div>
      <div class="home-greet-main">
        <span class="home-greet-eyebrow"><i class="bi {{ $homeGreetingIcon }}"></i>{{ $homeGreetingMy }} &middot; {{ now()->format('l, j F Y') }}</span>
        <h1 class="home-greet-title">{{ $homeGreeting }}, <em>{{ $homeUser->name }}</em></h1>
        @if($homeJabatan || $homeBahagian)
        <p class="home-greet-sub">
          <i class="bi bi-building"></i>
          @if($homeJabatan)<span>{{ $homeJabatan }}</span>@endif
          @if($homeJabatan && $homeBahagian)<span class="home-greet-sub-sep">&middot;</span>@endif
          @if($homeBahagian)<span class="home-greet-sub-bhg">{{ $homeBahagian }}</span>@endif
        </p>
        @endif
      </div>
    </section>
    <script>
      // Gold + white particles behind the greeting. particles.min.js is loaded at the bottom of layouts/app-all.blade.php
      // (after this content), so wait for DOMContentLoaded. Same settings as the sidebar in public/js/mesh-v4.js,
      // with gold/white dots and gold lines. Motion is turned off for users who prefer reduced motion.
      document.addEventListener('DOMContentLoaded', function () {
        if (!window.particlesJS || !document.getElementById('home-greet-particles')) return;
        var still = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        window.particlesJS('home-greet-particles', {
          particles: {
            number: { value: 160, density: { enable: true, value_area: 800 } }, // "Dense": raised from 60 (scaled by card size)
            color: { value: ['#f2c245', '#ffffff'] },
            shape: { type: 'circle', stroke: { width: 0, color: '#000000' }, polygon: { nb_sides: 5 } },
            opacity: { value: 0.7, random: false, anim: { enable: false, speed: 1, opacity_min: 0.1, sync: false } },
            size: { value: 3, random: true, anim: { enable: false, speed: 40, size_min: 0.1, sync: false } },
            line_linked: { enable: true, distance: 120, color: '#f2c245', opacity: 0.35, width: 1 },
            move: { enable: !still, speed: 2, direction: 'none', random: false, straight: false, out_mode: 'out', bounce: false, attract: { enable: false, rotateX: 600, rotateY: 1200 } }
          },
          interactivity: {
            detect_on: 'canvas',
            events: { onhover: { enable: false }, onclick: { enable: false }, resize: true },
            modes: {}
          },
          retina_detect: true
        });
      });
    </script>
    {{-- =============================================== --}}
