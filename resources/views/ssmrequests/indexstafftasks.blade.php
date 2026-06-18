@extends('layouts.app-all')

@section('title', 'SSM Staff Tasks List')

@section('content')


<?php
$pagename = "SSM Permohonan";
?>

<div class="pagetitle">
    <h1>SSM Staff Tasks Lists</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item"><a href="{{ route('ssmrequests.ssmrequest.indexpermohonan') }}">SSM Request Permohonan</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('ssmrequests.ssmrequest.indexstaffpermohonan') }}">SSM Tasks List</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<!----- Back out Button  ----->
<div class="col-md-1 text-left">
    <a href="{{ route('ssmrequests.ssmrequest.indexpermohonan') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 10px;">
        <i class="bi bi-arrow-left-circle"></i>
    </a>
</div>

<section class="section profile">

    <div class="col-md-12">

        @if(Session::has('success_message'))
        <div class="alert alert-success">
            <i class=" fas fa-fw fa-check"></i>
            {!! session('success_message') !!}
        </div>
        @endif

        <div class="col-12">
            <div class="card recent-sales">
                <div class="card-body overflow-auto">
                    <br>
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Tugasan Staff</h5>
                    <table class="table table-borderless mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Staff Kod.</th>
                                <th scope="col">Nama Staff</th>
                                <th scope="col" class="border-start border-end" style="text-align: center;">Jumlah Tugas</th>
                                <th scope="col" style="text-align: center;">Show</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if(isset($ssmkods) == 0)
                            <tr class="text-center">
                                <td colspan="8">
                                <h5>No records found</h5>
                                </td>
                            </tr>
                        @else
                        @foreach($ssmkods as $ssmkod)
                        <tr>
                            <td>{{ $ssmkod->kod }}</td>
                            <td>{{ $ssmkod->nama }}</td>
                            <td class="border-start border-end" style="text-align: center;">
                                @if($ssmkod->permohonanicno_count == 0)
                                    <span>Tidak ada</span>
                                @else
                                    @if($ssmkod->permohonanicno->contains('status', 'kiv'))
                                        <span class="badge rounded-pill bg-primary">{{ $ssmkod->permohonanicno_selesai_count }} / {{ $ssmkod->permohonanicno_count }}</span>
                                    @else
                                        <span class="badge rounded-pill
                                            {{ $ssmkod->permohonanicno_selesai_count == $ssmkod->permohonanicno_count ? 'bg-success' : 'bg-warning' }}">
                                            {{ $ssmkod->permohonanicno_selesai_count }} / {{ $ssmkod->permohonanicno_count }}
                                        </span>
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusInfoModal_{{ $ssmkod->id }}">
                                    <i class="bi bi-file-text-fill"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="statusInfoModal_{{ $ssmkod->id }}" tabindex="-1" role="dialog" aria-labelledby="statusInfoModalLabel_{{ $ssmkod->id }}" aria-hidden="true">
                                    <div class="modal-dialog" style="max-width: 50%;" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="statusInfoModalLabel_{{ $ssmkod->id }}">Status Information</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <ul class="nav nav-tabs nav-tabs-bordered ps-2 pt-2" id="myTab_{{ $ssmkod->id }}" role="tablist">
                                                <li class="nav-item border-start border-top rounded-top">
                                                    <button class="nav-link w-100 active" id="alltasks-tab_{{ $ssmkod->id }}" data-bs-toggle="tab" data-bs-target="#alltasks_{{ $ssmkod->id }}" role="tab" aria-controls="alltasks_{{ $ssmkod->id }}" aria-selected="true">All</button>
                                                </li>
                                                <li class="nav-item border-start border-end border-top rounded-top">
                                                    <button class="nav-link w-100" id="progresstasks-tab_{{ $ssmkod->id }}" data-bs-toggle="tab" data-bs-target="#progresstasks_{{ $ssmkod->id }}" role="tab" aria-controls="progresstasks_{{ $ssmkod->id }}" aria-selected="false">In Progress</button>
                                                </li>
                                                <li class="nav-item border-end border-top rounded-top">
                                                    <button class="nav-link w-100" id="completedtasks-tab_{{ $ssmkod->id }}" data-bs-toggle="tab" data-bs-target="#completedtasks_{{ $ssmkod->id }}" role="tab" aria-controls="completedtasks_{{ $ssmkod->id }}" aria-selected="false">Completed</button>
                                                </li>
                                            </ul>

                                            <!-- Tab Content -->
                                            <div class="tab-content" id="myTabContent_{{ $ssmkod->id }}">
                                                <!-- All Tasks Tab -->
                                                <div class="tab-pane fade show active" id="alltasks_{{ $ssmkod->id }}" role="tabpanel" aria-labelledby="alltasks-tab_{{ $ssmkod->id }}">
                                                    <div class="modal-body pt-1">
                                                        <p class="label mt-3" style="background-color: rgb(245, 245, 245); margin-left:40%; margin-right:40%;">
                                                            Total Tasks:  {{ $ssmkod->permohonanicno->count() }}
                                                        </p>
                                                        <table class="table dataTable table-striped table-bordered">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th>Ref. No.</th>
                                                                    <th>ICNo. Pemohon</th>
                                                                    <th>Kod</th>
                                                                    <th>Status</th>
                                                                    <th>Kiv Catatan</th>
                                                                    <th>Submitted At</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if($ssmkod->permohonanicno->isEmpty())
                                                                    <tr>
                                                                        <td colspan="5" class="text-center">No Records found</td>
                                                                    </tr>
                                                                @else
                                                                    @foreach($ssmkod->permohonanicno as $icnoRecord)
                                                                        <tr>
                                                                            <td>PM {{ $icnoRecord->permohonan_id }}</td>
                                                                            <td>{{ $icnoRecord->icno_pemohon }}</td>
                                                                            <td>{{ optional($icnoRecord->ssmkodindex)->kod }}</td>
                                                                            <td>
                                                                                @if($icnoRecord->status == null)
                                                                                    <span class="badge rounded-pill bg-danger">Untuk Tindakan</span>
                                                                                @elseif($icnoRecord->status == "Dalam Proses")
                                                                                    <span class="badge rounded-pill bg-warning">Dalam Proses</span>
                                                                                @elseif($icnoRecord->status == "kiv")
                                                                                    <span class="badge rounded-pill bg-primary">kiv</span>
                                                                                @elseif($icnoRecord->status == "selesai")
                                                                                    <span class="badge rounded-pill bg-success">Selesai</span>
                                                                                @endif
                                                                            </td>
                                                                            <td style="text-align: justify">
                                                                                <div class="text-container catatan" data-record-id="{{ $icnoRecord->id }}">
                                                                                    @if (strlen($icnoRecord->catatankivadmin) > 100)
                                                                                        <div class="limited-text">
                                                                                            {{ Str::limit($icnoRecord->catatankivadmin, 100) }}
                                                                                        </div>
                                                                                        <div class="full-text" style="display: none;">
                                                                                            {{ $icnoRecord->catatankivadmin }}
                                                                                        </div>
                                                                                        <a href="#" class="read-more" style="color: rgb(42, 152, 156);">Read More</a>
                                                                                    @else
                                                                                        <div class="full-text">
                                                                                            {{ $icnoRecord->catatankivadmin }}
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            </td>
                                                                            <td>{{ $icnoRecord->submitted_at }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <!-- In Progress Tasks Tab -->
                                                <div class="tab-pane fade" id="progresstasks_{{ $ssmkod->id }}" role="tabpanel" aria-labelledby="progresstasks-tab_{{ $ssmkod->id }}">
                                                    <div class="modal-body pt-1">
                                                        @php
                                                            $inProgressTasks = $ssmkod->permohonanicno->filter(function ($task) {
                                                                return $task->status !== 'selesai';
                                                            });
                                                        @endphp
                                                        <p class="label mt-3" style="background-color: rgb(245, 245, 245); margin-left:40%; margin-right:40%;">
                                                            Current Tasks:  {{ $inProgressTasks->count() }}
                                                        </p>
                                                        <table class="table dataTable table-striped table-bordered">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th>Ref. No.</th>
                                                                    <th>ICNo. Pemohon</th>
                                                                    <th>Kod</th>
                                                                    <th>Status</th>
                                                                    <th>Kiv Catatan</th>
                                                                    <th>Submitted At</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if($inProgressTasks->isEmpty())
                                                                    <tr>
                                                                        <td colspan="5" class="text-center">No Records found</td>
                                                                    </tr>
                                                                @else
                                                                    @foreach($inProgressTasks as $icnoRecord)
                                                                        <tr>
                                                                            <td>PM {{ $icnoRecord->permohonan_id }}</td>
                                                                            <td>{{ $icnoRecord->icno_pemohon }}</td>
                                                                            <td>{{ optional($icnoRecord->ssmkodindex)->kod }}</td>
                                                                            <td>
                                                                                @if($icnoRecord->status == null)
                                                                                    <span class="badge rounded-pill bg-danger">Untuk Tindakan</span>
                                                                                @elseif($icnoRecord->status == "Dalam Proses")
                                                                                    <span class="badge rounded-pill bg-warning">Dalam Proses</span>
                                                                                @elseif($icnoRecord->status == "kiv")
                                                                                    <span class="badge rounded-pill bg-primary">kiv</span>
                                                                                @endif
                                                                            </td>
                                                                            <td style="text-align: justify">
                                                                                <div class="text-container catatan" data-record-id="{{ $icnoRecord->id }}">
                                                                                    @if (strlen($icnoRecord->catatankivadmin) > 100)
                                                                                        <div class="limited-text">
                                                                                            {{ Str::limit($icnoRecord->catatankivadmin, 100) }}
                                                                                        </div>
                                                                                        <div class="full-text" style="display: none;">
                                                                                            {{ $icnoRecord->catatankivadmin }}
                                                                                        </div>
                                                                                        <a href="#" class="read-more" style="color: rgb(42, 152, 156);">Read More</a>
                                                                                    @else
                                                                                        <div class="full-text">
                                                                                            {{ $icnoRecord->catatankivadmin }}
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            </td>
                                                                            <td>{{ $icnoRecord->submitted_at }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <!-- Completed Tasks Tab -->
                                                <div class="tab-pane fade" id="completedtasks_{{ $ssmkod->id }}" role="tabpanel" aria-labelledby="completedtasks-tab_{{ $ssmkod->id }}">
                                                    <div class="modal-body pt-1">
                                                        @php
                                                            $completedTasks = $ssmkod->permohonanicno->filter(function ($task) {
                                                                return $task->status === 'selesai';
                                                            });
                                                        @endphp
                                                        <p class="label mt-3" style="background-color: rgb(245, 245, 245); margin-left:40%; margin-right:40%;">
                                                            Completed Tasks:  {{ $completedTasks->count() }}
                                                        </p>
                                                        <table class="table dataTable table-striped table-bordered">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th>Ref. No.</th>
                                                                    <th>ICNo. Pemohon</th>
                                                                    <th>Kod</th>
                                                                    <th>Status</th>
                                                                    <th>Kiv Catatan</th>
                                                                    <th>Submitted At</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if($completedTasks->isEmpty())
                                                                    <tr>
                                                                        <td colspan="5" class="text-center">No Records found</td>
                                                                    </tr>
                                                                @else
                                                                    @foreach($completedTasks as $icnoRecord)
                                                                        <tr>
                                                                            <td>PM {{ $icnoRecord->permohonan_id }}</td>
                                                                            <td>{{ $icnoRecord->icno_pemohon }}</td>
                                                                            <td>{{ optional($icnoRecord->ssmkodindex)->kod }}</td>
                                                                            <td>
                                                                                <span class="badge rounded-pill bg-success">Selesai</span>
                                                                            </td>
                                                                            <td style="text-align: justify">
                                                                                <div class="text-container catatan" data-record-id="{{ $icnoRecord->id }}">
                                                                                    @if (strlen($icnoRecord->catatankivadmin) > 100)
                                                                                        <div class="limited-text">
                                                                                            {{ Str::limit($icnoRecord->catatankivadmin, 100) }}
                                                                                        </div>
                                                                                        <div class="full-text" style="display: none;">
                                                                                            {{ $icnoRecord->catatankivadmin }}
                                                                                        </div>
                                                                                        <a href="#" class="read-more" style="color: rgb(42, 152, 156);">Read More</a>
                                                                                    @else
                                                                                        <div class="full-text">
                                                                                            {{ $icnoRecord->catatankivadmin }}
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            </td>
                                                                            <td>{{ $icnoRecord->submitted_at }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Permohonan Table -->
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.catatan').forEach(container => {
            container.addEventListener('click', function (event) {
                if (event.target.classList.contains('read-more')) {
                    event.preventDefault();

                    const limitedText = container.querySelector('.limited-text');
                    const fullText = container.querySelector('.full-text');

                    limitedText.style.display = limitedText.style.display === 'none' ? 'block' : 'none';
                    fullText.style.display = fullText.style.display === 'none' ? 'block' : 'none';

                    event.target.textContent = event.target.textContent === 'Read More' ? 'Read Less' : 'Read More';
                    event.target.style.color = event.target.textContent === 'Read More' ? 'rgb(42, 152, 156)' : 'grey';
                }
            });
        });
    });
</script>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
