@extends('layouts.app-all')

@section('title', 'Data Kehadiran')

@section('content')


<?php
$pagename = "Data_kehadiran";
?>

<div class="pagetitle">
    <h1>Data Kehadiran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Data Kehadiran</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

  @if(Session::has('success_message'))
  <div class="alert alert-success">
      <i class=" fas fa-fw fa-check"></i>
      {!! session('success_message') !!}
  </div>
  @endif

  <div class="col-md-12" style="text-align: right;">
  
  <a href="{{ route('export.excel.by.school') }}" class="btn btn-success">Export Excel </a>
<br>
<br>


   
      </div>

      <form action="{{ route('indexsearch') }}" method="GET">
          <div class="flex justify-between mb-3 rounded-lg overflow-hidden">

                <input type="text" name="query" id="term" placeholder="Search Sekolah/Institusi / Nama / ICNo./SKBNo./ Pelajar/Pengawas" class="w-full px-10 focus:outline-none">

                <button type="submit" class="p-3 bg-blue-500 hover:bg-blue-600" style="transition: 0.4s;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                </div>
   </form>



    <div class="col-md-12">

    <div class="row">
          <div class="col-12" hidden>
              <a href="{{ route('datakehadiran.datakehadiran.create') }}" class="btn btn-primary ml-md-3">Add Participant</a>
          </div>
        </div>

        <br>

      <div class="col-12">
        <div class="card recent-sales">

          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">               
            <li class="nav-item">
              <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#tindakan">Tindakan</button>
            </li>

            <li class="nav-item">
              <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#selesai">Selesai</button>
            </li>

            <li class="nav-item">
              <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#pasukanuniform">Pasukan Beruniform</button>
            </li>

         
          </ul>  
          <!-- Close Bordered Tabs -->

          <br>

          <div class ="tab-content pt-2">
            <!-- first tab -->
            <div class="tab-pane fade show active tindakan" id="tindakan">
                <div class="card-body overflow-auto">
                  <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Data Kehadiran</h5>
                    <table class="table table-borderless datatable mt-3">
                   
                      <thead>
                        <tr>
                    
                          <th scope="col">Sekolah / Institusi</th>
                          <th scope="col">Nama</th>
                          <th scope="col">IC No/SKB No.</th>
                          <th scope="col">Pelajar / Pengawas</th>
                          <th scope="col">Pasukan</th>
                          <th scope="col">Status</th>
                          <th scope="col">Catatan</th>
                          <th scope="col" style="text-align: center">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      @if(isset($resultsblank) == 0)
                        <tr class="text-center">
                          <td colspan="8">
                            <h5>No records found</h5>
                          </td>
                        </tr>
                      @else
                          @foreach($resultsblank as $datakehadiranblank)
                            <tr>                                   
                              <td>{{ $datakehadiranblank->sekolah_institusi }}</td>                              
                              <td>{{ $datakehadiranblank->nama_pelajar_pengawas }}</td> 
                              <td>{{ $datakehadiranblank->icno_skbno }}</td> 


                              <td>
                                  @if($datakehadiranblank->type_pelajar_pengawas === null || $datakehadiranblank->type_pelajar_pengawas === '')
                                      <!-- Leave this TD blank if type_pelajar_pengawas is null or empty -->
                                  @elseif(in_array(strtoupper($datakehadiranblank->type_pelajar_pengawas), ['P', 'PH']))
                                      Pelajar
                                  @elseif(in_array(strtoupper($datakehadiranblank->type_pelajar_pengawas), ['G', 'GH', 'GP']))
                                      Pengawas
                                  @elseif(strtoupper($datakehadiranblank->type_pelajar_pengawas) === 'PU')
                                      Pegawai Uniform
                                  @endif
                              </td>

                              <td>{{ $datakehadiranblank->pasukan }}</td> 


                            
                                <td>
      @if ($datakehadiranblank->hadir === null || $datakehadiranblank->hadir === '')
          <div style="display: flex; justify-content: space-between; align-items: center;">
              <a href="{{ route('datakehadiran.datakehadiran.updatehadir', ['dk' => $datakehadiranblank->id]) }}" class="btn btn-success" style="margin-right: 5px;">
                  <i class="ri-checkbox-line"></i> <!-- Icon for present -->
              </a>
              <a href="{{ route('datakehadiran.datakehadiran.updatetidakhadir', ['dk' => $datakehadiranblank->id]) }}" class="btn btn-danger" style="margin-left: 5px;">
                  <i class="bi-x-square"></i> <!-- Icon for absent -->
              </a>
          </div>
      @else
          @if($datakehadiranblank->hadir=="1")
              <span class="badge rounded-pill bg-primary">Hadir</span>
          @elseif(strtolower($datakehadiranblank->hadir) === "x")
              <span class="badge rounded-pill bg-warning">Tidak hadir</span>
          @endif
      @endif
  </td>


                         

                              <td>{{ $datakehadiranblank->catatan }}</td>                        


                              <td style="text-align: center">
                                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                  <!----Edit Button----->
                                  <form method="get" action="{{ route('datakehadiran.datakehadiran.edit', $datakehadiranblank->id ) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary">
                                      <i class="bi bi-pencil-fill"></i>
                                    </button>
                                  </form>

                                  <!----Delete Button----->
                                  <form id="deleteForm{{$datakehadiranblank->id}}" method="post" action="{{ route('datakehadiran.datakehadiran.destroy', $datakehadiranblank->id) }}" style="margin-bottom:0px;">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" title="Delete" onclick="showDeleteConfirmationApproval2({{ $datakehadiranblank->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                
                                            <!-- Add a modal for confirmation -->
                                            <div class="modal" id="deleteConfirmationModalApproval2{{ $datakehadiranblank->id }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Deletion</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval2({{ $datakehadiranblank->id }})">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this record?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval2('deleteForm{{ $datakehadiranblank->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval2({{ $datakehadiranblank->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <script>
                                            function showDeleteConfirmationApproval2(id) {
                                                $('#deleteConfirmationModalApproval2' + id).modal('show');
                                            }
                    
                                            function hideDeleteConfirmationApproval2(id) {
                                                $('#deleteConfirmationModalApproval2' + id).modal('hide');
                                            }
                    
                                            function deleteRecordApproval2(formId) {
                                                $('#' + formId).submit();
                                            }
                                            </script>


                                
                                
                                </div> 
                              </td>
                            </tr>
                          @endforeach
                      @endif                             
                      </tbody>

                    </table>

                    @if (!empty($resultsblank))
                        {{ $resultsblank->links() }}
                    @endif


                </div>
              </div>
          

                   

            <!-- second tab -->
            <div class="tab-pane fade selesai" id="selesai">
              <div class="card-body overflow-auto">
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #006A4E;">Data Kehadiran</h5>
                  <table class="table table-borderless datatable mt-3">                         
                  <thead>
                        <tr>
                        <th scope="col">Kategori</th> 
                        <th scope="col">Sekolah / Institusi</th>
                          <th scope="col">Nama</th>
                          <th scope="col">IC No/SKB No.</th>
                          <th scope="col">Pelajar / Pengawas</th>
                          <th scope="col">Pasukan</th>
                          <th scope="col">Status</th>
                          <th scope="col">Catatan</th>
                          <th scope="col" style="text-align: center">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      @if(isset($resultsdatakehadiran) == 0)
                        <tr class="text-center">
                          <td colspan="8">
                            <h5>No records found</h5>
                          </td>
                        </tr>
                      @else
                          @foreach($resultsdatakehadiran as $datakehadiran)
                            <tr>                                   
                              <td>{{ $datakehadiran->kategori }}</td>
                              <td>{{ $datakehadiran->sekolah_institusi }}</td>                              
                              <td>{{ $datakehadiran->nama_pelajar_pengawas }}</td> 
                              <td>{{ $datakehadiran->icno_skbno }}</td> 

                              
                              <td>
                                  @if($datakehadiran->type_pelajar_pengawas === null || $datakehadiran->type_pelajar_pengawas === '')
                                      <!-- Leave this TD blank if type_pelajar_pengawas is null or empty -->
                                  @elseif(in_array(strtoupper($datakehadiran->type_pelajar_pengawas), ['P', 'PH']))
                                      Pelajar
                                  @elseif(in_array(strtoupper($datakehadiran->type_pelajar_pengawas), ['G', 'GH', 'GP']))
                                      Pengawas
                                  @elseif(strtoupper($datakehadiran->type_pelajar_pengawas) === 'PU')
                                      Pegawai Uniform
                                  @endif
                              </td>    

                              <td>{{ $datakehadiran->pasukan }}</td> 


                                <td>
                                      @if($datakehadiran->hadir == null)
                                          <span class="badge rounded-pill bg-danger">Untuk Tindakan</span>
                                      @elseif($datakehadiran->hadir=="1")
                                          <span class="badge rounded-pill bg-primary">Hadir</span>
                                      @elseif(strtolower($datakehadiran->hadir) === "x")
                                          <span class="badge rounded-pill bg-warning">Tidak hadir</span>
                                      @endif
                                  </td>


                              <td>{{ $datakehadiran->catatan }}</td>                        


                              <td style="text-align: center">
                                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                  <!----Edit Button----->
                                  <form method="get" action="{{ route('datakehadiran.datakehadiran.edit', $datakehadiran->id ) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary">
                                      <i class="bi bi-pencil-fill"></i>
                                    </button>
                                  </form>

                                         <!----Delete Button----->
                                  <form id="deleteForm{{$datakehadiran->id}}" method="post" action="{{ route('datakehadiran.datakehadiran.destroy', $datakehadiran->id) }}" style="margin-bottom:0px;">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" title="Delete" onclick="showDeleteConfirmationApproval1({{ $datakehadiran->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                
                                            <!-- Add a modal for confirmation -->
                                            <div class="modal" id="deleteConfirmationModalApproval1{{ $datakehadiran->id }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Deletion</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval1({{ $datakehadiran->id }})">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this record?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval1('deleteForm{{ $datakehadiran->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval1({{ $datakehadiran->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <script>
                                            function showDeleteConfirmationApproval1(id) {
                                                $('#deleteConfirmationModalApproval1' + id).modal('show');
                                            }
                    
                                            function hideDeleteConfirmationApproval1(id) {
                                                $('#deleteConfirmationModalApproval1' + id).modal('hide');
                                            }
                    
                                            function deleteRecordApproval1(formId) {
                                                $('#' + formId).submit();
                                            }
                                            </script>
                                
                                
                                </div> 
                              </td>
                            </tr>
                          @endforeach


                      @endif             
                    </tbody>
                  </table>

                    @if (!empty($resultsdatakehadiran))
                        {{ $resultsdatakehadiran->links() }}
                    @endif

              </div>
            </div>
        
            <!-- end second tab -->

            <!-- third tab -->

            <div class="tab-pane fade pasukanuniform" id="pasukanuniform">
              <div class="card-body overflow-auto">
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #006A4E;">Pasukan Beruniform</h5>
                  <table class="table table-borderless datatable mt-3">                         
                  <thead>
                        <tr>
                        <th scope="col">Kategori</th> 
                        <th scope="col">Sekolah / Institusi</th>
                          <th scope="col">Nama</th>
                          <th scope="col">IC No/SKB No.</th>
                          <th scope="col">Pelajar / Pengawas</th>
                          <th scope="col">Pasukan</th>
                          <th scope="col">Status</th>
                          <th scope="col">Catatan</th>
                          <th scope="col" style="text-align: center">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      @if(isset($resultsuniform) == 0)
                        <tr class="text-center">
                          <td colspan="8">
                            <h5>No records found</h5>
                          </td>
                        </tr>
                      @else
                          @foreach($resultsuniform as $datakehadiranuniform)
                            <tr>                                   
                              <td>{{ $datakehadiranuniform->kategori }}</td>
                              <td>{{ $datakehadiranuniform->sekolah_institusi }}</td>                              
                              <td>{{ $datakehadiranuniform->nama_pelajar_pengawas }}</td> 
                              <td>{{ $datakehadiranuniform->icno_skbno }}</td> 

                              
                              <td>
                                    @if($datakehadiranuniform->type_pelajar_pengawas === null || $datakehadiranuniform->type_pelajar_pengawas === '')
                                        <!-- Leave this TD blank if type_pelajar_pengawas is null or empty -->
                                    @elseif(strtolower($datakehadiranuniform->type_pelajar_pengawas) === "p")
                                        Pelajar
                                    @elseif(strtolower($datakehadiranuniform->type_pelajar_pengawas) === "g")
                                        Pengawas
                                    @endif
                                </td> 

                              <td>{{ $datakehadiranuniform->pasukan }}</td> 


                                <td>
                                      @if($datakehadiranuniform->hadir == null)
                                          <span class="badge rounded-pill bg-danger">Untuk Tindakan</span>
                                      @elseif($datakehadiranuniform->hadir=="1")
                                          <span class="badge rounded-pill bg-primary">Hadir</span>
                                      @elseif(strtolower($datakehadiranuniform->hadir) === "x")
                                          <span class="badge rounded-pill bg-warning">Tidak hadir</span>
                                      @endif
                                  </td>


                              <td>{{ $datakehadiranuniform->catatan }}</td>                        


                              <td style="text-align: center">
                                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                  <!----Edit Button----->
                                  <form method="get" action="{{ route('datakehadiran.datakehadiran.edit', $datakehadiranuniform->id ) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary">
                                      <i class="bi bi-pencil-fill"></i>
                                    </button>
                                  </form>

                                         <!----Delete Button----->
                                  <form id="deleteForm{{$datakehadiranuniform->id}}" method="post" action="{{ route('datakehadiran.datakehadiran.destroyuniform', $datakehadiranuniform->id) }}" style="margin-bottom:0px;">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" title="Delete" onclick="showDeleteConfirmationApproval({{ $datakehadiranuniform->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                
                                            <!-- Add a modal for confirmation -->
                                            <div class="modal" id="deleteConfirmationModalApproval{{ $datakehadiranuniform->id }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Deletion</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval({{ $datakehadiranuniform->id }})">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this record?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $datakehadiranuniform->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $datakehadiranuniform->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <script>
                                            function showDeleteConfirmationApproval(id) {
                                                $('#deleteConfirmationModalApproval' + id).modal('show');
                                            }
                    
                                            function hideDeleteConfirmationApproval(id) {
                                                $('#deleteConfirmationModalApproval' + id).modal('hide');
                                            }
                    
                                            function deleteRecordApproval(formId) {
                                                $('#' + formId).submit();
                                            }
                                            </script>
                                
                                
                                </div> 
                              </td>
                            </tr>
                          @endforeach


                      @endif             
                    </tbody>
                  </table>

              @if (!empty($resultsuniform))
                  {{ $resultsuniform->links() }}
              @endif

              </div>
            </div>
            <!-- third tab -->


          </div>

          

        </div>
      </div>
    </div>
    
@endsection

   