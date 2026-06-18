@extends('layouts.app-all')

@section('title', 'Create')

@section('content')

<?php
$pagename = "Jawatankosong";
?>

<div class="pagetitle">
    
    <a href="{{ back()->getTargetUrl() }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>
    
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">


                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Jawatan Kosong</h5>


                    <form class="" method="post" action="{{ route('jawatankosong.jawatankosong.storecreate') }}" enctype="multipart/form-data">
                        @csrf

                        @foreach($employment as $employment)
                        <input type="text" name="dept_id" class="bg-gray-200 form-control " value="{{ optional($employment->department)->id }}"hidden>
                        @endforeach

                      
                        <div class="container">
                            

                            <div id="dataContainer">
                                <!-- Data rows will be added here -->
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn2" href="#">
                          Add Data
                            </button>
                            
                        </div>
                            </div>

                       
                        </div>
                                                
                       <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include other necessary JS libraries here (e.g., Bootstrap) -->

<script type="text/javascript">
    $(document).ready(function () {
        $('#addbtn2').off().on('click', function () {
            var html = '';

            // Create a new data entry container
            html += '<div class="data-entry mb-3">';
            
            // Add rows with formatted data
            html += '<div class="row mb-2">';
            html += '<div class="col-md-3 label">Jawatan</div>';
            html += '<div class="col-md-9"><input type="text" name="jawatan[]" placeholder="Jawatan" class="form-control"></div>';
            html += '</div>';

            html += '<div class="row mb-2">';
            html += '<div class="col-md-3 label">Tanggagaji</div>';
            html += '<div class="col-md-9"><select class="form-control" name="tanggagaji[]"><option value="">Pilih</option>@foreach ($tanggagaji as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach</select></div>';
            html += '</div>';

            html += '<div class="row mb-2">';
            html += '<div class="col-md-3 label">Bahagian</div>';
            html += '<div class="col-md-9"><select class="form-control" name="bhg[]"><option value="">Pilih</option>@foreach ($bahagian as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach</select></div>';
            html += '</div>';

            html += '<div class="row mb-2">';
            html += '<div class="col-md-3 label">Jumlah Kekosongan</div>';
            html += '<div class="col-md-9"><input type="number" name="jum_kosong[]" placeholder="Jumlah Kekosongan" class="form-control"></div>';
            html += '</div>';

            html += '<div class="row mb-2">';
            html += '<div class="col-md-3 label">Catatan</div>';
            html += '<div class="col-md-9"><textarea placeholder="Catatan" name="catatan[]" class="form-control"></textarea></div>';
            html += '</div>';


            html += '<div class="row">';
            html += '<div class="col-md-12"><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button">Remove</button></div>';
            html += '</div>';

            // Close the data entry container
            html += '</div>';

            $('#dataContainer').append(html);
        });

        $(document).on('click', '.removeDeclare', function () {
            // Remove the entire parent container of the data entry
            $(this).parents('.data-entry').remove();
        });
    });
</script>




                </div>
              </div>

            <br>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>


  </div>
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



@endsection