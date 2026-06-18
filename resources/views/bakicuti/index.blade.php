@extends('layouts.app-all')

@section('title', 'Baki Cuti Index')

@section('content')

<?php
    $pagename = "Baki Cuti";
  ?>

    <div class="pagetitle">
      <h1>Baki Cuti</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Baki Cuti</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <!--  Index Table -->
        @if(Session::has('success_message'))
        <div class="alert alert-success">
            <i class=" fas fa-fw fa-check"></i>
            {!! session('success_message') !!}
        </div>
        @endif
           
        <!-- Form button -->
        <div class="card-body d-flex justify-content-end" style="padding: 5px;">
            <a type="button" class="btn btn-primary" href="{{ route('bakicuti.bakicutis.form') }}"><i class="bi bi-plus"></i></a>
        </div>

        <div class="card mt-3">
            <div class="card-body pt-3">               
                <table class="table table-borderless datatable mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">No. Kad Pengenalan</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>            
                        @if(count($bc) == null)
                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>

                        @else
                        @foreach($bc as $bcs)   

                            <tr>
                                <td>{{ $bcs->name }}</td>
                                <td>{{ $bcs->ic_no }}</td>
                                <td>{{ $bcs->department }}</td>
                                <td>
                                    @if($bcs->status == 'Submitted')
                                        <span class="badge bg-primary">{{$bcs->status}}</span>
                                    @elseif($bcs->status == 'Selesai')
                                        <span class="badge bg-success">{{$bcs->status}}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                    <!----Edit Button----->
                                    <form method="get" action="{{ route('bakicuti.bakicutis.view', $bcs->id ) }}">
                                        @csrf

                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>

                                    </form>

                                        <!----Delete Button----->
                                        <form method="post" action="{{ route('bakicuti.bakicutis.destroy', $bcs->id ) }}">
                                            @csrf
                                            @method('delete')
                                            <a onclick='return confirm("Confirm to delete data?")'>
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
    </section>
@endsection