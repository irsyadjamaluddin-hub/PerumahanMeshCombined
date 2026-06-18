@extends('layouts.app-all')

@section('title', 'Memangku')

@section('content')

  <?php
    $pagename = "Memangku";
  ?>

    <div class="pagetitle">
      <h1>Memangku</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Memangku</li>  
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
                  <!-- <h5 class="card-title">Recent Sales <span>| Today</span></h5> -->

                  <table class="table table-borderless datatable mt-3">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">IC No.</th>
                        <th scope="col">Jawatan yang dipangku</th>
                        <th scope="col">Tanggagaji yang dipangku</th>
                        <th scope="col">Tarikh Mula Memangku</th>
                        <th scope="col">Tarikh Akhir Memangku</th>
                        <th scope="col">Sebab Memangku</th>
                        <th scope="col">Tempoh Memangku</th>
                        <th scope="col">Dokumen</th>
                    
                        
                      </tr>
                    </thead>
                    <tbody>

                    @if(count($acts) == 0)

                    <tr class="text-center">
                      <td colspan="8"><h5>No records found</h5></td>
                    </tr>
                          
                    @else
                    @foreach($acts as $act)

                      <tr>
                        <td>{{ $act->name }}</td>
                        <td>{{ $act->ic_no }}</td>
                        <td>{{ $act->acting_post }}</td>
                        <td>{{ optional($act->salaryScale)->label }}</td>
                        <td>{{ date('d/m/Y', strtotime($act->acting_start_date)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($act->acting_end_date)) }}</td>
                        <td>{{ optional($act->reasonActing)->label }}</td>
                        <td>@php $numberofDays = (\Carbon\Carbon::parse($act->acting_end_date)->addDay(1)->diff(\Carbon\Carbon::parse($act->acting_start_date))->format('%a')); @endphp
                          {{ $numberofDays}} Day/s</td>
                        <td>
                          @if($act->acting_file != '')
                            <a href='{{Storage::url("$act->acting_file") }}' target="_blank">View</a>
                          @else
                            <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                                <!----Edit Button----->
                                <form method="get" action="{{ route('actings.acting.editP', $act->id ) }}">
                                @csrf
                                  <button type="submit" class="btn btn-primary">
                                  <i class="bi bi-box-arrow-in-down"></i>
                                  </button>
                                </form>
                            </div>
                          @endif


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