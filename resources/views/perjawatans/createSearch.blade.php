@extends('layouts.app-all')

@section('title', 'Admin Search Perjawatan')

@section('content')

<?php
$pagename = "Admin_Perjawatan";
?>

<div class="pagetitle">
    <h1>Perjawatan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Perjawatan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <div class="row mb-2">

        <div class="col-md-11">

            <div class="search-bar">
                <!-- Start Search Bar -->
                <form class="search-form d-flex align-items-center" method="get" action="{{ route('perjawatan.perjawatan.search') }}">
                    @csrf
                    <input type="text" name="ic_search" class="form-control" placeholder="Search IC No. Eg. 00123456">

                    <button type="submit" class="btn btn-primary" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div><!-- End IC No Search Bar -->

        </div>

        <div class="col-md-1">
            <a href="{{ route('perjawatan.perjawatan.create') }}" class="btn btn-primary text-right">
                Back
            </a>
        </div>
    </div>

    <!-- ART Table -->
    <div class="col-12">
        <div class="card recent-sales">



            <div class="card-body">

                <div class="profile-overview pt-3">

                    <h3 class="card-title">Perjawatan Info</h3>



                    <form class="" method="post" action="{{ route('perjawatan.perjawatan.store') }}" enctype="multipart/form-data">
                        @csrf


                        @if(count($biodatas) == 0)

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Ralat <br> <i>Error</i></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="bg-gray-200 text-danger form-control" value="IC Number Not found, Try Again" readonly>

                            </div>
                        </div>

                        @else

                        @foreach($biodatas as $biodata)

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Nama Penuh <br> <i>Fullname</i></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="bg-gray-200 form-control" value="{{$biodata->name}}" readonly>
                                <input type="text" name="name" placeholder="IC No. Eg. 00123456" class="bg-gray-200 form-control" value="{{$biodata->name}}" hidden>


                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">No. Kad Pengenalan <br> <i>Identity Card No.</i></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="bg-gray-200 form-control" value="{{$id}}" readonly>
                                <input type="text" name="ic_no" class="bg-gray-200 form-control" value="{{$id}}" hidden>
                            </div>
                        </div>

                        @endforeach



                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">No Folio <br> <i>No File</i></div>
                            <div class="col-lg-4 col-md-3">
                                <input type="text" name="nofolio" class="form-control" placeholder="Number File">
                                {!! $errors->first('nofolio', '<p class="help-block text-danger">:message</p>') !!}
                            </div>

                            <div class="col-lg-4 col-md-3">
                                <input type="month" name="month" class="form-control" placeholder="Month">
                                {!! $errors->first('month', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>

                        @foreach($biodatas as $biodata)
                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Tarikh Lahir <br> <i>Date of Birth</i></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="bg-gray-200 form-control" value="{{$biodata->dob}}" readonly>
                                <input type="text" name="dob" class="bg-gray-200 form-control" value="{{$biodata->dob}}" hidden>
                            </div>
                        </div>
                        @endforeach

                        @foreach($employment as $employment)
                        <!-- <div class="row">
                            <div class="col-lg-4 col-md-3  label">Jabatan<br> <i>Department</i></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="bg-gray-200 form-control" value="{{optional($employment->department)->label}}" readonly>
                                <input type="text" name="department" class="bg-gray-200 form-control" value="{{$employment->department_id}}" hidden>
                            </div>
                        </div> -->

                        <div class="row">
                            <label class="col-lg-4 col-md-3  label">Tempat Bertugas<br> <i>Work Placement</i></label>

                            <div class="col-lg-4 col-md-9">
                                <input type="text" class="bg-gray-200 form-control" value="{{optional($employment->department)->label}}" readonly>
                                <input type="text" name="department" class="bg-gray-200 form-control" value="{{$employment->department_id}}" hidden>
                            </div>

                            <div class="col-lg-4 col-md-9">

                                <select class="form-select" name="school">
                                    <option>Pilih Sekolah...</option>
                                    @foreach ($school as $key => $value)
                                    <option value="{{ $key }}">
                                        {{ $value }}
                                    </option>
                                    @endforeach
                                </select>
                                {!! $errors->first('school', '<p class="help-block text-danger">:message</p>') !!}

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Tanggagaji<br> <i>Salary Scale</i></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="bg-gray-200 form-control" value="{{ optional($employment->salaryScale)->label}}" readonly>
                                <input type="text" name="salary_scale" class="bg-gray-200 form-control" value="{{ $employment->salary_scale }}" hidden>
                            </div>
                        </div>





                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Tarikh Lantikan<br> <i>Appointment Date</i></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="date" name="appt_date" class="form-control" value="{{ old('appt_date') }}">
                                {!! $errors->first('appt_date', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Tarikh Kenaikan<br> <i>Increment Date</i></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="date" id="third" name="promoted_date" class="form-control">
                                {!! $errors->first('promoted_date', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Tarikh Tetap Jawatan<br> <i>Date Appointed Position </i></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="date" id="fourth" name="tetap_jawatan_date" class="form-control">
                                {!! $errors->first('tetap_jawatan_date', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Status Penetepan<br> <i>Assigned Status</i></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="bg-gray-200 form-control" value="{{optional($employment->employmentstatus)->label}}" readonly>

                                <input type="text" name="employmentstatuss" class="bg-gray-200 form-control" value="{{$employment->employment_status_id }}" hidden>
                            </div>
                        </div>
                        @endforeach
                        @endif



                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Next</button>
                        </div>

                    </form>


                </div>

            </div>


        </div>

    </div>
    </div><!-- End Recent Sales -->

    </div>


</section>
@endsection