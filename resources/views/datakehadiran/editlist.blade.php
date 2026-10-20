@extends('layouts.app-all')

@section('title', 'Fokal IC No')

@section('content')

  <?php 
    $pagename = "dkschool";
  ?>

    <div class="pagetitle">
    <h1>Fokal ICNo.</h1>
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Fokal ICNo.</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

    @if(Session::has('success'))
        <div class="alert alert-success">
            <i class=" fas fa-fw fa-check"></i>
            {!! session('success') !!}
        </div>
    @endif

    <div class="col-md-1 text-left">
        <a href="http://127.0.0.1:8000/datakehadiran/indexlist" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem;">
        <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div> 

<section class="section profile">

  <div class="col-md-12">

    @if(Session::has('success_message'))
      <div class="alert alert-success">
          <i class=" fas fa-fw fa-check"></i>
          {!! session('success_message') !!}
      </div>
    @endif

    <!-- ACT Table -->
 
    <div class="card recent-sales">

  <div class="card-body">
  @foreach($dkschools as $dkschool)
    <div class="profile-overview pt-3">
    <form class="" method="post" action="{{ route('datakehadiran.datakehadiran.storeicnumber',['id' => $dkschool->id]) }}" enctype="multipart/form-data" id="dkschools_form">
            @csrf
                <input type="text" name="id" class="bg-gray-200 form-control " value="{{$dkschool->id}}" hidden>
            @endforeach


            <br>      
            <br>

            <div class="row">
                <label class="col-lg-2 col-form-label">Sekolah/Institusi:</label> 
                <div class="col-lg-9">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input class="form-control" value ="{{ $dkschool->schools }}" type="text" name="schools">    
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">

                <label for="inputic_no" class="col-lg-1 col-form-label">IC No:</label> 
                <div class="col-lg-9">
                    <div id="icno-input-container">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input class="form-control dkschool-icno-input" placeholder ="IC Number" type="text" name="icno[]">    
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary add-icno-input">Add IC Number</button>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <br>
                <br>
                <br>
                
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Fokal {{$dkschool->schools}}</h5>
              
      
                 <table class="table table-bordered">
                 <table class="table text-center">
                    <thead>
                        <tr>
                            <th>IC Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
    $icnoData = json_decode($dkschool->icno);
@endphp

@if(is_array($icnoData) && count($icnoData) > 0)
    @foreach($icnoData as $index => $icno)
        <tr>
            <td>{{ $icno }}</td>
            <td>
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="remove_icno[]" id="remove_icno_checkbox_{{ $index }}" value="{{ $index }}" class="form-check-input">
                    <label for="remove_icno_checkbox_{{ $index }}" class="form-check-label remove-icno-label" title="Check to remove chosen IC Number">Remove IC Number<span class="required-symbol">*</span></label>
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="2">No IC Numbers available.</td>
    </tr>
@endif



                    </tbody>
                </table>

                 <!-- end ic_no -->


                <script>
                    var submitButton = document.getElementById('submit-button');
                    var form = document.getElementById('dkschools_form');
                    
                    form.addEventListener('submit', function(event) {
                        if (this.getAttribute('data-submitted') !== null) {
                            event.preventDefault();
                        } else {                    
                            submitButton.disabled = true;
                            submitButton.innerText = 'Di Hantar...'; // Optional: Change the button text to indicate submission
                            this.setAttribute('data-submitted', 'true');
                        }
                    });

                    $(document).ready(function() {
                        // Add new file input field when the "Add" button is clicked
                        $(document).on("click", ".add-icno-input", function() {
                            var icnoInputContainer = $(this).closest("#icno-input-container"); // Get the closest file input container
                            var clonedIcnoInput = icnoInputContainer.find(".dkschool-icno-input").first().clone(); // Clone the first file input field
                            var removeButton = "<button type='button' class='btn btn-primary remove-icno-input'>Remove</button>"; // Create the remove button
                            var newRow = $("<div class='row mb-3'><div class='col-md-6'>" + clonedIcnoInput[0].outerHTML + "</div><div class='col-md-6'>" + removeButton + "</div></div>"); // Create the new row with the cloned file input and remove button
                            newRow.appendTo(icnoInputContainer); // Append the new row to the file input container
                        });

                        // Remove file input field when the "Remove" button is clicked
                        $(document).on("click", ".remove-icno-input", function() {
                            $(this).closest(".row.mb-3").remove(); // Remove the closest file input container
                        });
                    });
                </script>


            <br>

            <div class="form-group row justify-content-center">
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-outline-success">
                        Update
                    </button>
                </div>
            </div>

            </div>
        </form>
  </div>

 

  </div>

</section>

@endsection