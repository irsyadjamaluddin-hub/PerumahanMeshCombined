@extends('layouts.app-all')

@section('title', 'Admin Jawatan Kosong')

@section('content')

  <?php
    $pagename = "Admin Jawatan Kosong";
  ?>

    <div class="pagetitle">
      <h1>Jawatan Kosong</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          {{-- <li class="breadcrumb-item">Users</li> --}}
          <li class="breadcrumb-item active">Jawatan Kosong</li>  
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

        <div class="col-md-12" style="text-align: right;">
          <a href="{{ route('jawatankosong.jawatankosong.senaraijawatan') }}" class= "btn btn-primary text-right">
                    Jawatan List
          </a>
   
      </div>

       
         <!-- Jawatan Kosong Table -->
         <div class="col-12">
              <div class="card recent-sales">

                <div class="card-body overflow-auto">
                

                  <table class="table table-borderless datatable mt-3">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Jumlah kekosongan</th>
                        <th scope="col">Date updated</th>
                        <th scope="col">Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>

                    @if(count($jawatankosongs) == 0)

                    <tr class="text-center">
                      <td colspan="8"><h5>No records found</h5></td>
                    </tr>
                          
                    @else

             

                    @foreach($jawatankosongs as $jawatankosong)

                      <tr>
                      <td>{{ $jawatankosong->dept_id }}</td>
                        <td>{{ $jawatankosong->dept_label }}</td>

                        <td>
                            @foreach ($sum as $departmentSum)
                                @if ($departmentSum->dept_id == $jawatankosong->dept_id)
                                    {{ $departmentSum->total_jum_kosong }}
                                @endif
                            @endforeach
                        </td>
                       
                       

  
                

                    @if ($jawatankosong ->date_update==null)
                     <td>  </td>        
                    @else
                    <td> {{ date('d/m/Y', strtotime($jawatankosong->date_update)) }}</td>
                     @endif

                        <td>
                        
                        <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                            <!----Edit Button----->
                            <form method="get" action="{{ route('jawatankosong.jawatankosong.indexdept', $jawatankosong->dept_id ) }}">
                            @csrf
                              <button type="submit" class="btn btn-outline-primary">
                              <i class="bi bi-pencil-fill"></i>
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