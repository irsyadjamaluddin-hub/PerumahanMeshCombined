@extends('layouts.app-all')

@section('title', 'Admin Edit ART')

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
            <div class="col-md-11"></div>  <!-- blank space increase or decrease it by column # -->
                <div class="col-md-1">
                    <a href="{{ route('arts.art.indexAll') }}" class= "btn btn-primary text-right">
                         Back 
                    </a>
                </div>
        </div>

         <!-- ART Table -->
         <div class="col-12">
              <div class="card recent-sales">

             

                <div class="card-body">

                <div class="profile-overview pt-3">

                  <h3 class="card-title">Edit ART Form</h3>

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
                          <input type="text" class="bg-gray-200 form-control" value="{{$biodata->ic_no}}" readonly>
                      </div>
                  </div>

                  @endforeach

                  <form class="" method="post" action="{{ route('arts.art.updateAll') }}" enctype="multipart/form-data"> 
                        @csrf

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

                          @foreach($arts as $art)

                            <input type="text" name="id" class="form-control" value="{{ $art->emp_art_infos_id}}" hidden>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tempat Bertugas (Bahagian/Unit) <br> <i>Work Placement (Section/Unit)</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="place" class="form-control" value="{{ $art->work_place }}">
                                    {!! $errors->first('place', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                                
                            </div>

                            

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tarikh Ujian ART <br> <i>ART Test Date</i></div>
                                <div class="col-lg-8 col-md-9">
                                <input type="date" name="date_test" class="form-control" value="{{ $art->date_test }}">
                                    {!! $errors->first('date_test', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Keputusan ART <br> <i>ART Result</i></div>
                                 <div class="col-lg-8 col-md-9">
                                  @if($art->date_test == "-ve")
                                    <select class="form-control" name="result_id">
                                        <option value="-ve">Negative</option> 
                                        <option value="+ve">Positive</option> 
                                        <option value="inv">Invalid</option>      
                                    </select>
                                  @else
                                    <select class="form-control" name="result_id">
                                        <option value="-ve">Negative</option> 
                                        <option value="+ve">Positive</option>
                                         <option value="inv">Invalid</option>     
                                    </select>
                                  @endif
                                    {!! $errors->first('result_id', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Muat Naik Gambar ART <br> <i>Upload Photo ART</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="file" name="art_file" class="form-control">

                                    <a href='{{Storage::url("$art->art_image") }}' target="_blank"><p>View Uploaded File</p></a>
                                    {!! $errors->first('art_file', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Remark (Jika Ada) <br> <i>Remark (If Any)</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="remark" class="form-control" value="{{ $art->remark }}">
                                    {!! $errors->first('remark', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                          @endforeach

                            
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