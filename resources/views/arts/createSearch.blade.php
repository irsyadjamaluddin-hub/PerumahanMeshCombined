@extends('layouts.app-all')

@section('title', 'Create ART')

@section('content')

<?php
    $pagename = "Admin_ART";
  ?>

    <div class="pagetitle">
      <h1>Antigen Rapid Test</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">ART</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        
    <div class="row mb-2">

      <div class="col-md-11">

                  <div class="search-bar"><!-- Start Search Bar -->
                      <form class="search-form d-flex align-items-center"  method="get" action="{{ route('arts.art.searchIC') }}">
                        @csrf
                        <input type="text" name="ic_search" class="form-control" placeholder="Search IC No. Eg. 00123456">
                        
                        <button type="submit" class="btn btn-primary" title="Search"><i class="bi bi-search"></i></button>
                      </form>   
                  </div><!-- End IC No Search Bar -->

        </div>  

        <div class="col-md-1">
          <a href="{{ route('arts.art.indexAll') }}" class= "btn btn-primary text-right mb-2">
                  <i class="bi bi-arrow-left-circle"></i>
          </a>
        </div>

      </div>

         <!-- ART Table -->
         <div class="col-12">
              <div class="card recent-sales">

             

                <div class="card-body">

                <div class="profile-overview pt-3">

                  <h3 class="card-title">Create ART Form</h3>


                  <form class="" method="post" action="{{ route('arts.art.storeAll') }}" enctype="multipart/form-data"> 
                    @csrf

                     @if (count($errors) > 0)
          <div class="alert alert-danger">
            Upload Validation Error<br><br>
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

                    @if(count($biodatas) == 0)

                    <div class="row">
                          <div class="col-lg-4 col-md-3  label">Ralat <br> <i>Error</i></div>
                          <div class="col-lg-8 col-md-9">
                            <input type="text" class="bg-gray-200 text-danger form-control" value="IC Number Not found, Try Again" readonly>
                              
                          </div>
                      </div>

                    @else

                      @foreach($biodatas as $biodata)

                      <div class="row">
                          <div class="col-lg-4 col-md-3  label">Nama Penuh <br> <i>Fullname</i></div>
                          <div class="col-lg-8 col-md-9">
                              <input type="text" class="bg-gray-200 form-control" value="{{$biodata->name}}" readonly>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-4 col-md-3  label">No. Kad Pengenalan <br> <i>Identity Number</i></div>
                          <div class="col-lg-8 col-md-9">
                              <input type="text" class="bg-gray-200 form-control" name="ic_no" value="{{$biodata->ic_no}}" readonly>
                          </div>
                      </div>

                      @endforeach

                    @endif

                    

                      <div class="row">
                          <div class="col-lg-4 col-md-3  label">Jabatan  <br> <i>Department </i></div>
                          <div class="col-lg-8 col-md-9">

                          @foreach($employments as $employment)
                          
                            <input type="text" class="bg-gray-200 form-control" value="{{ optional($employment->department)->label }}" readonly>
                            <input type="text" name="department_id" class="bg-gray-200 form-control" value="{{ $employment->department_id }}" hidden>
                          @endforeach

                              {!! $errors->first('department_id', '<p class="help-block text-danger">:message</p>') !!}

                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-4 col-md-3  label">Tempat Bertugas (Bahagian/Unit) <br> <i>Work Placement (Section/Unit)</i></div>
                          <div class="col-lg-8 col-md-9">
                              <input type="text" name="place" class="form-control">
                              {!! $errors->first('place', '<p class="help-block text-danger">:message</p>') !!}
                          </div>
                          
                      </div>

                      

                      <div class="row">
                          <div class="col-lg-4 col-md-3  label">Tarikh Ujian ART <br> <i>ART Test Date</i></div>
                          <div class="col-lg-8 col-md-9">
                              <input type="date" name="date_test" class="form-control">
                              {!! $errors->first('date_test', '<p class="help-block text-danger">:message</p>') !!}
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-4 col-md-3  label">Keputusan ART <br> <i>ART Result</i></div>
                          <div class="col-lg-8 col-md-9">
                              <select class="form-control" name="result_id">
                                  <option value=" "></option>
                                  <option value="+ve">Positive</option>
                                  <option value="-ve">Negative</option>
                                   <option value="inv">Invalid</option>      
                              </select>
                              {!! $errors->first('result_id', '<p class="help-block text-danger">:message</p>') !!}
                          </div>
                      </div>

                     <div class="row">
                          <div class="col-lg-4 col-md-3  label">Muat Naik Gambar ART <br> <i>Upload Photo ART</i><br><i style="color:red;">*Saiz maksimum bagi setiap fail / gambar: 2MB</i> </div>
                          <div class="col-lg-8 col-md-9">
                              <input type="file" name="art_file" class="form-control">
                              {!! $errors->first('art_file', '<p class="help-block text-danger">:message</p>') !!}
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-4 col-md-3  label">Remark (Jika Ada) <br> <i>Remark (If Any)</i></div>
                          <div class="col-lg-8 col-md-9">
                              <input type="text" name="remark" class="form-control">
                              {!! $errors->first('remark', '<p class="help-block text-danger">:message</p>') !!}
                          </div>
                      </div>

                      
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