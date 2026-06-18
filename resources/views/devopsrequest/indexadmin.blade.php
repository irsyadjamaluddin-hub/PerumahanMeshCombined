@extends('layouts.app-all')

@section('title', 'Devops Request')

@section('content')

  <?php 
    $pagename = "DevopsRequest";
  ?>

    <div class="pagetitle">
      <h1>Devops Requests</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">DRF</li>  
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


    <!-- ACT Table -->
     <div class="row mb-2">
            <div class="col-md-10">
            </div>
            <div class="col-md-2" style="text-align:center;">
                <a href="{{ route('devops-request.addrequest') }}" target="_blank" class= "btn btn-primary">
                    <i class="bi bi-link"></i>
                </a>
                <a href="{{ route('devops-request.admin-emails') }}" class="btn btn-primary">
                  <i class="ri-user-add-fill"></i>
              </a>
            </div>
        </div>

    <!-- ACT Table -->
    <div class="col-12">
      <div class="card recent-sales">
        <div class="card-body overflow-auto">

            <table class="table table-borderless datatable mt-3">
              <thead>
                <tr>
                  <th scope="col">Nama Projek</th>
                  <th scope="col">Huraian</th>
                  <th scope="col">Status</th>
                  <th scope="col">Tarikh Diperlukan</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
  
              @if(count($devopsRequests) == 0)

                <tr class="text-center">
                    <td colspan="8">
                        <h5 style="margin-top: 30px;">No records found</h5>
                    </td>
                </tr>

              @else

              {{-- USE borangs/indexadmin AS REF --}}
              @foreach($devopsRequests as $devopsRequest)
              <tr>
                <td>{{ $devopsRequest['nama_projek'] }}</td>
                <td>{{ $devopsRequest['huraian'] }}</td>
                <td>{{ $devopsRequest['status'] }}</td>
                <td>{{ $devopsRequest['tarikh_diperlukan'] }}</td>
                <td>

                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                <!----show Button----->
                <form method="get" action="{{ route('devops-request.editadmin', $devopsRequest['id']) }}">
                    @csrf

                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-pencil-fill"></i>
                    </button>

                </form>
              
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