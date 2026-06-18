@extends('layouts.app-all')

@section('title', 'View Admin MED')

@section('content')

<?php
$pagename = "MED";
?>

<section class="section profile">

  <a href="{{ route('dispatchs.dis.indexadmin') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">

      <div class="card-body">

            @foreach($dispatchs as $dispatch)

            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Rujukan e-Despatch</h5>
<br>
              <div class="row">
                <div class="col-lg-4 label">Tarikh Diterima</div>
                @if ($dispatch ->dispatch_recieved_at==null)
                <div class="col-lg-8"> <span class="badge bg-danger"> Belum Diterima</span></div>
                @else
                <div class="col-lg-8">{{ date('d/m/Y', strtotime($dispatch->dispatch_recieved_at)) }}</div>
                @endif
              </div>

              <div class="row">
                <div class="col-lg-4 label">Jenis</div>
                <div class="col-lg-8">{{ optional($dispatch->jenis)->label }}</div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Daripada</div>
                <div class="col-lg-8">{{ optional($dispatch->Daripada)->label }}</div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Kepada</div>
                <div class="col-lg-8">@foreach (json_decode($dispatch->kpd) as $kpds){{ $kpds }}
                  <br>
                @endforeach
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Untuk Perhatian</div>
                <div class="col-lg-8">{{optional($dispatch->Untukperhatian)->kod}}</div>
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
                <div class="col-lg-4 label">Muat Naik Dokumen</div>
                <div class="col-lg-8">
                  <a href='{{Storage::url("$dispatch->lamp") }}' target="_blank">
                    <p>{{$dispatch->dis_filename}}</p>
                  </a>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Catatan</div>
                <div class="col-lg-8">{{$dispatch->catt}}</div>
              </div>

            </div>
<br>
            @endforeach

          <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Tindakan (Admin)</h5>
<br>
            @foreach ($dispatchs as $dispatch)
            
            <div class="row">
              <div class="col-lg-4 label">Tarikh Menerima</div>
              @if ($dispatch ->dispatch_recieved_at==null)
              <div class="col-lg-8"></div>
              @else
              <div class="col-lg-8">{{date('d/m/Y', strtotime($dispatch->dispatch_recieved_at)) }}</div>
              @endif
            </div>

            <div class="row">
              <div class="col-lg-4 label">Tarikh Memproses</div>
              @if ($dispatch ->date_process==null)
              <div class="col-lg-8"></div>
              @else
              <div class="col-lg-8">{{date('d/m/Y', strtotime( $dispatch->date_process))}}</div>
              @endif
            </div>

            <div class="row">
              <div class="col-lg-4 label">Tarikh Tutup</div>
              @if ($dispatch ->date_close==null)
              <div class="col-lg-8"></div>
              @else
              <div class="col-lg-8">{{date('d/m/Y', strtotime( $dispatch->date_close))}}</div>
              @endif
            </div>

            <div class="row">
              <div class="col-lg-4 label">Dokumen</div>
              <div class="col-lg-8">
                <a href='{{Storage::url("$dispatch->lamp") }}' target="_blank">
                  <p>{{$dispatch->dis_filename}}</p>
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

  </div>
  </div>
  </div>

</section>
@endsection