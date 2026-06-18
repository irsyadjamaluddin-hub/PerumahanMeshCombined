@extends('layouts.app-all')

@section('title', 'Status Jawatan Kosong Report')

@section('content')

@yield('content')

@yield('javascript')

  <?php
    $pagename = "Status Jawatan Kosong Report";
  ?>

<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.0/dist/apexcharts.min.js"></script>


    <div class="pagetitle">
      <h1>Status Jawatan KosongReport</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Status Jawatan Kosong Report (SJK)</li>
        </ol>
      </nav>
    </div>

<section class="section dashboard">

  <div class="row">

    <div class="col-lg-6">
      <div class="card info-card sales-card">
      <div class="card-body">
          <h5 class="card-title">Jumlah Jawatan Kosong Mengikut Bahagian</h5>

              <!-- Pie Chart -->
              <div id="pieChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#pieChart"), {
                    series: [{{ $bhg1 }}, {{ $bhg2 }},{{ $bhg3 }},{{ $bhg4 }},{{ $bhg5 }}],
                    chart: {
                      height: 300,
                      type: 'pie',
                      toolbar: {
                        show: true
                      }
                    },
                    theme: {
                        palette: 'palette2'
                    },                        
                    labels: ['Bahagian I', 'Bahagian II','Bahagian III','Bahagian IV','Bahagian v']
                  }).render();
                });
              </script>
              <!-- End Pie Chart -->              
      </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card info-card sales-card">
      <div class="card-body">
          <h5 class="card-title">Status Jawatan Kosong</h5>

            <div id="chartkosong"></div>
              <script>
                var options = {
                  series: [{
                              name: 'Proses Jabatan',
                              data: [{{$prosesjabatan1}}, {{$prosesspa1}}, {{$jupamoe1}}, {{$dipangku1}},{{$tradeoff1}}]
                            }, {
                              name: 'Proses SPA',
                              data: [{{$prosesjabatan2}}, {{$prosesspa2}}, {{$jupamoe2}}, {{$dipangku2}} ,{{$tradeoff2}}]
                            }, {
                              name: 'Ditetapkan Jawatan',
                              data: [{{$prosesjabatan3}}, {{$prosesspa3}}, {{$jupamoe3}}, {{$dipangku3}}, ,{{$tradeoff3}}]
                            }, {
                              name: 'Di Pangku',
                              data: [{{$prosesjabatan4}}, {{$prosesspa4}}, {{$jupamoe4}}, {{$dipangku4}}, ,{{$tradeoff4}}]
                            }, {
                              name: 'Tradeoff',
                              data: [{{$prosesjabatan5}}, {{$prosesspa5}}, {{$jupamoe5}}, {{$dipangku5}}, ,{{$tradeoff5}}]
                            }],
                  chart: {
                  type: 'bar',
                  height: 285
                },
                plotOptions: {
                  bar: {
                    // barHeight: '100%',
                    horizontal: false, //true: bar horizontal, false: bar vertical
                    dataLabels: {
                      position: 'top',
                    },
                  }
                },
                dataLabels: {
                  enabled: false,
                  offsetX: -6,
                  style: {
                    fontSize: '12px',
                    colors: ['#0']
                  }
                },
                stroke: {
                  show: true,
                  width: 1,
                  colors: ['#fff']
                },
                tooltip: {
                  shared: true,
                  intersect: false
                },
                xaxis: {
                  categories: [
                    ['I'],
                    ['II'],
                    ['III'],
                    
                    ['IV'],
                    ['V']
                  
                  ],
                },
                yaxis: {
                  labels: {
                    style: {
                      fontSize: '15px'
                    }
                  },                              
                },
                };

                var chart = new ApexCharts(document.querySelector("#chartkosong"), options);
                chart.render();
              </script>

          </div>
        <!-- End of Chart by JABATAN -->

      </div>
      </div>      
    </div>

  </div>

  <div class="row">

    <div class="col-lg-6">
      <div class="card info-card sales-card">
      <div class="card-body">
          <h5 class="card-title">Status Jawatan Kosong Mengikut Jabatan</h5>

              <div id="Chartdept"></div>

              
                          <script>
                            document.addEventListener("DOMContentLoaded", () => {
                              new ApexCharts(document.querySelector("#Chartdept"), {
                                series: [{
                                  data: [{{$jumlahdept1}}, {{$jumlahdept2}}, {{$jumlahdept3}},
                                        {{$jumlahdept4}}, {{$jumlahdept5}},
                                        {{$jumlahdept6}},
                                        {{$jumlahdept7}}, 
                                        {{$jumlahdept8}}, 
                                        {{$jumlahdept9}},
                                        {{$jumlahdept10}},
                                        {{$jumlahdept11}},
                                        {{$jumlahdept12}},
                                        {{$jumlahdept13}},
                                        {{$jumlahdept14}},
                                        {{$jumlahdept15}},
                                        {{$jumlahdept16}},
                                        {{$jumlahdept17}},
                                        {{$jumlahdept18}},
                                        {{$jumlahdept19}},
                                        {{$jumlahdept20}},
                                        {{$jumlahdept21}},
                                        {{$jumlahdept22}},
                                        {{$jumlahdept23}},
                                        {{$jumlahdept24}},
                                        {{$jumlahdept25}},
                                        {{$jumlahdept26}},
                                        {{$jumlahdept27}},
                                        {{$jumlahdept28}},
                                        {{$jumlahdept29}},
                                        {{$jumlahdept30}},
                                        {{$jumlahdept31}},
                                        {{$jumlahdept32}},
                                        {{$jumlahdept33}},
                                        {{$jumlahdept34}},
                                        {{$jumlahdept35}}
                                ]
                                }],
                                chart: {
                                  type: 'bar',
                                  height: 650
                                },
                                plotOptions: {
                                  bar: {
                                    borderRadius: 4,
                                    horizontal: true,
                                  }
                                },
                                dataLabels: {
                                  enabled: false
                                },
                                xaxis: {
                                  categories: [ 
                                    'MP', 
                      'TMP',
                      'SUT(CE)',
                      'SUT(HE)',
                      'TSUT(CE)', 
                      'TSUT(HE)',
                      'DG',
                      'DA',
                       'JSS',
                       'JPPE',
                      'JPP', 
                      'DICT',
                      'DE',
                      'IBTE', 
                      'JKSS',
                      'DCC',
                      'DC',
                       'DHE',
                       'JPK',
                      'CCD',
                       'JPS',
                       'JPB',
                      'DP', 
                      'IRD',
                      'MKPK', 
                      'SEPADU',
                      'BDLTA',
                      'EdTech', 
                      'EIC',
                      'EDGE',
                      'UHEA',
                      'MPK',
                      'L3C',
                      'SEAMEO'
                                  ],
                                }
                              }).render();
                            });
                          </script>
              <!-- End Column Chart -->



      </div>
      </div>      
    </div>


    <div class="col-lg-6">
      <div class="card info-card sales-card">
      <div class="card-body">
          <h5 class="card-title">Status Jawatan Kosong Mengikut Jawatan</h5>

              <div id="Chartdept"></div>

              <div class="card-body overflow-auto">
                  <table class="table table-borderless datatable mt-3">
                      <thead>
                          <tr>
                              <th scope="col">Jawatan</th>
                              <th scope="col">Status</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($sumJawatanList as $item)
                            <tr>
                                <td>  {{ optional($item->Jawatan)->label}}</td>
                              
                                <td>{{ $item->total_kosong }}</td>
                            </tr>
                        @endforeach
                      </tbody>  
                  </table>
              </div>

        
      </div>
      </div>      
    </div>

  </div>





</section>
@endsection