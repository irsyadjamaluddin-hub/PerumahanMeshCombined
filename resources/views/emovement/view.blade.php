@extends('layouts.app-all')

@section('title', 'View Employee Movement')

@section('content')

<?php
$pagename = "View_Employee";
?>

<div class="pagetitle">
    <h1>View Employee Movement</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Employee Movement</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

        <div class="row mb-2">

            <div class="col-md-11">

                          

                </div>  

                <div class="col-md-1">
                    <a href="{{ route('emovements.emovement.index') }}" class= "btn btn-primary text-right">
                         Back 
                    </a>
                </div>
        </div>

         <div class="col-12">
              <div class="card recent-sales">

             

                <div class="card-body">

                    <div class="profile-overview pt-3">

                        

                        <h3 class="card-title">View Employee Movement Form</h3>

                        @foreach($employmentdetails as $emp)
                        
                        
                            <input type="text" name="id" class="bg-gray-200 form-control " value="{{ $emp->id}}" hidden>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Nama </div>
                                <div class="col-lg-8 col-md-9">
                                    @foreach($users as $user)
                                    <input type="text" name="nama" class="bg-gray-200 form-control" value="{{$user->name}}" readonly>
                                    
                                </div>
                            </div>                            
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">No. Kad Pengenalan </div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="ic_no" class="bg-gray-200 form-control" value="{{$user->ic_no}}" readonly>
                                    @endforeach
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-4 col-md-3  label">Jabatan Asal</label>
                                <div class="col-lg-8 col-md-9">
                                @foreach($employmentview as $emp)
                                    <input type="text" name="department_id" class="form-control"  value="{{ $emp->label }}"readonly>
                                @endforeach
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-4 col-md-3  label">Jabatan Sekarang</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="current_service_place" class="form-control"  value="{{$emp->current_service_place}}"readonly>
                                </div>
                                </div>

                              <div class="row">
                                <label for="inputText" class="col-lg-4 col-md-3  label">Unit</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="unit_id" class="form-control"  value="{{$emp->unit_id }}" readonly>
                                </div>
                                </div>
                            
                            <div class="row">
                                <label for="inputText" class="col-lg-4 col-md-3  label">Bahagian</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="bahagian_id" class="form-control"  value="{{$emp->bahagian_id }}" readonly>
                                </div>
                                </div>


                            <div class="row">
                                <label for="inputText" class="col-lg-4 col-md-3  label">Status</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="unit_id" class="form-control"  value="{{$emp->status_penempatan}}" readonly>
                                </div>
                                </div>

                            @endforeach
                          

                        </form>

                    </div>

                </div>
                 

                </div>

              </div>
            </div><!-- End Recent Sales -->

        </div>


    </section>
@endsection