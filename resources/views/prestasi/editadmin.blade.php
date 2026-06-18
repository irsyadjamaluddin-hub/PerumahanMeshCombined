@extends('layouts.app-all')

@section('title', 'Admin Edit Prestasi')

@section('content')

<?php
$pagename = "prestasi";
?>

<section class="section profile">

  <a href="{{ route('prestasi.prestasi.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">

      <div class="card-body">

        <form class="" method="post" action="{{ route('prestasi.prestasi.updateadmin') }}" enctype="multipart/form-data">
          @csrf

          <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Edit Prestasi</h5>
<br>
              @foreach ($prestasi as $prestasi)

              <input type="text" name="id" class="bg-gray-200 form-control " value="{{$prestasi->id}}" hidden>

                <div class="row">
                    <div class="col-lg-4 label">Nama</div>
                    <div class="col-lg-8">
                        <input type="text" class="bg-gray-200 form-control"  value="{{$prestasi->nama}}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 label">No. Kad Pengenalan</div>
                    <div class="col-lg-8">
                        <input type="text" class="bg-gray-200 form-control"  value="{{$prestasi->ic_no}}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 label">No. Tel</div>
                    <div class="col-lg-8">
                        <input type="text" class="bg-gray-200 form-control" name="telephone_mobile" value="{{$prestasi->telephone_mobile}}" readonly>
                    </div>
                </div>

             

             
            <div class="row">
                <label class="col-lg-4 label">Jabatan</label>
                <div class="col-lg-8">
               
                <input type="text" class="bg-gray-200 form-control" value="{{ optional($prestasi->Department)->label }}" readonly>
             
                </div>
            </div>

              <div class="row">
                <div class="col-lg-4 label">Perkara</div>
                <div class="col-lg-8">
                  <input type="text"  class="bg-gray-200 form-control" value="{{$prestasi->perkara}}" readonly>
                  {!! $errors->first('perkara', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              
              
                <div class="row">
                    <div class="col-lg-4 label">Muat Naik Dokumen</div>
                    <div class="col-lg-8">
                        @if($prestasi->filename && count($prestasi->filename) > 0)
                            @foreach($prestasi->filename as $index => $filename)
                                <div class="row">
                                    <a href="{{ Storage::url($filename) }}" target="_blank">{{ basename($filename) }}</a>
                                </div>
                            @endforeach
                        @else
                                <!-- Display Current Files -->
                        <!-- Display Current Files -->
                        @if($prestasi->file)
                            @foreach($prestasi->file as $index => $filename)
                            <div class="row">
                              <div class="col-md-6">
                              

                                  <p id="margin-bottombegone">View current files: <a href="{{ url('storage/prestasi/' . $filename) }}" target="_blank">{{ basename($filename) }}</a></p>

                              </div>
                           
                            </div>
                            @endforeach
                            
                        @else
                        <p>No file chosen</p>
                        @endif
                        @endif
                    </div>
                </div>


              <div class="row">
                <div class="col-lg-4 label">Catatan<br></div>
                <div class="col-lg-8">
                  <textarea class="form-control"  placeholder="Sebarang Ulasan" id="floatingTextarea" style="height: 100px;" readonly>{{$prestasi->catatan}}</textarea>
                </div>
              </div>

              <div class="row">
                          <div class="col-lg-4 label">Status</div>
                          <div class="col-lg-8 ">
                              <select class="form-control" name="status">
                                  <option value="{{$prestasi->status}}">{{$prestasi->status}}</option>
                                  <option value="Sedang dikemaskini">Sedang dikemaskini</option>
                                  <option value="Selesai">Selesai</option>
                                
                              </select>
                              {!! $errors->first('status', '<p class="help-block text-danger">:message</p>') !!}
                          </div>
                      </div>

              <div class="row">
                <div class="col-lg-4 label">Catatan Admin <br></div>
                <div class="col-lg-8">
                  <textarea class="form-control" name="catatanadmin" placeholder="Sebarang Ulasan" id="floatingTextarea" style="height: 100px;">{{$prestasi->catatanadmin}}</textarea>
                  {!! $errors->first('catatan', '<p class="help-block text-danger">:message</p>') !!}
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