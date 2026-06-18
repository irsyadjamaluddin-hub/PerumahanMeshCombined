@extends('layouts.app-all')

@section('title', 'Senarai IQ')

@section('content')

  <?php 
    $pagename = "IQ";
  ?>

    <div class="pagetitle">
      <h1>Senarai IQ</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Senarai IQ</li>  
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
                        <th scope="col">Rujukan Fail</th>
                        <th scope="col">Daerah</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jawatan</th>
                        <th scope="col">Tel No.</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Tarikh Mendiami</th>
                        
                        <th scope="col">Action</th>
                    
                      </tr>
                    </thead>
                    <tbody>

                    @if(count($daiq) == 0)

                    <tr class="text-center">
                      <td colspan="8"><h5>No records found</h5></td>
                    </tr>
                          
                    @else
                    @foreach($daiq as $iq)

                         <tr>
                        <td>{{ $iq->rujukan_fail }}</td>
                        <td>{{ $iq->daerah }}</td>
                        <td>{{ $iq->nama_penghuni }}</td>
                        <td>{{ $iq->jawatan_penghuni }}</td>
                        <td>{{ $iq->no_tel }}</td>
                        <td>{{ $iq->alamat_1 }}</td>
                        <td>{{ $iq->tarikh_mendiami }}</td>
                       


                      <td>

                      <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----show Button----->
                                        <form method="get" action="{{ route('daperumahan.daperumahan.editiq', $iq->id ) }}">
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