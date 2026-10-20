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

  /* ======= v4 services layout, copied from superadmindashboard.blade.php ======= */
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
    background:#fff; border:1px solid #e6e9f2; border-radius:13px; padding:16px;
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

  /* filtered-out state used by the search box below */
  .svc-card[hidden], .svc-category[hidden]{ display:none; }
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

<div class="svc-search-wrap">
  <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="11" cy="11" r="7"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
  <input id="svcSearchInput" type="text" autocomplete="off" placeholder="Search services">
</div>

@if (Auth::check() && (!Auth::user()->hasRole('ROLE_SUPERADMIN')))
  <section class="svc-dashboard" id="svcAllServicesList">

    <!-- Category: Human Resource -->
    @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_SSM') || Auth::user()->hasRole('ROLE_ACT') || Auth::user()->hasRole('ROLE_BAKI_CUTI') || Auth::user()->hasRole('ROLE_PDMS_CUTI') || Auth::user()->hasRole('ROLE_PRESTASI')))
    <div class="svc-category">
      <div class="svc-cat-head" style="--svc-accent:#6656A3;">
        <i class="bi bi-person-badge"></i>
        <span class="svc-cat-title">Human Resource</span>
      </div>
      <div class="svc-grid">

        <!-- MY SSM -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_SSM') || Auth::user()->hasRole('ROLE_ACT') || Auth::user()->hasRole('ROLE_BAKI_CUTI') || Auth::user()->hasRole('ROLE_PDMS_CUTI') || Auth::user()->hasRole('ROLE_PRESTASI'))
        <div class="svc-card" type="button" data-bs-toggle="modal" data-bs-target="#ssmInternalModal" style="--svc-accent:#6656A3;--svc-tint:#EFEBF8;">
          <div class="svc-card-icon"><i class="bi bi-briefcase-fill"></i></div>
          <div class="svc-card-title">My SSM</div>
          <div class="svc-card-desc">Manage and activate SSM accounts, update personal information and documents, and submit enquiries related to SSM services.</div>
          <span class="svc-cta">Open</span>
        </div>
        @endif
        @endif

        <!-- PERMOHONAN PERANAN AKSES -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ACT'))
        <a class="svc-card" href="{{ route('skbs.skb.indexadmin') }}" style="--svc-accent:#6656A3;--svc-tint:#EFEBF8;">
          <div class="svc-card-icon"><i class="bi bi-file-text"></i></div>
          <div class="svc-card-title">Access Role Application</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

      </div>
    </div>
    @endif

    <!-- Category: Communication & Notifications -->
    @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ONS_ADMIN')))
    <div class="svc-category">
      <div class="svc-cat-head" style="--svc-accent:#1F7A8C;">
        <i class="bi bi-megaphone"></i>
        <span class="svc-cat-title">Communication & Notifications</span>
      </div>
      <div class="svc-grid">

        <!-- MNS -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ONS_ADMIN'))
        <a class="svc-card" href="{{ route('onlinenotifications.onlinenotification.index') }}" style="--svc-accent:#1F7A8C;--svc-tint:#E7F4F5;">
          <div class="svc-card-icon"><i class="bi bi-phone-vibrate"></i></div>
          <div class="svc-card-title">MNS</div>
          <div class="svc-card-sub">MESH Notification Service</div>
          <div class="svc-card-desc">Broadcast official messages and documents to multiple recipients simultaneously via WhatsApp using the WhatsApp API.</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

        <!-- MLS -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <a class="svc-card" href="{{ route('linkup.index') }}" style="--svc-accent:#1F7A8C;--svc-tint:#E7F4F5;">
          <div class="svc-card-icon"><i class="bi bi-link-45deg"></i></div>
          <div class="svc-card-title">MLS</div>
          <div class="svc-card-sub">MESH Link Sharing</div>
          <div class="svc-card-desc">Generate shortened links and QR codes for easy sharing and reference.</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

      </div>
    </div>
    @endif

    <!-- Category: Attendance & Events -->
    @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_QUESTION&ANSWER') || Auth::user()->hasRole('ROLE_MOEEVENT') || Auth::user()->hasRole('ROLE_SLIPKEHADIRAN')))
    <div class="svc-category">
      <div class="svc-cat-head" style="--svc-accent:#B9762E;">
        <i class="bi bi-calendar-check"></i>
        <span class="svc-cat-title">Attendance & Events</span>
      </div>
      <div class="svc-grid">

        <!-- Q&A -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_QUESTION&ANSWER'))
        <a class="svc-card" href="{{ route('st.soalantaklimat.indexadmin') }}" style="--svc-accent:#B9762E;--svc-tint:#F8EEE1;">
          <div class="svc-card-icon"><i class="bi bi-file-text"></i></div>
          <div class="svc-card-title">Q&A</div>
          <div class="svc-card-sub">Q&A Service</div>
          <div class="svc-card-desc">Submit and track questions/responses anonymously for training or event purposes</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

        <!-- MEA -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_MOEEVENT'))
        <a class="svc-card" href="{{ route('moeevent.moeevent.indexadmin') }}" style="--svc-accent:#B9762E;--svc-tint:#F8EEE1;">
          <div class="svc-card-icon"><i class="bi bi-card-heading"></i></div>
          <div class="svc-card-title">MEA</div>
          <div class="svc-card-sub">MESH Event Attendance</div>
          <div class="svc-card-desc">Manage attendance for Ministry activities, including participant check-in and attendance records for meetings, discussions, training sessions, and other official activities.</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

        <!-- MAS -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_SLIPKEHADIRAN'))
        <a class="svc-card" href="{{ route('sk.slipkedatangan.indexadmin') }}" style="--svc-accent:#B9762E;--svc-tint:#F8EEE1;">
          <div class="svc-card-icon"><i class="bi bi-building"></i></div>
          <div class="svc-card-title">MAS</div>
          <div class="svc-card-sub">MESH Attendance Slip</div>
          <div class="svc-card-desc">Attendance slips for Ministry events and training sessions.</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

      </div>
    </div>
    @endif

    <!-- Category: Support Requests -->
    @if (Auth::check() && Auth::user()->hasRole('ROLE_SUPERADMIN'))
    <div class="svc-category">
      <div class="svc-cat-head" style="--svc-accent:#B33A5B;">
        <i class="bi bi-file-code"></i>
        <span class="svc-cat-title">Support Requests</span>
      </div>
      <div class="svc-grid">

        <!-- DRF -->
        <a class="svc-card" href="{{ route('devops-request.indexadmin') }}" style="--svc-accent:#B33A5B;--svc-tint:#F9E9EE;">
          <div class="svc-card-icon"><i class="bi bi-gear-wide-connected"></i></div>
          <div class="svc-card-title">DRF</div>
          <div class="svc-card-sub">Devops Request Form</div>
          <div class="svc-card-desc">Submit requests for technical consultation, system development, enhancements, and other IT-related services based on departmental needs.</div>
          <span class="svc-cta">Open</span>
        </a>

        <!-- DSS -->
        <a class="svc-card" href="{{ route('support-center.index') }}" style="--svc-accent:#B33A5B;--svc-tint:#F9E9EE;">
          <div class="svc-card-icon"><i class="bi bi-headset"></i></div>
          <div class="svc-card-title">DSS</div>
          <div class="svc-card-sub">Devops Support Service</div>
          <div class="svc-card-desc">Manage, monitor, and coordinate technical support requests through the DevOps Support Desk.</div>
          <span class="svc-cta">Open</span>
        </a>

        <!-- MOE Enquiries -->
        <a class="svc-card" href="{{ route('soalanbiskita.soalanbiskita.indexadmin') }}" style="--svc-accent:#B33A5B;--svc-tint:#F9E9EE;">
          <div class="svc-card-icon"><i class="bi bi-question-square"></i></div>
          <div class="svc-card-title">MOE Enquiries</div>
          <div class="svc-card-desc">Send a general enquiry to the Ministry of Education.</div>
          <span class="svc-cta">Open</span>
        </a>

      </div>
    </div>
    @endif

    <!-- Category: Other Services -->
    @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_BNS') || Auth::user()->hasRole('ROLE_TEGAHAN') || Auth::user()->hasRole('ROLE_POSTUP') || Auth::user()->hasRole('ROLE_DATAKERAMAIAN')))
    <div class="svc-category">
      <div class="svc-cat-head" style="--svc-accent:#52618C;">
        <i class="bi bi-gear"></i>
        <span class="svc-cat-title">Other Services</span>
      </div>
      <div class="svc-grid">

        <!-- MB -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_BNS'))
        <a class="svc-card" href="{{ route('bn.banner.index') }}" style="--svc-accent:#52618C;--svc-tint:#EBEDF5;">
          <div class="svc-card-icon"><i class="bi bi-view-list"></i></div>
          <div class="svc-card-title">MB</div>
          <div class="svc-card-sub">MESH Banner</div>
          <div class="svc-card-desc">Manage the informational banners shown on the MESH homepage.</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

        <!-- MA -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <a class="svc-card" href="{{ route('announcement.announcementadmin') }}" style="--svc-accent:#52618C;--svc-tint:#EBEDF5;">
          <div class="svc-card-icon"><i class="bi bi-megaphone"></i></div>
          <div class="svc-card-title">MA</div>
          <div class="svc-card-sub">MESH Announcement</div>
          <div class="svc-card-desc">Manage and Publish announcements to all MESH users.</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

        <!-- MN -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <a class="svc-card" href="{{ route('news.newsadmin') }}" style="--svc-accent:#52618C;--svc-tint:#EBEDF5;">
          <div class="svc-card-icon"><i class="bi bi-newspaper"></i></div>
          <div class="svc-card-title">MN</div>
          <div class="svc-card-sub">MESH News</div>
          <div class="svc-card-desc">Manage and Publish news articles and updates on MESH.</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

        <!-- MPC -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_TEGAHAN'))
        <a class="svc-card" href="{{ route('msc.mscadmin') }}" style="--svc-accent:#52618C;--svc-tint:#EBEDF5;">
          <div class="svc-card-icon"><i class="bi bi-building-slash"></i></div>
          <div class="svc-card-title">MPC</div>
          <div class="svc-card-sub">Prohibited Company</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

        <!-- PostUp -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_POSTUP'))
        <a class="svc-card" href="{{ route('postup.postup.indexadmin') }}" style="--svc-accent:#52618C;--svc-tint:#EBEDF5;">
          <div class="svc-card-icon"><i class="bi bi-file-earmark-arrow-up-fill"></i></div>
          <div class="svc-card-title">PostUp</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

        <!-- Student Data -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_DATAKERAMAIAN'))
        <a class="svc-card" href="{{ route('inventory.datakeramaianindex') }}" style="--svc-accent:#52618C;--svc-tint:#EBEDF5;">
          <div class="svc-card-icon"><i class="bi bi-table"></i></div>
          <div class="svc-card-title">Student Data</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

      </div>
    </div>
    @endif

   
    <!-- Category: Internal -->
    @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_CCA_ADMIN') || Auth::user()->hasRole('ROLE_CCA_FOCAL') || Auth::user()->hasRole('ROLE_PERJAWATAN') || Auth::user()->hasRole('ROLE_PRESTASI') || Auth::user()->hasRole('ROLE_COMPETENCY') || Auth::user()->hasRole('ROLE_JAWATANKOSONG') || Auth::user()->hasRole('ROLE_CDDINVENTORY') || Auth::user()->hasRole('ROLE_DATAKEHADIRAN') || Auth::user()->hasRole('ROLE_EMINITADMIN') || Auth::user()->hasRole('ROLE_ATTENDANCE_EVENT') || Auth::user()->hasRole('ROLE_PASUKANBERUNIFORM') || Auth::user()->hasRole('ROLE_PASUKANHADRAH') || Auth::user()->hasRole('ROLE_ADMIN_PERUMAHAN') || Auth::user()->hasRole('ROLE_HRIDS') || Auth::user()->hasRole('ROLE_HRIDS_NONTEACHING')))
    <div class="svc-category">
      <div class="svc-cat-head" style="--svc-accent:#3B7A55;">
        <i class="bi bi-building"></i>
        <span class="svc-cat-title">Internal</span>
      </div>
      <div class="svc-grid">

        <!-- D Flow -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_EMINITADMIN'))
        <div class="svc-card" type="button" data-bs-toggle="modal" data-bs-target="#eminitModal" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
          <div class="svc-card-icon"><i class="bi bi-collection"></i></div>
          <div class="svc-card-title">D Flow</div>
          <div class="svc-card-sub">Documentation Flow</div>
          <div class="svc-card-desc">Create, track, and action official e-memos routed to your department.</div>
          <span class="svc-cta">Open</span>
        </div>
        @endif
        @endif

        <!-- HRIDS -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_HRIDS') || Auth::user()->hasRole('ROLE_HRIDS_NONTEACHING'))
        <a class="svc-card" href="{{ route('pj.landingpage') }}" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
          <div class="svc-card-icon"><i class="bi bi-database"></i></div>
          <div class="svc-card-title">HRIDS</div>
          <div class="svc-card-sub">Human Resources Integrated Database System</div>
          <div class="svc-card-desc">Manage and maintain human resources data across the Ministry of Education through an integrated platform</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

        <!-- SPIS -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_SPIS_ADMIN'))
        <a class="svc-card" href="{{ route('project-register.index') }}" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
          <div class="svc-card-icon"><i class="bi bi-graph-up-arrow"></i></div>
          <div class="svc-card-title">SPIS</div>
          <div class="svc-card-sub">Strategic Performance Info System</div>
          <div class="svc-card-desc">Strategic Performance Info System</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

        <!-- DICTHR -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_DICTHR'))
        <a class="svc-card" href="{{ Route::has('dicthr.index') ? route('dicthr.index') : '#' }}" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
          <div class="svc-card-icon"><i class="bi bi-person-badge"></i></div>
          <div class="svc-card-title">DICTHR</div>
          <div class="svc-card-sub">Pengurusan Rekod Kakitangan</div>
          <div class="svc-card-desc">Manage DICT staff biodata, training, leave, and employment records.</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

        <!-- TPAWSE -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_TPA'))
        <a class="svc-card" href="{{ Route::has('tpawse.portal.index') ? route('tpawse.portal.index') : '#' }}" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
          <div class="svc-card-icon"><i class="bi bi-clipboard-check"></i></div>
          <div class="svc-card-title">TPAWSE</div>
          <div class="svc-card-sub">Penilaian Prestasi Guru</div>
          <div class="svc-card-desc">Penilaian Prestasi Guru</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

        <!-- Housing -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ADMIN_PERUMAHAN'))
        <div class="svc-card" type="button" data-bs-toggle="modal" data-bs-target="#perumahandaModal" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
          <div class="svc-card-icon"><i class="bi bi-bank2"></i></div>
          <div class="svc-card-title">Housing</div>
          <div class="svc-card-sub">Housing Management</div>
          <div class="svc-card-desc">Administer housing allocations for Ministry staff.</div>
          <span class="svc-cta">Open</span>
        </div>
        @endif
        @endif

        <!-- CMS -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_CDDINVENTORY'))
        <div class="svc-card" type="button" data-bs-toggle="modal" data-bs-target="#inventoryModal" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
          <div class="svc-card-icon"><i class="bi bi-file-earmark-arrow-up-fill"></i></div>
          <div class="svc-card-title">CMS</div>
          <div class="svc-card-sub">Curriculum Materials Service</div>
          <div class="svc-card-desc">Manage applications and services related to curriculum materials.</div>
          <span class="svc-cta">Open</span>
        </div>
        @endif
        @endif

        <!-- CCAM -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_CCA_ADMIN') || Auth::user()->hasRole('ROLE_CCA_FOCAL'))
        <a class="svc-card" href="{{ route('cca.cca.indexAll') }}" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
          <div class="svc-card-icon"><i class="bx bx-bus-school"></i></div>
          <div class="svc-card-title">CCAM</div>
          <div class="svc-card-sub">Co-Curriculum Activities Management</div>
          <div class="svc-card-desc">Manage and coordinate co-curriculum activities.</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

        <!-- Personnel ID -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <a class="svc-card" href="{{ route('personnelid.personnelids.index') }}" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
          <div class="svc-card-icon"><i class="bi bi-file-medical"></i></div>
          <div class="svc-card-title">Personnel ID</div>
          <div class="svc-card-desc">Manage and issue staff identification records.</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

        <!-- Students & School Staff -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ATTENDANCE_EVENT'))
        <div class="svc-card" type="button" data-bs-toggle="modal" data-bs-target="#studentPengawasModal" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
          <div class="svc-card-icon"><i class="bi bi-flag"></i></div>
          <div class="svc-card-title">Students & School Staff</div>
          <div class="svc-card-sub">Attendance Event</div>
          <div class="svc-card-desc">Track attendance across students and school staff.</div>
          <span class="svc-cta">Open</span>
        </div>
        @endif
        @endif

        <!-- Post Establishment Management (PERJAWATAN) -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PERJAWATAN'))
        <a class="svc-card" href="{{ route('perjawatan.perjawatan.index') }}" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
          <div class="svc-card-icon"><i class="bi bi-bank2"></i></div>
          <div class="svc-card-title">Post Establishment Management</div>
          <div class="svc-card-desc">Manage approved staffing posts and establishment records.</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

        <!-- Competency -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_COMPETENCY'))
        <div class="svc-card" type="button" data-bs-toggle="modal" data-bs-target="#competencyModal" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
          <div class="svc-card-icon"><i class="bi bi-journal-text"></i></div>
          <div class="svc-card-title">Competency</div>
          <span class="svc-cta">Open</span>
        </div>
        @endif
        @endif

        <!-- Vacant Position (JAWATAN KOSONG) -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_JAWATANKOSONG'))
        <a class="svc-card" href="{{ route('jawatankosong.jawatankosong.indexadmin') }}" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
          <div class="svc-card-icon"><i class="bi bi-people"></i></div>
          <div class="svc-card-title">Vacant Position</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

        <!-- Attendance Data (DATA KEHADIRAN) -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_DATAKEHADIRAN') || Auth::user()->hasRole('ROLE_PASUKANBERUNIFORM') || Auth::user()->hasRole('ROLE_PASUKANHADRAH'))
        <div class="svc-card" type="button" data-bs-toggle="modal" data-bs-target="#dkModal" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
          <div class="svc-card-icon"><i class="bi bi-file-earmark-arrow-up-fill"></i></div>
          <div class="svc-card-title">Attendance Data</div>
          <div class="svc-card-desc">Upload and manage attendance datasets across departments.</div>
          <span class="svc-cta">Open</span>
        </div>
        @endif
        @endif

        <!-- One Stop Centre Feedback (PPKP) -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <a class="svc-card" href="{{ route('feedbacks.feedback.indexadmin') }}" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
          <div class="svc-card-icon"><i class="bi bi-chat-dots"></i></div>
          <div class="svc-card-title">One Stop Centre Feedback</div>
          <div class="svc-card-desc">Review feedback submitted through the One Stop Centre.</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

      </div>
    </div>
    @endif

    <!-- Category: Facilities -->
    @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_OSCROOM') || Auth::user()->hasRole('ROLE_OSC_OP') || Auth::user()->hasRole('ROLE_BOOKINGROOM_ADMIN')))
    <div class="svc-category">
      <div class="svc-cat-head" style="--svc-accent:#A24638;">
        <i class="bi bi-door-open"></i>
        <span class="svc-cat-title">Facilities</span>
      </div>
      <div class="svc-grid">

        <!-- MRB -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_BOOKINGROOM_ADMIN') || Auth::user()->hasRole('ROLE_OSCROOM'))
        <div class="svc-card" type="button" data-bs-toggle="modal" data-bs-target="#bookingModal" style="--svc-accent:#A24638;--svc-tint:#F7E9E6;">
          <div class="svc-card-icon"><i class="bi bi-door-open"></i></div>
          <div class="svc-card-title">MRB</div>
          <div class="svc-card-sub">Meeting Room Booking</div>
          <div class="svc-card-desc">Check availability, book, and manage meeting rooms for meetings, discussions, and official activities.</div>
          <span class="svc-cta">Open</span>
        </div>
        @endif
        @endif

        <!-- SRB -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_OSC_OP'))
        <a class="svc-card" href="{{ route('bookings.booking.home') }}" style="--svc-accent:#A24638;--svc-tint:#F7E9E6;">
          <div class="svc-card-icon"><i class="bi bi-door-open"></i></div>
          <div class="svc-card-title">SRB</div>
          <div class="svc-card-sub">Syndicate Room Booking</div>
          <div class="svc-card-desc">Check availability, book, and manage syndicate rooms for small meetings of up to 4 people.</div>
          <span class="svc-cta">Open</span>
        </a>
        @endif
        @endif

      </div>
    </div>
    @endif

    <!-- Category: Archive & Records -->
    @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ART_FOCAL')))
    <div class="svc-category">
      <div class="svc-cat-head" style="--svc-accent:#8A6D4E;">
        <i class="bi bi-archive"></i>
        <span class="svc-cat-title">Archive & Records</span>
      </div>
      <div class="svc-grid">

        <!-- ARCHIVED -->
        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ART_FOCAL'))
        <div class="svc-card" type="button" data-bs-toggle="modal" data-bs-target="#archivedModal" style="--svc-accent:#8A6D4E;--svc-tint:#F3ECE3;">
          <div class="svc-card-icon"><i class="bi bi-archive"></i></div>
          <div class="svc-card-title">Archived</div>
          <div class="svc-card-desc">Manage and retrieve archived records for easy reference and access</div>
          <span class="svc-cta">Open</span>
        </div>
        @endif
        @endif

      </div>
    </div>
    @endif

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