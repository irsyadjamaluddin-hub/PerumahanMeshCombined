@extends('layouts.app-all')

@section('title', 'Admin Create Memangku')

@section('content')

<?php
    $pagename = "Admin_Acting";
  ?>

    <div class="pagetitle">
      <h1>Memangku</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Memangku</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <div class="row mb-2">

            <div class="col-md-11">

                          <div class="search-bar"><!-- Start Search Bar -->
                              <form class="search-form d-flex align-items-center"  method="get" action="{{ route('actings.acting.search') }}">
                                @csrf
                                <input type="text" name="ic_search" class="form-control" placeholder="Search IC No. Eg. 00123456">
                                
                                <button type="submit" class="btn btn-primary" title="Search"><i class="bi bi-search"></i></button>
                              </form>   
                          </div><!-- End IC No Search Bar -->

                </div>  

                <div class="col-md-1">
                    <a href="{{ route('actings.acting.index') }}" class= "btn btn-primary text-right">
                         Back 
                    </a>
                </div>
        </div>

         <!-- ART Table -->
         <div class="col-12">
              <div class="card recent-sales">

             

                <div class="card-body">

                    <div class="profile-overview pt-3">

                        

                        <h3 class="card-title">Memangku Form</h3>

                        <form class="" method="post" action="{{ route('actings.acting.store') }}" enctype="multipart/form-data"> 
                        @csrf

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Nama Penuh <br> <i>Fullname</i></div>
                                <div class="col-lg-8 col-md-9">
                                  <input type="text" name="name" class="form-control" >
                                    {!! $errors->first('name', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">No. Kad Pengenalan <br> <i>Identity Card No.</i></div>
                                <div class="col-lg-8 col-md-9">
                                  <input type="text" name="ic_no" class="form-control">
                                    {!! $errors->first('ic_no', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Jawatan yang dipangku <br> <i>Acting Post</i></div>
                                <div class="col-lg-8 col-md-9">
                                <input type="text" name="acting_post" class="form-control">
                                    {!! $errors->first('acting_post', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tanggagaji yang dipangku <br> <i>Acting Salary Scale</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="acting_salary_scale">
                                        <option></option>
                                        @foreach ($salary_scale as $key => $value)
                                            <option value="{{ $key }}"> 
                                                {{ $value }} 
                                            </option>
                                        @endforeach    
                                    </select>
                                    {!! $errors->first('acting_salary_scale', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tarikh Mula Memangku<br> <i>Start Date Acting</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="date" id="first" name="start_date_acting" class="form-control">
                                    {!! $errors->first('start_date_acting', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tarikh Berakhir Memangku<br> <i>End Date Acting</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="date" id="second" name="end_date_acting" class="form-control">
                                    {!! $errors->first('end_date_acting', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Sebab Memangku<br> <i>Reason of Acting</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="reason">
                                        <option></option>
                                        @foreach ($reason as $key => $value)
                                            <option value="{{ $key }}"> 
                                                {{ $value }} 
                                            </option>
                                        @endforeach    
                                    </select>
                                    {!! $errors->first('reason', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                         <!--    <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tempoh Memangku (Hari) <br> <i>Duration of Acting (Day/s)</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" id="result" name="acting_period" class="form-control">
                                    {!! $errors->first('acting_period', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>
 -->
                            <div id="result"></div>
                        

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Muat Naik Dokumen Memangku <br> <i>Upload Document Acting</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="file" name="acting_file" class="form-control">
                                    {!! $errors->first('acting_file', '<p class="help-block text-danger">:message</p>') !!}
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