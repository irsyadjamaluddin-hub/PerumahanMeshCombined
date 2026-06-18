@extends('layouts.app-all')

@section('title', 'SSM Request Staff Permohonan')

@section('content')


<?php
$pagename = "SSM_Staff_Permohonan";
?>

<div class="pagetitle">
    <h1>SSM Request Staff Permohonan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">SSM Request Staff Permohonan</li>
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

  
    <div class="col-md-12">

    <div class="col-md-10">
        <a href="{{ route('ssmrequests.ssmrequest.createpermohonan') }}" class="btn btn-primary text-right" >
            <i class="bi bi-plus-lg"></i>
        </a>
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
              <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#salinan">Salinan</button>
            </li>
          </ul>  
          <!-- Close Bordered Tabs -->

          <br>

          <div class ="tab-content pt-2">
            <!-- first tab -->
            <div class="tab-pane fade show active tindakan" id="tindakan">
                <div class="card-body overflow-auto">
                  <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Permohonan (Tindakan)</h5>
                    <table class="table table-borderless datatable mt-3">
                   
                      <thead>
                        <tr>
                        <th scope="col">Ref. No.</th> 
                        <th scope="col">IC No. Pemohon</th>
                          <th scope="col">Jenis Permohonan</th>
                          <th scope="col">Tarikh</th>
                          <th scope="col">Status</th>
                          <th scope="col" style="text-align: center">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      @if(isset($ssmpermohonan) == 0)
                        <tr class="text-center">
                          <td colspan="8">
                            <h5>No records found</h5>
                          </td>
                        </tr>
                      @else
                          @foreach($ssmpermohonan as $ssmpermohonan)
                            <tr>                                   
                              <td>PM {{ $ssmpermohonan->permohonan_id }}</td>
                              <td>{{ $ssmpermohonan->icno_pemohon }}</td>
                              <td>{{ $ssmpermohonan->permohonan_type }}</td>                              
                              <td>{{ $ssmpermohonan->created_at }}</td>                        
                              @if($ssmpermohonan->status == null)
                                <td ><span class="badge rounded-pill bg-danger">Untuk Tindakan</span></td>
                              @elseif($ssmpermohonan->status=="kiv")
                                <td><span class="badge rounded-pill bg-primary">kiv</span></td>
                              @elseif($ssmpermohonan->status=="Dalam Proses")
                                <td><span class="badge rounded-pill bg-warning">Dalam Proses</span></td>
                              @elseif($ssmpermohonan->status =="selesai")
                                <td><span class="badge rounded-pill bg-success">Selesai</span></td>
                              @endif

                              <td style="text-align: center">
                                <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                  <input type="text" name="id"  value="{{$ssmpermohonan->id}}" hidden>
                                  <!----Edit Button----->
                                  <form method="get" action="{{ route('ssmrequests.ssmrequest.editstaffpermohonan', $ssmpermohonan->permohonan_id ) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary">
                                      <i class="bi bi-pencil-fill"></i>
                                    </button>
                                  </form>
                                  <!----Selesai Button----->
                                  <form method="post" action="{{ route('ssmrequests.ssmrequest.updatestaffpermohonanstatus', ['id' => $ssmpermohonan->id]) }}">
                                    @csrf
                                    <input type="text" name="status"  value="selesai" hidden>
                                    <button type="submit" class="btn btn-outline-success">
                                      <i class="bi bi-check2-circle"></i>
                                    </button>
                                  </form>
                                  <!----KIV Button----->
                                  @if ($ssmpermohonan->status=="kiv")
                                  @else
                                  <form method="post" action="{{ route('ssmrequests.ssmrequest.updatestaffpermohonanstatus', ['id' => $ssmpermohonan->id]) }}">
                                    @csrf
                                    <input type="text" name="status"  value="kiv" hidden>
                                    <button type="submit" class="btn btn-outline-primary">
                                      <i class="bi bi-arrow-repeat"></i>
                                    </button>
                                  </form>
                                  @endif
                                  <!----Dalam Proses Button----->
                                  @if ($ssmpermohonan->status=="Dalam Proses")
                                  @else
                                  <form method="post" action="{{ route('ssmrequests.ssmrequest.updatestaffpermohonanstatus', ['id' => $ssmpermohonan->id]) }}">
                                    @csrf
                                    <input type="text" name="status"  value="Dalam Proses" hidden>
                                    <button type="submit" class="btn btn-outline-warning">
                                      <i class="bi bi-clock"></i>
                                    </button>
                                  </form>
                                  @endif
                                </div> 
                              </td>
                            </tr>
                          @endforeach
                      @endif                             
                      </tbody>

                    </table>
                </div>
            </div>

            <!-- second tab -->
            <div class="tab-pane fade selesai" id="selesai">
              <div class="card-body overflow-auto">
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #006A4E;">Permohonan (Selesai)</h5>
                  <table class="table table-borderless datatable mt-3">                         
                    <thead>
                      <tr>
                      <th scope="col">Ref. No.</th> 
                      <th scope="col">IC No. Pemohon</th>
                        <th scope="col">Jenis Permohonan</th>
                        <th scope="col">Tarikh</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($ssmpermohonanselesai) == 0)
                        <tr class="text-center">
                          <td colspan="8">
                            <h5>No records found</h5>
                          </td>
                        </tr>
                      @else
                        @foreach($ssmpermohonanselesai as $ssmpermohonanselesai)
                          <tr>                                       
                            <td>PM {{$ssmpermohonanselesai->permohonan_id}}</td>
                            <td>{{ $ssmpermohonanselesai->icno_pemohon }}</td>
                            <td>{{ $ssmpermohonanselesai->permohonan_type }}</td>                                 
                            <td>{{ $ssmpermohonanselesai->created_at }}</td>                                
                            @if($ssmpermohonanselesai->status =="selesai")
                              <td><span class="badge rounded-pill bg-success">Selesai</span></td>
                            @endif
                            <td>
                              <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                <!----Edit Button----->
                                <form method="get" action="{{ route('ssmrequests.ssmrequest.editstaffpermohonan', $ssmpermohonanselesai->permohonan_id ) }}">
                                  @csrf
                                  <button type="submit" class="btn btn-outline-primary">
                                    <i class="bi bi-pencil-fill"></i>
                                  </button>
                                </form>                                              
                                                                    
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#sebabModal-{{ $ssmpermohonanselesai->id }}" data-bs-tooltip="tooltip" data-bs-placement="top">
                                  <i class="bi bi-arrow-repeat"></i>
                                </button>
                                <div class="modal fade" id="sebabModal-{{ $ssmpermohonanselesai->id }}" tabindex="-1" aria-labelledby="sebabModalLabel-{{ $ssmpermohonanselesai->id }}" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <form method="post" action="{{ route('ssmrequests.ssmrequest.updatestaffpermohonanstatus', ['id' => $ssmpermohonanselesai->id]) }}">
                                        @csrf
                                        <input type="text" name="status"  value="kiv" hidden>
                                        <div class="modal-header d-flex justify-content-center">
                                            <h5 class="modal-title" id="sebabModalLabel-{{ $ssmpermohonanselesai->id }}" style="text-align: center;"><b>Sebab kiv</b></h5>
                                        </div>
                                        <div class="modal-body">
                                            <textarea name="catatantindakan" placeholder="Catatan..." class="form-control" required></textarea>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary"">Submit</button>
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #f75f6e; border-color: #f75f6e;">Close</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>  
                              </div>
                            </td>
                          </tr>
                        @endforeach
                      @endif                                  
                    </tbody>
                  </table>
              </div>
            </div>
        
            <!-- third tab -->
            <div class="tab-pane fade selesai" id="salinan">
              <div class="card-body overflow-auto">
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #91c08f;">Permohonan (Salinan)</h5>
                  <div style="width: 100%; text-align: right; margin-top: 20px;">
                    <a href="{{ route('ssmrequests.ssmrequest.createpermohonansalinan') }}" class="btn btn-primary text-right" style="height: 2.39rem;">
                        <i class="bi bi-plus-lg"></i>
                    </a>
                  </div>   
                  <table class="table table-borderless datatable mt-3 catatan">                         
                    <thead>
                      <tr>
                        <th scope="col">Ref. No.</th> 
                        <th scope="col">Jenis Permohonan</th>
                        <th scope="col">Kad Pengenalan</th>
                        <th scope="col">Jumlah K.P</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Tarikh</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($ssmpermohonansalinans) == 0)
                        <tr class="text-center">
                          <td colspan="8">
                            <h5>No records found</h5>
                          </td>
                        </tr>
                      @else
                      @foreach($ssmpermohonansalinans as $ssmpermohonansalinan)
                        <tr>                                       
                          <td>SP {{$ssmpermohonansalinan->id}}</td>
                          <td>{{$ssmpermohonansalinan->permohonan_type}}</td>
                          <td>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusInfoModal_{{$ssmpermohonansalinan->id}}"> <i class="bi bi-file-text-fill"></i></button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="statusInfoModal_{{$ssmpermohonansalinan->id}}" tabindex="-1" role="dialog" aria-labelledby="statusInfoModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="statusInfoModalLabel">Kad Pengenalan Information</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Kad Pengenalan</th>
                                                        <th>Created At</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  @php
                                                    $totalIcnoPemohon = 0;
                                                  @endphp
                                                    @foreach($ssmpermohonansalinanicno[$ssmpermohonansalinan->id] as $icnoRecord)
                                                      <tr>
                                                          <td>{{ $icnoRecord->icno_pemohon }}</td>
                                                          <td>{{ $icnoRecord->created_at }}</td>
                                                      </tr>
                                                      @php
                                                        // Increment the total for each icno_pemohon
                                                        $totalIcnoPemohon++;
                                                      @endphp 
                                                    @endforeach    
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: #fff; background-color: #6c757d; border-color: #6c757d;">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </td>                                
                          <td>{{ $totalIcnoPemohon }}</td>     
                          <td style="width: 33%; text-align: justify">
                            <div class="text-container catatan" data-record-id="{{ $ssmpermohonansalinan->id }}">
                                @if (strlen($ssmpermohonansalinan->permohonan_catatan) > 100)
                                    <div class="limited-text">
                                        {{ Str::limit($ssmpermohonansalinan->permohonan_catatan, 100) }}
                                    </div>
                                    <div class="full-text" style="display: none;">
                                        {{ $ssmpermohonansalinan->permohonan_catatan }}
                                    </div>
                                    <a href="#" class="read-more" style="color: rgb(42, 152, 156);">Read More</a>
                                @else
                                    <div class="full-text">
                                        {{ $ssmpermohonansalinan->permohonan_catatan }}
                                    </div>
                                @endif
                            </div>
                        </td>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                // Add a click event listener to a common ancestor of "Read More" links
                                document.querySelector('.catatan[data-record-id="{{ $ssmpermohonansalinan->id }}"]').addEventListener('click', function (event) {
                                    // Check if the clicked element is a "Read More" link
                                    if (event.target.classList.contains('read-more')) {
                                        event.preventDefault();
                    
                                        // Find the parent container
                                        const container = event.target.closest('.text-container');
                    
                                        // Toggle the display of the limited and full text based on data attribute
                                        const limitedText = container.querySelector('.limited-text');
                                        const fullText = container.querySelector('.full-text');
                    
                                        limitedText.style.display = limitedText.style.display === 'none' ? 'block' : 'none';
                                        fullText.style.display = fullText.style.display === 'none' ? 'block' : 'none';
                    
                                        // Change the text and color of the link based on the current state
                                        if (event.target.textContent === 'Read More') {
                                            event.target.textContent = 'Read Less';
                                            event.target.style.color = 'grey';
                                        } else {
                                            event.target.textContent = 'Read More';
                                            event.target.style.color = 'rgb(42, 152, 156)';
                                        }
                                    }
                                });
                            });
                        </script>

                          <td>{{ $ssmpermohonansalinan->created_at }}</td>                             
                          <td>
                            <div class="btn-group gap-2" role="group" aria-label="Basic example">
                              <!----Edit Button----->
                              <form method="get" action="{{ route('ssmrequests.ssmrequest.editstaffsalinan', $ssmpermohonansalinan->id)}}">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary">
                                  <i class="bi bi-pencil-fill"></i>
                                </button>
                              </form>  
                              
                              <!----Delete Button---->
                              <form id="deleteForm{{$ssmpermohonansalinan->id}}" method="post" action="{{ route('ssmrequests.ssmrequest.destroypermohonansalinan', $ssmpermohonansalinan->id) }}" style="margin-bottom:0px;">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn btn-outline-danger" onclick="showDeleteConfirmationApproval({{ $ssmpermohonansalinan->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                                <!-- Add a modal for confirmation -->
                                <div class="modal" id="deleteConfirmationModalApproval{{ $ssmpermohonansalinan->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Deletion</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideDeleteConfirmationApproval({{ $ssmpermohonansalinan->id }})">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this record?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger" onclick="deleteRecordApproval('deleteForm{{ $ssmpermohonansalinan->id }}')" style="background-color: #bb2d3b; border-color: #b02a37; color: #fff">Delete</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmationApproval({{ $ssmpermohonansalinan->id }})" style="background-color: #5c636a; border-color: #565e64; color: #fff">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </form>
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
            </div>
            <!-- end second tab -->
          </div>

        </div>
      </div>
    </div>
    
@endsection

   