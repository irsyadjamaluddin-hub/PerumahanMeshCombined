@extends('layouts.app-all')

@section('title', 'Edit Event')

@section('content')

<?php
$pagename = "Event";
?>

@if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
@endif

<div class="pagetitle">
    <h1>MOE Event</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('moeevent.moeevent.indexadmin') }}">MOE Event</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

  <a href="{{ route('moeevent.moeevent.indexadmin') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

    <div class="col-12">
        <div class="card pt-3">
            <div class="card-body overflow-auto">

            <form class="" method="post" action="{{ route('moeevent.moeevent.updateadmin') }}" enctype="multipart/form-data">
             @csrf

                <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Event Details</h5>
                    <br>
                    @foreach ($perkaraevent as $perkaraevent)

                    <input type="text" name="id" class="bg-gray-200 form-control " value="{{$perkaraevent->id}}" hidden>

                        <div class="row">
                            <div class="col-lg-4 label d-flex align-items-center">Event</div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="eventlabel" value="{{$perkaraevent->eventlabel}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label d-flex align-items-center">Event Date</div>
                            <div class="col-lg-8">
                                <input type="date" class="form-control" name="eventdate" value="{{ $perkaraevent->eventdate}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label d-flex align-items-center">Event Date End</div>
                            <div class="col-lg-8">
                                <input type="date" class="form-control" name="eventdateend" value="{{ $perkaraevent->eventdateend}}">
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-lg-4 label d-flex align-items-center">Event Time</label>
                            <div class="col-lg-8">
                            <input type="time" class="form-control" name="eventtime" value="{{ $perkaraevent->eventtime}}">
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-lg-4 label d-flex align-items-center">Event Venue</label>
                            <div class="col-lg-8">
                            <input type="text" class="form-control" name="eventvenue" value="{{ $perkaraevent->eventvenue}}">
                            </div>
                        </div>

                            
                        <div class="row">
                            <label class="col-lg-4 label d-flex align-items-center">Jabatan</label>
                            <div class="col-lg-8">
                        
                            <input type="text" class="bg-gray-200 form-control" value="{{ optional($perkaraevent->Department)->label }}" readonly>
                        
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-4 label d-flex align-items-center">Nama</div>
                            <div class="col-lg-8">
                                <input type="text" class="bg-gray-200 form-control"  value="{{$perkaraevent->nama}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label d-flex align-items-center">IC No.</div>
                            <div class="col-lg-8">
                                <input type="text" class="bg-gray-200 form-control"  value="{{$perkaraevent->icno}}" readonly>
                            </div>
                        </div>

                    <br>

                    <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                    @endforeach
                </div>
            </form>

            </div>
        </div>
    </div>


    <!-- start new div -->
<div class="col-12">
    <div class="card pt-3">
        <div class="card-body">
            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Registered List</h5>
                <br>
                <div class="table-responsive">
                    <table class="table table-borderless datatable mt-3" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Jawatan</th>
                                <th scope="col">Nama</th>
                                <th scope="col">IC.No</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone No</th>
                                <th scope="col">Status (Approve? / Reject?)</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($moeevent) == 0)
                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>
                            @else
                            @foreach($moeevent as $moeevent)
                            <tr>
                                <td>{{ $moeevent->jabatan}}</td>
                                <td>{{ $moeevent->jawatan}}</td>
                                <td>{{ $moeevent->nama}}</td>
                                <td>{{ $moeevent->icno}}</td>
                                <td>{{ $moeevent->email}}</td>
                                <td>{{ $moeevent->no_tel}}</td>
                                @if($moeevent->status == 'approve')
                                    <td><span class="badge bg-success">Approved</span></td>
                                @elseif ($moeevent->status == 'reject')
                                    <td><span class="badge bg-danger">Rejected</span></td>
                                @else
                                    <td>
                                        <a href="{{ route('moeevent.moeevent.approve', $moeevent->id) }}" class="btn btn-outline-success" title="Approve"><i class="bi bi-check2-circle"></i></a>
                                        <a href="{{ route('moeevent.moeevent.reject', $moeevent->id) }}" class="btn btn-outline-danger" title="Reject"><i class="bi bi-x-lg"></i></a>
                                    </td>  
                                @endif 
                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('moeevent.moeevent.showevent', $moeevent->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </form>

                                        <!----Delete Button----->
                                        <form id="deleteForm{{$moeevent->id}}" method="post" action="{{ route('moeevent.moeevent.destroyregisterlist', $moeevent->id ) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-outline-danger delete-btn" style="height: 38px;" onclick="showDeleteConfirmationApproval({{ $moeevent->id }})">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                        <!-- Add a modal for confirmation -->
                                        <div class="modal" id="deleteConfirmationModalApprovalservice{{ $moeevent->id }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirm Deletion</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval({{ $moeevent->id }})">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this record?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $moeevent->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $moeevent->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            function showDeleteConfirmationApproval(id) {
                                                $('#deleteConfirmationModalApprovalservice' + id).modal('show');
                                            }
                                            function hideDeleteConfirmationApproval(id) {
                                                $('#deleteConfirmationModalApprovalservice' + id).modal('hide');
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
<!-- end new div -->


</section>
@endsection
