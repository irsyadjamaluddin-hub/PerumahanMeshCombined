@extends('layouts.app-all')

@section('title', 'Admin')

@section('content')

  <style>
  .dashboard .card-icon {
      font-size: 28px;
      width: 60px;
      height: 60px;
  }
  .tab {
      overflow: hidden;
      border-bottom: 2px solid #007bff;
      display: flex;
      justify-content: space-between;
  }

  .tab button {
      background-color: transparent;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 10px 20px;
      transition: 0.3s;
      color: #007bff;
      flex: 1;
      text-align: center;
      font-size: 20px;
  }

  .tab button:hover {
      background-color: #ddd;
  }

  .tab button.active {
      background-color: #fff;
      border-radius: 0;
      color: black;
  }

  .tabcontent {
      display: none;
      padding: 20px;
      border: 1px solid #ccc;
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

</style>


  <?php
    $pagename = "Super_Admin_Dashboard";
  ?>

    <div class="pagetitle">
      <h1>Admin</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Super Admin</li>
        </ol>
      </nav>
    </div>

    <div class="tab">
        <button id="generalTab" class="tablinks active" onclick="openTab(event, 'General')">General</button>
        <button id="internalTab" class="tablinks" onclick="openTab(event, 'Internal')">Internal</button>
    </div>

    <div class="container mt-4">
        <div class="search-bar">
            <form class="search-form d-flex align-items-center">
                <input id="serviceSearchInput" class="form-control" type="text" placeholder="Search ...">
                <button type="button" class="btn btn-primary" onclick="searchServices()" title="Search">
                <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

<!-- -------------------------------------------------------------------------------------INTERNAL-------------------------------------------------------------------------------------------------------->

  <!-- Internal content -->
  <section id="Internal" class="tabcontent" style="display: none;">
    <section class="section dashboard" id="internalServicesList">
        <div class="row">

          <!-- INFO -->
          @if (Auth::check())
          @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ACT'))
          <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#infoModal">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-info-lg"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Info</h6>
                      <span>
                    </div>
                  </div>
                </div>
              </div>
                    <!-- Basic Modal -->
                    <div class="modal fade" id="infoModal" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
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

                          </div>
                        </div>
                      </div>
                    </div><!-- End Basic Modal-->        
          </div>
          @endif
          @endif

          <!-- PERJAWATAN -->
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
                        <h6 style="font-size: 22px;">Perjawatan</h6>
                      </div>
                    </div>
              </div>
            </div>
          </a>
          </div>
          @endif
          @endif

          @if (Auth::check())
          @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PRESTASI'))
          <div class="col-lg-4">
          <a href="{{ route('prestasi.prestasi.indexadmin') }}">
          <!-- <a href="{{ route('maintenance.page') }}" > -->
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
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
          </div>
          @endif
          @endif

          <!-- JPKK -->
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
                        <h6 style="font-size: 22px;">JPKK</h6>
                      </div>
                    </div>
              </div>
            </div>
            </a>
          </div>
          @endif
          @endif

          <!-- COMPETENCY -->
          @if (Auth::check())
          @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_COMPETENCY'))
          <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#basicModal">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-journal-text"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Competency</h6>
                      <span>
                    </div>
                  </div>
                </div>
              </div>
                    <!-- Basic Modal -->
                    <div class="modal fade" id="basicModal" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
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
                      <span>
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
                      <span>
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
                      <span>
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
                    </div><!-- End Basic Modal-->        
          </div>
          @endif
          @endif

          <!-- JAWATAN KOSONG -->
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
                      <h6 style="font-size: 22px;">Jawatan Kosong</h6>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          @endif
          @endif

          <!-- TEGAHAN -->
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
                                  <h6 style="font-size: 22px;">Tegahan</h6>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>
          </div>
          @endif
          @endif

        <!-- INVENTORY -->
        <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#inventoryModal">
        <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
          <div class="card-body" style="padding: 10px;">
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-file-earmark-arrow-up-fill"></i>
              </div>
              <div class="ps-3">
                <h6 style="font-size: 22px;">Inventory</h6>
                <span>
              </div>
            </div>
          </div>
        </div>
              <!-- Basic Modal -->
              <div class="modal fade" id="inventoryModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
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
                                      <h6 style="font-size: 22px;">Application</h6>
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
              </div><!-- End Basic Modal-->     
              <!--End Inventory  -->

              </div>
    </section>
</section>

  <!---------------------------------------------------------------------------------------GENERAL-------------------------------------------------------------------------------------------------------->

  <!-- General content -->
  <section id="General" class="tabcontent" style="display: block;">
    <section class="section dashboard" id="generalServicesList">
        <div class="row">

        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ART_FOCAL'))
        <div class="col-lg-4">
          <a href="{{ route('arts.art.indexAll') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
          <div class="card-body"style="padding: 10px;">
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
        </div>
        @endif
        @endif

        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <div class="col-lg-4">
          <a href="{{ route('pps.pps.index') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
          <div class="card-body"style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">PPS Visitors</h6>
                    </div>
                  </div>
          </div>
          </div>
          </a>
        </div>
        @endif
        @endif


        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_ART_FOCAL'))
        <div class="col-lg-4">
          <a href="{{ route('users.user.create') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
          <div class="card-body"style="padding: 10px;">
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
        </div>
        @endif
        @endif

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
                      <h6 style="font-size: 22px;">Surat Kebenaran Bertugas</h6>
                    </div>
                  </div>
            </div>
          </div>
          </a>
        </div>
        @endif
        @endif

    @if (Auth::check())
    @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_SSM'))
    <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#ssmModal">
        <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
          <div class="card-body" style="padding: 10px;">
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-briefcase-fill"></i>
              </div>
              <div class="ps-3">
                <h6 style="font-size: 22px;">SSM</h6>
              </div>
            </div>
          </div>
        </div>
              <!-- Basic Modal -->
              <div class="modal fade" id="ssmModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

          <a href="{{ route('ssms.ssm.indexall') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                	<i class="bi bi-person-check"></i>
                </div>
                <div class="ps-3">
                	<h6 style="font-size: 22px;">Aktif Akaun SSM</h6>
                	<span>Sistem Sumber Manusia</span>
                </div>
            	</div>
            </div>
          </div>
          </a>

        <a href="{{ route('ssmrequests.ssmrequest.indexall') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
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
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-plus"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">SSM Permohonan</h6>
                      <span>Sistem Sumber Manusia</span>
                    </div>
                  </div>
            </div>
          </div>
        </a>



                    </div>
                  </div>
                </div>
              </div><!-- End Basic Modal-->        
    </div>      	
        @endif
        @endif


        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ACT') || Auth::user()->hasRole('ROLE_OSCROOM') || Auth::user()->hasRole('ROLE_OSC_OP'))
        <div class="col-lg-4">
        <a href="{{ route('bookings.booking.home') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-door-open"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Syndicate Room</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
        </div>
        @endif
        @endif

        @if (Auth::check())
          @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <div class="col-lg-4">
        <a href="{{ route('emovements.emovement.index') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
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
        </div>
        @endif
        @endif
@if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_BOOKINGROOM_ADMIN'))
        <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#bookingModal">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-door-open"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">Meeting Room</h6>
                    <span>
                  </div>
                </div>
              </div>
            </div>
                  <!-- Basic Modal -->
        <div class="modal fade" id="bookingModal" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
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
                          <h6 style="font-size: 22px;">Search Room Availability</h6>
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
                          <h6 style="font-size: 22px;">Calendar</h6>
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
                          <h6 style="font-size: 22px;">Booking</h6>
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
                          <h6 style="font-size: 22px;">Room</h6>
                        </div>
                      </div>
                </div>
              </div>
            </a>

                    </div>
                  </div>
                </div>
              </div><!-- End Basic Modal-->        
    </div>
    @endif
    @endif

        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_QUESTION&ANSWER'))
        <div class="col-lg-4">
        <a href="{{ route('st.soalantaklimat.indexadmin') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-text"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Q&A @MOEBN</h6>
                      
                    </div>
                  </div>
            </div>
          </div>
        </a>
        </div>
        @endif
        @endif 

        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <div class="col-lg-4">

        <a href="{{ route('soalanbiskita.soalanbiskita.indexadmin') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-question-square"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Tanya? MOEBN</h6>
                      
                    </div>
                  </div>
            </div>
          </div>
        </a>
        </div>
        @endif
        @endif 

        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ONS_ADMIN'))
        <div class="col-lg-4">
        <a href="{{ route('onlinenotifications.onlinenotification.index') }}">
        <!-- <a href="{{ route('maintenance.page') }}" > -->
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-phone-vibrate"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Online Notification Service (O.N.S.)</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
        </div>
        @endif
        @endif


<!--         @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PERMOHONAN'))
        <div class="col-lg-4">
          <a href="{{ route('permohonans.permohonan.indexadmin') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-clipboard"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Permohonan Jawatan Kosong</h6>
                    </div>
                  </div>
            </div>
          </div>
          </a>
        </div>
        @endif
        @endif -->

                  <!-- start Despatch -->
    @if (Auth::check())
    @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_DESPATCH'))
    <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#mecmedModal">
        <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
          <div class="card-body" style="padding: 10px;">
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-collection"></i>
              </div>
              <div class="ps-3">
                <h6 style="font-size: 22px;">MEC MED</h6>
                <span>
              </div>
            </div>
          </div>
        </div>
              <!-- Basic Modal -->
              <div class="modal fade" id="mecmedModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                          <a href="{{ route('dispatchs.dis.indexadmin') }}">
                            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                              <div class="card-body" style="padding: 10px;">
                                    <div class="d-flex align-items-center">
                                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-card-list"></i>
                                      </div>
                                      <div class="ps-3">
                                        <h6 style="font-size: 22px;">Despatch</h6>
                                      </div>
                                    </div>
                              </div>
                            </div>
                          </a>
                        
                          <a href="{{ route('dispatchs.dis.indexup') }}">
                            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                              <div class="card-body" style="padding: 10px;">
                                    <div class="d-flex align-items-center">
                                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-card-heading"></i>
                                      </div>
                                      <div class="ps-3">
                                        <h6 style="font-size: 22px;">Despatch (UP)</h6>
                                      </div>
                                    </div>
                              </div>
                            </div>
                          </a>
                          
                          <a href="{{ route('dispatchs.dis.indexcorrespondence') }}">
                          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                            <div class="card-body" style="padding: 10px;">
                                  <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                      <i class="bi bi-file-earmark-ruled-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                      <h6 style="font-size: 22px;">Correspondence</h6>
                                    </div>
                                  </div>
                            </div>
                          </div>
                        </a>


                    </div>
                  </div>
                </div>
              </div><!-- End Basic Modal-->        
    </div>
    @endif
    @endif


        <!-- end despatch -->

        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <div class="col-lg-4">
          <a href="{{ route('feedbacks.feedback.indexadmin') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
          <div class="card-body"style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-chat-dots"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">PPKP Feedback</h6>
                    </div>
                  </div>
          </div>
          </div>
          </a>
        </div>
        @endif
        @endif

        @if (Auth::check())
        @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
        <div class="col-lg-4">
          <a href="{{ route('borang.borangs.indexadmin') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
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
        </div>
        @endif
        @endif

    @if (Auth::check())
    @if (Auth::user()->hasRole('ROLE_SUPERADMIN')|| Auth::user()->hasRole('ROLE_SLIPKEHADIRAN'))
    <div class="col-lg-4">
      <a href="{{ route('sk.slipkedatangan.indexadmin') }}">
        <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
          <div class="card-body" style="padding: 10px;">
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-building"></i>
              </div>
              <div class="ps-3">
                <h6 style="font-size: 22px;">Hadir @MOEBN</h6>
                <span>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    @endif
    @endif

    <!-- 13/06/2023 -->
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

      <!-- 20/06/23-->
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
                      <h6 style="font-size: 22px;">Banner</h6>
                    </div>
                  </div>
            </div>
          </div>
        </a>
        </div>
        @endif
        @endif

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
                    <h6 style="font-size: 22px;">Announcement</h6>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

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
                    <h6 style="font-size: 22px;">News</h6>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endif
        @endif

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
                                <h6 style="font-size: 22px;">Data Pelajar</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @endif

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
                                <h6 style="font-size: 22px;">MOE Link</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @endif

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
                                <h6 style="font-size: 22px;">Tegahan</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @endif

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
                                <h6 style="font-size: 22px;">MOE Event</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @endif
        
        </div>
    </section>
</section>


    <script>
        window.onload = function() {
            openTab(null, 'General');
        };

        function openTab(evt, tabName) {
            document.querySelectorAll('.tabcontent').forEach(tab => tab.style.display = 'none');
            document.querySelectorAll('.tablinks').forEach(link => link.classList.remove('active'));
            document.getElementById(tabName).style.display = 'block';
            document.getElementById(tabName + 'Tab').classList.add('active');
        }

        function showServices(serviceItems) {
            serviceItems.forEach(service => service.style.display = '');
        }

        function searchServices() {
            var input = document.getElementById('serviceSearchInput');
            var filter = input.value.trim().toUpperCase();
            var generalServices = document.querySelectorAll('#generalServicesList .col-lg-4');
            var internalServices = document.querySelectorAll('#internalServicesList .col-lg-4');

            if (filter === '') {
                showServices([...generalServices, ...internalServices]);
                openTab(null, 'General');
                return;
            }

            var keywords = filter.split(/\s+/);

            function filterServices(serviceItems) {
                serviceItems.forEach(service => {
                    var serviceName = service.innerText.toUpperCase();
                    var matched = keywords.every(keyword => serviceName.includes(keyword));
                    service.style.display = matched ? '' : 'none';
                });
            }

            filterServices(generalServices);
            filterServices(internalServices);
        }
    </script>

@endsection