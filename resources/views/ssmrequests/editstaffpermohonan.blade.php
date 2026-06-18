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

<!----- Back out Button  ----->
<div class="col-md-1 text-left">
  <a href="{{ route('ssmrequests.ssmrequest.indexstaffpermohonan') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 10px;">
  <i class="bi bi-arrow-left-circle"></i>
  </a>
</div> 

<section class="section profile">

<div class="col-12">
        <div class="card recent-sales">
            <div class="card-body">
            <!-- <h3 class="card-title">Mengaktifkan Akaun SSM<br> <i>SSM Activation</i></h3> -->
    <div class="profile-overview">
        <h3 class="card-title"></h3>

        <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.updatestaffpermohonan') }}"  id="myDropzone"   class="dropzone"  enctype="multipart/form-data">
            @csrf

        @foreach($ssmpermohonan as $ssmpermohonan)


            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Permohonan Form</h5>
                          
                <div class="row mb-3">
                    <label class="col-sm-4 label">Jenis Permohonan:</label>
                    <div class="col-lg-8">
                    <select id="jenis_permohonan" name="permohonan_type" style="width: 100%;" disabled>                           
                        <option value="" disabled selected></option>
                            @foreach ($jenispermohonans as $key => $value)
                            <option value="{{ $value }}" {{ $ssmpermohonan->permohonan_type == $value ? 'selected' : '' }}>                      
                                {{ $value }}
                            </option>
                            @endforeach
                        </select>
                        {!! $errors->first('jabatan', '<p class="help-block text-danger">:message</p>')!!}
                    </div>
                </div>
                <script>
                $('#jenis_permohonan').select2({
                    width: '100%',
                    placeholder: "Pilih Jenis Permohonan",
                    allowClear: true
                });
                </script> 
        
                <div class="row mb-3">
                    <label  class="col-sm-4 label">Tarikh Permohonan</label>
                    <div class="col-sm-8">
                        <input type="date"  value="{{$ssmpermohonan->permohonan_date}}" class="form-control" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-4 label">Jabatan / Sekolah</label>
                  <div class="col-sm-8">
                      <select class="form-select" name="permohonan_dept" aria-label="Default select example" id="myselectjawatan" disabled>
                          <option selected hidden>Pilih Jabatan</option>
                          @foreach ($departments as $key => $value)
                              <option value="{{ $value }}" {{ $ssmpermohonan->permohonan_dept == $value ? 'selected' : '' }}>
                                  {{ $value }}
                              </option>
                          @endforeach
                      </select>
                  </div>
              </div>

              <div class="row mb-3">
                    <label  class="col-sm-4 label">Unit</label>
                    <div class="col-sm-8">
                        <input type="text" name="permohonan_jabsch" value="{{$ssmpermohonan->permohonan_jabsch}}" class="form-control" disabled>
                    </div>
                </div>

                    <div id="file-input-container">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-4 label">Muat Naik Dokumen</label>
                        <div class="col-sm-4">
                            
                        
                            @if(isset($ssmpermohonan) && isset($ssmpermohonan->permohonan_file) && is_array($ssmpermohonan->permohonan_file) && count($ssmpermohonan->permohonan_file) > 0)
                                <div class="d-flex flex-wrap">
                                    @foreach ($ssmpermohonan->permohonan_file as $index => $file)
                                        <div class="file-container mb-2 me-2 d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <a href="{{ asset('storage/ssmpermohonan/' . $file) }}" target="_blank">
                                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ $file }}">
                                                        <i class="bi bi-file-image"></i>
                                                    </button>
                                                </a>
                                            </div>
                                            
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>




                <div class="row mb-3">
                    <label  class="col-sm-4 label">Catatan</label>
                    <div class="col-lg-8">
                        <textarea type="hurai" value="{{$ssmpermohonan->permohonan_catatan}}"  class="form-control" disabled>{{$ssmpermohonan->permohonan_catatan}}</textarea>
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

                    <table class="table-achiev" id="tableprestasi1">
                        <thead>
                            <tr>
                                <th class="text-center">IC No.</th>
                                <th class="text-center">Kod</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Catatan</th>
                                <th class="text-center">Catatan Kiv Admin</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count( $ssmpermohonanicno) == 0)
                                <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                                </tr>
                            @else
                                @foreach( $ssmpermohonanicno as  $ssmpermohonanicnoItem)
                                <tr class="text-center">
                                <input type="hidden" name="id[]" lass="form-control" value="{{ $ssmpermohonanicnoItem->id}}" hidden>
                                    <td>{{ $ssmpermohonanicnoItem->icno_pemohon}}</td>
                                    <td>{{ $ssmpermohonanicnoItem->ssmkod->kod}}</td>
                                    @if(Auth::user()->ic_no == $ssmpermohonanicnoItem->kod)
                                        <td>
                                            <select name="status_{{ $ssmpermohonanicnoItem->id }}" id="categorySelect" class="form-control">
                                                <option value="" @if(empty($ssmpermohonanicnoItem->status)) selected @endif>Pilih Status</option>
                                                <option value="Dalam Proses" @if($ssmpermohonanicnoItem->status == 'Dalam Proses') selected @endif>Dalam Proses</option>
                                                <option value="kiv" @if($ssmpermohonanicnoItem->status == 'kiv') selected @endif>Kiv</option>
                                                <option value="selesai" @if($ssmpermohonanicnoItem->status == 'selesai') selected @endif>Selesai</option>  
                                            </select>
                                        </td>
                                        <td><textarea id="daripada" type="text" placeholder="catatan" class="form-control @error('dariapda') is-invalid @enderror" name="catatantindakan_{{ $ssmpermohonanicnoItem->id }}" value="{{ old('dariapda') }}" autofocus>{{ $ssmpermohonanicnoItem->catatantindakan}}</textarea></td>                         
                                    @else           
                                        @if( $ssmpermohonanicnoItem->status == null)
                                            <td ><span class="badge rounded-pill bg-danger">Untuk Tindakan</span></td>
                                            @elseif(  $ssmpermohonanicnoItem->status=="Dalam Proses")
                                            <td><span class="badge rounded-pill bg-warning">Dalam Proses</span></td>
                                            @elseif(  $ssmpermohonanicnoItem->status=="kiv")
                                            <td><span class="badge rounded-pill bg-primary">kiv</span></td>
                                            @elseif(  $ssmpermohonanicnoItem->status =="selesai")
                                            <td><span class="badge rounded-pill bg-success">Selesai</span></td>
                                        @endif
                                        <td>Not Authorized</td>
                                    @endif
                            
                                    @if ($ssmpermohonanicnoItem->catatankivadmin == null)
                                        <td></td>
                                    @else
                                        <td>  
                                        <!-- Basic Modal -->
                                        <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#catatan2_{{$ssmpermohonanicnoItem->id}}">
                                        </button>
                                        <div class="modal fade" id="catatan2_{{$ssmpermohonanicnoItem->id}}" tabindex="-1">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Catatan Kiv Admin</h5>                      
                                                </div>
                                                <div class="modal-body">
                                                <h5 style="text-align: left;">Diserahkan Oleh: {{$ssmpermohonanicnoItem->ic_no_kivadmin}}</h5>                
                                                <textarea class="form-control" style="height: 150px" readonly>{{$ssmpermohonanicnoItem->catatankivadmin}}</textarea>
                                                </div>
                                            </div>
                                            </div>
                                        </div><!-- End Basic Modal-->
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

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
        paramName: "dc_file", // The name that will be used to transfer the file
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

                  