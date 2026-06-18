@extends('layouts.app-pdms')

@section('title', 'All Personnels Profile')

@section('content')

    @php $pagename = "PDMS Data"; @endphp  

<div class="pagetitle">
    <h1>Personnel Data Management System</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('pdmshome') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pdms.index') }}">PDMS Index</a></li>
        <li class="breadcrumb-item active">View all Personnel Data</li>  
    </ol>
    </nav>
</div><!-- End Page Title -->

@if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
@endif

<section class="section profile">

    <!----- Create Button  ----->
    <div class="col-md-1 text-left">
        <a href="{{ route('pdms.createprofileform') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 10px;">
        <i class="bi bi-plus-lg"></i>
        </a>
    </div> 

    <div class="col-12">
        <div class="card recent-sales" style="box-shadow: 0px 15px 30px rgba(1, 41, 112, 0.1); border-radius: 0px 0px 5px 5px;">
            <div class="card-body overflow-auto">
                <div class="row search-header">
                    <div class="row" style="padding-bottom: 15px;">
                        <div class="col-lg-1 label" id="searchbybutton" style="padding-top: 5px;">Search by:</div>
            
                        <div class="col-lg-1 buttonfield">
                            <button type="submit" id="icbutton" class="btn btn-default button fullbuttonwidth active-button" style="border-color: #ccc;">
                                Ic No.
                            </button>
                        </div>
            
                        <div class="col-lg-1 buttonfield">
                            <button type="submit" id="namebutton" class="btn btn-default button fullbuttonwidth" style="border-color: #ccc;">
                                Name
                            </button>
                        </div>
            
                        <div class="col-lg-1 buttonfield" id="viewfstatement">
                            <form method="get" action="{{ route('pdms.viewpenyata') }}" enctype="multipart/form-data" id="viewFileStatementForm">
                                @csrf
                                <button type="submit" form="viewFileStatementForm" class="btn btn-default button" style="border-color: #ccc; width: 100%;">View File Statement</button>
                            </form>
                        </div>
            
                        <div class="col-lg-1 buttonfield" id="viewall">
                            <form method="get" action="{{ route('pdms.viewall') }}" enctype="multipart/form-data" id="viewAllForm">
                                @csrf
                                <button type="submit" form="viewAllForm" class="btn btn-default button" style="border-color: #ccc; background-color: #dedede; width: 100%;">View All</button>
                            </form>
                        </div>
                    </div>
            
                    <div class="row" style="padding-bottom: 5px;" id="iccontent">
                        <div class="col-lg-1 label iclabel">Ic No: </div>
                        <div class="col-lg-2 icfield">
                            <form method="post" action="{{ route('pdms.searchbyic') }}" enctype="multipart/form-data" id="icsearchForm">
                                @csrf
                                <input type="text" class="bg-white-200 form-control" name="no_ic" style="height:30px; width:150px; text-align:center; width: 100%" placeholder="">
                            </form>
                        </div>
                    
                        <div class="col-lg-1 buttonfield" style="height: 46px;">
                            <button type="submit" form="icsearchForm" class="btn btn-default button" style="border-color: #ccc; width: 100%">Search</button>
                        </div>
                    </div>
            
                    <div class="row" style="padding-bottom: 5px; display: none;" id="namecontent">
                        <div class="col-lg-1 label namelabel">Name: </div>
                        <div class="col-lg-2 namefield">
                            <form method="post" action="{{ route('pdms.searchbyname') }}" enctype="multipart/form-data" id="searchbynameForm">
                                @csrf
                                <input type="text" class="bg-white-200 form-control" name="name" style="height:30px; width:100%;" placeholder="">
                            </form>
                        </div>
                    
                        <div class="col-lg-1 buttonfield" style="height: 46px;">
                            <button type="submit" form="searchbynameForm" class="btn btn-default button" style="border-color: #ccc;">Search</button>
                        </div>
                    </div>
                    
                    <hr style="width: 96%;">       
                    
                    <p class="label mt-3">
                        You are now viewing Ic No: 
                        {{ $recordprofiles->first()->no_ic !== '' ? $recordprofiles->first()->no_ic : '0' }} 
                        - 
                        {{ $recordprofiles->last()->no_ic !== '' ? $recordprofiles->last()->no_ic : 'N/A' }}
                        | Total Personnel Profile:  {{ $recordprofiles->total() }}
                    </p>
                    
                </div>

                <table class="table table-borderless datatable mt-3">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Ic No.</th>
                        <th>No. Fail Jabatan</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>    
                    @foreach ($recordprofiles as $recordprofile)
                    <tr>
                        <td style="width: 37%">{{$recordprofile->name}}</td>
                        <td style="width: 14%">{{$recordprofile->no_ic}}</td>
                        <td style="width: 28%">{{$recordprofile->no_fail_jabatan}}</td>
                        <td style="width: 21%">
                            <div class="btn-group gap-2" role="group" aria-label="Basic example" style="height: 38px;"">
                                <!-- Show Button -->
                                @if($recordprofile->no_ic !== null && $recordprofile->no_ic !== '')
                                <form method="post" action="{{ route('pdms.searchbyic') }}" style="margin-bottom:0px;"> 
                                    @csrf
                                    <input type="text" name="no_ic"  value="{{$recordprofile->no_ic}}" hidden>
                                    <button type="submit" class="btn btn-outline-primary" style="height: 100%;">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </form>
                                @else
                                <form method="post" action="{{ route('pdms.showbyname') }}" style="margin-bottom:0px;"> 
                                    @csrf
                                    <input type="text" name="name"  value="{{$recordprofile->name}}" hidden>
                                    <button type="submit" class="btn btn-outline-primary" style="height: 100%;">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </form>
                                @endif

                                <!-- Delete Button -->
                                <form id="deleteForm{{$recordprofile->id}}" method="post" action="{{ route('pdms.deleteprofileform' , ['no_ic' => $recordprofile->no_ic, 'id' => $recordprofile->id])}}">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-outline-danger delete-btn" style="height: 38px;" onclick="showDeleteConfirmation({{ $recordprofile->id }})" id="deleteButton{{$recordprofile->id}}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal" id="deleteConfirmationModal{{ $recordprofile->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Deletion</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmation({{ $recordprofile->id }})">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this record?
                                            </div>
                                            <div class="modal-footer">
                                                <!-- Countdown Timer -->
                                                <div id="countdownTimer{{$recordprofile->id}}" style="display: inline-block; margin-right: 10px;"></div>
                                                <!-- Delete Button -->
                                                <button type="button" class="btn btn-danger" onclick="deleteRecord('deleteForm{{ $recordprofile->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff" id="deleteModalButton{{$recordprofile->id}}">Delete</button>
                                                <!-- Cancel Button -->
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmation({{ $recordprofile->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function showDeleteConfirmation(id) {
                                        // Clear previous countdown interval if exists
                                        clearInterval(window['countdownInterval' + id]);
                                        
                                        // Start the countdown timer
                                        var countdown = 3; // 3 seconds
                                        $('#countdownTimer' + id).text(countdown); // Set initial value
                                        window['countdownInterval' + id] = setInterval(function() {
                                            countdown--;
                                            if (countdown <= 0) {
                                                clearInterval(window['countdownInterval' + id]); // Stop the countdown timer
                                                $('#deleteModalButton' + id).prop('disabled', false); // Enable the delete button
                                                $('#countdownTimer' + id).hide(); // Hide the countdown timer
                                            } else {
                                                $('#countdownTimer' + id).text(countdown); // Update the countdown timer
                                            }
                                        }, 1000); // Update every second (1000 milliseconds)
                                        
                                        $('#deleteConfirmationModal' + id).modal('show');
                                        // Disable the delete button
                                        $('#deleteModalButton' + id).prop('disabled', true);
                                    }
                                
                                    function hideDeleteConfirmation(id) {
                                        $('#deleteConfirmationModal' + id).modal('hide');
                                        // Reset the countdown timer
                                        $('#countdownTimer' + id).show(); // Show the countdown timer
                                        $('#countdownTimer' + id).text(''); // Clear the countdown timer display
                                        $('#deleteModalButton' + id).prop('disabled', false); // Enable the delete button
                                        // Clear the countdown interval
                                        clearInterval(window['countdownInterval' + id]);
                                    }
                                
                                    function deleteRecord(formId) {
                                        $('#' + formId).submit();
                                    }
                                </script>                                
                            </div>
                        </td>                                                       
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- Pagination Links -->
                {{ $recordprofiles->links() }}
            </div>
        </div>
    </div><!-- End Recent Sales -->
    
</section>
@endsection

<style>
    @media (min-width: 992px) {
        #icbutton{
            border-radius:4px 0px 0px 4px !important; 
            border-right-style: none !important;
            width: 100%;
        }

        #namebutton{
            border-radius:0px 4px 4px 0px;
            width: 100%;
        }

        #penyatabutton{
            border-radius:0px 4px 4px 0px;
            border-left-style: none;
            width: 100%;
        }

        #viewfstatement{
            padding-left: auto; 
            padding-right: auto;
            margin-left: 1%;
            height: 32px;
            width: 19%;
        }

        #viewall{
            padding-left: auto; 
            padding-right: auto;
            margin-left: 1%;
            height: 32px;
            width: 10%;
        }

        #searchbybutton{
            width: 10.5%;
        }

        .buttonfield{
            padding: 0px 0 0 0 !important;
        }

        .fullbuttonwidth{
            width: 100%;
        }

        .active-button{
            background-color: #0d6efd !important;
            border-color: #3490dc !important;
            color: #ffffff !important;
        }

        .label {
            font-weight: 600;
            color: rgba(1, 41, 112, 0.6);
        }

        .search-header{
            padding: 30px 0 10px 30px;
        }

        .headergap{
            padding: 10px 0 30px 0;
        }
        
        .penyatalabel{
            padding-right: 0px !important; 
            width: 9% !important; 
            margin-top: 0.4% !important;
        }

        .penyatafield{
            width: 11% !important; 
        }

        .penyatabuttonfield{
            width: 10% !important;
        }

        .iclabel{
            padding-right: 0px !important; 
            width: 7% !important; 
            margin-top: 0.4% !important;
        }

        .icfield{
            padding-left: 0px !important;
            width: 14% !important;
            margin-top: auto !important;
            margin-bottom: auto !important;
        }

        .button {
            color: #333;
            padding-top: 3px !important;
            padding-bottom: 3px !important
        }

        .button:hover {
            background-color: #e9ecef;
            border-color: #ccc;
        }

        .namelabel{
            padding-right: 0px !important; 
            width: 8% !important; 
            margin-top: 0.3% !important; 
        }

        .namefield{
            padding-left: 0px !important;
            padding-right: 30px !important;
            width: 25% !important;
        }
    }

    @media (max-width: 768px) {

        .penyatalabel{
            padding-right: 0px !important; 
            width: 100% !important; 
            margin-top: 0.4% !important;
        }

        .penyatabuttonfield{
            width: 100% !important;
        }

        .penyatafield{
            width: 100% !important; 
        }

        .iclabel{
            width: 20% !important;
        }

        .icfield{
            padding-left: 10px !important;
            width: 80% !important
        }

        .buttonfield{
            padding-top: 20px !important;
            text-align: center;
        }

        .namelabel{
            width: 100% !important;
        }

        .namefield{
            padding-left: 10px !important;
            width: 100% !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get references to the buttons and content divs
        const icButton = document.getElementById('icbutton');
        const nameButton = document.getElementById('namebutton');
        const icContent = document.getElementById('iccontent');
        const nameContent = document.getElementById('namecontent');

        // Initially, set the ic button as active
        icButton.classList.add('active-button');
        nameButton.classList.remove('active-button');

        // Set initial display property for content divs
        icContent.style.display = 'flex';
        nameContent.style.display = 'none';

        // Function to toggle active and inactive buttons
        function toggleActiveButton(activeButton, inactiveButton) {
            activeButton.classList.add('active-button');
            activeButton.classList.remove('inactive-button');
            inactiveButton.classList.remove('active-button');
            inactiveButton.classList.add('inactive-button');
        }

        // Function to toggle content visibility
        function toggleContent(activeContent, inactiveContent) {
            activeContent.style.display = 'flex'; // Set the display property to 'flex'
            inactiveContent.style.display = 'none';
        }

        // Event listener for the ic button
        icButton.addEventListener('click', function() {
            toggleActiveButton(icButton, nameButton);
            toggleContent(icContent, nameContent);
        });

        // Event listener for the name button
        nameButton.addEventListener('click', function() {
            toggleActiveButton(nameButton, icButton);
            toggleContent(nameContent, icContent);
        });
    });
</script>


