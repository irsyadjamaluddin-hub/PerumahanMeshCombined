{{-- OLD VERSION (oldver-2025-2026septver): full copy of resources/views/hrs/layouts/landing.blade.php taken on 29 Sept 2026, just before the old code was --}}
{{-- removed from it. Old code is in the "ORIGINAL CODE" / "OLD ... kept for reference" blocks. Not used by any route. --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    {{-- =============== NISAH =============== --}}
    {{-- MESH v4 redesign fonts (additive -- existing Open Sans/Nunito/Poppins above are kept) --}}
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700;800&family=Anton&display=swap" rel="stylesheet">
    {{-- =============================================== --}}

    <!-- Mesh Admin Template CSS (header + sidebar) -->
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

    {{-- =============== NISAH =============== --}}
    {{-- MESH v4 redesign (scoped under .mesh-v4-sidebar/.mesh-v4-header -- does not override admin.css) --}}
    {{-- Same stylesheet used by layouts/app-all.blade.php and layouts/app-pdms.blade.php --}}
    <link href="{{ asset('css/mesh-v4.css') }}?v={{ filemtime(public_path('css/mesh-v4.css')) }}" rel="stylesheet">
    {{-- =============================================== --}}
</head>

{{-- MESH Smart Bot --}}
    {{-- @include('inc.smartbot') --}} {{-- SmartBot disabled temporarily --}}

{{-- =============== ORIGINAL CODE =============== --}}
{{-- <body> --}}
{{-- =============== NISAH =============== --}}
<body class="mesh-v4-page">
{{-- =============================================== --}}

    {{-- ============ OLD HEADER (pre MESH v4 redesign) — kept for reference, do not delete ============
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="/home" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">M E S H</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-person-fill"></i>
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                    </a><!-- End Profile Image Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('biodatas.biodata.show', [Auth::user()->ic_no]) }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('change_password') }}">
                                <i class="bi bi-key-fill"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#"
                               onclick="event.preventDefault(); document.getElementById('mesh-logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                            <form id="mesh-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul><!-- End Profile Dropdown Items -->

                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->
    ============ END OLD HEADER ============ --}}

    <!-- ======= Header (MESH v4) ======= -->
    <header id="header" class="header mesh-v4-header fixed-top">
        <button id="meshSidebarToggle" type="button" class="mesh-toggle-btn" aria-label="Toggle menu">
            <i class="bi bi-list"></i>
        </button>

        <div>
            <p class="mesh-page-title">{{ $pagename ?? 'HRIDS' }}</p>
            <p class="mesh-page-subtitle">Ministry of Education &middot; Employee &amp; Services Hub (MESH)</p>
        </div>

        <div class="mesh-header-right">
            {{-- =============== ORIGINAL CODE =============== --}}
            {{--
            <span class="mesh-bell-btn" aria-hidden="true">
                <i class="bi bi-bell"></i>
            </span>
            --}}
            {{-- =============== NISAH =============== --}}
            {{-- Announcements bell, same as layouts/app-all.blade.php (Sept 2026) — was decorative only. Latest 4 announcements --}}
            {{-- are loaded here once; inc/announcement-bell-modals.blade.php (near the end of <body>) reuses the same list. --}}
            @php
                $meshBellAnnouncements = \App\Models\Announcement::orderBy('created_at', 'DESC')->take(4)->get();
            @endphp
            @include('inc.announcement-bell')
            {{-- =============================================== --}}

            <div class="dropdown">
                <a href="#" class="mesh-user-chip dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="mesh-user-avatar">{{ Str::upper(Str::substr(Auth::user()->name, 0, 1)) }}</span>
                    <span class="mesh-user-name">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('biodatas.biodata.show', [Auth::user()->ic_no]) }}">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('change_password') }}">
                            <i class="bi bi-key-fill"></i>
                            <span>Change Password</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#"
                           onclick="event.preventDefault(); document.getElementById('mesh-logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                        <form id="mesh-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header><!-- End Header -->

    {{-- ============ OLD SIDEBAR (pre MESH v4 redesign) — kept for reference, do not delete ============
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            @if (Auth::check())
                @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PDMS_ADMIN')
                    || Auth::user()->hasRole('ROLE_PDMS_SERVICE') || Auth::user()->hasRole('ROLE_PDMS_CUTI'))
                    <li class="nav-heading">MESH</li>

                    <li class="nav-item">
                        <a class="@if(($pagename ?? '') == 'pdmshome') nav-link @else nav-link collapsed @endif" href="{{ route('pdmshome') }}">
                            <i class="bi bi-pc-display"></i>
                            <span>Admin Home</span>
                        </a>
                    </li><!-- End Home-->
                @endif
            @endif

            <li class="nav-heading">Main Menu</li>

            <li class="nav-item">
                <a class="@if(($pagename ?? '') == 'home') nav-link @else nav-link collapsed @endif" href="{{ route('home') }}">
                    <i class="bi bi-house-fill"></i>
                    <span>Home</span>
                </a>
            </li><!-- End Home-->

            <li class="nav-item">
                <a class="@if(($pagename ?? '') == 'Profile') nav-link @else nav-link collapsed @endif" href="{{ route('biodatas.biodata.show', [Auth::user()->ic_no]) }}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="@if(in_array(($pagename ?? ''), ['Dashboard', 'Report', 'ARTReport', 'JPKKReport', 'Status Jawatan Kosong Report'])) nav-link @else nav-link collapsed @endif" data-bs-target="#dash-nav" data-bs-toggle="collapse" href="{{ route('home') }}">
                    <i class="bi bi-grid"></i><span>Dashboard</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="dash-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    @if (Auth::check())
                        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MGT'))
                            <li>
                                <a class="@if(($pagename ?? '') == 'Report') nav-link @else nav-link collapsed @endif" href="{{ route('homereport') }}">
                                    <i class="bi bi-circle"></i><span>Users Report</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check())
                        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MGT'))
                            <li>
                                <a class="@if(($pagename ?? '') == 'ARTReport') nav-link @else nav-link collapsed @endif" href="{{ route('artreport') }}">
                                    <i class="bi bi-circle"></i><span>ART Report</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check())
                        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PPSDASHBOARD'))
                            <li>
                                <a class="@if(($pagename ?? '') == 'PPSVisitor') nav-link @else nav-link collapsed @endif" href="{{ route('ppsvisitor') }}">
                                    <i class="bi bi-circle"></i><span>PPS Visitors</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check())
                        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MGT') || Auth::user()->hasRole('ROLE_CCA_ADMIN'))
                            <li>
                                <a class="@if(($pagename ?? '') == 'JPKKReport') nav-link @else nav-link collapsed @endif" href="{{ route('ccareport') }}">
                                    <i class="bi bi-circle"></i><span>JPKK Report</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check())
                        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PRESTASI') || Auth::user()->hasRole('ROLE_JAWATANKOSONG'))
                            <li>
                                <a class="@if(($pagename ?? '') == 'Status Jawatan Kosong Report') nav-link @else nav-link collapsed @endif" href="{{ route('jawatankosongreport') }}">
                                    <i class="bi bi-circle"></i><span>SJK Report</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check())
                        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
                            <li>
                                <a class="@if(($pagename ?? '') == 'ONS Dashboard Report') nav-link @else nav-link collapsed @endif" href="{{ route('onsdashboard') }}">
                                    <i class="bi bi-circle"></i><span>ONS Report</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check())
                        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_TEGAHAN'))
                            <li>
                                <a class="@if(($pagename ?? '') == 'Suspended Company Report') nav-link @else nav-link collapsed @endif" href="{{ route('msc.mscindex') }}">
                                    <i class="bi bi-circle"></i><span>Tegahan Report</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check() && Auth::user()->hasRole('ROLE_SUPERADMIN'))
                        <li>
                            <a class="@if(($pagename ?? '') == 'GenAI Report') nav-link @else nav-link collapsed @endif"
                               href="{{ route('genai.report') }}">
                                <i class="bi bi-circle"></i><span>GenAI Report</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            <!-- MOE INFO -->
            <li class="nav-item">
                <a class="@if(($pagename ?? '') == 'Services') nav-link @else nav-link collapsed @endif" href="{{ route('servicesdashboard') }}">
                    <i class="bi bi-list-task"></i><span>Services</span>
                </a>
            </li>

            <li class="nav-heading">Admin</li>

            <!-- Start Admin Tab -->
            @if (Auth::check())
                @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
                    <li class="nav-item">
                        <a class="@if(($pagename ?? '') == 'Super_Admin_Dashboard') nav-link @else nav-link collapsed @endif" href="{{ route('superadmindashboard') }}">
                            <i class="bi bi-menu-button-wide"></i><span>Super Admin</span>
                        </a>
                    </li>
                @elseif (Auth::user()->hasRole('ROLE_CCA_ADMIN') || Auth::user()->hasRole('ROLE_ART_FOCAL') ||
                        Auth::user()->hasRole('ROLE_SSM') || Auth::user()->hasRole('ROLE_PERJAWATAN') ||
                        Auth::user()->hasRole('ROLE_PERMOHONAN') || Auth::user()->hasRole('ROLE_CCA_FOCAL') ||
                        Auth::user()->hasRole('ROLE_OSCROOM') || Auth::user()->hasRole('ROLE_FOCALADMIN_COMPETENCY') ||
                        Auth::user()->hasRole('ROLE_OSC_OP') || Auth::user()->hasRole('ROLE_DESPATCH') ||
                        Auth::user()->hasRole('ROLE_QUESTION&ANSWER') || Auth::user()->hasRole('ROLE_ONS_ADMIN') ||
                        Auth::user()->hasRole('ROLE_MOEEVENT') || Auth::user()->hasRole('ROLE_SLIPKEHADIRAN') ||
                        Auth::user()->hasRole('ROLE_PRESTASI') ||
                        Auth::user()->hasRole('ROLE_DATAKERAMAIAN') ||
                        Auth::user()->hasRole('ROLE_ADMIN_PERUMAHAN') ||
                        Auth::user()->hasRole('ROLE_HRIDS') ||
                        Auth::user()->hasRole('ROLE_DATAKEHADIRAN') || Auth::user()->hasRole('ROLE_ATTENDANCE_EVENT') || Auth::user()->hasRole('ROLE_EMINITADMIN') ||
                        Auth::user()->hasRole('ROLE_CDDINVENTORY'))
                    <li class="nav-item">
                        <a class="@if(($pagename ?? '') == 'Admin_Dashboard') nav-link @else nav-link collapsed @endif" href="{{ route('admindashboard') }}">
                            <i class="bi bi-menu-button-wide"></i><span>Admin</span>
                        </a>
                    </li>
                @endif
            @endif

            <!-- Start User Tab -->
            @if (Auth::check())
                @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
                    <li class="nav-item">
                        <a class="@if(in_array(($pagename ?? ''), ['Super_Admin_Role_User', 'Admin_User_Profile', 'Admin_List_Of_User'])) nav-link @else nav-link collapsed @endif" data-bs-target="#adminuser-nav" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                    </li>
                @endif
            @endif

            <ul id="adminuser-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                @if (Auth::check())
                    @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
                        <li class="nav-item">
                            <a class="@if(($pagename ?? '') == 'Admin_User_Profile') nav-link @else nav-link collapsed @endif" href="{{ route('profileusers.profileuser.index') }}">
                                <i class="bi bi-circle"></i>
                                <span>Profile</span>
                            </a>
                        </li><!-- End Role User Page Nav -->
                    @endif
                @endif

                @if (Auth::check())
                    @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
                        <li class="nav-item">
                            <a class="@if(($pagename ?? '') == 'Admin_List_Of_User') nav-link @else nav-link collapsed @endif" href="{{ route('users.user.index') }}">
                                <i class="bi bi-circle"></i>
                                <span>List/Verify</span>
                            </a>
                        </li><!-- End Role User Page Nav -->
                    @endif
                @endif
            </ul>

            <!-- Start Role Request Tab -->
            @if (Auth::check())
                @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#adminuser-nav-request" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-file-earmark-person-fill"></i>
                            <span>Role</span>
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                    </li>
                @endif
            @endif

            <!-- Role -->
            <ul id="adminuser-nav-request" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li class="nav-item">
                    <a class="@if(($pagename ?? '') == 'Super_Admin_Role_User') nav-link @else nav-link collapsed @endif" href="{{ route('role_users.role_user.index') }}">
                        <i class="bi bi-circle"></i>
                        <span>Assigned Role</span>
                    </a>
                </li><!-- End Role User Page Nav -->
            </ul>

            <!-- Role Request -->
            <ul id="adminuser-nav-request" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li class="nav-item">
                    <a class="@if(($pagename ?? '') == 'Super_Admin_Role_User') nav-link @else nav-link collapsed @endif" href="{{ route('permohonanrole.permohonanrole.indexadmin') }}">
                        <i class="bi bi-circle"></i>
                        <span>Request Role</span>
                    </a>
                </li><!-- End Role User Page Nav -->
            </ul>

        </ul>
    </aside><!-- End Sidebar-->
    ============ END OLD SIDEBAR ============ --}}

    <!-- Backdrop for the off-canvas sidebar on narrow screens (<992px) -->
    <div class="mesh-sidebar-backdrop" data-mesh-sidebar-backdrop></div>

    <!-- ======= Sidebar (MESH v4) ======= -->
    <aside id="sidebar" class="sidebar mesh-v4-sidebar">

        <div id="mesh-sidebar-particles" class="mesh-sidebar-particles" aria-hidden="true"></div>

        <div class="mesh-brand">
            {{-- =============== NISAH =============== --}}
            {{-- Brunei crest on the left of the MESH title (styles: .mesh-brand-logo in public/css/mesh-v4.css) --}}
            <div class="mesh-brand-logo"><img src="{{ asset('assets/img/logo.png') }}" alt="Brunei Darussalam crest"></div>
            {{-- =============================================== --}}
            <div class="mesh-brand-text">
                <div class="mesh-brand-title">M E S H</div>
                <div class="mesh-brand-sub">EMPLOYEE &amp; SERVICES HUB</div>
            </div>
        </div>

        <ul class="sidebar-nav" id="sidebar-nav">

            @if (Auth::check())
                @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PDMS_ADMIN')
                    || Auth::user()->hasRole('ROLE_PDMS_SERVICE') || Auth::user()->hasRole('ROLE_PDMS_CUTI'))
                    <li class="mesh-nav-heading">MESH</li>

                    <li class="nav-item">
                        <a class="@if(($pagename ?? '') == 'pdmshome') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('pdmshome') }}">
                            <i class="bi bi-pc-display"></i>
                            <span>Admin Home</span>
                        </a>
                    </li><!-- End Home-->
                @endif
            @endif

            <li class="mesh-nav-heading">Main Menu</li>

            <li class="nav-item">
                <a class="@if(($pagename ?? '') == 'home') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('home') }}">
                    <i class="bi bi-house-fill"></i>
                    <span>Home</span>
                </a>
            </li><!-- End Home-->

            <li class="nav-item">
                <a class="@if(($pagename ?? '') == 'Profile') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('biodatas.biodata.show', [Auth::user()->ic_no]) }}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="@if(in_array(($pagename ?? ''), ['Dashboard', 'Report', 'ARTReport', 'JPKKReport', 'Status Jawatan Kosong Report'])) mesh-nav-link mesh-active @else mesh-nav-link @endif" data-bs-target="#dash-nav" data-bs-toggle="collapse" href="{{ route('home') }}">
                    <i class="bi bi-grid"></i><span>Dashboard</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="dash-nav" class="nav-content mesh-sub-nav collapse " data-bs-parent="#sidebar-nav">

                    @if (Auth::check())
                        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MGT'))
                            <li>
                                <a class="@if(($pagename ?? '') == 'Report') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('homereport') }}">
                                    <i class="bi bi-circle"></i><span>Users Report</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check())
                        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MGT'))
                            <li>
                                <a class="@if(($pagename ?? '') == 'ARTReport') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('artreport') }}">
                                    <i class="bi bi-circle"></i><span>ART Report</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check())
                        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PPSDASHBOARD'))
                            <li>
                                <a class="@if(($pagename ?? '') == 'PPSVisitor') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('ppsvisitor') }}">
                                    <i class="bi bi-circle"></i><span>PPS Visitors</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check())
                        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MGT') || Auth::user()->hasRole('ROLE_CCA_ADMIN'))
                            <li>
                                <a class="@if(($pagename ?? '') == 'JPKKReport') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('ccareport') }}">
                                    <i class="bi bi-circle"></i><span>JPKK Report</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check())
                        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PRESTASI') || Auth::user()->hasRole('ROLE_JAWATANKOSONG'))
                            <li>
                                <a class="@if(($pagename ?? '') == 'Status Jawatan Kosong Report') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('jawatankosongreport') }}">
                                    <i class="bi bi-circle"></i><span>SJK Report</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check())
                        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
                            <li>
                                <a class="@if(($pagename ?? '') == 'ONS Dashboard Report') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('onsdashboard') }}">
                                    <i class="bi bi-circle"></i><span>ONS Report</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check())
                        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_TEGAHAN'))
                            <li>
                                <a class="@if(($pagename ?? '') == 'Suspended Company Report') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('msc.mscindex') }}">
                                    <i class="bi bi-circle"></i><span>Tegahan Report</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check() && Auth::user()->hasRole('ROLE_SUPERADMIN'))
                        <li>
                            <a class="@if(($pagename ?? '') == 'GenAI Report') mesh-nav-link mesh-active @else mesh-nav-link @endif"
                               href="{{ route('genai.report') }}">
                                <i class="bi bi-circle"></i><span>GenAI Report</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            <!-- MOE INFO -->
            {{-- =============== ORIGINAL CODE =============== --}}
            {{--
            <li class="nav-item">
                <a class="@if(($pagename ?? '') == 'Services') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('servicesdashboard') }}">
                    <i class="bi bi-list-task"></i><span>Services</span>
                </a>
            </li>
            --}}
            {{-- =============== NISAH =============== --}}
            {{-- Services link hidden from the sidebar (Sept 2026), same as layouts/app-all.blade.php — the Home page now lists all services. --}}
            {{-- =============================================== --}}

            <li class="mesh-nav-heading">Admin</li>

            <!-- Start Admin Tab -->
            @if (Auth::check())
                @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
                    <li class="nav-item">
                        <a class="@if(($pagename ?? '') == 'Super_Admin_Dashboard') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('superadmindashboard') }}">
                            <i class="bi bi-menu-button-wide"></i><span>Super Admin</span>
                        </a>
                    </li>
                @elseif (Auth::user()->hasRole('ROLE_CCA_ADMIN') || Auth::user()->hasRole('ROLE_ART_FOCAL') ||
                        Auth::user()->hasRole('ROLE_SSM') || Auth::user()->hasRole('ROLE_PERJAWATAN') ||
                        Auth::user()->hasRole('ROLE_PERMOHONAN') || Auth::user()->hasRole('ROLE_CCA_FOCAL') ||
                        Auth::user()->hasRole('ROLE_OSCROOM') || Auth::user()->hasRole('ROLE_FOCALADMIN_COMPETENCY') ||
                        Auth::user()->hasRole('ROLE_OSC_OP') || Auth::user()->hasRole('ROLE_DESPATCH') ||
                        Auth::user()->hasRole('ROLE_QUESTION&ANSWER') || Auth::user()->hasRole('ROLE_ONS_ADMIN') ||
                        Auth::user()->hasRole('ROLE_MOEEVENT') || Auth::user()->hasRole('ROLE_SLIPKEHADIRAN') ||
                        Auth::user()->hasRole('ROLE_PRESTASI') ||
                        Auth::user()->hasRole('ROLE_DATAKERAMAIAN') ||
                        Auth::user()->hasRole('ROLE_ADMIN_PERUMAHAN') ||
                        Auth::user()->hasRole('ROLE_HRIDS') ||
                        Auth::user()->hasRole('ROLE_DATAKEHADIRAN') || Auth::user()->hasRole('ROLE_ATTENDANCE_EVENT') || Auth::user()->hasRole('ROLE_EMINITADMIN') ||
                        Auth::user()->hasRole('ROLE_CDDINVENTORY'))
                    <li class="nav-item">
                        <a class="@if(($pagename ?? '') == 'Admin_Dashboard') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('admindashboard') }}">
                            <i class="bi bi-menu-button-wide"></i><span>Admin</span>
                        </a>
                    </li>
                @endif
            @endif

            <!-- Start User Tab -->
            @if (Auth::check())
                @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
                    <li class="nav-item">
                        <a class="@if(in_array(($pagename ?? ''), ['Super_Admin_Role_User', 'Admin_User_Profile', 'Admin_List_Of_User'])) mesh-nav-link mesh-active @else mesh-nav-link @endif" data-bs-target="#adminuser-nav" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                    </li>
                @endif
            @endif

            <ul id="adminuser-nav" class="nav-content mesh-sub-nav collapse " data-bs-parent="#sidebar-nav">

                @if (Auth::check())
                    @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
                        <li class="nav-item">
                            <a class="@if(($pagename ?? '') == 'Admin_User_Profile') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('profileusers.profileuser.index') }}">
                                <i class="bi bi-circle"></i>
                                <span>Profile</span>
                            </a>
                        </li><!-- End Role User Page Nav -->
                    @endif
                @endif

                @if (Auth::check())
                    @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
                        <li class="nav-item">
                            <a class="@if(($pagename ?? '') == 'Admin_List_Of_User') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('users.user.index') }}">
                                <i class="bi bi-circle"></i>
                                <span>List/Verify</span>
                            </a>
                        </li><!-- End Role User Page Nav -->
                    @endif
                @endif
            </ul>

            <!-- Start Role Request Tab -->
            @if (Auth::check())
                @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
                    <li class="nav-item">
                        <a class="mesh-nav-link" data-bs-target="#adminuser-nav-request" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-file-earmark-person-fill"></i>
                            <span>Role</span>
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                    </li>
                @endif
            @endif

            <!-- Role -->
            <ul id="adminuser-nav-request" class="nav-content mesh-sub-nav collapse" data-bs-parent="#sidebar-nav">
                <li class="nav-item">
                    <a class="@if(($pagename ?? '') == 'Super_Admin_Role_User') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('role_users.role_user.index') }}">
                        <i class="bi bi-circle"></i>
                        <span>Assigned Role</span>
                    </a>
                </li><!-- End Role User Page Nav -->
            </ul>

            <!-- Role Request -->
            <ul id="adminuser-nav-request" class="nav-content mesh-sub-nav collapse" data-bs-parent="#sidebar-nav">
                <li class="nav-item">
                    <a class="@if(($pagename ?? '') == 'Super_Admin_Role_User') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('permohonanrole.permohonanrole.indexadmin') }}">
                        <i class="bi bi-circle"></i>
                        <span>Request Role</span>
                    </a>
                </li><!-- End Role User Page Nav -->
            </ul>

        </ul>
    </aside><!-- End Sidebar (MESH v4) -->

    <main id="main" class="main">
        @yield('content')
    </main><!-- End #main -->

    {{-- =============== NISAH =============== --}}
    {{-- Footer didn't exist in this layout before -- added to match the current design used by --}}
    {{-- layouts/app-all.blade.php and layouts/app-pdms.blade.php --}}
    <footer id="footer" class="footer mesh-v4-footer">
        <img src="{{ asset('assets/img/logo.png') }}" alt="">
        <span class="mesh-footer-text" title="Developed by: Saidatul Ekma (MESH Lead Developer), Laila Khamis(EASE Lead Developer), Nurul Hasinah(Database Administrator), Nadzirah Ali Hassim(Programmer), Wan Arif(Project Officer), Lyanna Karim (MESH Layout & Design)">
            Ministry of Education &copy; 2026 All Rights Reserved. Powered by DevOps ICT.
        </span>
        <span class="mesh-footer-version">v4.0</span>
    </footer><!-- End Footer (MESH v4) -->
    {{-- =============================================== --}}

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- =============== NISAH =============== --}}
    {{-- Header bell's announcement popups + dropdown script, at <body> level so the popups aren't trapped under the --}}
    {{-- fixed header. Must stay ABOVE mesh-v4.js: it adds the poster lightbox on pages that don't already have one. --}}
    @include('inc.announcement-bell-modals')
    {{-- =============================================== --}}

    {{-- =============== NISAH =============== --}}
    {{-- MESH v4 redesign: sidebar particle background + collapse/lightbox toggle (same as layouts/app-all.blade.php) --}}
    {{-- Fix: mesh-v4.js is `(function($){...})(jQuery)` -- it needs jQuery as a global, but unlike
         layouts/app-all.blade.php / app-pdms.blade.php this layout never loaded jQuery, so that line
         threw "jQuery is not defined" and silently killed the whole script -- both the hamburger
         toggle AND the particle init, since they're both inside it. Same slim build/CDN as
         hrs/layouts/app-minimal.blade.php, loaded right before the script that needs it. --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="{{ asset('js/particles.min.js') }}"></script>
    <script src="{{ asset('js/mesh-v4.js') }}?v={{ filemtime(public_path('js/mesh-v4.js')) }}"></script>
    {{-- =============================================== --}}

</body>
</html>
