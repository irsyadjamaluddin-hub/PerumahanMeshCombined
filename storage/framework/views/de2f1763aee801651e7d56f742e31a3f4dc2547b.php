



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
    /* =============================================== */

    /* =============== NISAH =============== */
    // Fix (30 Sept 2026): jabatan was blank for most staff because users.department_id is usually empty.
    // Now reads the same record as the Profile page (emp_employment_infos by ic_no, biodatas/show.blade.php),
    // and only falls back to the users table when there is no employment record.
    $homeEmployment = \App\Models\Employment::where('ic_no', $homeUser->ic_no)->first();
    $homeDeptId = optional($homeEmployment)->department_id ?: $homeUser->department_id;
    $homeJabatan = is_numeric($homeDeptId)
        ? optional(\App\Models\Department::find($homeDeptId))->label
        : null;
    /* =============================================== */

    /* =============== NISAH =============== */
    // Fix (30 Sept 2026): Home crashed with "Conversion failed when converting the nvarchar value '...' to data type int".
    // bahagian_id is mostly free text (e.g. "hrmd", "Pentadbiran") but bahagians.code/id are int columns, so the
    // lookup is only done for numeric values; text is shown as typed. Old version: inc/home-greeting-oldver-30sept2026.blade.php
    $homeBahagianRaw = trim((string) (optional($homeEmployment)->bahagian_id ?: $homeUser->bahagian_id));
    if ($homeBahagianRaw === '') {
        $homeBahagian = null;
    } elseif (ctype_digit($homeBahagianRaw)) {
        $homeBahagian = \App\Models\Bahagian::where('code', (int) $homeBahagianRaw)->value('label')
            ?? optional(\App\Models\Bahagian::find((int) $homeBahagianRaw))->label;
    } else {
        $homeBahagian = $homeBahagianRaw;
    }
    /* =============================================== */

    /* =============== NISAH =============== */
    // Greeting line order changed (30 Sept 2026): Section · School · Department (most specific first).
    // School comes from emp_employment_infos.school_id -> schools, same as "Maktab/Sekolah" on the Profile page.
    // School staff often have the school name typed as their bahagian or picked as their jabatan too, so repeats are dropped.
    $homeSchool = $homeEmployment && is_numeric($homeEmployment->school_id)
        ? optional(\App\Models\School::find($homeEmployment->school_id))->label
        : null;
    $homeOrgParts = [];
    foreach ([$homeBahagian, $homeSchool, $homeJabatan] as $homeOrgPart) {
        $homeOrgPart = trim((string) $homeOrgPart);
        if ($homeOrgPart !== '' && !in_array(mb_strtolower($homeOrgPart), array_map('mb_strtolower', $homeOrgParts), true)) {
            $homeOrgParts[] = $homeOrgPart;
        }
    }
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

      /* #============= ORI CODE ============== */
      /* =============== NISAH =============== */
      /* Dark mode (Oct 2026) for the homepage content. Header/sidebar/footer dark styles and the --mesh-d-* colours
         are in public/css/mesh-v4.css. Only applies when the sun/moon switch is on dark (html[data-mesh-theme="dark"]). */
      /* (closing line of this block was: =============================================== ) */
      /* #================================ */
      /* Dark mode (Oct 2026) for the homepage content (also used by PDMS Home). Header/sidebar/footer dark styles and
         the --mesh-d-* colours are in public/css/mesh-v4.css; shared page parts in public/css/mesh-dark.css.
         Only applies when the sun/moon switch is on dark (html[data-mesh-theme="dark"]). */
      html[data-mesh-theme="dark"] body.mesh-dark-ready .home-greet{
        background:
          radial-gradient(520px 260px at 100% 0%, rgba(243,195,95,.14), transparent 60%),
          linear-gradient(120deg, #241a52, #3c1a66);
      }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .home-svc-title{ color:var(--mesh-d-text); }

      html[data-mesh-theme="dark"] body.mesh-dark-ready .svc-search-wrap input{
        background:var(--mesh-d-surface); border-color:var(--mesh-d-border); color:var(--mesh-d-text);
      }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .svc-search-wrap input::placeholder{ color:var(--mesh-d-muted); }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .svc-search-wrap input:focus{ border-color:#7c5cdb; box-shadow:0 0 0 3px rgba(124,92,219,.25); }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .svc-search-wrap svg{ stroke:var(--mesh-d-muted); }

      html[data-mesh-theme="dark"] body.mesh-dark-ready .svc-cat-head > i{ color:color-mix(in srgb, var(--svc-accent) 45%, #ffffff); }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .svc-cat-title{ color:#aeb5cc; }

      html[data-mesh-theme="dark"] body.mesh-dark-ready .svc-card{
        background:var(--mesh-d-card); border-color:var(--mesh-d-card-border);
        box-shadow:0 1px 2px rgba(0,0,0,.3), 0 8px 24px rgba(0,0,0,.35);
      }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .svc-card:hover{ border-color:#6d4bc4; box-shadow:0 10px 26px rgba(0,0,0,.45); }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .svc-card--disabled:hover{ border-color:var(--mesh-d-card-border); box-shadow:none; }
      /* icon chip: the category colour mixed down into the card, with a light tint of it for the glyph */
      html[data-mesh-theme="dark"] body.mesh-dark-ready .svc-card-icon{
        background:color-mix(in srgb, var(--svc-accent) 30%, var(--mesh-d-card));
        color:color-mix(in srgb, var(--svc-accent) 35%, #ffffff);
      }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .svc-card-title{ color:var(--mesh-d-text); }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .svc-card-sub,
      html[data-mesh-theme="dark"] body.mesh-dark-ready .svc-card-desc{ color:var(--mesh-d-muted); }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .svc-cta{ background:transparent; padding:0; color:var(--mesh-d-gold); font-weight:700; }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .svc-cta::after{ content:" \2192"; }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .svc-card-tooltip,
      html[data-mesh-theme="dark"] body.mesh-dark-ready .custom-tooltip{
        background:var(--mesh-d-surface-hover); color:var(--mesh-d-text); border-color:var(--mesh-d-border);
      }

      /* Service popups (My SSM, D Flow, Facility Booking, Support Request). The option cards carry inline
         white/blue styles, hence the !important. */
      html[data-mesh-theme="dark"] body.mesh-dark-ready .modal-content{ background:var(--mesh-d-surface); color:var(--mesh-d-text); border:1px solid var(--mesh-d-border); }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .modal-header{ border-bottom-color:var(--mesh-d-border); }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .modal-title{ color:var(--mesh-d-text); }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .btn-close{ filter:invert(1) grayscale(100%) brightness(200%); }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .modal-body .card.info-card{
        background-color:var(--mesh-d-card) !important; border-color:var(--mesh-d-card-border) !important; box-shadow:none;
      }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .modal-body .card.info-card[style*="border-left"]{
        background-color:#241a52 !important; border-left-color:var(--mesh-d-gold) !important;
      }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .modal-body .card.info-card .card-body{ background:transparent; }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .modal-body .card.info-card h6{ color:var(--mesh-d-text); }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .modal-body .card.info-card span{ color:var(--mesh-d-muted); }
      html[data-mesh-theme="dark"] body.mesh-dark-ready .modal-body .card-icon{ background:#2a2050; color:#c4b5fd; }
      /* #================================ */
    </style>

    
    
    
    
    <section class="home-greet">
      <div id="home-greet-particles" class="home-greet-particles" aria-hidden="true"></div>
      <div class="home-greet-main">
        
        
        
        
        <span class="home-greet-eyebrow"><i class="bi <?php echo e($homeGreetingIcon); ?>"></i><?php echo e(now()->format('l, j F Y')); ?></span>
        
        
        
        
        
        
        
        <h1 class="home-greet-title"><span><?php echo e($homeGreeting); ?></span>, <em><?php echo e($homeUser->display_name); ?></em></h1>
        
        
        
        
        <?php if(count($homeOrgParts)): ?>
        <p class="home-greet-sub">
          <i class="bi bi-building"></i>
          <?php $__currentLoopData = $homeOrgParts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homeOrgPart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!$loop->first): ?><span class="home-greet-sub-sep">&middot;</span><?php endif; ?>
            <span <?php if(!$loop->first): ?> class="home-greet-sub-bhg" <?php endif; ?>><?php echo e($homeOrgPart); ?></span>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </p>
        <?php endif; ?>
        
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
    
<?php /**PATH S:\MOE USER\Documents\Mesh110626-Combined\resources\views/inc/home-greeting.blade.php ENDPATH**/ ?>