@extends('layouts.app-all')

@section('title', 'Create SKB')

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

          <h3 class="card-title">SKB Form</h3>

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

          <!-- <div class="row">
                          <div class="col-lg-4 col-md-3  label">Dos Vaksinasi <br> <i>Vaccination Dose</i></div>
                          <div class="col-lg-8 col-md-9">
                              <input type="text" name="vac_dose" value="{{ optional($biodata->vac_dose)->label }}" class="form-control" readonly>
                              {!! $errors->first('vac_dose', '<p class="help-block text-danger">:message</p>') !!}
                          </div>
                          
                      </div> -->

          @endforeach

          <form class="" method="post" action="{{ route('skbs.skb.store') }}" enctype="multipart/form-data">
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
                <input type="text" name="address" value="{{ $contact->address }}" class="form-control" readonly>
                {!! $errors->first('address', '<p class="help-block text-danger">:message</p>') !!}
              </div>

            </div>

            @endforeach


            <!-- <div class="row">
              <div class="col-lg-4 col-md-3  label">Jawatan Sekarang <br> <i>Current Designation</i></div>
              <div class="col-lg-8 col-md-9">
                <input type="text" name="current_designation" value="{{ $employment->current_designation_id }}" class="form-control">
                {!! $errors->first('current_designation', '<p class="help-block text-danger">:message</p>') !!}
              </div>

            </div> -->

            <div class="row">
              <div class="col-lg-4 col-md-3  label">Tempat Bertugas<br> <i>Workplace</i> </div>
              <div class="col-lg-8 col-md-9">
                <select class="form-select" name="qo_work_places">
                  <option></option>
                  @foreach ($tempatbertugasqo as $key => $value)
                  <option value="{{ $key }}">
                    {{ $value }}
                  </option>
                  @endforeach
                </select>
                {!! $errors->first('qo_work_places', '<p class="help-block text-danger">:message</p>') !!}
              </div>
            </div>




            <!-- <div class="row">
                          <div class="col-lg-4 col-md-3  label">Kod Warna Bruhealth<br> <i> Bruhealth Color Code</i></div>
                          <div class="col-lg-8 col-md-9">
                              <select class="form-control" name="result_id">
                                  <option value=" "></option>
                                  <option value="red">Red</option>
                                  <option value="purple">Purple</option>
                                   <option value="blue">Blue</option>      
                              </select>
                              {!! $errors->first('result_id', '<p class="help-block text-danger">:message</p>') !!}
                          </div>
                      </div> -->


            <div class="row">
              <div class="col-lg-4 col-md-3  label">Muat Naik Gambar Bruhealth <br> <i>Upload Bruhealth Image</i><br><i style="color:red;">*Saiz maksimum bagi setiap fail / gambar: 2MB</i> </div>
              <div class="col-lg-8 col-md-9">
                <input type="file" name="bruhealth_img" class="form-control">
                {!! $errors->first('bruhealth_img', '<p class="help-block text-danger">:message</p>') !!}
              </div>
            </div>



            <div class="row">
              <div class="col-lg-4 col-md-3  label">Tarikh Mula <br> <i>Start Date</i></div>
              <div class="col-lg-8 col-md-9">
                <input type="date" name="start_date" class="form-control">
                {!! $errors->first('start_date', '<p class="help-block text-danger">:message</p>') !!}
              </div>
            </div>

            <div class="row">
              <div class="col-lg-4 col-md-3  label">Tarikh Berakhir <br> <i>End Date</i></div>
              <div class="col-lg-8 col-md-9">
                <input type="date" name="end_date" class="form-control">
                {!! $errors->first('end_date', '<p class="help-block text-danger">:message</p>') !!}
              </div>
            </div>

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
                  </tr>

                  <tr>
                    <td>Ke-2</td>
                    <td><input type="text" name="place2" class="form-control"></td>
                    <td>
                      <select class="form-select" name="result_id2">
                        <option value=" "></option>
                        <option value="+ve">Positive</option>
                        <option value="-ve">Negative</option>
                        <option value="inv">Invalid</option>
                      </select>
                    </td>
                    <td><input type="date" name="art_date2" class="form-control"></td>
                    <td><input type="file" name="art_file2" class="form-control"></td>
                  </tr>

                  <tr>
                    <td>Ke-3</td>
                    <td><input type="text" name="place3" class="form-control"></td>
                    <td>
                      <select class="form-select" name="result_id3">
                        <option value=" "></option>
                        <option value="+ve">Positive</option>
                        <option value="-ve">Negative</option>
                        <option value="inv">Invalid</option>
                      </select>
                    </td>
                    <td><input type="date" name="art_date3" class="form-control"></td>
                    <td><input type="file" name="art_file" class="form-control"></td>
                  </tr>

                  <tr>
                    <td>Ke-4</td>
                    <td><input type="text" name="place4" class="form-control"></td>
                    <td>
                      <select class="form-select" name="result_id4">
                        <option value=" "></option>
                        <option value="+ve">Positive</option>
                        <option value="-ve">Negative</option>
                        <option value="inv">Invalid</option>
                      </select>
                    </td>
                    <td><input type="date" name="art_date4" class="form-control"></td>
                    <td><input type="file" name="art_file4" class="form-control"></td>
                  </tr>

                  <tr>
                    <td>Ke-5</td>
                    <td><input type="text" name="place5" class="form-control"></td>
                    <td>
                      <select class="form-select" name="result_id5">
                        <option value=" "></option>
                        <option value="+ve">Positive</option>
                        <option value="-ve">Negative</option>
                        <option value="inv">Invalid</option>
                      </select>
                    </td>
                    <td><input type="date" name="art_date5" class="form-control"></td>
                    <td><input type="file" name="art_file5" class="form-control"></td>
                  </tr>

                </tbody>
              </table>
            </div>


            <br>

            <P> <b> DECLARATION </b></P>


            <!-- <p> Adakah anda berasa tidak sihat?:</p>
                      
                      <div>
                        <input type="radio" id="n" name="n" value="n" checked>
                         <label for="no">Tidak</label>
                      </div>
                      
                      <div>
                        <input type="radio" id="y" name="y" value="y">
                        <label for="yes">Ya</label>
                      </div> -->


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