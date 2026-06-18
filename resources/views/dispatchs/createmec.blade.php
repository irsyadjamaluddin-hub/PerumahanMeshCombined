@extends('layouts.app-all')

@section('title', 'Create MEC')

@section('content')

<?php
$pagename = "MEC";
?>

<section class="section profile">

  <a href="{{ route('dispatchs.dis.indextindakan') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>


  <div class="col-12">
    <div class="card pt-3">

      <div class="card-body">

          <form class="" method="post" action="{{ route('dispatchs.dis.storemec') }}" enctype="multipart/form-data">
            @csrf

            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Maklumat Persuratan</h5>
<br>

              <div class="row">
                <label class="col-lg-4 label">Jenis</label>
                <div class="col-lg-8">
                  <select class="form-select" name="jns" aria-label="Default select example">
                    <option></option>
                    @foreach ($jenis as $key => $value)
                    <option value="{{ $key }}">
                      {{ $value }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="row">
                <label class="col-lg-4 label">Daripada</label>
                <div class="col-lg-8">
                  @foreach($employments as $employment)
                
                <input type="text" class="bg-gray-200 form-control" name="daripada" value="{{ optional($employment->department)->label }}" readonly>
                <input type="hidden" name="daripada" class="bg-gray-200 form-control" value="{{ $employment->department_id }}" hidden>
                @endforeach
                </div>
              </div>

              <div class="row">
                <label for="inputText" class="col-lg-4 label">Daripada Persuratan Luar</label>
                <div class="col-lg-8">
                  <input type="text" name="dpl" class="form-control">
                </div>
              </div>

              <div class="row">
              <div class="col-lg-4 label">Kepada <i style="color:red;">*</i></div>
                <div class="col-lg-8">
                   <select class="form-control select2" id="myselect" data-select2-id="myselect" multiple="multiple" name="kpd[]" tabindex="-1" aria-hidden="true" required>
                    <option></option>
                    @foreach ($kepada as $key => $value)
                    <option value="{{ $key }}">
                      {{ $value }}
                    </option>
                    @endforeach
                  </select>
                  {!! $errors->first('kepada', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>


              <div class="row">
                <label for="inputText" class="col-lg-4 label">Untuk Perhatian</label>
                <div class="col-lg-8">
                  <input type="text" name="up" class="form-control">
                </div>
              </div>

              <div class="row">
              <label for="inputText" class="col-lg-4 label">Perkara</label>
                <div class="col-lg-8">
                  <input type="text" name="perkara" class="form-control">
                </div>
              </div>

              <!-- Tuan AO & Tuan Hj Akbar Requested this fields to be off 16/10/23 -->

          <!--     <div class="row">
                <label for="inputText" class="col-lg-4 label">Rujukan Persuratan</label>
                <div class="col-lg-8">
                  <input type="text" name="rp" class="form-control">
                </div>
              </div> -->

              <div class="row">
                <label for="inputText" class="col-lg-4 label">Rujukan Tuan/Puan</label>
                <div class="col-lg-8">
                  <input type="text" name="rm" class="form-control">
                </div>
              </div>

            
                 <!-- multiple file uploads 04/09/2023 -->

                <div class="row form-group mb-3">
                <label for="inputText" class="col-lg-4 label">Muat Naik Dokumen</label>
                <div class="col-lg-8">
                  <div class="row" id="file-input-container">
                    <div class="col-lg-4">
                      <input class="form-control pdf-file-input" type="file" name="lamp[]" >
                    </div>
                    <div class="col-lg-4">
                      <button type="button" class="btn btn-primary add-file-input">Add Document</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <label for="inputText" class="col-lg-4 label">Catatan</label>
                <div class="col-lg-8">
                  <textarea class="form-control" name="catt" placeholder="Sebarang Ulasan" id="floatingTextarea" style="height: 100px;"></textarea>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Salinan</div>
                  <div class="col-lg-8">
                      <select class="form-control select2" id="myselect" data-select2-id="myselect" multiple="multiple" name="salinankpd[]" tabindex="-1" aria-hidden="true">
                      <option></option>
                      @foreach ($kepada as $key => $value)
                      <option value="{{ $key }}">
                        {{ $value }}
                      </option>
                      @endforeach
                    </select>
                    {!! $errors->first('salinankpd', '<p class="help-block text-danger">:message</p>') !!}
                  </div>
              </div>

              
              <div class="row">
                <label for="inputText" class="col-lg-4 label">Salinan Persuratan Luar</label>
                <div class="col-lg-8">
                  <input type="text" name="spl" class="form-control">
                </div>
              </div>

              <div class="row form-group mb-3">
                <label for="inputText" class="col-lg-4 label">Muat Naik Dokumen Persuratan Luar</label>
                <div class="col-lg-8">
                  <div class="row" id="lampfile-input-container">
                    <div class="col-lg-4">
                      <input class="form-control pdf-lampfile-input" type="file" name="lamp1[]" >
                    </div>
                    <div class="col-lg-4">
                      <button type="button" class="btn btn-primary add-lampfile-input">Add Persuratan Luar</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>

        <br>

        <!-- second box -->

        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Maklumat Tindakan</h5>
<br>



          <div class="row">
            <label for="inputText" class="col-lg-4 label">No. Rujukan<i style="color:red;">*</i></label>
            <div class="col-lg-8">
              <input type="text" name="no_folio" class="form-control" required>
            </div>
          </div>

          <div class="row">
            <label for="inputText" class="col-lg-4 label">Catatan</label>
            <div class="col-lg-8">
              <textarea class="form-control" name="catatan_admin" placeholder="Sebarang Ulasan" id="floatingTextarea" style="height: 100px;"></textarea>
            </div>
          </div>


          <div class="row">
            <label class="col-lg-4 label">Tindakan</label>
            <div class="col-lg-8">
                <select class="form-control select2" id="myselect" data-select2-id="myselect" multiple="multiple" name="tindakan[]" tabindex="-1" aria-hidden="true">  
                    @foreach ($tindakan as $key => $value)
                        <option value="{{ $key }}">
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
                {!! $errors->first('tindakan', '<p class="help-block text-danger">:message</p>') !!}
            </div>
          </div>


        </div>

        <!-- take hidden ic_no so that easy to identify data belong/from who -->

        <input type="text" name="ic_no" class="bg-gray-200 form-control" value="{{Auth::user()->ic_no}}" hidden>

        <br>

        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>

      </form>

  </div>
  </div>
  </div>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $('#myselect1').select2({
      width: '100%',
      placeholder: "",
      allowClear: true
    });
  </script>

  <script>
    $('#myselect2').select2({
      width: '100%',
      placeholder: "",
      allowClear: true
    });
  </script>

<script>
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
    });
  </script>


  <script>
  
   $(document).ready(function(){

       // Initialize select2
       $("#myselection").select2();

       // Read selected option
       $('#but_read').click(function(){
       var username = $('#myselection option:selected').text();
       var userid = $('#myselection').val();

       $('#result').html("id : " + userid + ", name : " + username);

       });
       });
</script>

<script>
            var submitButton = document.getElementById('submit-button');
            var form = document.getElementById('mecmedfile_form');
            
           

            var form = document.getElementById('pdf_form');

            $(document).ready(function() {
                // Add new file input field when the "Add" button is clicked
                $(document).on("click", ".add-file-input", function() {
                    var fileInputContainer = $(this).closest("#file-input-container"); // Get the closest file input container
                    var clonedFileInput = fileInputContainer.find(".pdf-file-input").first().clone(); // Clone the first file input field
                    var removeButton = "<button type='button' class='btn btn-primary remove-file-input'>Remove</button>"; // Create the remove button
                    var newRow = $("<div class='row mb-3'><div class='col-md-6'>" + clonedFileInput[0].outerHTML + "</div><div class='col-md-6'>" + removeButton + "</div></div>"); // Create the new row with the cloned file input and remove button
                    newRow.appendTo(fileInputContainer); // Append the new row to the file input container
                });

                // Remove file input field when the "Remove" button is clicked
                $(document).on("click", ".remove-file-input", function() {
                    $(this).closest(".row.mb-3").remove(); // Remove the closest file input container
                });
            });

            $(document).ready(function() {
                // Add new file input field when the "Add" button is clicked
                $(document).on("click", ".add-lampfile-input", function() {
                    var fileInputContainer = $(this).closest("#lampfile-input-container"); // Get the closest file input container
                    var clonedFileInput = fileInputContainer.find(".pdf-lampfile-input").first().clone(); // Clone the first file input field
                    var removeButton = "<button type='button' class='btn btn-primary remove-lampfile-input'>Remove</button>"; // Create the remove button
                    var newRow = $("<div class='row mb-3'><div class='col-md-6'>" + clonedFileInput[0].outerHTML + "</div><div class='col-md-6'>" + removeButton + "</div></div>"); // Create the new row with the cloned file input and remove button
                    newRow.appendTo(fileInputContainer); // Append the new row to the file input container
                });

                // Remove file input field when the "Remove" button is clicked
                $(document).on("click", ".remove-lampfile-input", function() {
                    $(this).closest(".row.mb-3").remove(); // Remove the closest file input container
                });
            });
        </script>

</section>
@endsection