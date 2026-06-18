@extends('layouts.app-pdms')

@section('title', 'Personnel Data Management System')

@section('content')

    @php $pagename = "PDMS Data"; @endphp  

<div class="pagetitle">
    <h1>Personnel Data Management System</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('pdmshome') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pdms.index') }}">PDMS Index</a></li>
        <li class="breadcrumb-item active">Personnel Similar Name</li>  
    </ol>
    </nav>
</div><!-- End Page Title -->

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
                            <button type="submit" id="icbutton" class="btn btn-default button fullbuttonwidth" style="border-color: #ccc;">
                                Ic No.
                            </button>
                        </div>
            
                        <div class="col-lg-1 buttonfield">
                            <button type="submit" id="namebutton" class="btn btn-default button fullbuttonwidth active-button" style="border-color: #ccc;">
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
                                <button type="submit" form="viewAllForm" class="btn btn-default button" style="border-color: #ccc; width: 100%;">View All</button>
                            </form>
                        </div>
                    </div>
            
                    <div class="row" style="padding-bottom: 5px; display: none;" id="iccontent">
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
            
                    <div class="row" style="padding-bottom: 5px;" id="namecontent">
                        <div class="col-lg-1 label namelabel">Name: </div>
                        <div class="col-lg-2 namefield">
                            <form method="post" action="{{ route('pdms.searchbyname') }}" enctype="multipart/form-data" id="searchbynameForm">
                                @csrf
                                <input type="text" class="bg-white-200 form-control" name="name" style="height:30px; width:100%;" placeholder="{{$searchname}}">
                            </form>
                        </div>
                    
                        <div class="col-lg-1 buttonfield" style="height: 46px;">
                            <button type="submit" form="searchbynameForm" class="btn btn-default button" style="border-color: #ccc;">Search</button>
                        </div>
                    </div>
                    
                    <hr style="width: 96%;">                
                </div>

                <table class="table table-borderless datatable mt-3">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Ic No.</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>  
                    @foreach ($recordprofiles as $recordprofile)
                    <tr>
                        <td style="width: ">{{ $recordprofile->name}}</td>
                        <td>{{ $recordprofile->no_ic}}</td>
                        <td style="width: ">
                            <div class="btn-group gap-2" role="group" aria-label="Basic example" style="height: 38px;"">
                                <!----show Button----->
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
                            </div>
                        </td>                                                       
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
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
        nameButton.classList.add('active-button');
        icButton.classList.remove('active-button');

        // Set initial display property for content divs
        nameContent.style.display = 'flex';
        icContent.style.display = 'none';

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

