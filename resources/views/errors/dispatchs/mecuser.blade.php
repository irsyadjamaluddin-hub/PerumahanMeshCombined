@extends('layouts.app-all')

@section('title', 'MecUser')

@section('content')

<?php
$pagename = "MEC";
?>

<div class="pagetitle">

    <br>

    <a href="{{ route('dispatchs.dis.indexadmin') }}" class="btn btn-primary text-right mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>


    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}


    </div>
    @endif

    <div class="col-12">
        <div class="card recent-sales">





            <div class="card-body">

                <div class="profile-overview pt-3">

                    <div class="col profile-overview"
                        style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h3 class="card-title" style="padding: 0px;">Add List Tindakan</i></h3>


                        <br>


                        <form class="" method="post" action="{{ route('dispatchs.dis.store2') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card">


                                <table class="table-achiev" id="declare">
                                    <thead>
                                        <tr>

                                            <th>IC_No</th>
                                            <th>Email</th>
                                            <th>Kod</th>
                                            <th>Peranan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>


                                        <tr class="text-center">

                                            <td>

                                                <input type="text" name="moreFields[0][ic_no]" id="ic_no[0]"
                                                    class="form-control @error('ic_no.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('ic_no.0') }}">

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
                                                    '][ic_no]" required></td><td><input type="text" placeholder="email" name="moreFields[' +
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

                            </div>

                            <br>

                    </div>

                    </form>

                    <br>
                    <div class="col profile-overview"
                        style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h5 class="card-title">List of Tindakan</h5>

                        <div class="">


                            <div class="card-body overflow-auto ">


                                <table class="table-achiev datatable" id="tableprestasi1">
                                    <thead>
                                        <tr>
                                            <th>IC_No</th>
                                            <th>Email</th>
                                            <th>Kod</th>
                                            <th>Peranan</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>


                                    <tbody>

                                        @if(count( $mecusers) == 0)

                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>

                                        @else

                                        @foreach( $mecusers as $mecuser )


                                        <tr class="text-center">


                                            <td>{{$mecuser->ic_no}}</td>

                                            <td>{{$mecuser->email}}</td>

                                            <td>{{$mecuser->kod}}</td>

                                            <td>{{$mecuser->label}}</td>


                                            <td>
                                                <div class="btn-group gap-2" role="group" aria-label="Basic example">



                                                    <form method="post"
                                                        action="{{ route('dispatchs.dis.destroymecuser', $mecuser->id ) }}">

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

                    @endsection