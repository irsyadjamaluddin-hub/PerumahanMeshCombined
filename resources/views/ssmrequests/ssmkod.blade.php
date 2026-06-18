@extends('layouts.app-all')

@section('title', 'Sekretartiat SSM Kod')

@section('content')

<?php
$pagename = "Sekretariat SSM Kod";
?>

<div class="section profile">

    <a href="{{ route('ssmrequests.ssmrequest.indexall') }}" class="btn btn-primary mb-2">
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

                    <div class="col profile-overview overflow-auto" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h3 class="card-title">List Sekretariat SSM Kod</h3>

                        <form class="" method="post" action="{{ route('ssmrequests.ssmrequest.storessmkod') }}" enctype="multipart/form-data">
                            @csrf

                                <table class="table-achiev" id="declare">
                                    <thead>
                                        <tr>

                                            <th class="text-center">IC No</th>
                                            <th class="text-center">Nama </th>
                                            <th class="text-center">Kod</th>
                                            <th class="text-center">Tindakan</th>
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
                                                <input type="text" name="moreFields[0][nama]" id="nama[0]"
                                                    class="form-control @error('nama.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('nama.0') }}">
                                            </td>

                                            <td>
                                                <input type="text" name="moreFields[0][kod]" id="kod[0]"
                                                    class="form-control @error('kod.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('kod.0') }}">
                                            </td>

                                     

                                            <td>
                                                <button class="btn btn-primary mt-2 mb-2 btn-sm" type="button" name="addDeclare" id="addDeclare">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </td>


                                            <script type="text/javascript">
                                            var i = 0;

                                            $("#addDeclare").click(function() {

                                                ++i;

                                                $("#declare").append(
                                                    '<tr class="text-center"><td><input class="form-control" type="text" placeholder= "IC No" name="moreFields[' +
                                                    i +
                                                    '][ic_no]" required></td><td><input type="text" placeholder="Nama" name="moreFields[' +
                                                    i +
                                                    '][nama]" class="form-control" required></td><td><input class="form-control" type="text" placeholder= "Kod" name="moreFields[' +
                                                    i +
                                                    '][kod]" required></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
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

                    </div>

                    </form>

                    <br>
                    <div class="col profile-overview overflow-auto" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h3 class="card-title">List Sekretariat SSM Kod</h3>

                                <table class="table-achiev datatable" id="tableprestasi1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">IC No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Kod</th>
                                            <th class="text-center">Tindakan</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        @if(count( $ssmkods) == 0)
                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>

                                        @else

                                        @foreach( $ssmkods as $ssmkod )

                                        <tr class="text-center">

                                            <td>{{$ssmkod->ic_no}}</td>

                                            <td>{{$ssmkod->nama}}</td>

                                            <td>{{$ssmkod->kod}}</td>

                                        
                                            <td>
                                                <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                                    <form method="post" action="{{ route('ssmrequests.ssmrequest.destroyssmkod', $ssmkod->id ) }}">
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