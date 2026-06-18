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

 <div class="d-flex justify-content-end mb-3">
  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPpkModal">
      + Add PPK
  </button>
</div>


  {{-- Add PPK Modal --}}
  <div class="modal fade" id="addPpkModal" tabindex="-1" aria-labelledby="addPpkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="addPpkForm" method="POST" action="{{ route('admin.ppk.store') }}">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addPpkModalLabel">Add New Penolong Pengarah Kurikulum</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="text" name="name" placeholder="Nama" class="form-control mb-2" required>
            <input type="email" name="email" placeholder="Emel" class="form-control mb-2" required>
            <input type="text" name="ic_no" placeholder="No Kad Pengenalan" class="form-control mb-2" required>
            <input type="text" name="phone" placeholder="No Tel" class="form-control mb-2">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save PPK</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="col-12">
    <div class="card pt-3">

      <div class="card-body">

          <form method="post" action="{{ route('cddinventory.cddinventory.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">BORANG PERMOHONAN BAHAN-BAHAN KURIKULUM<br>BAGI UNIT-UNIT JABATAN PERKEMBANGAN KURIKULUM</h5>
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
                    <th scope="row">Unit</th>
                    <td>
                        <input type="text" name="unit" class="form-control" required>
                    </td>  
                    
                    <th scope="row">Nama Pemohon</th>
                    <td>
                        <input type="text" value="{{$biodata->name}}" name="nama" class="form-control" disabled>
                        <input type="text" value="{{$biodata->name}}" name="nama" class="form-control" hidden>
                    </td>
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

                <tr>
                    <th scope="row">Pilih Penolong Pengarah Kurikulum (PPK)</th>
                    <td colspan="3">
                        <select name="ppk_id" id="ppkSelect" class="form-control" required>
    <option value="">-- Sila Pilih PPK --</option>
    @foreach($ppks as $ppk)
        <option value="{{ $ppk->id }}"
            data-name="{{ $ppk->name }}"
            data-email="{{ $ppk->email }}"
            data-ic_no="{{ $ppk->ic_no }}"
            data-phone="{{ $ppk->phone }}">
            {{ $ppk->name }} — {{ $ppk->email }} — {{ $ppk->ic_no }}
        </option>
    @endforeach
</select>

<script>
  // Function to reset the PPK dropdown to just the placeholder option
  function resetPpkDropdown() {
    const ppkSelect = document.getElementById('ppkSelect');
    if (!ppkSelect) return;

    // Remove all options except the first one (the placeholder)
    while (ppkSelect.options.length > 1) {
      ppkSelect.remove(1);
    }
  }

  // Example usage: reset dropdown on page load (optional)
  document.addEventListener('DOMContentLoaded', () => {
    // resetPpkDropdown(); // Uncomment if you want to clear on page load
  });

  // Example: you can call resetPpkDropdown() anytime you want to clear the list
</script>

                </tr>

                </tbody>
              </table>

              <!-- Keterangan Penolong Pegawai Kerja -->
              <table class="table table-bordered" style="background-color: #B0C4DE;">
                <thead>
                  <tr style="background-color: #5B81A8; color: white; text-align: center;">
                    <th colspan="4">Keterangan Penolong Pengarah Kurikulum</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><label>Nama PPKs</label></td>
                    <td><input type="text" name="ppk_name" id="ppkName" class="form-control" placeholder="Masukkan Nama"></td>
                    <td><label>No. Kad Pengenalan</label></td>
                    <td><input type="text" name="ppk_ic_no" id="ppkIcNo" class="form-control" placeholder="Eg. 0112345"></td>
                  </tr>
                  <tr>
                    <td><label>Emel PPKs</label></td>
                    <td><input type="email" name="ppk_email" id="ppkEmail" class="form-control" placeholder=""></td>
                    <td><label>No. Tel PPKs</label></td>
                    <td><input type="text" name="ppk_phone" id="ppkPhone" class="form-control" placeholder=""></td>
                  </tr>
                </tbody>
              </table>

            @endforeach

            <table class="table table-bordered" style="background-color: #72A0C1; color: white;">
  <tr>
    <th colspan="7" style="text-align: center; padding: 10px;">Bahan - Bahan Kurikulum</th>
  </tr>
</table>


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

                  // UNIQUE ID (fix duplicate datalist issue)
                  var uid = Date.now();

                  row.innerHTML = `
                      <td>
                          <input list="isbn-${uid}" class="form-control isbn-select" name="isbn[]" placeholder="ISBN" required>
                          <datalist id="isbn-${uid}"></datalist>
                      </td>

                      <td>
                          <input list="kategori-${uid}" class="form-control matapelajaran" name="matapelajaran[]" placeholder="Matapelajaran">
                          <datalist id="kategori-${uid}"></datalist>
                      </td>

                      <td>
                          <input list="judul-${uid}" class="form-control judulbahan" name="judulbahan[]" placeholder="Judul Bahan">
                          <datalist id="judul-${uid}"></datalist>
                      </td>

                      <td>
                          <input type="text" class="form-control pengarang_penerbit" name="pengarang_penerbit[]" placeholder="Pengarang/Penerbit">
                      </td>

                      <td>
                          <input type="text" class="form-control" name="qty_dipohonkan[]" placeholder="Kuantiti" required>
                      </td>

                      <td>
                          <input type="text" class="form-control" name="sebab_permohonan[]" placeholder="Sebab Permohonan" required>
                      </td>

                      <td>
                          <button type="button" class="removeDeclare btn btn-danger btn-sm">X</button>
                      </td>
                  `;

                  // ===== GET ELEMENTS =====
                  var isbnInput = row.querySelector('.isbn-select');
                  var kategoriInput = row.querySelector('.matapelajaran');
                  var judulInput = row.querySelector('.judulbahan');

                  var isbnList = row.querySelector(`#isbn-${uid}`);
                  var kategoriList = row.querySelector(`#kategori-${uid}`);
                  var judulList = row.querySelector(`#judul-${uid}`);

                  // ===== POPULATE ISBN =====
                  preloadedData.forEach(book => {
                      let opt = document.createElement('option');
                      opt.value = book.isbn;
                      isbnList.appendChild(opt);
                  });

                  // ===== UNIQUE MATA PELAJARAN =====
                  let kategoriSet = new Set();
                  preloadedData.forEach(book => {
                      if (!kategoriSet.has(book.kategori)) {
                          kategoriSet.add(book.kategori);
                          let opt = document.createElement('option');
                          opt.value = book.kategori;
                          kategoriList.appendChild(opt);
                      }
                  });

                  // ===== UNIQUE JUDUL =====
                  let judulSet = new Set();
                  preloadedData.forEach(book => {
                      if (!judulSet.has(book.judul)) {
                          judulSet.add(book.judul);
                          let opt = document.createElement('option');
                          opt.value = book.judul;
                          judulList.appendChild(opt);
                      }
                  });

                  // ===== ISBN → AUTO FILL =====
                  isbnInput.addEventListener('change', function () {
                      let book = preloadedData.find(b => b.isbn === this.value);
                      if (book) {
                          kategoriInput.value = book.kategori;
                          judulInput.value = book.judul;
                          row.querySelector('.pengarang_penerbit').value = book.pengarang;
                      }
                  });

                  // ===== MATA PELAJARAN → FILTER =====
                  kategoriInput.addEventListener('change', function () {
                      let filtered = preloadedData.filter(b => b.kategori === this.value);

                      // update ISBN list based on selected subject
                      isbnList.innerHTML = '';
                      filtered.forEach(book => {
                          let opt = document.createElement('option');
                          opt.value = book.isbn;
                          isbnList.appendChild(opt);
                      });

                      // autofill first match
                      if (filtered.length > 0) {
                          let book = filtered[0];
                          isbnInput.value = book.isbn;
                          judulInput.value = book.judul;
                          row.querySelector('.pengarang_penerbit').value = book.pengarang;
                      }
                  });

                  // ===== JUDUL → FILTER =====
                  judulInput.addEventListener('change', function () {
                      let book = preloadedData.find(b => b.judul === this.value);

                      if (book) {
                          kategoriInput.value = book.kategori;
                          isbnInput.value = book.isbn;
                          row.querySelector('.pengarang_penerbit').value = book.pengarang;

                          // filter ISBN based on title
                          isbnList.innerHTML = '';
                          let opt = document.createElement('option');
                          opt.value = book.isbn;
                          isbnList.appendChild(opt);
                      }
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

              // PPK autofill
              const ppkSelect = document.getElementById('ppkSelect');
              const ppkName = document.getElementById('ppkName');
              const ppkIcNo = document.getElementById('ppkIcNo');
              const ppkEmail = document.getElementById('ppkEmail');
              const ppkPhone = document.getElementById('ppkPhone');

              ppkSelect.addEventListener('change', function () {
                const selectedOption = ppkSelect.options[ppkSelect.selectedIndex];

                if (selectedOption.value === '') {
                  ppkName.value = '';
                  ppkIcNo.value = '';
                  ppkEmail.value = '';
                  ppkPhone.value = '';
                  return;
                }

                ppkName.value = selectedOption.getAttribute('data-name') || '';
                ppkIcNo.value = selectedOption.getAttribute('data-ic_no') || '';
                ppkEmail.value = selectedOption.getAttribute('data-email') || '';
                ppkPhone.value = selectedOption.getAttribute('data-phone') || '';
              });

            });
            </script>

            <br><br><br>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

          </form>

    </div>
    </div>
    </div>

</section>
@endsection
