@extends('layouts.app-all')

@section('title', 'Edit MED')

@section('content')

<?php
$pagename = "MED";
?>

<section class="section profile">

  <a href="{{ route('dispatchs.dis.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">

      <div class="card-body">

         @foreach ($dispatchs as $dispatch)

        <form class="" method="post" action="{{ route('dispatchs.dis.update',$dispatch->id) }}" enctype="multipart/form-data">
          @csrf

          <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Edit MED</h5>
<br>
             

              <input type="text" name="id" class="bg-gray-200 form-control " value="{{$dispatch->id}}" hidden>

              <div class="row">
                <div class="col-lg-4 label">Jenis</div>
                <div class="col-lg-8">
                  <select class="form-select" name="jns">
                    <option value="{{ $dispatch->jns }}">{{optional($dispatch->jenis)->label }}</option>
                    @foreach ($jenis as $key => $value)
                    <option value="{{ $key }}">
                      {{ $value }}
                    </option>
                    @endforeach
                  </select>
                  {!! $errors->first('jns', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Daripada</div>
                <div class="col-lg-8">
                  <select class="form-select" name="daripada">
                    <option value="{{ $dispatch->daripada}}">{{optional($dispatch->Daripada)->label }}</option>
                    @foreach ($daripada as $key => $value)
                    <option value="{{ $key }}">
                      {{ $value }}
                    </option>
                    @endforeach
                  </select>
                  {!! $errors->first('daripada', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Dari Persuratan Luar</div>
                <div class="col-lg-8">
                  <input type="text" name="dpl" class="bg-gray-200 form-control" value="{{$dispatch->dpl}}">
                  {!! $errors->first('Dari Persuratan Luar', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>


              <?php
                    $K = json_decode($dispatch->kpd);  
              ?>

              <div class="row">
                <div class="col-lg-4 label">Kepada</div>
                  <div class="col-lg-8">
                   
                    <select class=" form-control select2"  id="myselect" data-select2-id="myselect" name="kpd[]" multiple="multiple" tabindex="-1" aria-hidden="true" >


                    @foreach ($kepada as $key => $value)

                    @if(in_array($key, $K))
                    <option value="{{ $key }}" selected>

                    @else
                    <option value="{{ $key }}">

                    @endif

                    {{ $value }}
                    </option>

                    @endforeach
            
                    </select>
                    {!! $errors->first('kpd', '<p class="help-block text-danger">:message</p>') !!}
                  </div>
              </div>

    
              <script>
                $(document).ready(function() {
                  $('.js-example-basic-multiple').select2();
                });
              </script>


              <div class="row">
                <label class="col-lg-4 label">Untuk Perhatian</label>
                <div class="col-lg-8">
                  <select class="form-select" name="up">

                    <option value="{{optional($dispatch->Untukperhatian)->kod}}">{{optional($dispatch->Untukperhatian)->kod}}</option>
                    @foreach ($untukperhatians as $key => $value)
                    <option value="{{ $key }}">
                      {{ $value }}
                    </option>
                    @endforeach

                  </select>                  
                  {!! $errors->first('up', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Perkara</div>
                <div class="col-lg-8">
                  <input type="text" name="perkara" class="bg-gray-200 form-control" value="{{$dispatch->perkara}}">
                  {!! $errors->first('perkara', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Rujukan Persuratan</div>
                <div class="col-lg-8">
                  <input type="text" name="rp" class="bg-gray-200 form-control" value="{{$dispatch->rp}}">
                  {!! $errors->first('rp', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Rujukan Tuan/Puan</div>
                <div class="col-lg-8">
                  <input type="text" name="rm" class="bg-gray-200 form-control" value="{{$dispatch->rm}}">
                  {!! $errors->first('rm', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <!-- Start Multiple Upload -->

              <div class="row form-group mb-3">
                <label for="inputText" class="col-lg-4 label">Muat Naik Dokumen</label>
                <div class="col-lg-8">
                  <div class="row" id="file-input-container">
                    <div class="col-lg-4">
                      <input class="form-control mecmed-file-input"  id="file" type="file" name="lamp[]" multiple>
                    </div>
                    <div class="col-lg-4">
                      <button type="button" class="btn btn-primary add-file-input">Add</button>
                    </div>
                        <!-- Display Current Files -->
                        @if($dispatch->lamp)
                            @foreach($dispatch->lamp as $index => $filename)
                            <div class="row">
                              <div class="col-md-6">
                                <p id="margin-bottombegone">View current files: <a href="{{ Storage::url($filename) }}" target="_blank">{{ basename($filename) }}</a></p>


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

                <!-- End Multiple Upload -->


              <div class="row">
                <div class="col-lg-4 label">Catatan<br></div>
                <div class="col-lg-8">
                  <textarea class="form-control" name="catt" placeholder="Sebarang Ulasan" id="floatingTextarea" style="height: 100px;">{{$dispatch->catt}}</textarea>
                  {!! $errors->first('catt', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>


            <?php
                $sk = [];
                if ($dispatch->salinankpd) {
                    $decoded = json_decode($dispatch->salinankpd);
                    if ($decoded !== null) {
                        $sk = $decoded;
                    } else {
                        // Handle the error, such as logging or displaying an error message.
                    }
                }
                ?>

              <div class="row">
                <div class="col-lg-4 label">Salinan</div>
                  <div class="col-lg-8">
                   
                    <select class=" form-control select2"  id="myselect" data-select2-id="myselect" name="salinankpd[]" multiple="multiple" tabindex="-1" aria-hidden="true" >


                    @foreach ($kepada as $key => $value)

                    @if(in_array($key, $sk))
                    <option value="{{ $key }}" selected>

                    @else
                    <option value="{{ $key }}">

                    @endif

                    {{ $value }}
                    </option>

                    @endforeach
            
                    </select>
                    {!! $errors->first('salinankpd', '<p class="help-block text-danger">:message</p>') !!}
                  </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Surat Persuratan Luar</div>
                <div class="col-lg-8">
                  <input type="text" name="spl" class="bg-gray-200 form-control" value="{{$dispatch->spl}}">
                  {!! $errors->first('surat persuratan luar', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

               <!-- Start salinan dokumen Multiple Upload -->

              <div class="row form-group mb-3">
                <label for="inputText" class="col-lg-4 label">Muat Naik Dokumen Persuratan Luar</label>
                <div class="col-lg-8">
                  <div class="row" id="file-input-container">
                    <div class="col-lg-4">
                      <input class="form-control mecmed-file-input"  id="file" type="file" name="lamp1[]" multiple>
                    </div>
                    <div class="col-lg-4">
                      <button type="button" class="btn btn-primary add-file-input">Add</button>
                    </div>
                        <!-- Display Current Files -->
                        @if($dispatch->lamp1)
                            @foreach($dispatch->lamp1 as $index => $filename)
                            <div class="row">
                              <div class="col-md-6">
                                <p id="margin-bottombegone">View current files: <a href="{{ Storage::url($dispatch->lamp1[$index]) }}" target="_blank">{{ basename($filename) }}</a></p>


                              </div>
                              <div class="col-md-6">
                                <div class="form-check" style="margin-bottom: 1rem;">
                                  <input type="checkbox" name="remove_file1[]" id="remove_file_checkbox_{{ $index }}" value="{{ $index }}" class="form-check-input">
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

           
                <!-- End dokumen Multiple Upload -->

              @endforeach

          </div>
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