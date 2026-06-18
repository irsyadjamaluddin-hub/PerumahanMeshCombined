@extends('layouts.app-all')

@section('title', 'Role List')

@section('content')

  <?php
    $pagename = "Super_Admin_Role_User";
  ?>

<div class="pagetitle">
  <h1>Role List</h1>
  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item"><a href="{{ route('role_users.role_user.index') }}">Role User</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('role_users.role_user.roleindex') }}">Role List</a></li>
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
  <a href="{{ route('role_users.role_user.index') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 7px;">
  <i class="bi bi-arrow-left-circle"></i>
  </a>
</div> 

<section class="section profile">

    <!-- Role Table -->
    <div class="col-12">
        <div class="card recent-sales">
            <div class="card-body">
                <div class="profile-overview pt-3">
                    <h5 class="card-title">Create New Role</h5>
                    <form class="" method="post" action="{{ route('role_users.role_user.rolestore') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3" style="margin-left: 0px;">
                            <label class="col-sm-1 col-form-label pe-2 w-14">Role:</label>
                            <div class="col-sm-3">
                                <input type="text" name="name" class="form-control" placeholder="Role_">
                            </div>

                            <label class="col-sm-1 col-form-label w-32">Description:</label>
                            <div class="col-sm-4">
                                <textarea type="text" name="description" class="form-control" style="height:24px;" placeholder="Role Description"></textarea>
                            </div>
                            <div class="col-sm-1">
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
                                  <th scope="col">Role Name</th>
                                  <th scope="col">Description</th>
                                  <th scope="col">Created At</th>
                                  <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>                         
                                @if(count($roles) == null)
                                    <tr class="text-center">
                                    <td colspan="8">
                                            <h5>No records found</h5>
                                        </td>
                                    </tr>
                                @else
                                @foreach($roles as $role)   
                                <tr>       
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td>{{ $role->created_at }}</td>
                                    <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example"> 
                                            <!----Edit Button----->
                                            <form method="get" action="{{ route('role_users.role_user.roleedit', $role->id ) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                                </button>
                                            </form>
                                            <!----Delete Button----->
                                            <form id="deleteForm{{$role->id}}" method="post" action="{{ route('role_users.role_user.roledestroy', $role->id) }}" style="margin-bottom:0px;">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" onclick="showDeleteConfirmationApproval({{ $role->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                
                                            <!-- Add a modal for confirmation -->
                                            <div class="modal" id="deleteConfirmationModalApproval{{ $role->id }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Deletion</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval({{ $role->id }})">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this record?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $role->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $role->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
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
        </div>
    </div>
<!-- End Jenis Permohonan Table -->

</section>
@endsection

