@extends('layouts.app-all')

@section('title', 'Admin Acting')

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

    <div class="col-md-12">

        @if(Session::has('success_message'))
            <div class="alert alert-success">
                <i class=" fas fa-fw fa-check"></i>
                {!! session('success_message') !!}


            </div>
        @endif

        <div class="row mb-2">
            <div class="col-md-10">

              <div class="search-bar"><!-- Start Search Bar -->
                  <form class="search-form d-flex align-items-center"  method="get" action="{{ route('actings.acting.searchIC') }}">
                    @csrf
                     <input class="form-control"  type="text" name="ic_no" placeholder="Search by Name / IC Number (Eg. 00123456)">
                    <button type="submit" class="btn btn-primary" title="Search"><i class="bi bi-search"></i></button>
                  </form>   
              </div><!-- End Search Bar -->

            </div>  
                <div class="col-md-2">
                    <a href="{{ route('actings.acting.create') }}" class= "btn btn-primary text-right">
                         Add New 
                    </a>
                </div>
        </div>

       

         <!-- ART Table -->
         <div class="col-12">
              <div class="card recent-sales">

             

                <div class="card-body overflow-auto">
                  <!-- <h5 class="card-title">Recent Sales <span>| Today</span></h5> -->

                  <table class="table table-borderless datatable mt-3">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">IC No.</th>
                        <th scope="col">Jawatan yang dipangku</th>
                        <th scope="col">Tanggagaji yang dipangku</th>
                        <th scope="col">Tarikh Mula Memangku</th>
                        <th scope="col">Tarikh Akhir Memangku</th>
                        <th scope="col">Sebab Memangku</th>
                        <th scope="col">Tempoh Memangku</th>
                        <th scope="col">Dokumen</th>
                        <th scope="col">Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>

                    @if(count($acts) == 0)

                    <tr class="text-center">
                      <td colspan="8"><h5>No records found</h5></td>
                    </tr>
                          
                    @else
                    @foreach($acts as $act)

                      <tr>
                        <td>{{ $act->name }}</td>
                        <td>{{ $act->ic_no }}</td>
                        <td>{{ $act->acting_post }}</td>
                        <td>{{ optional($act->salaryScale)->label }}</td>
                        <td> {{ date('d/m/Y', strtotime($act->acting_start_date)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($act->acting_end_date)) }}</td>
                        <td>{{ optional($act->reasonActing)->label }}</td>
                        <td>@php $numberofDays = (\Carbon\Carbon::parse($act->acting_end_date)->addDay(1)->diff(\Carbon\Carbon::parse($act->acting_start_date))->format('%a')); @endphp
                          {{ $numberofDays}} Day/s</td>
                        <td>
                          @if($act->acting_file != '')
                          <a href='{{Storage::url("$act->acting_file") }}' target="_blank">View</a>
                          @endif
                        </td>
                        <td>
                        
                          <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                            <!----Edit Button----->
                            <form method="get" action="{{ route('actings.acting.edit', $act->id ) }}">
                            @csrf
                              <button type="submit" class="btn btn-outline-primary">
                              <i class="bi bi-pencil-fill"></i>
                              </button>
                            </form>


                            <!----Delete Button----->
                            <form method="post" action="{{ route('actings.acting.destroy', $act->id ) }}">
                            @csrf
                            @method('delete')
                            <a onclick='return confirm("Confirm to delete data?")'>
                              <button type="submit" class="btn btn-outline-danger" >
                              <i class="bi bi-trash-fill"></i>
                              </button>
                            </form>
                          </div>
                                
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