<!DOCTYPE html>
@php
    $b = $borang;
    $items = $b ? $b->items->keyBy('bil') : collect();
    // One entry per signature block: [heading, nama, jawatan, tarikh].
    $blok = fn ($tajuk, $prefix, $tarikh) => [$tajuk, $b?->{$prefix.'_nama'}, $b?->{$prefix.'_jawatan'}, $b?->{$tarikh}?->format('d/m/Y')];
    $keluar = [
        $blok($b?->status === 'ditolak' ? 'DITOLAK OLEH:' : 'DIBENARKAN OLEH:', 'dibenarkan', 'tarikh_dibenarkan'),
        $blok('DIKELUARKAN OLEH:', 'dikeluarkan', 'tarikh_dikeluarkan'),
        $blok('DITERIMA OLEH:', 'diterima', 'tarikh_diterima'),
    ];
    $pulang = [
        $blok('DIKEMBALIKAN OLEH:', 'dikembalikan', 'tarikh_dikembalikan'),
        $blok('DITERIMA OLEH:', 'diterima_stor', 'tarikh_diterima_stor'),
    ];
@endphp
<html lang="ms">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Borang Peminjaman KKK</title>
<style>
    @page { size: A4; margin: 14mm 16mm; }
    * { box-sizing: border-box; }
    body { margin: 0; background: #E9E8F1; font-family: Calibri, Carlito, 'Segoe UI', Arial, sans-serif; font-size: 13px; color: #000; }
    .sheet { width: 210mm; min-height: 297mm; margin: 20px auto; padding: 14mm 16mm; background: #fff; box-shadow: 0 4px 20px rgba(0,0,0,.15); }
    .toolbar { width: 210mm; margin: 20px auto 0; display: flex; justify-content: flex-end; gap: 8px; }
    .toolbar button, .toolbar a { font: 600 13px system-ui, sans-serif; padding: 9px 18px; border-radius: 8px; border: 0; cursor: pointer; text-decoration: none; }
    .toolbar .print { background: #2E2A7A; color: #fff; }
    .toolbar .back { background: #fff; color: #2E2A7A; border: 1px solid #D6D4E8; }

    .no { text-align: right; font-weight: 700; }
    .no input { width: 110px; }
    .head { display: flex; align-items: center; justify-content: center; gap: 10px; margin-top: 4px; }
    .head img { height: 48px; }
    .head .unit { font-size: 20px; font-weight: 700; line-height: 1.1; }
    .head .kem { font-size: 12px; font-weight: 700; text-align: center; }
    h1 { text-align: center; font-size: 18px; line-height: 1.35; margin: 18px 0 16px; }
    p { margin: 0 0 4px; }

    input[type=text], input[type=date] { border: 0; border-bottom: 1px dotted #000; font: inherit; padding: 1px 2px; background: transparent; }
    input.cell { width: 100%; border: 0; text-align: center; }
    .box { border: 1px solid #000; padding: 8px 40px; margin: 14px 4px; display: flex; align-items: center; justify-content: space-between; font-weight: 700; }
    .box label { display: inline-flex; align-items: center; gap: 8px; }
    .box input[type=checkbox] { width: 18px; height: 18px; margin: 0; accent-color: #000; }
    .box .lain { flex: 1; display: inline-flex; align-items: center; gap: 8px; margin-left: 20px; }
    .box .lain input[type=text] { flex: 1; font-weight: 400; }

    table { width: 100%; border-collapse: collapse; }
    .senarai th, .senarai td { border: 1px solid #000; height: 26px; padding: 0 6px; }
    .senarai th { background: #D9D9D9; height: 36px; }
    .senarai td:first-child { text-align: center; width: 8%; }
    .senarai td:nth-child(2) { width: 50%; }

    .mohon { display: flex; justify-content: space-between; align-items: flex-end; margin: 26px 0 18px; font-weight: 700; }
    .mohon .ttd { text-align: center; }
    .mohon .ttd .line { width: 240px; border-bottom: 1px dotted #000; height: 22px; margin-bottom: 4px; }

    .pentadbiran th, .pentadbiran td { border: 1px solid #000; vertical-align: top; }
    .pentadbiran th { background: #D9D9D9; font-size: 12px; padding: 2px 6px; }
    .pentadbiran td { width: 33.33%; padding: 4px 8px 10px; }
    .sig .role { font-weight: 700; }
    .sig .line { border-bottom: 1px dotted #000; height: 30px; margin: 4px 0 2px; }
    .sig .ttd { text-align: center; font-weight: 700; margin-bottom: 18px; }
    .sig .row { display: flex; gap: 4px; font-weight: 700; margin-top: 2px; }
    .sig .row input { flex: 1; border-bottom: 0; }
    .pentadbiran + .pentadbiran { margin-top: 26px; }
    .catatan textarea { width: 100%; height: 150px; border: 0; resize: none; font: inherit; }

    @media print {
        body { background: #fff; }
        .toolbar { display: none; }
        .sheet { margin: 0; padding: 0; width: auto; min-height: 0; box-shadow: none; }
        input[type=date]::-webkit-calendar-picker-indicator { display: none; }
    }
</style>
</head>
<body>
<div class="toolbar">
    <a class="back" href="{{ route('kkk.rekod', $b ? ['tahun' => $b->tarikh_permohonan->year, 'pilih' => $b->id] : []) }}">Kembali</a>
    <button type="button" class="print" onclick="window.print()">Cetak / Simpan PDF</button>
</div>

<div class="sheet">
    <div class="no">NO: <input type="text" value="{{ $b?->no_borang }}" style="width:150px"></div>

    <div class="head">
        <img src="{{ asset('assets/img/brunei-emblem.png') }}" alt="">
        <div>
            <div class="unit">Unit Audit Dalaman</div>
            <div class="kem">Kementerian Pendidikan</div>
        </div>
    </div>

    <h1>BORANG PERMOHONAN PEMINJAMAN DOKUMEN KUNCI KIRA-KIRA<br>KEWANGAN SEKOLAH (FRRV)</h1>

    <p>Yang Mulia:</p>
    <p>Ketua Unit Audit Dalaman atau Ketua Sub Unit Pentadbiran dan Perkhidmatan Korporat.</p>
    <p style="margin-top:14px">Sukacita dipohonkan dokumen Kunci Kira-Kira Kewangan Sekolah seperti keterangan berikut:</p>

    <div class="box">
        <span>Jenis KKK:</span>
        @foreach (['Yuran', 'Kantin', 'Rampaian'] as $jenis)
            <label><input type="checkbox" {{ $b && in_array($jenis, $b->jenis, true) ? 'checked' : '' }}> {{ $jenis }}</label>
        @endforeach
    </div>

    <table class="senarai">
        <thead>
            <tr><th>Bil</th><th>Nama Sekolah</th><th>Tempoh dan Tahun KKK</th></tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= 5; $i++)
                <tr>
                    @php $item = $items->get($i); @endphp
                    <td><input type="text" class="cell" value="{{ $item ? $i : '' }}"></td>
                    <td><input type="text" class="cell" style="text-align:left" value="{{ $item?->sekolah?->nama }}"></td>
                    <td><input type="text" class="cell" value="{{ $item?->tempoh() }}"></td>
                </tr>
            @endfor
        </tbody>
    </table>

    <div class="box">
        <span>Tujuan KKK:</span>
        <label><input type="checkbox" {{ $b?->tujuan === 'semakan' ? 'checked' : '' }}> Semakan</label>
        <label><input type="checkbox" {{ $b?->tujuan === 'pengauditan' ? 'checked' : '' }}> Pengauditan</label>
        <span class="lain"><input type="checkbox" {{ $b?->tujuan === 'lain' ? 'checked' : '' }}> Sila nyatakan: <input type="text" value="{{ $b?->tujuan_lain }}"></span>
    </div>

    <div class="mohon">
        <div>Tarikh Permohonan : <input type="date" value="{{ ($b?->tarikh_permohonan ?? now())->toDateString() }}"></div>
        <div class="ttd"><div class="line"></div>Tandatangan Pemohon</div>
    </div>

    <table class="pentadbiran">
        <thead>
            <tr>
                <th colspan="2">UNTUK DIISI OLEH PIHAK PENTADBIRAN:</th>
                <th rowspan="2">DOKUMEN YANG DIKELUARKAN DI ATAS TELAH DITERIMA DENGAN SEMPURNA OLEH PEMOHON</th>
            </tr>
            <tr>
                <th>KETUA SUB UNIT PENTADBIRAN DAN PERKHIDMATAN KORPORAT</th>
                <th>PENGAWAS BILIK DAN STOR KKK</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($keluar as [$peranan, $nama, $jawatan, $tarikh])
                    <td class="sig">
                        <div class="role">{{ $peranan }}</div>
                        <div class="line"></div>
                        <div class="ttd">Tandatangan</div>
                        <div class="row">Nama: <input type="text" value="{{ $nama }}"></div>
                        <div class="row">Jawatan: <input type="text" value="{{ $jawatan }}"></div>
                        <div class="row">Tarikh: <input type="text" value="{{ $tarikh }}"></div>
                    </td>
                @endforeach
            </tr>
        </tbody>
    </table>

    <table class="pentadbiran">
        <thead>
            <tr>
                <th colspan="2">TARIKH PENGESAHAN PEMULANGAN DOKUMEN KUNCI KIRA-KIRA</th>
                <th>SEMAKAN ATAU CATATAN</th>
            </tr>
            <tr>
                <th>DIISIKAN OLEH PEMOHON</th>
                <th>PENGAWAS BILIK DAN STOR KKK</th>
                <th>PENGAWAS BILIK DAN STOR KKK</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($pulang as [$peranan, $nama, $jawatan, $tarikh])
                    <td class="sig">
                        <div class="role">{{ $peranan }}</div>
                        <div class="line"></div>
                        <div class="ttd">Tandatangan</div>
                        <div class="row">Nama: <input type="text" value="{{ $nama }}"></div>
                        <div class="row">Jawatan: <input type="text" value="{{ $jawatan }}"></div>
                        <div class="row">Tarikh: <input type="text" value="{{ $tarikh }}"></div>
                    </td>
                @endforeach
                <td class="catatan"><textarea>{{ $b?->status === 'ditolak' ? 'Ditolak: '.$b->sebab_ditolak : $b?->catatan_semakan }}</textarea></td>
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>
