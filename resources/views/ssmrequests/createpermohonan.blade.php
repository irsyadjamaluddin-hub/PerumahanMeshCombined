@extends('layouts.app-all')

@section('title', 'SSM Permohonan')

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
      <li class="breadcrumb-item active">SSM Permohonan</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

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
        <div class="profile-overview">
          <!-- form 6: Permohonan-->
          <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.storepermohonan') }}" enctype="multipart/form-data">
            @csrf
            <br>
            <br>
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Permohonan</h5>
            <div class="row mb-3">
              <div class="row mb-3">
                <label class="col-sm-4 label">Jenis Permohonan:</label>
                <div class="col-lg-8">
                  <select id="jenis_permohonan" name="permohonan_type" style="width: 100%;">                           
                    <option value="" disabled selected></option>
                        @foreach ($jenispermohonans as $key => $value)
                        <option value="{{ $value }}">                      
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
              <label for="inputText" class="col-sm-4 label">Tarikh Permohonan</label>
              <div class="col-sm-8">
                <input type="date" name="permohonan_date" class="form-control" >
                {!! $errors->first('taikh', '<p class="help-block text-danger">:message</p>') !!}
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 label">Jabatan / Sekolah</label>
              <div class="col-sm-8">
                  <select id="permohonan_dept" class="form-select" name="permohonan_dept" aria-label="Default select example" style="width: 100%;">
                      <option value="" disabled selected></option>
                      @foreach ($departments as $key => $value)
                          <option value="{{ $value }}">
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
              <label for="inputText" class="col-sm-4 label">Unit</label>
              <div class="col-sm-8">
                <input type="text" name="permohonan_jabsch" class="form-control" placeholder="">

                {!! $errors->first('Unit', '<p class="help-block text-danger">:message</p>') !!}
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
                      <div id="file-dropzone" class="dropzone">
                          <span>Drag and drop files here or click to browse</span>
                          <input name="permohonan_file[]" type="file" multiple id="file-input" style="display:none;"/>
                          <div id="file-previews"></div>
                      </div>
                  </div>
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 label">Catatan</label>
              <div class="col-sm-8">
                <textarea type="text" name="permohonan_catatan" class="form-control" placeholder="catatan" ></textarea>
                {!! $errors->first('catatan', '<p class="help-block text-danger">:message</p>') !!}
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

            <div style="width: 100%; padding-left: 20%; margin-bottom: 20px;">
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

            <input type="hidden" name="previous_page" value="{{url()->previous()}}">

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Hantar</button>
            </div>
                              
          </form>

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

<!-- Your JavaScript code -->
<script>
      Dropzone.options.fileDropzone = {
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
    $('#myselect').select2({
      width: '100%',
      placeholder: "Pilih Jabatan",
      allowClear: true
    });
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
