@extends('layouts.app-all')

@section('title', 'Add New Club')

@section('content')

<?php
$pagename = "Add New Club";
?>

<div class="pagetitle">

    <br>




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

                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h3 class="card-title" style="padding: 0px;">Tambah Kelab Baru</i></h3>


                        <br>


                        <form class="" method="post" action="{{ route('cca.cca.storetambahkelab') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card">

                            <!-- Button to tambah new line for add club -->
                            
                            <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn2" href="#">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div> -->

                            

                                <table class="table-achiev" id="declare">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nama Kelab</th>
                                            <th class="text-center">Komponen</th>
                                            <th class="text-center">Kaitan</th>
                                            <th class="text-center">Tindakan</th>
                                        </tr>
                                    </thead>

                                    <tbody>


                                        <tr>

                                            <td>
                                                
                                                <input type="text" placeholder="Nama Kelab" name="moreFields[0][label]"  required autocomplete="label" autofocus id="label[0]" class="form-control @error('label.0') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('label.0') }}">

                                            <td>
                                                <select type="text" name="moreFields[0][komponen]"  required autocomplete="komponen" autofocus id="komponen[0]" class="form-control @error('komponen.0') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('komponen.0') }}">
                                                    <option value="" disabled selected hidden >Pilih Komponen</option>
                                                    <option value="Fizikal">Fizikal</option>
                                                    <option value="Kerohanian">Kerohanian</option>
                                                    <option value="Kreativiti">Kreativiti</option> 
                                                    <option value="Perkhidmatan">Perkhidmatan</option> 
                                                </select>
                                            </td>
                                            

                                            <td>
                                                <select type="text" name="moreFields[0][kaitan]"  required autocomplete="kaitan" autofocus id="kaitan[0]" class="form-control @error('kaitan.0') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('kaitan.0') }}">
                                                    <option value="" disabled selected hidden>Pilih Kaitan</option>
                                                    <option value="Sukan">Sukan</option>
                                                    <option value="Kecergasan">Kecergasan</option>
                                                    <option value="Rekreasi">Rekreasi</option> 
                                                    <option value="Teras">Teras</option>
                                                    <option value="Kebudayaan Islam">Kebudayaan Islam</option>
                                                    <option value="Kesenian">Kesenian</option>
                                                    <option value="Kebudayaan">Kebudayaan</option>
                                                    <option value="Kemahiran Bahasa">Kemahiran Bahasa</option>
                                                    <option value="Permainan">Permainan</option>
                                                    <option value="S.T.E.A.M">S.T.E.A.M</option>
                                                    <option value="Keusahawanan">Keusahawanan</option>
                                                    <option value="Pasukan Beruniform">Pasukan Beruniform</option>
                                                    <option value="Khidmat Masyarakat">Khidmat Masyarakat</option>
                                                </select>
                                            </td>

                                            <td style="text-align: center;">
                                            <button class="btn btn-primary mt-2 mb-2 btn-sm"  type="button" name="addDeclare" id="addDeclare">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </td>
                                                   
                                                



                                            </td>

                                            


                                            

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
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h5 class="card-title">Senarai Kelab CCA </h5>

                        <div class="">


                            <div class="card-body overflow-auto ">


                                <table class="table-achiev datatable" id="tableprestasi">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nama Kelab</th>
                                            <th class="text-center">Komponen</th>
                                            <th class="text-center">Kaitan</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        @if(count( $ccanames) == 0)

                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>

                                        @else

                                        @foreach( $ccanames as $ccaname )


                                        <tr class="text-center">


                                            <td>{{$ccaname->label}}</td>

                                            <td>{{$ccaname->komponen}}</td>

                                            <td>{{$ccaname->kaitan}}</td>

                                            <!-- <td>{{$ccaname->label}}</td> -->


                                            <!-- <td>
                                                <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                                </div>
                                            </td> -->





                                        </tr>

                                        @endforeach

                                        @endif




                                    </tbody>
                                </table>
                    <!-- Script for adding new line under Tambah Kelab Baru if admin want to add more than one club -->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                    <script type="text/javascript">
                                                var i = 0;

                                                $("#addDeclare").click(function() {

                                                    ++i;

                                                    $("#declare").append('<tr class="text-center"><td><input class="form-control" type="text" placeholder= "Nama Kelab " name="moreFields[' + i + '][label]" required></td><td><select type="text" name="moreFields[' + i + '][komponen]"  required autocomplete="komponen" autofocus id="komponen[' + i + ']" class="form-control @error('komponen.0') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('komponen.0') }}"><option value="" disabled selected hidden >Pilih Komponen</option><option value="Fizikal">Fizikal</option><option value="Kerohanian">Kerohanian</option><option value="Kreativiti">Kreativiti</option><option value="Perkhidmatan">Perkhidmatan</option></select></td><td><select type="text" name="moreFields[' + i + '][kaitan]"  required autocomplete="kaitan" autofocus id="kaitan[' + i + ']" class="form-control @error('kaitan.0') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('kaitan.0') }}"><option value="" disabled selected hidden>Pilih Kaitan</option><option value="Sukan">Sukan</option><option value="Kecergasan">Kecergasan</option><option value="Rekreasi">Rekreasi</option><option value="Teras">Teras</option><option value="Kebudayaan Islam">Kebudayaan Islam</option><option value="Kesenian">Kesenian</option><option value="Kebudayaan">Kebudayaan</option><option value="Kemahiran Bahasa">Kemahiran Bahasa</option><option value="Permainan">Permainan</option><option value="S.T.E.A.M">S.T.E.A.M</option><option value="Keusahawanan">Keusahawanan</option><option value="Pasukan Beruniform">Pasukan Beruniform</option><option value="Khidmat Masyarakat">Khidmat Masyarakat</option></select></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>');
                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                     
                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                
                                                                                                                                                                                                                                                                                                                                                                                
                                                    
                                                    
                                                    

                                                    
                                                    
                                                    
                                                      
                                                    
                                                
                                            

                                                });

                                                $(document).on('click', '.removeDeclare', function() {
                                                    $(this).parents('tr').remove();
                                                });
                                            </script>
                    
                    

                            </div>
                            
                        </div>

                    </div>

                    @endsection

