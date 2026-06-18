@extends('layouts.app-all')

@section('title', 'Admin Create Perjawatan')

@section('content')

<?php
$pagename = "Admin_Perjawatan";
?>

<div class="pagetitle">
    <h1>Perjawatan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Perjawatan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <!-- ART Table -->
    <div class="col-xl-8">
        <div class="card mt-3">
            <div class="card-body pt-3">


                <!-- start pane tab 1 -->
                <div class="tab-content pt-2">


                    <!-- start pane tab 2 -->
                    <div class="tab-pane fade show active profile-overview" id="profile-overview">

                        @foreach($biodatas as $biodata)


                        <!-- <h3 class="card-title">Perjawatan Info</h3> -->
                        <form method="POST" action="{{ route('documents.document.store', $biodata->ic_no) }}" class="" enctype="multipart/form-data">
                            @csrf

                            @endforeach



                            <div class="card">
                                <h5 class="card-header text-lg font-extrabold text-center">Kadar Kenaikan Gaji</h5>

                                <div class="card-body overflow-auto">

                                    <!-- Add rows button-->
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn" href="#">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>

                                    <table class="table-achiev" id="tableprestasi">
                                        <thead>
                                            <tr>

                                                <th>Tahun</th>
                                                <th>IC No.</th>
                                                <th>Jenis Kenaikan</th>
                                                <th>Tarikh</th>
                                                <th>Gaji</th>
                                                <th>Attachment</th>
                                                <th>Action </th>
                                            </tr>
                                        </thead>


                                        <tr>

                                            <td><input id="year" type="number" min="1980" minlength="4" maxlength="4" placeholder="Year (Tahun)" class="form-control @error('
year ') is-invalid @enderror" name="year[]" value="{{ old('
year ') }}" required autocomplete="year" autofocus></td>

                                            <td><input id="ic_no" type="text" class="form-control @error('
name ') is-invalid @enderror" placeholder="IC No. Eg. 00123456" name="ic_no[]" value="{{ old('
name ') }}" required autocomplete="ic_no" placeholder="IC Number" autofocus></td>


                                            <td><select class="form-select" name="jeniskenaikan[]" aria-label="Default select example">
                                                    <option selected>Pilih Jenis Kenaikan</option>
                                                    </option>
                                                    <option value="Kenaikan Tahunan (Pink)">Kenaikan Tahunan (Pink)</option>
                                                    <option value="EB Sekatan (Hijau)">EB Sekatan (Hijau)</option>
                                                    <option value="EB Khas (Putih)">EB Khas (Putih)</option>
                                                    <option value="Penetap Jawatan">Penetap Jawatan</option>
                                                </select></td>

                                            <td><input id="promoted_date" type="date" class="form-control @error('
promoted_date ') is-invalid @enderror" name="promoted_date[]" value="{{ old('
promoted_date ') }}" required autocomplete="promoted_date" autofocus></td>

                                            <td><input id="gaji" type="text" class="form-control @error('
gaji ') is-invalid @enderror" name="gaji[]" value="{{ old('
gaji ') }}" required autocomplete="gaji" placeholder="Kadar Gaji" autofocus></td>

                                            <td><input id="file_1" type="file" class="form-control @error('
file_1 ') is-invalid @enderror" name="file_1[]" value="{{ old('
file_1 ') }}" required autocomplete="file_1" autofocus></td>


                                        </tr>

                                    </table>

                                </div>
                            </div>



                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('#addbtn').on('click', function() {
                                        var html = '';
                                        html += '<tr>';
                                        html += '<td></td>';

                                        html += '<td><input id="year" type="number" min="1980" minlength="4" maxlength="4" placeholder="Year (Tahun)"  class="form-control @error('
                                        year ') is-invalid @enderror" name="year[]" value="{{ old('
                                        year ') }}" required autocomplete="year" autofocus></td>';

                                        html += '<td><input id="ic_no" type="text" class="form-control @error('
                                        ic_no ') is-invalid @enderror" name="ic_no[]" value="{{ old('
                                        ic_no ') }}" required autocomplete="ic_no" placeholder="IC No. Eg. 00123456" autofocus></td>';

                                        html += '<td> <select class="form-select" name="jeniskenaikan[]" aria-label="Default select example"><option selected>Pilih Jenis Kenaikan</option></option><option value="Kenaikan Tahunan (Pink)">Kenaikan Tahunan (Pink)</option><option value="EB Sekatan (Hijau)">EB Sekatan (Hijau)</option><option value="EB Khas (Putih)">EB Khas (Putih)</option><option value="Penetap Jawatan">Penetap Jawatan</option></select></td>';

                                        html += ' <td><input id="promoted_date" type="date" class="form-control @error('
                                        promoted_date ') is-invalid @enderror" name="promoted_date[]" value="{{ old('
                                        promoted_date ') }}" required autocomplete="promoted_date" autofocus></td>';


                                        html += '<td><input id="gaji" type="text" class="form-control @error('
                                        gaji ') is-invalid @enderror" name="gaji[]" value="{{ old('
                                        gaji ') }}" required autocomplete="gaji" placeholder="Kadar Gaji" autofocus></td>';

                                        html += '<td><input id="file_1" type="file" class="form-control @error('
                                        file_1 ') is-invalid @enderror" name="file_1[]" value="{{ old('
                                        file_1 ') }}" required autocomplete="file_1" autofocus></td>';

                                        html += '<td> <button type="button" class="btn  btn-primary" id="add_btn"> <i class="bi bi-plus-lg"></i></td>';

                                        html += '</tr>';
                                        $('#tableprestasi').append(html);
                                    })

                                });

                                $(document).on('click', '#remove', function() {
                                    $(this).closest('tr').remove();
                                });
                            </script>


                    </div>


                    <div class="card">
                        <h5 class=" card-header text-lg font-extrabold text-center">Attachment</h5>

                        <div class="card-body overflow-auto">
                            <!-- Add rows button-->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="add_btn1" href="#">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>

                            <table class="table-achiev" id="tableattach">
                                <thead>
                                    <tr>
                                        <th>Bil</th>
                                        <th>IC No.</th>
                                        <th>Attachment</th>
                                        <th>Remarks by</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tr>

                                    <td></td>


                                    <td><input id="ic_no" type="text" placeholder="IC No. Eg. 00123456" class="form-control @error('
name ') is-invalid @enderror" name="ic_no[]" value="{{ old('
name ') }}" placeholder="IC Number" autofocus></td>

                                    <td><input id="file_2" type="file" class="form-control @error('
file_2 ') is-invalid @enderror" name="file_2[]" value="{{ old('
file_2 ') }}" autofocus></td>

                                    <td><input id="name" type="text" class="form-control @error('
name ') is-invalid @enderror" name="name[]" value="{{ old('
name ') }}" placeholder="Name" autofocus></td>

                                    <td></td>
                                </tr>

                            </table>

                        </div>
                    </div>





                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">save</button>
                    </div>


                    </form>


                </div>



            </div>
            <!-- end pane tab 1 -->


            <!-- End Bordered Tabs -->


        </div>
        <!-- end card body -->



    </div>
    <!-- end card recent sales -->

    </div>

    </div>
    <!-- table-->



    <!-- script attachment table -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#add_btn1').on('click', function() {
                var cols = '';
                cols += '<tr>';
                cols += '<td></td>';

                cols += '<td><input id="ic_no" type="text" class="form-control @error('
                ic_no ') is-invalid @enderror" name="ic_no[]" value="{{ old('
                ic_no ') }}" required autocomplete="ic_no" placeholder="IC No. Eg. 00123456" autofocus></td>';

                cols += '<td><input id="file_2" type="file" class="form-control @error('
                file_2 ') is-invalid @enderror" name="file_2[]" value="{{ old('
                file_2 ') }}" required autocomplete="file_2" autofocus></td>';

                cols += '<td><input id="name" type="text" class="form-control @error('
                name ') is-invalid @enderror" name="name[]" value="{{ old('
                name ') }}" required autocomplete="name" placeholder="Name" autofocus></td>';


                cols += '<td> <button type="button" class="btn  btn-primary" id="add_btn"> <i class="bi bi-plus-lg"></i></td>';

                cols += '</tr>';
                $('#tableattach').append(cols);
            })

        });

        $(document).on('click', '#remove', function() {
            $(this).closest('tr').remove();
        });
    </script>








</section>
@endsection