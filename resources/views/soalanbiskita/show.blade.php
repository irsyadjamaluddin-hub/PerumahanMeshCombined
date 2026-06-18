@extends('layouts.app-all')

@section('title', 'Edit Tanya? MOEBN')

@section('content')

    <?php
        $pagename = "Tanya? MOEBN";
    ?>

    <div class="pagetitle">
      <h1>Tanya? MOEBN</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Edit Tanya? MOEBN</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <div class="row mb-2">

            <div class="col-md-11">

            </div>  

                <div class="col-md-1">
                <a href="{{ back()->getTargetUrl() }}" class="btn btn-primary mb-2">
                    <i class="bi bi-arrow-left-circle"></i>
                </a>
                </div>
        </div>

         <!-- Edit Admin Jk Table -->
         <div class="col-12">
              <div class="card recent-sales">

             

                <div class="card-body">

                    <div class="profile-overview pt-3">


                        <h3 class="card-title">Show Tanya? MOEBN</h3>

                      
                        @csrf

                          @foreach ($soalanbiskitas as $soalanbiskita)

                        <input type="text" name="id" class="bg-gray-200 form-control " value="{{$soalanbiskita->id}}" hidden>

                          <div class="row">
                            <div class="col-lg-4 col-md-3  label">Jabatan</div>
                            <div class="col-lg-8 col-md-9">
                              <input type="text" class="bg-gray-200 form-control " value="{{$soalanbiskita->kpd_jabatan}}" readonly>
                            </div>
                        </div>

            

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Perkara</div>
                            <div class="col-lg-8 col-md-9">
                            <input type="text"  class="bg-gray-200 form-control " value="{{$soalanbiskita->tajuk}}" readonly>
                        
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Pertanyaan</div>
                            <div class="col-lg-8 col-md-9">
                                <input type="text"   class="form-control" value="{{$soalanbiskita->aduan}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Nama</div>
                            <div class="col-lg-8 col-md-9">
                              <input type="text" class="bg-gray-200 form-control " value="{{$soalanbiskita->nama}}" readonly>
                               
                            </div>
                        </div>

                        
                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">No Tel</div>
                            <div class="col-lg-8 col-md-9">
                            <input type="text"  class="form-control" value="{{$soalanbiskita->no_tel}}" readonly>
                                
                            </div>
                        </div>

                                   
                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Email</div>
                            <div class="col-lg-8 col-md-9">
                              <input type="text" class="bg-gray-200 form-control " value="{{$soalanbiskita->emel}}" readonly>
                            
                           
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Mesej</div>
                            <div class="col-lg-8 col-md-9">
                           
                            <input type="text" class="bg-gray-200 form-control " value="{{$soalanbiskita->mesej}}" readonly>

                               
                                
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