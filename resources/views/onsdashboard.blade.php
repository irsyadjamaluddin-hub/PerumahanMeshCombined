@extends('layouts.app-all')

@section('title', 'ONS Dashboard Report')

@section('content')

@yield('content')

@yield('javascript')

  <?php
    $pagename = "ONS Dashboard Report";
  ?>

<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.0/dist/apexcharts.min.js"></script>


    <div class="pagetitle">
      <h1>ONS Dashboard Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">ONS Dashboard Report</li>
        </ol>
      </nav>
    </div>

<section class="section dashboard">

  <div class="row">

  <div class="row">

        <style>
            /* Style for the larger icon */
            .large-icon {
                font-size: 48px; /* Adjust the icon size as needed */
            }

            /* Style for the biggest text size */
            .biggest-text {
                font-size: 36px; /* Adjust the text size as needed */
            }
        </style>
   

     <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">TAHUN 2023</h5>

 
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Jumlah Penggunaan ONS Tahun 2023</h5>

                <div class="d-flex flex-column align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center mb-2">
                        <i class="bi-people-fill large-icon"></i>
                    </div>
                    <div>
                        <h6 class="biggest-text">{{ $jumlah }}</h6>
                    </div>
                </div>
            </div>
        </div>

     <div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Pengunaan ONS Tahun 2023</h5>

            <!-- Line Chart -->
            <div id="lineChart"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
    const chartData = {!! json_encode($monthlyCounts) !!};

    if (chartData.length > 0) {
        // Convert month_year values to JavaScript Date objects
        chartData.forEach(item => {
            item.month_year = new Date(item.month_year);
        });

        // Sort the data by Date objects
        chartData.sort((a, b) => a.month_year - b.month_year);

        const counts = chartData.map(item => item.count);
        const labels = chartData.map(item => item.month_year.toLocaleDateString('en-US', { month: 'long', year: 'numeric' }));

        new ApexCharts(document.querySelector("#lineChart"), {
            series: [{
                name: "ONS",
                data: counts
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: true,
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                categories: labels,
            }
        }).render();
    }
});

            </script>
        </div>
    </div>
              </div>

            


    <div class="col-lg-6">
      <div class="card info-card sales-card">
      <div class="card-body">
          <h5 class="card-title">Jabatan Yang Menggunakan ONS</h5>

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

      <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">TAHUN 2024</h5>

              <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Jumlah Penggunaan ONS Tahun 2024</h5>

                <div class="d-flex flex-column align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center mb-2">
                        <i class="bi-people-fill large-icon"></i>
                    </div>
                    <div>
                        <h6 class="biggest-text">{{ $jumlah2024 }}</h6>
                    </div>
                </div>
            </div>
        </div>


     <div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Pengunaan ONS Tahun 2024</h5>

            <!-- Line Chart -->
            <div id="lineChart2024"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
    const chartData = {!! json_encode($monthlyCounts2024) !!};

    if (chartData.length > 0) {
        // Convert month_year values to JavaScript Date objects
        chartData.forEach(item => {
            item.month_year = new Date(item.month_year);
        });

        // Sort the data by Date objects
        chartData.sort((a, b) => a.month_year - b.month_year);

        const counts = chartData.map(item => item.count);
        const labels = chartData.map(item => item.month_year.toLocaleDateString('en-US', { month: 'long', year: 'numeric' }));

        new ApexCharts(document.querySelector("#lineChart2024"), {
            series: [{
                name: "ONS",
                data: counts
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: true,
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                categories: labels,
            }
        }).render();
    }
});

            </script>
        </div>
    </div>
              </div>

              <!-- year 2025 ekma add 22/10/25-->

              <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">TAHUN 2025</h5>

<div class="card info-card sales-card">
    <div class="card-body">
        <h5 class="card-title">Jumlah Penggunaan ONS Tahun 2025</h5>

        <div class="d-flex flex-column align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center mb-2">
                <i class="bi-people-fill large-icon"></i>
            </div>
            <div>
                <h6 class="biggest-text">{{ $jumlah2025 }}</h6>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Penggunaan ONS Tahun 2025</h5>

            <!-- Line Chart -->
            <div id="lineChart2025"></div>

            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const chartData = {!! json_encode($monthlyCounts2025) !!};

                    if (chartData.length > 0) {
                        // Convert month_year values to JavaScript Date objects
                        chartData.forEach(item => {
                            item.month_year = new Date(item.month_year);
                        });

                        // Sort the data by Date objects
                        chartData.sort((a, b) => a.month_year - b.month_year);

                        const counts = chartData.map(item => item.count);
                        const labels = chartData.map(item => 
                            item.month_year.toLocaleDateString('en-US', { month: 'long', year: 'numeric' })
                        );

                        new ApexCharts(document.querySelector("#lineChart2025"), {
                            series: [{
                                name: "ONS",
                                data: counts
                            }],
                            chart: {
                                height: 350,
                                type: 'line',
                                zoom: {
                                    enabled: false
                                }
                            },
                            dataLabels: {
                                enabled: true,
                            },
                            stroke: {
                                curve: 'smooth'
                            },
                            xaxis: {
                                categories: labels,
                            }
                        }).render();
                    }
                });
            </script>
        </div>
    </div>
</div>

               <!-- end year 2025 -->


   

  </div>





</section>
@endsection