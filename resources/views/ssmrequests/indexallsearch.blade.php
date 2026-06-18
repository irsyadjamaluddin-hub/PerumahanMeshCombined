@extends('layouts.app-all')

@section('title', 'SSM Request Admin Index')

@section('content')

<style>
    .label {
    color: white;
    padding: 7px;
    font-family: Arial;
    }
    .success {background-color: #04AA6D;} /* Green */
    .warning {background-color: #ff9800;} /* Orange */
    .danger {background-color: #f44336;} /* Red */
    .other {background-color: #e7e7e7; color: black;} /* Gray */
</style>

<?php
$pagename = "SSMSRequest_Admin";
?>

<div class="pagetitle">
    <h1>SSM Request Admin</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">SSM Request Admin</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

<div class="col-md-12">
    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif
    <div class="row mb-2">
        <div class="col-md-10">
            <a href="{{ route('ssmrequests.ssmrequest.create') }}" class="btn btn-primary text-right">
                <i class="bi bi-plus-lg"></i>
            </a>
        </div>
        <div class="col-md-2" style="text-align:center;">
            <a href="https://mesh.moe.gov.bn/borangaduanssm"  target="_blank" class= "btn btn-primary">
                <i class="bi bi-link"></i>
            </a>
            <a href="{{ route('ssmrequests.ssmrequest.ssmkod') }}" class="btn btn-primary">
                <i class="ri-user-add-fill"></i>
            </a>
        </div>
    </div>

    <form action="{{ route('indexallsearch') }}" method="GET">
          <div class="flex justify-between mb-3 rounded-lg overflow-hidden">

                <input type="text" name="query" id="term" placeholder="Master Search" class="w-full px-10 focus:outline-none">

                <button type="submit" class="p-3 bg-blue-500 hover:bg-blue-600" style="transition: 0.4s;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                </div>
   </form>

    <div class="card mt-3">
        <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                    <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#ssm-approval">Approval</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#ssm-cuti"> Delete Cuti</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#ssm-peranan">Peranan</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#ssm-password">Password</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#ssm-bakicuti" > Baki Cuti</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#ssm-pertukaran" >Pertukaran IC No</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#ssm-others">Others</button>
                </li>
            </ul>
            <br>
            <!-- Close Bordered Tabs -->
            <!-- Tab Start -->
            <div class="tab-content pt-2">
                <!-- Approval Tab -->
                <div class="tab-pane fade show active ssm-approval" id="ssm-approval">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Approval</h5>
                    <div class="overflow-auto" >
                        <table class="table table-borderless datatable mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Ref. No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">IC.No</th>
                                    <th scope="col">Approver Name</th>
                                    <th scope="col">Approver IC.No</th>
                                    <th scope="col">Tarikh</th>
                                    <th scope="col" style="width: 15%;">Catatan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($resultsssmapproval) == 0)
                                    <tr class="text-center">
                                        <td colspan="8">
                                            <h5>No records found</h5>
                                        </td>
                                    </tr>
                                @else
                                @foreach($resultsssmapproval as $ssmapproval)
                                <tr>
                                    <td>AP0{{ $ssmapproval->id }}</td>
                                    <td>{{ $ssmapproval->ap_name }}</td>
                                    <td>{{ $ssmapproval->ap_icno }}</td>
                                    <td>{{ $ssmapproval->ap_approvername }}</td>
                                    <td>{{ $ssmapproval->ap_approvericno }}</td>
                                    <td>{{ $ssmapproval->ap_created_at }}</td>
                                    <td style="text-align: justify">
                                        <div class="text-container catatanap" data-record-id="{{ $ssmapproval->id }}">
                                            @if (strlen($ssmapproval->ap_catatan) > 25)
                                                <div class="limited-text">
                                                    {{ Str::limit($ssmapproval->ap_catatan, 25) }}
                                                </div>
                                                <div class="full-text" style="display: none;">
                                                    {{ $ssmapproval->ap_catatan }}
                                                </div>
                                                <a href="#" class="read-more" style="color: rgb(42, 152, 156);">Read More</a>
                                            @else
                                                <div class="full-text">
                                                    {{ $ssmapproval->ap_catatan }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            // Add a click event listener to a common ancestor of "Read More" links
                                            document.querySelector('.catatanap[data-record-id="{{ $ssmapproval->id }}"]').addEventListener('click', function (event) {
                                                // Check if the clicked element is a "Read More" link
                                                if (event.target.classList.contains('read-more')) {
                                                    event.preventDefault();

                                                    // Find the parent container
                                                    const container = event.target.closest('.text-container');

                                                    // Toggle the display of the limited and full text based on data attribute
                                                    const limitedText = container.querySelector('.limited-text');
                                                    const fullText = container.querySelector('.full-text');

                                                    limitedText.style.display = limitedText.style.display === 'none' ? 'block' : 'none';
                                                    fullText.style.display = fullText.style.display === 'none' ? 'block' : 'none';

                                                    // Change the text and color of the link based on the current state
                                                    if (event.target.textContent === 'Read More') {
                                                        event.target.textContent = 'Read Less';
                                                        event.target.style.color = 'grey';
                                                    } else {
                                                        event.target.textContent = 'Read More';
                                                        event.target.style.color = 'rgb(42, 152, 156)';
                                                    }
                                                }
                                            });
                                        });
                                    </script>
                                    <td>
                                        @if($ssmapproval->ap_status == null)
                                            <span class="badge rounded-pill bg-danger">Aduan Diterima</span>
                                            @elseif($ssmapproval->ap_status=="Sedang Dikemaskini / Diteliti")
                                            <span class="badge rounded-pill bg-warning">Sedang Dikemaskini / Diteliti</span>
                                            @elseif($ssmapproval->ap_status=="Dihadapkan ke Dynamik")
                                            <span class="badge rounded-pill bg-primary">Dihadapkan ke Dynamik</span>
                                            @elseif($ssmapproval->ap_status=="Selesai")
                                            <span class="badge rounded-pill bg-success">Selesai</span>
                                            @endif
                                    </td>
                                    <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                            <!----Edit Button----->
                                            <form method="get" action="{{ route('ssmrequests.ssmrequest.editadminapproval', $ssmapproval->id ) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                            </form>
                                            <!----Destroy Button----->
                                            <form method="post" action="{{ route('ssmrequests.ssmrequest.destroyapproval', $ssmapproval->id ) }}">
                                                @csrf
                                                @method('delete')
                                                <a onclick='return confirm("Confirm to delete data?")'>
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $resultsssmapproval->links() }} <!-- Display pagination links -->

                    </div>
                </div>
                <!-- Delete Cuti Tab -->
                <div class="tab-pane fade ssm-cuti pt-2" id="ssm-cuti">
                    <div class="overflow-auto" >
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Delete Cuti</h5>
                        <table class="table table-borderless datatable mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Ref. No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">IC No.</th>
                                    <th scope="col">Jawatan</th>
                                    <th scope="col">Tarikh Cuti (Delete)</th>
                                    <th scope="col">Tarikh Aduan</th>
                                    <th scope="col" style="width: 15%;">Catatan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($resultsssmdc) == 0)
                                    <tr class="text-center">
                                        <td colspan="8">
                                        <h5>No records found</h5>
                                        </td>
                                    </tr>
                                @else
                                @foreach($resultsssmdc as $ssmdc)
                                <tr>
                                    <td>DC0{{ $ssmdc->id }}</td>
                                    <td>{{ $ssmdc->dc_name }}</td>
                                    <td>{{ $ssmdc->dc_icno }}</td>
                                    <td>{{ $ssmdc->dc_jawatan }}</td>
                                    <td>{{ $ssmdc->dc_datedelete }}</td>
                                    <td>{{ $ssmdc->dc_dateaduan }}</td>
                                    <td style="text-align: justify">
                                        <div class="text-container catatandc" data-record-id="{{ $ssmdc->id }}">
                                            @if (strlen($ssmdc->dc_catatan) > 25)
                                                <div class="limited-text">
                                                    {{ Str::limit($ssmdc->dc_catatan, 25) }}
                                                </div>
                                                <div class="full-text" style="display: none;">
                                                    {{ $ssmdc->dc_catatan }}
                                                </div>
                                                <a href="#" class="read-more" style="color: rgb(42, 152, 156);">Read More</a>
                                            @else
                                                <div class="full-text">
                                                    {{ $ssmdc->dc_catatan }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            // Add a click event listener to a common ancestor of "Read More" links
                                            document.querySelector('.catatandc[data-record-id="{{ $ssmdc->id }}"]').addEventListener('click', function (event) {
                                                // Check if the clicked element is a "Read More" link
                                                if (event.target.classList.contains('read-more')) {
                                                    event.preventDefault();

                                                    // Find the parent container
                                                    const container = event.target.closest('.text-container');

                                                    // Toggle the display of the limited and full text based on data attribute
                                                    const limitedText = container.querySelector('.limited-text');
                                                    const fullText = container.querySelector('.full-text');

                                                    limitedText.style.display = limitedText.style.display === 'none' ? 'block' : 'none';
                                                    fullText.style.display = fullText.style.display === 'none' ? 'block' : 'none';

                                                    // Change the text and color of the link based on the current state
                                                    if (event.target.textContent === 'Read More') {
                                                        event.target.textContent = 'Read Less';
                                                        event.target.style.color = 'grey';
                                                    } else {
                                                        event.target.textContent = 'Read More';
                                                        event.target.style.color = 'rgb(42, 152, 156)';
                                                    }
                                                }
                                            });
                                        });
                                    </script>
                                    <td>
                                        @if($ssmdc->dc_status == null)
                                            <span class="badge rounded-pill bg-danger">Aduan Diterima</span>
                                        @elseif($ssmdc->dc_status=="Selesai")
                                            <span class="badge rounded-pill bg-success">Selesai</span>
                                        @elseif($ssmdc->dc_status=="Dihadapkan ke Dynamik")
                                            <span class="badge rounded-pill bg-primary">Dihadapkan ke Dynamik</span>
                                        @elseif($ssmdc->dc_status=="Proses")
                                            <span class="badge rounded-pill bg-primary">Proses</span>
                                        @elseif($ssmdc->dc_status=="Permohonan dipadam & Selesai")
                                            <span class="badge rounded-pill bg-success">Permohonan dipadam & Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                            <!----Edit Button----->
                                            <form method="get" action="{{ route('ssmrequests.ssmrequest.editadmindc', $ssmdc->id ) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                            </form>
                                            <!----Destroy Button----->
                                            <form method="post" action="{{ route('ssmrequests.ssmrequest.destroydc', $ssmdc->id ) }}">
                                                @csrf
                                                @method('delete')
                                                <a onclick='return confirm("Confirm to delete data?")'>
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $resultsssmdc->links() }} <!-- Display pagination links -->

                    </div>
                </div>
                <!-- Peranan Tab -->
                <div class="tab-pane fade ssm-cuti pt-2" id="ssm-peranan">
                    <div class="overflow-auto" >
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Peranan</h5>
                        <table class="table table-borderless datatable mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Ref. No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">IC No.</th>
                                    <th scope="col">Jawatan</th>
                                    <th scope="col">Emel</th>
                                    <th scope="col">Tarikh</th>
                                    <th scope="col" style="width: 15%;">Catatan</th>
                                    <th scope="col">Peranan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($resultsssmperanan) == 0)
                                    <tr class="text-center">
                                        <td colspan="8">
                                            <h5>No records found</h5>
                                        </td>
                                    </tr>
                                @else
                                @foreach($resultsssmperanan as $ssmperanan)
                                <tr>
                                    <td>PE0{{ $ssmperanan->id }}</td>
                                    <td>{{ $ssmperanan->pe_name }}</td>
                                    <td>{{ $ssmperanan->pe_icno }}</td>
                                    <td>{{ $ssmperanan->pe_jawatan }}</td>
                                    <td>{{ $ssmperanan->pe_email }}</td>
                                    <td>{{ $ssmperanan->pe_created_by }}</td>
                                    <td style="text-align: justify">
                                        <div class="text-container catatanpe" data-record-id="{{ $ssmperanan->id }}">
                                            @if (strlen($ssmperanan->pe_catatan) > 25)
                                                <div class="limited-text">
                                                    {{ Str::limit($ssmperanan->pe_catatan, 25) }}
                                                </div>
                                                <div class="full-text" style="display: none;">
                                                    {{ $ssmperanan->pe_catatan }}
                                                </div>
                                                <a href="#" class="read-more" style="color: rgb(42, 152, 156);">Read More</a>
                                            @else
                                                <div class="full-text">
                                                    {{ $ssmperanan->pe_catatan }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            // Add a click event listener to a common ancestor of "Read More" links
                                            document.querySelector('.catatanpe[data-record-id="{{ $ssmperanan->id }}"]').addEventListener('click', function (event) {
                                                // Check if the clicked element is a "Read More" link
                                                if (event.target.classList.contains('read-more')) {
                                                    event.preventDefault();

                                                    // Find the parent container
                                                    const container = event.target.closest('.text-container');

                                                    // Toggle the display of the limited and full text based on data attribute
                                                    const limitedText = container.querySelector('.limited-text');
                                                    const fullText = container.querySelector('.full-text');

                                                    limitedText.style.display = limitedText.style.display === 'none' ? 'block' : 'none';
                                                    fullText.style.display = fullText.style.display === 'none' ? 'block' : 'none';

                                                    // Change the text and color of the link based on the current state
                                                    if (event.target.textContent === 'Read More') {
                                                        event.target.textContent = 'Read Less';
                                                        event.target.style.color = 'grey';
                                                    } else {
                                                        event.target.textContent = 'Read More';
                                                        event.target.style.color = 'rgb(42, 152, 156)';
                                                    }
                                                }
                                            });
                                        });
                                    </script>
                                    <td>{{ $ssmperanan->pe_peranan }}</td>
                                    <td>
                                        @if($ssmperanan->pe_status == null)
                                            <span class="badge rounded-pill bg-danger">Aduan Diterima</span>
                                        @elseif($ssmperanan->pe_status=="Sedang Dikemaskini / Diteliti")
                                            <span class="badge rounded-pill bg-warning">Sedang Dikemaskini / Diteliti</span>
                                        @elseif($ssmperanan->pe_status=="Dihadapkan ke Dynamik")
                                            <span class="badge rounded-pill bg-primary">Dihadapkan ke Dynamik</span>
                                        @elseif($ssmperanan->pe_status=="Selesai")
                                            <span class="badge rounded-pill bg-success">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                            <!----Edit Button----->
                                            <form method="get" action="{{ route('ssmrequests.ssmrequest.editadminperanan', $ssmperanan->id ) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                            </form>
                                            <form method="post" action="{{ route('ssmrequests.ssmrequest.destroyperanan', $ssmperanan->id ) }}">
                                                @csrf
                                                @method('delete')
                                                <a onclick='return confirm("Confirm to delete data?")'>
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>

                        {{ $resultsssmperanan->links() }} <!-- Display pagination links -->
                    </div>
                </div>
                <!-- Password Tab -->
                <div class="tab-pane fade ssm-password pt-2" id="ssm-password">
                    <div class="overflow-auto" >
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;"> Reset Password</h5>
                        <table class="table table-borderless datatable mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Ref. No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">IC No.</th>
                                    <th scope="col">Jawatan</th>
                                    <th scope="col">Password OTP</th>
                                    <th scope="col">Tarikh</th>
                                    <th scope="col" style="width: 15%;">Catatan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($resultsssmpassword) == 0)
                                    <tr class="text-center">
                                        <td colspan="8">
                                            <h5>No records found</h5>
                                        </td>
                                    </tr>
                                @else
                                @foreach($resultsssmpassword as $ssmpassword)
                                    <tr>
                                        <td>PS{{ $ssmpassword->id }}</td>
                                        <td>{{ $ssmpassword->ps_name }}</td>
                                        <td>{{ $ssmpassword->ps_icno }}</td>
                                        <td>{{ $ssmpassword->ps_jawatan }}</td>
                                        <td>{{ $ssmpassword->ps_otp }}</td>
                                        <td>{{ $ssmpassword->ps_created_at }}</td>
                                        <td style="text-align: justify">
                                            <div class="text-container catatanps" data-record-id="{{ $ssmpassword->id }}">
                                                @if (strlen($ssmpassword->ps_catatan) > 25)
                                                    <div class="limited-text">
                                                        {{ Str::limit($ssmpassword->ps_catatan, 25) }}
                                                    </div>
                                                    <div class="full-text" style="display: none;">
                                                        {{ $ssmpassword->ps_catatan }}
                                                    </div>
                                                    <a href="#" class="read-more" style="color: rgb(42, 152, 156);">Read More</a>
                                                @else
                                                    <div class="full-text">
                                                        {{ $ssmpassword->ps_catatan }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                // Add a click event listener to a common ancestor of "Read More" links
                                                document.querySelector('.catatanps[data-record-id="{{ $ssmpassword->id }}"]').addEventListener('click', function (event) {
                                                    // Check if the clicked element is a "Read More" link
                                                    if (event.target.classList.contains('read-more')) {
                                                        event.preventDefault();

                                                        // Find the parent container
                                                        const container = event.target.closest('.text-container');

                                                        // Toggle the display of the limited and full text based on data attribute
                                                        const limitedText = container.querySelector('.limited-text');
                                                        const fullText = container.querySelector('.full-text');

                                                        limitedText.style.display = limitedText.style.display === 'none' ? 'block' : 'none';
                                                        fullText.style.display = fullText.style.display === 'none' ? 'block' : 'none';

                                                        // Change the text and color of the link based on the current state
                                                        if (event.target.textContent === 'Read More') {
                                                            event.target.textContent = 'Read Less';
                                                            event.target.style.color = 'grey';
                                                        } else {
                                                            event.target.textContent = 'Read More';
                                                            event.target.style.color = 'rgb(42, 152, 156)';
                                                        }
                                                    }
                                                });
                                            });
                                        </script>
                                        <td>
                                            @if($ssmpassword->ps_status == null)
                                                <span class="badge rounded-pill bg-danger">Aduan Diterima</span>
                                            @elseif($ssmpassword->ps_status=="Dihadapkan ke HD")
                                                <span class="badge rounded-pill bg-primary">Dihadapkan ke HD</span>
                                            @elseif($ssmpassword->ps_status=="Selesai")
                                                <span class="badge rounded-pill bg-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                                <!----Edit Button----->
                                                <form method="get" action="{{ route('ssmrequests.ssmrequest.editadminpassword', $ssmpassword->id ) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                </form>
                                                <!----Destroy Button----->
                                                <form method="post" action="{{ route('ssmrequests.ssmrequest.destroypassword', $ssmpassword->id ) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <a onclick='return confirm("Confirm to delete data?")'>
                                                        <button type="submit" class="btn btn-outline-danger">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $resultsssmpassword->links() }} <!-- Display pagination links -->

                    </div>
                </div>
                <!-- Baki Cuti-->
                <div class="tab-pane fade ssm-bakicuti pt-2" id="ssm-bakicuti">
                    <div class="overflow-auto" >
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Baki Cuti</h5>
                        <table class="table table-borderless datatable mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Ref. No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">IC No.</th>
                                    <th scope="col">Jawatan</th>
                                    <th scope="col">Tempat Bertugas</th>
                                    <th scope="col">Tarikh</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Catatan</th>
                                    <th scope="col">Catatan Admin</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($resultsssmbakicuti) == 0)
                                    <tr class="text-center">
                                        <td colspan="8">
                                            <h5>No records found</h5>
                                        </td>
                                    </tr>
                                @else
                                @foreach($resultsssmbakicuti as $ssmbakicuti)
                                    <tr>
                                        <td> BC{{ $ssmbakicuti->id }}</td>
                                        <td>{{ $ssmbakicuti->bc_name }}</td>
                                        <td>{{ $ssmbakicuti->bc_icno }}</td>
                                        <td>{{ $ssmbakicuti->bc_jawatan }}</td>
                                        <td>{{ $ssmbakicuti->bc_workplace }}</td>
                                        <td>{{ $ssmbakicuti->bc_created_at }}</td>
                                        <td>
                                            @if(isset($ssmbakicuti) && isset($ssmbakicuti->bc_file) && is_array($ssmbakicuti->bc_file) && count($ssmbakicuti->bc_file) > 0)
                                                <div class="d-flex flex-wrap">
                                                    @foreach ($ssmbakicuti->bc_file as $index => $file)
                                                        <div class="file-container mb-2 me-2 d-flex align-items-center">
                                                            <a href="{{ asset('storage/ssmbakicuti/' . $file) }}" target="_blank">
                                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ $file }}">
                                                                    <i class="bi bi-collection"></i>
                                                                </button>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                No file
                                            @endif
                                        </td>
                                        <td style="text-align: justify">
                                            <div class="text-container catatanbc" data-record-id="{{ $ssmbakicuti->id }}">
                                                @if (strlen($ssmbakicuti->bc_catatanuser) > 25)
                                                    <div class="limited-text">
                                                        {{ Str::limit($ssmbakicuti->bc_catatanuser, 25) }}
                                                    </div>
                                                    <div class="full-text" style="display: none;">
                                                        {{ $ssmbakicuti->bc_catatanuser }}
                                                    </div>
                                                    <a href="#" class="read-more" style="color: rgb(42, 152, 156);">Read More</a>
                                                @else
                                                    <div class="full-text">
                                                        {{ $ssmbakicuti->bc_catatanuser }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                // Add a click event listener to a common ancestor of "Read More" links
                                                document.querySelector('.catatanbc[data-record-id="{{ $ssmbakicuti->id }}"]').addEventListener('click', function (event) {
                                                    // Check if the clicked element is a "Read More" link
                                                    if (event.target.classList.contains('read-more')) {
                                                        event.preventDefault();

                                                        // Find the parent container
                                                        const container = event.target.closest('.text-container');

                                                        // Toggle the display of the limited and full text based on data attribute
                                                        const limitedText = container.querySelector('.limited-text');
                                                        const fullText = container.querySelector('.full-text');

                                                        limitedText.style.display = limitedText.style.display === 'none' ? 'block' : 'none';
                                                        fullText.style.display = fullText.style.display === 'none' ? 'block' : 'none';

                                                        // Change the text and color of the link based on the current state
                                                        if (event.target.textContent === 'Read More') {
                                                            event.target.textContent = 'Read Less';
                                                            event.target.style.color = 'grey';
                                                        } else {
                                                            event.target.textContent = 'Read More';
                                                            event.target.style.color = 'rgb(42, 152, 156)';
                                                        }
                                                    }
                                                });
                                            });
                                        </script>
                                        <td style="text-align: justify">
                                            <div class="text-container catatanbca" data-record-id="{{ $ssmbakicuti->id }}">
                                                @if (strlen($ssmbakicuti->bc_catatanadmin) > 25)
                                                    <div class="limited-text">
                                                        {{ Str::limit($ssmbakicuti->bc_catatanadmin, 25) }}
                                                    </div>
                                                    <div class="full-text" style="display: none;">
                                                        {{ $ssmbakicuti->bc_catatanadmin }}
                                                    </div>
                                                    <a href="#" class="read-more" style="color: rgb(42, 152, 156);">Read More</a>
                                                @else
                                                    <div class="full-text">
                                                        {{ $ssmbakicuti->bc_catatanadmin }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                // Add a click event listener to a common ancestor of "Read More" links
                                                document.querySelector('.catatanbca[data-record-id="{{ $ssmbakicuti->id }}"]').addEventListener('click', function (event) {
                                                    // Check if the clicked element is a "Read More" link
                                                    if (event.target.classList.contains('read-more')) {
                                                        event.preventDefault();

                                                        // Find the parent container
                                                        const container = event.target.closest('.text-container');

                                                        // Toggle the display of the limited and full text based on data attribute
                                                        const limitedText = container.querySelector('.limited-text');
                                                        const fullText = container.querySelector('.full-text');

                                                        limitedText.style.display = limitedText.style.display === 'none' ? 'block' : 'none';
                                                        fullText.style.display = fullText.style.display === 'none' ? 'block' : 'none';

                                                        // Change the text and color of the link based on the current state
                                                        if (event.target.textContent === 'Read More') {
                                                            event.target.textContent = 'Read Less';
                                                            event.target.style.color = 'grey';
                                                        } else {
                                                            event.target.textContent = 'Read More';
                                                            event.target.style.color = 'rgb(42, 152, 156)';
                                                        }
                                                    }
                                                });
                                            });
                                        </script>
                                        <td>
                                            @if($ssmbakicuti->bc_status == null)
                                                <span class="badge rounded-pill bg-danger">Aduan Diterima</span>
                                            @elseif($ssmbakicuti->bc_status=="Dihadapkan ke HD")
                                                <span class="badge rounded-pill bg-primary">Dihadapkan ke HD</span>
                                            @elseif($ssmbakicuti->bc_status=="Selesai")
                                                <span class="badge rounded-pill bg-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                                <!----Edit Button----->
                                                <form method="get" action="{{ route('ssmrequests.ssmrequest.editadminbakicuti', $ssmbakicuti->id ) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                </form>
                                                <!----Destroy Button----->
                                                <form method="post" action="{{ route('ssmrequests.ssmrequest.destroybakicuti', $ssmbakicuti->id ) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <a onclick='return confirm("Confirm to delete data?")'>
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $resultsssmbakicuti->links() }} <!-- Display pagination links -->

                    </div>
                </div>
                <!-- Pertukaran IC No Tab -->
                <div class="tab-pane fade ssm-pertukaran pt-2" id="ssm-pertukaran">
                    <div class="overflow-auto" >
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Pertukaran IC</h5>
                        <table class="table table-borderless datatable mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Ref. No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Old IC No.</th>
                                    <th scope="col">New IC No.</th>
                                    <th scope="col">Jawatan</th>
                                    <th scope="col">Tarikh</th>
                                    <th scope="col">Catatan User</th>
                                    <th scope="col">Catatan Admin</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($resultsssmpertukaranic) == 0)
                                    <tr class="text-center">
                                        <td colspan="8">
                                            <h5>No records found</h5>
                                        </td>
                                    </tr>
                                @else
                                @foreach($resultsssmpertukaranic as $ssmpertukaranic)
                                    <tr>
                                        <td> PKP{{ $ssmpertukaranic->id }}</td>
                                        <td>{{ $ssmpertukaranic->pi_name }}</td>
                                        <td>{{ $ssmpertukaranic->pi_icno_old }}</td>
                                        <td>{{ $ssmpertukaranic->pi_icno_new }}</td>
                                        <td>{{ $ssmpertukaranic->pi_jawatan }}</td>
                                        <td>{{ $ssmpertukaranic->pi_created_at }}</td>
                                        <td style="text-align: justify">
                                            <div class="text-container catatanpia" data-record-id="{{ $ssmpertukaranic->id }}">
                                                @if (strlen($ssmpertukaranic->pi_catatanuser) > 25)
                                                    <div class="limited-text">
                                                        {{ Str::limit($ssmpertukaranic->pi_catatanuser, 25) }}
                                                    </div>
                                                    <div class="full-text" style="display: none;">
                                                        {{ $ssmpertukaranic->pi_catatanuser }}
                                                    </div>
                                                    <a href="#" class="read-more" style="color: rgb(42, 152, 156);">Read More</a>
                                                @else
                                                    <div class="full-text">
                                                        {{ $ssmpertukaranic->pi_catatanuser }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                // Add a click event listener to a common ancestor of "Read More" links
                                                document.querySelector('.catatanpia[data-record-id="{{ $ssmpertukaranic->id }}"]').addEventListener('click', function (event) {
                                                    // Check if the clicked element is a "Read More" link
                                                    if (event.target.classList.contains('read-more')) {
                                                        event.preventDefault();

                                                        // Find the parent container
                                                        const container = event.target.closest('.text-container');

                                                        // Toggle the display of the limited and full text based on data attribute
                                                        const limitedText = container.querySelector('.limited-text');
                                                        const fullText = container.querySelector('.full-text');

                                                        limitedText.style.display = limitedText.style.display === 'none' ? 'block' : 'none';
                                                        fullText.style.display = fullText.style.display === 'none' ? 'block' : 'none';

                                                        // Change the text and color of the link based on the current state
                                                        if (event.target.textContent === 'Read More') {
                                                            event.target.textContent = 'Read Less';
                                                            event.target.style.color = 'grey';
                                                        } else {
                                                            event.target.textContent = 'Read More';
                                                            event.target.style.color = 'rgb(42, 152, 156)';
                                                        }
                                                    }
                                                });
                                            });
                                        </script>
                                        <td style="text-align: justify">
                                            <div class="text-container catatanpi" data-record-id="{{ $ssmpertukaranic->id }}">
                                                @if (strlen($ssmpertukaranic->pi_catatanadmin) > 25)
                                                    <div class="limited-text">
                                                        {{ Str::limit($ssmpertukaranic->pi_catatanadmin, 25) }}
                                                    </div>
                                                    <div class="full-text" style="display: none;">
                                                        {{ $ssmpertukaranic->pi_catatanadmin }}
                                                    </div>
                                                    <a href="#" class="read-more" style="color: rgb(42, 152, 156);">Read More</a>
                                                @else
                                                    <div class="full-text">
                                                        {{ $ssmpertukaranic->pi_catatanadmin }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                // Add a click event listener to a common ancestor of "Read More" links
                                                document.querySelector('.catatanpi[data-record-id="{{ $ssmpertukaranic->id }}"]').addEventListener('click', function (event) {
                                                    // Check if the clicked element is a "Read More" link
                                                    if (event.target.classList.contains('read-more')) {
                                                        event.preventDefault();

                                                        // Find the parent container
                                                        const container = event.target.closest('.text-container');

                                                        // Toggle the display of the limited and full text based on data attribute
                                                        const limitedText = container.querySelector('.limited-text');
                                                        const fullText = container.querySelector('.full-text');

                                                        limitedText.style.display = limitedText.style.display === 'none' ? 'block' : 'none';
                                                        fullText.style.display = fullText.style.display === 'none' ? 'block' : 'none';

                                                        // Change the text and color of the link based on the current state
                                                        if (event.target.textContent === 'Read More') {
                                                            event.target.textContent = 'Read Less';
                                                            event.target.style.color = 'grey';
                                                        } else {
                                                            event.target.textContent = 'Read More';
                                                            event.target.style.color = 'rgb(42, 152, 156)';
                                                        }
                                                    }
                                                });
                                            });
                                        </script>
                                        <td>
                                            @if($ssmpertukaranic->pi_status == null)
                                                <span class="badge rounded-pill bg-danger">Aduan Diterima</span>
                                            @elseif($ssmpertukaranic->pi_status=="Dihadapkan ke HD")
                                                <span class="badge rounded-pill bg-primary">Dihadapkan ke HD</span>
                                            @elseif($ssmpertukaranic->pi_status=="Selesai")
                                                <span class="badge rounded-pill bg-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                                <!----Edit Button----->
                                                <form method="get" action="{{ route('ssmrequests.ssmrequest.editadminpertukaranic', $ssmpertukaranic->id ) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                </form>
                                                <!----Destroy Button----->
                                                <form method="post" action="{{ route('ssmrequests.ssmrequest.destroypertukaranic', $ssmpertukaranic->id ) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <a onclick='return confirm("Confirm to delete data?")'>
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $resultsssmpertukaranic->links() }} <!-- Display pagination links -->

                    </div>
                </div>
                <!-- Others tab -->
                <div class="tab-pane fade ssm-others pt-2" id="ssm-others">
                    <div class="overflow-auto" >
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Others</h5>
                        <table class="table table-borderless datatable mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Ref. No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">IC No.</th>
                                    <th scope="col">Jawatan</th>
                                    <th scope="col">No.Tel</th>
                                    <th scope="col">Tarikh</th>
                                    <th scope="col">Catatan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($resultsssmother) == 0)
                                    <tr class="text-center">
                                        <td colspan="8">
                                            <h5>No records found</h5>
                                        </td>
                                    </tr>
                                @else
                                @foreach($resultsssmother as $ssmother)
                                    <tr>
                                        <td> LL{{ $ssmother->id }}</td>
                                        <td>{{ $ssmother->ot_name }}</td>
                                        <td>{{ $ssmother->ot_icno }}</td>
                                        <td>{{ $ssmother->ot_jawatan }}</td>
                                        <td>{{ $ssmother->ot_notel }}</td>
                                        <td>{{ $ssmother->ot_created_at }}</td>
                                        <td style="text-align: justify">
                                            <div class="text-container catatanot" data-record-id="{{ $ssmother->id }}">
                                                @if (strlen($ssmother->ot_catatan) > 25)
                                                    <div class="limited-text">
                                                        {{ Str::limit($ssmother->ot_catatan, 25) }}
                                                    </div>
                                                    <div class="full-text" style="display: none;">
                                                        {{ $ssmother->ot_catatan }}
                                                    </div>
                                                    <a href="#" class="read-more" style="color: rgb(42, 152, 156);">Read More</a>
                                                @else
                                                    <div class="full-text">
                                                        {{ $ssmother->ot_catatan }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                // Add a click event listener to a common ancestor of "Read More" links
                                                document.querySelector('.catatanot[data-record-id="{{ $ssmother->id }}"]').addEventListener('click', function (event) {
                                                    // Check if the clicked element is a "Read More" link
                                                    if (event.target.classList.contains('read-more')) {
                                                        event.preventDefault();

                                                        // Find the parent container
                                                        const container = event.target.closest('.text-container');

                                                        // Toggle the display of the limited and full text based on data attribute
                                                        const limitedText = container.querySelector('.limited-text');
                                                        const fullText = container.querySelector('.full-text');

                                                        limitedText.style.display = limitedText.style.display === 'none' ? 'block' : 'none';
                                                        fullText.style.display = fullText.style.display === 'none' ? 'block' : 'none';

                                                        // Change the text and color of the link based on the current state
                                                        if (event.target.textContent === 'Read More') {
                                                            event.target.textContent = 'Read Less';
                                                            event.target.style.color = 'grey';
                                                        } else {
                                                            event.target.textContent = 'Read More';
                                                            event.target.style.color = 'rgb(42, 152, 156)';
                                                        }
                                                    }
                                                });
                                            });
                                        </script>
                                        <td>
                                            @if($ssmother->ot_status == null)
                                                <span class="badge rounded-pill bg-danger">Aduan Diterima</span>
                                            @elseif($ssmother->ot_status=="Sedang Dikemaskini / Diteliti")
                                                <span class="badge rounded-pill bg-warning">Sedang Dikemaskini / Diteliti</span>
                                            @elseif($ssmother->ot_status=="Dihadapkan ke Dynamik")
                                                <span class="badge rounded-pill bg-primary">Dihadapkan ke Dynamik</span>
                                            @elseif($ssmother->ot_status=="Selesai")
                                                <span class="badge rounded-pill bg-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                                <!----Edit Button----->
                                                <form method="get" action="{{ route('ssmrequests.ssmrequest.editadminother', $ssmother->id ) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                </form>
                                                <!----Destroy Button----->
                                                <form method="post" action="{{ route('ssmrequests.ssmrequest.destroyother', $ssmother->id ) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <a onclick='return confirm("Confirm to delete data?")'>
                                                        <button type="submit" class="btn btn-outline-danger">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $resultsssmother->links() }} <!-- Display pagination links -->
                    </div>
                </div>
            </div>
            <!-- Tab Ends -->
        </div>
    </div>
</section>
@endsection
