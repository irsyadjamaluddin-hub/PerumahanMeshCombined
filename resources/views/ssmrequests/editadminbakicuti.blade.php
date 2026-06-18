@extends('layouts.app-all')

@section('title', 'Admin Edit SSM Request')

@section('content')

<?php
$pagename = "Admin_Edit_SSMRequest";
?>

<div class="pagetitle">
    <h1>Edit SSM Request</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">User</li>
            <li class="breadcrumb-item active">Edit SSM Request</li>
        </ol>
    </nav>
</div>

<section class="section profile">

<div class="col-12">
        <div class="card recent-sales">
            <div class="card-body">
            <!-- <h3 class="card-title">Mengaktifkan Akaun SSM<br> <i>SSM Activation</i></h3> -->
    <div class="profile-overview">
        <h3 class="card-title"></h3>

        @foreach($ssmbakicuti as $ssmbakicuti)

        <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.updateadminbakicuti') }}"  id="myDropzone"   class="dropzone"  enctype="multipart/form-data">
            @csrf

            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Baki Cuti Form</h5>


            <input type="text" name="id" class="form-control" value="{{$ssmbakicuti->id}}" hidden>

            
                <div class="row mb-3">
                    <div class="col-sm-4 label">Nombor Rujukan:</div>
                    <div class="col-sm-8">
                        <input type="text" name="id" value="BC{{$ssmbakicuti->id}}" class="form-control" disabled>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <div class="col-sm-4 label">Nama</div>
                    <div class="col-sm-8">
                        <input type="text" name="bc_name" value="{{$ssmbakicuti->bc_name}}" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label  class="col-sm-4 label">IC No.</label>
                    <div class="col-sm-8">
                        <input type="text" name="bc_icno" value="{{$ssmbakicuti->bc_icno}}" class="form-control">
                    </div>
                </div>


                <div class="row mb-3">
                        <label for="inputText" class="col-sm-4 col-form-label">Jawatan</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="bc_jawatan" aria-label="Default select example" id="myselectjawatan">
                                <option selected hidden>Pilih Jawatan</option>
                                @foreach ($jawatanlist as $key => $value)
                                    <option value="{{ $value }}" {{ $ssmbakicuti->bc_jawatan == $value ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                <div class="row mb-3">
                    <div class="col-sm-4 label">Nombor Tel</div>
                    <div class="col-sm-8">
                        <input type="text" name="bc_notel" value="{{$ssmbakicuti->bc_notel}}" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label  class="col-sm-4 label">Tempat Bertugas Sekarang</label>
                    <div class="col-lg-8">
                        <textarea type="hurai" name="bc_workplace" value="{{$ssmbakicuti->bc_workplace}}"  class="form-control">{{$ssmbakicuti->bc_workplace}}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label  class="col-sm-4 label">Tarikh Lantikan Sekarang</label>
                    <div class="col-sm-8">
                        <input type="date" name="bc_date" value="{{$ssmbakicuti->bc_date}}"  class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label  class="col-sm-4 label">Baki Cuti SSM</label>
                    <div class="col-sm-8">
                        <input type="text" name="bc_days" value="{{$ssmbakicuti->bc_days}}"  class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label  class="col-sm-4 label">Baki Cuti JPP</label>
                    <div class="col-sm-8">
                        <input type="text" name="bc_daysjpp" value="{{$ssmbakicuti->bc_daysjpp}}"  class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label  class="col-sm-4 label">Catatan </label>
                    <div class="col-lg-8">
                        <textarea type="hurai" name="bc_catatanuser" value="{{$ssmbakicuti->bc_catatanuser}}"  class="form-control">{{$ssmbakicuti->bc_catatanuser}}</textarea>
                    </div>
                </div>

                <style>
                                #file-dropzone {
                                    border: 3px dashed #ccc;
                                    border-radius: 4px;
                                    padding: 10px;
                                    text-align: center;
                                    cursor: pointer;
                                    margin-bottom: 10px;
                                }
               </style>

                <div id="file-input-container">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-4 label">Muat Naik Dokumen</label>
                        <div class="col-sm-4">
                            <div id="file-input-container">
                            <div class="col-sm-12" id="file-dropzone" class="dropzone">
                                 <span>Drag and drop files here or click to browse</span>
                                  <input name="bc_file[]" type="file" multiple />
                              </div>
                            </div>
                            <br>
                            @if(isset($ssmbakicuti) && isset($ssmbakicuti->bc_file) && is_array($ssmbakicuti->bc_file) && count($ssmbakicuti->bc_file) > 0)
                                <div class="d-flex flex-wrap">
                                    @foreach ($ssmbakicuti->bc_file as $index => $file)
                                        <div class="file-container mb-2 me-2 d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <a href="{{ asset('storage/ssmbakicuti/' . $file) }}" target="_blank">
                                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ $file }}">
                                                        <i class="bi bi-collection"></i>
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="checkbox-container ms-4"> <!-- Added margin start (ms-2) -->
                                                <input type="checkbox" name="remove_file[]" value="{{ $index }}" id="removeFile{{ $index }}" class="form-check-input">
                                                <label class="form-check-label" for="removeFile{{ $index }}">Remove File {{ $index + 1 }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


           



<!-- <script>
// Activate Bootstrap tooltips
$(function () {
$('[data-bs-toggle="tooltip"]').tooltip()
})
</script> -->

     






                
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Admin</h5>

      
            <div class="row mb-3">
                    <label  class="col-sm-4 label">Catatan Admin </label>
                    <div class="col-lg-8">
                        <textarea type="hurai" name="bc_catatanadmin" value="{{$ssmbakicuti->bc_catatanadmin}}"  class="form-control">{{$ssmbakicuti->bc_catatanadmin}}</textarea>
                    </div>
                </div>

                <!-- start status -->
              <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col-form-label">Status:</label>
              <div class="col-sm-6">
                 <select name="bc_status" class="form-control" >
              <option value=""></option>

              <option value="Dihadapkan ke HD" {{ $ssmbakicuti->bc_status == 'Dihadapkan ke HD' ? 'selected' : '' }}>Dihadapkan ke HD</option>
              <option value="Selesai" {{ $ssmbakicuti->bc_status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
          </select>

                
                {!! $errors->first('status', '<p class="help-block text-danger">:message</p>') !!}
              </div>
              <div class="col-sm-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusInfoModal">Info</button>
              </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="statusInfoModal" tabindex="-1" role="dialog" aria-labelledby="statusInfoModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="statusInfoModalLabel">Status Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Status</th>
                          <th>Updated At</th>
                          <th>By</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- You can populate this table with data dynamically based on your needs -->
                        <tr>
                          <td>Dihadapkan ke HD</td>
                          <td>{{$ssmbakicuti->bc_hd_at}}</td>
                          <td> {{$ssmbakicuti->bc_hd_by}}</td>
                        </tr>

                   

                        <tr>
                          <td>Selesai</td>
                          <td>{{$ssmbakicuti->bc_selesai_at}}</td>
                          <td>{{$ssmbakicuti->bc_selesai_by}}</td>
                        </tr>
                        <!-- Add more rows as needed -->
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

</div>
</div>
</div>
</section>

                
              

               





                <br>
                <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
    
 
        </form>
        @endforeach
        </div>

</div>
</div>
</div>


</section>
@endsection




<!-- Include Dropzone.css in the head of your layout file -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">

<!-- Include Dropzone.js at the bottom of your layout file, after jQuery or any other dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>



<script>
     Dropzone.options.fileDropzone  = {
        paramName: "bc_file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        init: function () {
            this.on("success", function (file, response) {
                // Handle the success response, if needed
                console.log(response);
            });

            this.on("removedfile", function (file) {
                // Handle the file removal, if needed
                console.log(file);
            });
        },
    };
</script>

                  