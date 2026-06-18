@extends('layouts.app-all')

@section('title', 'Show e-Correspondence')

@section('content')

<?php
$pagename = "SHOW MEC";
?>

<div class="pagetitle">
    <h1>MOE e-Correspondence</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">MEC</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">


    <a href="{{ route('dispatchs.dis.indextindakan') }}" class="btn btn-primary text-right mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>


    <!-- QO Table -->
    <div class="col-12">

        <div class="card recent-sales">

            <div class="card-body">

                <div class="profile-overview pt-3">


                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link w-100 active" data-bs-toggle="tab"
                                data-bs-target="#profile-overview">Info</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#profile-doc">Rujukan
                                MEC</button>
                        </li>

                    </ul>

                    <br>

                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">

                            @foreach($dispatchs as $dispatch)

                            <div class="col" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                <h5 class="card-title">MOE e-Despatch</h5>
                                <hr>

                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Tarikh Diterima </div>
                                    @if ($dispatch ->dispatch_recieved_at==null)
                                    <div class="col-lg-8 col-md-9"> <span class="badge bg-danger"> Belum Diterima</span>
                                    </div>
                                    @else
                                    <div class="col-lg-8 col-md-9">
                                        {{ date('d/m/Y', strtotime($dispatch->dispatch_recieved_at)) }}</div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Jenis </div>
                                    <div class="col-lg-8 col-md-9">{{ optional($dispatch->jenis)->label }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Daripada</div>
                                    <div class="col-lg-8 col-md-9">{{ optional($dispatch->Daripada)->label }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Kepada</div>
                                    <div class="col-lg-8 col-md-9">{{ optional($dispatch->kepada)->label }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Untuk Perhatian</div>
                                    <div class="col-lg-8 col-md-9">{{$dispatch->up}}</div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Perkara</div>
                                    <div class="col-lg-8 col-md-9">{{$dispatch->perkara}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Rujukan Persuratan</div>
                                    <div class="col-lg-8 col-md-9">{{$dispatch->rp}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Rujukan Pejabat Yang Menghadapkan</div>
                                    <div class="col-lg-8 col-md-9">{{$dispatch->rm}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Muat Naik Dokumen</div>
                                    <div class="col-lg-8 col-md-9">
                                        <a href='{{Storage::url("$dispatch->lamp") }}' target="_blank">
                                            <p>View Uploaded File</p>
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Catatan</div>
                                    <div class="col-lg-8 col-md-9">{{$dispatch->catt}}</div>
                                </div>
                            </div>

                            @endforeach
                            <br>


                            <div style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                <h3 class="card-title" style="padding: 0px;">Rujukan (Admin)</i></h3>
                                <hr>

                                @foreach ($dispatchs as $dispatch)
                                <br>

                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Tarikh Menerima <br></div>
                                    <div class="col-lg-8 col-md-9">
                                        {{date('d/m/Y', strtotime($dispatch->dispatch_recieved_at)) }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Tarikh Memproses </div>
                                    <div class="col-lg-8 col-md-9">
                                        {{date('d/m/Y', strtotime( $dispatch->date_process))}}</div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Tarikh Tutup</div>
                                    <div class="col-lg-8 col-md-9">{{date('d/m/Y', strtotime( $dispatch->date_close))}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Dokumen</div>
                                    <div class="col-lg-8 col-md-9">
                                        <a href='{{Storage::url("$dispatch->lamp") }}' target="_blank">
                                            <p>View Uploaded File</p>
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">No. Rujukan</div>
                                    <div class="col-lg-8 col-md-9">{{ $dispatch->no_folio}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Catatan</div>
                                    <div class="col-lg-8 col-md-9">{{ $dispatch->catatan_admin}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Tindakan</div>
                                    <div class="col-lg-8 col-md-9">{{optional($dispatch->Tindakan)->kod}}</div>
                                </div>

                                @endforeach

                            </div>

                            <br>

                            @foreach ($dispatchpassmecs as $dispatchpassmec)

                            <div style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                <h3 class="card-title" style="padding: 0px;">Tindakan</i></h3>
                                <hr>
                                <br>

                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Tindakan</div>
                                    <div class="col-lg-8 col-md-9">
                                        @php $tindakan_action_passs=$dispatchpassmec->tindakan_action_pass ?
                                        json_decode($dispatchpassmec->tindakan_action_pass, true) : []; @endphp
                                        @foreach($tindakan_action_passs as $tindakan_action_pass)

                                        <br>
                                        {{($tindakan_action_pass)}}


                                        @endforeach
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Ulasan Pengarah</div>
                                    <div class="col-lg-8 col-md-9">{{($dispatchpassmec->ulasan_pas)}}</div>
                                </div>


                                <br>
                                <div class="row">
                                    <div class="col-lg-4 col-md-3  label">Tindakan</div>
                                    <div class="col-lg-8 col-md-9">{{optional($dispatchpassmec->Tindakan)->kod}}</div>
                                </div>
                            </div>
                            <br>

                            @endforeach


                            <div style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                <h3 class="card-title" style="padding: 0px;">Documents</i></h3>
                                <hr>
                                <br>

                                <!-- Dokumen -->
                                <div class="card">
                                    <form>
                                        <table class="table-achiev overflow-auto">
                                            <thead>
                                                <tr>

                                                    <th>Daripada</th>
                                                    <th>No. Rujukan</th>
                                                    <th>Tarikh Surat</th>
                                                    <th>Tindakan</th>
                                                    <th>Catatan</th>
                                                    <th>Dokumen</th>


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
                                                        <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#StrategicThinkingEvidence">

                                                        </button>
                                                        <div class="modal fade" id="StrategicThinkingEvidence"
                                                            tabindex="-1">
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
                                                                            readonly>{{$dispatchfile->despatch}}</textarea>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div><!-- End Basic Modal-->
                                                    </td>


                                                    <td><a href='{{Storage::url("$dispatchfile->file") }}'
                                                            target="_blank">View</a></td>

                                                </tr>

                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>

                        </div>


                        <div class="tab-pane fade profile-overview pt-3" id="profile-doc">

                            <div class="col profile-overview"
                                style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                <h3 class="card-title" style="padding: 0px;">Rujukan MEC</i></h3>
                                <hr>
                                <br>



                                <!-- Dokumen -->
                                <div class="card">
                                    <form>
                                        <table class="table-achiev overflow-auto">
                                            <thead>
                                                <tr>

                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Tindakan</th>
                                                    <th>Catatan</th>
                                                    <th>Tarikh</th>



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

                                                    <td>{{$dispatchpassmec->created_by}}</td>

                                                    <td>{{(optional($dispatchpassmec->Tindakan)->kod)}}</td>

                                                    <td>
                                                        <!-- Basic Modal -->
                                                        <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#StrategicThinkingEvidence1">

                                                        </button>
                                                        <div class="modal fade" id="StrategicThinkingEvidence1"
                                                            tabindex="-2">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Tindakan</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        @php
                                                                        $tindakan_action_passs=$dispatchpassmec->tindakan_action_pass
                                                                        ?
                                                                        json_decode($dispatchpassmec->tindakan_action_pass,
                                                                        true) : []; @endphp
                                                                        @foreach($tindakan_action_passs as
                                                                        $tindakan_action_pass)
                                                                        <textarea class="form-control"
                                                                            style="height: 150px" readonly>

                                                                        {{($tindakan_action_pass)}}
                                                                        </textarea>
                                                                        @endforeach
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div><!-- End Basic Modal-->
                                                    </td>


                                                    <td>
                                                        <!-- Basic Modal -->
                                                        <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                            data-bs-toggle="modal" data-bs-target="#catatan">

                                                        </button>
                                                        <div class="modal fade" id="catatan" tabindex="-1">
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

                        </div>


                    </div>
                </div>
            </div><!-- End Recent Sales -->

        </div>
    </div>



</section>
@endsection