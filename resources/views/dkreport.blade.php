@extends('layouts.app-all')

@section('title', 'DK Report')

@section('content')

  <?php
    $pagename = "DKReport";
  ?>

    <div class="pagetitle">
      <h1>Data Kehadiran Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">DK Report</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">

    <h5 class="card-title" style="text-align: center; color: white; padding: 20px; border-radius: 0px; background-color: #4682B4;">Dashboard Data Kehadiran</h5>


    <div class="row">
                            <div class="col-lg-12">
                            <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title" style="font-weight: bold; font-size: 50px;">{{$countAll}}</h5>
                                <p style="font-size: 20px; font-weight: bold;">JUMLAH DATA</p>
                            </div>
                            </div>
                            </div>
                        </div>
    <div class="row">

           

            <!-- Sales Card -->
            <div class="col-lg-4">
              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Hadir</span></h5>

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
                  <h5 class="card-title">Tidak Hadir</span></h5>

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

            <div class="col-lg-4">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Pending (Action)</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center icon-red-bg">
                      <i class="bi-person-dash-fill text-danger"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$countAction}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- start kategori chart -->

      <div class="col-lg-">
        <div class="card info-card sales-card">
          <div class="card-body">
              <h5 class="card-title">Kategori Data</h5>

                  <!-- Bar Chart -->
                  <div id="barChartData3"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#barChartData3"), {
                        series: [{
                          name: 'Jumlah',
                          data: [{{$moeteras}}, {{$moepengajiantinggi}}, {{$mora}}, {{$uniform}},
                          {{$swasta}}, {{$ipts}}]
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
                          categories: ['MOE PENDIDIKAN TERAS', 'MOE PENGAJIAN TINGGI', 'MORA', 'PASUKAN BERUNIFORM', 'SEKOLAH-SEKOLAH SWASTA', 'INSTITUT PENGAJIAN TINGGI SWASTA']
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Bar Chart -->
          </div>
        </div>
      </div>
      </div>

      <!-- end kategori chart -->

      <div class="col-lg-">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title">Data Kehadiran by Kategori</h5>

            <!-- Bar Chart -->
            <div id="chart"></div>
            <script>
                // Assuming you have fetched the counts from your backend and stored them in PHP variables

                var categories = ['MOE PENDIDIKAN TERAS', 'MOE PENGAJIAN TINGGI', 'MORA', 'PASUKAN BERUNIFORM', 'SEKOLAH-SEKOLAH SWASTA', 'IPTS'];
                var hadirCounts = [<?= $moeterashadir ?>, <?= $moepengajiantinggihadir ?>, <?= $morahadir ?>, <?= $uniformhadir ?>, <?= $swastahadir ?>, <?= $iptshadir ?>];
                var tidakhadirCounts = [<?= $moeterasnonhadir ?>, <?= $moepengajiantingginonhadir ?>, <?= $moranonhadir ?>, <?= $uniformnonhadir ?>, <?= $swastanonhadir ?>, <?= $iptsnonhadir ?>];

                var options = {
                    series: [{
                        name: 'hadir',
                        data: hadirCounts
                    }, {
                        name: 'tidakhadir',
                        data: tidakhadirCounts
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
                        categories: categories
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

  @if (Auth::check())
         @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))


  </div><!-- End Row -->

  <div class="col-lg-12" >
        <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title">Still Validating (Not Yet Correct Figure) </h5>

            <h5 class="card-title" hidden>Pecahan Data Kehadiran Pelajar dan Guru Pengawas </h5>
        </div>

          <!-- Bar Chart -->
          <div id="barChartData"></div>

          <div class="card-body overflow-auto">
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Jumlah Pelajar</th>
                    <th scope="col">Jumlah Guru Pengawas</th>
                    <th scope="col">Jumlah Pelajar Hadrah</th>
                    <th scope="col">Jumlah Guru Pengawas Hadrah</th>
                    <th scope="col">Jumlah Keseluruhan</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>1</td>
                        <td>MOE PENDIDIKAN TERAS</td>
                        <td>{{$pelajarteras}}</td>
                        <td>{{$guruteras}}</td>
                        <td>{{$hadrahpelajarteras}}</td>
                        <td>{{$hadrahguruteras}}</td>
                        <td>{{$sumteras}}</td>
                        {{$terasnull}}

                    </tr>
                    <tr>
                        <td>2</td>
                        <td>MOE PENGAJIAN TINGGI</td>
                        <td>{{$pelajarpt}}</td>
                        <td>{{$gurupt}}</td>
                        <td>{{$hadrahpelajarpt}}</td>
                        <td>{{$hadrahgurupt}}</td>
                        <td>{{$sumpt}}</td>
                        {{$ptnull}}

                    </tr>
                    <tr>
                        <td>3</td>
                        <td>MORA</td>
                        <td>{{$pelajarmora}}</td>
                        <td>{{$gurumora}}</td>
                        <td>{{$hadrahpelajarmora}}</td>
                        <td>{{$hadrahgurumora}}</td>
                        <td>{{$summora}}</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>PASUKAN BERUNIFORM</td>
                        <td>{{$pelajarpu}}</td>
                        <td>{{$gurupu}}</td>
                        <td>-</td>
                        <td>-</td>
                        <td>{{$sumpu}}</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>SEKOLAH - SEKOLAH SWASTA</td>
                        <td>{{$pelajarswasta}}</td>
                        <td>{{$guruswasta}}</td>
                        <td>-</td>
                        <td>-</td>
                        <td>{{$sumswasta}}</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>INSTITUT PENGAJIAN TINGGI SWASTA</td>
                        <td>{{$pelajaripts}}</td>
                        <td>{{$guruipts}}</td>
                        <td>-</td>
                        <td>-</td>
                        <td>{{$sumipts}}</td>
                        {{$iptsnull}}
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
      </div>
<!-- end top 5chart -->
    </div>

     
    <div class="col-lg-12">
      <div class="card info-card sales-card">
      <div class="card-body">
          <h5 class="card-title">MOE PENDIDIKAN TERAS</h5>

              <div id="Chartdept"></div>

              <div class="card-body overflow-auto">
                  <table class="table table-borderless datatable mt-3">
                      <thead>
                          <tr>
                              <th scope="col">SEKOLAH</th>
                              <th scope="col">Jumlah Hadir</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                        @php
						    $totalHadirteras = 0;
						@endphp

						@foreach ($dkschools as $dkschool)
						    <tr>
						        <td>{{ $dkschool->schools }}</td>
						        <td>
                                    <?php
                                        $dataKehadiranCount = App\Models\Datakehadiran::where('sekolah_institusi', $dkschool->schools)
                                            ->where('hadir', 1)
                                            ->where('kategori', '!=', 'PEGAWAI & KAKITANGAN')
                                            ->count();
                                        echo $dataKehadiranCount;
                                        $totalHadirteras += $dataKehadiranCount;
                                    ?>
                                </td>
						    </tr>
						@endforeach

						<tr>
						    <td><strong>Total</strong></td>
						    <td><strong>{{ $totalHadirteras }}</strong></td>
						</tr>
                      </tbody>  
                  </table>
              </div>

        
      </div>
      </div>      
    </div>

    <div class="col-lg-12">
      <div class="card info-card sales-card">
      <div class="card-body">
          <h5 class="card-title">MOE PENGAJIAN TINGGI</h5>

              <div id="Chartdept"></div>

              <div class="card-body overflow-auto">
                  <table class="table table-borderless datatable mt-3">
                      <thead>
                          <tr>
                              <th scope="col">SEKOLAH</th>
                              <th scope="col">Jumlah Hadir</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                      @php
                              $totalHadirpt = 0;
                          @endphp
                        @foreach ($dkschoolspt as $dkschoolpt)
                            <tr>
                            <td>{{ $dkschoolpt->schools }}</td>
                        
                        <td>
                            <?php
                                $dataKehadiranCount = App\Models\Datakehadiran::where('sekolah_institusi', $dkschoolpt->schools)
                                    ->where('hadir', 1)
                                    ->where('kategori', '!=', 'PEGAWAI & KAKITANGAN')
                                    ->count();
                                echo $dataKehadiranCount;
                                $totalHadirpt += $dataKehadiranCount;
                            ?>
                        </td>
                            </tr>
                        @endforeach
                        <tr>
                              <td><strong>Total</strong></td>
                              <td><strong>{{ $totalHadirpt }}</strong></td>
                          </tr>
                      </tbody>  
                  </table>
              </div>

        
      </div>
      </div>      
    </div>

    <div class="col-lg-12">
      <div class="card info-card sales-card">
      <div class="card-body">
          <h5 class="card-title">MORA</h5>

              <div id="Chartdept"></div>

              <div class="card-body overflow-auto">
                  <table class="table table-borderless datatable mt-3">
                      <thead>
                          <tr>
                              <th scope="col">SEKOLAH</th>
                              <th scope="col">Jumlah Hadir</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                           @php
                              $totalHadirmora = 0;
                          @endphp
                        @foreach ($dkschoolsmoras as $dkschoolmora)
                            <tr>
                            <td>{{ $dkschoolmora->schools }}</td>
                        
                        <td>
                            <?php
                                $dataKehadiranCount = App\Models\Datakehadiran::where('sekolah_institusi', $dkschoolmora->schools)
                                    ->where('hadir', 1)
                                    ->where('kategori', '!=', 'PEGAWAI & KAKITANGAN')
                                    ->count();
                                echo $dataKehadiranCount;
                                $totalHadirmora += $dataKehadiranCount;
                            ?>
                        </td>
                            </tr>
                        @endforeach
                        <tr>
                              <td><strong>Total</strong></td>
                              <td><strong>{{ $totalHadirmora }}</strong></td>
                          </tr>
                      </tbody>  
                  </table>
              </div>

        
      </div>
      </div>      
    </div>

    <div class="col-lg-12">
      <div class="card info-card sales-card">
      <div class="card-body">
          <h5 class="card-title">SEKOLAH-SEKOLAH SWASTA</h5>

              <div id="Chartdept"></div>

              <div class="card-body overflow-auto">
                  <table class="table table-borderless datatable mt-3">
                      <thead>
                          <tr>
                              <th scope="col">SEKOLAH</th>
                              <th scope="col">Jumlah Hadir</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                          @php
                              $totalHadirswasta = 0;
                          @endphp
                          @foreach ($dkschoolswastas as $dkschoolswasta)
                              <tr>
                                  <td>{{ $dkschoolswasta->schools }}</td>
                                  <td>
                                      <?php
                                          $dataKehadiranCount = App\Models\Datakehadiran::where('sekolah_institusi', $dkschoolswasta->schools)
                                              ->where('hadir', 1)
                                              ->where('kategori', '!=', 'PEGAWAI & KAKITANGAN')
                                              ->count();
                                          echo $dataKehadiranCount;
                                          $totalHadirswasta += $dataKehadiranCount;
                                      ?>
                                  </td>
                              </tr>
                          @endforeach
                          <tr>
                              <td><strong>Total</strong></td>
                              <td><strong>{{ $totalHadirswasta }}</strong></td>
                          </tr>
                      </tbody>  
                  </table>
              </div>

        
      </div>
      </div>      
    </div>

    <div class="col-lg-12">
      <div class="card info-card sales-card">
      <div class="card-body">
          <h5 class="card-title">INSTITUT PENGAJIAN TINGGI SWASTA</h5>

              <div id="Chartdept"></div>

              <div class="card-body overflow-auto">
                  <table class="table table-borderless datatable mt-3">
                      <thead>
                          <tr>
                              <th scope="col">SEKOLAH</th>
                              <th scope="col">Jumlah Hadir</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                          @php
                              $totalHadir = 0;
                          @endphp
                          @foreach ($dkschoolsipts as $dkschoolipts)
                              <tr>
                                  <td>{{ $dkschoolipts->schools }}</td>
                                  <td>
                                      <?php
                                          $dataKehadiranCount = App\Models\Datakehadiran::where('sekolah_institusi', $dkschoolipts->schools)
                                              ->where('hadir', 1)
                                              ->where('kategori', '!=', 'PEGAWAI & KAKITANGAN')
                                              ->count();
                                          echo $dataKehadiranCount;
                                          $totalHadir += $dataKehadiranCount;
                                      ?>
                                  </td>
                              </tr>
                          @endforeach
                          <tr>
                              <td><strong>Total</strong></td>
                              <td><strong>{{ $totalHadir }}</strong></td>
                          </tr>
                      </tbody>  
                  </table>
              </div>

        
      </div>
      </div>      
    </div>
 @endif
@endif


   

</div>
</div>

@endsection