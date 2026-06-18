@extends('layouts.app-all')

@section('title', 'Prestasi')

@section('content')

<?php
$pagename = "prestasi";
?>


<style>                
.dataTable-info{
    color: white;
}
</style>

    <div class="pagetitle">
      <h1>Prestasi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Prestasi</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

<section class="section">
<div class="row">

    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif

    <div class="col-12 mb-2 mt-2" style="text-align: right;">
        <!-- <a href="{{ route('prestasi.prestasi.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a> -->
    </div>


    <div class="col-12">
        <div class="card">

            <div class="card-body overflow-auto">

                <table class="table table-borderless datatable mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">IC No.</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Dokumen</th>
                            <th scope="col">Tarikh</th>
                            <th scope="col">Status</th>
                            <th scope="col">Catatan Admin</th>

                            <th scope="col">Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        @if(count($prestasi) == 0)
                        <tr class="text-center">
                            <td colspan="8">
                                <h5>No records found</h5>
                            </td>
                        </tr>

                        @else

                        @foreach($prestasi as $prestasi)

                            <tr>

                                <td>{{ $prestasi->nama }}</td>
                                <td>{{ $prestasi->ic_no}}</td>
                                <td>{{ optional($prestasi->Department)->label }}</td>
                               


                                <td>
                                    @if($prestasi->filename && count($prestasi->filename) > 0)
                                        @foreach($prestasi->filename as $index => $filename)
                                            <a href="{{ Storage::url($filename) }}">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="bi bi-collection"></i>
                                                </button>
                                            </a>
                                        @endforeach

                                    @else

                                    @if($prestasi->file)

                                     @foreach($prestasi->file as $index => $filename)

                                      <a href="{{ url('storage/prestasi/' . $filename) }}" target="_blank"> <button type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top">
                                        <i class="bi bi-collection"></i></button></a>

                                    @endforeach
                            
                                        @else
                                        <p>No file chosen</p>
                                        @endif
                                        @endif
                                   
                                    
                                </td>

                                <td><span > {{ $prestasi->created_at }}</span></td>


                                
                                @if ($prestasi->status == 'Sedang dikemaskini')
                                <td><span class="badge bg-primary"> Sedang dikemaskini</span></td>
                                @elseif ($prestasi->status == 'Selesai')
                                <td><span class="badge bg-success"> Selesai</span></td>
                                @else
                                <td>{{$prestasi->status}}</td>

                                @endif
                                
                                <td>{{ $prestasi -> catatanadmin}}</td>
                                
                                <td>

                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('prestasi.prestasi.editadmin', $prestasi->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </form>

                                
                                                                                
                                    </div>

                                     <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                            <!----Delete Button----->
                                            <form method="post" action="{{ route('prestasi.prestasi.destroy', $prestasi->id ) }}">
                                                @csrf
                                                @method('delete')
                                                <a onclick='return confirm("Confirm to delete data?")'>
                                                <button type="submit" class="btn btn-outline-danger" >
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
</section>
@endsection