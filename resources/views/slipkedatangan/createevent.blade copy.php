@extends('layouts.app-all')

@section('title', 'Create Event')

@section('content')

<?php
$pagename = "Event";
?>

{{-- @if (count($errors) > 0)
          <div class="alert alert-danger">
            Upload Validation Error<br><br>
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif --}}

<section class="section profile">

  <a href="{{ route('sk.slipkedatangan.indexadmin') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="card pt-3">
    <div class="card-body overflow-auto">

        <h5 class="card-title">Perkara Baru</h5>
        
        <form class="" method="post" action="{{ route('sk.slipkedatangan.storeperkara') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col-lg-4 label d-flex align-items-center" required>Perkara</div>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="label">
                </div>
                @error('label')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="row mb-3">
                <div class="col-lg-4 label d-flex align-items-center">Tarikh Bermula</div>
                <div class="col-lg-8">
                    <input class="form-control" type="datetime-local" name="tarikh_bermula" id="tarikh_bermula">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-lg-4 label d-flex align-items-center">Tarikh Berakhir</div>
                <div class="col-lg-8">
                    <input class="form-control" type="datetime-local" name="tarikh_berakhir" id="tarikh_berakhir">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-lg-4 label d-flex align-items-center">Status</div>
                <div class="col-lg-8">
                    <select name="status" id="status" class="form-control">
                        <option value="">--Pilih Status--</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
          <div class="text-center">
              <button type="submit" class="btn btn-outline-success" >
                  Add
               </button>
          </div>

        </form>
        
    </div>
</div>
  
  <div class="card recent-sales">

    <div class="card-body">
  
        
        
      <div class="profile-overview pt-3">

          {{-- <h5 class="card-title">Perkara Baru</h5>
          <div> --}}
            {{-- <form class="" method="post" action="{{ route('sk.slipkedatangan.storeperkara') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-lg-1 col-form-label">Perkara:</label>
                    <div class="col-lg-3">
                        <input type="text" name="label" class="form-control" placeholder="Perkara">
                            {!! $errors->first('nama', '<p class="help-block text-danger">:message</p>')!!}
                    </div>
                </div>
  
                <div class="row mb-3">
                  <label class="col-lg-1 col-form-label">Status:</label>
                  <div class="col-lg-3">
                      <select name="status" id="status" class="form-control"  >
                          <option value="">---Pilih Status---</option>
                          @foreach ($statuses as $status)
                              <option value="{{ $status }}">{{ $status }}</option>
                          @endforeach
                      </select>
                      
                          {!! $errors->first('status', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
              </div>
  
              <div class="row mb-3">
                  <label for="tarikh_bermula" class="col-lg-1 col-form-label">Tarikh Bermula:</label>
                  <div class="col-lg-3">
                      <input type="datetime-local" name="tarikh_bermula" id="tarikh_bermula" class="form-control">
                      
                          {!! $errors->first('tarikh_bermula', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
              </div>
  
              <div class="row mb-3">
                  <label for="tarikh_berakhir" class="col-lg-1 col-form-label">Tarikh Berakhir:</label>
                  <div class="col-lg-3">
                      <input type="datetime-local" name="tarikh_berakhir" id="tarikh_berakhir" class="form-control">
                      
                          {!! $errors->first('tarikh_berakhir', '<p class="help-block text-danger">:message</p>')!!}
                          
                  </div>
              </div>
              <div >
                  <button type="submit" class="btn btn-outline-success" >
                      Add
                   </button>
              </div>
  
            </form> --}}
          </div>
  
          <div class="card-body overflow-auto">
  
  
                      <table class="table table-borderless datatable mt-3">
                          <thead>
                              <tr>
                                  <th scope="col">Perkara</th>
                                  <th scope="col">Created At</th>
                                  <th scope="col">Action</th>
                              </tr>
                          </thead>
                          <tbody>
  
                             
                          
                          @if(count($skperkaras) == null)
                              <tr class="text-center">
                                  <td colspan="8">
                                      <h5>No records found</h5>
                                  </td>
                              </tr>
  
                          @else
                           @foreach($skperkaras as $skp)   
  
                              <tr>
                                  
                                  <td>{{ $skp->label }}</td>
                                  <td>{{ $skp->created_at }}</td>
                                  <td>
                                      <div class="btn-group gap-2" role="group" aria-label="Basic example"> 
                                          <!----Delete Button----->
                                          <form method="post" onclick="return confirm('Are you sure?')" action="{{ route('sk.slipkedatangan.destroy', $skp->id ) }}">
                                              @csrf
                                              @method('delete')
                                              <button type="submit" class="btn btn-outline-danger" >
                                                  <i class="bi bi-trash-fill"></i>
                                              </button>
                                          </form>
                                      </div>
                                  </td>
  
                              </tr>
                              @endforeach
                              @endif
  
                              
                             
  
                          </tbody>
                      </table>
                      
                  </div>
      </div>
  
    </div>
  
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const yesOption = document.getElementById('yesOption');
        const noOption = document.getElementById('noOption');
        const linkDiv = document.getElementById('linkDiv');

        // Initially hide the div
        linkDiv.style.display = 'none';

        // Show or hide the div based on the selected option
        yesOption.addEventListener('change', function () {
            if (this.checked) {
                linkDiv.style.display = 'block';
            }
        });

        noOption.addEventListener('change', function () {
            if (this.checked) {
                linkDiv.style.display = 'none';
            }
        });
    });
</script>






  
</section>
@endsection