@extends('layouts.app-all')

@section('title', 'Edit Prestasi')

@section('content')

<?php
$pagename = "prestasi";
?>


 <style>
    .hidden-div {
        display: none;
    }
</style>

<section class="section profile">

  <a href="{{ route('prestasi.prestasi.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">

      <div class="card-body">
      @foreach ($prestasi as $prestasi)

      <form class="" method="post" action="{{ route('prestasi.prestasi.update',$prestasi->id) }}"  id="prestasi_form"  enctype="multipart/form-data">
          @csrf

          <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Edit Prestasi</h5><br>

              @foreach($biodatas as $biodata)

                 <!--  in order the data updated on the indexdept this is needed -->
                 <input type="text" name="id" class="bg-gray-200 form-control " value="{{$prestasi->id}}" hidden>
                     

               <div class="row hidden-div">
                    <div class="col-lg-4 label">Nama</div>
                    <div class="col-lg-8">
                        <input type="text" class="bg-gray-200 form-control" name="nama" value="{{$biodata->name}}" readonly>
                    </div>
                </div>

               <div class="row hidden-div">
                    <div class="col-lg-4 label">No. Kad Pengenalan</div>
                    <div class="col-lg-8">
                        <input type="text" class="bg-gray-200 form-control" name="ic_no" value="{{$biodata->ic_no}}" readonly>
                    </div>
                </div>

                @endforeach


                @foreach ($contacts as $contact)

               <div class="row hidden-div">
                    <div class="col-lg-4 label">No. Tel</div>
                    <div class="col-lg-8">
                        <input type="text" class="bg-gray-200 form-control" name="telephone_mobile" value="{{$contact->telephone_mobile}}" readonly>
                    </div>
                </div>

                @endforeach


            <div class="row">
                <label class="col-lg-4 label">Jabatan</label>
                <div class="col-lg-8">
                @foreach($employments as $employment)
                <input type="text" class="bg-gray-200 form-control" name="jabatan" value="{{ optional($employment->department)->label }}" readonly>
                <input type="hidden" name="jabatan" class="bg-gray-200 form-control" value="{{ $employment->department_id }}" hidden>
                @endforeach
                </div>
            </div>

              <div class="row">
                <div class="col-lg-4 label">Perkara</div>
                <div class="col-lg-8">
                  <input type="text" name="perkara" class="bg-gray-200 form-control" value="{{$prestasi->perkara}}" readonly>
                  {!! $errors->first('perkara', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

         


              
              
        <div class="row">
            <div class="col-lg-4 label">Muat Naik Dokumen<br><i style="color:red;">*Saiz maksimum bagi setiap fail: 2MB dalam pdf format sahaja</i></div>
            <div class="col-lg-8">
                  <div class="row" id="file-input-container">
                    <div class="col-lg-4">
                      <input class="form-control pdf-file-input"  id="file" type="file" name="file[]" multiple>
                    </div>
                    <div class="col-lg-4">
                      <button type="button" class="btn btn-primary add-file-input">Add</button>
                    </div>
                        <!-- Display Current Files -->
                        @if($prestasi->file)
                            @foreach($prestasi->file as $index => $filename)
                            <div class="row">
                              <div class="col-md-6">
                                 <p id="margin-bottombegone">View current files: <a href="{{ url('storage/prestasi/' . $filename) }}" target="_blank">{{ basename($filename) }}</a></p>

                              </div>
                              <div class="col-md-6">
                                <div class="form-check" style="margin-bottom: 1rem;">
                                  <input type="checkbox" name="remove_file[]" id="remove_file_checkbox_{{ $index }}" value="{{ $index }}" class="form-check-input">
                                  <label for="remove_file_checkbox_{{ $index }}" class="remove-file-label" title="Check to remove chosen file">Remove file<span class="required-symbol">*</span></label>
                                </div>
                              </div>
                            </div>
                            @endforeach
                            
                        @else
                        <p>No file chosen</p>
                        @endif
                  </div>
                </div>
        </div>


        <div class="row">
                <div class="col-lg-4 label">Tarikh</div>
                <div class="col-lg-8">
                  <input type="text"  class="bg-gray-200 form-control" value="{{ $prestasi->created_at }}" readonly>
                
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Catatan<br></div>
                <div class="col-lg-8">
                  <textarea class="form-control" name="catatan" placeholder="Sebarang Ulasan" id="floatingTextarea" style="height: 100px;">{{$prestasi->catatan}}</textarea>
                  {!! $errors->first('catatan', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

               


              <div class="row">
                <div class="col-lg-4 label">Catatan Admin<br></div>
                <div class="col-lg-8">
                  <textarea class="form-control"  id="floatingTextarea" style="height: 100px;" readonly>{{$prestasi->catatanadmin}}</textarea>
                </div>
              </div>
              
              @endforeach

             
        <br>

        <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>

  </div>
  </div>
  </div>



        <script>
            var submitButton = document.getElementById('submit-button');
            var form = document.getElementById('prestasi_form');
            
           

            var form = document.getElementById('pdf_form');

            $(document).ready(function() {
                // Add new file input field when the "Add" button is clicked
                $(document).on("click", ".add-file-input", function() {
                    var fileInputContainer = $(this).closest("#file-input-container"); // Get the closest file input container
                    var clonedFileInput = fileInputContainer.find(".pdf-file-input").first().clone(); // Clone the first file input field
                    var removeButton = "<button type='button' class='btn btn-primary remove-file-input'>Remove</button>"; // Create the remove button
                    var newRow = $("<div class='row mb-4'><div class='col-md-6'>" + clonedFileInput[0].outerHTML + "</div><div class='col-md-6'>" + removeButton + "</div></div>"); // Create the new row with the cloned file input and remove button
                    newRow.appendTo(fileInputContainer); // Append the new row to the file input container
                });

                    // Remove file input field when the "Remove" button is clicked
          $(document).on("click", ".remove-file-input", function() {
              $(this).parent().remove(); // Remove the parent column containing the input and remove button
          });
            });

      
        </script>


     


</section>
@endsection