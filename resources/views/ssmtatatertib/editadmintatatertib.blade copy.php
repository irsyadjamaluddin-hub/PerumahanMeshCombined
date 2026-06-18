@extends('layouts.app-all')

@section('title', 'Admin Edit SSM Tatatertib')

@section('content')

<?php
$pagename = "Admin_Edit_SSMTatatertib";
?>

<div class="pagetitle">
  <h1>Edit SSM Tatatertib</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">Edit SSM Tatatertib</li>
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
  <a href="{{ route('ssmtatatertib.ssmrequest.indextatatertib') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 10px;">
  <i class="bi bi-arrow-left-circle"></i>
  </a>
</div> 

<section class="section profile">

  <div class="col-12">
    <div class="card recent-sales">
      <div class="card-body">
        <div class="profile-overview">

        @foreach($ssmtatatertib as $ssmtatatertib)
        <form class="" method="post" action="{{ route('ssmtatatertib.ssmrequest.updateadmintatatertib') }}"  id="myDropzone"   class="dropzone"  enctype="multipart/form-data">
          @csrf

          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Tatatertib Form</h5>
            <input type="text" name="id" class="form-control" value="{{$ssmtatatertib->id}}" hidden>
            <br>

            <!-- Existing Name -->
            <div class="row mb-3">
                <label class="col-sm-4 label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" name="tt_name" value="{{ $ssmtatatertib->tt_name }}" class="form-control" readonly>
                </div>
            </div>

            <!-- Existing IC. No -->
            <div class="row mb-3">
                <label class="col-sm-4 label">IC. No</label>
                <div class="col-sm-8">
                    <input type="text" name="tt_icno" value="{{ $ssmtatatertib->tt_icno }}" class="form-control" readonly>
                </div>
            </div>

              <!-- Existing Surat Rujukan -->
              <div class="row mb-3">
                  <label class="col-sm-4 label">Surat Rujukan</label>
                  <div class="col-sm-8">
                      <input type="text" name="tt_surat_rujukan" value="{{ $ssmtatatertib->tt_surat_rujukan }}" class="form-control">
                  </div>
              </div>

              <!-- Existing Perkara -->
              <div class="row mb-3">
                  <label class="col-sm-4 label">Perkara</label>
                  <div class="col-sm-8">
                      <input type="text" name="tt_perkara" value="{{ $ssmtatatertib->tt_perkara }}" class="form-control">
                  </div>
              </div>

              <!-- Existing Jawatan -->
              <div class="row mb-3">
                  <label for="inputText" class="col-sm-4 label">Jawatan</label>
                  <div class="col-sm-8">
                      <select id="tt_jawatan" class="form-select" name="tt_jawatan" aria-label="Default select example" style="width: 100%;">
                          <option value="" disabled selected></option>
                          @foreach ($jawatanlist as $key => $value)
                              <option value="{{ $value }}" {{ $ssmtatatertib->tt_jawatan == $value ? 'selected' : '' }}>
                                  {{ $value }}
                              </option>
                          @endforeach
                      </select>
                  </div>
              </div>
              <script>
                $('#permohonan_dept').select2({
                    width: '100%',
                    placeholder: "Pilih Jawatan",
                    allowClear: true
                });
              </script>

              <!-- Existing Tempat Bertugas -->
              <div class="row mb-3">
                    <label  class="col-sm-4 label">Tempat Bertugas</label>
                    <div class="col-sm-8">
                        <input type="text" name="tt_tempat_bertugas" value="{{$ssmtatatertib->tt_tempat_bertugas}}" class="form-control">
                    </div>
                </div>

              <!-- Existing Email -->
              <div class="row mb-3">
                    <label  class="col-sm-4 label">Emel</label>
                    <div class="col-sm-8">
                        <input type="text" name="tt_email" value="{{$ssmtatatertib->tt_email}}" class="form-control">
                    </div>
                </div>

              <!-- Existing No. Tel -->
              <div class="row mb-3">
                    <label  class="col-sm-4 label">No. Tel</label>
                    <div class="col-sm-8">
                        <input type="text" name="tt_notel" value="{{$ssmtatatertib->tt_notel}}" class="form-control">
                    </div>
                </div>

              <!-- Existing File Upload -->
              <div id="file-input-container">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 label">Muat Naik Dokumen</label>
                    <div class="col-sm-4">
                        <div id="file-input-container">
                        <div class="col-sm-12" id="file-dropzone" class="dropzone">
                            <span>Drag and drop files here or click to browse</span>
                              <input name="tt_file[]" type="file" multiple />
                          </div>
                        </div>
                        <br>
                        @if(isset($ssmtatatertib) && isset($ssmtatatertib->tt_file) && is_array($ssmtatatertib->tt_file) && count($ssmtatatertib->tt_file) > 0)
                            <div class="d-flex flex-wrap">
                                @foreach ($ssmtatatertib->tt_file as $index => $file)
                                    <div class="file-container mb-2 me-2 d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <a href="{{ asset('storage/ssmtatatertib/' . $file) }}" target="_blank">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ $file }}">
                                                    <i class="bi bi-file-image"></i>
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

            <!--Add Catatan-->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end" style="padding-right: 20%;">
                <button type="button" class="btn mt-2 mb-2 btn-sm" id="addCatatanBtn" style="background-color: rgb(144, 147, 225);">
                    <i class="bi bi-plus-lg" style="color: white;"></i>
                </button>
            </div>

            <!-- Table to display catatan fields -->
            <div style="width: 100%; padding-left: 20%; margin-bottom: 20px;">
                <table class="table-achiev" id="tableToAddCatatan" style="width: 75%;">
                    <thead>
                        <tr>
                            <th class="text-center" style="background-color: rgb(144, 147, 225);">No. Rujukan</th>
                            <th class="text-center" style="background-color: rgb(144, 147, 225);">Catatan</th>
                            <th class="text-center" style="background-color: rgb(144, 147, 225);">Tarikh Catatan</th>
                            <th class="text-center" style="background-color: rgb(144, 147, 225);">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table rows for adding catatan entries will be dynamically added here -->
                    </tbody>
                </table>
            </div>

            <script>
            $(document).ready(function() {
                // Variable to keep track of the current reference number
                let refNumber = {{ $ssmtatatertibcatatan->count() + 1 }}; // Initialize reference number based on the existing count of catatan entries

            // Function to generate HTML for a new "catatan" box
            function createCatatanRow() {
                return `
                    <tr>
                        <td class="text-center">TT ${refNumber}</td>
                        <td>
                            <input type="text" placeholder="Catatan" class="form-control" name="tt_catatan[]" value="">
                        </td>
                        <td>
                            <input type="date" name="catatan_created_at[]" class="form-control">
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger removeCatatanBtn">
                                <i class="bi bi-dash"></i>
                            </button>
                        </td>
                    </tr>`;
            }

            // Append the first "catatan" box
            $('#tableToAddCatatan tbody').append(createCatatanRow());

            // Add click event handler for the plus button
            $('#addCatatanBtn').click(function() {
                // Append a new "catatan" box
                $('#tableToAddCatatan tbody').append(createCatatanRow());

                // Increment the reference number for the next "catatan"
                refNumber++;
            });

            // Add click event handler to remove "catatan" boxes
            $(document).on('click', '.removeCatatanBtn', function() {
                // Only remove the row if it's not the first one
                if ($(this).closest('tr').index() > 0) {
                    $(this).closest('tr').remove();
                }
            });
            });
            </script>


            <!-- SUBMIT BUTTON -->
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

<div class="container">
    <div class="row mb-3">
        <div class="col-sm-12">
            <table class="table table-bordered">
                <thead style="background-color: #4682B4; color: white;">
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Catatan</th>
                        <th class="text-center">Tarikh Catatan</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ssmtatatertibcatatan as $index => $catatan)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $catatan->tt_catatan }}</td>
                        <td class="text-center">
                            @if($catatan->tt_catatan_date)
                                {{ $catatan->tt_catatan_date }}
                            @else
                                {{ $catatan->catatan_created_at }}
                            @endif
                        </td>
                        <td class="text-center">
    <button type="button" class="btn btn-outline-danger delete-button" data-catatan-id="{{ $catatan->id }}" onclick="showDeleteConfirmation('{{ $catatan->id }}')" style="margin-right:15px;">
        <i class="bi bi-trash-fill"></i>
    </button>
    </td>
    </tr>
    @endforeach
    </tbody>
    </table>
    <!-- Single button to update all catatan -->
    <form method="get" action="{{ route('ssmtatatertib.ssmrequest.updatetatatertibcatatan') }}">
        @csrf
        <button type="submit" class="btn btn-outline-primary">Update Catatan</button>
    </form>
    </div>
    </div>
    </div>

<!-- Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this catatan?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let deleteCatatanId;

        $('.delete-button').click(function() {
            deleteCatatanId = $(this).data('catatan-id');
            $('#deleteConfirmationModal').modal('show');
        });

        $('#confirmDeleteButton').click(function() {
            $('#deleteForm' + deleteCatatanId).submit();
        });
    });
</script>



        <hr><br>

        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Admin</h5>

        <div class="row mb-3">
            <label  class="col-sm-4 label" style="padding-left: 20px;">Created by</label>
            <div class="col-sm-8">
                <input type="text"  value="{{$ssmtatatertib->created_by}}"  class="form-control" readonly>
            </div>
        </div>
        <!-- start status -->
        <form class="" method="post" action="{{ route('ssmtatatertib.ssmrequest.updatestatusadmintatatertib') }}"  id="statusadmin"  enctype="multipart/form-data">
          @csrf
          <input type="text" name="id" class="form-control" value="{{$ssmtatatertib->id}}" hidden>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-4 col label" style="padding-left: 20px;">Status</label>
            <div class="col-sm-6">
              <select name="status" class="form-control">
                <option value="">Null</option>
                <!-- <option value="untuktindakan">Untuk Tindakan</option> -->
                <!-- <option value="dikemaskini/diteliti">Dikemaskini/Diteliti</option> -->
                <option value="untuktindakan" {{ $ssmtatatertib->status == 'untuktindakan' ? 'selected' : '' }}>Untuk Tindakan</option>
                <option value="dikemaskini/diteliti" {{ $ssmtatatertib->status == 'dikemaskini/diteliti' ? 'selected' : '' }}>Sedang Dikemaskini/Diteliti</option>
                <option value="selesai" {{ $ssmtatatertib->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
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
            <tr>
                <td>Untuk Tindakan</td>
                <td>{{ $ssmtatatertib->Ut_at }}</td>
                <td>{{ optional($ssmtatatertib->ssmkod)->kod }}</td>
            </tr>
            <tr>
                <td>Sedang Dikemaskini/Diteliti</td>
                <td>{{ $ssmtatatertib->kt_at }}</td>
                <td>{{ optional($ssmtatatertib->selesaikod)->kod }}</td>
            </tr>
            <tr>
                <td>Selesai</td>
                <td>{{ $ssmtatatertib->selesai_at }}</td>
                <td>{{ optional($ssmtatatertib->selesaikod)->kod }}</td>
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
    Dropzone.options.myDropzone = {
        paramName: "tt_file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        autoProcessQueue: true, // Automatically process the files
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