@extends('layouts.app-all')

@section('title', 'Cuti')

@section('content')

  <?php
    $pagename = "Cuti";
  ?>

    <div class="pagetitle">
      <h1>Cuti</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          {{-- <li class="breadcrumb-item">Users</li> --}}
          <li class="breadcrumb-item active">Cuti</li>  
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
                        <th scope="col">Jabatan</th>
                        <th scope="col">Tarikh Mula Cuti</th>
                        <th scope="col">Tarikh Akhir Cuti</th>
                        <th scope="col">Jenis Cuti</th>
                        <th scope="col">Tempoh Cuti</th>
                        <th scope="col">Catatan</th>
                      
                        
                      </tr>
                    </thead>
                    <tbody>

                    @if(count($cutis) == 0)

                    <tr class="text-center">
                      <td colspan="8"><h5>No records found</h5></td>
                    </tr>
                          
                    @else
                        @foreach($cutis as $cuti)

                      <tr>
                        <td>{{ $cuti->name }}</td>
                        <td>{{ $cuti->ic_no }}</td>
                        
                        <td>{{ $cuti->department}}</td>

                        @if ($cuti ->start_date_cuti==null)
                          <td>  </td>
                        @else
                          <td> {{ date('d/m/Y', strtotime($cuti->start_date_cuti)) }}</td>
                        @endif
   
   
                        @if ($cuti ->end_date_cuti==null)
                            <td>  </td>        
                        @else
                            <td>{{ date('d/m/Y', strtotime($cuti->end_date_cuti)) }}</td>
                        @endif

                        <td>{{ optional($cuti->jeniscuti)->label }}</td>
                        <td> @php $numberofCutiDays = (\Carbon\Carbon::parse($cuti->end_date_cuti)->addDay(1)->diff(\Carbon\Carbon::parse($cuti->start_date_cuti))->format('%a')); @endphp
                        {{ $numberofCutiDays }} Days/s </td>
                        <td>{{ $cuti->catatan}}</td>

                   
                       
                                                  
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