@extends('layouts.app-all')

@section('title', 'ART Report')

@section('content')

  <?php
    $pagename = "ARTReport";
  ?>

    <div class="pagetitle">
      <h1>ART Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">ART Report</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
    <div class="row">

            <!-- Sales Card -->
            <div class="col-lg-4">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Total ART Uploaded</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi-person-lines-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$countAll}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Sales Card -->
            <div class="col-lg-4">
              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Positive</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi-person-plus-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$countPositive}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Sales Card -->
            <div class="col-lg-4">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Negative</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi-person-dash-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$countNegative}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">ART Result</h5>

              <!-- Pie Chart -->
              <div id="pieChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#pieChart"), {
                    series: [{{$countPositive}}, {{$countNegative}}],
                    chart: {
                      height: 350,
                      type: 'pie',
                      toolbar: {
                        show: true
                      }
                    },
                    labels: ['Positive', 'Negative']
                  }).render();
                });
              </script>
              <!-- End Pie Chart -->

            </div>
          </div>
        </div>
      </div>

</div>
</div>

@endsection