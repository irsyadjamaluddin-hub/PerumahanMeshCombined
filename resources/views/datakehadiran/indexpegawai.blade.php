@extends('layouts.app-all')

@section('title', 'Data Kehadiran')

@section('content')


<?php
$pagename = "Data_kehadiran";
?>

<div class="pagetitle">
    <h1>Data Kehadiran Pegawai & Kakitangan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Data Kehadiran Pegawai & Kakitangan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

  @if(Session::has('success_message'))
  <div class="alert alert-success">
      <i class=" fas fa-fw fa-check"></i>
      {!! session('success_message') !!}
  </div>
  @endif



      <br>

    


  




    <div class="col-md-12">

        <div class="row">
          <div class="col-12">
              <a href="{{ route('datakehadiran.datakehadiran.createadmin') }}" class="btn btn-primary ml-md-3">Add Participant</a>
               <a href="{{ route('export.excel.by.pegawai') }}" class="btn btn-success">Export Excel </a>

          </div>
        </div>

        <br>

    
      <div class="col-12">
        <div class="card recent-sales">

         

          <br>

          



          <div class ="tab-content pt-2">
           

            <!-- second tab -->
              <div class="card-body overflow-auto">
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #006A4E;">Data Kehadiran Pegawai & Kakitangan</h5>
                  <table class="table table-borderless datatable mt-3">                         
                  <thead>
                        <tr>
                        <th scope="col">Kategori</th> 
                        <th scope="col">Jabatan</th>
                          <th scope="col">Nama</th>
                          <th scope="col">IC No. / SKB No.</th>
                          <th scope="col">Pelajar / Pengawas</th>
                          <th scope="col">Status</th>
                          <th scope="col">Catatan</th>
                          <th scope="col" style="text-align: center">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      @if(isset($datakehadiranpegawais) == 0)
                        <tr class="text-center">
                          <td colspan="8">
                            <h5>No records found</h5>
                          </td>
                        </tr>
                      @else
                          @foreach($datakehadiranpegawais as $datakehadiranpegawai)
                            <tr>                                   
                              <td>{{ $datakehadiranpegawai->kategori }}</td>
                              <td>{{ $datakehadiranpegawai->sekolah_institusi }}</td>                              
                              <td>{{ $datakehadiranpegawai->nama_pelajar_pengawas }}</td> 
                              <td>{{ $datakehadiranpegawai->icno_skbno }}</td> 


                              <td>
                                  @if($datakehadiranpegawai->type_pelajar_pengawas === null || $datakehadiranpegawai->type_pelajar_pengawas === '')
                                      <!-- Leave this TD blank if type_pelajar_pengawas is null or empty -->
                                  @elseif(in_array(strtoupper($datakehadiranpegawai->type_pelajar_pengawas), ['P', 'PH']))
                                      Pelajar
                                  @elseif(in_array(strtoupper($datakehadiranpegawai->type_pelajar_pengawas), ['G', 'GH', 'GP']))
                                      Pengawas
                                  @elseif(strtoupper($datakehadiranpegawai->type_pelajar_pengawas) === 'PU')
                                      Pegawai Uniform
                                  @endif
                              </td>

                                
                     
                                

                                <td>
                                  @if($datakehadiranpegawai->hadir === null || $datakehadiranpegawai->hadir === '')
                                      <span class="badge rounded-pill bg-danger">Untuk Tindakan</span>
                                  @elseif($datakehadiranpegawai->hadir === "1")
                                      <span class="badge rounded-pill bg-primary">Hadir</span>
                                  @elseif($datakehadiranpegawai->hadir === "x" || $datakehadiranpegawai->hadir === "X")
                                      <span class="badge rounded-pill bg-warning">Tidak hadir</span>
                                  @endif
                              </td>

                              <td>{{ $datakehadiranpegawai->catatan }}</td>                        


                              <td style="text-align: center">
                                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                  <!----Edit Button----->
                                  <form method="get" action="{{ route('datakehadiran.datakehadiran.editadmin', $datakehadiranpegawai->id ) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary">
                                      <i class="bi bi-pencil-fill"></i>
                                    </button>
                                  </form>
                                
                                
                                </div> 
                              </td>
                            </tr>
                          @endforeach


                      @endif             
                    </tbody>
                  </table>


              </div>
            
        
            <!-- end second tab -->
          </div>

        </div>
      </div>
    </div>
    
@endsection

   