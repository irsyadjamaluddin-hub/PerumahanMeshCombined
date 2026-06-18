@extends('layouts.app-all')

@section('title', 'Create MED')

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

          <form class="" method="post" action="{{ route('dispatchs.dis.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">MED</h5>
<br>

              <div class="row">
                <label class="col-lg-4 label">Jenis</label>
                <div class="col-lg-8">
                  <select class="form-select" name="jns" aria-label="Default select example">
                    <option></option>
                    @foreach ($jenis as $key => $value)
                    <option value="{{ $key }}">
                      {{ $value }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="row">
                <label class="col-lg-4 label">Daripada</label>
                <div class="col-lg-8">
                  <select class="form-select" name="daripada" aria-label="Default select example" id="myselect">
                    <option></option>
                    @foreach ($daripada as $key => $value)
                    <option value="{{ $key }}">
                      {{ $value }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Kepada</div>
                  <div class="col-lg-8">
                    <select class="form-select js-example-basic-multiple" multiple="multiple" name="kpd[]">
                      <option></option>
                      @foreach ($kepada as $key => $value)
                      <option value="{{ $key }}">
                        {{ $value }}
                      </option>
                      @endforeach
                    </select>
                    {!! $errors->first('kpd', '<p class="help-block text-danger">:message</p>') !!}
                  </div>
              </div>

                <div class="row">
                <label class="col-lg-4 col-md-3  label">Untuk Perhatian</label>
                <div class="col-lg-8 col-md-9">
                  <select class="form-select" name="up" aria-label="Default select example">
                    <option></option>
                    @foreach ($untukperhatians as $key => $value)
                    <option value="{{ $key }}">
                      {{ $value }}
                    </option>
                    @endforeach
                  </select>

                </div>
              </div>

              <div class="row">
                <label for="inputText" class="col-lg-4 label">Perkara</label>
                <div class="col-lg-8">
                  <input type="text" name="perkara" class="form-control">
                </div>
              </div>

              <div class="row">
                <label for="inputText" class="col-lg-4 label">Rujukan Persuratan</label>
                <div class="col-lg-8">
                  <input type="text" name="rp" class="form-control">
                </div>
              </div>

              <div class="row">
                <label for="inputText" class="col-lg-4 label">Rujukan Tuan/Puan</label>
                <div class="col-lg-8">
                  <input type="text" name="rm" class="form-control">
                </div>
              </div>

              <div class="row">
                                <div class="col-lg-4 col-md-3  label">Muat Naik Dokumen <br></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="file" name="lamp"><br>
                                    <input type="file" name="lamp1"><br>
                                    <input type="file" name="lamp2">
                                </div>
                            </div>

              <div class="row">
                <label for="inputText" class="col-lg-4 label">Catatan</label>
                <div class="col-lg-8">
                  <textarea class="form-control" name="catt" placeholder="Sebarang Ulasan" id="floatingTextarea" style="height: 100px;"></textarea>
                </div>
              </div>

          </div>

            <!-- take hidden ic_no so that easy to identify data belong/from who -->

            <input type="text" name="ic_no" class="bg-gray-200 form-control" value="{{Auth::user()->ic_no}}" hidden>

<br>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

          </form>

    </div>
    </div>
    </div>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
    });
  </script>

  <script>
    $('#myselect').select2({
      width: '100%',
      placeholder: "Jabatan",
      allowClear: true
    });
  </script>

</section>
@endsection