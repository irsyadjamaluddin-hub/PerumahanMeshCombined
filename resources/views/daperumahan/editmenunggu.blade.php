@extends('layouts.app-all')

@section('title', 'Edit')

@section('content')

<?php
$pagename = "Menunggu List";
?>

<div class="pagetitle">
    <h1>Menunggu List</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('daperumahan.daperumahan.indexmenunggu') }}">Senarai Menunggu</a></li>  
        <li class="breadcrumb-item active">Edit Menunggu</li>  
      </ol>
    </nav>
</div><!-- End Page Title -->

<div class="pagetitle">

    <a href="{{ route('daperumahan.daperumahan.indexmenunggu') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Menunggu Form</h5>

                        {{-- HERE --}}
                        <form class="" id="updatemenunggu" method="post" enctype="multipart/form-data" action="{{ route('daperumahan.daperumahan.updatemenunggu', ['damenunggu' => $damenunggu]) }}">
                            @csrf
                            @method('PUT')
                        
                            <br>

                            <div style="padding: 0 24px 0 24px;">


                                <div class="row mb-2">
                                    <div class="col-md-3 label">Nama Penuh Pemohon</div>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_pemohon" id="nama_pemohon" value="{{$damenunggu->nama_pemohon}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">No. KPP Pemohon / Warna</div>
                                    <div class="col-md-9">
                                        <input type="text" name="no_kp_pemohon" id="no_kp_pemohon" value="{{$damenunggu->no_kp_pemohon}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Lahir</div>
                                    <div class="col-md-9">
                                     <input type="date" name="tarikh_lahir" value="{{$damenunggu->tarikh_lahir}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Bersara</div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_bersara" value="{{$damenunggu->tarikh_bersara}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Taraf Kelamin</div>
                                    <div class="col-md-9">
                                    <select class="form-control" name="taraf_kelamin">
                                        <option disabled>--Pilih--</option>
                                        <option value="Lelaki">LELAKI</option>
                                        <option value="Perempuan">PEREMPUAN</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tanggungan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_tanggungan" id="nama_tanggungan" value="{{$damenunggu->nama_tanggungan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Alamat Persuratan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="alamat_persuratan" id="alamat_persuratan" value="{{$damenunggu->alamat_persuratan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">No. Perhubungan</div>
                                    <div class="col-md-9">
                                        <input type="tel" name="no_tell" id="no_tell" value="{{$damenunggu->no_tell}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Alamat Tempat Tinggal</div>
                                    <div class="col-md-9">
                                        <input type="text" name="alamat_tinggal" id="alamat_tinggal" value="{{$damenunggu->alamat_tinggal}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tempat Bertugas Pemohon</div>
                                    <div class="col-md-9">
                                        <input type="text" name="tempat_pemohon" id="tempat_pemohon" value="{{$damenunggu->tempat_pemohon}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Jawatan</div>
                                    <div class="col-md-9">
                                    <input type="text" name="jawatan_pemohon" id="jawatan_pemohon" value="{{$damenunggu->jawatan_pemohon}}" class="form-control">
                                 </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Bahagian</div>
                                    <div class="col-md-9">
                                        <select name="bhg_pemohon" id="bhg_pemohon" class="form-control">
                                            @foreach ($bhgPemohon as $bhg)
                                                <option value="{{ $bhg }}" {{ $damenunggu->bhg_pemohon == $bhg ? 'selected' : '' }}>{{ $bhg }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tanggagaji</div>
                                    <div class="col-md-9">
                                        <input type="text" name="bahagian_tanggagaji" id="bahagian_tanggagaji" value="{{$damenunggu->bahagian_tanggagaji}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Gaji Terkini</div>
                                    <div class="col-md-9">
                                        <input type="text" name="gaji_terkini" id="gaji_terkini" value="{{$damenunggu->gaji_terkini}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Lantikan</div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_lantikan" value="{{$damenunggu->tarikh_lantikan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Status Lantikan</div>
                                    <div class="col-md-9">
                                    <select class="form-control" name="status_lantikan" required>
                                        <option value="Tetap" {{ $damenunggu->status_lantikan == 'Tetap' ? 'selected' : '' }}>TETAP</option>
                                        <option value="Kontrak" {{ $damenunggu->status_lantikan == 'Kontrak' ? 'selected' : '' }}>KONTRAK</option>
                                        <option value="Sementara" {{ $damenunggu->status_lantikan == 'Sementara' ? 'selected' : '' }}>SEMENTARA</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Ditetapkan Jawatan</div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_jawatan" value="{{$damenunggu->tarikh_jawatan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Nama Penuh Pasangan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_pasangan" id="nama_pasangan" value="{{$damenunggu->nama_pasangan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">No. KPP Pemohon / Warna</div>
                                    <div class="col-md-9">
                                        <input type="text" name="no_kp_pemohon" id="no_kp_pemohon" value="{{$damenunggu->no_kp_pemohon}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tempat Bertugas Pasangan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="tempat_bertugas_pasangan" id="tempat_bertugas_pasangan" value="{{$damenunggu->tempat_bertugas_pasangan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kementerian</div>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_kementerian" id="nama_kementerian" value="{{$damenunggu->nama_kementerian}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kemudahan Kerjaan (jika ada)</div>
                                    <div class="col-md-9">
                                        <input type="text" name="kemudahan_kerja" id="kemudahan_kerja" value="{{$damenunggu->kemudahan_kerja}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Permohonan</div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_permohonan" value="{{$damenunggu->tarikh_permohonan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Status Permohonan</div>
                                    <div class="col-md-9">
                                    <select class="form-control" name="status_permohonan" required>
                                        <option disabled>--Pilih--</option>
                                        <option value="BARU" {{ $damenunggu->status_permohonan == 'BARU' ? 'selected' : '' }}>BARU</option>
                                        <option value="DALAM PROSES" {{ $damenunggu->status_permohonan == 'DALAM PROSES' ? 'selected' : '' }}>DALAM PROSES</option>
                                        <option value="LULUS" {{ $damenunggu->status_permohonan == 'Lulus' ? 'selected' : '' }}>LULUS</option>
                                        <option value="DITOLAK" {{ $damenunggu->status_permohonan == 'Ditolak' ? 'selected' : '' }}>DITOLAK</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Daerah</div>
                                    <div class="col-md-9">
                                        <select name="daerah" id="daerah" class="form-control">
                                            <option value="" {{ $damenunggu->daerah == null ? 'selected' : '' }}>--Pilih Daerah--</option>
                                            @foreach ($daerahList as $daerah)
                                                <option value="{{ $daerah }}" {{ $damenunggu->daerah == $daerah ? 'selected' : '' }}>{{ $daerah }}</option>
                                            @endforeach
                                        </select>
                                            
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kelayakan Perumahan</div>
                                    <div class="col-md-9">
                                    <select class="form-control" name="kelayakan_perumahan" required>
                                        <option value="">--Pilih--</option>
                                        <option value="LAYAK" {{ $damenunggu->kelayakan_perumahan == 'LAYAK' ? 'selected' : '' }}>LAYAK</option>
                                        <option value="TIDAK_LAYAK" {{ $damenunggu->kelayakan_perumahan == 'TIDAK_LAYAK' ? 'selected' : '' }}>TIDAK LAYAK</option>
                                        <option value="MENUNGGU" {{ $damenunggu->kelayakan_perumahan == 'MENUNGGU' ? 'selected' : '' }}>MENUNGGU</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Kelas</div>
                                    <div class="col-md-9">
                                     <input type="text" name="kelas" id="kelas" value="{{$damenunggu->kelas}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tarikh Diterima</div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_diterima" id="tarikh_diterima" value="{{$damenunggu->tarikh_diterima}}" placeholder="" class="form-control">
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
                                    <div class="col-md-3 label">Kad Pengenalan Pemohon Dan Atau Suami/Isteri</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="kad_pengenalan_sm" id="kad_pengenalan_sm">
                                        <span id="file-name-kad_pengenalan_sm" class="file-name-inside">
                                            @if(!empty($damenunggu->kad_pengenalan_sm))
                                                <a href="{{ asset('storage/' . $damenunggu->kad_pengenalan_sm) }}" target="_blank">
                                                    📄 {{ basename($damenunggu->kad_pengenalan_sm) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Sijil Nikah / Cerai / Meninggal (jika Berkenaan)</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="sijil_nikah_sm" id="sijil_nikah_sm">
                                        <span id="file-name-sijil_nikah_sm" class="file-name-inside">
                                            @if(!empty($damenunggu->sijil_nikah_sm))
                                                <a href="{{ asset('storage/' . $damenunggu->sijil_nikah_sm) }}" target="_blank">
                                                    📄 {{ basename($damenunggu->sijil_nikah_sm) }}
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
                                        <input class="form-control file-input" type="file" name="slip_gaji_sm" id="slip_gaji_sm">
                                        <span id="file-name-slip_gaji_sm" class="file-name-inside">
                                            @if(!empty($damenunggu->slip_gaji_sm))
                                                <a href="{{ asset('storage/' . $damenunggu->slip_gaji_sm) }}" target="_blank">
                                                    📄 {{ basename($damenunggu->slip_gaji_sm) }}
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
                                        <input class="form-control file-input" type="file" name="surat_lantikan_sm" id="surat_lantikan_sm">
                                        <span id="file-name-surat_lantikan_sm" class="file-name-inside">
                                            @if(!empty($damenunggu->surat_lantikan_sm))
                                                <a href="{{ asset('storage/' . $damenunggu->surat_lantikan_sm) }}" target="_blank">
                                                    📄 {{ basename($damenunggu->surat_lantikan_sm) }}
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
                                        <input class="form-control file-input" type="file" name="surat_penetapan_sm" id="surat_penetapan_sm">
                                        <span id="file-name-surat_penetapan_sm" class="file-name-inside">
                                            @if(!empty($damenunggu->surat_penetapan_sm))
                                                <a href="{{ asset('storage/' . $damenunggu->surat_penetapan_sm) }}" target="_blank">
                                                    📄 {{ basename($damenunggu->surat_penetapan_sm) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Surat Beranak, Kad Pengenalan anak dan atau surat kebenaran mengangkat</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="dokumen_anak_sm" id="dokumen_anak_sm">
                                        <span id="file-name-dokumen_anak_sm" class="file-name-inside">
                                            @if(!empty($damenunggu->dokumen_anak_sm))
                                                <a href="{{ asset('storage/' . $damenunggu->dokumen_anak_sm) }}" target="_blank">
                                                    📄 {{ basename($damenunggu->dokumen_anak_sm) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Pas Perkerja Pembantu Rumah (jika berkenaan)</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="pas_pembantu_rumah_sm" id="pas_pembantu_rumah_sm">
                                        <span id="file-name-pas_pembantu_rumah_sm" class="file-name-inside">
                                            @if(!empty($damenunggu->pas_pembantu_rumah_sm))
                                                <a href="{{ asset('storage/' . $damenunggu->pas_pembantu_rumah_sm) }}" target="_blank">
                                                    📄 {{ basename($damenunggu->pas_pembantu_rumah_sm) }}
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
                                        <input class="form-control file-input" type="file" name="surat_bantuan_sm" id="surat_bantuan_sm">
                                        <span id="file-name-surat_bantuan_sm" class="file-name-inside">
                                            @if(!empty($damenunggu->surat_bantuan_sm))
                                                <a href="{{ asset('storage/' . $damenunggu->surat_bantuan_sm) }}" target="_blank">
                                                    📄 {{ basename($damenunggu->surat_bantuan_sm) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                 <div class="row mb-3 align-items-start">
                                    <div class="col-md-3 label">Surat / Memorandum kebenaran mendiami Perumahan Kerajaan pemohon atau pasangan (jika ada)</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="surat_kebenaran_perumahan_sm" id="surat_kebenaran_perumahan_sm">
                                        <span id="file-name-surat_kebenaran_perumahan_sm" class="file-name-inside">
                                            @if(!empty($damenunggu->surat_kebenaran_perumahan_sm))
                                                <a href="{{ asset('storage/' . $damenunggu->surat_kebenaran_perumahan_sm) }}" target="_blank">
                                                    📄 {{ basename($damenunggu->surat_kebenaran_perumahan_sm) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Borang Pemohonan</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="borang_permohonan_sm" id="borang_permohonan_sm">
                                        <span id="file-name-pas_borang_permohonan_sm" class="file-name-inside">
                                            @if(!empty($damenunggu->borang_permohonan_sm))
                                                <a href="{{ asset('storage/' . $damenunggu->borang_permohonan_sm) }}" target="_blank">
                                                    📄 {{ basename($damenunggu->borang_permohonan_sm) }}
                                                </a>
                                            @else
                                                No file selected.
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Lain-lain Dokumen (jika ada)</div>
                                    <div class="col-lg-8 col-md-9 position-relative">
                                        <input class="form-control file-input" type="file" name="dokumen_lain_sm" id="dokumen_lain_sm">
                                        <span id="file-name-dokumen_lain_sm" class="file-name-inside">
                                            @if(!empty($damenunggu->dokumen_lain_sm))
                                                <a href="{{ asset('storage/' . $damenunggu->dokumen_lain_sm) }}" target="_blank">
                                                    📄 {{ basename($damenunggu->dokumen_lain_sm) }}
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
                            var form = document.getElementById('updatemenunggu');
                            
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