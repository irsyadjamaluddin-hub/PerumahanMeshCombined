@extends('layouts.app-all')

@section('title', 'Admin Post UP')

@section('content')

<?php
    $pagename = "PostUP";
  ?>

    <div class="pagetitle">
      <h1>PostUP</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          {{-- <li class="breadcrumb-item">Users</li> --}}
          <li class="breadcrumb-item active">PostUp</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

    <div class="row mb-2">
            <div class="col-md-10">
            </div>  
            <div class="col-md-2" style="text-align:center;">
                <a href={{ route('postup1') }} target="_blank" class= "btn btn-primary">
                    <i class="bi bi-link"></i>
                </a>
                <a href="/assets/img/qrcode/postup.png" target="_blank" class= "btn btn-primary">
                    <i class="bi bi-qr-code"></i>
                </a>
            </div>
        </div>


        <!-- PostUP Index Table -->


            @if(Session::has('success_message'))
            <div class="alert alert-success">
                <i class=" fas fa-fw fa-check"></i>
                {!! session('success_message') !!}


            </div>
            @endif

            <div class="col-12">
                <div class="card recent-sales">



                    <div class="card-body overflow-auto">


                        <table class="table table-borderless datatable mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Subjek</th>
                                    <th scope="col">Rujukan</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">IC No</th>
                                    <th scope="col">Dokumen</th>
                                    <th scope="col">Tarikh</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            
                            
                            @if(count($postups) == null)
                                <tr class="text-center">
                                    <td colspan="8">
                                        <h5>No records found</h5>
                                    </td>
                                </tr>

                            @else
                            @foreach($postups as $postup)   

                                <tr>
                                    
                                    <td>{{ $postup->subjek }}</td>
                                    <td>{{ $postup->rujukan }}</td>
                                    <td>{{ $postup->name }}</td>
                                    <td>{{ $postup->ic_no }}</td>
                                     <td>
        @if ($postup && $postup->file)
            @foreach ($postup->file as $file)
                @php
                    $parts = explode('_', $file);
                    $originalFilename = implode('_', array_slice($parts, 1)); // Remove the unique ID
                @endphp
                <a href="{{ Storage::url($file) }}" target="_blank">
                    <p>{{ $originalFilename }}</p>
                </a>
            @endforeach
        @else
            <!-- Handle the case when $postup is null or $postup->file is null or empty -->
            @if (!$postup)
                <p>No postup found.</p>
            @else
                <p>No files available for this postup.</p>
            @endif
        @endif
    </td>
                               
                                    <td>{{ $postup->created_at }}</td>
                                    
                                    <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                            <!----Delete Button----->
                                            <form method="post" action="{{ route('postup.postup.destroy', $postup->id ) }}">
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
            </div><!-- End Recent Sales -->
        
        



    </section>
@endsection