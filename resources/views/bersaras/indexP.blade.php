@extends('layouts.app-all')

@section('title', 'Bersara')

@section('content')

  <?php 
    $pagename = "Bersara";
  ?>

    <div class="pagetitle">
      <h1>Bersara</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Bersara</li>  
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
                        <th scope="col">Jawatan Bersara</th>
                        <th scope="col">Penamatan</th>
                        <th scope="col">Peruntukan Bersara</th>
                        <th scope="col">Tarikh Mula Cuti Bersara</th>
                        <th scope="col">Tarikh Berakhir Cuti Bersara</th>
                        <th scope="col">Tarikh Penamatan</th>
                        <th scope="col">Ulasan</th>
                        
                    
                        
                      </tr>
                    </thead>
                    <tbody>

                    @if(count($bersaras) == 0)

                    <tr class="text-center">
                      <td colspan="8"><h5>No records found</h5></td>
                    </tr>
                          
                    @else
                    @foreach($bersaras as $bersara)

                         <tr>
                        <td>{{ $bersara->name }}</td>
                        <td>{{ $bersara->ic_no }}</td>
                        <td>{{ $bersara->bersara_post }}</td>
                        {{-- <td>{{ optional($bersara->retirementposition)->label }}</td> --}}
                        <td>{{ optional($bersara->terminationtype)->label }}</td>
                        <td>{{ optional($bersara->retirementposition1)->label }}</td>
                        @if ($bersara ->date_cuti_bersara==null)
                            <td>  </td>        
                            @else
                            
                            <td>{{ date('d/m/Y', strtotime($bersara->date_cuti_bersara)) }}</td>
                        @endif


                        @if ($bersara ->end_date_bersara==null)
                        <td>  </td>        
                        @else
                        <td>{{ date('d/m/Y', strtotime($bersara->end_date_bersara)) }}</td>
                        @endif


                        @if ($bersara ->date_bersara==null)
                        <td>  </td>        
                        @else
                          <td>{{ date('d/m/Y', strtotime($bersara->date_bersara)) }}</td>
                          @endif
                        <td>{{ $bersara->ulasan}}</td>
                                                  
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