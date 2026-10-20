@extends('layouts.app-all')

@section('title', 'E-Memo Admin')

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
<div class="mesh-home-theme">
{{-- #================================ --}}

<?php
$pagename = "E-Memo Admin";
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

<section class="section">
<div class="row">

    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif
    <div class="col-12 mb-2 mt-2" style="text-align: left;">
    <button type="button" class="btn btn-primary"
        onclick="window.location.href='{{ route('servicesdashboard', ['open' => 'EMT']) }}'">
        <i class="bi bi-arrow-left-circle"></i> Back
    </button>
    </div>
    <div class="col-12">
        <div class="card">
            

            <br>
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">E-Memo Admin</h5>


            <div class="card-body overflow-auto">


            <table class="table table-borderless datatable mt-3">
              
                    <thead>
                        <tr>
                            <th scope="col">Category</th>
                            <th scope="col">Date</th>
                            <th scope="col">Memo From</th>
                            <th scope="col">To</th>
                            <th scope="col">Subject</th>
                            <th scope="col">No Reference (Memo Recieved)</th>
                            <th scope="col">Document</th>
                            <th scope="col">Admin Remarks</th>
                            <th scope="col">Admin Received</th>
                            <th scope="col"><i class="fas fa-users"></i> Action Status</th>
                            <th scope="col">Action</th>
                            <th scope="col">Prepared By</th>


                        </tr>
                    </thead>

                    <tbody>
                        @if(count($eminits) == 0)
                        <tr class="text-center">
                            <td colspan="9">
                                <h5>No records found</h5>
                            </td>
                        </tr>

                        @else

                        @foreach($eminits as $eminit)

                        @php
                          // Normalize to an array of files
                          $raw = $eminit->eminit_file ?? null;

                          if (is_string($raw)) {
                              $decoded = json_decode($raw, true);
                              $files = json_last_error() === JSON_ERROR_NONE ? $decoded : ($raw ? [ ['path' => $raw] ] : []);
                          } elseif (is_array($raw)) {
                              $files = $raw;
                          } else {
                              $files = [];
                          }

                          // Map to [{url, label}]
                          $items = collect($files)->map(function ($f) {
                              if (is_string($f)) {
                                  return ['url' => Storage::url($f), 'label' => basename($f)];
                              }
                              $url =
                                  $f['url'] ??
                                  (isset($f['path'])   ? Storage::url($f['path'])   : null) ??
                                  (isset($f['stored']) ? Storage::url('eminit/'.$f['stored']) : null);

                              $label = $f['original'] ?? basename($f['path'] ?? $f['stored'] ?? $url ?? '') ?: 'Document';
                              return $url ? ['url' => $url, 'label' => $label] : null;
                          })->filter()->values();
                        @endphp
                            <tr>

                                <td>{{ $jenisMap[(int)($eminit->jenis ?? 0)] ?? '-' }}</td>
                                
                                <td>{{ $eminit->created_at}}</td>
                                <td>{{ $eminit->memoDepartment->label ?? '-' }}</td>

                                @php
                                $ids = (array) ($eminit->kpd ?? []);
                                $names = array_map(fn($id) => $labelsById[$id] ?? "ID {$id}", $ids);
                                @endphp
                                <td>{{ implode(', ', $names) }}</td>
                                <td style="font-weight: bold; text-transform: uppercase;">{{$eminit->perkara}}</td>
                                <td>{{$eminit->rujukan_tp}}</td>

                                <td>
                                  @if($items->isNotEmpty())
                                    <div class="btn-group flex-wrap gap-1" role="group" aria-label="Document">
                                      @foreach($items as $i => $file)
                                        <a href="{{ $file['url'] }}" target="_blank"
                                          class="btn btn-success btn-sm"
                                          data-bs-toggle="tooltip"
                                          title="{{ $file['label'] }}">
                                          <i class="bi bi-file-earmark-text"></i> {{-- or show #{{ $i+1 }} if you prefer --}}
                                        </a>
                                      @endforeach
                                    </div>
                                  @else
                                    <span class="text-muted">No documents</span>
                                  @endif
                                </td>

                                @php
                                $ts = optional($eminit->latestAdminEntry)->catatan;
                                @endphp
                                <td>
                                @if($ts)
                                    {{$ts}}
                                @else
                                    <span class="text-muted">No Remarks</span>
                                @endif
                                </td>

                                @php
                                  $raw = $admindates[$eminit->id] ?? null;
                                  $ts  = $raw ? \Carbon\Carbon::parse($raw) : null;  // pluck returns string
                                @endphp
                                <td>
                                  @if($ts)
                                    {{ $ts->timezone('Asia/Brunei')->format('d/m/Y, H:i') }}
                                  @else
                                    <span class="badge rounded-pill bg-secondary">
                                      <i class="bi bi-hourglass-split me-1"></i>Not Yet Received
                                    </span>
                                  @endif
                                </td>

                     <td>
                      @php
                          $status = $latestStatuses[$eminit->id] ?? 'Not Received';
                      @endphp

                      <span class="badge rounded-pill
                          {{ $status === 'Completed' ? 'bg-success' : ($status === 'In Progress' ? 'bg-info text-dark' : 'bg-warning text-dark') }}">
                          {{ $status }}
                      </span>
                  </td>




                                

                                

                  



        

                                <td>
                                    <div class="d-flex gap-2">
                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('eminit.eminit.editeminitadmin', $eminit->id ) }}">
                                            @csrf
                                            <button type="submit" class="action-btn btn-edit">
                                                Edit
                                            </button>
                                        </form>
                                        {{--View button--}}
                                        <form method="get" action="{{ route('eminit.eminit.vieweminitadmin', $eminit->id ) }}">
                                            @csrf
                                            <button type="submit" class="action-btn btn-view">
                                                View
                                            </button>
                                        </form>
                                    </div>

                                </td>

                                <td>
                                        {{
                                            optional(
                                                \App\Models\Eminit_Tindakandiperlukan::where('ic_no', $eminit->ic_no)->first()
                                            )->kod
                                            ? \Illuminate\Support\Str::title(
                                                optional(
                                                    \App\Models\Eminit_Tindakandiperlukan::where('ic_no', $eminit->ic_no)->first()
                                                )->kod
                                            )
                                            : '-'
                                        }}
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