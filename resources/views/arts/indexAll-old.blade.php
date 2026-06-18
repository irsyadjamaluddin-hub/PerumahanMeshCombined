@extends('layouts.app-all')

@section('title', 'Admin ART')

@section('content')

  <?php
    $pagename = "Admin_ART";
  ?>

    <div class="pagetitle">
      <h1>Antigen Rapid Test</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">ART</li>  
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

        <div class="row mb-2">
            <div class="col-md-10">

                @if (Auth::check())
                    @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
                        <div class="search-bar"><!-- Start Search Bar -->
                            <form class="search-form d-flex align-items-center"  method="POST" action="{{ route('arts.art.search') }}">
                                @csrf
                                <select class="form-control" name="department_id">
                                                    <option>Search by Department</option>
                                                    @foreach ($departments as $key => $value)
                                                        <option value="{{ $key }}"> 
                                                            {{ $value }} 
                                                        </option>
                                                    @endforeach    
                                </select>
                                <button type="submit" class="btn btn-primary" title="Search"><i class="bi bi-search"></i></button>
                            </form>   
                        </div><!-- End Search Bar -->
                    @endif
                @endif

                @if (Auth::check())
                    @if (Auth::user()->hasRole('ROLE_ART_FOCAL'))
                        <div class="search-bar"><!-- Start Search Bar -->
                            <form class="search-form d-flex align-items-center"  method="POST" action="{{ route('arts.art.searchDept') }}">
                                @csrf
                                <input type=text name=search class="form-control" placeholder="Search by Name/ IC Number/ Place(Section/Unit)">
                                <button type="submit" class="btn btn-primary" title="Search"><i class="bi bi-search"></i></button>
                            </form>   
                        </div><!-- End Search Bar -->
                    @endif
                @endif

            </div>  
                <div class="col-md-2">
                    <a href="{{ route('arts.art.createAll') }}" class= "btn btn-primary text-right">
                         Add New ART
                    </a>
                </div>
        </div>

        <div class="row mb-2">
          <span><b>Total Records: {{ $countAll }}</b> | <span class="text-danger"><b>Positive Result/s: {{ $countPositive }}</b></span> | <span class="text-success text-bold"><b>Negative Result/s: {{ $countNegative }}</b></span> </span>
        </div>

         <!-- ART Table -->
         <div class="col-12">
              <div class="card recent-sales">

                <div class="card-body overflow-auto">
                  <!-- <h5 class="card-title">Recent Sales <span>| Today</span></h5> -->

                  <table class="table table-borderless datatable mt-3">
                    <thead>
                      <tr>
                      <th scope="col">Name</th>
                        <th scope="col">IC No.</th>
                        <th scope="col">Department</th>
                        <th scope="col">ART Result</th>
                        <th scope="col">ART Date</th>
                        <th scope="col">Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>

                        @if(count($arts) == 0)

							<tr class="text-center">
								<td colspan="8"><h5>No records found</h5></td>
							</tr>
										
						@else
						@foreach($arts as $art)

                            <tr>
                                <td>{{ $art->name}}</td>
                                <td>{{ $art->ic_no }}</td>
                                <td>{{ optional($art->department)->label }}</td>
                               

                                @if(($art->art_result) == "-ve") 
                                <td><span class="badge bg-success">Negative</span></td>
                                @elseif(($art->art_result) == "+ve") 
                                <td><span class="badge bg-danger">Positive</span></td>
                                  @else
                                  <td><span class="badge bg-warning">Invalid</span></td>
                                @endif

                                <td>{{ date('d/m/Y', strtotime($art->date_test)) }}</td>

                               

                                
                                <td>

                                <div class="btn-group gap-2" role="group" aria-label="Basic example">
 					
                                  <!----Edit Button----->
                                  <form method="get" action="{{ route('arts.art.editAll', $art->emp_art_infos_id ) }}">
                                  @csrf

                                    <button type="submit" class="btn btn-outline-primary" >
                                    <i class="bi bi-pencil-fill"></i>
                                    </button>

                                  </form>


                                  <!----Delete Button----->
                                  <form method="post" action="{{ route('arts.art.destroyAll', $art->emp_art_infos_id ) }}">
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

        </div>


    </section>
@endsection