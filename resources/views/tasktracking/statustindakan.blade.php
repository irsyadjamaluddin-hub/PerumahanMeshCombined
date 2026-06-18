@extends('layouts.app-all')

@section('title', 'Task Tracking Status/Tindakan')

@section('content')

<?php
$pagename = "TaskTracking";
?>

<div class="pagetitle">
<h1>Status/Tindakan Index</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item"><a href="{{ route('tasktracking.indextasktracking') }}">Task Tracking (MEC)</a></li>
            <li class="breadcrumb-item active">Status/Tindakan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

@if(Session::has('success_message'))
<div class="alert alert-success">
    <i class=" fas fa-fw fa-check"></i>
    {!! session('success_message') !!}
</div>
@endif

<!----- Back out Button  ----->
<div class="col-md-1 text-left">
    <a href="{{  route('tasktracking.indextasktracking') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 7px;">
        <i class="bi bi-arrow-left-circle"></i>
    </a>
</div>

<section class="section profile">

<div class="col-12">
    <div class="card recent-sales">

        <!-- Bordered Tabs -->
        <ul class="nav nav-tabs nav-tabs-bordered">
            <li class="nav-item">
                <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#status">Status</button>
            </li>

            <li class="nav-item">
                <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#tindakan">Tindakan</button>
            </li>
        </ul>
        <!-- Close Bordered Tabs -->

        <div class ="tab-content pt-2">
            <!-- first tab -->
            <div class="tab-pane fade show active status" id="status">
                <div class="card-body">
                    <div class="profile-overview pt-3">
                        <h5 class="card-title">Status Baru</h5>
                        <form class="" method="post" action="{{ route('tasktracking.storestatus') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3" style="margin-left: 0px;">
                                <label class="col-lg-1 col-form-label" style="width: 10rem;">Status:</label>
                                <div class="col-lg-3">
                                    <input type="text" name="text" class="form-control" placeholder="Nama Status" required>
                                    <input type="text" name="nama_id" class="form-control" value="Status" hidden>
                                </div>
                                @php
                                    $colours = [
                                        'Kuning' => 'btn-warning',
                                        'Biru Terang' => 'btn-info',
                                        'Biru' => 'btn-primary',
                                        'Merah' => 'btn-danger',
                                        'Hijau' => 'btn-success'
                                    ];
                                @endphp

                                <div class="col-lg-3">
                                    <select name="nama_id_colour" class="form-control" style="color: #757b80;" required>
                                        <option value="" disabled selected hidden>Satu Warna per Status</option>
                                        @foreach($colours as $colour => $class)
                                            @if(!in_array($colour, $existingColours))
                                                <option value="{{ $colour }}" class="{{ $class }}">{{ $colour }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-outline-success" >
                                    Add
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="card-body overflow-auto">
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($statuss) == null)
                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($statuss as $status)
                                        <tr>
                                            <td>
                                                @if($status->nama_id_colour == "Kuning")
                                                    <span class="badge rounded-pill bg-warning">{{ $status->text }}</span>
                                                @elseif ($status->nama_id_colour == "Biru Terang")
                                                    <span class="badge rounded-pill bg-info">{{ $status->text }}</span>
                                                @elseif ($status->nama_id_colour == "Biru")
                                                    <span class="badge rounded-pill bg-primary">{{ $status->text }}</span>
                                                @elseif ($status->nama_id_colour == "Merah")
                                                    <span class="badge rounded-pill bg-danger">{{ $status->text }}</span>
                                                @elseif ($status->nama_id_colour == "Hijau")
                                                    <span class="badge rounded-pill bg-success">{{ $status->text }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $status->created_by }}</td>
                                            <td>{{ $status->created_at }}</td>
                                            <td>
                                                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                                    <!----Edit Button----->
                                                    <form method="get" action="{{ route('tasktracking.editstatus', $status->id ) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-primary">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </button>
                                                    </form>
                                                    <!----Delete Button----->
                                                    <form id="deleteForm{{$status->id}}" method="post" action="{{ route('tasktracking.destroystatus', $status->id) }}" style="margin-bottom:0px;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" onclick="showDeleteConfirmationApprovalStatus({{ $status->id }})">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>

                                                    <!-- Add a modal for confirmation -->
                                                    <div class="modal" id="deleteConfirmationModalApprovalStatus{{ $status->id }}" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Confirm Deletion</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApprovalStatus({{ $status->id }})">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete this record?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger" onclick="deleteRecordApprovalStatus('deleteForm{{ $status->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApprovalStatus({{ $status->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        function showDeleteConfirmationApprovalStatus(id) {
                                                            $('#deleteConfirmationModalApprovalStatus' + id).modal('show');
                                                        }

                                                        function hideDeleteConfirmationApprovalStatus(id) {
                                                            $('#deleteConfirmationModalApprovalStatus' + id).modal('hide');
                                                        }

                                                        function deleteRecordApprovalStatus(formId) {
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
            </div>
            <!-- second tab -->
            <div class="tab-pane fade tindakan" id="tindakan">
                <div class="card-body">
                    <div class="profile-overview pt-3">
                        <h5 class="card-title">Tindakan Baru</h5>
                        <form class="" method="post" action="{{ route('tasktracking.storetindakan') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3" style="margin-left: 0px;">
                                <label class="col-lg-1 col-form-label" style="width: 10rem;">Tindakan:</label>
                                <div class="col-lg-6">
                                    <input type="text" name="text" class="form-control" placeholder="Nama Tindakan" required>
                                    <input type="text" name="nama_id" class="form-control" value="Tindakan" hidden>
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-outline-success" >
                                    Add
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="card-body overflow-auto">
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Tindakan</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($tindakans) == null)
                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($tindakans as $tindakan)
                                        <tr>
                                            <td>{{ $tindakan->text }}</td>
                                            <td>{{ $tindakan->created_by }}</td>
                                            <td>{{ $tindakan->created_at }}</td>
                                            <td>
                                                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                                    <!----Edit Button----->
                                                    <form method="get" action="{{ route('tasktracking.edittindakan', $tindakan->id ) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-primary">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </button>
                                                    </form>
                                                    <!----Delete Button----->
                                                    <form id="deleteForm{{$tindakan->id}}" method="post" action="{{ route('tasktracking.destroytindakan', $tindakan->id) }}" style="margin-bottom:0px;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" onclick="showDeleteConfirmationApprovalTindakan({{ $tindakan->id }})">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>

                                                    <!-- Add a modal for confirmation -->
                                                    <div class="modal" id="deleteConfirmationModalApprovalTindakan{{ $tindakan->id }}" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Confirm Deletion</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApprovalTindakan({{ $tindakan->id }})">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete this record?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger" onclick="deleteRecordApprovalTindakan('deleteForm{{ $tindakan->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApprovalTindakan({{ $tindakan->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        function showDeleteConfirmationApprovalTindakan(id) {
                                                            $('#deleteConfirmationModalApprovalTindakan' + id).modal('show');
                                                        }

                                                        function hideDeleteConfirmationApprovalTindakan(id) {
                                                            $('#deleteConfirmationModalApprovalTindakan' + id).modal('hide');
                                                        }

                                                        function deleteRecordApprovalTindakan(formId) {
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
            </div>
        </div>
    </div>
</div>

</section>
@endsection

