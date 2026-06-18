@extends('layouts.app-all')

@section('title', 'Create inventory')

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

          <form class="" method="post" action="{{ route('cddinventory.cddinventory.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">BORANG PERMOHONAN BAHAN-BAHAN KURIKULUM <br>BAGI SEKOLAH-SEKOLAH KERAJAAN</h5>
              <br>
              
              @foreach($biodatas as $biodata)

              <div style="display: flex; align-items: center; float: right; margin-top: 10px;">
                  <label style="margin-right: 10px;">Date:</label>
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

                <tr>
                    <th colspan="4" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Maklumat Pemohon</th>
                </tr>

                <tr>
                    <th scope="row">Unit</th>
                    <td><input type="text"  name="unit" class="form-control" ></td>  
                    
                    <th scope="row">Nama Pemohon</th>
                    <td><input type="text" value="{{$biodata->name}}" name="nama" class="form-control" disabled></td>
                    <input type="text" value="{{$biodata->name}}" name="nama" class="form-control" hidden>
                 </tr>

                 

                <tr>
                    <th scope="row">Jabatan</th>
                    @foreach($employments as $employment)
                    <td><input type="text" class="bg-gray-200 form-control" name="jabatan" value="{{ optional($employment->department)->label }}" readonly></td>
                    <input type="hidden" name="jabatan" class="bg-gray-200 form-control" value="{{ $employment->department_id }}" hidden>
                    @endforeach
               
               
                    <th scope="row">Emel Pemohon</th>
                    <td><input type="text" value="{{$biodata->email}}" name="emel" class="form-control" disabled></td>
                    <input type="text" value="{{$biodata->email}}" name="emel" class="form-control" hidden>
                </tr>

                
                <tr>
                    <th scope="row">No. Kad Pengenalan Pemohon</th>
                    <td><input type="text" value="{{$biodata->ic_no}}" name="ic_no" class="form-control" disabled></td>
                    <input type="text" value="{{$biodata->ic_no}}" name="ic_no" class="form-control" hidden>
               
                </tr>
        
      
              
                <tr></tr>

                <!-- Start bahan bahan kurikulum -->
           
                <tr>
                 <th colspan="4" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Bahan - Bahan Kurikulum</th>
                </tr>   

               </tbody>
              </table>
            @endforeach
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn2" href="#">
                  <i class="bi bi-plus-lg"></i>
                </button>
            </div>

              <input type="text" name="id" class="bg-gray-200 form-control " hidden>

                <table class="table-achiev" id="tableprestasi1">

                  <thead>
                    <tr>
                      <th class="text-center">ISBN No.</th>
                      <th class="text-center">Mata Pelajaran</th>
                      <th class="text-center">Judul Bahan</th>
                      <th class="text-center">Pengarang/Penerbit</th>
                      <th class="text-center">Kuantiti Dipohonkan</th>
                      <th class="text-center">Sebab Permohonan</th>

                      <th></th>
                    </tr>
                  </thead>


                  <tbody>
                      <tr class="text-center">

                      </tr>

                    </tbody>
                  </table>

                 <!-- Your custom script -->
   <!-- Your custom script -->
<script type="text/javascript">
   document.addEventListener("DOMContentLoaded", function () {
   

    var preloadedData = <?php echo json_encode($allBooks); ?>;

    function fetchAdditionalInfo(isbn, row) {
        var bookData = preloadedData.find(function (book) { return book.isbn === isbn; });

        if (bookData) {
            console.log('Additional Info:', bookData);
            row.querySelector('.matapelajaran').value = bookData.kategori;
            row.querySelector('.judulbahan').value = bookData.judul;
            row.querySelector('.pengarang_penerbit').value = bookData.pengarang;
        } else {
            console.error('Book data not found for ISBN:', isbn);
            alert('Error: Book data not found for ISBN ' + isbn);
        }
    }

    function addRow() {
        var tbody = document.querySelector('#tableprestasi1 tbody');
        var row = tbody.insertRow();

        row.innerHTML = `
          <td>
          <input list="isbn-options" class="form-control isbn-select" name="isbn[]" required autocomplete="isbn" autofocus style="width: 100%; height: 36px !important;">
          <datalist id="isbn-options">
              <!-- Populate with options dynamically -->
          </datalist>
      </td>
              <td><input type="text" class="form-control matapelajaran"  name="matapelajaran[]" placeholder="Matapelajaran" autofocus></td>
            <td><input type="text" class="form-control judulbahan"  name="judulbahan[]" placeholder="Judul Bahan" autofocus></td>
            <td><input type="text" class="form-control pengarang_penerbit" name="pengarang_penerbit[]" placeholder="Pengarang/Penerbit" autofocus></td>
            <td><input type="text" class="form-control"  name="qty_dipohonkan[]" placeholder="Kuantiti" autofocus></td>
            <td><input type="text" class="form-control"  name="sebab_permohonan[]" placeholder="Sebab Permohonan" autofocus></td>
            <td><button class="removeDeclare">Remove</button></td>
        `;

        // Populate datalist options
  var datalist = row.querySelector('#isbn-options');
  preloadedData.forEach(function (book) {
      var option = document.createElement('option');
      option.value = book.isbn;
      datalist.appendChild(option);
  });

        // Populate ISBN options
        var select = row.querySelector('.isbn-select');
        preloadedData.forEach(function (book) {
            var option = document.createElement('option');
            option.value = book.isbn;
            option.textContent = book.isbn;
            select.appendChild(option);
        });

        // Add event listener for select change
        select.addEventListener('change', function () {
            var selectedIsbn = select.value;
            fetchAdditionalInfo(selectedIsbn, row);
        });

      
    }

    document.getElementById('addbtn2').addEventListener('click', addRow);

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('removeDeclare')) {
            event.target.closest('tr').remove();
            console.log('Row removed successfully.');
            alert('Row removed successfully.');
        }
    });
});
</script>
<br>
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

