@extends('layouts.app-all')

@section('title', 'SSM Jenis Permohonan')

@section('content')

<?php
$pagename = "SSMSRequest";
?>

<div class="pagetitle">
  <h1>SSM Permohonan</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item"><a href="{{ route('ssmrequests.ssmrequest.indexpermohonan') }}">SSM Request Permohonan</a></li>
      <li class="breadcrumb-item active">Jenis Permohonan</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<!----- Back out Button  ----->
<div class="col-md-1 text-left">
  <a href="{{ route('ssmrequests.ssmrequest.indexpermohonan') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 7px;">
  <i class="bi bi-arrow-left-circle"></i>
  </a>
</div> 

<section class="section profile">

  <!-- jenis Permohonan Table -->
  <div class="col-12">
      <div class="card recent-sales">
          <div class="card-body">
              <div class="profile-overview pt-3">
                  <h5 class="card-title">Jenis Permohonan Baru</h5>
                  <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.storejenispermohonan') }}" enctype="multipart/form-data">
                      @csrf
                      <div class="row mb-3" style="margin-left: 0px;">
                          <label class="col-lg-1 col-form-label" style="width: 10rem;">Jenis Permohonan:</label>
                          <div class="col-lg-6">
                              <input type="text" name="label" class="form-control" placeholder="Nama Permohonan">
                                  {!! $errors->first('nama', '<p class="help-block text-danger">:message</p>')!!}
                          </div>
                          <div class="col-lg-3">
                              <button type="submit" class="btn btn-outline-success" >
                              Add
                              </button>
                          </div>
                      </div>
                  </form>

                  <div class="card-body overflow-auto">
                      <table class="table table-borderless datatable mt-3">
                          <thead>
                              <tr>
                                  <th scope="col">Jenis Permohonan</th>
                                  <th scope="col">Created At</th>
                                  <th scope="col">Action</th>
                              </tr>
                          </thead>
                          <tbody>                         
                          @if(count($jenispermohonans) == null)
                              <tr class="text-center">
                                  <td colspan="8">
                                      <h5>No records found</h5>
                                  </td>
                              </tr>
                          @else
                              @foreach($jenispermohonans as $jenispermohonan)   
                              <tr>       
                                  <td>{{ $jenispermohonan->label }}</td>
                                  <td>{{ $jenispermohonan->created_at }}</td>
                                  <td>
                                      <div class="btn-group gap-2" role="group" aria-label="Basic example"> 
                                          <!----Edit Button----->
                                          <form method="get" action="{{ route('ssmrequests.ssmrequest.editjenispermohonan', $jenispermohonan->id ) }}">
                                              @csrf
                                              <button type="submit" class="btn btn-outline-primary">
                                              <i class="bi bi-pencil-fill"></i>
                                              </button>
                                          </form>
                                          <!----Delete Button----->
                                          <form method="post" onclick="return confirm('Are you sure?')" action="{{ route('ssmrequests.ssmrequest.destroyjenispermohonan', $jenispermohonan->id ) }}">
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
  </div>
  <!-- End Jenis Permohonan Table -->

</section>
@endsection

