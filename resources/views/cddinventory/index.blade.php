@extends('layouts.app-all')

@section('title', 'Pengurusan Bahan-Bahan Kurikulum')

@section('content')

<?php
    $pagename = "Cddinventory";
?>

<div class="pagetitle">
  <h1>Pengurusan Bahan-Bahan Kurikulum</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Laman Utama</a></li>
      <li class="breadcrumb-item active">Pengurusan Bahan-Bahan Kurikulum</li>  
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

    <!-- Buttons -->
    <div class="card-body d-flex justify-content-end" style="padding: 10px;">
        <button type="button" data-bs-toggle="modal" data-bs-target="#infoModal" class="btn btn-primary">Borang</button>
        @if (Auth::check())
            <!-- @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_CDDINVENTORY') )
            <a href="{{ route('cddinventory.indexgbpg') }}" class="btn btn-secondary ms-3"><i class="bi bi-person-badge"></i></a>
            @endif -->
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <a href="{{ route('cddinventory.cddinventory.create') }}">
                        <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                            <div class="card-body" style="padding: 10px;">
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-post-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 style="font-size: 22px;">Sekolah</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('cddinventory.cddinventory.createunit') }}">
                        <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                            <div class="card-body" style="padding: 10px;">
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-post"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 style="font-size: 22px;">Unit</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div><!-- End Basic Modal -->

    <div class="card mt-3">
        <div class="card-body pt-3">

            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                <button class="nav-link w-100 {{ request('tab') != 'unit' ? 'active' : '' }}"
        data-bs-toggle="tab"
        data-bs-target="#sekolah-in">Sekolah</button>
                </li>
                <li class="nav-item">
                <button class="nav-link w-100 {{ request('tab') == 'unit' ? 'active' : '' }}"
        data-bs-toggle="tab"
        data-bs-target="#unit-in">Unit</button>
                </li>
            </ul>

            <br>

            <div class="tab-content pt-2">

                <!-- Sekolah Tab -->
                <div class="tab-pane fade {{ request('tab') != 'unit' ? 'show active' : '' }}" id="sekolah-in">
                    <div class="card-body overflow-auto">
                        <table class="table table-borderless datatable mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Bil.</th>
                                    <th scope="col">Nama Sekolah</th>
                                    <th scope="col">Tarikh</th>
                                    <th scope="col">Status GB</th>
                                    <th scope="col">Status JPK</th>
                                    <th scope="col">Borang Pengeluaran JPK</th>
                                    <th scope="col">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($inventory) == 0)
                                    <tr class="text-center">
                                        <td colspan="8">
                                            <h5>Tiada rekod dijumpai</h5>
                                        </td>
                                    </tr>
                                @else
                                    @foreach($inventory as $inventory)   
                                        <tr>
                                            <td>{{\Carbon\Carbon::parse($inventory->created_at)->format('Y')}}/SP/BBK-{{ $inventory->id }}</td>
                                            <td>{{ $inventory->nama_sch }}</td>
                                            <td>{{ $inventory->created_at }}</td>
                                            <td>
                                                @if ($inventory->kgp_status == NULL)
                                                    <span class="badge bg-danger">Belum Selesai</span>
                                                @elseif ($inventory->kgp_status == "Need Amendments")
                                                    <span class="badge bg-warning">Perlu Pindaan</span>
                                                @elseif ($inventory->kgp_status == "Waiting for Approval")
                                                    @if (Auth::user()->ic_no === $inventory->kgp_ic_no)
                                                        <span class="badge bg-info text-white">Menunggu Kelulusan</span>
                                                    @else
                                                        <span class="badge bg-info text-white">Menunggu Kelulusan</span>
                                                    @endif
                                                @elseif ($inventory->kgp_status == "Approve")
                                                    <span class="badge bg-success">Diluluskan</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $inventory->kgp_status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $submitted = $inventory->submitted_forms ?? 0;
                                                    $total = $inventory->total_forms ?? 0;
                                                    $bp_submitted = $inventory->bp_submitted ?? false;
                                                    $kgp_status = $inventory->kgp_status ?? null;
                                                @endphp

                                                @if ($kgp_status == "Approve" && $submitted == 0)
                                                    <span class="badge bg-primary">Permohonan Diterima</span>
                                                @elseif ($total == 0)
                                                    <span class="badge bg-primary">Permohonan Diterima</span>
                                                @elseif ($submitted > 0 && $submitted < $total)
                                                    <span class="badge bg-warning">Dalam Proses ({{ $submitted }}/{{ $total }})</span>
                                                @elseif ($submitted == $total && $total > 0)
                                                    <span class="badge bg-success">Selesai ({{ $submitted }}/{{ $total }})</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($inventory->bp_submitted)
                                                    <form method="get" action="{{ route('cddinventory.cddinventory.bpform', $inventory->id) }}">
                                                        <button type="submit" class="btn btn-outline-primary">
                                                            <i class="bi bi-file-earmark-text-fill"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group gap-2" role="group">
                                                    <form method="get" action="{{ route('cddinventory.cddinventory.edit', $inventory->id ) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-primary">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </button>
                                                    </form>
                                                    @if($inventory->kgp_status != 'Approve')
                                                        <form method="post" action="{{ route('cddinventory.cddinventory.destroy', $inventory->id ) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Sahkan untuk padam data?')">
                                                                <i class="bi bi-trash-fill"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Unit Tab -->
                <div class="tab-pane fade {{ request('tab') == 'unit' ? 'show active' : '' }}" id="unit-in">
                    <div class="card-body overflow-auto">
                        <table class="table table-borderless datatable mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Bil.</th>
                                    <th scope="col">Nama Unit</th>
                                    <th scope="col">Tarikh</th>
                                    <th scope="col">Status PPK</th>
                                    <th scope="col">Status JPK</th>
                                    <th scope="col">Borang Pengeluaran JPK</th>
                                    <th scope="col">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($inventoryunit) == 0)
                                    <tr class="text-center">
                                        <td colspan="7"><h5>Tiada rekod dijumpai</h5></td>
                                    </tr>
                                @else
                                    @foreach($inventoryunit as $inventoryunit)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($inventoryunit->created_at)->format('Y') }}/UP/BBK-{{ $inventoryunit->id }}</td>
                                            <td>{{ $inventoryunit->unit }}</td>
                                            <td>{{ $inventoryunit->created_at }}</td>
                                            <td>
                                                    @if ($inventoryunit->kgp_status == NULL)
                                                        <span class="badge bg-danger">Belum Selesai</span>
                                                    @elseif ($inventoryunit->kgp_status == "Need Amendments")
                                                        <span class="badge bg-warning">Perlu Pindaan</span>
                                                    @elseif ($inventoryunit->kgp_status == "Waiting for Approval")
                                                        @if (Auth::user()->ic_no === $inventoryunit->ppk_ic_no)
                                                            <span class="badge bg-info text-white">Menunggu Kelulusan</span>
                                                        @else
                                                            <span class="badge bg-info text-white">Menunggu Kelulusan</span>
                                                        @endif
                                                    @elseif ($inventoryunit->kgp_status == "Approve")
                                                        <span class="badge bg-success">Diluluskan</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $inventoryunit->kgp_status }}</span>
                                                    @endif
                                                </td>
                                            <td>
                                                @php
                                                    $submitted = $inventoryunit->submitted_forms ?? 0;
                                                    $total = $inventoryunit->total_forms ?? 0;
                                                    $bp_submitted = $inventoryunit->bp_submitted ?? false;
                                                    $kgp_status = $inventoryunit->kgp_status ?? null;
                                                @endphp

                                               @if ($kgp_status == "Approve" && ($submitted == 0 || $total == 0))
                                                    <span class="badge bg-primary">Permohonan Diterima</span>
                                                @elseif ($submitted > 0 && $submitted < $total)
                                                    <span class="badge bg-warning">Dalam Proses ({{ $submitted }}/{{ $total }})</span>
                                                @elseif ($submitted == $total && $total > 0)
                                                    <span class="badge bg-success">Selesai ({{ $submitted }}/{{ $total }})</span>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($bp_submitted)
                                                    <form method="get" action="{{ route('cddinventory.cddinventory.bpform', $inventoryunit->id) }}">
                                                        <button type="submit" class="btn btn-outline-primary">
                                                            <i class="bi bi-file-earmark-text-fill"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group gap-2" role="group">
                                                    <form method="get" action="{{ route('cddinventory.cddinventory.editunit', $inventoryunit->id ) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-primary">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </button>
                                                    </form>
                                                    @if($inventoryunit->kgp_status != 'Approve')
                                                        <form method="post" action="{{ route('cddinventory.cddinventory.destroy', $inventoryunit->id ) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Sahkan untuk padam data?')">
                                                                <i class="bi bi-trash-fill"></i>
                                                            </button>
                                                        </form>
                                                    @endif
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
    </div>

</section>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function () {

    const urlParams = new URLSearchParams(window.location.search);
    const tab = urlParams.get('tab');

    const unitTabBtn = document.querySelector('[data-bs-target="#unit-in"]');

    if (tab === 'unit' && unitTabBtn) {
        const tabInstance = new bootstrap.Tab(unitTabBtn);
        tabInstance.show();

        // FORCE redraw AFTER visible
        unitTabBtn.addEventListener('shown.bs.tab', function () {

            setTimeout(() => {
                window.dispatchEvent(new Event('resize'));
            }, 200);

        });
    }

});
</script>