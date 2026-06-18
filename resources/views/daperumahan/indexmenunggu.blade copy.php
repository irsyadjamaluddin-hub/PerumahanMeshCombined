@extends('layouts.app-all')

@section('title', 'Senarai Menunggu')

@section('content')

  <?php 
    $pagename = "Menunggu";
  ?>

    <div class="pagetitle">
      <h1>Senarai Menunggu</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Senarai Menunggu</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

    <div class="col-md-12">

        @if(Session::has('success_message'))
            <div class="alert alert-success">
                <i class=" fas fa-fw fa-check"></i>
                {!! session('success_message') !!}
            </div>
        @endif

      

         <!-- ACT Table -->
         <div class="col-12">
              <div class="card recent-sales">

  
                <div class="card-body overflow-auto">
                  <!-- <h5 class="card-title">Recent Sales <span>| Today</span></h5> -->

                  <table class="table table-borderless datatable mt-3">
                    <thead>
                      <tr>
                        <th scope="col">Nama Pemohon</th>
                        <th scope="col">Bahagian Pemohon</th>
                        <th scope="col">Jawatan Pemohon</th>
                        <th scope="col">Jenis Perkhidmatan</th>
                        <th scope="col">Kategori Permohonan</th>
                        <th scope="col">Daerah</th>
                        <th scope="col">Tarikh Diterima</th>
                        <th scope="col">Action</th>
                    
                      </tr>
                    </thead>
                    <tbody>

                    @if(count($damenunggu) == 0)

                    <tr class="text-center">
                      <td colspan="8"><h5>No records found</h5></td>
                    </tr>
                          
                    @else
                    @foreach($damenunggu as $menunggu)

                         <tr>
                          <td>{{ $menunggu->nama_pemohon }}</td>
                          <td>{{ $menunggu->bhg_pemohon }}</td>
                          <td>{{ $menunggu->jawatan_pemohon }}</td>
                          <td>{{ $menunggu->jenis_perkhidmatan }}</td>
                          <td>{{ $menunggu->kategori_permohonan }}</td>
                          <td>{{ $menunggu->daerah }}</td>
                          <td>{{ $menunggu->tarikh_diterima }}</td>


                      <td>

                      <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----show Button----->
                                        <form method="get" action="{{ route('daperumahan.daperumahan.editmenunggu', $menunggu->id ) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>

                                        </form>

                                         



                      </td>
                                                  
                      </tr>

                    @endforeach
                    @endif
                      
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

        </div>


    </section>
@endsection