@extends('layouts.app-all')

@section('title', 'Admin List Schools / Institutions')

@section('content')

  <?php
    $pagename = "Admin List Schools / Institutions";
  ?>

    <div class="pagetitle">
      <h1>Admin List Schools / Institutions</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          {{-- <li class="breadcrumb-item">Users</li> --}}
          <li class="breadcrumb-item active">Admin List Schools / Institutions</li>  
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

       

    
         <!-- Table -->
         <div class="col-12">
	<div class="row justify-content-end">
    <div class="col-md-6 text-md-right">
        <a href="{{ route('exportschoolstat.excel') }}" class="btn btn-success">Export Excel</a>
    </div>
</div>

	<br>

              <div class="card recent-sales">

                <div class="card-body overflow-auto">
                

                  <table class="table table-borderless datatable mt-3">
                    <thead>
                      <tr>
                        
                        <th scope="col">Sekolah / Institusi </th>
                        <th scope="col">Jumlah Hadir </th>

                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>

                    @if(count($dkschools) == 0)

                    <tr class="text-center">
                      <td colspan="8"><h5>No records found</h5></td>
                    </tr>
                          
                    @else

             

                    @foreach($dkschools as $dkschool)

                      <tr>
                        <td>{{ $dkschool->schools }}</td>
                        
                        <td>
                            <?php
                                $dataKehadiranCount = App\Models\Datakehadiran::where('sekolah_institusi', $dkschool->schools)
                                    ->where('hadir', 1)
                                    ->count();
                                echo $dataKehadiranCount;
                            ?>
                        </td>

                        

                        <td>  @php
                                    $status = 'completed';
                                    $dataKehadiran = App\Models\Datakehadiran::where('sekolah_institusi', $dkschool->schools)
                                        ->where(function($query) {
                                            $query->whereNull('icno_skbno')
                                                  ->orWhere('icno_skbno', '')
                                                  ->orWhereNull('hadir')
                                                  ->orWhere('hadir', '');
                                        })
                                        
                                        ->exists();
                                    if ($dataKehadiran) {
                                        $status = 'in-progress';
                                    }
                                    echo '<span class="badge rounded-pill ';
								        if ($status === 'completed') {
								            echo 'bg-success';
								        } elseif ($status === 'in-progress') {
								            echo 'bg-warning';
								        }
								        echo '">';

								        // Display the status text inside the badge
								        echo $status;

								        // Close the span tag
								        echo '</span>';
                                @endphp
                              </td>
                        <td>
                        
                        <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                            <!----Edit Button----->
                            <form method="get" action="{{ route('datakehadiran.datakehadiran.editlist', $dkschool->id ) }}">
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