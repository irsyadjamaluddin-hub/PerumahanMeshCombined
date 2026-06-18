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
 
    <div class="card recent-sales">

  <div class="card-body">

    <div class="profile-overview pt-3">
        <h5 class="card-title">Perkara </h5>
        <form class="" method="post" action="{{ route('soalanbiskita.soalanbiskita.storeperkara') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-lg-1 col-form-label">Perkara:</label>
                <div class="col-lg-4">
                    <input type="text" name="label" class="form-control" placeholder="Perkara">
              
            </div>
            
           
            <!--     <label class="col-lg-1 col-form-label">IC No:</label>
                <div class="col-lg-3">
                    <input type="text" name="ic_no" class="form-control" placeholder="IC Number">
                </div> -->
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-outline-success" >
                       Update
                    </button>
                </div>
            </div>
        </form>

        <div class="card-body overflow-auto">


                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Perkara</th>
                                
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                           
                        
                        @if(count($tanyaperkaras) == null)
                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>

                        @else
                         @foreach($tanyaperkaras as $tanyaperkara)   

                            <tr>
                                
                                <td>{{ $tanyaperkara->label }}</td>
                              
                                <td>{{ $tanyaperkara->created_at }}</td>
                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example"> 
                                        <!----Edit Button----->
                                            <form method="get" action="{{ route('soalanbiskita.soalanbiskita.editperkaraic', $tanyaperkara->id ) }}">
                                        @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                            <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </form> 
                                        <!----Delete Button----->
                                        <form method="post" onclick="return confirm('Are you sure?')" action="{{ route('soalanbiskita.soalanbiskita.destroyperkara', $tanyaperkara->id ) }}">
                                            @csrf
                                            @method('delete')
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

  </div>

  </div>

</section>

@endsection