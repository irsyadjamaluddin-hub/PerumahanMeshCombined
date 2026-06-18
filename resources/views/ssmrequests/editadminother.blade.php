@extends('layouts.app-all')

@section('title', 'Admin Edit SSM Request')

@section('content')

<?php
$pagename = "Admin_Edit_SSMRequest";
?>

<div class="pagetitle">
    <h1>Edit SSM Request</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">User</li>
            <li class="breadcrumb-item active">Edit SSM Request</li>
        </ol>
    </nav>
</div>

<section class="section profile">

<div class="col-12">
        <div class="card recent-sales">
            <div class="card-body">
            <!-- <h3 class="card-title">Mengaktifkan Akaun SSM<br> <i>SSM Activation</i></h3> -->
    <div class="profile-overview">
        <h3 class="card-title"></h3>

        @foreach($ssmother as $ssmother)

        <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.updateadminother') }}" enctype="multipart/form-data">
            @csrf

            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Others Form</h5>


            <input type="text" name="id" class="form-control" value="{{$ssmother->id}}" hidden>

            
                <div class="row mb-3">
                    <div class="col-sm-4 label">Nombor Rujukan:</div>
                    <div class="col-sm-8">
                        <input type="text" name="id" value="LL{{$ssmother->id}}" class="form-control" disabled>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <div class="col-sm-4 label">Name</div>
                    <div class="col-sm-8">
                        <input type="text" name="ot_name" value="{{$ssmother->ot_name}}" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label  class="col-sm-4 label">IC No.</label>
                    <div class="col-sm-8">
                        <input type="text" name="ot_icno" value="{{$ssmother->ot_icno}}" class="form-control">
                    </div>
                </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-4 col-form-label">Jawatan</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="ot_jawatan" aria-label="Default select example" id="myselectjawatan">
                                <option selected hidden>Pilih Jawatan</option>
                                @foreach ($jawatanlist as $key => $value)
                                    <option value="{{ $value }}" {{ $ssmother->ot_jawatan == $value ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                <div class="row mb-3">
                    <div class="col-sm-4 label">Nombor Tel</div>
                    <div class="col-sm-8">
                        <input type="text" name="ot_notel" value="{{$ssmother->ot_notel}}" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label  class="col-sm-4 label">Tempat Bertugas Sekarang:</label>
                    <div class="col-sm-8">
                        <input type="text" name="ot_workplace" value="{{$ssmother->ot_workplace}}"  class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label  class="col-sm-4 label">Catatan</label>
                    <div class="col-lg-8">
                        <textarea type="hurai" name="ot_catatan" value="{{$ssmother->ot_catatan}}"  class="form-control">{{$ssmother->ot_catatan}}</textarea>
                    </div>
                </div>

            

            

            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Admin</h5>

            <div class="row mb-3">
                    <label  class="col-sm-4 label">Created by</label>
                    <div class="col-sm-8">
                        <input type="text"  value="{{$ssmother->ot_created_by}}"  class="form-control" readonly>
                    </div>
                </div>

 <!-- start status -->
 <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col-form-label">Status:</label>
              <div class="col-sm-6">
                 <select name="ot_status" class="form-control" required>
                <option value="" ></option>
              <option value="Sedang Dikemaskini / Diteliti" {{ $ssmother->ot_status == 'Sedang Dikemaskini / Diteliti' ? 'selected' : '' }}>Sedang Dikemaskini / Diteliti</option>
              <option value="Dihadapkan ke Dynamik" {{ $ssmother->ot_status == 'Dihadapkan ke Dynamik' ? 'selected' : '' }}>Dihadapkan ke Dynamik</option>
              <option value="Selesai" {{ $ssmother->ot_status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
          </select>

                  

                
                {!! $errors->first('status', '<p class="help-block text-danger">:message</p>') !!}
              </div>
              <div class="col-sm-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusInfoModal">Info</button>
              </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="statusInfoModal" tabindex="-1" role="dialog" aria-labelledby="statusInfoModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="statusInfoModalLabel">Status Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Status</th>
                          <th>Updated At</th>
                          <th>By</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- You can populate this table with data dynamically based on your needs -->
                        <tr>
                          <td>Sedang Dikemaskini / Diteliti</td>
                          <td>{{$ssmother->diteliti_updatedat}}</td>
                          <td> {{$ssmother->diteliti_updatedby}}</td>
                        </tr>

                        <tr>
                          <td>Dihadapkan ke Dynamik</td>
                          <td>{{$ssmother->dinamik_updatedat}}</td>
                          <td> {{$ssmother->dinamik_updatedby}}</td>
                        </tr>


                        <tr>
                          <td>Selesai</td>
                          <td>{{$ssmother->selesai_updatedat}}</td>
                          <td>{{$ssmother->selesai_updatedby}}</td>
                        </tr>
                        <!-- Add more rows as needed -->
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>


</div>
</div>
</div>
</section>

                
              

               





                <br>
                <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
    
 
        </form>
        @endforeach
        </div>

</div>
</div>
</div>


</section>
@endsection