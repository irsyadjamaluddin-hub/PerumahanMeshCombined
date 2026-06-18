<div class="tab-pane fade profile-overview pt-3" id="profile-achiev">

    @foreach($biodatas as $biodata)

    <form method="POST" action="{{ route('documents.document.store', [$biodata->ic_no]) }}" class="" enctype="multipart/form-data">

        @csrf

        <div class="card">
            <h5 class="card-header text-lg font-extrabold text-center">Kadar Kenaikan Gaji</h5>

            <div class="card-body overflow-auto">

                <!-- Add rows button-->
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn2" href="#">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>

                <table class="table-achiev" id="tableprestasi1">
                    <thead>
                        <tr>
                            <th>Bil</th>
                            <th>Tahun</th>
                            <th>IC No.</th>
                            <th>Jenis Kenaikan</th>
                            <th>Tarikh</th>
                            <th>Gaji</th>
                            <th>Attachment</th>
                            <th>Action</th>
                        </tr>
                    </thead>



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
                        <td>{{$kadarjawatan->promoted_date}}</td>
                        <td> ${{$kadarjawatan->gaji}}.00</td>

                        <td><a href='{{Storage::url("$kadarjawatan->file_1") }}' target="_blank">View</a></td>

                        <!-- <td> <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="insertRowPrestasi"> <i class="bi bi-plus-lg"></i></td> -->

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


                                <form method="post" action="{{ route('perjawatan.perjawatan.destroy', $kadarjawatan->id ) }}">
                                    @csrf
                                    @method('delete')

                                    <button type="submit" style="position: relative " class="btn btn-outline-danger btn-sm" onclick="return confirm('are you sure you want to delete year record {{ $kadarjawatan->year }}?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>

                                </form>

                            </div>
                        </td>

                    </tr>
                    @endforeach
                    @endif



                </table>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#addbtn2').off().on('click', function() {

                            var html = '';
                            html += '<tr>';

                            html += '<td></td>';


                            html += '<td><input id="year" type="number" min="1980" minlength="4" maxlength="4" placeholder="Year (Tahun)"  class="form-control @error('
                            year ') is-invalid @enderror" name="year[]" value="{{ old('
                            year ') }}" required autocomplete="year" autofocus></td>';

                            html += '<td><input id="ic_no" type="text" class="form-control @error('
                            ic_no ') is-invalid @enderror" name="ic_no[]" value="{{ old('
                            ic_no ') }}" required autocomplete="ic_no" placeholder="IC Number" autofocus></td>';

                            html += ' <td><select class="form-control @error('
                            jeniskenaikan ') is-invalid @enderror" name="jeniskenaikan[]" required autocomplete="jeniskenaikan" autofocus><option value="">Pilih Jenis Kenaikan</option><option value="Kenaikan Tahunan (Pink)">Kenaikan Tahunan (Pink)</option><option value="EB Sekatan (Hijau)">EB Sekatan (Hijau)</option><option value="EB Khas (Putih)">EB Khas (Putih)</option><option value="Penetap Jawatan">Penetap Jawatan</option></select></td>';

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
                            $('#tableprestasi1').append(html);
                        })

                    });

                    $(document).on('click', '#remove', function() {
                        $(this).closest('tr').remove();
                    });
                </script>



            </div>
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

                        <td>{{$attachperjawatan->ic_no}}</td>
                        <td><a href='{{Storage::url("$attachperjawatan->file_2") }}' target="_blank">View</a></td>
                        <td>{{$attachperjawatan->name}}</td>
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
                                <form method="post" action="{{ route('perjawatan.perjawatan.destroy', $attachperjawatan->id ) }}">
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



                </table>

            </div>
        </div>



        <div class="text-center">
            <button type="submit" class="btn btn-primary">save</button>
        </div>


    </form>



    <!-- script attachment table -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#add_btn1').off().on('click', function() {
                var cols = '';
                cols += '<tr>';
                cols += '<td></td>';


                cols += '<td><input id="ic_no" type="text" class="form-control @error('
                ic_no ') is-invalid @enderror" name="ic_no[]" value="{{ old('
                ic_no ') }}" required autocomplete="ic_no" placeholder="IC Number" autofocus></td>';

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





    @endforeach

</div>
<!-- end Documents -->