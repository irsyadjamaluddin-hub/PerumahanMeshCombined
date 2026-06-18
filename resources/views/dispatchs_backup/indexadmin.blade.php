@extends('layouts.app-all')

@section('title', 'Admin e-Despatch')

@section('content')

<?php
$pagename = "DIS";
?>

<img src="/img/med.jpeg">

<style>                
.dataTable-info{
    color: white;
}
</style>

<section class="section">
  <div class="row">

    @if(Session::has('success_message'))
    <div class="alert alert-success">
      <i class=" fas fa-fw fa-check"></i>
      {!! session('success_message') !!}
    </div>
    @endif


    <div class="col-lg-12 mt-2">

        <a href="{{ route('dispatchs.dis.mecuser') }}" class="btn btn-primary">
        <i class="ri-user-add-fill"></i>
        </a>

        <a href="{{ route('dispatchs.dis.untukperhatian') }}" class="btn btn-primary"> 
        UP
        </a>

    </div>

    <div class="col-lg-12 mt-2">
      <div class="card">

        <div class="card-body overflow-auto">

          <table class="table table-borderless datatable mt-3">
            <thead>
              <tr>
                <th scope="col">Jenis</th>
                <th scope="col">Perkara</th>
                <th scope="col">Ruj.Persuratan</th>
                <th scope="col">Daripada</th>
                <th scope="col">Dokumen</th>                
                <th scope="col">Tarikh Menerima</th>
                <th scope="col">Tindakan</th>
              </tr>
            </thead>

            <tbody>
              @if(count($dispatchs) == 0)
              <tr class="text-center">
                <td colspan="8">
                  <h5>No records found</h5>
                </td>
              </tr>

              @else
              @foreach($dispatchs as $dispatch)
              @php $kpds=$dispatch->kpd ? json_decode($dispatch->kpd, true) : []; @endphp

              <tr>
                <td>{{ optional($dispatch->jenis)->label }}</td>
                <td>{{$dispatch->perkara}}</td>
                <td>{{ $dispatch->rp }}</td>
<!--                 <td>{{ $dispatch->rm}}</td>
 -->                <td>{{ optional($dispatch->Daripada)->label }}</td>
                <td><a href='{{Storage::url("$dispatch->lamp") }}' target="_blank">
                    <p>{{$dispatch->dis_filename}}</p>
                  </a></td> 
<!--                 <td>@foreach (json_decode($dispatch->kpd) as $kpds){{ $kpds }}
                    <br>
                    @endforeach
                </td> -->

                @if ($dispatch->dispatch_recieved_at == null)
                <td><a href="{{ route('dispatchs.dis.terima', $dispatch->id) }}" class="btn btn-success">Terima</a></td>
                @else
                <td>{{ date('d/m/Y', strtotime($dispatch->dispatch_recieved_at)) }}</td>
                @endif

                <td>
                  <div class="btn-group gap-2" role="group" aria-label="Basic example">

                    <!----Edit Button----->
                    <form method="get" action="{{ route('dispatchs.dis.editadmin', $dispatch->id ) }}">
                      @csrf
                      <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-pencil-fill"></i>
                      </button>
                    </form>

                    <!----Show Button----->
                    <form method="get" action="{{ route('dispatchs.dis.showadmin', $dispatch->id) }}">
                      @csrf
                      <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-eye-fill"></i>
                      </button>
                    </form>

                    <!----Delete Button----->
                    <form method="post" action="{{ route('dispatchs.dis.destroyadmin', $dispatch->id ) }}">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash-fill"></i>
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
      </div>
    </div>
  </div>

@endsection