@extends('layouts.app-all')

@section('title', 'Event')

@section('content')

<?php
$pagename = "Event";
?>


<style>
.dataTable-info{
    color: white;
}

.download-button {
        display: inline-block;
        padding: 3px 8px;
        background-color: #fff; /* White background */
        color: #0D6EFD; /* Blue text color */
        text-decoration: none;
        border: 1px solid #0D6EFD; /* Blue border */
        border-radius: 5px;
        margin-top: 5px; /* Margin to position below the QR code */
    }
</style>

<div class="pagetitle">
    <h1>MOE Event</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('moeevent.moeevent.indexadmin') }}">MOE Event</a></li>
    </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">

    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif

 
    <div class="col-12 mb-2 mt-2" style="text-align: right;">
        <!-- Added by Amal 'Izzah (PB) -->
        <a href="https://mesh.moe.gov.bn/ratingopenform"  target="_blank" class= "btn btn-primary" hidden>
            <i class="bi bi-send"></i>
        </a>
        <!------ ==========  ------>
        <a href="https://mesh.moe.gov.bn/moeevent"  target="_blank" class= "btn btn-primary">
            <i class="bi bi-link"></i>
        </a>
        <a href="{{ route('moeevent.moeevent.createevent') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    <div class="col-12">
        <div class="card">

            <div class="card-body overflow-auto">

                <table class="table table-borderless datatable mt-3">
                    <thead>
                        <tr>
                            <th scope="col">QR Code</th>
                            <th scope="col">Event</th>
                            <th scope="col" style="width: 15%;">Event Date</th>
                            <th scope="col" style="width: 15%;">Event Date End</th>
                            <th scope="col">Event Time</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">IC No.</th>                           
                            <th scope="col">Ratings</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        @if(count($perkaraevent) == 0)
                        <tr class="text-center">
                            <td colspan="8">
                                <h5>No records found</h5>
                            </td>
                        </tr>

                        @else

                        @foreach($perkaraevent as $perkaraevent)

                            <tr>
                                <td>
                                    <a href="{{ route('eventqrcodeadmin', $perkaraevent->id) }}">
                                        {{ QrCode::size(100)->generate(route('eventqrcodeadmin', $perkaraevent->id)) }}
                                    </a>
                                    <button type="button"><a href="{{ route('downloadQrCodePdf', ['id' => $perkaraevent->id]) }}" target="_blank" class="download-button">Pdf</a></button>
                                    <button type="button" class="download-button imgButton" data-id="{{ $perkaraevent->id }}">IMG</button>                                
                                </td>
                                <td>{{ $perkaraevent->eventlabel }}</td>
                                <td>{{ \Carbon\Carbon::parse($perkaraevent->eventdate)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($perkaraevent->eventdateend)->format('d-m-Y') }}</td>
                                <td>{{ $perkaraevent->eventtime }}</td> 
                                <td>{{ optional($perkaraevent->Department)->label }}</td>
                                <td title="{{ $perkaraevent->nama }}">{{ $perkaraevent->icno }}</td>                                
                                <td>   <!-- show rating  Added by Amal 'Izzah (PB)-->
                                            <form method="get" action="{{ route('moeevent.moeevent.showrating', $perkaraevent->id ) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary" title="Ratings">
                                                    <i class="bi bi-star"></i>
                                                </button>
                                            </form>   
                                 </td>                    
                                <td>
                                    <div class="row" style="padding-bottom:5px;">
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                            <!----Edit Button----->
                                            <form method="get" action="{{ route('moeevent.moeevent.editadmin', $perkaraevent->id ) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary" title="Edit">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                            </form>

                                            <!----Delete Button----->
                                            <form id="deleteForm{{$perkaraevent->id}}" method="post" action="{{ route('moeevent.moeevent.destroymoeevent', $perkaraevent->id) }}" style="margin-bottom:0px;">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" title="Delete" onclick="showDeleteConfirmationApproval({{ $perkaraevent->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                
                                            <!-- Add a modal for confirmation -->
                                            <div class="modal" id="deleteConfirmationModalApproval{{ $perkaraevent->id }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Deletion</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval({{ $perkaraevent->id }})">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this record?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $perkaraevent->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $perkaraevent->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
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
                                    </div>

                                    <div class="row">
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                            <!-- approved users -->
                                            <form method="get" action="{{ route('moeevent.moeevent.approveparticipant', $perkaraevent->id ) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary" title="Approve Participant">
                                                    <i class="bi bi-card-checklist"></i>
                                                </button>
                                            </form>
                                    
                                            <!-- dashboard -->
                                            <form method="get" action="{{ route('moeevent.moeevent.dashboard', $perkaraevent->id ) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary" title="Dashboard">
                                                    <i class="bi bi-bar-chart-line-fill"></i>
                                                </button>
                                            </form>

                                         
                                        </div>
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

<script>
    function downloadQRCode(eventId) {
        window.location.href = "{{ route('downloadQrCodePdf', ['id' => '__EVENT_ID__']) }}".replace('__EVENT_ID__', eventId);
        }

        document.addEventListener('DOMContentLoaded', function() {
        // Use class instead of id for multiple buttons
        const imgButtons = document.querySelectorAll('.imgButton');

        imgButtons.forEach(function(imgButton) {
            imgButton.addEventListener('click', function(event) {
                event.preventDefault();
                // Get the data-id attribute from the clicked button
                const eventId = imgButton.getAttribute('data-id');
                console.log('Button clicked for Event ID:', eventId);

                // Redirect to the showQrCodeImage route with the event ID
                window.location.href = "{{ route('showQrCodeImage', '__EVENT_ID__') }}".replace('__EVENT_ID__', eventId);
            });
        });
    });
</script>

</section>
@endsection

