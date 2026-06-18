<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>One Stop Centre Report</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/vendors/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendors/aos/aos.css" rel="stylesheet">
  <link href="assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendors/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendors/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendors/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendors/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  
  <!-- Template Main CSS File -->
  <link href="assets/css/admin.css" rel="stylesheet">
 

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>


  <style>
    p {
      font-size: 14px;
    }
    body {
      background: #4f77aa;
    }
    @media screen and (max-width: 768px) {
    /* CSS rules for smaller screens */
    }
    .thetablets {
    background-color: #6889ce; /* Replace 'your-desired-color' with the color you want */
    color: #fff; /* Set text color to make it readable on the background color */
    }

    .nav-tabs-bordered .nav-link.active {
    background-color: #1F4E78 !important; /* Replace 'your-desired-color' with the color you want */
    color: #fff; /* Set text color to make it readable on the background color */
    border-bottom: 0px !important;
    }
  </style>

</head>
<header>
    <div class= "row">
        <div class="col-lg-12 text-center">
            <h1 class="card-title" style="font-size:30px; color: white;"><b>Pusat Perkhidmatan Setempat (PPS)</b></h1>
            <h1 class="card-title" style="font-size:30px; color: white;">Pelanggan: {{ $totalVisitorsAll }} <i class="bi bi-people-fill"></i></h1>
        </div>
    </div>
</header>

<body>

    <main>
        <section  class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="row col-lg-8 d-flex flex-column align-items-center justify-content-center">
        <div class="row">
    <div class="col-lg-12 text-center" style="background-color:white;">
        <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="myTabjustified" role="tablist">
            @foreach ($years as $year)
            <li class="nav-item flex-fill" role="presentation">
                <a class="nav-link w-100 {{ $loop->first ? 'active' : '' }}" id="tab{{ $year }}" data-year="{{ $year }}" href="#" role="tab" aria-controls="{{ $year }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}"><b>{{ $year }}</b></a>
            </li>
            @endforeach
        </ul>
    </div>
</div>



                <br>
                
                <!-- ======================================================================================================================================================================================================== -->
                <!-- ================================================================================================= FOR EACH YEAR ======================================================================================== -->
                <!-- ======================================================================================================================================================================================================== -->
                <div class="tab-content" id="borderedTabJustifiedContent">
    @foreach ($years as $year)
    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $year }}" role="tabpanel" aria-labelledby="tab{{ $year }}">
        <!-- Content for {{ $year }} -->
        <div class="card">
            <div class="card-body mt-3">
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Ringkasan Statistik (PPS)</h5>

                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="card-title">Jumlah Pelanggan {{ $year }}: {{ $totalVisitorsYear[$year] }}</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 text-center">
                        <table class="table table-bordered mt-3">
                            <tbody>
                                <tr>
                                    <th scope="col" style="background: #e9ecef;">Bulan</th>
                                    <th scope="col" style="background: #e9ecef;">Jumlah</th>
                                </tr>
                                @foreach($totalVisitorsPerMonth as $monthYear => $total)
                                    @if (strpos($monthYear, $year) !== false)
                                    <tr>
                                        <td><b>{{ $monthYear }}</b></td>
                                        <td>{{ $total }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6 text-center">
                        <!-- Column Chart -->
                        <div id="columnChart{{ $year }}"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#columnChart{{ $year }}"), {
                                    series: [{
                                        name: 'Jumlah',
                                        data: [
                                            @foreach($totalVisitorsPerMonth as $monthYear => $total)
                                                @if (strpos($monthYear, $year) !== false)
                                                    {{ $total }},
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
                                            text: 'Jumlah Pelanggan'
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
                                    tooltip: {}
                                }).render();
                            });
                        </script>
                        <!-- End Column Chart -->
                    </div>
                </div>

                <!-- Chart by JABATAN -->
                <div class="col-lg-12">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;"> Jumlah Pelanggan Mengikut Jabatan</h5>

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
                                    ['DE'],
                                    ['JSS'],
                                    ['JPS'],
                                    ['JPB'],
                                    ['JPPE'],
                                    ['DA'],
                                    ['JPP']
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
                <!-- End of Chart by JABATAN -->

                <!-- Chart Counter (as a service) -->
                <div class="col-lg-12">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Jumlah Pelanggan Mengikut Perkhidmatan</h5>

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
                <!-- End of Chart Counter (as a service) -->
                <br><br>
            </div><!-- End of Card-Body -->
        </div><!-- End of Card -->
    </div>
    @endforeach
                
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tabLinks = document.querySelectorAll('.nav-link');
        const tabContents = document.querySelectorAll('.tab-pane');

        tabLinks.forEach(tabLink => {
            tabLink.addEventListener('click', function(e) {
                e.preventDefault();
                const year = this.getAttribute('data-year');
                tabLinks.forEach(link => link.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('show', 'active'));
                this.classList.add('active');
                document.getElementById(year).classList.add('show', 'active');
            });
        });
    });
</script>

                <!-- ======================================================================================================================================================================================================== -->
                <!-- ================================================================================================= FOR ALL YEARS ======================================================================================== -->
                <!-- ======================================================================================================================================================================================================== -->
                <!-- Line Chart -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body mt-3">
                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Tren Pelanggan di Pusat Perkhidmatan Setempat</h5>

                            <div id="lineChart"></div>

                            <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#lineChart"), {
                                series: [{
                                    name: "Pelanggan",
                                    data: [
                                                    @foreach($totalVisitorsPerMonth as $total)
                                                        {{$total}},
                                                    @endforeach
                                                ]
                                }],
                                chart: {
                                    height: 350,
                                    type: 'line',
                                    zoom: {
                                    enabled: false
                                    }
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                stroke: {
                                    curve: 'straight'
                                },
                                grid: {
                                    row: {
                                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                    opacity: 0.5
                                    },
                                },
                                xaxis: {
                                    categories: [
                                                    @foreach($totalVisitorsPerMonth as $monthYear => $total)
                                                        '{{ $monthYear }}',
                                                    @endforeach
                                                ]
                                }
                                }).render();
                            });
                            </script>
                        </div>
                        <!-- End Line Chart -->
                    </div>
                        </div>
                </div>
              </div><!-- End Bordered Tabs Justified -->
                

            </div>
        </section>
    </main>   
</body>

</html>