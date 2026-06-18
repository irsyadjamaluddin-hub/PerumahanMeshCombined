@extends('layouts.app-all')

@section('title', 'SSM Penilai Admin Index')

@section('content')

<?php
    $pagename = "SSM Penilai Admin";
  ?>

    <div class="pagetitle">
      <h1>SSM Penilai Admin</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">SSM Penilai Admin</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <!--  Index Table -->
        @if(Session::has('success_message'))
        <div class="alert alert-success">
            <i class=" fas fa-fw fa-check"></i>
            {!! session('success_message') !!}
        </div>
        @endif

        <div class="card mt-3">
            <div class="card-body pt-3"> 
                
                <!-- Bordered Tabs -->

                <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                        <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#submitted-tab">Permohonan</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#selesai-in">Selesai</button>
                    </li>
                </ul>

                <br>
                    <!-- Clsoe Bordered Tabs -->
                <div class ="tab-content pt-2">

                    <!-- first tab -->

                    <div class="tab-pane fade show active submitted-tab" id="submitted-tab">
                        
                        <div class="card-body overflow-auto">
                        
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">No. Rujukan</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">No. Kad Pengenalan</th>
                                        <th scope="col">Emel</th>
                                        <th scope="col">No. Tel</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Di Buat Pada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($ssmpsb) == null)
                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>

                                    @else
                                    @foreach($ssmpsb as $ssmpsbs)   

                                    @php
                                        $ssmpp = $ssmpg->filter(function($item) use ($ssmpsbs) {
                                            return $item->correlation == $ssmpsbs->id;
                                        });
                                    @endphp
                                        <tr>
                                            <td><b>PP{{ $ssmpsbs->id }}</b></td>
                                            <td>{{ $ssmpsbs->name }}</td>
                                            <td>{{ $ssmpsbs->ic_no }}</td>
                                            <td>{{ $ssmpsbs->email }}</td>
                                            <td>{{ $ssmpsbs->phone_number }}</td>
                                            <td>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#statuschange{{ $ssmpsbs->id }}" class="btn btn-primary">
                                                    <span class="badge bg-primary">{{$ssmpsbs->status}}</span>
                                                </button>

                                                <!-- Basic Modal -->
                                                <!-- Basic Modal -->
                                                <div class="modal fade" id="statuschange{{ $ssmpsbs->id }}" tabindex="-1">
                                                    <div class="modal-dialog modal-lg"> <!-- Use modal-lg for a larger modal -->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body" style="min-height: auto;">
                                                                <div class="table-responsive"> <!-- Add responsive class -->
                                                                    <table class="table table-striped table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Nama Pegawai</th>
                                                                                <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Jawatan</th>
                                                                                <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">No. Kad Pengenalan</th>
                                                                                <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Nama Pegawai Penilai</th>
                                                                                <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">No. Kad Pengenalan (Pegawai Penilai)</th>
                                                                                <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="text-center">
                                                                            @foreach($ssmpp as $ssmpps)
                                                                            <tr>
                                                                                <td>{{ $ssmpps->name_peg }}</td>
                                                                                <td>{{ $ssmpps->jawatan_peg }}</td>
                                                                                <td>{{ $ssmpps->ic_no_peg }}</td>
                                                                                <td>{{ $ssmpps->name_pen }}</td>
                                                                                <td>{{ $ssmpps->ic_no_pen }}</td>
                                                                                @if($ssmpps->status == 'Submitted')
                                                                                    <td>
                                                                                    <form method="post" action="{{ route('ssms.penilai.update', $ssmpps->id ) }}">
                                                                                        @csrf

                                                                                        <input type="text" name="id" value="{{ $ssmpps->id }}" class="form-control" hidden/>
                                                                                        <button type="submit" class="btn btn-outline-success">
                                                                                            <i class="bi bi-check2-circle"></i>
                                                                                        </button>

                                                                                    </form>
                                                                                    </td>
                                                                                @elseif($ssmpps->status == 'Selesai')
                                                                                    <td><span class="badge bg-success">Selesai</span></td>
                                                                                @endif
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <script>
                                                                    var submitButton = document.getElementById('submit-button');
                                                                    var form = document.getElementById('storebooksubject');

                                                                    form.addEventListener('submit', function(event) {
                                                                        if (submitButton.getAttribute('data-submitted') !== null) {
                                                                            event.preventDefault();
                                                                        } else {
                                                                            submitButton.disabled = true;
                                                                            submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                                                                            submitButton.setAttribute('data-submitted', 'true');
                                                                        }
                                                                    });
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $ssmpsbs->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end 1st tab -->
                    <div class="tab-pane fade selesai-in pt-2" id="selesai-in">
                        <div class="card-body overflow-auto">
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">No. Kad Pengenalan</th>
                                        <th scope="col">Emel</th>
                                        <th scope="col">No. Tel</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Di Buat Pada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($ssmpsi) == null)
                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>

                                    @else
                                    @foreach($ssmpsi as $ssmpsis)   

                                    @php
                                        $ssmppi = $ssmpg->filter(function($item) use ($ssmpsis) {
                                            return $item->correlation == $ssmpsis->id;
                                        });
                                    @endphp
                                        <tr>
                                            <td>{{ $ssmpsis->name }}</td>
                                            <td>{{ $ssmpsis->ic_no }}</td>
                                            <td>{{ $ssmpsis->email }}</td>
                                            <td>{{ $ssmpsis->phone_number }}</td>
                                            <td>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#statuschange{{ $ssmpsis->id }}" class="btn btn-success">
                                                    <span class="badge bg-success">{{$ssmpsis->status}}</span>
                                                </button>

                                                <!-- Basic Modal -->
                                                <!-- Basic Modal -->
                                                <div class="modal fade" id="statuschange{{ $ssmpsis->id }}" tabindex="-1">
                                                    <div class="modal-dialog modal-lg"> <!-- Use modal-lg for a larger modal -->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body" style="min-height: auto;">
                                                                <div class="table-responsive"> <!-- Add responsive class -->
                                                                    <table class="table table-striped table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Nama Pegawai</th>
                                                                                <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Jawatan</th>
                                                                                <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">No. Kad Pengenalan</th>
                                                                                <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Nama Pegawai Penilai</th>
                                                                                <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">No. Kad Pengenalan (Pegawai Penilai)</th>
                                                                                <th style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="text-center">
                                                                            @foreach($ssmppi as $ssmppis)
                                                                            <tr>
                                                                                <td>{{ $ssmppis->name_peg }}</td>
                                                                                <td>{{ $ssmppis->jawatan_peg }}</td>
                                                                                <td>{{ $ssmppis->ic_no_peg }}</td>
                                                                                <td>{{ $ssmppis->name_pen }}</td>
                                                                                <td>{{ $ssmppis->ic_no_pen }}</td>
                                                                                @if($ssmppis->status == 'Submitted')
                                                                                    <td>
                                                                                    <form method="post" action="{{ route('ssms.penilai.update', $ssmppis->id ) }}">
                                                                                        @csrf

                                                                                        <input type="text" name="id" value="{{ $ssmppis->id }}" class="form-control" hidden/>
                                                                                        <button type="submit" class="btn btn-outline-success">
                                                                                            <i class="bi bi-check2-circle"></i>
                                                                                        </button>

                                                                                    </form>
                                                                                    </td>
                                                                                @elseif($ssmppis->status == 'Selesai')
                                                                                    <td><span class="badge bg-success">Selesai</span></td>
                                                                                @endif
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <script>
                                                                    var submitButton = document.getElementById('submit-button');
                                                                    var form = document.getElementById('storebooksubject');

                                                                    form.addEventListener('submit', function(event) {
                                                                        if (submitButton.getAttribute('data-submitted') !== null) {
                                                                            event.preventDefault();
                                                                        } else {
                                                                            submitButton.disabled = true;
                                                                            submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                                                                            submitButton.setAttribute('data-submitted', 'true');
                                                                        }
                                                                    });
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $ssmpsis->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection