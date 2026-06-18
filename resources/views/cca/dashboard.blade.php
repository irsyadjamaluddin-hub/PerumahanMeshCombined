@extends('layouts.app-all')

@section('title', 'Show CCA')

@section('content')

<?php
$pagename = "CCA";
?>

<div class="pagetitle">
    <h1>MAKLUMAT KELAB-KELAB SEKOLAH</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">CCA</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">
    <div class="row">

        <div class="col-xl-8">
            <a href="javascript: history.back()" class="btn btn-primary">
                <i class="bi bi-arrow-left-circle"></i>
            </a>
        </div>

        <div class="card mt-3">
            <div class="card-body pt-3">

                        @foreach($ccas as $cca)
                        <!-- Lyanna -->

                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">DASHBOARD</h5>
                        <div class="row">
                        <div class="col-lg-12">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th scope="row">NAMA SEKOLAH</th>
                                <td>{{ optional($cca->schools)->label }}</td>
                            </tr>
                            <tr>
                                <th scope="row">KLUSTER</th>
                                <td>{{$cca->kluster}}</td>
                            </tr>
                            <tr>
                                <th scope="row">TAHUN</th>
                                <td>{{$cca->year}}</td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-lg-12">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">JUMLAH PELAJAR</h5>
                        </div>
                        
                        <div class="col-lg-6">

                            <div class="card" style="padding-top: 20px;">
                            <div class="card-body" style="text-align: center;">

                                <div class="row">
                                    <div class="col-lg-12">
                                    <h5 class="card-title" style="font-weight: bold; font-size: 40px;">{{$jumlah}}</h5>
                                    <p style="font-size: 20px; font-weight: bold;">JUMLAH PELAJAR</p>
                                </div>
                            </div>

                            <div class="row"><div class="col-lg-6"><img src= "{{ asset('assets/img/M.PNG') }}" style= "width: 100px;">
                                <!-- <h5 class="card-title" style="font-weight: bold; font-size: 35px; padding-top: 20px;">{{$jumlahLelaki}}</h5> -->
                                <p style="font-size: 20px; font-weight: bold;">LELAKI</p>

                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th scope="row">Lelaki Keseluruhan</th>
                                        <td>{{$jumlahLelaki}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Lelaki Berkeperluan Khas</th>
                                        <td>{{$jumlahlelakiberkeperluankhas}}</td>
                                    </tr>
                                
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6"><img src= "{{ asset('assets/img/F.png') }}" style= "width: 100px;">
                                <!-- <h5 class="card-title" style="font-weight: bold; font-size: 35px; padding-top: 20px;">{{$jumlahPerempuan}}</h5> -->
                                <p style="font-size: 20px; font-weight: bold;">PEREMPUAN</p>

                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th scope="row">Perempuan Keseluruhan</th>
                                        <td>{{$jumlahPerempuan}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Perempuan Berkeperluan Khas</th>
                                        <td>{{$jumlahperempuanberkeperluankhas}}</td>
                                    </tr>
                                
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            </div>


                            </div>


                        </div>

                        <div class="col-lg-6">

                        <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Carta Jumlah Pelajar</h5>

                        <!-- Bar Chart -->
                        <div id="chart"></div>

                        <!-- showRendah-->
                        @if ($cca->school_name == '36' || $cca->school_name == '38' || $cca->school_name == '39'
                            ||$cca->school_name == '40' || $cca->school_name == '41' || $cca->school_name == '42'
                            ||$cca->school_name == '43' || $cca->school_name == '44' || $cca->school_name == '45'
                            ||$cca->school_name == '46' || $cca->school_name == '47' || $cca->school_name == '48'
                            ||$cca->school_name == '49' || $cca->school_name == '50' || $cca->school_name == '51'
                            ||$cca->school_name == '52' || $cca->school_name == '53' || $cca->school_name == '54'
                            ||$cca->school_name == '55' || $cca->school_name == '56' || $cca->school_name == '57'
                            ||$cca->school_name == '58' || $cca->school_name == '59' || $cca->school_name == '60'
                            ||$cca->school_name == '61' || $cca->school_name == '62' || $cca->school_name == '63'
                            ||$cca->school_name == '64' || $cca->school_name == '65' || $cca->school_name == '66'
                            ||$cca->school_name == '67' || $cca->school_name == '68' || $cca->school_name == '69'
                            ||$cca->school_name == '70' || $cca->school_name == '71' || $cca->school_name == '72'
                            ||$cca->school_name == '73' || $cca->school_name == '74' || $cca->school_name == '75'
                            ||$cca->school_name == '76' || $cca->school_name == '77' || $cca->school_name == '78'
                            ||$cca->school_name == '79' || $cca->school_name == '80' || $cca->school_name == '81'
                            ||$cca->school_name == '82' || $cca->school_name == '83' || $cca->school_name == '84'
                            ||$cca->school_name == '85' || $cca->school_name == '86' || $cca->school_name == '87'
                            ||$cca->school_name == '88' || $cca->school_name == '89' || $cca->school_name == '90'
                            ||$cca->school_name == '91' || $cca->school_name == '92' || $cca->school_name == '93'
                            ||$cca->school_name == '94' || $cca->school_name == '95' || $cca->school_name == '96'
                            ||$cca->school_name == '97' || $cca->school_name == '98' || $cca->school_name == '99'
                            ||$cca->school_name == '100' || $cca->school_name == '101' || $cca->school_name == '102'
                            ||$cca->school_name == '103' || $cca->school_name == '104' || $cca->school_name == '105'
                            ||$cca->school_name == '106' || $cca->school_name == '107' || $cca->school_name == '108'
                            ||$cca->school_name == '109' || $cca->school_name == '110' || $cca->school_name == '111'
                            ||$cca->school_name == '112' || $cca->school_name == '113' || $cca->school_name == '114'
                            ||$cca->school_name == '115' || $cca->school_name == '116' || $cca->school_name == '117'
                            ||$cca->school_name == '118' || $cca->school_name == '119' || $cca->school_name == '120'
                            ||$cca->school_name == '121' || $cca->school_name == '122' || $cca->school_name == '123'
                            ||$cca->school_name == '124' || $cca->school_name == '125' || $cca->school_name == '126'
                            ||$cca->school_name == '127' || $cca->school_name == '128' || $cca->school_name == '129'
                            ||$cca->school_name == '130' || $cca->school_name == '131' || $cca->school_name == '132'
                            ||$cca->school_name == '133' || $cca->school_name == '134' || $cca->school_name == '135'
                            ||$cca->school_name == '136' || $cca->school_name == '137' || $cca->school_name == '138'
                            ||$cca->school_name == '139' || $cca->school_name == '140' || $cca->school_name == '141'
                            ||$cca->school_name == '142' || $cca->school_name == '143' || $cca->school_name == '144'
                            ||$cca->school_name == '145' || $cca->school_name == '146' || $cca->school_name == '147'
                            ||$cca->school_name == '148' || $cca->school_name == '149' || $cca->school_name == '150'
                            ||$cca->school_name == '151' || $cca->school_name == '152' || $cca->school_name == '153'
                             || $cca->school_name == '155' )
                        <script>
                            var options = {
                            series: [{
                            name: 'Lelaki',
                            data: [{{$Total6L}}, {{$Total5L}}, {{$Total4L}}, {{$Total3L}}, {{$Total2L}}, {{$Total1L}}, {{$TotalPraL}}]
                            }, {
                            name: 'Perempuan',
                            data: [{{$Total6P}}, {{$Total5P}}, {{$Total4P}}, {{$Total3P}}, {{$Total2P}}, {{$Total1P}}, {{$TotalPraP}}]
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
                            categories: ['Tahun 6', 'Tahun 5', 'Tahun 4', 'Tahun 3', 'Tahun 2', 'Tahun 1', 'Pra']
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
                        <!-- End showRendah Chart -->

                        <!-- showMenengah -->
                        @elseif ($cca->school_name == '8' || $cca->school_name == '9' || $cca->school_name == '10' || $cca->school_name == '11'
                            || $cca->school_name== '12' || $cca->school_name == '13'
                            || $cca->school_name== '14' || $cca->school_name == '15'
                            || $cca->school_name== '16' || $cca->school_name == '17'
                            || $cca->school_name== '18' || $cca->school_name == '19'
                            || $cca->school_name== '20' || $cca->school_name == '21'
                            || $cca->school_name== '22' || $cca->school_name == '23'
                            || $cca->school_name== '24' || $cca->school_name == '25'
                            || $cca->school_name== '26' || $cca->school_name == '27'
                            || $cca->school_name== '28' || $cca->school_name == '29'
                            || $cca->school_name== '30' || $cca->school_name == '31'
                            || $cca->school_name== '32' || $cca->school_name == '33'
                            || $cca->school_name== '34' || $cca->school_name == '35'
                            || $cca->school_name== '37' || $cca->school_name== '154' 
                            || $cca->school_name== '7'||$cca->school_name == '8' ||$cca->school_name == '154')
                        <script>
                            var options = {
                            series: [{
                            name: 'Lelaki',
                            data: [{{$Total11L}}, {{$Total10L}}, {{$Total9L}}, {{$Total8L}}, {{$Total7L}}]
                            }, {
                            name: 'Perempuan',
                            data: [{{$Total11P}}, {{$Total10P}}, {{$Total9P}}, {{$Total8P}}, {{$Total7P}}]
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
                            categories: ['Tahun 11', 'Tahun 10', 'Tahun 9', 'Tahun 8', 'Tahun 7']
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
                        <!-- End showMenengah Chart -->

                        <!-- showFORM6 -->
                        @elseif(
                        $cca->school_name== '2' || $cca->school_name == '3'|| $cca->school_name == '4'|| $cca->school_name== '5' || $cca->school_name == '6' )
                        <script>
                            var options = {
                            series: [{
                            name: 'Lelaki',
                            data: [{{$Total13L}}, {{$Total12L}}]
                            }, {
                            name: 'Perempuan',
                            data: [{{$Total13P}}, {{$Total12P}}]
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
                            categories: ['Tahun 13', 'Tahun 12']
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
                        <!-- End showFORM6 Chart -->
                        
                        <!-- showMaktabSAINS-->
                        @elseif($cca->school_name == '1' )
                        <script>
                            var options = {
                            series: [{
                            name: 'Lelaki',
                            data: [{{$Total13L}}, {{$Total12L}}, {{$Total11L}}, {{$Total10L}}, {{$Total8L}}, {{$Total7L}}]
                            }, {
                            name: 'Perempuan',
                            data: [{{$Total13P}}, {{$Total12P}}, {{$Total11P}}, {{$Total10P}}, {{$Total8P}}, {{$Total7P}}]
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
                            categories: ['Tahun 13', 'Tahun 12', 'Tahun 11', 'Tahun 10', 'Tahun 8', 'Tahun 7']
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
                        <!-- End showMaktabSAINS Chart -->

                        @else
                        <div>
                        </div>
                        @endif

                        </div>
                        </div>

                        </div>
                        </div>



                        <!-- <h5 class="card-title">Charts will be added soon</h5> -->

                        <div class="row">
                            <div class="col-lg-6">

                            @if ($cca->year > 2023)
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title" style="margin-top: 15px; text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">JUMLAH AKTIVITI</h5>

                                        <!-- Donut Chart -->
                                        <div id="donut" style="margin-top: 15px; border: 2px solid #012970; padding: 15px; border-radius: 25px;"></div>

                                            <script>
                                            document.addEventListener("DOMContentLoaded", () => {
                                            new ApexCharts(document.querySelector("#donut"), {
                                            series: [{{$FizikalNew}}, {{$KerohanianNew}}, {{$KreativitiNew}}, {{$PerkhidmatanNew}}],
                                            chart: {
                                            height: 350,
                                            type: 'donut',
                                            toolbar: {
                                                show: true
                                            },
                                            },
                                            labels: ['Fizikal', 'Kerohanian', 'Kreativiti', 'Perkhidmatan'],
                                            }).render();
                                            });
                                            </script>
                                            <!-- End Donut Chart -->

                                    </div>
                                </div>


                             @else

                             <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title" style="margin-top: 15px; text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">JUMLAH AKTIVITI</h5>

                                    <!-- Donut Chart -->
                                    <div id="donut" style="margin-top: 15px; border: 2px solid #012970; padding: 15px; border-radius: 25px;"></div>

                                        <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#donut"), {
                                        series: [{{$Fizikal}}, {{$Kerohanian}}, {{$Kreativiti}}, {{$Perkhidmatan}}],
                                        chart: {
                                        height: 350,
                                        type: 'donut',
                                        toolbar: {
                                            show: true
                                        },
                                        },
                                        labels: ['Fizikal', 'Kerohanian', 'Kreativiti', 'Perkhidmatan'],
                                        }).render();
                                        });
                                        </script>
                                        <!-- End Donut Chart -->

                                 </div>
                             </div>

                             @endif

                        </div>

                   
<div class="col-lg-6">
    @if ($cca->year > 2023)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style="margin-top: 15px; text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">
                    PECAHAN PELAJAR MENGIKUT KOMPONEN
                </h5>
                <div id="columnChart" style="border: 2px solid #012970; padding: 15px; border-radius: 25px;"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#columnChart"), {
                            series: [{
                                name: 'Lelaki',
                                data: [{{ $fizikalCountNew['jantina_stat'] ?? 0 }}, {{ $kerohanianCountNew['jantina_stat'] ?? 0 }}, {{ $kreativitiCountNew['jantina_stat'] ?? 0 }}, {{ $perkhidmatanCountNew['jantina_stat'] ?? 0 }}]
                            },
                            {
                                name: 'Perempuan',
                                data: [{{ $fizikalCountNew['jumlah_stat'] ?? 0 }}, {{ $kerohanianCountNew['jumlah_stat'] ?? 0 }}, {{ $kreativitiCountNew['jumlah_stat'] ?? 0 }}, {{ $perkhidmatanCountNew['jumlah_stat'] ?? 0 }}]
                            }],
                            chart: { type: 'bar', height: 350 },
                            plotOptions: { bar: { horizontal: false, columnWidth: '55%', endingShape: 'rounded' } },
                            dataLabels: { enabled: true },
                            stroke: { show: true, width: 2, colors: ['transparent'] },
                            xaxis: { categories: ['Fizikal', 'Kerohanian', 'Kreativiti', 'Perkhidmatan'] },
                            fill: { opacity: 1 }
                        }).render();
                    });
                </script>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style="margin-top: 15px; text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">
                    PECAHAN PELAJAR MENGIKUT KOMPONEN
                </h5>
                <div id="columnChartx" style="border: 2px solid #012970; padding: 15px; border-radius: 25px;"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#columnChartx"), {
                            series: [{
                                name: 'Lelaki',
                                data: [{{ $fizikalCount['jantina_stat'] ?? 0 }}, {{ $kerohanianCount['jantina_stat'] ?? 0 }}, {{ $kreativitiCount['jantina_stat'] ?? 0 }}, {{ $perkhidmatanCount['jantina_stat'] ?? 0 }}]
                            },
                            {
                                name: 'Perempuan',
                                data: [{{ $fizikalCount['jumlah_stat'] ?? 0 }}, {{ $kerohanianCount['jumlah_stat'] ?? 0 }}, {{ $kreativitiCount['jumlah_stat'] ?? 0 }}, {{ $perkhidmatanCount['jumlah_stat'] ?? 0 }}]
                            }],
                            chart: { type: 'bar', height: 350 },
                            plotOptions: { bar: { horizontal: false, columnWidth: '55%', endingShape: 'rounded' } },
                            dataLabels: { enabled: true },
                            stroke: { show: true, width: 2, colors: ['transparent'] },
                            xaxis: { categories: ['Fizikal', 'Kerohanian', 'Kreativiti', 'Perkhidmatan'] },
                            fill: { opacity: 1 }
                        }).render();
                    });
                </script>
            </div>
        </div>
    @endif
</div>


                     
                        </div>
                        <!-- Lyanna -->
                        @endforeach

            </div>
        </div>
    </div>

</section>

@endsection