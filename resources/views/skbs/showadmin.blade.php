@extends('layouts.app-all')

@section('title', 'Admin Letter SKB')

@section('content')

<style>
#customers {
    width: 100%;
    border: 1px solid;
}

#customers td, #customers th {
    font-size: 11px;
    text-align: center;
}

#customers th {
    font-size: 11px;
    border-bottom: 0.5px solid;
    text-align: center;
}

hr {
    border-width: 0.5px;
}
</style>

<?php
$pagename = "SKB";
?>

<div class="pagetitle">
    <h1>Letter SKB</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Letter SKB</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="col" style="text-align: center; padding-bottom: 5px; padding-top: 0px;">
@foreach($qos as $qo)
<a href="{{action('QOController@downloadadminPDF', $qo->emp_qo_infos_id )}}" class="btn btn-success">Save as PDF</a>
@endforeach
</div>

    <section class="section" style="font-family: Times New Roman, Times, serif;">

      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
            <div class="container" style="padding: 0in;">

<div class="row">
<div class="col">
<img src="{{ asset('assets/img/letterhead.png') }}" style="width: 100%; pointer-events: none;"/>
<div>
</div>

<br>
@foreach($biodatas as $biodata)
<div class="row">
<div class="col">
<table style= "width: 100%; font-size: 14px;">
    <tr>
    <td style="text-align: left;"><b><i>Rujukan Kami:</i></b> KP/MESH/SKB/{{$qo->ic_no}}</td>
    <td style="text-align: right;">
    @foreach($qos as $qo)
    {{ date('d/m/Y', strtotime($qo->start_date))}}
    @endforeach
    </td>
    </tr>
</table>
</div>
</div>

<br>
<br>
<div class="row">
<div class="col" style="font-size: 14px;">
Kepada Yang Berkenaan,
</div>
</div>

<br>
<div class="row">
<div class="col" style="display: center; text-align: center; font-weight: bold; text-transform: uppercase; font-size: 14px;">
SURAT KEBENARAN BERTUGAS
<br>
{{$biodata->name}} [No. KP: {{$qo->ic_no}}]
<br>
@foreach($employments as $employment)
{{ optional($employment->department)->label }}
@endforeach
<br>
@foreach($employments as $employment)
{{ $employment->current_designation_id }}
@endforeach
</div>
</div>

<br>
<div class="row" style="text-align: justify; font-size: 14px;">
<div class="col">
Dengan hormat sukacita merujuk sepertimana Garispanduan Prosedur Operasi Tetap (SOP) Bagi Warga Perkhidmatan Awam Yang Mempunyai Kod 
<i>Bruhealth Merah</i> bilangan: JPM/SUT/PA/U/124 bertarikh 13 Rejab 1443 bersamaan dengan 14 Februari 2022.
<br>
<br>
@foreach($contacts as $contact)
Sehubungan dengan itu, pegawai/kakitangan yang tersebut di atas adalah diberikan
kebenaran pergerakan (point-to-point) iaitu dari tempat kediaman <b>{{ $contact->address }}</b> dan
tempat bertugas <b>Blok D, Kementerian Pendidikan, Jalan Airport Lama</b> sahaja,
tanpa membuat persinggahan di mana-mana tempat selain daripada tempat bertugas/mengajar.
@endforeach
<br>
<br>
@foreach($qos as $qo)
Kebenaran ini bermula dari <b>{{ date('d/m/Y', strtotime($qo->start_date))}}</b> ke <b>{{ date('d/m/Y', strtotime($qo->end_date))}} </b>sahaja.
@endforeach
<br>
<br>
Bagaimanapun, kebenaran ini akan dibatalkan jika sekiranya nama di atas mendapati hasil ujian saringan ART,
positif dan mempunyai simptom dan tanda jangkitan.
<br>
<br>
Sekian untuk perhatian mengenainya dan sebarang pertanyaan lanjut bolehlah menghubungi
<b>Haji Mohammad Azmi Saiful Rizal bin Haji Abdul Rahman</b> di talian <b>+673 8732105</b>.
</div>
</div>

<br>
<div class="row" style= "text-align: center; font-size: 14px;">
<div class="col">
<i>"Berjimat Menggunakan Air Tanggungjawab Bersama"</i>
</div>
</div>

<br>
<div class="row" style= "text-align: center; font-size: 13px;">
<div class="col">
[SURAT INI DICETAK MENGGUNAKAN SISTEM, TIDAK MEMERLUKAN TANDATANGAN]
</div>
</div>

<hr>

<div class="row" style= "text-align: center; font-size: 14px;">
<div class="col">
<b><i>MOE M.E.S.H. Generated Report:-</i></b>
</div>
</div>

<br>

<div class="row" style= "font-size: 14px;">
<div class="col">
                <i>{{$biodata->name}}</i>
                <br>
                <i>{{$biodata->ic_no}}</i>
                <br>
                @foreach($biodatas as $biodata)
                <i>Dose Vaccine: {{optional($biodata->vaccinedos)->label }}</i>
                @endforeach
                </table>
                </td>
                <!-- letter end -->
                @endforeach
<br>
<br>
@php $id = Crypt::encrypt($qo->emp_qo_infos_id); @endphp

{!! QrCode::size(100)->generate("http://127.0.0.1:8000/verify/$id"); !!}


</div>

<div class="col">
<b><i>Antigen Rapid Test (ART) Result:-</i></b>
                <br>
                <br>
                    <table id="customers" >
                        <tr>
                            <th>Hari</th>
                            <th>Tempat Bertugas</th>
                            <th>Keputusan ART</th>
                            <th>Tarikh Ujian ART</th>
                        </tr>


                        <tbody>
                            <tr>

                                <td>Ke-1</td>

                                @if(count($artday1) == 0)
                                <td></td>


                                @else
                                @foreach($artday1 as $art1)
                                <td>{{$art1->work_place}}</td>

                                <td>
                                    @if($art1->art_result == "-ve")
                                    <span class="badge bg-success">Negative</span>
                                    @elseif(($art1->art_result) == "+ve")
                                    <span class="badge bg-danger">Positive</span>
                                    @else
                                    <span class="badge bg-warning">Invalid</span>
                                    @endif
                                </td>


                                <td>{{ date('d/m/Y', strtotime($art1->date_test)) }}</td>
                                @endforeach
                                @endif

                            </tr>

                            <tr>

                                <td>Ke-2</td>
                                @if(count($artday2) == 0)
                                <td></td>


                                @else
                                @foreach($artday2 as $art2)

                                <td>{{$art2->work_place}}</td>

                                <td>
                                    @if($art2->art_result == "-ve")
                                    <span class="badge bg-success">Negative</span>
                                    @elseif(($art2->art_result) == "+ve")
                                    <span class="badge bg-danger">Positive</span>
                                    @else
                                    <span class="badge bg-warning">Invalid</span>
                                    @endif
                                </td>

                                <td>{{ date('d/m/Y', strtotime($art2->date_test)) }}</td>

                                @endforeach
                                @endif

                            </tr>

                            <tr>

                                <td>Ke-3</td>
                                @if(count($artday3) == 0)
                                <td></td>

                                @else
                                @foreach($artday3 as $art3)

                                <td>{{$art3->work_place}}</td>

                                <td>
                                    @if($art3->art_result == "-ve")
                                    <span class="badge bg-success">Negative</span>
                                    @elseif(($art3->art_result) == "+ve")
                                    <span class="badge bg-danger">Positive</span>
                                    @else
                                    <span class="badge bg-warning">Invalid</span>
                                    @endif
                                </td>

                                <td>{{ date('d/m/Y', strtotime($art3->date_test)) }}</td>

                                @endforeach
                                @endif

                            </tr>

                            <tr>

                                <td>Ke-4</td>
                                @if(count($artday4) == 0)
                                <td></td>



                                @else
                                @foreach($artday4 as $art4)

                                <td>{{$art4->work_place}} </td>

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

                                @endforeach
                                @endif
                            </tr>


                            <tr>

                                <td>Ke-5</td>
                                @if(count($artday5) == 0)
                                <td></td>


                                @else
                                @foreach($artday5 as $art5)

                                <td>{{$art5->work_place}}</td>



                                <td>
                                    @if($art5->art_result == "-ve")
                                    <span class="badge bg-success">Negative</span>
                                    @elseif(($art5->art_result) == "+ve")
                                    <span class="badge bg-danger">Positive</span>
                                    @else
                                    <span class="badge bg-warning">Invalid</span>
                                    @endif
                                </td>

                                <td> {{ date('d/m/Y', strtotime($art5->date_test)) }}</td>



                                @endforeach
                                @endif
                            </tr>

                        </tbody>
                </td>

</tr>

</table>

</div>
</div>

<br>
</div><!-- container -->
            </div>
          </div>

        </div>

      </div>
    </section>

@endsection