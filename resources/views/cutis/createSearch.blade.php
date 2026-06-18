@extends('layouts.app-all')

@section('title', 'Admin Cuti')

@section('content')

<?php
    $pagename = "Admin_Cuti";
  ?>

    <div class="pagetitle">
      <h1>Cuti</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          {{-- <li class="breadcrumb-item">Users</li> --}}
          <li class="breadcrumb-item active">Cuti</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <div class="row mb-2">

            <div class="col-md-11">

                          <div class="search-bar"><!-- Start Search Bar -->
                              <form class="search-form d-flex align-items-center"  method="get" action="{{ route('cutis.cuti.search') }}">
                                @csrf
                                <input type="text" name="ic_search" class="form-control" placeholder="Search IC No. Eg. 00123456">
                                
                                <button type="submit" class="btn btn-primary" title="Search"><i class="bi bi-search"></i></button>
                              </form>   
                          </div><!-- End IC No Search Bar -->

                </div>  

                <div class="col-md-1">
                    <a href="{{ route('cutis.cuti.create') }}" class= "btn btn-primary text-right">
                         Back 
                    </a>
                </div>
        </div>

         <!-- ART Table -->
         <div class="col-12">
              <div class="card recent-sales">

             

                <div class="card-body">

                    <div class="profile-overview pt-3">

                        

                        <h3 class="card-title">Cuti Form</h3>

                        

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

                          @endforeach
                          
                              <div class="row">
                                  <div class="col-lg-4 col-md-3  label">No. Kad Pengenalan <br> <i>Identity Card No.</i></div>
                                  <div class="col-lg-8 col-md-9">
                                    <input type="text" class="bg-gray-200 form-control" value="{{$id}}" readonly>
                                    
                                  </div>
                              </div>



                              @foreach($employment as $employment)


                              <div class="row">
                                <div class="col-lg-4 col-md-3  label">Jabatan<br> <i>Department</i></div>
                                <div class="col-lg-8 col-md-9">
                                  <input type="text" class="bg-gray-200 form-control" value="{{ optional($employment->department)->label }}" readonly>
                                  
                                </div>
                            </div>
                            @endforeach
                        
                        @endif

                        <form class="" method="post" action="{{ route('cutis.cuti.store') }}" enctype="multipart/form-data"> 
                         @csrf

                         @if(count($biodatas) != 0)

                            <input type="text" name="name" class="bg-gray-200 form-control" value="{{$biodata->name}}" hidden>
                         

                            <input type="text" name="ic_no" class="bg-gray-200 form-control" value="{{$id}}" hidden>

                            <input type="text" name="department" class="bg-gray-200 form-control" value="{{ optional($employment->department)->label }}" hidden>
                        @endif

      

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tarikh Mula Cuti<br> <i>Start Date On leave</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="date" name="start_date_cuti" class="form-control" value="{{ old('start_date_cuti') }}">
                                    {!! $errors->first('start_date_cuti', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tarikh Akhir Cuti<br> <i>End Date On leave</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="date" name="end_date_cuti" class="form-control" value="{{ old('end_date_cuti') }}">
                                    {!! $errors->first('end_date_cuti', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Jenis Cuti<br> <i>Type of Leave</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="jenis_cuti">
                                        <option></option>
                                        @foreach ($jeniscuti as $key => $value)
                                            <option value="{{ $key }}"> 
                                                {{ $value }} 
                                            </option>
                                        @endforeach    
                                    </select>
                                    {!! $errors->first('jenis_cuti', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Catatan<br> <i>Remarks</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="textarea" name="catatan" class="form-control" value="{{ old('catatan') }}">
                                    {!! $errors->first('catatan', '<p class="help-block text-danger">:message</p>') !!}
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