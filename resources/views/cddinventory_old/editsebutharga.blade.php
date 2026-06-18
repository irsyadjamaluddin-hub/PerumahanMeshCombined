@extends('layouts.app-all')

        @section('title', 'Edit Senarai agihan dan pengesahan penerimaan bahan')

        @section('content')

        <?php
        $pagename = "Inventory";
        ?>

        <section class="section profile">
            
    
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('cddinventory.cddinventory.indexsebutharga') }}" class="btn btn-primary mb-2">
                        <i class="bi bi-arrow-left-circle"></i>
                    </a>
                </div>
                <div class="col-md-6 text-right">
                    @foreach($inventorysebutharga as $item)
                        <a href="{{ route('generate.pdf', ['in' => $item->id]) }}" target="_blank" class="btn btn-secondary ml-2">
                            <i class="bi bi-printer-fill"></i> Generate PDF
                        </a>
                    @endforeach
                </div>
            </div>
        </div>


        

        <div class="col-12">
            <div class="card pt-3">

            <div class="card-body">

                <form class="" method="post" action="{{ route('cddinventory.cddinventory.updatesebutharga') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #655D72;">SENARAI AGIHAN DAN PENGESAHAN PENERIMAAN BAHAN<br>BAGI SEKOLAH-SEKOLAH KERAJAAN, KEMENTERIAN PENDIDIKAN</h5>
                                <br>
                                
                                
                                @foreach($inventorysebutharga as $inventorysebutharga) 


                                        <div style="display: flex; align-items: center; float: right; margin-top: 10px;">
                                            <label style="margin-right: 10px;">Date:</label>
                                            <input type="text" class="bg-gray-200 form-control form-control-sm" style="width: 200px;" value="{{ $inventorysebutharga->created_at}}" readonly>
                                            
                                        </div>


                                        <br>
                                        <br>

                                        <table class="table table-bordered">
                                            <tbody>


                                                    <tr>
                                                        <th scope="row">Bil. Sebut Harga</th>
                                                        <td><input type="text" value= "SH{{$inventorysebutharga->id}}"   class="form-control" readonly></td>
                                                       <input type="text"  name="sh_id" class="bg-gray-200 form-control " value="{{$inventorysebutharga->id}}"hidden>


                                                    <tr>
                                                        <th scope="row">Bil. Purchase Order</th>
                                                        <td><input type="text" name="bil_po" value="{{$inventorysebutharga->bil_po}}"  class="form-control"></td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Pembekal</th>
                                                        <td><input type="text" name="pembekal" value="{{$inventorysebutharga->pembekal}}"   class="form-control"></td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">E-Mel Pembekal</th>
                                                        <td><input type="text" name="emel_pembekal" value="{{$inventorysebutharga->emel_pembekal}}"   class="form-control"></td>
                                                    </tr>
                                                    <tr></tr>

                                            </tbody>
                                        </table>
                                @endforeach
                                
                                
                                <!-- Start bahan bahan kurikulum -->
                                
                                <table class="table table-bordered">

                                    <tbody>
                                    <tr>
                                    <th colspan="3" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color:#898196 ;">BUKU - BUKU </th>
                                    </tr>   
                                        <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="button" class="btn btn- mt-2 mb-2 btn-sm" id="addbtn1" href="#" style="background-color: #9E8FB2; color: white;">
                                                <i class="bi bi-plus-lg"></i>
                                            </button>
                                        </div> -->

                                    <table class="table-achiev" id="table1">

                                    <thead>
                                        <tr>
                                        <th class="text-center" style="background-color:#9E8FB2 ; color: white;">Bil.</th>
                                        <th class="text-center"style="background-color:#9E8FB2 ; color: white;" >ISBN</th>
                                        <th class="text-center" style="background-color:#9E8FB2 ; color: white;">Judul Bahan</th>
                                        <th class="text-center"style="background-color:#9E8FB2 ; color: white;" >Penulis & Penerbit</th>
                                        <th class="text-center" style="background-color:#9E8FB2; color: white;">Harga Sebuah</th>
                                        <th class="text-center" style="background-color:#9E8FB2 ; color: white;">Jumlah Bahan</th>
                                        <th class="text-center" style="background-color:#9E8FB2 ; color: white;"> </th>
                                        </tr>
                                    </thead> 

                                
                                    <tbody>
                                            @if(count( $inventoryshbook) == 0)
                                                <tr class="text-center">
                                                    <td colspan="8">
                                                    <h5>No records found</h5>
                                                    </td>
                                                </tr>

                                                @else
                                                @php $counter = 1 @endphp
                                                @foreach( $inventoryshbook as $inventoryshbook)
                                            

                                                <tr class="text-center">
                                                    <td>{{ $counter++ }}</td>
                                                    <td>{{$inventoryshbook->isbn}}</td>
                                                    <td>{{$inventoryshbook->judul_bahan}}</td>
                                                    <td>{{$inventoryshbook->penulis_penerbit}}</td>
                                                    <td>{{$inventoryshbook->harga}}</td>
                                                    <td>{{$inventoryshbook->jum_bahan}}</td>
                                            
                                                </tr>

                                                @endforeach
                                                @endif

                                    </tbody>
                                    
                                    </table>

                            <script type="text/javascript">
                                $(document).ready(function() {
                                    var isbnOptions = <?php echo json_encode($isbnOptions); ?>;
                                    var preloadedData = {!! $allBooks !!};

                                    $('#addbtn1').on('click', function() {
                                        var rowIndex = $('#table1 tr').length; // Unique index for the datalist
                                        var html = '<tr>';
                                        html += '<td><input type="text" class="form-control bil-input" name="bil[]" autofocus></td>';
                                        
                                        // Replace the select with an input and datalist for ISBN
                                        html += `
                                            <td>
                                                <input list="isbn-options-${rowIndex}" class="form-control isbn-select" name="isbn[]" required autocomplete="off" style="width: 100%; height: 36px !important;">
                                                <datalist id="isbn-options-${rowIndex}">
                                                    ${isbnOptions.map(option => `<option value="${option}">`).join('')}
                                                </datalist>
                                            </td>
                                        `;
                                        
                                        html += '<td><input type="text" class="form-control judul_bahan" name="judul_bahan[]" readonly></td>';
                                        html += '<td><input type="text" class="form-control penulis_penerbit" name="penulis_penerbit[]" readonly></td>';
                                        html += '<td><input type="text" class="form-control" name="harga[]"></td>';
                                        html += '<td><input type="text" class="form-control" name="jum_bahan[]"></td>';
                                        html += '<td><button class="removeDeclare btn btn-danger" type="button"><i class="bi bi-dash"></i></button></td>';
                                        html += '</tr>';
                                        
                                        $('#table1').append(html);
                                    });

                                    $(document).on('click', '.removeDeclare', function() {
                                        $(this).closest('tr').remove();
                                    });

                                    $(document).on('change', '.isbn-select', function(e) {
                                        e.preventDefault();
                                        var selectedIsbn = $(this).val();
                                        var row = $(this).closest('tr');
                                        fetchAdditionalInfo(selectedIsbn, row);
                                    });

                                    function fetchAdditionalInfo(isbn, row) {
                                        var bookData = preloadedData.find(book => book.isbn === isbn);
                                        if (bookData) {
                                            $('.judul_bahan', row).val(bookData.judul);
                                            $('.penulis_penerbit', row).val(bookData.pengarang);
                                        }
                                    }
                                });
                            </script>

                     <br>
   
                        <!-- Start sekolah-sekolah kerajaan, kementerian pendidikan -->
                        <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn- mt-2 mb-2 btn-sm" id="addbtn2" href="#"  style="background-color: #9E8FB2; color: white;">
                                <i class="bi bi-plus-lg"></i>
                                </button>
                        </div> -->
                            <tr>
                                <table class="table table-bordered">
                                    <tbody>
                                    <th colspan="3" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color:#898196  ;">SEKOLAH - SEKOLAH KERAJAAN / JABATAN PERKEMBANGAN KURIKULUM</th>
                                    </tr>   
                                </tbody>
                                </table>
                                
                                <input type="text" name="id" class="bg-gray-200 form-control " hidden>

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
                                                    <td colspan="8">
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

                                                                @if (!empty($school->penerima))
                                                                    <p></p>
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

                            <script type="text/javascript">
                                $(document).ready(function () {
                                    // Define a global variable to store bil values
                                    var bilValues = [];

                                    // Initialize Select2 for the initial unit_sch dropdown
                                $('#daripada').select2({
                                    placeholder: 'Search for a department',
                                    allowClear: true
                                });
                                        


                                $('#addbtn2').off().on('click', function () {
                                    var html = '';
                                
                                
                                    html += '<tr>';
                                    html += '<td><select class="form-select unit-sch-select" name="unit_sch[]" autofocus>';
                                    html += '<option value=""></option>';

                                    <?php
                                    $departments = DB::select(DB::raw('select * from departments'));
                                    ?>

                                    @if (count($departments) > 0)
                                    @foreach ($departments as $department)
                                    html += '<option value="{{$department->id}}">{{$department->label}}</option>';
                                    @endforeach
                                    @endif

                                    html += '</select></td>';


                                    html += '<td ><input id="daripada" type="text" placeholder="" class="form-control @error('
                                        dariapda ') is-invalid @enderror" name="penerima[]" value="{{ old('
                                        daripada ') }}" autofocus readonly></td>';
                                    html += '<td ><input id="daripada" type="text" placeholder="" class="form-control @error('
                                        dariapda ') is-invalid @enderror" name="penerima_icno[]" value="{{ old('
                                        daripada ') }}" autofocus readonly></td>';
                                    html += '<td ><input id="daripada" type="text" placeholder="" class="form-control @error('
                                        dariapda ') is-invalid @enderror" name="no_do[]" value="{{ old('
                                        daripada ') }}" autofocus readonly></td>';
                                    html += '<td > <input id="daripada" type="date" placeholder="" class="form-control @error('
                                        dariapda ') is-invalid @enderror" name="date_recieve[]" value="{{ old('
                                        daripada ') }}" autofocus readonly></td>';
                            
                                    html += '<td></td>'; // Empty cell for spacing
                                    html += '<td><button class="addBilanganRow btn btn-success mt-2 mb-2 btn-sm" type="button"><i class="bi bi-plus"></i> Add Bilangan</button></td>';
                                    html += '</tr>';

                                    $('#table2').append(html); // Append the row for existing fields

                                    // Initialize Select2 for the new unit_sch dropdown
                                    $('.unit-sch-select').select2({
                                        placeholder: 'Search for a department',
                                        allowClear: true
                                    });
                                    
                                });

                                // Add rows for "bilangan"
                                $(document).on('click', '.addBilanganRow', function () {
                                    var bilanganRow = '<tr>';
                                

                                    bilanganRow += '<td>';

                                

                                    bilanganRow += '<select name="shbk_id[]" class="form-control">';
                                    bilanganRow += '<option value="">Pilih Bil.</option>';
                                    for (var i = 0; i < bilValues.length; i++) {
                                        bilanganRow += '<option value="' + bilValues[i] + '">' + bilValues[i] + '</option>';
                                    }
                                    bilanganRow += '</select>';

                                    bilanganRow += '</td>';

                                    bilanganRow += '<td><input id="bilangan2" type="text" placeholder="Kuantiti" class="form-control @error('
                                        dariapda ') is-invalid @enderror" name="qty[]" value="{{ old('
                                        daripada ') }}" autofocus></td>';

                            

                                    bilanganRow += '<td colspan="3"></td>'; // Empty cells for spacing
                                    bilanganRow += '<td><button class="removeBilanganRow btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i> Remove</button></td>';
                                    bilanganRow += '</tr>';

                                    $(this).closest('tr').after(bilanganRow); // Add the "bilangan" row below the clicked button
                                });

                                // Remove "bilangan" row
                                $(document).on('click', '.removeBilanganRow', function () {
                                    $(this).closest('tr').remove();
                                });

                                // Listen for changes in bil[] inputs and update the bilValues array
                                $(document).on('input', '.bil-input', function () {
                                    var index = $(this).closest('tr').index();
                                    var inputValue = $(this).val();
                                    bilValues[index] = inputValue;
                                });

                            
                            });
                            </script>

                                                    <br>

                                                    <br>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                </form>

            </div>
            </div>
        </div>

</section>
@endsection