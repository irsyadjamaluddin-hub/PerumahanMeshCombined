@extends('layouts.app-all')

@section('title', 'Feedback')

@section('content')

  <?php 
    $pagename = "Feedback";
  ?>

    <div class="pagetitle">
      <h1>Feedback</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Feedback</li>  
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
                        <th scope="col">Date</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Action</th>
                        
                        
                    
                        
                      </tr>
                    </thead>
                    <tbody>

                    @if(count($feedbacks) == 0)

                    <tr class="text-center">
                      <td colspan="8"><h5>No records found</h5></td>
                    </tr>
                          
                    @else
                    @foreach($feedbacks as $feedback)

                         <tr>
                        <td>{{ $feedback->created_at }}</td>
                        <td>{{ $feedback->jenis }}</td>
                        <td>{{ $feedback->catatan }}</td>
                        <td>{{ $feedback->nama }}</td>
                        <td>{{ $feedback->contact }}</td>
                      <td>

                      <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----show Button----->
                                        <form method="get" action="{{ route('feedbacks.feedback.showadmin', $feedback->id ) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>

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

        </div>


    </section>
@endsection