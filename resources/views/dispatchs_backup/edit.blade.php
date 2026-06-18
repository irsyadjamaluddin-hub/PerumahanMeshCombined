@extends('layouts.app-all')

@section('title', 'Edit MED')

@section('content')

<?php
$pagename = "MED";
?>

<section class="section profile">

  <a href="{{ route('dispatchs.dis.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">

      <div class="card-body">

        <form class="" method="post" action="{{ route('dispatchs.dis.update') }}" enctype="multipart/form-data">
          @csrf

          <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Edit MED</h5>
<br>
              @foreach ($dispatchs as $dispatch)

              <input type="text" name="id" class="bg-gray-200 form-control " value="{{$dispatch->id}}" hidden>

              <div class="row">
                <div class="col-lg-4 label">Jenis</div>
                <div class="col-lg-8">
                  <select class="form-select" name="jns">
                    <option value="{{ $dispatch->jns }}">{{optional($dispatch->jenis)->label }}</option>
                    @foreach ($jenis as $key => $value)
                    <option value="{{ $key }}">
                      {{ $value }}
                    </option>
                    @endforeach
                  </select>
                  {!! $errors->first('jns', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Daripada</div>
                <div class="col-lg-8">
                  <select class="form-select" name="daripada">
                    <option value="{{ $dispatch->daripada}}">{{optional($dispatch->Daripada)->label }}</option>
                    @foreach ($daripada as $key => $value)
                    <option value="{{ $key }}">
                      {{ $value }}
                    </option>
                    @endforeach
                  </select>
                  {!! $errors->first('daripada', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>


              <?php
                    $K = json_decode($dispatch->kpd);  
              ?>

              <div class="row">
                <div class="col-lg-4 label">Kepada</div>
                  <div class="col-lg-8">
                    <select class="form-select js-example-basic-multiple"  multiple="multiple" name="kpd[]">

                    @foreach ($kepada as $key => $value)

                    @if(in_array($key, $K))
                    <option value="{{ $key }}" selected>

                    @else
                    <option value="{{ $key }}">

                    @endif

                    {{ $value }}
                    </option>

                    @endforeach
            
                    </select>
                    {!! $errors->first('kpd', '<p class="help-block text-danger">:message</p>') !!}
                  </div>
              </div>

    
              <script>
                $(document).ready(function() {
                  $('.js-example-basic-multiple').select2();
                });
              </script>


              <div class="row">
                <label class="col-lg-4 label">Untuk Perhatian</label>
                <div class="col-lg-8">
                  <select class="form-select" name="up">

                    <option value="{{optional($dispatch->Untukperhatian)->kod}}">{{optional($dispatch->Untukperhatian)->kod}}</option>
                    @foreach ($untukperhatians as $key => $value)
                    <option value="{{ $key }}">
                      {{ $value }}
                    </option>
                    @endforeach

                  </select>                  
                  {!! $errors->first('up', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Perkara</div>
                <div class="col-lg-8">
                  <input type="text" name="perkara" class="bg-gray-200 form-control" value="{{$dispatch->perkara}}">
                  {!! $errors->first('perkara', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Rujukan Persuratan</div>
                <div class="col-lg-8">
                  <input type="text" name="rp" class="bg-gray-200 form-control" value="{{$dispatch->rp}}">
                  {!! $errors->first('rp', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Rujukan Tuan/Puan</div>
                <div class="col-lg-8">
                  <input type="text" name="rm" class="bg-gray-200 form-control" value="{{$dispatch->rm}}">
                  {!! $errors->first('rm', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              
	      <div class="row">
                                <div class="col-lg-4 label">Muat Naik Dokumen</div>
                                <div class="col-lg-8">

                                    <a href='{{Storage::url("$dispatch->lamp") }}' target="_blank">
                                        <p>{{$dispatch->dis_filename}}</p>
                                    </a>
                                    <input type="file" name="lamp" class="form-control">

                                    {!! $errors->first('lamp', '<p class="help-block text-danger">:message</p>') !!}

                                    <a href='{{Storage::url("$dispatch->lamp1") }}' target="_blank">
                                        <p>{{$dispatch->dis_filename1}}</p>
                                    </a>
                                    <input type="file" name="lamp1" class="form-control">

                                    {!! $errors->first('lamp1', '<p class="help-block text-danger">:message</p>') !!}

                                    <a href='{{Storage::url("$dispatch->lamp2") }}' target="_blank">
                                        <p>{{$dispatch->dis_filename2}}</p>
                                    </a>
                                    <input type="file" name="lamp2" class="form-control">

                                    {!! $errors->first('lamp2', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

              <div class="row">
                <div class="col-lg-4 label">Catatan<br></div>
                <div class="col-lg-8">
                  <textarea class="form-control" name="catt" placeholder="Sebarang Ulasan" id="floatingTextarea" style="height: 100px;">{{$dispatch->catt}}</textarea>
                  {!! $errors->first('catt', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              @endforeach

          </div>
        <br>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>

  </div>
  </div>
  </div>

</section>
@endsection