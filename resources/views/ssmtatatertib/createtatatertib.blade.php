@extends('layouts.app-all')

@section('title', 'SSM Tatatertib')

@section('content')

<?php
$pagename = "SSMSRequest";
?>

<div class="pagetitle">
  <h1>SSM Tatatertib</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">SSM Tatatertib</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

@if(Session::has('error_message'))
<div class="alert alert-danger">
    <i class="fas fa-fw fa-exclamation-circle"></i>
    {!! session('error_message') !!}
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
          <!-- form 6: Tatatertib - Fira-->
          <form class="" method="post" action="{{ route('ssmtatatertib.ssmrequest.storetatatertib') }}" enctype="multipart/form-data">
            @csrf
            <br>
            <br>
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Tatatertib</h5>
            <div class="row mb-3">
              <div class="row mb-3">

              <!--Add Name - Fira-->
              <div class="row mb-3">
                <label for="inputText" class="col-sm-4 label">Nama</label>
                <div class="col-sm-8">
                  <input type="text" name="tt_name" class="form-control" placeholder="">

                  {!! $errors->first('Nama', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <!--Add IC. No - Fira-->
              <div class="row mb-3">
                <label for="inputText" class="col-sm-4 label">IC. No</label>
                <div class="col-sm-8">
                  <input type="number" name="tt_icno" class="form-control" placeholder="">

                  {!! $errors->first('IC. No', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <!--Add Surat Rujukan - Fira-->
              <div class="row mb-3">
                <label for="inputText" class="col-sm-4 label">Surat Rujukan</label>
                <div class="col-sm-8">
                  <input type="text" name="tt_surat_rujukan" class="form-control" placeholder="">

                  {!! $errors->first('Surat Rujukan', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <!--Add Perkara - Fira-->
              <div class="row mb-3">
                <label for="inputText" class="col-sm-4 label">Perkara</label>
                <div class="col-sm-8">
                  <input type="text" name="tt_perkara" class="form-control" placeholder="">

                  {!! $errors->first('Perkara', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <!-- Add Jawatan - Fira -->
              <div class="row mb-3">
                  <label for="inputText" class="col-sm-4 label">Jawatan</label>
                  <div class="col-sm-8">
                      <select id="tt_jawatan" class="form-select" name="tt_jawatan" aria-label="Default select example" style="width: 100%;">
                          <option value="" disabled selected></option>
                          @foreach ($jawatanlist as $key => $value)
                              <option value="{{ $value }}">
                                  {{ $value }}
                              </option>
                          @endforeach
                      </select>
                  </div>
              </div>
              <script>
                  $('#tt_jawatan').select2({
                      width: '100%',
                      placeholder: "Pilih Jawatan",
                      allowClear: true
                  });
              </script>

              <!--Add Tempat Bertugas - Fira-->
              <div class="row mb-3">
                <label for="inputText" class="col-sm-4 label">Tempat Bertugas</label>
                <div class="col-sm-8">
                  <input type="text" name="tt_tempat_bertugas" class="form-control" placeholder="">

                  {!! $errors->first('Tempat Bertugas', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <!--Add Email - Fira-->
              <div class="row mb-3">
                <label for="inputText" class="col-sm-4 label">Emel</label>
                <div class="col-sm-8">
                  <input type="text" name="tt_email" class="form-control" placeholder="">

                  {!! $errors->first('Emel', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <!--Add No. Tel - Fira-->
              <div class="row mb-3">
                <label for="inputText" class="col-sm-4 label">No. Tel</label>
                <div class="col-sm-8">
                  <input type="text" name="tt_notel" class="form-control" placeholder="">

                  {!! $errors->first('No. Tel', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <!--Add File Upload - Fira-->
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
                  <div class="col-sm-8" id="file-dropzone" class="dropzone">
                    <span>Drag and drop files here or click to browse</span>
                      <input name="tt_file[]" type="file" multiple />
                  </div>     
                </div>
            </div>

            <!--Add Catatan - Fira-->
            <form class="" method="post" action="{{ route('ssmtatatertib.ssmrequest.storeCatatan') }}" enctype="multipart/form-data">
                @csrf

                <!-- Catatan Section -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-end" style="padding-right: 10%;">
                    <button type="button" class="btn mt-2 mb-2 btn-sm" id="addbtn2" style="background-color: rgb(144, 147, 225);">
                        <i class="bi bi-plus-lg" style="color: white;"></i>
                    </button>
                </div>

                <script>
                    $(document).ready(function() {
                        let refNumber = 1;

                        $('#addbtn2').click(function() {
                            var newRow = `
                                <tr>
                                    <td>
                                        <textarea placeholder="Catatan" class="form-control" name="tt_catatan[]" rows="2"></textarea>
                                    </td>
                                    <td>
                                        <input type="date" name="tt_catatan_date[]" class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger removeCatatanBtn"  style="background-color: #f75f6e; border-color: #f75f6e;">
                                            <i class="bi bi-dash"></i>
                                        </button>
                                    </td>
                                </tr>`;
                            $('#tableprestasi1 tbody').append(newRow);

                            refNumber++;
                        });

                        $(document).on('click', '.removeCatatanBtn', function() {
                            $(this).closest('tr').remove();
                        });
                    });
                </script>

                <!-- Table to display catatan fields -->
                <div style="width: 100%; padding-left: 10%; margin-bottom: 20px;">
                    <table class="table-achiev" id="tableprestasi1" style="width: 90%;">
                        <thead>
                            <tr>
                                <th class="text-center" style="background-color: rgb(144, 147, 225); width: 50%;">Catatan</th>
                                <th class="text-center" style="background-color: rgb(144, 147, 225); width: 30%;">Tarikh Catatan</th>
                                <th class="text-center" style="background-color: rgb(144, 147, 225); width: 20%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <textarea type="text" name="tt_catatan[]" class="form-control" placeholder="Catatan" rows="2"></textarea>
                                </td>
                                <td>
                                    <input type="date" name="tt_catatan_date[]" class="form-control">
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>

          <br>

          <div class="text-center">
              <button type="submit" id="btn" class="btn btn-primary">Hantar</button>
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
        paramName: "tt_file",
        maxFilesize: 2, 
        addRemoveLinks: true,
        init: function () {
            this.on("success", function (file, response) {
                console.log(response);
            });

            this.on("removedfile", function (file) {
                console.log(file);
            });
        },
    };
</script>


