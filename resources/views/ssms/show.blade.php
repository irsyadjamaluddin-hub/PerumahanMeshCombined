@extends('layouts.app-all')

@section('title', 'Keterangan Mengaktifkan Akaun SSM')

@section('content')

<?php
$pagename = "SSM";
?>

<div class="pagetitle">
  <h1>Keterangan Mengaktifkan Akaun SSM</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Borang SSM</li>
      <li class="breadcrumb-item active">Keterangan Mengaktifkan Akaun SSM</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">

  <div class="col-12">
    <div class="card">
      <div class="card-body pt-2">

        <h3 class="card-title">Keterangan Mengaktifkan Akaun SSM<br> <i>SSM Activation Details</i></h3>

        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
          <h3 class="card-title" style="padding: 0px;">Status</i></h3>


          @foreach($ssms as $ssm)
          <div class="row mb-3">
            <div class="col-lg-2 label">Status</div>
            @if($ssm->status_ssm == null)
            <div class="col-lg-10">
              <span class=" spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
              In-Progress
            </div>
            @else
            <div class=" col-lg-10">{{ $ssm->status_ssm }}</div>
            @endif
          </div>
          @endforeach

          <div class="row mb-3">
            <div class="col-lg-2 label">Position ID</div>
            @if($ssm->position_id == null)
            <div class="col-lg-10">
              <span class=" spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
              In-Progress
            </div>
            @else
            <div class="col-lg-10">{{ $ssm->position_id }}</div>
          </div>
          @endif


          @foreach($employments as $employment)


          <div class="row mb-3">
            <div class="col-lg-2 label">Jabatan</div>
            <div class="col-lg-10"> {{ optional($employment->department)->label }}</div>
          </div>
          @endforeach

          <div class="row mb-3">
            <div class="col-lg-2 label">Password</div>

            @if($ssm->password == null)
            <div class="col-lg-10">
              <span class=" spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
              In-Progress
            </div>
            @else
            <div class="col-lg-10">{{ $ssm->password }}</div>
            @endif
          </div>

        </div>
      </div>


      <br>
      <br>
      <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
        <h3 class="card-title" style="padding: 0px;">Keterangan Peribadi <br> <i>Personal Details</i></h3>
        <hr>
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

        <div class="row">
          @foreach($employments as $employment)
          <div class="col-lg-2 label">Jawatan<br> <i>Designation </i></div>
          <div class="col-lg-4">{{ $employment->current_designation_id }}</div>

          <div class="col-lg-2 label">Tempat Bertugas Jawatan<br> <i>Designation Placement</i></div>
          <div class="col-lg-4 ">{{ $employment->current_service_place }}</div>
          @endforeach
        </div>

        <div class="row">
          <div class="col-lg-3 label">Tarikh Bersara<br> <i> Date of Retirement </i></div>
          <div class="col-lg-9">{{ $biodata->bersara_date}}</div>
        </div>

        <div class="row">
          @foreach($contacts as $contact)
          <div class="col-lg-2 label">No. Telefon Bimbit <br> <i>No. Telephone Mobile</i></div>
          <div class="col-lg-4">{{ $contact->telephone_mobile }}</div>

          <div class="col-lg-2 label">Emel <br> <i>Email</i></div>
          <div class="col-lg-4">{{ $biodata->email }}</div>
          @endforeach
        </div>

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
              <td><a href='{{Storage::url("$file->apptletter_file") }}' target="_blank">{{ $file->apptletter_filename }}</td>
            </tr>

            <tr>
              <td scope="row">Surat Melapor Diri <br> <i> Reporting Letter </i></td>
              <td><a href='{{Storage::url("$file->workreport_file") }}' target="_blank">{{ $file->workreport_filename }}</a></td>
            </tr>

            <tr>
              <td scope="row">Gambar Passport <br> <i> Passport Photo </i></td>
              <td><a href='{{Storage::url("$file->passport_file") }}' target="_blank">{{ $file->passport_filename }}</a></td>
            </tr>

            @endforeach
          </tbody>
        </table>
        <!-- End Table with stripped rows -->

      </div>

    </div>
  </div>
  </div>


</section>
@endsection