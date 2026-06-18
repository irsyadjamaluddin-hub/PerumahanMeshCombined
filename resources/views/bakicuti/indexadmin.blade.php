@extends('layouts.app-all')

@section('title', 'Baki Cuti Admin Index')

@section('content')

<?php
    $pagename = "Baki Cuti Admin";
  ?>

    <div class="pagetitle">
      <h1>Baki Cuti Admin</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Baki Cuti Admin</li>  
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

        <div class="card mt-3">
            <div class="card-body pt-3"> 
                
                <!-- Bordered Tabs -->

                <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                        <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#submitted-tab">Permohonan</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#selesai-in">Selesai</button>
                    </li>
                </ul>

                <br>
                    <!-- Clsoe Bordered Tabs -->
                <div class ="tab-content pt-2">

                    <!-- first tab -->

                    <div class="tab-pane fade show active submitted-tab" id="submitted-tab">
                        
                        <div class="card-body overflow-auto">
                        
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">No. Kad Pengenalan</th>
                                        <th scope="col">Jabatan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Di Buat Pada</th>
                                    </tr>
                                </thead>
                                <tbody>            
                                    @if(count($bc) == null)
                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>

                                    @else
                                    @foreach($bc as $bcs)   

                                        <tr>
                                            <td>{{ $bcs->name }}</td>
                                            <td>{{ $bcs->ic_no }}</td>
                                            <td>{{ $bcs->department }}</td>
                                            <td>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#statuschange{{ $bcs->id }}" class="btn btn-primary">
                                                    <span class="badge bg-primary">{{$bcs->status}}</span>
                                                </button>

                                                <!-- Basic Modal -->
                                                <div class="modal fade" id="statuschange{{ $bcs->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body" style="min-height: auto;">
                                                                <form class="" id="storebooksubject" method="post" action="{{ route('bakicuti.bakicutis.updateadmin') }}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="text" name="id" value="{{ $bcs->id }}" class="form-control" hidden>
                                                                    <div class="row mb-3" style="margin-left: 0px; align-items: center;">
                                                                        <label class="col-lg-1 col-form-label" style="width: 10rem;">File No:</label>
                                                                        <div class="col-lg-6">
                                                                            {{$bcs->file_no}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3" style="margin-left: 0px; align-items: center;">
                                                                        <label class="col-lg-1 col-form-label" style="width: 10rem;">Tarikh Baki Cuti:</label>
                                                                        <div class="col-lg-6">
                                                                            <input type="date" name="tarikh_baki_cuti" class="form-control" required>
                                                                                {!! $errors->first('tarikh_baki_cuti', '<p class="help-block text-danger">:message</p>')!!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3" style="margin-left: 0px; align-items: center;">
                                                                        <label class="col-lg-1 col-form-label" style="width: 10rem;">Baki Cuti:</label>
                                                                        <div class="col-lg-6">
                                                                            <input type="text" name="baki_cuti" class="form-control" required>
                                                                                {!! $errors->first('baki_cuti', '<p class="help-block text-danger">:message</p>')!!}
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="row mb-3" style="">
                                                                        <div class="col-lg-12" style="text-align:center;">
                                                                            <button id="submit-button" type="submit" class="btn btn-primary">Update</button>
                                                                        </div>
                                                                        <script>
                                                                            var submitButton = document.getElementById('submit-button');
                                                                            var form = document.getElementById('storebooksubject');
                                                                        
                                                                            form.addEventListener('submit', function(event) {
                                                                                if (submitButton.getAttribute('data-submitted') !== null) {
                                                                                    event.preventDefault();
                                                                                } else {
                                                                                    submitButton.disabled = true;
                                                                                    submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                                                                                    submitButton.setAttribute('data-submitted', 'true');
                                                                                }
                                                                            });
                                                                        </script>

                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $bcs->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end 1st tab -->
                    <div class="tab-pane fade selesai-in pt-2" id="selesai-in">

                        <div class="card-body overflow-auto">
                        
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">No. Kad Pengenalan</th>
                                        <th scope="col">Jabatan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Di Buat Pada</th>
                                        <th scope="col">Di Kemaskini Pada</th>
                                    </tr>
                                </thead>
                                <tbody>            
                                    @if(count($bcsel) == null)
                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>

                                    @else
                                    @foreach($bcsel as $bcsels)   

                                        <tr>
                                            <td>{{ $bcsels->name }}</td>
                                            <td>{{ $bcsels->ic_no }}</td>
                                            <td>{{ $bcsels->department }}</td>
                                            <td>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#statuschange{{ $bcsels->id }}" class="btn btn-success">
                                                    <span class="badge bg-success">{{$bcsels->status}}</span>
                                                </button>

                                                <!-- Basic Modal -->
                                                <div class="modal fade" id="statuschange{{ $bcsels->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body" style="min-height: auto;">
                                                                <form class="" id="storebooksubject" method="post" action="{{ route('bakicuti.bakicutis.updateadmin') }}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="text" name="id" value="{{ $bcsels->id }}" class="form-control" hidden>
                                                                    <div class="row mb-3" style="margin-left: 0px; align-items: center;">
                                                                        <label class="col-lg-1 col-form-label" style="width: 10rem;">File No:</label>
                                                                        <div class="col-lg-6">
                                                                            {{$bcsels->file_no}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3" style="margin-left: 0px; align-items: center;">
                                                                        <label class="col-lg-1 col-form-label" style="width: 10rem;">Tarikh Baki Cuti:</label>
                                                                        <div class="col-lg-6">
                                                                            {{ $bcsels->tarikh_baki_cuti }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3" style="margin-left: 0px; align-items: center;">
                                                                        <label class="col-lg-1 col-form-label" style="width: 10rem;">Baki Cuti:</label>
                                                                        <div class="col-lg-6">
                                                                            {{ $bcsels->baki_cuti }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3" style="margin-left: 0px; align-items: center;">
                                                                        <label class="col-lg-1 col-form-label" style="width: 10rem;">Di Buat Oleh:</label>
                                                                        <div class="col-lg-6">
                                                                            <b>{{ $bcsels->done_by }}</b>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $bcsels->created_at }}</td>
                                            <td>{{ $bcsels->updated_at }}</td>
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