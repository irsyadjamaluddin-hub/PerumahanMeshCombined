{{-- OLD VERSION (oldver-2025-2026septver): full copy of resources/views/layouts/app-all.blade.php taken on 29 Sept 2026, just before the old code was --}}
{{-- removed from it. Old code is in the "ORIGINAL CODE" / "OLD ... kept for reference" blocks. Not used by any route. --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="{{asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css' rel="stylesheet"/>

<!-- MEETING ROOM-->

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
    
    
  <link href="{{asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- dropdown -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    
    
  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i,800|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- MESH v4 redesign fonts (additive — existing Open Sans/Nunito/Poppins above are kept, other pages still use them) -->
  <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700;800&family=Anton&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
  <script src="{{ asset('assets/js/apexcharts-bundle.js') }}"></script>

  <!-- MESH v4 redesign (scoped under .mesh-v4-sidebar/.mesh-v4-header — does not override admin.css) -->
  <link href="{{ asset('css/mesh-v4.css') }}?v={{ filemtime(public_path('css/mesh-v4.css')) }}" rel="stylesheet">

  <!-- {{-- Tailwind CSS --}} -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.1.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <!-- Jquery UI (date-picker) -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  
  <!-- Bootstrap table with add new row button-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
  function toggle1(){
    var x = document.getElementById("btn-submit");
    
      x.style.display = "block";
   
  }
  </script>
  
  <script>
  function toggle2(){
    var x = document.getElementById("btn-submit");
    
      x.style.display = "block";
   
  }
  </script>
  
  <script>
  function toggle3(){
    var x = document.getElementById("btn-submit");
    
      x.style.display = "block";
   
  }
  </script>
  
  <script>
  function toggle4(){
    var x = document.getElementById("btn-submit");
    
      x.style.display = "block";
   
  }
  </script>
  
  <script>
  function toggle5(){
    var x = document.getElementById("btn-submit");
    
      x.style.display = "block";
   
  }
  </script>
  
  
  <script>
  function toggle6(){
    var x = document.getElementById("btn-submit");
    
      x.style.display = "none";
   
  }
  </script>

  <style>
    .check {
        border: 2px solid red;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;  
    }

    .line-clamp-4 {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;  
    }

    .collapse{
        visibility: visible !important;
    }

    .btn-primary{
        background-color: #0d6efd !important;
    }

    .dataTable-input{
        border-width: 2px !important;
    }

    .dataTable-selector{
        border-width: 2px !important;
    }

    .btn-success{
        background-color: #198754 !important;
    }

    #pgap {
        margin-bottom: 0px !important;
    }

    #justify {
        text-align: justify;
        text-justify: inter-word;
    }

    #background {
        background: #f6f9ff;
    }

    #announcementgap {
        margin-top: 0px !important;
    }

    #announcementtextgap {
        padding-left: 4rem;
    }

    .labeledit {
      font-weight: 600;
      color: rgba(1, 41, 112, 0.6);
      width: 25%;
      font-size: 15px;
    }

    .labeleditgap {
      margin-bottom: 25px;
    }
  </style>

</head>

<body class="mesh-v4-page">

  <!-- MESH v4: shared decorative "network/mesh" SVG pattern, reused by the sidebar
       brand area and the announcement/news modal cover panels via <use href="#netmesh">. -->
  <svg width="0" height="0" style="position:absolute" aria-hidden="true">
    <symbol id="netmesh" viewBox="0 0 800 400" preserveAspectRatio="xMidYMid slice">
      <g stroke="currentColor" stroke-width="0.7" fill="none" opacity="0.9">
        <path d="M20 40 110 15 195 80 285 25 370 95 455 30 545 85 630 20 715 75 790 25"></path>
        <path d="M60 150 150 205 240 140 330 190 420 150 505 210 590 145 680 200 770 140"></path>
        <path d="M25 290 115 340 205 275 295 330 385 270 470 335 560 280 650 330 740 275"></path>
        <path d="M20 40 60 150 25 290 115 340 90 395"></path>
        <path d="M110 15 150 205 205 275 300 398"></path>
        <path d="M195 80 240 140 295 330"></path>
        <path d="M285 25 330 190 385 270 520 392"></path>
        <path d="M370 95 420 150 470 335"></path>
        <path d="M455 30 505 210 560 280 700 398"></path>
        <path d="M545 85 590 145 650 330"></path>
        <path d="M630 20 680 200 740 275"></path>
        <path d="M715 75 770 140 790 25"></path>
        <path d="M60 150 195 80 330 190 455 30 590 145 715 75"></path>
        <path d="M115 340 240 140 385 270 505 210 650 330 770 140"></path>
        <path d="M25 290 150 205 295 330 420 150 560 280 680 200"></path>
      </g>
      <g fill="currentColor">
        <circle cx="20" cy="40" r="2.4"></circle><circle cx="110" cy="15" r="1.8"></circle><circle cx="195" cy="80" r="2.8"></circle><circle cx="285" cy="25" r="1.8"></circle>
        <circle cx="370" cy="95" r="2.4"></circle><circle cx="455" cy="30" r="2.8"></circle><circle cx="545" cy="85" r="1.8"></circle><circle cx="630" cy="20" r="2.4"></circle>
        <circle cx="715" cy="75" r="2.8"></circle><circle cx="790" cy="25" r="1.8"></circle><circle cx="60" cy="150" r="2.8"></circle><circle cx="150" cy="205" r="2.4"></circle>
        <circle cx="240" cy="140" r="1.8"></circle><circle cx="330" cy="190" r="2.8"></circle><circle cx="420" cy="150" r="2.4"></circle><circle cx="505" cy="210" r="2.8"></circle>
        <circle cx="590" cy="145" r="1.8"></circle><circle cx="680" cy="200" r="2.4"></circle><circle cx="770" cy="140" r="2.8"></circle><circle cx="25" cy="290" r="1.8"></circle>
        <circle cx="115" cy="340" r="2.8"></circle><circle cx="205" cy="275" r="2.4"></circle><circle cx="295" cy="330" r="1.8"></circle><circle cx="385" cy="270" r="2.8"></circle>
        <circle cx="470" cy="335" r="2.4"></circle><circle cx="560" cy="280" r="2.8"></circle><circle cx="650" cy="330" r="1.8"></circle><circle cx="740" cy="275" r="2.4"></circle>
        <circle cx="90" cy="395" r="2.4"></circle><circle cx="300" cy="398" r="1.8"></circle><circle cx="520" cy="392" r="2.4"></circle><circle cx="700" cy="398" r="1.8"></circle>
      </g>
    </symbol>
  </svg>

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
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sign Out</span>
                    </a>
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
      <p class="mesh-page-title">{{ $pagename ?? 'MESH' }}</p>
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
      {{-- The bell is now the announcements dropdown on EVERY page (was decorative only). Latest 4 announcements are --}}
      {{-- loaded here once; inc/announcement-bell-modals.blade.php (near the end of <body>) reuses the same list for the popups. --}}
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
            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
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
        <a class="@if($pagename == 'pdmshome') nav-link @else nav-link collapsed @endif" href="{{ route('pdmshome') }}">
          <i class="bi bi-pc-display"></i>
          <span>Admin Home</span>
        </a>
      </li><!-- End Home-->
      @endif
    @endif
	
	  <li class="nav-heading">Main Menu</li>

	      <li class="nav-item">
        <a class="@if($pagename == 'home') nav-link @else nav-link collapsed @endif" href="{{ route('home') }}">
          <i class="bi bi-house-fill"></i>
          <span>Home</span>
        </a>
      </li><!-- End Home-->

	   <li class="nav-item">
        <a class="@if($pagename == 'Profile') nav-link @else nav-link collapsed @endif" href="{{ route('biodatas.biodata.show', [Auth::user()->ic_no]) }}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <!-- archivephasebyphase -->
    
    <li class="nav-item">
        <a class="@if($pagename == 'Dashboard' || $pagename == 'Report' || $pagename == 'ARTReport' || $pagename == 'JPKKReport'|| $pagename == 'Status Jawatan Kosong Report') nav-link @else nav-link collapsed @endif"  data-bs-target="#dash-nav" data-bs-toggle="collapse" href="{{ route('home') }}">
          <i class="bi bi-grid"></i><span>Dashboard</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      <ul id="dash-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

      <!-- <li>
        <a class="@if($pagename == 'Dashboard') nav-link collapsed @else nav-link collapsed @endif" href="{{ route('home') }}">
          <i class="bi bi-circle"></i><span>Welcome</span>
        </a>
      </li> -->

      @if (Auth::check())
         @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MGT'))
      <li>
        <a class="@if($pagename == 'Report') nav-link @else nav-link collapsed @endif" href="{{ route('homereport') }}">
          <i class="bi bi-circle"></i><span>Users Report</span>
        </a>
      </li>
         @endif
        @endif

        @if (Auth::check())
         @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MGT'))
        <li>
        <a class="@if($pagename == 'ARTReport') nav-link @else nav-link collapsed @endif" href="{{ route('artreport') }}">
          <i class="bi bi-circle"></i><span>ART Report</span>
        </a>
      </li>
      @endif
        @endif

        @if (Auth::check())
         @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PPSDASHBOARD'))
        <li>
        <a class="@if($pagename == 'PPSVisitor') nav-link @else nav-link collapsed @endif" href="{{ route('ppsvisitor') }}">
          <i class="bi bi-circle"></i><span>PPS Visitors</span>
        </a>
      </li>
      @endif
        @endif



        @if (Auth::check())
         @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MGT')  || Auth::user()->hasRole('ROLE_CCA_ADMIN'))
        <li>
        <a class="@if($pagename == 'JPKKReport') nav-link @else nav-link collapsed @endif" href="{{ route('ccareport') }}">
          <i class="bi bi-circle"></i><span>JPKK Report</span>
        </a>
      </li>
      @endif
      @endif


        @if (Auth::check())
         @if (Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_PRESTASI') || Auth::user()->hasRole('ROLE_JAWATANKOSONG'))
        <li>
        <a class="@if($pagename == 'Status Jawatan Kosong Report') nav-link @else nav-link collapsed @endif" href="{{ route('jawatankosongreport') }}">
          <i class="bi bi-circle"></i><span>SJK Report</span>
        </a>
      </li>
      @endif
      @endif

       @if (Auth::check())
         @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <li>
        <a class="@if($pagename == 'ONS Dashboard Report') nav-link @else nav-link collapsed @endif" href="{{ route('onsdashboard') }}">
          <i class="bi bi-circle"></i><span>ONS Report</span>
        </a>
      </li>
      @endif
      @endif

      @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_TEGAHAN'))
        <li>
          <a class="@if($pagename == 'Suspended Company Report') nav-link @else nav-link collapsed @endif" href="{{ route('msc.mscindex') }}">
            <i class="bi bi-circle"></i><span>Tegahan Report</span>
          </a>
        </li>
        @endif
      @endif
  

    @if (Auth::check() && Auth::user()->hasRole('ROLE_SUPERADMIN'))
  <li>
    <a class="@if($pagename == 'GenAI Report') nav-link @else nav-link collapsed @endif"
       href="{{ route('genai.report') }}">
      <i class="bi bi-circle"></i><span>GenAI Report</span>
    </a>
  </li>
@endif
</ul>
</li>



<!-- MOE INFO -->

      <li class="nav-item">
        <a class="@if($pagename == 'Services') nav-link @else nav-link collapsed @endif" href="{{ route('servicesdashboard') }}">
          <i class="bi bi-list-task">
          </i><span>Services</span>
        </a>
      </li>
      
      @if(false)
      <li class="nav-item">
        <a class="@if($pagename == 'announcement' || $pagename == 'newsindex') nav-link @else nav-link collapsed @endif"  data-bs-target="#add1-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-info-circle"></i><span> MOE Info</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      <ul id="add1-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

     <li class="nav-item">
        <a class="@if($pagename == 'announcement') nav-link @else nav-link collapsed @endif" href="{{ route('announcement.announcementindex') }}">
          <i class="bi bi-megaphone"></i>
          <span>Announcement</span>
        </a>
      </li><!-- End Announcement Page Nav -->

      <li class="nav-item">
        <a class="@if($pagename == 'newsindex') nav-link @else nav-link collapsed @endif" href="{{ route('news.newsindex') }}">
          <i class="bi bi-newspaper"></i>
          <span>News</span>
        </a>
      </li><!-- End News Page Nav -->

    </ul>
    </li>
    @endif
    <!-- MOE INFO -->

    <!-- @if (Auth::check()) -->
    <!-- @if (Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_ONS_USER')) -->
      <!-- <li class="nav-item" > -->
        <!-- <a class="@if($pagename == 'Online Notification User') nav-link @else nav-link collapsed @endif" > -->
         <!-- <a class="@if($pagename == 'Online Notification User') nav-link @else nav-link collapsed @endif" href="{{ route('onlinenotifications.onlinenotification.indexuser') }}" > -->
          <!-- <a class="@if($pagename == 'Maintenance Page') nav-link @else nav-link collapsed @endif" href="{{ route('maintenance.page') }}" > -->
          <!-- <i class="bi bi-file-text"> -->
          <!-- </i><span>O.N.S 2.0</span> -->
        <!-- </a> -->
      <!-- </li> -->
    <!-- @endif -->
    <!-- @endif -->

       <!-- <li class="nav-item">
        <a class="@if($pagename == 'data_kehadiran') nav-link @else nav-link collapsed @endif" href="{{ route('datakehadiran.datakehadiran.index') }}">
          <i class="bi bi-file-earmark-post">
          </i><span>Data Kehadiran</span>
        </a>
      </li> -->

      <!-- part wani tambah -->
      <li class="nav-item">
        <a class="@if($pagename == 'Calendar') nav-link @else nav-link collapsed @endif" href="{{ route('fsm.fsm.index') }}">
          <i class="bi bi-file-text-fill">
          </i><span>F.S.M</span>
        </a>
      </li>

      <!-- requested by AO to comment this out and not use this code anymore date 10/10/2024 -->
      <!-- <li class="nav-item">
        <a class="@if($pagename == 'Calendar') nav-link @else nav-link collapsed @endif" href="{{ route('adminbooking.systemcalendar') }}">
          <i class="bi bi-calendar-event-fill">
          </i><span>Room Booking</span>
        </a>
      </li> -->


    <!--   <li class="nav-item">
        <a class="@if($pagename == 'prestasi') nav-link @else nav-link collapsed @endif" href="{{ route('prestasi.prestasi.index') }}">
          <i class="bi bi-bookmark-star-fill">
          </i><span>Prestasi</span>
        </a>
      </li> -->


   
<!-- 
	<li class="nav-item">
    		<a class="@if($pagename == 'TaskTracking') nav-link @else nav-link collapsed @endif"href="{{ route('tasktracking.indextasktracking') }}">
        <i class="bi bi-file-earmark-text"></i>
        <span>TaskTracking</span>
    </a>
</li> -->


       <!--- Download Tab Start ------>
    <!-- <li class="nav-item">
        <a class="@if($pagename == 'dp-download') nav-link @else nav-link collapsed @endif"  data-bs-target="#dl-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-download"></i><span>Download</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      <ul id="dl-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

      <li>
        <a class="@if($pagename == 'dp-download') nav-link @else nav-link collapsed @endif" href="/download">
          <i class="bi bi-circle"></i><span>DP</span>
        </a>
      </li>

    </ul>
    </li> -->
    <!---- Download Tab End ------->

    
  

       <!-- MEC MED -->
<!--       <li class="nav-item">
        <a class="@if($pagename == 'DIS' || $pagename == 'MEC') nav-link @else nav-link collapsed @endif"  data-bs-target="#add3-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-article-line"></i><span> MEC MED </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      <ul id="add3-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

  
      <li class="nav-item">
          <a class="@if($pagename == 'DIS') nav-link @else nav-link collapsed @endif"
              href="{{ route('dispatchs.dis.index') }}">
              <i class="ri-article-line">
              </i><span>Despatch</span>
          </a>
      </li>

      <li class="nav-item">
          <a class="@if($pagename == 'MEC') nav-link @else nav-link collapsed @endif"
              href="{{ route('dispatchs.dis.indextindakan') }}">
              <i class="bi bi-person-check-fill">
              </i><span>Correspondence</span>
          </a>
      </li>

    </ul>
    </li> -->
    <!-- MEC MED -->


      @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_TATATERTIB'))
          <li class="nav-item">
            <a class="@if($pagename == 'SSM Tatatertib') nav-link @else nav-link collapsed @endif" href="{{ route('ssmtatatertib.ssmrequest.indextatatertib') }}">
              <i class="bi bi-person-plus"></i>
              <span>SSM Tatatertib</span>
            </a>
          </li>
        @endif
      @endif     

<li class="nav-heading">Admin</li>
    
    <!-- Start Admin Tab -->
    @if (Auth::check())
    @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <li class="nav-item">
            <a class="@if($pagename == 'Super_Admin_Dashboard') nav-link @else nav-link collapsed @endif" href="{{ route('superadmindashboard') }}">
                <i class="bi bi-menu-button-wide"></i><span>Super Admin</span>
            </a>
        </li>
        @elseif (Auth::user()->hasRole('ROLE_CCA_ADMIN') || Auth::user()->hasRole('ROLE_ART_FOCAL') || 
                Auth::user()->hasRole('ROLE_SSM') || Auth::user()->hasRole('ROLE_PERJAWATAN') || 
                Auth::user()->hasRole('ROLE_PERMOHONAN') || Auth::user()->hasRole('ROLE_CCA_FOCAL') || 
                Auth::user()->hasRole('ROLE_OSCROOM') || Auth::user()->hasRole('ROLE_FOCALADMIN_COMPETENCY')|| 
                Auth::user()->hasRole('ROLE_OSC_OP') || Auth::user()->hasRole('ROLE_DESPATCH') || 
                Auth::user()->hasRole('ROLE_QUESTION&ANSWER') || Auth::user()->hasRole('ROLE_ONS_ADMIN') || 
                Auth::user()->hasRole('ROLE_MOEEVENT') || Auth::user()->hasRole('ROLE_SLIPKEHADIRAN') || 
                Auth::user()->hasRole('ROLE_PRESTASI')|| 
                Auth::user()->hasRole('ROLE_DATAKERAMAIAN')|| 
                Auth::user()->hasRole('ROLE_ADMIN_PERUMAHAN')|| 
                Auth::user()->hasRole('ROLE_HRIDS')|| 
                Auth::user()->hasRole('ROLE_DATAKEHADIRAN') || Auth::user()->hasRole('ROLE_ATTENDANCE_EVENT')  || Auth::user()->hasRole('ROLE_EMINITADMIN') ||
                Auth::user()->hasRole('ROLE_CDDINVENTORY'))
            <li class="nav-item">
                <a class="@if($pagename == 'Admin_Dashboard') nav-link @else nav-link collapsed @endif" href="{{ route('admindashboard') }}">
                    <i class="bi bi-menu-button-wide"></i><span>Admin</span>
                </a>
            </li>
        @endif
    @endif

  <!-- Start SSM Tab -->
    @if (Auth::check())
      @if (Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_SSM') || Auth::user()->hasRole('ROLE_ADUANSSM'))
        <li class="nav-item">
          <a class="@if($pagename == 'Admin_SSM' || $pagename == 'SSMSRequest_Admin' || $pagename == 'SSM Permohonan') nav-link @else nav-link collapsed @endif" data-bs-target="#adminssm-nav"  data-bs-toggle="collapse" href="#">
            <i class="bi bi-briefcase-fill"></i><span>SSM Admin</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
        </li>
      @endif
    @endif

    <ul id="adminssm-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">  
      @if (Auth::check())
			  @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_SSM'))
          <li class="nav-item">
            <a class="@if($pagename == 'Admin_SSM') nav-link @else nav-link collapsed @endif" href="{{ route('ssms.ssm.indexall') }}">
              <i class="bi bi-person-check"></i>
              <span>Aktif Akaun SSM</span>
            </a>
          </li>
        @endif
      @endif
      
      @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_SSM') || Auth::user()->hasRole('ROLE_ADUANSSM'))
          <li class="nav-item">
            <a class="@if($pagename == 'SSMSRequest_Admin') nav-link @else nav-link collapsed @endif" href="{{ route('ssmrequests.ssmrequest.indexall') }}">
              <i class="bi bi-person-plus"></i>
              <span>Aduan SSM</span>
            </a>
          </li>
        @endif
      @endif


      @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_SSM'))
          <li class="nav-item">
            <a class="@if($pagename == 'SSM Permohonan') nav-link @else nav-link collapsed @endif" href="{{ route('ssmrequests.ssmrequest.indexpermohonan') }}">
              <i class="bi bi-person-plus"></i>
              <span>Permohonan SSM (Tindakan)</span>
            </a>
          </li>
        @endif
      @endif

      @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_SSM'))
          <li class="nav-item">
            <a class="@if($pagename == 'SSM Penilai Admin') nav-link @else nav-link collapsed @endif" href="{{ route('ssms.penilai.index') }}">
              <i class="bi bi-person-gear"></i>
              <span>SSM Pertukaran Pegawai Penilai</span>
            </a>
          </li>
        @endif
      @endif
    </ul>
  <!-- END SSM Tab -->

  
  @php
          $icNos = \App\Models\SSMKod::pluck('ic_no')->toArray();
      @endphp

      @if (in_array(Auth::user()->ic_no, $icNos))

      <li class="nav-item">
          <a class="@if($pagename == 'SSM_Staff_Permohonan') nav-link @else nav-link collapsed @endif"
              href="{{ route('ssmrequests.ssmrequest.indexstaffpermohonan') }}">
              <i class="bi bi-person-plus">
              </i><span>Permohonan SSM (ST)</span>
          </a>
      </li>

      @endif
  
  <!-- Start User Tab -->
  @if (Auth::check())
    @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
      <li class="nav-item">
        <a class="@if($pagename == 'Super_Admin_Role_User' || $pagename == 'Admin_User_Profile' || $pagename == 'Admin_List_Of_User') nav-link @else nav-link collapsed @endif" data-bs-target="#adminuser-nav"  data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      </li>
    @endif
  @endif

  <ul id="adminuser-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">  
    
    @if (Auth::check())
      @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <li class="nav-item">
          <a class="@if($pagename == 'Admin_User_Profile') nav-link @else nav-link collapsed @endif" href="{{ route('profileusers.profileuser.index') }}">
            <i class="bi bi-circle"></i>
            <span>Profile</span>
          </a>
        </li><!-- End Role User Page Nav -->
      @endif
    @endif


    @if (Auth::check())
      @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <li class="nav-item">
          <a class="@if($pagename == 'Admin_List_Of_User') nav-link @else nav-link collapsed @endif" href="{{ route('users.user.index') }}">
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
        <a class="@if($pagename == 'Super_Admin_Role_User') nav-link @else nav-link collapsed @endif" href="{{ route('role_users.role_user.index') }}">
          <i class="bi bi-circle"></i>
          <span>Assigned Role</span>
        </a>
      </li><!-- End Role User Page Nav -->
    </ul>

    <!-- Role Request -->
    <ul id="adminuser-nav-request" class="nav-content collapse" data-bs-parent="#sidebar-nav">  
      <li class="nav-item">
        <a class="@if($pagename == 'Super_Admin_Role_User') nav-link @else nav-link collapsed @endif" href="{{ route('permohonanrole.permohonanrole.indexadmin') }}">
          <i class="bi bi-circle"></i>
          <span>Request Role</span>
        </a>
      </li><!-- End Role User Page Nav -->
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
        <a class="@if($pagename == 'pdmshome') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('pdmshome') }}">
          <i class="bi bi-pc-display"></i>
          <span>Admin Home</span>
        </a>
      </li><!-- End Home-->
      @endif
    @endif

	  <li class="mesh-nav-heading">Main Menu</li>

	      <li class="nav-item">
        <a class="@if($pagename == 'home') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('home') }}">
          <i class="bi bi-house-fill"></i>
          <span>Home</span>
        </a>
      </li><!-- End Home-->

	   <li class="nav-item">
        <a class="@if($pagename == 'Profile') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('biodatas.biodata.show', [Auth::user()->ic_no]) }}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <!-- archivephasebyphase -->

    <li class="nav-item">
        <a class="@if($pagename == 'Dashboard' || $pagename == 'Report' || $pagename == 'ARTReport' || $pagename == 'JPKKReport'|| $pagename == 'Status Jawatan Kosong Report') mesh-nav-link mesh-active @else mesh-nav-link @endif"  data-bs-target="#dash-nav" data-bs-toggle="collapse" href="{{ route('home') }}">
          <i class="bi bi-grid"></i><span>Dashboard</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      <ul id="dash-nav" class="nav-content mesh-sub-nav collapse " data-bs-parent="#sidebar-nav">

      @if (Auth::check())
         @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MGT'))
      <li>
        <a class="@if($pagename == 'Report') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('homereport') }}">
          <i class="bi bi-circle"></i><span>Users Report</span>
        </a>
      </li>
         @endif
        @endif

        @if (Auth::check())
         @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MGT'))
        <li>
        <a class="@if($pagename == 'ARTReport') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('artreport') }}">
          <i class="bi bi-circle"></i><span>ART Report</span>
        </a>
      </li>
      @endif
        @endif

        @if (Auth::check())
         @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PPSDASHBOARD'))
        <li>
        <a class="@if($pagename == 'PPSVisitor') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('ppsvisitor') }}">
          <i class="bi bi-circle"></i><span>PPS Visitors</span>
        </a>
      </li>
      @endif
        @endif



        @if (Auth::check())
         @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MGT')  || Auth::user()->hasRole('ROLE_CCA_ADMIN'))
        <li>
        <a class="@if($pagename == 'JPKKReport') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('ccareport') }}">
          <i class="bi bi-circle"></i><span>JPKK Report</span>
        </a>
      </li>
      @endif
      @endif


        @if (Auth::check())
         @if (Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_PRESTASI') || Auth::user()->hasRole('ROLE_JAWATANKOSONG'))
        <li>
        <a class="@if($pagename == 'Status Jawatan Kosong Report') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('jawatankosongreport') }}">
          <i class="bi bi-circle"></i><span>SJK Report</span>
        </a>
      </li>
      @endif
      @endif

       @if (Auth::check())
         @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <li>
        <a class="@if($pagename == 'ONS Dashboard Report') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('onsdashboard') }}">
          <i class="bi bi-circle"></i><span>ONS Report</span>
        </a>
      </li>
      @endif
      @endif

      @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_TEGAHAN'))
        <li>
          <a class="@if($pagename == 'Suspended Company Report') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('msc.mscindex') }}">
            <i class="bi bi-circle"></i><span>Tegahan Report</span>
          </a>
        </li>
        @endif
      @endif


    @if (Auth::check() && Auth::user()->hasRole('ROLE_SUPERADMIN'))
  <li>
    <a class="@if($pagename == 'GenAI Report') mesh-nav-link mesh-active @else mesh-nav-link @endif"
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
        <a class="@if($pagename == 'Services') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('servicesdashboard') }}">
          <i class="bi bi-list-task">
          </i><span>Services</span>
        </a>
      </li>

      <!-- part wani tambah -->
      <li class="nav-item">
        <a class="@if($pagename == 'Calendar') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('fsm.fsm.index') }}">
          <i class="bi bi-file-text-fill">
          </i><span>F.S.M</span>
        </a>
      </li>
      --}}
      {{-- =============== NISAH =============== --}}
      {{-- Services and F.S.M links hidden from the sidebar (Sept 2026) — the Home page now lists all services. --}}
      {{-- The pages themselves still work at /servicesdashboard and the F.S.M URL; un-comment the block above to bring the links back. --}}
      {{-- =============================================== --}}

      @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_TATATERTIB'))
          <li class="nav-item">
            <a class="@if($pagename == 'SSM Tatatertib') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('ssmtatatertib.ssmrequest.indextatatertib') }}">
              <i class="bi bi-person-plus"></i>
              <span>SSM Tatatertib</span>
            </a>
          </li>
        @endif
      @endif

<li class="mesh-nav-heading">Admin</li>

    <!-- Start Admin Tab -->
    @if (Auth::check())
    @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <li class="nav-item">
            <a class="@if($pagename == 'Super_Admin_Dashboard') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('superadmindashboard') }}">
                <i class="bi bi-menu-button-wide"></i><span>Super Admin</span>
            </a>
        </li>
        @elseif (Auth::user()->hasRole('ROLE_CCA_ADMIN') || Auth::user()->hasRole('ROLE_ART_FOCAL') ||
                Auth::user()->hasRole('ROLE_SSM') || Auth::user()->hasRole('ROLE_PERJAWATAN') ||
                Auth::user()->hasRole('ROLE_PERMOHONAN') || Auth::user()->hasRole('ROLE_CCA_FOCAL') ||
                Auth::user()->hasRole('ROLE_OSCROOM') || Auth::user()->hasRole('ROLE_FOCALADMIN_COMPETENCY')||
                Auth::user()->hasRole('ROLE_OSC_OP') || Auth::user()->hasRole('ROLE_DESPATCH') ||
                Auth::user()->hasRole('ROLE_QUESTION&ANSWER') || Auth::user()->hasRole('ROLE_ONS_ADMIN') ||
                Auth::user()->hasRole('ROLE_MOEEVENT') || Auth::user()->hasRole('ROLE_SLIPKEHADIRAN') ||
                Auth::user()->hasRole('ROLE_PRESTASI')||
                Auth::user()->hasRole('ROLE_DATAKERAMAIAN')||
                Auth::user()->hasRole('ROLE_ADMIN_PERUMAHAN')||
                Auth::user()->hasRole('ROLE_HRIDS')||
                Auth::user()->hasRole('ROLE_DATAKEHADIRAN') || Auth::user()->hasRole('ROLE_ATTENDANCE_EVENT')  || Auth::user()->hasRole('ROLE_EMINITADMIN') ||
                Auth::user()->hasRole('ROLE_CDDINVENTORY'))
            <li class="nav-item">
                <a class="@if($pagename == 'Admin_Dashboard') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('admindashboard') }}">
                    <i class="bi bi-menu-button-wide"></i><span>Admin</span>
                </a>
            </li>
        @endif
    @endif

  <!-- Start SSM Tab -->
    @if (Auth::check())
      @if (Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_SSM') || Auth::user()->hasRole('ROLE_ADUANSSM'))
        <li class="nav-item">
          <a class="@if($pagename == 'Admin_SSM' || $pagename == 'SSMSRequest_Admin' || $pagename == 'SSM Permohonan') mesh-nav-link mesh-active @else mesh-nav-link @endif" data-bs-target="#adminssm-nav"  data-bs-toggle="collapse" href="#">
            <i class="bi bi-briefcase-fill"></i><span>SSM Admin</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
        </li>
      @endif
    @endif

    <ul id="adminssm-nav" class="nav-content mesh-sub-nav collapse " data-bs-parent="#sidebar-nav">
      @if (Auth::check())
			  @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_SSM'))
          <li class="nav-item">
            <a class="@if($pagename == 'Admin_SSM') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('ssms.ssm.indexall') }}">
              <i class="bi bi-person-check"></i>
              <span>Aktif Akaun SSM</span>
            </a>
          </li>
        @endif
      @endif

      @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_SSM') || Auth::user()->hasRole('ROLE_ADUANSSM'))
          <li class="nav-item">
            <a class="@if($pagename == 'SSMSRequest_Admin') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('ssmrequests.ssmrequest.indexall') }}">
              <i class="bi bi-person-plus"></i>
              <span>Aduan SSM</span>
            </a>
          </li>
        @endif
      @endif


      @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_SSM'))
          <li class="nav-item">
            <a class="@if($pagename == 'SSM Permohonan') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('ssmrequests.ssmrequest.indexpermohonan') }}">
              <i class="bi bi-person-plus"></i>
              <span>Permohonan SSM (Tindakan)</span>
            </a>
          </li>
        @endif
      @endif

      @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_SSM'))
          <li class="nav-item">
            <a class="@if($pagename == 'SSM Penilai Admin') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('ssms.penilai.index') }}">
              <i class="bi bi-person-gear"></i>
              <span>SSM Pertukaran Pegawai Penilai</span>
            </a>
          </li>
        @endif
      @endif
    </ul>
  <!-- END SSM Tab -->


  @php
          $icNos = \App\Models\SSMKod::pluck('ic_no')->toArray();
      @endphp

      @if (in_array(Auth::user()->ic_no, $icNos))

      <li class="nav-item">
          <a class="@if($pagename == 'SSM_Staff_Permohonan') mesh-nav-link mesh-active @else mesh-nav-link @endif"
              href="{{ route('ssmrequests.ssmrequest.indexstaffpermohonan') }}">
              <i class="bi bi-person-plus">
              </i><span>Permohonan SSM (ST)</span>
          </a>
      </li>

      @endif

  <!-- Start User Tab -->
  @if (Auth::check())
    @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
      <li class="nav-item">
        <a class="@if($pagename == 'Super_Admin_Role_User' || $pagename == 'Admin_User_Profile' || $pagename == 'Admin_List_Of_User') mesh-nav-link mesh-active @else mesh-nav-link @endif" data-bs-target="#adminuser-nav"  data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      </li>
    @endif
  @endif

  <ul id="adminuser-nav" class="nav-content mesh-sub-nav collapse " data-bs-parent="#sidebar-nav">

    @if (Auth::check())
      @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <li class="nav-item">
          <a class="@if($pagename == 'Admin_User_Profile') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('profileusers.profileuser.index') }}">
            <i class="bi bi-circle"></i>
            <span>Profile</span>
          </a>
        </li><!-- End Role User Page Nav -->
      @endif
    @endif


    @if (Auth::check())
      @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <li class="nav-item">
          <a class="@if($pagename == 'Admin_List_Of_User') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('users.user.index') }}">
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
        <a class="@if($pagename == 'Super_Admin_Role_User') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('role_users.role_user.index') }}">
          <i class="bi bi-circle"></i>
          <span>Assigned Role</span>
        </a>
      </li><!-- End Role User Page Nav -->
    </ul>

    <!-- Role Request -->
    <ul id="adminuser-nav-request" class="nav-content mesh-sub-nav collapse" data-bs-parent="#sidebar-nav">
      <li class="nav-item">
        <a class="@if($pagename == 'Super_Admin_Role_User') mesh-nav-link mesh-active @else mesh-nav-link @endif" href="{{ route('permohonanrole.permohonanrole.indexadmin') }}">
          <i class="bi bi-circle"></i>
          <span>Request Role</span>
        </a>
      </li><!-- End Role User Page Nav -->
    </ul>

    </ul>
  </aside><!-- End Sidebar (MESH v4) -->




  <main id="main" class="main">

    <!-- <div class="pagetitle">
     @yield ('pagetitle')
    </div> -->
    <!-- End Page Title -->

    <div class="row">
     
        @yield('content')
                
    </div>            


  </main><!-- End #main -->




<!-- ======= Footer ======= -->
{{-- ============ OLD FOOTER (pre MESH v4 redesign) — kept for reference, do not delete ============
<footer id="footer" class="footer">
    <div class="copyright">
      <span style="color:black" title="Developed by: Saidatul Ekma (MESH Lead Developer), Laila Khamis(EASE Lead Developer), Nurul Hasinah(Database Administrator), Nadzirah Ali Hassim(Programmer), Wan Arif(Project Officer), Lyanna Karim (MESH Layout & Design)">
		Ministry of Education &copy; 2021 All Rights Reserved. Powered by DevOps ICT. Version 3.0.</span>
    </div>
</footer><!-- End Footer -->
============ END OLD FOOTER ============ --}}

<footer id="footer" class="footer mesh-v4-footer">
  <img src="{{ asset('assets/img/logo.png') }}" alt="">
  <span class="mesh-footer-text" title="Developed by: Saidatul Ekma (MESH Lead Developer), Laila Khamis(EASE Lead Developer), Nurul Hasinah(Database Administrator), Nadzirah Ali Hassim(Programmer), Wan Arif(Project Officer), Lyanna Karim (MESH Layout & Design)">
    Ministry of Education &copy; 2026 All Rights Reserved. Powered by DevOps ICT.
  </span>
  <span class="mesh-footer-version">v4.0</span>
</footer><!-- End Footer (MESH v4) -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  {{-- Jquery For Date-Picker --}}
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>



	{{-- Script For Date --}}
	<script type="text/javascript">

		$(function() {
			$( "#datepicker_dob" ).datepicker({
       changeMonth: true,
			changeYear: true,
			format: 'dd-mm-yy',
			dateFormat: 'dd-mm-yy',
			yearRange:  "-80:-0",
			});
		});
		</script>

	<script type="text/javascript">
		$(function() {
			$( "#datepicker_service" ).datepicker({
       changeMonth: true,
			changeYear: true,
			format: 'dd-mm-yy',
			dateFormat: 'dd-mm-yy',
			yearRange:  "-80:-0",
			});
		});
	</script>

	<script type="text/javascript">
		$(function() {
			$( "#datepicker_retirement" ).datepicker({
			changeMonth: true,
			changeYear: true,
			format: 'dd-mm-yy',
			dateFormat: 'dd-mm-yy',
			minDate:  '0',
			});
		});
	</script>

	<script type="text/javascript">
		$(function() {
			$( "#datepicker_graduate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			format: 'dd-mm-yy',
			dateFormat: 'dd-mm-yy',
			yearRange:  "-80:-0",
			});
		});
	</script>

	<script type="text/javascript">
		$(function() {
			$( "#datepicker_registrationDate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			format: 'dd-mm-yy',
			dateFormat: 'dd-mm-yy',
			});
		});
	</script>

	<script type="text/javascript">
		$(function() {
			$( "#datepicker_roadtaxExpiry" ).datepicker({
			changeMonth: true,
			changeYear: true,
			format: 'dd-mm-yy',
			dateFormat: 'dd-mm-yy',
			});
		});
	</script>

		<script type="text/javascript">
		$(function() {
			$( "#datepicker_drivingExpiry" ).datepicker({
			changeMonth: true,
			changeYear: true,
			format: 'dd-mm-yy',
			dateFormat: 'dd-mm-yy',
			});
		});

	</script>
	<script type="text/javascript">
		$(function() {
			$( "#datepicker_date_graduate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			format: 'dd-mm-yy',
			dateFormat: 'dd-mm-yy',
			yearRange:  "-80:-0",
			});
		});
	</script>
	<script type="text/javascript">
		$(function() {
			$( "#datepicker_date_end" ).datepicker({
			changeMonth: true,
			changeYear: true,
			format: 'dd-mm-yy',
			dateFormat: 'dd-mm-yy',
			yearRange:  "-80:-0",
			});
		});
	</script>
	<script type="text/javascript">
		$(function() {
			$( "#datepicker_role_start" ).datepicker({
			changeMonth: true,
			changeYear: true,
			format: 'dd-mm-yy',
			dateFormat: 'dd-mm-yy',
			yearRange:  "-80:-0",
			});
		});
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
	$('#bahagianOther').hide();	
		$('#bahagian').on('change', function() {
		  if ( this.value == '999')
		  {
			$("#bahagianOther").show();
		  }
		  else
		  {
			$("#bahagianOther").hide();
		  }
		});
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
	$('#unitOther').hide();	
		$('#unit').on('change', function() {
		  if ( this.value == '999')
		  {
			$("#unitOther").show();
		  }
		  else
		  {
			$("#unitOther").hide();
		  }
		});
	});
	</script>

<script type="text/javascript">
	$(document).ready(function(){
	$('#raceOther').hide();	
		$('#races').on('change', function() {
		  if ( this.value == '10')
		  {
			$("#raceOther").show();
		  }
		  else
		  {
			$("#raceOther").hide();
		  }
		});
	});
	</script>

<script type="text/javascript">
	$(document).ready(function(){
	$('#religionOther').hide();	
		$('#religions').on('change', function() {
		  if ( this.value == '4')
		  {
			$("#religionOther").show();
		  }
		  else
		  {
			$("#religionOther").hide();
		  }
		});
	});
	</script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(function() {
  let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
  let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
  let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
  let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
  let printButtonTrans = '{{ trans('global.datatables.print') }}'
  let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
  let selectAllButtonTrans = '{{ trans('global.select_all') }}'
  let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

  let languages = {
    'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
  };

  $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
  $.extend(true, $.fn.dataTable.defaults, {
    language: {
      url: languages['{{ app()->getLocale() }}']
    },
    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
    }, {
        orderable: false,
        searchable: false,
        targets: -1
    }],
    select: {
      style:    'multi+shift',
      selector: 'td:first-child'
    },
    order: [],
    scrollX: true,
    pageLength: 100,
    dom: 'lBfrtip<"actions">',
    buttons: [
      {
        extend: 'selectAll',
        className: 'btn-primary',
        text: selectAllButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'selectNone',
        className: 'btn-primary',
        text: selectNoneButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'copy',
        className: 'btn-default',
        text: copyButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'csv',
        className: 'btn-default',
        text: csvButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'excel',
        className: 'btn-default',
        text: excelButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'pdf',
        className: 'btn-default',
        text: pdfButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'print',
        className: 'btn-default',
        text: printButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'colvis',
        className: 'btn-default',
        text: colvisButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      }
    ]
  });

  $.fn.dataTable.ext.classes.sPageButton = '';
});

    </script>

    {{-- =============== NISAH =============== --}}
    {{-- Header bell's announcement popups + dropdown script, at <body> level so the popups aren't trapped under the --}}
    {{-- fixed header. Must stay ABOVE mesh-v4.js: it adds the poster lightbox on pages that don't already have one. --}}
    @include('inc.announcement-bell-modals')
    {{-- =============================================== --}}

    <!-- MESH v4 redesign: full-height sidebar particle background (same library/config as welcome-new.blade.php's hero) -->
    <script src="{{ asset('js/particles.min.js') }}"></script>

    <!-- MESH v4 redesign: sidebar collapse + poster lightbox (additive, guarded, see public/js/mesh-v4.js) -->
    <script src="{{ asset('js/mesh-v4.js') }}?v={{ filemtime(public_path('js/mesh-v4.js')) }}"></script>

    @yield('scripts')

</body>

</html>
