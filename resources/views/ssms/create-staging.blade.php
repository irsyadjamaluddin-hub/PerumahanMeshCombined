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
          'route' => ['ssms.ssm.update.staging', $biodata->ic_no],
          'class' => 'form-horizontal',
          'name' => 'edit_biodata_form',
          'id' => 'edit_biodata_form',
          'enctype' => "multipart/form-data"
          ]) !!}

          {{ csrf_field() }}

          {{-- Error Message --}}
<!--           @if ($errors->any())
          @foreach ($errors->all() as $error)

          <div class="ErrorMessage p-2 w-full bg-red-200 rounded-md mb-5 flex flex-row items-center justify-between text-red-800">

            <div class="flex flex-row items-center">

              <p class="ml-3">{{ $errors }}</p>
            </div>

            <button onclick="closeErrorMessage()" class="" data-dismiss="alert" aria-label="Close">
            </button>

          </div>

          @endforeach
          @endif -->


             @if (count($errors) > 0)
          <div class="alert alert-danger">
           Please fill in all required fields<br><br>
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif




          <div class="row">
            <div class="col-lg-3 col-md-5  label">Nama Penuh <br> <i>Fullname</i></div>
            <div class="col-lg-9 col-md-7">
              <input type="text" name="name" class="bg-gray-200 form-control" value="{{$biodata->name}}" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5  label">No. Kad Pengenalan <br> <i>Identity Card Number</i></div>
            <div class="col-lg-9 col-md-7">
              <input type="text" name="ic_no" class="bg-gray-200 form-control" value="{{Auth::user()->ic_no}}" readonly>
            </div>
          </div>


          <div class="row">
            <div class="col-lg-3 col-md-5 label">Alamat <br> <i>Address</i></div>
            <div class="col-lg-9 col-md-7">{!! Form::text('address', $address, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5 label">Tarikh Lahir <br> <i>Date of Birth</i></div>
            <div class="col-lg-9 col-md-7">
              <input type="date" name="dob" class="form-control" value="{{ $biodata->dob }}">
            </div>
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
              {!! Form::date('current_designation_date', $roleDateStart, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => 'datepicker_role_start', 'placeholder' => '', ]) !!}
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5 label">Tarikh Bersara <br> <i>Date of Retirement</i></div>
            <div class="col-lg-9 col-md-7">{!! Form::text('bersara_date', null, ['class' => 'form-control', 'readonly','spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
          </div>

<!--           <div class="row">
            <div class="col-lg-3 col-md-5 label">Tarikh Bersara<br> <i> Date of Retirement </i></div>
            <div class="col-lg-9 col-md-7">{!! Form::text('bersara_date',null, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => '', 'placeholder' => '', ]) !!}</div>
          </div>
 -->
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

            @if($icFile != null)
            <input type="text" name="ic_filename" value="{{$icFile}}"  id="ic_file" hidden>
            <input type="text" name="ic_file" value="{{$icFilePath}}"  id="ic_file" hidden>


            <a href='{{Storage::url("$icFilePath") }}' target="_blank">
            <p>{{$icFile}}</p>
            </a>

            @else
            <input type="file" name="ic_filenew"   id="ic_file" >
                 
            @endif
           
            </div>

          </div>

        

          <div class="row">
            <div class="col-lg-3 col-md-5  label">Muat Naik Surat Lantikan Jawatan <br> <i>Upload Appointment Letter</i><br>(Saiz maksima fail: 2MB)<i style="color:red;">*</i></div>
            <div class="col-lg-9 col-md-7">
            @if($apptletterFile!= null)
            <input type="text" name="apptletter_filename" value="{{$apptletterFile}}"  id="apptletter_file" hidden>
            <input type="text" name="apptletter_file" value="{{$apptletterFilePath}}"  id="apptletter_file" hidden>

             <a href='{{Storage::url("$apptletterFilePath") }}' target="_blank" >
                <p>{{$apptletterFile}}</p>
              </a>

              @else
              <input type="file" name="apptletter_filenew"   id="apptletter_file" >
              @endif
          
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-5  label">Muat Naik Surat Melapor Diri <br> <i>Upload Work Report Letter</i><br>(Saiz maksima fail: 2MB)<i style="color:red;">*</i></div>
            <div class="col-lg-9 col-md-7">

              @if($workreportFile !== null)
              
                <input type="hidden" name="workreport_filename"  value="{{$workreportFile}}" id="workreport_file">
                <input type="hidden" name="workreport_file"  value="{{$workreportFilePath}}" id="workreport_file">

                <a href='{{Storage::url("$workreportFilePath") }}' target="_blank" >
                    <p>{{$workreportFile}}</p>
                </a>

              @else
            
                <input type="file" name="workreport_filenew" id="workreport_filenew" required>
                
              @endif
            
            </div>
          </div>

             <div class="row">
            <div class="col-lg-3 col-md-5  label">Muat Naik Gambar Passport <br> <i>Upload Passport Photo</i><br>(Saiz maksima fail: 2MB)<i style="color:red;">*</i></div>
            <div class="col-lg-9 col-md-7">

            @if($passportFile!= null)

            <input type="text" name="passport_filename"  value="{{$passportFile}}" id="passport_file" hidden>
            <input type="text" name="passport_file"  value="{{$passportFilePath}}" id="passport_file" hidden>


            <a href='{{Storage::url("$passportFilePath") }}' target="_blank" >
                <p>{{$passportFile}}</p>
              </a>

              @else
            
              <input type="file" name="passport_filenew"   id="passport_file">
              @endif
            
            </div>
          </div>


          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
           <button class="btn btn-primary" id="btn-submit" text-align="right" onclick="this.disabled=true;this.value='Sending,please wait..';this.form.submit();">Submit</button>
        
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