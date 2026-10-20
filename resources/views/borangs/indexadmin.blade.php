@extends('layouts.app-all')

@section('title', 'Borang')

@section('content')

  <?php 
    $pagename = "Borang";
  ?>

    <div class="pagetitle">
      <h1>Borang</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Borang</li>  
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
     <div class="row mb-2">
            <div class="col-md-10">
            </div>
            <div class="col-md-2" style="text-align:center;">
                <a href="http://127.0.0.1:8000/pdt"  target="_blank" class= "btn btn-primary">
                    <i class="bi bi-link"></i>
                </a>
                <a href="/assets/img/qrcode/pdt.jpg"  target="_blank" class= "btn btn-primary text-right">
                    <i class="bi bi-qr-code"></i>
                </a>
            </div>
        </div>

    <!-- ACT Table -->
    <div class="col-12">
      <div class="card recent-sales">
        <div class="card-body overflow-auto">

            <table class="table table-borderless datatable mt-3">
              <thead>
                <tr>
                  <th scope="col">Jabatan</th>
                  <th scope="col">Perkhidmatan</th>
                  <th scope="col">Huraian</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
  
              @if(count($borangs) == 0)

                <tr class="text-center">
                    <td colspan="8">
                        <h5 style="margin-top: 30px;">No records found</h5>
                    </td>
                </tr>

              @else

              @foreach($borangs as $borang)
              <tr>
                <td>{{ $borang->jabatan }}</td>
                <td style="text-align: center;">{{ $borang->perkhidmatan }}</td>
                <td style="text-align: justify;">{{ $borang->huraian }}</td>
                <td>

                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                <!----show Button----->
                <form method="get" action="{{ route('borang.borangs.showadmin' , $borang->id) }}">
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