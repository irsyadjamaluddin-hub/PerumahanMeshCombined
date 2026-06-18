@extends('layouts.app-all')

@section('title', 'Admin Show Perjawatan')

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
    <div class="row">

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


                            <h5 class="card-title"></h5>


                            @foreach ($perjawatans as $jawatan)



                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Nama Penuh <br> <i>Full Name</i></div>
                                <div class="col-lg-8 col-md-9">{{ ucwords(trans ($jawatan->name)) }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3 label">No. Kad Pengenalan <br> <i>Identity Card No.</i></div>
                                <div class="col-lg-8 col-md-9">{{ $jawatan->ic_no }}</div>
                            </div>



                            <div class="row">
                                <div class="col-lg-2 label">No Folio <br> <i> No File</i></div>
                                <div class="col-lg-4">{{ $jawatan->nofolio }}</div>

                                <div class="col-lg-2 label">Bulan <br> <i>Month</i></div>
                                <div class="col-lg-4">{{ date('F', strtotime ($jawatan->month))}}</div>
                            </div>


                            <div class="row">
                                <div class="col-lg-4 col-md-3 label">Tarikh Lahir <br> <i>Date of Birth</i></div>
                                @if ($jawatan->dob==null)
                                <div></div>
                                @else
                                <div class="col-lg-8 col-md-9">{{ date('d/m/Y', strtotime ($jawatan->dob)) }}</div>
                                @endif
                            </div>


                            <div class="row">
                                <div class="col-lg-4 col-md-3 label">Jabatan<br> <i>Department</i></div>
                                <div class="col-lg-8 col-md-9">{{optional($jawatan->Department)->label }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3 label">Sekolah<br> <i>School</i></div>
                                <div class="col-lg-8 col-md-9">{{optional($jawatan->School)->label }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3 label">Tanggagaji<br> <i>Salary Scale</i></div>
                                <div class="col-lg-8 col-md-9">{{ optional($jawatan->salaryScale)->label }}</div>
                            </div>





                            <div class="row">
                                <div class="col-lg-4 col-md-3 label">Tarikh Lantikan<br> <i>Appointment Date</i></div>
                                @if ($jawatan->appt_date==null)
                                <div></div>
                                @else
                                <div class="col-lg-8 col-md-9">{{ date('d/m/Y', strtotime($jawatan->appt_date))}}</div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3 label">Tarikh Kenaikan<br> <i>Promoted Date </i></div>
                                @if ($jawatan->promoted_date==null)
                                <div></div>
                                @else
                                <div class="col-lg-8 col-md-9">{{ date('d/m/Y', strtotime($jawatan->promoted_date))}}</div>
                                @endif

                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3 label">Tarikh Tetap Jawatan<br> <i>Date Appointed Position </i></div>
                                @if($jawatan->tetap_jawatan_date==null)
                                <div></div>
                                @else
                                <div class="col-lg-8 col-md-9">{{ date('d/m/Y', strtotime($jawatan->promoted_date))}}</div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3 label">Status Penetepan<br> <i>Assigned Status</i></div>
                                <div class="col-lg-8 col-md-9"> {{ optional($jawatan->EmploymentStatus)->label }} </div>

                            </div>

                            @endforeach
                        </div>




                        <!--TABLE -->

                        <div class="tab-pane fade profile-overview pt-3" id="profile-achiev">
                            <h5 class="card-header text-lg font-extrabold text-center">Kadar Kenaikan Gaji</h5>

                            {{-- Kadar Kenaikan Gaji --}}
                            <div class="card">

                                <form>
                                    <table class="table-achiev overflow-auto">
                                        <thead>
                                            <tr>

                                                <th>Bil</th>
                                                <th>Tahun</th>
                                                <th>Jenis Kenaikan</th>
                                                <th>Tarikh</th>
                                                <th>Gaji</th>
                                                <th>Attachment</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if(count($kadarperjawatans) == 0)

                                            <tr class="text-center">
                                                <td colspan="8">
                                                    <h5>No records found</h5>
                                                </td>
                                            </tr>

                                            @else
                                            @foreach( $kadarperjawatans as $kadarjawatan )

                                            <tr>

                                                <td scope="row">{{ $loop->iteration }}</td>
                                                <td>{{$kadarjawatan->year}}</td>
                                                <td>{{$kadarjawatan->jeniskenaikan}}</td>
                                                <!-- <td>{{ optional($kadarjawatan->JenisKenaikan)->label }}</td> -->
                                                <td>{{$kadarjawatan->promoted_date}}</td>
                                                <td>{{$kadarjawatan->gaji}}</td>
                                                <td><a href='{{Storage::url("$kadarjawatan->file_1") }}' target="_blank">View</a></td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </form>


                            </div>
                            {{-- Kadar Kenaikan Gaji ends --}}

                            {{-- Attachment File --}}

                            <div class="card">
                                <h5 class="card-header text-lg font-extrabold text-center">Attachment</h5>

                                <form>
                                    <table class="table-achiev">
                                        <thead>
                                            <tr>
                                                <th>Bil</th>
                                                <th>Attachment</th>
                                                <th>Remarks by</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if(count( $attachmentperjawatans) == 0)

                                            <tr class="text-center">
                                                <td colspan="8">
                                                    <h5>No records found</h5>
                                                </td>
                                            </tr>

                                            @else
                                            @foreach( $attachmentperjawatans as $attachperjawatan )

                                            <tr>

                                                <td scope="row">{{ $loop->iteration }}</td>

                                                <td><a href='{{Storage::url("$attachperjawatan->file_1") }}' target="_blank">View</a></td>
                                                <td>{{$attachperjawatan->name}}</td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </form>

                            </div>
                            {{-- Attachment ENDS--}}


                        </div><!-- End Achievement Collapse -->
                    </div><!-- End Achievement Tab -->
                </div>
                <!-- End Bordered Tabs -->

            </div>

        </div>
    </div>
</section>


@endsection