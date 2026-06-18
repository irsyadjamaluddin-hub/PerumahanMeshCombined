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

        @foreach($ssmpassword as $ssmpassword)

        <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.updateadminpassword') }}" enctype="multipart/form-data">
            @csrf

            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Peranan Form</h5>


            <input type="text" name="id" class="form-control" value="{{$ssmpassword->id}}" hidden>

            
                <div class="row mb-3">
                    <div class="col-sm-4 label">Nombor Rujukan:</div>
                    <div class="col-sm-8">
                        <input type="text" name="id" value="PS0{{$ssmpassword->id}}" class="form-control" disabled>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <div class="col-sm-4 label">Name</div>
                    <div class="col-sm-8">
                        <input type="text" name="ps_name" value="{{$ssmpassword->ps_name}}" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label  class="col-sm-4 label">IC No.</label>
                    <div class="col-sm-8">
                        <input type="text" name="ps_icno" value="{{$ssmpassword->ps_icno}}" class="form-control">
                    </div>
                </div>

                      <div class="row mb-3">
                        <label for="inputText" class="col-sm-4 col-form-label">Jawatan</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="ps_jawatan" aria-label="Default select example" id="myselectjawatan">
                                <option selected hidden>Pilih Jawatan</option>
                                @foreach ($jawatanlist as $key => $value)
                                    <option value="{{ $value }}" {{ $ssmpassword->ps_jawatan == $value ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                <div class="row mb-3">
                    <div class="col-sm-4 label">Tempat Bertugas Sekarang</div>
                    <div class="col-sm-8">
                        <input type="text" name="ps_workplace" value="{{$ssmpassword->ps_workplace}}" class="form-control">
                    </div>
                </div>



                <div class="row mb-3">
                    <div class="col-sm-4 label">Email</div>
                    <div class="col-sm-8">
                        <input type="text" name="ps_email" value="{{$ssmpassword->ps_email}}" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label  class="col-sm-4 label">Nombor Telefon</label>
                    <div class="col-sm-8">
                        <input type="text" name="ps_notel" value="{{$ssmpassword->ps_notel}}"  class="form-control">
                    </div>
                </div>

                 <div class="row mb-3">
                    <label  class="col-sm-4 label">Password OTP</label>
                    <div class="col-sm-8">
                        <input type="text" name="ps_otp" value="{{$ssmpassword->ps_otp}}"  class="form-control">
                    </div>
                </div>



                <div class="row mb-3">
                    <label  class="col-sm-4 label">Catatan</label>
                    <div class="col-lg-8">
                        <textarea type="hurai" name="ps_catatan" value="{{$ssmpassword->ps_catatan}}"  class="form-control">{{$ssmpassword->ps_catatan}}</textarea>
                    </div>
                </div>

              
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Admin</h5>

            <div class="row mb-3">
                    <label  class="col-sm-4 label">Created by</label>
                    <div class="col-sm-8">
                        <input type="text"  value="{{$ssmpassword->ps_created_by}}"  class="form-control" readonly>
                    </div>
                </div>

               <!-- start status -->
              <div class="row mb-3">
              <label for="inputText" class="col-sm-4 label">Status:</label>
              <div class="col-sm-6">
                 <select name="ps_status" class="form-control" required>
                <option value="" ></option>
              <option value="Dihadapkan ke HD" {{ $ssmpassword->ps_status == 'Dihadapkan ke HD' ? 'selected' : '' }}>Dihadapkan ke HD</option>
              <!-- <option value="Dihadapkan ke Dynamik" {{ $ssmpassword->pe_status == 'Dihadapkan ke Dynamik' ? 'selected' : '' }}>Dihadapkan ke Dynamik</option> -->
              <option value="Selesai" {{ $ssmpassword->ps_status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
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
                          <td>Dihadapkan ke HD</td>
                          <td>{{$ssmpassword->hd_updatedat}}</td>
                          <td> {{$ssmpassword->hd_updatedby}}</td>
                        </tr>

                        <!-- <tr>
                          <td>Dihadapkan ke Dynamik</td>
                          <td>{{$ssmpassword->dinamik_updatedat}}</td>
                          <td> {{$ssmpassword->dinamik_updatedby}}</td>
                        </tr> -->


                        <tr>
                          <td>Selesai</td>
                          <td>{{$ssmpassword->selesai_updatedat}}</td>
                          <td>{{$ssmpassword->selesai_updatedby}}</td>
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