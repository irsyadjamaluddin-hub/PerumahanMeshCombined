@extends('layouts.app-all')

@section('title', 'Admin Show Feedback')

@section('content')

<?php
$pagename = "Feedback";
?>

<div class="pagetitle">
    <h1>Feedback</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Feedback</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">


    <a href="{{ route('feedbacks.feedback.indexadmin') }}" class="btn btn-primary text-right mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>


    <!-- QO Table -->
    <div class="col-12">
        <div class="card recent-sales">



            <div class="card-body">

                <div class="profile-overview pt-3">


                    <div class="col profile-overview" style="border: 8px solid #012970; padding: 20px; border-radius: 25px;">

                        <h5 class="card-title" style="text-decoration: underline;">View Feedback</h5>

                      

                        <div class="row">
                      
                            <div class="col-lg-4 col-md-3  label">Jenis: </div>

                            <div class="col-lg-8 col-md-9">{{$feedbacks->jenis}}</div>

                       <hr>    
                            
                       <br>

                            <div class="col-lg-4 col-md-3  label">Catatan <br></div>
                            <div class="col-lg-8 col-md-9">{{$feedbacks->catatan}}</div>
                       
                        <hr>   
                        <br>

                            <div class="col-lg-4 col-md-3  label">Name </div>
                            <div class="col-lg-8 col-md-9">{{$feedbacks->nama}} </div>

                        <hr>   
                        <br>
                            <div class="col-lg-4 col-md-3  label">Contact</div>
                            <div class="col-lg-8 col-md-9"> {{$feedbacks->contact}}</div>

                        <hr>   

                          
                        </div>



                        
                </div>

            </div>


        </div>

    </div>




</section>
@endsection