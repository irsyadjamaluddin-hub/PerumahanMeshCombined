@extends('layouts.app-all')

@section('title', 'Tindakan Admin SSM')

@section('content')

<?php
$pagename = "Admin_Edit_SSM";
?>

<div class="pagetitle">
    <h1>Tindakan Admin SSM</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">User</li>
            <li class="breadcrumb-item active">Tindakan Admin - Mengaktifkan Akaun SSM</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body pt-3">

                <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                  <h3 class="card-title" style="padding: 0px;">Keterangan Peribadi</h3>
                  <hr>
                    @foreach ($biodatas as $biodata)

                    <div class="row">
                        <div class="col-lg-2 label">Nama Penuh</div>
                        <div class="col-lg-4">{{ ucwords(trans ($biodata->name)) }}</div>

                        <div class="col-lg-2 label">No. Kad Pengenalan</div>
                        <div class="col-lg-4">{{ $biodata->ic_no }}</div>
                    </div>


                    <div class="row">
                        <div class="col-lg-2 label">Tarikh Lahir</div>
                        <div class="col-lg-4">{{ $biodata->dob ?? 'Not Available' }}</div>
                    </div>

                    <div class="row">
                        @foreach($contacts as $contact)
                        <div class="col-lg-2 label">Alamat</div>
                        <div class="col-lg-4">{{ $ssms->address }}</div>
                        @endforeach
                        <div class="col-lg-2 label">Tempat Lahir</div>
                        <div class="col-lg-4">{{ $ssms->place_of_birth }}</div>
                    </div>


                    <div class="row">
                        <div class="col-lg-2 label">Jantina</div>
                        <div class="col-lg-10">{{ optional($biodata->gender)->label }}</div>
                    </div>
                    @endforeach

                    <div class="row">
                        @foreach($employments as $employment)
                        <div class="col-lg-2 label">Jawatan</div>
                        <div class="col-lg-4">{{ $ssms->current_designation_id }}</div>

                        <div class="col-lg-2 label">Tempat Bertugas Jawatan</div>
                        <div class="col-lg-4 ">{{ $ssms->current_service_place }}</div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-lg-2 label">Tarikh Bersara</div>
                        <!-- <div class="col-lg-4">{{ $bersara_date = \Carbon\Carbon::parse($biodata->dob)->addYears(60)->format('Y-m-d');}}</div> -->
                        <div class="col-lg-4">{{ $biodata && $biodata->dob ? \Carbon\Carbon::parse($biodata->dob)->addYears(60)->format('Y-m-d'): 'Not Available'}}</div>
                    </div>

                    <div class="row">
                        @foreach($contacts as $contact)
                        <div class="col-lg-2 label">No. Telefon Bimbit</div>
                        <div class="col-lg-4">{{ $ssms->telephone_mobile }}</div>

                        <div class="col-lg-2 label">Emel</div>
                        <div class="col-lg-4">{{ $ssms->email }}</div>
                        @endforeach
                    </div>

                    @foreach($biodatas as $biodata)
                    <div class="row">
                        <div class="col-lg-2 label">Status Kelamin</div>
                        <div class="col-lg-4">{{ optional($biodata->maritalStatus)->label }}</div>

                        <div class="col-lg-2 label">Bangsa</div>
                        <div class="col-lg-4">@if( $biodata->race_id == '10') <p>{{ $biodata->race_other }}</p> @else{{ optional($biodata->race)->label }}@endif</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2 label">Agama</div>
                        <div class="col-lg-10">@if( $biodata->religion_id == '4') <p>{{ $biodata->religion_other }}</p> @else{{ optional($biodata->religion)->label }}@endif</div>
                    </div>

                    @endforeach
                </div>
                <br>
                <br>
                <div class="col" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h3 class="card-title" style="padding: 0px;">Dokumen</h3>
                    <hr>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Dokumen</th>
                                <th scope="col">Fail</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($files as $file)
                            <tr>
                                <td scope="row">Salinan Kad Pengenalan</td>
                                <td><a href='{{Storage::url("$ssms->ic_file") }}' target="_blank">{{ $ssms->ic_filename }}</a></td>

                            </tr>
                            <tr>
                                <td scope="row">Surat Lantikan</td>
                                <td><a href='{{Storage::url("$ssms->apptletter_file") }}' target="_blank">{{ $ssms->apptletter_filename }}</a></tr>
                            <tr>
                                <td scope="row">Surat Melapor Diri</td>
                                <td><a href='{{Storage::url("$ssms->workreport_file") }}' target="_blank">{{ $ssms->workreport_filename }}</a></td>
                            </tr>

                              <tr>
                                <td scope="row">Gambar Passport</td>
                                <td><a href='{{Storage::url("$ssms->passport_file") }}' target="_blank">{{ $ssms->passport_filename }}</a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
                <br>
                <br>
                <div class="col" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h3 class="card-title" style="padding: 0px;">Tindakan (Admin)</h3>
                    <hr>



                    <form class="" method="post" action="{{ route('ssms.ssm.updateadmin')}}" enctype="multipart/form-data">

                        @csrf

                        <input type="text" name="id" class="bg-gray-200 form-control " value="{{$ssms->id}}" hidden>

                        <div class="row mb-3" hidden>
                            <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="bg-gray-200 form-control" value="{{$ssms->name}}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3" hidden>
                            <label for="inputText" class="col-sm-2 col-form-label">No Kad Pengenalan </label>
                            <div class="col-sm-10">
                                <input type="text" class="bg-gray-200 form-control" value="{{$ssms->ic_no}}" readonly>
                            </div>
                        </div>

                            <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Tindakan</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="tindakan_ssm" value="" aria-label="Default select example">

                                    <option value="{{ $ssms->tindakan_ssm }}">{{ $ssms->tindakan_ssm }}</option>
                                   
<!--                                     <option value="">Pilih Tindakan</option>                
 -->                                    <option value="PTKII(AO)">PTKII(AO)</option>
                                    <option value="AA(AM)">AA(AM)</option>
                                    <option value="CC(MY)">CC(MY)</option>
                                    <option value="K(HNR)">K(HNR)</option>
                                    <option value="K(ZR)">K(ZR)</option>
                                    <option value="K(NMD)">K(NMD)</option>
                                    <option value="K(ND)">K(ND)</option>
                                    <option value="K(HM)">K(HM)</option>
                                    <option value="K(FT)">K(FT)</option>
                                    <option value="K(RA)">K(RA)</option>
                                    <option value="K(ZS)">K(ZS)</option>
                                    <option value="OVIII(NHT)">OVIII(NHT)</option>
                                    <option value="PbP(FM)">Pbp(FM)</option>
                                    <option value="OVIII(ASM)">OVIII(ASM)</option>
                                            

                                </select>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="status_ssm" value="" aria-label="Default select example">

                                    <option value="{{$ssms->status_ssm}}">{{ $ssms->status_ssm }}</option>
                                   
                                    <!-- <option value="">Pilih Status</option> -->
                                    <option value="Dihadapkan ke JPA">Dihadapkan ke JPA</option>
                                    <option value="Untuk dikemaskini SSM">Untuk dikemaskini SSM</option>                                    
                                    <option value="Pengemaskinian SSM telah dilaksanakan">Pengemaskinian SSM telah dilaksanakan</option>
                                    <option value="Untuk dihadapkan ke SSM Helpdesk">Untuk dihadapkan ke SSM Helpdesk</option>                                    
                                    <option value="Dihadapkan ke SSM Helpdesk untuk OTP">Dihadapkan ke SSM Helpdesk untuk OTP</option>
                                    <option value="Diproses untuk persuratan">Diproses untuk persuratan</option>                                    
                                    <option value="Selesai">Selesai</option>
                                    <option value="Fasa 1 SSM tidak termasuk perkhidmatan Gaji Hari">Fasa 1 SSM tidak termasuk perkhidmatan Gaji Hari</option>
                                    <option value="Dokumen tidak lengkap">Dokumen tidak lengkap</option>                                    

                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Position ID</label>
                            <div class="col-sm-10"><input type="text" name="position_id" value="{{ $ssms->position_id }}" class="form-control"></div>
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
                            <div class="col-sm-10"><input type="text" name="password" value="{{ $ssms->password }}" class="form-control"></div>
                        </div>

                        <div class="text-center mt-3">

                            <button type="submit" class="btn btn-primary" href="">Submit</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>


</section>
@endsection