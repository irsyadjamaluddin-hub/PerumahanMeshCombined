@extends('layouts.app-all')

@section('title', 'Edit')

@section('content')

<?php
$pagename = "Pemilik";
?>

<div class="pagetitle">
    <h1>Edit Pemilik</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('daperumahan.daperumahan.indexpemilik') }}">Senarai Pemilik</a></li>
            <li class="breadcrumb-item"><a href="{{ route('daperumahan.daperumahan.showpemilik', $dapemilik->id) }}">Show Pemilik</a></li>  
            <li class="breadcrumb-item active">Edit Pemilik</li>  
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="pagetitle">

    <a href="{{ route('daperumahan.daperumahan.showpemilik', $dapemilik->id) }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Pemilik Form</h5>

                        {{-- HERE --}}
                        <form class="" id="updatepemilik" method="post" enctype="multipart/form-data" action="{{ route('daperumahan.daperumahan.updatepemilik', ['dapemilik' => $dapemilik]) }}">
                            @csrf
                            @method('PUT')
                        
                            <br>

                            <div style="padding: 0 24px 0 24px;">

                                {{-- nama penghuni, nokp2, lokasi, mukim, rujukan fail --}}

                                <!-- Detail Pemilik -->
                                <!-- <div class="card mb-3">
                                    <div class="card-header">Maklumat Pemilik</div>
                                    <div class="card-body"> -->

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">Rujukan Fail</div>
                                            <div class="col-md-9">
                                                <input type="text" name="rujukan_fail" id="rujukan_fail" placeholder="DA / AKR /..." class="form-control" value="{{$dapemilik->rujukan_fail}}"> 
                                            </div>
                                        </div>


                                        <div class="row mb-2">
                                            <div class="col-md-3 label">Nama Penuh Pemilik</div>
                                            <div class="col-md-9">
                                                <input type="text" name="nama_pemilik" id="nama_pemilik"  class="form-control" value="{{$dapemilik->nama_pemilik}}">
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">NO KPP Pemilik</div>
                                            <div class="col-md-9">
                                            <input type="text" name="no_kp1" id="no_kp1" class="form-control" value="{{$dapemilik->no_kp1}}">
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">Alamat Rumah Sewa</div>
                                            <div class="col-md-9">
                                                <input type="text" name="alamat_rumah_sewa" id="alamat_rumah_sewa" rows="3" class="form-control" value="{{$dapemilik->alamat_rumah_sewa}}">
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">Alamat Persuratan</div>
                                            <div class="col-md-9">
                                                <input type="text" name="alamat_persuratan" id="alamat_persuratan" rows="3" class="form-control" value="{{$dapemilik->alamat_persuratan}}">
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">No Perhubungan</div>
                                            <div class="col-md-9">
                                                <input type="tel" name="mob1" id="mob1" class="form-control" value="{{$dapemilik->mob1}}" >
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">Mukim</div>
                                            <div class="col-md-9">
                                                <input type="text" name="mukim" id="mukim" class="form-control" value="{{$dapemilik->mukim}}" >
                                                <!-- or change to <select> if you have fixed options -->
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">Daerah</div>
                                            <div class="col-md-9">
                                            <select class="form-control" name="daerah" required>
                                            <option value="BRUNEI MUARA" {{ $dapemilik->daerah == 'BRUNEI MUARA' ? 'selected' : '' }}>BRUNEI MUARA</option>
                                            <option value="TUTONG" {{ $dapemilik->daerah == 'TUTONG' ? 'selected' : '' }}>TUTONG</option>
                                            <option value="TEMBURONG" {{ $dapemilik->daerah == 'TEMBURONG' ? 'selected' : '' }}>TEMBURONG</option>
                                            <option value="BELAIT" {{ $dapemilik->daerah == 'BELAIT' ? 'selected' : '' }}>BELAIT</option>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">Sewa Sebulan</div>
                                            <div class="col-md-9">
                                                <input type="text" name="sewa_sebulan" id="sewa_sebulan" class="form-control" value="{{$dapemilik->sewa_sebulan}}">
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">Sewa Perabot Sebulan</div>
                                            <div class="col-md-9">
                                                <input type="text" name="kadar_sewa_perabot_terkini" id="kadar_sewa_perabot_terkini" class="form-control" value="{{$dapemilik->kadar_sewa_perabot_terkini}}">
                                            </div>
                                        </div>


                                        @php
                                            $tarikhMulaDisewaRaw = $dapemilik->tarikh_mula_disewa;
                                            $tarikhMulaDisewaInput = null;

                                            if (!empty($tarikhMulaDisewaRaw)) {
                                                try {
                                                    $tarikhMulaDisewaInput = \Carbon\Carbon::parse($tarikhMulaDisewaRaw)->format('Y-m-d');
                                                } catch (\Exception $e) {
                                                    try {
                                                        $tarikhMulaDisewaInput = \Carbon\Carbon::createFromFormat(
                                                            'd F Y',
                                                            $tarikhMulaDisewaRaw,
                                                            'ms'
                                                        )->format('Y-m-d');
                                                    } catch (\Exception $e) {
                                                        $tarikhMulaDisewaInput = null;
                                                    }
                                                }
                                            }
                                        @endphp

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">Tarikh Mula Disewa</div>
                                            <div class="col-md-9">
                                                <div class="d-flex gap-2 align-items-center">
                                                    <input
                                                        type="date"
                                                        name="tarikh_mula_disewa"
                                                        class="form-control"
                                                        value="{{ $tarikhMulaDisewaInput }}"
                                                    >

                                                  
                                                </div>
                                            </div>
                                        </div>

                                        @php
                                            $bermulaRaw = $dapemilik->bermula;
                                            $bermulaInput = null;

                                            if (!empty($bermulaRaw)) {
                                                try {
                                                    $bermulaInput = \Carbon\Carbon::parse($bermulaRaw)->format('Y-m-d');
                                                } catch (\Exception $e) {
                                                    try {
                                                        $bermulaInput = \Carbon\Carbon::createFromFormat(
                                                            'd F Y',
                                                            $bermulaRaw,
                                                            'ms'
                                                        )->format('Y-m-d');
                                                    } catch (\Exception $e) {
                                                        $bermulaInput = null;
                                                    }
                                                }
                                            }
                                        @endphp

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">Tarikh Penyambungan TA</div>
                                            <div class="col-md-9">
                                                <div class="d-flex gap-2 align-items-center">
                                                    <input
                                                        type="date"
                                                        name="tarikh_penyambungan_ta"
                                                        class="form-control"
                                                        value="{{ $bermulaInput }}"
                                                    >

                                                   
                                                </div>
                                            </div>
                                        </div>

                                        @php
                                            $berakhirRaw = $dapemilik->berakhir;
                                            $berakhirInput = null;

                                            if (!empty($berakhirRaw)) {
                                                try {
                                                    $berakhirInput = \Carbon\Carbon::parse($berakhirRaw)->format('Y-m-d');
                                                } catch (\Exception $e) {
                                                    try {
                                                        $berakhirInput = \Carbon\Carbon::createFromFormat(
                                                            'd F Y',
                                                            $berakhirRaw,
                                                            'ms'
                                                        )->format('Y-m-d');
                                                    } catch (\Exception $e) {
                                                        $berakhirInput = null;
                                                    }
                                                }
                                            }
                                        @endphp

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">Tarikh Mansuh TA </div>
                                            <div class="col-md-9">
                                                <div class="d-flex gap-2 align-items-center">
                                                    <input
                                                        type="date"
                                                        name="berakhir"
                                                        class="form-control"
                                                        value="{{ $berakhirInput }}"
                                                    >

                                                 
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">Nama Penghuni</div>
                                            <div class="col-md-9">
                                                <input type="text" name="nama_penghuni" id="nama_penghuni" class="form-control" value="{{$dapemilik->nama_penghuni}}">
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">Tarikh Mula Mendiami</div>
                                            <div class="col-md-9">
                                                <input type="date" name="tarikh_mula_mendiami" id="tarikh_mula_mendiami" class="form-control" value="{{$dapemilik->tarikh_mula_mendiami}}">
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">Tarikh Mengosongkan</div>
                                            <div class="col-md-9">
                                                <input type="date" name="tarikh_mengosongkan" id="tarikh_mengosongkan" class="form-control" value="{{$dapemilik->tarikh_mengosongkan}}">
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">Status</div>
                                            <div class="col-md-9">
                                                <select name="status_rumah" id="status_rumah" class="form-control">
                                                @php
                                                    $data_penghuni = $rumah2_pemilik[0] ?? null;
                                                @endphp
                                                    <option value="" {{ $data_penghuni->status_rumah == null ? 'selected' : '' }}>--Pilih Status--</option>
                                                    @foreach ($statusList as $status)
                                                        <option value="{{ $status }}" {{ $data_penghuni->status_rumah == $status ? 'selected' : '' }}>{{ $status }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3 label">Status Permohonan</div>
                                            <div class="col-md-9">
                                            <select class="form-control" name="status_permohonan" required>
                                                <option disabled>--Pilih--</option>
                                                <option value="BARU" {{ $dapemilik->status_permohonan == 'Baru' ? 'selected' : '' }}>BARU</option>
                                                <option value="DALAM PROSES" {{ $dapemilik->status_permohonan == 'DALAM PROSES' ? 'selected' : '' }}>DALAM PROSES</option>
                                                <option value="LULUS" {{ $dapemilik->status_permohonan == 'Lulus' ? 'selected' : '' }}>LULUS</option>
                                                <option value="DITOLAK" {{ $dapemilik->status_permohonan == 'Ditolak' ? 'selected' : '' }}>DITOLAK</option>
                                            </select>
                                         </div>
                                </div>
                                <br>
                                <br>
                            </div>
                     
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>

     <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Muat Naik Dokumen</h5>

                        {{-- HERE --}}
                        
                            <br>

                            <div style="padding: 0 24px 0 24px;">

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Borang Penyambungan</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="borang_penyambungan" id="borang_penyambungan">
                                        <span id="file-name-borang_penyambungan" class="file-name-inside">
                                             @if(!empty($dapemilik->borang_penyambungan))
                                                <a href="{{ asset('storage/' . $dapemilik->borang_penyambungan) }}" target="_blank">
                                                    📄 {{ basename($dapemilik->borang_penyambungan) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Surat / Dokumen perjanjian mula hingga terkini</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="dokumen_perjanjian" id="dokumen_perjanjian">
                                        <span id="file-name-dokumen_perjanjian" class="file-name-inside">
                                             @if(!empty($dapemilik->dokumen_perjanjian))
                                                <a href="{{ asset('storage/' . $dapemilik->dokumen_perjanjian) }}" target="_blank">
                                                    📄 {{ basename($dapemilik->dokumen_perjanjian) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            <div class="row mb-2">
                                <div class="col-md-3 label">Laporan Teknikal</div>
                                <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="laporan_teknikal" id="laporan_teknikal">
                                        <span id="file-name-laporan_teknikal" class="file-name-inside">
                                             @if(!empty($dapemilik->laporan_teknikal))
                                                <a href="{{ asset('storage/' . $dapemilik->laporan_teknikal) }}" target="_blank">
                                                    📄 {{ basename($dapemilik->laporan_teknikal) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            <div class="row mb-2">
                                <div class="col-md-3 label">Insuren yang masih sah laku</div>
                                <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="insurans" id="insurans">
                                        <span id="file-name-insurans" class="file-name-inside">
                                             @if(!empty($dapemilik->insurans))
                                                <a href="{{ asset('storage/' . $dapemilik->insurans) }}" target="_blank">
                                                    📄 {{ basename($dapemilik->insurans) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            <div class="row mb-2">
                                <div class="col-md-3 label">Resit pembayaran pemadam kebakaran</div>
                                <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="resit_pemadam_kebakaran" id="resit_pemadam_kebakaran">
                                        <span id="file-name-resit_pemadam_kebakaran" class="file-name-inside">
                                             @if(!empty($dapemilik->insurans))
                                                <a href="{{ asset('storage/' . $dapemilik->resit_pemadam_kebakaran) }}" target="_blank">
                                                    📄 {{ basename($dapemilik->resit_pemadam_kebakaran) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            <div class="row mb-2">
                                <div class="col-md-3 label">KPP Pemilik</div>
                                <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="kpp_pemilik" id="kpp_pemilik">
                                        <span id="file-name-kpp_pemilik" class="file-name-inside">
                                             @if(!empty($dapemilik->kpp_pemilik))
                                                <a href="{{ asset('storage/' . $dapemilik->kpp_pemilik) }}" target="_blank">
                                                    📄 {{ basename($dapemilik->kpp_pemilik) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            <div class="row mb-2">
                                <div class="col-md-3 label">Geran Tanah</div>
                                <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="geran_tanah" id="geran_tanah">
                                        <span id="file-name-geran_tanah" class="file-name-inside">
                                             @if(!empty($dapemilik->geran_tanah))
                                                <a href="{{ asset('storage/' . $dapemilik->geran_tanah) }}" target="_blank">
                                                    📄 {{ basename($dapemilik->geran_tanah) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            <div class="row mb-2">
                                <div class="col-md-3 label">Surat Kesiapan Rumah (OP)</div>
                                <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="surat_op" id="surat_op">
                                        <span id="file-name-surat_op" class="file-name-inside">
                                             @if(!empty($dapemilik->surat_op))
                                                <a href="{{ asset('storage/' . $dapemilik->surat_op) }}" target="_blank">
                                                    📄 {{ basename($dapemilik->surat_op) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            <div class="row mb-2">
                                <div class="col-md-3 label">Gambar Rumah Terkini</div>
                                <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="gambar_rumah" id="gambar_rumah">
                                        <span id="file-name-gambar_rumah" class="file-name-inside">
                                             @if(!empty($dapemilik->gambar_rumah))
                                                <a href="{{ asset('storage/' . $dapemilik->gambar_rumah) }}" target="_blank">
                                                    📄 {{ basename($dapemilik->gambar_rumah) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            <div class="row mb-2">
                                <div class="col-md-3 label">Pengesah Penomboran Rumah</div>
                                <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="pengesah_penomboran" id="pengesah_penomboran">
                                        <span id="file-name-pengesah_penomboran" class="file-name-inside">
                                             @if(!empty($dapemilik->pengesah_penomboran))
                                                <a href="{{ asset('storage/' . $dapemilik->pengesah_penomboran) }}" target="_blank">
                                                    📄 {{ basename($dapemilik->pengesah_penomboran) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            <div class="row mb-2">
                                <div class="col-md-3 label">Senarai Perabot Yang Dibekalkan</div>
                                <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="senarai_perabot" id="senarai_perabot">
                                        <span id="file-name-senarai_perabot" class="file-name-inside">
                                             @if(!empty($dapemilik->senarai_perabot))
                                                <a href="{{ asset('storage/' . $dapemilik->senarai_perabot) }}" target="_blank">
                                                    📄 {{ basename($dapemilik->senarai_perabot) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            <div class="row mb-2">
                                <div class="col-md-3 label">Memorandum taksiran Perabot</div>
                                <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="memorandum_perabot" id="memorandum_perabot">
                                        <span id="file-name-memorandum_perabot" class="file-name-inside">
                                             @if(!empty($dapemilik->memorandum_perabot))
                                                <a href="{{ asset('storage/' . $dapemilik->memorandum_perabot) }}" target="_blank">
                                                    📄 {{ basename($dapemilik->memorandum_perabot) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            <div class="row mb-2">
                                <div class="col-md-3 label">Surat Kebenaran Pihak ABCi Jika Terdapat</div>
                                <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="surat_abci" id="surat_abci">
                                        <span id="file-name-surat_abci" class="file-name-inside">
                                             @if(!empty($dapemilik->surat_abci))
                                                <a href="{{ asset('storage/' . $dapemilik->surat_abci) }}" target="_blank">
                                                    📄 {{ basename($dapemilik->surat_abci) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            <div class="row mb-2">
                                <div class="col-md-3 label">Surat 'Sale Dan Purchase Agreement' (jika ada)</div>
                                <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="sale_purchase_agreement" id="sale_purchase_agreement">
                                        <span id="file-name-sale_purchase_agreement" class="file-name-inside">
                                             @if(!empty($dapemilik->sale_purchase_agreement))
                                                <a href="{{ asset('storage/' . $dapemilik->sale_purchase_agreement) }}" target="_blank">
                                                    📄 {{ basename($dapemilik->sale_purchase_agreement) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            <div class="row mb-2">
                                <div class="col-md-3 label">Permohonan Berkhidmat Dengan Kerjaan</div>
                                <div class="col-lg-8 col-md-9 position-relative">
                                    <input class="form-control file-input" type="file" name="permohonan_kerajaan" id="permohonan_kerajaan">
                                    <span id="file-name-permohonan_kerajaan" class="file-name-inside">
                                        @if(!empty($dapemilik->permohonan_kerajaan))
                                            <a href="{{ asset('storage/' . $dapemilik->permohonan_kerajaan) }}" target="_blank">
                                                📄 {{ basename($dapemilik->permohonan_kerajaan) }}
                                            </a>
                                        @else
                                            No file selected.
                                        @endif
                                    </span>
                                    <p style="font-size: 14px;">
                                        'Surat Kebenaran Memiliki Tanah Dari JPM',
                                        'Slip Gaji', 
                                        'Surat Kebenaran Pinjaman Kewangan, MOF dan Ekonomi, Bank, dan lain-lain'
                                    </p>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-3 label">Lain - lain Dokumen (jika ada)</div>
                                <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="dokumen_lain_spmlk" id="dokumen_lain_spmlk">
                                        <span id="file-name-dokumen_lain_spmlk" class="file-name-inside">
                                             @if(!empty($dapemilik->dokumen_lain_spmlk))
                                                <a href="{{ asset('storage/' . $dapemilik->dokumen_lain_spmlk) }}" target="_blank">
                                                    📄 {{ basename($dapemilik->dokumen_lain_spmlk) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="text-center pt-3">
                                <button id="submit-button" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <script>
                           document.addEventListener('DOMContentLoaded', function () {
                                const inputs = document.querySelectorAll('.file-input');

                                inputs.forEach(input => {
                                    const display = document.getElementById('file-name-' + input.id);

                                    if (!display) return;

                                    input.addEventListener('change', function () {
                                        if (input.files.length > 0) {
                                            display.textContent = input.files[0].name;
                                        } else {
                                            display.textContent = 'No file selected';
                                        }
                                    });
                                });
                                
                                document.querySelectorAll('.file-name-inside a').forEach(link => {
                                    link.addEventListener('click', function(e) {
                                        e.stopPropagation();
                                    });
                                });
                            });

                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include other necessary JS libraries here (e.g., Bootstrap) -->


<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    });
</script>


<script>
$(document).ready(function(){

    // Initialize select2
    $("#myselection").select2();

    // Read selected option
    $('#but_read').click(function(){
    var username = $('#myselection option:selected').text();
    var userid = $('#myselection').val();

    $('#result').html("id : " + userid + ", name : " + username);

    });
    });
</script>

<style>
    .removeDeclare:hover {
        background-color: #dc3545 !important;
    }
</style>

<style>
.file-input {
    position: relative;
    z-index: 1;
    font-size: 0;
    background-color: transparent;
    height: 38px;
    padding: 6px 12px;
}

.file-input::file-selector-button {
    height: calc(1.6em + .75rem + 2px); /* match Bootstrap input height */
    padding: .5rem 1rem;
    font-size: 14px;
}

/* For older browsers */
.file-input::-webkit-file-upload-button {
    height: 100%;
    padding: .5rem 1rem;
    font-size: 14px;
}

.file-name-inside {
    position: absolute;
    top: 50%;
    left: 120px;
    transform: translateY(-50%);
    z-index: 3;
    font-size: 15px;
    color: #6c757d;
    max-width: 60%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    pointer-events: auto;
    color: #000;
}

.file-name-inside a {
    color: #0d6efd;
    text-decoration: none;
}

.file-name-inside a:hover {
    text-decoration: underline;
}

#file-name-permohonan_kerajaan {
    position: absolute;
    top: 45%;
    left: 120px; /* aligns right of the Browse button */
    transform: translateY(-50%);
    font-size: 15px;
    color:black;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: calc(100% - 120px);
    pointer-events: none;
    height: 39px;
}
</style>

@endsection