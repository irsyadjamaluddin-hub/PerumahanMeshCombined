<!-- Start Documents -->
<div class="tab-pane fade profile-overview pt-3" id="profile-achiev">

    @foreach($biodatas as $biodata)

    <form method="POST" action="{{ route('documents.document.store', [$biodata->ic_no]) }}" class="" enctype="multipart/form-data">
        @csrf
        @endforeach
        <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-primary" id="btn-submit" text-align="right"><i class="ri-save-3-line"></i></button>
        </div> -->

        <!-- Kadar Kenaikan Gaji Table -->

        <div class="card">


            <h5 class="card-header text-lg font-extrabold text-center">Kadar Kenaikan Gaji</h5>

            <div class="card-body">

                <!-- Add rows button-->
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="insertRowPrestasi" href="#">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>

                <table class="table-achiev" id="tableprestasi">
                    <thead>
                        <tr>
                            <th>Bil</th>
                            <th>Tahun</th>
                            <th>IC No.</th>
                            <th>Jenis Kenaikan</th>
                            <th>Tarikh Kenaikan</th>
                            <th>Gaji</th>
                            <th>Attachment</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @if(count($kadarperjawatans) == 0)

                        <tr class="text-center">
                            <td colspan="8">
                                <h5>No records found</h5>
                            </td>
                        </tr>

                        @else
                        @foreach( $kadarperjawatans as $kadarjawatan )

                        <tr>

                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{$kadarjawatan->year}}</td>
                            <td>{{$kadarjawatan->ic_no}}</td>
                            <td>{{$kadarjawatan->jeniskenaikan}}</td>
                            <!-- <td>{{ optional($kadarjawatan->JenisKenaikan)->label }}</td> -->
                            <td>{{$kadarjawatan->promoted_date}}</td>
                            <td> ${{$kadarjawatan->gaji}}.00</td>

                            <td><a href='{{Storage::url("$kadarjawatan->file_1") }}' target="_blank">View</a></td>

                            <td>
                                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                    <!----Edit Button----->
                                    <form method="get" action="">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary btn-sm" disabled hidden>
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                    </form>
                                    <!----Delete Button----->
                                    <form method="post" action="{{ route('perjawatans.perjawatan.destroy', $kadarjawatan->id ) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('are you sure you want to delete year record {{ $kadarjawatan->year }}?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                        @endif


                    </tbody>
                </table>

            </div>

        </div>



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


                    cols += '<td><input id="ic_no" type="text" class="form-control @error('
                    ic_no ') is-invalid @enderror" name="ic_no[]" value="{{ old('
                    ic_no ') }}" required autocomplete="ic_no" placeholder="IC Number" autofocus></td>';



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

        <!-- End Kadar Kenaikan Gaji-->


        <!-- Start Table 2 Document -->

        <div class="card">
            <h5 class="card-header text-lg font-extrabold text-center">Attachment</h5>

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
                            <th>IC No.</th>
                            <th>Attachment</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @if(count( $attachmentperjawatans) == 0)

                        <tr class="text-center">
                            <td colspan="8">
                                <h5>No records found</h5>
                            </td>
                        </tr>

                        @else
                        @foreach( $attachmentperjawatans as $attachperjawatan )

                        <tr>

                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{$attachperjawatan->name}}</td>
                            <td>{{$attachperjawatan->ic_no}}</td>
                            <td><a href='{{Storage::url("$attachperjawatan->file_2") }}' target="_blank">View</a></td>
                            <td>
                                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                    <!----Edit Button----->
                                    <form method="get" action="">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary btn-sm" disabled hidden>
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                    </form>
                                    <!----Delete Button----->
                                    <form method="post" action="{{ route('perjawatans.perjawatan.destroy', $attachperjawatan->id ) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('are you sure you want to delete {{ $attachperjawatan->name }} record?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        @endforeach
                        @endif


                    </tbody>
                </table>

            </div>

        </div>



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

                    cols += '<td><input id="ic_no" type="text" class="form-control @error('
                    ic_no ') is-invalid @enderror" name="ic_no[]" value="{{ old('
                    ic_no ') }}" required autocomplete="ic_no" placeholder="IC Number" autofocus></td>';


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
        <div class="text-center">
            <button type="submit" class="btn btn-primary">save</button>
        </div>

    </form>

</div>
<!-- end Documents -->