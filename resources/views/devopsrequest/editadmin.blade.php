@extends('layouts.app-all')

@section('title', 'Admin Show DRF')

@section('content')

<?php
$pagename = "DRF";
?>

<div class="pagetitle">
    <h1>DevOps Request</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Borang</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <a href="{{ route('devops-request.indexadmin') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-12">
        <div class="card recent-sales">
            <div class="card-body">

                <div class="profile-overview pt-3">

                    <div class="col profile-overview" style="padding-top: 18px; padding-left: 18px; padding-right: 18px;">

                    <h4>DevOps Request Form</h4>
                    <hr>

                        <div class="row">
                            <div class="col-lg-4 label">Jabatan:</div>
                            <div class="col-lg-8">{{ ($devopsRequest->jabatan) }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Bahagian/Unit:</div>
                            <div class="col-lg-8">{{ ($devopsRequest->bahagian_unit) }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Nama Projek:</div>
                            <div class="col-lg-8">{{ ($devopsRequest->nama_projek) }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Jawatan:</div>
                            <div class="col-lg-8">{{ ($devopsRequest->jawatan) }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Jenis Perkhidmatan:</div>
                            <div class="col-lg-8">{{ ($devopsRequest->perkhidmatan) }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Huraian:</div>
                            <div class="col-lg-8">{{ ($devopsRequest->huraian) }}</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-4 label">Tarikh Diperlukan:</div>
                            <div class="col-lg-8">{{ ($devopsRequest->tarikh_diperlukan) }}</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-4 label">Muat Naik Dokumen:</div>
                            <div class="col-lg-8">
                                @if (count($devopsRequest->drfdocuments) == 0)
                                    <p>No Document Available</p>
                                @else
                                    <ul style="list-style-type:disc;">
                                        @foreach ($devopsRequest->drfdocuments as $drfDoc)
                                            <li>
                                                <p style="color: blue; text-decoration: underline;">
                                                    <a href="{{ route('devops-request.uploadedfile-download', $drfDoc->id) }}">
                                                        Download {{ $drfDoc['doc_name'] }}
                                                    </a>
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    
                                    
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Penyelaras Projek:</div>
                            <div class="col-lg-8">{{ ($devopsRequest->penyelaras_projek) }}</div>
                        </div>

                        <div class="row">                        
                            <div class="col-lg-4 label">Emel:</div>
                            <div class="col-lg-8">{{ ($devopsRequest->emel) }}</div>
                        </div>

                        <div class="row">                        
                            <div class="col-lg-4 label">Telefon No:</div>
                            <div class="col-lg-8">{{ ($devopsRequest->tel_no) }}</div>
                        </div>

                        <div class="row">                        
                            <div class="col-lg-4 label">Remarks:</div>
                            
                            <div class="col-12">
                        <table class="table table-bordered mt-3">
                                <thead>
                                  <tr>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Timestamp</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                    
                                @if(count($drfRemarks) == 0)
                  
                                  <tr class="text-center">
                                      <td colspan="8">
                                          <h5 style="margin-top: 30px;">No records found</h5>
                                      </td>
                                  </tr>
                  
                                @else
                  
                                {{-- USE borangs/indexadmin AS REF --}}
                                @foreach($drfRemarks as $drfRemark)
                                <tr>
                                  <td>{{ $drfRemark['remark'] }}</td>
                                  <td>{{ $drfRemark['created_at'] }}</td>
                                  <td>
                  
                                  <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                  <!----Delete Button----->
                                  <form method="post" action="{{ route('devops-request.delete-remark', $drfRemark['id']) }}">
                                      @csrf
                  
                                      <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Delete remark?')">
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
                          
                    </div>

                    <br><hr><br>

                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            <i class=" fas fa-fw fa-check"></i>
                            {!! session('success') !!}
                        </div>
                    @endif
                    
                    
                    
                    <br>
                    
                    <form action="{{ route('devops-request.updateadmin', $devopsRequest['id']) }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-lg-4 label">Status:</div>
                            <div class="col-sm-8">
                                <select class="form-select" name="status" aria-label="Default select example" required>
                                  <option hidden {{ $devopsRequest['status'] == null ? 'selected' : '' }}>Pilih Status</option>
                                  @foreach ($statuses as $status)
                                      <option value="{{ $status }}" {{ $devopsRequest['status'] == $status ? 'selected' : '' }}>{{ $status }}</option>
                                  @endforeach
                                </select>
                                
                                {!! $errors->first('perkhidmatan', '<p class="help-block text-danger">:message</p>')!!}
                              </div>
                        </div>
                        
                        <button type="button" id="add-remark" class="btn btn-primary">Add Remark</button>
                        
                        <div id="remarks-container">
                            <div class="remark-form">
                                
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const container = document.getElementById('remarks-container');
                                const addButton = document.getElementById('add-remark');
                                let remarkCount = 1;

                                addButton.addEventListener('click', function() {
                                    const newRemark = document.createElement('div');
                                    newRemark.className = 'remark-form';
                                    newRemark.innerHTML = `
                                    <br>
                                <div class="row mb-3">
                                    <label for="huraian" class="col-sm-4 col-form-label">Remark ${remarkCount}:</label>
                                    <div class="col-sm-8">
                                      <textarea name="drf_remarks[${remarkCount}][remark]" class="form-control" style="height: 100px"></textarea>
                                      <button type="button" class="btn btn-primary remove-remark mt-1">Remove</button>
                                    </div>
                                  </div>
                                    `;
                                    container.appendChild(newRemark);
                                    remarkCount++;
                                });

                                container.addEventListener('click', function(e) {
                                    if (e.target.classList.contains('remove-remark')) {
                                        if (container.querySelectorAll('.remark-form').length > 0) {
                                            e.target.closest('.remark-form').remove();
                                        }
                                    }
                                });
                            });
                        </script>
                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                          </div>
                        
                        
                    </form>
                    
                    
                </div>
            </div>
        </div>
    </div>

</section>
@endsection