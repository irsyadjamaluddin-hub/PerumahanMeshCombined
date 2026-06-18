@extends('layouts.app-all')

@section('title', 'Senarai IQ Kosong')

@section('content')

  <?php 
    $pagename = "IQ Kosong";
  ?>

    <div class="pagetitle">
      <h1>Senarai IQ Kosong</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Senarai IQ Kosong</li>  
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
                        <th scope="col" style="min-width: 250px;">Rujukan Fail</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No KP</th>
                        <th scope="col">Mukim</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Daerah</th>
                        <th scope="col">Status Rumah</th>
                        <th scope="col">Action</th>
                    
                      </tr>
                    </thead>
                    <tbody>

                    @if(count($dapenghuniiq?? []) == 0)

                    <tr class="text-center">
                      <td colspan="8"><h5>No records found</h5></td>
                    </tr>
                          
                    @else
                    @foreach($dapenghuniiq as $penghuniiq)

                     <tr>
                        <td>{{ $penghuniiq->rujukan_fail }}</td>
                        <td>{{ $penghuniiq->nama_pemilik }}</td>
                        <td>{{ $penghuniiq->no_kp1 }}</td>
                        <td>{{ $penghuniiq->mukim }}</td>
                        <td>{{ $penghuniiq->kelas }}</td>
                        <td>{{ $penghuniiq->lokasi }}</td>
                        <td>{{ $penghuniiq->kampung }}</td>
                        <td>{{ $penghuniiq->status_rumah }}</td>
                        



                      <td>

                      <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----show Button----->
                                        <form method="get" action="{{ route('daperumahan.daperumahan.editpenghuniiq', $penghuniiq->id ) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye-fill"></i>
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