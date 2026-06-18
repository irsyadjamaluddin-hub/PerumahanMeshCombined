
        <?php
        $pagename = "Inventory";
        ?>

        

        <a href="{{ route('cddinventory.cddinventory.indexsebutharga') }}" class="btn btn-primary mb-2">
            <i class="bi bi-arrow-left-circle"></i>
        </a>

        <div class="col-12">
            <div class="card pt-3">

            <div class="card-body">

        


                <form class="" method="post" action="{{ route('cddinventory.cddinventory.updatesebutharga') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #655D72;">SENARAI AGIHAN DAN PENGESAHAN PENERIMAAN BAHAN<br>BAGI SEKOLAH-SEKOLAH KERAJAAN, KEMENTERIAN PENDIDIKAN</h5>
                    <br>
                    
                    
                    @foreach($inventorysebutharga as $inventorysebutharga) 

                    <div style="display: flex; align-items: center; float: right; margin-top: 5px;">
                        <label style="margin-right: 10px;">Tarikh: {{ date('d/m/Y', strtotime($inventorysebutharga->created_at)) }}</label>
                    </div>
                    <br>
                    <br>
                    <br>



                   <div style="display: flex; align-items: center; float: right; margin-top: 10px;">
                        @php
                            $url = route('inventorypenerimaanbuku', ['id' => $inventorysebutharga->id]);
                            $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate($url);
                        @endphp

                        <a href="{{ $url }}">
                            <img src="data:image/png;base64, {{ base64_encode($qrCode) }}" alt="QR Code">
                        </a>
                    </div> 

                 

                    <br>
                    <br>

                    <style>
                        .table th {
                            text-align: left;
                        }

                        

                        .container {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }

                        .center-table {
                            margin: 0 auto;
                        }
                 </style>


                    <table class="table table-bordered">
                     <tbody>

                   
                        <tr>
                            <th scope="row">Bil ID:</th>
                            <td><input class="form-control">SH{{$inventorysebutharga->id}}</td>

                            <th scope="row"></th>
                            <td>
                                <!-- <div class="text-right"> 
                                    <input class="form-control">
                                    <a href="{{ $url }}">
                                        <img src="data:image/png;base64, {{ base64_encode($qrCode) }}" alt="QR Code">
                                    </a>
                                </div> -->
                            </td>

                        <tr>
                            <th scope="row">Bil. Purchase Order:</th>
                            <td><input   class="form-control"> {{$inventorysebutharga->bil_po}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Pembekal:</th>
                            <td><input class="form-control">{{$inventorysebutharga->pembekal}}</td>
                           

                        </tr>

                        <tr>
                            <th scope="row">e-mel</th>
                            <td><input class="form-control">{{$inventorysebutharga->emel_pembekal}}</td>
                           

                        </tr>
                        

                        </tbody>
                    </table>

      
                    @endforeach


                
                    
    <!-- Start bahan bahan kurikulum -->
    
    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #898196;">BUKU-BUKU</h5>
    <div class="container">
    <table class="table table-achiev mx-auto left-table table-bordered" id="table1">
        <thead>
            <tr>
                <th class="text-center" style="background-color:#9E8FB2; color: white; text-align: center; padding: 10px;">Bil.</th>
                <th class="text-center" style="background-color:#9E8FB2; color: white; text-align: center; padding: 10px;">ISBN</th>

                <th class="text-center" style="background-color:#9E8FB2; color: white; text-align: center; padding: 10px;">Judul Bahan</th>
                <th class="text-center" style="background-color:#9E8FB2; color: white; text-align: center; padding: 10px;">Penulis & Penerbit</th>
                <th class="text-center" style="background-color:#9E8FB2; color: white; text-align: center; padding: 10px;">Harga Sebuah</th>

                <th class="text-center" style="background-color:#9E8FB2; color: white; text-align: center;padding: 10px;">Jumlah Bahan</th>
            </tr>
        </thead>

        <tbody>
            @if(count($inventoryshbook) == 0)
                <tr class="text-center">
                    <td colspan="8">
                        <h5>No records found</h5>
                    </td>
                </tr>
            @else
                @php $counter = 1 @endphp
                @foreach($inventoryshbook as $item)
                    <tr class="text-center">
                        <td style="border: 1px solid #dee2e6;">{{ $counter++ }}</td>
                        <td style="border: 1px solid #dee2e6;">{{ $item->isbn }}</td>
                        <td style="border: 1px solid #dee2e6;">{{ $item->judul_bahan }}</td>
                        <td style="border: 1px solid #dee2e6;">{{ $item->penulis_penerbit }}</td>
                        <td style="border: 1px solid #dee2e6;">{{ $item->harga }}</td>
                        <td style="border: 1px solid #dee2e6;">{{ $item->jum_bahan }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>


    <br>
      <!-- Start sekolah-sekolah kerajaan, kementerian pendidikan -->
    
    
   
    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #898196;">SEKOLAH - SEKOLAH KERAJAAN / JABATAN PERKEMBANGAN KURIKULUM</h5>

     
        

        <table class="table-achiev" id="table2">
        <thead>
            <tr>
            <th class="text-center "  style="background-color:#9E8FB2 ; color: white;">ID.</th>
            <th class="text-center "  style="background-color:#9E8FB2 ; color: white;">Nama Sekolah</th>
            <th class="text-center" style="background-color:#9E8FB2 ; color: white;">Nama Penerima</th>
            <th class="text-center" style="background-color:#9E8FB2 ; color: white;">No Kad Pintar</th>
            <th class="text-center" style="background-color:#9E8FB2 ; color: white;">No D.O</th>
             <th class="text-center" style="background-color:#9E8FB2 ; color: white;">Dokumen</th>
            <th class="text-center" style="background-color:#9E8FB2 ; color: white;">Tarikh Menerima</th>
            </tr>
        </thead>

        <tbody>
  <!-- First Body: Display data from inventory_shdept -->
@if(count($inventoryshdept) == 0)
    <tr class="text-center">
        <td colspan="6">
            <h5>No records found</h5>
        </td>
    </tr>
@else
    @php $counter = 1 @endphp
    @foreach($inventoryshdept as $school)
        <tr class="text-center">
            <td><strong>{{ $counter++ }}</strong></td>
            <td><strong>{{ $school->department->label }}</strong></td>
            <td>{{ $school->penerima }}</td>
            <td>{{ $school->penerima_icno }}</td>
            <td>{{ $school->no_do }}</td>
            

            <td>
                @if (!empty($school->file))
                   <p><a href="{{ asset('storage/' . $school->file) }}" target="_blank">View here</a></p>

                @else
                    N/A
                @endif
            </td>

             




            <td>{{ $school->date_recieve }}</td>
        </tr>

        <!-- Second Body: Display data from inventory_shdept_order related to inventory_shdept -->
        <tr>
            <td colspan="6">
                @if(isset($inventoryshdeptorder))
                    <table class="" style="background-color: white;">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center" style="background-color:#696969; color: white; padding: 8px;">Bil.Buku</th>
                                <th class="text-center" style="background-color:#696969; color: white; padding: 8px;">Bil.Kuantiti</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($inventoryshdeptorder->sortBy('shbk_id') as $order)
                            @if($order->unit_sch_order == $school->unit_sch)
                                <tr class="text-center">
                                    <td>{{ $order->shbk_id }}</td>
                                    <td>{{ $order->qty }}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                @else
                    No orders found
                @endif
            </td>
        </tr>
    @endforeach
@endif
</tbody>




        </table>

      

<br>









<br>
<div class="text-center">

</div>
</form>

</div>
</div>
</div>

