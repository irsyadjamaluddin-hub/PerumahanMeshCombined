@extends('layouts.app-all')

@section('title', 'Edit')

@section('content')

<?php
$pagename = "Penghuni IQ List";
?>

<div class="pagetitle">
    <h1>Penghuni IQ List</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('daperumahan.daperumahan.indexpenghuniiq') }}">Senarai Penghuni IQ</a></li>  
        <li class="breadcrumb-item active">Edit Penghuni IQ</li>  
      </ol>
    </nav>
</div><!-- End Page Title -->

<div class="pagetitle">

    <a href="{{ route('daperumahan.daperumahan.indexpenghuniiq') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-lg-12">
    <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Penghuni IQ Form</h5>

                        {{-- HERE --}}
                        <form class="" id="updatepenghuniiq" method="post" enctype="multipart/form-data" action="{{ route('daperumahan.daperumahan.updatepenghuniiq', ['dapenghuniiq' => $dapenghuniiq]) }}">
                            @csrf
                            @method('PUT')
                        
                            <br>

                            <div style="padding: 0 24px 0 24px;">

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Nama Penuh Penghuni</div>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_penghuni" id="nama_penghuni" value="{{$dapenghuniiq->nama_penghuni}}" placeholder="Nama Penghuni" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">No. KPP Penghuni / Warna</div>
                                    <div class="col-md-9">
                                        <input type="text" name="no_kp_penghuni" id="no_kp_penghuni" value="{{$dapenghuniiq->no_kp_penghuni}}" placeholder="No. KP Penghuni" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Lahir</div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_lahir_penghuni" id="tarikh_lahir_penghuni" value="{{$dapenghuniiq->tarikh_lahir_penghuni}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Bersara</div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_bersara_penghuni" id="tarikh_bersara_penghuni" value="{{$dapenghuniiq->tarikh_bersara_penghuni}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Taraf Kelamin</div>
                                    <div class="col-md-9">
                                    <select class="form-control" name="taraf_kelamin" required>
                                        <option disabled>--Pilih--</option>
                                        <option value="LELAKI" {{ $dapenghuniiq->taraf_kelamin == 'LELAKI' ? 'selected' : '' }}>LELAKI</option>
                                        <option value="PEREMPUAN" {{ $dapenghuniiq->taraf_kelamin == 'PEREMPUAN' ? 'selected' : '' }}>PEREMPUAN</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tanggungan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_tanggungan" id="nama_tanggungan" value="{{$dapenghuniiq->nama_tanggungan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">No. Perhubungan</div>
                                    <div class="col-md-9">
                                        <input type="tel" name="mob2" id="mob2" value="{{$dapenghuniiq->mob2}}"  class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tempat Bertugas</div>
                                    <div class="col-md-9">
                                    <input type="text" name="tempat_bertugas" id="tempat_bertugas" value="{{$dapenghuniiq->tempat_bertugas}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Jawatan</div>
                                    <div class="col-md-9">
                                    <input type="text" name="jawatan" id="jawatan" value="{{$dapenghuniiq->jawatan}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Bahagian</div>
                                    <div class="col-md-9">
                                    <input type="text" name="bahagian" id="bahagian" value="{{$dapenghuniiq->bahagian}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tanggagaji</div>
                                    <div class="col-md-9">
                                    <input type="text" name="tangga_gaji" id="tangga_gaji" value="{{$dapenghuniiq->tangga_gaji}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Gaji Terkini</div>
                                    <div class="col-md-9">
                                    <input type="text" name="gaji_terkini" id="gaji_terkini" value="{{$dapenghuniiq->gaji_terkini}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Lantikan</div>
                                    <div class="col-md-9">
                                    <input type="date" name="tarikh_lantikan" value="{{$dapenghuniiq->tarikh_lantikan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Status Lantikan</div>
                                    <div class="col-md-9">
                                    <select class="form-control" name="status_lantikan" required>
                                        <option value="Tetap" {{ $dapenghuniiq->status_lantikan == 'Tetap' ? 'selected' : '' }}>TETAP</option>
                                        <option value="Kontrak" {{ $dapenghuniiq->status_lantikan == 'Kontrak' ? 'selected' : '' }}>KONTRAK</option>
                                        <option value="Sementara" {{ $dapenghuniiq->status_lantikan == 'Sementara' ? 'selected' : '' }}>SEMENTARA</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Ditetapkan Jawatan</div>
                                    <div class="col-md-9">
                                    <input type="date"name="tarikh_jawatan" value="{{$dapenghuniiq->tarikh_jawatan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Nama Penuh Pasangan</div>
                                    <div class="col-md-9">
                                    <input type="text" name="nama_penuh_pasangan" id="nama_penuh_pasangan" value="{{$dapenghuniiq->nama_penuh_pasangan}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">No. KPP Pemohon / Warna</div>
                                    <div class="col-md-9">
                                        <input type="text" name="no_kp_pemohon" id="no_kp_pemohon" value="{{$dapenghuniiq->no_kp_pemohon}}" placeholder="No. KP Pemohon" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tempat Bertugas Pasangan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="tempat_bertugas_pasangan" id="tempat_bertugas_pasangan" value="{{$dapenghuniiq->tempat_bertugas_pasangan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kementerian</div>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_kementerian" id="nama_kementerian" value="{{$dapenghuniiq->nama_kementerian}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kemudahan Kerajaan (jika ada) </div>
                                    <div class="col-md-9">
                                        <input type="text" name="kemudahan_kerajaan" id="kemudahan_kerajaan" value="{{$dapenghuniiq->kemudahan_kerajaan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Alamat Perumahan Kerajaan (IQ)</div>
                                    <div class="col-md-9">
                                        <input type="text" name="alamat_rumah_kerajaan" id="alamat_rumah_kerajaan" value="{{$dapenghuniiq->alamat_rumah_kerajaan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Daerah</div>
                                    <div class="col-md-9">
                                    <select class="form-control" name="daerah" required>
                                        <option value="">--Pilih Daerah--</option>
                                        <option value="BRUNEI MUARA" {{ $dapenghuniiq->daerah == 'BRUNEI MUARA' ? 'selected' : '' }}>BRUNEI MUARA</option>
                                        <option value="TUTONG" {{ $dapenghuniiq->daerah == 'TUTONG' ? 'selected' : '' }}>TUTONG</option>
                                        <option value="TEMBURONG" {{ $dapenghuniiq->daerah == 'TEMBURONG' ? 'selected' : '' }}>TEMBURONG</option>
                                        <option value="BELAIT" {{ $dapenghuniiq->daerah == 'BELAIT' ? 'selected' : '' }}>BELAIT</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kelas</div>
                                    <div class="col-md-9">
                                     <input type="text" name="kelas" id="kelas" value="{{$dapenghuniiq->kelas}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Bayaran Sebulan</div>
                                    <div class="col-md-9">
                                    <input type="text" name="bayaran_sebulan" id="bayaran_sebulan" value="{{$dapenghuniiq->bayaran_sebulan}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Dibekal Perabot</div>
                                    <div class="col-md-9">
                                    <input type="text" name="dibekal_perabot" id="dibekal_perabot" value="{{$dapenghuniiq->dibekal_perabot}}" class="form-control">
                                    </div>
                                </div>

                                @php
                                $tarikhMendiamiInput = null;
                                $tarikhMendiamiRaw = $dapenghuniiq->tarikh_mendiami;

                                if (!empty($tarikhMendiamiRaw)) {
                                    try {
                                        $tarikhMendiamiInput = \Carbon\Carbon::parse($tarikhMendiamiRaw)->format('Y-m-d');
                                    } catch (\Exception $e) {
                                        try {
                                            $tarikhMendiamiInput = \Carbon\Carbon::createFromFormat(
                                                'd F Y',
                                                $tarikhMendiamiRaw,
                                                'ms'
                                            )->format('Y-m-d');
                                        } catch (\Exception $e) {
                                            $tarikhMendiamiInput = null;
                                        }
                                    }
                                }
                            @endphp


                            <div class="row mb-2">
                                <div class="col-md-3 label">Tarikh Mula Mendiami</div>

                                <div class="col-md-9">
                                    <div class="d-flex gap-2 align-items-center">
                                        {{-- Calendar input (always editable) --}}
                                        <input
                                            type="date"
                                            name="tarikh_mendiami"
                                            class="form-control"
                                            value="{{ $tarikhMendiamiInput }}"
                                        >

                                    
                                    </div>
                                </div>
                            </div>


                            @php
                                $tarikhKosong = null;

                                if (!empty($dapenghuniiq->tarikh_kosong)) {
                                    try {
                                        $tarikhKosong = \Carbon\Carbon::parse($dapenghuniiq->tarikh_kosong)->format('Y-m-d');
                                    } catch (\Exception $e) {
                                        try {
                                            $tarikhKosong = \Carbon\Carbon::createFromFormat(
                                                'd F Y',
                                                $dapenghuniiq->tarikh_kosong,
                                                'ms'
                                            )->format('Y-m-d');
                                        } catch (\Exception $e) {
                                            $tarikhKosong = null;
                                        }
                                    }
                                }
                            @endphp

                            <div class="row mb-2">
                                <div class="col-md-3 label">Tarikh Mengosongkan</div>
                                <div class="col-md-9">
                                    <input
                                        type="date"
                                        name="tarikh_kosong"
                                        id="tarikh_kosong"
                                        value="{{ $tarikhKosong }}"
                                        class="form-control"
                                    >
                                </div>
                            </div>

                            <div class="row mb-2">
                                    <div class="col-md-3 label">Status</div>
                                    <div class="col-md-9">
                                    <select name="status_rumahtangga" id="status_rumahtangga" class="form-control">
                                    <option value="">--Pilih Status--</option>
                                        @foreach ($statusList as $status)
                                            <option value="{{ $status }}"
                                                {{ $dapenghuniiq->status_rumahtangga == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <br>
                                <hr>
                                <br>
                            </div>
                           
                        
                    </div>
                </div>
                <br>
            </div>
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
                                    <div class="col-md-3 label">Borang Maklumat</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="borang_maklumat_spiq" id="borang_maklumat_spiq">
                                        <span id="file-name-borang_maklumat_spiq" class="file-name-inside">
                                             @if(!empty($dapenghuniiq->borang_maklumat_spiq))
                                                <a href="{{ asset('storage/' . $dapenghuniiq->borang_maklumat_spiq) }}" target="_blank">
                                                    📄 {{ basename($dapenghuniiq->borang_maklumat_spiq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Gambar IQ / No.Alamat Pintu</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="gambar_spiq" id="gambar_spiq">
                                        <span id="file-name-gambar_spiq" class="file-name-inside">
                                             @if(!empty($dapenghuniiq->gambar_spiq))
                                                <a href="{{ asset('storage/' . $dapenghuniiq->gambar_spiq) }}" target="_blank">
                                                    📄 {{ basename($dapenghuniiq->gambar_spiq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                        
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kad Pengenalan Penghuni Dan Atau Suami / Isteri</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="kad_pengenalan_spiq" id="kad_pengenalan_spiq">
                                        <span id="file-name-kad_pengenalan_spiq" class="file-name-inside">
                                            @if(!empty($dapenghuniiq->kad_pengenalan_spiq))
                                                <a href="{{ asset('storage/' . $dapenghuniiq->kad_pengenalan_spiq) }}" target="_blank">
                                                    📄 {{ basename($dapenghuniiq->kad_pengenalan_spiq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Slip Gaji Terkini Pemohon Dan Atau Suami / Isteri / Penyata Gaji Bagi Sector Swasta</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="slip_gaji_spiq" id="slip_gaji_spiq">
                                        <span id="file-name-slip_gaji_spiq" class="file-name-inside">
                                            @if(!empty($dapenghuniiq->slip_gaji_spiq))
                                                <a href="{{ asset('storage/' . $dapenghuniiq->slip_gaji_spiq) }}" target="_blank">
                                                    📄 {{ basename($dapenghuniiq->slip_gaji_spiq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Surat Lantikan Jawatan Terkini Pemohon</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="surat_lantikan_spiq" id="surat_lantikan_spiq">
                                        <span id="file-name-surat_lantikan_spiq" class="file-name-inside">
                                            @if(!empty($dapenghuniiq->surat_lantikan_spiq))
                                                <a href="{{ asset('storage/' . $dapenghuniiq->surat_lantikan_spiq) }}" target="_blank">
                                                    📄 {{ basename($dapenghuniiq->surat_lantikan_spiq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Surat Penetapan Jawatan Pemohon</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="surat_penetapan_spiq" id="surat_penetapan_spiq">
                                        <span id="file-name-surat_penetapan_spiq" class="file-name-inside">
                                            @if(!empty($dapenghuniiq->surat_penetapan_spiq))
                                                <a href="{{ asset('storage/' . $dapenghuniiq->surat_penetapan_spiq) }}" target="_blank">
                                                    📄 {{ basename($dapenghuniiq->surat_penetapan_spiq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Surat Beranak, Kad Pengenalan Anak Dan Atau Surat Kebenaran Mengangkat</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="dokumen_anak_spiq" id="dokumen_anak_spiq">
                                        <span id="file-name-dokumen_anak_spiq" class="file-name-inside">
                                            @if(!empty($dapenghuniiq->dokumen_anak_spiq))
                                                <a href="{{ asset('storage/' . $dapenghuniiq->dokumen_anak_spiq) }}" target="_blank">
                                                    📄 {{ basename($dapenghuniiq->dokumen_anak_spiq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                <div class="row mb-3 align-items-start">
                                    <div class="col-md-3 label">Surat Kebenaran Bantuan Kewangan Kerajaan Membina Rumah Atau Diberi Kemudahan Perumahan RPN atau STKRJ atau Lain-lain Bantuan-bantuan Kerajaan</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="surat_bantuan_spiq" id="surat_bantuan_spiq">
                                        <span id="file-name-surat_bantuan_spiq" class="file-name-inside">
                                            @if(!empty($dapenghuniiq->surat_bantuan_spiq))
                                                <a href="{{ asset('storage/' . $dapenghuniiq->surat_bantuan_spiq) }}" target="_blank">
                                                    📄 {{ basename($dapenghuniiq->surat_bantuan_spiq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Surat / Dokumen Tawaran Dan Persetujuan Mendiami</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="dokumen_tawaran_spiq" id="dokumen_tawaran_spiq">
                                        <span id="file-name-dokumen_tawaran_spiq" class="file-name-inside">
                                            @if(!empty($dapenghuniiq->dokumen_tawaran_spiq))
                                                <a href="{{ asset('storage/' . $dapenghuniiq->dokumen_tawaran_spiq) }}" target="_blank">
                                                    📄 {{ basename($dapenghuniiq->dokumen_tawaran_spiq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Surat / Dokumen Tarikh Mula Mendiami</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="dokumen_mendiami_spiq" id="dokumen_mendiami_spiq">
                                        <span id="file-name-dokumen_mendiami_spiq" class="file-name-inside">
                                            @if(!empty($dapenghuniiq->dokumen_mendiami_spiq))
                                                <a href="{{ asset('storage/' . $dapenghuniiq->dokumen_mendiami_spiq) }}" target="_blank">
                                                    📄 {{ basename($dapenghuniiq->dokumen_mendiami_spiq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Surat / Dokumen Pengakuan Bersetuju Mendiami</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="dokumen_pengakuan_spiq" id="dokumen_pengakuan_spiq">
                                        <span id="file-name-dokumen_pengakuan_spiq" class="file-name-inside">
                                            @if(!empty($dapenghuniiq->dokumen_pengakuan_spiq))
                                                <a href="{{ asset('storage/' . $dapenghuniiq->dokumen_pengakuan_spiq) }}" target="_blank">
                                                    📄 {{ basename($dapenghuniiq->dokumen_pengakuan_spiq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Surat / Dokumen Mengosongkan</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="dokumen_kosong_spiq" id="dokumen_kosong_spiq">
                                        <span id="file-name-dokumen_kosong_spiq" class="file-name-inside">
                                            @if(!empty($dapenghuniiq->dokumen_kosong_spiq))
                                                <a href="{{ asset('storage/' . $dapenghuniiq->dokumen_kosong_spiq) }}" target="_blank">
                                                    📄 {{ basename($dapenghuniiq->dokumen_kosong_spiq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Lain- lain Dokumen (jika ada)</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="dokumen_lain_spiq" id="dokumen_lain_spiq">
                                        <span id="file-name-dokumen_lain_spiq" class="file-name-inside">
                                            @if(!empty($dapenghuniiq->dokumen_lain_spiq))
                                                <a href="{{ asset('storage/' . $dapenghuniiq->dokumen_lain_spiq) }}" target="_blank">
                                                    📄 {{ basename($dapenghuniiq->dokumen_lain_spiq) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <br>
                                <hr>
                                <br>
                            </div>
                            <div class="text-center">
                                <button id="submit-button" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <script>
                            var submitButton = document.getElementById('submit-button');
                            var form = document.getElementById('updatepenghuniiq');
                            
                            form.addEventListener('submit', function(event) {
                                if (submitButton.getAttribute('data-submitted') !== null) {
                                    event.preventDefault();
                                } else {
                                    submitButton.disabled = true;
                                    submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                                    submitButton.setAttribute('data-submitted', 'true');
                                }
                            });

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
                <br>
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
</style>

@endsection