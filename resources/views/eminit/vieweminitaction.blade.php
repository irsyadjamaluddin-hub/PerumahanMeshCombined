{{-- resources/views/eminit/editeminitadmin.blade.php --}}
@extends('layouts.app-all')

@section('title', 'E-Memo Action')

@push('styles')
  {{-- Select2 CSS (load once) --}}
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
<?php $pagename = "e-minit action"; ?>



<section class="section profile">
  <a href="{{ route('eminit.eminit.indexeminitaction') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">
      <div class="card-body">

        {{-- ====== INFO (read-only) ====== --}}
        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; background-color: #1F4E78;">E-Memo Information</h5>

          <div class="row mt-3">
            <div class="col-lg-4 label">Date Received</div>
            <div class="col-lg-8">{{ $eminit->created_at ?? '-' }}</div>
          </div>

          <div class="row mt-3">
              <div class="col-lg-4 label">Category</div>
              <div class="col-lg-8">{{ $eminit_jenis }}</div>
          </div>


          <div class="row mt-3" hidden>
              <div class="col-lg-4 label">From</div>
              <div class="col-lg-8">{{ $eminit_daripada }}</div>
          </div>

          <div class="row mt-3">
              <div class="col-lg-4 label">Memo From</div>
              <div class="col-lg-8">{{ $eminit->memoDepartment->label ?? '-' }}</div>
          </div>


       <div class="row mt-3">
            <div class="col-lg-4 label">To</div>
            <div class="col-lg-8">
                @if(!empty($eminit_kepada))
                    {{ implode(', ', $eminit_kepada) }}
                @else
                    <span class="text-muted">No Recipient</span>
                @endif
            </div>
        </div>




          <div class="row mt-3">
            <div class="col-lg-4 label">For Attention</div>
            <div class="col-lg-8">
              @if(!empty($eminit->untukperhatian))
                {{ is_array($eminit->untukperhatian) ? implode(', ', $eminit->untukperhatian) : $eminit->untukperhatian }}
              @else
                -
              @endif
            </div>
          </div>

          <div class="row mt-3">
              <div class="col-lg-4 label">Subject</div>
              <div class="col-lg-8" style="font-weight: bold; text-transform: uppercase;">
                  {{ $eminit->perkara ?? '-' }}
              </div>
          </div>



          <div class="row mt-3" hidden>
            <div class="col-lg-4 label">Correspondence Reference</div>
            <div class="col-lg-8">{{ $eminit->rujukan_tp ?? '-' }}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">No Reference (Memo Recieved)</div>
            <div class="col-lg-8">{{ $eminit->rujukan_tp ?? '-' }}</div>
          </div>

          <div class="row mt-3">
          <div class="col-lg-4 label">Uploaded Document</div>
          <div class="col-lg-8">
              @if(!empty($eminit->eminit_file))
                  @foreach($eminit->eminit_file as $file)
                      <a href="{{ $file['url'] }}" target="_blank" class="btn btn-primary btn-sm mb-2">
                          <i class="bi bi-file-earmark"></i> {{ $file['original'] }}
                      </a><br>
                  @endforeach
              @else
                  -
              @endif
          </div>
      </div>


          <div class="row mt-3">
            <div class="col-lg-4 label">Remarks</div>
            <div class="col-lg-8">
              {{ $eminit->catatan ?? '-' }}
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">CC To</div>
            <div class="col-lg-8">
              @if(!empty($eminit->salinan))
                {{ is_array($eminit->salinan) ? implode(', ', $eminit->salinan) : $eminit->salinan }}
              @else
                -
              @endif
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">CC External</div>
            <div class="col-lg-8">
               @if(!empty($eminit->salinan_dokumen))
                  {{ is_array($eminit->salinan_dokumen) ? implode(', ', $eminit->salinan_dokumen) : $eminit->salinan_dokumen }}
                @else
                  -
                @endif
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">Uploaded CC External Document</div>
            <div class="col-lg-8">
               @if(!empty($eminit->salinan_kepada))
                  @foreach($eminit->salinan_kepada as $file)
                    <a href="{{ $file['url'] }}" target="_blank">{{ $file['original'] }}</a><br>
                  @endforeach
                @else
                  -
                @endif

            </div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">Department Reference</div>
            <div class="col-lg-8">{{ $eminit->no_rujukan ?? '-' }}</div>
          </div>
        </div>
        {{-- ====== END INFO ====== --}}

        <br>

        {{-- ====== INFO (read-only) ====== --}}
        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; background-color: #1F4E78;">
            E-Memo Information (Assistant Director/Director)
        </h5>
            <div class="mt-3 p-3" style="border:1px dashed #1F4E78; border-radius: 12px;">
            {{-- Tarikh Diterima --}}
            <div class="row mt-3">
                <div class="col-lg-4 label">Date Received</div>
                     <div class="col-lg-8">{{ $eminitadmin->created_at ?? '-' }}</div>
            </div>

            {{-- No Rujukan --}}
            <div class="row mt-3" hidden>
                <div class="col-lg-4 label">Reference No</div>
                <div class="col-lg-8">{{ $eminitadmin->no_rujukan ?? '-' }}</div>
            </div>

            {{-- Catatan --}}
            <div class="row mt-3">
                <div class="col-lg-4 label">Remarks</div>
                <div class="col-lg-8">{{ $eminitadmin->catatan ?? '-' }}

                </div>
            </div>


            <div class="row mt-3">
            <div class="col-lg-4 label">Action To</div>
                  <div class="col-lg-8">
                      @if(!empty($tindakan_labels))
                          {{ implode(', ', $tindakan_labels) }}
                      @else
                          -
                      @endif
                  </div>
              </div>

              <div class="row mt-3">
                  <div class="col-lg-4 label">Action Type</div>
                  <div class="col-lg-8">
                      @if(!empty($jenis_labels))
                          {{ implode(', ', $jenis_labels) }}
                      @else
                          -
                      @endif
                  </div>
              </div>
            </div>
        </div>
        {{-- ====== END INFO ====== --}}

        <br>

        {{-- ====== Action INFO (read-only) ====== --}}

        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px; margin-top:20px;">
            <h5 class="card-title text-center text-white p-2" style="background-color:rgb(102, 0, 128);">
              E-Memo Action Information
            </h5>

            @if($relatedActions->isNotEmpty())
              @foreach($relatedActions as $relatedAction)

            <div class="mt-3 p-3" style="border:1px dashed #1F4E78; border-radius: 12px;">
                {{-- Tarikh Diterima --}}
                <div class="row mt-3">
                    <div class="col-lg-4 label">Date Received</div>
                    <div class="col-lg-8">
                        {{ $relatedAction->created_at ? $relatedAction->created_at->format('d/m/Y H:i') : '-' }}
                    </div>
                </div>

                {{-- No Rujukan --}}
                <div class="row mt-3" hidden>
                    <div class="col-lg-4 label">Reference No</div>
                    <div class="col-lg-8">{{ $relatedAction->no_rujukan ?? '-' }}</div>
                </div>

                {{-- Tindakan Dokumen --}}
                <div class="row mt-3">
                    <div class="col-lg-4 label">Action Document</div>
                    <div class="col-lg-8">
                        @if(!empty($relatedAction->tindakan_file) && count($relatedAction->tindakan_file) > 0)
                            <ul class="list-unstyled">
                                @foreach($relatedAction->tindakan_file as $file)
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
                    <div class="col-lg-4 label">Remarks</div>
                    <div class="col-lg-8">{{ $relatedAction->catatan ?? '-' }}</div>
                </div>

                {{-- Tindakan Diperlukan --}}
                <div class="row mt-3">
                    <div class="col-lg-4 label">Action To</div>
                    <div class="col-lg-8">
                       @if(!empty($relatedAction->tindakan_labels))
                          <ul>
                              @foreach($relatedAction->tindakan_labels as $kod)
                                  <li>{{ $kod }}</li>
                              @endforeach
                          </ul>
                      @else
                          -
                      @endif

                    </div>
                </div>

             {{-- Tindakan Daripada (only for related actions, not current action) --}}
              @if(!$loop->first)
                  <div class="row mt-3">
                      <div class="col-lg-4 label">Action From</div>
                      <div class="col-lg-8">
                          {{ $relatedAction->tindakan_daripada_kod ?? '-' }}
                      </div>
                  </div>
              @endif



                {{-- Jenis Tindakan --}}
                <div class="row mt-3">
                    <div class="col-lg-4 label">Action Type</div>
                    <div class="col-lg-8">
                        @if(!empty($relatedAction->jenis_labels))
                            <ul>
                                @foreach($relatedAction->jenis_labels as $label)
                                    <li>{{ $label }}</li>
                                @endforeach
                            </ul>
                        @else
                            -
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>


    
@endif

  

</section>

@endsection