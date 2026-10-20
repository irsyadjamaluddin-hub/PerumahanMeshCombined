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

        <!-- <div class="col-lg-4">
            <a href="{{ route('arts.art.index') }}">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                <div class="card-body" style="padding: 15px;">
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-file-earmark-medical"></i>
                        </div>
                        <div class="ps-3">
                          <h6 style="font-size: 22px;">ART</h6>
                        </div>
                      </div>
                </div>
              </div>
            </a>
        </div> -->

        <!-- archivephasebyphase -->
        <!-- <div class="col-lg-4">
          <a href="{{ route('skbs.skb.index') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 15px;">
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
        </div> -->

        <div class="col-lg-4">
            <a href="{{ route('ssms.ssm.index') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 15px;">
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-briefcase"></i>
                      </div>
                      <div class="ps-3">
                        <h6 style="font-size: 22px;">Aktif Akaun SSM</h6>
                        <span>Sistem Sumber Manusia</span>
                      </div>
                    </div>
              </div>
            </div>
           </a>
        </div>

         {{-- <div class="col-lg-4">
            <a href="{{ route('ssmrequests.ssmrequest.index') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
              <div class="card-body" style="padding: 15px;">
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-briefcase"></i>
                      </div>
                      <div class="ps-3">
                        <h6 style="font-size: 22px;">SSM Update Request</h6>
                       
                      </div>
                    </div>
              </div>
            </div>
           </a>
        </div> --}}

        <div class="col-lg-4">
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
        </div>


            
        <div class="col-lg-4">
        <a href="{{ route('cca.cca.index') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 15px;">
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

        <div class="col-lg-4">
          <a href="{{ route('cddinventory.cddinventory.index') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-bookmark-star-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Curriculum Materials</h6>
                     
                    </div>
                  </div>
          </div>
          </div>
         </a>
        </div>

        <!-- <div class="col-lg-4">
          <a href="http://127.0.0.1:8000/borangpermohonanperanan">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-bookmark-star-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Role Request</h6>
                     
                    </div>
                  </div>
            </div>
          </div>
         </a>
        </div> -->

        <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#infoModal">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                <div class="card-body" style="padding: 10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-info-lg"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Permohonan</h6>
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
                            <a href="http://127.0.0.1:8000/borangpermohonanperanan">
                              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                                <div class="card-body" style="padding: 10px;">
                                      <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                          <i class="bi bi-person-square"></i>
                                        </div>
                                        <div class="ps-3">
                                          <h6 style="font-size: 22px;">Peranan MESH</h6>
                                        </div>
                                      </div>
                                </div>
                              </div>
                            </a>
            
              <a href="http://127.0.0.1:8000/moeevent">
                <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                  <div class="card-body" style="padding: 10px;">
                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-calendar-event-fill"></i>
                          </div>
                          <div class="ps-3">
                            <h6 style="font-size: 22px;">MOE EVENT</h6>
                          </div>
                        </div>
                  </div>
                </div>
              </a>

              <a href="http://127.0.0.1:8000/borangaduanssm">
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

              <a href="http://127.0.0.1:8000/sk">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                  <div class="card-body" style="padding: 10px;">
                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people-fill"></i>
                          </div>
                          <div class="ps-3">
                            <h6 style="font-size: 22px;">Slip Kehadiran</h6>
                          </div>
                        </div>
                  </div>
                </div>
              </a>

              <!-- <a href="http://127.0.0.1:8000/pdt">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                  <div class="card-body" style="padding: 10px;">
                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-file-code"></i>
                          </div>
                          <div class="ps-3">
                            <h6 style="font-size: 22px;">Permohonan Perkhidmatan</h6>
                          </div>
                        </div>
                  </div>
                </div>
              </a> -->

              <a href="http://127.0.0.1:8000/drf">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                  <div class="card-body" style="padding: 10px;">
                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-file-code"></i>
                          </div>
                          <div class="ps-3">
                            <h6 style="font-size: 22px;">Permohonan DRF</h6>
                          </div>
                        </div>
                  </div>
                </div>
              </a>

              <!-- <a href="http://127.0.0.1:8000/tanyamoebn">
              <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                  <div class="card-body" style="padding: 10px;">
                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-calendar-event"></i>
                          </div>
                          <div class="ps-3">
                            <h6 style="font-size: 22px;">Tanya? @MOEBN</h6>
                          </div>
                        </div>
                  </div>
                </div>
              </a> -->

                          </div>
                        </div>
                      </div>
                    </div><!-- End Basic Modal-->        
          </div>
         
       
          <div class="col-lg-4">
          <a href="{{ route('linkup.index') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-link-45deg"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Link UP</h6>
                     
                    </div>
                  </div>
          </div>
          </div>
         </a>
        </div>

        <!-- MEC MED Card -->


<!-- MEC MED Modal (Hidden)
<div class="modal fade" id="mecMedModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <a href="{{ route('dispatchs.dis.index') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="ri-article-line"></i>
                </div>
                <div class="ps-3">
                  <h6 style="font-size: 22px;">Despatch</h6>
                </div>
              </div>
            </div>
          </div>
        </a>

        <a href="{{ route('dispatchs.dis.indextindakan') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
            <div class="card-body" style="padding: 10px;">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-person-check-fill"></i>
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
</div>
-->


<!-- e-Minit Card -->
<div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#eminitModal">
  <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
    <div class="card-body" style="padding: 10px;">
      <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
          <i class="bi bi-card-list"></i>
        </div>
        <div class="ps-3">
          <h6 style="font-size: 22px;">E-Memo Tindakan</h6>
        </div>
      </div>
    </div>
  </div>

  <!-- e-Minit Modal -->
  <div class="modal fade" id="eminitModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

          <!-- e-Minit -->
          <a href="{{ route('eminit.eminit.indexeminit') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-card-list"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">E-Memo</h6>
                  </div>
                </div>
              </div>
            </div>
          </a>

          <!-- e-Minit Action -->
          <a href="{{ route('eminit.eminit.indexeminitaction') }}">
            <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
              <div class="card-body" style="padding: 10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-earmark-ruled-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 22px;">E-Memo (Tindakan)</h6>
                  </div>
                </div>
              </div>
            </div>
          </a>

        </div>
      </div>
    </div>
  </div>
</div>



        

      </div>

      </div>

 


        <!-- add 28dec23 -->

        {{-- <div class="col-lg-4">
          <a href="{{ route('ssmrequests.ssmrequest.indexstaffpermohonan') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-briefcase"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">SSM Staff Permohonan</h6>
                     
                    </div>
                  </div>
            </div>
          </div>
         </a>
        </div> --}}

<!--        <div class="col-lg-4">
        <a href="{{ route('permohonans.permohonan.index') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 15px;">
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
        </div> -->



       <div class="col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#infoModal">
              <!-- <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
                <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-info-lg"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 22px;">Personnel Admin</h6>
                      <span>
                    </div>
                  </div>
                </div>
              </div> -->
              <!-- Basic Modal -->
              <div class="modal fade" id="infoModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <a href="{{ route('cutis.cuti.indexP') }}">
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
      
                        <a href="{{ route('actings.acting.indexP') }}">
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

                          <a href="{{ route('bersaras.bersara.indexP') }}">
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





<!-- archivephasebyphase -->
          <!-- <div class="col-lg-4">
          <a href="{{ route('competency.competency.indexcompetency') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 15px;">
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
        </div>
      </div> -->

           <!-- <div class="col-lg-4">
          <a href="{{ route('prestasi.prestasi.index') }}">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue;">
            <div class="card-body" style="padding: 15px;">
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
      </div> -->

    
 
   




      </div>


           



      </div>
    </section>

@endsection