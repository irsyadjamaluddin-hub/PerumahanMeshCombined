@extends('layouts.app-pdms')

@section('title', 'Personnel Data Management System')

@section('content')

    @php $pagename = "PDMS Service"; @endphp

<div class="pagetitle">
    <h1>Personnel Data Management System</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('pdmshome') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pdms.serviceindex') }}">PDMS Index</a></li>
        <li class="breadcrumb-item active">{{$recordprofiles->first()->no_ic}}</li>  
    </ol>
    </nav>
</div><!-- End Page Title -->

@if(Session::has('error_message'))
<div class="alert alert-danger">
    <i class="fas fa-fw fa-exclamation-circle"></i>
    {!! session('error_message') !!}
</div>
@endif

@if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
@endif


<section class="section profile">

    <!----- Back out Button  ----->
    <div class="col-md-1 text-left">
        <a href="{{ route('pdms.serviceindex') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 10px;">
        <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div>  
    
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
                    <form method="post" action="{{ route('pdms.servicesearchbyic') }}" enctype="multipart/form-data" id="icsearchForm">
                        @csrf
                        <input type="text" class="bg-white-200 form-control" name="no_ic" style="height:30px; width:150px; text-align:center; width: 100%"" placeholder="{{  $recordprofiles->first()->no_ic !== null && $recordprofiles->first()->no_ic !== '' ? $recordprofiles->first()->no_ic : 'Null' }}">
                    </form>
                </div>
            
                <div class="col-lg-1 buttonfield" style="height: 46px;">
                    <button type="submit" form="icsearchForm" class="btn btn-default button" style="border-color: #ccc; width: 100%">Search</button>
                </div>
            </div>
            
            <hr style="width: 96%;">

            <div class="row search-header">
                <div class="col-lg-1 label namelabel">Name: </div>
                <div class="col-lg-5 namefield">
                    <input type="text" class="bg-white-200 form-control" style="height:30px;" name="nama" title="{{  $recordprofiles->first()->name  }}" value="{{  $recordprofiles->first()->name  }}" readonly>
                </div>

                <div class="col-lg-4 label iccolourlabel">Ic colour: </div>
                <div class="col-lg-2 iccolourfield">
                    <input type="text" class="bg-white-200 form-control" style="height:30px; text-align:center" name="ic_colour" title="{{ $recordprofiles->first()->ic_colour }}" value="{{ $recordprofiles->first()->ic_colour }}" readonly>
                </div>

                <div class="col-lg-1 label faillabel">Department File No.: </div>
                <div class="col-lg-2 failfield">
                    <input type="text" class="bg-white-200 form-control" style="height:30px; text-align:center" name="no_fail_jabatan" title="{{ $recordprofiles->first()->no_fail_jabatan }}" value="{{ $recordprofiles->first()->no_fail_jabatan }}" readonly>
                </div>
            </div>

            <div class="row headergap">
                <div class="col-lg-1 label jawatanlabel">Position: </div>
                <div class="col-lg-2 jawatanfield">
                    <input type="text" class="bg-white-200 form-control" style="height:30px; text-align:center" name="jawatan_sekarang" title="{{ $recordprofiles->first()->jawatan_sekarang }}" value="{{ $recordprofiles->first()->jawatan_sekarang }}" readonly>
                </div>

                <div class="col-lg-1 label jenislabel">Type of Service: </div>
                <div class="col-lg-2 jenisfield">
                    <input type="text" class="bg-white-200 form-control" style="height:30px; text-align:center" name="jenis_perkhidmatan" title="{{ $recordprofiles->first()->jenis_perkhidmatan }}" value="{{ $recordprofiles->first()->jenis_perkhidmatan }}" readonly>
                </div>

                <div class="col-lg-1 label gajilabel">Salary Type: </div>
                <div class="col-lg-2 gajifield">
                    <input type="text" class="bg-white-200 form-control" style="height:30px; text-align:center" name="tanggagaji" title="{{ $recordprofiles->first()->tanggagaji }}" value="{{ $recordprofiles->first()->tanggagaji }}" readonly>
                </div>

                <div class="col-lg-1 label bahagianlabel">Section: </div>
                <div class="col-lg-2 bahagianfield">
                    <input type="text" class="bg-white-200 form-control" style="height:30px; text-align:center" name="bahagian" value="{{ $recordprofiles->first()->bahagian }}" readonly>
                </div>
            </div>
        </div>

        <div class="card-body" style="padding-top: 20px !important;">
            <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100 active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile" aria-selected="true">Profile</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="services-tab" data-bs-toggle="tab" data-bs-target="#services-justified" type="button" role="tab" aria-controls="services" aria-selected="false">Service Records</button>
                </li>
            </ul>

            <div class="tab-content pt-2" id="borderedTabContent">

                <div class="tab-pane fade show active" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col-lg-12" style="padding-left: 0px;  padding-right: 0px">
                        <div class="card-body mt-3 overflow-auto" style="padding-left: 0px; padding-right: 0px">

                            <div class="alert alert-secondary bg-light" role="alert">
                                <ul class="nav nav-tabs d-flex">
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">JPA File No. <br> <i>No. Fail JPA</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->no_fail_jpa }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Sex <br> <i>Jantina</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->jantina }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            
                                            <div class="col-lg-3 col-md-5 label">Date of Birth <br> <i>Tarikh Lahir</i></div>
                                            <div class="col-lg-9 col-md-7">
                                                @if ($recordprofiles->isNotEmpty() && $recordprofiles->first()->tarikh_lahir)
                                                        {{ \Carbon\Carbon::parse($recordprofiles->first()->tarikh_lahir)->isoFormat('Do MMMM YYYY') }}
                                                @else
                                                @endif
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Date of Retirement <br> <i>Tarikh Bersara</i></div>
                                            <div class="col-lg-9 col-md-7">
                                                @if ($recordprofiles->isNotEmpty() && $recordprofiles->first()->tarikh_bersara)
                                                        {{ \Carbon\Carbon::parse($recordprofiles->first()->tarikh_bersara)->isoFormat('Do MMMM YYYY') }}
                                                @else
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Place of Birth <br> <i>Tempat Lahir</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->tempat_lahir }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Religion <br> <i>Ugama</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->ugama }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Race <br> <i>bangsa</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->bangsa }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Citizensip <br> <i>Kerakyatan</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->kerakyatan }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Marital Status <br> <i>Taraf Kelamin</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->taraf_kelamin }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Starting of Service Date <br> <i>Tarikh Mula Berkhidmat</i></div>
                                            <div class="col-lg-9 col-md-7">
                                                @if ($recordprofiles->isNotEmpty() && $recordprofiles->first()->tarikh_mula_berkhidmat)
                                                        {{ \Carbon\Carbon::parse($recordprofiles->first()->tarikh_mula_berkhidmat)->isoFormat('Do MMMM YYYY') }}
                                                @else
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Home Address <br> <i>Alamat Rumah</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->alamat_rumah }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Different Address <br> <i>Alamat Lain</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->alamat_lain }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label"> Phone (Home) <br> <i>Telefon Rumah</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->telefon_rumah }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Phone (Mobile) <br> <i>Telefon Mobile</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->telefon_mobile }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Current Chosen Date <br> <i>Tarikh Lantikan Sekarang</i></div>
                                            <div class="col-lg-9 col-md-7">
                                                @if ($recordprofiles->isNotEmpty() && $recordprofiles->first()->tarikh_lantikan_sekarang)
                                                        {{ \Carbon\Carbon::parse($recordprofiles->first()->tarikh_lantikan_sekarang)->isoFormat('Do MMMM YYYY') }}
                                                @else
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Place of Work <br> <i>Tempat Bertugas</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->tempat_bertugas }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Department <br> <i>Jabatan</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->jabatan }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Ministry <br> <i>Kementerian</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->kementerian }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Fixation Department Date<br> <i>Tarikh Penepatan Jawatan</i></div>
                                            <div class="col-lg-9 col-md-7">
                                                @if ($recordprofiles->isNotEmpty() && $recordprofiles->first()->tarikh_penepatan_jawatan)
                                                        {{ \Carbon\Carbon::parse($recordprofiles->first()->tarikh_penepatan_jawatan)->isoFormat('Do MMMM YYYY') }}
                                                @else
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Status <br> <i>Status</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->status }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Service scheme <br> <i>Skim Perkhidmatan</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->skim_perkhidmatan }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-link w-100 active">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 label">Teacher Scheme <br> <i>Skim Perguruan</i></div>
                                            <div class="col-lg-9 col-md-7">{{ $recordprofiles->first()->skim_perguruan }}</div>
                                        </div>
                                    </li>

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="services-justified" role="tabpanel" aria-labelledby="services-tab">
                    <!----- Create Service Records Button  ----->
                    <div class="row">
                        <div class="d-flex justify-content-between">
                            @if (!$recordprofiles->isEmpty())
                                @php
                                    $modified_no_ic = str_replace('/', '|', $recordprofiles->first()->no_ic);
                                @endphp
                                <a href="{{ route('pdms.servicecreateserviceform', ['no_ic' => $modified_no_ic]) }}" class="btn btn-primary text-right" style=" margin-bottom: 5px; margin-top: 10px; height: 2.39rem; padding-top: 10px;">
                                    <i class="bi bi-plus-lg"></i>
                                </a>
                                @if ($recordservices->isNotEmpty())
                                    @php
                                        $modified_no_ic = str_replace('/', '|', $recordservices->first()->no_ic);
                                    @endphp
                                    <a href="{{ route('pdms.print.serviceform', ['no_ic' => $modified_no_ic]) }}" class="btn text-right" style=" margin-bottom: 5px; margin-top: 10px; height: 2.39rem; padding-top: 10px; color: green; border-color: green">
                                        <i class="bi bi-printer"></i>
                                    </a>
                                @endif
                            @else
                            <a href="{{ route('pdms.servicecreateserviceform', ['no_ic' => $recordservices->first()->no_ic]) }}" class="btn btn-primary text-right" style=" margin-bottom: 5px; margin-top: 10px; height: 2.39rem; padding-top: 10px;">
                                <i class="bi bi-plus-lg"></i>
                            </a>
                            @endif
                        </div>
                    </div>   
                    <div class="col-lg-12" style="padding-left: 0px;  padding-right: 0px; padding-top: 15px;">
                        <div class="card recent-sales">
                            <div class="card-body overflow-auto">

                                <table class="table table-borderless datatable mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">RecordID</th>
                                            <th scope="col">Type of Service</th>
                                            <th scope="col">Position</th>
                                            <th scope="col">Date Start</th>
                                            <th scope="col">Date End</th>
                                            <th scope="col">Monthly Pay (Bnd)</th>
                                            <th scope="col">Rujukan</th>
                                            <th scope="col">Notes</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($recordservices) == null)
                                            <tr class="text-center">
                                                <td colspan="8">
                                                    <h5>No records found</h5>
                                                </td>
                                            </tr>
                                        @else
                                        @foreach ($recordservices as $recordservice)
                                        <tr>
                                            <td>{{ $recordservice->id_rekod }}</td>
                                            <td style="width: 20% !important;">
                                                @if ($recordservice->jenis_maklumat)
                                                    @php
                                                        $jenisMaklumat = $recordservice->jenis_maklumat;
                                                        if (is_string($jenisMaklumat)) {
                                                            // Check if it's a JSON array
                                                            $decoded = json_decode($jenisMaklumat);
                                                            $jenisMaklumat = ($decoded !== null && is_array($decoded)) ? $decoded : [$jenisMaklumat];
                                                        }
                                            
                                                        // Replace '/' with ', ' in each string of the array
                                                        foreach ($jenisMaklumat as &$item) {
                                                            $item = str_replace('/', ', ', $item);
                                                        }
                                            
                                                        $jenisMaklumatString = implode(', ', $jenisMaklumat);
                                                    @endphp
                                                    {{ $jenisMaklumatString }}
                                                @endif
                                            </td>                                           
                                            <td style="width: 9% !important;">{{ $recordservice->jawatan }}</td>
                                            <td style="width: 13% !important;">
                                                @if ($recordservice->tarikh_mula)
                                                    {{ date('d/m/Y', strtotime($recordservice->tarikh_mula)) }}
                                                @endif
                                            </td>
                                            <td style="width: 13% !important;">
                                                @if ($recordservice->tarikh_hingga)
                                                    {{ date('d/m/Y', strtotime($recordservice->tarikh_hingga)) }}
                                                @endif
                                            </td>
                                            <td style="width: 10.4294% !important;">
                                                @if ($recordservice->gaji_bulan != 0)
                                                    ${{ $recordservice->gaji_bulan }}
                                                @endif
                                            </td>
                                            <td style="width: 10.4294% !important;">{{ $recordservice->rujukan }}</td>
                                            <td style="width: 52.638% !important;">
                                                <div class="text-container" data-record-id="{{ $recordservice->id }}">
                                                    @if (strlen($recordservice->catitan) > 100)
                                                        <div class="limited-text" style="display: block;">
                                                            {{ Str::limit($recordservice->catitan, 100) }}
                                                        </div>
                                                        <div class="full-text" style="display: none;">
                                                            {{ $recordservice->catitan }}
                                                        </div>
                                                        <a href="#" class="read-more" style="color: rgb(42, 152, 156);">Read More</a>
                                                    @else
                                                        <div class="full-text">
                                                            {{ $recordservice->catitan }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td> 
                                                <div class="btn-group gap-2" role="group" aria-label="Basic example" style="height: 38px;"">
                                                    <!----Edit Button----->
                                                    <form method="get" action="{{ route('pdms.serviceeditserviceform' , ['no_ic' => $modified_no_ic, 'id_rekod' => $recordservice->id_rekod]) }}" style="margin-bottom:0px;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-primary" style="height: 100%;">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </button>
                                                    </form>
                                                    <!----Delete Button----->
                                                    <form id="deleteForm{{$recordservice->id}}" method="post" action="{{ route('pdms.servicedeleteserviceform' , ['no_ic' => $modified_no_ic, 'id_rekod' => $recordservice->id_rekod])}}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" class="btn btn-outline-danger delete-btn" style="height: 38px;" onclick="showDeleteConfirmationApproval({{ $recordservice->id }})">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                        
                                                    <!-- Add a modal for confirmation -->
                                                    <div class="modal" id="deleteConfirmationModalApproval{{ $recordservice->id }}" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Confirm Deletion</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval({{ $recordservice->id }})">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete this record?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $recordservice->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $recordservice->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
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
            width: 18%;
        }

        #viewall{
            padding-left: auto; 
            padding-right: auto;
            margin-left: 1%;
            height: 32px;
            width: 10%;
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
            width: 17.5% !important; 
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
    document.addEventListener('DOMContentLoaded', function () {
        // Add a click event listener to a common ancestor of "Read More" links
        document.querySelector('.datatable').addEventListener('click', function (event) {
            // Check if the clicked element is a "Read More" link
            if (event.target.classList.contains('read-more')) {
                event.preventDefault();

                // Find the parent container
                const container = event.target.closest('.text-container');

                // Toggle the display of the limited and full text based on data attribute
                const limitedText = container.querySelector('.limited-text');
                const fullText = container.querySelector('.full-text');

                limitedText.style.display = limitedText.style.display === 'none' ? 'block' : 'none';
                fullText.style.display = fullText.style.display === 'none' ? 'block' : 'none';

                // Change the text and color of the link based on the current state
                if (event.target.textContent === 'Read More') {
                    event.target.textContent = 'Read Less';
                    event.target.style.color = 'grey';
                } else {
                    event.target.textContent = 'Read More';
                    event.target.style.color = 'rgb(42, 152, 156)';
                }
            }
        });
    });
</script>

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
