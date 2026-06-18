@extends('layouts.app-all')

@section('title', 'Edit Employee Movement')

@section('content')

<?php 
    $pagename = "Employee";
  ?>

    <div class="pagetitle">
      <h1>Edit Employee Movement</h1>
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

         <!-- ART Table -->
         <div class="col-12">
              <div class="card recent-sales">

             

                <div class="card-body">

                    <div class="profile-overview pt-3">

                        <h3 class="card-title">Edit Employee Movement Form</h3>

                        <form method="post" action="{{ route('emovements.emovement.updateEM') }}" enctype="multipart/form-data"> 
                        @csrf

                        @foreach($employmentdetails as $emp)

                        <input type="text" name="id" class="bg-gray-200 form-control " value="{{ $emp->id}}" hidden>

                      @foreach($users as $user)
                      <div class="row">
                                <div class="col-lg-4 col-md-3  label">Nama </div>
                                <div class="col-lg-8 col-md-9">
                                    
                                        <input type="text" name="nama" class="bg-gray-200 form-control" value="{{$user->name}}" readonly>
                                    
                                </div>
                            </div>    
                        
                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">No. Kad Pengenalan </div>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" name="ic_no" class="bg-gray-200 form-control" value="{{$user->ic_no}}" readonly>
                                
                            </div>
                        </div>
                        @endforeach

                        <div class="row">
                            <label for="inputText" class="col-lg-4 col-md-3  label">Jabatan Asal</label>
                            <div class="col-lg-8 col-md-9">
                                <select class="form-select" name="department_id" id="myselection">
                                @foreach($employment as $emp)
                                    <option value= "{{ $emp->department_id }}"> {{ $emp->label }}</option>
                                @endforeach
                                    @foreach ($department as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputText" class="col-lg-4 col-md-3  label">Jabatan Sekarang</label>
                            <div class="col-lg-8 col-md-9">
                            <select class="form-select" name="department_other" id="myselection2">
                                @foreach($employment2 as $emp)
                                    <option value= "{{ $emp->department_other }}"> {{ $emp->label }}</option>
                                @endforeach
                                    @foreach ($department as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            </div>

                        <div class="row">
                            <label for="inputText" class="col-lg-4 col-md-3  label">Unit</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" name="unit_id" class="form-control"  value="{{$emp->unit_id }}">
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputText" class="col-lg-4 col-md-3  label">Bahagian</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" name="bahagian_id" class="form-control"  value="{{$emp->bahagian_id }}">
                            </div>
                         </div>


                        <div class="row">
                            <label for="inputText" class="col-lg-4 col-md-3  label">Status</label>
                            <div class="col-lg-8 col-md-9">
                                <select type="text" class="form-control" name="status_penempatan" value="{{$emp->status_penempatan}}">
                                    <option value="{{ $emp->status_penempatan }}">{{ $emp->status_penempatan }}</option>
                                    <option value="Diperbantukan">Diperbantukan</option> 
                                    <option value="Dipindah">Dipindah</option>
                                </select>
                            </div>
                            </div>

                        @endforeach

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
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

 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 

<!-- jQuery --> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

<!-- Select2 JS --> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function(){

        // Initialize select2
        $("#myselection").select2();

        // Read selected option
        $('#but_read').click(function(){
        var username = $('#myselection option:selected').text();
        var userid = $('#myselection').val();

        $('#result').html("id : " + userid + ", name : " + username);

        });
    });

    $(document).ready(function(){

// Initialize select2
$("#myselection2").select2();

// Read selected option
$('#but_read').click(function(){
var username = $('#myselection2 option:selected').text();
var userid = $('#myselection2').val();

$('#result').html("id : " + userid + ", name : " + username);

});
});
</script>
