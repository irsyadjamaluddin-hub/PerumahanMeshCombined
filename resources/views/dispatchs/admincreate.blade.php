@extends('layouts.app-all')

@section('title', 'Admin_Create MED')

@section('content')

<?php
$pagename = "MED";
?>

<div class="pagetitle">
  <h1>MoeDispatch</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">MED</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">


  <a href="{{ route('dispatchs.dis.indexadmin') }}" class="btn btn-primary text-right mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>


  <!-- QO Table -->
  <div class="col-12">
    <div class="card recent-sales">



      <div class="card-body">

        <div class="profile-overview pt-3">

          <h3 class="card-title"> MoeDispatch Form</h3>

          <form class="" method="post" action="{{ route('dispatchs.dis.store') }}" enctype="multipart/form-data">
            @csrf

           

          <div class="row">
                  <label class="col-lg-4 col-md-3  label">Jenis</label>
                  <div class="col-lg-8 col-md-9">
                    <select class="form-select" name="jns" aria-label="Default select example">
                      <option></option>
                      @foreach ($jenis as $key => $value)
                  <option value="{{ $key }}">
                    {{ $value }}
                  </option>
                  @endforeach
                    </select>
                    
                  </div>
                </div>

          

          <div class="row">
                  <label class="col-lg-4 col-md-3  label">Daripada <br> <i></i></label>
                  <div class="col-lg-8 col-md-9">
                    <select class="form-select" name="kpd"aria-label="Default select example">
                      <option></option>
                      @foreach ($kepada as $key => $value)
                  <option value="{{ $key }}">
                    {{ $value }}
                  </option>
                  @endforeach
                    </select>
                  </div>
                </div>

               

                <div class="row">
              <div class="col-lg-4 col-md-3  label">Kepada <br> <i></i> </div>
              <div class="col-lg-8 col-md-9">
                <select class="form-select" name="kpd">
                  <option></option>
                  @foreach ($kepada as $key => $value)
                  <option value="{{ $key }}">
                    {{ $value }}
                  </option>
                  @endforeach
                </select>
                {!! $errors->first('kepada', '<p class="help-block text-danger">:message</p>') !!}
              </div>
            </div>

               

            
            <div class="row">
                  <label for="inputText" class="col-lg-4 col-md-3  label">Untuk Perhatian </label>
                  <div class="col-lg-8 col-md-9">
                    <input type="text" name="up" class="form-control">
                  </div>
          </div>

          
            

                <div class="row">
                  <label for="inputText" class="col-lg-4 col-md-3  label">Perkara</label>
                  <div class="col-lg-8 col-md-9">
                    <input type="text" name="perkara" class="form-control">
                  </div>
          </div>

          <div class="row">
                  <label for="inputText" class="col-lg-4 col-md-3  label">Rujukan Persuratan</label>
                  <div class="col-lg-8 col-md-9">
                    <input type="text" name="rp" class="form-control">
                  </div>
          </div>

          <div class="row">
                  <label for="inputText" class="col-lg-4 col-md-3  label">Rujukan Pejabat Yang Menhadapkan</label>
                  <div class="col-lg-8 col-md-9">
                    <input type="text" name="rm" class="form-control">
                  </div>
          </div>

          <div class="row">
                  <label for="inputNumber" class="col-lg-4 col-md-3  label">Lampiran</label>
                  <div class="col-lg-8 col-md-9">
                    <input type="file" name="lamp" class="form-control" >
          </div>
                
          </div>

          

          <div class="row">
                  <label for="inputText" class="col-lg-4 col-md-3  label">Catatan</label>
                  <div class="col-lg-8 col-md-9">
                      <textarea class="form-control" name="catt" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"></textarea>
                      
                  </div>
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


</section>
@endsection