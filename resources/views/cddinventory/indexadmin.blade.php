@extends('layouts.app-all')

@section('title', 'Inventory Index')

@section('content')
@php
    $queriedId = session('queried_inventory_id');
@endphp

<?php
    $pagename = "Cddinventory";
?>

<div class="pagetitle">
  <h1>Pengurusan Bahan-Bahan Kurikulum</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Pengurusan Bahan-Bahan Kurikulum</li>  
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

    <!-- Redirect to PPK creation page -->
    <a href="{{ route('admin.ppk.index') }}" class="btn btn-primary ms-2">
    List PPKs
</a>

@if (Auth::check())
            @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_CDDINVENTORY') )
            <a href="{{ route('cddinventory.indexgbpg') }}" class="btn btn-secondary ms-3"><i class="bi bi-person-badge"></i>List GB</a>
            @endif
        @endif

<div class="d-flex justify-content-end mb-3">
  <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPpkModal">
      + Add PPK
  </button> -->
</div>

<!-- Add PPK Modal -->
<div class="modal fade" id="addPpkModal" tabindex="-1" aria-labelledby="addPpkModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addPpkForm" method="POST" action="{{ route('admin.ppk.store') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPpkModalLabel">Add New PPK</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="name" placeholder="Nama" class="form-control mb-2" required>
          <input type="email" name="email" placeholder="Emel" class="form-control mb-2" required>
          <input type="text" name="ic_no" placeholder="No Kad Pengenalan" class="form-control mb-2" required>
          <input type="text" name="phone" placeholder="No Tel" class="form-control mb-2">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save PPK</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

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
            <!-- Close Bordered Tabs -->
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
                            <th scope="col">Remarks</th> {{-- New Remarks Column --}}
                        </tr>
                    </thead>
                    <tbody>

                    @if(count($inventory) == null)
                        <tr class="text-center">
                            <td colspan="9">
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
                               <span style="color: green;">Diambil</span>
                           @else
                               <span style="color: red;">Belum Diambil</span>

                           @endif
                       </td>

                       {{-- Remarks icon button with collapse --}}
                       <td>
                           @php
                               $remarks = $inventory->remarks ?? '';
                               $hasRemarks = !empty(trim($remarks));
                           @endphp

                           <button class="btn btn-outline-info btn-sm remarks-toggle-btn" type="button" data-bs-toggle="collapse" data-bs-target="#remarks-{{ $inventory->id }}" aria-expanded="false" aria-controls="remarks-{{ $inventory->id }}" title="Show Remarks">
                               <i class="bi bi-chat-text"></i>
                               @if($hasRemarks)
                                   <span class="badge bg-info ms-1">!</span>
                               @endif
                           </button>

                           <div class="collapse mt-2" id="remarks-{{ $inventory->id }}">
                               <div class="card card-body p-2">
                                   <p class="mb-1"><strong>Remarks:</strong> {{ $remarks ?: '' }}</p>

                                   <form method="POST" action="{{ route('cddinventory.cddinventory.updateRemarks', $inventory->id) }}">
                                       @csrf
                                       @method('PUT')
                                       <textarea name="remarks" rows="3" class="form-control" placeholder="Add or edit remarks...">{{ $remarks }}</textarea>
                                       <button type="submit" class="btn btn-sm btn-primary mt-1">Save</button>
                                   </form>
                               </div>
                           </div>
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
                        <th scope="col">Remarks</th> {{-- New Remarks Column --}}
                    </tr>
                </thead>
                <tbody>

                @if(count($inventoryunit) == null)
                    <tr class="text-center">
                        <td colspan="9">
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
                            $bbkRecordsunit = $inventorybbkunit[$inventoryunit->id] ?? [];
                            $filledCountunit = collect($bbkRecordsunit)->whereNotNull('cdd_status')->count();
                            $totalCountunit = count($bbkRecordsunit);
                            $percentageFilled = $totalCountunit > 0 ? ($filledCountunit / $totalCountunit) * 100 : 0;
                        @endphp

                        <td>
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

                            <!-- Query Button -->
                            <button type="button" class="btn btn-outline-secondary query-btn" 
                                    data-id="{{ $inventoryunit->id }}" 
                                    data-bs-toggle="modal" data-bs-target="#queryModal" 
                                    title="Query">
                                @if ($inventoryunit->has_query)
                                    <i id="queryIcon-{{ $inventoryunit->id }}" class="bi bi-arrow-repeat" style="color: #0dfd0dff;"></i>
                                @else
                                    <i id="queryIcon-{{ $inventoryunit->id }}" class="bi bi-arrow-repeat" style="color: #0d6efd;"></i>
                                @endif
                            </button>

                        </div>
                       </td>

                        <td>
                            <div class="btn-group gap-2" role="group" aria-label="Basic example">
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
                                <span style="color: green;">Diambil</span>
                            @else
                                <span style="color: red;">Belum Diambil</span>
                            @endif
                        </td>

                        {{-- Remarks icon button with collapse --}}
                        <td>
                            @php
                                $remarks = $inventoryunit->remarks ?? '';
                                $hasRemarks = !empty(trim($remarks));
                            @endphp

                            <button class="btn btn-outline-info btn-sm remarks-toggle-btn" type="button" data-bs-toggle="collapse" data-bs-target="#remarks-unit-{{ $inventoryunit->id }}" aria-expanded="false" aria-controls="remarks-unit-{{ $inventoryunit->id }}" title="Show Remarks">
                                <i class="bi bi-chat-text"></i>
                                @if($hasRemarks)
                                    <span class="badge bg-info ms-1">!</span>
                                @endif
                            </button>

                            <div class="collapse mt-2" id="remarks-unit-{{ $inventoryunit->id }}">
                                <div class="card card-body p-2">
                                    <p class="mb-1"><strong>Remarks:</strong> {{ $remarks ?: 'No remarks yet.' }}</p>

                                    <form method="POST" action="{{ route('cddinventory.cddinventory.updateRemarksUnit', $inventoryunit->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <textarea name="remarks" rows="3" class="form-control" placeholder="Add or edit remarks...">{{ $remarks }}</textarea>
                                        <button type="submit" class="btn btn-sm btn-primary mt-1">Save</button>
                                    </form>
                                </div>
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

      document.querySelectorAll('.query-btn').forEach(button => {
          button.addEventListener('click', function () {
              const inventoryId = this.getAttribute('data-id');
              inventoryIdInput.value = inventoryId;
              messageBox.value = '';
          });
      });

      queryForm.addEventListener('submit', function () {
          const inventoryId = inventoryIdInput.value;
          const icon = document.getElementById('queryIcon-' + inventoryId);

          if (icon) {
              icon.class
              icon.classList.add('spin');

              setTimeout(() => {
                  icon.classList.remove('spin');
                  icon.style.color = '#0dfd0dff'; // Green
              }, 2000);
          }
      });
  });
</script>

@endsection
