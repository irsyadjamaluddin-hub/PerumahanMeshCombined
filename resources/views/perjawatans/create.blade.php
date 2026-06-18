@extends('layouts.app-all')

@section('title', 'Admin Create Perjawatan')

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
            <a href="{{ route('perjawatan.perjawatan.index') }}" class="btn btn-primary text-right">
                Back
            </a>
        </div>
    </div>

    <!-- ART Table -->
    <div class="col-xl-8">
        <div class="card mt-3">
            <div class="card-body pt-3">




                <!-- start pane tab 1 -->

                <div class="tab-content pt-2">


                    <!-- start pane tab 2 -->

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">


                        <!-- <h3 class="card-title">Perjawatan Info</h3> -->

                        <form class="" method="post" action="{{ route('perjawatan.perjawatan.store') }}" enctype="multipart/form-data">
                            @csrf



                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Nama Penuh <br> <i>Fullname</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="name" class="form-control">
                                    {!! $errors->first('name', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">No. Kad Pengenalan <br> <i>Identity Card No.</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="ic_no" placeholder="IC No. Eg. 00123456" class="form-control">
                                    {!! $errors->first('ic_no', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

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

                            <div class="row">
                                <div class="col-lg-4 col-md-3 label">Tarikh Lahir <br> <i>Date of Birth</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="date" id='first' name="dob" class="form-control">
                                    {!! $errors->first('dob', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>



                            <div class="row">
                                <label class="col-lg-4 col-md-3  label">Tempat Bertugas<br> <i>Work Placement</i></label>
                                <div class="col-lg-4 col-md-9">
                                    <select class="form-select" name="department">
                                        <option>Pilih Jabatan..</option>
                                        @foreach ($departmentonly as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('department', '<p class="help-block text-danger">:message</p>') !!}
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




                            <!-- 
                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Jabatan<br> <i>Department</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="department">
                                        <option>Pilih Jabatan</option>
                                        @foreach ($departmentonly as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('department', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Sekolah<br> <i>School</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="school">
                                        <option>Pilih Sekolah</option>

                                        @foreach ($school as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('school', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div> -->



                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tanggagaji<br> <i>Salary Scale</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="salary_scale">
                                        <option></option>
                                        @foreach ($salary_scale as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('salary_scale', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tarikh Lantikan<br> <i>Appointment Date</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="date" id="second" name="appt_date" class="form-control">
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
                                <div class="col-lg-4 col-md-3  label">Status Penetepan <br> <i>Assigned Status</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="employmentstatuss">
                                        <option></option>
                                        @foreach ($employmentstatuss as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('employmentstatuss', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Next</button>
                            </div>


                        </form>


                    </div>



                </div>
                <!-- end pane tab 1 -->


                <!-- End Bordered Tabs -->


            </div>
            <!-- end card body -->



        </div>
        <!-- end card recent sales -->

    </div>

    </div>
    <!-- table-->




</section>
@endsection