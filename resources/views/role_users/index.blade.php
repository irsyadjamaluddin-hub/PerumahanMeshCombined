
@extends('layouts.app-all')

@section('title', 'Super Admin Role User')

@section('content')

  <?php
    $pagename = "Super_Admin_Role_User";
  ?>

    <div class="pagetitle">
      <h1>Role User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active"><a href="{{ route('role_users.role_user.index') }}">Role User</a></li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

    <div class="col-md-12">

        @if(Session::has('success_message'))
            <div class="alert alert-success">
                <i class=" fas fa-fw fa-check"></i>
                {!! session('success_message') !!}
            </div>
        @endif

    <div class="row mb-2 w-100" style="text-align: right;"">
      <div class="col-md-1 w-100">
          <a href="{{ route('role_users.role_user.roleindex') }}" class="btn btn-primary" title="Add Roles">
              <i class="bi bi-file-plus"></i>
          </a>
      </div>
    </div>

<!-- Start Search Bar -->
<!--        <div class="row mb-2">
            <div class="col-md-10">

              <div class="search-bar">
                  <form class="search-form d-flex align-items-center"  method="get" action="{{ route('role_users.role_user.search') }}">
                    @csrf
                        <input class="form-control" type="text" name='id' placeholder="Serach by Name / IC Number (Eg. 00123456) ">
                    <button type="submit" class="btn btn-primary" title="Search"><i class="bi bi-search"></i></button>
                  </form>   
              </div>

            </div>   
        </div> -->
<!-- End Search Bar -->
        

         <!-- Role User Table -->
         <div class="col-12">
              <div class="card recent-sales">
                <div class="card-body overflow-auto">
                  <!-- <h5 class="card-title">Recent Sales <span>| Today</span></h5> -->

                  <table class="table table-borderless datatable mt-3">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>IC No</th>
                        <!-- <th>Role Name</th> -->
                        <th>Email</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>

                        @if(count($Users) == 0)

              <tr class="text-center">
                <td colspan="8"><h5>No records found</h5></td>
              </tr>
                    
            @else
            
            @foreach($Users as $User)
            

            <tr>
              <!-- <td>{{ optional($User->user)->name }}</td>
              <td>{{ optional($User->user)->ic_no }}</td>
              <td>{{ optional($User->role)->name }}</td>
              <td>{{ optional($User->user)->email }}</td> -->
              <td>{{ $User->name }}</td>
							<td>{{ $User->ic_no }}</td>
              <!-- <td>role</td>  -->
              <td>{{ $User->email }}</td>
              
              

              <td>

                {{---{!! Form::open([
                  'method' =>'DELETE',
                  'route'  => ['role_users.role_user.destroy', $roleUser->id],
                ]) !!}--}}


                  <div class="flex flex-row items-center justify-center gap-2" role="group">
                    
                    <!-- <a href="{{ route('role_users.role_user.show', $User->id ) }}" class="btn btn-outline-primary" title="Show Role">
                      <i class="bi bi-pencil-fill"></i>
                    </a> -->

                    @php  ($k = $User->id) @endphp

                    @if ($k == 1)
                    
                    @else
                      <!-- <a href="{{ route('role_users.role_user.formredesign', $User->id ) }}" class="btn btn-outline-primary" title="Edit Role"> -->
                      <a href="{{ route('role_users.role_user.formredesign', ['newroles' => Crypt::encryptString($User->id)] ) }}" class="btn btn-outline-primary" title="Edit Role">
                        <i class="bi bi-pencil-fill"></i>
                      </a>

                      {{---{!! Form::button('
                        <i class="bi bi-trash-fill"></i>', 
                        [   
                          'type'    => 'submit',
                          'class'   => 'btn btn-outline-danger',
                          'title'   => 'Delete Claimant',
                          'onclick' => 'return confirm("' . 'Delete Role User?' . '")'
                        ])
                      !!}--}}
                    @endif

                  </div>

                {{--{!! Form::close() !!}--}}

              </td>
                                
                               

                              
                                
            </tr>

                        @endforeach
                        @endif
                     
                    </tbody>
                  </table>

               
            

                </div>

              </div>
            </div><!-- End Recent Sales -->

        </div>


    </section>
@endsection