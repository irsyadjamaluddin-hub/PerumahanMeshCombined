<!DOCTYPE html>
@php
    $housing2Theme = session('housing2_theme', 'light');
    $housing2ViewMode = session('housing2_view_mode', 'user');
@endphp
<html lang="{{ \App\Support\Housing2Lang::locale() }}" data-theme="{{ $housing2Theme }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Pengurusan Perumahan')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/housing2.css') }}?v={{ filemtime(public_path('css/housing2.css')) }}">
</head>
<body>
<div class="shell">
    <header class="topbar">
        <a class="btn-home" href="{{ route('superadmindashboard') }}" title="Home" aria-label="Home">
            <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
            </svg>
        </a>
        <div class="brand-group">
            <a class="brand" href="{{ route('housing2.index') }}">{{ \App\Support\Housing2Lang::t('Pengurusan Perumahan') }}</a>
            <span class="sub">{{ \App\Support\Housing2Lang::t('Sistem rekod bagi pengurusan RUMAH SEWA (RS) & KUARTERS (IQ)') }}</span>
        </div>
        <div class="mode-switch">
            <a href="{{ route('housing2.view-mode', 'user') }}" class="{{ $housing2ViewMode === 'user' ? 'active' : '' }}">{{ \App\Support\Housing2Lang::t('User') }}</a>
            <a href="{{ route('housing2.view-mode', 'admin') }}" class="{{ $housing2ViewMode === 'admin' ? 'active' : '' }}">{{ \App\Support\Housing2Lang::t('Admin') }}</a>
        </div>
        <div class="lang-switch">
            <a href="{{ route('housing2.lang', 'ms') }}" class="{{ \App\Support\Housing2Lang::locale() === 'ms' ? 'active' : '' }}">Bahasa Melayu</a>
            <a href="{{ route('housing2.lang', 'en') }}" class="{{ \App\Support\Housing2Lang::locale() === 'en' ? 'active' : '' }}">English</a>
        </div>
        <a class="btn-theme" href="{{ route('housing2.theme', $housing2Theme === 'dark' ? 'light' : 'dark') }}"
           title="{{ $housing2Theme === 'dark' ? 'Light Mode' : 'Night Mode' }}" aria-label="Toggle night mode">
            @if ($housing2Theme === 'dark')
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" width="17" height="17">
                    <circle cx="12" cy="12" r="4.5" />
                    <path d="M12 2.5v2M12 19.5v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M2.5 12h2M19.5 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4" />
                </svg>
            @else
                <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16">
                    <path d="M20.7 14.4A8.5 8.5 0 0 1 9.6 3.3a.7.7 0 0 0-.9-.9A10 10 0 1 0 21.6 15.3a.7.7 0 0 0-.9-.9Z" />
                </svg>
            @endif
        </a>
        <img class="moe-logo" src="{{ asset('assets/img/moe-logo-latest-white.png') }}" alt="Kementerian Pendidikan, Negara Brunei Darussalam">
    </header>

    <div class="body">
        @include('partials.housing2-sidebar')
        <main>
            @yield('content')
        </main>
    </div>
</div>

@if (session('berjaya'))
    <div class="toast" id="toast">
        <div>
            <div class="check">&check;</div>
            <div class="h" style="font-size:26px">{{ \App\Support\Housing2Lang::t(session('berjaya')) }}</div>
            <p class="muted" style="margin:0">{{ \App\Support\Housing2Lang::t('Rekod telah dikemaskini dalam sistem.') }}</p>
            <button type="button" class="btn btn-primary" onclick="document.getElementById('toast').remove()">{{ \App\Support\Housing2Lang::t('Balik') }}</button>
        </div>
    </div>
@endif

@if (session('ralat'))
    <div class="toast" id="toast-ralat">
        <div>
            <div class="check" style="border-color:#b3261e;color:#b3261e">&times;</div>
            <div class="h" style="font-size:22px">{{ \App\Support\Housing2Lang::t(session('ralat')) }}</div>
            <button type="button" class="btn btn-primary" onclick="document.getElementById('toast-ralat').remove()">{{ \App\Support\Housing2Lang::t('Balik') }}</button>
        </div>
    </div>
@endif
@stack('scripts')
<script src="{{ asset('js/particles.min.js') }}"></script>
<script>
    particlesJS('housing2Particles', {
        particles: {
            number: { value: 40, density: { enable: true, value_area: 800 } },
            color: { value: ['#ffffff', '#D0C71E'] },
            shape: { type: 'circle' },
            opacity: { value: 0.6, random: false },
            size: { value: 3, random: true },
            line_linked: { enable: true, distance: 130, color: '#D0C71E', opacity: 0.25, width: 1 },
            move: { enable: true, speed: 6, direction: 'none', random: false, straight: false, out_mode: 'out', bounce: false }
        },
        interactivity: {
            detect_on: 'canvas',
            events: { onhover: { enable: true, mode: 'repulse' }, onclick: { enable: false }, resize: true },
            modes: { repulse: { distance: 120, duration: 0.4 } }
        },
        retina_detect: true
    });

    // The menu sits above the canvas, so forward the sidebar's mouse movement to it.
    (function () {
        const sidebar = document.querySelector('.sidebar');
        const canvas = document.querySelector('#housing2Particles canvas');
        if (!sidebar || !canvas) return;
        sidebar.addEventListener('mousemove', function (e) {
            const rect = canvas.getBoundingClientRect();
            const ev = new MouseEvent('mousemove', { clientX: e.clientX, clientY: e.clientY });
            Object.defineProperty(ev, 'offsetX', { value: e.clientX - rect.left });
            Object.defineProperty(ev, 'offsetY', { value: e.clientY - rect.top });
            canvas.dispatchEvent(ev);
        });
        sidebar.addEventListener('mouseleave', function () {
            canvas.dispatchEvent(new MouseEvent('mouseleave'));
        });
    })();
</script>
</body>
</html>
