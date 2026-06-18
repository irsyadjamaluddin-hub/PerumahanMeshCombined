@extends('layouts.app-all')

@section('title', 'Inventory Index')

@section('content')

<?php
    $pagename = "Cddinventory";
?>

<div class="pagetitle">
  <h1>Book List</h1>
  <nav>
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Inventory</li>  
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">

    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class="fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif

    <div class="col-12 mb-2 mt-2 text-end">
        <a href="{{ route('cddinventory.cddinventory.createbooksubject') }}" class="btn btn-primary" title="Tambah Subjek">
            <i class="bi bi-file-plus"></i>
        </a>
        <a href="{{ route('cddinventory.cddinventory.createbook') }}" class="btn btn-primary" title="Tambah Buku">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    <div class="col-md-12">
        <div class="col-12">
            <div class="card recent-sales">

                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">               
                    <li class="nav-item">
                        <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#Menengah">Menengah</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#Rendah">Rendah</button>
                    </li>
                </ul>  
                <!-- Close Bordered Tabs -->

                <div class="tab-content pt-2">
                    <!-- Menengah Tab -->
                    <div class="tab-pane fade show active tindakan" id="Menengah">
                        <div class="card-body overflow-auto">
                            <h5 class="card-title text-center text-white p-2" style="background-color: #1F4E78;">Menengah</h5>
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>  
                                        <th scope="col">Subjek</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Pengarang</th>
                                        <th scope="col">ISBN</th>
                                        <th scope="col">Peringkat</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Catatan</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>                            
                                    @forelse($inventorybookmenengahs as $inventorybookmenengah)
                                    <tr>
                                        <td>{{ $inventorybookmenengah->subjek ?? '-' }}</td>
                                        <td>{{ $inventorybookmenengah->judul ?? '-' }}</td>
                                        <td>{{ $inventorybookmenengah->pengarang ?? '-' }}</td>
                                        <td>{{ $inventorybookmenengah->isbn ?? '-' }}</td>
                                        <td>{{ $inventorybookmenengah->peringkat ?? '-' }}</td>
                                        <td>{{ $inventorybookmenengah->status ?? '-' }}</td>
                                        <td>
                                            @if($inventorybookmenengah->catatan == "ACTIVE" || $inventorybookmenengah->catatan == "Aktif") 
                                                <span class="badge bg-success">Aktif</span>
                                            @elseif ($inventorybookmenengah->catatan == "NON-ACTIVE" || $inventorybookmenengah->catatan == "Tidak Aktif") 
                                                <span class="badge bg-primary">Tidak Aktif</span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group gap-2" role="group">
                                                <!-- Edit -->
                                                <form method="get" action="{{ route('cddinventory.cddinventory.editbook', $inventorybookmenengah->id ) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                </form>
                                                <!-- Delete -->
                                                <form id="deleteForm{{$inventorybookmenengah->id}}" method="post" action="{{ route('cddinventory.cddinventory.destroybook', $inventorybookmenengah->id) }}" style="margin-bottom:0px;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-outline-danger" onclick="showDeleteConfirmationApproval({{ $inventorybookmenengah->id }})">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal" id="deleteConfirmationModalApproval{{ $inventorybookmenengah->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Deletion</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval({{ $inventorybookmenengah->id }})"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this record?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $inventorybookmenengah->id }}')">Delete</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $inventorybookmenengah->id }})">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="8"><h5>No records found</h5></td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end Menengah Tab -->

                    <!-- Rendah Tab -->
                    <div class="tab-pane fade show tindakan" id="Rendah">
                        <div class="card-body overflow-auto">
                            <h5 class="card-title text-center text-white p-2" style="background-color: #1F4E78;">Rendah</h5>
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>        
                                        <th scope="col">Subjek</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Pengarang</th>
                                        <th scope="col">ISBN</th>
                                        <th scope="col">Peringkat</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Catatan</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    @forelse($inventorybookrendahs as $inventorybookrendah)
                                    <tr>
                                        <td>{{ $inventorybookrendah->subjek ?? '-' }}</td>
                                        <td>{{ $inventorybookrendah->judul ?? '-' }}</td>
                                        <td>{{ $inventorybookrendah->pengarang ?? '-' }}</td>
                                        <td>{{ $inventorybookrendah->isbn ?? '-' }}</td> 
                                        <td>{{ $inventorybookrendah->peringkat ?? '-' }}</td>
                                        <td>{{ $inventorybookrendah->status ?? '-' }}</td> 
                                        <td>
                                            @if($inventorybookrendah->catatan == "ACTIVE" || $inventorybookrendah->catatan == "Aktif") 
                                                <span class="badge bg-success">Aktif</span>
                                            @elseif ($inventorybookrendah->catatan == "NON-ACTIVE" || $inventorybookrendah->catatan == "Tidak Aktif") 
                                                <span class="badge bg-primary">Tidak Aktif</span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group gap-2" role="group">
                                                <!-- Edit -->
                                                <form method="get" action="{{ route('cddinventory.cddinventory.editbook', $inventorybookrendah->id ) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                </form>
                                                <!-- Delete -->
                                                <form id="deleteForm{{$inventorybookrendah->id}}" method="post" action="{{ route('cddinventory.cddinventory.destroybook', $inventorybookrendah->id) }}" style="margin-bottom:0px;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-outline-danger" onclick="showDeleteConfirmationApproval({{ $inventorybookrendah->id }})">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal" id="deleteConfirmationModalApproval{{ $inventorybookrendah->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Deletion</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval({{ $inventorybookrendah->id }})"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this record?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $inventorybookrendah->id }}')">Delete</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $inventorybookrendah->id }})">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="8"><h5>No records found</h5></td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>        
                        </div>
                    </div>
                    <!-- end Rendah Tab -->

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Delete Modal Scripts -->
<script>
function showDeleteConfirmationApproval(id) {
    var modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModalApproval' + id));
    modal.show();
}

function hideDeleteConfirmationApproval(id) {
    var modal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmationModalApproval' + id));
    modal.hide();
}

function deleteRecordApproval(formId) {
    document.getElementById(formId).submit();
}
</script>

@endsection
