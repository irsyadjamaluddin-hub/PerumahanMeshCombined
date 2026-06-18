@extends('layouts.app-all')

@section('title', 'Admin Bersara')

@section('content')

  <?php
    $pagename = "Admin_Bersara";
  ?>

    <div class="pagetitle">
      <h1>Bersara</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Bersara</li>  
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
                  <form class="search-form d-flex align-items-center"  method="get" action="{{ route('bersaras.bersara.searchIC') }}">
                    @csrf
                     <input class="form-control"  type="text" name="ic_no" placeholder="Search by Name / IC Number (Eg. 00123456)">
                    <button type="submit" class="btn btn-primary" title="Search"><i class="bi bi-search"></i></button>
                  </form>   
              </div><!-- End Search Bar -->

            </div>  
                <div class="col-md-2">
                    <a href="{{ route('bersaras.bersara.create') }}" class= "btn btn-primary text-right">
                         Add New 
                    </a>
                </div>
        </div>

       

         <!-- ART Table -->
         <div class="col-12">
              <div class="card recent-sales overflow-auto">

             

                <div class="card-body">
                  <!-- <h5 class="card-title">Recent Sales <span>| Today</span></h5> -->

                  <table class="table table-borderless datatable mt-3">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">IC No.</th>
                        <th scope="col">Jawatan Bersara</th>
                        <th scope="col">Penamatan</th>
                        <th scope="col">Peruntukan Bersara</th>
                        <th scope="col">Tarikh Mula Cuti Bersara</th>
                        <th scope="col">Tarikh Berakhir Cuti Bersara</th>
                        <th scope="col">Tarikh Penamatan</th>
                        <th scope="col">Ulasan</th>
                        <th scope="col">Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>

                    @if(count($bersaras) == 0)

                    <tr class="text-center">
                      <td colspan="8"><h5>No records found</h5></td>
                    </tr>
                          
                    @else
                    @foreach($bersaras as $bersara)

                      <tr>
                        <td>{{ $bersara->name }}</td>
                        <td>{{ $bersara->ic_no }}</td>
                        <td>{{ $bersara->bersara_post}}</td>
                        {{-- <td>{{ optional($bersara->Retirementposition)->label }}</td> --}}
                        <td>{{ optional($bersara->Terminationtype)->label }}</td>
                        <td>{{ optional($bersara->Retirementposition1)->label }}</td>

                        @if ($bersara ->date_cuti_bersara==null)
                            <td>  </td>        
                            @else
                            
                            <td>{{ date('d/m/Y', strtotime($bersara->date_cuti_bersara)) }}</td>
                        @endif


                        @if ($bersara ->end_date_bersara==null)
                        <td>  </td>        
                        @else
                        <td>{{ date('d/m/Y', strtotime($bersara->end_date_bersara)) }}</td>
                        @endif


                        @if ($bersara ->date_bersara==null)
                        <td>  </td>        
                        @else
                          <td>{{ date('d/m/Y', strtotime($bersara->date_bersara)) }}</td>
                          @endif
                        
                        
                        <td>{{ $bersara->ulasan}}</td>
                    
                    
                        <td>
                          <div class="btn-group gap-2" role="group" aria-label="Basic example"> 
                            <!----Edit Button----->
                            <form method="get" action="{{ route('bersaras.bersara.edit', $bersara->id ) }}">
                            @csrf
                              <button type="submit" class="btn btn-outline-primary">
                              <i class="bi bi-pencil-fill"></i>
                              </button>
                            </form>


                            <!----Delete Button----->
                            <form method="post" action="{{ route('bersaras.bersara.destroy', $bersara->id ) }}">
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