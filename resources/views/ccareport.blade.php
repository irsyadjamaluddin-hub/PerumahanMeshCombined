@extends('layouts.app-all')

@section('title', 'JPKK Report')

@section('content')

  <?php
    $pagename = "JPKKReport";
  ?>

    <div class="pagetitle">
      <h1>JPKK Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">JPKK Report</li>
        </ol>
      </nav>
    </div>

<section class="section dashboard">

  <div class="row">

      <div class="col-lg-6">
      <div class="card info-card sales-card">
      <div class="card-body">
          <h5 class="card-title">Jumlah Pelajar Seluruh Brunei Darussalam {{ date('Y') }}</h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi-people-fill"></i>
              </div>
              <div class="ps-3">
                <h6>{{ $jumlah }} pelajar</h6>
              </div>
            </div>

              <!-- Pie Chart -->
              <div id="pieChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#pieChart"), {
                    series: [{{ $jumlahLelaki }}, {{ $jumlahPerempuan }}],
                    chart: {
                      height: 350,
                      type: 'pie',
                      toolbar: {
                        show: true
                      }
                    },
                    theme: {
                        palette: 'palette2'
                    },                        
                    labels: ['Lelaki', 'Perempuan']
                  }).render();
                });
              </script>
              <!-- End Pie Chart -->              
      </div>
      </div>
      </div>

      <!-- SYIKIN ADDED CHART  -->
      <div class="col-lg-6">
      <div class="card info-card sales-card">
      <div class="card-body">
          <h5 class="card-title">Carta Jumlah Pelajar {{ date('Y') }}</h5>

              <!-- Bar Chart -->
              <div id="chart"></div>
    <script>
                            var options = {
                            series: [{
                            name: 'Lelaki',
                            data: [{{$totalRL}}, {{$totalML}}, {{$totalPL}}]
                            }, {
                            name: 'Perempuan',
                            data: [{{$totalRP}}, {{$totalMP}}, {{$totalPP}}]
                            }],
                            chart: {
                            type: 'bar',
                            height: 350,
                            stacked: true,
                            },
                            plotOptions: {
                            bar: {
                                horizontal: true,
                                dataLabels: {
                                total: {
                                    enabled: true,
                                    offsetX: 0,
                                    style: {
                                    fontSize: '13px',
                                    fontWeight: 900
                                    }
                                }
                                }
                            },
                            },
                            stroke: {
                            width: 1,
                            colors: ['#fff']
                            },
                            xaxis: {
                            categories: ['Jumlah Rendah', 'Jumlah Menengah', 'JumlahPTE']
                            },
                            yaxis: {
                            title: {
                                text: undefined
                            },
                            },
                            tooltip: {
                                enabled: true
                            },
                            fill: {
                            opacity: 1
                            },
                            legend: {
                            position: 'top',
                            horizontalAlign: 'left',
                            offsetX: 40
                            }
                            };

                            var chart = new ApexCharts(document.querySelector("#chart"), options);
                            chart.render();                            
                        </script>
              <!-- End Bar Chart -->

      </div>
      </div>      
      </div>

  </div><!-- End Row -->
<!-- end of SYIKIN ADDED CHART  -->


  <div class="row">

      <div class="col-lg-6">
      <div class="card info-card sales-card">
      <div class="card-body">
          <h5 class="card-title">Bilangan Sekolah Menghantar Data CCA {{ date('Y') }}</h5>

              <!-- Bar Chart -->
              <div id="barChartData"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#barChartData"), {
                    series: [{
                      name: 'Jumlah',
                      data: [{{$kluster1}}, {{$kluster2}}, {{$kluster3}}, {{$kluster4}}, {{$kluster5}}, {{$kluster6}}]
                    }],
                    chart: {
                      type: 'bar',
                      height: 350
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
                      categories: ['Kluster 1', 'Kluster 2', 'Kluster 3', 'Kluster 4', 'Kluster 5', 'Kluster 6'
                      ],
                    }
                  }).render();
                });
              </script>
              <!-- End Bar Chart -->

      </div>
      </div>
      </div>

      <div class="col-lg-6">
      <div class="card info-card sales-card">
      <div class="card-body">
          <h5 class="card-title">Jumlah Kelab Mengikut Komponen 2025</h5>
              <!-- Donut Chart -->
              <div id="donutChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#donutChart"), {
                    series: [{{$Fizikal}}, {{$Kerohanian}}, {{$Kreativiti}}, {{$Perkhidmatan}}],
                    chart: {
                      height: 365,
                      type: 'donut',
                      toolbar: {
                        show: true
                      }
                    },
                    labels: ['Fizikal', 'Kerohanian', 'Kreativiti', 'Perkhidmatan'],
                  }).render();
                });
              </script>
              <!-- End Donut Chart -->
      </div>
      </div>      
  </div><!-- End Row -->

  <!-- SYIKIN ADDED CHART  -->

    <div class="row">

      <div class="col-lg-6">
          <div class="card info-card sales-card">
          <div class="card-body">
              <h5 class="card-title">Pecahan Kelab Mengikut Komponen di Setiap Peringkat 2025</h5>
                  <!-- Column Chart -->
                  <div id="columnChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#columnChart"), {
                        series: [{
                          name: 'SR',
                          data: [{{$fizikalr}}, {{$kerohanianr}}, {{$kreativitir}}, {{$perkhidmatanr}}]
                        }, {
                          name: 'SM',
                          data: [{{$fizikalm}}, {{$kerohanianm}}, {{$kreativitim}}, {{$perkhidmatanm}}]
                        }, {
                          name: 'PTE',
                          data: [{{$fizikalp}}, {{$kerohanianp}}, {{$kreativitip}}, {{$perkhidmatanp}}]
                        }],
                        chart: {
                          type: 'bar',
                          height: 350
                        },
                        plotOptions: {
                          bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded'
                          },
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          show: true,
                          width: 2,
                          colors: ['transparent']
                        },
                        xaxis: {
                          categories: ['Fizikal', 'Kerohanian', 'Kreativiti', 'Perkhidmatan'],
                        },
                        fill: {
                          opacity: 1
                        },
                        tooltip: {
                          y: {
                            formatter: function(val) {
                              return val + " kelab"
                            }
                          }
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Column Chart -->
          </div>
        </div>      
      </div>

<!-- end of SYIKIN ADDED CHART  -->

      <div class="col-lg-6">
        <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title">Top 5 CCA Club 2025</h5>
        </div>

          <!-- Bar Chart -->
          <div id="barChartData"></div>

          <div class="card-body overflow-auto">
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Fizikal</th>
                    <th scope="col">Kerohanian</th>
                    <th scope="col">Kreativiti</th>
                    <th scope="col">Perkhidmatan</th>
                </tr>
            </thead>
            <tbody>
                  @php
                  $counter = 1;
                  @endphp
                  @foreach ($topFizikal as $item)
                  <tr>
                      <td>{{ $counter++ }}</td>
                      <td>
                          <span title="Occurrences: {{ $item->occurrences }}">
                              {{ $item->namacca->label }}
                          </span>
                      </td>
                      <td>
                          @if ($loop->index < count($topKerohanian))
                          <span title="Occurrences: {{ $topKerohanian[$loop->index]->occurrences }}">
                              {{ $topKerohanian[$loop->index]->namacca->label }}
                          </span>
                          @endif
                      </td>
                      <td>
                          @if ($loop->index < count($topKreativiti))
                          <span title="Occurrences: {{ $topKreativiti[$loop->index]->occurrences }}">
                              {{ $topKreativiti[$loop->index]->namacca->label }}
                          </span>
                          @endif
                      </td>
                      <td>
                          @if ($loop->index < count($topPerkhidmatan))
                          <span title="Occurrences: {{ $topPerkhidmatan[$loop->index]->occurrences }}">
                              {{ $topPerkhidmatan[$loop->index]->namacca->label }}
                          </span>
                          @endif
                      </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
<!-- end top 5chart -->
    </div>

  <div class="row" hidden>

      <div class="col-lg-6">
        <div class="card info-card sales-card">
          <div class="card-body">
              <h5 class="card-title">Jumlah Kelab Berkaitan</h5>

                  <!-- Bar Chart -->
                  <div id="barChartData3"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#barChartData3"), {
                        series: [{
                          name: 'Jumlah',
                          data: [{{$kaitan1}}, {{$kaitan2}}, {{$kaitan3}}, {{$kaitan4}},
                          {{$kaitan5}}, {{$kaitan6}}, {{$kaitan7}},
                          {{$kaitan8}}, {{$kaitan9}}, {{$kaitan10}},
                          {{$kaitan11}}, {{$kaitan12}}, {{$kaitan13}}, {{$kaitan14}}]
                        }],
                        chart: {
                          type: 'bar',
                          height: 350
                        },
                        plotOptions: {
                          bar: {
                            borderRadius: 4,
                            horizontal: true,
                          }
                        },
                        dataLabels: {
                          enabled: true
                        },
                        xaxis: {
                          categories: ['Kebudayaan', 'Kebudayaan Islam', 'Kemahiran Bahasa', 'Kesenian', 'Kesenian Islam', 'Kesihatan & Kecergasan', 'Keusahawanan', 
                                          'Khidmat Masyarakat', 'Pasukan Beruniform', 'Permainan', 'Rekreasi', 'S.T.E.A.M', 'Sukan', 'Teras'],
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Bar Chart -->
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection



<style>
<!-- top5 chart -->
    table {
        width: 75%; /* Adjust the width to your preference */
        font-size: 14px; /* Adjust the font size to your preference */
        margin: 0 auto; /* Center the table horizontally on the page */
    }

    th, td {
        padding: 6px 10px; /* Adjust the padding to your preference */
    }
</style>