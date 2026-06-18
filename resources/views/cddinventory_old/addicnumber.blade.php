@extends('layouts.app-all')

@section('title', 'BP Add ICNo')

@section('content')

  <?php 
    $pagename = "Inventory";
  ?>

    <div class="pagetitle">
    <h1>Inventory</h1>
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Inventory</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

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
  @foreach($inventory as $inventory)
    <div class="profile-overview pt-3">
    <form class="" method="post" action="{{ route('cddinventory.cddinventory.storeicnumber',['id' => $inventory->id]) }}" enctype="multipart/form-data" id="inventorys_form">
            @csrf
                <input type="text" name="id" class="bg-gray-200 form-control " value="{{$inventory->id}}" hidden>
            @endforeach


            <br>      
            <br>

            <div class="row mb-3">
                <label for="inputic_no" class="col-lg-1 col-form-label">IC No:</label> 
                <div class="col-lg-9">
                <div id="icno-input-container">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input class="form-control inventory-icno-input" placeholder ="IC Number" type="text" name="bp_icno[]">    
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
                
                  <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Senarai</h5>
              
      
                 <table class="table table-bordered">
                 <table class="table text-center">
                    <thead>
                        <tr>
                            <th>IC Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
               @if(is_array($inventory->bp_icno) || is_object($inventory->bp_icno))
                @foreach($inventory->bp_icno as $index => $bp_icno)
                    <tr>
                        <td>{{ $bp_icno }}</td>
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
                    var form = document.getElementById('inventorys_form');
                    
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
                            var clonedIcnoInput = icnoInputContainer.find(".inventory-icno-input").first().clone(); // Clone the first file input field
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