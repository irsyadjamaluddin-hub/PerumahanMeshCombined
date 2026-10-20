@extends('layouts.app-all')

@section('title', 'Perkhidmatan Sesi Soal Jawab')

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" sections; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
<div class="mesh-home-theme">
{{-- #================================ --}}

<?php
$pagename = "Soalan Yang Diajukan";
?>

<div class="pagetitle">
    <h1>Perkhidmatan Sesi Soal Jawab</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Perkhidmatan Sesi Soal Jawab</li>
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

        <div class="row mb-2">
            <div class="col-md-10">
            </div>  
            <div class="col-md-2" style="text-align:center;">
                <a href="http://127.0.0.1:8000/Q&A" target="_blank" class= "btn btn-primary">
                    <i class="bi bi-link"></i>
                </a>
                <a href="/assets/img/qrcode/SoalanAjukan.jpg" target="_blank" class= "btn btn-primary">
                    <i class="bi bi-qr-code"></i>
                </a>
            </div>
        </div>

        <div class="col-12">
            <div class="card recent-sales">
                <div class="card-body overflow-auto">
                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Perkara</th>
                                <th scope="col">Tarikh</th>
                                <th scope="col">Soalan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @if(count($soalantaklimat) == null)
                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>
                        @else
                         @foreach($soalantaklimat as $st)   
                            <tr>                                
                                <td>{{ $st->perkara }}</td>
                                <td>{{ $st->tarikh_st }}</td>
                                <td>{{ $st->soalan }}</td>
                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----View Button----->
                                        <form method="get" action="{{ route('st.soalantaklimat.showadmin',  $st->id)}}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- <div class="btn-group gap-2" role="group" aria-label="Basic example"> -->	
                                        <!----Delete Button----->
                                        <!-- <form method="post" onclick="return confirm('Are you sure?')" action="{{ route('st.soalantaklimat.destroy', $st->id ) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger" >
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div> -->
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    
                </div>

            </div>
        </div><!-- End Recent Sales -->

        
<div class="col-12">

<div class="card recent-sales">

  <div class="card-body">

    <div class="profile-overview pt-3">
        <h5 class="card-title">Perkara Baru</h5>
        <form class="" method="post" action="{{ route('st.soalantaklimat.storeperkara') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-lg-1 col-form-label">Perkara:</label>
                <div class="col-lg-6">
                    <input type="text" name="perkara" class="form-control" placeholder="Perkara">
                        {!! $errors->first('nama', '<p class="help-block text-danger">:message</p>')!!}
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-outline-success" >
                       Update
                    </button>
                </div>
            </div>
        </form>

        <div class="card-body overflow-auto">


                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Perkara</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                           
                        
                        @if(count($perkara_st) == null)
                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>

                        @else
                         @foreach($perkara_st as $pst)   

                            <tr>
                                
                                <td>{{ $pst->perkara }}</td>
                                <td>{{ $pst->created_at }}</td>
                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                                        <!----Delete Button----->
                                        <form method="post" onclick="return confirm('Are you sure?')" action="{{ route('pst.soalantaklimat.destroy', $pst->id ) }}">
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