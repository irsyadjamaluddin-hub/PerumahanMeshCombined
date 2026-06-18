@extends('layouts.app-all')

@section('title', 'Create MEC')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?php
$pagename = "MEC";
?>

<div class="pagetitle">
    <h1>MoeDispatch</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">MEC</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">


    <a href="{{ route('dispatchs.dis.indextindakan') }}" class="btn btn-primary text-right mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>


    <!-- QO Table -->
    <div class="col-12">
        <div class="card recent-sales">



            <div class="card-body">

                <div class="profile-overview pt-3">



                    <form class="" method="post" action="{{ route('dispatchs.dis.storemec') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <br>


                        <div class="col profile-overview"
                            style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                            <h3 class="card-title" style="padding: 0px;">MEC</i></h3>
                            <hr>
                            <br>

                            <div class="col-lg-12 overflow-auto">
                                <table class="table table-bordered">

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
                                            <select class="form-select" name="daripada"
                                                aria-label="Default select example">
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
                                                name="kpd">
                                                <option></option>
                                                @foreach ($kepada as $key => $value)
                                                <option value="{{ $key }}">
                                                    {{ $value }}
                                                </option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('kepada', '<p class="help-block text-danger">:message</p>
                                            ') !!}
                                        </div>
                                    </div>


                                    <div class="row">
                                        <label for="inputText" class="col-lg-4 col-md-3  label">Untuk Perhatian </label>
                                        <div class="col-lg-7 col-md-9">
                                            <input type="text" name="up" class="form-control">
                                        </div>

                                        <!-- add ppl button -->
                                        <div class="col-lg-1 col-md-1">
                                            <!-- <button type="button" class="btn btn-primary " id="addbtn" href="{{ route('dispatchs.dis.mecuser') }}">
                                <i class="ri-user-add-fill"></i>
                                </button> -->
                                            <a href="{{ route('dispatchs.dis.mecuser') }}"
                                                class="btn btn-primary text-right mb-2">
                                                <i class="bi bi-plus-lg"></i>
                                            </a>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <label for="inputText" class="col-lg-4 col-md-3  label">Perkara</label>
                                        <div class="col-lg-8 col-md-9">
                                            <input type="text" name="perkara" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label for="inputText" class="col-lg-4 col-md-3  label">Rujukan
                                            Persuratan</label>
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
                                        <label for="inputNumber" class="col-lg-4 col-md-3  label">Muat Naik
                                            Dokumen</label>
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
                            </table>
                        </div>

                </div>

                <br>

                <!-- second box -->

                <div class="col profile-overview"
                    style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h3 class="card-title" style="padding: 0px;">Admin</i></h3>
                    <hr>
                    <br>

                    <!-- <div class="row">
            <div class="col-lg-4 col-md-3  label">Tarikh Menerima <br></div>
            <div class="col-lg-8 col-md-9">
              <input type="text" name="dispatch_recieved_at" class="bg-gray-200 form-control" readonly>
              {!! $errors->first('dispatch_recieved_at', '<p class="help-block text-danger">:message</p>') !!}
            </div>
          </div> -->


                    <div class="row">
                        <div class="col-lg-4 col-md-3  label">Tarikh Memproses</div>
                        <div class="col-lg-8 col-md-9">
                            <input type="date" name="date_process" class="form-control">
                            {!! $errors->first('date_process', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-3  label">Tarikh Tutup</div>
                        <div class="col-lg-8 col-md-9">
                            <input type="date" name="date_close" class="form-control">
                            {!! $errors->first('date_close', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                    </div>


                    <div class="row">
                        <label for="inputNumber" class="col-lg-4 col-md-3  label">Muat Naik Dokumen</label>
                        <div class="col-lg-8 col-md-9">
                            <input type="file" name="lamp" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <label for="inputText" class="col-lg-4 col-md-3  label">No. Rujukan</label>
                        <div class="col-lg-8 col-md-9">
                            <input type="text" name="no_folio" class="form-control">
                        </div>
                    </div>


                    <div class="row">
                        <label for="inputText" class="col-lg-4 col-md-3  label">Catatan</label>
                        <div class="col-lg-8 col-md-9">
                            <textarea class="form-control" name="catatan_admin" placeholder="Sebarang Ulasan"
                                id="floatingTextarea" style="height: 100px;"></textarea>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-4 col-md-3  label">Tindakan <br> <i></i> </div>
                        <div class="col-lg-8 col-md-9">
                            <select class="form-select" name="tindakan">
                                <option></option>
                                @foreach ($tindakan as $key => $value)
                                <option value="{{ $key }}">
                                    {{ $value }}
                                </option>
                                @endforeach
                            </select>
                            {!! $errors->first('tindakan', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                    </div>


                </div>




                <!-- take hidden ic_no so that easy to identify data belong/from who -->

                <input type="text" name="ic_no" class="bg-gray-200 form-control" value="{{Auth::user()->ic_no}}" hidden>

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