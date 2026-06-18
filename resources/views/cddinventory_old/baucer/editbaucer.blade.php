@extends('layouts.app-all')

@section('title', 'Edit baucher')

@section('content')

<?php
$pagename = "Cddinventory";
?>

<section class="section profile">

  <a href="{{ route('cddinventory.cddinventory.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">
      <div class="card-body">

        <form method="post" action="{{ route('cddinventory.updatebaucer', $baucers->first()->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">BAUCER PENERIMAAN BARANG <br>(STORE RECEIVE VOUCHER)</h5>
              
            <div style="display: flex; align-items: center; float: right; margin-top: 10px;">
                <label style="margin-right: 10px;">Rujukan SRV:</label>
                <input type="text" name="rujukan_srv" value="{{$baucers->first()->rujukan_srv}}" class="bg-gray-200 form-control form-control-sm" style="width: 200px;" required> 
            </div>
            <br><br><br>

            <input type="text" name="id" class="bg-gray-200 form-control " hidden>
            <table class="table-achiev">
              <thead>
                <tr>
                  <th class="text-center padding" rowspan="2" style="border: 1px solid white;">Nama Syarikat Pembekal</th>
                  <th class="text-center padding" rowspan="2" style="border: 1px solid white;">Jenis Barang </th>
                  <th class="text-center padding" colspan="2" style="border: 1px solid white;">Purchase Order</th>
                  <th class="text-center padding" colspan="2" style="border: 1px solid white;">Delivery Order</th>
                  <th class="text-center padding" rowspan="2" style="border: 1px solid white;">Lokasi Penerimaan/Penghantaran</th>
                </tr>
                <tr>
                  <th class="text-center padding" style="border: 1px solid white;">No.Rujukan</th>
                  <th class="text-center padding" style="border: 1px solid white;">Tarikh</th>
                  <th class="text-center padding" style="border: 1px solid white;">No.Rujukan</th>
                  <th class="text-center padding" style="border: 1px solid white;">Tarikh</th>
                </tr>
              </thead>

              <tbody>
                <tr class="text-center">
                  <td><input type="text" class="form-control" name="nama_syarikat_pembekal" value="{{$baucers->first()->nama_syarikat_pembekal}}" autofocus required></td>
              
                  <td><input type="text" class="form-control" name="jenis_barang" value="{{$baucers->first()->jenis_barang}}" autofocus required></td>
              
                  <td><input type="text" class="form-control" name="po_norujukan" value="{{$baucers->first()->po_norujukan}}" autofocus required></td>
              
                  <td><input type="date" class="form-control" name="po_tarikh" value="{{$baucers->first()->po_tarikh}}" autofocus required></td>

                  <td><input type="text" class="form-control" name="do_norujukan" value="{{$baucers->first()->do_norujukan}}" autofocus required></td>

                  <td><input type="date" class="form-control" name="do_tarikh" value="{{$baucers->first()->do_tarikh}}" autofocus required></td>
              
                  <td><textarea type="text" class="form-control" name="lokasi_penerimaan" required>{{$baucers->first()->lokasi_penerimaan}}</textarea></td>
                </tr>                    
              </tbody>
            </table>         
            <br>

              <table class="table-achiev" id="tablebaucer2">
                <thead>
                  <tr>
                    <th class="text-center padding2" rowspan="2" style="border: 1px solid white;">Bil.</th>
                    <th class="text-center padding2" rowspan="2" style="border: 1px solid white;">Jadual Buku</th>
                    <th class="text-center padding2" rowspan="2" style="border: 1px solid white;">ISBN</th>
                    <th class="text-center padding2" rowspan="2" style="border: 1px solid white;">Unit</th>
                    <th class="text-center padding2" colspan="2" style="border: 1px solid white;">Kuantiti</th>
                    <th class="text-center padding2" colspan="2" style="border: 1px solid white;">Harga (BND)</th>
                    <th class="text-center padding2" rowspan="2" style="border: 1px solid white;">Catatan</th>
                    <th class="text-center padding2" rowspan="2" style="border: 1px solid white;"></th>
                  </tr>
                  <tr>
                    <th class="text-center padding2" style="border: 1px solid white;">DO</th>
                    <th class="text-center padding2" style="border: 1px solid white;">Diterima</th>
                    <th class="text-center padding2" style="border: 1px solid white;">Kos Seunit</th>
                    <th class="text-center padding2" style="border: 1px solid white;">Jumlah</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($baucersbuku as $baucerbuku)
                    <tr class="text-center">
                      <td><input type="text" class="form-control" name="bil[]" value="{{$baucerbuku->bil}}" autofocus required></td>
                  
                      <td><input type="text" class="form-control" name="jadual_buku[]" value="{{$baucerbuku->jadual_buku}}" autofocus required></td>
                  
                      <td><input type="text" class="form-control" name="isbn[]" value="{{$baucerbuku->isbn}}" autofocus required></td>
                  
                      <td><input type="text" class="form-control" name="unit[]" value="{{$baucerbuku->unit}}" autofocus required></td>

                      <td><input type="text" class="form-control" name="kuantiti_do[]" value="{{$baucerbuku->kuantiti_do}}" autofocus required></td>

                      <td><input type="text" class="form-control" name="kuantiti_diterima[]" value="{{$baucerbuku->kuantiti_diterima}}" autofocus required></td>

                      <td><input type="text" class="form-control" name="harga_kos_seunit[]" value="{{$baucerbuku->harga_kos_seunit}}" autofocus required></td>

                      <td><input type="text" class="form-control" name="harga_jumlah[]" value="{{$baucerbuku->harga_jumlah}}" autofocus required></td>
                  
                      <td><textarea type="text" class="form-control" name="catatan[]" value="{{$baucerbuku->catatan}}" required>{{$baucerbuku->catatan}}</textarea></td>
                    </tr> 
                  @endforeach                   
                </tbody>
              </table>         
              <br>

              <div class="float-container">
                <div class="float-child">
                  <div class="green">
                    <b>Penghantaran Dari:</b>
                    <br><br><br><br><br>
                    <hr style="width:80%; margin:0; border-width:0; background-color:#000000; color:#000000;">
                    <b>(Tandatangan)</b>
                    <br><br>
                    <b>Nama:</b>
                    <br><br>
                    <b>Kad Pintar:</b>
                    <br><br>
                    <br><br>
                    <b>Tarikh:</b>
                  </div>
                </div>
                
                <div class="float-child">
                  <div class="blue">
                    <b>Diterima Oleh:</b>
                    <br><br><br><br><br>
                    <hr style="width:80%; margin:0; border-width:0; background-color:#000000; color:#000000;">
                    <b>(Tandatangan Pegawai/Kakitangan)</b>
                    <br><br>
                    <b>Nama:</b>
                    <br><br>
                    <b>Jawatan:</b>
                    <br><br>
                    <b>Kad Pintar:</b>
                    <br><br>
                    <b>Tarikh:</b>
                  </div>
                </div>

                <div class="float-child" style="border-right: 1px solid rgb(56, 56, 56);">
                  <div class="blue">
                    <b>Disahkan Oleh:</b>
                    <br><br><br><br><br>
                    <hr style="width:80%; margin:0; border-width:0; background-color:#000000; color:#000000;">
                    <b>(Tandatangan Pegawai/Kakitangan)</b>
                    <br><br>
                    <b>Nama:</b>
                    <br><br>
                    <b>Jawatan:</b>
                    <br><br>
                    <b>Kad Pintar:</b>
                    <br><br>
                    <b>Tarikh:</b>
                  </div>
                </div>
              </div>

              <br>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>

      </div>
    </div>
  </div>
</section>
 

<style>
  .padding{
    padding-top: 5px !important;
    padding-bottom: 5px !important;
    width: 16.5% !important;
  }

  .padding2{
    padding-top: 5px !important;
    padding-bottom: 5px !important;
    width: 11% !important;
  }

  .float-container {
    border: 1px solid #fff;
    padding-bottom: 20rem;
    font-size: 14px; 
  }

  .float-child {
      width: 33.333%;
      float: left;
      padding: 0px 20px 20px 4px;
      border-top: 1px solid rgb(56, 56, 56);
      border-bottom: 1px solid rgb(56, 56, 56);
      border-left: 1px solid rgb(56, 56, 56);
  }  
</style>
@endsection

