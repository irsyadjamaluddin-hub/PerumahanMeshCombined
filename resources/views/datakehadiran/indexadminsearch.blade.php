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
          <a href="{{ route('datakehadiran.datakehadiran.indexlist') }}" class= "btn btn-primary text-right">
                    Schools List
          </a>


          <a href="{{ route('exportdatakehadiran.excel') }}" class="btn btn-success">Export to Excel</a>

          <br>

   
      </div>


  <form action="{{ route('indexadminsearch') }}" method="GET">
          <div class="flex justify-between mb-3 rounded-lg overflow-hidden">

                <input type="text" name="query" id="term" placeholder="Search Kategori / Sekolah/Institusi / Nama / ICNo./SKB No. / Pasukan " class="w-full px-10 focus:outline-none">

                <button type="submit" class="p-3 bg-blue-500 hover:bg-blue-600" style="transition: 0.4s;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                </div>
   </form>

    <div class="col-md-12">

    <div class="row">
          <div class="col-12">
              <a href="{{ route('datakehadiran.datakehadiran.createadmin') }}" class="btn btn-success ml-md-3">Add Participant</a>
          </div>
        </div>
        <br>

      <div class="col-12">
        <div class="card recent-sales">

         

          <br>

         
          <div class ="tab-content pt-2">
           

            <!-- second tab -->
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

                      @if(isset($results) == 0)
                        <tr class="text-center">
                          <td colspan="8">
                            <h5>No records found</h5>
                          </td>
                        </tr>
                      @else
                          @foreach($results as $datakehadiran)
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
                                  @if($datakehadiran->hadir === null || $datakehadiran->hadir === '')
                                      <span class="badge rounded-pill bg-danger">Untuk Tindakan</span>
                                  @elseif($datakehadiran->hadir === "1")
                                      <span class="badge rounded-pill bg-primary">Hadir</span>
                                  @elseif($datakehadiran->hadir === "x" || $datakehadiran->hadir === "X")
                                      <span class="badge rounded-pill bg-warning">Tidak hadir</span>
                                  @endif
                              </td>

                              <td>{{ $datakehadiran->catatan }}</td>                        


                              <td style="text-align: center">
                                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                  <!----Edit Button----->
                                  <form method="get" action="{{ route('datakehadiran.datakehadiran.editadmin', $datakehadiran->id ) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary">
                                      <i class="bi bi-pencil-fill"></i>
                                    </button>
                                  </form>

                                         <!----Delete Button----->
                                  <form id="deleteForm{{$datakehadiran->id}}" method="post" action="{{ route('datakehadiran.datakehadiran.destroyadminsearch', $datakehadiran->id) }}" style="margin-bottom:0px;">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" title="Delete" onclick="showDeleteConfirmationApproval({{ $datakehadiran->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                
                                            <!-- Add a modal for confirmation -->
                                            <div class="modal" id="deleteConfirmationModalApproval{{ $datakehadiran->id }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Deletion</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval({{ $datakehadiran->id }})">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this record?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $datakehadiran->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $datakehadiran->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
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


              </div>
            
        
            <!-- end second tab -->
          </div>

        </div>
      </div>
    </div>
    
@endsection

   