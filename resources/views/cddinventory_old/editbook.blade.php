@extends('layouts.app-all')

@section('title', 'Edit')

@section('content')

<?php
$pagename = "Book List";
?>

<div class="pagetitle">
    <h1>Book List</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('cddinventory.cddinventory.indexbook') }}">Inventory</a></li>  
        <li class="breadcrumb-item active">Edit Buku</li>  
      </ol>
    </nav>
</div><!-- End Page Title -->

<div class="pagetitle">

    <a href="{{ route('cddinventory.cddinventory.indexbook') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Book Form</h5>

                        <form class="" id="updatebook" method="post" action="{{ route('cddinventory.cddinventory.updatebook') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="id" value="{{$inventorybook->id}}" placeholder="Jumlah Kekosongan" class="form-control" hidden>
                        
                            <br>

                            <div style="padding: 0 24px 0 24px;">

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Struktur Sekolah</div>
                                    <div class="col-md-9">
                                        <select name="sekolah" class="form-control">
                                            <option value="" @if($inventorybook->sekolah == null) selected @endif>Pilih Struktur</option>
                                            <option value="Menengah" @if($inventorybook->sekolah == 'Menengah') selected @endif>Menengah</option>
                                            <option value="Rendah" @if($inventorybook->sekolah == 'Rendah') selected @endif>Rendah</option>
                                        </select>
                                    </div>
                                </div> 

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Subjek</div>
                                    <div class="col-md-9" style="height: 38px;">
                                        <select id="kategori" name="kategori" class="form-control" aria-label="Default select example">
                                            <option value="" disabled></option>
                                            @foreach ($kategoribuku as $key => $value)
                                                <option value="{{ $value }}" {{ ($inventorybook->subjek == $value) ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <script>
                                    $('#kategori').select2({
                                        width: '100%',
                                        placeholder: "Subjek Buku",
                                        allowClear: true
                                    });
                                </script>                                                               

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Judul</div>
                                    <div class="col-md-9">
                                        <input type="text" name="judul" value="{{$inventorybook->judul}}" placeholder="Nama Buku" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Pengarang</div>
                                    <div class="col-md-9">
                                    <input type="text" name="pengarang" value="{{$inventorybook->pengarang}}" class="form-control">

                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">ISBN</div>
                                    <div class="col-md-9">
                                        <input type="text" name="isbn" value="{{$inventorybook->isbn}}" placeholder="No ISBN" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Penerbit</div>
                                    <div class="col-md-9">
                                        <input type="text" name="penerbit" value="{{$inventorybook->penerbit}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Peringkat</div>
                                    <div class="col-md-9">
                                        <input type="text" name="peringkat" value="{{$inventorybook->peringkat}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Jenis Buku</div>
                                    <div class="col-md-9">
                                        <input type="text" name="jenisbuku" value="{{$inventorybook->jenisbuku}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tahun Terbitan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="tahunterbitan" value="{{$inventorybook->tahunterbitan}}" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Status</div>
                                    <div class="col-md-9">
                                        <select name="status" class="form-control">
                                            <option value="" @if($inventorybook->status == null) selected @endif>Pilih Perubahan</option>
                                            <option value="Tidak Ada Perubahan" @if($inventorybook->status == 'Tidak Ada Perubahan') selected @endif>Tidak Ada Perubahan</option>
                                            <option value="Ada Perubahan" @if($inventorybook->status == 'Ada Perubahan') selected @endif>Ada Perubahan</option>
                                        </select>
                                    </div>
                                </div>  
                            
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Catatan</div>
                                    <div class="col-md-9">
                                        <select name="catatan" class="form-control">
                                            <option value="" @if($inventorybook->catatan == null) selected @endif>Pilih Status</option>
                                            <option value="ACTIVE" @if($inventorybook->catatan == 'ACTIVE') selected @endif>Aktif</option>
                                            <option value="NON-ACTIVE" @if($inventorybook->catatan == 'NON-ACTIVE') selected @endif>Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>                             

                                <div class="row mb-2">
                                    <div class="col-md-3 label">% mengikuti sukatan pelajaran</div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="number" name="sukatanpelajaran"  value="{{$inventorybook->sukatanpelajaran}}" placeholder="0" class="form-control" step="1">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <hr>
                                <br>
                            </div>
                            <div class="text-center">
                                <button id="submit-button" type="submit" class="btn btn-primary">Hantar</button>
                            </div>
                            <script>
                            var submitButton = document.getElementById('submit-button');
                            var form = document.getElementById('updatebook');
                            
                            form.addEventListener('submit', function(event) {
                                if (submitButton.getAttribute('data-submitted') !== null) {
                                    event.preventDefault();
                                } else {
                                    submitButton.disabled = true;
                                    submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                                    submitButton.setAttribute('data-submitted', 'true');
                                }
                            });
                            </script>
                        </form>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include other necessary JS libraries here (e.g., Bootstrap) -->


<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    });
</script>


<script>
$(document).ready(function(){

    // Initialize select2
    $("#myselection").select2();

    // Read selected option
    $('#but_read').click(function(){
    var username = $('#myselection option:selected').text();
    var userid = $('#myselection').val();

    $('#result').html("id : " + userid + ", name : " + username);

    });
    });
</script>

<style>
    .removeDeclare:hover {
        background-color: #dc3545 !important;
    }
</style>

@endsection