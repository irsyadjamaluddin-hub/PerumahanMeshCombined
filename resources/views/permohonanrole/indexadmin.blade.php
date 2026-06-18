@extends('layouts.app-all')

@section('title', 'Permohonan Peranan')

@section('content')

  <?php 
    $pagename = "Permohonan Peranan";
  ?>

<!-- require 'export/export.php'; -->

    <div class="pagetitle">
      <h1>Permohonan Peranan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Permohonan Peranan</li>  
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
                <a href="https://mesh.moe.gov.bn/borangpermohonanperanan"  target="_blank" class= "btn btn-primary">
                    <i class="bi bi-link"></i>
                </a>
                <a href="/assets/img/qrcode/permohonanperanan.jpg"  target="_blank" class= "btn btn-primary text-right">
                    <i class="bi bi-qr-code"></i>
                </a>
            </div>
        </div>
    <div class="col-12">
      <div class="card recent-sales">
        <div class="card-body overflow-auto">

  
<br>
            <table class="table table-borderless datatable mt-3">
              <thead>
                <tr>
                  <th scope="col">Nama</th>
                  <th scope="col">Jabatan</th>
                  <th scope="col">IC No.</th>
                  <th scope="col">Peranan</th>
                  <th scope="col">Catatan</th>
                  <th scope="col">Tarikh</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>

                </tr>
              </thead>
              <tbody>
  
              @if(count($permohonanroles) == 0)

                <tr class="text-center">
                    <td colspan="8">
                        <h5>No records found</h5>
                    </td>
                </tr>

              @else

              @foreach($permohonanroles as $permohonanrole)
              <tr>
                <td>{{ $permohonanrole->nama }}</td>
                <td>{{ $permohonanrole->jabatan }}</td>
                <td>{{ $permohonanrole->icno }}</td>
                <td>{{ $permohonanrole->peranan }}</td>
                <td>{{ $permohonanrole->catatan}}</td>
                <td>{{ $permohonanrole->created_at }}</td>

                @if ($permohonanrole->status == null)
                <td><a href="{{ route('permohonanrole.permohonanrole.approve', $permohonanrole->id) }}" onclick="return confirm('Are you sure you want to proceed approval?')" class="btn btn-success">Approve</a>
                <a href="{{ route('permohonanrole.permohonanrole.reject', $permohonanrole->id) }}" onclick="return confirm('Are you sure you want to reject?')" class="btn btn-danger">Reject</a></td>

                @else
                <td>{{ $permohonanrole->status}}</td>
                @endif

                <td>

                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                <!----edit Button----->
                <form method="get" action="{{ route('permohonanrole.permohonanrole.editadmin' , $permohonanrole->id) }}">
                    @csrf

                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-pencil-fill"></i>
                    </button>

                </form>

                <!----Delete Button----->
                <form method="post" onclick="return confirm('Are you sure?')" action="{{ route('permohonanrole.permohonanrole.destroy', $permohonanrole->id ) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-outline-danger" >
                        <i class="bi bi-trash-fill"></i>
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
    <div class="col-12">

<div class="card recent-sales">

  <div class="card-body">

    <div class="profile-overview pt-3">
        <h5 class="card-title">Peranan</h5>
        <form class="" method="post" action="{{ route('permohonanrole.permohonanrole.storeperanan') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <!-- peranan input -->
                <label class="col-lg-1 col-form-label">Peranan:</label>
                <div class="col-lg-4">
                    <input type="text" name="label" class="form-control" placeholder="Perkara">
                        {!! $errors->first('peranan', '<p class="help-block text-danger">:message</p>')!!}
                </div>

                <!-- Description input -->
                <label class="col-lg-1 col-form-label">Desc:</label>
                <div class="col-lg-4">
                    <input type="text" name="desc" class="form-control" placeholder="Description">
                        {!! $errors->first('description', '<p class="help-block text-danger">:message</p>')!!}
                </div>

                <!-- update Button -->
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-outline-success" >
                       Update
                    </button>
                </div>
            </div>
        </form>

        <div class="card-body overflow-auto">


                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Peranan</th>
                                <th scope="col">Desc</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                           
                        
                        @if(count($permohonanperanan) == null)
                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>

                        @else
                         @foreach($permohonanperanan as $permohonanperanan)   

                            <tr>
                                
                                <td>{{ $permohonanperanan->label }}</td>
                                <td>{{ $permohonanperanan->desc }}</td>

                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example"> 
                                        <!----Delete Button----->
                                        <form method="post" onclick="return confirm('Are you sure?')" action="{{ route('permohonanrole.permohonanrole.destroyperanan', $permohonanperanan->id ) }}">
                                            @csrf
                                            @method('delete')
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

  </div>

  </div>

</section>

@endsection