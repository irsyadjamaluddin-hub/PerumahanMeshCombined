@extends('layouts.app-all')

@section('title', 'Admin Edit Perjawatan')

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



                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                        <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#profile-overview">Info</button>
                    </li>

                    <!-- <li><a href="{{ route('perjawatan.perjawatan.create') }}">Perjawatan Info</a></li> -->

                    <li class="nav-item">
                        <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#profile-achiev">Perjawatan</button>
                    </li>

                </ul>

                <!-- start pane tab 1 -->

                <div class="tab-content pt-2">


                    <!-- start pane tab 2 -->

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">


                        <h3 class="card-title">Edit Perjawatan Info</h3>

                        <form class="" method="post" action="{{ route('perjawatan.perjawatan.update') }}" enctype="multipart/form-data">
                            @csrf

                            @foreach ($perjawatans as $jawatan)

                            <input type="text" name="id" class="bg-gray-200 form-control " value="{{$jawatan->id}}" hidden>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Nama Penuh <br> <i>Fullname</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="name" class="bg-gray-200 form-control " value="{{$jawatan->name}}" readonly>
                                    {!! $errors->first('name', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">No. Kad Pengenalan <br> <i>Identity Card No.</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="ic_no" class="bg-gray-200 form-control" value="{{$jawatan->ic_no}}" readonly>
                                    {!! $errors->first('ic_no', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">No Folio <br> <i>No File</i></div>
                                <div class="col-lg-4 col-md-3">
                                    <input type="text" name="nofolio" class="form-control" placeholder="Number File" value="{{$jawatan->nofolio}}">
                                    {!! $errors->first('nofolio', '<p class="help-block text-danger">:message</p>') !!}
                                </div>

                                <div class="col-lg-4 col-md-3">
                                    <input type="month" name="month" class="form-control" placeholder="Month" value="{{$jawatan->month}}">
                                    {!! $errors->first('month', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>
                            @foreach ($biodatas as $biodata)

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tarikh Lahir <br> <i>Date of Birth</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="date" id="first" name="dob" class="form-control" value="{{$biodata->dob}}">
                                    {!! $errors->first('dob', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            @endforeach

                            <div class="row">
                                <label class="col-lg-4 col-md-3  label">Tempat Bertugas<br> <i>Work Placement</i></label>
                                <div class="col-lg-4 col-md-9">
                                    <input type="text" name="department" class="form-control" value="{{optional($jawatan->Department)->label }}" readonly>
                                    {!! $errors->first('department', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                                <div class="col-lg-4 col-md-9">
                                    <select class="form-select" name="school">

                                        <option value="{{ $jawatan->school}}">{{ optional($jawatan->School)->label }} </option>
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
                                <div class="col-lg-4 col-md-3  label">Tanggagaji<br> <i> Salary Scale</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="salary_scale">
                                        <option value="{{ $jawatan->salary_scale }}">{{ optional($jawatan->salaryScale)->label }} </option>
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
                                    <input type="date" id="second" name="appt_date" class="form-control" value="{{$jawatan->appt_date}}">
                                    {!! $errors->first('appt_date', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tarikh Kenaikan<br> <i>Promoted Date</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="date" id="third" name="promoted_date" class="form-control" value="{{$jawatan->promoted_date}}">
                                    {!! $errors->first('promoted_date', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tarikh Tetap Jawatan<br> <i>Date Appointed Position</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="date" id="fourth" name="tetap_jawatan_date" class="form-control" value="{{$jawatan->tetap_jawatan_date}}">
                                    {!! $errors->first('tetap_jawatan_date', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Status Penetepan<br> <i>Assigned Status</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="employmentstatuss">
                                        <option value="{{ $jawatan->employmentstatuss }}">{{ optional($jawatan->EmploymentStatus)->label }}</option>
                                        @foreach ($employmentstatuss as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('employmentstatuss', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            @endforeach



                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </form>

                    </div>

                    @include ('perjawatans.documents', ['perjawatan' => $perjawatans,])

                    {!! Form::close() !!}

                    @include ('perjawatans.documents')


                </div>


            </div>

        </div>
    </div><!-- End Recent Sales -->

    </div>


</section>
@endsection