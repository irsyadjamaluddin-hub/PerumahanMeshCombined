<!DOCTYPE html>
@php
    $kkkRole = session('kkk_role');
    $kkkNav = [
        'kkk.rekod' => ['route' => 'rekod', 'label' => 'Peminjaman Kunci Kira-Kira', 'roles' => ['pemohon', 'ketua_sub', 'pengawas']],
        'kkk.pemeriksaan' => ['route' => 'pemeriksaan', 'label' => 'Pemeriksaan Kunci Kira-Kira', 'roles' => ['ketua_sub', 'pengawas']],
        'kkk.pencapaian' => ['route' => 'pencapaian', 'label' => 'Pencapaian Pemeriksaan', 'roles' => ['ketua_sub', 'pengawas']],
        'kkk.dashboard' => ['route' => 'dashboard', 'label' => 'Dashboard Pegawai', 'roles' => ['ketua_sub', 'pengawas']],
        'kkk.exec' => ['route' => 'exec', 'label' => 'Dashboard Eksekutif', 'roles' => ['ketua_sub', 'pengawas']],
        'kkk.sekolah' => ['route' => 'sekolah', 'label' => 'Sekolah & Pemimpin', 'roles' => ['ketua_sub', 'pengawas']],
        'kkk.import' => ['route' => 'import', 'label' => 'Import Excel', 'roles' => ['pengawas']],
        'kkk.audit' => ['route' => 'audit', 'label' => 'Log Audit', 'roles' => ['ketua_sub', 'pengawas']],
    ];
    $kkkTheme = session('kkk_theme', 'light');
@endphp
<html lang="{{ \App\Support\KkkLang::locale() }}" data-theme="{{ $kkkTheme }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistem Kunci Kira-Kira')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/kkk.css') }}?v={{ filemtime(public_path('css/kkk.css')) }}">
</head>
<body class="kkk">
<div class="kkk-shell">
    <header class="kkk-topbar">
        <a class="kkk-topbar-home" href="{{ route('superadmindashboard') }}" title="Home" aria-label="Home">
            <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
            </svg>
        </a>

        <a class="kkk-topbar-brand" href="{{ route('kkk.rekod') }}">
            <span class="kkk-topbar-title">{{ \App\Support\KkkLang::t('Sistem Kunci Kira-Kira') }}</span>
            <span class="kkk-topbar-sub">{{ \App\Support\KkkLang::t('Kunci Kira-Kira Sekolah') }}</span>
        </a>

        @if ($kkkRole)
            <div class="kkk-role-switch">
                @foreach (['pemohon' => 'Pemohon', 'ketua_sub' => 'Ketua Sub Unit Pentadbiran', 'pengawas' => 'Pengawas Bilik & Stor KKK'] as $roleKey => $roleLabel)
                    <a href="{{ route('kkk.switch-role', $roleKey) }}" class="{{ $kkkRole === $roleKey ? 'active' : '' }}">{{ \App\Support\KkkLang::t($roleLabel) }}</a>
                @endforeach
            </div>
        @endif

        <div class="kkk-lang-switch">
            <a href="{{ route('kkk.lang', 'ms') }}" class="{{ \App\Support\KkkLang::locale() === 'ms' ? 'active' : '' }}">Bahasa Melayu</a>
            <a href="{{ route('kkk.lang', 'en') }}" class="{{ \App\Support\KkkLang::locale() === 'en' ? 'active' : '' }}">English</a>
        </div>

        <a href="{{ route('kkk.theme', $kkkTheme === 'dark' ? 'light' : 'dark') }}" class="kkk-theme-btn-topbar"
           title="{{ $kkkTheme === 'dark' ? 'Light Mode' : 'Night Mode' }}" aria-label="Toggle night mode">
            @if ($kkkTheme === 'dark')
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

        <img class="kkk-topbar-logo" src="{{ asset('assets/img/moe-logo-latest-white.png') }}" alt="Kementerian Pendidikan, Negara Brunei Darussalam">
    </header>

    <div class="kkk-body">
        <aside class="kkk-sidebar">
            <div class="kkk-particles" id="kkkParticles"></div>
            <div class="kkk-sidebar-content">
                @if ($kkkRole)
                    <div>
                        <h6>{{ \App\Support\KkkLang::t('Papan Utama') }}</h6>
                        <nav class="kkk-nav">
                            @foreach ($kkkNav as $routeName => $item)
                                @if (in_array($kkkRole, $item['roles'], true))
                                    <a href="{{ route($routeName) }}" class="{{ request()->routeIs($routeName) ? 'active' : '' }}">
                                        <span>{{ \App\Support\KkkLang::t($item['label']) }}</span>
                                    </a>
                                @endif
                            @endforeach
                        </nav>
                    </div>
                @endif
            </div>
        </aside>

        <main class="kkk-main">
            @if (session('kkk_berjaya'))
                <div class="kkk-alert ok">&check; {{ \App\Support\KkkLang::t(session('kkk_berjaya')) }}</div>
            @endif
            @if (session('kkk_ralat'))
                <div class="kkk-alert err">&times; {{ \App\Support\KkkLang::t(session('kkk_ralat')) }}</div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
<script src="{{ asset('js/particles.min.js') }}"></script>
<script>
    particlesJS('kkkParticles', {
        particles: {
            number: { value: 40, density: { enable: true, value_area: 800 } },
            {{-- was ['#ffffff', '#D4C820']: white dots vanish on the translucent white panel; rose + gold show on white and on the dark-mode maroon --}}
            color: { value: ['#B5524A', '#D4C820'] },
            shape: { type: 'circle' },
            opacity: { value: 0.6, random: false },
            size: { value: 3, random: true },
            line_linked: { enable: true, distance: 130, color: '#D4C820', opacity: 0.25, width: 1 },
            move: { enable: true, speed: 6, direction: 'none', random: false, straight: false, out_mode: 'out', bounce: false }
        },
        interactivity: {
            detect_on: 'canvas',
            events: { onhover: { enable: true, mode: 'grab' }, onclick: { enable: false }, resize: true },
            modes: { grab: { distance: 160, line_linked: { opacity: 0.7 } } }
        },
        retina_detect: true
    });

    // The menu sits above the canvas, so forward the sidebar's mouse movement to it.
    (function () {
        const sidebar = document.querySelector('.kkk-sidebar');
        const canvas = document.querySelector('#kkkParticles canvas');
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
