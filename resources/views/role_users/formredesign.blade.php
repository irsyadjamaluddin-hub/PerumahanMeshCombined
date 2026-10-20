@extends('layouts.app-all')

@section('title', 'Super Admin Edit Role User')

@section('content')
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>


<?php
    $pagename = "Super_Admin_Role_User";
  ?>

    <div class="pagetitle">
      <h1>Role User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Role User</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

      
                    <a href="{{ route('role_users.role_user.index') }}" class= "btn btn-primary text-right mb-2">
                    <i class="bi bi-arrow-left-circle"></i> 
                    </a>
           

       


<!--  Table -->
<div class="col-12">
              <div class="card recent-sales">

             

                <div class="card-body">

                <div class="profile-overview pt-3">

                  <h3 class="card-title">Edit Role Form</h3>



                  <form class="" method="post" action="{{ route('role_users.role_user.updatenew') }}" enctype="multipart/form-data"> 
                    @csrf
                    @foreach($newroles as $roleUser)

                    <input type="test" name="id" class="form-control" value="{{$roleUser->id}}" hidden>
                    <input type="test" name="user_id" class="form-control" value="{{$roleUser->user_id}}" hidden>
                  
                    @endforeach
                   
                    
                  
                    <div class="row">
                      <div class="col-lg-4 col-md-3  label">Name</div>
                        <div class="col-lg-8 col-md-9">
                          <input type="text" class="bg-gray-200 form-control" value="{{ optional($roleUser->user)->name }}" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-3  label">Email</div>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="bg-gray-200 form-control" value="{{ optional($roleUser->user)->email }}" disabled>
                            </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn2" href="#">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>                                        
                                    </div>

                    <table class="table-achiev" id="tableprestasi1" style="width: 65%;" align="center">
                                        <thead>
                                            <tr>
                                                <!-- <th style="text-align: center;">User Name</th> -->
                                                <!-- <th style="text-align: center;">User ID</th> -->
                                                <!-- <th style="text-align: center;">Komponen</th>
                                                <th style="text-align: center;">Kaitan</th> -->
                                                <th style="text-align: center;">User Role</th>
                                                <th style="text-align: center;">Tindakan</th>
                                            </tr>
                                        </thead>


                                        <tbody>

                                            

                                        @foreach($newroles as $roleUser)

                                            <tr class="text-center">

                                                <!-- <td>{{ optional($roleUser->user)->name }}</td> -->
                                                <!-- <td>{{$roleUser->user_id}}</td> -->
                                                <!-- <td>{{$roleUser->role_id}}</td> -->
                                                <td>{{optional($roleUser->role)->name }}</td>
                                                <td>
                                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                                      
                                                        <form method="post" action="{{ route('role_users.role_user.destroy', $roleUser->id ) }}">
                                                        
                                                            @csrf
                                                            @method('post')

                                                            
                                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('are you sure you want to delete?')">
                                                                <i class="bi bi-trash-fill"></i>
                                                            </button>
                                                            
                                                        </form>

                                                    </div>
                                                </td>






                                            </tr>

                                            

                                           
                                            @endforeach 

                                            

                                        </tbody>
                                        
                                    </table>
                    
                  
                            <br>
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

        <script>
                        $(document).ready(function() {
                            $('.js-example-basic-multiple').select2({
                            placeholder: "Select Roles",
                            maximumSelectionLength: 5
                            });
                            
                        });

                        $(document).ready(function() {
                      $('#addbtn2').off().on('click', function() {

                        var html = '';
                        html += '<tr>';

                               // html += ' <td><input type="text" name="user_id[]"  style="text-align:center"  value="{{$roleUser->user_id}}"  class="form-control" disabled></td>';
                               
                               // html += '<td><input id="user_id" type="text"  placeholder="{{$roleUser->user_id}}"  class="form-control @error('
                               // user_id ') is-invalid @enderror" name="user_id[]" style="text-align:center" value="{{$roleUser->user_id}}" required autocomplete="user_id" autofocus disabled></td>';
                    
                                html += ' <td><select class="form-control @error('
                                role_id') is-invalid @enderror" name="role_id[]" required autocomplete="role_id" autofocus><option value="" disabled selected hidden >Pilih Role</option>@foreach ($roles as $key => $value)<option value="{{ $key }}" {{ ( $key == $value)  ? 'selected' : '' }}>{{ $value }}</option>@endforeach</select></td>';

                                html += '<td style="text-align: center;"> <button class="btn btn-danger mt-2 mb-2 btn-sm  removeDeclare" type="button"><i class="bi bi-dash"></i></button></i></td>';
                                html += '</tr>';
                        $('#tableprestasi1').append(html);
                      })

                    });

                    $(document).on('click','.removeDeclare', function() {
                      $(this).parents('tr').remove();
                    });
                        </script>

    </section>

    <script>
    $('#myselect').select2({
    width: '100%',
    placeholder: "Choose role",
    allowClear: true
    });
</script>
@endsection