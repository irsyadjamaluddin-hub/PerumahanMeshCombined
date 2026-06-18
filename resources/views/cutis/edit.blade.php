@extends('layouts.app-all')

@section('title', 'Admin Edit Cuti')

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

                          

                </div>  

                <div class="col-md-1">
                    <a href="{{ route('cutis.cuti.index') }}" class= "btn btn-primary text-right">
                         Back 
                    </a>
                </div>
        </div>

         <!-- ART Table -->
         <div class="col-12">
              <div class="card recent-sales">

             

                <div class="card-body">

                    <div class="profile-overview pt-3">

                        

                        <h3 class="card-title">Edit Cuti Form</h3>

                        <form class="" method="post" action="{{ route('cutis.cuti.update') }}" enctype="multipart/form-data"> 
                        @csrf

                          @foreach ($cutis as $cuti)

                          <input type="text" name="id" class="bg-gray-200 form-control " value="{{$cuti->id}}" hidden>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Nama Penuh <br> <i>Fullname</i></div>
                                <div class="col-lg-8 col-md-9">
                                  <input type="text" name="name" class="bg-gray-200 form-control " value="{{$cuti->name}}" readonly>
                                    {!! $errors->first('name', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">No. Kad Pengenalan <br> <i>Identity Card No.</i></div>
                                <div class="col-lg-8 col-md-9">
                                  <input type="text" name="ic_no" class="bg-gray-200 form-control" value="{{$cuti->ic_no}}" readonly>
                                    {!! $errors->first('ic_no', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Jabatan<br> <i>Department</i></div>
                                <div class="col-lg-8 col-md-9">
                                  <input type="text" name="department" class="bg-gray-200 form-control" value="{{$cuti->department}}" readonly>
                                    {!! $errors->first('department', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-lg-4 col-md-3  label">Jabatan<br> <i>Department</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="department">
                                        <option value="{{ $cuti->department }}" readonly>{{($cuti->department)}}</option>
                                        @foreach ($department as $key => $value)
                                            <option value="{{ $key }}"> 
                                                {{ $value }} 
                                            </option>
                                        @endforeach    
                                    </select>
                                    {!! $errors->first('department', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                                
                            </div> --}}

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tarikh Mula Cuti<br> <i>Start Date on leave</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="date" id="first" name="start_date_cuti" class="form-control" value="{{$cuti->start_date_cuti}}">
                                    {!! $errors->first('start_date_cuti', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tarikh Akhir Cuti<br> <i>End Date on leave</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="date" id="second" name="end_date_cuti" class="form-control" value="{{$cuti->end_date_cuti}}">
                                    {!! $errors->first('end_date_cuti', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Jenis Cuti <br> <i>Type of Leave</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="jenis_cuti">
                                        <option value="{{ $cuti->jenis_cuti }}">{{ optional($cuti->jenis_cuti)->label }}</option>
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
                                <div class="col-lg-4 col-md-3  label">Catatan <br> <i>Remarks</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="textarea" id="catatan" name="catatan" class="form-control"  value="{{$cuti->catatan}}">
                                    {!! $errors->first('catatan', '<p class="help-block text-danger">:message</p>') !!}
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