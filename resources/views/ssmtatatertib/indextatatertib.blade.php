@extends('layouts.app-all')

@section('title', 'SSM Tatatertib Admin')

@section('content')

<?php
$pagename = "SSM Tatatertib Admin";
?>

<div class="pagetitle">
    <h1>SSM Tatatertib Admin</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">SSM Tatatertib Admin</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <div class="col-md-12">

        @if(Session::has('success_message'))
        <div class="alert alert-success">
            <i class="fas fa-fw fa-check"></i>
            {!! session('success_message') !!}
        </div>
        @endif

        <!-- Tatatertib Table -->
        <div class="row mb-2">   
            <div class="col-md-10">
                <a href="{{ route('ssmtatatertib.ssmrequest.createtatatertib') }}" class="btn btn-primary text-right" style="height: 2.39rem; padding-top: 8px;">
                    <i class="bi bi-plus-lg"></i>
                </a>
            </div>  
        </div>

        <div class="col-12">
            <div class="card recent-sales">
                <div class="card-body overflow-auto">
                    <br>
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Tatatertib</h5>           
                      <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">IC. No </th>
                                <th scope="col">Surat Rujukan </th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(empty($ssmtatatertib))
                                <tr class="text-center">
                                    <td colspan="8">
                                        <h5>No records found</h5>
                                    </td>
                                </tr>
                            @else
                                @foreach($ssmtatatertib as $ssmtatatertib)
                                    <tr> 
                                        <!-- <td>TT {{$ssmtatatertib->id}}</td> -->
                                        <td>{{ $ssmtatatertib->tt_name }}</td>
                                        <td>
                                            @if(is_array($ssmtatatertib->tt_icno))
                                                {{ implode(', ', $ssmtatatertib->tt_icno) }}
                                            @else
                                                {{ $ssmtatatertib->tt_icno }}
                                            @endif
                                        </td>
                                        <td>{{ $ssmtatatertib->tt_surat_rujukan }}</td>
                                        <td>
                                            <div class="col-sm-2">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#catatanModal_{{$ssmtatatertib->id}}"> <i class="bi bi-file-text-fill"></i></button>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="catatanModal_{{$ssmtatatertib->id}}" tabindex="-1" role="dialog" aria-labelledby="catatanModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document"> 
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="catatanModalLabel">Catatan Information</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr class="text-center">
                                                                        <th>No. Rujukan</th>
                                                                        <th>Catatan</th>
                                                                        <th>Tarikh</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($catatanEntries->where('tt_id', $ssmtatatertib->id) as $catatan)
                                                                    <tr>
                                                                    <td style="padding-left:5%;">TT{{ $catatan->tt_no_catatan }}</td>
                                                                        <td style="width: 50%; text-align: justify">
                                                                            <div class="text-container catatan" data-record-id="{{ $ssmtatatertib->id }}">
                                                                                @if (strlen($catatan->tt_catatan) > 100)
                                                                                    <div class="limited-text">
                                                                                        {{ Str::limit($catatan->tt_catatan, 100) }}
                                                                                    </div>
                                                                                    <div class="full-text" style="display: none;">
                                                                                        {{ $catatan->tt_catatan }}
                                                                                    </div>
                                                                                    <a href="#" class="read-more" style="color: rgb(42, 152, 156);">Read More</a>
                                                                                @else
                                                                                    <div class="full-text">
                                                                                        {{ $catatan->tt_catatan }}
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            @if ($catatan->tt_catatan_date)
                                                                                {{ date('d/m/y h:i A', strtotime($catatan->tt_catatan_date)) }}
                                                                            @else
                                                                                {{ date('d/m/y h:i A', strtotime($catatan->catatan_created_at)) }}
                                                                            @endif
                                                                        </td>
                                                                        <!-- <td>{{ date('d/m/y h:i A', strtotime($catatan->catatan_updated_at)) }}</td> -->
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($ssmtatatertib->status == 'selesai')
                                                <span class="badge rounded-pill bg-success">Selesai</span>
                                            @elseif ($ssmtatatertib->status == 'dikemaskini/diteliti')
                                                <span class="badge rounded-pill bg-danger">Sedang Dikemaskini/Diteliti</span>
                                            @else
                                                <span class="badge rounded-pill bg-warning">Untuk Tindakan</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                                <!----Edit Button----->
                                                <form method="get" action="{{ route('ssmtatatertib.ssmrequest.editadmintatatertib', $ssmtatatertib->id ) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                </form>
                                                <!----Delete Button----->
                                                <form id="deleteForm{{$ssmtatatertib->id}}" method="post" action="{{ route('ssmtatatertib.ssmrequest.destroytatatertib', $ssmtatatertib->id) }}" style="margin-bottom:0px;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" onclick="showDeleteConfirmationApproval({{ $ssmtatatertib->id }})">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>

                                                <!-- Created At Button -->
                                                <button type="button" class="btn btn-outline-primary" style="border-radius: 5px; margin-left: -15px" onclick="showCreatedAt('{{ $ssmtatatertib->created_at }}')">
                                                    <i class="bi bi-clock-history"></i>
                                                </button>

                                                  <!-- Created At Modal -->
                                                  <div class="modal" id="createdAtModal{{ $ssmtatatertib->id }}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Created At</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeCreatedAtModal('{{ $ssmtatatertib->id }}')">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form>
                                                                    <div class="form-group row">
                                                                        <label for="createdAtInput{{ $ssmtatatertib->id }}" class="col-sm-4 col-form-label">Date and Time Created:</label>
                                                                        <div class="col-sm-8">
                                                                        <input type="text" class="form-control" id="createdAtInput{{ $ssmtatatertib->id }}" value="{{ \Carbon\Carbon::parse($ssmtatatertib->created_at)->format('d/m/y h:i A') }}" readonly>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Created At script -->
                                                <script>
                                                    function showCreatedAt(createdAt) {
                                                        var createdAtInput = document.getElementById('createdAtInput{{ $ssmtatatertib->id }}');
                                                        var modal = $('#createdAtModal{{ $ssmtatatertib->id }}');

                                                        var formattedDate = new Date(createdAt);
                                                        var options = { 
                                                            day: '2-digit', 
                                                            month: '2-digit', 
                                                            year: '2-digit', 
                                                            hour: '2-digit', 
                                                            minute: '2-digit',
                                                            hour12: true,
                                                            hourCycle: 'h23'
                                                        };
                                                        var formattedDateString = formattedDate.toLocaleString('en-GB', options);

                                                        createdAtInput.value = formattedDateString;
                                                        modal.modal('show');
                                                        
                                                        modal.on('hidden.bs.modal', function () {
                                                            createdAtInput.value = '';
                                                        });
                                                    }

                                                    function closeCreatedAtModal(id) {
                                                        $('#createdAtModal' + id).modal('hide');
                                                    }
                                                </script>

                                                <!-- Add a modal for confirmation -->
                                                <div class="modal" id="deleteConfirmationModalApproval{{ $ssmtatatertib->id }}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Confirm Deletion</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval({{ $ssmtatatertib->id }})">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this record?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $ssmtatatertib->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $ssmtatatertib->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <script>
                                                    function showDeleteConfirmationApproval(id) {
                                                        $('#deleteConfirmationModalApproval' + id).modal('show');
                                                    }
                            
                                                    function hideDeleteConfirmationApproval(id) {
                                                        $('#deleteConfirmationModalApproval' + id).modal('hide');
                                                    }
                            
                                                    function deleteRecordApproval(formId) {
                                                        $('#' + formId).submit();
                                                    }
                                                </script>
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
        <!-- End Tatatertib Table -->
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.modal-body .catatan .read-more').forEach(function (readMoreLink) {
            readMoreLink.addEventListener('click', function (event) {
                event.preventDefault();
                const container = readMoreLink.closest('.text-container');
                const limitedText = container.querySelector('.limited-text');
                const fullText = container.querySelector('.full-text');

                limitedText.style.display = limitedText.style.display === 'none' ? 'block' : 'none';
                fullText.style.display = fullText.style.display === 'none' ? 'block' : 'none';

                if (readMoreLink.textContent === 'Read More') {
                    readMoreLink.textContent = 'Read Less';
                    readMoreLink.style.color = 'grey';
                } else {
                    readMoreLink.textContent = 'Read More';
                    readMoreLink.style.color = 'rgb(42, 152, 156)';
                }
            });
        });
    });
</script>

<script>
    function confirmDelete(formId) {
        var result = confirm("Are you sure you want to delete this item?");
        if (result) {
            document.getElementById(formId).submit();
        } else {
        }
    }
</script>

@endsection
