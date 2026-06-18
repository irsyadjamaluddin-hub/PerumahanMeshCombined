@extends('layouts.app-all')

@section('title', 'E-Memo Admin')

@section('content')

<?php
$pagename = "E-Memo Admin";
?>


<style>                
.dataTable-info{
    color: white;
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
        <i class="bi bi-arrow-left-circle"></i> Kembali
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
                            <th scope="col">Jenis</th>
                            <th scope="col">Tarikh</th>
                            <th scope="col">Memo Daripada</th>
                            <th scope="col">Kepada</th>
                            <th scope="col">Perkara</th>
                            <th scope="col">Rujukan (Memo Diterima)</th>
                            <th scope="col">Dokumen</th>
                            <th scope="col">Admin Catatan</th>
                            <th scope="col">Admin Menerima</th>
                            <th scope="col"><i class="fas fa-users"></i> Tindakan Status</th>
                            <th scope="col">Tindakan</th>
                            <th scope="col">Disediakan Oleh</th>


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

                              $label = $f['original'] ?? basename($f['path'] ?? $f['stored'] ?? $url ?? '') ?: 'Dokumen';
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
                                    <div class="btn-group flex-wrap gap-1" role="group" aria-label="Dokumen">
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
                                    <span class="text-muted">Tiada dokumen</span>
                                  @endif
                                </td>

                                @php
                                $ts = optional($eminit->latestAdminEntry)->catatan;
                                @endphp
                                <td>
                                @if($ts)
                                    {{$ts}}
                                @else
                                    <span class="text-muted">Tiada Catatan</span>
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
                                      <i class="bi bi-hourglass-split me-1"></i>Belum Diterima
                                    </span>
                                  @endif
                                </td>

                     <td>
                      @php
                          $status = $latestStatuses[$eminit->id] ?? 'belum diterima';
                      @endphp

                      <span class="badge rounded-pill 
                          {{ $status === 'selesai' ? 'bg-success' : ($status === 'in-progress' ? 'bg-info text-dark' : 'bg-warning text-dark') }}">
                          {{ ucfirst($status) }}
                      </span>
                  </td>




                                

                                

                  



        

                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('eminit.eminit.editeminitadmin', $eminit->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary"  title="Kemaskini">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </form>
                                        {{--View button--}}
                                        <form method="get" action="{{ route('eminit.eminit.vieweminitadmin', $eminit->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary"  title="Lihat">
                                                <i class="bi bi-eye-fill"></i>
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
@endsection