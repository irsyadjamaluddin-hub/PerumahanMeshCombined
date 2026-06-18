@extends('layouts.app-all')

@section('title', 'Jawatan Kosong')

@section('content')

  <?php 
    $pagename = "Jawatan Kosong";
  ?>

    <div class="pagetitle">
    <h1>Jawatan Kosong</h1>
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Jawatan Kosong</li>  
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

    <!-- ACT Table -->
 
    <div class="card recent-sales">

  <div class="card-body">

    <div class="profile-overview pt-3">
        <h5 class="card-title">Perkara </h5>
        <form class="" method="post" action="{{ route('jawatankosong.jawatankosong.storejawatan') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-lg-1 col-form-label">Jawatan</label>
                <div class="col-lg-4">
                    <input type="text" name="label" class="form-control" placeholder="Nama Jawatan">
              
            </div>
            
           
                <label class="col-lg-1 col-form-label">Tanggagaji</label>
                <div class="col-lg-3">
                    <input type="text" name="tanggagaji" class="form-control" placeholder="Tanggagaji">
                </div>

                <div class="col-lg-3">
                    <button type="submit" class="btn btn-outline-success" >
                       Update
                    </button>
                </div>
            </div>
        </form>

        <div class="card-body overflow-auto">


                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Jawatan</th>
                                <th scope="col">Tanggagaji</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                           
                        
                        @if(count($jawatanlist) == null)
                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>

                        @else
                         @foreach($jawatanlist as $jawatanlist)   

                            <tr>
                                
                                <td>{{ $jawatanlist->label }}</td>
                                <td>{{ $jawatanlist->tanggagaji }}</td>
                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----Edit Button----->
                                        <a href="{{ route('jawatankosong.jawatankosong.editsenaraijawatan', $jawatanlist->id) }}" class="btn btn-outline-primary">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <!----Delete Button----->
                                        <form id="deleteForm{{$jawatanlist->id}}" method="post" action="{{ route('jawatankosong.jawatankosong.destroyjawatan', $jawatanlist->id) }}" style="margin-bottom:0px;">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" onclick="showDeleteConfirmationApproval({{ $jawatanlist->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
            
                                        <!-- Add a modal for confirmation -->
                                        <div class="modal" id="deleteConfirmationModalApproval{{ $jawatanlist->id }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirm Deletion</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval({{ $jawatanlist->id }})">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this record?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $jawatanlist->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $jawatanlist->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
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

</section>

@endsection
