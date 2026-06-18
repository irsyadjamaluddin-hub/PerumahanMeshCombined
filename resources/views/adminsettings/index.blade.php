@extends('layouts.app-all')

@section('title', 'e-Minit')

@section('content')

<?php
$pagename = "MEC";
?>

<!-- <img src="/img/mec_new.png"> -->

<style>                
.dataTable-info{
    color: white;
}
</style>

@if(Session::has('success_message'))
    <div class="alert alert-success">
      <i class=" fas fa-fw fa-check"></i>
      {!! session('success_message') !!}
    </div>
@endif
<div class="col-12 mb-2 mt-2 d-flex justify-content-end">
    <a href="{{ route('dispatchs.dis.mecuser') }}" class="btn btn-primary">
        <i class="ri-user-add-fill"></i>
    </a>
    
    <a href="{{ route('eminit.create') }}" class="btn btn-primary ms-2">
        <i class="bi bi-plus-lg"></i>
    </a>
</div>

<section class="section">
  <div class="row">



    <div class="card mt-3">
      <div class="card-body pt-3">

<!-- Bordered Tabs -->
<ul class="nav nav-tabs nav-tabs-bordered">

    <li class="nav-item">
        <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#profile-sender">OUT</button>
    </li>
</ul>
        
        <br>
<!-- Clsoe Bordered Tabs -->

    <div class="tab-content pt-2" id="profile-sender">
    <div class="overflow-auto" >   
            <table class="table table-borderless datatable mt-3" id="tablesender">
              
            <thead>
              <tr>
            
              <th scope="col">No.Rujukan</th>
            
              <th scope="col">Perkara</th>
            
              <th scope="col">Tarikh</th>
            
              <th scope="col">Status</th>
            
              <th scope="col">Tindakan</th>
            </tr>
          </thead>

        <tbody>
          @if(count($dispatchpassmecsenders) == 0)
          <tr class="text-center">
            <td colspan="8">
              <h5>No records found</h5>
            </td>
          </tr>

          @else

       

          @foreach($dispatchpassmecsenders as $dispatchpassmecsender)

          <tr>
            <td>{{$dispatchpassmecsender->no_folio}}</td>
            <td>{{$dispatchpassmecsender->perkara}}</td>
            <td>{{ date('d/m/Y', strtotime($dispatchpassmecsender->date_admin_submit)) }}</td>
            
            <!-- status condition if selesai -->
              <td>
                @php
                    $dispatch_infos_id_match = false;
                    $status_match = false;
                @endphp

                @foreach ($dispatchpassmecs as $dp)
                    @if ($dp->dispatch_infos_id == $dispatchpassmec->dispatch_infos_id)
                        @php
                            $dispatch_infos_id_match = true;
                        @endphp
                    @endif

                    @if ($dp->status == $dispatchpassmec->status)
                        @php
                            $status_match = true;
                        @endphp
                    @endif

                    @if ($dispatch_infos_id_match && $status_match)
                        @break; // Exit the loop if both conditions are met
                    @endif
                @endforeach

                @if ($dispatch_infos_id_match && $status_match)
                    <span class="badge bg-success">Selesai</span>
                @else
                    <span class="badge bg-warning">Proses</span>
                @endif
            </td>

         


            <td>
              <div class="btn-group gap-2" role="group" aria-label="Basic example">

                <!----Edit Button----->
                <form method="get" action="{{ route('eminit.editeminit', $dispatchpassmecsender->id ) }}">
                  @csrf
                  <button type="submit" class="btn btn-outline-primary">
                    <i class="bi bi-pencil-fill"></i>
                  </button>
                </form>

     <!----Delete Button----->
                <form id="deleteForm" method="post" action="{{ route('eminit.destroycorrespondence', $dispatchpassmecsender->id ) }}">
                  @csrf
                  @method('delete')
                  <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                    <i class="bi bi-trash-fill"></i>
                  </button>
                </form>

                <script>
                  function confirmDelete() {
                    if (confirm("Are you sure you want to delete?")) {
                      document.getElementById("deleteForm").submit();
                    }
                  }
                </script>


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

</div>
</section>
@endsection