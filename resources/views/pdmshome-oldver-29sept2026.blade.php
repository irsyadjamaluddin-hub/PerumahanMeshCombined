{{-- OLD VERSION (oldver-29sept2026): copy of resources/views/pdmshome.blade.php taken on 29 Sept 2026, before PDMS Home was changed to show the --}}
{{-- full MESH homepage (greeting + services moved into inc/home-greeting and inc/home-services). Not used by any route. --}}
{{-- =============== NISAH =============== --}}
{{-- NEW PDMS HOMEPAGE (Sept 2026, same "Option C v3" style as home.blade.php): greeting + the user's name, --}}
{{-- then the PDMS services as cards (only the ones the user's PDMS role allows are clickable). --}}
{{-- Announcements are in the header bell (layouts/app-pdms.blade.php -> inc/announcement-bell*.blade.php). --}}
{{-- The previous PDMS homepage is kept as pdmshome-oldver-2025-2026septver.blade.php (rename it back to roll back). --}}
{{-- =============================================== --}}
@extends('layouts.app-pdms')

@section('title', 'MOE MESH - PDMS Home')

@section('content')

  <?php
    // pagename drives the header title in app-pdms.blade.php (same value as the old PDMS home)
    $pagename = " PDMS Home";

    // Time-of-day greeting — same rules as home.blade.php (petang until 6:59 PM, malam from 7 PM)
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

    // Jabatan + bahagian line, same lookup as home.blade.php; either is hidden when not set
    $homeUser = Auth::user();
    $homeJabatan = $homeUser->department_id
        ? optional(\App\Models\Department::find($homeUser->department_id))->label
        : null;
    // bahagian_id is saved from dropdowns keyed by code (Bahagian::pluck('label','code')), so try code first, then id
    $homeBahagian = $homeUser->bahagian_id
        ? (\App\Models\Bahagian::where('code', $homeUser->bahagian_id)->value('label')
            ?? optional(\App\Models\Bahagian::find($homeUser->bahagian_id))->label)
        : null;

    // Same role checks as the PDMS sidebar in layouts/app-pdms.blade.php
    $pdmsCanCuti = $homeUser->hasRole('ROLE_SUPERADMIN') || $homeUser->hasRole('ROLE_PDMS_ADMIN') || $homeUser->hasRole('ROLE_PDMS_CUTI');
    $pdmsCanService = $homeUser->hasRole('ROLE_SUPERADMIN') || $homeUser->hasRole('ROLE_PDMS_ADMIN') || $homeUser->hasRole('ROLE_PDMS_SERVICE');
    $pdmsCanAdmin = $homeUser->hasRole('ROLE_SUPERADMIN') || $homeUser->hasRole('ROLE_PDMS_ADMIN');
  ?>

    <style>
      /* ======= Greeting card — copied from home.blade.php ("Proposed B", gold + white particles) ======= */
      .home-greet{
        position:relative; overflow:hidden; border-radius:20px; color:#fff; padding:28px 32px; margin-bottom:28px;
        background:
          radial-gradient(520px 260px at 100% 0%, rgba(242,194,69,.16), transparent 60%),
          linear-gradient(120deg, #1f1c55, var(--mesh-sidebar-2,#312e81) 70%);
      }
      .home-greet-particles{
        position:absolute; inset:0; z-index:0; pointer-events:none;
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

      .home-svc-head{ display:flex; align-items:center; gap:16px; flex-wrap:wrap; margin-bottom:18px; }
      .home-svc-title{ margin:0; font-size:20px; font-weight:700; color:#1c1934; }

      /* ======= Service cards — same svc- styles as home.blade.php / servicesdashboard.blade.php ======= */
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

      /* access-required disabled state, same tooltip mechanic as home.blade.php */
      .svc-card--disabled{ opacity:.6; cursor:not-allowed; box-shadow:none; }
      .svc-card--disabled:hover{ transform:none; box-shadow:none; }
      .svc-card-tooltip{
        position:absolute; top:10px; right:10px; background:#fff; color:#1c1934; padding:5px 12px;
        border-radius:4px; font-size:12.5px; white-space:nowrap; opacity:0; visibility:hidden;
        transition:opacity .2s ease; pointer-events:none; z-index:5; box-shadow:0 2px 8px rgba(0,0,0,.15);
        border:1px solid #f0f0f0;
      }
      .svc-card--disabled:hover .svc-card-tooltip{ opacity:1; visibility:visible; }
    </style>

    @if(session('success'))
    <div class="alert alert-success" style="margin-top: 20px">
        {{ session('success') }}
    </div>
    @endif

    {{-- ================= Greeting (same card as home.blade.php) ================= --}}
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
      // Gold + white particles behind the greeting. particles.min.js is loaded at the bottom of layouts/app-pdms.blade.php
      // (after this content), so wait for DOMContentLoaded. Motion is off for users who prefer reduced motion.
      document.addEventListener('DOMContentLoaded', function () {
        if (!window.particlesJS || !document.getElementById('home-greet-particles')) return;
        var still = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        window.particlesJS('home-greet-particles', {
          particles: {
            number: { value: 160, density: { enable: true, value_area: 800 } },
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

    {{-- ================= PDMS services (same links + role checks as the PDMS sidebar) ================= --}}
    <div class="home-svc-head">
      <h2 class="home-svc-title">PDMS Services</h2>
    </div>

    <section class="svc-dashboard">

      {{-- Category: Records --}}
      <div class="svc-category">
        <div class="svc-cat-head" style="--svc-accent:#6656A3;">
          <i class="bi bi-folder2-open"></i>
          <span class="svc-cat-title">Records</span>
        </div>
        <div class="svc-grid">

          @if ($pdmsCanCuti)
            <a class="svc-card" href="{{ route('pdms.cutiindex') }}" style="--svc-accent:#6656A3;--svc-tint:#EFEBF8;">
              <div class="svc-card-icon"><i class="bi bi-list-check"></i></div>
              <div class="svc-card-title">PDMS Cuti Records</div>
              <div class="svc-card-sub">Leave records</div>
              <div class="svc-card-desc">Search, add and update staff leave records and their supporting documents.</div>
              <span class="svc-cta">Open</span>
            </a>
          @else
            <div class="svc-card svc-card--disabled" style="--svc-accent:#6656A3;--svc-tint:#EFEBF8;">
              <div class="svc-card-icon"><i class="bi bi-list-check"></i></div>
              <div class="svc-card-title">PDMS Cuti Records</div>
              <div class="svc-card-sub">Leave records</div>
              <div class="svc-card-desc">Search, add and update staff leave records and their supporting documents.</div>
              <span class="svc-cta">Open</span>
              <span class="svc-card-tooltip">Access required</span>
            </div>
          @endif

          @if ($pdmsCanService)
            <a class="svc-card" href="{{ route('pdms.serviceindex') }}" style="--svc-accent:#1F7A8C;--svc-tint:#E7F4F5;">
              <div class="svc-card-icon"><i class="bi bi-list-ol"></i></div>
              <div class="svc-card-title">PDMS Service Records</div>
              <div class="svc-card-sub">Service records</div>
              <div class="svc-card-desc">Search, add and update staff service records and their supporting documents.</div>
              <span class="svc-cta">Open</span>
            </a>
          @else
            <div class="svc-card svc-card--disabled" style="--svc-accent:#1F7A8C;--svc-tint:#E7F4F5;">
              <div class="svc-card-icon"><i class="bi bi-list-ol"></i></div>
              <div class="svc-card-title">PDMS Service Records</div>
              <div class="svc-card-sub">Service records</div>
              <div class="svc-card-desc">Search, add and update staff service records and their supporting documents.</div>
              <span class="svc-cta">Open</span>
              <span class="svc-card-tooltip">Access required</span>
            </div>
          @endif

        </div>
      </div>

      {{-- Category: Admin (only shown to PDMS admins, same as the sidebar) --}}
      @if ($pdmsCanAdmin)
      <div class="svc-category">
        <div class="svc-cat-head" style="--svc-accent:#A24638;">
          <i class="bi bi-shield-lock"></i>
          <span class="svc-cat-title">Admin</span>
        </div>
        <div class="svc-grid">
          <a class="svc-card" href="{{ route('pdms.index') }}" style="--svc-accent:#A24638;--svc-tint:#F7E9E6;">
            <div class="svc-card-icon"><i class="bi bi-archive"></i></div>
            <div class="svc-card-title">PDMS Admin</div>
            <div class="svc-card-sub">Personnel data</div>
            <div class="svc-card-desc">Manage staff profiles, statements, leave and service files across PDMS.</div>
            <span class="svc-cta">Open</span>
          </a>
        </div>
      </div>
      @endif

      {{-- Category: MESH --}}
      <div class="svc-category">
        <div class="svc-cat-head" style="--svc-accent:#3B7A55;">
          <i class="bi bi-grid"></i>
          <span class="svc-cat-title">MESH</span>
        </div>
        <div class="svc-grid">
          <a class="svc-card" href="{{ route('home') }}" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
            <div class="svc-card-icon"><i class="bi bi-house-fill"></i></div>
            <div class="svc-card-title">MESH Home</div>
            <div class="svc-card-sub">All MESH services</div>
            <div class="svc-card-desc">Go back to the main MESH homepage for all other services.</div>
            <span class="svc-cta">Open</span>
          </a>
        </div>
      </div>

    </section>

@endsection
