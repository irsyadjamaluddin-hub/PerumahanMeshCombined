@extends('layouts.app-all')

@section('title', 'Tambah Subjek')

@section('content')

<?php
$pagename = "Book List";
?>

<div class="pagetitle">
    <h1>Book List</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('cddinventory.cddinventory.indexbook') }}">Inventory</a></li>  
        <li class="breadcrumb-item active">Tambah Subjek</li>  
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
  <a href="{{ route('cddinventory.cddinventory.indexbook') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 7px;">
  <i class="bi bi-arrow-left-circle"></i>
  </a>
</div> 

<section class="section profile">

  <!-- Subject Table -->
  <div class="col-12">
      <div class="card recent-sales">
          <div class="card-body">
              <div class="profile-overview pt-3">
                  <h5 class="card-title">Subjek Baru</h5>
                  <form class="" id="storebooksubject" method="post" action="{{ route('cddinventory.cddinventory.storebooksubject') }}" enctype="multipart/form-data">
                      @csrf
                      <div class="row mb-3" style="margin-left: 0px;">
                          <label class="col-lg-1 col-form-label" style="width: 10rem;">Subjek Buku:</label>
                          <div class="col-lg-6">
                              <input type="text" name="kategori" class="form-control" placeholder="Nama Subjek">
                                  {!! $errors->first('nama', '<p class="help-block text-danger">:message</p>')!!}
                          </div>
                          <div class="col-lg-3">
                            <button id="submit-button" type="submit" class="btn btn-primary">Add</button>
                          </div>
                          <script>
                            var submitButton = document.getElementById('submit-button');
                            var form = document.getElementById('storebooksubject');
                          
                            form.addEventListener('submit', function(event) {
                                if (submitButton.getAttribute('data-submitted') !== null) {
                                    event.preventDefault();
                                } else {
                                    submitButton.disabled = true;
                                    submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                                    submitButton.setAttribute('data-submitted', 'true');
                                }
                            });
                          </script>

                      </div>
                  </form>

                  <div class="card-body overflow-auto">
                      <table class="table table-borderless datatable mt-3">
                          <thead>
                              <tr>
                                  <th scope="col">Subjek Buku</th>
                                  <th scope="col">Created At</th>
                                  <th scope="col">Action</th>
                              </tr>
                          </thead>
                          <tbody>                         
                          @if(count($booksubjects) == null)
                              <tr class="text-center">
                                  <td colspan="8">
                                      <h5>No records found</h5>
                                  </td>
                              </tr>
                          @else
                              @foreach($booksubjects as $booksubject)   
                              <tr>       
                                  <td>{{ $booksubject->kategori }}</td>
                                  <td>{{ $booksubject->created_at }}</td>
                                  <td>
                                      <div class="btn-group gap-2" role="group" aria-label="Basic example"> 
                                          <!----Edit Button----->
                                          <form method="get" action="{{ route('cddinventory.cddinventory.editbooksubject', $booksubject->id ) }}">
                                              @csrf
                                              <button type="submit" class="btn btn-outline-primary">
                                              <i class="bi bi-pencil-fill"></i>
                                              </button>
                                          </form>
                                          <!----Delete Button----->
                                          <form id="deleteForm{{$booksubject->id}}" method="post" action="{{ route('cddinventory.cddinventory.destroybooksubject', $booksubject->id) }}" style="margin-bottom:0px;">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" onclick="showDeleteConfirmationApproval({{ $booksubject->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
            
                                        <!-- Add a modal for confirmation -->
                                        <div class="modal" id="deleteConfirmationModalApproval{{ $booksubject->id }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirm Deletion</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval({{ $booksubject->id }})">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this record?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $booksubject->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $booksubject->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
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
  <!-- End Subject Table -->

</section>
@endsection

