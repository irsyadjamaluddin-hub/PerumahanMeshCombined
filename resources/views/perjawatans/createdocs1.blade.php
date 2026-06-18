@extends('layouts.app-all')

@section('title', 'Admin Create Perjawatans')

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

    <div class="col-xl-8">
        <div class="card mt-3">
            <div class="card-body pt-3">

                <div class="tab-content pt-2">

                    <!-- Start Documents -->
                    <div class="tab-pane fade profile-overview pt-3" id="profile-create">

                        <form method="POST" action="{{ route('documents.document.store', [Auth::user()->ic_no]) }}" class="" enctype="multipart/form-data">
                            @csrf

                            <!-- Kadar Kenaikan Gaji Table -->
                            <h5 class="card-header text-lg font-extrabold text-center">Kadar Kenaikan Gaji</h5>

                            <div class="card-body overflow-auto">

                                <!-- Add rows button-->
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="insertRowPrestasi" href="#">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </div>

                                <table class="table-achiev" id="#tableprestasi">
                                    <thead>
                                        <tr>
                                            <th>Tahun</th>
                                            <th>Jenis Kenaikan</th>
                                            <th>Tarikh Kenaikan</th>
                                            <th>Gaji</th>
                                            <th>Attachment</th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td><input id="year" type="number" min="1980" minlength="4" maxlength="4" placeholder="Year (Tahun)" class="form-control @error('
            year ') is-invalid @enderror" name="year[]" value="{{ old('
            year ') }}" required autocomplete="year" autofocus></td>

                                            <td><input id="jeniskenaikan" type="text" class="form-control @error('
            jeniskenaikan ') is-invalid @enderror" name="jeniskenaikan[]" value="{{ old('
            jeniskenaikan ') }}" required autocomplete="jeniskenaikan" placeholder="Pilih Jenis Kenaikan" autofocus></td>

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
                                    </tbody>
                                </table>

                            </div>
                            <!-- <td> <button type="button" class="btn  btn-danger" id="save"> <i class="bi bi-file-minus-fill"></i></td> -->


                            <!-- Start Table 2 Document -->

                            <h5 class=" card-header text-lg font-extrabold text-center">Attachment</h5>

                            <div class="card-body">
                                <!-- Add rows button-->
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="insertRowattach" href="#">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </div>

                                <table class="table-achiev" id="tableattach">
                                    <thead>
                                        <tr>
                                            <th>Bil</th>
                                            <th>Nama</th>
                                            <th>Attachment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>

                                            <td></td>

                                            <td><input id="name" type="text" class="form-control @error('
            name ') is-invalid @enderror" name="name[]" value="{{ old('
            name ') }}" required autocomplete="name" placeholder="Name" autofocus></td>

                                            <td><input id="file_2" type="file" class="form-control @error('
            file_2 ') is-invalid @enderror" name="file_2[]" value="{{ old('
            file_2 ') }}" required autocomplete="file_2" autofocus></td>

                                            <td></td>
                                        </tr>



                                    </tbody>
                                </table>

                            </div>

                            <div class=" text-center">
                                <button type="submit" class="btn btn-primary">save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


            <!-- script table kadar kenaikan gaji -->

            <script>
                $(function() {

                    // Start counting from the third row
                    // var counter = 3;
                    var counter = 0;

                    $("#insertRowPrestasi").on("click", function(event) {
                        event.preventDefault();

                        var newRow = $("<tr>");
                        var cols = '';

                        // Table columns
                        // cols += '<th scrope="row">' + counter + '</th>';
                        cols += '<td></td>';

                        cols += '<td><input id="year" type="number" min="1980" minlength="4" maxlength="4" placeholder="Year (Tahun)"  class="form-control @error('
                        year ') is-invalid @enderror" name="year[]" value="{{ old('
                        year ') }}" required autocomplete="year" autofocus></td>';



                        cols += '<td><input id="jeniskenaikan" type="text" class="form-control @error('
                        jeniskenaikan ') is-invalid @enderror" name="jeniskenaikan[]" value="{{ old('
                        jeniskenaikan ') }}" required autocomplete="jeniskenaikan" placeholder="Pilih Jenis Kenaikan" autofocus></td>'



                        cols += '<td><input id="promoted_date" type="date" class="form-control @error('
                        promoted_date ') is-invalid @enderror" name="promoted_date[]" value="{{ old('
                        promoted_date ') }}" required autocomplete="promoted_date" autofocus></td>';


                        cols += '<td><input id="gaji" type="text" class="form-control @error('
                        gaji ') is-invalid @enderror" name="gaji[]" value="{{ old('
                        gaji ') }}" required autocomplete="gaji" placeholder="Kadar Gaji" autofocus></td>';


                        cols += '<td><input id="file_1" type="file" class="form-control @error('
                        file_1 ') is-invalid @enderror" name="file_1[]" value="{{ old('
                        file_1 ') }}" required autocomplete="file_1" autofocus></td>';


                        // Insert the columns inside a row
                        newRow.append(cols);

                        // Insert the row inside a table
                        $("#tableprestasi").append(newRow);
                        // Increase counter after each row insertion
                        counter++;
                    });

                    // Remove row when delete btn is clicked
                    $("#tableprestasi").on("click", "#deleteRow", function(event) {
                        $(this).closest("tr").remove();
                        counter -= 1
                    });
                });
            </script>

            <!-- script attachment table -->
            <script>
                $(function() {

                    // Start counting from the third row
                    // var counter = 3;
                    var counter = 0;

                    $("#insertRowattach").on("click", function(event) {
                        event.preventDefault();

                        var newRow = $("<tr>");
                        var cols = '';

                        // Table columns
                        // cols += '<th scrope="row">' + counter + '</th>';
                        cols += '<td></td>';

                        cols += '<td><input id="name" type="text" class="form-control @error('
                        name ') is-invalid @enderror" name="name[]" value="{{ old('
                        name ') }}" required autocomplete="name" placeholder="Name" autofocus></td>';

                        cols += '<td><input id="file_2" type="file" class="form-control @error('
                        file_2 ') is-invalid @enderror" name="file_2[]" value="{{ old('
                        file_2 ') }}" required autocomplete="file_2" autofocus></td>';


                        // Insert the columns inside a row
                        newRow.append(cols);

                        // Insert the row inside a table
                        $("#tableattach").append(newRow);
                        // Increase counter after each row insertion
                        counter++;
                    });

                    // Remove row when delete btn is clicked
                    $("#tableattach").on("click", "#deleteRow", function(event) {
                        $(this).closest("tr").remove();
                        counter -= 1
                    });
                });
            </script>


</section>
@endsection



<!-- end Documents -->