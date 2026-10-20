@extends('layouts.app-all')

@section('title', 'File Storage Management')

@section('content')

<?php
$pagename = "fsm";
?>

<style>

</style>

{{-- #========== NEWLY ADDED ============ --}}
{{-- Wrapper so this page's dark mode styles stay on this page (closed just before @endsection). --}}
{{-- Dark mode in the Home page theme (Oct 2026), same design as linkup/index and ssms/index: deep purple cards --}}
{{-- with violet borders, gold active tab, purple title bars with gold text, lavender table headings, violet "+" --}}
{{-- button, gold edit / lavender access buttons. Covers both tabs (Shared Folders comes from fsm/sharedfolder). --}}
{{-- Only applies when the sun/moon switch is on dark; light mode is unchanged. --}}
<div class="mesh-fsm-page">
<style>
  /* Breadcrumb: no light grey bar in dark mode, current page in gold */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .breadcrumb { background: transparent; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .breadcrumb .breadcrumb-item.active { color: #f3c35f; }

  /* "+" (new folder) button */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .btn-primary {
    background-color: #6d4bc4 !important; border-color: #6d4bc4; color: #ffffff;
  }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .btn-primary:hover { background-color: #7c5cdb !important; border-color: #7c5cdb; }

  /* User-Created Folders / Shared Folders tabs (sit in an .alert box) */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .alert-secondary {
    background: #1c1340 !important; border: 1px solid #3a2768 !important; border-radius: 10px;
  }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .nav-tabs { border-bottom-color: #3a2768; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .nav-tabs .nav-link { color: #9aa2bd; background: transparent; border-color: transparent; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .nav-tabs .nav-link:hover { color: #e8eaf4; border-color: transparent; }
  /* #============= ORI CODE ============== */
  /* html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .nav-tabs .nav-link.active {
    color: #f3c35f; background: #2a1d5c; border-color: #3a2768 #3a2768 transparent;
  } */
  /* #================================ */
  /* Selected tab: a lighter purple than the tab box so it stands out (never white) */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .nav-tabs .nav-link.active {
    color: #f3c35f; background: #3d2c7d !important; border-color: #5b44a8 #5b44a8 transparent;
  }
  /* #================================ */

  /* Cards */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .card {
    background: #1c1340; border: 1px solid #3a2768;
    box-shadow: 0 1px 2px rgba(0,0,0,.3), 0 8px 24px rgba(0,0,0,.35);
  }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .card-title[style] {
    background-color: #2a1d5c !important; color: #f3c35f !important; border-radius: 10px !important; letter-spacing: .02em;
  }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page hr { border-top-color: #3a2768; opacity: 1; }

  /* Tables ("entries per page", "Search...", "Showing 1 to 1 of 1 entries") */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .table th { color: #c4b5fd; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .table th,
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .table td { border-bottom: 1px solid #3a2768; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .dataTable-input,
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .dataTable-selector {
    background-color: #140d30; border-color: #3a2768; color: #e8eaf4;
  }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .dataTable-top,
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .dataTable-bottom,
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .dataTable-table > thead > tr > th { border-color: #3a2768; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .dataTable-info { color: #9aa2bd; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .dataTable-pagination .active a { background-color: #6d4bc4; color: #ffffff; }

  /* Row buttons: edit, grant access and view users gold, delete red */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .btn-outline-primary { border-color: #f3c35f; color: #f3c35f; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .btn-outline-primary:hover { background-color: #f3c35f; color: #1c1340; }
  /* #============= ORI CODE ============== */
  /* html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .btn-outline-blue { border-color: #c4b5fd; color: #c4b5fd; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .btn-outline-blue:hover { background-color: #c4b5fd; color: #1c1340; } */
  /* #================================ */
  /* Grant access / view users: gold like the edit button (only delete stays red) */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .btn-outline-blue { border-color: #f3c35f; color: #f3c35f; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .btn-outline-blue:hover { background-color: #f3c35f; color: #1c1340; }
  /* #================================ */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .btn-outline-danger { border-color: #f87171; color: #f87171; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-fsm-page .btn-outline-danger:hover { background-color: #f87171; color: #1c1340; }
</style>
{{-- #================================ --}}

<!-- FILE STORAGE MANAGEMENT -->

<div class="pagetitle">
    <h1>File Storage Management</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">File Storage Management</li>
        </ol>
    </nav>
</div><!-- End Page Title -->



<div class="row mb-2">
    <div class="col-md-1">
        <a href="{{ route('fsm.fsm.createfsm') }}" class="btn btn-primary text-right">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>
</div>

<!-- Container for upload file form -->
<div id="upload-file-container"></div>

<!-- Bordered Tabs -->
<div class="alert alert-secondary bg-light text-light border-0 alert-dismissible fade show" role="alert">
    <ul class="nav nav-tabs d-flex">
        <li class="nav-item flex-fill">
            <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#userFolders">User-Created Folders</button>
        </li>
        <li class="nav-item flex-fill">
            <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#sharedFolders">Shared Folders</button>
        </li>
    </ul>
</div>

<!-- Tabbed content for user-created folders and shared folders -->
<div class="tab-content">

    <!-- User-Created Folders Tab -->
    <div class="tab-pane fade show active" id="userFolders" role="tabpanel" aria-labelledby="userFolders-tab">
        <div class="col-md-12">

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

            <div class="col-12" style="padding: 0px;">
                <div class="card recent-sales">
                    <div class="card-body overflow-auto">
                        <div class="profile-overview pt-3">
                            <table class="table table-borderless datatable mt-3">
                                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">User-Created Folders</h5><hr>
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Folder Name</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($folders->isEmpty())
                                    <tr class="text-center">
                                        <td colspan="4">
                                            <h5>No folders found</h5>
                                        </td>
                                    </tr>
                                    @else
                                    @foreach($folders as $folder)
                                    <tr>
                                        <td>{{ $folder->id }}</td>
                                        <td>{{ $folder->folder }}</td>
                                        <td>{{ $folder->created_at }}</td>
                                        <td>

                                            <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                            <!----Edit Button----->
                                                <form method="get" action="{{ route('fsm.fsm.editfsm', ['id' => $folder->id]) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                </form>

                                                <style>
                                                    .btn-outline-blue {
                                                        color: #007bff;
                                                        border-color: #007bff;
                                                    }

                                                    .btn-outline-blue:hover {
                                                        background-color: #007bff;
                                                        color: #fff; /* Change text color to white when hovering */
                                                    }
                                                </style>

                                            <!-- Grant Access Button -->
                                                <form method="post" action="{{ route('fsm.accessfsm',$folder->id) }}">
                                                    @csrf

                                                    <button type="submit" class="btn btn-outline-blue">
                                                        <i class="bi bi-person-fill"></i>
                                                    </button>
                                                </form>

                                            <!-- View Users with Access Button -->
                                            <a class="btn btn-outline-blue" href="{{ route('fsm.showAccessUsers', $folder->id) }}">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>

                                             <!----Delete Button----->
                                             <form method="post" onclick="return confirm('Are you sure?')" action="{{ route('fsm.destroy', $folder->id ) }}">
                                                    @csrf
                                                    @method('delete')
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
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Recent Sales -->
    </div>

    <!-- Shared Folders Tab -->
    <div class="tab-pane fade" id="sharedFolders" role="tabpanel" aria-labelledby="sharedFolders-tab">
        @include('fsm.sharedfolder')
    </div>

</div>

{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-fsm-page --}}
{{-- #================================ --}}




@endsection
