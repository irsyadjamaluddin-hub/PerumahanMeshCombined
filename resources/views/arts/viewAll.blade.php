@extends('layouts.app-all')

@section('title', 'Admin View ART')

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

                          

                </div>  

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

                        

                        <h3 class="card-title">View ART</h3>

                       

                        @foreach($biodatas as $biodata)

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Nama Penuh <br> <i>Fullname</i></div>
                                <div class="col-lg-8 col-md-9">
                                    {{$biodata->name}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">No. Kad Pengenalan <br> <i>Identity Number</i></div>
                                <div class="col-lg-8 col-md-9">
                                    {{Auth::user()->ic_no}}
                                </div>
                            </div>

                        @endforeach



                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Jabatan  <br> <i>Department </i></div>
                            <div class="col-lg-8 col-md-9">

                            @foreach($employments as $employment)
                            
                                {{ optional($employment->department)->label }}
                                
                            @endforeach

                                

                            </div>
                        </div>

                        @foreach($arts as $art)

                        

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Tempat Bertugas (Bahagian/Unit) <br> <i>Work Placement (Section/Unit)</i></div>
                            <div class="col-lg-8 col-md-9">
                               {{ $art->work_place }}
                            </div>
                            
                        </div>

                        

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Tarikh Ujian ART <br> <i>ART Test Date</i></div>
                            <div class="col-lg-8 col-md-9">
                                {{ $art->date_test }}
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Keputusan ART <br> <i>ART Result</i></div>
                            <div class="col-lg-8 col-md-9">
                                @if($art->date_test == "-ve")
                                    Negative
                                @else
                                    Positive
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Gambar ART <br> <i>Photo ART</i></div>
                            <div class="col-lg-8 col-md-9">
                               

                                
                                <img src='{{Storage::url("$art->art_image") }}' width="200" height="200">
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Remark (Jika Ada) <br> <i>Remark (If Any)</i></div>
                            <div class="col-lg-8 col-md-9">
                                {{ $art->remark }}
                                
                            </div>
                        </div>

                        @endforeach
                            
                      

                       


                        
                    
                    </div>

                </div>
                 

                </div>

              </div>
            </div><!-- End Recent Sales -->

        </div>


    </section>
@endsection