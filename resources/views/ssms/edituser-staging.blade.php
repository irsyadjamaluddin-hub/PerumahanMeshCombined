@extends('layouts.app-all')

@section('title', 'User Edit SSM')

@section('content')

    <?php
        $pagename = "Edit_SSM";
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
    </div>

    <section class="section profile">

        <div class="card">

            <div class="card-body pt-3">

                @foreach ($ssms as $ssm)
                    
                    <form class="" method="post" action="{{ route('ssms.ssm.updateuser.staging')}}" enctype="multipart/form-data">
                    
                        @csrf

                        <input type="text" name="id" class="bg-gray-200 form-control " value="{{$ssm->id}}" hidden>

                        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                            @foreach ($biodatas as $biodata)

                                <div class="row">
                                    <div class="col-lg-3 label">Nama Penuh</div>
                                    <div class="col-lg-9">
                                        <input type="text" name="name" class="form-control" value="{{$biodata->name}}" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 label">No. Kad Pengenalan</div>
                                    <div class="col-lg-9">
                                        <input type="text" name="ic_no" class="form-control" value="{{Auth::user()->ic_no}}" readonly>
                                    </div>
                                </div>

                                @foreach($contacts as $contact)
                                    <div class="row">
                                        <div class="col-lg-3 label">Alamat</div>
                                        <div class="col-lg-9">
                                            <input type="text" name="address" class="form-control" value="{{$contact->address}}" readonly>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="row">
                                    <div class="col-lg-3 label">Tarikh Lahir</div>
                                    <div class="col-lg-9">
                                        <input type="date" name="dob" class="form-control" value="{{$biodata->dob}}" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 label">Tempat Lahir</div>
                                    <div class="col-lg-9">
                                        <input type="text" name="place_of_birth" class="form-control" value="{{$biodata->place_of_birth}}" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 label">Jantina<br> <i>Gender</i></div>
                                    <div class="col-lg-9">
                                        <input type="text" name="gender" class="form-control" value="{{optional($biodata->gender)->label}}" readonly>
                                    </div>
                                </div>

                            @endforeach

                            @foreach($employments as $employment)

                                <div class="row">
                                    <div class="col-lg-3 label">Jawatan</div>
                                    <div class="col-lg-9">
                                        <input type="text" name="current_designation_id" class="form-control" value="{{ $employment->current_designation_id }}" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 label">Tempat Bertugas Jawatan</div>
                                    <div class="col-lg-9">
                                        <input type="text" name="current_service_place" class="form-control" value="{{$employment->current_service_place}}" readonly>
                                    </div>
                                </div>

                            @endforeach

                            <div class="row">
                                <div class="col-lg-3 label">Tarikh Bersara<br> <i>Date of Retirement</i></div>
                                <div class="col-lg-9">
                                    <input type="text" name="bersara_date" class="form-control" value="{{$bersara_date = \Carbon\Carbon::parse($biodata->dob)->addYears(60)->format('Y-m-d');}}" readonly>
                                </div>
                            </div>

                            @foreach($bersaras as $bersara)
                                <div class="row">                    
                                    <div class="col-lg-3 label">Terikh Bersara<br> <i>Date of Retirement</i></div>
                                    <div class="col-lg-9">
                                        <input type="text" name="bersara_date" class="bg-gray-200 form-control" value="{{$biodata->bersara_date}}" readonly>
                                    </div>
                                </div>
                            @endforeach

                            @foreach($contacts as $contact)
                                <div class="row">
                                    <div class="col-lg-3 col-md-5  label">No. Telefon Bimbit<br> <i>No. Telephone Mobile</i></div>
                                    <div class="col-lg-9 col-md-7">
                                        <input type="text" name="telephone_mobile" class="bg-gray-200 form-control" value="{{$contact->telephone_mobile}}" readonly>
                                    </div>
                                </div>
                                        
                                <div class="row">
                                    <div class="col-lg-3 col-md-5  label">Emel<br> <i>Email</i></div>
                                    <div class="col-lg-9 col-md-7">
                                        <input type="text" name="email" class="bg-gray-200 form-control" value="{{$biodata->email}}" readonly>
                                    </div>
                                </div>
                            @endforeach
                            
                            @foreach($biodatas as $biodata)

                                <div class="row">
                                    <div class="col-lg-3 col-md-5  label">Status Kelamin<br> <i>Martial Status</i></div>
                                    <div class="col-lg-9 col-md-7">
                                        <input type="text" name="marital_status_id" class="bg-gray-200 form-control" value="{{optional($biodata->maritalstatus)->label}}" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-5  label">Bangsa<br> <i>Race</i></div>
                                    <div class="col-lg-9 col-md-7">
                                        <input type="text" name="race_id" class="bg-gray-200 form-control"
                                            value="{{optional($biodata->race)->label}}" readonly>
                                    </div>
                                </div>
                                    
                                <div class="row">
                                    <div class="col-lg-3 col-md-5  label">Agama<br> <i>Religion</i></div>
                                    <div class="col-lg-9 col-md-7">
                                        <input type="text" name="religion_id" class="bg-gray-200 form-control" value="{{optional($biodata->religion)->label}}" readonly>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                        
                        <br>
                        <br>

                        <div class="col" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                            <h3 class="card-title" style="padding: 0px;">Dokumen<br> <i>Documents</i></h3>
                            <hr>

                            @foreach($files as $file)

                                <div class="row">
                                    <div class="col-lg-3 col-md-5  label">Salinan Kad Pengenalan <br> <i>Identification Card</i></div>
                                    <div class="col-lg-9 col-md-7">
                                        <input type="file" name="ic_file" accept=".jpg, .jpeg, .png, .pdf"  id="ic_file">
                                            <a href='{{Storage::url("$file->ic_file") }}' target="_blank"><p>View IC</p></a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-5  label">Surat Lantikan <br> <i>Appointment Letter</i></div>
                                    <div class="col-lg-9 col-md-7">
                                        <input type="file" name="apptletter_file" accept=".jpg, .jpeg, .png, .pdf"  id="ic_file" required>
                                            <a href='{{Storage::url("$file->apptletter_file") }}' target="_blank"><p>View Appointment Letter</p></a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-5  label">Surat Melapor Diri<br> <i>Reporting Letter</i></div>
                                    <div class="col-lg-9 col-md-7">
                                        <input type="file" name="workreport_file" accept=".jpg, .jpeg, .png, .pdf"  id="ic_file" required>
                                            <a href='{{Storage::url("$file->workreport_file") }}' target="_blank"><p>View Reporting Letter</p></a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-5  label">Gambar Passport<br> <i> Passport Photo</i></div>
                                    <div class="col-lg-9 col-md-7">
                                        <input type="file" name="passport_file" accept=".jpg, .jpeg, .png, .pdf"  id="passport_file" required>
                                        <a href='{{Storage::url("$file->passport_file") }}' target="_blank"><p>View Passport Photo</p></a>
                                    </div>
                                </div>
                                
                            @endforeach

                        </div>

                        <br>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary" id="btn-submit" text-align="right">Submit</button>
                        </div>

                    </form>

                @endforeach

                <br>
                <br>

            </div>
            
        </div>

    </section>
    
@endsection