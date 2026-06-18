@extends('layouts.app-all')

@section('title', 'Createadmin')

@section('content')

<?php
$pagename = "Datakehadiran";
?>

<div class="pagetitle">

    <a href="{{ back()->getTargetUrl() }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

            <form class="" method="post" action="{{ route('datakehadiran.datakehadiran.storecreate') }}" enctype="multipart/form-data">
                            @csrf

                <div class="profile-overview pt-3">
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">ADD List Participant</h5>

                   


                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn2" href="#">
                                    Add Data
                                </button>
                            </div>

                            <br>

                            <div style="padding: 0 24px 0 24px;">

                            <div class="row mb-3">
                                        <div class="col-sm-4 label">Kategori</div>
                                        <div class="col-sm-8">
                                            <select name="kategori[]" class="form-control">
                                                <option selected hidden value="">-- Pilih Kategori --</option>
                                                <option value="MOE PENDIDIKAN TERAS">MOE PENDIDIKAN TERAS</option>
                                                <option value="MOE PENGAJIAN TINGGI">MOE PENGAJIAN TINGGI</option>
                                                <option value="MORA">MORA</option>
                                                <option value="PASUKAN BERUNIFORM">PASUKAN BERUNIFORM</option>
                                                <option value="SEKOLAH-SEKOLAH SWASTA">SEKOLAH-SEKOLAH SWASTA</option>
                                                <option value="INSTITUT PENGAJIAN TINGGI SWASTA">INSTITUT PENGAJIAN TINGGI SWASTA</option>
                                                <option value="PEGAWAI & KAKITANGAN">PEGAWAI & KAKITANGAN</option>
                                            </select>
                                        </div>
                                    </div>


                                   
                                        <div class="row mb-3">
                                            <div class="col-sm-4 label">Sekolah/Institusi</div> <!-- Removed extra ">" character -->
                                            <div class="col-sm-8">
                                                <select id="sekolah_institusi" class="form-select" name="sekolah_institusi[]" aria-label="Default select example" style="width: 100%;">
                                                    <option value="" disabled selected></option>
                                                    @foreach ($dkschools as $key => $value)
                                                         <option value="{{ $value }}">                      
                                                                {{ $value }}
                                                            </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <script>
                                            $('#sekolah_institusi').select2({
                                                width: '100%',
                                                placeholder: "",
                                                allowClear: true
                                            });
                                        </script>

                                    <div class="row mb-3">
                                        <label class="col-sm-4 label">Nama</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="nama_pelajar_pengawas[]"  class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-4 label">IC No./SKB.No</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="icno_skbno[]"  class="form-control">
                                        </div>
                                    </div>

                               

                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-4 label">Pelajar / Pengawas</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" name="type_pelajar_pengawas[]" aria-label="Default select example">
                                                <option selected hidden value="">-- Pilih Status --</option>
                                                <option value="G" >Pengawas</option>
                                                <option value="P" >Pelajar</option>
                                                <option value="PU" >Pegawai Uniform</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-4 label">Status</div>
                                        <div class="col-sm-8">
                                            <select name="hadir[]" class="form-control">
                                                <option value="">-- Status Kehadiran --</option>
                                                <option value="X">Tidak Hadir</option>
                                                <option value="1" >Hadir</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-4 label">Pasukan (<i>Jika berkenaan</i>)</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" name="pasukan[]" aria-label="Default select example">
                                                <option selected hidden value=""> -- Pilih Pasukan -- </option>
                                                <option value="Kadet Polis">Kadet Polis</option>
                                                <option value="Kadet Tentera">Kadet Tentera</option>
                                                <option value="Pandu Puteri">Pandu Puteri</option>
                                                <option value="Pasukan Hadrah">Pasukan Hadrah</option>
                                                <option value="Pengakap">Pengakap</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-4 label">Pindah sekolah / Institusi?</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" name="pindah[]" aria-label="Default select example">
                                                <option value=""> -- Pilih --</option>
                                                <option value="Tidak">Tidak</option>
                                                <option value="Ya" >Ya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-4 label">Catatan</label>
                                        <div class="col-lg-8">
                                            <textarea type="text" name="catatan[]" class="form-control"></textarea> <!-- Removed unnecessary value attribute -->
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

                    </div>
                </div>
                <br>

                </form>

               

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
        $('#addbtn2').off().on('click', function () {
            var html = '';

            // Create a new data entry container
            html += '<div class="data-entry mb-3">';
            
            // Add rows with formatted data
            html += `
            <div class="row mb-3">
                                        <div class="col-sm-4 label">Kategori</div>
                                        <div class="col-sm-8">
                                            <select name="kategori[]" class="form-control">
                                                <option selected hidden value="">-- Pilih Kategori --</option>

                                                <option value="MOE PENDIDIKAN TERAS">MOE PENDIDIKAN TERAS</option>
                                                <option value="MOE PENGAJIAN TINGGI">MOE PENGAJIAN TINGGI</option>
                                                <option value="MORA">MORA</option>
                                                <option value="PASUKAN BERUNIFORM">PASUKAN BERUNIFORM</option>
                                                <option value="SEKOLAH-SEKOLAH SWASTA">SEKOLAH-SEKOLAH SWASTA</option>
                                                <option value="INSTITUT PENGAJIAN TINGGI SWASTA">INSTITUT PENGAJIAN TINGGI SWASTA</option>
                                            </select>
                                        </div>
                                    </div>


                                   <div class="row mb-3">
                                            <div class="col-sm-4 label">Sekolah/Institusi</div> <!-- Removed extra ">" character -->
                                            <div class="col-sm-8">
                                                <select id="sekolah_institusi" class="form-select" name="sekolah_institusi[]" aria-label="Default select example" style="width: 100%;">
                                                    <option value="" disabled selected></option>
                                                    @foreach ($dkschools as $key => $value)
                                                         <option value="{{ $value }}">                      
                                                                {{ $value }}
                                                            </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        
                                    

                                    <div class="row mb-3">
                                        <label class="col-sm-4 label">Nama</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="nama_pelajar_pengawas[]"  class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-4 label">IC No./SKB.No</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="icno_skbno[]"  class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-4 label">Pelajar / Pengawas</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" name="type_pelajar_pengawas[]" aria-label="Default select example">
                                                <option selected hidden value="">-- Pilih Status --</option>
                                                <option value="G" >Pengawas</option>
                                                <option value="P" >Pelajar</option>
                                                <option value="PU" >Pegawai Uniform</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-4 label">Status</div>
                                        <div class="col-sm-8">
                                            <select name="hadir[]" class="form-control">
                                                <option value="">-- Status Kehadiran --</option>
                                                <option value="X">Tidak Hadir</option>
                                                <option value="1" >Hadir</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-4 label">Pasukan (<i>Jika berkenaan</i>)</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" name="pasukan[]" aria-label="Default select example">
                                                <option selected hidden value=""> -- Pilih Pasukan --</option>
                                                <option value="Kadet Polis">Kadet Polis</option>
                                                <option value="Kadet Tentera">Kadet Tentera</option>
                                                <option value="Pandu Puteri">Pandu Puteri</option>
                                                <option value="Pasukan Hadrah">Pasukan Hadrah</option>
                                                <option value="Pengakap">Pengakap</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-4 label">Pindah sekolah / Institusi?</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" name="pindah[]" aria-label="Default select example">
                                                <option value=""> -- Pilih --</option>
                                                <option value="Tidak">Tidak</option>
                                                <option value="Ya" >Ya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-4 label">Catatan</label>
                                        <div class="col-lg-8">
                                            <textarea type="text" name="catatan[]" class="form-control"></textarea> <!-- Removed unnecessary value attribute -->
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
        });

        $(document).on('click', '.removeDeclare', function () {
            // Remove the entire parent container of the data entry
            $(this).parents('.data-entry').remove();
        });
    });
</script>

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