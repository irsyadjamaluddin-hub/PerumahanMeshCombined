@extends('layouts.app-all')

@section('title', 'Create CCA')

@section('content')

<?php
$pagename = "CCA";
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

                    <h5 class="card-title">MAKLUMAT KELAB-KELAB SEKOLAH</h5>

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        Upload Validation Error<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <form class="" method="post" action="{{ route('cca.cca.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                            <h5 class="card-title">Keterangan Sekolah</h5>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Nama Sekolah</div>
                                <div class="col-lg-8 col-md-9">

                                   <select class="form-control select2" id="myselection" data-select2-id="myselection"  name="school_name" tabindex="-1" aria-hidden="true">
                                        <option>Select Option</option>
                                        <!-- Maktab Sains -->
                                        <option data-id="showMaktabsci" value="1">Maktab Sain PSBS</option>
                                        <!-- Tingkatan Enam -->
                                        <option data-id="showEnam" value="2">Maktab Duli Pengiran Muda Al-Muhtadee Billah</option>
                                        <option data-id="showEnam" value="3">Pusat Tingkatan Enam Belait</option>
                                        <option data-id="showEnam" value="4">Pusat Tingkatan Enam Meragang</option>
                                        <option data-id="showEnam" value="5">Pusat Tingkatan Enam Sengkurong</option>
                                        <option data-id="showEnam" value="6">Pusat Tingkatan Enam Tutong</option>
                                        <!-- Menengah -->
                                        <option data-id="showMenengah" value="7">Maktab Anthony Abell Seria</option>
                                        <option data-id="showMenengah" value="8">Maktab Sultan Omar Ali Saifuddien</option>
                                        <option data-id="showMenengah" value="9">Sekolah Tinggi Perempuan Raja Isteri</option>
                                        <option data-id="showMenengah" value="10">Sekolah Menengah Sultan Sharif Ali</option>
                                        <option data-id="showMenengah" value="11">Sekolah Menengah Awang Semaun</option>
                                        <option data-id="showMenengah" value="12">Sekolah Menengah Berakas</option>
                                        <option data-id="showMenengah" value="13">Sekolah Menengah Katok </option>
                                        <option data-id="showMenengah" value="14">Sekolah Menengah Lambak Kiri</option>
                                        <option data-id="showMenengah" value="15">Sekolah Menengah Masin</option>
                                        <option data-id="showMenengah" value="16">Sekolah Menengah Menglait</option>
                                        <option data-id="showMenengah" value="17">Sekolah Menengah Muda Hashim </option>
                                        <option data-id="showMenengah" value="18">Sekolah Menengah PAP Hajah Rashidah Sa'adatul Bolkiah</option>
                                        <option data-id="showMenengah" value="19">Sekolah Menengah Pehin Dato Seri Maharaja</option>
                                        <option data-id="showMenengah" value="20">Sekolah Menengah Pengiran Anak Puteri Hajah Masna</option>
                                        <option data-id="showMenengah" value="21">Sekolah Menengah Pengiran Isteri Hajah Mariam</option>
                                        <option data-id="showMenengah" value="22">Sekolah Menengah Pengiran Jaya Negara Pengiran Haji Abu Bakar</option>
                                        <option data-id="showMenengah" value="23">Sekolah Menengah Perdana Wazir</option>
                                        <option data-id="showMenengah" value="24">Sekolah Menengah Raja Isteri Pengiran Anak Saleha</option>
                                        <option data-id="showMenengah" value="25">Sekolah Menengah Rimba</option>
                                        <option data-id="showMenengah" value="26">Sekolah Menengah Rimba II</option>
                                        <option data-id="showMenengah" value="27">Sekolah Menengah Sayyidina Abu Bakar</option>
                                        <option data-id="showMenengah" value="28">Sekolah Menengah Sayyidina Ali</option>
                                        <option data-id="showMenengah" value="29">Sekolah Menengah Sultan Hassan Bangar, Temburong</option>
                                        <option data-id="showMenengah" value="30">Sekolah Menengah Sayyidina Husain</option>
                                        <option data-id="showMenengah" value="31">Sekolah Menengah Sayyidina Othman</option>
                                        <option data-id="showMenengah" value="32">Sekolah Menengah Sayyidina Umar Al-Khattab</option>
                                        <option data-id="showMenengah" value="33">Sekolah Menengah Sufri Bolkiah</option>
                                        <option data-id="showMenengah" value="34">Sekolah Menengah Sayyidina Hasan</option>
                                        <option data-id="showMenengah" value="35">Sekolah Menengah Sultan Muhammad Jamalul Alam</option>
                                        <option data-id="showMenengah" value="154">Sekolah Menengah Tanjong Maya Tutong</option>
                                        <!-- Rendah -->
                                        <option data-id="showRendah" value="36">Sekolah Rendah Abdul Rashid,Tanjong Maya </option>
                                        <option data-id="showMenengah" value="37">Sekolah Sukan</option>
                                        <option data-id="showRendah" value="38">Sekolah Rendah Abdul Rashid, Tanjong Maya</option>
                                        <option data-id="showRendah" value="39">Sekolah Rendah Ahmad Tajuddin</option>
                                        <option data-id="showRendah" value="40">Sekolah Rendah AHMY Katimahar</option>
                                        <option data-id="showRendah" value="41">Sekolah Rendah Amar Pahlawan</option>
                                        <option data-id="showRendah" value="42">Sekolah Rendah Amo</option>
                                        <option data-id="showRendah" value="43">Sekolah Rendah Anggerek Desa</option>
                                        <option data-id="showRendah" value="44">Sekolah Rendah Angkatan Tentera Laut</option>
                                        <option data-id="showRendah" value="45">Sekolah Rendah Bakiau</option>
                                        <option data-id="showRendah" value="46">Sekolah Rendah Batang Mitus</option>
                                        <option data-id="showRendah" value="47">Sekolah Rendah Batu Marang</option>
                                        <option data-id="showRendah" value="48">Sekolah Rendah Bebuloh</option>
                                        <option data-id="showRendah" value="49">Sekolah Rendah Bendahara Lama</option>
                                        <option data-id="showRendah" value="50">Sekolah Rendah Bendahara Sakam Bunut</option>
                                        <option data-id="showRendah" value="51">Sekolah Rendah Bengkurong</option>
                                        <option data-id="showRendah" value="52">Sekolah Rendah Benutan</option>
                                        <option data-id="showRendah" value="53">Sekolah Rendah Berakas Garisson</option>
                                        <option data-id="showRendah" value="54">Sekolah Rendah Beribi Telanai</option>
                                        <option data-id="showRendah" value="55">Sekolah Rendah Binturan</option>
                                        <option data-id="showRendah" value="56">Sekolah Rendah Birau</option>
                                        <option data-id="showRendah" value="57">Sekolah Rendah Bukit Panggal</option>
                                        <option data-id="showRendah" value="58">Sekolah Rendah Bukit Udal</option>
                                        <option data-id="showRendah" value="59">Sekolah Rendah Danau</option>
                                        <option data-id="showRendah" value="60">Sekolah Rendah Dato Basir</option>
                                        <option data-id="showRendah" value="61">Sekolah Rendah Dato Maharaja Setia Dian Sukang</option>
                                        <option data-id="showRendah" value="62">Sekolah Rendah Dato Mahawangsa Lambak</option>
                                        <option data-id="showRendah" value="63">Sekolah Rendah Dato Marsal</option>
                                        <option data-id="showRendah" value="64">Sekolah Rendah Dato Mohd Yassin</option>
                                        <option data-id="showRendah" value="65">Sekolah Rendah Dato Othman</option>
                                        <option data-id="showRendah" value="66">Sekolah Rendah Dato Pemancha Saging Ukong</option>
                                        <option data-id="showRendah" value="67">Sekolah Rendah Dato Ratna Haji Muhammad Jaafar</option>
                                        <option data-id="showRendah" value="68">Sekolah Rendah Delima Satu</option>
                                        <option data-id="showRendah" value="69">Sekolah Rendah Haji Mohd Jaafar Maun</option>
                                        <option data-id="showRendah" value="70">Sekolah Rendah Haji Mohd Salleh</option>
                                        <option data-id="showRendah" value="71">Sekolah Rendah Haji Tarif</option>
                                        <option data-id="showRendah" value="72">Sekolah Rendah Jerudong</option>
                                        <option data-id="showRendah" value="73">Sekolah Rendah Junjongan</option>
                                        <option data-id="showRendah" value="74">Sekolah Rendah Kampong Bukit</option>
                                        <option data-id="showRendah" value="75">Sekolah Rendah Kampong Bukit Beruang II</option>
                                        <option data-id="showRendah" value="76">Sekolah Rendah Kampong Mata-Mata</option>
                                        <option data-id="showRendah" value="77">Sekolah Rendah Kampong Menengah</option>
                                        <option data-id="showRendah" value="78">Sekolah Rendah Kampong Perpindahan Lambak Kanan Jalan</option>
                                        <option data-id="showRendah" value="79">Sekolah Rendah Kapok</option>
                                        <option data-id="showRendah" value="80">Sekolah Rendah Kasat</option>
                                        <option data-id="showRendah" value="81">Sekolah Rendah Katok A</option>
                                        <option data-id="showRendah" value="82">Sekolah Rendah Katok B</option>
                                        <option data-id="showRendah" value="83">Sekolah Rendah Keriam</option>
                                        <option data-id="showRendah" value="84">Sekolah Rendah Kiudang</option>
                                        <option data-id="showRendah" value="85">Sekolah Rendah Kuala Belait</option>
                                        <option data-id="showRendah" value="86">Sekolah Rendah Kupang</option>
                                        <option data-id="showRendah" value="87">Sekolah Rendah Labi</option>
                                        <option data-id="showRendah" value="88">Sekolah Rendah Labu Estate</option>
                                        <option data-id="showRendah" value="89">Sekolah Rendah Lambak Kanan Jalan</option>
                                        <option data-id="showRendah" value="90">Sekolah Rendah Lamunin</option>
                                        <option data-id="showRendah" value="91">Sekolah Rendah Lubok Pulau</option>
                                        <option data-id="showRendah" value="92">Sekolah Rendah Lumapas</option>
                                        <option data-id="showRendah" value="93">Sekolah Rendah Lumut</option>
                                        <option data-id="showRendah" value="94">Sekolah Rendah Mabohai</option>
                                        <option data-id="showRendah" value="95">Sekolah Rendah Masin</option>
                                        <option data-id="showRendah" value="96">Sekolah Rendah Melilas</option>
                                        <option data-id="showRendah" value="97">Sekolah Rendah Mentiri</option>
                                        <option data-id="showRendah" value="98">Sekolah Rendah Merangking</option>
                                        <option data-id="showRendah" value="99">Sekolah Rendah Muda Hashim</option>
                                        <option data-id="showRendah" value="100">Sekolah Rendah Muhammad Alam</option>
                                        <option data-id="showRendah" value="101">Sekolah Rendah Mulaut</option>
                                        <option data-id="showRendah" value="102">Sekolah Rendah Nakhoda Abdul Rashid Menunggol</option>
                                        <option data-id="showRendah" value="103">Sekolah Rendah Negalang</option>
                                        <option data-id="showRendah" value="104">Sekolah Rendah OKSB Kilanas</option>
                                        <option data-id="showRendah" value="105">Sekolah Rendah Paduka Seri Begawan SOAS</option>
                                        <option data-id="showRendah" value="106">Sekolah Rendah Panaga</option>
                                        <option data-id="showRendah" value="107">Sekolah Rendah Panchong</option>
                                        <option data-id="showRendah" value="108">Sekolah Rendah Panchor Murai</option>
                                        <option data-id="showRendah" value="109">Sekolah Rendah Panglima Barudin</option>
                                        <option data-id="showRendah" value="110">Sekolah Rendah Pantai Berakas</option>
                                        <option data-id="showRendah" value="111">Sekolah Rendah PAP Besar Sungai Kebun</option>
                                        <option data-id="showRendah" value="112">Sekolah Rendah Pehin Dato Jamil</option>
                                        <option data-id="showRendah" value="113">Sekolah Rendah Penanjong</option>
                                        <option data-id="showRendah" value="114">Sekolah Rendah Penapar</option>
                                        <option data-id="showRendah" value="115">Sekolah Rendah Pengiran Dipa Negara Pengiran Jaya Sengkarai</option>
                                        <option data-id="showRendah" value="116">Sekolah Rendah Pengiran Muda Mahkota</option>
                                        <option data-id="showRendah" value="117">Sekolah Rendah Pengiran Pekerma Setia Diraja Sahibul Bandar</option>
                                        <option data-id="showRendah" value="118">Sekolah Rendah Pengiran Setia Jaya Pengiran Abdul Momin</option>
                                        <option data-id="showRendah" value="119">Sekolah Rendah Pengkalan Batu</option>
                                        <option data-id="showRendah" value="120">Sekolah Rendah Pg Setia Negara Pg Mohd Yusof</option>
                                        <option data-id="showRendah" value="121">Sekolah Rendah Pintu Malim</option>
                                        <option data-id="showRendah" value="122">Sekolah Rendah PKN Bukit Beruang</option>
                                        <option data-id="showRendah" value="123">Sekolah Rendah Pulaie</option>
                                        <option data-id="showRendah" value="124">Sekolah Rendah Puni</option>
                                        <option data-id="showRendah" value="125">Sekolah Rendah Pusar Ulak</option>
                                        <option data-id="showRendah" value="126">Sekolah Rendah Putat</option>
                                        <option data-id="showRendah" value="127">Sekolah Rendah Raja Isteri Fatimah</option>
                                        <option data-id="showRendah" value="128">Sekolah Rendah Rambai</option>
                                        <option data-id="showRendah" value="129">Sekolah Rendah Rataie</option>
                                        <option data-id="showRendah" value="130">Sekolah Rendah Rimba I</option>
                                        <option data-id="showRendah" value="131">Sekolah Rendah Rimba II</option>
                                        <option data-id="showRendah" value="132">Sekolah Rendah Rimba III</option>
                                        <option data-id="showRendah" value="133">Sekolah Rendah S.U.A.S Muara</option>
                                        <option data-id="showRendah" value="134">Sekolah Rendah Saba Darat</option>
                                        <option data-id="showRendah" value="135">Sekolah Rendah Selangan</option>
                                        <option data-id="showRendah" value="136">Sekolah Rendah Selapon</option>
                                        <option data-id="showRendah" value="137">Sekolah Rendah Semabat</option>
                                        <option data-id="showRendah" value="138">Sekolah Rendah Sengkurong</option>
                                        <option data-id="showRendah" value="139">Sekolah Rendah Serasa</option>
                                        <option data-id="showRendah" value="140">Sekolah Rendah Sinaut</option>
                                        <option data-id="showRendah" value="141">Sekolah Rendah Subok</option>
                                        <option data-id="showRendah" value="142">Sekolah Rendah Sultan Abdul Bubin</option>
                                        <option data-id="showRendah" value="143">Sekolah Rendah Sultan Hasan Bangar</option>
                                        <option data-id="showRendah" value="144">Sekolah Rendah Sultan Hashim</option>
                                        <option data-id="showRendah" value="145">Sekolah Rendah Sungai Liang</option>
                                        <option data-id="showRendah" value="146">Sekolah Rendah Sungai Siamas</option>
                                        <option data-id="showRendah" value="147">Sekolah Rendah Sungai Tali</option>
                                        <option data-id="showRendah" value="148">Sekolah Rendah Sungai Teraban</option>
                                        <option data-id="showRendah" value="149">Sekolah Rendah Tanah Jambu</option>
                                        <option data-id="showRendah" value="150">Sekolah Rendah Tanjong Kindana</option>
                                        <option data-id="showRendah" value="151">Sekolah Rendah Tumpuan Telisai</option>
                                        <option data-id="showRendah" value="152">Sekolah Rendah Tungku</option>
                                        <option data-id="showRendah" value="153">Sekolah Rendah Tutong Kem</option>
                                        <option data-id="showRendah" value="155">Sekolah Rendah Orang Kaya Ali Wanika Setia Diraja Kupang</option>

                                    </select>

                                    {!! $errors->first('school_name', '<p class="help-block text-danger">:message</p>')
                                    !!}
                                </div>
                            </div>

                            {{-- School name JS --}}
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

                            <script>
                                $(function() {
                                    $('#myselection').change(function() {
                                        $('.myDiv').hide().attr('hidden', 'hidden').attr('disabled', 'disabled').find(':input').prop('disabled', true);
                                        var selectedDivId = $(this).find(':selected').data('id');
                                        $('#' + selectedDivId).show().removeAttr('hidden').removeAttr('disabled').find(':input').prop('disabled', false);
                                    });
                                });
                            </script>

                            <!-- Select2 CSS -->
                            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

                            <!-- jQuery --> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                            <!-- Select2 JS -->
                            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>



                            <script>
                                $(document).ready(function(){

                                    // Initialize select2
                                    $("#myselection").select2();

                                    // Read selected option
                                    $('#but_read').click(function(){
                                    var username = $('#myselection option:selected').text();
                                    var userid = $('#myselection').val();

                                    $('#result').html("id : " + userid + ", name : " + username);

                                    });
                                });
                            </script>

                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Kluster</div>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="kluster">
                                        <option></option>
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
                                <div class="col-lg-4 col-md-3  label">Year <br> <i></i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="number"  placeholder="Eg. 2022" min="1980" minlength="4" maxlength="4" name="year" class="form-control">
                                    {!! $errors->first('year', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>


                           <!--  <div class="row">
                                <div class="col-lg-4 col-md-3  label">Jumlah Pelajar <br> <i></i></div>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="jum_pelajar" class="form-control">
                                    {!! $errors->first('jum_pelajar', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>
 -->

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
                                                <input type="text"  placeholder="Nama" name="nama_guru" class="form-control">
                                                {!! $errors->first('nama_guru', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>

                                                <div>
                                                <input type="number" name="ic_no_guru" placeholder ="IC No. Eg. 00123456" class="form-control">
                                                {!! $errors->first('ic_no_guru', '<p class="help-block text-danger">:message</p>') !!}
                                                </div>


                                            <td>
                                                <input type="text" name="guru_position" class="form-control">
                                                {!! $errors->first('guru_position', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-control @error('jantina') is-invalid @enderror" name="jantina">
                                                    <option value=""></option>
                                                    <option value="Lelaki">Lelaki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </td>


                                            <td>
                                                <div>
                                                <input type="number"  placeholder="Eg. 8912345" name="no_tel_guru" class="form-control">
                                                {!! $errors->first('no_tel_guru', '<p class="help-block text-danger">:message</p>') !!}
                                                </div>
                                            </td>

                                            <td>
                                                <input type="text" name="email"  placeholder="@moe.gov.bn" class="form-control">
                                                {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>


                                        </tr>

                                        <tr>

                                            <td>
                                                <input type="text" placeholder="Nama" name="nama_guru1" class="form-control">
                                                {!! $errors->first('nama_guru1', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <div>
                                                <input type="number" name="ic_no_guru1" placeholder ="IC No. Eg. 00123456" class="form-control">
                                                {!! $errors->first('ic_no_guru1', '<p class="help-block text-danger">:message</p>') !!}
                                                </div>

                                            <td>
                                                <input type="text" name="guru_position1" class="form-control">
                                                {!! $errors->first('guru_position1', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>



                                            <td>
                                                <select class="form-control @error('jantina1') is-invalid @enderror" name="jantina1">
                                                    <option value=""></option>
                                                    <option value="Lelaki">Lelaki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </td>

                                            <td>
                                                <div>
                                                <input type="number"  placeholder="Eg. 8912345" name="no_tel_guru1" class="form-control">
                                                {!! $errors->first('no_tel_guru1', '<p class="help-block text-danger">:message</p>') !!}
                                                </div>
                                            </td>

                                            <td>
                                                <input type="text" placeholder="@moe.gov.bn" name="email1" class="form-control">
                                                {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>


                                        </tr>

                                        <tr>

                                            <td>
                                                <input type="text" placeholder="Nama" name="nama_guru2" class="form-control">
                                                {!! $errors->first('nama_guru2', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <div>
                                                <input type="number" name="ic_no_guru2" placeholder ="IC No. Eg. 00123456" class="form-control">
                                                {!! $errors->first('ic_no_guru2', '<p class="help-block text-danger">:message</p>') !!}
                                                </div>

                                            <td>
                                                <input type="text" name="guru_position2" class="form-control">
                                                {!! $errors->first('guru_position2', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>



                                            <td>
                                                <select class="form-control @error('jantina2') is-invalid @enderror" name="jantina2">
                                                    <option value=""></option>
                                                    <option value="Lelaki">Lelaki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </td>

                                            <td>
                                                <div>
                                                <input type="number"  placeholder="Eg. 8912345" name="no_tel_guru2" class="form-control">
                                                {!! $errors->first('no_tel_guru2', '<p class="help-block text-danger">:message</p>') !!}
                                                 </div>
                                            </td>

                                            <td>
                                                <input type="text" placeholder="@moe.gov.bn" name="email1" class="form-control">
                                                {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>


                                        </tr>

                                        
                                        <!-- Here additional dynamic row -->



                                        <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            const table = document.getElementById('tableprestasi').querySelector('tbody');
                                            const addRowButton = document.getElementById('addRow');

                                            // Function to add a new row
                                            addRowButton.addEventListener('click', function () {
                                                const newRow = document.createElement('tr');
                                                newRow.innerHTML = `
                                                    <td><input type="text" placeholder="Nama" name="add_nama_guru[]" class="form-control"></td>
                                                    <td><input type="text" placeholder="Eg. 00123456" name="add_ic_no_guru[]" class="form-control"></td>
                                                    <td><input type="text" name="add_guru_position[]" class="form-control"></td>
                                                    <td>
                                                        <select class="form-control" name="add_jantina[]">
                                                            <option value="" selected></option>
                                                            <option value="Lelaki">Lelaki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" placeholder="Eg. 8912345" name="add_no_tel_guru[]" class="form-control"></td>
                                                    <td><input type="text" placeholder="@moe.gov.bn" name="add_email[]" class="form-control"></td>
                                                    <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
                                                `;
                                                table.appendChild(newRow);
                                            });

                                            // Event delegation to remove a row
                                            table.addEventListener('click', function (event) {
                                                if (event.target && event.target.classList.contains('removeRow')) {
                                                    const row = event.target.closest('tr');
                                                    row.remove();
                                                }
                                            });
                                        });
                                    </script>


                                    </tbody>
                                </table>
                            </div>

                            
                             <!-- Button Container -->
                             <div class="d-flex justify-content-end">
                                    <button type="button" id="addRow" class="btn btn-primary mt-3">Add Row</button>
                                </div>


                        </div>

                        <br>

                        <div id="showRendah" class="myDiv"
                            style="border: 2px solid #012970; padding: 20px; border-radius: 25px;" hidden disbaled>

                            <h5 class="card-title">Jadual Sesi CCA</h5>

                            <div class="card">


                                <table class="table-achiev" id="tableprestasi">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Tahun</th>
                                            <th style="text-align: center;">Jumlah Pelajar Lelaki</th>
                                            <th style="text-align: center;">Jumlah Pelajar Lelaki Berkeperluan Khas</th>
                                            <th style="text-align: center;">Jumlah Pelajar Perempuan</th>
                                            <th style="text-align: center;">Jumlah Pelajar Perempuan Berkeperluan Khas</th>
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
                                                <input type="text" name="jum_lelaki_pra" class="form-control" >
                                                {!! $errors->first('jum_lelaki_pra', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_pra_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_pra', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_pra" class="form-control" >
                                                {!! $errors->first('jum_perempuan_pra', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_pra_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_pra', '<p
                                                    class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_pra" class="form-control">
                                                {!! $errors->first('jam_mula_pra', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_pra" class="form-control">
                                                {!! $errors->first('jam_berakhir_pra', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td>Tahun 1</td>
                                            <td>
                                                <input type="text" name="jum_lelaki_1" class="form-control" >
                                                {!! $errors->first('jum_lelaki_1', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_1_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_1', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_1" class="form-control" >
                                                {!! $errors->first('jum_perempuan_1', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_1_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_1', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_1"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_1', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun1" class="form-control">
                                                {!! $errors->first('jam_mula_tahun1', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun1" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun1', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 2</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_2" class="form-control" >
                                                {!! $errors->first('jum_lelaki_2', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_2_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_2', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_2" class="form-control" >
                                                {!! $errors->first('jum_perempuan_2', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_2_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_2', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_2"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_2', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun2" class="form-control">
                                                {!! $errors->first('jam_mula_tahun2', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun2" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun2', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 3</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_3" class="form-control" >
                                                {!! $errors->first('jum_lelaki_3', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_3_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_3', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_3" class="form-control">
                                                {!! $errors->first('jum_perempuan_3', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_3_khas" class="form-control">
                                                {!! $errors->first('jum_perempuan_3', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_3"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_3', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun3" class="form-control">
                                                {!! $errors->first('jam_mula_tahun3', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun3" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun3', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 4</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_4" class="form-control" >
                                                {!! $errors->first('jum_lelaki_4', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_4_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_4', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_4" class="form-control" >
                                                {!! $errors->first('jum_perempuan_4', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_4_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_4', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_4"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_4', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun4" class="form-control">
                                                {!! $errors->first('jam_mula_tahun4', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun4" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun4', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 5</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_5" class="form-control">
                                                {!! $errors->first('jum_lelaki_5', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_5_khas" class="form-control">
                                                {!! $errors->first('jum_lelaki_5', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_5" class="form-control" >
                                                {!! $errors->first('jum_perempuan_5', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_5_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_5', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_5"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_5', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun5" class="form-control">
                                                {!! $errors->first('jam_mula_tahun5', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun5" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun5', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>
                                        <tr>
                                            <td>Tahun 6</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_6" class="form-control" >
                                                {!! $errors->first('jum_lelaki_6', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_6_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_6', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_6" class="form-control" >
                                                {!! $errors->first('jum_perempuan_6', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_6_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_6', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_6"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_6', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun6" class="form-control">
                                                {!! $errors->first('jam_mula_tahun6', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun6" class="form-control">
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

                        <div id="showMenengah" class="myDiv"
                            style="border: 2px solid #012970; padding: 20px; border-radius: 25px;" hidden disabled>

                            <h5 class="card-title">Jadual Sesi CCA</h5>

                            <div class="card">


                                <table class="table-achiev" id="tableprestasi">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Tahun</th>
                                            <th style="text-align: center;">Jumlah Pelajar Lelaki</th>
                                            <th style="text-align: center;">Jumlah Pelajar Lelaki Berkeperluan Khas</th>
                                            <th style="text-align: center;">Jumlah Pelajar Perempuan</th>
                                            <th style="text-align: center;">Jumlah Pelajar Perempuan Berkeperluan Khas</th>
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
                                                <input type="text" name="jum_lelaki_7" class="form-control" >
                                                {!! $errors->first('jum_lelaki_7', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_7_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_7', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_7" class="form-control" >
                                                {!! $errors->first('jum_perempuan_7', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_7_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_7', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_7"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_7', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun7" class="form-control">
                                                {!! $errors->first('jam_mula_tahun7', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun7" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun7', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 8</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_8" class="form-control" >
                                                {!! $errors->first('jum_lelaki_8', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_8_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_8', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_8" class="form-control" >
                                                {!! $errors->first('jum_perempuan_8', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_8_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_8', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_8"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_8', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun8" class="form-control">
                                                {!! $errors->first('jam_mula_tahun8', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun8" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun8', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 9</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_9" class="form-control" >
                                                {!! $errors->first('jum_lelaki_9', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_9_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_9', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_9" class="form-control" >
                                                {!! $errors->first('jum_perempuan_9', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_9_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_9', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_9"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_9', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun9" class="form-control">
                                                {!! $errors->first('jam_mula_tahun9', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun9" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun9', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 10</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_10" class="form-control" >
                                                {!! $errors->first('jum_lelaki_10', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_10_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_10', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_10" class="form-control" >
                                                {!! $errors->first('jum_perempuan_10', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_10_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_10', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_10"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_10', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun10" class="form-control">
                                                {!! $errors->first('jam_mula_tahun10', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun10" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun10', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 11</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_11" class="form-control" >
                                                {!! $errors->first('jum_lelaki_11', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_11_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_11', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_11" class="form-control" >
                                                {!! $errors->first('jum_perempuan_11', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_11_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_11', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_11"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_11', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun11" class="form-control">
                                                {!! $errors->first('jam_mula_tahun11', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun11" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun11', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>

                        <br>

                        <div id="showMaktabsci" class="myDiv"
                            style="border: 2px solid #012970; padding: 20px; border-radius: 25px;" hidden disabled>

                            <h5 class="card-title">Jadual Sesi CCA</h5>

                            <div class="card">


                                <table class="table-achiev" id="tableprestasi">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Tahun</th>
                                            <th style="text-align: center;">Jumlah Pelajar Lelaki</th>
                                            <th style="text-align: center;">Jumlah Pelajar Lelaki Berkeperluan Khas</th>
                                            <th style="text-align: center;">Jumlah Pelajar Perempuan</th>
                                            <th style="text-align: center;">Jumlah Pelajar Perempuan Berkeperluan Khas</th>
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
                                                <input type="text" name="jum_lelaki_7" class="form-control" >
                                                {!! $errors->first('jum_lelaki_7', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_7_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_7', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_7" class="form-control" >
                                                {!! $errors->first('jum_perempuan_7', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_7_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_7', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_7"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_7', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun7" class="form-control">
                                                {!! $errors->first('jam_mula_tahun7', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun7" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun7', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 8</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_8" class="form-control" >
                                                {!! $errors->first('jum_lelaki_8', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_8_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_8', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_8" class="form-control" >
                                                {!! $errors->first('jum_perempuan_8', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_8_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_8', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_8"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_8', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun8" class="form-control">
                                                {!! $errors->first('jam_mula_tahun8', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun8" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun8', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 9</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_9" class="form-control" >
                                                {!! $errors->first('jum_lelaki_9', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_9_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_9', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_9" class="form-control" >
                                                {!! $errors->first('jum_perempuan_9', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_9_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_9', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_9"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_9', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun9" class="form-control">
                                                {!! $errors->first('jam_mula_tahun9', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun9" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun9', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 10</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_10" class="form-control" >
                                                {!! $errors->first('jum_lelaki_10', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_10_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_10', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_10" class="form-control" >
                                                {!! $errors->first('jum_perempuan_10', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_10_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_10', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_10"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_10', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun10" class="form-control">
                                                {!! $errors->first('jam_mula_tahun10', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun10" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun10', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 11</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_11" class="form-control" >
                                                {!! $errors->first('jum_lelaki_11', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_11_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_11', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_11" class="form-control" >
                                                {!! $errors->first('jum_perempuan_11', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_11_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_11', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_11"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_11', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun11" class="form-control">
                                                {!! $errors->first('jam_mula_tahun11', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun11" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun11', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 12</td>
                                            <td>
                                                <input type="text" name="jum_lelaki_12" class="form-control" >
                                                {!! $errors->first('jum_lelaki_12', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_12_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_12', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_12" class="form-control">
                                                {!! $errors->first('jum_perempuan_12', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_12_khas" class="form-control">
                                                {!! $errors->first('jum_perempuan_12', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_12"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_12', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun12" class="form-control">
                                                {!! $errors->first('jam_mula_tahun12', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun12" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun12', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 13</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_13" class="form-control">
                                                {!! $errors->first('jum_lelaki_13', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_13_khas" class="form-control">
                                                {!! $errors->first('jum_lelaki_13', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_13" class="form-control" >
                                                {!! $errors->first('jum_perempuan_13', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_13_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_13', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_13"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_13', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun13" class="form-control">
                                                {!! $errors->first('jam_mula_tahun13', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun13" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun8', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>

                        <br>

                        <div id="showEnam" class="myDiv"
                            style="border: 2px solid #012970; padding: 20px; border-radius: 25px;" hidden disabled>

                            <h5 class="card-title">Jadual Sesi CCA</h5>

                            <div class="card">


                                <table class="table-achiev" id="tableprestasi">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Tahun</th>
                                            <th style="text-align: center;">Jumlah Pelajar Lelaki</th>
                                            <th style="text-align: center;">Jumlah Pelajar Lelaki Berkeperluan Khas</th>
                                            <th style="text-align: center;">Jumlah Pelajar Perempuan</th>
                                            <th style="text-align: center;">Jumlah Pelajar Perempuan Berkeperluan Khas</th>
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
                                                <input type="text" name="jum_lelaki_12" class="form-control" >
                                                {!! $errors->first('jum_lelaki_12', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_12_khas" class="form-control" >
                                                {!! $errors->first('jum_lelaki_12', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_12" class="form-control">
                                                {!! $errors->first('jum_perempuan_12', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_12_khas" class="form-control">
                                                {!! $errors->first('jum_perempuan_12', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_12"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_12', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun12" class="form-control">
                                                {!! $errors->first('jam_mula_tahun12', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun12" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun12', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>Tahun 13</td>

                                            <td>
                                                <input type="text" name="jum_lelaki_13" class="form-control">
                                                {!! $errors->first('jum_lelaki_13', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_lelaki_13_khas" class="form-control">
                                                {!! $errors->first('jum_lelaki_13', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_13" class="form-control" >
                                                {!! $errors->first('jum_perempuan_13', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="text" name="jum_perempuan_13_khas" class="form-control" >
                                                {!! $errors->first('jum_perempuan_13', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <select class="form-select" name="hari_tahun_13"
                                                    aria-label="Default select example">
                                                    {!! $errors->first('hari_tahun_13', '<p
                                                        class="help-block text-danger">:message</p>') !!}
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
                                                <input type="time" name="jam_mula_tahun13" class="form-control">
                                                {!! $errors->first('jam_mula_tahun13', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td>
                                                <input type="time" name="jam_berakhir_tahun13" class="form-control">
                                                {!! $errors->first('jam_berakhir_tahun8', '<p
                                                    class="help-block text-danger">:message</p>') !!}
                                            </td>

                                            <td></td>

                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>



                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" style="margin: 20px;">Request</button>
                        </div>

                    </form>


                </div>

            </div>


        </div>

    </div>
    </div><!-- End Recent Sales -->

    </div>


</section>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script>
  $('#myselect').select2({
    width: '100%',
    placeholder: "Sekolah",
    allowClear: true
  });
</script>

@endsection
