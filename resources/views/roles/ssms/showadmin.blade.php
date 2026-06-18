@extends('layouts.app-all')

@section('title', 'Mengaktifkan Akaun SSM')

@section('content')

<?php
$pagename = "Admin_SSM";
?>

<div class="pagetitle">
  <h1>Mengaktifkan Akaun SSM</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">User</li>
      <li class="breadcrumb-item active">Mengaktifkan Akaun SSM</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">

  <div class="col-12">
    <div class="card">
      <div class="card-body pt-2">

        <h3 class="card-title">Mengaktifkan Akaun SSM<br> <i>SSM Activation</i></h3>





        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
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
            <div class="col-lg-4">{{ Auth::user()->email }}</div>
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
          <form>
            @foreach($ssms as $ssm)
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Status</label>
              @if($ssm->status_ssm == null)
              <td></td>
              @else
              <div class="col-sm-10">
                {{ $ssm->status_ssm }}
              </div>
              @endif
            </div>

            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Position ID</label>
              <div class="col-sm-10">{{ $ssm->position_id }}</div>
            </div>

            @foreach($employments as $employment)
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Jabatan</label>
              <div class="col-sm-10">{{ optional($employment->department)->label }}</div>
            </div>
            @endforeach

            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">{{ $ssm->password }}</div>
            </div>

            @endforeach


          </form>
        </div>

      </div>
    </div>
  </div>


</section>
@endsection