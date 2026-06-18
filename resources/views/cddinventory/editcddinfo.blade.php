@extends('layouts.app-all')

@section('title', 'Edit CDD Inventory')

@section('content')

<?php
$pagename = "Cddinventory";
?>

@if(session('success_message'))
    <div class="alert alert-success">
        {{ session('success_message') }}
    </div>
@endif

<!-- Back Button -->
<a href="#" id="backButton" class="btn btn-primary mb-3" style="width: fit-content;">
    <i class="bi bi-arrow-left-circle"></i> Back
</a>

<div class="card">
    <div class="card-body mt-3">
        <h5 class="card-title text-center text-white py-2" style="background-color: #1F4E78;">
            Bahan-Bahan Kurikulum
        </h5>

        <div class="col-lg-12 overflow-auto">
            <form id="inventoryForm" class="search-form d-flex align-items-center" method="POST" action="{{ route('cddinventory.cddinventory.updateinfo') }}">
                @csrf
                
                <input type="hidden" name="id" value="{{ $inventorynormalbbk->id }}" class="form-control bg-gray-200">

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">Mata Pelajaran</th>
                            <td><input type="text" name="matapelajaran" value="{{ old('matapelajaran', $inventorynormalbbk->matapelajaran) }}" class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Judul Bahan</th>
                            <td><input type="text" name="judulbahan" value="{{ old('judulbahan', $inventorynormalbbk->judulbahan) }}" class="form-control" readonly></td>
                        </tr> 
                        <tr>
                            <th scope="row">ISBN No.</th>
                            <td><input type="text" name="isbn" value="{{ old('isbn', $inventorynormalbbk->isbn) }}" class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Pengarang/Penerbit</th>
                            <td><input type="text" name="pengarang_penerbit" value="{{ old('pengarang_penerbit', $inventorynormalbbk->pengarang_penerbit) }}" class="form-control" readonly></td>
                        </tr>      
                        <tr>
                            <th scope="row">Kuantiti DiPohonkan</th>
                            <td><input type="text" name="qty_dipohonkan" value="{{ old('qty_dipohonkan', $inventorynormalbbk->qty_dipohonkan) }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <th scope="row">Sebab Permohonan</th>
                            <td>
                                <textarea name="sebab_permohonan" class="form-control">{{ old('sebab_permohonan', $inventorynormalbbk->sebab_permohonan) }}</textarea>
                            </td>
                        </tr> 

                        <tr>
                            <!-- <th scope="row">Kuantiti Pengeluaran</th>
                            <td>
                                <input type="number" name="kqty_pengeluaran" value="{{ old('kqty_pengeluaran', $inventorynormalbbk->kqty_pengeluaran ?? '') }}" class="form-control" /> -->
                            </td>
                        </tr>
                        <tr>
                            <!-- <th scope="row">Kuantiti Sebutharga</th>
                            <td>
                                <input type="number" name="kqty_sebutharga" value="{{ old('kqty_sebutharga', $inventorynormalbbk->kqty_sebutharga ?? '') }}" class="form-control" />
                            </td> -->
                        </tr>

                        <!-- <tr id="row-cdd_catatan">
                            <th scope="row">Catatan</th>
                            <td>
                                <textarea name="cdd_catatan" class="form-control">{{ old('cdd_catatan', $inventorynormalbbk->cdd_catatan ?? '') }}</textarea> -->
                            </td>
                        </tr>

                    </tbody>
                </table>
        </div>

       <div class="text-center">
    <button type="submit" class="btn btn-primary">Submit</button>

    <!-- @if($isLast)
        <a href="{{ route('cddinventory.notify', ['inventory_id' => $inventoryId]) }}" 
           class="btn btn-success mt-2">
            Next (Go to Notify)
        </a> -->
    <!-- @else
        <a href="{{ route('cddinventory.editcddinfoadmin', $nextId) }}" 
           class="btn btn-primary mt-2">
            Next
        </a>
    @endif -->
</div>
</form>


<!-- JavaScript to handle back button logic -->
<script>
    // Set flag in sessionStorage when form is submitted
    document.getElementById('inventoryForm').addEventListener('submit', function () {
        sessionStorage.setItem('formSubmitted', 'true');
    });

    // Handle back button click
    document.getElementById('backButton').addEventListener('click', function (e) {
        e.preventDefault();
        const wasSubmitted = sessionStorage.getItem('formSubmitted') === 'true';

        if (wasSubmitted) {
            sessionStorage.removeItem('formSubmitted'); // clear it after use
            history.go(-2); // Go back 2 pages
        } else {
            history.go(-1); // Go back 1 page
        }
    });
</script>

@endsection
