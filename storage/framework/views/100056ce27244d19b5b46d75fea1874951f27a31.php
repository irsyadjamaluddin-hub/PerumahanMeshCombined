<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $__env->yieldContent('title'); ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="<?php echo e(asset('admin/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
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
    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet" />
    <?php echo $__env->yieldContent('styles'); ?>
    
    
  <link href="<?php echo e(asset('admin/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
  <!-- dropdown -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    
    
  <!-- Favicons -->
  <link href="<?php echo e(asset('assets/img/logo.png')); ?>" rel="icon">
  <link href="<?php echo e(asset('assets/img/logo.png')); ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo e(asset('assets/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/vendor/remixicon/remixicon.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/vendor/boxicons/css/boxicons.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/vendor/quill/quill.snow.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/vendor/quill/quill.bubble.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/vendor/simple-datatables/style.css')); ?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo e(asset('assets/css/admin.css')); ?>" rel="stylesheet">
  <script src="<?php echo e(asset('assets/js/apexcharts-bundle.js')); ?>"></script>  

  <!--  -->
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

<body>

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
                    <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo e(Auth::user()->name); ?></span>
                </a><!-- End Profile Image Icon -->

            
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li>
                    <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('biodatas.biodata.show', [Auth::user()->ic_no])); ?>">
                        <i class="bi bi-person"></i>
                        <span>My Profile</span>
                    </a>
                    </li>
                    <li>
                    <hr class="dropdown-divider">
                    </li>
                    <li>
                    <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('change_password')); ?>">
                        <i class="bi bi-key-fill"></i>
                        <span>Change Password</span>
                    </a>
                    </li>
                    <li>
                    <hr class="dropdown-divider">
                    </li>
                    <li>
                    <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('logout')); ?>">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sign Out</span>
                    </a>
                    </li>
                </ul><!-- End Profile Dropdown Items -->

            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <?php if(Auth::check()): ?>
      <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PDMS_ADMIN') 
      || Auth::user()->hasRole('ROLE_PDMS_SERVICE') || Auth::user()->hasRole('ROLE_PDMS_CUTI')): ?>
      <li class="nav-heading">MESH</li>

      <li class="nav-item">
        <a class="<?php if($pagename == 'pdmshome'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('pdmshome')); ?>">
          <i class="bi bi-pc-display"></i>
          <span>Admin Home</span>
        </a>
      </li><!-- End Home-->
      <?php endif; ?>
    <?php endif; ?>
	
	  <li class="nav-heading">Main Menu</li>

	      <li class="nav-item">
        <a class="<?php if($pagename == 'home'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('home')); ?>">
          <i class="bi bi-house-fill"></i>
          <span>Home</span>
        </a>
      </li><!-- End Home-->

	   <li class="nav-item">
        <a class="<?php if($pagename == 'Profile'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('biodatas.biodata.show', [Auth::user()->ic_no])); ?>">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <!-- archivephasebyphase -->
    
    <li class="nav-item">
        <a class="<?php if($pagename == 'Dashboard' || $pagename == 'Report' || $pagename == 'ARTReport' || $pagename == 'JPKKReport'|| $pagename == 'Status Jawatan Kosong Report'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>"  data-bs-target="#dash-nav" data-bs-toggle="collapse" href="<?php echo e(route('home')); ?>">
          <i class="bi bi-grid"></i><span>Dashboard</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      <ul id="dash-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

      <!-- <li>
        <a class="<?php if($pagename == 'Dashboard'): ?> nav-link collapsed <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('home')); ?>">
          <i class="bi bi-circle"></i><span>Welcome</span>
        </a>
      </li> -->

      <?php if(Auth::check()): ?>
         <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MGT')): ?>
      <li>
        <a class="<?php if($pagename == 'Report'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('homereport')); ?>">
          <i class="bi bi-circle"></i><span>Users Report</span>
        </a>
      </li>
         <?php endif; ?>
        <?php endif; ?>

        <?php if(Auth::check()): ?>
         <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MGT')): ?>
        <li>
        <a class="<?php if($pagename == 'ARTReport'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('artreport')); ?>">
          <i class="bi bi-circle"></i><span>ART Report</span>
        </a>
      </li>
      <?php endif; ?>
        <?php endif; ?>

        <?php if(Auth::check()): ?>
         <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PPSDASHBOARD')): ?>
        <li>
        <a class="<?php if($pagename == 'PPSVisitor'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('ppsvisitor')); ?>">
          <i class="bi bi-circle"></i><span>PPS Visitors</span>
        </a>
      </li>
      <?php endif; ?>
        <?php endif; ?>



        <?php if(Auth::check()): ?>
         <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MGT')  || Auth::user()->hasRole('ROLE_CCA_ADMIN')): ?>
        <li>
        <a class="<?php if($pagename == 'JPKKReport'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('ccareport')); ?>">
          <i class="bi bi-circle"></i><span>JPKK Report</span>
        </a>
      </li>
      <?php endif; ?>
      <?php endif; ?>


        <?php if(Auth::check()): ?>
         <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_PRESTASI') || Auth::user()->hasRole('ROLE_JAWATANKOSONG')): ?>
        <li>
        <a class="<?php if($pagename == 'Status Jawatan Kosong Report'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('jawatankosongreport')); ?>">
          <i class="bi bi-circle"></i><span>SJK Report</span>
        </a>
      </li>
      <?php endif; ?>
      <?php endif; ?>

       <?php if(Auth::check()): ?>
         <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN')): ?>
        <li>
        <a class="<?php if($pagename == 'ONS Dashboard Report'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('onsdashboard')); ?>">
          <i class="bi bi-circle"></i><span>ONS Report</span>
        </a>
      </li>
      <?php endif; ?>
      <?php endif; ?>

      <?php if(Auth::check()): ?>
        <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_TEGAHAN')): ?>
        <li>
          <a class="<?php if($pagename == 'Suspended Company Report'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('msc.mscindex')); ?>">
            <i class="bi bi-circle"></i><span>Tegahan Report</span>
          </a>
        </li>
        <?php endif; ?>
      <?php endif; ?>
  

    <?php if(Auth::check() && Auth::user()->hasRole('ROLE_SUPERADMIN')): ?>
  <li>
    <a class="<?php if($pagename == 'GenAI Report'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>"
       href="<?php echo e(route('genai.report')); ?>">
      <i class="bi bi-circle"></i><span>GenAI Report</span>
    </a>
  </li>
<?php endif; ?>
</ul>
</li>



<!-- MOE INFO -->

      <li class="nav-item">
        <a class="<?php if($pagename == 'Services'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('servicesdashboard')); ?>">
          <i class="bi bi-list-task">
          </i><span>Services</span>
        </a>
      </li>
      
      <?php if(false): ?>
      <li class="nav-item">
        <a class="<?php if($pagename == 'announcement' || $pagename == 'newsindex'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>"  data-bs-target="#add1-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-info-circle"></i><span> MOE Info</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      <ul id="add1-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

     <li class="nav-item">
        <a class="<?php if($pagename == 'announcement'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('announcement.announcementindex')); ?>">
          <i class="bi bi-megaphone"></i>
          <span>Announcement</span>
        </a>
      </li><!-- End Announcement Page Nav -->

      <li class="nav-item">
        <a class="<?php if($pagename == 'newsindex'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('news.newsindex')); ?>">
          <i class="bi bi-newspaper"></i>
          <span>News</span>
        </a>
      </li><!-- End News Page Nav -->

    </ul>
    </li>
    <?php endif; ?>
    <!-- MOE INFO -->

    <!-- <?php if(Auth::check()): ?> -->
    <!-- <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_ONS_USER')): ?> -->
      <!-- <li class="nav-item" > -->
        <!-- <a class="<?php if($pagename == 'Online Notification User'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" > -->
         <!-- <a class="<?php if($pagename == 'Online Notification User'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('onlinenotifications.onlinenotification.indexuser')); ?>" > -->
          <!-- <a class="<?php if($pagename == 'Maintenance Page'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('maintenance.page')); ?>" > -->
          <!-- <i class="bi bi-file-text"> -->
          <!-- </i><span>O.N.S 2.0</span> -->
        <!-- </a> -->
      <!-- </li> -->
    <!-- <?php endif; ?> -->
    <!-- <?php endif; ?> -->

       <!-- <li class="nav-item">
        <a class="<?php if($pagename == 'data_kehadiran'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('datakehadiran.datakehadiran.index')); ?>">
          <i class="bi bi-file-earmark-post">
          </i><span>Data Kehadiran</span>
        </a>
      </li> -->

      <!-- part wani tambah -->
      <li class="nav-item">
        <a class="<?php if($pagename == 'Calendar'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('fsm.fsm.index')); ?>">
          <i class="bi bi-file-text-fill">
          </i><span>F.S.M</span>
        </a>
      </li>

      <!-- requested by AO to comment this out and not use this code anymore date 10/10/2024 -->
      <!-- <li class="nav-item">
        <a class="<?php if($pagename == 'Calendar'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('adminbooking.systemcalendar')); ?>">
          <i class="bi bi-calendar-event-fill">
          </i><span>Room Booking</span>
        </a>
      </li> -->


    <!--   <li class="nav-item">
        <a class="<?php if($pagename == 'prestasi'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('prestasi.prestasi.index')); ?>">
          <i class="bi bi-bookmark-star-fill">
          </i><span>Prestasi</span>
        </a>
      </li> -->


   
<!-- 
	<li class="nav-item">
    		<a class="<?php if($pagename == 'TaskTracking'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>"href="<?php echo e(route('tasktracking.indextasktracking')); ?>">
        <i class="bi bi-file-earmark-text"></i>
        <span>TaskTracking</span>
    </a>
</li> -->


       <!--- Download Tab Start ------>
    <!-- <li class="nav-item">
        <a class="<?php if($pagename == 'dp-download'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>"  data-bs-target="#dl-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-download"></i><span>Download</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      <ul id="dl-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

      <li>
        <a class="<?php if($pagename == 'dp-download'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="/download">
          <i class="bi bi-circle"></i><span>DP</span>
        </a>
      </li>

    </ul>
    </li> -->
    <!---- Download Tab End ------->

    
  

       <!-- MEC MED -->
<!--       <li class="nav-item">
        <a class="<?php if($pagename == 'DIS' || $pagename == 'MEC'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>"  data-bs-target="#add3-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-article-line"></i><span> MEC MED </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      <ul id="add3-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

  
      <li class="nav-item">
          <a class="<?php if($pagename == 'DIS'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>"
              href="<?php echo e(route('dispatchs.dis.index')); ?>">
              <i class="ri-article-line">
              </i><span>Despatch</span>
          </a>
      </li>

      <li class="nav-item">
          <a class="<?php if($pagename == 'MEC'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>"
              href="<?php echo e(route('dispatchs.dis.indextindakan')); ?>">
              <i class="bi bi-person-check-fill">
              </i><span>Correspondence</span>
          </a>
      </li>

    </ul>
    </li> -->
    <!-- MEC MED -->


      <?php if(Auth::check()): ?>
        <?php if(Auth::user()->hasRole('ROLE_TATATERTIB')): ?>
          <li class="nav-item">
            <a class="<?php if($pagename == 'SSM Tatatertib'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('ssmtatatertib.ssmrequest.indextatatertib')); ?>">
              <i class="bi bi-person-plus"></i>
              <span>SSM Tatatertib</span>
            </a>
          </li>
        <?php endif; ?>
      <?php endif; ?>     

<li class="nav-heading">Admin</li>
    
    <!-- Start Admin Tab -->
    <?php if(Auth::check()): ?>
    <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN')): ?>
        <li class="nav-item">
            <a class="<?php if($pagename == 'Super_Admin_Dashboard'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('superadmindashboard')); ?>">
                <i class="bi bi-menu-button-wide"></i><span>Super Admin</span>
            </a>
        </li>
        <?php elseif(Auth::user()->hasRole('ROLE_CCA_ADMIN') || Auth::user()->hasRole('ROLE_ART_FOCAL') || 
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
                Auth::user()->hasRole('ROLE_CDDINVENTORY')): ?>
            <li class="nav-item">
                <a class="<?php if($pagename == 'Admin_Dashboard'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('admindashboard')); ?>">
                    <i class="bi bi-menu-button-wide"></i><span>Admin</span>
                </a>
            </li>
        <?php endif; ?>
    <?php endif; ?>

  <!-- Start SSM Tab -->
    <?php if(Auth::check()): ?>
      <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_SSM') || Auth::user()->hasRole('ROLE_ADUANSSM')): ?>
        <li class="nav-item">
          <a class="<?php if($pagename == 'Admin_SSM' || $pagename == 'SSMSRequest_Admin' || $pagename == 'SSM Permohonan'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" data-bs-target="#adminssm-nav"  data-bs-toggle="collapse" href="#">
            <i class="bi bi-briefcase-fill"></i><span>SSM Admin</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
        </li>
      <?php endif; ?>
    <?php endif; ?>

    <ul id="adminssm-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">  
      <?php if(Auth::check()): ?>
			  <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_SSM')): ?>
          <li class="nav-item">
            <a class="<?php if($pagename == 'Admin_SSM'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('ssms.ssm.indexall')); ?>">
              <i class="bi bi-person-check"></i>
              <span>Aktif Akaun SSM</span>
            </a>
          </li>
        <?php endif; ?>
      <?php endif; ?>
      
      <?php if(Auth::check()): ?>
        <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_SSM') || Auth::user()->hasRole('ROLE_ADUANSSM')): ?>
          <li class="nav-item">
            <a class="<?php if($pagename == 'SSMSRequest_Admin'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('ssmrequests.ssmrequest.indexall')); ?>">
              <i class="bi bi-person-plus"></i>
              <span>Aduan SSM</span>
            </a>
          </li>
        <?php endif; ?>
      <?php endif; ?>


      <?php if(Auth::check()): ?>
        <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_SSM')): ?>
          <li class="nav-item">
            <a class="<?php if($pagename == 'SSM Permohonan'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('ssmrequests.ssmrequest.indexpermohonan')); ?>">
              <i class="bi bi-person-plus"></i>
              <span>Permohonan SSM (Tindakan)</span>
            </a>
          </li>
        <?php endif; ?>
      <?php endif; ?>

      <?php if(Auth::check()): ?>
        <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN')  || Auth::user()->hasRole('ROLE_SSM')): ?>
          <li class="nav-item">
            <a class="<?php if($pagename == 'SSM Penilai Admin'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('ssms.penilai.index')); ?>">
              <i class="bi bi-person-gear"></i>
              <span>SSM Pertukaran Pegawai Penilai</span>
            </a>
          </li>
        <?php endif; ?>
      <?php endif; ?>
    </ul>
  <!-- END SSM Tab -->

  
  <?php
          $icNos = \App\Models\SSMKod::pluck('ic_no')->toArray();
      ?>

      <?php if(in_array(Auth::user()->ic_no, $icNos)): ?>

      <li class="nav-item">
          <a class="<?php if($pagename == 'SSM_Staff_Permohonan'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>"
              href="<?php echo e(route('ssmrequests.ssmrequest.indexstaffpermohonan')); ?>">
              <i class="bi bi-person-plus">
              </i><span>Permohonan SSM (ST)</span>
          </a>
      </li>

      <?php endif; ?>
  
  <!-- Start User Tab -->
  <?php if(Auth::check()): ?>
    <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN')): ?>
      <li class="nav-item">
        <a class="<?php if($pagename == 'Super_Admin_Role_User' || $pagename == 'Admin_User_Profile' || $pagename == 'Admin_List_Of_User'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" data-bs-target="#adminuser-nav"  data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      </li>
    <?php endif; ?>
  <?php endif; ?>

  <ul id="adminuser-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">  
    
    <?php if(Auth::check()): ?>
      <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN')): ?>
        <li class="nav-item">
          <a class="<?php if($pagename == 'Admin_User_Profile'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('profileusers.profileuser.index')); ?>">
            <i class="bi bi-circle"></i>
            <span>Profile</span>
          </a>
        </li><!-- End Role User Page Nav -->
      <?php endif; ?>
    <?php endif; ?>


    <?php if(Auth::check()): ?>
      <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN')): ?>
        <li class="nav-item">
          <a class="<?php if($pagename == 'Admin_List_Of_User'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('users.user.index')); ?>">
            <i class="bi bi-circle"></i>
            <span>List/Verify</span>
          </a>
        </li><!-- End Role User Page Nav -->
      <?php endif; ?>
    <?php endif; ?>
  </ul>

    <!-- Start Role Request Tab -->
    <?php if(Auth::check()): ?>
      <?php if(Auth::user()->hasRole('ROLE_SUPERADMIN')): ?>
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#adminuser-nav-request" data-bs-toggle="collapse" href="#">
            <i class="bi bi-file-earmark-person-fill"></i>
            <span>Role</span>
            <i class="bi bi-chevron-down ms-auto"></i>
          </a>
        </li>
      <?php endif; ?>
    <?php endif; ?>

    <!-- Role -->
    <ul id="adminuser-nav-request" class="nav-content collapse" data-bs-parent="#sidebar-nav">  
      <li class="nav-item">
        <a class="<?php if($pagename == 'Super_Admin_Role_User'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('role_users.role_user.index')); ?>">
          <i class="bi bi-circle"></i>
          <span>Assigned Role</span>
        </a>
      </li><!-- End Role User Page Nav -->
    </ul>

    <!-- Role Request -->
    <ul id="adminuser-nav-request" class="nav-content collapse" data-bs-parent="#sidebar-nav">  
      <li class="nav-item">
        <a class="<?php if($pagename == 'Super_Admin_Role_User'): ?> nav-link <?php else: ?> nav-link collapsed <?php endif; ?>" href="<?php echo e(route('permohonanrole.permohonanrole.indexadmin')); ?>">
          <i class="bi bi-circle"></i>
          <span>Request Role</span>
        </a>
      </li><!-- End Role User Page Nav -->
    </ul>

</aside><!-- End Sidebar-->



  <main id="main" class="main">

    <!-- <div class="pagetitle">
     <?php echo $__env->yieldContent('pagetitle'); ?>
    </div> -->
    <!-- End Page Title -->

    <div class="row">
     
        <?php echo $__env->yieldContent('content'); ?>
                
    </div>            


  </main><!-- End #main -->




<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
      <span style="color:black" title="Developed by: Saidatul Ekma (MESH Lead Developer), Laila Khamis(EASE Lead Developer), Nurul Hasinah(Database Administrator), Nadzirah Ali Hassim(Programmer), Wan Arif(Project Officer), Lyanna Karim (MESH Layout & Design)">
		Ministry of Education &copy; 2021 All Rights Reserved. Powered by DevOps ICT. Version 3.0.</span>
    </div>
</footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo e(asset('assets/vendor/bootstrap/js/bootstrap.bundle.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/php-email-form/validate.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/quill/quill.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/tinymce/tinymce.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/simple-datatables/simple-datatables.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/chart.js/chart.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/apexcharts/apexcharts.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/echarts/echarts.min.js')); ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>

  
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>



	
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
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <script>
        $(function() {
  let copyButtonTrans = '<?php echo e(trans('global.datatables.copy')); ?>'
  let csvButtonTrans = '<?php echo e(trans('global.datatables.csv')); ?>'
  let excelButtonTrans = '<?php echo e(trans('global.datatables.excel')); ?>'
  let pdfButtonTrans = '<?php echo e(trans('global.datatables.pdf')); ?>'
  let printButtonTrans = '<?php echo e(trans('global.datatables.print')); ?>'
  let colvisButtonTrans = '<?php echo e(trans('global.datatables.colvis')); ?>'
  let selectAllButtonTrans = '<?php echo e(trans('global.select_all')); ?>'
  let selectNoneButtonTrans = '<?php echo e(trans('global.deselect_all')); ?>'

  let languages = {
    'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
  };

  $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
  $.extend(true, $.fn.dataTable.defaults, {
    language: {
      url: languages['<?php echo e(app()->getLocale()); ?>']
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
    <?php echo $__env->yieldContent('scripts'); ?>

</body>

</html>
<?php /**PATH S:\Mesh110626\resources\views/layouts/app-all.blade.php ENDPATH**/ ?>