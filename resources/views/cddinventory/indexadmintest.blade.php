@extends('layouts.app-all')

@section('title', 'Inventory Index')

@section('content')
@php
    $queriedId = session('queried_inventory_id');
@endphp

<!-- //index admin with 5/5 working -->

<?php
    $pagename = "Cddinventory";
  ?>

    <div class="pagetitle">
      <h1>Curriculum Materials</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
  
          <li class="breadcrumb-item active">Curriculum Materials</li>  
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
                                    <th scope="col">Borang Pengeluaran JPK</th>
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
<!-- Query Button (Updated) -->
<button type="button" class="btn btn-outline-secondary query-btn" 
        data-id="{{ $inventory->id }}" 
        data-bs-toggle="modal" data-bs-target="#queryModal" 
        title="Query">
    @if ($inventory->has_query)
        <i id="queryIcon-{{ $inventory->id }}" class="bi bi-arrow-repeat" style="color: #0dfd0dff;"></i>  {{-- green --}}
    @else
        <i id="queryIcon-{{ $inventory->id }}" class="bi bi-arrow-repeat" style="color: #0d6efd;"></i>  {{-- blue --}}
    @endif
</button>




    </div>
</td>


                                    <td>
    @php
        $submitted = $inventory->submitted_forms ?? 0;
        $total = $inventory->total_forms ?? 0;
    @endphp

    {{-- Borang Pengeluaran button with conditional icon --}}
    <div class="btn-group gap-2 mb-1" role="group" aria-label="Basic example">
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

    {{-- Status badge below the icon --}}
    @if ($inventory->kgp_status != null)
        @if ($submitted == 0 && $total > 0)
            <span class="badge bg-primary">Received application</span>
        @elseif ($submitted > 0 && $submitted < $total)
            <span class="badge bg-warning">In progress ({{ $submitted }}/{{ $total }})</span>
        @elseif ($submitted == $total && $total > 0)
            <span class="badge bg-success">Completed ({{ $submitted }}/{{ $total }})</span>
        @endif
    @endif
</td>


                                    <td>
                                   
                                   @if (!empty($inventory->bp_recieve_nama))
                                       <span style="color: green;">Diambil</span>
                                   @else
                                       <span style="color: red;">Belum Diambil</span>
                                  
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

                                <th scope="col">Nama Unit</th>
                                <th scope="col">Tarikh</th>
                                <th scope="col">Tindakan Status</th>
                                <th scope="col">Action</th>
                                <th scope="col">Borang Pengeluaran JPK</th>
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

        <!-- --Query Button (New)--- -->
        <button type="button" class="btn btn-outline-secondary query-btn" 
                data-id="{{ $inventoryunit->id }}" 
                data-bs-toggle="modal" data-bs-target="#queryModal" 
                title="Query">
            @if ($inventoryunit->has_query)
                <i id="queryIcon-{{ $inventoryunit->id }}" class="bi bi-arrow-repeat" style="color: #0dfd0dff;"></i>  {{-- green --}}
            @else
                <i id="queryIcon-{{ $inventoryunit->id }}" class="bi bi-arrow-repeat" style="color: #0d6efd;"></i>  {{-- blue --}}
            @endif
        </button>

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
  <div class="mt-1">
      @if($total > 0)
          @if($submitted == 0)
              <span class="badge bg-primary">Received application</span>
          @elseif($submitted > 0 && $submitted < $total)
              <span class="badge bg-warning">In progress ({{ $submitted }}/{{ $total }})</span>
          @elseif($submitted == $total)
              <span class="badge bg-success">Completed ({{ $submitted }}/{{ $total }})</span>
          @endif
      @else
          <span class="badge bg-secondary">No forms</span>
      @endif
  </div>
</td>

  @php
      $submitted = $inventoryunit->submitted_forms ?? 0;
      $total = $inventoryunit->total_forms ?? 0;
  @endphp

  @if($inventoryunit->kgp_status == NULL)
      {{-- Do not show anything --}}
  @elseif($submitted == 0)
      <span class="badge bg-primary">Received application</span>
  @elseif($submitted > 0 && $submitted < $total)
      <span class="badge bg-warning">In progress ({{ $submitted }}/{{ $total }})</span>
  @elseif($submitted == $total && $total > 0)
      <span class="badge bg-success">Completed ({{ $submitted }}/{{ $total }})</span>
  @endif
</td>


                                
                                <td>
                                   
                                        @if (!empty($inventoryunit->bp_recieve_nama))
                                            <span style="color: green;">Diambil</span>
                                        @else
                                            <span style="color: red;">Belum Diambil</span>
                                       
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
    <!-- Query Message Modal -->
<div class="modal fade" id="queryModal" tabindex="-1" aria-labelledby="queryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="queryForm" method="POST" action="{{ route('cddinventory.cddinventory.submitQuery') }}">

      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="queryModalLabel">Message Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for="queryMessage" class="form-label">Message</label>
          <textarea id="queryMessage" name="message" class="form-control" rows="3" required></textarea>
          <input type="hidden" id="inventoryId" name="inventory_id" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const queryModal = document.getElementById('queryModal');
        const inventoryIdInput = document.getElementById('inventoryId');
        const messageBox = document.getElementById('queryMessage');

        document.querySelectorAll('.query-btn').forEach(button => {
            button.addEventListener('click', function() {
                const inventoryId = this.getAttribute('data-id');
                inventoryIdInput.value = inventoryId;
                messageBox.value = ''; // clear previous message if any
            });
        });
    });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const inventoryIdInput = document.getElementById('inventoryId');
      const messageBox = document.getElementById('queryMessage');
      const queryForm = document.getElementById('queryForm');

      // When "Query" button is clicked, set inventory ID
      document.querySelectorAll('.query-btn').forEach(button => {
          button.addEventListener('click', function () {
              const inventoryId = this.getAttribute('data-id');
              inventoryIdInput.value = inventoryId;
              messageBox.value = ''; // clear old message
          });
      });

      // When form is submitted
      queryForm.addEventListener('submit', function () {
          const inventoryId = inventoryIdInput.value;
          const icon = document.getElementById('queryIcon-' + inventoryId);

          if (icon) {
              // Start spinning
              icon.classList.add('spin');

              // After 2 seconds, stop spinning and make green
              setTimeout(() => {
                  icon.classList.remove('spin');
                  icon.style.color = '#0dfd0dff'; // Green
              }, 2000); // Adjust if needed
          }
      });
  });
</script>

@endsection