@extends('layouts.app-all')

@section('title', 'Borang Pengeluaran')

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


              <!-- Bahan bahan kurikulum -->

              <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                 <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #40826d;">BORANG PENGELUARAN BAHAN-BAHAN KURIKULUM <br>BAGI SEKOLAH-SEKOLAH KERAJAAN</h5>
                  <br>

                  <form class="" method="post" action="{{ route('cddinventory.cddinventory.updatebp') }}" enctype="multipart/form-data">
                   @csrf

      
           

           

                <table class="table table-bordered">
                 <tbody>

                    <tr>
                        <th colspan="3" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #355e3b;">Bahan - Bahan Kurikulum</th>
                    </tr>   
                 @foreach($inventory as $inventory)
                    
                    <input type="text" name="id" value="{{$inventory->id}}" class="bg-gray-200 form-control " hidden>
            

                 <div class="table-responsive">
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
                    @foreach($inventorybp as$inventorybp)

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

                 </div>

                

               


                    <table class="table table-bordered">
                      <br>
                        <tbody>
                        <tr>
                            <th scope="row">Sebab Dibekalkan: </th>
                            <td><textarea type="text"  class="form-control" readonly>{{$inventory->bp_catatan}}</textarea></td>
                    
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
                            <td><input type="text"  name="bp_recieve_nama" value="{{Auth::user()->name}}"  class="form-control"readonly></td>
                            <th scope="row">Nama</th>
                            <td><input type="text"  value="{{$inventory->bp_disahkan_nama}}" class="form-control" readonly></td>
                        </tr>
                      
                        <tr>
                
                            <th scope="row">No. Kad Pengenalan</th>
                            <td><input type="text" name="bp_recieve_icno" value="{{Auth::user()->ic_no}}" class="form-control" readonly></td>

                            <th scope="row">No. Kad Pengenalan</th>
                            <td><input type="text"  value="{{$inventory->bp_disahkan_icno}}"  class="form-control" disabled></td>
                           
                        </tr>


                        <tr>
                            <th scope="row">Jawatan</th>
                            <td><input type="text" name="bp_recieve_jawatan"   value="{{$inventory->bp_recieve_jawatan}}" class="form-control" ></td>
                            <th></th><td></td>
                        </tr>
                    
                        <tr>
                            <th scope="row">Tarikh</th>

                            @if ($inventory->bp_recieve_date == NULL)
                            <td><input type="date" name="bp_recieve_date"  value="{{ date('Y-m-d') }}"  class="bg-gray-200 form-control form-control-sm" style="width: 200px;" value="{{ date('d-m-y') }}" readonly></td>
                            @else
                            <td><input type="text" name="bp_recieve_date"  value="{{$inventory->bp_recieve_date}}"  class="bg-gray-200 form-control form-control-sm" style="width: 200px;" value="{{ date('d-m-y') }}" readonly></td>
                            @endif


                            <th></th>
                            <td></td>
                        </tr>

     
                        

                        @endforeach

                     
                        </tbody>

                      
                    </table>
                  
                    <a href="{{ route('cddinventory.cddinventory.addicnumber',$inventory->id) }}" class="btn btn-primary mb-2">Add IC Number</a>

      

            <br>
            <br>

                                        <div class="row mb-3">
        <div class="col-lg-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="responsibilityCheck" required>
            <label class="form-check-label" for="responsibilityCheck">
              <small><i>Adalah menjadi tanggungjawab setiap Sekolah, Maktab dan Pusat Tingkatan Enam untuk menggunakan bahan-bahan kurikulum dengan sebaiknya setelah dibekalkan oleh Jabatan Perkembangan Kurikulum. Bahan-bahan yang telah diserahkan dan diterima oleh pihak sekolah adalah menjadi hak milik pihak Sekolah, Maktab dan Pusat Tingkatan Enam seperti yang dinyatakan dalam Memorandum bilangan JPK/BBT/25 J22 (60).</i></small>
            </label>
          </div>
        </div>
      </div>

                <div class="text-center">
                     <button type="submit" class="btn btn-primary">Submit</button>
                </div>

       

            </form>

        </div>
    </div>
</div>

                </div>

</section>
@endsection