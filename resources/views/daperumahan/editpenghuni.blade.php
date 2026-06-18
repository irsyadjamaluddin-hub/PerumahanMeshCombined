@extends('layouts.app-all')

@section('title', 'Edit')

@section('content')

<?php
$pagename = "Penghuni List";
?>

<div class="pagetitle">
    <h1>Penghuni List</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('daperumahan.daperumahan.indexpenghuni') }}">Senarai Penghuni</a></li>  
        <li class="breadcrumb-item active">Edit Penghuni</li>  
      </ol>
    </nav>
</div><!-- End Page Title -->

<div class="pagetitle">

    <a href="{{ route('daperumahan.daperumahan.indexpenghuni') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-lg-12">
    <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Penghuni Form</h5>

                        {{-- HERE --}}
                        <form class="" id="updatepenghuni" method="post" enctype="multipart/form-data" action="{{ route('daperumahan.daperumahan.updatepenghuni', ['dapenghuni' => $dapenghuni]) }}">
                            @csrf
                            @method('PUT')
                        
                            <br>

                            <div style="padding: 0 24px 0 24px;">

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Nama Penuh Penghuni</div>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_penghuni" id="nama_penghuni" value="{{$dapenghuni->nama_penghuni}}" placeholder="Nama Penghuni" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">No. KPP Penghuni / Warna</div>
                                    <div class="col-md-9">
                                        <input type="text" name="no_kp_penghuni" id="no_kp_penghuni" value="{{$dapenghuni->no_kp_penghuni}}" placeholder="No. KP Penghuni" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Lahir</div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_lahir_penghuni" id="tarikh_lahir_penghuni" value="{{$dapenghuni->tarikh_lahir_penghuni}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Bersara</div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_bersara_penghuni" id="tarikh_bersara_penghuni" value="{{$dapenghuni->tarikh_bersara_penghuni}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Taraf Kelamin</div>
                                    <div class="col-md-9">
                                    <select class="form-control" name="taraf_kelamin" required>
                                        <option value="">--Pilih--</option>
                                        <option value="Lelaki" {{ $dapenghuni->taraf_kelamin == 'Lelaki' ? 'selected' : '' }}>LELAKI</option>
                                        <option value="Perempuan" {{ $dapenghuni->taraf_kelamin == 'Perempuan' ? 'selected' : '' }}>PEREMPUAN</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">No. Perhubungan</div>
                                    <div class="col-md-9">
                                        <input type="tel" name="mob2" id="mob2" value="{{$dapenghuni->mob2}}"  class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tempat Bertugas</div>
                                    <div class="col-md-9">
                                    <input type="text" name="tempat_bertugas" id="tempat_bertugas" value="{{$dapenghuni->tempat_bertugas}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Jawatan</div>
                                    <div class="col-md-9">
                                    <input type="text" name="jawatan" id="jawatan" value="{{$dapenghuni->jawatan}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Bahagian</div>
                                    <div class="col-md-9">
                                    <input type="text" name="bahagian" id="bahagian" value="{{$dapenghuni->bahagian}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tanggagaji</div>
                                    <div class="col-md-9">
                                    <input type="text" name="tangga_gaji" id="tangga_gaji" value="{{$dapenghuni->tangga_gaji}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Gaji Terkini</div>
                                    <div class="col-md-9">
                                    <input type="text" name="gaji_terkini" id="gaji_terkini" value="{{$dapenghuni->gaji_terkini}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Lantikan</div>
                                    <div class="col-md-9">
                                    <input type="date" name="tarikh_lantikan" value="{{$dapenghuni->tarikh_lantikan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Status Lantikan</div>
                                    <div class="col-md-9">
                                    <select class="form-control" name="status_lantikan" required>
                                    <option value="Tetap" {{ $dapenghuni->status_lantikan == 'Tetap' ? 'selected' : '' }}>TETAP</option>
                                    <option value="Kontrak" {{ $dapenghuni->status_lantikan == 'Kontrak' ? 'selected' : '' }}>KONTRAK</option>
                                    <option value="Sementara" {{ $dapenghuni->status_lantikan == 'Sementara' ? 'selected' : '' }}>SEMENTARA</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Ditetapkan Jawatan</div>
                                    <div class="col-md-9">
                                    <input type="date"name="tarikh_jawatan" value="{{$dapenghuni->tarikh_jawatan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Nama Penuh Pasangan</div>
                                    <div class="col-md-9">
                                    <input type="text" name="nama_penuh_pasangan" id="nama_penuh_pasangan" value="{{$dapenghuni->nama_penuh_pasangan}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">No. KPP Pemohon / Warna</div>
                                    <div class="col-md-9">
                                        <input type="text" name="no_kp_pemohon" id="no_kp_pemohon" value="{{$dapenghuni->no_kp_pemohon}}" placeholder="No. KP Pemohon" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tempat Bertugas Pasangan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="tempat_bertugas_pasangan" id="tempat_bertugas_pasangan" value="{{$dapenghuni->tempat_bertugas_pasangan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kementerian</div>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_kementerian" id="nama_kementerian" value="{{$dapenghuni->nama_kementerian}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kemudahan Kerajaan (jika ada) </div>
                                    <div class="col-md-9">
                                        <input type="text" name="kemudahan_kerajaan" id="kemudahan_kerajaan" value="{{$dapenghuni->kemudahan_kerajaan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Alamat Rumah Sewa</div>
                                    <div class="col-md-9">
                                        <input type="text" name="alamat_rumah_sewa" id="alamat_rumah_sewa" value="{{$dapenghuni->alamat_rumah_sewa}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Daerah</div>
                                    <div class="col-md-9">
                                    <select class="form-control" name="daerah" required>
                                        <option value="">--Pilih Daerah--</option>
                                        <option value="BRUNEI MUARA" {{ $dapenghuni->daerah == 'BRUNEI MUARA' ? 'selected' : '' }}>BRUNEI MUARA</option>
                                        <option value="TUTONG" {{ $dapenghuni->daerah == 'TUTONG' ? 'selected' : '' }}>TUTONG</option>
                                        <option value="TEMBURONG" {{ $dapenghuni->daerah == 'TEMBURONG' ? 'selected' : '' }}>TEMBURONG</option>
                                        <option value="BELAIT" {{ $dapenghuni->daerah == 'BELAIT' ? 'selected' : '' }}>BELAIT</option>
                                    </select>
                                    </div>
                                </div>

                                
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kelas</div>
                                    <div class="col-md-9">
                                     <input type="text" name="kelas" id="kelas" value="{{$dapenghuni->kelas}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Sewa Sebulan</div>
                                    <div class="col-md-9">
                                    <input type="text" name="sewa_sebulan" id="sewa_sebulan" value="{{$dapenghuni->sewa_sebulan}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Sewa Sebulan Perabot</div>
                                    <div class="col-md-9">
                                    <input type="text" name="sewa_sebulan_perabot" id="sewa_sebulan_perabot" value="{{$dapenghuni->sewa_sebulan_perabot}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Nama Pemilik</div>
                                    <div class="col-md-9">
                                    <input type="text" name="nama_pemilik" id="nama_pemilik" value="{{$dapenghuni->nama_pemilik}}" class="form-control">
                                    </div>
                                </div>

                                @php
                                $tarikhMendiamiInput = null;
                                $tarikhMendiamiRaw = $dapenghuni->tarikh_mendiami;

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

                                if (!empty($dapenghuni->tarikh_kosong)) {
                                    try {
                                        $tarikhKosong = \Carbon\Carbon::parse($dapenghuni->tarikh_kosong)->format('Y-m-d');
                                    } catch (\Exception $e) {
                                        try {
                                            $tarikhKosong = \Carbon\Carbon::createFromFormat(
                                                'd F Y',
                                                $dapenghuni->tarikh_kosong,
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
                                                {{ $dapenghuni->status_rumahtangga == $status ? 'selected' : '' }}>
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
                                        <input class="form-control file-input" type="file" name="borang_maklumat" id="borang_maklumat">
                                        <span id="file-name-borang_maklumat" class="file-name-inside">
                                             @if($dapenghuni->borang_maklumat)
                                                <a href="{{ Storage::url($dapenghuni->borang_maklumat) }}" target="_blank">
                                                    📄 {{ basename($dapenghuni->borang_maklumat) }}
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
                                        <input class="form-control file-input" type="file" name="kad_pengenalan" id="kad_pengenalan">
                                        <span id="file-name-kad_pengenalan" class="file-name-inside">
                                            @if(!empty($dapenghuni->kad_pengenalan))
                                                <a href="{{ Storage::url($dapenghuni->kad_pengenalan) }}" target="_blank">
                                                    📄 {{ basename($dapenghuni->kad_pengenalan) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                        
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Slip Gaji Terkini Pemohon Dan Atau Suami / Isteri / Penyata Gaji Bagi Sector Swata</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="slip_gaji" id="slip_gaji">
                                        <span id="file-name-slip_gaji" class="file-name-inside">
                                            @if(!empty($dapenghuni->slip_gaji))
                                                <a href="{{ asset('storage/' . $dapenghuni->slip_gaji) }}" target="_blank">
                                                    📄 {{ basename($dapenghuni->slip_gaji) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Sijil Nikah / Cerai / Meninggal (jika berkenaan)</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="sijil_nikah" id="sijil_nikah">
                                        <span id="file-name-sijil_nikah" class="file-name-inside">
                                            @if(!empty($dapenghuni->sijil_nikah))
                                                <a href="{{ asset('storage/' . $dapenghuni->sijil_nikah) }}" target="_blank">
                                                    📄 {{ basename($dapenghuni->sijil_nikah) }}
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
                                        <input class="form-control file-input" type="file" name="surat_lantikan" id="surat_lantikan">
                                        <span id="file-name-surat_lantikan" class="file-name-inside">
                                            @if(!empty($dapenghuni->surat_lantikan))
                                                <a href="{{ asset('storage/' . $dapenghuni->surat_lantikan) }}" target="_blank">
                                                    📄 {{ basename($dapenghuni->surat_lantikan) }}
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
                                        <input class="form-control file-input" type="file" name="surat_penetapan" id="surat_penetapan">
                                        <span id="file-name-surat_penetapan" class="file-name-inside">
                                            @if(!empty($dapenghuni->surat_penetapan))
                                                <a href="{{ asset('storage/' . $dapenghuni->surat_penetapan) }}" target="_blank">
                                                    📄 {{ basename($dapenghuni->surat_penetapan) }}
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
                                        <input class="form-control file-input" type="file" name="dokumen_anak" id="dokumen_anak">
                                        <span id="file-name-dokumen_anak" class="file-name-inside">
                                            @if(!empty($dapenghuni->dokumen_anak))
                                                <a href="{{ asset('storage/' . $dapenghuni->dokumen_anak) }}" target="_blank">
                                                    📄 {{ basename($dapenghuni->dokumen_anak) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="row mb-3 align-items-start">
                                    <div class="col-md-3 label">Surat Kebenaran bantuan Kewangan Kerajaan membina Rumah atau diberi Kemudahan Perumahan RPN atau STKRJ atau lain-lain bantuan-bantuan Kerajaan</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                    <div class="file-input-center-wrapper">
                                        <input class="form-control file-input" type="file" name="surat_bantuan" id="surat_bantuan">
                                                <span id="file-name-surat_bantuan" class="file-name-inside">
                                                    @if(!empty($dapenghuni->surat_bantuan))
                                                        <a href="{{ asset('storage/' . $dapenghuni->surat_bantuan) }}" target="_blank">
                                                            📄 {{ basename($dapenghuni->surat_bantuan) }}
                                                        </a>
                                                    @else
                                                        No file selected.
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Surat / Dokumen Tawaran Dan Persetujuan Mendiami</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="dokumen_tawaran" id="dokumen_tawaran">
                                        <span id="file-name-dokumen_tawaran" class="file-name-inside">
                                            @if(!empty($dapenghuni->dokumen_tawaran))
                                                <a href="{{ asset('storage/' . $dapenghuni->dokumen_tawaran) }}" target="_blank">
                                                    📄 {{ basename($dapenghuni->dokumen_tawaran) }}
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
                                        <input class="form-control file-input" type="file" name="dokumen_mendiami" id="dokumen_mendiami">
                                        <span id="file-name-dokumen_mendiami" class="file-name-inside">
                                            @if(!empty($dapenghuni->dokumen_mendiami))
                                                <a href="{{ asset('storage/' . $dapenghuni->dokumen_mendiami) }}" target="_blank">
                                                    📄 {{ basename($dapenghuni->dokumen_mendiami) }}
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
                                        <input class="form-control file-input" type="file" name="dokumen_pengakuan" id="dokumen_pengakuan">
                                        <span id="file-name-dokumen_pengakuan" class="file-name-inside">
                                            @if(!empty($dapenghuni->dokumen_pengakuan))
                                                <a href="{{ asset('storage/' . $dapenghuni->dokumen_pengakuan) }}" target="_blank">
                                                    📄 {{ basename($dapenghuni->dokumen_pengakuan) }}
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
                                        <input class="form-control file-input" type="file" name="dokumen_kosong" id="dokumen_kosong">
                                        <span id="file-name-dokumen_kosong" class="file-name-inside">
                                            @if(!empty($dapenghuni->dokumen_kosong))
                                                <a href="{{ asset('storage/' . $dapenghuni->dokumen_kosong) }}" target="_blank">
                                                    📄 {{ basename($dapenghuni->dokumen_kosong) }}
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
                                        <input class="form-control file-input" type="file" name="dokumen_lain" id="dokumen_lain">
                                        <span id="file-name-dokumen_lain" class="file-name-inside">
                                            @if(!empty($dapenghuni->dokumen_lain))
                                                <a href="{{ Storage::url($dapenghuni->dokumen_lain) }}" target="_blank">
                                                    📄 {{ basename($dapenghuni->dokumen_lain) }}
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
                            var form = document.getElementById('updatepenghuni');
                            
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

/* Keep your existing styles for .file-input and .file-name-inside */

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