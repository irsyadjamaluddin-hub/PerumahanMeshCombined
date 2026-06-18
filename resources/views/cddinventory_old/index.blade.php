@extends('layouts.app-all')

@section('title', 'Inventory Index')

@section('content')

<?php
    $pagename = "Cddinventory";
  ?>

    <div class="pagetitle">
      <h1>Inventory CDD</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
  
          <li class="breadcrumb-item active">Inventory</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <!--  Index Table -->


            @if(Session::has('success_message'))
            <div class="alert alert-success">
                <i class=" fas fa-fw fa-check"></i>
                {!! session('success_message') !!}


            </div>
            @endif

          

    
           <!-- start button -->

           <div class="card-body d-flex justify-content-end" style="padding: 10px;">
                <button type="button" data-bs-toggle="modal" data-bs-target="#infoModal" class="btn btn-primary">Borang</button>
                @if (Auth::check())
                @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_CDDINVENTORY') )
                <a  href="{{ route('cddinventory.indexgbpg') }}" class="btn btn-secondary ms-3"><i class="bi bi-person-badge"></i></a>
                @endif
                @endif
            </div>


            
       

            <!-- Basic Modal -->
            <div class="modal fade" id="infoModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                                <a href="{{ route('cddinventory.cddinventory.create') }}">
                                    <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                                            <div class="card-body" style="padding: 10px;">
                                                <div class="d-flex align-items-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-file-earmark-post-fill"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6 style="font-size: 22px;">Sekolah</h6>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </a>
                                  
                          
                                    <a href="{{ route('cddinventory.cddinventory.createunit') }}">
                                        <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                                            <div class="card-body" style="padding: 10px;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                            <i class="bi bi-file-earmark-post"></i>
                                                        </div>
                                                        <div class="ps-3">
                                                            <h6 style="font-size: 22px;">Unit</h6>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </a>
                                    
                        </div>
                    </div>
                </div>
             </div>
            </div><!-- End Basic Modal -->

           <!-- end button -->

           <div class="card mt-3">
                <div class="card-body pt-3">

                    <!-- Bordered Tabs -->

                    <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                    <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#sekolah-in">Sekolah</button>
                    </li>

                    <li class="nav-item">
                    <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#unit-in">Unit</button>
                    </li>
                    </ul>

                    <br>
                    <!-- Clsoe Bordered Tabs -->
                    <div class ="tab-content pt-2">

                    <!-- first tab -->

                        <div class="tab-pane fade show active sekolah-in" id="sekolah-in">
                            
                         <div class="card-body overflow-auto">
                            
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Bil.</th>
                                        <th scope="col">Nama Sekolah</th>
                                        <th scope="col">Tarikh</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Borang Pengeluaran</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                
                                
                                @if(count($inventory) == null)
                                    <tr class="text-center">
                                        <td colspan="8">
                                            <h5>No records found</h5>
                                        </td>
                                    </tr>

                                @else
                                @foreach($inventory as $inventory)   

                                    <tr>

                                       <td>{{\Carbon\Carbon::parse($inventory->created_at)->format('Y')}}/SP/BBK-{{ $inventory->id }}</td>

                                        <td>{{ $inventory->nama_sch }}</td>
                                        <td>{{ $inventory->created_at }}</td>

                                        @if ($inventory->kgp_status == NULL)
                                        <td><span class="badge bg-danger">Pending approval</span></td>
                                        @elseif ($inventory->kgp_status == "Need Amendments")
                                        <td><span class="badge bg-warning">{{$inventory->kgp_status}}</span></td>
                                        @else
                                        <td><span class="badge bg-success">{{$inventory->kgp_status}}</span></td>

                                        <!-- <td><span class="badge bg-success">Diterima/span></td> -->
                                        @endif

                                        @if ($inventory->bp_status == NULL)
                                        <td></td>
                                        @else 

                                        <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                            <!----Borang Pengeluaran Button----->
                                            <form method="get" action="{{ route('cddinventory.cddinventory.bpform', $inventory->id ) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-file-earmark-text-fill"></i>
                                            </button>

                                            </form>

                                            </div>
                                        </td>
        
                                        @endif
                                
                                        
                                        <td>
                                            <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                                <!----Edit Button----->
                                                <form method="get" action="{{ route('cddinventory.cddinventory.edit', $inventory->id ) }}">
                                                    @csrf

                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>

                                                </form>

                                                @if($inventory->kgp_status == 'Approve')

                                                @else
                                                <!----Delete Button----->
                                                <form method="post" action="{{ route('cddinventory.cddinventory.destroy', $inventory->id ) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <a onclick='return confirm("Confirm to delete data?")'>
                                                    <button type="submit" class="btn btn-outline-danger" >
                                                    <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                    @endif

                                    
                                

                                </tbody>
                            </table>

                         </div>
                        </div>
                    <!-- end 1st tab -->

               
                   
                   
                   <div class="tab-pane fade unit-in pt-2" id="unit-in">

                   <div class="card-body overflow-auto">
                            
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Bil.</th>
                                        <th scope="col">Nama Unit</th>
                                        <th scope="col">Tarikh</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Borang Pengeluaran</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                
                                
                                @if(count($inventoryunit) == null)
                                    <tr class="text-center">
                                        <td colspan="8">
                                            <h5>No records found</h5>
                                        </td>
                                    </tr>

                                @else
                                @foreach($inventoryunit as $inventoryunit)   

                                    <tr>
                                        
                                        <td>{{\Carbon\Carbon::parse($inventoryunit->created_at)->format('Y')}}/UP/BBK-{{ $inventoryunit->id }}</td>

                                        <td>{{ $inventoryunit->unit }}</td>
                                        <td>{{ $inventoryunit->created_at }}</td>

                                        @if ($inventoryunit->kgp_status == NULL)
                                        <td><span class="badge bg-success">Sent</span></td>
                                        @elseif ($inventoryunit->kgp_status == "Need Amendments")
                                        <td><span class="badge bg-warning">Need Amendments</span></td>
                                        @else
                                        <td><span class="badge bg-success">{{$inventoryunit->kgp_status}}</span></td>

                                        <!-- <td><span class="badge bg-success">Diterima/span></td> -->
                                        @endif

                                        @if ($inventoryunit->bp_status == NULL)
                                        <td></td>
                                        @else 

                                        <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                            <!----Borang Pengeluaran Button----->
                                            <form method="get" action="{{ route('cddinventory.cddinventory.bpform', $inventoryunit->id ) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-file-earmark-text-fill"></i>
                                            </button>

                                            </form>

                                            </div>
                                        </td>
        
                                        @endif
                                
                                        
                                        <td>
                                            <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                                <!----Edit Button----->
                                                <form method="get" action="{{ route('cddinventory.cddinventory.editunit', $inventoryunit->id ) }}">
                                                    @csrf

                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>

                                                </form>

                                                 @if($inventoryunit->kgp_status == 'Approve')

                                                @else

                                                <!----Delete Button----->
                                                <form method="post" action="{{ route('cddinventory.cddinventory.destroy', $inventoryunit->id ) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <a onclick='return confirm("Confirm to delete data?")'>
                                                    <button type="submit" class="btn btn-outline-danger" >
                                                    <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                    @endif

                                    
                                

                                </tbody>
                            </table>

                         </div>
                    
                   </div>
                  </div>

        
        



    </section>
@endsection