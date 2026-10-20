@extends('layouts.app-all')

@section('title', 'Mesh Paparan Iklan')

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" sections; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
<div class="mesh-home-theme">
{{-- #================================ --}}

<?php
$pagename = "Banner Form";
?>

<div class="pagetitle">
    <h1>Mesh Paparan Iklan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Mesh Paparan Iklan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <div class="col-md-12">

        @if(Session::has('success_message'))
        <div class="alert alert-success">
            <i class=" fas fa-fw fa-check"></i>
            {!! session('success_message') !!}


        </div>
        @endif

        <div class="col-12">
            <div class="card recent-sales">
                <div class="card-body overflow-auto">
                    <form method="post" action="{{ route('bn.banner.store') }}" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        {{-- #============= ORI CODE ============== --}}
                        {{-- <h3 class="card-title"style="padding: 0px;">Masukkan Paparan Iklan</i></h3> --}}
                        {{-- #================================ --}}
                        {{-- Title centred; gold in dark mode (mesh-gold-title, public/css/mesh-dark.css) --}}
                        <h3 class="card-title mesh-gold-title" style="padding: 0px; text-align: center;">Masukkan Paparan Iklan</i></h3>
                        {{-- #================================ --}}
                        <hr>
                        <br>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">Name</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="name" class="form-control">
                                </div>
                        </div>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">Teks</label>
                                <div class="col-lg-8 col-md-9">
                                    <input class="form-control" type="file" name="bn_image" accept=".jpg, .jpeg, .png, .pdf" id="file">
                                </div>
                        </div>

                        <div class="row" style="text-align: center;">
                            <div class="col-lg-10 col-md-12" >
                                <div style="color:red;">
                                    <b><i>Sila gunakan imej dengan spesifikasi 1280 x 300</i></b>
                                </div>
                            </div>
                        </div>

                        <br>
                        <br>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Hantar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- End Recent Sales -->
        
        <div class="col-12">
            <div class="card recent-sales">
                <div class="card-body">
                    <div class="profile-overview pt-3">
                        <div class="card-body overflow-auto">
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">IC No.</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($banners) == null)
                                    <tr class="text-center">
                                        <td colspan="8">
                                            <h5>No records found</h5>
                                        </td>
                                    </tr>
                                    @else
                                    @foreach($banners as $bns)
                                    <tr>
                                        <td>{{ $bns->name }}</td>
                                        <td>{{ $bns->ic_no }}</td>
                                        <td>{{ $bns->created_at }}</td>
                                        <td>
                                            <img src='{{Storage::url("$bns->bn_image_path") }}' alt="" title="" style="width:125px;"/>
                                        </td>  
                                        <td>
                                            <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                                                <!----Delete Button----->
                                                <form method="post" onclick="return confirm('Are you sure?')" action="{{ route('bn.banner.delete', $bns->id ) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-danger" >
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
    </div><!-- End Recent Sales -->

{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
    @endsection