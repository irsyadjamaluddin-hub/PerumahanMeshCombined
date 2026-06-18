@extends('layouts.app-all')

@section('title', 'Inventory Index Senarai agihan dan pengesahan penerimaan bahan')

@section('content')

<?php
    $pagename = "Cddinventory";
  ?>

    <div class="pagetitle">
      <h1>SENARAI AGIHAN DAN PENGESAHAN PENERIMAAN BAHAN</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
  
          <li class="breadcrumb-item active">SENARAI AGIHAN DAN PENGESAHAN PENERIMAAN BAHAN</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

 
    <section class="section profile">

        <!--  Index Table -->


            @if(Session::has('success_message'))
            <div class="alert alert-success">
                <i class=" fas fa-fw fa-check"></i>
                {!! session('success_message') !!}


            </div>
            @endif

            <div class="col-12 mb-2 mt-2" style="text-align: right;">
                <a href="{{ route('cddinventory.cddinventory.createsebutharga') }}" class="btn btn-primary" style="display: inline-block;">
                    <i class="bi bi-plus-lg"></i>
                </a>


                <form action="{{ route('cddinventory.cddinventory.downloadallrecordspdf') }}" method="GET" style="display: inline-block;">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-file-earmark-text me-1"></i>
                    </button>
                </form>
                
                <form action="{{ route('download.pdfs.zip') }}" method="GET" style="display: inline-block;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-file-archive"></i>
                    </button>
                </form>
            </div>

        
            <div class="col-12">
                <div class="card recent-sales">
                    <div class="card-body pt-3">

                        <!-- Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link w-100 active"
                                        data-bs-toggle="tab"
                                        data-bs-target="#sebutharga-sekolah">
                                    Sekolah
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link w-100"
                                        data-bs-toggle="tab"
                                        data-bs-target="#sebutharga-unit">
                                    Unit
                                </button>
                            </li>
                        </ul>

                        <br>

                        <!-- Tab Content -->
                        <div class="tab-content pt-2">

                            <!-- ================= SEKOLAH TAB ================= -->
                            <div class="tab-pane fade show active" id="sebutharga-sekolah">

                                <div class="card-body overflow-auto">

                                    <table class="table table-borderless datatable mt-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">Bil.</th>
                                                <th scope="col">Bil. PO</th>
                                                <th scope="col">Emel Pembekal</th>
                                                <th scope="col">Pembekal</th>
                                                <th scope="col">Tarikh</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if(count($inventorysebutharga) == null)
                                                <tr class="text-center">
                                                    <td colspan="6">
                                                        <h5>No records found</h5>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach($inventorysebutharga as $inventorysebutharga)
                                                    <tr>
                                                        <td>SH{{ $inventorysebutharga->id }}</td>
                                                        <td>{{ $inventorysebutharga->bil_po }}</td>
                                                        <td>{{ $inventorysebutharga->emel_pembekal }}</td>
                                                        <td>{{ $inventorysebutharga->pembekal }}</td>
                                                        <td>{{ $inventorysebutharga->created_at }}</td>

                                                        <td>
                                                                @if($inventorysebutharga->status == 'SELESAI')
                                                                    <span class="badge bg-success">SELESAI</span>

                                                                @elseif($inventorysebutharga->status == 'BELUM SELESAI')
                                                                    <span class="badge bg-warning text-dark">BELUM SELESAI</span>

                                                                @else
                                                                    <span class="badge bg-danger">BELUM DI HANTAR</span>
                                                                @endif
                                                            </td>

                                                        <td>
                                                            <div class="btn-group gap-2">

                                                                <form method="get"
                                                                    action="{{ route('cddinventory.cddinventory.editsebutharga', $inventorysebutharga->id ) }}">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-outline-primary">
                                                                        <i class="bi bi-pencil-fill"></i>
                                                                    </button>
                                                                </form>

                                                                <form action="{{ route('generate.pdf', ['in' => $inventorysebutharga->id]) }}"
                                                                    method="GET" target="_blank">
                                                                    <button type="submit" class="btn btn-outline-secondary">
                                                                        <i class="fas fa-file-pdf"></i>
                                                                    </button>
                                                                </form>

                                                                <form action="{{ route('cddinventory.cddinventory.emailvendor', $inventorysebutharga->id) }}"
                                                                    method="GET">

                                                                    @csrf

                                                                    @if($inventorysebutharga->email_status == NULL)
                                                                        <button type="submit" class="btn btn-outline-primary">
                                                                            <i class="fas fa-envelope"></i>
                                                                        </button>
                                                                    @else
                                                                        <button type="submit" class="btn btn-primary">
                                                                            <i class="fas fa-envelope"></i>
                                                                        </button>
                                                                    @endif
                                                                </form>

                                                                <form method="post"
                                                                    action="{{ route('cddinventory.cddinventory.destroysebutharga', $inventorysebutharga->id) }}">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit"
                                                                            onclick="return confirm('Confirm to delete data?')"
                                                                            class="btn btn-outline-danger">
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

                            <!-- ================= UNIT TAB ================= -->
                            <div class="tab-pane fade" id="sebutharga-unit">

                                <div class="card-body overflow-auto">

                                    <div class="alert alert-info mt-3">
                                        Unit data not shown yet (same table can be reused or separate dataset later).
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- End Recent Sales -->
        
        



    </section>
@endsection