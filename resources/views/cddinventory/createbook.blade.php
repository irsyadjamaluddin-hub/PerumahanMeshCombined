@extends('layouts.app-all')

@section('title', 'Create')

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
        <li class="breadcrumb-item active">Tambah Buku</li>  
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

                        <form class="" method="post" action="{{ route('cddinventory.cddinventory.storebook') }}" enctype="multipart/form-data">
                            @csrf                  

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn2" href="#">
                                    Add Book
                                </button>
                            </div>

                            <br>

                            <div style="padding: 0 24px 0 24px;">

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Struktur Sekolah</div>
                                    <div class="col-md-9">
                                        <select name="sekolah[]" class="form-control">
                                            <option value="">Pilih Struktur</option>
                                            <option value="Menengah">Menengah</option>
                                            <option value="Rendah">Rendah</option>
                                        </select>
                                    </div>
                                </div> 

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Subjek</div>
                                    <div class="col-md-9"  style="height: 38px;">
                                        <select id="kategori" name="kategori[]" class="form-control" aria-label="Default select example">
                                            <option value="" disabled selected></option>
                                            @foreach ($kategoribuku as $key => $value)
                                                <option value="{{$value}}">
                                                    {{$value}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> 
                                <script>
                                    $('#kategori').select2({
                                        width: '100%',
                                        placeholder: "Kategori Buku",
                                        allowClear: true
                                    });
                                </script>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Judul</div>
                                    <div class="col-md-9">
                                        <input type="text" name="judul[]" placeholder="Nama Buku" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Pengarang</div>
                                    <div class="col-md-9">
                                        <input type="text" name="pengarang[]"  class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">ISBN</div>
                                    <div class="col-md-9">
                                        <input type="text" name="isbn[]" placeholder="No ISBN" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Penerbit</div>
                                    <div class="col-md-9">
                                        <input type="text" name="penerbit[]" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Peringkat</div>
                                    <div class="col-md-9">
                                        <input type="text" name="peringkat[]" placeholder="Tahun 0" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Jenis Buku</div>
                                    <div class="col-md-9">
                                        <input type="text" name="jenisbuku[]" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Tahun Terbitan</div>
                                    <div class="col-md-9">
                                        <input type="text" name="tahunterbitan[]" placeholder="0000" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 label">Status</div>
                                    <div class="col-md-9">
                                        <select name="status[]" class="form-control">
                                            <option value="">Pilih Perubahan</option>
                                            <option value="Tidak Ada Perubahan">Tidak Ada Perubahan</option>
                                            <option value="Ada Perubahan">Ada Perubahan</option>
                                        </select>
                                    </div>
                                </div> 
                            
                                <div class="row mb-2">
                                    <div class="col-md-3 label">Catatan</div>
                                    <div class="col-md-9">
                                        <select name="catatan[]" class="form-control">
                                            <option value="">Pilih Status</option>
                                            <option value="ACTIVE">Aktif</option>
                                            <option value="NON-ACTIVE">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div> 
   
                                <div class="row mb-2">
                                    <div class="col-md-3 label">% mengikuti sukatan pelajaran</div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="number" name="sukatanpelajaran[]" placeholder="0" class="form-control" step="1">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>               

                                <br>
                                <hr>
                                <br>

                                <div class="container" style="padding: 0 0 0 0">
                                    <div id="dataContainer">
                                        <!-- Data rows will be added here -->
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
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

<script type="text/javascript">
    $(document).ready(function () {
        let counter = 0; // Add a counter to generate unique IDs
        $('#addbtn2').off().on('click', function () {
            var html = '';

            // Create a new data entry container
            html += '<div class="data-entry mb-3">';
            
            // Add rows with formatted data
            html += `
        
                <div class="row mb-2">
                    <div class="col-md-3 label">Struktur Sekolah</div>
                    <div class="col-md-9">
                        <select name="sekolah[]" class="form-control">
                            <option value="">Pilih Struktur</option>
                            <option value="Menengah">Menengah</option>
                            <option value="Rendah">Rendah</option>
                        </select>
                    </div>
                </div> 

                <div class="row mb-2">
                    <div class="col-md-3 label">Subjek</div>
                    <div class="col-md-9"  style="height: 38px;">
                        <select id="kategori${counter}" name="kategori[]" class="form-control" aria-label="Default select example">
                            <option value="" disabled selected></option>
                            @foreach ($kategoribuku as $key => $value)
                                <option value="{{$value}}">
                                    {{$value}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 label">Judul</div>
                    <div class="col-md-9">
                        <input type="text" name="judul[]" placeholder="Nama Buku" class="form-control">
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 label">Pengarang</div>
                    <div class="col-md-9">
                    <input type="text" name="pengarang[]" placeholder="" class="form-control">

                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 label">ISBN</div>
                    <div class="col-md-9">
                    <input type="text" name="isbn[]" placeholder="No ISBN"  class="form-control">

                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 label">Penerbit</div>
                    <div class="col-md-9">
                    <input type="text" name="penerbit[]" placeholder="Tahun 0"  class="form-control">

                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 label">Peringkat</div>
                    <div class="col-md-9">
                    <input type="text" name="peringkat[]" placeholder=""  class="form-control">

                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 label">Jenis Buku</div>
                    <div class="col-md-9">
                    <input type="text" name="jenisbuku[]" placeholder=""  class="form-control">

                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 label">Tahun Terbitan</div>
                    <div class="col-md-9">
                        <input type="text" name="tahunterbitan[]" placeholder="0000"  class="form-control">
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 label">Status</div>
                    <div class="col-md-9">
                        <select name="status[]" class="form-control">
                            <option value="">Select Perubahan</option>
                            <option value="Tidak Ada Perubahan">Tidak Ada Perubahan</option>
                            <option value="Ada Perubahan">Ada Perubahan</option>
                        </select>
                    </div>
                </div> 

                <div class="row mb-2">
                    <div class="col-md-3 label">Catatan</div>
                    <div class="col-md-9">
                        <select name="catatan[]" class="form-control">
                            <option value="">Select Status</option>
                            <option value="ACTIVE">Aktif</option>
                            <option value="NON-ACTIVE">Tidak Aktif</option>
                        </select>
                    </div>
                </div> 

                <div class="row mb-2">
                    <div class="col-md-3 label">% mengikuti sukatan pelajaran</div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="number" name="sukatanpelajaran[]" placeholder="0" class="form-control" step="1">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>   

                <div class="row">
                    <div class="col-md-12"><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" style="background-color: #f75f6e;" type="button">Remove</button></div>
                </div>

                <br>
                <hr>
                <br>
            `;

            // Close the data entry container
            html += '</div>';

            $('#dataContainer').append(html);

            // Initialize select2 for the new select element
            $(`#kategori${counter}`).select2({
                width: '100%',
                placeholder: "Kategori Buku",
                allowClear: true
            });
        });

        $(document).on('click', '.removeDeclare', function () {
            // Remove the entire parent container of the data entry
            $(this).parents('.data-entry').remove();
        });
    });
</script>

<style>
    .removeDeclare:hover {
        background-color: #dc3545 !important;
    }
</style>
@endsection