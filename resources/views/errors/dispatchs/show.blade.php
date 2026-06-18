@extends('layouts.app-all')

@section('title', 'Show e-Despatch')

@section('content')

<?php
$pagename = "SHOW MED";
?>

<div class="pagetitle">
    <h1>MoeDispatch</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">MED</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">


    <a href="{{ route('dispatchs.dis.index') }}" class="btn btn-primary text-right mb-2">
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
                            <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#profile-overview">Info</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#profile-doc">Documents</button>
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
                                    <div class="col-lg-8 col-md-9"> <span class="badge bg-danger"> Belum Diterima</span></div>
                                    @else
                                    <div class="col-lg-8 col-md-9">{{ date('d/m/Y', strtotime($dispatch->dispatch_recieved_at)) }}</div>
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

                        </div>


                        <div class="tab-pane fade profile-overview pt-3" id="profile-doc">

                            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                <h3 class="card-title" style="padding: 0px;">Dokumen</i></h3>
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
                                {{-- Dokumen ends --}}
                            </div>

                        </div>


                    </div>
                </div>
            </div><!-- End Recent Sales -->

        </div>
    </div>



</section>
@endsection