@extends('layouts.app-all')

@section('title', 'Edit Admin Inventory')

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

      <form class="" method="post" action="{{ route('cddinventory.cddinventory.updateadmin') }}" enctype="multipart/form-data">
            @csrf

            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">BORANG PERMOHONAN BAHAN-BAHAN KURIKULUM <br>BAGI SEKOLAH-SEKOLAH KERAJAAN</h5>
              <br>

              @foreach ($inventory as $inventory)
              
          

              <div style="display: flex; align-items: center; float: right; margin-top: 10px;">
                  <label style="margin-right: 10px;">Date:</label>
                  <input type="text" class="bg-gray-200 form-control form-control-sm" style="width: 200px;" value="{{ $inventory->created_at }}" readonly>
                
              </div>

            <br>
            <br>

              <table class="table table-bordered">
                <tbody>

                <tr>
                    <th colspan="2" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Maklumat Sekolah</th>
                    <th colspan="3" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Maklumat Pemohon</th>
                </tr>

                

                <tr>

                    <th scope="row">Nama Sekolah</th>
                    <td><input type="text" value ="{{$inventory->nama_sch}}" class="form-control" readonly></td>


                    <th scope="row">No. Kad Pengenalan Pemohon</th>
                    <td><input type="text" value="{{$inventory->ic_no}}" class="form-control" readonly></td>
                </tr>

                <tr>
                    <th scope="row">Kluster</th>
                    <td><input type="text" value="{{$inventory->kluster}}" class="form-control" readonly></td>

                    <th scope="row">Nama Pemohon</th>
                    <td><input type="text" value="{{$inventory->nama}}" class="form-control" readonly></td>

                </tr>

                <tr>
                    <th scope="row">No Tel Sekolah</th>
                    <td><input type="text" value="{{$inventory->no_tel}}" class="form-control" readonly></td>

                    <th scope="row">Emel Pemohon</th>
                    <td><input type="text" value="{{$inventory->emel}}" class="form-control" readonly></td>

                </tr>
        
                <tr>
                 <th colspan="4" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Keterangan Guru Besar/Pengetua</th>
                </tr>

                <tr>
                    <th scope="row">Nama Guru Besar/Pengetua</th>
                    <td><input type="text" value="{{$inventory->kgp_nama}}" class="form-control" readonly></td>


                    <th scope="row">No. Kad Pengenalan</th>
                    <td><input type="text" value="{{$inventory->kgp_ic_no}}" class="form-control" readonly></td>

                 
                </tr>

                <tr>
  
                    <th scope="row">Emel Guru Besar/Pengetua</th>
                    <td><input type="text" value="{{$inventory->kgp_emel}}" class="form-control" readonly></td>


                    <th></th><td></td>
                </tr>

                <tr></tr>

                <!-- Start bahan bahan kurikulum -->
           
                <tr>
                 <th colspan="4" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Bahan - Bahan Kurikulum</th>
                </tr>   

               </tbody>
              </table>



              <input type="text" name="id" class="bg-gray-200 form-control " hidden>

                <table class="table-achiev" id="tableprestasi1">

                  <thead>
                    <tr>
                      <th class="text-center">Mata Pelajaran</th>
                      <th class="text-center">Judul Bahan</th>
                      <th class="text-center">ISBN No.</th>
                      <th class="text-center">Pengarang/Penerbit</th>
                      <!-- <th class="text-center">Purata Pelajar Bagi Tahun Dipohonkan </th>
                      <th class="text-center">Kuantiti Bahan dapat Digunakan</th> -->
                      <th class="text-center">Kuantiti Dipohonkan</th>
                      <th class="text-center">Sebab Permohonan</th>
                      <th class="text-center" style="background-color:#018749; color: white;" > Status Permohonan</th>

                      <th class="text-center">Action</th>


                      <th></th>
                    </tr>
                  </thead>


                  <tbody>
                  @if(count( $inventorybbk) == 0)
                      <tr class="text-center">
                        <td colspan="8">
                          <h5>No records found</h5>
                        </td>
                      </tr>

                    @else
                    @foreach( $inventorybbk as $inventorybbk)

                    <tr class="text-center">

                        <td>{{$inventorybbk->matapelajaran}}</td>
                        <td>{{$inventorybbk->judulbahan}}</td>
                        <td>{{$inventorybbk->isbn}}</td>
                        <td>{{$inventorybbk->pengarang_penerbit}}</td>
                       
                        <td>{{$inventorybbk->qty_dipohonkan}}</td>
                        

                        <td>
                          <!-- Basic Modal -->
                          <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#SebabPermohonanModal{{ $inventorybbk->id }}">
                          </button>
                      <!-- Modal -->
                        <div class="modal fade" id="SebabPermohonanModal{{ $inventorybbk->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Sebab Permohonan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{ $inventorybbk->sebab_permohonan }}
                                    </div>
                                </div>
                            </div>
                        </div>
                                  
                          <!-- End Basic Modal-->
                        </td>

                        <td>{{$inventorybbk->cdd_status}}</td>

                             
                        <!----Edit Button----->
                        <td><a href="{{ route('cddinventory.cddinventory.editcddinfoadmin', $inventorybbk->id ) }}" class="btn btn-primary text-right "><i class="bi bi-pencil-fill"></i></a></td>


                       
                   

                      </tr>

                      @endforeach
                      @endif


                    </tbody>
                  </table>

                  <script type="text/javascript">
                    $(document).ready(function() {
                      $('#addbtn2').off().on('click', function() {

                        var html = '';
                        html += '<tr>';

                        html += '<td><input id="daripada" type="text"    class="form-control @error('
                        dariapda ') is-invalid @enderror" name="matapelajaran[]" value="{{ old('
                        daripada ') }}"  autofocus></td>';

                        html += '<td><input id="daripada" type="text"    class="form-control @error('
                        dariapda ') is-invalid @enderror" name="judulbahan[]" value="{{ old('
                        daripada ') }}"  autofocus></td>';

                        
                        html += '<td><input id="daripada" type="text"  placeholder=""  class="form-control @error('
                        dariapda ') is-invalid @enderror" name="isbn_no[]" value="{{ old('
                        daripada ') }}"  autofocus></td>';

                        html += '<td><input id="daripada" type="text"  placeholder=""  class="form-control @error('
                        dariapda ') is-invalid @enderror" name="pengarang[]" value="{{ old('
                        daripada ') }}"  autofocus></td>';

                        
                       
                        
                        html += '<td><input id="daripada" type="text"  placeholder=""  class="form-control @error('
                        dariapda ') is-invalid @enderror" name="qty_dipohonkan[]" value="{{ old('
                        daripada ') }}"  autofocus></td>';

                        html += '<td><textarea id="daripada" type="text"  placeholder=""  class="form-control @error('
                        dariapda ') is-invalid @enderror" name="sebab_permohonan[]" value="{{ old('
                        daripada ') }}" ></textarea></td>';

                        html += '<td> <button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                        html += '</tr>';
                        $('#tableprestasi1').append(html);
                      })

                    });

                    // $(document).on('click', '#remove', function() {
                    //     $(this).closest('tr').remove();
                    // });

                    $(document).on('click', '.removeDeclare', function() {
                      $(this).parents('tr').remove();
                    });
                  </script>
              
<br>


 



<br>
<br>
            
@endforeach
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

          </form>
  </div>
  </div>
  </div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    if (sessionStorage.getItem('refreshOnBack') === 'true') {
      sessionStorage.removeItem('refreshOnBack');
      location.reload();
    }
  });
</script>

</section>
@endsection