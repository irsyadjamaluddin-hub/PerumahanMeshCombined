@extends('layouts.app-all')

@section('title', 'Edit Jabatan List')

@section('content')

<?php 
    $pagename = "Tanya MOEBN";
  ?>

    <div class="pagetitle">
    <h1>Tanya @MOEBN</h1>
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Tanya @MOEBN</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <div class="row mb-2">

            <div class="col-md-11">

                          

                </div>  

                <div class="col-md-1">
                    <a href="{{ route('soalanbiskita.soalanbiskita.indexadmin') }}" class= "btn btn-primary text-right">
                         Back 
                    </a>
                </div>
        </div>

         <!--  Table -->
         <div class="col-12">
              <div class="card recent-sales">

             

                <div class="card-body">

                    <div class="profile-overview pt-3">

                        
                        <h3 class="card-title">Edit Senarai Jabatan</h3>

                        <form class="" method="post" action="{{ route('soalanbiskita.soalanbiskita.updatedept') }}" enctype="multipart/form-data"> 
                        @csrf

                          @foreach ($soalanbiskitadepartments as $soalanbiskitadept)

                          <input type="text" name="id" class="bg-gray-200 form-control " value="{{$soalanbiskitadept->id}}" hidden>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Jabatan</div>
                                <div class="col-lg-8 col-md-9">
                                  <input type="text" name="label" class="bg-gray-200 form-control " value="{{$soalanbiskitadept->label}}" readonly>
                                    {!! $errors->first('label', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Contact.No.</div>
                                <div class="col-lg-8 col-md-9">
                                  <input type="text" name="contact_no" class="bg-gray-200 form-control" value="{{$soalanbiskitadept->contact_no}}">
                                    {!! $errors->first('contact_no', '<p class="help-block text-danger">:message</p>') !!}
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