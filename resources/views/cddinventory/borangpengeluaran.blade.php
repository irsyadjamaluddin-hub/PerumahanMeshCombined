@extends('layouts.app-all')

@section('title', 'Borang Pengeluaran')

@section('content')


@if(session('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<?php
$pagename = "Cddinventory";
?>

<section class="section profile">

  <a href="{{ route('cddinventory.cddinventory.indexadmin') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">

      <div class="card-body">

         

            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">RUJUKAN KETERANGAN BAHAN-BAHAN KURIKULUM <br>BAGI SEKOLAH-SEKOLAH KERAJAAN</h5>
              <br>
              
              <div style="display: flex; align-items: center; float: right; margin-top: 10px;">
                  <label style="margin-right: 10px;">Tarikh:</label>
                  <input type="text" name="date" class="bg-gray-200 form-control form-control-sm" style="width: 200px;" value="{{ date('d-m-y') }}" readonly>
                
              </div>

              <script>
                const currentDateElement = document.getElementById('currentDate');
                const currentDate = new Date();
                
                const year = currentDate.getFullYear();
                const month = currentDate.getMonth() + 1; // Months are 0-based
                const day = currentDate.getDate();
                
                const formattedDate = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                currentDateElement.textContent = formattedDate;
              </script>

            <br>
            <br>

            <!-- Maklumat Sekolah -->

              <table class="table table-bordered">
                <tbody>

                <tr>
                    <th colspan="2" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Maklumat Sekolah</th>
      
              </tr>

              @foreach($inventory as $inventory)

                <tr>

                    <th scope="row">Jabatan/Sekolah/Maktab</th>
                    @if($inventory->nama_sch == null)

                    <td><input type="text" value="{{ optional($inventory->Department)->label }}" class="form-control" readonly></td>

                    @else


                    <td><input type="text" value ="{{$inventory->nama_sch}}" class="form-control" readonly></td>

                    @endif


                <tr>
                    <th scope="row">Kluster/Unit</th>
                    @if($inventory->nama_sch == null)
                    <td><input type="text" value="{{$inventory->unit}}" class="form-control" readonly></td>
                    @else
                    <td><input type="text" value ="{{$inventory->kluster}}" class="form-control" readonly></td>
                    @endif


                </tr>
          

                </tbody>
              </table>
              <!-- Maklumat Sekolah -->

               <!-- Display maklumat bahan -->
           
        
              <input type="text" name="id" class="bg-gray-200 form-control " hidden>

                <table class="table-achiev" id="displayinfo">

               

                  <thead>
                    

                  <tr>
                    <th colspan="12" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Bahan - Bahan Kurikulum</th>
                  </tr> 

                    <tr>
                      <th class="text-center">Mata Pelajaran</th>
                      <th class="text-center">Judul Bahan</th>
                      <th class="text-center">ISBN No.</th>
                      <th class="text-center">Pengarang/Penerbit</th>
                      <th class="text-center">Kuantiti Dipohonkan</th>
                      <th class="text-center">Sebab Permohonan</th>
                      <th class="text-center">Kuantiti Pengeluaran</th>
                      <th class="text-center">Kuantiti Sebutharga</th>
                      <th class="text-center">Catatan</th>
                      <th class="text-center">Status</th>


                      <th></th>
                    </tr>
                  </thead>


                  <tbody>
                  @if(count( $inventorybbk) == 0)
                      <tr class="text-center">
                        <td colspan="10">
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
                        </td>

                        {{-- Kuantiti Pengeluaran Column --}}
                        <td>
                            @if($inventorybbk->cdd_status == 'Borang Pengeluaran & Sebutharga')
                                {{ $inventorybbk->kqty_pengeluaran ?? '-' }}
                            @elseif($inventorybbk->cdd_status == 'Borang Pengeluaran')
                                {{ $inventorybbk->cdd_qty_diluluskan ?? '-' }}
                            @else
                                -
                            @endif
                        </td>
                        
                        {{-- Kuantiti Sebutharga Column --}}
                        <td>
                            @if($inventorybbk->cdd_status == 'Borang Pengeluaran & Sebutharga')
                                {{ $inventorybbk->kqty_sebutharga ?? '-' }}
                            @elseif($inventorybbk->cdd_status == 'Sebutharga')
                                {{ $inventorybbk->cdd_qty_diluluskan ?? '-' }}
                            @else
                                -
                            @endif
                        </td>
                        
                        <td>
                          <!-- Basic Modal -->
                            <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#CatatanModal{{ $inventorybbk->id }}">
                          </button>
                         <div class="modal fade" id="CatatanModal{{ $inventorybbk->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Catatan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{ $inventorybbk->cdd_catatan }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        </td>
                        

                        <td>{{$inventorybbk->cdd_status}}</td>

                      </tr>

                      @endforeach
                      @endif


                    </tbody>
                  </table>

                  <!-- Display Maklumat Kurikulum -->

</div>

<br>

              
        
    
              <!-- Bahan bahan kurikulum -->

              <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                 <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #40826d;">BORANG PENGELUARAN BAHAN-BAHAN KURIKULUM <br>BAGI SEKOLAH-SEKOLAH KERAJAAN</h5>
                  <br>

                  <form class="" method="post" action="{{ route('cddinventory.cddinventory.storebp') }}" enctype="multipart/form-data">
                   @csrf

              

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-success mt-2 mb-2 btn-sm" id="addbtn2" href="#">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>

           

                <table class="table table-bordered">
                 <tbody>

                    <tr>
                        <th colspan="3" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #355e3b;">Bahan - Bahan Kurikulum</th>
                    </tr>   
                    
                    <input type="text" name="id" value="{{$inventory->id}}" class="bg-gray-200 form-control " hidden>
            


                  <table class="table-achiev" id="tableprestasi1">

                    <thead>
                    <tr>
                        <th class="text-center" style="background-color:#40826d ; color: white;">Bil.</th>
                        <th class="text-center" style="background-color:#40826d ; color: white;">Judul Bahan</th>
                        <th class="text-center" style="background-color:#40826d ; color: white;">ISBN No.</th>
                        <th class="text-center" style="background-color:#40826d ; color: white;">Kuantiti</th>
                        <th class="text-center" style="background-color:#40826d ; color: white;">Harga @</th>

                        <th style="background-color:#40826d ; color: white;"></th>
                    </tr>
                    </thead>

                    <tbody>
                  @if(count( $inventorybp) == 0)
                      <tr class="text-center">
                        <td colspan="8">
                          <h5>No records found</h5>
                        </td>
                      </tr>

                    @else

                    @php
                        $counter = 1; // Initialize counter variable
                    @endphp
                    @foreach($inventorybp as $inventorybp)

                    <tr class="text-center">
                    <td>{{ $counter++ }}</td> <!-- Increment the counter and display it -->

                        <td>{{$inventorybp->bp_judulbahan}}</td>
                        <td>{{$inventorybp->bp_isbn}}</td>
                        <td>{{$inventorybp->bp_qty}}</td>
                        <td>{{$inventorybp->bp_harga}}</td>

                      </tr>

                      @endforeach
                      @endif


                    </tbody>
                 </table>

                 

               

                    <table class="table table-bordered">
                      <br>
                        <tbody>
                        <tr>
                            <th scope="row">Sebab Dibekalkan: </th>
                            <td><textarea type="text" name ="bp_catatan" class="form-control">{{$inventory->bp_catatan}}</textarea></td>
                    
                          </tr>
                       
                        
                        </tbody>
                    </table>

                    

                    <!-- Bahan-bahan Kurikulum -->
                                  
                    <br>
                    <br>           
                    
                    <!-- Maklumat Penerima dan Disahkan Oleh -->
                    <table class="table table-bordered">
                      <tbody>

                        <tr>
                            <th colspan="2" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #355e3b;">Diterima Oleh</th>
                            <th colspan="3" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #355e3b;">Disahkan Oleh</th>
                        </tr>
                
                        <tr>
                            <th scope="row">Nama</th>
                            <td><input type="text"   value= "{{$inventory->bp_recieve_nama}}"  class="form-control"readonly></td>
                            <th scope="row">Nama</th>
                            <td>   <input type="text"
                                name="bp_disahkan_nama"
                                value="{{ $inventory->bp_disahkan_nama ?? Auth::user()->name }}"
                                class="form-control"
                                {{ $inventory->bp_disahkan_nama ? 'readonly' : '' }}></td>
                                             

                      
                        <tr>
                   

                            <th scope="row">No. Kad Pengenalan1</th>
                            <td><input type="text" value="{{$inventory->bp_recieve_icno}}" class="form-control" readonly></td>

                            <th scope="row">No. Kad Pengenalan2</th>
                            <td><input type="text"
           name="bp_disahkan_icno"
           value="{{ $inventory->bp_disahkan_icno ?? Auth::user()->ic_no }}"
           class="form-control"
           {{ $inventory->bp_disahkan_icno ? 'readonly' : '' }}></td>
                           
                           
                        </tr>

                      

                        <tr>
                            <th scope="row">Jawatan</th>
                            <td><input type="text"  value="{{$inventory->bp_recieve_jawatan}}" class="form-control" readonly></td>
                            <th></th><td></td>
                        </tr>
                    
                        <tr>
                            <th scope="row">Tarikh</th>
                            <td><input type="text" value="{{$inventory->bp_recieve_date}}"  class="bg-gray-200 form-control form-control-sm" style="width: 200px;" value="{{ date('d-m-y') }}" readonly></td>
                            <th></th>
                            <td></td>
                        </tr>

                     
                        </tbody>
                      
                    </table>

                <script type="text/javascript">
                    $(document).ready(function() {
                      var bilNumber = 1; // Initialize a variable for sequential numbers
                    $('#addbtn2').off().on('click', function() {

                        var html = '';
                        html += '<tr>';

                        html += '<td>' + bilNumber + '</td>';
                         bilNumber++; // Increment the sequential number

                        html += '<td><input  type="text" placeholder="Judul Bahan"  class="form-control @error('
                        bp_judulbahan ') is-invalid @enderror" name="bp_judulbahan[]" value="{{ old('
                        bp_judulbahan ') }}"  autofocus></td>';

                        
                        html += '<td><input  type="text"   placeholder="Nombor ISBN"  class="form-control @error('
                        bp_isbn ') is-invalid @enderror" name="bp_isbn[]" value="{{ old('
                         ') }}"  autofocus></td>';

                        html += '<td><input  type="text"  placeholder="Kuantiti"  class="form-control @error('
                        bp_qty ') is-invalid @enderror" name="bp_qty[]" value="{{ old('
                        bp_qty ') }}"  autofocus></td>';

                        
                        html += '<td><input  type="text"  placeholder="Harga"  class="form-control @error('
                        bp_harga ') is-invalid @enderror" name="bp_harga[]" value="{{ old('
                        bp_harga ') }}"  autofocus></td>';

                        html += '<td> <button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                        html += '</tr>';
                        $('#tableprestasi1').append(html);
                    })

                    });

                    $(document).on('click', '.removeDeclare', function() {
                    $(this).parents('tr').remove();
                    });
                </script>

            <br>
            <br>

                <div class="text-center">
                     <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                @endforeach

            </form>

        </div>
    </div>
</div>

                </div>

</section>
@endsection