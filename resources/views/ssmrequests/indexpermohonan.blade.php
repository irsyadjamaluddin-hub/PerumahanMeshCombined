@extends('layouts.app-all')

@section('title', 'SSM Request Permohonan')

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" sections; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
<div class="mesh-home-theme">
{{-- #================================ --}}


<?php
$pagename = "SSM Permohonan";
?>

<div class="pagetitle">
    <h1>SSM Request Permohonan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">SSM Request Permohonan</li>
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

        <!-- Permohonan Table -->
        <div class="row mb-2">   
            <div class="col-md-10">
                <a href="{{ route('ssmrequests.ssmrequest.createpermohonan') }}" class="btn btn-primary text-right" style="height: 2.39rem; padding-top: 10px;">
                    <i class="bi bi-plus-lg"></i>
                </a>
            </div>  
            <div class="col-md-2" style="text-align:center;">
                <a href="{{ route('ssmrequests.ssmrequest.indexjenispermohonan') }}" class="btn btn-primary" style="height: 2.39rem; padding-top: 10px;">
                    <i class="bi bi-file-plus"></i>
                </a>
                <a href="{{ route('ssmrequests.ssmrequest.ssmkod') }}" class="btn btn-primary">
                    <i class="ri-user-add-fill"></i>
                </a>
                @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
                <a href="{{ route('ssmrequests.ssmrequest.indexstafftasks') }}" class="btn btn-primary" style="height: 2.39rem; padding-top: 10px;">
                    <i class="bi bi-card-list"></i>
                </a>
                @endif
            </div>
        </div>


        <div class="col-12">
            <div class="card recent-sales">
                <div class="card-body overflow-auto">
                    <br>
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Permohonan</h5>           
                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Ref. No.</th> 
                                <th scope="col">Jabatan/Sekolah</th>
                                <th scope="col">Jenis Permohonan</th>
                                <th scope="col">Tarikh Permohonan</th>
                                <th scope="col">IC No. Pemohon</th>
                                <th scope="col" class="border-start" style="text-align: center;">Staff</th>
                                <th scope="col" style="text-align: center;">Status Admin</th>
                                <th scope="col" class="border-end" style="text-align: center;">Despatch</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if(isset($ssmpermohonan) == 0)
                            <tr class="text-center">
                                <td colspan="8">
                                <h5>No records found</h5>
                                </td>
                            </tr>
                        @else
                        @foreach($ssmpermohonan as $ssmpermohonan)
                        <tr> 
                            <td>PM {{$ssmpermohonan->id}}</td>
                            <td>{{ $ssmpermohonan->permohonan_dept }}</td>
                            <td>{{ $ssmpermohonan->permohonan_type }}</td>
                            <td>{{ $ssmpermohonan->permohonan_date }}</td>
                            <td>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusInfoModal_{{$ssmpermohonan->id}}"> <i class="bi bi-file-text-fill"></i></button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="statusInfoModal_{{$ssmpermohonan->id}}" tabindex="-1" role="dialog" aria-labelledby="statusInfoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" style="max-width: 50%;" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="statusInfoModalLabel">Status Information</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th>ICNo. Pemohon</th>
                                                            <th>Kod</th>
                                                            <th>Status</th>
                                                            <th>Kiv Catatan</th>
                                                            <th>Submitted At</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($ssmpermohonanicno[$ssmpermohonan->id] as $icnoRecord)
                                                        <tr>
                                                            <td>{{ $icnoRecord->icno_pemohon }}</td>
                                                            <td>{{ optional($icnoRecord->ssmkodindex)->kod }}</td>                                                               
                                                            @if($icnoRecord->status == null)
                                                                <td><span class="badge rounded-pill bg-danger">Untuk Tindakan</span></td>
                                                                @elseif($icnoRecord->status=="Dalam Proses")
                                                                <td><span class="badge rounded-pill bg-warning">Dalam Proses</span></td>
                                                                @elseif($icnoRecord->status=="kiv")
                                                                <td><span class="badge rounded-pill bg-primary">kiv</span></td>
                                                                @elseif($icnoRecord->status =="selesai")
                                                                <td><span class="badge rounded-pill bg-success">Selesai</span></td>
                                                            @endif
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
                                                            <script>
                                                                document.addEventListener('DOMContentLoaded', function () {
                                                                    // Add a click event listener to a common ancestor of "Read More" links
                                                                    document.querySelector('.catatan[data-record-id="{{ $icnoRecord->id }}"]').addEventListener('click', function (event) {
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
                                                            <td>{{ $icnoRecord->submitted_at }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: #fff; background-color: #6c757d; border-color: #6c757d;">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="border-start" style="width: 10.5265%; text-align: center;">
                                @php
                                    $allSelesai = true;
                                    $allNull = true;
                                    $hasKivStatus = false;
                                    $hasDalamProsesStatus = false;
                                @endphp
                                
                                @foreach($ssmpermohonanicno[$ssmpermohonan->id] as $icnoRecord)
                                    @if($icnoRecord->status != "selesai")
                                        @php
                                            $allSelesai = false;
                                        @endphp
                                    @endif
                                
                                    @if($icnoRecord->status != null)
                                        @php
                                            $allNull = false;
                                        @endphp
                                    @endif
                                
                                    @if($icnoRecord->status == "kiv")
                                        @php
                                            $hasKivStatus = true;
                                        @endphp
                                    @endif
                                
                                    @if($icnoRecord->status == "Dalam Proses")
                                        @php
                                            $hasDalamProsesStatus = true;
                                        @endphp
                                    @endif
                                @endforeach
                                
                                @if($allSelesai)
                                    <i class="bi bi-clipboard2-check" style="color: rgb(25, 135, 84); font-size:25px;" title="Selesai"></i>
                                    {{-- <span class="badge rounded-pill bg-success">Selesai</span> --}}
                                @elseif($allNull)
                                    <span class="badge rounded-pill bg-danger">Untuk Tindakan</span>
                                @elseif($hasKivStatus && !$hasDalamProsesStatus)
                                    <span class="badge rounded-pill bg-primary">Kiv</span>
                                @else
                                    <span class="badge rounded-pill bg-warning">Dalam Proses</span>
                                @endif  
                            </td>
                            <td style="width: 7.69858%; text-align: center;">
                                @if($ssmpermohonan->permohonan_status == "selesai")
                                    <i class="bi bi-person-check" style="color: rgb(25, 135, 84); font-size:25px;" title="Selesai"></i>
                                    {{-- <span class="badge rounded-pill bg-success">Selesai</span> --}}
                                @elseif($ssmpermohonan->permohonan_status == "kiv")
                                    <span class="badge rounded-pill bg-primary">Kiv</span>
                                @else
                                @endif
                            </td>
                            <td class="border-end" style="width: 10%; text-align: center;">
                                @if($ssmpermohonan->dispatch_status == "selesai")
                                    <i class="bi bi-check2-all" style="color: rgb(25, 135, 84); font-size:25px;" title="Selesai"></i>
                                    {{-- <span class="badge rounded-pill bg-success">Selesai</span> --}}
                                @endif
                            </td>
                            <td>
                                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                <!----Edit Button----->
                                <form method="get" action="{{ route('ssmrequests.ssmrequest.editadminpermohonan', $ssmpermohonan->id ) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary">
                                    <i class="bi bi-pencil-fill"></i>
                                    </button>
                                </form>
                                <!----Delete Button----->
                                <form id="deleteForm{{$ssmpermohonan->id}}" method="post" action="{{ route('ssmrequests.ssmrequest.destroypermohonan', $ssmpermohonan->id) }}" style="margin-bottom:0px;">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" onclick="confirmDelete('deleteForm{{$ssmpermohonan->id}}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

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
{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
    @endsection

    <script>
        function confirmDelete(formId) {
            var result = confirm("Are you sure you want to delete this item?");
            if (result) {
                // User confirmed, submit the form with the specified id
                document.getElementById(formId).submit();
            } else {
                // User cancelled, do nothing
            }
        }
      </script>