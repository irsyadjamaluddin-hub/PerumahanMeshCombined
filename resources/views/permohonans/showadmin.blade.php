@extends('layouts.app-all')

@section('title', 'Admin Show PJK')

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


    <a href="{{ route('permohonans.permohonan.indexadmin') }}" class="btn btn-primary text-right mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>


    <!-- QO Table -->
    <div class="col-12">
        <div class="card recent-sales">



            <div class="card-body">

                <div class="profile-overview pt-3">


                    <div class="col" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h3 class="card-title" style="text-decoration: underline;">Tindakan (Admin)</h3>

                        @foreach($permohonans as $permohonan)
                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Tindakan: </div>

                            <div class="col-lg-8 col-md-9">


                                @if($permohonan->tindakan == null)
                                <td></td>
                                @else
                                <div class="col-sm-10">
                                    {{ $permohonan->tindakan }}
                                </div>
                                @endif
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Tarikh Disahkan: </div>
                            <div class="col-lg-8 col-md-9">

                                @if ($permohonan ->tarikh_sah==null)
                                <td> </td>
                                @else
                                <td>{{ date('d/m/Y', strtotime($permohonan->tarikh_sah)) }}</td>
                                @endif


                            </div>
                        </div>

                        @endforeach
                    </div>

                    <br>

                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h5 class="card-title" style="text-decoration: underline;">Butir Peribadi</h5>

                        @foreach($biodatas as $biodata)

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Nama Penuh <br></div>
                            <div class="col-lg-8 col-md-9">{{$biodata->name}}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">No. Kad Pengenalan </div>
                            <div class="col-lg-8 col-md-9">{{$biodata->ic_no}} </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Email</div>
                            <div class="col-lg-8 col-md-9"> {{$biodata->email}}</div>
                        </div>

                        @endforeach


                        @foreach($employments as $employment)

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Jabatan </div>
                            <div class="col-lg-8 col-md-9">{{optional($employment->department)->label}}</div>
                        </div>
                        @endforeach



                        @foreach ($permohonans as $permohonan)

                        <input type="text" name="id" class="bg-gray-200 form-control " value="{{$permohonan->id}}" hidden>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Tempat Bertugas (Bahagian/Unit) </div>
                            <div class="col-lg-8 col-md-9">
                                {{$permohonan->place}}
                            </div>
                        </div>


                        <h5 class="card-title" style="text-decoration: underline;">Jawatan Yang Dipohonkan</h5>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Nama Jawatan </div>
                            <div class="col-lg-8 col-md-9">
                                {{ $permohonan->nama_jawatan}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Tarikh Tutup Iklan </div>
                            <div class="col-lg-8 col-md-9">

                                {{ date('d/m/Y', strtotime($permohonan->tarikh_tutup)) }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Jabatan/Kementerian </div>
                            <div class="col-lg-8 col-md-9">
                                {{ $permohonan->jabatan_kementerian }}
                            </div>
                        </div>

                        @endforeach


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
                                        <td> </td>

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
                                        <td></td>

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
                                        <td></td>

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


                                @foreach($permohonans as $permohonan)
                                <tr>

                                    <td>Borang Pengesahan Ketua Jabatan</td>
                                    <td>
                                        <a href='{{Storage::url("permohonan/BorangPengesahanKetuaJabatan.pdf") }}' target="_blank">
                                            <div class="btn btn-outline-primary">
                                                <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                            </div>
                                        </a>
                                    </td>

                                    <input type="text" value="{{$permohonan->id}}" name="id" hidden>

                                    <td>
                                        <div class="row">

                                            <div class="col-lg-8 col-md-9">



                                                <a href='{{Storage::url("$permohonan->file") }}' target="_blank">
                                                    <p> <i>View Uploaded File </i></p>
                                                </a>





                                            </div>
                                        </div>
                                    </td>

                                </tr>

                    </div>

                    @endforeach
                    </tbody>
                    </table>


                </div>

            </div>


        </div>

    </div>




</section>
@endsection