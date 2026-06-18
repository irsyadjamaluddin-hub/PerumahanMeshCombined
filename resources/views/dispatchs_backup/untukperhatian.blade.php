@extends('layouts.app-all')

@section('title', 'Untuk Perhatian')

@section('content')

<?php
$pagename = "U";
?>

<div class="pagetitle">

    <a href="{{ route('dispatchs.dis.indexadmin') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>


    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">

                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h3 class="card-title">Tambah Senarai Untuk Perhatian</i></h3>

                        <form class="" method="post" action="{{ route('dispatchs.dis.storeuntukperhatian') }}" enctype="multipart/form-data">
                            @csrf

                                <table class="table-achiev" id="declare">
                                    <thead>
                                        <tr>
                                            <th class="text-center">IC No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Kod</th>
                                            <th class="text-center">Peranan</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr class="text-center">

                                            <td>

                                                <input type="text" name="moreFields[0][ic_no]" id="ic_no[0]"
                                                    class="form-control @error('ic_no.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('ic_no.0') }}">
                                                
                                                </td>

                                                <td>
                                                <input type="text" name="moreFields[0][name]" id="name[0]"
                                                    class="form-control @error('name.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('name.0') }}">
                                            </td>

                                            <td>
                                                <input type="text" name="moreFields[0][email]" id="email[0]"
                                                    class="form-control @error('email.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('email.0') }}">
                                            </td>

                                            <td>
                                                <input type="text" name="moreFields[0][kod]" id="kod[0]"
                                                    class="form-control @error('kod.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('kod.0') }}">
                                            </td>

                                            <td>
                                                <select type="text" name="moreFields[0][label]" id="label[0]"
                                                    class="form-control @error('label.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('label.0') }}">
                                                    <option value="">Pilih Peranan</option>
                                                    <option value="Pengarah">Pengarah</option>
                                                    <option value="Pegawai Tindakan">Pegawai Tindakan</option>
                                                    <option value="Kakitangan PT">Kakitangan PT</option>
                                                </select>
                                            </td>




                                            <td>
                                                <button class="btn btn-primary mt-2 mb-2 btn-sm" type="button"
                                                    name="addDeclare" id="addDeclare">
                                                    <i class="bi bi-plus-lg"></i>

                                                </button>
                                            </td>


                                            <script type="text/javascript">
                                            var i = 0;

                                            $("#addDeclare").click(function() {

                                                ++i;

                                                $("#declare").append(
                                                    '<tr class="text-center"><td><input class="form-control" type="text" placeholder= "IC Number " name="moreFields[' +
                                                    i +
                                                    '][ic_no]" required></td><td><input type="text" placeholder="Nama" name="moreFields[' +
                                                    i +
                                                    '][name]" class="form-control" required></td><td><input type="text" placeholder="email" name="moreFields[' +
                                                    i +
                                                    '][email]" class="form-control" required></td><td><input class="form-control" type="text" placeholder= "kod" name="moreFields[' +
                                                    i +
                                                    '][kod]" required></td><td><input class="form-control" type="text" placeholder= "Bahagian " name="moreFields[' +
                                                    i +
                                                    '][label]" required></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                                    );
                                            });

                                            $(document).on('click', '.removeDeclare', function() {
                                                $(this).parents('tr').remove();
                                            });
                                            </script>


                                        </tr>




                                    </tbody>
                                </table>

                                <br>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                <br>

                            <br>

                    </div>

                    </form>

                    <br>
                    <div class="col profile-overview overflow-auto" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h5 class="card-title">Senarai Untuk Perhatian</h5>

                                <table class="table-achiev datatable" id="tableprestasi1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">IC No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Kod</th>
                                            <th class="text-center">Peranan</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        @if(count( $untukperhatians) == 0)
                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>

                                        @else

                                        @foreach( $untukperhatians as $untukperhatian )


                                        <tr class="text-center">

                                            <td>{{$untukperhatian->ic_no}}</td>
                                            <td>{{$untukperhatian->name}}</td>
                                            <td>{{$untukperhatian->email}}</td>
                                            <td>{{$untukperhatian->kod}}</td>
                                            <td>{{$untukperhatian->label}}</td>

                                            <td>
                                                <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                                    <form method="post"
                                                        action="{{ route('dispatchs.dis.destroyuntukperhatian', $untukperhatian->id ) }}">

                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('are you sure you want to delete?')">
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
</div>
</div>
</div>
</div>

@endsection