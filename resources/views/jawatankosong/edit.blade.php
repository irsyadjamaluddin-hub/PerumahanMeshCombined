@extends('layouts.app-all')

@section('title', 'Edit Jawatan Kosong')

@section('content')

    <?php
        $pagename = "Edit Admin Jawatan Kosong";
    ?>

    <div class="pagetitle">
      <h1>Jawatan Kosong</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Edit Admin Jawatan Kosong</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <div class="row mb-2">

            <div class="col-md-11">

                          

            </div>  

                <div class="col-md-1">
                <a href="{{ back()->getTargetUrl() }}" class="btn btn-primary mb-2">
                    <i class="bi bi-arrow-left-circle"></i>
                </a>
                </div>
        </div>

         <!-- Edit Admin Jk Table -->
         <div class="col-12">
              <div class="card recent-sales">

             

                <div class="card-body">

                    <div class="profile-overview pt-3">

                        

                        <h3 class="card-title">Edit Admin Jawatan Kosong</h3>

                        <form class="" method="post" action="{{ route('jawatankosong.jawatankosong.update') }}" enctype="multipart/form-data"> 
                        @csrf

                          @foreach ($jawatankosongs as $jawatankosong)

                        <input type="text" name="id" class="bg-gray-200 form-control " value="{{$jawatankosong->id}}" hidden>

                        <!--  in order the data updated on the indexdept this is needed -->
                        <input type="text" name="dept_id" class="bg-gray-200 form-control " value="{{$jawatankosong->dept_id}}" hidden>
                       

                          <div class="row">
                            <div class="col-lg-4 col-md-3  label">Jawatan</div>
                            <div class="col-lg-8 col-md-9">
                              <input type="text" name="jawatan" class="bg-gray-200 form-control " value="{{$jawatankosong->jawatan}}" readonly>
                                {!! $errors->first('jawatan', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>

            

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Tanggagaji</div>
                            <div class="col-lg-8 col-md-9">
                                <select class="form-select" name="tanggagaji">
                                    <option value="{{ $jawatankosong->tanggagaji }}">{{ optional($jawatankosong->tanggagaji)->label }}</option>
                                    @foreach ($tanggagaji as $key => $value)
                                        <option value="{{ $key }}"> 
                                            {{ $value }} 
                                        </option>
                                    @endforeach    
                                </select>
                                {!! $errors->first('tanggagaji', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Bahagian</div>
                            <div class="col-lg-8 col-md-9">
                                <select class="form-select" name="bhg">
                                    <option value="{{ $jawatankosong->bhg }}">{{ optional($jawatankosong->bahagian)->label }}</option>
                                    @foreach ($bahagian as $key => $value)
                                        <option value="{{ $key }}"> 
                                            {{ $value }} 
                                        </option>
                                    @endforeach    
                                </select>
                                {!! $errors->first('tanggagaji', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Jumlah Kekosongan</div>
                            <div class="col-lg-8 col-md-9">
                                <input type="number"  name="jum_kosong" class="form-control" value="{{$jawatankosong->jum_kosong}}">
                                {!! $errors->first('jum_kosong', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-3  label">Catatan</div>
                            <div class="col-lg-8 col-md-9">
                                <textarea name="catatan" class="form-control" value="{{$jawatankosong->catatan}}"> </textarea>
                                {!! $errors->first('catatan', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>

                      @endforeach


                            
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


    </section>
@endsection