@extends('layouts.app-all')

@section('title', 'View MEC')

@section('content')

<?php
$pagename = "MEC";
?>

<section class="section profile">

    <a href="{{ route('dispatchs.dis.indextindakan') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-12">
        <div class="card pt-3">

            <div class="card-body">

                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true">Maklumat</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Rujukan MEC</button>
                        </li>
                    </ul>
                    <!-- End of Bordered Tabs -->

<br>

                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">

                        <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">

                            @foreach($dispatchs as $dispatch)

                            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">MEC</h5>
<br>
                                <div class="row">
                                    <div class="col-lg-4 label">Tarikh Diterima </div>
                                    @if ($dispatch ->dispatch_recieved_at==null)
                                    <div class="col-lg-8"> <span class="badge bg-danger"> Belum Diterima</span></div>
                                    @else
                                    <div class="col-lg-8">{{ date('d/m/Y', strtotime($dispatch->dispatch_recieved_at)) }}</div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Jenis </div>
                                    <div class="col-lg-8">{{ optional($dispatch->jenis)->label }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Daripada</div>
                                    <div class="col-lg-8">{{ optional($dispatch->Daripada)->label }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Kepada</div>
                                    <div class="col-lg-8">@foreach (json_decode($dispatch->kpd) as
                                        $kpds){{ $kpds }}
                                        <br>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Untuk Perhatian</div>
                                    <div class="col-lg-8">{{$dispatch->up}}</div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-4 label">Perkara</div>
                                    <div class="col-lg-8">{{$dispatch->perkara}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Rujukan Persuratan</div>
                                    <div class="col-lg-8">{{$dispatch->rp}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Rujukan Tuan/Puan</div>
                                    <div class="col-lg-8">{{$dispatch->rm}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Dokumen</div>
                                    <div class="col-lg-8">
                                        <a href='{{Storage::url("$dispatch->lamp") }}' target="_blank">
                                            <p>{{$dispatch->lamp}}</p>
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Catatan</div>
                                    <div class="col-lg-8">{{$dispatch->catt}}</div>
                                </div>

                            </div>

                            @endforeach
                            <br>


                            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Rujukan (Admin)</h5>
<br>

                                @foreach ($dispatchs as $dispatch)

                                <div class="row">
                                    <div class="col-lg-4 label">Tarikh Menerima <br></div>
                                    <div class="col-lg-8">{{date('d/m/Y', strtotime($dispatch->dispatch_recieved_at)) }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Tarikh Memproses </div>
                                    <div class="col-lg-8">{{date('d/m/Y', strtotime( $dispatch->date_process))}}</div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-4 label">Tarikh Tutup</div>
                                    <div class="col-lg-8">{{date('d/m/Y', strtotime( $dispatch->date_close))}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Dokumen</div>
                                    <div class="col-lg-8">
                                        <a href='{{Storage::url("$dispatch->lamp") }}' target="_blank">
                                            <p>{{$dispatch->lamp}}</p>
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">No. Rujukan</div>
                                    <div class="col-lg-8">{{ $dispatch->no_folio}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Catatan</div>
                                    <div class="col-lg-8">{{ $dispatch->catatan_admin}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Tindakan</div>
                                    <div class="col-lg-8">{{optional($dispatch->Tindakan)->kod}}</div>
                                </div>

                                @endforeach

                            </div>

                            <br>

                            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Tindakan</h5>

                            @foreach ($dispatchpassmecs as $dispatchpassmec)
              <!-- Default Accordion -->
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Tindakan
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        
                                <div class="row">
                                    <div class="col-lg-4 label">Tindakan</div>
                                    <div class="col-lg-8">
                                        @php $tindakan_action_passs=$dispatchpassmec->tindakan_action_pass ? json_decode($dispatchpassmec->tindakan_action_pass, true) : []; @endphp
                                        @foreach($tindakan_action_passs as $tindakan_action_pass)
                                        {{($tindakan_action_pass)}}<br>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Ulasan Pengarah</div>
                                    <div class="col-lg-8">{{($dispatchpassmec->ulasan_pas)}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Tindakan</div>
                                    <div class="col-lg-8">{{optional($dispatchpassmec->Tindakan)->kod}}</div>
                                </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Default Accordion Example -->
                            @endforeach



                            </div>
                            <br>

                            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Dokumen</h5>
<br>

                                <!-- Dokumen -->
                                <div class="card">
                                    <form>
                                        <table class="table-achiev overflow-auto">
                                            <thead>
                                                <tr>

                                                    <th class="text-center">Daripada</th>
                                                    <th class="text-center">No. Rujukan</th>
                                                    <th class="text-center">Tarikh Surat</th>
                                                    <th class="text-center">Tindakan</th>
                                                    <th class="text-center">Catatan</th>
                                                    <th class="text-center">Dokumen</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if(count($dispatchfiles) == 0)

                                                <tr class="text-center">
                                                    <td colspan="8">
                                                        <h5>No records found</h5>
                                                    </td>
                                                </tr>

                                                @else
                                                @foreach( $dispatchfiles as $dispatchfile )

                                                <tr class="text-center">

                                                    <td>{{$dispatchfile->daripada}}</td>
                                                    <td>{{$dispatchfile->no_folio_dokumen}}</td>

                                                    @if ($dispatchfile->tarikh_surat == null)
                                                    <td></td>
                                                    @else
                                                    <td>{{ date('d/m/Y', strtotime($dispatchfile->tarikh_surat)) }}</td>
                                                    @endif

                                                    <td>{{$dispatchfile->tindakan}}</td>

                                                    <td>
                                                        <!-- Basic Modal -->
                                                        <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#StrategicThinkingEvidence">

                                                        </button>
                                                        <div class="modal fade" id="StrategicThinkingEvidence" tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Catatan</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <textarea class="form-control" style="height: 150px" readonly>{{$dispatchfile->despatch}}</textarea>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div><!-- End Basic Modal-->
                                                    </td>


                                                    <td><a href='{{Storage::url("$dispatchfile->file") }}' target="_blank">View</a></td>

                                                </tr>

                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>

                        </div><!-- End of Tab Maklumat -->


                        <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel" aria-labelledby="profile-tab">

                        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Rujukan MEC</h5>
<br>                        

                                <!-- Dokumen -->
                                <div class="card">
                                    <form>
                                        <table class="table-achiev overflow-auto">
                                            <thead>
                                                <tr>

                                                    <th class="text-center">From</th>
                                                    <th class="text-center">To</th>
                                                    <th class="text-center">Tindakan</th>
                                                    <th class="text-center">Catatan</th>
                                                    <th class="text-center">Tarikh</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                   @if(count($dispatchpassmecs) == 0)

                                                <tr class="text-center">
                                                    <td colspan="8">
                                                        <h5>No records found</h5>
                                                    </td>
                                                </tr>

                                                @else



                                                @foreach( $dispatchpassmecs as $dispatchpassmec )
                                                
                                               


                                                <tr class="text-center">



                                                    <td> {{$dispatchpassmec->kod}} </td>


                                                    @foreach( $dispatchmecusers as $dispatchmecuser )

                                                    @if ($dispatchpassmec->tindakan_pass == $dispatchmecuser->ic_no)
                                                    <td>{{$dispatchmecuser->kod}}</td>
                                                    @else
                                               

                                                    @endif
                                                    @endforeach



                                                    <td>
                                                    @php
                                                                        $tindakan_action_passs=$dispatchpassmec->tindakan_action_pass
                                                                        ?
                                                                        json_decode($dispatchpassmec->tindakan_action_pass,
                                                                        true) : []; @endphp
                                                                        @foreach($tindakan_action_passs as
                                                                        $tindakan_action_pass)

                                                                        {{($tindakan_action_pass)}}

                                                                        @endforeach

                                                    </td>

                                                 


                                                    <td>
                                                        <!-- Basic Modal -->
                                                        <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                            data-bs-toggle="modal" data-bs-target="#catatan{{$dispatchpassmec->id}}">

                                                        </button>
                                                        <div class="modal fade" id="catatan{{$dispatchpassmec->id}}"  tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Catatan</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <textarea class="form-control"
                                                                            style="height: 150px"
                                                                            readonly>{{$dispatchpassmec->ulasan_pass}}</textarea>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div><!-- End Basic Modal-->
                                                    </td>


                                                    @if ($dispatchpassmec->created_at == null)
                                                    <td></td>
                                                    @else
                                                    <td>{{ date('d/m/Y', strtotime($dispatchpassmec->created_at)) }}
                                                    </td>
                                                    @endif

                                                </tr>

                                                

                                                @endforeach


                                                @endif
                                            </tbody>
                                        </table>
                                    </form>
                                </div>

                            </div>
                        </div><!-- End of Tab Rujukan MEC -->


                </div>
            </div>
        </div>
    </div>

</section>
@endsection