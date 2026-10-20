@extends('layouts.app-all')

@section('title', 'Admin Cuti')

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" sections; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
<div class="mesh-home-theme">
{{-- #================================ --}}

  <?php
    $pagename = "Admin_Cuti";
  ?>

    <div class="pagetitle">
      <h1>Cuti</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          {{-- <li class="breadcrumb-item">Users</li> --}}
          <li class="breadcrumb-item active">Cuti</li>  
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
                  <form class="search-form d-flex align-items-center"  method="get" action="{{ route('cutis.cuti.searchIC') }}">
                    @csrf
                     <input class="form-control"  type="text" name="ic_no" placeholder="Search by Name / IC Number (Eg. 00123456)">
                    <button type="submit" class="btn btn-primary" title="Search"><i class="bi bi-search"></i></button>
                  </form>   
              </div><!-- End Search Bar -->

            </div>  
                <div class="col-md-2">
                    <a href="{{ route('cutis.cuti.create') }}" class= "btn btn-primary text-right">
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
                        <th scope="col">Jabatan</th>
                        <th scope="col">Tarikh Mula Cuti</th>
                        <th scope="col">Tarikh Akhir Cuti</th>
                        <th scope="col">Jenis Cuti</th>
                        <th scope="col">Tempoh Cuti</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>

                    @if(count($cutis) == 0)

                    <tr class="text-center">
                      <td colspan="8"><h5>No records found</h5></td>
                    </tr>
                          
                    @else
                    @foreach($cutis as $cuti)

                      <tr>
                        <td>{{ $cuti->name }}</td>
                        <td>{{ $cuti->ic_no }}</td>
                        <td>{{ $cuti->department }}</td>
                

                    @if ($cuti ->start_date_cuti==null)
                     <td>  </td>        
                    @else
                    <td> {{ date('d/m/Y', strtotime($cuti->start_date_cuti)) }}</td>
                     @endif


                     @if ($cuti ->end_date_cuti==null)
                     <td>  </td>        
                    @else
                        <td>{{ date('d/m/Y', strtotime($cuti->end_date_cuti)) }}</td>

                        @endif

                        <td>{{ optional($cuti->jeniscuti)->label }}</td>
                        <td> @php $numberofCutiDays = (\Carbon\Carbon::parse($cuti->end_date_cuti)->addDay(1)->diff(\Carbon\Carbon::parse($cuti->start_date_cuti))->format('%a')); @endphp
                        {{ $numberofCutiDays }} Days/s </td>
                        <td>{{ $cuti->catatan}}</td>
                      
                        <td>
                        
                          <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                            <!----Edit Button----->
                            <form method="get" action="{{ route('cutis.cuti.edit', $cuti->id ) }}">
                            @csrf
                              <button type="submit" class="btn btn-outline-primary">
                              <i class="bi bi-pencil-fill"></i>
                              </button>
                            </form>


                            <!----Delete Button----->
                            <form method="post" action="{{ route('cutis.cuti.destroy', $cuti->id ) }}">
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
{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
@endsection