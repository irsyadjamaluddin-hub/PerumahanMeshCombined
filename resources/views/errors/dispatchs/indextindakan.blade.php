@extends('layouts.app-all')

@section('title', 'e-Correspondence')

@section('content')

<?php
$pagename = "MEC";
?>

<img src="/img/mec.jpeg">
<div class="pagetitle">

  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">MEC</li>
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

    <div class="row mb-2">
      <div class="col-md-11">


      </div>

      <div class="col-md-1">
        <a href="{{ route('dispatchs.dis.createmec') }}" class="btn btn-primary text-right">
          <i class="bi bi-plus-lg"></i>
        </a>
      </div>
    </div>



    <!-- W.A>L Table -->
    <div class="col-12">
      <div class="card recent-sales">
        <div class="card-body overflow-auto">
          <table class="table table-borderless datatable mt-3">
            <thead>
              <tr>
                <th scope="col">No.Rujukan</th>
                <th scope="col">Perkara</th>
                <th scope="col">Tarikh</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              @if(count($dispatchpassmecs) == 0)

              <tr class="text-center">
                <td colspan="8">
                  <h5>No records found</h5>
                </td>
              </tr>

              @else

              @foreach($dispatchs as $dispatch)

              @foreach($dispatchpassmecs as $dispatchpassmec)

              <!-- Dibawah ani if and else untuk limit the viewer of tindakan with their respective Ic -->
              @if((optional($dispatchpassmec->Tindakan)->label) == ("Pengarah" || "Kakitangan PT || Pegawai Tindakan") && (optional($dispatchpassmec->Tindakan)->ic_no) == Auth::user()->ic_no )


              <tr>
                <td>{{$dispatchpassmec->no_folio}}</td>
                <td>{{$dispatch->perkara}}</td>
                <td>{{ date('d/m/Y', strtotime($dispatch->date_admin_submit)) }}</td>


                <td>
                  <div class="btn-group gap-2" role="group" aria-label="Basic example">

                    <!----Edit Button----->
                    <form method="get" action="{{ route('dispatchs.dis.edittindakan', $dispatch->id ) }}">
                      @csrf

                      <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-pencil-fill"></i>
                      </button>

                    </form>

                    <!----Show Button----->
                    <form method="get" action="{{ route('dispatchs.dis.showtindakan', $dispatch->id ) }}">
                      @csrf
                      <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-eye-fill"></i>
                      </button>
                    </form>


                    <!----Delete Button----->
                    <form method="post" action="#">
                      @csrf

                      @method('delete')

                      <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash-fill"></i>
                      </button>

                    </form>

                  </div>

                </td>

              </tr>

              @else

              <tr class="text-center">

              </tr>


              @endif



              @endforeach

              @endforeach
              @endif



            </tbody>
          </table>

        </div>

      </div>
    </div><!-- End Recent Sales -->

  </div>


  @endsection