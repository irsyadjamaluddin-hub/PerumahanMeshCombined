@extends('layouts.app-all')

@section('title', 'Department Jawatan Kosong')

@section('content')

  <?php
    $pagename = "Department Jawatan Kosong";
  ?>

    <div class="pagetitle">
      <h1>Department Jawatan Kosong</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          {{-- <li class="breadcrumb-item">Users</li> --}}
          <li class="breadcrumb-item active"> Department Jawatan Kosong</li>  
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
        

        <div class="col-md-2">
                <a href="{{ route('jawatankosong.jawatankosong.createadmin', ['id' => $id]) }}" class="btn btn-primary text-right">
                        Add New
                </a>
        </div>

        
        </div>
    

       
         <!-- dept Jawatan Kosong Table -->
         <div class="col-12">
              <div class="card recent-sales">

                <div class="card-body overflow-auto">
                

                  <table class="table table-borderless datatable mt-3">
                    <thead>
                      <tr>
                        <th scope="col">Jawatan</th>
                        <th scope="col">Tanggagajii</th>
                        <th scope="col">Bahagian</th>
                        <th scope="col">Jumlah Kekosongan</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>

                    @if(count($jawatankosongdept) == 0)

                    <tr class="text-center">
                      <td colspan="8"><h5>No records found</h5></td>
                    </tr>
                          
                    @else
                    @foreach($jawatankosongdept as $jawatankosongdept)
                      <tr>
                        <td>{{ optional($jawatankosongdept->Jawatan)->label}}</td>
                        <td>{{ optional($jawatankosongdept->Jawatan)->tanggagaji}}</td>
                        <td>{{ optional($jawatankosongdept->bahagian)->label }}</td>
                        <td>{{ $jawatankosongdept->jum_kosong }}</td>
                        <td>{{ $jawatankosongdept->catatan }}</td>
                        <!-- @if ($jawatankosongdept ->created_at==null)
                         <td>  </td>        
                          @else
                          <td> {{ date('d/m/Y', strtotime($jawatankosongdept->created_at)) }}</td>
                        @endif -->

                    
                        <td>{{ $jawatankosongdept->status }}</td>

                        <td>
                         
                         <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                             <!----Edit Button----->
                             <form method="get" action="{{ route('jawatankosong.jawatankosong.editdept', $jawatankosongdept->id ) }}">
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