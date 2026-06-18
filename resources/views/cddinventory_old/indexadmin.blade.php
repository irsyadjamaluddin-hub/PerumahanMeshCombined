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

            <a href="{{ route('inventorybbk.exportToExcel') }}" class="btn btn-success">
                Export Excel
            </a>

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
                                    <th scope="col">Bil. ID</th>

                                    <th scope="col">Nama Sekolah</th>
                                    <th scope="col">Tarikh</th>
                                    <th scope="col">Tindakan Status</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Borang Pengeluaran</th>
                                    <th scope="col">Status Pengambilan</th>


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
                                    @php
                                        // Get related inventorybbk records
                                        $bbkRecords = $inventorybbk[$inventory->id] ?? []; // Get the related bbk records
                                        $filledCount = collect($bbkRecords)->whereNotNull('cdd_status')->count(); // Count filled cdd_status
                                        $totalCount = count($bbkRecords); // Total records

                                        // Calculate the percentage if there are records
                                        $percentageFilled = $totalCount > 0 ? ($filledCount / $totalCount) * 100 : 0;
                                    @endphp

           

                                    <td>
                                    {{-- Display the rounded percentage with corresponding message and color --}}
                                        @if ($percentageFilled === 100)
                                            <span style="color: green;">Selesai ({{ number_format($percentageFilled, 0) }}%) </span>
                                        @elseif ($percentageFilled === 0)
                                            <span style="color: red;">Untuk tindakan ({{ number_format($percentageFilled, 0) }}%)</span>
                                        @else
                                            <span style="color: orange;">Dalam proses ({{ number_format($percentageFilled, 0) }}%)</span>
                                        @endif
                                    </td>
                                
                                    
                                    
                               
                                    
                                    <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                         <!----Edit Button----->
                                         <form method="get" action="{{ route('cddinventory.cddinventory.editadmin', $inventory->id ) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>

                                        </form>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                         <!----Borang Pengeluaran Button----->

                        
                                         <form method="get" action="{{ route('cddinventory.cddinventory.borangpengeluaran', $inventory->id ) }}">
                                            @csrf

                                            @if ($inventory->bp_status == NULL)

                                             <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-file-earmark-text-fill"></i>
                                            </button>


                                            @else

                                              <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-file-earmark-text-fill"></i>
                                            </button>

                                            @endif


                                        </form>

                                        </div>
                                    </td>

                                    <td>
                                   
                                   @if (!empty($inventory->bp_recieve_nama))
                                       <span style="color: green;">Collected</span>
                                   @else
                                       <span style="color: red;">N/A</span>
                                  
                                   @endif
                               </td>

                                </tr>
                                @endforeach
                                @endif

                                
                            

                            </tbody>
                        </table>

                    </div>
                
                </div>

                <div class="tab-pane fade unit-in pt-2" id="unit-in">
                <div class="card-body overflow-auto">

                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Bil. ID</th>

                                <th scope="col">Nama Sekolah</th>
                                <th scope="col">Tarikh</th>
                                <th scope="col">Tindakan Status</th>
                                <th scope="col">Action</th>
                                <th scope="col">Borang Pengeluaran</th>
                                <th scope="col">Status Pengambilan</th>

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

                                   @php
                                        // Get related inventorybbk records
                                        $bbkRecordsunit = $inventorybbkunit[$inventoryunit->id] ?? []; // Get the related bbk records
                                        $filledCountunit = collect($bbkRecordsunit)->whereNotNull('cdd_status')->count(); // Count filled cdd_status
                                        $totalCountunit = count($bbkRecordsunit); // Total records

                                        // Calculate the percentage if there are records
                                        $percentageFilled = $totalCountunit > 0 ? ($filledCountunit / $totalCountunit) * 100 : 0;
                                    @endphp

                                    


                                    <td>
                                    {{-- Display the rounded percentage with corresponding message and color --}}
                                        @if ($percentageFilled === 100)
                                            <span style="color: green;">Selesai ({{ number_format($percentageFilled, 0) }}%) </span>
                                        @elseif ($percentageFilled === 0)
                                            <span style="color: red;">Untuk tindakan ({{ number_format($percentageFilled, 0) }}%)</span>
                                        @else
                                            <span style="color: orange;">Dalam proses ({{ number_format($percentageFilled, 0) }}%)</span>
                                        @endif
                                    </td>
                                
                                

                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                    <!----Edit Button----->
                                    <form method="get" action="{{ route('cddinventory.cddinventory.editadminunit', $inventoryunit->id ) }}">
                                        @csrf

                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>

                                    </form>

                                    </div>
                                </td>

                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                    <!----Borang Pengeluaran Button----->
                                    <form method="get" action="{{ route('cddinventory.cddinventory.borangpengeluaran', $inventoryunit->id ) }}">
                                        @csrf

                                       @if ($inventoryunit->bp_status == NULL)

                                             <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-file-earmark-text-fill"></i>
                                            </button>



                                            @else

                                              <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-file-earmark-text-fill"></i>
                                            </button>

                                            @endif

                                    </form>

                                    </div>
                                </td>

                                
                                <td>
                                   
                                        @if (!empty($inventoryunit->bp_recieve_nama))
                                            <span style="color: green;">Collected</span>
                                        @else
                                            <span style="color: red;">N/A</span>
                                       
                                        @endif
                                    </td>

                            </tr>
                            @endforeach
                            @endif

                            
                        

                        </tbody>
                    </table>

                </div>
                </div>

</div>
</div>
      
        
        



    </section>
@endsection