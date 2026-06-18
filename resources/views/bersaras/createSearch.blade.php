@extends('layouts.app-all')

@section('title', 'Admin Create Bersara')

@section('content')

<?php
    $pagename = "Admin_Bersara";
  ?>

    <div class="pagetitle">
      <h1>Bersara</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Bersara</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <div class="row mb-2">

            <div class="col-md-11">

                          <div class="search-bar"><!-- Start Search Bar -->
                              <form class="search-form d-flex align-items-center"  method="get" action="{{ route('bersaras.bersara.search') }}">
                                @csrf
                                <input type="text" name="ic_search" class="form-control" placeholder="Search IC No. Eg. 00123456">
                                
                                <button type="submit" class="btn btn-primary" title="Search"><i class="bi bi-search"></i></button>
                              </form>   
                          </div><!-- End IC No Search Bar -->

                </div>  

                <div class="col-md-1">
                    <a href="{{ route('bersaras.bersara.create') }}" class= "btn btn-primary text-right">
                         Back 
                    </a>
                </div>
        </div>

         <!-- ART Table -->
         <div class="col-12">
              <div class="card recent-sales">

             

                <div class="card-body">

                    <div class="profile-overview pt-3">

                        

                        <h3 class="card-title">Bersara Form</h3>

                        

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
                                <div class="col-lg-4 col-md-3  label">Jawatan Bersara <br> <i>Retirement Position</i></div>
                                <div class="col-lg-8 col-md-9">
                                  <input type="text" class="bg-gray-200 form-control" value="{{$employment->current_designation_id}}" readonly>
                                  
                                </div>
                            </div>
                            @endforeach
                        
                        @endif

                        <form class="" method="post" action="{{ route('bersaras.bersara.store') }}" enctype="multipart/form-data"> 
                         @csrf

                         @if(count($biodatas) != 0)

                            <input type="text" name="name" class="bg-gray-200 form-control" value="{{$biodata->name}}" hidden>
                         

                            <input type="text" name="ic_no" class="bg-gray-200 form-control" value="{{$id}}" hidden>

                            <input type="text" name="bersara_post" class="bg-gray-200 form-control" value="{{$employment->current_designation_id}}" hidden>
                        @endif

                        {{-- <div class="row">
                          <div class="col-lg-4 col-md-3  label">Jawatan Bersara <br> <i>Retirement Position</i></div>
                          <div class="col-lg-8 col-md-9">
                            <select class="form-select" name="bersara_post" value="{{ old('bersara_post') }}">
                              <option></option>
                              @foreach ($retirementposition as $key => $value)
                                  <option value="{{ $key }}"> 
                                      {{ $value }} 
                                  </option>
                              @endforeach    
                          </select>
                          {!! $errors->first('bersara_post', '<p class="help-block text-danger">:message</p>') !!}
                         </div>
                      </div> --}}


                      <div class="row">
                          <div class="col-lg-4 col-md-3  label">Jenis Penamatan<br> <i>Termination Type</i></div>
                          <div class="col-lg-8 col-md-9">
                            <select class="form-select" name="penamatan">
                              <option></option>
                              @foreach ($terminationtype as $key => $value)
                                  <option value="{{ $key }}"> 
                                      {{ $value }} 
                                  </option>
                              @endforeach    
                          </select>
                          {!! $errors->first('penamatan', '<p class="help-block text-danger">:message</p>') !!}
                     </div>
                      </div>

                   

                      <div class="row">
                          <div class="col-lg-4 col-md-3  label">Peruntukan Bersara<br> <i> Retirement Budget </i></div>
                          <div class="col-lg-8 col-md-9">
                            <select class="form-select" name="peruntukanbersara" value="{{ old('peruntukanbersara') }}">
                              <option></option>
                              @foreach ($retirementposition1 as $key => $value)
                                  <option value="{{ $key }}"> 
                                      {{ $value }} 
                                  </option>
                              @endforeach    
                          </select>
                          {!! $errors->first('peruntukanbersara', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4 col-md-3  label">Tarikh Mula Cuti Bersara<br> <i> Start Date Retirement on leave</i></div>
                        <div class="col-lg-8 col-md-9">
                            <input type="date" id="second" name="date_cuti_bersara" class="form-control" placeholder="">
                            {!! $errors->first('date_cuti_bersara', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4 col-md-3  label">Tarikh Berakhir Cuti Bersara<br> <i> End Date Retirement on leave</i></div>
                      <div class="col-lg-8 col-md-9">
                          <input type="date" id="third" name="end_date_bersara" class="form-control" placeholder="">
                          {!! $errors->first('end_date_bersara', '<p class="help-block text-danger">:message</p>') !!}
                      </div>
                  </div>

                  <div class="row">
                          <div class="col-lg-4 col-md-3  label">Tarikh Penamatan<br> <i>Retirement Date</i></div>
                          <div class="col-lg-8 col-md-9">
                              <!-- <input type="date" id="fourth" name="date_bersara" class="form-control" placeholder=""> -->

                               <input type="text" class="bg-gray-200 form-control" value="{{ \Carbon\Carbon::parse($biodata->dob)->addYears(60)->format('Y-m-d'); }}" readonly>
                              {!! $errors->first('date_bersara', '<p class="help-block text-danger">:message</p>') !!}
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-4 col-md-3  label">Ulasan <br> <i>Remarks</i></div>
                          <div class="col-lg-8 col-md-9">
                              <input type="textarea" name="ulasan" class="form-control">
                              {!! $errors->first('ulasan', '<p class="help-block text-danger">:message</p>') !!}
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