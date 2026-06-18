@extends('layouts.app-all')

@section('title', 'Edit CCA')

@section('content')

<?php
$pagename = "CCA Focal";
?>

<div class="pagetitle">
    <h1>CCA</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">CCA</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">


    <a href="{{ route('cca.cca.indexAll') }}" class="btn btn-primary text-right mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>


    <!-- QO Table -->
    <div class="col-12">
        <div class="card recent-sales">



            <div class="card-body">

                <div class="profile-overview pt-3">

                    <h3 class="card-title">Edit CCA</h3>




                    <form class="" method="post" action="{{ route('cca.cca.updatefocal') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                            <h5 class="card-title">Keterangan Sekolah</h5>


                            @foreach($ccas as $cca)

                            <input type="text" name="id" class="bg-gray-200 form-control " value="{{$cca->id}}" hidden>
                            <div class="row">
                                     <div class="col-lg-4 col-md-3  label">Nama Sekolah</div>

                                    <div class="col-lg-8 col-md-9">

                                    <input type="text" value="{{ optional($cca->schools)->label }}" class="form-control"
                                        readonly>
                                    {!! $errors->first('school_name', '<p class="help-block text-danger">:message</p>')
                                    !!}


                                </div>
                            </div>      

                            {{-- School name JS --}}
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

                            <script>
                            $(function() {
                                $('#myselection').change(function() {
                                    // "this" is the <select>
                                    $('.myDiv').hide();
                                    $('#' + $(this).find(':selected').data('id')).show();
                                });
                            });
                            </script>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Kluster</div>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="kluster" id="myselect">
                                          <option value="{{ $cca->kluster}}">{{ $cca->kluster }}</option>
                                        @foreach ($clusters as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('kluster', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Year</div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="number" min="1980" minlength="4" maxlength="4" name="year" class="bg-gray-200 form-control" value="{{$cca->year}}">
                                </div>
                            </div>

                        </div>

                        <br>


                        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                            <h5 class="card-title">Keterangan Guru Pengawas CCA</h5>

                            <div class="card">


                                <table class="table-achiev" id="tableprestasi">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Nama Guru</th>
                                            <th style="text-align: center;">No Kad Pengenalan Guru</th>
                                            <th style="text-align: center;">Jawatan dalam CCA</th>
                                            <th style="text-align: center;">Jantina</th>
                                            <th style="text-align: center;">No.Telefon</th>
                                            <th style="text-align: center;">Emel</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="nama_guru" value="{{ $cca->nama_guru}}" class="form-control" placeholder ="Nama">
                                                {!! $errors->first('nama_guru', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="ic_no_guru" placeholder ="IC No. Eg. 00123456" value="{{ $cca->ic_no_guru}}" class="form-control">
                                                {!! $errors->first('ic_no_guru', '<p class="help-block text-danger">:message</p>') !!}


                                            <td>
                                                <input type="text" name="guru_position" value="{{ $cca->guru_position}}" class="form-control">
                                                {!! $errors->first('guru_position', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-control @error('jantina') is-invalid @enderror" name="jantina">
                                                    <option value="{{ $cca->jantina}}">{{ $cca->jantina}}</option>
                                                    <option value="Lelaki">Lelaki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="no_tel_guru" value="{{ $cca->no_tel_guru}}" class="form-control" placeholder ="Eg. 8912345">
                                                {!! $errors->first('no_tel_guru', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="email" value="{{ $cca->email}}" class="form-control" placeholder ="@moe.gov.bn">
                                                {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="text" name="nama_guru1" value="{{ $cca->nama_guru1}}" class="form-control" placeholder ="Nama">
                                                {!! $errors->first('nama_guru1', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="ic_no_guru1" placeholder ="IC No. Eg. 00123456" value="{{ $cca->ic_no_guru1}}" class="form-control">
                                                {!! $errors->first('ic_no_guru1', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="guru_position1" value="{{ $cca->guru_position1}}" class="form-control">
                                                {!! $errors->first('guru_position1', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-control @error('jantina1') is-invalid @enderror" name="jantina1">
                                                    <option value="{{ $cca->jantina1}}">{{ $cca->jantina1}}</option>
                                                    <option value="Lelaki">Lelaki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="no_tel_guru1" value="{{ $cca->no_tel_guru1}}" class="form-control" placeholder ="Eg. 8912345">
                                                {!! $errors->first('no_tel_guru', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="email1" value="{{ $cca->email1}}" class="form-control" placeholder ="@moe.gov.bn">
                                                {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                             
                                        </td>

                                        <tr>
                                            <td>
                                                <input type="text" placeholder="Nama" name="nama_guru2" value="{{ $cca->nama_guru2}}" class="form-control">
                                                {!! $errors->first('nama_guru2', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            
                                            <td>
                                                <input type="number" name="ic_no_guru2" placeholder ="IC No. Eg. 00123456" value="{{ $cca->ic_no_guru2}}" class="form-control">
                                                {!! $errors->first('ic_no_guru2', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="guru_position2" value="{{ $cca->guru_position2}}" class="form-control">
                                                {!! $errors->first('guru_position2', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-control @error('jantina2') is-invalid @enderror" name="jantina2">
                                                <option value="{{ $cca->jantina2}}">{{ $cca->jantina2}}</option>
                                                    <option value="Lelaki">Lelaki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="number"  placeholder="Eg. 8912345" value="{{ $cca->no_tel_guru2}}" name="no_tel_guru2" class="form-control">
                                                {!! $errors->first('no_tel_guru2', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" placeholder="@moe.gov.bn" name="email2" value="{{ $cca->email2}}"class="form-control">
                                                {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <br>

                        <!-- Rendah -->
                        @if ($cca->school_name == '36' || $cca->school_name == '38' || $cca->school_name == '39'
                        ||$cca->school_name == '40' || $cca->school_name == '41' || $cca->school_name == '42'
                        ||$cca->school_name == '43' || $cca->school_name == '44' || $cca->school_name == '45'
                        ||$cca->school_name == '46' || $cca->school_name == '47' || $cca->school_name == '48'
                        ||$cca->school_name == '49' || $cca->school_name == '50' || $cca->school_name == '51'
                        ||$cca->school_name == '52' || $cca->school_name == '53' || $cca->school_name == '54'
                        ||$cca->school_name == '55' || $cca->school_name == '56' || $cca->school_name == '57'
                        ||$cca->school_name == '58' || $cca->school_name == '59' || $cca->school_name == '60'
                        ||$cca->school_name == '61' || $cca->school_name == '62' || $cca->school_name == '63'
                        ||$cca->school_name == '64' || $cca->school_name == '65' || $cca->school_name == '66'
                        ||$cca->school_name == '67' || $cca->school_name == '68' || $cca->school_name == '69'
                        ||$cca->school_name == '70' || $cca->school_name == '71' || $cca->school_name == '72'
                        ||$cca->school_name == '73' || $cca->school_name == '74' || $cca->school_name == '75'
                        ||$cca->school_name == '76' || $cca->school_name == '77' || $cca->school_name == '78'
                        ||$cca->school_name == '79' || $cca->school_name == '80' || $cca->school_name == '81'
                        ||$cca->school_name == '82' || $cca->school_name == '83' || $cca->school_name == '84'
                        ||$cca->school_name == '85' || $cca->school_name == '86' || $cca->school_name == '87'
                        ||$cca->school_name == '88' || $cca->school_name == '89' || $cca->school_name == '90'
                        ||$cca->school_name == '91' || $cca->school_name == '92' || $cca->school_name == '93'
                        ||$cca->school_name == '94' || $cca->school_name == '95' || $cca->school_name == '96'
                        ||$cca->school_name == '97' || $cca->school_name == '98' || $cca->school_name == '99'
                        ||$cca->school_name == '100' || $cca->school_name == '101' || $cca->school_name == '102'
                        ||$cca->school_name == '103' || $cca->school_name == '104' || $cca->school_name == '105'
                        ||$cca->school_name == '106' || $cca->school_name == '107' || $cca->school_name == '108'
                        ||$cca->school_name == '109' || $cca->school_name == '110' || $cca->school_name == '111'
                        ||$cca->school_name == '112' || $cca->school_name == '113' || $cca->school_name == '114'
                        ||$cca->school_name == '115' || $cca->school_name == '116' || $cca->school_name == '117'
                        ||$cca->school_name == '118' || $cca->school_name == '119' || $cca->school_name == '120'
                        ||$cca->school_name == '121' || $cca->school_name == '122' || $cca->school_name == '123'
                        ||$cca->school_name == '124' || $cca->school_name == '125' || $cca->school_name == '126'
                        ||$cca->school_name == '127' || $cca->school_name == '128' || $cca->school_name == '129'
                        ||$cca->school_name == '130' || $cca->school_name == '131' || $cca->school_name == '132'
                        ||$cca->school_name == '133' || $cca->school_name == '134' || $cca->school_name == '135'
                        ||$cca->school_name == '136' || $cca->school_name == '137' || $cca->school_name == '138'
                        ||$cca->school_name == '139' || $cca->school_name == '140' || $cca->school_name == '141'
                        ||$cca->school_name == '142' || $cca->school_name == '143' || $cca->school_name == '144'
                        ||$cca->school_name == '145' || $cca->school_name == '146' || $cca->school_name == '147'
                        ||$cca->school_name == '148' || $cca->school_name == '149' || $cca->school_name == '150'
                        ||$cca->school_name == '151' || $cca->school_name == '152' || $cca->school_name == '153' ||$cca->school_name == '155')

                        <div id="showRendah" class="myDiv"
                            style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                            <h5 class="card-title">Jadual Sesi CCA</h5>

                            <div class="card">


                                <table class="table-achiev" id="tableprestasi">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Tahun</th>
                                            <th style="text-align: center;">Jumlah Pelajar Lelaki</th>
                                            <th style="text-align: center;">Jumlah Pelajar Perempuan</th>
                                            <th style="text-align: center;">Hari</th>
                                            <th style="text-align: center;">Jam Bermula</th>
                                            <th style="text-align: center;">Jam Berakhir</th>
                                            <th style="text-align: center;">Jumlah Jam</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Pra</td>
                                            <td>
                                                <input type="text" name="jum_lelaki_pra" value="{{$cca->jum_lelaki_pra}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_pra', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_pra" value="{{$cca->jum_perempuan_pra}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_pra', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_pra" 
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_pra', '<p class="help-block text-danger">
                                                        :message</p>') !!}
                                                    <option value="{{$cca->hari_pra}}">{{$cca->hari_pra}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_pra" value="{{$cca->jam_mula_pra}}" class="form-control">
                                                {!! $errors->first('jam_mula_pra', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_pra" value="{{$cca->jam_berakhir_pra}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_pra', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td>Tahun 1</td>
                                            <td>
                                                <input type="text" name="jum_lelaki_1" value="{{$cca->jum_lelaki_1}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_1', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_1" value="{{$cca->jum_perempuan_1}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_1', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_1" 
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_1', '<p
                                                        class="help-block text-danger">:message</p>') !!}
                                                    <option value="{{$cca->hari_tahun_1}}">{{$cca->hari_tahun_1}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun1" value="{{$cca->jam_mula_tahun1}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun1', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun1" value="{{$cca->jam_berakhir_tahun1}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun1', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 2</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_2" value="{{$cca->jum_lelaki_2}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_2', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_2" value="{{$cca->jum_perempuan_2}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_2', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_2"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_2', '<p
                                                        class="help-block text-danger">:message</p>') !!}
                                                    <option value="{{$cca->hari_tahun_2}}">{{$cca->hari_tahun_2}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun2" value="{{$cca->jam_mula_tahun2}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun2', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun2" value="{{$cca->jam_berakhir_tahun2}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun2', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 3</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_3" value="{{$cca->jum_lelaki_3}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_3', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_3" value="{{$cca->jum_perempuan_3}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_3', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_3"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_3', '<p
                                                        class="help-block text-danger">:message</p>') !!}
                                                    <option value="{{$cca->hari_tahun_3}}">{{$cca->hari_tahun_3}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun3"  value="{{$cca->jam_mula_tahun3}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun3', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun3"  value="{{$cca->jam_berakhir_tahun3}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun3', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 4</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_4" value="{{$cca->jum_lelaki_4}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_4', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_4" value="{{$cca->jum_perempuan_4}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_4', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_4"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_4', '<p
                                                        class="help-block text-danger">:message</p>') !!}
                                                    <option value="{{$cca->hari_tahun_4}}">{{$cca->hari_tahun_4}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun4" value="{{$cca->jam_mula_tahun4}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun4', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun4" value="{{$cca->jam_berakhir_tahun4}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun4', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 5</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_5" value="{{$cca->jum_lelaki_5}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_5', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_5" value="{{$cca->jum_perempuan_5}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_5', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_5"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_5', '<p
                                                        class="help-block text-danger">:message</p>') !!}
                                                    <option value="{{$cca->hari_tahun_5}}">{{$cca->hari_tahun_5}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun5" value="{{$cca->jam_mula_tahun5}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun5', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun5" value="{{$cca->jam_berakhir_tahun5}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun5', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>
                                        <tr>
                                            <td>Tahun 6</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_6" value="{{$cca->jum_lelaki_6}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_6', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_6" value="{{$cca->jum_perempuan_6}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_6', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_6"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_6', '<p
                                                        class="help-block text-danger">:message</p>') !!}
                                                    <option value="{{$cca->hari_tahun_6}}">{{$cca->hari_tahun_6}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun6" value="{{$cca->jam_mula_tahun6}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun6', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun6" value="{{$cca->jam_berakhir_tahun6}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun6', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>


                                    </tbody>
                                </table>

                            </div>

                        </div>

                        <br>

                        <!-- Menengah -->
                        @elseif ($cca->school_name == '9' || $cca->school_name == '10' || $cca->school_name == '11'
                        || $cca->school_name== '12' || $cca->school_name == '13'
                        || $cca->school_name== '14' || $cca->school_name == '15'
                        || $cca->school_name== '16' || $cca->school_name == '17'
                        || $cca->school_name== '18' || $cca->school_name == '19'
                        || $cca->school_name== '20' || $cca->school_name == '21'
                        || $cca->school_name== '22' || $cca->school_name == '23'
                        || $cca->school_name== '24' || $cca->school_name == '25'
                        || $cca->school_name== '26' || $cca->school_name == '27'
                        || $cca->school_name== '28' || $cca->school_name == '29'
                        || $cca->school_name== '30' || $cca->school_name == '31'
                        || $cca->school_name== '32' || $cca->school_name == '33'
                        || $cca->school_name== '34' || $cca->school_name == '35'
                        || $cca->school_name== '37' )

                        <div id="showMenengah" class="myDiv"
                            style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                            <h5 class="card-title">Jadual Sesi CCA</h5>

                            <div class="card">


                                <table class="table-achiev" id="tableprestasi">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Tahun</th>
                                            <th style="text-align: center;">Jumlah Pelajar Lelaki</th>
                                            <th style="text-align: center;">Jumlah Pelajar Perempuan</th>
                                            <th style="text-align: center;">Hari</th>
                                            <th style="text-align: center;">Jam Bermula</th>
                                            <th style="text-align: center;">Jam Berakhir</th>
                                            <th style="text-align: center;">Jumlah Jam</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td>Tahun 7</td>
                                            <td>
                                                <input type="text" name="jum_lelaki_7" value="{{$cca->jum_lelaki_7}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_7', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_7" value="{{$cca->jum_perempuan_7}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_7', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_7"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_7', '<p
                                                        class="help-block text-danger">
                                                        :message</p>') !!}
                                                    <option value="{{$cca->hari_tahun_7}}">{{$cca->hari_tahun_7}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun7" value="{{$cca->jam_mula_tahun7}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun7', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun7" value="{{$cca->jam_berakhir_tahun7}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun7', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 8</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_8" value="{{$cca->jum_lelaki_8}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_8', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_8" value="{{$cca->jum_perempuan_8}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_8', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_8"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_8', '<p
                                                        class="help-block text-danger">
                                                        :message</p>') !!}
                                                    <option value="{{$cca->hari_tahun_8}}">{{$cca->hari_tahun_8}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun8" value="{{$cca->jam_mula_tahun8}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun8', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun8" value="{{$cca->jam_berakhir_tahun8}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun8', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 9</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_9" value="{{$cca->jum_lelaki_9}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_9', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_9" value="{{$cca->jum_perempuan_9}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_9', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_9"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_9', '<p
                                                        class="help-block text-danger">
                                                        :message</p>') !!}
                                                    <option value="{{$cca->hari_tahun_9}}">{{$cca->hari_tahun_9}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun9" value="{{$cca->jam_mula_tahun9}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun9', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun9" value="{{$cca->jam_berakhir_tahun9}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun9', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 10</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_10" value="{{$cca->jum_lelaki_10}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_10', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_10" value="{{$cca->jum_perempuan_10}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_10', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_10"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_10', '<p
                                                        class="help-block text-danger">
                                                        :message</p>') !!}
                                                    <option value="{{$cca->hari_tahun_10}}">{{$cca->hari_tahun_10}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun10" value="{{$cca->jam_mula_tahun10}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun10', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun10" value="{{$cca->jam_berakhir_tahun10}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun10', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 11</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_11" value="{{$cca->jum_lelaki_11}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_11', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_11" value="{{$cca->jum_perempuan_10}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_11', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_11"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_11', '<p
                                                        class="help-block text-danger">
                                                        :message</p>') !!}
                                                    <option value="{{$cca->hari_tahun_11}}">{{$cca->hari_tahun_11}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun11" value="{{$cca->jam_mula_tahun11}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun11', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun11" value="{{$cca->jam_berakhir_tahun11}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun11', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>

                        <br>

                        <!-- Maktab Sci -->
                        @elseif($cca->school_name == '1' )

                        <div id="showMaktabsci" class="myDiv"
                            style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                            <h5 class="card-title">Jadual Sesi CCA</h5>

                            <div class="card">


                                <table class="table-achiev" id="tableprestasi">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Tahun</th>
                                            <th style="text-align: center;">Jumlah Pelajar Lelaki</th>
                                            <th style="text-align: center;">Jumlah Pelajar Perempuan</th>
                                            <th style="text-align: center;">Hari</th>
                                            <th style="text-align: center;">Jam Bermula</th>
                                            <th style="text-align: center;">Jam Berakhir</th>
                                            <th style="text-align: center;">Jumlah Jam</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td>Tahun 7</td>
                                            <td>
                                                <input type="text" name="jum_lelaki_7" value="{{$cca->jum_lelaki_7}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_7', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_7" value="{{$cca->jum_perempuan_7}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_7', '<p
                                                    class="help-block text-danger">
                                                    :message
                                                </p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_7"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_7', '<p
                                                        class="help-block text-danger">
                                                        :message
                                                    </p>') !!}
                                                    <option value="{{$cca->hari_tahun_7}}">{{$cca->hari_tahun_7}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun7" value="{{$cca->jam_mula_tahun7}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun7', '<p
                                                    class="help-block text-danger">
                                                    :message
                                                </p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun7" value="{{$cca->jam_berakhir_tahun7}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun7', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 8</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_8" value="{{$cca->jum_lelaki_8}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_8', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_8" value="{{$cca->jum_perempuan_8}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_8', '<p
                                                    class="help-block text-danger">
                                                    :message
                                                </p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_8"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_8', '<p
                                                        class="help-block text-danger">
                                                        :message
                                                    </p>') !!}
                                                    <option value="{{$cca->hari_tahun_8}}">{{$cca->hari_tahun_8}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun8" value="{{$cca->jam_mula_tahun8}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun8', '<p
                                                    class="help-block text-danger">
                                                    :message
                                                </p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun8" value="{{$cca->jam_berakhir_tahun8}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun8', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 10</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_10" value="{{$cca->jum_lelaki_10}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_10', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_10" value="{{$cca->jum_perempuan_10}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_10', '<p
                                                    class="help-block text-danger">
                                                    :message
                                                </p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_10"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_10', '<p
                                                        class="help-block text-danger">
                                                        :message
                                                    </p>') !!}
                                                    <option value="{{$cca->hari_tahun_10}}">{{$cca->hari_tahun_10}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun10" value="{{$cca->jam_mula_tahun10}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun10', '<p
                                                    class="help-block text-danger">
                                                    :message
                                                </p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun10" value="{{$cca->jam_berakhir_tahun10}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun10', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 11</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_11" value="{{$cca->jum_lelaki_11}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_11', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_11" value="{{$cca->jum_perempuan_11}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_11', '<p
                                                    class="help-block text-danger">
                                                    :message
                                                </p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_11"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_11', '<p
                                                        class="help-block text-danger">
                                                        :message
                                                    </p>') !!}
                                                    <option value="{{$cca->hari_tahun_11}}">{{$cca->hari_tahun_11}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun11" value="{{$cca->jam_mula_tahun11}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun11', '<p
                                                    class="help-block text-danger">
                                                    :message
                                                </p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun11" value="{{$cca->jam_berakhir_tahun11}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun11', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 12</td>
                                            <td>
                                                <input type="text" name="jum_lelaki_12" value="{{$cca->jum_lelaki_12}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_12', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_12" value="{{$cca->jum_perempuan_12}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_12', '<p
                                                    class="help-block text-danger">
                                                    :message
                                                </p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_12" 
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_12', '<p
                                                        class="help-block text-danger">
                                                        :message
                                                    </p>') !!}
                                                    <option value="{{$cca->hari_tahun_12}}">{{$cca->hari_tahun_12}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun12" value="{{$cca->jam_mula_tahun12}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun12', '<p
                                                    class="help-block text-danger">
                                                    :message
                                                </p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun12" value="{{$cca->jam_berakhir_tahun12}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun12', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 13</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_13" value="{{$cca->jum_lelaki_13}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_13', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_13" value="{{$cca->jum_perempuan_13}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_13', '<p
                                                    class="help-block text-danger">
                                                    :message
                                                </p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_13"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_13', '<p
                                                        class="help-block text-danger">
                                                        :message
                                                    </p>') !!}
                                                    <option value="{{$cca->hari_tahun_13}}">{{$cca->hari_tahun_13}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun13" value="{{$cca->jam_mula_tahun13}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun13', '<p
                                                    class="help-block text-danger">
                                                    :message
                                                </p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun13" value="{{$cca->jam_berakhir_tahun13}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun8', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>

                        <br>

                        <!-- Maktab and pusat tingkatan enam -->
                        @elseif(
                        $cca->school_name== '2' ||
                        $cca->school_name == '3'|| $cca->school_name== '4' || $cca->school_name== '5' ||
                        $cca->school_name == '6' || $cca->school_name== '7'||
                        $cca->school_name == '8' )

                        <div id="showEnam" class="myDiv"
                            style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                            <h5 class="card-title">Jadual Sesi CCA</h5>

                            <div class="card">


                                <table class="table-achiev" id="tableprestasi">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Tahun</th>
                                            <th style="text-align: center;">Jumlah Pelajar Lelaki</th>
                                            <th style="text-align: center;">Jumlah Pelajar Perempuan</th>
                                            <th style="text-align: center;">Hari</th>
                                            <th style="text-align: center;">Jam Bermula</th>
                                            <th style="text-align: center;">Jam Berakhir</th>
                                            <th style="text-align: center;">Jumlah Jam</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td>Tahun 12</td>
                                            <td>
                                                <input type="text" name="jum_lelaki_12" value="{{$cca->jum_lelaki_12}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_12', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_12" value="{{$cca->jum_perempuan_12}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_12', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_12"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_12', '<p
                                                        class="help-block text-danger">:message
                                                    </p>') !!}
                                                    <option value="{{$cca->hari_tahun_12}}">{{$cca->hari_tahun_12}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun12" value="{{$cca->jam_mula_tahun12}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun12', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun12" value="{{$cca->jam_berakhir_tahun12}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun12', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 13</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_13" value="{{$cca->jum_lelaki_13}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_13', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_13" value="{{$cca->jum_perempuan_13}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_13', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_13"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_13', '<p
                                                        class="help-block text-danger">:message
                                                    </p>') !!}
                                                    <option value="{{$cca->hari_tahun_13}}">{{$cca->hari_tahun_13}}</option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun13" value="{{$cca->jam_mula_tahun13}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun13', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun13" value="{{$cca->jam_berakhir_tahun13}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun8', '<p
                                                    class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>

                        @else

                        <div id="showRendah" class="myDiv"
                            style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                            <h5 class="card-title">Jadual Sesi CCA</h5>

                            <div class="card">


                                <table class="table-achiev" id="tableprestasi">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Tahun</th>
                                            <th style="text-align: center;">Jumlah Pelajar Lelaki</th>
                                            <th style="text-align: center;">Jumlah Pelajar Perempuan</th>
                                            <th style="text-align: center;">Hari</th>
                                            <th style="text-align: center;">Jam Bermula</th>
                                            <th style="text-align: center;">Jam Berakhir</th>
                                            <th style="text-align: center;">Jumlah Jam</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Pra</td>
                                            <td>
                                                <input type="text" name="jum_lelaki_pra" value="{{$cca->jum_lelaki_pra}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_pra', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_pra" value="{{$cca->jum_perempuan_pra}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_pra', '<p
                                                    class="help-block text-danger">:message</p>
                                                ') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_pra"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_pra', '<p class="help-block text-danger">
                                                        :message</p>') !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_pra" value="{{$cca->jam_mula_pra}}" class="form-control">
                                                {!! $errors->first('jam_mula_pra', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_pra" value="{{$cca->jam_berakhir_pra}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_pra', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td>Tahun 1</td>
                                            <td>
                                                <input type="text" name="jum_lelaki_1" value="{{$cca->jum_lelaki_1}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_1', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_1" value="{{$cca->jum_perempuan_1}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_1', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_1"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_1', '<p
                                                        class="help-block text-danger">:message</p>')
                                                    !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun1" value="{{$cca->jam_mula_tahun1}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun1', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun1" value="{{$cca->jam_berakhir_tahun1}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun1', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 2</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_2" value="{{$cca->jum_lelaki_2}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_2', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_2" value="{{$cca->jum_perempuan_2}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_2', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_2"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_2', '<p
                                                        class="help-block text-danger">:message</p>')
                                                    !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun2" value="{{$cca->jam_mula_tahun2}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun2', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun2" value="{{$cca->jam_berakhir_tahun2}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun2', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 3</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_3" value="{{$cca->jum_lelaki_3}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_3', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_3" value="{{$cca->jum_perempuan_3}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_3', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_3"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_3', '<p
                                                        class="help-block text-danger">:message</p>')
                                                    !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun3" value="{{$cca->jam_mula_tahun3}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun3', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun3" value="{{$cca->jam_berakhir_tahun3}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun3', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 4</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_4" value="{{$cca->jum_lelaki_4}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_4', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_4" value="{{$cca->jum_perempuan_4}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_4', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_4"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_4', '<p
                                                        class="help-block text-danger">:message</p>')
                                                    !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun4" value="{{$cca->jam_mula_tahun4}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun4', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun4" value="{{$cca->jam_berakhir_tahun4}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun4', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 5</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_5" value="{{$cca->jum_lelaki_5}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_5', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_5" value="{{$cca->jum_perempuan_5}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_5', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_5"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_5', '<p
                                                        class="help-block text-danger">:message</p>')
                                                    !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun5" value="{{$cca->jam_mula_tahun5}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun5', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun5" value="{{$cca->jam_berakhir_tahun5}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun5', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>
                                        <tr>
                                            <td>Tahun 6</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_6" value="{{$cca->jum_lelaki_6}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_6', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_6" value="{{$cca->jum_perempuan_6}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_6', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_6 aria-label=" Default
                                                    select example">
                                                    {!! $errors->first('hari_tahun_6', '<p
                                                        class="help-block text-danger">:message</p>')
                                                    !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun6" value="{{$cca->jam_mula_tahun6}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun6', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun6" value="{{$cca->jam_berakhir_tahun6}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun6', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>


                                    </tbody>
                                </table>

                            </div>

                        </div>

                        <br>

                        <div id="showMenengah" class="myDiv"
                            style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                            <h5 class="card-title">Jadual Sesi CCA</h5>

                            <div class="card">


                                <table class="table-achiev" id="tableprestasi">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Tahun</th>
                                            <th style="text-align: center;">Jumlah Pelajar Lelaki</th>
                                            <th style="text-align: center;">Jumlah Pelajar Perempuan</th>
                                            <th style="text-align: center;">Hari</th>
                                            <th style="text-align: center;">Jam Bermula</th>
                                            <th style="text-align: center;">Jam Berakhir</th>
                                            <th style="text-align: center;">Jumlah Jam</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td>Tahun 7</td>
                                            <td>
                                                <input type="text" name="jum_lelaki_7" value="{{$cca->jum_lelaki_7}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_7', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_7" value="{{$cca->jum_perempuan_7}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_7', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_7"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_7', '<p
                                                        class="help-block text-danger">:message</p>')
                                                    !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun7" value="{{$cca->jam_mula_tahun7}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun7', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun7" value="{{$cca->jam_berakhir_tahun7}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun7', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 8</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_8" value="{{$cca->jum_lelaki_8}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_8', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_8" value="{{$cca->jum_perempuan_8}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_8', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_8"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_8', '<p
                                                        class="help-block text-danger">:message</p>')
                                                    !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun8" value="{{$cca->jam_mula_tahun8}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun8', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun8" value="{{$cca->jam_berakhir_tahun8}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun8', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 9</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_9" value="{{$cca->jum_lelaki_9}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_9', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_9" value="{{$cca->jum_perempuan_9}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_9', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_9"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_9', '<p
                                                        class="help-block text-danger">:message</p>')
                                                    !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun9" value="{{$cca->jam_mula_tahun9}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun9', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun9" value="{{$cca->jam_berakhir_tahun9}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun9', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 10</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_10" value="{{$cca->jum_lelaki_10}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_10', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_10" value="{{$cca->jum_perempuan_10}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_10', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_10"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_10', '<p
                                                        class="help-block text-danger">:message</p>
                                                    ') !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun10" value="{{$cca->jam_mula_tahun10}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun10', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun10" value="{{$cca->jam_berakhir_tahun10}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun10', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 11</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_11" value="{{$cca->jum_lelaki_11}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_11', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_11" value="{{$cca->jum_perempuan_11}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_11', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_11"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_11', '<p
                                                        class="help-block text-danger">:message</p>
                                                    ') !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun11" value="{{$cca->jam_mula_tahun11}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun11', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun11" value="{{$cca->jam_berakhir_tahun11}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun11', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>

                        <br>

                        <div id="showMaktabsci" class="myDiv"
                            style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                            <h5 class="card-title">Jadual Sesi CCA</h5>

                            <div class="card">


                                <table class="table-achiev" id="tableprestasi">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Tahun</th>
                                            <th style="text-align: center;">Jumlah Pelajar Lelaki</th>
                                            <th style="text-align: center;">Jumlah Pelajar Perempuan</th>
                                            <th style="text-align: center;">Hari</th>
                                            <th style="text-align: center;">Jam Bermula</th>
                                            <th style="text-align: center;">Jam Berakhir</th>
                                            <th style="text-align: center;">Jumlah Jam</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td>Tahun 7</td>
                                            <td>
                                                <input type="text" name="jum_lelaki_7" value="{{$cca->jum_lelaki_7}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_7', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_7" value="{{$cca->jum_perempuan_7}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_7', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_7"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_7', '<p
                                                        class="help-block text-danger">:message</p>')
                                                    !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun7" value="{{$cca->jam_mula_tahun7}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun7', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun7" value="{{$cca->jam_berakhir_tahun7}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun7', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 8</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_8" value="{{$cca->jum_lelaki_8}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_8', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_8" value="{{$cca->jum_perempuan_8}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_8', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_8"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_8', '<p
                                                        class="help-block text-danger">:message</p>')
                                                    !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun8" value="{{$cca->jam_mula_tahun8}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun8', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun8" value="{{$cca->jam_berakhir_tahun8}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun8', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 10</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_10" value="{{$cca->jum_lelaki_10}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_10', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_10" value="{{$cca->jum_perempuan_10}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_10', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_10"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_10', '<p
                                                        class="help-block text-danger">:message</p>
                                                    ') !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun10" value="{{$cca->jam_mula_tahun10}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun10', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun10" value="{{$cca->jam_berakhir_tahun10}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun10', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 11</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_11" value="{{$cca->jum_lelaki_11}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_11', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_11" value="{{$cca->jum_perempuan_11}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_11', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_11"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_11', '<p
                                                        class="help-block text-danger">:message</p>
                                                    ') !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun11" value="{{$cca->jam_mula_tahun11}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun11', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun11" value="{{$cca->jam_berakhir_tahun11}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun11', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 12</td>
                                            <td>
                                                <input type="text" name="jum_lelaki_12" value="{{$cca->jum_lelaki_12}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_12', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_12" value="{{$cca->jum_perempuan_12}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_12', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_12"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_12', '<p
                                                        class="help-block text-danger">:message</p>
                                                    ') !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun12" value="{{$cca->jam_mula_tahun12}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun12', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun12" value="{{$cca->jam_berakhir_tahun12}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun12', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 13</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_13" value="{{$cca->jum_lelaki_13}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_13', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_13" value="{{$cca->jum_perempuan_13}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_13', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_13"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_13', '<p
                                                        class="help-block text-danger">:message</p>
                                                    ') !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun13" value="{{$cca->jam_mula_tahun13}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun13', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun13" value="{{$cca->jam_berakhir_tahun13}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun8', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>

                        <br>

                        <div id="showEnam" class="myDiv"
                            style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                            <h5 class="card-title">Jadual Sesi CCA</h5>

                            <div class="card">


                                <table class="table-achiev" id="tableprestasi">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Tahun</th>
                                            <th style="text-align: center;">Jumlah Pelajar Lelaki</th>
                                            <th style="text-align: center;">Jumlah Pelajar Perempuan</th>
                                            <th style="text-align: center;">Hari</th>
                                            <th style="text-align: center;">Jam Bermula</th>
                                            <th style="text-align: center;">Jam Berakhir</th>
                                            <th style="text-align: center;">Jumlah Jam</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td>Tahun 12</td>
                                            <td>
                                                <input type="text" name="jum_lelaki_12" value="{{$cca->jum_lelaki_12}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_12', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_12" value="{{$cca->jum_perempuan_12}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_12', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_12"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_12', '<p
                                                        class="help-block text-danger">:message</p>
                                                    ') !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun12" value="{{$cca->jam_mula_tahun12}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun12', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun12" value="{{$cca->jam_berakhir_tahun12}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun12', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 13</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_13" value="{{$cca->jum_lelaki_13}}" class="form-control">
                                                {!! $errors->first('jum_lelaki_13', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_13" value="{{$cca->jum_perempuan_13}}" class="form-control">
                                                {!! $errors->first('jum_perempuan_13', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_13"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_13', '<p
                                                        class="help-block text-danger">:message</p>
                                                    ') !!}
                                                    <option></option>
                                                    <option value="Isnin">Isnin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Khamis">Khamis</option>
                                                    <option value="Jumaat">Jumaat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Ahad">Ahad</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="time" name="jam_mula_tahun13" value="{{$cca->jam_mula_tahun13}}" class="form-control">
                                                {!! $errors->first('jam_mula_tahun13', '<p
                                                    class="help-block text-danger">:message</p>')
                                                !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun13" value="{{$cca->jam_berakhir_tahun13}}" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun8', '<p
                                                    class="help-block text-danger">:message
                                                </p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>

                        @endif

                        @endforeach

                        <br>

                        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                            <h5 class="card-title">Senarai Kelab CCA</h5>

                            <div class="">


                                <div class="card-body overflow-auto">

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn2" href="#">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>


                                    @foreach( $ccas as $cca )
                                    <input type="text" name="id" class="bg-gray-200 form-control " value="{{$cca->id}}" hidden>
                                    @endforeach

                                </form>


                                    <table class="table-achiev" id="tableprestasi1">
                                        <thead>
                                            <tr>
                                            <th style="text-align: center;">Nama Kelab</th>
                                                <!-- <th style="text-align: center;">Komponen</th>
                                                <th style="text-align: center;">Kaitan</th> -->
                                                <th style="text-align: center;">Kelas</th>
                                                <th style="text-align: center;">Jantina<br>Lelaki</th>
                                                <th style="text-align: center;">Jantina<br>Perempuan</th>
                                                <th style="text-align: center;">Tindakan</th>
                                            </tr>
                                        </thead>


                                        <tbody>

                                            @if(count( $cca_senarais) == 0)

                                            <tr class="text-center">
                                                <td colspan="8">
                                                    <h5>No records found</h5>
                                                </td>
                                            </tr>

                                            @else

                                            @foreach( $cca_senarais as $cca_senarai )


                                            <tr class="text-center">


                                                <td>{{ optional($cca_senarai->namacca)->label }}</td>

                                                <td>{{$cca_senarai->tahun}}</td>

                                                <td>{{$cca_senarai->jantina_stat}}</td>

                                                <td>{{$cca_senarai->jumlah_stat}}</td>

                                                <td>
                                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                                        <form method="post" action="{{ route('cca.cca.destroysenaraiadmin', $cca_senarai->id ) }}">

                                                            @csrf
                                                            @method('post')

                                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('are you sure you want to delete?')">
                                                                <i class="bi bi-trash-fill"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>





                                            </tr>

                                            @endforeach

                                            @endif




                                        </tbody>
                                    </table>

                                         <br>



                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                                </div>
                            </div>

                        </div>

                        <br>



                       

                    

                    



                </div>

            </div>


        </div>

    </div>
    </div><!-- End Recent Sales -->

    </div>
 <script type="text/javascript">
                    $(document).ready(function() {
                      $('#addbtn2').off().on('click', function() {

                        var html = '';
                        html += '<tr>';

                                html += ' <td><select class="form-control @error('
                                CCA_Name') is-invalid @enderror" name="nama_cca[]" required autocomplete="nama_cca" autofocus><option value="" disabled selected hidden >Pilih Kelab</option>@foreach ($cca_names as $key => $value)<option value="{{ $key }}" {{ ( $key == $value)  ? 'selected' : '' }}>{{ $value }}</option>@endforeach</select></td>';
                                 
                    
                                html += ' <td><select class="form-control @error('
                                tahun ') is-invalid @enderror" name="tahun[]" required autocomplete="tahun" autofocus><option value="" disabled selected hidden >Tahun</option><option value="Pra">Pra</option><option value="Tahun 1">Tahun 1</option><option value="Tahun 2">Tahun 2</option><option value="Tahun 3">Tahun 3</option><option value="Tahun 4">Tahun 4</option><option value="Tahun 5">Tahun 5</option><option value="Tahun 6">Tahun 6</option><option value="Tahun 7">Tahun 7</option><option value="Tahun 8">Tahun 8</option><option value="Tahun 9">Tahun 9</option><option value="Tahun 10">Tahun 10</option><option value="Tahun 11">Tahun 11</option><option value="Tahun 12">Tahun 12</option><option value="Tahun 13">Tahun 13</option></select></td>';

                                html += '<td><input id="jantina_stat[]" type="text"  placeholder="Jantina Lelaki"  class="form-control @error('
                                jantina_stat ') is-invalid @enderror" name="jantina_stat[]" value="{{ old('
                                jantina_stat ') }}" required autocomplete="jantina_stat[]" autofocus></td>';

                                html += '<td><input id="jumlah_stat" type="text"  placeholder="Jantina Perempuan"  class="form-control @error('
                                jumlah_pelajar ') is-invalid @enderror" name="jumlah_stat[]" value="{{ old('
                                jumlah_pelajar ') }}" required autocomplete="jumlah_stat" autofocus></td>';

                                html += '<td style="text-align: center;"> <button class="btn btn-danger mt-2 mb-2 btn-sm  removeDeclare" type="button"><i class="bi bi-dash"></i></button></i></td>';
                                html += '</tr>';
                        $('#tableprestasi1').append(html);
                      })

                    });

                    $(document).on('click','.removeDeclare', function() {
                      $(this).parents('tr').remove();
                    });
                  </script>

                </div>
              </div>
            </div>

</section>
@endsection