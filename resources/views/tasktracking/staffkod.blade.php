@extends('layouts.app-all')

@section('title', 'Task Tracking Staff Kod')

@section('content')

<?php
$pagename = "TaskTracking";
?>

<div class="section profile">

    <a href="{{ route('tasktracking.indextasktracking') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

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
                        <h3 class="card-title">Task Tracking Staff Kod</h3>
                        <form class="" method="post" action="{{ route('tasktracking.storestaffkod') }}" enctype="multipart/form-data">
                            @csrf
                            <table class="table-achiev" id="declare">
                                <thead>
                                    <tr>
                                        <th class="text-center">IC No</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Kod</th>
                                        <th class="text-center">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>
                                            <input type="text" name="moreFields[0][ic_no]" id="ic_no[0]" placeholder="IC No" class="form-control @error('ic_no.0') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('ic_no.0') }}" required>
                                        </td>
                                        <td>
                                            <input type="text" name="moreFields[0][nama]" id="nama[0]" placeholder="Nama" class="form-control @error('nama.0') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('nama.0') }}" required>
                                        </td>
                                        <td>
                                            <input type="text" name="moreFields[0][kod]" id="kod[0]" placeholder="Kod" class="form-control @error('kod.0') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('kod.0') }}" required>
                                        </td>
                                            <input type="text" name="moreFields[0][department_id]" class="form-control" value="{{ $department->department_id }}" hidden>
                                            <input type="text" name="moreFields[0][created_by]" class="form-control" value="{{ $icNos }}" hidden>
                                        <td>
                                            <button class="btn btn-primary mt-2 mb-2 btn-sm" type="button" name="addDeclare" id="addDeclare">
                                                <i class="bi bi-plus-lg"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <script type="text/javascript">
                                $(document).ready(function() {
                                    var i = 0;

                                    $("#addDeclare").click(function() {
                                        ++i;
                                        $("#declare tbody").append(
                                            '<tr class="text-center"><td><input class="form-control" type="text" placeholder="IC No" name="moreFields[' +
                                            i +
                                            '][ic_no]" required></td><td><input type="text" placeholder="Nama" name="moreFields[' +
                                            i +
                                            '][nama]" class="form-control" required></td><td><input class="form-control" type="text" placeholder="Kod" name="moreFields[' +
                                            i +
                                            '][kod]" required></td><td class=""><input type="text" name="moreFields[' +
                                            i +
                                            '][department_id]" class="form-control" value="{{ $department->department_id }}" hidden><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                        );
                                    });

                                    $(document).on('click', '.removeDeclare', function() {
                                        $(this).closest('tr').remove();
                                    });
                                });
                            </script>
                            <br>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

                <br>
                <div class="col profile-overview overflow-auto" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h3 class="card-title">List Staff Kod</h3>
                    <table class="table-achiev datatable" id="tableprestasi1">
                        <thead>
                            <tr>
                                <th class="text-center">IC No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Kod</th>
                                <th class="text-center">Tindakan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(count( $staffkods) == 0)
                                <tr class="text-center">
                                    <td colspan="8">
                                        <h5>No records found</h5>
                                    </td>
                                </tr>
                            @else
                            @foreach( $staffkods as $staffkod )
                                <tr class="text-center">
                                    <td>{{$staffkod->ic_no}}</td>
                                    <td>{{$staffkod->nama}}</td>
                                    <td>{{$staffkod->kod}}</td>
                                    <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                            <!----Delete Button----->
                                            <form id="deleteForm{{$staffkod->id}}" method="post" action="{{ route('tasktracking.destroystaffkod', $staffkod->id) }}" style="margin-bottom:0px;">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" onclick="showDeleteConfirmationApproval({{ $staffkod->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>

                                            <!-- Add a modal for confirmation -->
                                            <div class="modal" id="deleteConfirmationModalApproval{{ $staffkod->id }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Deletion</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval({{ $staffkod->id }})">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this record?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $staffkod->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $staffkod->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
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
@endsection
