@extends('layouts.app-pdms')

@section('title', 'Personnel Data Management System')

@section('content')

    @php $pagename = "PDMS Cuti"; @endphp  

<div class="pagetitle">
    <h1>Personnel Data Management System</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('pdmshome') }}">Home</a></li>
        <li class="breadcrumb-item active">PDMS Index</li>
    </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

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

<div class="card">

    <div class="row search-header">
        <div class="row" style="padding-bottom: 15px;">
            <div class="col-lg-1 label" id="searchbybutton" style="padding-top: 5px;">Search by:</div>

            <div class="col-lg-1 buttonfield">
                <button type="submit" id="icbutton" class="btn btn-default button fullbuttonwidth active-button" style="border-color: #ccc;">
                    Ic No.
                </button>
            </div>

        </div>

        <div class="row" style="padding-bottom: 5px;" id="iccontent">
            <div class="col-lg-1 label iclabel">Ic No: </div>
            <div class="col-lg-2 icfield">
                <form method="post" action="{{ route('pdms.cutisearchbyic') }}" enctype="multipart/form-data" id="icsearchForm">
                    @csrf
                    <input type="text" class="bg-white-200 form-control" name="no_ic" style="height:30px; width:150px; text-align:center; width: 100%"" placeholder="">
                </form>
            </div>
        
            <div class="col-lg-1 buttonfield" style="height: 46px;">
                <button type="submit" form="icsearchForm" class="btn btn-default button" style="border-color: #ccc; width: 100%;">Search</button>
            </div>
        </div>
        
        <hr style="width: 96%;">

        <div class="row search-header">
            <div class="col-lg-1 label namelabel">Name: </div>
            <div class="col-lg-5 namefield">
                <input type="text" class="bg-white-200 form-control" style="height:30px;" name="nama" value="" readonly>
            </div>

            <div class="col-lg-4 label iccolourlabel">Ic colour: </div>
            <div class="col-lg-2 iccolourfield">
                <input type="text" class="bg-white-200 form-control" style="height:30px; text-align:center" name="nama" value="" readonly>
            </div>

            <div class="col-lg-1 label faillabel">Department Fail No. : </div>
            <div class="col-lg-2 failfield">
                <input type="text" class="bg-white-200 form-control" style="height:30px; text-align:center" name="nama" value="" readonly>
            </div>
        </div>

        <div class="row headergap">
            <div class="col-lg-1 label jawatanlabel">Position: </div>
            <div class="col-lg-2 jawatanfield">
                <input type="text" class="bg-white-200 form-control" style="height:30px; text-align:center" name="nama" value="" readonly>
            </div>

            <div class="col-lg-1 label jenislabel">Type of Service: </div>
            <div class="col-lg-2 jenisfield">
                <input type="text" class="bg-white-200 form-control" style="height:30px; text-align:center" name="nama" value="" readonly>
            </div>

            <div class="col-lg-1 label gajilabel">Salary Type: </div>
            <div class="col-lg-2 gajifield">
                <input type="text" class="bg-white-200 form-control" style="height:30px; text-align:center" name="nama" value="" readonly>
            </div>

            <div class="col-lg-1 label bahagianlabel">Section: </div>
            <div class="col-lg-2 bahagianfield">
                <input type="text" class="bg-white-200 form-control" style="height:30px; text-align:center" name="nama" value="" readonly>
            </div>
        </div>
    </div>

    <div class="card-body" style="padding-top: 20px !important;">
        <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
            <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100 active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile" aria-selected="true">Profile</button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100" id="cuti-tab" data-bs-toggle="tab" data-bs-target="#cuti-justified" type="button" role="tab" aria-controls="services" aria-selected="false">Record Cuti</button>
            </li>
        </ul>

        <div class="tab-content pt-2" id="borderedTabContent">

            <div class="tab-pane fade show active" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body mt-3 overflow-auto">

                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="cuti-justified" role="tabpanel" aria-labelledby="cuti-tab">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body mt-3 overflow-auto">

                        </div>
                    </div>
                </div>
            </div>

        </div><!-- End Bordered Tabs -->

    </div>
</div>

</section>
@endsection

<style>
    @media (min-width: 992px) {
        #icbutton{
            border-radius:4px 4px 4px 4px !important; 
            border-right-style: none !important;
            width: 100%;
        }

        #penyatabutton{
            border-radius:0px 4px 4px 0px;
            border-left-style: none;
            width: 100%;
        }

        #searchbybutton{
            width: 10%;
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
            width: 7% !important; 
            margin-top: 0.3% !important; 
        }

        .namefield{
            padding-left: 0px !important;
            padding-right: 30px !important;
            width: 25% !important;
        }

        .iccolourlabel{
            padding-right: 0px !important; 
            width: 9% !important; 
            margin-top: auto !important; 
            margin-bottom: auto !important;
        }

        .iccolourfield{
            padding-left: 0px !important; 
            width: 14% !important;
        }

        .faillabel{
            padding-right: 0px !important; 
            width: 19% !important; 
            margin-top: auto !important; 
            margin-bottom: auto !important;
        }

        .failfield{
            padding-left: 0px !important;
            width: 14% !important;
        }

        .jawatanlabel{
            padding-right: 0px !important;
            width: 8.5% !important; 
            margin-top: auto !important; 
            margin-bottom: auto !important;
        }

        .jawatanfield{
            padding-left: 0px !important;  
            width: 14% !important;
        }

        .jenislabel{
            padding-right: 0px !important;
            width: 12.5% !important; 
            margin-top: auto !important; 
            margin-bottom: auto !important;
        }

        .jenisfield{
            padding-left: 0px !important;  
            width: 20% !important;
        }

        .gajilabel{
            padding-right: 0px !important;
            width: 10.5% !important; 
            margin-top: auto !important; 
            margin-bottom: auto !important;
        }

        .gajifield{
            padding-left: 0px !important;  
            width: 14% !important;
        }

        .bahagianlabel{
            padding-right: 0px !important;
            width: 8.5% !important; 
            margin-top: auto !important; 
            margin-bottom: auto !important;
        }

        .bahagianfield{
            padding-left: 0px !important;  
            width: 11.5% !important;
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

        .iccolourlabel{
            padding-right: 0px !important; 
            padding-top: 20px !important;
            width: 30% !important; 
            margin-top: auto !important; 
            margin-bottom: auto !important;
        }

        .iccolourfield{
            padding-left: 0px !important; 
            padding-top: 20px !important;
            width: 45% !important;
        }

        .faillabel{
            padding-right: 0px !important;
            padding-top: 20px !important;
            width: 30% !important; 
            margin-top: auto !important; 
            margin-bottom: auto !important;
        }

        .failfield{
            padding-left: 0px !important;
            padding-top: 20px !important;
            width: 45% !important;
        }

        .jawatanlabel{
            padding-right: 0px !important;
            width: 55% !important; 
            margin-top: auto !important; 
            margin-bottom: auto !important;
        }

        .jawatanfield{
            padding-left: 10px !important;  
            width: 100% !important;
        }

        .jenislabel{
            padding-right: 0px !important;
            padding-top: 20px !important;
            width: 55% !important; 
            margin-top: auto !important; 
            margin-bottom: auto !important;
        }

        .jenisfield{
            padding-left: 10px !important;  
            width: 100% !important;
        }

        .gajilabel{
            padding-right: 0px !important;
            width: 40% !important; 
            padding-top: 20px !important;
            margin-top: auto !important; 
            margin-bottom: auto !important;
        }

        .gajifield{
            padding-left: 0px !important;
            padding-top: 20px !important;  
            width: 44% !important;
        }

        .bahagianlabel{
            padding-right: 0px !important;
            padding-top: 20px !important; 
            width: 40% !important; 
            margin-top: auto !important; 
            margin-bottom: auto !important;
        }

        .bahagianfield{
            padding-left: 0px !important; 
            padding-top: 20px !important;  
            width: 45% !important;
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
