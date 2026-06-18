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
        <h3 class="card-title">Butiran Pemohon<br> <i>Requester's Details</i></h3>

        @foreach($ssmsreq as $ssmrq)

        <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.updateadmin') }}" enctype="multipart/form-data">
            @csrf

            <input type="text" name="id" class="form-control" value="{{$ssmrq->id}}" hidden>

            
            <div class="row mb-3">
                    <div class="col-sm-4 label">Kategori:</div>
                    <div class="col-sm-8">
                        <input type="text" name="id" value="{{$ssmrq->kategori}}" class="form-control" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4 label">Nombor Rujukan:</div>
                    <div class="col-sm-8">
                        <input type="text" name="id" value="{{$ssmrq->id}}" class="form-control" disabled>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <div class="col-sm-4 label">Nama:</div>
                    <div class="col-sm-8">
                        <input type="text" name="name" value="{{$ssmrq->name}}" class="form-control" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label  class="col-sm-4 label">Nombor Kad Pengenalan:</label>
                    <div class="col-sm-8">
                        <input type="text" name="ic" value="0{{$ssmrq->ic}}" class="form-control" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4 label">Jawatan:</div>
                    <div class="col-sm-8">
                        <input type="text" name="name" value="{{$ssmrq->jawatan}}" class="form-control" disabled>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-sm-4 label">Nombor Telefon:</div>
                    <div class="col-sm-8">
                        <input type="text" name="name" value="{{$ssmrq->telephone}}" class="form-control" disabled>
                    </div>
                </div>

                <!-- <div class="row mb-3">
                    <label  class="col-sm-4 label">Tempat Bertugas Sekarang:</label>
                    <div class="col-sm-8">
                        <input type="text" name="current_workplace" value="{{$ssmrq->current_workplace}}"  class="form-control" disabled>
                    </div>
                </div> -->
</div>
</div>
</div>
</section>

                <section class="section profile">
                <div class="col-12">
        <div class="card recent-sales">
            <div class="card-body">
            <h3 class="card-title">Tindakan (Admin)<br> <i>Action</i></h3>

<br>
                <div class="row mb-3">
                    <label  class="col-sm-4 label">Catatan:</label>
                    <div class="col-lg-8">
                        <textarea type="hurai" name="huraian" value="{{$ssmrq->huraian}}"  class="form-control">{{$ssmrq->huraian}}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label  class="col-sm-4 label">Nama Approver:</label>
                    <div class="col-sm-8">
                        <input type="text" name="approver_name" value="{{$ssmrq->approver_name}}"  class="form-control" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label  class="col-sm-4 label">Nombor Kad Pengenalan Approver:</label>
                    <div class="col-sm-8">
                        <input type="text" name="approver_ic" value="0{{$ssmrq->approver_ic}}"  class="form-control" disabled>
                    </div>
                </div>

                <!-- <div class="row mb-3">
                            <label class="col-sm-4 label">Status:</label>
                            <div class="col-sm-8">
                                <select class="form-select" name="status" aria-label="Default select example" value="{{$ssmrq->status}}">
                                    @if($ssmrq->status==!NULL && $ssmrq->status=="Selesai")
                                    <option value="{{$ssmrq->status}}" selected>{{$ssmrq->status}}</option>
                                    <option value="DiTolak">DiTolak</option>
                                    <option value="Sedang Diproses">Sedang Diproses</option>

                                    @elseif($ssmrq->status==!NULL && $ssmrq->status=="DiTolak")
                                    <option value="{{$ssmrq->status}}" selected>{{$ssmrq->status}}</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Sedang Diproses">Sedang Diproses</option>

                                    @elseif($ssmrq->status==!NULL && $ssmrq->status=="Sedang Diproses")
                                    <option value="{{$ssmrq->status}}" selected>{{$ssmrq->status}}</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="DiTolak">DiTolak</option>

                                    @else
                                    <option value="Sedang Diproses" selected hidden>Select Status</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Sedang Diproses">Sedang Diproses</option>
                                    <option value="DiTolak">DiTolak</option>
                                    @endif
                                </select>
                            </div>
                        </div> -->

                        <div class="row mb-3">
  <label for="inputText" class="col-sm-4 col-form-label">Status:</label>
  <div class="col-sm-6">
    <select name="status" class="form-control" required>
      <option value="">Pilih Status</option>
      <option value="Diterima">Diterima</option>
      <option value="Dipohonkan SSM HD">Dipohonkan SSM HD</option>
      <option value="Sedang Dikemaskini">Sedang Dikemaskini</option>
      <option value="KIV">KIV</option>
      <option value="Selesai">Selesai</option>
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
              <td>Diterima</td>
              <td>2023-10-31 10:00 AM</td>
              <td>John Doe</td>
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