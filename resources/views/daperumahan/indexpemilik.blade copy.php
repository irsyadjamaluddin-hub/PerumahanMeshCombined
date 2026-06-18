@extends('layouts.app-all')

@section('title', 'Senarai pemilik')

@section('content')

  <?php 
    $pagename = "pemilik";
  ?>

    <div class="pagetitle">
      <h1>Senarai pemilik</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Senarai pemilik</li>  
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
                        <th scope="col">Nama</th>
                        <th scope="col">No KP</th>
                        <th scope="col">Mukim</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Kampung</th>  
                        <th scope="col">Status Rumah</th>
                        <th scope="col">Gambar Rumah</th>
                        <th scope="col">Action</th>
                    
                      </tr>
                    </thead>
                    <tbody>

                    @if(count($dapemilik) == 0)

                    <tr class="text-center">
                      <td colspan="8"><h5>No records found</h5></td>
                    </tr>
                          
                    @else
                    @foreach($dapemilik as $pemilik)

                         <tr>
                        <td>{{ $pemilik->rujukan_fail }}</td>
                        <td>{{ $pemilik->nama_pemilik }}</td>
                        <td>{{ $pemilik->no_kp1 }}</td>
                        <td>{{ $pemilik->mukim }}</td>
                        <td>{{ $pemilik->lokasi }}</td>
                        <td>{{ $pemilik->kampung }}</td>
                        <td>{{ $pemilik->status_rumah }}</td>
                        <!-- <td>{{ $pemilik->image }}</td> -->
                        <!-- <td>
                          <a href="{{ $pemilik['image'] ? asset('storage/' . $pemilik['image']) : asset('storage/images/image_not_available.png') }}" target="_blank">
                            <img src="{{ $pemilik['image'] ? asset('storage/' . $pemilik['image']) : asset('storage/images/image_not_available.png') }}" alt="{{ $pemilik['image'] ? 'Uploaded Image' : 'Image Not Available' }}" width="100">
                          </a>
                        </td> -->



                        <td>
                      @if ($pemilik['image'])
                          <img src="{{ asset('storage/' . $pemilik['image']) }}"
                              alt="Uploaded Image"
                              width="100">
                      @else
                          <i class="bi bi-file-earmark-image" style="font-size: 40px; color: #6c757d;"></i>
                      @endif
                      </td>
                      
                      <td>

                      <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----show Button----->
                                        <form method="get" action="{{ route('daperumahan.daperumahan.showpemilik', $pemilik->id ) }}">
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