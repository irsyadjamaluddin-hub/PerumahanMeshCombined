@extends('layouts.app-all')

@section('title', 'DP: Download')

@section('content')

  <?php
    $pagename = "dp-download";
  ?>

    <div class="pagetitle">
      <h1>DP: Download</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">DP: Download</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col">


    <div class="card">
      <div class="card-body">
        <h5 class="card-title">BORANG DROPOUTS </h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <!-- <th scope="col">#</th> -->
                    <th scope="col">FileName</th>
                    <th scope="col">Download</th>
                  </tr>
                </thead>
                <tbody>
          

                   <tr>
                    <!-- <th scope="row">1</th> -->
                    <td style="word-break: break-all;">Dropout_PRIM_SECS_PREU_2021</td>
                    <td><a href='{{Storage::url("dropout/Dropout_PRIM_SECS_PREU_2021.xlsx") }}' target="_blank">
                            <button type="submit" class="btn btn-outline-primary" >
                              <i class="bi bi-file-earmark-arrow-down-fill"></i>
                            </button>
                        </a>
                    </td>
                  </tr>

                   <tr>
                    <!-- <th scope="row">1</th> -->
                    <td style="word-break: break-all;">Dropout_PRIM_SECS_PREU_2022</td>
                    <td><a href='{{Storage::url("dropout/Dropout_PRIM_SECS_PREU_2022.xlsx") }}' target="_blank">
                            <button type="submit" class="btn btn-outline-primary" >
                              <i class="bi bi-file-earmark-arrow-down-fill"></i>
                            </button>
                        </a>
                    </td>
                  </tr>

                </tbody>
              </table>
              <!-- End Table with hoverable rows -->

      </div>
    </div>



    <div class="card">
      <div class="card-body">
        <h5 class="card-title">BORANG PERANGKAAN 2023</h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <!-- <th scope="col">#</th> -->
                    <th scope="col">FileName</th>
                    <th scope="col">Download</th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td>MORA_Perangkaan 2023</td>
                    <td><a href='{{Storage::url("perangkaan/MORA_Perangkaan 2023.zip") }}' target="_blank">
                            <button type="submit" class="btn btn-outline-primary" >
                              <i class="bi bi-file-earmark-arrow-down-fill"></i>
                            </button>
                        </a>
                    </td>
                  </tr>
                  <tr>

                    <td>MOE_Perangkaan 2023_Pra & Rendah</td>
                    <td><a href='{{Storage::url("perangkaan/MOE_Perangkaan 2023_Pra & Rendah.zip") }}' target="_blank">
                            <button type="submit" class="btn btn-outline-primary" >
                              <i class="bi bi-file-earmark-arrow-down-fill"></i>
                            </button>
                        </a>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>MOE_Perangkaan 2023_Menengah & Pusat Tingkatan Enam</td>
                    <td><a href='{{Storage::url("perangkaan/MOE_Perangkaan 2023_Menengah & Pusat Tingkatan Enam.zip") }}' target="_blank">
                            <button type="submit" class="btn btn-outline-primary" >
                              <i class="bi bi-file-earmark-arrow-down-fill"></i>
                            </button>
                          </a>
                    </td>
                  </tr>
            
                  <tr>
                    <td>MOE_Perangkaan 2023_Pusat Tingkatan Enam</td>
                    <td><a href='{{Storage::url("perangkaan/MOE_Perangkaan 2023_Pusat Tingkatan Enam.zip") }}' target="_blank">
                            <button type="submit" class="btn btn-outline-primary" >
                              <i class="bi bi-file-earmark-arrow-down-fill"></i>
                            </button>
                        </a>
                    </td>
                  </tr>
             
                </tbody>
              </table>
              <!-- End Table with hoverable rows -->

      </div>
    </div>

</div>
</div>
</section>
@endsection