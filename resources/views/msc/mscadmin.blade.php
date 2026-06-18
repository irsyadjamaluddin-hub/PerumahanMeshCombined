@extends('layouts.app-all')

@section('title', 'Admin Tegahan')

@section('content')

<?php
$pagename = "MSC";
?>


<div class="pagetitle">
    <h1>Tegahan</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Laman Utama</a></li>
        <li class="breadcrumb-item active">Tegahan Admin</li>  
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif

    @if(Session::has('error_message'))
    <div class="alert alert-danger">
        <i class="fas fa-fw fa-exclamation-circle"></i>
        {!! session('error_message') !!}
    </div>
    @endif

    <div class="row mb-2" style="padding-left: 15px;">
        <div class="col-md-2" style="width: 10%; padding-right: 0px;">
            <label class="col-form-label">Tarikh Hari Ini: </label>
        </div>
        <div class="col-md-3" style="padding-left: 10px;">
            <input type="text" class="form-control" value="{{ now()->format('jS F Y') }}" disabled>
        </div>
        <!----- MSC Button  ----->
        <div class="col-sm-1 text-left" style="padding-right: 0px !important; padding-left: 0px !important; width: 10%">
            <button id="MSC-button" class="btn btn-primary active-button" style="width: 100% !important;">TEGAHAN</button>
        </div>
        <!----- History Button  ----->
        <div class="col-sm-2 text-left">
            <button id="History-button" type="submit" class="btn btn-primary inactive-button" style="width: 100% !important;">Sejarah Padam</button>
        </div>
        <div class="col-sm-3 text-left">
            <form method="GET" action="{{ route('msc.excel') }}" class="form-inline" id="exportForm">
                <button class="btn btn-success" type="submit" id="excelButton">Eksport Excel</button>
            </form>
        </div>
        <div class="col-sm-1 text-center">
            <a href="{{ route('msc.mscform') }}" class="btn btn-primary" style="margin-bottom: 10px; margin-left: 90px;">
                <i class="bi bi-plus-lg"></i>
            </a>
        </div>
    </div>

    <div class="col-12" id="MSC-content">
        <div class="card recent-sales">
            <div class="card-body overflow-auto">

                <table class="table table-borderless datatable mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Bil</th>
                            <th scope="col">Nama Syarikat</th>
                            <th scope="col">Kementerian</th>
                            <th scope="col">Tempoh Bulanan</th>
                            <th scope="col">Bil.Rujukan</th>
                            <th scope="col">Sebab Penggantungan</th>
                            <th scope="col">Tarikh Mula</th>
                            <th scope="col">Tarikh Tamat</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($suspendedcompany as $suspendedcompanys)
                    <tr>
                        <td style="text-align: center;">{{ $suspendedcompanys->id }}</td>
                        <td>{{ $suspendedcompanys->nama_syarikat }}</td>
                        <td>{{ $suspendedcompanys->kementerian }}</td>
                        <td style="text-align: center;">{{ $suspendedcompanys->tempoh_bulanan }}</td>
                        <td>{{ $suspendedcompanys->bil_rujukan }}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#sebabModal-{{ $suspendedcompanys->id }}" data-bs-tooltip="tooltip" data-bs-placement="top">
                                <i class="bi bi-card-text"></i>
                            </button>
                        </td>
                        <div class="modal fade" id="sebabModal-{{ $suspendedcompanys->id }}" tabindex="-1" aria-labelledby="sebabModalLabel-{{ $suspendedcompanys->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center">
                                        <h5 class="modal-title" id="sebabModalLabel-{{ $suspendedcompanys->id }}" style="text-align: center;"><b>Sebab</b></h5>
                                    </div>
                                    <div class="modal-body">
                                        <textarea placeholder="{{ $suspendedcompanys->sebab }}" class="form-control" disabled></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #f75f6e; border-color: #f75f6e;">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <td>{{ $suspendedcompanys->date_start->format('jS F Y') }}</td>
                        <td>{{ $suspendedcompanys->date_end->format('jS F Y') }}</td>
                        @php
                            $currentDate = \Carbon\Carbon::now(); // Get the current date
                            $startDate = $suspendedcompanys->date_start;
                            $endDate = $suspendedcompanys->date_end;
                        @endphp
                        <td>
                            @if ($currentDate >= $startDate && $currentDate <= $endDate)
                                <span class="badge badge-danger">Digantung</span>
                            @elseif ($currentDate > $endDate)
                                <span class="badge badge-success">Selesai</span>
                            @elseif ($currentDate < $startDate)
                                <span class="badge badge-warning">Menunggu</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $suspendedcompanys->id }}" data-bs-tooltip="tooltip" data-bs-placement="top">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </td>
                        <div class="modal fade" id="deleteModal-{{ $suspendedcompanys->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $suspendedcompanys->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center">
                                        <h5 class="modal-title" id="deleteModalLabel-{{ $suspendedcompanys->id }}" style="text-align: center;"><b>Sebab Pemadaman</b></h5>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('msc.destroy', $suspendedcompanys->id) }}">
                                            @csrf
                                            @method('delete')
                                            <div class="form-group">
                                                <textarea name="sebab_delete" class="form-control" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #7393B3; border-color: #7a96b4;">Tutup</button>
                                                <button type="submit" value="delete" class="btn btn-secondary" style="background-color: #f75f6e; border-color: #f75f6e;">Padam</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="col-12" id="History-content">
        <div class="card recent-sales">
            <div class="card-body overflow-auto">

                <table class="table table-borderless datatable mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nama Syarikat</th>
                            <th scope="col">Kementerian</th>
                            <th scope="col">Bil.Rujukan</th>
                            <th scope="col">Sebab Penggantungan</th>
                            <th scope="col">Tarikh Mula</th>
                            <th scope="col">Tarikh Tamat</th>
                            <th scope="col">Sebab Pemadaman</th>
                            <th scope="col">Dipadam oleh:</th>
                            <th scope="col">Dipadam pada:</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($suspendedhistory as $suspendedhistorys)
                    <tr>
                        <td>{{ $suspendedhistorys->id }}</td>
                        <td>{{ $suspendedhistorys->nama_syarikat }}</td>
                        <td>{{ $suspendedhistorys->kementerian }}</td>
                        <td>{{ $suspendedhistorys->bil_rujukan }}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#sebabModal2-{{ $suspendedhistorys->id }}" data-bs-tooltip="tooltip" data-bs-placement="top">
                                <i class="bi bi-card-text"></i>
                            </button>
                        </td>
                        <div class="modal fade" id="sebabModal2-{{ $suspendedhistorys->id }}" tabindex="-1" aria-labelledby="sebabModal2Label-{{ $suspendedhistorys->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center">
                                        <h5 class="modal-title" id="sebabModal2Label-{{ $suspendedhistorys->id }}" style="text-align: center;"><b>Sebab</b></h5>
                                    </div>
                                    <div class="modal-body">
                                        <textarea placeholder="{{ $suspendedhistorys->sebab }}" class="form-control" disabled></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #f75f6e; border-color: #f75f6e;">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <td>{{ $suspendedhistorys->date_start->format('jS F Y') }}</td>
                        <td>{{ $suspendedhistorys->date_end->format('jS F Y')}}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#sebabdeleteModal-{{ $suspendedhistorys->id }}" data-bs-tooltip="tooltip" data-bs-placement="top">
                                <i class="bi bi-card-text"></i>
                            </button>
                        </td>
                        <div class="modal fade" id="sebabdeleteModal-{{ $suspendedhistorys->id }}" tabindex="-1" aria-labelledby="sebabdeleteModalLabel-{{ $suspendedhistorys->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center">
                                        <h5 class="modal-title" id="sebabdeleteModalLabel-{{ $suspendedhistorys->id }}" style="text-align: center;"><b>Sebab</b></h5>
                                    </div>
                                    <div class="modal-body">
                                        <textarea placeholder="{{ $suspendedhistorys->sebab_delete }}" class="form-control" disabled></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #f75f6e; border-color: #f75f6e;">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <td>{{ $suspendedhistorys->ic_no }}</td>
                        <td>{{ $suspendedhistorys->created_at }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>

<style>
    .btn-secondary:hover {
        background-color: #dc3545 !important;
    }

    .active-button {
        background-color: #0d6efd !important;
        border-color: #3490dc !important;
    }

    .inactive-button {
        background-color: #7393B3 !important;
        border-color: #7a96b4 !important;
    }

    .add-button{
        margin-bottom: 10px; 
        margin-left: 20rem;
    }

    @media (max-width: 768px) {
    .add-button{
            margin-bottom: 10px; 
            margin-left: 0rem;
        }
    }
</style>

<script>
    // Get references to the buttons and content divs
    const MSCButton = document.getElementById('MSC-button');
    const HistoryButton = document.getElementById('History-button');
    const MSCContent = document.getElementById('MSC-content');
    const HistoryContent = document.getElementById('History-content');

    // Initially hide the HistoryContent
    HistoryContent.style.display = 'none';

    // Initially, set the MSC button as active
    MSCButton.classList.add('active-button');
    HistoryButton.classList.remove('active-button');

    // Function to toggle active and inactive buttons
    function toggleActiveButton(activeButton, inactiveButton) {
        activeButton.classList.add('active-button');
        activeButton.classList.remove('inactive-button');
        inactiveButton.classList.remove('active-button');
        inactiveButton.classList.add('inactive-button');
    }

    // Function to toggle content visibility
    function toggleContent(activeContent, inactiveContent) {
        activeContent.style.display = 'block';
        inactiveContent.style.display = 'none';
    }

    // Add click event listeners to the buttons
    MSCButton.addEventListener('click', () => {
        toggleContent(MSCContent, HistoryContent);
        toggleActiveButton(MSCButton, HistoryButton);
    });

    HistoryButton.addEventListener('click', () => {
        toggleContent(HistoryContent, MSCContent);
        toggleActiveButton(HistoryButton, MSCButton);
    });
</script>
@endsection