@extends('layouts.app-all')

@section('title', 'Student List')

@section('content')


<?php
$pagename = "Data_kehadiran";
?>

<div class="pagetitle">
    <h1>Student List</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Student List</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

  @if(Session::has('success_message'))
  <div class="alert alert-success">
    <i class=" fas fa-fw fa-check"></i>
    {!! session('success_message') !!}
  </div>
  @endif

  <br>

  <form action="{{ route('attendance.attendances.searchstudent') }}" method="GET">
    <div class="flex justify-between mb-3 rounded-lg overflow-hidden">
      <input type="text" name="query" id="term" placeholder="Search Sekolah/Institusi / Nama / ICNo./SKBNo./ Pelajar/Pengawas" class="w-full px-10 focus:outline-none">

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
        <a href="{{ route('attendance.attendances.formstudent') }}" class="btn btn-primary ml-md-3">Add Student</a>
      </div>
    </div>

    <br>

    <div class="col-12">
      <div class="card recent-sales">
        <br>
        <div class="card-body overflow-auto">
          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #A88905;">Student List</h5>
          <table class="table table-borderless datatable mt-3">                         
            <thead>
              <tr>
                <th scope="col">Name</th> 
                <th scope="col">IC/Birth Cert</th>
                <th scope="col">Year</th>
                <th scope="col">School Name</th>
                <th scope="col">District</th>
                <th scope="col" style="text-align: center">Action</th>
                <th scope="col">Created At</th>
              </tr>
            </thead>
            <tbody>
              @if(isset($attendst) == 0)
                <tr class="text-center">
                  <td colspan="8">
                    <h5>No records found</h5>
                  </td>
                </tr>
              @else
              @foreach($attendst as $attendsts)
                <tr>                                   
                  <td>{{ $attendsts->name }}</td>
                  @if($attendsts->ic_no != null)
                    <td>{{ $attendsts->ic_no }}</td>
                  @else
                    <td>{{ $attendsts->birth_cert }}</td>
                  @endif
                  <td>{{ $attendsts->year }}</td> 
                  <td>{{ $attendsts->school }}</td>                           
                  <td>{{ $attendsts->district }}</td> 
                  <td style="text-align: center">
                    <div class="btn-group gap-2" role="group" aria-label="Basic example">

                      <!----Edit Button----->
                      <form method="get" action="{{ route('attendance.attendances.editstudent', $attendsts->id ) }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">
                          <i class="bi bi-pencil-fill"></i>
                        </button>
                      </form>

                      <!----Delete Button----->
                      <form method="post" onclick="return confirm('Are you sure?')" action="{{ route('attendance.attendances.destroystudent', $attendsts->id ) }}">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-outline-danger" >
                              <i class="bi bi-trash-fill"></i>
                          </button>
                      </form>
                      
                    </div> 
                  </td>
                  <td>{{ $attendsts->created_at }}</td>
                </tr>
              @endforeach
              @endif             
            </tbody>
          </table>
          @if (!empty($attendst))
            {{ $attendst->links() }}
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

   