{{-- resources/views/eminit/editeminitadmin.blade.php --}}
@extends('layouts.app-all')

@section('title', 'Lihat E-Memo Admin')

@push('styles')
  {{-- Select2 CSS (load once) --}}
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
<?php $pagename = "e-minit"; ?>

@php
  // Lookups for Info
  $jenisLabel = $jenis[$eminit->jenis] ?? ('ID '.$eminit->jenis);
  $deptLabel  = optional(optional($employments->first())->department)->label ?? '-';

  $kepadaNames = collect((array)($eminit->kpd ?? []))
      ->map(fn($id) => $kepada[$id] ?? 'ID '.$id)
      ->implode('<br>');

  $salinanNames = collect((array)($eminit->salinan_kepada ?? []))
      ->map(fn($id) => $kepada[$id] ?? 'ID '.$id)
      ->implode('<br>');

  $eminitFiles   = (array)($eminit->eminit_file ?? []);
  $salinanFiles  = (array)($eminit->salinan_dokumen ?? []);
  $tarikhDiterima = ($eminit->created_at);
@endphp

<section class="section profile">
  <a href="{{ route('eminit.eminit.indexeminitadmin') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">
      <div class="card-body">

        {{-- ====== INFO (read-only) ====== --}}

        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; background-color: #1F4E78;">Maklumat E-Memo</h5>

          <div class="row mt-3">
            <div class="col-lg-4 label">Tarikh Diterima</div>
            <div class="col-lg-8">{{ $tarikhDiterima ?? '-' }}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">Jenis</div>
            <div class="col-lg-8">{{ $jenisLabel }}</div>
          </div>

          <div class="row mt-3" hidden>
            <div class="col-lg-4 label">Daripada</div>
            <div class="col-lg-8">{{ $deptLabel }}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">Memo Daripada</div>
            <div class="col-lg-8">{{ $eminit->memoDepartment->label ?? '-' }}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">Kepada</div>
            <div class="col-lg-8">{!! $kepadaNames !== '' ? $kepadaNames : '-' !!}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">Untuk Perhatian</div>
            <div class="col-lg-8">{{ $eminit->untukperhatian ?? '-' }}</div>
          </div>

          <div class="row mt-3">
              <div class="col-lg-4 label">Perkara</div>
              <div class="col-lg-8" style="font-weight: bold; text-transform: uppercase;">
                  {{ $eminit->perkara ?? '-' }}
              </div>
          </div>

         

          <div class="row mt-3" hidden>
            <div class="col-lg-4 label">Rujukan Persuratan</div>
            <div class="col-lg-8">{{ $eminit->rujukan_persuratan ?? '-' }}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">Rujukan (Memo Diterima) </div>
            <div class="col-lg-8">{{ $eminit->rujukan_tp ?? '-' }}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">Muat Naik Dokumen</div>
            <div class="col-lg-8">
                @if(count($eminitFiles))
                    @foreach ($eminitFiles as $f)
                        @if(!empty($f['url']))
                            <a href="{{ $f['url'] }}" target="_blank" class="btn btn-primary btn-sm mb-2">
                                <i class="bi bi-file-earmark"></i> {{ $f['original'] ?? $f['stored'] ?? 'Dokumen' }}
                            </a><br>
                        @else
                            <span class="btn btn-secondary btn-sm mb-2 disabled">
                                <i class="bi bi-file-earmark"></i> {{ $f['original'] ?? $f['stored'] ?? 'Dokumen' }}
                            </span><br>
                        @endif
                    @endforeach
                @else
                    -
                @endif
            </div>
        </div>


          <div class="row mt-3">
            <div class="col-lg-4 label">Catatan</div>
            <div class="col-lg-8">{{ $eminit->catatan ?? '-' }}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">Salinan</div>
            <div class="col-lg-8">{!! $salinanNames !== '' ? $salinanNames : '-' !!}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">Salinan Persuratan Luar</div>
            <div class="col-lg-8">{{ $eminit->salinan ?? '-' }}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">Muat Naik Dokumen Persuratan Luar</div>
            <div class="col-lg-8">
              @if(count($salinanFiles))
                <ul class="mb-0">
                  @foreach ($salinanFiles as $f)
                    <li>
                      @if(!empty($f['url']))
                        <a href="{{ $f['url'] }}" target="_blank">{{ $f['original'] ?? $f['stored'] ?? 'Dokumen' }}</a>
                      @else
                        {{ $f['original'] ?? $f['stored'] ?? 'Dokumen' }}
                      @endif
                    </li>
                  @endforeach
                </ul>
              @else
                -
              @endif
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">Rujukan Jabatan</div>
            <div class="col-lg-8">{{ $eminit->no_rujukan ?? '-' }}</div>
          </div>
        </div>
        {{-- ====== END INFO ====== --}}

        <br>

        {{-- ====== INFO (read-only) ====== --}}
        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; background-color: #1F4E78;">
            Maklumat E-Memo Pengarah/ Penolong Pengarah
        </h5>

        @forelse($admins as $admin)
            <div class="mt-3 p-3" style="border:1px dashed #1F4E78; border-radius: 12px;">
            {{-- Tarikh Diterima --}}
            <div class="row mt-3">
                <div class="col-lg-4 label">Tarikh Diterima</div>
                <div class="col-lg-8">{{$admin->created_at ?? '-'}}
                </div>
            </div>

            {{-- No Rujukan --}}
            <div class="row mt-3" hidden>
                <div class="col-lg-4 label">No Rujukan</div>
                <div class="col-lg-8">{{ $admin->no_rujukan ?? '-' }}</div>
            </div>

            {{-- Catatan --}}
            <div class="row mt-3">
                <div class="col-lg-4 label">Catatan</div>
                <div class="col-lg-8">
                @php $cat = $admin->catatan ?? '-'; @endphp
                {{ is_array($cat) ? implode(', ', array_filter($cat)) : ($cat ?? '-') }}
                </div>
            </div>

              {{-- Tindakan Diperlukan (array of IDs -> kod via $eminit_TindakandiperlukanMap) --}}
              <div class="row mt-3">
                  <div class="col-lg-4 label">Kepada</div>
                  <div class="col-lg-8">
                      @php
                          $td = (array) ($admin->tindakan_diperlukan ?? []);
                          $td = array_map('strval', $td); // cast IDs to string to match map keys
                      @endphp
                      {{ collect($td)->map(fn($id) => $eminit_TindakandiperlukanMap[$id] ?? $id)->implode(', ') ?: '-' }}
                  </div>
              </div>


            {{-- Jenis Tindakan (array of IDs -> labels via $jenisTindakanMap) --}}
            <div class="row mt-3">
                <div class="col-lg-4 label">Jenis Tindakan</div>
                <div class="col-lg-8">
                @php
                    $jt = (array) ($admin->jenis_tindakan ?? []);
                    $jt = array_map('strval', $jt);
                @endphp
                {{ collect($jt)->map(fn($id) => $jenisTindakanMap[$id] ?? $id)->implode(', ') ?: '-' }}
                </div>
            </div>

            {{-- Tindakan Daripada --}}
              <div class="row mt-3">
                  <div class="col-lg-4 label">Tindakan Daripada</div>
                  <div class="col-lg-8">
                      {{
                          optional(
                              \App\Models\Eminit_Tindakandiperlukan::where('ic_no', $admin->created_by)->first()
                          )->kod
                          ? \Illuminate\Support\Str::title(
                              optional(
                                  \App\Models\Eminit_Tindakandiperlukan::where('ic_no', $admin->created_by)->first()
                              )->kod
                          )
                          : '-'
                      }}
                  </div>
              </div>
                        </div>

            
        @empty
            <div class="alert alert-secondary mt-3">Belum ada maklumat E-Memo Pengarah/ Penolong Pengarah</div>
        @endforelse
        </div>

        <br>
        {{-- ====== END INFO ====== --}}
        {{-- ====== INFO (read-only) ====== --}}
        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; background-color: #1F4E78;">
            Maklumat E-Memo Tindakan
        </h5>

        @forelse($eminitActions as $action)
        <div class="mt-3 p-3" style="border:1px dashed #1F4E78; border-radius: 12px;">
            
            {{-- Tarikh Diterima --}}
            <div class="row mt-3">
                <div class="col-lg-4 label">Tarikh Diterima</div>
                <div class="col-lg-8">
                    {{ $action->created_at?->format('d/m/Y H:i') ?? '-' }}
                </div>
            </div>

            {{-- No Rujukan --}}
            <div class="row mt-3" hidden>
                <div class="col-lg-4 label">No Rujukan</div>
                <div class="col-lg-8">
                    {{ $action->no_rujukan ?? '-' }}
                </div>
            </div>

            {{-- Tindakan Dokumen --}}
                <div class="row mt-3">
                    <div class="col-lg-4 label">Tindakan Dokumen</div>
                    <div class="col-lg-8">
                        @if(!empty($action->tindakan_file) && count($action->tindakan_file) > 0)
                            <ul class="list-unstyled">
                                @foreach($action->tindakan_file as $file)
                                    <li>
                                        <i class="bi bi-file-earmark-fill me-1" style="color: #0d6efd;"></i>
                                        <a href="{{ $file['url'] ?? asset('storage/' . ($file['path'] ?? '')) }}" target="_blank">
                                            {{ $file['original'] ?? basename($file['path'] ?? '') }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            -
                        @endif
                    </div>
                </div>

            {{-- Catatan --}}
            <div class="row mt-3">
                <div class="col-lg-4 label">Catatan</div>
                <div class="col-lg-8">
                    {{ $action->catatan ?? '-' }}
                </div>
            </div>

        {{-- Tindakan Diperlukan --}}
        <div class="row mt-3">
            <div class="col-lg-4 label">Kepada</div>
            <div class="col-lg-8">
                {{ $action->display_tindakanby_kod ?? '-' }}
            </div>
        </div>

    {{-- Tindakan Daripada --}}
      <div class="row mt-3">
          @if(!empty($action->display_tindakan_daripada))
              <div class="col-lg-4 label">Tindakan Daripada</div>
              <div class="col-lg-8">
                  {{ $action->display_tindakan_daripada }}
              </div>
          @endif
      </div>




        </div>
    @empty
        <div class="alert alert-secondary mt-3">
            Belum ada maklumat e-minit action.
        </div>
    @endforelse
        
        </div>
        {{-- ====== END INFO ====== --}}
</section>

@endsection