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

    <section class="section dashboard">
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
                        <span>Sistem Sumber Manusia</span>
                      </div>
                    </div>
              </div>
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
                                  <h6 style="font-size: 22px;">Aktif Akaun SSM</h6>
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
                                    <h6 style="font-size: 22px;">Aduan SSM</h6>
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
                              <h6 style="font-size: 22px;">Cuti</h6>
                              <span>Akan Datang</span>
                            </div>
                          </div>
                        </div>
                        <span class="custom-tooltip">Akan datang!</span>
                      </div>

                      <!-- Memangku - Non-clickable, Coming Soon -->
                      <div class="card info-card sales-card coming-soon-card" style="padding: 0px; border: 1px solid grey; margin-bottom: 20px; opacity: 0.6; cursor: not-allowed; position: relative;">
                        <div class="card-body" style="padding: 10px;">
                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-diagram-2"></i>
                            </div>
                            <div class="ps-3">
                              <h6 style="font-size: 22px;">Memangku</h6>
                              <span>Akan Datang</span>
                            </div>
                          </div>
                        </div>
                        <span class="custom-tooltip">Akan datang!</span>
                      </div>

                      <!-- Bersara - Non-clickable, Coming Soon -->
                      <div class="card info-card sales-card coming-soon-card" style="padding: 0px; border: 1px solid grey; margin-bottom: 20px; opacity: 0.6; cursor: not-allowed; position: relative;">
                        <div class="card-body" style="padding: 10px;">
                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-calendar-event"></i>
                            </div>
                            <div class="ps-3">
                              <h6 style="font-size: 22px;">Bersara</h6>
                              <span>Akan Datang</span>
                            </div>
                          </div>
                        </div>
                        <span class="custom-tooltip">Akan datang!</span>
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
        </div>

                    <!-- Komunikasi Notifikasi -->
                    <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#komunikasiModal">
                          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                            <div class="card-body" style="padding: 15px;">
                              <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                  <i class="bi bi-chat-dots"></i>
                                </div>
                                <div class="ps-3">
                                  <h6 style="font-size: 22px;">Komunikasi Notifikasi</h6>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Komunikasi Notifikasi Modal -->
                          <!-- Komunikasi Notifikasi Modal -->
            <div class="modal fade" id="komunikasiModal" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Komunikasi Notifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body">

                  {{-- Mesh Perkhidmatan Notifikasi (MPN) --}}
                    @if (Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ONS_USER')))
                      {{-- Clickable version for authorized users --}}
                      <a href="{{ route('onlinenotifications.onlinenotification.indexuser') }}">
                        <div class="card info-card sales-card" 
                            style="padding: 0px; border: 1px solid blue; margin-bottom: 20px; transition: 0.3s;">
                          <div class="card-body" style="padding: 10px;">
                            <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-phone-vibrate"></i>
                              </div>
                              <div class="ps-3">
                                <h6 style="font-size: 22px;">MPN</h6>
                                <span>MESH Perkhidmatan Notifikasi</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                    @else
                      {{-- Disabled version for users without access --}}
                      <div class="card info-card sales-card coming-soon-card" 
                          style="padding: 0px; border: 1px solid grey; margin-bottom: 20px; opacity: 0.6; cursor: not-allowed; position: relative;">
                        <div class="card-body" style="padding: 10px;">
                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-phone-vibrate"></i>
                            </div>
                            <div class="ps-3">
                              <h6 style="font-size: 22px;">MPN</h6>
                              <span>MESH Perkhidmatan Notifikasi</span>
                            </div>
                          </div>
                        </div>
                        <span class="custom-tooltip-black">Akses diperlukan</span>
                      </div>
            @endif

                    {{-- Mesh Kongsi Pautan (MKP) – Always visible --}}
                    <a href="{{ route('linkup.index') }}">
                      <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                        <div class="card-body" style="padding: 10px;">
                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-link-45deg"></i>
                            </div>
                            <div class="ps-3">
                              <h6 style="font-size: 22px;">MKP</h6>
                              <span>MESH Kongsi Pautan</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>

                  </div>
                </div>
              </div>
            </div>
            <!-- End Komunikasi Notifikasi Modal -->
        </div>

        <!-- Kehadiran & Pengurusan Peserta -->
        <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#kehadiranModal">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Kehadiran & Pengurusan Peserta</h6>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Kehadiran & Pengurusan Peserta Modal -->
              <div class="modal fade" id="kehadiranModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Kehadiran & Pengurusan Peserta</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <a href="https://mesh.moe.gov.bn/moeevent">
                        <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                          <div class="card-body" style="padding: 10px;">
                                <div class="d-flex align-items-center">
                                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-calendar-event-fill"></i>
                                  </div>
                                  <div class="ps-3">
                                    <h6 style="font-size: 22px;">MPMKP</h6>
                                    <span>MESH Pengurusan Majlis KP</span>
                                  </div>
                                </div>
                          </div>
                        </div>
                      </a>

                      <a href="https://mesh.moe.gov.bn/sk">
                        <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                            <div class="card-body" style="padding: 10px;">
                                  <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                      <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                      <h6 style="font-size: 22px;">MSK</h6>
                                      <span>MESH Slip Kehadiran</span>
                                    </div>
                                  </div>
                            </div>
                          </div>
                      </a>

                      <a href="https://mesh.moe.gov.bn/Q&A">
                    <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                        <div class="card-body" style="padding: 10px;">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-file-text"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 style="font-size: 22px;">PSSJ</h6>
                                    <span>Perkhidmatan Sesi Soal Jawab</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                    </div>
                  </div>
                </div>
              </div><!-- End Kehadiran & Pengurusan Peserta Modal-->
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
                      <h6 style="font-size: 22px;">Permohonan Sokongan</h6>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Permohonan Sokongan Modal -->
              <div class="modal fade" id="permohonanModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Permohonan Sokongan</h5>
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
                                        <h6 style="font-size: 22px;">DSD</h6>
                                        <span>Perkhidmatan Bantuan DevOps</span>
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
                                    <span>Borang Permohonan DevOps</span>
                                  </div>
                                </div>
                          </div>
                        </div>
                      </a>
                      
                      
                    </div>
                  </div>
                </div>
              </div><!-- End Permohonan Sokongan Modal-->
        </div>

        <!-- Perkhidmatan Lain -->
        <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#perkhidmatanModal">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-gear"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Perkhidmatan Lain</h6>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Perkhidmatan Lain Modal -->
              <div class="modal fade" id="perkhidmatanModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Perkhidmatan Lain</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- MST - Tegahan -->
                  <a href="https://mesh.moe.gov.bn/msc/index">
                      <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                          <div class="card-body" style="padding: 10px;">
                              <div class="d-flex align-items-center">
                                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                      <i class="bi bi-building-slash"></i>
                                  </div>
                                  <div class="ps-3">
                                      <h6 style="font-size: 22px;">MST</h6>
                                      <span>Syarikat Tegahan</span>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </a>

                    <!-- MPI - Banner - Non-clickable -->
                  <div class="card info-card sales-card coming-soon-card" style="padding: 0px; border: 1px solid grey; margin-bottom: 20px; opacity: 0.6; cursor: not-allowed; position: relative;">
                    <div class="card-body" style="padding: 10px;">
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-view-list"></i>
                        </div>
                        <div class="ps-3">
                          <h6 style="font-size: 22px;">MPI</h6>
                          <span>MESH Paparan Iklan</span>
                        </div>
                      </div>
                    </div>
                    <span class="custom-tooltip-black">Akses di perlukan</span>
                  </div>

                  <!-- MP - Announcement - Non-clickable -->
                  <div class="card info-card sales-card coming-soon-card" style="padding: 0px; border: 1px solid grey; margin-bottom: 20px; opacity: 0.6; cursor: not-allowed; position: relative;">
                    <div class="card-body" style="padding: 10px;">
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-megaphone"></i>
                        </div>
                        <div class="ps-3">
                          <h6 style="font-size: 22px;">MP</h6>
                          <span>MESH Pemberitahuan</span>
                        </div>
                      </div>
                    </div>
                    <span class="custom-tooltip-black">Akses di perlukan</span>
                  </div>

                  <style>
                  .coming-soon-card {
                    position: relative;
                  }

                  /* Red tooltip for "akan datang!" */
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

                  /* Black tooltip for "Akses di perlukan" */
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

                  .coming-soon-card:hover .custom-tooltip,
                  .coming-soon-card:hover .custom-tooltip-black {
                    opacity: 1;
                    visibility: visible;
                  }
                  </style>
                    </div>
                  </div>
                </div>
              </div><!-- End Perkhidmatan Lain Modal-->
        </div>

       <!-- Perkhidmatan Operasi Dalaman -->
<div class="col-lg-4">
  <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;" 
       type="button" data-bs-toggle="modal" data-bs-target="#dynamicModal">
    <div class="card-body" style="padding: 15px;">
      <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
          <i class="bi bi-building"></i>
        </div>
        <div class="ps-3">
          <h6 style="font-size: 22px;">Perkhidmatan Operasi Dalaman</h6>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Single Dynamic Modal -->
<div class="modal fade" id="dynamicModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dynamicModalTitle">Perkhidmatan Operasi Dalaman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="dynamicModalBody">
        <!-- Main options -->
        <div class="card-list">
          <div class="card info-card sales-card" style="padding:0; border:1px solid blue; margin-bottom:20px; cursor:pointer;" onclick="openModalOption('PBBK')">
            <div class="card-body" style="padding:10px;">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-bookmark-star-fill"></i>
                </div>
                <div class="ps-3">
                  <h6 style="font-size:22px;">PBBK</h6>
                  <span>Pengurusan Bahan-Bahan Kurikulum</span>
                </div>
              </div>
            </div>
          </div>

          <div class="card info-card sales-card" style="padding:0; border:1px solid blue; margin-bottom:20px; cursor:pointer;" onclick="openModalOption('PKOKU')">
            <div class="card-body" style="padding:10px;">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-trophy"></i>
                </div>
                <div class="ps-3">
                  <h6 style="font-size:22px;">PKOKU</h6>
                  <span>Pengurusan Aktiviti Ko-Kurikulum</span>
                </div>
              </div>
            </div>
          </div>

          <div class="card info-card sales-card" style="padding:0; border:1px solid blue; margin-bottom:20px; cursor:pointer;" onclick="openModalOption('EMT')">
            <div class="card-body" style="padding:10px;">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-envelope-paper"></i>
                </div>
                <div class="ps-3">
                  <h6 style="font-size:22px;">EMT</h6>
                  <span>E-Memo Tindakan</span>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="modal-footer" id="dynamicModalFooter">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- JS: Dynamic Modal Content -->
<script>
function openModalOption(option) {
  const modalTitle = document.getElementById('dynamicModalTitle');
  const modalBody = document.getElementById('dynamicModalBody');

  if(option === 'PBBK') {
    window.location.href = "{{ route('cddinventory.cddinventory.index') }}";
    return;
  }

  if(option === 'PKOKU') {
    window.location.href = "{{ route('cca.cca.index') }}";
    return;
  }

  if(option === 'EMT') {
    modalTitle.innerText = 'EMT - E-Memo Tindakan';
    modalBody.innerHTML = `
      <div class="card info-card sales-card" style="padding:0; border:1px solid blue; margin-bottom:20px; cursor:pointer;" onclick="window.location.href='{{ route('eminit.eminit.indexeminit') }}'">
        <div class="card-body" style="padding:10px;">
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-journal-text"></i>
            </div>
            <div class="ps-3">
              <h6 style="font-size:22px;">E-Memo</h6>
            </div>
          </div>
        </div>
      </div>
      <div class="card info-card sales-card" style="padding:0; border:1px solid blue; margin-bottom:20px; cursor:pointer;" onclick="window.location.href='{{ route('eminit.eminit.indexeminitaction') }}'">
        <div class="card-body" style="padding:10px;">
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-check-circle"></i>
            </div>
            <div class="ps-3">
              <h6 style="font-size:22px;">E-Memo Tindakan</h6>
            </div>
          </div>
        </div>
      </div>
      <button type="button" class="btn btn-secondary mt-2" onclick="goBack()">Back</button>
    `;
  }
}

function goBack() {
  const modalTitle = document.getElementById('dynamicModalTitle');
  const modalBody = document.getElementById('dynamicModalBody');

  modalTitle.innerText = 'Perkhidmatan Operasi Dalaman';
  modalBody.innerHTML = `
    <div class="card-list">
      <div class="card info-card sales-card" style="padding:0; border:1px solid blue; margin-bottom:20px; cursor:pointer;" onclick="openModalOption('PBBK')">
        <div class="card-body" style="padding:10px;">
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-bookmark-star-fill"></i>
            </div>
            <div class="ps-3">
              <h6 style="font-size:22px;">PBBK</h6>
              <span>Pengurusan Bahan-Bahan Kurikulum</span>
            </div>
          </div>
        </div>
      </div>

      <div class="card info-card sales-card" style="padding:0; border:1px solid blue; margin-bottom:20px; cursor:pointer;" onclick="openModalOption('PKOKU')">
        <div class="card-body" style="padding:10px;">
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-trophy"></i>
            </div>
            <div class="ps-3">
              <h6 style="font-size:22px;">PKOKU</h6>
              <span>Pengurusan Aktiviti Ko-Kurikulum</span>
            </div>
          </div>
        </div>
      </div>

      <div class="card info-card sales-card" style="padding:0; border:1px solid blue; margin-bottom:20px; cursor:pointer;" onclick="openModalOption('EMT')">
        <div class="card-body" style="padding:10px;">
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-envelope-paper"></i>
            </div>
            <div class="ps-3">
              <h6 style="font-size:22px;">EMT</h6>
              <span>E-Memo Tindakan</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  `;
}
</script>

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
                      <h6 style="font-size: 22px;">Permohonan Peranan Akses</h6>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <!-- End Permohonan Peranan Akses -->

       

        <!-- Pengurusan Tempahan Fasilitas -->
         <!-- ============================= -->

         <!-- ===================================== -->
<!-- Pengurusan Tempahan Fasilitas -->
<!-- ===================================== -->

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
        <h6 style="font-size:22px;">Pengurusan Tempahan Fasilitas</h6>
      </div>
    </div>
  </div>
</div>

</div>

<!-- MODAL -->
<div class="modal fade" id="fasilitasModal" tabindex="-1">
<div class="modal-dialog">
  <div class="modal-content">

    <div class="modal-header">
      <h5 class="modal-title" id="fasilitasTitle">
        Pengurusan Tempahan Fasilitas
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
  'Pengurusan Tempahan Fasilitas';

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
          <h6 style="font-size:22px;">TBM</h6>
          <span>Tempahan Bilik Mesyuarat</span>
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
            <h6 style="font-size:22px;">TBS</h6>
            <span>Tempahan Bilik Sindikit</span>
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
  'TBM - Tempahan Bilik Mesyuarat';

document.getElementById('fasilitasBody').innerHTML = `
  <a href="{{ route('adminbooking.searchroomadmin') }}" style="text-decoration:none;">
    ${fasilitasItem('bi-search','Cari Ketersediaan Bilik')}
  </a>

  <a href="{{ route('adminbooking.systemcalendaradmin') }}" style="text-decoration:none;">
    ${fasilitasItem('bi-calendar','Kalendar')}
  </a>

  <a href="{{ route('adminbooking.booking.indexadmin') }}" style="text-decoration:none;">
    ${fasilitasItem('bi-calendar-check','Tempahan')}
  </a>

  <a href="{{ route('adminbooking.rooms.index') }}" style="text-decoration:none;">
    ${fasilitasItem('bi-door-open','Bilik')}
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    const open = params.get('open');

    console.log('URL param:', open); // debug

    if (open === 'EMT') {
        openModalOption('EMT');

        // REQUIRED: show the modal
        const modalElement = document.getElementById('dynamicModal');
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
    }
});
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

      </div>
    </section>

@endsection