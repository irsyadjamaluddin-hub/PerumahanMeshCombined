@extends('layouts.app-all')

@section('title', 'Guru Besar / Pengetua')

@section('content')

<?php
$pagename = "Guru Besar / Pengetua";
?>

<div class="section profile">

    <div class="d-flex justify-content-between align-items-center mb-2">
        <a href="{{ route('cddinventory.cddinventory.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left-circle"></i>
        </a>
        
        <div>
            <button type="button" data-bs-toggle="modal" data-bs-target="#infoModal" class="btn btn-primary">
                <i class="bi bi-person-plus"></i>
            </button>
        </div>
    </div>

    <!-- Basic Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="min-height: auto;">
                    <form class="" id="storebooksubject" method="post" action="{{ route('cddinventory.storegbpg') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3" style="margin-left: 0px;">
                            <label class="col-lg-1 col-form-label" style="width: 10rem;">Nama:</label>
                            <div class="col-lg-6">
                                <input type="text" name="name" class="form-control" placeholder="Name">
                                    {!! $errors->first('name', '<p class="help-block text-danger">:message</p>')!!}
                            </div>
                        </div>
                        <div class="row mb-3" style="margin-left: 0px;">
                            <label class="col-lg-1 col-form-label" style="width: 10rem;">No. Kad Pengenalan:</label>
                            <div class="col-lg-6">
                                <input type="text" name="ic_no" class="form-control" placeholder="01234567" required>
                                    {!! $errors->first('ic_no', '<p class="help-block text-danger">:message</p>')!!}
                            </div>
                        </div>
                        <div class="row mb-3" style="margin-left: 0px;">
                            <label class="col-lg-1 col-form-label" style="width: 10rem;">Sekolah:</label>
                            <div class="col-lg-6">
                                <select class="form-select" name="school"  aria-label="Default select example" required>
                                    <option selected hidden>Pilih Sekolah</option>
                                    @foreach ($sekolah as $key => $value)
                                        <option value="{{ $value }}">
                                          {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                    {!! $errors->first('school', '<p class="help-block text-danger">:message</p>')!!}
                            </div>
                        </div>

                        <script>
                            $('#myselect').select2({
                            width: '100%',
                            placeholder: "Pilih Jabatan",
                            allowClear: true
                            });
                        </script>
                        <div class="row mb-3" style="margin-left: 0px;">
                            <label class="col-lg-1 col-form-label" style="width: 10rem;">Emel:</label>
                            <div class="col-lg-6">
                                <input type="email" name="email" class="form-control" placeholder="exampleemail@moe.gov.bn" required>
                                    {!! $errors->first('email', '<p class="help-block text-danger">:message</p>')!!}
                            </div>
                        </div>
                        <div class="row mb-3" style="margin-left: 0px;">
                            <label class="col-lg-1 col-form-label" style="width: 10rem;">No Tel:</label>
                            <div class="col-lg-6">
                                <input type="text" name="phone_number" class="form-control" placeholder="741XXXX" required>
                                    {!! $errors->first('ic_no', '<p class="help-block text-danger">:message</p>')!!}
                            </div>
                        </div>
                        <div class="row mb-3" style="margin-left: 0px;">
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
                </div>
            </div>
        </div>
    </div><!-- End Basic Modal -->

           <!-- end button -->

    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview overflow-auto" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h3 class="card-title">Guru Besar / Pengetua</h3>
                        
                        <table class="table-achiev" id="declare">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Sekolah</th>
                                    <th class="text-center">Emel</th>
                                    <th class="text-center">IC No</th>
                                    <th class="text-center">Phone Number</th>
                                    <th class="text-center">Di Masukkan Oleh</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($gbpg) == null)
                                    <tr class="text-center">
                                        <td colspan="8">
                                            <h5>No records found</h5>
                                        </td>
                                    </tr>
                                @else
                                @foreach($gbpg as $gbpgs)
                                <tr class="text-center">
                                    <td>{{ $gbpgs->name }}</td>
                                    <td>{{ $gbpgs->school }}</td>
                                    <td>{{ $gbpgs->email }}</td>
                                    <td>{{ $gbpgs->ic_no }}</td>
                                    <td>{{ $gbpgs->phone_number }}</td>
                                    <td>{{ $gbpgs->created_by }}</td>
                                    <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                            <!----Delete Button----->
                                            <form id="deleteForm{{$gbpgs->id}}" method="post" action="{{ route('cddinventory.destroygbpg', $gbpgs->id) }}" style="margin-bottom:0px;">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" onclick="showDeleteConfirmationApproval({{ $gbpgs->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>

                                            <!-- Add a modal for confirmation -->
                                            <div class="modal" id="deleteConfirmationModalApproval{{ $gbpgs->id }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Deletion</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval({{ $gbpgs->id }})">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this record?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $gbpgs->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $gbpgs->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
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

                <br>
                

            </div>
        </div>
    </div>
</div>
@endsection
