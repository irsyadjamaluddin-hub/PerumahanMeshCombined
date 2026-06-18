@extends('layouts.app-all')

@section('title', 'Borang Mengaktifkan Akaun SSM')

@section('content')

<?php
$pagename = "SSMS";
?>

<div class="pagetitle">
  <h1>Borang Mengaktifkan Akaun SSM</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">Borang Mengaktifkan Akaun SSM</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">

  <div class="col-12">
    <div class="card recent-sales">



      <div class="card-body">

        <div class="profile-overview">

          <h3 class="card-title">Borang Mengaktifkan Akaun SSM<br> <i>SSM Activation Form</i></h3>

          {!! Form::model($biodata, [
          'method' => 'PUT',
          'route' => ['ssms.ssm.update', $biodata->ic_no],
          'class' => 'form-horizontal',
          'name' => 'edit_biodata_form',
          'id' => 'edit_biodata_form',
          'enctype' => "multipart/form-data"
          ]) !!}

          {{ csrf_field() }}

          {{-- Error Message --}}
          @if ($errors->any())
          @foreach ($errors->all() as $error)

          <div class="ErrorMessage p-2 w-full bg-red-200 rounded-md mb-5 flex flex-row items-center justify-between text-red-800">

            <div class="flex flex-row items-center">

              <p class="ml-3">{{ $errors }}</p>
            </div>

            <button onclick="closeErrorMessage()" class="" data-dismiss="alert" aria-label="Close">
            </button>

          </div>

          @endforeach
          @endif





          <div class="row">
            <div class="col-lg-3 col-md-5  label">Nama Penuh <br> <i>Fullname</i></div>
            <div class="col-lg-9 col-md-7">
              <input type="text" name="name" class="bg-gray-200 form-control" value="{{$biodata->name}}" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5  label">No. Kad Pengenalan <br> <i>Identity Number</i></div>
            <div class="col-lg-9 col-md-7">
              <input type="text" name="ic_no" class="bg-gray-200 form-control" value="{{Auth::user()->ic_no}}" readonly>
            </div>
          </div>


          <div class="row">
            <div class="col-lg-3 col-md-5 label">Alamat <br> <i>Address</i></div>
            <div class="col-lg-9 col-md-7">{!! Form::text('address', $address, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5 label">Tempat Lahir<br> <i> Place of Birth </i></div>
            <div class="col-lg-9 col-md-7">{!! Form::text('place_of_birth', null, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5 label">Jantina <br> <i>Gender</i></div>
            <div class="col-lg-9 col-md-7">{!! Form::select('gender_id', $genders, null, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '2', 'placeholder' => '', ]) !!}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5  label">Jawatan<br> <i>Designation </i></div>
            <div class="col-lg-9 col-md-7">
              {!! Form::text('current_designation_id', $currentDesignation, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5  label">Tempat Bertugas Jawatan<br> <i>Designation Placement</i></div>
            <div class="col-lg-9 col-md-7">
              {!! Form::text('current_service_place', $designationCurrentPlace, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5  label">Tarikh Lantikan Jawatan<br> <i>Designation Date</i></div>
            <div class="col-lg-9 col-md-7">
              {!! Form::text('current_designation_date', $roleDateStart, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => 'datepicker_role_start', 'placeholder' => '', ]) !!}
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5 label">Tarikh Bersara<br> <i> Date of Retirement </i></div>
            <div class="col-lg-9 col-md-7">{!! Form::text('bersara_date',null, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => '', 'placeholder' => '', ]) !!}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5 label">No. Telefon Bimbit <br> <i>No. Telephone Mobile</i></div>
            <div class="col-lg-9 col-md-7">{!! Form::text('telephone_mobile', $telMobile, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5 label">Emel <br> <i>Email</i></div>
            <div class="col-lg-9 col-md-7">{!! Form::text('email', $usersEmail, ['class' => 'form-control', 'readonly', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5 label">Status Kelamin <br> <i>Martial Status</i></div>
            <div class="col-lg-9 col-md-7">{!! Form::select('marital_status_id', $maritalstatuss,null, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '2', 'placeholder' => '', ]) !!}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5 label">Puak Etnik <br> <i>Ethnic</i></div>
            <div class="col-lg-9 col-md-7">{!! Form::select('race_id', $races, null,['id' => 'races', 'class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5 label">Bangsa <br> <i> Race </i></div>
            <div class="col-lg-9 col-md-7">{!! Form::select('race_id', $races, null,['id' => 'races', 'class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-5 label"> <br> <i> </i></div>
            <div class="col-lg-9 col-md-7"> {!! Form::text('race_other', null,['id' => 'raceOther','class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '50', 'placeholder' => 'Enter races...', ]) !!}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5 label">Agama <br> <i> Religion </i></div>
            <div class="col-lg-9 col-md-7">{!! Form::select('religion_id', $religions, null,['id' => 'religions','class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
          </div>



          <div class="row">
            <div class="col-lg-3 col-md-5  label">Muat Naik Kad Pengenalan <br> <i>Upload Identification Card</i><br>(Saiz maksima fail: 2MB)<i style="color:red;">*</i></div>
            <div class="col-lg-9 col-md-7">
              <input type="file" name="ic_file" accept=".jpg, .jpeg, .png, .pdf" id="ic_file">

              <a href='{{Storage::url("$icFilePath") }}' target="_blank">
                <p>{{$icFile}}</p>
              </a>
            </div>

          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5  label">Muat Naik Lesen Memandu <br> <i>Upload Driving License</i><br>(Saiz maksima fail: 2MB)<i style="color:red;">*</i></div>
            <div class="col-lg-9 col-md-7">
              <input type="file" name="drivelicense_file" accept=".jpg, .jpeg, .png, .pdf" id="drivelicense_file">

              <a href='{{Storage::url("$drivelicenseFilePath") }}' target="_blank">
                <p>{{$drivelicenseFile}}</p>
              </a>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5  label">Muat Naik Surat Lantikan Jawatan <br> <i>Upload Appointment Letter</i><br>(Saiz maksima fail: 2MB)<i style="color:red;">*</i></div>
            <div class="col-lg-9 col-md-7">
              <input type="file" name="apptletter_file" accept=".jpg, .jpeg, .png, .pdf" id="apptletter_file">

              <a href='{{Storage::url("$apptletterFilePath") }}' target="_blank">
                <p>{{$apptletterFile}}</p>
              </a>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5  label">Muat Naik Surat Melapor Diri <br> <i>Upload Work Report Letter</i><br>(Saiz maksima fail: 2MB)<i style="color:red;">*</i></div>
            <div class="col-lg-9 col-md-7">
              <input type="file" name="workreport_file" accept=".jpg, .jpeg, .png, .pdf" id="workreport_file">

              <a href='{{Storage::url("$workreportFilePath") }}' target="_blank">
                <p>{{$workreportFile}}</p>
              </a>
            </div>
          </div>


          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-primary" id="btn-submit" text-align="right">Submit</button>
          </div>
          </form>



        </div>

      </div>


    </div>

  </div>
  </div><!-- End Recent Sales -->

  </div>


</section>
@endsection