@extends('layouts.app-all')

@section('title', 'Admin Edit Salinan')

@section('content')

<?php
$pagename = "SSM_Staff_Permohonan";
?>

<div class="pagetitle">
    <h1>Edit Salinan Permohonan</h1>
    <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item">SSM Request Staff Permohonan</li>
          <li class="breadcrumb-item active">Edit Salinan Permohonan</li>
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

        @foreach($ssmpermohonansalinans as $ssmpermohonansalinan)
          <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.updatestaffsalinan') }}"  id="myDropzone"   class="dropzone"  enctype="multipart/form-data">
          @csrf
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #91c08f;">Edit Salinan</h5>
            <input type="text" name="id" class="form-control" value="{{$ssmpermohonansalinan->id}}" hidden>
            <br>
            
            <div class="row mb-3">
              <label class="col-sm-4 label">Jenis Permohonan:</label>
              <div class="col-lg-8" id="permohonandropdownview">
                <select id="jenis_permohonan" name="permohonan_type" style="width: 100%;" required>                           
                  <option value="" disabled selected></option>
                    @foreach ($jenispermohonans as $key => $value)
                    <option value="{{ $value }}" {{ $ssmpermohonansalinan->permohonan_type == $value ? 'selected' : '' }}>              
                        {{ $value }}
                    </option>
                    @endforeach
                </select>
                {!! $errors->first('jabatan', '<p class="help-block text-danger">:message</p>')!!}
              </div>

              <div class="col-lg-8" id="permohonantextview" hidden>
                <input type="text" id="permohonantextinput" name="permohonan_type" value="{{ $ssmpermohonansalinan->permohonan_type ?? '' }}" class="form-control" placeholder="Jenis Permohonan Lain..." style="height:28px; padding-left: 8px; font-size: 15px; padding-bottom: 4px;" disabled>
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
              <label class="col-sm-4 label"></label>
              <div class="col-lg-8">
                <div class="checkbox-container" style="padding-left: 20px;">
                  <input type="checkbox" class="form-check-input" id="otherPermohonanCheckbox">
                  <label class="form-check-label" style="padding-left:10px;">Other Permohonan</label>
                </div>
              </div>
            </div>

            <script>
              document.addEventListener('DOMContentLoaded', function () {
                  const jenisPermohonanDropdownview = document.getElementById('permohonandropdownview');
                  const jenisPermohonanTextview = document.getElementById('permohonantextview');
                  const jenisPermohonanDropdowninput = document.getElementById('jenis_permohonan');
                  const jenisPermohonanTextinput = document.getElementById('permohonantextinput');
                  const otherPermohonanCheckbox = document.getElementById('otherPermohonanCheckbox');
          
                  otherPermohonanCheckbox.addEventListener('change', function () {
                    if (otherPermohonanCheckbox.checked) {
                          jenisPermohonanDropdownview.setAttribute('hidden', '');
                          jenisPermohonanDropdowninput.setAttribute('disabled', '');
                          jenisPermohonanDropdowninput.removeAttribute('required', '');

                          jenisPermohonanTextinput.setAttribute('required', ''); 
                          jenisPermohonanTextview.removeAttribute('hidden', '');
                          jenisPermohonanTextinput.removeAttribute('disabled', '');                                                  
                      } else {
                          jenisPermohonanDropdownview.removeAttribute('hidden', '');
                          jenisPermohonanDropdowninput.removeAttribute('disabled', '');
                          jenisPermohonanDropdowninput.setAttribute('required', '');
                          
                          jenisPermohonanTextinput.removeAttribute('required', '');
                          jenisPermohonanTextview.setAttribute('hidden', '');
                          jenisPermohonanTextinput.setAttribute('disabled', '');                         
                      }
                  });
              });
            </script>
          
            <div class="row mb-3">
                <label  class="col-sm-4 label">Tarikh Salinan</label>
                <div class="col-sm-8">
                    <input type="timestamp" name="permohonan_date" value="{{$ssmpermohonansalinan->created_at}}" class="form-control" disabled>
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
                    @if(isset($ssmpermohonansalinan) && isset($ssmpermohonansalinan->permohonan_file) && is_array($ssmpermohonansalinan->permohonan_file) && count($ssmpermohonansalinan->permohonan_file) > 0)
                        <div class="d-flex flex-wrap" style="width: 27rem;">
                            @foreach ($ssmpermohonansalinan->permohonan_file as $index => $file)
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
                    <textarea type="hurai" name="permohonan_catatan" value="{{$ssmpermohonansalinan->permohonan_catatan}}"  class="form-control">{{$ssmpermohonansalinan->permohonan_catatan}}</textarea>
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
                      html += '<td><select class="form-select" name="kod[]" aria-label="Default select example" disabled>';
                      
                      @foreach ($ssmkod as $value)
                          html += '<option value="{{ $value['ic_no'] }}">{{ $value['kod'] }}</option>';
                      @endforeach
          
                      html += '</select>';

                      html += '<select class="form-select" name="kod[]" aria-label="Default select example" hidden>';
                      
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
                    <th class="text-center" style="background-color: rgb(144, 147, 225);">Kad Pengenalan </th>
                    <th class="text-center" style="background-color: rgb(144, 147, 225);">Kod</th>
                    <th class="text-center" style="background-color: rgb(144, 147, 225);">Action</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>
                      <input type="text" placeholder="No Kad Pengenalan" class="form-control" name="icno_pemohon[]" autofocus>
                    </td>
                    <td>
                      <select class="form-select" name="kod[]" aria-label="Default select example" disabled>    
                        @foreach ($ssmkod as $value)
                            <option value="{{ $value['ic_no'] }}">
                              {{ $value['kod'] }}
                            </option>
                        @endforeach
                      </select>
                      <select class="form-select" name="kod[]" aria-label="Default select example" hidden>    
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
              <th class="text-center">Tarikh</th>
              <th class="text-center">Action</th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            @if(count($ssmpermohonansalinanicnos) == 0)
                <tr class="text-center">
                  <td colspan="8">
                    <h5>No records found</h5>
                  </td>
                </tr>
            @else
              @foreach( $ssmpermohonansalinanicnos as $ssmpermohonansalinanicno)

              <tr class="text-center" style="width: 100%;">
                <td style="width: 30%;">{{$ssmpermohonansalinanicno->icno_pemohon}}</td>
                <td style="width: 30%;">{{$ssmpermohonansalinanicno->ssmkod->kod}}</td>    
                <td style="width: 30%;">{{$ssmpermohonansalinanicno->created_at}}</td>
                <td style="width: 10%;"> 
                  <div style="display: flex; text-align: justify; justify-content: center;">
                    <form id="deleteForm{{$ssmpermohonansalinanicno->id}}" method="post" action="{{ route('ssmrequests.ssmrequest.destroypermohonansalinanicno', $ssmpermohonansalinanicno->id) }}" style="margin-bottom:0px;">
                        @csrf
                        @method('delete')
                        <button type="button" class="btn btn-outline-danger" onclick="showDeleteConfirmationApproval({{ $ssmpermohonansalinanicno->id }})">
                            <i class="bi bi-trash-fill"></i>
                        </button>

                        <!-- Add a modal for confirmation -->
                        <div class="modal" id="deleteConfirmationModalApproval{{ $ssmpermohonansalinanicno->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirm Deletion</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval({{ $ssmpermohonansalinanicno->id }})">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this record?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $ssmpermohonansalinanicno->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $ssmpermohonansalinanicno->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <script>
                        function showDeleteConfirmationApproval(id) {
                            $('#deleteConfirmationModalApproval' + id).modal('show');
                        }

                        function hideDeleteConfirmationApproval(id) {
                            $('#deleteConfirmationModalApproval' + id).modal('hide');
                        }

                        function deleteRecordApproval(formId) {
                            $('#' + formId).submit();
                        }
                    </script>
                  </div> 
                </td>    
              </tr>
              @endforeach
            @endif
          </tbody>
        </table>

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
