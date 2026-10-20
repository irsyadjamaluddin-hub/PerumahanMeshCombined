<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MESH</title>

    <!-- Favicon -->
    <link href="{{ asset('assets/img/panjipanji-surat-01.png') }}" rel="icon">
    <link href="{{ asset('assets/img/panjipanji-surat-01.png') }}" rel="apple-touch-icon">

    <!-- Google Font: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
      :root {
        --ink: #140f34;
        --ink-2: #201a5c;
        --indigo: #3730a3;
        --indigo-600: #4f46e5;
        --gold: #f2c245;
        --red: #ce1126;
        --paper: #eaf0fb;
        --paper-alt: #dee7f8;
        --card: #f5f8fd;
        --text: #1c1934;
        --muted: #5b6188;
        --line: #cdd9f0;
        --white: #ffffff;
      }

      * { box-sizing: border-box; }
      html { scroll-behavior: smooth; }

      body {
        margin: 0;
        background: var(--paper);
        color: var(--text);
        font-family: 'Poppins', -apple-system, "Segoe UI", Roboto, sans-serif;
        -webkit-font-smoothing: antialiased;
        overflow-x: hidden;
      }

      img { max-width: 100%; display: block; }

      .wrap {
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 28px;
      }

      .mono {
        font-family: ui-monospace, SFMono-Regular, Consolas, "Liberation Mono", monospace;
      }

      .eyebrow {
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: var(--indigo-600);
        margin: 0 0 12px;
      }

      .eyebrow.on-dark { color: var(--gold); }

      h2.h-section {
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 700;
        line-height: 1.15;
        margin: 0 0 16px;
        text-wrap: balance;
      }

      .lede {
        font-size: 14px;
        line-height: 1.7;
        color: var(--muted);
        max-width: 62ch;
        margin: 0;
      }

      section { position: relative; }

      /* ---------- Sticky nav ---------- */
      /* #==== ORI CODE (sticky wrapper approach; reverted because the nav must stay hidden until scrolled while the banner is visible from the start)
      .site-nav-wrap {
        position: sticky;
        top: 0;
        left: 0;
        right: 0;
        z-index: 50;
      }
      */
      /* #==== NEWLY ADDED (nav goes back to fixed + slide-in-on-scroll, exactly as it originally worked before the banner existed) ==== */
      .site-nav {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 50;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 28px;
        background: rgba(20, 15, 52, 0.82);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        transform: translateY(-100%);
        transition: transform 0.35s ease;
      }

      .site-nav.show { transform: translateY(0); }

      .site-nav .brand {
        color: var(--white);
        font-weight: 700;
        font-size: 15px;
        letter-spacing: 0.05em;
      }

      .site-nav .brand span { color: var(--gold); }

      /* #==== ORI CODE ====
      .site-nav .links {
        display: flex;
        gap: 26px;
        list-style: none;
        margin: 0;
        padding: 0;
      }

      .site-nav .links a {
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        font-size: 13.5px;
        font-weight: 500;
        transition: color 0.15s ease;
      }

      .site-nav .links a:hover { color: var(--white); }

      .site-nav .cta {
        display: flex;
        gap: 10px;
      }
      */

      /* #==== NEWLY ADDED (hamburger menu replacing the nav links + Login/Register buttons) ==== */
      .site-nav .nav-toggle {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 5px;
        width: 34px;
        height: 34px;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0;
      }

      .site-nav .nav-toggle span {
        display: block;
        width: 100%;
        height: 2px;
        background: var(--white);
        border-radius: 2px;
        transition: transform 0.25s ease, opacity 0.25s ease;
      }

      .site-nav .nav-toggle.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
      .site-nav .nav-toggle.open span:nth-child(2) { opacity: 0; }
      .site-nav .nav-toggle.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

      .site-nav .nav-menu {
        position: absolute;
        top: 100%;
        right: 28px;
        margin-top: 8px;
        list-style: none;
        padding: 10px;
        min-width: 200px;
        background: rgba(20, 15, 52, 0.96);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        box-shadow: 0 20px 45px rgba(4, 18, 40, 0.5);
        opacity: 0;
        transform: translateY(-8px);
        pointer-events: none;
        transition: opacity 0.2s ease, transform 0.2s ease;
      }

      .site-nav .nav-menu.open {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
      }

      .site-nav .nav-menu li + li { margin-top: 2px; }

      .site-nav .nav-menu a {
        display: block;
        padding: 10px 12px;
        border-radius: 8px;
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        font-size: 13.5px;
        font-weight: 500;
        transition: background-color 0.15s ease, color 0.15s ease;
      }

      .site-nav .nav-menu a:hover { background: rgba(255, 255, 255, 0.08); color: var(--white); }

      .pill-btn {
        border: 1.5px solid rgba(255, 255, 255, 0.55);
        color: var(--white);
        text-decoration: none;
        padding: 7px 18px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 600;
        transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        white-space: nowrap;
      }

      .pill-btn:hover { background: var(--white); color: var(--ink); }

      .pill-btn.solid {
        background: var(--gold);
        border-color: var(--gold);
        color: var(--ink);
      }

      .pill-btn.solid:hover { background: #ffd75e; border-color: #ffd75e; }

      /* #==== ORI CODE ====
      @media (max-width: 720px) {
        .site-nav .links { display: none; }
      }
      */

      /* #==== NEWLY ADDED (yellow maintenance/notice tagline bar; sits in normal flow at the top of the page while the nav is hidden, then switches to fixed-below-nav once .stuck is toggled on scroll) ==== */
      .site-banner {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: var(--gold);
        color: var(--ink);
        text-align: center;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.4;
        padding: 10px 20px;
      }

      .site-banner.stuck {
        position: fixed;
        top: var(--nav-h, 62px);
        left: 0;
        right: 0;
        z-index: 49;
      }

      .site-banner svg { flex-shrink: 0; }

      @media (max-width: 600px) {
        .site-banner { font-size: 12px; padding: 10px 16px; }
      }

      /* ---------- Hero ---------- */
      .hero {
        position: relative;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        overflow: hidden;
        /* === ORI CODE ===
          background:
            radial-gradient(ellipse 900px 600px at 20% 10%, rgba(79, 70, 229, 0.35), transparent 60%),
            radial-gradient(ellipse 800px 700px at 85% 85%, rgba(206, 17, 38, 0.18), transparent 55%),
            linear-gradient(150deg, #0f0b2e 0%, var(--ink) 45%, var(--ink-2) 100%);
        */
        /* === ORI CODE ===
          background-image:
            radial-gradient(circle, rgba(255, 255, 255, 0.12) 1px, transparent 1.4px),
            radial-gradient(ellipse 900px 600px at 20% 10%, rgba(79, 70, 229, 0.35), transparent 60%),
            radial-gradient(ellipse 800px 700px at 85% 85%, rgba(206, 17, 38, 0.18), transparent 55%),
            linear-gradient(155deg, #081f42 0%, #0c2f5e 45%, #144d8f 100%);
          background-size: 22px 22px, cover, cover, cover;
          background-position: 0 0, center, center, center;
          background-repeat: repeat, no-repeat, no-repeat, no-repeat;
        */
        /* #====== NEWLY ADDED (reverted to previous indigo/purple gradient) ==== */
        background-image:
          radial-gradient(circle, rgba(255, 255, 255, 0.12) 1px, transparent 1.4px),
          radial-gradient(ellipse 900px 600px at 20% 10%, rgba(79, 70, 229, 0.35), transparent 60%),
          radial-gradient(ellipse 800px 700px at 85% 85%, rgba(206, 17, 38, 0.18), transparent 55%),
          linear-gradient(150deg, #0f0b2e 0%, var(--ink) 45%, var(--ink-2) 100%);
        background-size: 22px 22px, cover, cover, cover;
        background-position: 0 0, center, center, center;
        background-repeat: repeat, no-repeat, no-repeat, no-repeat;
        color: var(--white);
        padding: 40px 28px 28px;
        text-align: center;
      }

      #particles-js {
        position: absolute;
        inset: 0;
        z-index: 1;
      }

      .hero-content {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: clamp(24px, 6vh, 56px);
        flex: 1;
        justify-content: center;
        padding-top: 32px;
      }

      .crest-block { display: flex; flex-direction: column; align-items: center; gap: 10px; }
      .crest-block img { width: 64px; height: auto; }
      .crest-block .jawi { font-size: 22px; letter-spacing: 0.02em; }
      .crest-block .en { font-weight: 700; text-transform: uppercase; font-size: 13px; letter-spacing: 0.08em; }
      .crest-block .country { font-size: 12px; opacity: 0.85; text-transform: uppercase; letter-spacing: 0.08em; }

      .mesh-block { display: flex; flex-direction: column; align-items: center; }

      .internal-pill {
        border: 1.5px solid rgba(255, 255, 255, 0.65);
        border-radius: 999px;
        padding: 3px 14px;
        font-size: 11px;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        align-self: flex-end;
        margin-right: 18px;
        margin-bottom: -6px;
      }

      .mesh-word {
        font-weight: 700;
        font-size: clamp(56px, 11vw, 112px);
        line-height: 1;
        letter-spacing: 0.04em;
        background: linear-gradient(180deg, #ffffff 0%, #d8d6ea 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin: 0;
      }

      .mesh-tagline {
        color: var(--gold);
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 0.14em;
        margin-top: 6px;
      }

      .hero-ctas { display: flex; gap: 16px; }
      .hero-ctas .pill-btn { padding: 10px 30px; font-size: 14px; }

      .scroll-cue {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        color: rgba(255, 255, 255, 0.65);
        font-size: 11px;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        margin-top: 16px;
      }

      .scroll-cue svg { animation: bob 1.8s ease-in-out infinite; }

      @keyframes bob {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(6px); }
      }

      /* ---------- Reveal ---------- */
      .reveal {
        opacity: 0;
        transform: translateY(22px);
        transition: opacity 0.6s ease, transform 0.6s ease;
      }
      .reveal.is-visible { opacity: 1; transform: translateY(0); }

      @media (prefers-reduced-motion: reduce) {
        .reveal { opacity: 1; transform: none; transition: none; }
        .scroll-cue svg { animation: none; }
        html { scroll-behavior: auto; }
      }

      /* ---------- About ---------- */
      .about {
        padding: clamp(72px, 10vw, 120px) 0;
        background: var(--paper);
      }

      .about .wrap {
        display: grid;
        grid-template-columns: 0.95fr 1.15fr;
        gap: 56px;
        align-items: center;
      }

      .about-facts {
        display: flex;
        gap: 28px;
        margin-top: 30px;
        flex-wrap: wrap;
      }

      .fact { min-width: 120px; }
      .fact .num { font-size: 26px; font-weight: 700; color: var(--indigo-600); }
      .fact .lbl { font-size: 12.5px; color: var(--muted); margin-top: 2px; }

      .hub-diagram { width: 100%; height: auto; max-width: 820px; overflow: visible; }
      .hub-diagram text { font-family: 'Poppins', sans-serif; fill: var(--text); }
      /* #==== NEWLY ADDED (10-node hub now carries longer labels, so font size trimmed from 23px to keep two-line labels clear of neighbors) ==== */
      .hub-diagram .node-label { font-size: 20px; font-weight: 600; }
      .hub-diagram .center-label { font-size: 40px; font-weight: 700; fill: var(--white); }
      .hub-diagram .spoke { stroke: var(--line); stroke-width: 2.5; }
      .hub-diagram .node-dot { fill: var(--white); stroke: var(--indigo-600); stroke-width: 3; }

      /* ---------- Services ---------- */
      /* === ORI CODE === */
      /* # background: var(--paper-alt); */
      /* # border-top: 1px solid var(--line); */
      /* # border-bottom: 1px solid var(--line); */
      /* #====== NEWLY ADDED ==== */
      .services {
        padding: clamp(72px, 10vw, 120px) 0;
        background: linear-gradient(150deg, #0f0b2e 0%, var(--ink) 55%, var(--ink-2) 100%);
      }

      .services .eyebrow { color: var(--gold); }
      .services h2.h-section { color: #ffffff; }
      .services-head { text-align: center; margin: 0 auto 48px; max-width: 640px; }
      .services-head .lede { margin: 0 auto; color: rgba(255, 255, 255, 0.68); }

      /* #==== ORI CODE ====
      .service-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
      }
      */
      {{-- #==== NEWLY ADDED (plain "1fr" tracks refuse to shrink below their content's min-content width, which on narrow phones pushed the whole grid, and with it the section text above it, wider than the viewport and forced a horizontal scroll instead of wrapping; minmax(0, 1fr) lets the tracks actually shrink to the viewport) ==== --}}
      .service-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
      }

      /* #==== ORI CODE ====
      .service-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 26px 24px;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
      }
      */
      /* #==== NEWLY ADDED (min-width: 0 override; grid items default to min-width: auto, which fights the minmax(0, 1fr) tracks above) ==== */
      .service-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 26px 24px;
        min-width: 0;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
      }

      .service-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 32px rgba(20, 15, 52, 0.1);
        border-color: rgba(79, 70, 229, 0.25);
      }

      .service-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: rgba(79, 70, 229, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--indigo-600);
        margin-bottom: 16px;
      }

      .service-card h3 { font-size: 16.5px; font-weight: 600; margin: 0 0 8px; }
      .service-card p { font-size: 13.5px; color: var(--muted); line-height: 1.55; margin: 0 0 14px; }

      @media (max-width: 900px) {
        /* #==== NEWLY ADDED (minmax(0, 1fr), same overflow fix as the desktop declaration above) ==== */
        .service-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .about .wrap { grid-template-columns: 1fr; }
        /* #==== NEWLY ADDED (Housing's grid-column:2 desktop override no longer applies once the grid drops to 2 columns) ==== */
        .service-grid .service-card { grid-column: auto; }
      }
      @media (max-width: 600px) {
        /* #==== ORI CODE ====
        .service-grid { grid-template-columns: minmax(0, 1fr); }
        */
        /* #==== NEWLY ADDED (single-column grid was still rendering cards stacked on top of each other on phones instead of one below the other; swapping to a plain flex column sidesteps the grid quirk entirely and reliably stacks them, plus tighter padding/icon size so cards read as phone-sized, not scaled-down desktop cards) ==== */
        .service-grid {
          display: flex;
          flex-direction: column;
          gap: 14px;
        }
        .service-card {
          padding: 18px 16px;
        }
        .service-icon {
          width: 36px;
          height: 36px;
          margin-bottom: 12px;
        }
        .service-card h3 { font-size: 15px; }
        .service-card p { font-size: 13px; }
      }

      /* #==== NEWLY ADDED (the hub diagram's SVG text scales down with the whole graphic on narrow screens, so bump the source font-size to keep it legible) ==== */
      @media (max-width: 600px) {
        /* #==== NEWLY ADDED (scaled down from 37px to match the 20px desktop node-label size) ==== */
        .hub-diagram .node-label { font-size: 32px; }
        .hub-diagram .center-label { font-size: 36px; }
        .hub-diagram .spoke { stroke-width: 4; }
        .hub-diagram .node-dot { stroke-width: 5; }
      }

      /* === ORI CODE ===
        ---------- Benefits (dark band) section deleted, background moved to .services above ----------
      .benefits {
        padding: clamp(72px, 10vw, 120px) 0;
        background: linear-gradient(150deg, #0f0b2e 0%, var(--ink) 55%, var(--ink-2) 100%);
        color: var(--white);
      }

      .benefits .lede { color: rgba(255, 255, 255, 0.68); }

      .benefit-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 32px 40px;
        margin-top: 48px;
      }

      .benefit-item .mark {
        width: 22px;
        height: 3px;
        background: var(--gold);
        border-radius: 2px;
        margin-bottom: 14px;
      }

      .benefit-item h3 { font-size: 16px; font-weight: 600; margin: 0 0 8px; }
      .benefit-item p { font-size: 13.5px; color: rgba(255, 255, 255, 0.62); line-height: 1.6; margin: 0; }

      @media (max-width: 900px) {
        .benefit-grid { grid-template-columns: repeat(2, 1fr); }
      }
      @media (max-width: 560px) {
        .benefit-grid { grid-template-columns: 1fr; }
      }
      */

      /* ---------- Who uses ---------- */
      .who {
        padding: clamp(72px, 10vw, 120px) 0;
        position: relative;
        background-image:
          radial-gradient(ellipse 75% 70% at center, rgba(191, 219, 254, 0.35) 0%, rgba(30, 64, 175, 0.85) 100%),
          url("{{ asset('img/moe-building-compressed.jpg') }}");
        background-size: cover, cover;
        background-position: center, center;
        background-repeat: no-repeat, no-repeat;
      }

      .who .eyebrow { color: var(--gold); }

      .who h2.h-section {
        color: #ffffff;
        text-shadow: 0 2px 14px rgba(6, 15, 36, 0.55);
      }

      .who-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-top: 40px;
      }

      .who-card {
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 24px 20px;
        background: var(--card);
      }

      .who-card .chip {
        display: inline-block;
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: var(--red);
        background: rgba(206, 17, 38, 0.08);
        padding: 3px 10px;
        border-radius: 999px;
        margin-bottom: 12px;
      }

      .who-card h3 { font-size: 15.5px; font-weight: 600; margin: 0 0 8px; }
      .who-card p { font-size: 13px; color: var(--muted); line-height: 1.55; margin: 0; }

      @media (max-width: 900px) {
        .who-grid { grid-template-columns: repeat(2, 1fr); }
      }
      @media (max-width: 560px) {
        .who-grid { grid-template-columns: 1fr; }
      }

      /* ---------- Getting started ---------- */
      .start {
        padding: clamp(72px, 10vw, 120px) 0;
        background: var(--paper-alt);
        border-top: 1px solid var(--line);
        border-bottom: 1px solid var(--line);
      }

      .steps {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
        margin-top: 48px;
        position: relative;
      }

      .step { position: relative; padding-left: 4px; }

      .step .num-badge {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: var(--indigo-600);
        color: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 15px;
        margin-bottom: 16px;
      }

      .step h3 { font-size: 16px; font-weight: 600; margin: 0 0 8px; }
      .step p { font-size: 13.5px; color: var(--muted); line-height: 1.6; margin: 0; }

      .step:not(:last-child)::after {
        content: "";
        position: absolute;
        top: 19px;
        left: calc(100% - 4px);
        width: calc(28px + 8px);
        height: 2px;
        background: var(--line);
      }

      @media (max-width: 900px) {
        .steps { grid-template-columns: 1fr; gap: 36px; }
        .step:not(:last-child)::after { display: none; }
      }

      /* ---------- Footer ---------- */
      .site-footer {
        background: var(--ink);
        color: rgba(255, 255, 255, 0.6);
        padding: 40px 0;
        text-align: center;
        font-size: 12.5px;
      }

      .site-footer img { width: 34px; margin: 0 auto 14px; opacity: 0.9; }
      .site-footer a { color: rgba(255, 255, 255, 0.85); text-decoration: underline; }
    </style>
</head>
<body>

<nav class="site-nav" id="siteNav">
  <div class="brand">MESH<span>&middot;</span> MOE Employee &amp; Services Hub</div>
  {{-- #==== ORI CODE ====
  <ul class="links">
    <li><a href="#about">About</a></li>
    <li><a href="#services">Services</a></li>
    # <li><a href="#benefits">Benefits</a></li>
    <li><a href="#start">Get Started</a></li>
  </ul>
  <div class="cta">
    <a href="{{ route('login') }}" class="pill-btn">Login</a>
    <a href="{{ route('registerform') }}" class="pill-btn solid">Register</a>
  </div>
  --}}
  {{-- #==== NEWLY ADDED (hamburger menu replacing the nav links + Login/Register buttons) ==== --}}
  <button class="nav-toggle" id="navToggle" aria-label="Open menu" aria-expanded="false">
    <span></span><span></span><span></span>
  </button>
  <ul class="nav-menu" id="navMenu">
    <li><a href="#services">Services</a></li>
    <li><a href="#who">Who Uses MESH</a></li>
    <li><a href="#start">Getting Started</a></li>
  </ul>
</nav>

{{-- #==== NEWLY ADDED (yellow maintenance/notice tagline bar; visible at the top of the page while the nav is hidden, then becomes fixed and follows below the nav once .stuck is toggled on scroll) ==== --}}
<div class="site-banner" id="siteBanner">
  {{-- <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg> --}}
  {{-- #==== NEWLY ADDED (caution triangle swapped for a traffic-cone icon) ==== --}}
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 9 18h6L12 2Z"/><path d="M10 9h4"/><path d="M9.4 13h5.2"/><rect x="6" y="18" width="12" height="3" rx="1"/></svg>
  {{-- #==== ORI CODE ====
  <span>MESH is currently undergoing enhancements. Some features may be temporarily unavailable &mdash; thank you for your patience.</span>
  --}}
  {{-- #==== NEWLY ADDED (em dash replaced with a full stop, split into two sentences) ==== --}}
  <span>MESH is currently undergoing enhancements. Some features may be temporarily unavailable. Thank you for your patience.</span>
</div>

<header class="hero">
  <div id="particles-js"></div>

  <div class="hero-content">
    <div class="crest-block">
      <img src="{{ asset('assets/img/panjipanji-surat-01.png') }}" alt="Brunei Ministry of Education crest">
      <div class="jawi">كمنترين ڤنديديقن</div>
      <div class="en">Ministry of Education</div>
      <div class="country">Brunei Darussalam</div>
    </div>

    <div class="mesh-block">
      <div class="internal-pill">internal</div>
      <p class="mesh-word">MESH</p>
      <p class="mesh-tagline">MOE EMPLOYEE &amp; SERVICES HUB</p>
    </div>

    <div class="hero-ctas">
      <a href="{{ route('login') }}" class="pill-btn">Login</a>
      <a href="{{ route('registerform') }}" class="pill-btn">Register</a>
    </div>
  </div>

  <div class="scroll-cue">
    <span>Scroll to explore</span>
    <svg width="18" height="10" viewBox="0 0 18 10" fill="none"><path d="M1 1l8 7 8-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
  </div>

</header>

<section class="about reveal" id="about">
  <div class="wrap">
    <div>
      {{-- <p class="eyebrow">About Us</p>
      <h2 class="h-section">One hub for every MOE&nbsp;service.</h2>
      <p class="lede">MESH (MOE Employee &amp; Services Hub) is the Ministry of Education Brunei Darussalam's internal staff portal, bringing HR, attendance, facilities, documents, and communications together under a single login &mdash; replacing scattered paper forms and disconnected tools with one hub every MOE employee, school, and department can rely on.</p> --}}
      {{-- #==== NEWLY ADDED ==== --}}
      <p class="eyebrow">MESH</p>
      <h2 class="h-section">Your Gateway to MOE Internal Services</h2>
      {{-- #==== ORI CODE ====
      <p class="lede" style="font-style: italic;">Access the tools, applications and digital services you need <br>- all in one place.</p>
      --}}
      {{-- #==== NEWLY ADDED (dash-continuation line rewritten as two sentences) ==== --}}
      <p class="lede" style="font-style: italic;">Access the tools, applications and digital services you need. All in one place.</p>
      <p class="lede" style="margin-top: 1em;">MESH is an internal digital service platform developed to provide MOE officers and staff with a centralised gateway to essential digital services and applications. It brings together commonly used internal services into a single, streamlined experience, helping staff access the right tools more easily while supporting a more connected and efficient way of working.</p>

      {{-- <div class="about-facts">
        <div class="fact"><div class="num">30+</div><div class="lbl">integrated services</div></div>
        <div class="fact"><div class="num">1</div><div class="lbl">login for everything</div></div>
        <div class="fact"><div class="num">10</div><div class="lbl">service categories</div></div>
      </div> --}}
    </div>

    <div>
      {{-- #==== ORI CODE (6-node hub; kept for reference, superseded by the 10-node version below)
      <svg class="hub-diagram" viewBox="-240 -40 1000 600" xmlns="http://www.w3.org/2000/svg">
        <line class="spoke" x1="300" y1="260" x2="300" y2="50"/>
        <line class="spoke" x1="300" y1="260" x2="481.9" y2="155"/>
        <line class="spoke" x1="300" y1="260" x2="481.9" y2="365"/>
        <line class="spoke" x1="300" y1="260" x2="300" y2="470"/>
        <line class="spoke" x1="300" y1="260" x2="118.1" y2="365"/>
        <line class="spoke" x1="300" y1="260" x2="118.1" y2="155"/>

        <circle cx="300" cy="260" r="92" fill="#4f46e5"/>
        <circle cx="300" cy="260" r="92" fill="none" stroke="#f2c245" stroke-width="3"/>
        <text x="300" y="270" text-anchor="middle" class="center-label">MESH</text>

        <circle class="node-dot" cx="300" cy="50" r="12"/>
        <text x="300" y="8" text-anchor="middle" class="node-label">HR &amp; Personnel</text>

        <circle class="node-dot" cx="481.9" cy="155" r="12"/>
        <text x="510" y="161" text-anchor="start" class="node-label">Attendance</text>

        <circle class="node-dot" cx="481.9" cy="365" r="12"/>
        <text x="510" y="371" text-anchor="start" class="node-label">Facilities</text>

        <circle class="node-dot" cx="300" cy="470" r="12"/>
        <text x="300" y="531" text-anchor="middle" class="node-label">Documents</text>

        <circle class="node-dot" cx="118.1" cy="365" r="12"/>
        <text x="90" y="371" text-anchor="end" class="node-label">Communication</text>

        <circle class="node-dot" cx="118.1" cy="155" r="12"/>
        <text x="90" y="161" text-anchor="end" class="node-label">Support</text>
      </svg>
      ==== --}}
      {{-- #==== NEWLY ADDED (rebuilt as a 10-node decagon, one spoke per service category, in place of the old 6-node hexagon; wider viewBox and two-line tspans keep the longer category names clear of each other) ==== --}}
      <svg class="hub-diagram" viewBox="-260 -60 1120 680" xmlns="http://www.w3.org/2000/svg">
        <line class="spoke" x1="300" y1="260" x2="300" y2="30"/>
        <line class="spoke" x1="300" y1="260" x2="435.2" y2="73.9"/>
        <line class="spoke" x1="300" y1="260" x2="518.8" y2="188.9"/>
        <line class="spoke" x1="300" y1="260" x2="518.8" y2="331.1"/>
        <line class="spoke" x1="300" y1="260" x2="435.2" y2="446.1"/>
        <line class="spoke" x1="300" y1="260" x2="300" y2="490"/>
        <line class="spoke" x1="300" y1="260" x2="164.8" y2="446.1"/>
        <line class="spoke" x1="300" y1="260" x2="81.2" y2="331.1"/>
        <line class="spoke" x1="300" y1="260" x2="81.2" y2="188.9"/>
        <line class="spoke" x1="300" y1="260" x2="164.8" y2="73.9"/>

        <circle cx="300" cy="260" r="92" fill="#4f46e5"/>
        <circle cx="300" cy="260" r="92" fill="none" stroke="#f2c245" stroke-width="3"/>
        <text x="300" y="270" text-anchor="middle" class="center-label">MESH</text>

        <circle class="node-dot" cx="300" cy="30" r="10"/>
        <text x="300" y="-10" text-anchor="middle" class="node-label">HR &amp; Personnel</text>

        <circle class="node-dot" cx="435.2" cy="73.9" r="10"/>
        <text x="463.2" y="67.9" text-anchor="start" class="node-label">
          <tspan x="463.2" dy="0">Attendance &amp;</tspan>
          <tspan x="463.2" dy="24">Events</tspan>
        </text>

        <circle class="node-dot" cx="518.8" cy="188.9" r="10"/>
        <text x="546.8" y="182.9" text-anchor="start" class="node-label">
          <tspan x="546.8" dy="0">Facilities &amp;</tspan>
          <tspan x="546.8" dy="24">Booking</tspan>
        </text>

        <circle class="node-dot" cx="518.8" cy="331.1" r="10"/>
        <text x="546.8" y="325.1" text-anchor="start" class="node-label">
          <tspan x="546.8" dy="0">Curriculum &amp;</tspan>
          <tspan x="546.8" dy="24">Learning Resources</tspan>
        </text>

        <circle class="node-dot" cx="435.2" cy="446.1" r="10"/>
        <text x="463.2" y="440.1" text-anchor="start" class="node-label">
          <tspan x="463.2" dy="0">Assets &amp;</tspan>
          <tspan x="463.2" dy="24">Inventory</tspan>
        </text>

        <circle class="node-dot" cx="300" cy="490" r="10"/>
        <text x="300" y="532" text-anchor="middle" class="node-label">
          <tspan x="300" dy="0">Documents &amp;</tspan>
          <tspan x="300" dy="24">Correspondence</tspan>
        </text>

        <circle class="node-dot" cx="164.8" cy="446.1" r="10"/>
        <text x="136.8" y="452.1" text-anchor="end" class="node-label">Communication</text>

        <circle class="node-dot" cx="81.2" cy="331.1" r="10"/>
        <text x="53.2" y="325.1" text-anchor="end" class="node-label">
          <tspan x="53.2" dy="0">Public &amp;</tspan>
          <tspan x="53.2" dy="24">External Services</tspan>
        </text>

        <circle class="node-dot" cx="81.2" cy="188.9" r="10"/>
        <text x="53.2" y="194.9" text-anchor="end" class="node-label">IT Support</text>

        <circle class="node-dot" cx="164.8" cy="73.9" r="10"/>
        <text x="136.8" y="79.9" text-anchor="end" class="node-label">Housing</text>
      </svg>
    </div>
  </div>
</section>

<section class="services reveal" id="services">
  <div class="wrap">
    <div class="services-head">
      <p class="eyebrow" style="margin-left:auto;margin-right:auto;">Services of MESH</p>
      {{-- <p class="lede">Every module is role-gated &mdash; you only see what's relevant to you.</p> --}}
      {{-- #==== ORI CODE ====
      <p class="lede">MESH provides role-based access, so each user sees only the modules and services relevant to their role and responsibilities.</p>
      --}}
      {{-- #==== NEWLY ADDED (comma-splice split into two sentences) ==== --}}
      <p class="lede">MESH provides role-based access. Each user sees only the modules and services relevant to their role and responsibilities.</p>
    </div>

    <div class="service-grid">

      <div class="service-card">
        <div class="service-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="3"/><path d="M5 19c0-3.5 3-6 7-6s7 2.5 7 6"/></svg></div>
        <h3>HR &amp; Personnel</h3>
        <p>Staff accounts, personnel records, leave, acting appointments, retirement, and performance.</p>
      </div>

      <div class="service-card">
        <div class="service-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="5" width="16" height="14" rx="2"/><polyline points="8,12 11,15 16,9"/></svg></div>
        <h3>Attendance &amp; Events</h3>
        <p>Digital attendance slips, event registration with QR check-in, and briefing Q&amp;A.</p>
      </div>

      <div class="service-card">
        <div class="service-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="5" width="16" height="15" rx="2"/><line x1="4" y1="10" x2="20" y2="10"/><line x1="8" y1="3" x2="8" y2="7"/><line x1="16" y1="3" x2="16" y2="7"/></svg></div>
        <h3>Facilities &amp; Booking</h3>
        <p>Search availability and book meeting or syndicate rooms on a shared calendar.</p>
      </div>

      <div class="service-card">
        <div class="service-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6c-2-1.2-5-1.2-7 0v13c2-1.2 5-1.2 7 0"/><path d="M12 6c2-1.2 5-1.2 7 0v13c-2-1.2-5-1.2-7 0"/><line x1="12" y1="6" x2="12" y2="19"/></svg></div>
        {{-- <h3>Curriculum &amp; Inventory</h3> --}}
        {{-- #==== NEWLY ADDED ==== --}}
        <h3>Curriculum &amp; Learning Resources</h3>
        {{-- <p>Curriculum materials, tenders, and co-curricular club and activity management.</p> --}}
        {{-- #==== NEWLY ADDED ==== --}}
        <p>Co-curricular clubs and activities management.</p>
      </div>

      {{-- #==== NEWLY ADDED ==== --}}
      <div class="service-card">
        <div class="service-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></div>
        <h3>Assets &amp; Inventory</h3>
        {{-- #==== NEWLY ADDED ==== --}}
        <p>Curriculum materials and inventory management.</p>
      </div>

      <div class="service-card">
        <div class="service-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="18" rx="1.5"/><line x1="8" y1="8" x2="16" y2="8"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="8" y1="16" x2="13" y2="16"/></svg></div>
        <h3>Documents &amp; Correspondence</h3>
        <p>Create and action internal memos, track dispatch, files, and task assignments.</p>
      </div>

      <div class="service-card">
        <div class="service-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6 11a6 6 0 0 1 12 0v3.5c0 1 .4 1.8 1 2.5H5c.6-.7 1-1.5 1-2.5z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg></div>
        <h3>Communication</h3>
        <p>Push notifications, a shared link hub, announcements, news, and banners.</p>
      </div>

      <div class="service-card">
        <div class="service-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="5" width="16" height="11" rx="3"/><polyline points="9,16 9,19 13,16"/><circle cx="9" cy="10.5" r="0.9" fill="currentColor" stroke="none"/><circle cx="12" cy="10.5" r="0.9" fill="currentColor" stroke="none"/><circle cx="15" cy="10.5" r="0.9" fill="currentColor" stroke="none"/></svg></div>
        {{-- <h3>Public-Facing</h3> --}}
        {{-- #==== NEWLY ADDED ==== --}}
        <h3>Public &amp; External Services</h3>
        <p>Route public enquiries to departments and manage One Stop Centre feedback.</p>
      </div>

      <div class="service-card">
        <div class="service-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13a7 7 0 0 1 14 0"/><rect x="4" y="13" width="3" height="5" rx="1.3"/><rect x="17" y="13" width="3" height="5" rx="1.3"/><path d="M18.5 18v.5a2.5 2.5 0 0 1-2.5 2.5h-1.5"/></svg></div>
        <h3>IT Support</h3>
        <p>Raise support tickets and submit IT or systems change requests.</p>
      </div>

      {{-- #==== NEWLY ADDED (grid-column centers Housing under the middle column since it's the 9th/last card in a 3-col grid) ==== --}}
      <div class="service-card" style="grid-column: 2;">
        <div class="service-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><polyline points="4,11 12,5 20,11"/><path d="M6 10.5V20h12v-9.5"/><rect x="10.5" y="14" width="3" height="6"/></svg></div>
        <h3>Housing</h3>
        {{-- #==== ORI CODE ====
        <p>Manage government quarters &mdash; occupants, waiting list, and vacancies.</p>
        --}}
        {{-- #==== NEWLY ADDED (em dash replaced with a full stop) ==== --}}
        <p>Manage government quarters. Occupants, waiting list, and vacancies.</p>
      </div>

    </div>
  </div>
</section>

{{-- === ORI CODE ===
<section class="benefits reveal" id="benefits">
  <div class="wrap">
    <p class="eyebrow on-dark">Benefits of MESH</p>
    <h2 class="h-section">Why one hub beats ten logins.</h2>
    <p class="lede">Designed around a simple idea: staff shouldn't need to know which system does what.</p>

    <div class="benefit-grid">
      <div class="benefit-item">
        <div class="mark"></div>
        <h3>One login, every service</h3>
        <p>No more remembering which system handles what &mdash; sign in once for the whole hub.</p>
      </div>
      <div class="benefit-item">
        <div class="mark"></div>
        <h3>Personalized access</h3>
        <p>Your dashboard shows only the services your role grants &mdash; nothing you don't need.</p>
      </div>
      <div class="benefit-item">
        <div class="mark"></div>
        <h3>Paperless workflows</h3>
        <p>Leave, acting, room booking, and IT requests all move online, not through paper trails.</p>
      </div>
      <div class="benefit-item">
        <div class="mark"></div>
        <h3>Centralized records</h3>
        <p>One source of truth for staff and personnel data, instead of scattered spreadsheets.</p>
      </div>
      <div class="benefit-item">
        <div class="mark"></div>
        <h3>Real-time updates</h3>
        <p>Notifications and announcements reach you the moment they're published.</p>
      </div>
      <div class="benefit-item">
        <div class="mark"></div>
        <h3>Transparent tracking</h3>
        <p>See the live status of your own applications and requests, end to end.</p>
      </div>
    </div>
  </div>
</section>
--}}

<section class="who reveal" id="who">
  <div class="wrap">
    <p class="eyebrow">Who Uses MESH</p>

    <div class="who-grid">
      <div class="who-card">
        <span class="chip">Staff</span>
        <h3>MOE Staff</h3>
        <p>Full portal access scoped to your role &mdash; from leave applications to room bookings.</p>
      </div>
      <div class="who-card">
        <span class="chip">Schools</span>
        <h3>School Personnel</h3>
        <p>Teaching and non-teaching staff records, attendance, and co-curricular management.</p>
      </div>
      <div class="who-card">
        <span class="chip">Admin</span>
        <h3>Department Admins</h3>
        <p>Review approvals, manage requests, and configure module settings for your department.</p>
      </div>
    </div>
  </div>
</section>

<section class="start reveal" id="start">
  <div class="wrap">
    <p class="eyebrow">Getting Started</p>
    <h2 class="h-section">Three steps to your dashboard.</h2>

    <div class="steps">
      <div class="step">
        <div class="num-badge">1</div>
        <h3>Register</h3>
        <p>Create your MESH account with your MOE particulars. A step-by-step guide walks you through the form.</p>
      </div>
      <div class="step">
        <div class="num-badge">2</div>
        <h3>Get approved</h3>
        <p>Submit a role access request &mdash; it's reviewed by the relevant department administrator.</p>
      </div>
      <div class="step">
        <div class="num-badge">3</div>
        <h3>Start using MESH</h3>
        <p>Once approved, your personalized dashboard unlocks the services tied to your role.</p>
      </div>
    </div>
  </div>
</section>

<footer class="site-footer">
  <div class="wrap">
    <img src="{{ asset('assets/img/panjipanji-surat-01.png') }}" alt="Brunei Ministry of Education crest">
    <p>Ministry of Education &copy; 2026 All Rights Reserved. Powered by DevOps ICT.</p>
    <p><a href="/terms">Terms &amp; Conditions</a></p>
  </div>
</footer>

{{-- Particles JS --}}
<script src="{{ asset('js/particles.min.js') }}"></script>

{{-- Particles JS Initializer --}}
<script>
  particlesJS("particles-js", {"particles":{"number":{"value":80,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});

  (function () {
    var hero = document.querySelector('.hero');
    var nav = document.getElementById('siteNav');
    // #==== NEWLY ADDED (banner switches to fixed once the nav slides in, positioned right below it, and back to normal flow when the nav hides again) ====
    var banner = document.getElementById('siteBanner');
    if (banner && nav) {
      banner.style.setProperty('--nav-h', nav.offsetHeight + 'px');
      window.addEventListener('resize', function () {
        banner.style.setProperty('--nav-h', nav.offsetHeight + 'px');
      });
    }
    if (hero && nav) {
      var obs = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          var show = !entry.isIntersecting;
          nav.classList.toggle('show', show);
          if (banner) { banner.classList.toggle('stuck', show); }
        });
      }, { threshold: 0.05 });
      obs.observe(hero);
    }

    // #==== NEWLY ADDED (hamburger menu open/close) ====
    var navToggle = document.getElementById('navToggle');
    var navMenu = document.getElementById('navMenu');
    if (navToggle && navMenu) {
      navToggle.addEventListener('click', function () {
        var isOpen = navMenu.classList.toggle('open');
        navToggle.classList.toggle('open', isOpen);
        navToggle.setAttribute('aria-expanded', isOpen);
      });
      navMenu.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
          navMenu.classList.remove('open');
          navToggle.classList.remove('open');
          navToggle.setAttribute('aria-expanded', 'false');
        });
      });
      document.addEventListener('click', function (e) {
        if (!navToggle.contains(e.target) && !navMenu.contains(e.target)) {
          navMenu.classList.remove('open');
          navToggle.classList.remove('open');
          navToggle.setAttribute('aria-expanded', 'false');
        }
      });
    }

    var reveals = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window) {
      var revealObs = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            revealObs.unobserve(entry.target);
          }
        });
      }, { threshold: 0.12 });
      reveals.forEach(function (el) { revealObs.observe(el); });
    } else {
      reveals.forEach(function (el) { el.classList.add('is-visible'); });
    }
  })();
</script>

</body>
</html>
