@extends('layouts.app-all')

@section('title', 'Show CCA')

@section('content')

<?php 
$pagename = "CCA";
?>

<div class="pagetitle">
    <h1>MAKLUMAT KELAB-KELAB SEKOLAH</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">CCA</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">
    <div class="row">



        <div class="col-xl-8">
            <a href="javascript: history.back()" class="btn btn-primary">
                <i class="bi bi-arrow-left-circle"></i>
            </a>

        </div>


        <div class="card mt-3">
            <div class="card-body pt-4 profile-overview">

                @foreach($ccas as $cca)

                <div class="col" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h5 class="card-title">Keterangan Sekolah</h5>

                    <div class="row">
                        <div class="col-lg-4 col-md-3  label">Nama Sekolah <br></div>
                        <div class="col-lg-8 col-md-9">{{ optional($cca->schools)->label }}</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-3  label">Kluster<br></div>
                        <div class="col-lg-8 col-md-9">{{$cca->kluster}}</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-3  label">Year <br></div>
                        <div class="col-lg-8 col-md-9">{{$cca->year}}</div>
                    </div>

                    <!-- <div class="row">
                        <div class="col-lg-4 col-md-3  label">Jumlah Pelajar<br></div>
                        <div class="col-lg-8 col-md-9">{{$cca->jum_pelajar}}</div>
                    </div> -->
                </div>
                <br>

                <div class="col" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
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

                                    <td>{{$cca->nama_guru}}</td>

                                    <td>{{$cca->ic_no_guru}} </td>

                                    <td>{{$cca->guru_position}}</td>

                                    <td>{{$cca->jantina}}</td>

                                    <td>{{$cca->no_tel_guru}}</td>

                                    <td>{{$cca->email}}</td>
                                </tr>
                                <tr>

                                    <td>{{$cca->nama_guru1}}</td>

                                    <td>{{$cca->ic_no_guru1}} </td>

                                    <td>{{$cca->guru_position1}}</td>

                                    <td>{{$cca->jantina1}}</td>

                                    <td>{{$cca->no_tel_guru1}}</td>

                                    <td>{{$cca->email1}}</td>
                                </tr>

                                <tr>

                                    <td>{{$cca->nama_guru2}}</td>

                                    <td>{{$cca->ic_no_guru2}} </td>

                                    <td>{{$cca->guru_position2}}</td>

                                    <td>{{$cca->jantina2}}</td>

                                    <td>{{$cca->no_tel_guru2}}</td>

                                    <td>{{$cca->email2}}</td>
                                </tr>


                            </tbody>
                        </table>

                    </div>



                </div>
                <br>

                <div class="col profile-overview"
                    style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                    <h5 class="card-title">Jadual Sesi CCA</h5>

                    <div class="card">


                        <table class="table-achiev" id="tableprestasi">
                            <thead>
                                <tr>
                                    <th style="text-align: center;  width:7%">Tahun</th>
                                    <th style="text-align: center;">Jumlah Pelajar Lelaki (Keseluruhan)</th>
                                    @if ($cca->year > 2023)
                                        <th style="text-align: center;">Jumlah Pelajar Lelaki Berkeperluan Khas</th>
                                    @endif
                                    <th style="text-align: center;">Jumlah Pelajar Perempuan (Keseluruhan)</th>
                                    @if ($cca->year > 2023)
                                        <th style="text-align: center;">Jumlah Pelajar Perempuan Berkeperluan Khas</th>
                                    @endif
                                    <th style="text-align: center;">Hari</th>
                                    <th style="text-align: center;">Jam Bermula</th>
                                    <th style="text-align: center;">Jam Berakhir</th>
                                    <th style="text-align: center;  width:6.5%">Jumlah Jam</th>
                                </tr>
                            </thead>


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
                            ||$cca->school_name == '151' || $cca->school_name == '152' || $cca->school_name == '153'
                            ||$cca->school_name == '155' )

                            <tbody>
                                <!-- ShowRendah -->
                                <tr>
                                    <td>Pra</td>
                                    <td>{{$cca->jum_lelaki_pra}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_pra_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_pra}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_pra_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_pra}}</td>  

                                    @if ($cca->jam_mula_pra==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_pra))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_pra==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_pra))}}</td>
                                    @endif

                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_pra);
                                        $time2 = strtotime($cca->jam_berakhir_pra);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                                <tr>
                                    <td>Tahun 1</td>

                                    <td>{{$cca->jum_lelaki_1}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_1_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_1}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_1_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_1}}</td>

                                    @if ($cca->jam_mula_tahun1==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun1))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun1==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun1))}}</td>
                                    @endif

                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun1);
                                        $time2 = strtotime($cca->jam_berakhir_tahun1);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                                <tr>
                                    <td>Tahun 2</td>


                                    <td>{{$cca->jum_lelaki_2}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_2_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_2}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_2_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_2}}</td>

                                    @if ($cca->jam_mula_tahun2==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun2))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun2==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun2))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun2);
                                        $time2 = strtotime($cca->jam_berakhir_tahun2);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                                <tr>
                                    <td>Tahun 3</td>

                                    <td>{{$cca->jum_lelaki_3}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_3_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_3}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_3_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_3}}</td>

                                    @if ($cca->jam_mula_tahun3==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun3))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun3==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun3))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun3);
                                        $time2 = strtotime($cca->jam_berakhir_tahun3);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                                <tr>
                                    <td>Tahun 4</td>

                                    <td>{{$cca->jum_lelaki_4}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_4_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_4}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_4_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_4}}</td>

                                    @if ($cca->jam_mula_tahun4==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun4))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun4==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun4))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun4);
                                        $time2 = strtotime($cca->jam_berakhir_tahun4);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                                <tr>
                                    <td>Tahun 5</td>

                                    <td>{{$cca->jum_lelaki_5}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_5_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_5}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_5_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_5}}</td>

                                    @if ($cca->jam_mula_tahun5==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun5))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun5==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun5))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun5);
                                        $time2 = strtotime($cca->jam_berakhir_tahun5);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                                <tr>
                                    <td>Tahun 6</td>
                                    <td>{{$cca->jum_lelaki_6}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_6_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_6}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_6_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_6}}</td>

                                    @if ($cca->jam_mula_tahun6==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun6))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun6==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun6))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun6);
                                        $time2 = strtotime($cca->jam_berakhir_tahun6);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>
                                </tr>

                            </tbody>


                            <!-- showMenengah -->

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
                            || $cca->school_name== '37' || $cca->school_name== '154'|| $cca->school_name== '7'||
                            $cca->school_name == '8' )

                            <tbody>
                                <tr>
                                    <td>Tahun 7</td>

                                    <td>{{$cca->jum_lelaki_7}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_7_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_7}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_7_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_7}}</td>

                                    @if ($cca->jam_mula_tahun7==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun7))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun7==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun7))}}</td>
                                    @endif

                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun7);
                                        $time2 = strtotime($cca->jam_berakhir_tahun7);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                                <tr>
                                    <td>Tahun 8</td>


                                    <td>{{$cca->jum_lelaki_8}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_8_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_8}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_8_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_8}}</td>

                                    @if ($cca->jam_mula_tahun8==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun8))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun8==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun8))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun8);
                                        $time2 = strtotime($cca->jam_berakhir_tahun8);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                                <tr>
                                    <td>Tahun 9</td>

                                    <td>{{$cca->jum_lelaki_9}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_9_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_9}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_9_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_9}}</td>

                                    @if ($cca->jam_mula_tahun9==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun9))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun9==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun9))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun9);
                                        $time2 = strtotime($cca->jam_berakhir_tahun9);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                                <tr>
                                    <td>Tahun 10</td>

                                    <td>{{$cca->jum_lelaki_10}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_10_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_10}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_10_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_10}}</td>

                                    @if ($cca->jam_mula_tahun10==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun10))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun10==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun10))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun10);
                                        $time2 = strtotime($cca->jam_berakhir_tahun10);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                                <tr>
                                    <td>Tahun 11</td>

                                    <td>{{$cca->jum_lelaki_11}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_11_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_11}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_11_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_11}}</td>

                                    @if ($cca->jam_mula_tahun11==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun11))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun11==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun11))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun11);
                                        $time2 = strtotime($cca->jam_berakhir_tahun11);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                            </tbody>

                            <!-- showMaktabSci-->

                            @elseif($cca->school_name == '1' )

                            <tbody>
                                <tr>
                                    <td>Tahun 7</td>

                                    <td>{{$cca->jum_lelaki_7}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_7_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_7}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_7_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_7}}</td>

                                    @if ($cca->jam_mula_tahun7==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun7))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun7==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun7))}}</td>
                                    @endif

                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun7);
                                        $time2 = strtotime($cca->jam_berakhir_tahun7);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                                <tr>
                                    <td>Tahun 8</td>


                                    <td>{{$cca->jum_lelaki_8}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_8_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_8}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_8_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_8}}</td>

                                    @if ($cca->jam_mula_tahun8==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun8))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun8==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun8))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun8);
                                        $time2 = strtotime($cca->jam_berakhir_tahun8);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                                <tr>
                                    <td>Tahun 9</td>


                                    <td>{{$cca->jum_lelaki_9}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_9_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_9}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_9_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_9}}</td>

                                    @if ($cca->jam_mula_tahun9==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun9))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun9==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun9))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun9);
                                        $time2 = strtotime($cca->jam_berakhir_tahun9);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>


                                <tr>
                                    <td>Tahun 10</td>

                                    <td>{{$cca->jum_lelaki_10}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_19_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_10}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_10_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_10}}</td>

                                    @if ($cca->jam_mula_tahun10==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun10))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun10==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun10))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun10);
                                        $time2 = strtotime($cca->jam_berakhir_tahun10);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                                <tr>
                                    <td>Tahun 11</td>

                                    <td>{{$cca->jum_lelaki_11}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_11_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_11}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_11_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_11}}</td>

                                    @if ($cca->jam_mula_tahun11==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun11))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun11==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun11))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun11);
                                        $time2 = strtotime($cca->jam_berakhir_tahun11);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                                <tr>
                                    <td>Tahun 12</td>

                                    <td>{{$cca->jum_lelaki_12}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_12_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_12}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_12_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_12}}</td>

                                    @if ($cca->jam_mula_tahun12==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun12))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun12==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun12))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun12);
                                        $time2 = strtotime($cca->jam_berakhir_tahun12);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>
                                </tr>
                                
                                    <tr>
                                    <td>Tahun 13</td>

                                    <td>{{$cca->jum_lelaki_13}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_13_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_13}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_13_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_13}}</td>

                                    @if ($cca->jam_mula_tahun13==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun13))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun13==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun13))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun13);
                                        $time2 = strtotime($cca->jam_berakhir_tahun13);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                                </tr>

                            </tbody>

                            <!-- showEnam -->




                            @elseif(
                            $cca->school_name== '2' ||
                            $cca->school_name == '3'|| $cca->school_name == '4'|| $cca->school_name== '5' ||
                            $cca->school_name == '6'  )


                            <tbody>


                                <tr>
                                    <td>Tahun 12</td>

                                    <td>{{$cca->jum_lelaki_12}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_12_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_12}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_12_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_12}}</td>

                                    @if ($cca->jam_mula_tahun12==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun12))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun12null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun12))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun12);
                                        $time2 = strtotime($cca->jam_berakhir_tahun12);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                <tr>
                                    <td>Tahun 13</td>

                                    <td>{{$cca->jum_lelaki_13}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_lelaki_13_khas}} </td>
                                    @endif

                                    <td>{{$cca->jum_perempuan_13}} </td>

                                    @if ($cca->year > 2023)
                                    <td>{{$cca->jum_perempuan_13_khas}} </td>
                                    @endif

                                    <td>{{$cca->hari_tahun_13}}</td>

                                    @if ($cca->jam_mula_tahun13==null)
                                    <td> </td>
                                    @else
                                    <td>{{date('h:i A', strtotime($cca->jam_mula_tahun13))}}</td>
                                    @endif

                                    @if ($cca->jam_berakhir_tahun13==null)
                                    <td> </td>
                                    @else

                                    <td>{{date('h:i A', strtotime($cca->jam_berakhir_tahun13))}}</td>
                                    @endif
                                    <td>@php
                                        $time1 = strtotime( $cca->jam_mula_tahun13);
                                        $time2 = strtotime($cca->jam_berakhir_tahun13);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        echo $difference ;
                                        @endphp
                                        jam
                                    </td>

                                </tr>

                                </tr>

                            </tbody>

                            @else

                            <tbody>

                            </tbody>

                            @endif
                        </table>

                    </div>

                </div>

                @endforeach
                <br>

                <div class="col profile-overview"
                    style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                    <h5 class="card-title">Senarai Kelab CCA</h5>

                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        @if ($cca->year > 2023)
                        <table class="table-achiev" id="tableprestasi1">
                            <thead>
                                <tr>
                                    <th style="text-align: center; width:20%">Nama Kelab</th>
                                    <th style="text-align: center; width:20%">Nama Kelab Khusus</th>
                                    <!-- <th style="text-align: center;">Komponen</th>
                                    <th style="text-align: center;">Kaitan</th> -->
                                    <th style="text-align: center; width:10%">Tahun</th>
                                    <th style="text-align: center; width:15%">Jumlah Lelaki</th>
                                    <th style="text-align: center; width:15%">Jumlah Perempuan</th>
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

                                    <td style="width:20%">{{ optional($cca_senarai->namacca2)->label }}</td>

                                    <td style="width:20%">{{$cca_senarai->nama_cca_khusus}}</td>

                                    <td style="width:10%">{{$cca_senarai->tahun}}</td>

                                    <td style="width:15%">{{$cca_senarai->jantina_stat}}</td>

                                    <td style="width:15%">{{$cca_senarai->jumlah_stat}}</td>

                                </tr>

                                @endforeach
                                @endif

                            </tbody>
                        </table>
                        @else
                        <table class="table-achiev" id="tableprestasi1">
                            <thead>
                                <tr>
                                    <th style="text-align: center; width:20%">Nama Kelab</th>
                                    <th style="text-align: center; width:10%">Tahun</th>
                                    <th style="text-align: center; width:15%">Jumlah Lelaki</th>
                                    <th style="text-align: center; width:15%">Jumlah Perempuan</th>
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

                                    <td style="width:20%">{{ optional($cca_senarai->namacca)->label }}</td>

                                    <td style="width:10%">{{$cca_senarai->tahun}}</td>

                                    <td style="width:15%">{{$cca_senarai->jantina_stat}}</td>

                                    <td style="width:15%">{{$cca_senarai->jumlah_stat}}</td>
                                </tr>

                                @endforeach
                                @endif

                            </tbody>
                        </table>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>

</section>

@endsection