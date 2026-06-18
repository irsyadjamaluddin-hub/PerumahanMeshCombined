@extends('layouts.app-all')

@section('title', 'PPS Visitors')

@section('content')

    <?php
        $pagename = "PPSVisitor";
    ?>
  
    <div class="pagetitle">
        <h1>Pusat Perkhidmatan Setempat (PPS) Statistics</h1>
        <nav>
            <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">PPS Visitors</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">

            <div class="card">
                <div class="card-body mt-3">
      	            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Total Number of Visitors By Years</h5><br>

                    <!-- ===================================================================================================================================================================================================================================== -->
                    <!-- ==================================================================================================== NUMBER OF VISITORS BY YEARS ==================================================================================================== -->
                    <!-- ===================================================================================================================================================================================================================================== -->
        
                    <div class="row">
                        @foreach ($years as $index => $year)
                            @if ($index % 3 == 0)
                    </div>
                    <div class="row"> <!-- Close previous row and start a new row after every third button -->
                        @endif
                            <div class="col-lg-4 text-center">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable{{ $year }}">
                                    Total Number of Visitors in {{ $year }}
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <!-- Modals for each year -->
                    @foreach ($years as $year)
                        <div class="modal fade" id="modalDialogScrollable{{ $year }}" tabindex="-1">
                            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Total Number of Visitors in {{ $year }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                <div class="modal-body">
                                    <!-- Total Number of Visitors for each year -->
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <h1 class="card-title">Total Number of Visitors for {{ $year }}: {{ $totalVisitorsYear[$year] }}</h1>
                                        </div>
                                    </div>
                                    <!-- End Total Number of Visitors for each year -->

                                    <!-- Total Number of Visitors for each month (Table) - each year -->
                                    <div class="row">
                                        <div class="col-lg-6 text-center">
                                            <table class="table table-bordered mt-3">
                                                <tbody>
                                                    <tr>
                                                        <th scope="col" style="background: #e9ecef;">Month</th>
                                                        <th scope="col" style="background: #e9ecef;">Total</th>
                                                    </tr>
                                @foreach($totalVisitorsPerMonth as $monthYear => $total)
                                @if (strpos($monthYear, $year) !== false)
                                <tr>
                                    <td>{{ $monthYear }}</td>
                                    <td>{{ $total }}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End Total Number of Visitors for each month (Table) - each year -->

                    <!-- Total Number of Visitors for Each Month (Graph) - each year -->
                    <div class="col-lg-6 text-center">
                        <div id="columnChart{{ $year }}"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#columnChart{{ $year }}"), {
                                    series: [{
                                        name: 'Total',
                                        data: [
                                            @foreach($totalVisitorsPerMonth as $monthYear => $total)
                                            @if (strpos($monthYear, $year) !== false)
                                            {{$total}},
                                            @endif
                                            @endforeach
                                        ]
                                    }],
                                    chart: {
                                        type: 'bar',
                                        height: 350
                                    },
                                    plotOptions: {
                                        bar: {
                                            horizontal: true,
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
                                        title: {
                                            text: 'Total Number of Visitors'
                                        },
                                        categories: [
                                            @foreach($totalVisitorsPerMonth as $monthYear => $total)
                                            @if (strpos($monthYear, $year) !== false)
                                            '{{ $monthYear }}',
                                            @endif
                                            @endforeach
                                        ]
                                    },
                                    fill: {
                                        opacity: 1
                                    },
                                    tooltip: {

                                    }
                                }).render();
                            });
                        </script>
                    </div>
                </div>
                <!-- End Total Number of Visitors for Each Month (Graph) - each year -->

                <!-- Chart Counter (Graph) - each year -->
                <div class="col-lg-12">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Counter Visitors</h5>
                    <div id="chart{{ $year }}"></div>

                    <script>
                        var options = {
                            series: [
                                @foreach($counterVisitorsPerMonthYear as $monthYear => $counterVisitors)
                                    @if (strpos($monthYear, $year) !== false)
                                        {
                                            name: '{{ $monthYear }}',
                                            data: [
                                                @foreach(['Jabatan Peperiksaan (Examination)', 'Surat Akuan Pelajar (JSS)', 'Jabatan Pendidikan Swasta', 'Scholarship', 'Jabatan Perancangan Pengurusan Estet (JPPE)', 'Kewangan (Gaji, Elaun)', 'Kewangan (Baucer)', 'Kewangan (Pembayaran, Hasil, Tender)', 'Pindah Sekolah (JSS)', 'Jabatan Pengurusan Pendidik', 'Perumahan Kerajaan', 'HECAS (HED)', 'LNCP'] as $category)
                                                    @if(isset($counterVisitors[$category]))
                                                        {{ $counterVisitors[$category] }},
                                                    @else
                                                        0,
                                                    @endif
                                                @endforeach
                                            ]
                                        },
                                    @endif
                                @endforeach
                            ],

                            chart: {
                                type: 'bar',
                                height: 500
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                    dataLabels: {
                                        position: 'top',
                                    }
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
                                            ['Jabatan', 'Peperiksaan'],
                                            ['Surat Akuan', 'Pelajar (JSS)'], 
                                            ['Jabatan', 'Pendidikan Swasta'], 
                                            'Scholarship',
                                            ['Jabatan', 'Perancangan', 'Pengurusan Estet'],
                                            ['Kewangan', '(Gaji, Elaun)'],
                                            ['Kewangan', '(Baucer)'],
                                            ['Kewangan', '(Pembayaran,', 'Hasil, Tender)'],
                                            ['Pindah', 'Sekolah', '(JSS)'],
                                            ['Jabatan', 'Pengurusan', 'Pendidik'], 
                                            ['Perumahan', 'Kerajaan'], 
                                            'HECAS (HED)',
                                            'LNCP'
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

                        var chart{{ $year }} = new ApexCharts(document.querySelector("#chart{{ $year }}"), options);
                        chart{{ $year }}.render();
                    </script>
                </div>
                <!-- End of Chart Counter (as a service) - each year -->

                <!-- Chart by JABATAN - each year -->
                <div class="col-lg-12">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Total Visitors by Department</h5>
                    <div id="chartJabatan{{ $year }}"></div>

                    <script>
                        var options = {
                            series: [
                                @foreach($totalVisitorsPerMonth as $monthYear => $totalVisitors)
                                @if (strpos($monthYear, $year) !== false)
                                {
                                    name: '{{ $monthYear }}',
                                    data: [
                                        @foreach(['Jabatan Peperiksaan (Examination)', 'jabatanSekolahSekolah', 'Jabatan Pendidikan Swasta', 'Scholarship', 'Jabatan Perancangan Pengurusan Estet (JPPE)', 'jabatanPentadbiran', 'Jabatan Pengurusan Pendidik'] as $counter)
                                            @if($counter == 'jabatanSekolahSekolah')
                                                {{ $jabatanSekolahSekolah[$monthYear] }},
                                            @elseif($counter == 'jabatanPentadbiran')
                                                {{ $jabatanPentadbiran[$monthYear] }},
                                            @elseif(isset($counterVisitorsPerMonthYear[$monthYear][$counter]))
                                                {{ $counterVisitorsPerMonthYear[$monthYear][$counter] }},
                                            @else
                                                0,
                                            @endif
                                        @endforeach
                                    ]
                                },
                                @endif
                                @endforeach
                            ],
                            chart: {
                                type: 'bar',
                                height: 500
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                    dataLabels: {
                                        position: 'top',
                                    }
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
                                            ['Jabatan', 'Peperiksaan'],
                                            ['Jabatan', 'Sekolah-Sekolah'],
                                            ['Jabatan', 'Pendidikan Swasta'],
                                            'Scholarship',
                                            ['Jabatan', 'Perancangan', 'Pengurusan Estet'],
                                            ['Jabatan', 'Pentadbiran dan', 'Perkhidmatan-Perkhidmatan'],
                                            ['Jabatan', 'Pengurusan', 'Pendidik']
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

                        var chartJabatan{{ $year }} = new ApexCharts(document.querySelector("#chartJabatan{{ $year }}"), options);
                        chartJabatan{{ $year }}.render();
                    </script>
                </div>
                <!-- End of Chart by JABATAN - each year -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach



                        <!-- ===================================================================================================================================================================================================================================== -->
                        <!-- ==================================================================================================== NUMBER OF VISITORS BY WHOLE ==================================================================================================== -->
                        <!-- ===================================================================================================================================================================================================================================== -->

                        <br>
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Total Number of Visitors</h5>

                        <!-- Total Number of Visitors for all years -->
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h1 class="card-title">Total Number of Visitors: {{ $totalVisitorsAll }}</h1>
                            </div>
                        </div>
                        <!-- End Total Number of Visitors for all years -->

                        <!-- Total Number of Visitors for each month (Table) - as a whole -->
                        <div class="row">        
                            <div class="col-lg-6 text-center">
                                <table class="table table-bordered mt-3">
                                    <tbody>
                                        <tr>
                                            <th scope="col" style="background: #e9ecef;">Month</th>
                                            <th scope="col" style="background: #e9ecef;">Total</th>
                                        </tr>                
                                        @foreach($totalVisitorsPerMonth as $monthYear => $total)
                                            <tr>
                                                <td>{{ $monthYear }}</td>
                                                <td>{{ $total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>          
                            </div>
                            <!-- End Total Number of Visitors for each month (Table) - as a whole -->

                            <!-- Total Number of Visitors for Each Month (Graph) - as a whole -->
                            <div class="col-lg-6 text-center">
                                <div id="columnChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#columnChart"), {
                                            series: [{
                                                name: 'Total',
                                                data: [
                                                    @foreach($totalVisitorsPerMonth as $total)
                                                        {{$total}},
                                                    @endforeach
                                                ]
                                            }],
                                            chart: {
                                                type: 'bar',
                                                height: 350
                                            },
                                            plotOptions: {
                                                bar: {
                                                    horizontal: true,
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
                                                title: {
                                                    text: 'Total Number of Visitors'
                                                },                      
                                                categories: [
                                                    @foreach($totalVisitorsPerMonth as $monthYear => $total)
                                                        '{{ $monthYear }}',
                                                    @endforeach
                                                ]
                                            },
                                            fill: {
                                                opacity: 1
                                            },
                                            tooltip: {

                                            }
                                        }).render();
                                    });
                                </script>
                            </div>
                            <!-- End Total Number of Visitors for Each Month (Graph) - as a whole -->
                        </div>

                        <!-- Chart Counter (as a service) - as a whole -->
                        <div class="col-lg-12">
                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Counter Visitors</h5>
                            <div id="chart"></div>

                            <script>
                                var options = {
                                    series: [
                                        @foreach($counterVisitorsPerMonthYear as $monthYear => $counterVisitors)
                                            {
                                                name: '{{ $monthYear }}',
                                                data: [
                                                    @foreach(['Jabatan Peperiksaan (Examination)', 'Surat Akuan Pelajar (JSS)', 'Jabatan Pendidikan Swasta', 'Scholarship', 'Jabatan Perancangan Pengurusan Estet (JPPE)', 'Kewangan (Gaji, Elaun)', 'Kewangan (Baucer)', 'Kewangan (Pembayaran, Hasil, Tender)', 'Pindah Sekolah (JSS)', 'Jabatan Pengurusan Pendidik', 'Perumahan Kerajaan', 'HECAS (HED)', 'LNCP'] as $category)
                                                        @if(isset($counterVisitors[$category]))
                                                            {{ $counterVisitors[$category] }},
                                                        @else
                                                            0,
                                                        @endif
                                                    @endforeach
                                                ]
                                            },
                                        @endforeach
                                    ],
                                    
                                    chart: {
                                        type: 'bar',
                                        height: 500
                                    },
                                    plotOptions: {
                                        bar: {
                                            horizontal: false,
                                            dataLabels: {
                                                position: 'top',
                                            }
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
                                            ['Jabatan', 'Peperiksaan'],
                                            ['Surat Akuan', 'Pelajar (JSS)'], 
                                            ['Jabatan', 'Pendidikan Swasta'], 
                                            'Scholarship',
                                            ['Jabatan', 'Perancangan', 'Pengurusan Estet'],
                                            ['Kewangan', '(Gaji, Elaun)'],
                                            ['Kewangan', '(Baucer)'],
                                            ['Kewangan', '(Pembayaran,', 'Hasil, Tender)'],
                                            ['Pindah', 'Sekolah', '(JSS)'],
                                            ['Jabatan', 'Pengurusan', 'Pendidik'], 
                                            ['Perumahan', 'Kerajaan'], 
                                            'HECAS (HED)',
                                            'LNCP'
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

                                var chart = new ApexCharts(document.querySelector("#chart"), options);
                                chart.render();
                            </script>
                        </div>
                        <!-- End of Chart Counter (as a service) - as a whole -->


                        <!-- Chart by JABATAN - as a whole -->
                        <div class="col-lg-12">
                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Total Visitors by Department</h5>
                            <div id="chartJabatan"></div>
    
                            <script>
                                var options = {
                                    series: [
                                        @foreach($totalVisitorsPerMonth as $monthYear => $totalVisitors)
                                            {
                                                name: '{{ $monthYear }}',
                                                data: [
                                                    @foreach(['Jabatan Peperiksaan (Examination)', 'jabatanSekolahSekolah', 'Jabatan Pendidikan Swasta', 'Scholarship', 'Jabatan Perancangan Pengurusan Estet (JPPE)', 'jabatanPentadbiran', 'Jabatan Pengurusan Pendidik'] as $counter)
                                                        @if($counter == 'jabatanSekolahSekolah')
                                                            {{ $jabatanSekolahSekolah[$monthYear] }},
                                                        @elseif($counter == 'jabatanPentadbiran')
                                                            {{ $jabatanPentadbiran[$monthYear] }},
                                                        @elseif(isset($counterVisitorsPerMonthYear[$monthYear][$counter]))
                                                            {{ $counterVisitorsPerMonthYear[$monthYear][$counter] }},
                                                        @else
                                                            0,
                                                        @endif
                                                    @endforeach
                                                ]
                                            },
                                        @endforeach
                                    ],
                                    chart: {
                                        type: 'bar',
                                        height: 500
                                    },
                                    plotOptions: {
                                        bar: {
                                            horizontal: false,
                                            dataLabels: {
                                                position: 'top',
                                            }
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
                                            ['Jabatan', 'Peperiksaan'],
                                            ['Jabatan', 'Sekolah-Sekolah'],
                                            ['Jabatan', 'Pendidikan Swasta'],
                                            'Scholarship',
                                            ['Jabatan', 'Perancangan', 'Pengurusan Estet'],
                                            ['Jabatan', 'Pentadbiran dan', 'Perkhidmatan-Perkhidmatan'],
                                            ['Jabatan', 'Pengurusan', 'Pendidik']
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

                                var chart = new ApexCharts(document.querySelector("#chartJabatan"), options);
                                chart.render();
                            </script>
                        </div>
                        <!-- End of Chart by JABATAN - as a whole -->

                    </div><!-- End of Card-Body -->
                </div><!-- End of Card -->
            </div>
    </section>
@endsection