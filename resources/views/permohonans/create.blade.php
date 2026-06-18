@extends('layouts.app-all')

@section('title', 'Create PJK')

@section('content')

<?php
$pagename = "PJK";
?>

<div class="pagetitle">
    <h1>Permohonan Jawatan Kosong</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">PJK</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">


    <a href="{{ route('permohonans.permohonan.index') }}" class="btn btn-primary text-right mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>


    <div class="col-12 pt-3">
        <div class="card recent-sales">



            <div class="card-body">
                <div class="profile-overview pt-3">

                <div class="col profile-overview pt-3" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                    <h5 class="card-title" style="text-decoration: underline;">Butir Peribadi</h5>

                            @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        Upload Validation Error<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <form class="" method="post" action="{{ route('permohonans.permohonan.store') }}" enctype="multipart/form-data">
                        @csrf

                        @foreach($biodatas as $biodata)



                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Nama Penuh <br></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="bg-gray-200 form-control" value="{{$biodata->name}}" readonly>
                                <input type="text" name="name" class="bg-gray-200 form-control" value="{{$biodata->name}}" hidden>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">No. Kad Pengenalan <br> <i></i></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="bg-gray-200 form-control" value="{{Auth::user()->ic_no}}" readonly>
                            </div>
                        </div>


                        @endforeach

                        @foreach($contacts as $contact)

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Email <br> <i></i></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" name="email" value="{{Auth::user()->email}}" class="form-control" readonly>
                                {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
                            </div>

                        </div>

                        @endforeach

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Jabatan <br> <i></i></div>
                            <div class="col-lg-8 col-md-9">

                                @foreach($employments as $employment)

                                <input type="text" class="bg-gray-200 form-control" name="department_id" value="{{ optional($employment->department)->label }}" readonly>
                                <input type="hidden" name="department_id" class="bg-gray-200 form-control" value="{{ $employment->department_id }}" hidden>

                                @endforeach

                                {!! $errors->first('department_id', '<p class="help-block text-danger">:message</p>') !!}

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Tempat Bertugas (Bahagian/Unit) <br> <i></i></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" name="place" class="form-control">
                                {!! $errors->first('place', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>

                        
                        <h5 class="card-title" style="text-decoration: underline;">Jawatan Yang Dipohonkan</h5>


                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Nama Jawatan <br> <i></i></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" name="nama_jawatan" class="form-control">
                                {!! $errors->first('nama_jawatan', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Tarikh Tutup Iklan <br> <i></i></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="date" name="tarikh_tutup" class="form-control">
                                {!! $errors->first('tarikh_tutup', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Jabatan/Kementerian <br> <i></i></div>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" name="jabatan_kementerian" class="form-control">
                                {!! $errors->first('jabatan_kementerian', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>


                        <h5 class="card-title" style="text-decoration: underline;">Prestasi</h5>


                        <div class="card">

                            <table class="table-achiev" id="tableprestasi">
                                <thead>
                                    <tr>


                                        <th style="text-align: center;">Year</th>
                                        <th style="text-align: center;">Percentage (%)</th>
                                        <th style="text-align: center;">Grade</th>
                                        <th style="text-align: center;">File</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>

                                        @if(count($performances1) == 0)
                                        <td>
                                            <input type="number" min="1980" minlength="4" maxlength="4" name=" year1" placeholder="Year (Tahun)" class="form-control">
                                            {!! $errors->first('year1', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>

                                        <td>
                                            <input type="text" name="percentage1" class="form-control">
                                            {!! $errors->first('percentage1', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>


                                           <td>
                                                <select class="form-select" name="grade_id1">
                                                    <option></option>
                                                    @foreach ($grades as $key => $value)
                                                    <option value="{{ $key }}">
                                                        {{ $value }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('grade_id1', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                        <td>
                                            <input type="file" name="file_1" class="form-control">
                                            {!! $errors->first('file_1', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>

                                        @else
                                        @foreach($performances1 as $perf1)


                                        <td>
                                            {{ ($perf1->year)}}
                                        </td>

                                        <td>
                                            {{$perf1->percentage}}
                                        </td>

                                          <td>{{ optional($perf1->Grade)->label }}</td>

                                        <td>
                                            <a href='{{Storage::url("$perf1->file_1") }}' target="_blank">View</a>
                                        </td>

                                        @endforeach
                                        @endif
                                    </tr>

                                    <tr>

                                        @if(count($performances2) == 0)
                                        <td>
                                            <input type="number" min="1980" minlength="4" maxlength="4" name=" year2" placeholder="Year (Tahun)" class="form-control">
                                            {!! $errors->first('year2', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>

                                        <td>
                                            <input type="text" name="percentage2" class="form-control">
                                            {!! $errors->first('percentage2', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>


                                        <td>
                                                <select class="form-select" name="grade_id2">
                                                    <option></option>
                                                    @foreach ($grades as $key => $value)
                                                    <option value="{{ $key }}">
                                                        {{ $value }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('grade_id2', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                        <td>
                                            <input type="file" name="file_2" class="form-control">
                                            {!! $errors->first('file_2', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>

                                        @else
                                        @foreach($performances2 as $perf2)


                                        <td>
                                            {{ ($perf2->year) }}
                                        </td>

                                        <td>
                                            {{$perf2->percentage}}
                                        </td>

                                         <td>{{ optional($perf2->Grade)->label }}</td>

                                        <td>
                                            <a href='{{Storage::url("$perf2->file_1") }}' target="_blank">View</a>
                                        </td>

                                        @endforeach
                                        @endif
                                    </tr>


                                    <tr>

                                        @if(count($performances3) == 0)
                                        <td>
                                            <input type="number" min="1980" minlength="4" maxlength="4" name=" year3" placeholder="Year (Tahun)" class="form-control">
                                            {!! $errors->first('year3', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>

                                        <td>
                                            <input type="text" name="percentage3" class="form-control">
                                            {!! $errors->first('percentage3', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>

                                          <td>
                                                <select class="form-select" name="grade_id3">
                                                    <option></option>
                                                    @foreach ($grades as $key => $value)
                                                    <option value="{{ $key }}">
                                                        {{ $value }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('grade_id3', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>



                                        <td>
                                            <input type="file" name="file_3" class="form-control">
                                            {!! $errors->first('file_3', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>

                                        @else
                                        @foreach($performances3 as $perf3)


                                        <td>
                                            {{ ($perf3->year) }}
                                        </td>

                                        <td>
                                            {{$perf3->percentage}}
                                        </td>

                                         <td>{{ optional($perf3->Grade)->label }}</td>

                                        <td>
                                            <a href='{{Storage::url("$perf3->file_1") }}' target="_blank">View</a>
                                        </td>

                                        @endforeach
                                        @endif
                                    </tr>

                                    <tr>

                                        @if(count($performances4) == 0)
                                        <td>
                                            <input type="number" min="1980" minlength="4" maxlength="4" name=" year4" placeholder="Year (Tahun)" class="form-control">
                                            {!! $errors->first('year4', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>

                                        <td>
                                            <input type="text" name="percentage4" class="form-control">
                                            {!! $errors->first('percentage4', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>

                                        <td>
                                                <select class="form-select" name="grade_id4">
                                                    <option></option>
                                                    @foreach ($grades as $key => $value)
                                                    <option value="{{ $key }}">
                                                        {{ $value }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('grade_id4', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                        <td>
                                            <input type="file" name="file_4" class="form-control">
                                            {!! $errors->first('file_4', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>

                                        @else
                                        @foreach($performances4 as $perf4)


                                        <td>
                                            {{($perf4->year) }}
                                        </td>

                                        <td>
                                            {{$perf4->percentage}}
                                        </td>

                                          <td>{{ optional($perf4->Grade)->label }}</td>

                                        <td>
                                            <a href='{{Storage::url("$perf4->file_1") }}' target="_blank">View</a>
                                        </td>

                                        @endforeach
                                        @endif
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <h5 class="card-title" style="text-decoration: underline;">File</h5>

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">#</th> -->
                                    <th scope="col"></th>
                                    <th scope="col">Download</th>
                                    <th scope="col">Upload</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td>Borang Pengesahan Ketua Jabatan</td>
                                    <td>
                                        <a href='{{Storage::url("permohonan/BorangPengesahanKetuaJabatan.pdf") }}' target="_blank">
                                            <div class="btn btn-outline-primary">
                                                <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                            </div>
                                        </a>
                                    </td>

                                    <td>
                                        <input type="file" name="file" class="form-control">
                                        {!! $errors->first('file', '<p class="help-block text-danger">:message</p>') !!}
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->

                        <br>



                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>


                </div>

            </div>


        </div>

    </div>
    </div><!-- End Recent Sales -->
    </div>

    </div>


</section>
@endsection