@extends('layouts.app-all')

@section('title', 'Create MED')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?php
$pagename = "MED";
?>

<div class="pagetitle">
    <h1>MoeDispatch</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">MED</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">


    <a href="{{ route('dispatchs.dis.index') }}" class="btn btn-primary text-right mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>


    <!-- QO Table -->
    <div class="col-12">
        <div class="card recent-sales">



            <div class="card-body">

                <div class="profile-overview pt-3">



                    <form class="" method="post" action="{{ route('dispatchs.dis.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <br>


                        <div class="col profile-overview"
                            style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                            <h3 class="card-title" style="padding: 0px;">MOE-Dispatch</i></h3>
                            <hr>
                            <br>

                            <div class="row">
                                <label class="col-lg-4 col-md-3  label">Jenis</label>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="jns" aria-label="Default select example">
                                        <option></option>
                                        @foreach ($jenis as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>



                            <div class="row">
                                <label class="col-lg-4 col-md-3  label">Daripada <br> <i></i></label>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="daripada" aria-label="Default select example">
                                        <option></option>
                                        @foreach ($kepada as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-lg-4 col-md-3  label">Kepada <br> <i></i> </div>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select js-example-basic-multiple" multiple="multiple"
                                        name="kpd[]">
                                        <option></option>
                                        @foreach ($kepada as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('kpd', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>




                            <div class="row">
                                <label for="inputText" class="col-lg-4 col-md-3  label">Untuk Perhatian </label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="up" class="form-control">
                                </div>
                            </div>




                            <div class="row">
                                <label for="inputText" class="col-lg-4 col-md-3  label">Perkara</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="perkara" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-4 col-md-3  label">Rujukan Persuratan</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="rp" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputText" class="col-lg-4 col-md-3  label">Rujukan Pejabat Yang
                                    Menghadapkan</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" name="rm" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="inputNumber" class="col-lg-4 col-md-3  label">Muat Naik Dokumen</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="file" name="lamp" class="form-control">
                                </div>

                            </div>



                            <div class="row">
                                <label for="inputText" class="col-lg-4 col-md-3  label">Catatan</label>
                                <div class="col-lg-8 col-md-9">
                                    <textarea class="form-control" name="catt" placeholder="Sebarang Ulasan"
                                        id="floatingTextarea" style="height: 100px;"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- take hidden ic_no so that easy to identify data belong/from who -->

                        <input type="text" name="ic_no" class="bg-gray-200 form-control" value="{{Auth::user()->ic_no}}"
                            hidden>

                        <br>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>


                </div>

            </div>


        </div>

    </div>
    </div><!-- End Recent Sales -->

    </div>

    <script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    </script>


</section>
@endsection