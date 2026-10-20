@extends('layouts.app-all')

@section('title', 'Admin')

@section('content')

<style>
  .dashboard .card-icon {
      font-size: 28px;
      width: 60px;
      height: 60px;
  }

  .search-bar {
    display: flex;
    justify-content: flex-end;
  } 

  .search-bar input[type="text"] {
      border: none;
      border-bottom: 1px solid #ccc;
      padding: 5px 10px;
      margin-top: 5px;
      margin-bottom: 10px;
      width: 300px;
  }

  /* Fix for modal submenu links - keep everything consistent */
  .modal-body a {
      text-decoration: none;
      color: inherit;
  }

  .modal-body a:hover {
      text-decoration: none;
  }

  /* Ensure modal card icons are same size */
  .modal-body .card-icon {
      font-size: 28px;
      width: 60px;
      height: 60px;
      color: #4154f1;
  }

  /* Ensure modal card titles are same size, color, and BOLD */
  .modal-body .card-body h6 {
      color: #012970;
      font-weight: 700 !important;
  }

  /* Ensure modal card subtitles are same color */
  .modal-body .card-body span {
      color: #899bbd;
  }

  .services-category {
    margin-bottom: 35px;
  }
  .services-category:last-child {
    margin-bottom: 0;
  }
  .category-title {
    font-size: 16px;
    font-weight: 600;
    color: #012970;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 15px;
    padding-bottom: 8px;
    border-bottom: 2px solid #e6e9ec;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .category-title i {
    color: #4154f1;
    font-size: 18px;
  }
</style>
  <?php
    $pagename = "Admin_Dashboard";
  ?>

  <div class="pagetitle">
      <h1>Admin</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Admin</li>
        </ol>
      </nav>
    </div>

    <div class="container mt-4">
    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="get">
            <input id="serviceSearchInput" class="form-control" type="text" name="search" placeholder="Search ..." oninput="
                var input = document.getElementById('serviceSearchInput');
                var filter = input.value.trim().toUpperCase();
                var allServices = document.querySelectorAll('#allServicesList .col-lg-4');
                allServices.forEach(service => {
                    var serviceName = service.innerText.toUpperCase();
                    var matched = serviceName.includes(filter);
                    service.style.display = matched ? '' : 'none';
                });
            ">
        </form>
    </div>
</div>

@if (Auth::check() && (!Auth::user()->hasRole('ROLE_SUPERADMIN')))
  <section class="section dashboard" id="allServicesList">

    <!-- Category: Human Resource -->
    @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_SSM') || Auth::user()->hasRole('ROLE_ACT') || Auth::user()->hasRole('ROLE_BAKI_CUTI') || Auth::user()->hasRole('ROLE_PDMS_CUTI') || Auth::user()->hasRole('ROLE_PRESTASI')))
    <div class="services-category">
      <h5 class="category-title"><i class="bi bi-person-badge"></i> Human Resource</h5>
      <div class="row">

        <!-- MY SSM -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_SSM') || Auth::user()->hasRole('ROLE_ACT') || Auth::user()->hasRole('ROLE_BAKI_CUTI') || Auth::user()->hasRole('ROLE_PDMS_CUTI') || Auth::user()->hasRole('ROLE_PRESTASI'))
        <div class="col-lg-4">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;" type="button" data-bs-toggle="modal" data-bs-target="#ssmInternalModal">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-briefcase-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">My SSM</h6>
                  </div>
                </div>
              </div>
            </div>
        </div>
        @endif
        @endif

        <!-- PERMOHONAN PERANAN AKSES -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ACT'))
        <div class="col-lg-4">
          <a href="{{ route('skbs.skb.indexadmin') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-text"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Access Role Application</h6>
                    </div>
                  </div>
            </div>
          </div>
          </a>
        </div>
        @endif
        @endif

      </div>
    </div>
    @endif

    <!-- Category: Communication & Notifications -->
    @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ONS_ADMIN')))
    <div class="services-category">
      <h5 class="category-title"><i class="bi bi-megaphone"></i> Communication & Notifications</h5>
      <div class="row">

        <!-- MNS -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ONS_ADMIN'))
        <div class="col-lg-4">
          <a href="{{ route('onlinenotifications.onlinenotification.index') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-phone-vibrate"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">MNS</h6>
                    <span>MESH Notification Service</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

        <!-- MLS -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <div class="col-lg-4">
          <a href="{{ route('linkup.index') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-link-45deg"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">MLS</h6>
                    <span>MESH Link Sharing</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

      </div>
    </div>
    @endif

    <!-- Category: Attendance & Events -->
    @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_QUESTION&ANSWER') || Auth::user()->hasRole('ROLE_MOEEVENT') || Auth::user()->hasRole('ROLE_SLIPKEHADIRAN')))
    <div class="services-category">
      <h5 class="category-title"><i class="bi bi-calendar-check"></i> Attendance & Events</h5>
      <div class="row">

        <!-- Q&A -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_QUESTION&ANSWER'))
        <div class="col-lg-4">
          <a href="{{ route('st.soalantaklimat.indexadmin') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-text"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">Q&A</h6>
                    <span>Q&A Service</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

        <!-- MEA -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MOEEVENT'))
        <div class="col-lg-4">
          <a href="{{ route('moeevent.moeevent.indexadmin') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-card-heading"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">MEA</h6>
                    <span>MESH Event Attendance</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

        <!-- MAS -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_SLIPKEHADIRAN'))
        <div class="col-lg-4">
          <a href="{{ route('sk.slipkedatangan.indexadmin') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-building"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">MAS</h6>
                    <span>MESH Attendance Slip</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

      </div>
    </div>
    @endif

    <!-- Category: Support Requests -->
    @if (Auth::check() && Auth::user()->hasRole('ROLE_SUPERADMIN'))
    <div class="services-category">
      <h5 class="category-title"><i class="bi bi-file-code"></i> Support Requests</h5>
      <div class="row">

        <!-- DRF -->
        <div class="col-lg-4">
          <a href="{{ route('devops-request.indexadmin') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-gear-wide-connected"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">DRF</h6>
                    <span>Devops Request Form</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- DSS -->
        <div class="col-lg-4">
          <a href="{{ route('support-center.index') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-headset"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">DSS</h6>
                    <span>Devops Support Service</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- MOE Enquiries -->
        <div class="col-lg-4">
          <a href="{{ route('soalanbiskita.soalanbiskita.indexadmin') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-question-square"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">MOE Enquiries</h6>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

      </div>
    </div>
    @endif

    <!-- Category: Other Services -->
    @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_BNS') || Auth::user()->hasRole('ROLE_TEGAHAN') || Auth::user()->hasRole('ROLE_POSTUP') || Auth::user()->hasRole('ROLE_DATAKERAMAIAN')))
    <div class="services-category">
      <h5 class="category-title"><i class="bi bi-gear"></i> Other Services</h5>
      <div class="row">

        <!-- MB -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_BNS'))
        <div class="col-lg-4">
          <a href="{{ route('bn.banner.index') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-view-list"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">MB</h6>
                    <span>MESH Banner</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

        <!-- MA -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <div class="col-lg-4">
          <a href="{{ route('announcement.announcementadmin') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-megaphone"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">MA</h6>
                    <span>MESH Announcement</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

        <!-- MN -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <div class="col-lg-4">
          <a href="{{ route('news.newsadmin') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-newspaper"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">MN</h6>
                    <span>MESH News</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

        <!-- MPC -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_TEGAHAN'))
        <div class="col-lg-4">
          <a href="{{ route('msc.mscadmin') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-building-slash"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">MPC</h6>
                    <span>Prohibited Company</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

        <!-- PostUp -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_POSTUP'))
        <div class="col-lg-4">
          <a href="{{ route('postup.postup.indexadmin') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-earmark-arrow-up-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">PostUp</h6>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

        <!-- Student Data -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_DATAKERAMAIAN'))
        <div class="col-lg-4">
          <a href="{{ route('inventory.datakeramaianindex') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-table"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">Student Data</h6>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

      </div>
    </div>
    @endif

   
    <!-- Category: Internal -->
    @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_CCA_ADMIN') || Auth::user()->hasRole('ROLE_CCA_FOCAL') || Auth::user()->hasRole('ROLE_PERJAWATAN') || Auth::user()->hasRole('ROLE_PRESTASI') || Auth::user()->hasRole('ROLE_COMPETENCY') || Auth::user()->hasRole('ROLE_JAWATANKOSONG') || Auth::user()->hasRole('ROLE_CDDINVENTORY') || Auth::user()->hasRole('ROLE_DATAKEHADIRAN') || Auth::user()->hasRole('ROLE_EMINITADMIN') || Auth::user()->hasRole('ROLE_ATTENDANCE_EVENT') || Auth::user()->hasRole('ROLE_PASUKANBERUNIFORM') || Auth::user()->hasRole('ROLE_PASUKANHADRAH') || Auth::user()->hasRole('ROLE_ADMIN_PERUMAHAN') || Auth::user()->hasRole('ROLE_HRIDS') || Auth::user()->hasRole('ROLE_HRIDS_NONTEACHING')))
    <div class="services-category">
      <h5 class="category-title"><i class="bi bi-building"></i> Internal</h5>
      <div class="row">

        <!-- EMA -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_EMINITADMIN'))
        <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#eminitModal">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 10px;">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-collection"></i>
                </div>
                <div class="ps-3">
                  <h6 style="font-size: 22px;">D Flow</h6>
                  <span>Documentation Flow</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endif
        <!-- HRIDS -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_HRIDS') || Auth::user()->hasRole('ROLE_HRIDS_NONTEACHING'))
        <div class="col-lg-4">
          <a href="{{ route('pj.landingpage') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-database"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">HRIDS</h6>
                    <span>Human Resources Integrated Database System</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

             <!-- SPIS -->
             @if (Auth::check())
             @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_SPIS_ADMIN'))
        <div class="col-lg-4">
          <a href="{{ route('project-register.index') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-graph-up-arrow"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">SPIS</h6>
                    <span>Strategic Performance Info System</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

        <!-- HRIDS -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_DICTHR'))

         <!-- DICTHR -->
         <div class="col-lg-4">
           <a href="{{ Route::has('dicthr.index') ? route('dicthr.index') : '#' }}">
                      <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                          <div class="card-body" style="padding: 10px;">
                              <div class="d-flex align-items-center">
                                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                      <i class="bi bi-person-badge"></i>
                                  </div>
                                  <div class="ps-3">
                                      <h6 style="font-size: 22px;">DICTHR</h6>
                                      <span>Pengurusan Rekod Kakitangan</span>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </a>
              </div>

              @endif
              @endif


              @if (Auth::check())
               @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_TPA'))


                  <!-- TPAWSE -->
                  <div class="col-lg-4">
                  <a href="{{ Route::has('tpawse.portal.index') ? route('tpawse.portal.index') : '#' }}">
                      <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                          <div class="card-body" style="padding: 10px;">
                              <div class="d-flex align-items-center">
                                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                      <i class="bi bi-clipboard-check"></i>
                                  </div>
                                  <div class="ps-3">
                                      <h6 style="font-size: 22px;">TPAWSE</h6>
                                      <span>Penilaian Prestasi Guru</span>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </a>
              </div>

              @endif
              @endif

        <!-- Housing -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ADMIN_PERUMAHAN'))
        <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#perumahandaModal">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 10px;">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-bank2"></i>
                </div>
                <div class="ps-3">
                  <h6 style="font-size: 22px;">Housing</h6>
                  <span>Housing Management</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endif

        <!-- CMS -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_CDDINVENTORY'))
        <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#inventoryModal">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 10px;">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-file-earmark-arrow-up-fill"></i>
                </div>
                <div class="ps-3">
                  <h6 style="font-size: 22px;">CMS</h6>
                  <span>Curriculum Materials Service</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endif

        <!-- CCAM -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_CCA_ADMIN') || Auth::user()->hasRole('ROLE_CCA_FOCAL'))
        <div class="col-lg-4">
          <a href="{{ route('cca.cca.indexAll') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bx bx-bus-school"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">CCAM</h6>
                    <span>Co-Curriculum Activities Management</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

        <!-- Personnel ID -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <div class="col-lg-4">
          <a href="{{ route('personnelid.personnelids.index') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-medical"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">Personnel ID</h6>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

        <!-- Students & School Staff -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ATTENDANCE_EVENT'))
        <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#studentPengawasModal">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 10px;">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-flag"></i>
                </div>
                <div class="ps-3">
                  <h6 style="font-size: 22px;">Students & School Staff</h6>
                  <span>Attendance Event</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endif

        <!-- Post Establishment Management (PERJAWATAN) -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PERJAWATAN'))
        <div class="col-lg-4">
          <a href="{{ route('perjawatan.perjawatan.index') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-bank2"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">Post Establishment Management</h6>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

        <!-- Competency -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_COMPETENCY'))
        <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#competencyModal">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 10px;">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-journal-text"></i>
                </div>
                <div class="ps-3">
                  <h6 style="font-size: 22px;">Competency</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endif

        <!-- Vacant Position (JAWATAN KOSONG) -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_JAWATANKOSONG'))
        <div class="col-lg-4">
          <a href="{{ route('jawatankosong.jawatankosong.indexadmin') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">Vacant Position</h6>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

        <!-- Attendance Data (DATA KEHADIRAN) -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_DATAKEHADIRAN') || Auth::user()->hasRole('ROLE_PASUKANBERUNIFORM') || Auth::user()->hasRole('ROLE_PASUKANHADRAH'))
        <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#dkModal">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 10px;">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-file-earmark-arrow-up-fill"></i>
                </div>
                <div class="ps-3">
                  <h6 style="font-size: 22px;">Attendance Data</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endif

        <!-- One Stop Centre Feedback (PPKP) -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <div class="col-lg-4">
          <a href="{{ route('feedbacks.feedback.indexadmin') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-chat-dots"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">One Stop Centre Feedback</h6>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

      </div>
    </div>
    @endif

    <!-- Category: Facilities -->
    @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_OSCROOM') || Auth::user()->hasRole('ROLE_OSC_OP') || Auth::user()->hasRole('ROLE_BOOKINGROOM_ADMIN')))
    <div class="services-category">
      <h5 class="category-title"><i class="bi bi-door-open"></i> Facilities</h5>
      <div class="row">

        <!-- MRB -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_BOOKINGROOM_ADMIN') || Auth::user()->hasRole('ROLE_OSCROOM'))
        <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#bookingModal">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 10px;">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-door-open"></i>
                </div>
                <div class="ps-3">
                  <h6 style="font-size: 22px;">MRB</h6>
                  <span>Meeting Room Booking</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endif

        <!-- SRB -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_OSC_OP'))
        <div class="col-lg-4">
          <a href="{{ route('bookings.booking.home') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-door-open"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">SRB</h6>
                    <span>Syndicate Room Booking</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

      </div>
    </div>
    @endif

    <!-- Category: Archive & Records -->
    @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ART_FOCAL')))
    <div class="services-category">
      <h5 class="category-title"><i class="bi bi-archive"></i> Archive & Records</h5>
      <div class="row">

        <!-- ARCHIVED -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ART_FOCAL'))
        <div class="col-lg-4">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;" type="button" data-bs-toggle="modal" data-bs-target="#archivedModal">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-archive"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">Archived</h6>
                  </div>
                </div>
              </div>
            </div>
        </div>
        @endif
        @endif

      </div>
    </div>
    @endif

  </section>
@endif

<!-- ALL MODALS PLACED HERE AFTER THE MAIN SECTION -->

<!-- My SSM Modal -->
@if (Auth::check())
@if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_SSM') || Auth::user()->hasRole('ROLE_ACT') || Auth::user()->hasRole('ROLE_PERJAWATAN') || Auth::user()->hasRole('ROLE_BAKI_CUTI') || Auth::user()->hasRole('ROLE_PDMS_CUTI') || Auth::user()->hasRole('ROLE_PRESTASI'))
<div class="modal fade" id="ssmInternalModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">My SSM</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_SSM'))
        <a href="{{ route('ssms.ssm.indexall') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-person-check"></i>
                </div>
                <div class="ps-3">
                  <h6 style="font-size: 22px;">Activate SSM Account</h6>
                  <span>Sistem Sumber Manusia</span>
                </div>
              </div>
            </div>
          </div>
        </a>

        <a href="{{ route('ssmrequests.ssmrequest.indexall') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-plus"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">SSM Request Admin</h6>
                      <span>Sistem Sumber Manusia</span>
                    </div>
                  </div>
            </div>
          </div>
        </a>

        <a href="{{ route('ssmrequests.ssmrequest.indexpermohonan') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-plus"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">SSM Application</h6>
                      <span>Sistem Sumber Manusia</span>
                    </div>
                  </div>
            </div>
          </div>
        </a>
        @endif
        @endif

       <!-- INFO SUBMENU -->
@if (Auth::check())
@if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ACT') || Auth::user()->hasRole('ROLE_BAKI_CUTI') || Auth::user()->hasRole('ROLE_PDMS_CUTI'))
<div type="button" data-bs-toggle="modal" data-bs-target="#infoModal">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px; cursor: pointer;">
            <div class="card-body" style="padding: 10px;">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-info-lg"></i>
                </div>
                <div class="ps-3">
                  <h6 style="font-size: 22px;">Information</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endif
      <!-- PRESTASI -->
      @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PRESTASI'))
        <a href="{{ route('prestasi.prestasi.indexadmin') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-bookmark-star-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Prestasi</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
        @endif
        @endif
        <!-- EMPLOYEE MOVEMENT -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <a href="{{ route('emovements.emovement.index') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Employee Movement</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
        @endif
        @endif

      </div>
    </div>
  </div>
</div><!-- End My SSM Modal-->
@endif
@endif

<!-- INFO Submenu Modal -->
@if (Auth::check())
@if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ACT') || Auth::user()->hasRole('ROLE_BAKI_CUTI') || Auth::user()->hasRole('ROLE_PDMS_CUTI'))
<div class="modal fade" id="infoModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      @if (Auth::check())
@if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ACT') || Auth::user()->hasRole('ROLE_PDMS_CUTI'))
<a href="{{ route('cutis.cuti.index') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-calendar-week"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Cuti</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>

        <a href="{{ route('actings.acting.index') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-diagram-2"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Memangku</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>

        <a href="{{ route('bersaras.bersara.index') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-calendar-event"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Bersara</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
        @endif
        @endif

        @if (Auth::check())
@if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_BAKI_CUTI') || Auth::user()->hasRole('ROLE_PDMS_CUTI'))
<a href="{{ route('bakicuti.bakicutis.indexadmin') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-calendar-week"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Baki Cuti</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
        @endif
        @endif

      </div>
    </div>
  </div>
</div><!-- End INFO Submenu Modal-->
@endif
@endif


<!-- D FLOW TINDAKAN Submenu Modal -->
@if (Auth::check())
@if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_EMINITADMIN'))
<div class="modal fade" id="eminitModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">D Flow Action</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      

        <a href="{{ route('eminit.eminit.indexeminitadmin') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px; ">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-card-heading"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">List of D Flow</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>

           <a href="{{ route('eminit.eminit.indexeminit') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid #1F4E78; border-left: 4px solid #012970; margin-bottom: 20px; background-color: #EAF1FB;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-card-list"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Create D Flow</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>

   
     

        <a href="{{ route('eminit.eminit.indexeminitaction') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid #1F4E78; border-left: 4px solid #012970; margin-bottom: 20px; background-color: #EAF1FB;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-earmark-ruled-fill"></i>
                    </div>
                    <div class="ps-3">
                    <div style="display: flex; align-items: center; gap: 10px;">
                          <h6 style="font-size: 22px; margin: 0;">D Flow (Action)</h6>
                          <h6 style="
                              font-size: 26px; 
                              display: inline-block;
                              background-color: #FFD700; /* yellow */
                              color: white; 
                              width: 50px; 
                              height: 50px; 
                              line-height: 50px; 
                              text-align: center; 
                              border-radius: 50%;
                              font-weight: bold;
                              margin: 0;
                          ">
                              {{ $totalEmemoTindakan ?? 0 }}
                          </h6>
                      </div>

                    </div>
                  </div>
            </div>
          </div>
        </a>

             <a href="{{ route('adminsettings.adminsettingsdashboard') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px; ">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-gear-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Settings</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>


  
      </div>
    </div>
  </div>
</div><!-- End D FLOW TINDAKAN Modal-->
@endif
@endif

<!--  Modal Perumahan -->

@if (Auth::check())
@if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ADMIN_PERUMAHAN'))
<div class="modal fade" id="perumahandaModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                  {{-- ADD START --}}
                  <div type="button" data-bs-toggle="modal" data-bs-target="#addModal">
                    <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                        <div class="card-body" style="padding: 10px;">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-plus-circle"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 style="font-size: 22px;">Add</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                      {{-- ADD END --}}
                       
                    <a href="https://mesh.moe.gov.bn/daperumahan/indexpenghuni">
                        <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                            <div class="card-body" style="padding: 10px;">
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 style="font-size: 22px;">Senarai Penghuni</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="https://mesh.moe.gov.bn/daperumahan/indexpemilik">
                        <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                            <div class="card-body" style="padding: 10px;">
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-card-heading"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 style="font-size: 22px;">Senarai Pemilik</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="https://mesh.moe.gov.bn/daperumahan/indexiq">
                      <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                          <div class="card-body" style="padding: 10px;">
                              <div class="d-flex align-items-center">
                                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                      <i class="bi bi-card-list"></i>
                                  </div>
                                  <div class="ps-3">
                                      <h6 style="font-size: 22px;">Senarai IQ</h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </a>

                  <a href="https://mesh.moe.gov.bn/daperumahan/indexmenunggu">
                    <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                        <div class="card-body" style="padding: 10px;">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-card-list"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 style="font-size: 22px;">Senarai Menunggu</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                   
                </div>
            </div>
        </div>
    </div><!-- End Basic Modal-->

    {{-- ADD MODAL --}}
<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <a href="https://mesh.moe.gov.bn/daperumahan/createpemilik">
                  <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                      <div class="card-body" style="padding: 10px;">
                          <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                  <i class="bi bi-person-plus"></i>
                              </div>
                              <div class="ps-3">
                                  <h6 style="font-size: 22px;">Pemilik</h6>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>

              <a href="https://mesh.moe.gov.bn/daperumahan/createmenunggu">
                  <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                      <div class="card-body" style="padding: 10px;">
                          <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                  <i class="bi bi-person-plus"></i>
                              </div>
                              <div class="ps-3">
                                  <h6 style="font-size: 22px;">Menunggu</h6>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>
          </div>
      </div>
  </div>
</div>
{{-- END ADD MODAL --}}
<!--  End Perumahan Model-->
@endif
@endif

<!-- Competency Submenu Modal -->
@if (Auth::check())
@if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_COMPETENCY'))
<div class="modal fade" id="competencyModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Competency</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <a href="{{ route('competency.competency.indexadmincompetency') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-file-text"></i>
                </div>
                <div class="ps-3">
                  <h6 style="font-size: 22px;">Competency Assessment</h6>
                </div>
              </div>
            </div>
          </div>
        </a>
        
      @if (Auth::check())
      @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <a href="{{ route('competency.competency.HRDListCompetency') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-bar-chart-steps"></i>
                </div>
                <div class="ps-3">
                  <h6 style="font-size: 22px;">HRD List Competency</h6>
                </div>
              </div>
            </div>
          </div>
        </a>

        <a href="{{ route('competency.competency.HRDDashboard') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-bar-chart-line"></i>
                </div>
                <div class="ps-3">
                  <h6 style="font-size: 22px;">HRD Dashboard</h6>
                </div>
              </div>
            </div>
          </div>
        </a>
      @endif
      @endif
      </div>
    </div>
  </div>
</div><!-- End Competency Modal-->
@endif
@endif

<!-- Student Pengawas Submenu Modal -->
@if (Auth::check())
@if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ATTENDANCE_EVENT'))
<div class="modal fade" id="studentPengawasModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Students & School Staff</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <a href="{{ route('attendance.attendances.indexstudent') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Student</h6>
                      <span>List of Students</span>
                    </div>
                  </div>
            </div>
          </div>
        </a>

        <a href="{{ route('attendance.attendances.indexstaff') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-plus"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Staff</h6>
                      <span>List of Staffs</span>
                    </div>
                  </div>
            </div>
          </div>
        </a>

        <a href="{{ route('attendance.attendances.indexevent') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-plus"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Event</h6>
                      <span>List of Events</span>
                    </div>
                  </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div><!-- End Student Pengawas Modal-->
@endif
@endif

<!-- INVENTORY Submenu Modal -->
@if (Auth::check())
@if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_CDDINVENTORY'))
<div class="modal fade" id="inventoryModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pengurusan Bahan-Bahan Kurikulum</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <a href="https://mesh.moe.gov.bn/inventory/indexadmin">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-card-list"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Pengurusan Bahan-Bahan Kurikulum</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>

        <a href="https://mesh.moe.gov.bn/inventory/indexsebutharga">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-card-heading"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Senarai Agihan & Pengesahan Penerimaan Bahan</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>

        <a href="https://mesh.moe.gov.bn/inventory/indexbook">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-card-heading"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Senarai Buku</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div><!-- End INVENTORY Modal-->
@endif
@endif

<!-- DATA KEHADIRAN Submenu Modal -->
@if (Auth::check())
@if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_DATAKEHADIRAN') || Auth::user()->hasRole('ROLE_PASUKANBERUNIFORM') || Auth::user()->hasRole('ROLE_PASUKANHADRAH'))
<div class="modal fade" id="dkModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Data Kehadiran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_DATAKEHADIRAN'))
        <a href="{{ route('datakehadiran.datakehadiran.indexadmin') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-card-list"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Masterlist</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>

        <a href="{{ route('datakehadiran.datakehadiran.indexlist') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-card-list"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Assigned Access</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
        @endif
        @endif

        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_DATAKEHADIRAN') || Auth::user()->hasRole('ROLE_PASUKANHADRAH'))
        <a href="{{ route('datakehadiran.datakehadiran.indexhadrah') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-card-list"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Pasukan Hadrah</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
        @endif
        @endif

        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_DATAKEHADIRAN') || Auth::user()->hasRole('ROLE_PASUKANBERUNIFORM'))
        <a href="{{ route('datakehadiran.datakehadiran.indexuniform') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-card-list"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Pasukan Beruniform</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
        @endif
        @endif

         @if (Auth::check())
         @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_DATAKEHADIRAN'))
         <a href="{{ route('datakehadiran.datakehadiran.indexpegawai') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-card-list"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Pegawai & Kakitangan</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>

          <a href="{{ route('dkreport') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-card-list"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Dashboard</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
        @endif
        @endif

      </div>
    </div>
  </div>
</div><!-- End DATA KEHADIRAN Modal-->
@endif
@endif

<!-- Booking Submenu Modal -->
@if (Auth::check())
@if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_BOOKINGROOM_ADMIN') || Auth::user()->hasRole('ROLE_BOOKINGROOM_ADMIN'))
<div class="modal fade" id="bookingModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tempahan Bilik Mesyuarat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <a href="{{ route('adminbooking.searchroomadmin') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-search"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Cari Ketersediaan Bilik</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>

        <a href="{{ route('adminbooking.systemcalendaradmin') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-calendar"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Kalendar</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
      
        <a href="{{ route('adminbooking.booking.indexadmin') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-calendar-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Tempahan</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>

        <a href="{{ route('adminbooking.rooms.index') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-door-open"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Bilik</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div><!-- End Booking Submenu Modal-->
@endif
@endif

<!-- Archived Modal -->
@if (Auth::check())
@if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ART_FOCAL'))
<div class="modal fade" id="archivedModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Archived</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ART_FOCAL'))
        <a href="{{ route('arts.art.indexAll') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-earmark-medical"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">ART</h6>
                      <span>Antigen Rapid Test</span>
                    </div>
                  </div>
            </div>
          </div>
        </a>
        @endif
        @endif

        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <a href="{{ route('borang.borangs.indexadmin') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-gear-wide-connected"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">MESH Request Form</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
        @endif
        @endif

        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <a href="{{ route('pps.pps.index') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">One Stop Centre Visitor</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
        @endif
        @endif

        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <a href="{{ route('users.user.create') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-plus"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">User Create</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
        @endif
        @endif

      </div>
    </div>
  </div>
</div><!-- End Archived Modal-->
@endif
@endif

</div>
    </section>

@endsection