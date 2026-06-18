@extends('layouts.app-all')

@section('title', 'Data Kehadiran')

@section('content')


<?php
$pagename = "Data_kehadiran";
?>

<div class="pagetitle">
    <h1>Data Kehadiran Pasukan Hadrah</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Data Kehadiran Pasukan Hadrah</li>
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



      <br>

    


  




    <div class="col-md-12">

        <div class="row">
          <div class="col-12">
              <a href="{{ route('datakehadiran.datakehadiran.createhadrah') }}" class="btn btn-primary ml-md-3">Add Participant</a>
               <a href="{{ route('export.excel.by.hadrah') }}" class="btn btn-success">Export Excel </a>

          </div>
        </div>

        <br>

    
      <div class="col-12">
        <div class="card recent-sales">

         

          <br>

          



          <div class ="tab-content pt-2">
           

            <!-- second tab -->
              <div class="card-body overflow-auto">
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #006A4E;">Data Kehadiran Pasukan Hadrah</h5>
                  <table class="table table-borderless datatable mt-3">                         
                  <thead>
                        <tr>
                        <th scope="col">Kategori</th> 
                        <th scope="col">Sekolah / Institusi</th>
                          <th scope="col">Nama</th>
                          <th scope="col">IC No. / SKB No.</th>
                          <th scope="col">Pelajar / Pengawas</th>
                          <th scope="col">Pasukan</th>
                          <th scope="col">Status</th>
                          <th scope="col">Catatan</th>
                          <th scope="col" style="text-align: center">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      @if(isset($datakehadiranhadrahs) == 0)
                        <tr class="text-center">
                          <td colspan="8">
                            <h5>No records found</h5>
                          </td>
                        </tr>
                      @else
                          @foreach($datakehadiranhadrahs as $datakehadiranhadrah)
                            <tr>                                   
                              <td>{{ $datakehadiranhadrah->kategori }}</td>
                              <td>{{ $datakehadiranhadrah->sekolah_institusi }}</td>                              
                              <td>{{ $datakehadiranhadrah->nama_pelajar_pengawas }}</td> 
                              <td>{{ $datakehadiranhadrah->icno_skbno }}</td> 


                              <td>
                                  @if($datakehadiranhadrah->type_pelajar_pengawas === null || $datakehadiranhadrah->type_pelajar_pengawas === '')
                                      <!-- Leave this TD blank if type_pelajar_pengawas is null or empty -->
                                  @elseif(in_array(strtoupper($datakehadiranhadrah->type_pelajar_pengawas), ['P', 'PH']))
                                      Pelajar
                                  @elseif(in_array(strtoupper($datakehadiranhadrah->type_pelajar_pengawas), ['G', 'GH', 'GP']))
                                      Pengawas
                                  @elseif(strtoupper($datakehadiranhadrah->type_pelajar_pengawas) === 'PU')
                                      Pegawai Uniform
                                  @endif
                              </td>

                                
                              <td>{{ $datakehadiranhadrah->pasukan }}</td> 
                                

                                <td>
                                  @if($datakehadiranhadrah->hadir === null || $datakehadiranhadrah->hadir === '')
                                      <span class="badge rounded-pill bg-danger">Untuk Tindakan</span>
                                  @elseif($datakehadiranhadrah->hadir === "1")
                                      <span class="badge rounded-pill bg-primary">Hadir</span>
                                  @elseif($datakehadiranhadrah->hadir === "x" || $datakehadiranhadrah->hadir === "X")
                                      <span class="badge rounded-pill bg-warning">Tidak hadir</span>
                                  @endif
                              </td>

                              <td>{{ $datakehadiranhadrah->catatan }}</td>                        


                              <td style="text-align: center">
                                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                  <!----Edit Button----->
                                  <form method="get" action="{{ route('datakehadiran.datakehadiran.editadmin', $datakehadiranhadrah->id ) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary">
                                      <i class="bi bi-pencil-fill"></i>
                                    </button>
                                  </form>

                                         <!----Delete Button----->
                                  <form id="deleteForm{{$datakehadiranhadrah->id}}" method="post" action="{{ route('datakehadiran.datakehadiran.destroyhadrah', $datakehadiranhadrah->id) }}" style="margin-bottom:0px;">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-outline-danger delete-btn" style="margin-right:15px;" title="Delete" onclick="showDeleteConfirmationApproval({{ $datakehadiranhadrah->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                
                                            <!-- Add a modal for confirmation -->
                                            <div class="modal" id="deleteConfirmationModalApproval{{ $datakehadiranhadrah->id }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Deletion</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval({{ $datakehadiranhadrah->id }})">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this record?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $datakehadiranhadrah->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $datakehadiranhadrah->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
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

   