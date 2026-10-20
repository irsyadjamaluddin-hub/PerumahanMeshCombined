@extends('layouts.app-all')

@section('title', 'DevOps Support Service')

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" sections; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
<div class="mesh-home-theme">
{{-- #================================ --}}

<?php 
  $pagename = "SupportCenter";
?>

<div class="pagetitle">
  <h1>DevOps Support Service</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Admin</li>
      <li class="breadcrumb-item active">DevOps Support Service</li>  
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">
  <div class="col-md-12">

    @if(Session::has('success'))
      <div class="alert alert-success">
          <i class="fas fa-fw fa-check"></i>
          {!! session('success') !!}
      </div>
    @endif

    <!-- Add Buttons -->
    <div class="row mb-2">
      <div class="col text-end d-flex justify-content-end gap-2">
        <a href="{{ route('support-center.admin-emails.index') }}" class="btn btn-outline-secondary" title="Manage Admin Emails">
          <i class="bi bi-people-fill"></i>
        </a>

        <a href="{{ route('support-center.create') }}" class="btn btn-primary" title="Create New Request">
          <i class="bi bi-plus-lg"></i>
        </a>
      </div>
    </div>

    <!-- Requests Table -->
    <div class="col-12">
      <div class="card recent-sales">
        <div class="card-body overflow-auto">

          <table class="table table-borderless datatable mt-3">
            <thead>
              <tr>
                <th scope="col">Nama</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Perkara</th>
                <th scope="col">Kepentingan</th>
                <th scope="col">Status</th>
                <th scope="col">Tarikh</th>
                <th scope="col">Tindakan</th>
              </tr>
            </thead>
            <tbody>
              @if($supportRequests->isEmpty())
                <tr class="text-center">
                  <td colspan="7">
                    <h5 style="margin-top: 30px;">Tiada rekod ditemui</h5>
                  </td>
                </tr>
              @else
                @foreach($supportRequests as $request)
                <tr>
                  <td>{{ $request->name }}</td>
                  <td>{{ $request->department }}</td>
                  <td>{{ $request->perkara }}</td>


                  <td>
                    <span class="badge bg-{{ $request->getPriorityBadgeClass() }}">
                      {{ $request->priority_label }}
                    </span>
                  </td>

                  <td>
                    <span class="badge bg-{{ $request->getStatusBadgeClass() }}">
                      {{ $request->status_label }}
                    </span>
                  </td>

                  <td>{{ \Carbon\Carbon::parse($request->created_at)->format('d-m-Y') }}</td>
                  <td>
                    <div class="btn-group gap-2" role="group">
                      <a href="{{ route('support-center.edit', $request->id) }}" class="btn btn-outline-success" title="Edit">
                        <i class="bi bi-pencil-fill"></i>
                      </a>
                    </div>
                  </td>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>

          <!-- Pagination -->
          <div class="d-flex justify-content-center mt-3">
            {{ $supportRequests->links() }}
          </div>

        </div>
      </div>
    </div><!-- End Recent Sales -->

  </div>
</section>

{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
@endsection
