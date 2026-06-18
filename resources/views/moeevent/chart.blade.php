@extends('layouts.app-all')

@section('title', 'Dashboard')

@section('content')

<?php
$pagename = "Event";
?>

<div class="pagetitle">
    <h1>MOE Event</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('moeevent.moeevent.indexadmin') }}">MOE Event</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    </nav>
</div><!-- End Page Title -->

<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.0/dist/apexcharts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

<section class="section profile">

    <a href="{{ route('moeevent.moeevent.indexadmin') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>
    
    <div class="row">

        <div class="card mt-3">
            <div class="card-body pt-3">

                    <div class="row">
                        <div class="col-lg-12">
                            @foreach($perkaraevent as $perkaraevent)
                            <h5 class="card-title" style="text-align: center; color: white; padding: 20px; border-radius: 0px; background-color: #4682B4;">Dashboard {{ $perkaraevent->eventlabel }}</h5>
                            @endforeach
                        </div>

                        <!-- Chart 1: Jumlah Kehadiran -->
                  

                        <div class="row">
                            <div class="col-lg-12">
                            <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title" style="font-weight: bold; font-size: 50px;">{{$totalAttendees}}</h5>
                                <p style="font-size: 20px; font-weight: bold;">JUMLAH Kehadiran</p>
                            </div>
                            </div>
                            </div>
                        </div>

                          <!-- Chart 2: Pecahan Hadir / Tidak Hadir -->
               
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Pecahan Hadir / Tidak Hadir</h5>
                                        <div id="barChart" style="min-height: 355px;" class="echart"></div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            echarts.init(document.querySelector("#barChart")).setOption({
                                                xAxis: {
                                                    type: 'category',
                                                    data: ['Hadir', 'Tidak Hadir'],
                                                    axisLabel: {
                                                        textStyle: {
                                                            fontSize: 14, // Adjust the font size as needed
                                                            fontWeight: 'bold', // Make the text bold
                                                        }
                                                    }
                                                },
                                                yAxis: {
                                                    type: 'value'
                                                },
                                                series: [{
                                                    data: [{{$totalhadir}}, {{$totalnonhadir}}], // Replace with your actual data
                                                    type: 'bar',
                                                    barWidth: 200,
                                                }]
                                            });
                                        });
                                    </script>
                                    <!-- End Bar Chart -->

                                    </div>
                                    </div>
                                </div>


                                    
                                <!-- Chart 3: Pecahan Permohonan -->
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Pecahan Permohonan</h5>
                                            <div id="pieChart"></div>

                                        <script>
                                            document.addEventListener("DOMContentLoaded", () => {
                                            new ApexCharts(document.querySelector("#pieChart"), {
                                                series: [{{$totalapproveapplication}}, {{$totalrejectapplication}},{{$totalnullapplication}}],
                                                chart: {
                                                height: 350,
                                                type: 'pie',
                                                toolbar: {
                                                    show: true
                                                }
                                                },
                                                labels: ['Approve', 'Rejected', 'Null'],
                                                    colors: ['#3cb371', '#800000', '#ffa500'] // Green for Approve, Red for Rejected, Yellow for Null
                                                }).render();
                                            });
                                        </script>
                                        <!-- End Pie Chart -->

                                        </div>
                                    </div>
                                </div>


                       <!-- Chart 4: Pecahan Female vs Male -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Pecahan Female vs Male</h5>
                                        <div id="pieChart1"></div>

                                            <script>
                                                document.addEventListener("DOMContentLoaded", () => {
                                                new ApexCharts(document.querySelector("#pieChart1"), {
                                                    series: [{{$totalfemale}}, {{$totalmale}}],
                                                    chart: {
                                                    height: 350,
                                                    type: 'pie',
                                                    toolbar: {
                                                        show: true
                                                    }
                                                    },
                                                    labels: ['Female', 'Male'],
                                                        colors: ['#FF69B4', '#3498db'] // Set custom colors for Female (pink) and Male (blue)
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

</section>

@endsection