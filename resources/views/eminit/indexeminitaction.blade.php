@extends('layouts.app-all')

@section('title', 'E-Memo Tindakan')

@section('content')

<?php
$pagename = "E-Memo Action";
?>


<style>                
.dataTable-info{
    color: white;
}
</style>
<div class="col-12 mb-2 mt-2" style="text-align: left;">
        <button type="button" class="btn btn-primary" onclick="window.history.back()">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </button>
    </div>
<section class="section">
<div class="row">

    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif




    <div class="col-12">
        <div class="card">
            

            <br>
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">E-Memo Tindakan</h5>


            <div class="card-body overflow-auto">


            <table class="table table-borderless datatable mt-3">
              
                    <thead>
                        <tr>
                            <th scope="col">Jenis</th>
                            <th scope="col">Memo Daripada</th>
                            <th scope="col">Perkara</th>
                            <th scope="col">Rujukan (Memo Diterima)</th>
                            <th scope="col">Dokumen</th>
                            <th scope="col">Pengarah Menerima</th>
                            <th scope="col">Pengarah Catatan</th>
                            <th scope="col" style="border-right: 2px solid blue;">Kod</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Tindakan Status</th>
                            <th scope="col">Memo Status</th>
                            <th scope="col">Tindakan</th>
                            

                        </tr>
                    </thead>

                    <tbody>
                        @if(count($actions) == 0)
                        <tr class="text-center">
                            <td colspan="9">
                                <h5>No records found</h5>
                            </td>
                        </tr>

                        @else

                        @foreach($actions as $action)
                          <tr>
                              <td>{{ $jenisMap[$action->eminit_jenis] ?? '-' }}</td>
                              <td>
                                @php
                                  $memoDept = \App\Models\Eminit::find($action->eminit_id)->memoDepartment;
                                @endphp
                                {{ $memoDept->label ?? '-' }}
                              </td>
                              <td style="font-weight: bold; text-transform: uppercase;">{{ $action->eminit_perkara ?? '-' }}</td>
                              <td>{{ $action->rujukan_tp ?? '-' }}</td>

                              <td>
                                @php 
                                    $files = json_decode($action->eminit_file, true) ?? []; 
                                @endphp

                                @if(!empty($files))
                                    <div class="btn-group flex-wrap gap-1" role="group" aria-label="Dokumen">
                                        @foreach($files as $i => $file)
                                            <a href="{{ $file['url'] }}" target="_blank"
                                              class="btn btn-success btn-sm"
                                              data-bs-toggle="tooltip"
                                              title="{{ $file['original'] }}">
                                              <i class="bi bi-file-earmark-text"></i> {{-- optional: #{{ $i+1 }} --}}
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-muted">Tiada dokumen</span>
                                @endif
                            </td>

                              
                                {{-- Pengarah menerima = created_at from eminit_admin --}}
                              <td>{{ $action->admin_created_at ?? '-' }}</td>

                              {{-- Pengarah catatan = catatan from eminit_admin --}}
                              <td>{{ $action->admin_catatan ?? '-' }}</td>

                              {{-- Tindakan diperlukan --}}
                              <td style="border-right: 2px solid blue;">
                                    {{ !empty($action->tindakan_labels)
                                        ? implode(', ', $action->tindakan_labels)
                                        : '-' }}
                                </td>
                                

                              {{-- Catatan = catatan from eminit_action --}}
                              <td>{{ $action->action_catatan ?? '-' }}</td>

                              <td>
                                    @if(!empty($action->jenis_tindakan_labels))
                                        {{ implode(', ', $action->jenis_tindakan_labels) }}
                                    @else
                                    <span class="badge rounded-pill bg-warning text-dark">
                                        Untuk Tindakan
                                    </span>
                                    @endif
                                </td>


                                <td>
    <span class="badge rounded-pill 
        {{ $action->memo_status_display == 'Selesai' ? 'bg-success' : ($action->memo_status_display == 'In-Progress' ? 'bg-info text-dark' : 'bg-warning text-dark') }}">
        {{ $action->memo_status_display }}
    </span>
</td>







                              <!-- <td>action id{{ $action->action_id }}</td>
                              <td>admin id{{ $action->eminit_admin_id }}</td> -->

                              
                              <td>
                                  <div class="btn-group" role="group">
                                      <form method="get" action="{{ route('eminit.eminit.editeminitaction', $action->action_id) }}">
                                          @csrf
                                          <button type="submit" class="btn btn-outline-primary"  title="Kemaskini">
                                              <i class="bi bi-pencil-fill"></i>
                                          </button>
                                      </form>
                                      <form method="get" action="{{ route('eminit.eminit.vieweminitaction', $action->action_id) }}">
                                          @csrf
                                          <button type="submit" class="btn btn-outline-primary"  title="Lihat">
                                              <i class="bi bi-eye-fill"></i>
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