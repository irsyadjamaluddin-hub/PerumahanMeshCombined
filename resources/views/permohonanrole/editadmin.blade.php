@extends('layouts.app-all')

@section('title', 'Admin Edit Permohonan peranan')

@section('content')

<?php
$pagename = "Permohonan Peranan";
?>

<section class="section profile">

  <a href="{{ route('permohonanrole.permohonanrole.indexadmin') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">

      <div class="card-body">

        <form class="" method="post" action="{{ route('permohonanrole.permohonanrole.updateadmin') }}" enctype="multipart/form-data">
          @csrf

          <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Edit Permohonan Peranan MESH</h5>
<br>
              @foreach ($permohonanrole as $permohonanrole)

              <input type="text" name="id" class="bg-gray-200 form-control " value="{{$permohonanrole->id}}" hidden>

                <div class="row">
                    <div class="col-lg-4 label">Nama</div>
                    <div class="col-lg-8">
                        <input type="text" class="bg-gray-200 form-control"  value="{{$permohonanrole->nama}}" readonly>
                    </div>
                </div>

                <div class="row">
                    <label class="col-lg-4 label">Jabatan</label>
                    <div class="col-lg-8">
                
                    <input type="text" class="bg-gray-200 form-control" value="{{$permohonanrole->jabatan}}" readonly>
                
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 label">No. Kad Pengenalan</div>
                    <div class="col-lg-8">
                        <input type="text" class="bg-gray-200 form-control"  value="{{$permohonanrole->icno}}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 label">Nombor Telefon</div>
                    <div class="col-lg-8">
                        <input type="text" class="bg-gray-200 form-control"  value="{{$permohonanrole->no_tel}}" readonly>
                    </div>
                </div>

            
              <div class="row">
                <div class="col-lg-4 label">Peranan</div>
                <div class="col-lg-8">
                  <input type="text"  class="bg-gray-200 form-control" value="{{$permohonanrole->peranan}}" readonly>
                  {!! $errors->first('perkara', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              

              <div class="row">
                <div class="col-lg-4 label">Catatan<br></div>
                <div class="col-lg-8">
                  <textarea class="form-control"  placeholder="Sebarang Ulasan" id="floatingTextarea" style="height: 100px;" readonly>{{$permohonanrole->catatan}}</textarea>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Status</div>
                <div class="col-lg-8 ">
                    <select class="form-control" name="status">
                        <option value="{{$permohonanrole->status}}">{{$permohonanrole->status}}</option>
                        <option value="approve">approve</option>
                        <option value="reject">reject</option>
                        
                    </select>
                    {!! $errors->first('status', '<p class="help-block text-danger">:message</p>') !!}
                </div>
            </div>

            <div class="row">
                    <div class="col-lg-4 label">Admin</div>
                    <div class="col-lg-8">
                        <input type="text" class="bg-gray-200 form-control"  value="{{$permohonanrole->admin_icno}}" readonly>
                    </div>
            </div>

        <br>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            @endforeach

        </form>

  </div>
  </div>
  </div>

</section>
@endsection