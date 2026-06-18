@extends('layouts.app-all')

@section('title', 'Edit SKB')

@section('content')

<?php
$pagename = "SKB";
?>

<div class="pagetitle">
  <h1>Surat Kebenaran Bertugas</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">SKB</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">


  <a href="{{ route('skbs.skb.index') }}" class="btn btn-primary text-right mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>


  <!-- QO Table -->
  <div class="col-12">
    <div class="card recent-sales">



      <div class="card-body">

        <div class="profile-overview pt-3">

          <h3 class="card-title">Edit SKB Form</h3>

          @foreach($biodatas as $biodata)

          <div class="row">
            <div class="col-lg-4 col-md-3  label">Nama Penuh <br> <i>Fullname</i></div>
            <div class="col-lg-8 col-md-9">
              <input type="text" class="bg-gray-200 form-control" value="{{$biodata->name}}" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-3  label">No. Kad Pengenalan <br> <i>Identity Number</i></div>
            <div class="col-lg-8 col-md-9">
              <input type="text" class="bg-gray-200 form-control" value="{{Auth::user()->ic_no}}" readonly>
            </div>
          </div>

          @endforeach

          <form class="" method="post" action="{{ route('skbs.skb.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
              <div class="col-lg-4 col-md-3  label">Jabatan <br> <i>Department </i></div>
              <div class="col-lg-8 col-md-9">

                @foreach($employments as $employment)

                <input type="text" class="bg-gray-200 form-control" name="department_id" value="{{ optional($employment->department)->label }}" readonly>
                <input type="hidden" name="department_id" class="bg-gray-200 form-control" value="{{ $employment->department_id }}" hidden>
                @endforeach

                {!! $errors->first('department_id', '<p class="help-block text-danger">:message</p>') !!}

              </div>
            </div>

            @foreach($contacts as $contact)

            <div class="row">
              <div class="col-lg-4 col-md-3  label">Alamat <br> <i>Address</i></div>
              <div class="col-lg-8 col-md-9">
                <input type="text" name="address" value="{{ $contact->address}}" class="form-control" readonly>
                {!! $errors->first('address', '<p class="help-block text-danger">:message</p>') !!}
              </div>

            </div>

            @endforeach


            @foreach($qos as $qo)

            <div class="row">
              <div class="col-lg-4 col-md-3  label"> Tempat Bertugas<br> <i>Workplace</i></div>
              <div class="col-lg-8 col-md-9">
                <input type="text" value="{{ $qo->qo_work_places }}" name="qo_work_places" class="bg-gray-200 form-control" hidden>
                <input type="text" class="bg-gray-200 form-control" value="{{ $qo->label }}" readonly>
                {!! $errors->first('qo_work_places', '<p class="help-block text-danger">:message</p>') !!}
              </div>
            </div>


            <div class="row">
              <div class="col-lg-4 col-md-3  label">Muat Naik Gambar Bruhealth <br> <i>Upload Bruhealth Image</i></div>
              <div class="col-lg-8 col-md-9">

                <a href='{{Storage::url("$qo->bruhealth_img") }}' target="_blank">
                  <p> <i>View Uploaded File </i></p>
                </a>


              </div>
            </div>

            <input type="text" value="{{$qo->emp_qo_infos_id}}" name="id" hidden>

            <div class="row">
              <div class="col-lg-4 col-md-3  label">Tarikh Mula <br> <i>Start Date</i></div>
              <div class="col-lg-8 col-md-9">
                <input type="date" name="start_date" value="{{ $qo->start_date }}" class="form-control">
                {!! $errors->first('start_date', '<p class="help-block text-danger">:message</p>') !!}
              </div>
            </div>

            <div class="row">
              <div class="col-lg-4 col-md-3  label">Tarikh Berakhir <br> <i>End Date</i></div>
              <div class="col-lg-8 col-md-9">
                <input type="date" name="end_date" value="{{ $qo->end_date }}" class="form-control">
                {!! $errors->first('end_date', '<p class="help-block text-danger">:message</p>') !!}
              </div>
            </div>

            @endforeach

            <div class="card">
              <h3 class="card-title text-lg font-extrabold text-center">ART</h3>

              <table class="table-achiev" id="tableprestasi">
                <thead>
                  <tr>
                    <th>Hari</th>
                    <th>Tempat Bertugas</th>
                    <th>Keputusan ART</th>
                    <th>Tarik Ujian ART</th>
                    <th>Gambar ART</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>Ke-1</td>

                    @if(count($artday1) == 0)
                    <td>
                      <input type="text" name="place1" class="form-control">
                      {!! $errors->first('place1', '<p class="help-block text-danger">:message</p>') !!}
                    </td>

                    <td>
                      <select class="form-select" name="result_id1">
                        <option value=" "></option>
                        <option value="+ve">Positive</option>
                        <option value="-ve">Negative</option>
                        <option value="inv">Invalid</option>
                      </select>
                      {!! $errors->first('result_id1', '<p class="help-block text-danger">:message</p>') !!}
                    </td>

                    <td>
                      <input type="date" name="art_date1" class="form-control">
                      {!! $errors->first('art_date1', '<p class="help-block text-danger">:message</p>') !!}
                    </td>

                    <td>
                      <input type="file" name="art_file1" class="form-control">
                      {!! $errors->first('art_file1', '<p class="help-block text-danger">:message</p>') !!}
                    </td>

                    @else
                    @foreach($artday1 as $art1)

                    <td>
                      {{$art1->work_place}}
                    </td>

                    <td>
                      @if($art1->art_result == "-ve")
                      <span class="badge bg-success">Negative</span>
                      @elseif(($art1->art_result) == "+ve")
                      <span class="badge bg-danger">Positive</span>
                      @else
                      <span class="badge bg-warning">Invalid</span>
                      @endif
                    </td>

                    <td>
                      {{ date('d/m/Y', strtotime($art1->date_test)) }}
                    </td>

                    <td>
                      <a href='{{Storage::url("$art1->art_image") }}' target="_blank">View</a>
                    </td>

                    @endforeach
                    @endif
                  </tr>

                  <tr>
                    <td>Ke-2</td>
                    @if(count($artday2) == 0)
                    <td>
                      <input type="text" name="place2" class="form-control">
                      {!! $errors->first('place2', '<p class="help-block text-danger">:message</p>') !!}
                    </td>
                    <td>
                      <select class="form-select" name="result_id2">
                        <option value=" "></option>
                        <option value="+ve">Positive</option>
                        <option value="-ve">Negative</option>
                        <option value="inv">Invalid</option>
                      </select>
                      {!! $errors->first('result_id2', '<p class="help-block text-danger">:message</p>') !!}
                    </td>
                    <td>
                      <input type="date" name="art_date2" class="form-control">
                      {!! $errors->first('art_date2', '<p class="help-block text-danger">:message</p>') !!}
                    </td>
                    <td>
                      <input type="file" name="art_file2" class="form-control">
                      {!! $errors->first('art_file2', '<p class="help-block text-danger">:message</p>') !!}
                    </td>
                    @else
                    @foreach($artday2 as $art2)
                    <td>
                      {{$art2->work_place}}
                    </td>
                    <td>
                      @if($art2->art_result == "-ve")
                      <span class="badge bg-success">Negative</span>
                      @elseif(($art2->art_result) == "+ve")
                      <span class="badge bg-danger">Positive</span>
                      @else
                      <span class="badge bg-warning">Invalid</span>
                      @endif
                    </td>
                    <td>
                      {{ date('d/m/Y', strtotime($art2->date_test)) }}
                    </td>
                    <td>
                      <a href='{{Storage::url("$art2->art_image") }}' target="_blank">View</a>
                    </td>
                    @endforeach
                    @endif
                  </tr>

                  <tr>
                    <td>Ke-3</td>
                    @if(count($artday3) == 0)
                    <td>
                      <input type="text" name="place3" class="form-control">
                      {!! $errors->first('place3', '<p class="help-block text-danger">:message</p>') !!}
                    </td>
                    <td>
                      <select class="form-select" name="result_id3">
                        <option value=" "></option>
                        <option value="+ve">Positive</option>
                        <option value="-ve">Negative</option>
                        <option value="inv">Invalid</option>
                      </select>
                      {!! $errors->first('result_id3', '<p class="help-block text-danger">:message</p>') !!}
                    </td>
                    <td>
                      <input type="date" name="art_date3" class="form-control">
                      {!! $errors->first('art_date3', '<p class="help-block text-danger">:message</p>') !!}
                    </td>
                    <td>
                      <input type="file" name="art_file3" class="form-control">
                      {!! $errors->first('art_file3', '<p class="help-block text-danger">:message</p>') !!}
                    </td>
                    @else
                    @foreach($artday3 as $art3)
                    <td>
                      {{$art3->work_place}}
                    </td>
                    <td>
                      @if($art3->art_result == "-ve")
                      <span class="badge bg-success">Negative</span>
                      @elseif(($art3->art_result) == "+ve")
                      <span class="badge bg-danger">Positive</span>
                      @else
                      <span class="badge bg-warning">Invalid</span>
                      @endif
                    </td>
                    <td>
                      {{ date('d/m/Y', strtotime($art3->date_test)) }}
                    </td>
                    <td>
                      <a href='{{Storage::url("$art3->art_image") }}' target="_blank">View</a>
                    </td>
                    @endforeach
                    @endif
                  </tr>

                  <tr>
                    <td>Ke-4</td>
                    @if(count($artday4) == 0)
                    <td>
                      <input type="text" name="place4" class="form-control">
                      {!! $errors->first('place4', '<p class="help-block text-danger">:message</p>') !!}
                    </td>
                    <td>
                      <select class="form-select" name="result_id4">
                        <option value=" "></option>
                        <option value="+ve">Positive</option>
                        <option value="-ve">Negative</option>
                        <option value="inv">Invalid</option>
                      </select>
                      {!! $errors->first('result_id4', '<p class="help-block text-danger">:message</p>') !!}
                    </td>
                    <td>
                      <input type="date" name="art_date4" class="form-control">
                      {!! $errors->first('art_date4', '<p class="help-block text-danger">:message</p>') !!}
                    </td>
                    <td>
                      <input type="file" name="art_file4" class="form-control">
                      {!! $errors->first('art_file4', '<p class="help-block text-danger">:message</p>') !!}
                    </td>
                    @else
                    @foreach($artday4 as $art4)
                    <td>
                      {{$art4->work_place}}
                    </td>
                    <td>
                      @if($art4->art_result == "-ve")
                      <span class="badge bg-success">Negative</span>
                      @elseif(($art4->art_result) == "+ve")
                      <span class="badge bg-danger">Positive</span>
                      @else
                      <span class="badge bg-warning">Invalid</span>
                      @endif
                    </td>
                    <td>
                      {{ date('d/m/Y', strtotime($art4->date_test)) }}
                    </td>
                    <td>
                      <a href='{{Storage::url("$art4->art_image") }}' target="_blank">View</a>
                    </td>
                    @endforeach
                    @endif
                  </tr>

                  <tr>
                    <td>Ke-5</td>
                    @if(count($artday5) == 0)
                    <td>
                      <input type="text" name="place5" class="form-control">
                      {!! $errors->first('place5', '<p class="help-block text-danger">:message</p>') !!}
                    </td>
                    <td>
                      <select class="form-select" name="result_id5">
                        <option value=" "></option>
                        <option value="+ve">Positive</option>
                        <option value="-ve">Negative</option>
                        <option value="inv">Invalid</option>
                      </select>
                      {!! $errors->first('result_id5', '<p class="help-block text-danger">:message</p>') !!}
                    </td>
                    <td>
                      <input type="date" name="art_date5" class="form-control">
                      {!! $errors->first('art_date5', '<p class="help-block text-danger">:message</p>') !!}
                    </td>
                    <td>
                      <input type="file" name="art_file5" class="form-control">
                      {!! $errors->first('art_file5', '<p class="help-block text-danger">:message</p>') !!}
                    </td>
                    @else
                    @foreach($artday5 as $art5)
                    <td>
                      {{$art5->work_place}}
                    </td>
                    <td>
                      @if($art5->art_result == "-ve")
                      <span class="badge bg-success">Negative</span>
                      @elseif(($art5->art_result) == "+ve")
                      <span class="badge bg-danger">Positive</span>
                      @else
                      <span class="badge bg-warning">Invalid</span>
                      @endif
                    </td>
                    <td>
                      {{ date('d/m/Y', strtotime($art5->date_test)) }}
                    </td>
                    <td>
                      <a href='{{Storage::url("$art5->art_image") }}' target="_blank">View</a>
                    </td>
                    @endforeach
                    @endif
                  </tr>

                </tbody>
              </table>
            </div>

            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>

                <label class="form-check-label" for="acceptTerms">Saya mengakui bahawa maklumat dan keputusan yang dihadapkan adalah sahih dan betul.</label>
                <div class="invalid-feedback">You must agree before submitting.</div>
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

          </form>


        </div>

      </div>


    </div>

  </div>
  </div><!-- End Recent Sales -->

  </div>


</section>
@endsection