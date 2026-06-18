@extends('layouts.app-all')

@section('title', 'Users Report')

@section('content')

  <?php
    $pagename = "Report";
  ?>

    <div class="pagetitle">
      <h1>Users Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Users Report</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
    <div class="row">

            <!-- Sales Card -->
            <div class="col">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Total User</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bx bx-user"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$countUsers}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Sales Card -->
            <div class="col">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Core Education</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bx bx-buildings"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$countJabatan}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Sales Card -->
            <div class="col">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Higher Education</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bx bx-building-house"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$countSekolah}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            
        <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
          <h5 class="card-title">MOE</h5>

                          <div id="barChart0"></div>

                          <script>
                            document.addEventListener("DOMContentLoaded", () => {
                              new ApexCharts(document.querySelector("#barChart0"), {
                                series: [{
                                  data: [{{$count1}}, {{$count2}}, {{$count3}}, {{$count4}}, {{$count5}}, {{$count6}}, {{$count27}}
                                ]
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
                                  categories: ['MP', 'TMP', 'SUTCE',
                                                'SUTHE', 'TSUTCE',
                                                'TSUTHE', 'SEPADU'
                                  ],
                                }
                              }).render();
                            });
                          </script>

            </div>
          </div>
          </div>


          <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
            <h5 class="card-title">Core Education</h5>

                          <div id="barChart"></div>

                          <script>
                            document.addEventListener("DOMContentLoaded", () => {
                              new ApexCharts(document.querySelector("#barChart"), {
                                series: [{
                                  data: [{{$count7}}, {{$count23}}, {{$count8}},
                                        {{$count9}}, {{$count11}}, {{$count15}}, {{$count17}},
                                        {{$count13}}, {{$count16}}, {{$count10}}, {{$count19}},
                                        {{$count21}}, {{$count20}}, {{$count26}}, {{$count29}},
                                        {{$count30}}, {{$count33}}, {{$count31}}
                                ]
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
                                  categories: ['DG', 'DP', 'DA',
                                  'DS', 'DEM', 'JKSS', 'DC',
                                  'DE', 'JPKK', 'JPPE', 'JPKhas',
                                  'JPS', 'BICK', 'STEP', 'EdTech',
                                  'EIC','BDLTA', 'EDGE'
                                  ],
                                }
                              }).render();
                            });
                          </script>

            </div>
          </div>
          </div>


          <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
            <h5 class="card-title">Higher Education</h5>

                          <div id="barChart1"></div>

                          <script>
                            document.addEventListener("DOMContentLoaded", () => {
                              new ApexCharts(document.querySelector("#barChart1"), {
                                series: [{
                                  data: [{{$count12}},{{$count18}}, {{$count14}},
                                  {{$count22}},{{$count24}},{{$count34}},
                                  {{$count25}},{{$count36}},{{$count35}}

                                    // {{$count27}}, {{$count28}},    {{$count32}},
                                    
                                ]
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
                                  categories: ['DICT', 'DHE', 'IBTE',
                                    'JPB', 'BPA', 'MPK',
                                   'MKPK', 'SEAMEO VOCTECH', 'L3', 
                                   
                                   
                                  //  'Pusat Kerjasama Sains', 'Strategic Enterprise Performance dan Delivery Unit (SEPADU)', 'Unit Hal Ehwal Antarabangsa'
                                  ],
                                }
                              }).render();
                            });
                          </script>

            </div>
          </div>
          </div>

          
    <!-- Monthly Users Chart -->
    <div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Mesh User Registration Breakdown {{ $currentYear }}</h5>

      <div class="year-selector d-flex align-items-center mb-3">
          <button type="button" class="btn btn-sm btn-outline-primary me-2" id="prev-year">&larr;</button>
          <h5 id="selected-year" class="m-0">{{ $currentYear }}</h5>
          <button type="button" class="btn btn-sm btn-outline-primary ms-2" id="next-year">&rarr;</button>
      </div>

      <div id="monthlyUsersChart"></div>

<script>
// Year selector
document.addEventListener("DOMContentLoaded", function() {
    const prevBtn = document.getElementById("prev-year");
    const nextBtn = document.getElementById("next-year");
    const yearLabel = document.getElementById("selected-year");

    prevBtn.addEventListener("click", function() {
        let year = parseInt(yearLabel.textContent);
        updateYear(year - 1);
    });

    nextBtn.addEventListener("click", function() {
        let year = parseInt(yearLabel.textContent);
        updateYear(year + 1);
    });

    function updateYear(year) {
        window.location.href = `?year=${year}`;
    }
});
</script>

        </div>
    </div>
</div>

      <script>
        document.addEventListener("DOMContentLoaded", () => {
          const chart = new ApexCharts(document.querySelector("#monthlyUsersChart"), {
            chart: { 
              type: 'line',
              height: 360,
              toolbar: { show: true }
            },

            stroke: {
              width: 4,
              curve: 'smooth'
            },

            markers: {
              size: 6,
              colors: ['#fff'],
              strokeColors: '#008FFB',
              strokeWidth: 3,
              hover: { size: 8 }
            },

            dataLabels: {
              enabled: true,
              style: { fontSize: '12px', fontWeight: 'bold' },
              background: { enabled: true, borderRadius: 4 }
            },

            series: [
              {
                name: "Users",
                data: @json($monthlyTotalUsers)
              }
            ],

            xaxis: {
              categories: [
                'January {{ $currentYear }}', 'February {{ $currentYear }}', 'March {{ $currentYear }}',
                'April {{ $currentYear }}', 'May {{ $currentYear }}', 'June {{ $currentYear }}',
                'July {{ $currentYear }}', 'August {{ $currentYear }}', 'September {{ $currentYear }}',
                'October {{ $currentYear }}', 'November {{ $currentYear }}', 'December {{ $currentYear }}'
              ],
              labels: {
                rotate: -45,
                style: { fontSize: '12px' }
              }
            },

            yaxis: {
              min: 0,
              labels: { style: { fontSize: '12px' } }
            },

            tooltip: { theme: "light" }
          });

          chart.render();
        });
      </script>
    </div>
  </div>
</div>

</div>
</section>


@endsection