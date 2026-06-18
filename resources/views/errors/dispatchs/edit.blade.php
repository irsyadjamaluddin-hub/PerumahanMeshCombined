@extends('layouts.app-all')

@section('title', 'Edit MED')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?php
$pagename = "MED";
?>

<div class="pagetitle">
  <h1>MED edit form</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">MED</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">


  <a href="{{ route('dispatchs.dis.index') }}" class="btn btn-primary text-right mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>


  <!-- QO Table -->
  <div class="col-12">
    <div class="card recent-sales">



      <div class="card-body">

        <div class="profile-overview pt-3">





          <form class="" method="post" action="{{ route('dispatchs.dis.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
              <h3 class="card-title" style="padding: 0px;">Edit</i></h3>
              <hr>
              <br>

              @foreach ($dispatchs as $dispatch)

              <input type="text" name="id" class="bg-gray-200 form-control " value="{{$dispatch->id}}" hidden>


              <div class="row">
                <div class="col-lg-4 col-md-3  label">Jenis</i></div>
                <div class="col-lg-8 col-md-9">
                  <select class="form-select" name="jns">
                    <option value="{{ $dispatch->jns }}">{{optional($dispatch->jenis)->label }}</option>
                    @foreach ($jenis as $key => $value)
                    <option value="{{ $key }}">
                      {{ $value }}
                    </option>
                    @endforeach
                  </select>
                  {!! $errors->first('jns', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-3  label">Daripada</div>
                <div class="col-lg-8 col-md-9">
                  <select class="form-select" name="daripada">
                    <option value="{{ $dispatch->daripada}}">{{optional($dispatch->Daripada)->label }}</option>
                    @foreach ($daripada as $key => $value)
                    <option value="{{ $key }}">
                      {{ $value }}
                    </option>
                    @endforeach
                  </select>
                  {!! $errors->first('daripada', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <div class="row">
            <div class="col-lg-4 col-md-3  label">Kepada <br> <i></i> </div>
            <div class="col-lg-8 col-md-9">
              <select class="form-select js-example-basic-multiple" multiple="multiple" name="kpd[]">
                <option></option>
                @foreach ($kepada as $key => $value)
                <option value="{{ $key }}">
                  {{ $value }}
                </option>
                @endforeach
              </select>
              {!! $errors->first('kpd', '<p class="help-block text-danger">:message</p>') !!}
            </div>
          </div>



              <div class="row">
                <div class="col-lg-4 col-md-3  label">Untuk Perhatian <br></div>
                <div class="col-lg-8 col-md-9">
                  <input type="text" name="up" class="bg-gray-200 form-control" value="{{$dispatch->up}}">
                  {!! $errors->first('up', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>



              <div class="row">
                <div class="col-lg-4 col-md-3  label">Perkara <br></div>
                <div class="col-lg-8 col-md-9">
                  <input type="text" name="perkara" class="bg-gray-200 form-control" value="{{$dispatch->perkara}}">
                  {!! $errors->first('perkara', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>


              <div class="row">
                <div class="col-lg-4 col-md-3  label">Rujukan Persuratan <br></div>
                <div class="col-lg-8 col-md-9">
                  <input type="text" name="rp" class="bg-gray-200 form-control" value="{{$dispatch->rp}}">
                  {!! $errors->first('rp', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-3  label">Rujukan Pejabat Yang Menghadapkan <br></div>
                <div class="col-lg-8 col-md-9">
                  <input type="text" name="rm" class="bg-gray-200 form-control" value="{{$dispatch->rm}}">
                  {!! $errors->first('rm', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>


              <div class="row">
                <div class="col-lg-4 col-md-3  label">Muat Naik Dokumen</div>
                <div class="col-lg-8 col-md-9">
                  <a href='{{Storage::url("$dispatch->lamp") }}' target="_blank">
                    <p>View Uploaded File</p>
                  </a>
                  <input type="file" name="lamp" class="form-control">

                  {!! $errors->first('lamp', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-3  label">Catatan<br></div>
                <div class="col-lg-8 col-md-9">
                  <textarea class="form-control" name="catt" placeholder="Sebarang Ulasan" id="floatingTextarea" style="height: 100px;">{{$dispatch->catt}}</textarea>
                  {!! $errors->first('catt', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>


              @endforeach

            </div>
            <br>


            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>



          </form>



        </div>

      </div>


    </div>

  </div>
  </div><!-- End Recent Sales -->

  </div>

  <script>$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});</script>


</section>
@endsection