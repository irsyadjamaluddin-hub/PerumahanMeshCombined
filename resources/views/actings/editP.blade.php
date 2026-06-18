@extends('layouts.app-all')

@section('title', 'Edit Memangku')

@section('content')

    <?php
        $pagename = "Memangku";
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

                          

                </div>  

                <div class="col-md-1">
                    <a href="{{ route('actings.acting.indexP') }}" class= "btn btn-primary text-right">
                         Back 
                    </a>
                </div>
        </div>

         <!-- ART Table -->
         <div class="col-12">
              <div class="card recent-sales">

             

                <div class="card-body">

                    <div class="profile-overview pt-3">

                        

                        <h3 class="card-title">Edit Memangku Form</h3>

                        <form class="" method="post" action="{{ route('actings.acting.updateP') }}" enctype="multipart/form-data"> 
                        @csrf

                          @foreach ($actings as $act)

                          <input type="text" name="id" class="bg-gray-200 form-control " value="{{$act->id}}" hidden>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Nama Penuh <br> <i>Fullname</i></div>
                                <div class="col-lg-8 col-md-9">
                                  <input type="text" name="name" class="bg-gray-200 form-control " value="{{$act->name}}" readonly>
                                    {!! $errors->first('name', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">No. Kad Pengenalan <br> <i>Identity Card No.</i></div>
                                <div class="col-lg-8 col-md-9">
                                  <input type="text" name="ic_no" class="bg-gray-200 form-control" value="{{$act->ic_no}}" readonly>
                                    {!! $errors->first('ic_no', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Jawatan yang dipangku <br> <i>Acting Post</i></div>
                                <div class="col-lg-8 col-md-9">
                                <input type="text" name="acting_post" class="bg-gray-200 form-control" value="{{$act->acting_post}}" readonly>
                                    {!! $errors->first('acting_post', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tanggagaji yang dipangku <br> <i>Acting Salary Scale</i></div>
                                <div class="col-lg-8 col-md-9">
                                  <input type="text" class="bg-gray-200 form-control" value="{{ optional($act->salaryScale)->label }}" readonly>
                                  <input type="text" value="{{ $act->acting_salary_scale }}" name="acting_salary_scale" class="bg-gray-200 form-control" hidden>
                                    {!! $errors->first('acting_salary_scale', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tarikh Mula Memangku<br> <i>Start Date Acting</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="date" id="first" name="start_date_acting" class="bg-gray-200  form-control" value="{{$act->acting_start_date}}" readonly>
                                    {!! $errors->first('start_date_acting', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tarikh Berakhir Memangku<br> <i>End Date Acting</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="date" id="second" name="end_date_acting" class="bg-gray-200  form-control" value="{{$act->acting_end_date}}" readonly>
                                    {!! $errors->first('end_date_acting', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Sebab Memangku<br> <i>Reason of Acting</i></div>
                                <div class="col-lg-8 col-md-9">
                                  <input type="text" id="second" class="bg-gray-200  form-control" value="{{ optional($act->reasonActing)->label }}" readonly>
                                  <input type="text" id="second" value="{{ $act->acting_reason }}" name="reason" class="bg-gray-200  form-control" hidden>
                                    {!! $errors->first('reason', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                       <!--      <div class="row">
                                <div class="col-lg-4 col-md-3  label">Tempoh Memangku (Hari) <br> <i>Duration of Acting (Day/s)</i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" id="result" name="acting_period" class="form-control"  value="{{$act->acting_period}}" readonly>
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