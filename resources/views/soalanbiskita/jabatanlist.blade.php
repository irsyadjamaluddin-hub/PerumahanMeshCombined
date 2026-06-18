@extends('layouts.app-all')

@section('title', 'Tanya MOEBN')

@section('content')

  <?php 
    $pagename = "Tanya MOEBN";
  ?>

    <div class="pagetitle">
    <h1>Tanya @MOEBN</h1>
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Tanya @MOEBN</li>  
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

    <!-- ACT Table -->
 
    <div class="col-12">
      <div class="card recent-sales">
        <div class="card-body overflow-auto">

            <table class="table table-borderless datatable mt-3">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Jabatan</th>
                  <th scope="col">Contact.No</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
  
              @if(count($soalanbiskitadepartments) == 0)

                <tr class="text-center">
                    <td colspan="8">
                        <h5>No records found</h5>
                    </td>
                </tr>

              @else

              @foreach($soalanbiskitadepartments as $soalanbiskitadept)
              <tr>
                <td>{{ $soalanbiskitadept->id }}</td>
                <td>{{ $soalanbiskitadept->label }}</td>
                <td>{{ $soalanbiskitadept->contact_no }}</td>
              

                <td>
                <form method="get" action="{{ route('soalanbiskita.soalanbiskita.editdept', $soalanbiskitadept->id ) }}">
                    @csrf
					<button type="submit" class="btn btn-outline-primary">  <i class="bi bi-pencil-fill"></i> </button>
                </form>
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



</section>

@endsection