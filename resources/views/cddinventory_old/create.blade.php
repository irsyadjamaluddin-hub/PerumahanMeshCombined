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
                    <th colspan="2" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Maklumat Sekolah</th>
                    <th colspan="3" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Maklumat Pemohon</th>
                </tr>

        
                <tr>

                    <th scope="row">Nama Sekolah</th>
                    <td>

                    	 <select class="form-select" name="nama_sch" aria-label="Default select example" id="namasch" required>
                   
                      <option selected hidden>Pilih Sekolah</option>
                      @foreach ($sekolah as $key => $value)
                      <option value="{{ $value }}">
                          {{ $value }}
                      </option>
                      @endforeach
                    </select>
                    </td>

                    <script>
    
  </script>

                    <th scope="row">No. Kad Pengenalan Pemohon</th>
                    <td><input type="text" value="{{$biodata->ic_no}}" name="ic_no" class="form-control" disabled></td>
                    <input type="text" value="{{$biodata->ic_no}}" name="ic_no" class="form-control" hidden>
                </tr>

                <tr>
                    <th scope="row">Kluster</th>
                    <td><input type="text" name="kluster"  class="form-control"></td>
                    <th scope="row">Nama Pemohon</th>
                    <td><input type="text" value="{{$biodata->name}}" name="nama" class="form-control" disabled></td>
                    <input type="text" value="{{$biodata->name}}" name="nama" class="form-control" hidden>
                </tr>

                <tr>
                    <th scope="row">No Tel Sekolah</th>
                    <td><input type="text" name="no_tel" class="form-control"></td>
                    <th scope="row">Emel Pemohon</th>
                    <td><input type="text" value="{{$biodata->email}}" name="emel" class="form-control" disabled></td>
                    <input type="text" value="{{$biodata->email}}" name="emel" class="form-control" hidden>
                </tr>
        
                <tr>
                 <th colspan="4" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Keterangan Guru Besar/Pengetua</th>
                </tr>

              <tr>
                <th scope="row">Nama Guru Besar/Pengetua</th>
                <td>
                    <select name="kgp_nama" id="kgp_nama" class="form-control" required>
                        <option selected hidden>Pilih Nama Guru Besar/Pengetua</option>
                    </select>
                </td>

                <th scope="row">No. Kad Pengenalan</th>
                <td>
                    <input type="text" name="kgp_ic_no" id="kgp_ic_no" placeholder="Eg. 0112345" class="form-control" readonly>
                </td>
              </tr>

              <tr>
                <th scope="row">Emel Guru Besar/Pengetua</th>
                <td>
                    <input type="email" name="kgp_emel" id="kgp_emel" class="form-control" readonly>
                </td>

                <th scope="row">No. Tel Guru Besar/Pengetua</th>
                <td>
                    <input type="text" name="kgp_phone_number" id="kgp_phone_number" class="form-control" readonly>
                </td>
              </tr>

              <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
              
              <script>
                  $(document).ready(function() {
                      var kgpData = {}; // To store the data returned from the server

                      $('#namasch').on('change', function() {
                          var namaSch = $(this).val();
                          if (namaSch) {
                              $.ajax({
                                  url: '{{ route("getKgpNama", ":nama_sch") }}'.replace(':nama_sch', encodeURIComponent(namaSch)),
                                  type: 'GET',
                                  dataType: 'json',
                                  success: function(data) {
                                      $('#kgp_nama').empty();
                                      $('#kgp_nama').append('<option selected hidden>Pilih Nama Guru Besar/Pengetua</option>');

                                      kgpData = {}; // Reset kgpData

                                      $.each(data, function(index, item) {
                                          $('#kgp_nama').append('<option value="' + item.name + '">' + item.name + '</option>');
                                          // Store all relevant data keyed by name
                                          kgpData[item.name] = {
                                              ic_no: item.ic_no,
                                              email: item.email,
                                              phone_number: item.phone_number
                                          };
                                      });

                                      $('#kgp_nama').select2({
                                          width: '100%',
                                          placeholder: "Pilih Nama Guru Besar/Pengetua",
                                          allowClear: true
                                      });
                                  },
                                  error: function(xhr) {
                                      console.error('AJAX Error:', xhr);
                                  }
                              });
                          } else {
                              $('#kgp_nama').empty();
                              $('#kgp_nama').append('<option selected hidden>Pilih Nama Guru Besar/Pengetua</option>');
                              $('#kgp_nama').select2({
                                  width: '100%',
                                  placeholder: "Pilih Nama Guru Besar/Pengetua",
                                  allowClear: true
                              });
                          }
                      });

                      $('#kgp_nama').on('change', function() {
                          var selectedName = $(this).val();
                          if (selectedName) {
                              var selectedData = kgpData[selectedName]; // Get the relevant data for the selected name
                              $('#kgp_ic_no').val(selectedData.ic_no); // Set the ic_no in the input field
                              $('#kgp_emel').val(selectedData.email); // Set the email in the input field
                              $('#kgp_phone_number').val(selectedData.phone_number); // Set the phone number in the input field
                          } else {
                              // Clear the input fields if no name is selected
                              $('#kgp_ic_no').val('');
                              $('#kgp_emel').val('');
                              $('#kgp_phone_number').val('');
                          }
                      });
                  });
              </script>




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

              <!-- Your existing HTML code for the table -->
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
                        <tr class="text-center"></tr>
                    </tbody>
                </table>

                <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>


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

