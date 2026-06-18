@extends('layouts.app-all')

@section('title', 'DIS')

@section('content')

<?php
$pagename = "DIS";
?>

<div class="pagetitle">
  <h1>MoeCorrespondence</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">MEC</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<style>                
.dataTable-info{
    color: white;
}
</style>

<section class="section profile">

  <div class="col-md-12">

    @if(Session::has('success_message'))
    <div class="alert alert-success">
      <i class=" fas fa-fw fa-check"></i>
      {!! session('success_message') !!}


    </div>
    @endif

    <div class="row mb-2">
      <div class="col-md-11">


      </div>

      <div class="col-md-1">
      <a href="{{ route('dispatchs.dis.createmec') }}" class="btn btn-primary text-right mb-2">
    <i class="bi bi-arrow-right-circle"></i>
  </a>

    <!-- Mec form -->
    <div class="card">
            <div class="card-body">
              <h5 class="card-title">DICT</h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">IC</th>
                    <th scope="col">Email</th>
                    <th scope="col">Kod</th>
                    <th scope="col">Action</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Haji</td>
                    <td>01-098798</td>
                    <td>Test@gmil.com</td>
                    <td>adc123</td>
                    <td>
                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                    <!----Edit Button----->
                    <form method="get" action="{{ route('dispatchs.dis.editmec', $dispatch->dispatch_infos_id ) }}">
                      @csrf

                      <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-pencil-fill"></i>
                      </button>

                    </form>

                      <!----Delete Button----->
                      <form method="post" action="{{ route('dispatchs.dis.index', $dispatch->dispatch_infos_id ) }}">
                      @csrf

                      @method('delete')

                      <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash-fill"></i>
                      </button>

                    </form>

                  </div>

                    
                </td>
                    
                  </tr>
                  
                </tbody>
              </table>
              <!-- End Table with hoverable rows -->

            </div>
          </div>

  </div>


  @endsection

  