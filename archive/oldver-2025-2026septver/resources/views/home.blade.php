{{-- OLD VERSION (oldver-2025-2026septver): full copy of resources/views/home.blade.php taken on 29 Sept 2026, just before the old code was --}}
{{-- removed from it. Old code is in the "ORIGINAL CODE" / "OLD ... kept for reference" blocks. Not used by any route. --}}
{{-- =============== NISAH =============== --}}
{{-- NEW HOMEPAGE (Sept 2026, "Option C v3"): greeting + the user's name, then the services in their sections --}}
{{-- (same cards/popups as servicesdashboard.blade.php). Announcements are in the header bell, which now lives in --}}
{{-- layouts/app-all.blade.php (inc/announcement-bell*.blade.php) so it works on every page, not just here. --}}
{{-- The previous homepage is kept as home-oldver-sept2026.blade.php (rename it back to roll back). --}}
{{-- =============================================== --}}
@extends('layouts.app-all')

@section('title', 'MOE MESH - Home')

@section('content')

  <?php
    // pagename drives the header title and the sidebar active-state check in app-all.blade.php
    $pagename = "";

    /* =============== ORIGINAL CODE =============== */
    // Time-of-day greeting (app timezone is Asia/Brunei, see config/app.php)
    // $homeHour = now()->hour;
    // if ($homeHour < 12) {
    //     $homeGreeting = 'Good morning';
    //     $homeGreetingMy = 'Selamat pagi';
    // } elseif ($homeHour < 16) {
    //     $homeGreeting = 'Good afternoon';
    //     $homeGreetingMy = 'Selamat petang';
    // } else {
    //     $homeGreeting = 'Good evening';
    //     $homeGreetingMy = 'Selamat malam';
    // }
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
      /* =============== ORIGINAL CODE =============== */
      /* ======= Homepage greeting ======= */
      /*
      .home-greet{
        background:var(--mesh-sidebar-2,#312e81); color:#fff; border-radius:18px;
        padding:28px 32px; margin-bottom:28px; display:flex; flex-direction:column; gap:6px;
      }
      .home-greet-eyebrow{ font-size:12.5px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--mesh-yellow,#f2c245); }
      .home-greet-title{
        margin:0; font-family:'Figtree', Helvetica, sans-serif; font-weight:700; line-height:1.15; letter-spacing:-.01em;
        font-size:clamp(26px, 3.2vw, 38px); color:#fff; overflow-wrap:anywhere;
      }
      .home-greet-sub{ margin:0; font-size:15.5px; color:rgba(255,255,255,.8); }
      */
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

    @if(session('success'))
    <div class="alert alert-success" style="margin-top: 20px">
        {{ session('success') }}
    </div>
    @endif

    {{-- ================= Greeting ================= --}}
    {{-- =============== ORIGINAL CODE =============== --}}
    {{--
    <section class="home-greet">
      <span class="home-greet-eyebrow">{{ $homeGreetingMy }} &middot; {{ now()->format('l, j F Y') }}</span>
      <h1 class="home-greet-title">{{ $homeGreeting }}, {{ Auth::user()->name }}</h1>
      <p class="home-greet-sub">Welcome to MESH. Choose a service below to get started.</p>
    </section>
    --}}
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

    {{-- ================= Services (same sections, cards and popups as servicesdashboard.blade.php) ================= --}}
    <div class="home-svc-head">
      <h2 class="home-svc-title">Services</h2>
      <div class="svc-search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="11" cy="11" r="7"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        <input id="svcSearchInput" type="text" autocomplete="off" placeholder="Search services" aria-label="Search services">
      </div>
    </div>

    <section class="svc-dashboard" id="svcAllServicesList">

      {{-- Category: Human Resource --}}
      <div class="svc-category">
        <div class="svc-cat-head" style="--svc-accent:#6656A3;">
          <i class="bi bi-person-badge"></i>
          <span class="svc-cat-title">Human Resource</span>
        </div>
        <div class="svc-grid">

          <div class="svc-card" type="button" data-bs-toggle="modal" data-bs-target="#ssmModal" style="--svc-accent:#6656A3;--svc-tint:#EFEBF8;">
            <div class="svc-card-icon"><i class="bi bi-briefcase"></i></div>
            <div class="svc-card-title">My SSM</div>
            <div class="svc-card-sub">Human Resource System</div>
            <div class="svc-card-desc">Manage and activate SSM accounts, update personal information and documents, and submit enquiries related to SSM services.</div>
            <span class="svc-cta">View options</span>
          </div>
          <!-- My SSM Modal -->
          <div class="modal fade" id="ssmModal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">My SSM</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <a href="{{ route('ssms.ssm.index') }}">
                    <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                      <div class="card-body" style="padding: 10px;">
                            <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-briefcase"></i>
                              </div>
                              <div class="ps-3">
                                <h6 style="font-size: 22px;">Activate SSM Account</h6>
                              </div>
                            </div>
                      </div>
                    </div>
                  </a>

                  <a href="https://mesh.moe.gov.bn/borangaduanssm">
                    <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                        <div class="card-body" style="padding: 10px;">
                              <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                  <i class="bi bi-chat-right-dots-fill"></i>
                                </div>
                                <div class="ps-3">
                                  <h6 style="font-size: 22px;">SSM Enquiries</h6>
                                </div>
                              </div>
                        </div>
                      </div>
                  </a>
                      <!-- Cuti - Non-clickable, Coming Soon -->
                      <div class="card info-card sales-card coming-soon-card" style="padding: 0px; border: 1px solid grey; margin-bottom: 20px; opacity: 0.6; cursor: not-allowed; position: relative;">
                      <div class="card-body" style="padding: 10px;">
                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-calendar-week"></i>
                          </div>
                          <div class="ps-3">
                            <h6 style="font-size: 22px;">Leave</h6>
                            <span>Coming Soon</span>
                          </div>
                        </div>
                      </div>
                      <span class="custom-tooltip">Coming soon!</span>
                    </div>

                    <!-- Memangku - Non-clickable, Coming Soon -->
                    <div class="card info-card sales-card coming-soon-card" style="padding: 0px; border: 1px solid grey; margin-bottom: 20px; opacity: 0.6; cursor: not-allowed; position: relative;">
                      <div class="card-body" style="padding: 10px;">
                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-diagram-2"></i>
                          </div>
                          <div class="ps-3">
                            <h6 style="font-size: 22px;">Acting</h6>
                            <span>Coming Soon</span>
                          </div>
                        </div>
                      </div>
                      <span class="custom-tooltip">Coming soon!</span>
                    </div>

                    <!-- Bersara - Non-clickable, Coming Soon -->
                    <div class="card info-card sales-card coming-soon-card" style="padding: 0px; border: 1px solid grey; margin-bottom: 20px; opacity: 0.6; cursor: not-allowed; position: relative;">
                      <div class="card-body" style="padding: 10px;">
                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-calendar-event"></i>
                          </div>
                          <div class="ps-3">
                            <h6 style="font-size: 22px;">Retirement</h6>
                            <span>Coming Soon</span>
                          </div>
                        </div>
                      </div>
                      <span class="custom-tooltip">Coming soon!</span>
                    </div>

                </div>
              </div>
            </div>
          </div><!-- End My SSM Modal-->

        </div>
      </div>

      {{-- Category: Communication & Notifications --}}
      <div class="svc-category">
        <div class="svc-cat-head" style="--svc-accent:#1F7A8C;">
          <i class="bi bi-megaphone"></i>
          <span class="svc-cat-title">Communication & Notifications</span>
        </div>
        <div class="svc-grid">

          @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ONS_USER')))
            <a class="svc-card" href="{{ route('onlinenotifications.onlinenotification.indexuser') }}" style="--svc-accent:#1F7A8C;--svc-tint:#E7F4F5;">
              <div class="svc-card-icon"><i class="bi bi-phone-vibrate"></i></div>
              <div class="svc-card-title">MNS</div>
              <div class="svc-card-sub">MESH Notification Service</div>
              <div class="svc-card-desc">Broadcast official messages and documents to multiple recipients simultaneously via WhatsApp using the WhatsApp API.</div>
              <span class="svc-cta">Open</span>
            </a>
          @else
            <div class="svc-card svc-card--disabled" style="--svc-accent:#1F7A8C;--svc-tint:#E7F4F5;">
              <div class="svc-card-icon"><i class="bi bi-phone-vibrate"></i></div>
              <div class="svc-card-title">MNS</div>
              <div class="svc-card-sub">MESH Notification Service</div>
              <div class="svc-card-desc">Broadcast official messages and documents to multiple recipients simultaneously via WhatsApp using the WhatsApp API.</div>
              <span class="svc-cta">Open</span>
              <span class="svc-card-tooltip">Access required</span>
            </div>
          @endif

          <a class="svc-card" href="{{ route('linkup.index') }}" style="--svc-accent:#1F7A8C;--svc-tint:#E7F4F5;">
            <div class="svc-card-icon"><i class="bi bi-link-45deg"></i></div>
            <div class="svc-card-title">MLS</div>
            <div class="svc-card-sub">MESH Link Sharing</div>
            <div class="svc-card-desc">Generate shortened links and QR codes for easy sharing and reference.</div>
            <span class="svc-cta">Open</span>
          </a>

        </div>
      </div>

      {{-- Category: Attendance & Events --}}
      <div class="svc-category">
        <div class="svc-cat-head" style="--svc-accent:#B9762E;">
          <i class="bi bi-calendar-check"></i>
          <span class="svc-cat-title">Attendance & Events</span>
        </div>
        <div class="svc-grid">

          <a class="svc-card" href="https://mesh.moe.gov.bn/moeevent" style="--svc-accent:#B9762E;--svc-tint:#F8EEE1;">
            <div class="svc-card-icon"><i class="bi bi-calendar-event-fill"></i></div>
            <div class="svc-card-title">MEA</div>
            <div class="svc-card-sub">MESH Event Attendance</div>
            <div class="svc-card-desc">Manage attendance for Ministry activities, including participant check-in and attendance records for meetings, discussions, training sessions, and other official activities.</div>
            <span class="svc-cta">Open</span>
          </a>

          <a class="svc-card" href="{{ route('slipkehadiran') }}" style="--svc-accent:#B9762E;--svc-tint:#F8EEE1;">
            <div class="svc-card-icon"><i class="bi bi-people-fill"></i></div>
            <div class="svc-card-title">MAS</div>
            <div class="svc-card-sub">MESH Attendance Slip</div>
            <div class="svc-card-desc">Attendance slips for Ministry events and training sessions.</div>
            <span class="svc-cta">Open</span>
          </a>

          <a class="svc-card" href="https://mesh.moe.gov.bn/Q&A" style="--svc-accent:#B9762E;--svc-tint:#F8EEE1;">
            <div class="svc-card-icon"><i class="bi bi-file-text"></i></div>
            <div class="svc-card-title">Q&A</div>
            <div class="svc-card-sub">Q&A Service</div>
            <div class="svc-card-desc">Submit questions anonymously for training or event purposes.</div>
            <span class="svc-cta">Open</span>
          </a>

        </div>
      </div>

      {{-- Category: Operations --}}
      <div class="svc-category">
        <div class="svc-cat-head" style="--svc-accent:#3B7A55;">
          <i class="bi bi-mortarboard"></i>
          <span class="svc-cat-title">Operations</span>
        </div>
        <div class="svc-grid">

          <a class="svc-card" href="{{ route('cddinventory.cddinventory.index') }}" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
            <div class="svc-card-icon"><i class="bi bi-bookmark-star-fill"></i></div>
            <div class="svc-card-title">CMS</div>
            <div class="svc-card-sub">Curriculum Materials Service</div>
            <div class="svc-card-desc">Manage applications and services related to curriculum materials.</div>
            <span class="svc-cta">Open</span>
          </a>

          <a class="svc-card" href="{{ route('cca.cca.index') }}" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
            <div class="svc-card-icon"><i class="bi bi-trophy"></i></div>
            <div class="svc-card-title">CCAM</div>
            <div class="svc-card-sub">Co-Curriculum Activities Management</div>
            <div class="svc-card-desc">Manage and coordinate co-curricular activities.</div>
            <span class="svc-cta">Open</span>
          </a>

          <div class="svc-card" type="button" data-bs-toggle="modal" data-bs-target="#emaModal" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
            @if (($totalEmemoTindakan ?? 0) > 0)
              <span class="home-svc-badge" title="E-Memo waiting for your action">{{ $totalEmemoTindakan }} to act</span>
            @endif
            <div class="svc-card-icon"><i class="bi bi-envelope-paper"></i></div>
            <div class="svc-card-title">
              D Flow
              @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_EMINITADMIN')))
              <span class="badge rounded-pill" style="background-color:#1F4E78; color:#fff; font-size:11px; padding:3px 9px; vertical-align:middle;">
                <i class="bi bi-shield-lock-fill me-1"></i>Admin
              </span>
              @endif
            </div>
            <div class="svc-card-sub">Documentation Flow</div>
            <div class="svc-card-desc">Create, track, and action official e-memos routed to your department.</div>
            <span class="svc-cta">View options</span>
          </div>
          <!-- EMA Modal -->
          <div class="modal fade" id="emaModal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">EMA - E-Memo Action</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_EMINITADMIN')))
                  <div class="card info-card sales-card" style="padding:0; border:1px solid blue; margin-bottom:20px; cursor:pointer;" onclick="window.location.href='{{ route('eminit.eminit.indexeminitadmin') }}'">
                    <div class="card-body" style="padding:10px;">
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-card-heading"></i>
                        </div>
                        <div class="ps-3">
                          <h6 style="font-size:22px;">List of E-Memo</h6>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card info-card sales-card" style="padding:0; border:1px solid #1F4E78; border-left:4px solid #012970; margin-bottom:20px; background-color:#EAF1FB;" onclick="window.location.href='{{ route('eminit.eminit.indexeminit') }}'">
                    <div class="card-body" style="padding:10px;">
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-journal-text"></i>
                        </div>
                        <div class="ps-3">
                          <h6 style="font-size:22px;">Create E-Memo</h6>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card info-card sales-card" style="padding:0; border:1px solid #1F4E78; border-left:4px solid #012970; margin-bottom:20px; background-color:#EAF1FB;" onclick="window.location.href='{{ route('eminit.eminit.indexeminitaction') }}'">
                    <div class="card-body" style="padding:10px;">
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="ps-3">
                          <div style="display:flex; align-items:center; gap:10px;">
                            <h6 style="font-size:22px; margin:0;">E-Memo (Action)</h6>
                            <h6 style="
                                font-size:26px;
                                display:inline-block;
                                background-color:#FFD700;
                                color:white;
                                width:50px;
                                height:50px;
                                line-height:50px;
                                text-align:center;
                                border-radius:50%;
                                font-weight:bold;
                                margin:0;
                            ">
                              {{ $totalEmemoTindakan ?? 0 }}
                            </h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card info-card sales-card" style="padding:0; border:1px solid blue; margin-bottom:20px; cursor:pointer;" onclick="window.location.href='{{ route('adminsettings.adminsettingsdashboard') }}'">
                    <div class="card-body" style="padding:10px;">
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-gear-fill"></i>
                        </div>
                        <div class="ps-3">
                          <h6 style="font-size:22px;">Settings</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                  @else
                  @if (Auth::check() && Auth::user()->hasRole('ROLE_CREATE_EMEMO'))
                  <div class="card info-card sales-card" style="padding:0; border:1px solid blue; margin-bottom:20px; cursor:pointer;" onclick="window.location.href='{{ route('eminit.eminit.indexeminit') }}'">
                    <div class="card-body" style="padding:10px;">
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-journal-text"></i>
                        </div>
                        <div class="ps-3">
                          <h6 style="font-size:22px;">Create E-Memo</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                  <div class="card info-card sales-card" style="padding:0; border:1px solid blue; margin-bottom:20px; cursor:pointer;" onclick="window.location.href='{{ route('eminit.eminit.indexeminitaction') }}'">
                    <div class="card-body" style="padding:10px;">
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="ps-3">
                          <h6 style="font-size:22px;">E-Memo Action</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div><!-- End EMA Modal -->

          <!-- Deep-link support: ?open=EMT opens the EMA modal directly -->
          <script>
          document.addEventListener('DOMContentLoaded', function () {
              const params = new URLSearchParams(window.location.search);
              const open = params.get('open');

              if (open === 'EMT') {
                  const modalElement = document.getElementById('emaModal');
                  const modal = new bootstrap.Modal(modalElement);
                  modal.show();
              }
          });
          </script>

        </div>
      </div>

      {{-- Category: Facilities & Support --}}
      <div class="svc-category">
        <div class="svc-cat-head" style="--svc-accent:#A24638;">
          <i class="bi bi-tools"></i>
          <span class="svc-cat-title">Facilities & Support</span>
        </div>
        <div class="svc-grid">

          <div class="svc-card" type="button" onclick="openFasilitasMain()" style="--svc-accent:#A24638;--svc-tint:#F7E9E6;">
            <div class="svc-card-icon"><i class="bi bi-door-open"></i></div>
            <div class="svc-card-title">Facility Booking Management</div>
            <div class="svc-card-desc">Reserve meeting and syndicate rooms within the Ministry of Education for internal meetings and activities.</div>
            <span class="svc-cta">View options</span>
          </div>

          <!-- MODAL -->
          <div class="modal fade" id="fasilitasModal" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title" id="fasilitasTitle">
                  Facility Booking Management
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body" id="fasilitasBody">
                <!-- Dynamic -->
              </div>

            </div>
          </div>
          </div>

          <!-- SCRIPT -->
          <script>
          function openFasilitasMain() {

          document.getElementById('fasilitasTitle').innerText =
            'Facility Booking Management';

          document.getElementById('fasilitasBody').innerHTML = `
            <div class="card info-card sales-card mb-3"
                 style="padding:0; border:1px solid blue; cursor:pointer;"
                 onclick="openTBM()">
              <div class="card-body" style="padding:10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-door-open"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size:22px;">MRB</h6>
                    <span>Meeting Room Booking</span>
                  </div>
                </div>
              </div>
            </div>

            <a href="{{ route('bookings.booking.home') }}" style="text-decoration:none;">
              <div class="card info-card sales-card"
                   style="padding:0; border:1px solid blue;">
                <div class="card-body" style="padding:10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-door-closed"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size:22px;">SRB</h6>
                      <span>Syndicate Room Booking</span>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          `;

          new bootstrap.Modal(document.getElementById('fasilitasModal')).show();
          }

          function openTBM() {

          document.getElementById('fasilitasTitle').innerText =
            'MRB - Meeting Room Booking';

          document.getElementById('fasilitasBody').innerHTML = `
            <a href="{{ route('adminbooking.searchroomadmin') }}" style="text-decoration:none;">
              ${fasilitasItem('bi-search','Search Room Availability')}
            </a>

            <a href="{{ route('adminbooking.systemcalendaradmin') }}" style="text-decoration:none;">
              ${fasilitasItem('bi-calendar','Calendar')}
            </a>

            <a href="{{ route('adminbooking.booking.indexadmin') }}" style="text-decoration:none;">
              ${fasilitasItem('bi-calendar-check','Booking')}
            </a>

            <a href="{{ route('adminbooking.rooms.index') }}" style="text-decoration:none;">
              ${fasilitasItem('bi-door-open','Room')}
            </a>

            <button class="btn btn-secondary mt-2" onclick="openFasilitasMain()">
              Back
            </button>
          `;
          }

          function fasilitasItem(icon, text) {
          return `
            <div class="card info-card sales-card mb-3"
                 style="padding:0; border:1px solid blue;">
              <div class="card-body" style="padding:10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi ${icon}"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size:18px;">${text}</h6>
                  </div>
                </div>
              </div>
            </div>
          `;
          }
          </script>

          <div class="svc-card" type="button" data-bs-toggle="modal" data-bs-target="#permohonanModal" style="--svc-accent:#A24638;--svc-tint:#F7E9E6;">
            <div class="svc-card-icon"><i class="bi bi-file-code"></i></div>
            <div class="svc-card-title">Support Request</div>
            <div class="svc-card-desc">Get technical support and assistance from the DevOps Support Desk.</div>
            <span class="svc-cta">View options</span>
          </div>
          <!-- Permohonan Sokongan Modal -->
          <div class="modal fade" id="permohonanModal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Support Request</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- DSD - DevOps Service Desk -->
                <a href="https://mesh.moe.gov.bn/dsd">
                    <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                        <div class="card-body" style="padding: 10px;">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-headset"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 style="font-size: 22px;">DSS</h6>
                                    <span>DevOps Support Service</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                  <!-- DRF - DevOps Request Form -->
                  <a href="https://mesh.moe.gov.bn/drf">
                    <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                      <div class="card-body" style="padding: 10px;">
                            <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-gear-wide-connected"></i>
                              </div>
                              <div class="ps-3">
                                <h6 style="font-size: 22px;">DRF</h6>
                                <span>DevOps Request Form</span>
                              </div>
                            </div>
                      </div>
                    </div>
                  </a>

                </div>
              </div>
            </div>
          </div><!-- End Permohonan Sokongan Modal-->

          <!--Permohonan Peranan Akses -->
          <a class="svc-card" href="https://mesh.moe.gov.bn/borangpermohonanperanan" style="--svc-accent:#A24638;--svc-tint:#F7E9E6;">
            <div class="svc-card-icon"><i class="bi bi-person-square"></i></div>
            <div class="svc-card-title">Role Access</div>
            <div class="svc-card-desc">Request or review the MESH roles and permission levels assigned to your account.</div>
            <span class="svc-cta">Open</span>
          </a>

        </div>
      </div>

    </section>

    <script>
    // Services search — same behaviour as servicesdashboard.blade.php
    (function(){
      var cats = Array.from(document.querySelectorAll('#svcAllServicesList .svc-category'));
      var input = document.getElementById('svcSearchInput');
      if (input) {
        input.addEventListener('input', function(){
          var q = input.value.trim().toUpperCase();
          cats.forEach(function(cat){
            var any = false;
            Array.from(cat.querySelectorAll('.svc-card')).forEach(function(card){
              var match = !q || card.innerText.toUpperCase().includes(q);
              card.hidden = !match;
              if (match) any = true;
            });
            cat.hidden = !any;
          });
        });
      }
    })();

    </script>

@endsection
