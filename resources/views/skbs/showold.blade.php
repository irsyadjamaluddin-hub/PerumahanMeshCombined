@extends('layouts.app-all')

@section('title', 'Letter SKB')

@section('content')

<?php
$pagename = "SKB";
?>

<style>
  table {
    width: 50%;
    border-spacing: 1em .5em
  }


  .page-header,
  .page-header-space {
    height: 0px;
  }

  .page-footer,
  .page-footer-space {
    height: 0px;
  }

  .page-footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    border-top: 0px solid black;
    background: green;
  }

  .page-header {
    position: absolute;
    top: 0;
    width: 100%;
    border-bottom: 0px solid black;
    background: green;
  }

  .page {
    /* page-break-after: always; */
    size: A4 portrait;
  }

  @page {
    margin-top: 1.9in;
    margin-bottom: 0.8in;
    margin-left: 1in;
    margin-right: 1in;
  }

  @media print {

    /* thead {display: table-header-group;} 
      tfoot {display: table-footer-group;} */

    button,
    a,
    .btn {
      display: none;
    }
  }

  /* body * {
        visibility: hidden;
        margin: 0;
      } */

  /* .item-b{
        display: none;
      }

      .item-c{
        display: none;
      } */

  /* #section-to-print, #section-to-print * {
        visibility: visible;
      }
      #section-to-print {
        position: absolute;
        left: 0;
        top: 0;
      } */

  .page-header {
    position: fixed;
    top: 0;
  }

  .page-footer {
    position: fixed;
    bottom: 0;
  }

  /* } */

  .grid-container {
    display: grid;
    grid-template-columns: 180px 150px 320px 320px;
    background-color: white;
    padding: 10px;
  }

  .grid-item {
    background-color: rgba(255, 255, 255, 0.8);
    border: 0px solid rgba(0, 0, 0, 0.8);
    padding: 1px;
    font-size: 22px;
    font-family: "Times New Roman", Times, serif;
    text-align: 0;
  }

  .item-a {
    /* spacing */
    grid-column: 1 / 5;
    padding-top: 30px;
  }

  .item-b {
    /* Rujukan Kami:*/
    grid-column: 1/2;
    grid-row: 1/2;
  }

  .item-c {
    /* Our Reference:*/
    grid-column: 1/2;
    grid-row: 2/3;
  }

  .item-d {
    /* Folio No*/
    grid-column: 2 / span 2;
    grid-row: 2 / 3;
    text-align: left;

  }

  .item-e {
    /* Date Masehi */
    grid-column: 4/5;
    grid-row: 3/4;
    text-align: right;
  }

  .item-f {
    /* Date Hijrah */
    grid-column: 4/5;
    grid-row: 4/5;
    text-align: right;
  }

  .item-g {
    /* Yang Mulia, FUllname, Country */
    grid-column: 1/5;
  }

  .item-gg {
    /* Address, */
    grid-column: 1 / span 2;
  }

  .item-h {
    /* Title Pengiktirafan */
    grid-column: 1 / 5;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
  }

  .item-h1 {
    /* Title Pengiktirafan */
    grid-column: 1 / 5;

    grid-column: 1 / 5;
    text-align: center;
    text-justify: inter-word;

  }

  .item-i {
    /* isi surat */
    grid-column: 1 / 5;
    text-align: justify;
    text-justify: inter-word;
  }

  .item-j {
    /* slogan */
    grid-column: 1 / 5;
    text-align: center;
    font-size: 30px;
    font-family: "Edwardian Script ITC";
  }

  .item-k {
    /* SUK Signature */
    grid-column: 1 / 5;
    text-transform: Capitalize;
    text-align: center;
  }

  .item-l {
    /* Officer Code */
    grid-column: 1 / 5;
    font-size: 10px;
    vertical-align: text-top;


  }

  .item-generate {
    /* isi surat */
    grid-column: 1 / 5;
    text-align: center;
    text-justify: inter-word;
    font-size: 15px;
    position: center;
  }

  .item-mesh {
    /* isi surat */
    grid-column: 1 / 5;
    text-align: justify;
    text-justify: inter-word;
    font-size: 15px;
    position: center;
  }

  .center {
    display: block;

    margin-left: auto;
    margin-right: auto;
    width: 95%;
  }
</style>


<section class="section profile">

  @foreach($qos as $qo)

  <a href="{{action('QOController@downloadPDF', $qo->emp_qo_infos_id )}}" class="btn btn-success">Save as PDF </a>
  @endforeach

  <!-- <div id="section-to-print" class="relative bg-white"> -->







  <div class="flex justify-center py-5">


    <table class="" id="tableUser">

      <thead>
        <tr>
          <td>
            <!--place holder for the fixed-position header-->
            <div class="page-header-space">



            </div>

          </td>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>

            <!-- QO Table -->
            <div class="col-12">
              <div class="card recent-sales">
                <div class="card-body">

                  <img src="{{ asset('assets/img/letterhead.png') }}" class="center" />



                  <div class="profile-overview pt-3">


                    @foreach($biodatas as $biodata)


                    <!-- letter content -->

                    <div class="grid-container">




                      <div class="grid-item item-c"><b><i>Rujukan Kami:</i></b></div>
                      <div class="grid-item item-d">KP/MESH/SKB/{{Auth::user()->ic_no}}</div>



                      @foreach($qos as $qo)

                      <div class="grid-item item-f">{{ date('d/m/Y', strtotime($qo->start_date))}} </div>
                      @endforeach
                      <br>
                      <div class="grid-item item-a"></div>

                      <div class="grid-item item-g">Kepada Yang Berkenaan,</div>

                      <div class="grid-item item-a"></div>

                      <div class="grid-item item-h">SURAT KEBENARAN BERTUGAS</div>
                      <div class="grid-item item-h">{{$biodata->name}} [No. KP: {{Auth::user()->ic_no}}]</div>

                      @foreach($employments as $employment)
                      <div class="grid-item item-h">{{ optional($employment->department)->label }}</div>
                      @endforeach

                      @foreach($employments as $employment)
                      <div class="grid-item item-h">{{ $employment->current_designation_id }}</div>
                      @endforeach

                      <div class="grid-item item-a"></div>
                      <div class="grid-item item-i">
                        Dengan hormat sukacita merujuk sepertimana Garispanduan Prosedur Operasi Tetap (SOP)
                        Bagi Warga Perkhidmatan Awam Yang Mempunyai Kod <i>Bruhealth Merah</i> bilangan: JPM/SUT/PA/U/124
                        bertarikh 13 Rejab 1443 bersamaan dengan 14 Februari 2022. </div>

                      <div class="grid-item item-a"></div>



                      @foreach($contacts as $contact)
                      <div class="grid-item item-i">Sehubungan dengan itu, pegawai/kakitangan yang tersebut di atas adalah diberikan
                        kebenaran pergerakan (point-to-point) iaitu dari tempat kediaman <b>{{ $contact->address }} </b> dan
                        tempat bertugas <b> Blok D, Kementerian Pendidikan, Jalan Airport Lama </b> sahaja,
                        tanpa membuat persinggahan di mana-mana tempat selain daripada tempat bertugas/mengajar.</div>
                      <div class="grid-item item-a"></div>
                      @endforeach

                      <!-- @foreach($contacts as $contact)
                      <div class="grid-item item-i">Sehubungan dengan itu, pegawai/kakitangan yang tersebut di atas adalah diberikan
                        kebenaran pergerakan (point-to-point) iaitu dari tempat kediaman <b>{{ $contact->address }} </b> dan
                        tempat bertugas <b> {{ optional($employment->department)->label }}, {{ optional($employment->ministry)->label }} </b> sahaja,
                        tanpa membuat persinggahan di mana-mana tempat selain daripada tempat bertugas/mengajar.</div>
                      <div class="grid-item item-a"></div>
                      @endforeach -->

                      @foreach($qos as $qo)

                      <input type="text" value="{{$qo->emp_qo_infos_id}}" name="id" hidden>

                      <div class="grid-item item-i">Kebenaran ini bermula dari <b>{{ date('d/m/Y', strtotime($qo->start_date))}}</b> ke <b>{{ date('d/m/Y', strtotime($qo->end_date))}} </b> sahaja.</div>
                      <div class="grid-item item-a"></div>

                      @endforeach

                      <div class="grid-item item-i">Bagaimanapun, kebenaran ini akan dibatalkan jika sekiranya nama di atas mendapati hasil ujian saringan ART,
                        positif dan mempunyai simptom dan tanda jangkitan.</div>
                      <div class="grid-item item-a"></div>


                      <div class="grid-item item-i">Sekian untuk perhatian mengenainya dan sebarang pertanyaan lanjut bolehlah
                        <b>Haji Mohammad Azmi Saiful Rizal bin Haji Abdul Rahman</b> di talian <b>+673 8732105</b>.
                      </div>

                      <div class="grid-item item-a"></div>


                      <div class="grid-item item-j">"Berjimat Menggunakan Air Tanggungjawab Bersama"</div>

                      <div class="grid-item item-a"></div>

                      <div class="grid-item item-h1"> Dengan hormat,
                      </div>
                      <div class="grid-item item-a"></div>

                      <div class="grid-item item-generate">[SURAT INI DICETAK MENGGUNAKAN KOMPUTER, TIDAK MEMERLUKAN TANDATANGAN]</div>
                      <!-- <div class="grid-item item-generate">_________________________________________________________________________</div> -->


                      <!-- <div class="grid-item item-h"> HAJAH NUR AMALINA BINTI SIDIK
                      </div> -->

                      @if($qo->qo_work_places == "1")
                      <div class="grid-item item-h">PENGIRAN JEFFRYNUL HAFLI BIN PENGIRAN HAJI ALI
                      </div>
                      @elseif(($qo->qo_work_places) == "2")
                      <div class="grid-item item-h">NUR AMALINA BINTI ALI YUSRI</div>
                      @elseif(($qo->qo_work_places) == "3")
                      <div class="grid-item item-h">SITI RAMONNA BINTI HAJI ZAINAL ABIDIN</div>
                      @elseif(($qo->qo_work_places) == "4")
                      <div class="grid-item item-h">PG HJ BAHRIN BIN PG HJ SULAIMAN</div>
                      @elseif(($qo->qo_work_places) == "5")
                      <div class="grid-item item-h">ARIFFIN @ABDULLAH BIN DENG </div>
                      @elseif(($qo->qo_work_places) == "6")
                      <div class="grid-item item-h">HAJAH NUR AMALINA BINTI SIDIK</div>
                      @else
                      <div class="grid-item item-h">HJ SIASA BIN TAMBAH</div>
                      @endif



                      @if($qo->qo_work_places == "1")
                      <div class="grid-item item-h1"> Pemangku Pengarah Pentadbiran dan Perkhidmatan-Perkhidmatan</div>
                      @elseif(($qo->qo_work_places) == "2")
                      <div class="grid-item item-h1">b.p Pengarah Pentadbiran dan Perkhidmatan-Perkhidmatan</div>
                      @elseif(($qo->qo_work_places) == "3")
                      <div class="grid-item item-h1"> b.p Pengarah Pentadbiran dan Perkhidmatan-Perkhidmatan</div>
                      @elseif(($qo->qo_work_places) == "4")
                      <div class="grid-item item-h1"> b.p Pengarah Pentadbiran dan Perkhidmatan-Perkhidmatan</div>
                      @elseif(($qo->qo_work_places) == "5")
                      <div class="grid-item item-h1"> b.p Pengarah Pentadbiran dan Perkhidmatan-Perkhidmatan</div>
                      @elseif(($qo->qo_work_places) == "6")
                      <div class="grid-item item-h1"> b.p Pengarah Pentadbiran dan Perkhidmatan-Perkhidmatan</div>
                      @else
                      <div class="grid-item item-h1">b.p Pengarah Pentadbiran dan Perkhidmatan-Perkhidmatan</div>
                      @endif





                      <div class="grid-item item-h1">Kementerian Pendidikan
                      </div>


                      <div class="grid-item item-a"></div>


                      <div class="grid-item item-mesh"> <b>MOE M.E.S.H Generated Report:-</b></div>

                      <div class="grid-item item-mesh"> <i>{{$biodata->name}} </i></div>
                      <div class="grid-item item-mesh"> <i>{{Auth::user()->ic_no}}</i></div>
                      @foreach($biodatas as $biodata)
                      <div class="grid-item item-mesh"> Dose Vaccine: {{optional($biodata->vaccinedos)->label }}</div>
                      @endforeach
                      <div class="grid-item item-mesh"> Antigen Rapid Test (ART) Result:-</div>
                    </div>

                    <!-- letter end -->

                    @endforeach


                    <div>
                      <table class="table">

                        <tr>
                          <th>Hari</th>
                          <th>Tempat Bertugas</th>
                          <th>Keputusan ART</th>
                          <th>Tarik Ujian ART</th>
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
                    </div>

      <tfoot>
        <tr>
          <td>
            <!--place holder for the fixed-position footer-->
            <div class="page-footer-space"></div>
          </td>
        </tr>
      </tfoot>

    </table>
  </div>



  </div>

  @endsection