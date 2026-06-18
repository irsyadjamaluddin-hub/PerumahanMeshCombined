@extends('layouts.app-all')

@section('title', 'Candidates')

@section('content')


<?php
$pagename = "Candidates";
?>

<div class="pagetitle">
    <h1>Candidates</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Candidates</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row mb-2">
      <div class="col-md-10">
          <a href="{{ route('attendance.export.excel', ['id' => $events->id]) }}" class="btn btn-success">Export Excel</a>
      </div>
      <div class="col-md-2" style="text-align:center;">
      </div>
  </div>

  @if(Session::has('success_message'))
  <div class="alert alert-success">
    <i class=" fas fa-fw fa-check"></i>
    {!! session('success_message') !!}
  </div>
  @endif

  <br>

  <form action="{{ route('attendance.attendances.searchchosen') }}" method="GET">
    <div class="flex justify-between mb-3 rounded-lg overflow-hidden">
      <input type="text" name="query" id="term" placeholder="Search Sekolah/Institusi / Nama / ICNo./SKBNo./ Pelajar/Pengawas" class="w-full px-10 focus:outline-none">

      <input type="text" name="event" value="{{$events->id}}"hidden>

      <button type="submit" class="p-3 bg-blue-500 hover:bg-blue-600" style="transition: 0.4s;">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </button>
    </div>
  </form>




  <div class="col-md-12">
    <div class="row">
      <div class="col-12" >
        <a href="{{ route('attendance.attendances.formchosen', $events->id) }}" class="btn btn-primary ml-md-3">Add Candidates</a>
      </div>
    </div>

    <br>

    <div class="col-12">
      <div class="card recent-sales">
        <br>
        <div class="card-body overflow-auto">
          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #A88905;">Candidates</h5>
          <table class="table table-borderless datatable mt-3">                         
            <thead>
              <tr>
                <th scope="col">Name</th> 
                <th scope="col">IC/Birth Cert</th>
                <th scope="col">Year</th>
                <th scope="col">School Name</th>
                <th scope="col">District</th>
                <th scope="col">Category</th>
                <th scope="col" style="text-align: center">Action</th>
                <th scope="col">Created At</th>
              </tr>
            </thead>
            <tbody>
              @if(isset($attenduser) == 0)
                <tr class="text-center">
                  <td colspan="8">
                    <h5>No Selected Candidates for this event</h5>
                  </td>
                </tr>
              @else
              @foreach($attenduser as $attendusers)
                <tr>                                   
                  <td>{{ $attendusers->name }}</td>
                  @if($attendusers->ic_no != null)
                    <td>{{ $attendusers->ic_no }}</td>
                  @else
                    <td>{{ $attendusers->birth_cert }}</td>
                  @endif
                  <td>{{ $attendusers->year }}</td> 
                  <td>{{ $attendusers->school }}</td>                           
                  <td>{{ $attendusers->district }}</td>
                  <td>{{ $attendusers->category }}</td>
                  <td style="text-align: center">
                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                     
                      <!----Event Button----->
                      @if($attendusers->hadir == "Ya")
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-square"> {{ $attendusers->hadir_by }}</i>
                        </button>
                      @else
                      <form method="post" action="{{ route('attendance.attendances.hadirupdate') }}"  enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" value="{{ $attendusers->id }}" class="form-control" hidden>
                        
                        <button type="submit" class="btn btn-outline-success">
                            <i class="bi bi-check-square"></i>
                        </button>
                      </form>
                      @endif

                      <!----Edit Button----->
                      <form method="get" action="{{ route('attendance.attendances.editchosen', $attendusers->id ) }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">
                          <i class="bi bi-pencil-fill"></i>
                        </button>
                      </form>

                      <!----Delete Button----->
                      <form method="post" onclick="return confirm('Are you sure?')" action="{{ route('attendance.attendances.destroychosen', $attendusers->id ) }}">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-outline-danger" >
                              <i class="bi bi-trash-fill"></i>
                          </button>
                      </form>
                      
                    </div> 
                  </td>
                  <td>{{ $attendusers->created_at }}</td>
                </tr>
              @endforeach
              @endif             
            </tbody>
          </table>
          @if (!empty($attenduser))
            {{ $attenduser->links() }}
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

   