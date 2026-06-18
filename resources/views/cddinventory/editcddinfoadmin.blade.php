@extends('layouts.app-all')

@section('title', 'Edit CDD Inventory')

@section('content')

<?php
$pagename = "Cddinventory";
?>

<section class="section profile">

  <!-- Back Button -->
  <a href="#" onclick="goBackTwoPages()" class="btn btn-primary mb-3">
    <i class="bi bi-arrow-left-circle"></i> Back
  </a>

  <script>
    function goBackTwoPages() {
      sessionStorage.setItem('refreshOnBack', 'true');
      history.go(-2);
    }
  </script>

  @if(session('success_message'))
    <div class="alert alert-success">
      {{ session('success_message') }}
    </div>
  @endif

  <div class="card">
    <div class="card-body mt-3">
      <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">
        Bahan-Bahan Kurikulum
      </h5>

      <div class="col-lg-12 overflow-auto">
        <form class="search-form d-flex align-items-center" method="POST" action="{{ route('cddinventory.cddinventory.updatecddinfoadmin') }}">
          @csrf
          <input type="hidden" name="id" class="bg-gray-200 form-control" value="{{ $inventorynormalbbk->id }}">
          <input type="hidden" name="direction" id="direction" value="submit">
          <input type="hidden" name="inventory_id" value="{{ $inventoryId }}">
         

          <table class="table table-bordered">
            <tbody>
              <tr>
                <th scope="row">Mata Pelajaran</th>
                <td><input type="text" value="{{ $inventorynormalbbk->matapelajaran }}" class="form-control" readonly></td>
              </tr>
              <tr>
                <th scope="row">Judul Bahan</th>
                <td><input type="text" value="{{ $inventorynormalbbk->judulbahan }}" class="form-control" readonly></td>
              </tr>
              <tr>
                <th scope="row">ISBN No.</th>
                <td><input type="text" value="{{ $inventorynormalbbk->isbn }}" class="form-control" readonly></td>
              </tr>
              <tr>
                <th scope="row">Pengarang/Penerbit</th>
                <td><input type="text" value="{{ $inventorynormalbbk->pengarang_penerbit }}" class="form-control" readonly></td>
              </tr>
              <tr>
                <th scope="row">Kuantiti DiPohonkan</th>
                <td><input type="text" value="{{ $inventorynormalbbk->qty_dipohonkan }}" class="form-control" readonly></td>
              </tr>
              <tr>
                <th scope="row">Sebab Permohonan</th>
                <td>
                  <textarea class="form-control" readonly>{{ $inventorynormalbbk->sebab_permohonan }}</textarea>
                </td>
              </tr>
            </tbody>
          </table>
      </div>

      <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">
        Admin
      </h5>

      <div class="col-lg-12 overflow-auto">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th scope="row">Status</th>
              <td>
                <select name="cdd_status" class="form-control">
                  <option value="" {{ old('cdd_status', $inventorynormalbbk->cdd_status) == '' ? 'selected' : '' }}>Please Select</option>
                  <option value="Borang Pengeluaran" {{ old('cdd_status', $inventorynormalbbk->cdd_status) == 'Borang Pengeluaran' ? 'selected' : '' }}>Borang Pengeluaran</option>
                  <option value="Sebutharga" {{ old('cdd_status', $inventorynormalbbk->cdd_status) == 'Sebutharga' ? 'selected' : '' }}>Sebutharga</option>
                  <option value="Rejected" {{ old('cdd_status', $inventorynormalbbk->cdd_status) == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                  <option value="In Process" {{ old('cdd_status', $inventorynormalbbk->cdd_status) == 'In Process' ? 'selected' : '' }}>In Process</option>
                  <option value="Borang Pengeluaran & Sebutharga" {{ old('cdd_status', $inventorynormalbbk->cdd_status) == 'Borang Pengeluaran & Sebutharga' ? 'selected' : '' }}>Borang Pengeluaran & Sebutharga</option>
                </select>
              </td>
            </tr>
            <tr id="row-cdd_qty_diluluskan">
              <th scope="row">Kuantiti Pengeluaran</th>
              <td><input type="text" name="cdd_qty_diluluskan" value="{{ old('cdd_qty_diluluskan', $inventorynormalbbk->cdd_qty_diluluskan) }}" class="form-control"></td>
            </tr>
            <tr id="row-kqty_pengeluaran" style="display:none;">
              <th scope="row">Kuantiti Pengeluaran</th>
              <td>
                <input type="text" name="kqty_pengeluaran" value="{{ old('kqty_pengeluaran', $inventorynormalbbk->kqty_pengeluaran ?? '') }}" class="form-control">
              </td>
            </tr>
            <tr id="row-kqty_sebutharga" style="display:none;">
              <th scope="row">Kuantiti Sebutharga</th>
              <td>
                <input type="text" name="kqty_sebutharga" value="{{ old('kqty_sebutharga', $inventorynormalbbk->kqty_sebutharga ?? '') }}" class="form-control">
              </td>
            </tr>
            <tr id="row-cdd_catatan">
              <th scope="row">Catatan</th>
              <td>
                <textarea name="cdd_catatan" class="form-control" rows="4" cols="50" style="resize: vertical;">{{ old('cdd_catatan', $inventorynormalbbk->cdd_catatan ?? '') }}</textarea>
              </td>
            </tr>
          </tbody>
        </table>
      </div>



      @if(isset($previousId))
      <button type="submit" class="btn btn-secondary me-2"
              onclick="document.getElementById('direction').value='previous'">
        &laquo; Previous
      </button>
    @endif

    @if(isset($isLast) && $isLast)
      <button type="submit" class="btn btn-success ms-2" 
              onclick="document.getElementById('direction').value='notify'">
        Next
      </button>
    @elseif(isset($nextId))
      <button type="submit" class="btn btn-secondary ms-2"
              onclick="document.getElementById('direction').value='next'">
        Next &raquo;
      </button>
    @endif
        
      </div>
      </form>
    </div>
  </div>

</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const statusSelect = document.querySelector('select[name="cdd_status"]');
    const qtyDiluluskanRow = document.getElementById('row-cdd_qty_diluluskan');
    const catatanRow = document.getElementById('row-cdd_catatan');
    const qtyPengeluaranRow = document.getElementById('row-kqty_pengeluaran');
    const qtySebuthargaRow = document.getElementById('row-kqty_sebutharga');

    function toggleFields() {
      const selected = statusSelect.value;

      if (selected === 'Rejected') {
        qtyDiluluskanRow.style.display = 'none';
        qtyPengeluaranRow.style.display = 'none';
        qtySebuthargaRow.style.display = 'none';
        catatanRow.style.display = '';
      } else if (selected === 'Borang Pengeluaran & Sebutharga') {
        qtyDiluluskanRow.style.display = 'none';
        qtyPengeluaranRow.style.display = '';
        qtySebuthargaRow.style.display = '';
        catatanRow.style.display = '';
      } else if (
        selected === 'Borang Pengeluaran' ||
        selected === 'Sebutharga' ||
        selected === 'In Process'
      ) {
        qtyDiluluskanRow.style.display = '';
        qtyPengeluaranRow.style.display = 'none';
        qtySebuthargaRow.style.display = 'none';
        catatanRow.style.display = '';
      } else {
        qtyDiluluskanRow.style.display = 'none';
        qtyPengeluaranRow.style.display = 'none';
        qtySebuthargaRow.style.display = 'none';
        catatanRow.style.display = 'none';
      }
    }

    toggleFields();

    statusSelect.addEventListener('change', toggleFields);
  });
</script>

@endsection