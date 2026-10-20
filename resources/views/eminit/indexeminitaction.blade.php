@extends('layouts.app-all')

@section('title', 'E-Memo Action')

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- #============= ORI CODE ============== --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: shared styles in public/css/mesh-home-theme.css, --}}
{{-- applied to everything inside the mesh-home-theme wrapper below. Light mode is unchanged. --}}
{{-- <link href="{{ asset('css/mesh-home-theme.css') }}?v={{ filemtime(public_path('css/mesh-home-theme.css')) }}" rel="stylesheet"> --}}
{{-- #================================ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" section; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
{{-- #================================ --}}
<style>
  /* Blue line after the Code column becomes gold */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-home-theme th[style*="border-right"], html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-home-theme td[style*="border-right"] { border-right-color: #f3c35f !important; }
</style>
<div class="mesh-home-theme">
{{-- #================================ --}}

<?php
$pagename = "E-Memo Action";
?>


<style>
.dataTable-info{
    color: white;
}

/* Elegant action buttons */
.action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 16px;
    border-radius: 20px;
    border: 1.5px solid transparent;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.02em;
    background-color: transparent;
    transition: all 0.2s ease-in-out;
}
.action-btn:hover {
    transform: translateY(-1px);
}
.action-btn.btn-view {
    border-color: #2563eb;
    color: #2563eb;
}
.action-btn.btn-view:hover {
    background-color: #2563eb;
    color: #fff;
    box-shadow: 0 4px 10px rgba(37,99,235,0.25);
}
.action-btn.btn-edit {
    border-color: #d97706;
    color: #d97706;
}
.action-btn.btn-edit:hover {
    background-color: #d97706;
    color: #fff;
    box-shadow: 0 4px 10px rgba(217,119,6,0.25);
}
.action-btn.btn-delete {
    border-color: #dc2626;
    color: #dc2626;
}
.action-btn.btn-delete:hover {
    background-color: #dc2626;
    color: #fff;
    box-shadow: 0 4px 10px rgba(220,38,38,0.25);
}
</style>
<div class="col-12 mb-2 mt-2" style="text-align: left;">
        <button type="button" class="btn btn-primary" onclick="window.history.back()">
            <i class="bi bi-arrow-left-circle"></i> Back
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
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">E-Memo Action</h5>


            <div class="card-body overflow-auto">


            <table class="table table-borderless datatable mt-3">
              
                    <thead>
                        <tr>
                            <th scope="col">Category</th>
                            <th scope="col">Memo From</th>
                            <th scope="col">Subject</th>
                            <th scope="col">No Reference (Memo Recieved)</th>
                            <th scope="col">Document</th>
                            <th scope="col">Director Received</th>
                            <th scope="col">Director Remarks</th>
                            <th scope="col" style="border-right: 2px solid blue;">Code</th>
                            <th scope="col">Remarks</th>
                            <th scope="col">Action Status</th>
                            <th scope="col">Memo Status</th>
                            <th scope="col">Action</th>
                            

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
                                    <div class="btn-group flex-wrap gap-1" role="group" aria-label="Document">
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
                                    <span class="text-muted">No documents</span>
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
                                        For Action
                                    </span>
                                    @endif
                                </td>


                                <td>
    <span class="badge rounded-pill
        {{ $action->memo_status_display == 'Completed' ? 'bg-success' : ($action->memo_status_display == 'In-Progress' ? 'bg-info text-dark' : 'bg-warning text-dark') }}">
        {{ $action->memo_status_display }}
    </span>
</td>







                              <!-- <td>action id{{ $action->action_id }}</td>
                              <td>admin id{{ $action->eminit_admin_id }}</td> -->

                              
                              <td>
                                  <div class="d-flex gap-2">
                                      <form method="get" action="{{ route('eminit.eminit.editeminitaction', $action->action_id) }}">
                                          @csrf
                                          <button type="submit" class="action-btn btn-edit">
                                              Edit
                                          </button>
                                      </form>
                                      <form method="get" action="{{ route('eminit.eminit.vieweminitaction', $action->action_id) }}">
                                          @csrf
                                          <button type="submit" class="action-btn btn-view">
                                              View
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
{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
@endsection