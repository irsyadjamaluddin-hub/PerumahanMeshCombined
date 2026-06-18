@extends('layouts.app-all')

@section('title', 'View Tindakan Admin SSM')

@section('content')

<?php
$pagename = "Admin_SSM";
?>

<div class="pagetitle">
  <h1>View Tindakan Admin SSM</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">User</li>
      <li class="breadcrumb-item active">View Tindakan Admin - Mengaktifkan Akaun SSM</li>
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

          <div class="row">
            <div class="col-lg-2 label">Nama Penuh</div>
            <div class="col-lg-4">{{ ucwords(trans ($biodata->name)) }}</div>

            <div class="col-lg-2 label">No. Kad Pengenalan</div>
            <div class="col-lg-4">{{ $biodata->ic_no }}</div>
          </div>

          <div class="row">
            <div class="col-lg-2 label">Tarikh Lahir</div>
            <div class="col-lg-4">{{ $biodata->dob }}</div>
          </div>




          <div class="row">
            @foreach($contacts as $contact)
            <div class="col-lg-2 label">Alamat</div>
            <div class="col-lg-4">{{ $contact->address }}</div>
            @endforeach
            <div class="col-lg-2 label">Tempat Lahir</div>
            <div class="col-lg-4">{{ $biodata->place_of_birth }}</div>
          </div>

          <div class="row">
            <div class="col-lg-2 label">Jantina</div>
            <div class="col-lg-10">{{ optional($biodata->gender)->label }}</div>
          </div>

          <div class="row">
            @foreach($employments as $employment)
            <div class="col-lg-2 label">Jawatan</div>
            <div class="col-lg-4">{{ $employment->current_designation_id }}</div>

            <div class="col-lg-2 label">Tempat Bertugas Jawatan</div>
            <div class="col-lg-4 ">{{ $employment->current_service_place }}</div>
            @endforeach
          </div>

          <div class="row">
            <div class="col-lg-2 label">Tarikh Bersara</div>
            <div class="col-lg-4">{{ $bersara_date = \Carbon\Carbon::parse($biodata->dob)->addYears(60)->format('Y-m-d');}}</div>
          </div>

          <div class="row">
            @foreach($contacts as $contact)
            <div class="col-lg-2 label">No. Telefon Bimbit</div>
            <div class="col-lg-4">{{ $contact->telephone_mobile }}</div>

            <div class="col-lg-2 label">Emel</div>
            <div class="col-lg-4">{{ $biodata->email }}</div>
            @endforeach
          </div>

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
                <td><a href='{{Storage::url("$file->ic_file") }}' target="_blank">{{ $file->ic_filename }}</a></td>
              </tr>
              <tr>
                <td scope="row">Surat Lantikan</td>
                <td><a href='{{Storage::url("$file->apptletter_file") }}' target="_blank">{{ $file->apptletter_filename }}</td>
              </tr>
              <tr>
                <td scope="row">Surat Melapor Diri</td>
                <td><a href='{{Storage::url("$file->workreport_file") }}' target="_blank">{{ $file->workreport_filename }}</a></td>
              </tr>

              <tr>
                <td scope="row">Gambar Passport</td>
                <td><a href='{{Storage::url("$file->passport_file") }}' target="_blank">{{ $file->passport_filename }}</a></td>
              </tr
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
          <form>

            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Tindakan</label>
              <div class="col-sm-10">{{ $ssm->tindakan_ssm }}</div>
            </div>

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