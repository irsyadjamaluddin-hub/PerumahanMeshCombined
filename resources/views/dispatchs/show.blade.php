@extends('layouts.app-all')

@section('title', 'View MED')

@section('content')

<?php
$pagename = "MED";
?>

<section class="section profile">

    <a href="{{ route('dispatchs.dis.index') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-12">
        <div class="card pt-3">

            <div class="card-body">

                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true">Info</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Dokumen</button>
                        </li>
                    </ul>
                    <!-- End of Bordered Tabs -->

<br>

                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">

                        <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">

                            @foreach($dispatchs as $dispatch)

                            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Info</h5>
<br>
                                <div class="row">
                                    <div class="col-lg-4 label">Tarikh Diterima</div>
                                    @if ($dispatch->dispatch_recieved_at==null)
                                    <div class="col-lg-8"><span class="badge bg-danger"> Belum Diterima</span></div>
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
                                  <div class="col-lg-4 label">Daripada Persuratan Luar</div>
                                  <div class="col-lg-8">{{$dispatch->dpl}}</div>
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
                                        <!-- Display Current Files -->
                                            @if($dispatch->lamp)
                                                @foreach($dispatch->lamp as $index => $filename)
                                                <p id="margin-bottombegone"><a href="{{ Storage::url($dispatch->lamp[$index]) }}" target="_blank">{{ basename($filename) }}</a></p>

                                                
                                                @endforeach
                                                
                                            @else
                                            <p>No file chosen</p>
                                            @endif
                                    </div>
                                </div>

                     
                                <div class="row">
                                    <div class="col-lg-4 label">Catatan</div>
                                    <div class="col-lg-8">{{$dispatch->catt}}</div>
                                </div>



                               <div class="row">
                                    <div class="col-lg-4 label">Salinan</div>
                                    <div class="col-lg-8">
                                        @if ($dispatch->salinankpd)
                                            @foreach (json_decode($dispatch->salinankpd) as $skpds)
                                                {{ $skpds }}
                                                <br>
                                            @endforeach
                                        @else
                                            No salinan available.
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-4 label">Salinan Persuratan Luar</div>
                                  <div class="col-lg-8">{{$dispatch->spl}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Muat Naik Dokumen Persuratan Luar</div>
                                    <div class="col-lg-8">
                                        <!-- Display Current Files -->
                                            @if($dispatch->lamp1)
                                                @foreach($dispatch->lamp1 as $index => $filename1)
                                                <p id="margin-bottombegone"><a href="{{ Storage::url($dispatch->lamp1[$index]) }}" target="_blank">{{ basename($filename1) }}</a></p>

                                                
                                                @endforeach
                                                
                                            @else
                                            <p>No file chosen</p>
                                            @endif
                                    </div>
                                </div>

                            </div>

                            @endforeach

                        </div><!-- End of Info Tab -->


                        <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel" aria-labelledby="profile-tab">

                            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Dokumen</h5>
<br>

                                <!-- Dokumen -->
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

                                                    <td>{{$dispatchfile->tindakanfile}}</td>

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


                                                    <td><a href='{{Storage::url("$dispatchfile->filename") }}' target="_blank">View</a></td>

                                                  


                                                </tr>

                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </form>

                            </div>
                        </div><!-- End of Dokumen Tab -->


                    </div><!-- End of tab-content -->
</div>
</div>
</div>

</section>
@endsection