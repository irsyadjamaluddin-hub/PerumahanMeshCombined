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


@if(Session::has('success_message'))
<div class="alert alert-success">
    <i class=" fas fa-fw fa-check"></i>
    {!! session('success_message') !!}
</div>
@endif

<!----- Back out Button  ----->
<div class="col-md-1 text-left">
  <a href="{{ route('ssmrequests.ssmrequest.indexpermohonan') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 10px;">
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

        @foreach($ssmpermohonan as $ssmpermohonan)
          <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.updateadminpermohonan') }}"  id="myDropzone"   class="dropzone"  enctype="multipart/form-data">
          @csrf

            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Permohonan Form</h5>
            <input type="text" name="id" class="form-control" value="{{$ssmpermohonan->id}}" hidden>
            <br>

                <div class="row mb-3">
                    <label class="col-sm-4 label">Jenis Permohonan:</label>
                    <div class="col-lg-8">
                      <select id="jenis_permohonan" name="permohonan_type" style="width: 100%;">                           
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
                        <input type="date" name="permohonan_date" value="{{$ssmpermohonan->permohonan_date}}" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-4 label">Jabatan / Sekolah</label>
                  <div class="col-sm-8">
                      <select id="permohonan_dept" class="form-select" name="permohonan_dept" aria-label="Default select example" style="width: 100%;">
                          <option value="" disabled selected></option>
                          @foreach ($departments as $key => $value)
                              <option value="{{ $value }}" {{ $ssmpermohonan->permohonan_dept == $value ? 'selected' : '' }}>
                                  {{ $value }}
                              </option>
                          @endforeach
                      </select>
                  </div>
              </div>
              <script>
                $('#permohonan_dept').select2({
                    width: '100%',
                    placeholder: "Pilih Jabatan",
                    allowClear: true
                });
              </script>

              <div class="row mb-3">
                    <label  class="col-sm-4 label">Unit</label>
                    <div class="col-sm-8">
                        <input type="text" name="permohonan_jabsch" value="{{$ssmpermohonan->permohonan_jabsch}}" class="form-control">
                    </div>
                </div>



                <div id="file-input-container">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-4 label">Muat Naik Dokumen</label>
                  <div class="col-sm-4">
                    <div id="file-dropzone" class="dropzone">
                        <span>Drag and drop files here or click to browse</span>
                        <input name="permohonan_file[]" type="file" multiple id="file-input" style="display:none;"/>
                        <div id="file-previews"></div>
                    </div>
                    <br>
                      @if(isset($ssmpermohonan) && isset($ssmpermohonan->permohonan_file) && is_array($ssmpermohonan->permohonan_file) && count($ssmpermohonan->permohonan_file) > 0)
                          <div class="d-flex flex-wrap" style="width: 27rem;"">
                              @foreach ($ssmpermohonan->permohonan_file as $index => $file)
                                  <div class="file-container mb-2 me-2 d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <a href="{{ asset('storage/ssmpermohonan/' . $file) }}" target="_blank">
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ $file }}">
                                                <i class="bi bi-file-image"></i>
                                            </button>
                                        </a>
                                    </div>
                                    <div style="width: 15rem;">
                                      <label style="padding-left: 10px; margin-bottom: 0px;"> : </label> <label style="padding-left: 20px; margin-bottom: 0px;"  title="{{ $file }}"> {{ Str::limit($file, 15) }} </label>
                                    </div>
                                    <div class="checkbox-container"> <!-- Added margin start (ms-2) -->
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

            <div class="row mb-3">
                <label  class="col-sm-4 label">Catatan</label>
                <div class="col-lg-8">
                    <textarea type="hurai" name="permohonan_catatan" value="{{$ssmpermohonan->permohonan_catatan}}"  class="form-control">{{$ssmpermohonan->permohonan_catatan}}</textarea>
                </div>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end" style="padding-right: 20%;">
              <button type="button" class="btn mt-2 mb-2 btn-sm" id="addbtn2" href="#" style="background-color: rgb(144, 147, 225);"">
                <i class="bi bi-plus-lg" style="color: white;"></i>
              </button>
            </div>

            <script type="text/javascript">
                $(document).ready(function() {
                    $('#addbtn2').off().on('click', function() {
                        var 
                        
                        html = '<tr>';
                        html += '<td><input type="text" placeholder="No Kad Pengenalan" class="form-control @error('dariapda') is-invalid @enderror" name="icno_pemohon[]" value="{{ old('dariapda') }}" autofocus></td>';
                        html += '<td><select class="form-select" name="kod[]" aria-label="Default select example" required><option selected hidden>Pilih Kod</option>';
                        
                        @foreach ($ssmkod as $value)
                            html += '<option value="{{ $value['ic_no'] }}">{{ $value['kod'] }}</option>';
                        @endforeach
            
                        html += '</select></td>';
                        html += '<td style="text-align:center;"><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button" style="background-color: #f75f6e; border-color: #f75f6e;"><i class="bi bi-dash"></i></button></td>';
                        html += '</tr>';
            
                        $('#tableprestasi1').append(html);
                    });
            
                    $(document).on('click', '.removeDeclare', function() {
                        $(this).closest('tr').remove();
                    });
                });
            </script>

            <div style="width: 100%; padding-left: 20%;">
              <table class="table-achiev" id="tableprestasi1" style="width: 75%;">

                <thead>
                  <tr>
                    <th class="text-center" style="background-color: rgb(144, 147, 225);">IC No.Pemohon </th>
                    <th class="text-center" style="background-color: rgb(144, 147, 225);">Kod</th>
                    <th class="text-center" style="background-color: rgb(144, 147, 225);">Action</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>
                      <input type="text" placeholder="No Kad Pengenalan" class="form-control @error('dariapda') is-invalid @enderror" name="icno_pemohon[]" value="{{ old('dariapda') }}" autofocus>
                    </td>
                    <td>
                      <select class="form-select" name="kod[]" aria-label="Default select example">
                        <option value="" disabled selected>Pilih Kod</option>     
                        @foreach ($ssmkod as $value)
                            <option value="{{ $value['ic_no'] }}">
                              {{ $value['kod'] }}
                            </option>
                        @endforeach
                      </select>
                    </td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <br>

            <div class="text-center">
              <button type="submit" class="btn btn-primary" id="myDropzonesubmit">Submit</button>
            </div>
            <script>
              var dropzoneSubmitButton  = document.getElementById('myDropzonesubmit');
              var dropzoneForm  = document.getElementById('myDropzone');
            
              dropzoneForm.addEventListener('submit', function(event) {
                  if (dropzoneSubmitButton.getAttribute('data-submitted') !== null) {
                      event.preventDefault();
                  } else {
                      dropzoneSubmitButton.disabled = true;
                      dropzoneSubmitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                      dropzoneSubmitButton.setAttribute('data-submitted', 'true');
                  }
              });
            </script>
          </form>
        @endforeach

        <hr><br>

        <table class="table-achiev">

          <thead>
            <tr>
              <th class="text-center">IC No.Pemohon </th>
              <th class="text-center">Kod</th>
              <th class="text-center">Status</th>
              <th class="text-center">Tarikh Diserahkan</th>
              <th class="text-center">Catatan</th>
              <th class="text-center">Catatan Kiv Admin</th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            @if(count($ssmpermohonanicno) == 0)
                <tr class="text-center">
                  <td colspan="8">
                    <h5>No records found</h5>
                  </td>
                </tr>
            @else
              @foreach( $ssmpermohonanicno as $ssmpermohonanicno)

              <tr class="text-center">
                <td>{{$ssmpermohonanicno->icno_pemohon}}</td>
              <td>{{ optional($ssmpermohonanicno->ssmkod)->kod }}</td>   

                @if($ssmpermohonanicno->status == null)
                  <td ><span class="badge rounded-pill bg-danger">Untuk Tindakan</span></td>
                @elseif($ssmpermohonanicno->status=="Dalam Proses")
                  <td><span class="badge rounded-pill bg-warning">Dalam Proses</span></td>
                @elseif($ssmpermohonanicno->status=="kiv")
                  <td><span class="badge rounded-pill bg-primary">kiv</span></td>
                @elseif($ssmpermohonanicno->status =="selesai")
                  <td><span class="badge rounded-pill bg-success">Selesai</span></td>
                @endif

                <td>{{$ssmpermohonanicno->submitted_at}}</td>
                <!-- <td>{{$ssmpermohonanicno->catatan}}</td> -->

                @if ($ssmpermohonanicno->catatantindakan == null)
                  <td></td>
                @else
                <td>  
                  <!-- Basic Modal -->
                  <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#catatan_{{$ssmpermohonanicno->id}}">
                  </button>
                  <div class="modal fade" id="catatan_{{$ssmpermohonanicno->id}}" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Catatan</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <textarea class="form-control" style="height: 150px" readonly>{{$ssmpermohonanicno->catatantindakan}}</textarea>
                        </div>
                      </div>
                    </div>
                  </div><!-- End Basic Modal-->
                </td>
                @endif

                @if ($ssmpermohonanicno->catatankivadmin == null)
                  <td></td>
                @else
                <td>  
                  <!-- Basic Modal -->
                  <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#catatan2_{{$ssmpermohonanicno->id}}">
                  </button>
                  <div class="modal fade" id="catatan2_{{$ssmpermohonanicno->id}}" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Catatan Kiv Admin</h5>                      
                        </div>
                        <div class="modal-body">
                          <h5 style="text-align: left;">Diserahkan Oleh: {{$ssmpermohonanicno->ic_no_kivadmin}}</h5>                
                          <textarea class="form-control" style="height: 150px" readonly>{{$ssmpermohonanicno->catatankivadmin}}</textarea>
                        </div>
                      </div>
                    </div>
                  </div><!-- End Basic Modal-->
                </td>
                @endif

                <td> 
                  <div style="display: flex; text-align: justify; justify-content: center;"">
                    <form id="deleteForm{{$ssmpermohonanicno->id}}" method="post" action="{{ route('ssmrequests.ssmrequest.destroypermohonanicno', $ssmpermohonanicno->id) }}" style="margin-bottom:0px;">
                      @csrf
                      @method('delete')
                      <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" onclick="confirmDelete('deleteForm{{$ssmpermohonanicno->id}}')">
                          <i class="bi bi-trash"></i>
                      </button>
                    </form>

                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#sebabModal-{{ $ssmpermohonanicno->id }}" data-bs-tooltip="tooltip" data-bs-placement="top">
                      <i class="bi bi-arrow-repeat"></i>
                    </button>
                    <div class="modal fade" id="sebabModal-{{ $ssmpermohonanicno->id }}" tabindex="-1" aria-labelledby="sebabModalLabel-{{ $ssmpermohonanicno->id }}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form method="post" id="kivstatus" action="{{ route('ssmrequests.ssmrequest.updatestaffpermohonanstatus', ['id' => $ssmpermohonanicno->id]) }}">
                              @csrf
                              <input type="text" name="status" value="kiv" hidden>
                              <div class="modal-header d-flex justify-content-center">
                                <h5 class="modal-title" id="sebabModalLabel-{{ $ssmpermohonanicno->id }}" style="text-align: center;"><b>Sebab kiv</b></h5>
                              </div>
                              <div class="modal-body">
                                <textarea name="catatankivadmin" placeholder="Catatan..." class="form-control" required></textarea>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" id="kivstatus" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #f75f6e; border-color: #f75f6e;">Close</button>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div> 
                </td>    
  
              </tr>
              @endforeach
            @endif
          </tbody>
        </table>

        <br>
        <br>

        <!-- Admin Status -->
          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Admin</h5>

          <div class="row mb-3">
              <label  class="col-sm-4 label" style="padding-left: 20px;">Created by</label>
              <div class="col-sm-8">
                  <input type="text"  value="{{$ssmpermohonan->created_by}}"  class="form-control" readonly>
              </div>
          </div>
          <!-- start status -->
          <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.updatestatusadminpermohonan') }}"  id="statusadmin"  enctype="multipart/form-data">
            @csrf
            <input type="text" name="id" class="form-control" value="{{$ssmpermohonan->id}}" hidden>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col label" style="padding-left: 20px;">Status</label>
              <div class="col-sm-6">
                <select name="permohonan_status" class="form-control">
                  <option value="">Null</option>
                  <option value="kiv" {{ $ssmpermohonan->permohonan_status == 'kiv' ? 'selected' : '' }}>KIV</option>
                  <option value="selesai" {{ $ssmpermohonan->permohonan_status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                {!! $errors->first('status', '<p class="help-block text-danger">:message</p>') !!}
              </div>
              <div class="col-sm-2">
                <button type="submit" class="btn btn-primary" id="statusadminsubmit">Submit</button>
                <script>
                  var statusAdminSubmitButton  = document.getElementById('statusadminsubmit');
                  var statusAdminForm = document.getElementById('statusadmin');
                
                  statusAdminForm.addEventListener('submit', function(event) {
                      if (statusAdminSubmitButton .getAttribute('data-submitted') !== null) {
                          event.preventDefault();
                      } else {
                        statusAdminSubmitButton .disabled = true;
                        statusAdminSubmitButton .innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                        statusAdminSubmitButton .setAttribute('data-submitted', 'true');
                      }
                  });
                </script>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusInfoModal">Info</button>
              </div>
            </div>
          </form>
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
                        <td>KIV</td>
                        <td>{{$ssmpermohonan->kiv_at}}</td>
                        <td> {{optional($ssmpermohonan->ssmkod)->kod}}</td>
                      </tr>

                      <tr>
                        <td>Selesai</td>
                        <td>{{$ssmpermohonan->selesai_at}}</td>
                        <td>{{optional($ssmpermohonan->selesaikod)->kod}}</td>
                      </tr>
                      <!-- Add more rows as needed -->
                    </tbody>
                  </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #f75f6e; border-color: #f75f6e;">Close</button>
                </div>
              </div>
            </div>
          </div>
        <!-- Admin Status End -->

        <br>

        <!-- Despatch Status -->
          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Despatch</h5>
          <br>
          <!-- start status -->
          <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.updatestatusdispatchpermohonan') }}"  id="statusdispatch"  enctype="multipart/form-data">
            @csrf
            <input type="text" name="id" class="form-control" value="{{$ssmpermohonan->id}}" hidden>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col label" style="padding-left: 20px;">Status</label>
              <div class="col-sm-6">
                @if ($ssmpermohonan->permohonan_status == 'selesai')
                  <select name="dispatch_status" class="form-control">
                    <option value="">Null</option>
                    <option value="selesai" {{ $ssmpermohonan->dispatch_status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                  </select>
                  {!! $errors->first('status', '<p class="help-block text-danger">:message</p>') !!}
                @else
                  <select name="" class="form-control" disabled>
                    <option value="">Null</option>
                  </select>
                @endif
              </div>
              <div class="col-sm-2">
                <button type="submit" class="btn btn-primary" id="statusdispatchsubmit">Submit</button>
                <script>
                  var statusdispatchsubmitButton  = document.getElementById('statusdispatchsubmit');
                  var statusdispatchForm = document.getElementById('statusdispatch');
                
                  statusdispatchForm.addEventListener('submit', function(event) {
                      if (statusdispatchsubmitButton .getAttribute('data-submitted') !== null) {
                          event.preventDefault();
                      } else {
                        statusdispatchsubmitButton .disabled = true;
                        statusdispatchsubmitButton .innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                        statusdispatchsubmitButton .setAttribute('data-submitted', 'true');
                      }
                  });
                </script>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusInfoDispatchModal">Info</button>
              </div>
            </div>
          </form>
          <!-- Modal -->
          <div class="modal fade" id="statusInfoDispatchModal" tabindex="-1" role="dialog" aria-labelledby="statusInfoDispatchModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="statusInfoDispatchModal">Despatch Status Information</h5>
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
                      <tr>
                        <td>Selesai</td>
                        <td>{{$ssmpermohonan->dispatch_updated_at}}</td>
                        <td>{{$ssmpermohonan->dispatch_updated_by}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #f75f6e; border-color: #f75f6e;">Close</button>
                </div>
              </div>
            </div>
          </div>
        <!-- Despatch Status End -->

        <br>

      </div>
    </div>
  </div>
</div>

</section>
@endsection

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

<script>
  function confirmDelete(formId) {
      var result = confirm("Are you sure you want to delete this item?");
      if (result) {
          // User confirmed, submit the form with the specified id
          document.getElementById(formId).submit();
      } else {
          // User cancelled, do nothing
      }
  }
</script>

<!-- Include Dropzone.css in the head of your layout file -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">

<!-- Include Dropzone.js at the bottom of your layout file, after jQuery or any other dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var fileDropzone = document.getElementById('file-dropzone');
		var fileInput = document.getElementById('file-input');
		var filePreviews = document.getElementById('file-previews');
		var filesList = []; // Array to store files

		fileDropzone.addEventListener('click', function(event) {
			if (event.target === fileDropzone) {
				fileInput.click();
			}
		});

		fileInput.addEventListener('change', function(event) {
			handleFiles(event.target.files);
		});

		fileDropzone.addEventListener('dragover', function(event) {
			event.preventDefault();
			fileDropzone.classList.add('dragging');
		});

		fileDropzone.addEventListener('dragleave', function() {
			fileDropzone.classList.remove('dragging');
		});

		fileDropzone.addEventListener('drop', function(event) {
			event.preventDefault();
			fileDropzone.classList.remove('dragging');
			handleFiles(event.dataTransfer.files);
		});

		function handleFiles(files) {
			for (var i = 0; i < files.length; i++) {
				var file = files[i];
				filesList.push(file); // Add files to the list
				createPreview(file, filesList.length - 1); // Pass the index of the file
			}
			updateFileInput();
		}

		function createPreview(file, index) {
			var preview = document.createElement('div');
			preview.classList.add('file-preview');
			preview.setAttribute('data-index', index); // Set the index as a data attribute

			if (file.type.startsWith('image/')) {
				var img = document.createElement('img');
				img.src = URL.createObjectURL(file);
				preview.appendChild(img);
			} else {
				var fileIcon = document.createElement('span');
				fileIcon.classList.add('file-icon');
				fileIcon.innerHTML = '&#128196;'; // Unicode character for a generic file icon
				preview.appendChild(fileIcon);
			}

			var fileName = document.createElement('span');
			fileName.textContent = file.name;
			preview.appendChild(fileName);

			var removeBtn = document.createElement('button');
			removeBtn.classList.add('remove-btn');
			removeBtn.innerHTML = '&times;';
			removeBtn.addEventListener('click', function(event) {
				event.stopPropagation(); // Prevents the file input click event
				removeFile(index);
			});
			preview.appendChild(removeBtn);

			filePreviews.appendChild(preview);
		}

		function removeFile(index) {
			filesList.splice(index, 1); // Remove the file from the list
			updatePreviews();
			updateFileInput();
		}

		function updatePreviews() {
			filePreviews.innerHTML = '';
			filesList.forEach(function(file, index) {
				createPreview(file, index);
			});
		}

		function updateFileInput() {
			var dataTransfer = new DataTransfer();
				filesList.forEach(function(file) {
					dataTransfer.items.add(file);
				});
				fileInput.files = dataTransfer.files;
                    	}
                  });
</script>

<style>
	#file-dropzone {
		border: 3px dashed #ccc;
		border-radius: 4px;
		padding: 10px;
		text-align: center;
		cursor: pointer;
		margin-bottom: 10px;
	}
	.file-preview {
		display: flex;
		align-items: center;
		margin-top: 10px;
		position: relative;
	}
	.file-preview img {
		max-width: 100px;
		max-height: 100px;
 		margin-right: 10px;
	}
	.file-preview .file-icon {
  		font-size: 50px;
		margin-right: 10px;
	}
	.file-preview .remove-btn {
		position: absolute;
		top: 0;
		right: 0;
		background: red;
		color: white;
		border: none;
		border-radius: 50%;
		cursor: pointer;
		width: 20px;
		height: 20px;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 14px;
		line-height: 20px;
	}
</style>
