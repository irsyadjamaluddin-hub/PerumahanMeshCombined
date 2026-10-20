{{-- OLD VERSION (oldver-2025-2026septver): full copy of resources/views/servicesdashboard.blade.php taken on 29 Sept 2026, just before the old code was --}}
{{-- removed from it. Old code is in the "ORIGINAL CODE" / "OLD ... kept for reference" blocks. Not used by any route. --}}
@extends('layouts.app-all')

@section('title', 'Services')

@section('content')

  <?php
    $pagename = "Services";
  ?>

    <div class="pagetitle">
      <h1>Services</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Services</li>
        </ol>
      </nav>
    </div>

    {{-- ============ OLD SERVICES STYLES (pre services-layout redesign) — kept for reference, do not delete ============
    <style>
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
    .custom-tooltip-black {
      position: absolute;
      background-color: white;
      color: black;
      padding: 5px 12px;
      border-radius: 4px;
      font-size: 14px;
      white-space: nowrap;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s;
      pointer-events: none;
      z-index: 1000;
      top: 10px;
      right: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
      border: 1px solid #f0f0f0;
    }
    .coming-soon-card {
      position: relative;
    }
    .coming-soon-card:hover .custom-tooltip-black {
      opacity: 1;
      visibility: visible;
    }
    </style>
    ============ END OLD SERVICES STYLES ============ --}}

    <style>
      /* ======= NEW services layout (svc- prefixed so it can't clash with
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
    </style>

    <!-- ============ OLD SERVICES CONTENT (pre services-layout redesign) — kept for reference, do not delete.
         Wrapped with a real conditional set to a constant false value, rather than a Blade doc-comment
         block, because this block contains its own doc-comments — and Blade's comment stripping is not
         nesting-aware, so it would have closed early and left part of "the old content" rendering live.
         ============ -->
    @if (false)
    <section class="section dashboard">

      <!-- ===================================== -->
      <!-- Category: Human Resource -->
      <!-- ===================================== -->
      <div class="services-category">
        <h5 class="category-title"><i class="bi bi-person-badge"></i> Human Resource</h5>
        <div class="row">

          <!-- My SSM -->
          <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#ssmModal">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                <div class="card-body" style="padding: 15px;">
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-briefcase"></i>
                        </div>
                        <div class="ps-3">
                          <h6 style="font-size: 22px;">My SSM</h6>
                          <span>Human Resource System</span>
                        </div>
                      </div>
                </div>
              </div>
          </div>

          <!-- Permohonan Peranan Akses -->
          <div class="col-lg-4">
            <a href="https://mesh.moe.gov.bn/borangpermohonanperanan" style="text-decoration: none;">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-square"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Role Access</h6>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <!-- End Permohonan Peranan Akses -->

        </div>
      </div>

      <!-- ===================================== -->
      <!-- Category: Communication & Notifications -->
      <!-- ===================================== -->
      <div class="services-category">
        <h5 class="category-title"><i class="bi bi-megaphone"></i> Communication & Notifications</h5>
        <div class="row">

          {{-- Mesh Perkhidmatan Notifikasi (MPN) --}}
          <div class="col-lg-4">
            @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ONS_USER')))
              {{-- Clickable version for authorized users --}}
              <a href="{{ route('onlinenotifications.onlinenotification.indexuser') }}">
                <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; transition: 0.3s;">
                  <div class="card-body" style="padding: 15px;">
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
            @else
              {{-- Disabled version for users without access --}}
              <div class="card info-card sales-card coming-soon-card" style="padding: 0px; border: 1px solid grey; opacity: 0.6; cursor: not-allowed; position: relative;">
                <div class="card-body" style="padding: 15px;">
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
                <span class="custom-tooltip-black">Access required</span>
              </div>
            @endif
          </div>

          {{-- Mesh Kongsi Pautan (MKP) – Always visible --}}
          <div class="col-lg-4">
            <a href="{{ route('linkup.index') }}">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                <div class="card-body" style="padding: 15px;">
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

        </div>
      </div>

      <!-- ===================================== -->
      <!-- Category: Attendance & Events -->
      <!-- ===================================== -->
      <div class="services-category">
        <h5 class="category-title"><i class="bi bi-calendar-check"></i> Attendance & Events</h5>
        <div class="row">

          <!-- MEA -->
          <div class="col-lg-4">
            <a href="https://mesh.moe.gov.bn/moeevent">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-calendar-event-fill"></i>
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

          <!-- MAS -->
          <div class="col-lg-4">
            <a href="{{ route('slipkehadiran') }}">       <!-- FROM MOE TO NOW -->
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people-fill"></i>
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

          <!-- Q&A -->
          <div class="col-lg-4">
            <a href="https://mesh.moe.gov.bn/Q&A">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                <div class="card-body" style="padding: 15px;">
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

        </div>
      </div>

      <!-- ===================================== -->
      <!-- Category: Academic Operations -->
      <!-- ===================================== -->
      <div class="services-category">
        <h5 class="category-title"><i class="bi bi-mortarboard"></i> Operations</h5>
        <div class="row">

          <!-- CMS -->
          <div class="col-lg-4">
            <a href="{{ route('cddinventory.cddinventory.index') }}">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-bookmark-star-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">CMS</h6>
                      <span>Curriculum Materials Service</span>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <!-- CCAM -->
          <div class="col-lg-4">
            <a href="{{ route('cca.cca.index') }}">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-trophy"></i>
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

          <!-- EMA -->
          <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#emaModal">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 15px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-envelope-paper"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">
                      EMA
                      @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_EMINITADMIN')))
                      <span class="badge rounded-pill" style="background-color:#1F4E78; color:#fff; font-size:11px; padding:3px 9px; vertical-align:middle;">
                        <i class="bi bi-shield-lock-fill me-1"></i>Admin
                      </span>
                      @endif
                    </h6>
                    <span>E-Memo Action</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ===================================== -->
      <!-- Category: Facilities & Support -->
      <!-- ===================================== -->
      <div class="services-category">
        <h5 class="category-title"><i class="bi bi-tools"></i> Facilities & Support</h5>
        <div class="row">

          <!-- Pengurusan Tempahan Fasilitas -->
          <div class="col-lg-4">

            <!-- MAIN CARD -->
            <div class="card info-card sales-card"
                 style="padding:0; border:1px solid blue; cursor:pointer;"
                 onclick="openFasilitasMain()">
              <div class="card-body" style="padding:15px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-door-open"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size:22px;">Facility Booking Management</h6>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Permohonan Sokongan -->
          <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#permohonanModal">
                <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                  <div class="card-body" style="padding: 15px;">
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-file-code"></i>
                      </div>
                      <div class="ps-3">
                        <h6 style="font-size: 22px;">Support Request</h6>
                      </div>
                    </div>
                  </div>
                </div>
          </div>

          {{-- Perkhidmatan Lain (Other Service) removed from view — see git history to restore (FSS, MBD, MAC) --}}

        </div>
      </div>

    </section>
    @endif
    <!-- ============ END OLD SERVICES CONTENT ============ -->

    <div class="svc-search-wrap">
      <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="11" cy="11" r="7"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
      <input id="svcSearchInput" type="text" autocomplete="off" placeholder="Search services">
    </div>

    <section class="svc-dashboard" id="svcAllServicesList">

      {{-- Category: Human Resource --}}
      <div class="svc-category">
        <div class="svc-cat-head" style="--svc-accent:#6656A3;">
          <i class="bi bi-person-badge"></i>
          <span class="svc-cat-title">Human Resource</span>        </div>
        <div class="svc-grid">

          <div class="svc-card" type="button" data-bs-toggle="modal" data-bs-target="#ssmModal" style="--svc-accent:#6656A3;--svc-tint:#EFEBF8;">
            <div class="svc-card-icon"><i class="bi bi-briefcase"></i></div>
            <div class="svc-card-title">My SSM</div>
            <div class="svc-card-sub">Human Resource System</div>
            <div class="svc-card-desc">Manage and activate SSM accounts, update personal information and documents, and submit enquiries related to SSM services.</div>
            <span class="svc-cta">Open</span>
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

                    <style>
                    .coming-soon-card {
                      position: relative;
                    }

                    .custom-tooltip {
                      position: absolute;
                      background-color: white;
                      color: red;
                      padding: 5px 12px;
                      border-radius: 4px;
                      font-size: 14px;
                      white-space: nowrap;
                      opacity: 0;
                      visibility: hidden;
                      transition: opacity 0.3s;
                      pointer-events: none;
                      z-index: 1000;
                      top: 10px;
                      right: 10px;
                      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
                      border: 1px solid #f0f0f0;
                    }

                    .coming-soon-card:hover .custom-tooltip {
                      opacity: 1;
                      visibility: visible;
                    }
                    </style>

                </div>
              </div>
            </div>
          </div><!-- End My SSM Modal-->

          {{-- Role Access card moved to the Facilities & Support category, near the end of this file --}}

        </div>
      </div>

      {{-- Category: Communication & Notifications --}}
      <div class="svc-category">
        <div class="svc-cat-head" style="--svc-accent:#1F7A8C;">
          <i class="bi bi-megaphone"></i>
          <span class="svc-cat-title">Communication & Notifications</span>        </div>
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
              <div class="svc-card-desc">Broadcast official messages and documents to multiple recipients simultaneously via WhatsApp using the WhatsApp API.  </div>
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
          <span class="svc-cat-title">Attendance & Events</span>        </div>
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
          <span class="svc-cat-title">Operations</span>        </div>
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
            <span class="svc-cta">Open</span>
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
          <span class="svc-cat-title">Facilities & Support</span>        </div>
        <div class="svc-grid">

          <div class="svc-card" type="button" onclick="openFasilitasMain()" style="--svc-accent:#A24638;--svc-tint:#F7E9E6;">
            <div class="svc-card-icon"><i class="bi bi-door-open"></i></div>
            <div class="svc-card-title">Facility Booking Management</div>
            <div class="svc-card-desc">Reserve meeting and syndicate rooms within the Ministry of Education for internal meetings and activities.</div>
            <span class="svc-cta">Open</span>
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
            <span class="svc-cta">Open</span>
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

          {{-- =============== NISAH =============== --}}
          {{-- Role Access card, moved here from the Human Resource category --}}
          {{-- (accent color updated from HR's purple #6656A3 to this category's #A24638) --}}
          <!--Permohonan Peranan Akses -->
          <a class="svc-card" href="https://mesh.moe.gov.bn/borangpermohonanperanan" style="--svc-accent:#A24638;--svc-tint:#F7E9E6;">
            <div class="svc-card-icon"><i class="bi bi-person-square"></i></div>
            <div class="svc-card-title">Role Access</div>
            <div class="svc-card-desc">Request or review the MESH roles and permission levels assigned to your account.</div>
            <span class="svc-cta">Open</span>
          </a>
          {{-- =============================================== --}}

        </div>
      </div>

    </section>

    <script>
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

        <!-- Baki Cuti - Standalone Card -->
        <!-- <div class="col-lg-4">
          <a href="{{ route('bakicuti.bakicutis.index') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 15px;">
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-calendar2-week"></i>
                      </div>
                      <div class="ps-3">
                        <h6 style="font-size: 22px;">Baki Cuti</h6>
                      </div>
                    </div>
              </div>
            </div>
          </a>
        </div> -->

    </section>

@endsection
