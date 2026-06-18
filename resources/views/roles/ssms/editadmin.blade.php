@extends('layouts.app-all')

@section('title', 'Admin Edit SSM')

@section('content')

<?php
$pagename = "Admin_Edit_SSM";
?>

<div class="pagetitle">
    <h1>Edit Akaun SSM</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">User</li>
            <li class="breadcrumb-item active">Edit Akaun SSM</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <div class="col-12">
        <div class="card">
            <div class="card-body pt-2">

                <h3 class="card-title">Mengaktifkan Akaun SSM<br> <i>SSM Activation</i></h3>

                <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                    @foreach ($biodatas as $biodata)

                    <div class="row">
                        <div class="col-lg-2 label">Nama Penuh <br> <i>Full Name</i></div>
                        <div class="col-lg-4">{{ ucwords(trans ($biodata->name)) }}</div>

                        <div class="col-lg-2 label">No. Kad Pengenalan <br> <i>Identity Card No.</i></div>
                        <div class="col-lg-4">{{ $biodata->ic_no }}</div>
                    </div>


                    <div class="row">
                        @foreach($contacts as $contact)
                        <div class="col-lg-2 label">Alamat <br> <i>Address</i></div>
                        <div class="col-lg-4">{{ $contact->address }}</div>
                        @endforeach
                        <div class="col-lg-2 label">Tempat Lahir<br> <i> Place of Birth </i></div>
                        <div class="col-lg-4">{{ $biodata->place_of_birth }}</div>
                    </div>



                    <div class="row">
                        <div class="col-lg-2 label">Jantina <br> <i>Gender</i></div>
                        <div class="col-lg-10">{{ optional($biodata->gender)->label }}</div>
                    </div>
                    @endforeach

                    <div class="row">
                        @foreach($employments as $employment)
                        <div class="col-lg-2 label">Jawatan<br> <i>Designation </i></div>
                        <div class="col-lg-4">{{ $employment->current_designation_id }}</div>

                        <div class="col-lg-2 label">Tempat Bertugas Jawatan<br> <i>Designation Placement</i></div>
                        <div class="col-lg-4 ">{{ $employment->current_service_place }}</div>
                        @endforeach
                    </div>

                    @foreach($bersaras as $bersara)

                    <div class="row">
                        <div class="col-lg-3 label">Tarikh Bersara<br> <i> Date of Retirement </i></div>
                        <div class="col-lg-9">{{ $biodata->bersara_date}}</div>
                    </div>

                    @endforeach

                    <div class="row">
                        @foreach($contacts as $contact)
                        <div class="col-lg-2 label">No. Telefon Bimbit <br> <i>No. Telephone Mobile</i></div>
                        <div class="col-lg-4">{{ $contact->telephone_mobile }}</div>

                        <div class="col-lg-2 label">Emel <br> <i>Email</i></div>
                        <div class="col-lg-4">{{ Auth::user()->email }}</div>
                        @endforeach
                    </div>

                    @foreach($biodatas as $biodata)
                    <div class="row">

                        <div class="col-lg-2 label">Status Kelamin <br> <i>Martial Status</i></div>
                        <div class="col-lg-4">{{ optional($biodata->maritalStatus)->label }}</div>

                        <div class="col-lg-2 label">Bangsa <br> <i> Race </i></div>
                        <div class="col-lg-4">@if( $biodata->race_id == '10') <p>{{ $biodata->race_other }}</p> @else{{ optional($biodata->race)->label }}@endif</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2 label">Agama <br> <i> Religion </i></div>
                        <div class="col-lg-10">@if( $biodata->religion_id == '4') <p>{{ $biodata->religion_other }}</p> @else{{ optional($biodata->religion)->label }}@endif</div>
                    </div>

                    @endforeach
                </div>
                <br>
                <br>
                <div class="col" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h3 class="card-title" style="padding: 0px;">Dokumen<br> <i>Documents</i></h3>
                    <hr>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Dokumen / Document</th>
                                <th scope="col">Fail / File</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($files as $file)
                            <tr>
                                <td scope="row">Salinan Kad Pengenalan <br> <i> IC Copy </i></td>
                                <td><a href='{{Storage::url("$file->ic_file") }}' target="_blank">{{ $file->ic_filename }}</a></td>

                            </tr>
                            <tr>
                                <td scope="row">Surat Lantikan <br> <i> Appointment Letter </i></td>
                                <td><a href='{{Storage::url("$file->apptletter_file") }}' target="_blank">{{ $file->apptletter_filename }}</ </tr>
                            <tr>
                                <td scope="row">Surat Melapor Diri <br> <i> Reporting Letter </i></td>
                                <td><a href='{{Storage::url("$file->workreport_file") }}' target="_blank">{{ $file->workreport_filename }}</a></td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
                <br>
                <br>
                <div class="col" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h3 class="card-title" style="padding: 0px;">Tindakan (Admin)<br> <i>Action</i></h3>
                    <hr>


                    @foreach ($ssms as $ssm)

                    <form class="" method="post" action="{{ route('ssms.ssm.updateadmin')}}" enctype="multipart/form-data">

                        @csrf

                        <input type="text" name="id" class="bg-gray-200 form-control " value="{{$ssm->id}}" hidden>

                        <div class="row mb-3" hidden>
                            <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="bg-gray-200 form-control" value="{{$ssm->name}}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3" hidden>
                            <label for="inputText" class="col-sm-2 col-form-label">No Kad Pengenalan </label>
                            <div class="col-sm-10">
                                <input type="text" class="bg-gray-200 form-control" value="{{$ssm->ic_no}}" readonly>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="status_ssm" aria-label="Default select example">
                                    <option selected>Select Status</option>
                                    <option value="Di hadapkan Ke JPA">Di hadapkan Ke JPA</option>
                                    <option value="SSM Helpdesk">SSM Helpdesk</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Position ID</label>
                            <div class="col-sm-10"><input type="text" name="position_id" class="form-control"></div>
                        </div>

                        @foreach($employments as $employment)


                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Jabatan</label>

                            <div class="col-sm-10">
                                <input type="text" class="bg-gray-200 form-control" value="{{ optional($employment->department)->label }}" readonly>
                            </div>
                        </div>

                        @endforeach

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10"><input type="text" name="password" class="form-control"></div>
                        </div>

                        <div class="text-center mt-3">

                            <button type="submit" class="btn btn-primary" href="">Submit</button>
                        </div>
                    </form>

                    @endforeach

                </div>

            </div>
        </div>
    </div>


</section>
@endsection