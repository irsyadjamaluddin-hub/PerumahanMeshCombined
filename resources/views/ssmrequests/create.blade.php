@extends('layouts.app-all')

@section('title', 'Borang Permohonan Pengemaskinian SSM')

@section('content')

<?php
$pagename = "SSMSRequest_Admin";
?>

<div class="pagetitle">
  <h1>Borang Permohonan Pengemaskinian SSM</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">Borang Mengaktifkan Akaun SSM</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<!----- Back out Button  ----->
<div class="col-md-1 text-left">
  <a href="{{ route('ssmrequests.ssmrequest.indexall') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 10px;">
  <i class="bi bi-arrow-left-circle"></i>
  </a>
</div> 

<section class="section profile">

  <div class="col-12">
    <div class="card recent-sales">
      <div class="card-body">
        <div class="profile-overview">

          <h3 class="card-title">Borang Permohonan Pengemaskinian SSM<br> <i>SSM Update Request</i></h3>
                <!-- <hr> -->
                
          @csrf

                  <div class="row mb-3">
                  <label for="inputText" class="col-sm-4 col-form-label">Kategori:</label>
                  <div class="col-sm-8">
                    <select name="category" id="categorySelect" class="form-control" required>
                      <option value="">Pilih Kategori</option>
                      <option value="Approval">Approval</option>
                      <option value="Delete Cuti">Delete Cuti</option>
                      <option value="Peranan">Peranan</option>
                      <option value="Password">Reset Password</option>
                      <option value="Others">Others</option>
                    
                    </select>
                    {!! $errors->first('category', '<p class="help-block text-danger">:message</p>') !!}
                  </div>
                </div>

                

                <!-- <div id="otherCategoryInput" style="display: none;">
                <div class="row mb-3">
                  <label for="otherCategory" class="col-sm-4 col-form-label">Other Category:</label>
                  <div class="col-sm-8">
                    <input type="text" name="otherCategory" class="form-control" placeholder="Enter other category">
                  </div>
                  </div>
                </div> -->

              <!-- form 1 : Approval -->

                  <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.storeapproval') }}" enctype="multipart/form-data">
                  @csrf
                    <div id="approval" style="display: none;">

                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Approval Form</h5>
        
                        <div class="row mb-3">
                          <label for="inputText" class="col-sm-4 col-form-label">Name</label>
                          <div class="col-sm-8">
                            <input type="text" name="ap_name" class="form-control" placeholder="Nama penuh">

                            {!! $errors->first('name', '<p class="help-block text-danger">:message</p>')!!}
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="inputText" class="col-sm-4 col-form-label">IC No.</label>
                          <div class="col-sm-8">
                            <input type="text" name="ap_icno" class="form-control" placeholder="Eg. 01000000" pattern="[0-9]{8}">

                            {!! $errors->first('icno', '<p class="help-block text-danger">:message</p>') !!}
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="inputText" class="col-sm-4 col-form-label">Jawatan</label>
                            <div class="col-sm-8">
                              <select name="ap_jawatan" id="jawatan_approval" style="width:100%">
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
                        $('#jawatan_approval').select2({
                            width: '100%',
                            placeholder: "Pilih Jawatan",
                            allowClear: true
                        });
                      </script>

                        <div class="row mb-3">
                          <label for="inputText" class="col-sm-4 col-form-label">Email</label>
                          <div class="col-sm-8">
                            <input type="text" name="ap_email" class="form-control" placeholder="example@moe.gov.bn">

                            {!! $errors->first('telephone', '<p class="help-block text-danger">:message</p>') !!}
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="inputText" class="col-sm-4 col-form-label">Nombor Tel</label>
                          <div class="col-sm-8">
                            <input type="text" name="ap_notel" class="form-control" placeholder="Eg. 8888888" pattern="[0-9]{7}">

                            {!! $errors->first('telephone', '<p class="help-block text-danger">:message</p>') !!}
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="inputText" class="col-sm-4 col-form-label">Tempat Bertugas Sekarang</label>
                          <div class="col-sm-8">
                            <input type="text" name="ap_workplace" class="form-control" placeholder="">

                            {!! $errors->first('Tempat Betugas', '<p class="help-block text-danger">:message</p>') !!}
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="inputText" class="col-sm-4 col-form-label">Approver Name</label>
                          <div class="col-sm-8">
                            <input type="text" name="ap_approvername" class="form-control" placeholder="Nama penuh">

                            {!! $errors->first('approver name', '<p class="help-block text-danger">:message</p>')!!}
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="inputText" class="col-sm-4 col-form-label">Approve IC No.</label>
                          <div class="col-sm-8">
                            <input type="text" name="ap_approvericno" class="form-control" placeholder="Eg. 01000000">

                            {!! $errors->first('approver_ic', '<p class="help-block text-danger">:message</p>') !!}
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="inputText" class="col-sm-4 col-form-label">Catatan:</label>
                          <div class="col-sm-8">
                            <textarea type="text" name="ap_catatan" class="form-control" placeholder="catatan" ></textarea>

                            {!! $errors->first('catatan', '<p class="help-block text-danger">:message</p>') !!}
                          </div>
                        </div>

                        <div class="text-center">
                          <button type="submit" class="btn btn-primary">Hantar</button>
                        </div>

                    </div>

                  </form>

              <!-- end form 1 -->

              <!-- form 2 : Cuti -->

                  <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.storedc') }}" id="myDropzone"   class="dropzone"  enctype="multipart/form-data">
                  @csrf

                    <div id="deletecuti" style="display: none;">

                      <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Delete Cuti Form</h5>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                              <input type="text" name="dc_name" class="form-control" placeholder="Nama penuh">

                              {!! $errors->first('name', '<p class="help-block text-danger">:message</p>')!!}
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">IC No.</label>
                            <div class="col-sm-8">
                              <input type="text" name="dc_icno" class="form-control" placeholder="Eg. 01000000" pattern="[0-9]{8}">

                              {!! $errors->first('IC Number', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                          
                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Jawatan</label>
                              <div class="col-sm-8">
                                <select  name="dc_jawatan" id="jawatan_deletecuti"  style="width:100%">
                                  <option selected disabled></option>
                                  @foreach ($jawatanlist as $key => $value)
                                  <option value="{{ $value }}">
                                      {{ $value }}
                                  </option>
                                  @endforeach
                                </select>
                              </div>
                          </div>
                          <script>
                            $('#jawatan_deletecuti').select2({
                                width: '100%',
                                placeholder: "Pilih Jawatan",
                                allowClear: true
                            });
                          </script>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                              <input type="text" name="dc_email" class="form-control" placeholder="example@moe.gov.bn" >

                              {!! $errors->first('Email', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Nombor Telefon</label>
                            <div class="col-sm-8">
                              <input type="text" name="dc_notel" class="form-control" placeholder="Eg. 8888888" pattern="[0-9]{7}" >

                              {!! $errors->first('telephone', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                      

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Tarikh Cuti(Delete)</label>
                            <div class="col-sm-8">
                              <textarea type="text" name="dc_datedelete" class="form-control" placeholder="" ></textarea>

                              {!! $errors->first('Catatan', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Tarikh Aduan</label>
                            <div class="col-sm-8">
                              <input type="date" name="dc_dateaduan" class="form-control" placeholder="">

                              {!! $errors->first('Tarikh Aduan', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>
                    
                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Catatan</label>
                            <div class="col-sm-8">
                              <textarea type="text" name="dc_catatan" class="form-control" placeholder="catatan" ></textarea>

                              {!! $errors->first('Catatan', '<p class="help-block text-danger">:message</p>') !!}
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
                              <div class="col-sm-8" id="file-dropzone" class="dropzone">
                                 <span>Drag and drop files here or click to browse</span>
                                  <input name="dc_file[]" type="file" multiple />
                              </div>

                                  
                              </div>
                          </div>


                          <div class="text-center">
                              <button type="submit" class="btn btn-primary">Hantar</button>
                          </div>
                    </div>

                  </form>

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

                  
              <!-- end form 2 -->

             <!-- form 3 : Peranan -->

                  <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.storepe') }}" enctype="multipart/form-data">
                  @csrf
                      <div id="peranan" style="display: none;">
                              <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Peranan Form</h5>
                                <div id="peranan-justified">
                                  
                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Name</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="moreDataPe[0][pe_name]" class="form-control" placeholder="Nama penuh">

                                      {!! $errors->first('name', '<p class="help-block text-danger">:message</p>')!!}
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">IC No.</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="moreDataPe[0][pe_icno]" class="form-control" placeholder="Eg. 01000000" pattern="[0-9]{8}">
                                      {!! $errors->first('ic', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>

                                  
                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Jawatan</label>
                                    <div class="col-sm-8">
                                      <select name="moreDataPe[0][pe_jawatan]" id="jawatan_peranan" style="width:100%">
                                        <option selected disabled></option>
                                        @foreach ($jawatanlist as $key => $value)
                                        <option value="{{ $value }}">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <script>
                                    $('#jawatan_peranan').select2({
                                        width: '100%',
                                        placeholder: "Pilih Jawatan",
                                        allowClear: true
                                    });
                                  </script>

                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="moreDataPe[0][pe_email]" class="form-control" placeholder="example@moe.gov.bn">

                                      {!! $errors->first('Emai', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>


                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Nombor Telefon</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="moreDataPe[0][pe_notel]" class="form-control" placeholder="Eg. 8888888" pattern="[0-9]{7}">

                                      {!! $errors->first('telephone', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                      <label for="inputText" class="col-sm-4 col-form-label">Peranan:</label>
                                      <div class="col-sm-8">
                                        <select name="moreDataPe[0][pe_peranan]" id="categorySelect" class="form-control" >
                                          <option value="">Pilih Peranan</option>
                                          <option value="MSS">MSS</option>
                                          <option value="HR ROLE OM">HR ROLE OM</option>
                                          <option value="HR ROLE TM">HR ROLE TM</option>
                                          <option value="HR ROLE AM">HR ROLE AM</option>
                                        
                                        </select>
                                        {!! $errors->first('Peranan', '<p class="help-block text-danger">:message</p>') !!}
                                      </div>
                                    </div>

                                  

                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Catatan</label>
                                    <div class="col-sm-8">
                                      <textarea type="text" name="moreDataPe[0][pe_catatan]" class="form-control" placeholder="catatan" ></textarea>

                                      {!! $errors->first('Catatan', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>  
                                </div>

                                <div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"id="dynamic-row" href="#">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                </div>

                                  <div class="text-center">
                                      <button type="submit" class="btn btn-primary">Hantar</button>
                                  </div>
                      </div>
                    
                  </form>

                  <script type="text/javascript">
                    $(document).ready(function () {
                      var i = 0;

                      $(document).on('click', '#dynamic-row', function () {
                        ++i;
                        $("#peranan-justified").append(
                          '<div id="section_' + i + '" class="peranan-section">' +
                          '<div class="row mb-3"><label class="col-lg-4 col-form-label"><b>Tambahan</label></b></div><br>' +
                          '<div class="row mb-3"><label for="inputText" class="col-sm-4 col-form-label">Name</label><div class="col-sm-8"><input type="text" name="moreDataPe[' + i + '][pe_name]" class="form-control" placeholder="Nama penuh"></div></div>' +
                          '<div class="row mb-3"><label for="inputText" class="col-sm-4 col-form-label">IC No.</label><div class="col-sm-8"><input type="text" name="moreDataPe[' + i + '][pe_icno]" class="form-control" placeholder="Eg. 01000000" pattern="[0-9]{8}"></div></div>' +
                          '<div class="row mb-3"><label for="inputText" class="col-sm-4 col-form-label">Jawatan</label><div class="col-sm-8"><select name="moreDataPe[' + i + '][pe_jawatan]" id="jawatan_peranan_' + i + '" class="form-control" style="width:100%"><option selected disabled></option>@foreach ($jawatanlist as $key => $value)<option value="{{ $value }}">{{ $value }}</option>@endforeach</select></div></div>' +
                          '<div class="row mb-3"><label for="inputText" class="col-sm-4 col-form-label">Email</label><div class="col-sm-8"><input type="text" name="moreDataPe[' + i + '][pe_email]" class="form-control" placeholder="example@moe.gov.bn"></div></div>' +
                          '<div class="row mb-3"><label for="inputText" class="col-sm-4 col-form-label">Nombor Telefon</label><div class="col-sm-8"><input type="text" name="moreDataPe[' + i + '][pe_notel]" class="form-control" placeholder="Eg. 8888888" pattern="[0-9]{7}"></div></div>' +
                          '<div class="row mb-3"><label for="inputText" class="col-sm-4 col-form-label">Peranan:</label><div class="col-sm-8"><select name="moreDataPe[' + i + '][pe_peranan]" id="categorySelect_' + i + '" class="form-control" ><option value="">Pilih Peranan</option><option value="MSS">MSS</option><option value="HR ROLE OM">HR ROLE OM</option><option value="HR ROLE TM">HR ROLE TM</option><option value="HR ROLE AM">HR ROLE AM</option></select></div></div>' +
                          '<div class="row mb-3"><label for="inputText" class="col-sm-4 col-form-label">Catatan</label><div class="col-sm-8"><textarea type="text" name="moreDataPe[' + i + '][pe_catatan]" class="form-control" placeholder="catatan" ></textarea></div></div>' +
                          '<div class="row mb-3 text-center"><div class="text-center mx-auto"><button class="btn btn-danger remove-element" data-id="section_' + i + '"><i class="bi bi-trash-fill"></i></button></div></div>' +
                          '</div>'
                        );

                        // Initialize select2 for the new element
                        $('#jawatan_peranan_' + i).select2({
                          width: '100%',
                          placeholder: "Pilih Jawatan",
                          allowClear: true
                        });
                      });

                      // Remove HTML on button click for dynamically added elements
                      $(document).on("click", ".remove-element", function () {
                        var elementId = $(this).data("id");
                        $("#" + elementId).remove();
                      });
                    });
                  </script>
                      
              <!-- end form 3 -->

              <!-- form 4 : Password -->

                <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.storeps') }}" enctype="multipart/form-data">
                  @csrf
                      <div id="password" style="display: none;">

                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;"> Reset Password Form</h5>

                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Name</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="ps_name" class="form-control" placeholder="Nama penuh">

                                      {!! $errors->first('name', '<p class="help-block text-danger">:message</p>')!!}
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">IC No.</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="ps_icno" class="form-control" placeholder="Eg. 01000000" pattern="[0-9]{8}">

                                      {!! $errors->first('IC Number', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>


                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Jawatan</label>
                                    <div class="col-sm-8">
                                      <select  name="ps_jawatan" id="jawatan_resetpassword"  style="width:100%">
                                        <option selected disabled></option>
                                        @foreach ($jawatanlist as $key => $value)
                                        <option value="{{ $value }}">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <script>
                                    $('#jawatan_resetpassword').select2({
                                        width: '100%',
                                        placeholder: "Pilih Jawatan",
                                        allowClear: true
                                    });
                                  </script>

                                  <div class="row mb-3">
                                      <label for="inputText" class="col-sm-4 col-form-label">Tempat Bertugas Sekarang</label>
                                      <div class="col-sm-8">
                                        <input type="text" name="ps_workplace" class="form-control" placeholder="">

                                        {!! $errors->first('Tempat Bertugas Sekarang', '<p class="help-block text-danger">:message</p>') !!}
                                      </div>
                                    </div>


                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="ps_email" class="form-control" placeholder="example@moe.gov.bn">

                                      {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>


                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Nombor Telefon</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="ps_notel" class="form-control" placeholder="Eg. 8888888">

                                      {!! $errors->first('telephone', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>

                                  
                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Password OTP</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="ps_otp" class="form-control" placeholder="Password OTP">

                                      {!! $errors->first('password otp', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>

                                  

                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Catatan</label>
                                    <div class="col-sm-8">
                                      <textarea type="text" name="ps_catatan" class="form-control" placeholder="catatan" ></textarea>

                                      {!! $errors->first('catatan', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>  

                                  <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Hantar</button>
                                </div>
                      </div>
                </form>
                  
              <!-- end form 4 -->

              <!-- form 5: Lain-Lain -->
                <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.storeot') }}" enctype="multipart/form-data">
                 @csrf
                    <div id="others" style="display: none;">

                      <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Others</h5>

                              <div class="row mb-3">
                                <label for="inputText" class="col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                  <input type="text" name="ot_name" class="form-control" placeholder="Nama penuh">

                                  {!! $errors->first('name', '<p class="help-block text-danger">:message</p>')!!}
                                </div>
                              </div>

                              <div class="row mb-3">
                                <label for="inputText" class="col-sm-4 col-form-label">IC No.</label>
                                <div class="col-sm-8">
                                  <input type="text" name="ot_icno" class="form-control" placeholder="Eg. 01000000" pattern="[0-9]{8}" >

                                  {!! $errors->first('icno', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                              </div>


                         

                              <div class="row mb-3">
                                <label for="inputText" class="col-sm-4 col-form-label">Jawatan</label>
                                <div class="col-sm-8">
                                  <select name="ot_jawatan" id="jawatan_others"  style="width:100%">
                                    <option selected disabled></option>
                                    @foreach ($jawatanlist as $key => $value)
                                    <option value="{{ $value }}">
                                        {{ $value }}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              <script>
                                $('#jawatan_others').select2({
                                    width: '100%',
                                    placeholder: "Pilih Jawatan",
                                    allowClear: true
                                });
                              </script>


                              <div class="row mb-3">
                                  <label for="inputText" class="col-sm-4 col-form-label">Tempat Bertugas Sekarang</label>
                                  <div class="col-sm-8">
                                    <input type="text" name="ot_workplace" class="form-control" placeholder="">

                                    {!! $errors->first('Tempat Bertugas', '<p class="help-block text-danger">:message</p>') !!}
                                  </div>
                                </div>


                              <div class="row mb-3">
                                <label for="inputText" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                  <input type="text" name="ot_email" class="form-control" placeholder="example@moe.gov.bn">

                                  {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                              </div>


                              <div class="row mb-3">
                                <label for="inputText" class="col-sm-4 col-form-label">Nombor Telefon</label>
                                <div class="col-sm-8">
                                  <input type="text" name="ot_notel" class="form-control" placeholder="Eg. 8888888" pattern="[0-9]{7}">

                                  {!! $errors->first('telephone', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                              </div>


                              <div class="row mb-3">
                                <label for="inputText" class="col-sm-4 col-form-label">Catatan</label>
                                <div class="col-sm-8">
                                  <textarea type="text" name="ot_catatan" class="form-control" placeholder="catatan" ></textarea>

                                  {!! $errors->first('catatan', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                              </div> 

                              <div class="text-center">
                                  <button type="submit" class="btn btn-primary">Hantar</button>
                              </div>
                              
                    </div>
                  
                </form>

              <!-- end form 5 -->

               

              
    
    
                

            <br>



        </div>

      </div>


    </div>

  </div>
  </div><!-- End Recent Sales -->

  </div>


<script>
  document.getElementById('categorySelect').addEventListener('change', function () {
      var selectedCategory = this.value;
      var otherCategoryInput = document.getElementById('others');
      var approvalElement = document.getElementById('approval');
      var deleteCutiElement = document.getElementById('deletecuti');
      var perananElement = document.getElementById('peranan');
      var passwordElement = document.getElementById('password');
      var submitButton = document.getElementById('submitButton');

      otherCategoryInput.style.display = 'none';
      approvalElement.style.display = 'none';
      deleteCutiElement.style.display = 'none';
      perananElement.style.display = 'none';
      passwordElement.style.display = 'none';

      if (selectedCategory === 'Others') {
          otherCategoryInput.style.display = 'block';
      } else if (selectedCategory === 'Approval') {
          approvalElement.style.display = 'block';
      } else if (selectedCategory === 'Delete Cuti') {
          deleteCutiElement.style.display = 'block';
      } else if (selectedCategory === 'Peranan') {
          perananElement.style.display = 'block';
      }

      else if (selectedCategory === 'Password') {
          passwordElement.style.display = 'block';
      }
      

      // Enable submit button when a category is selected
      submitButton.disabled = selectedCategory === '';
  });
</script>


<style>
  .select2-container .select2-selection--single {
    height: 36px !important;
    width: 100% !important;
  }

  .select2-results__option:hover {
    background-color: #337ab7; /* Change this to your desired highlight color */
    color: #fff; /* Change this to your desired text color */
}
</style>
@endsection