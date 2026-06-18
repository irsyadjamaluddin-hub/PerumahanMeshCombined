@extends('layouts.app-all')

@section('title', 'Show Registered User')

@section('content')

<?php
$pagename = "prestasi";
?>

@if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
@endif

<section class="section profile">

  <a href="{{ route('moeevent.moeevent.indexadmin') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 10px;">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">
      <div class="card-body">
     
        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Edit registed user</h5><br>

          <form id="updateuserform" method="post" action="{{ route('moeevent.moeevent.updateregistereduser', $moeevent->first()->id ) }}">
            @csrf
            @foreach ($moeevent as $moeevent)                      
                <div class="row">
                    <div class="col-lg-4 label">Nama</div>
                    <div class="col-lg-8">
                        <input type="text" name="nama" class="form-control"  value="{{$moeevent->nama}}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 label">IC No.</div>
                    <div class="col-lg-8">
                        <input type="text" name="icno" class="form-control"  value=" {{$moeevent->icno}}">
                    </div>
                </div>

                
              <div class="row">
                <div class="col-lg-4 label">Jabatan</div>
                <div class="col-lg-8">
                  <input type="text" name="jabatan" class="form-control" value="{{$moeevent->jabatan}}" readonly>
                </div>
              </div>


        

              <div class="row">
                <div class="col-lg-4 label">Jawatan</div>
                <div class="col-lg-8">
                  <select id="jawatan_dept" class="form-select" name="jawatan" aria-label="Default select example" id="myselectjawatan">
                                <option selected hidden>Pilih Jawatan</option>
                                @foreach ($jawatanlist as $key => $value)
                                    <option value="{{ $value }}" {{ $moeevent->jawatan == $value ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>             
                </div>
              </div>

               <script>
            $('#jawatan_dept').select2({
                width: '100%',
                placeholder: "Pilih Jabatan",
                allowClear: true
            });
          </script>
               

            


              <div class="row mb-3">
                <label class="col-lg-4 label">Gender</label>
                <div class="col-lg-8">
                    <select class="form-select" name="gender" aria-label="Default select example">
                        <option selected hidden>{{$moeevent->gender}}</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">No Tel.</div>
                <div class="col-lg-8">
                  <input type="text" name="no_tel" class="form-control" value="{{$moeevent->no_tel}}">             
                </div>
              </div>

              
              <div class="row">
                <div class="col-lg-4 label">Email</div>
                <div class="col-lg-8">
                  <input type="text" name="email" class="form-control" value="{{$moeevent->email}}">             
                </div>
              </div>

                            
              <div class="row">
                <div class="col-lg-4 label">Status</div>
                <div class="col-lg-8">
                  <input type="text"  class="form-control" value="{{$moeevent->status}}" readonly>             
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Created At</div>
                <div class="col-lg-8">
                  <input type="text"  class="form-control" value="{{$moeevent->created_at}}" readonly>             
                </div>
              </div>
            @endforeach

            <br>

            <div class="text-center">
              <button id="submit-button" type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

  
</section>
@endsection

{{-- Disable button when Submitting --}}
<script>
  var submitButton = document.getElementById('submit-button');
  var form = document.getElementById('updateuserform');
  
  form.addEventListener('submit', function(event) {
      if (this.getAttribute('data-submitted') !== null) {
          event.preventDefault();
      } else {
          submitButton.disabled = true;
          submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
          this.setAttribute('data-submitted', 'true');
      }
  });
</script>



<script>
    $('#myselectjawatan').select2({
      width: '100%',
      placeholder: "",
      allowClear: true
    });
  </script>
