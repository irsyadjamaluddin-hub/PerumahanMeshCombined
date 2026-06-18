@extends('layouts.app-all')

        @section('title', 'Sebutharga Form')

        @section('content')

        <?php
        $pagename = "Inventory";
        ?>

        <section class="section profile">

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


        <a href="{{ route('cddinventory.cddinventory.indexsebutharga') }}" class="btn btn-primary mb-2">
            <i class="bi bi-arrow-left-circle"></i>
        </a>

        <div class="col-12">
            <div class="card pt-3">

            <div class="card-body">

                <form class="" method="post" action="{{ route('cddinventory.cddinventory.storesebutharga') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #655D72;">JUDUL SENARAI AGIHAN<br>BAGI SEKOLAH-SEKOLAH KERAJAAN, KEMENTERIAN PENDIDIKAN</h5>
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

                    <table class="table table-bordered">
                    <tbody>
                

                        <tr hidden>
                            <th scope="row">Bil. Sebut Harga</th>
                            <td><input type="text" name="bil_sh"  class="form-control"></td>

                        <tr>
                        <!-- hidden because bil sh will be generated automatically -->
                            <th scope="row">Bil. Purchase Order</th>
                            <td><input type="text" name="bil_po"  class="form-control"></td>
                        </tr>

                        <tr>
                            <th scope="row">Pembekal</th>
                            <td><input type="text" name="pembekal"  class="form-control"></td>
                        </tr>
                        <tr>
                            <th scope="row">E-mel Pembekal</th>
                            <td><input type="text" name="emel_pembekal"  class="form-control"></td>
                        </tr>
                        <tr></tr>

                        </tbody>
                    </table>
                
                    
    <!-- Start bahan bahan kurikulum -->

<table class="table table-bordered">
    <tbody>
        <tr>
            <th colspan="3" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color:#898196 ;">BUKU - BUKU </th>
        </tr>
    </tbody>
</table>

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button type="button" class="btn btn- mt-2 mb-2 btn-sm" id="addbtn1" style="background-color: #9E8FB2; color: white;">
        <i class="bi bi-plus-lg"></i>
    </button>
</div>

<table class="table-achiev" id="table1">
    <thead>
        <tr>
            <th class="text-center" style="background-color:#9E8FB2 ; color: white;">Bil.</th>
            <th class="text-center" style="background-color:#9E8FB2 ; color: white;">ISBN</th>
            <th class="text-center" style="background-color:#9E8FB2 ; color: white;">Judul Bahan</th>
            <th class="text-center" style="background-color:#9E8FB2 ; color: white;">Penulis & Penerbit</th>
            <th class="text-center" style="background-color:#9E8FB2 ; color: white;">Harga Sebuah</th>
            <th class="text-center" style="background-color:#9E8FB2 ; color: white;">Jumlah Bahan</th>
            <th class="text-center" style="background-color:#9E8FB2 ; color: white;"> </th>
        </tr>
    </thead>
    <tbody>
        <!-- Rows will be dynamically added here -->
    </tbody>
</table>

<script>
    // Define a global variable to store ISBN values
    var isbnValues = [];

    document.addEventListener('DOMContentLoaded', function() {
        var isbnOptions = <?php echo json_encode($isbnOptions); ?>;
        var preloadedData = <?php echo json_encode($allBooks); ?>;

        var addbtn1 = document.getElementById('addbtn1');
        var table1 = document.getElementById('table1').getElementsByTagName('tbody')[0];

        // Add the remove button to the existing first row
        var firstRow = table1.rows[0];
        if (firstRow) {
            var cellRemove = firstRow.insertCell(-1);
            cellRemove.innerHTML = '<button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button>';
        }

        addbtn1.addEventListener('click', function() {
            var newRow = table1.insertRow();
            var cellIndex = newRow.insertCell(0);
            var cellIsbn = newRow.insertCell(1);
            var cellJudul = newRow.insertCell(2);
            var cellPenulis = newRow.insertCell(3);
            var cellHarga = newRow.insertCell(4);
            var cellJumlah = newRow.insertCell(5);
            var cellRemove = newRow.insertCell(6);

            var rowIndex = newRow.rowIndex;

            cellIndex.innerHTML = '<input type="text" class="form-control bil-input" name="bil[]" autofocus>';
            cellIsbn.innerHTML = `
                <input list="isbn-options-${rowIndex}" class="form-control isbn-select" name="isbn[]" required autocomplete="isbn" autofocus style="width: 100%; height: 36px !important;">
                <datalist id="isbn-options-${rowIndex}">
                    <!-- Populate with options dynamically -->
                </datalist>`;
            cellJudul.innerHTML = '<input type="text" class="form-control judul_bahan" name="judul_bahan[]" autofocus readonly>';
            cellPenulis.innerHTML = '<input type="text" class="form-control penulis_penerbit" name="penulis_penerbit[]" autofocus readonly>';
            cellHarga.innerHTML = '<input type="text" class="form-control" name="harga[]" autofocus>';
            cellJumlah.innerHTML = '<input type="text" class="form-control" name="jum_bahan[]" autofocus>';
            cellRemove.innerHTML = '<button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button>';

            // Populate datalist options
            var datalist = newRow.querySelector(`#isbn-options-${rowIndex}`);
            preloadedData.forEach(function (book) {
                var option = document.createElement('option');
                option.value = book.isbn;
                datalist.appendChild(option);
            });

            // Initialize Select2 on the isbn-select element
            var isbnSelect = newRow.querySelector('.isbn-select');
            $(isbnSelect).select2({
                width: '100%',
                placeholder: "Pilih Jenis Permohonan",
                allowClear: true
            });
        });

        table1.addEventListener('click', function(event) {
            if (event.target.classList.contains('removeDeclare')) {
                var row = event.target.closest('tr');
                row.parentNode.removeChild(row);
            }
        });

        table1.addEventListener('change', function(event) {
            if (event.target.classList.contains('isbn-select')) {
                var selectedIsbn = event.target.value;
                var row = event.target.closest('tr');
                fetchAdditionalInfo(selectedIsbn, row);
            }
        });

        function fetchAdditionalInfo(isbn, row) {
            var bookData = preloadedData.find(book => book.isbn === isbn);
            if (bookData) {
                var judulInput = row.querySelector('.judul_bahan');
                var penulisInput = row.querySelector('.penulis_penerbit');
                judulInput.value = bookData.judul;
                penulisInput.value = bookData.pengarang;
            } else {
                console.error('Book data not found for ISBN:', isbn);
            }
        }
    });
</script>



    <!-- Start sekolah-sekolah kerajaan, kementerian pendidikan -->
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button type="button" class="btn btn- mt-2 mb-2 btn-sm" id="addbtn2" style="background-color: #9E8FB2; color: white;">
        <i class="bi bi-plus-lg"></i>
    </button>
</div>

<table class="table table-bordered">
    <tbody>
        <tr>
            <th colspan="3" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color:#898196;">SEKOLAH - SEKOLAH KERAJAAN / JABATAN PERKEMBANGAN KURIKULUM</th>
        </tr>   
    </tbody>
</table>
        
<input type="text" name="id" class="bg-gray-200 form-control " hidden>

<table class="table-achiev" id="table2">
    <thead>
        <tr>
            <th class="text-center" style="background-color:#9E8FB2; color: white;">Nama Sekolah / JPK</th>
            <th class="text-center" style="background-color:#9E8FB2; color: white;">Nama Penerima</th>
            <th class="text-center" style="background-color:#9E8FB2; color: white;">No Kad Pintar</th>
            <th class="text-center" style="background-color:#9E8FB2; color: white;">No D.O</th>
            <th class="text-center" style="background-color:#9E8FB2; color: white;">Tarikh Menerima</th>
            <th style="background-color:#9E8FB2; color: white;"></th>
        </tr>
    </thead>
    <tbody>
        <!-- Rows will be dynamically added here -->
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function () {
        var bilValues = [];

        $('#addbtn2').off().on('click', function () {
            var html = '';
            html += '<tr>';
            html += '<td><select class="form-select unit-sch-select initial-unit-sch" name="unit_sch[]" autofocus>';
            html += '<option value=""></option>';

            <?php
            $departments = DB::select(DB::raw('select * from departments'));
            ?>

            @if (count($departments) > 0)
            @foreach ($departments as $department)
            html += '<option value="{{ $department->id }}">{{ $department->label }}</option>';
            @endforeach
            @endif

            html += '</select></td>';

            html += '<td><input type="text" placeholder="" class="form-control" name="penerima[]" autofocus readonly></td>';
            html += '<td><input type="text" placeholder="" class="form-control" name="penerima_icno[]" autofocus readonly></td>';
            html += '<td><input type="text" placeholder="" class="form-control" name="no_do[]" autofocus readonly></td>';
            html += '<td><input type="date" placeholder="" class="form-control" name="date_recieve[]" autofocus readonly></td>';
            html += '<td><button class="removeRow btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td>'; // Empty cell for spacing
            html += '<td><button class="addBilanganRow btn btn-success mt-2 mb-2 btn-sm" type="button"><i class="bi bi-plus"></i> Add Bilangan</button></td>';
            html += '</tr>';

            $('#table2 tbody').append(html); // Append the row for existing fields

            // Initialize Select2 for the new unit_sch dropdown
            $('.unit-sch-select').select2({
                placeholder: 'Search for a department',
                allowClear: true
            });
        });

        $(document).on('click', '.removeRow', function () {
            $(this).closest('tr').remove();
        });
        
        $(document).on('change', '.unit-sch-select', function () {
            var selectedValue = $(this).val();
            $(this).closest('tr').find('.unit-sch-bil-hidden').val(selectedValue);
            var associatedBilRows = $(this).closest('tr').nextUntil(':not(.bilangan-row)');
            associatedBilRows.find('.unit-sch-bil-hidden').val(selectedValue);
        });

        $(document).on('click', '.addBilanganRow', function () {
            var bilanganRow = '<tr class="bilangan-row">';
            bilanganRow += '<td><select name="shbk_id[]" class="form-control">';
            bilanganRow += '<option value="">Pilih Bil.</option>';

            for (var i = 0; i < bilValues.length; i++) {
                bilanganRow += '<option value="' + bilValues[i] + '">' + bilValues[i] + '</option>';
            }

            bilanganRow += '</select></td>';

            var initialUnitSchValue = $(this).closest('tr').find('.initial-unit-sch').val();
            bilanganRow += '<td><input type="hidden" name="unit_sch_order[]" class="unit-sch-bil-hidden" value="' + initialUnitSchValue + '"></td>';
            bilanganRow += '<td><input type="text" placeholder="Kuantiti" class="form-control" name="qty[]" autofocus></td>';
            bilanganRow += '<td colspan="3"></td>'; // Empty cells for spacing
            bilanganRow += '<td><button class="removeBilanganRow btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i> Remove</button></td>';
            bilanganRow += '</tr>';

            $(this).closest('tr').after(bilanganRow); // Add the "bilangan" row below the clicked button
        });

        $(document).on('click', '.removeBilanganRow', function () {
            $(this).closest('tr').remove();
        });

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