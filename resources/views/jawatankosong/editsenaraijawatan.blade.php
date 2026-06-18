@extends('layouts.app-all')

@section('title', 'Edit Jawatan Kosong')

@section('content')

<?php 
    $pagename = "Edit Jawatan Kosong";
  ?>

    <div class="pagetitle">
        <h1>Edit Jawatan Kosong</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Edit Jawatan Kosong</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!----- Back out Button  ----->
    <div class="col-md-1 text-left">
    <a href="{{ route('jawatankosong.jawatankosong.senaraijawatan') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem;">
    <i class="bi bi-arrow-left-circle"></i>
    </a>
    </div> 

    <section class="section profile">

        <div class="col-md-12">

            <div class="card recent-sales">

                <div class="card-body">
                    <br>
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Edit Jawatan</h5>
                    <br>
                    <form method="post"
                        action="{{ route('jawatankosong.jawatankosong.updatesenaraijawatan', $jawatanlist->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label class="col-lg-1 col-form-label">Jawatan</label>
                            <div class="col-lg-4">
                                <input type="text" name="label" class="form-control" placeholder="Nama Jawatan"
                                    value="{{ $jawatanlist->label }}">
                            </div>
                        
                        </div>

                        <div class="row mb-3">
                        <label class="col-lg-1 col-form-label">Tanggagaji</label>
                            <div class="col-lg-3">
                                <input type="text" name="tanggagaji" class="form-control"
                                    placeholder="Tanggagaji" value="{{ $jawatanlist->tanggagaji }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                        <div class="col-lg-3">
                                <button type="submit" class="btn btn-outline-success">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </section>

@endsection
