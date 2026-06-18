@extends('layouts.app-all')

@section('title', 'HRD Dashboard')

@section('content')

<script src="assets/vendor/echarts/echarts.min.js"></script>

<?php
$pagename = "HRDDashboard";
?>

<section class="section">
    <div class="row">

        <div class="card">
            <div class="card-body mt-3">
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">MINISTRY OF EDUCATION<br> HRD Dashboard</h5>

              <!-- Vertical Bar Chart -->
              <div id="verticalBarChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#verticalBarChart")).setOption({
                    title: {
                      text: ''
                    },
                    tooltip: {
                      trigger: 'axis',
                      axisPointer: {
                        type: 'shadow'
                      }
                    },
                    legend: {},
                    grid: {
                      left: '3%',
                      right: '4%',
                      bottom: '3%',
                      containLabel: true
                    },
                    xAxis: {
                      type: 'value',
                      boundaryGap: [0, 0.01]
                    },
                    yAxis: {
                      type: 'category',
                      data: ['JPPE','MKPK', 'DICT', 'CCD','JPKhas', 'DA'] 
                    },
                    series: [{
                        name: 'Assessment Completed',
                        type: 'bar',
                        data: [0, 20, 38, 1, 85, 100]
                      },
                      {
                        name: 'Total Employee',
                        type: 'bar',
                        data: [172, 21, 38, 57, 100, 200]
                      }
                    ]
                  });
                });
              </script>
              <!-- End Vertical Bar Chart -->

            </div>
        </div>

</div>
</section>
@endsection