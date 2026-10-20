{{-- resources/views/eminit/editeminitadmin.blade.php --}}
@extends('layouts.app-all')

@section('title', 'E-Memo Action')

@push('styles')
  {{-- Select2 CSS (load once) --}}
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
<?php $pagename = "e-minit"; ?>

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

          <div class="row mt-3">
            <div class="col-lg-4 label">No Reference (Memo Recieved)</div>
            <div class="col-lg-8">{{ $eminit->rujukan_tp ?? '-' }}</div>
          </div>

          <!-- <div class="row mt-3">
            <div class="col-lg-4 label">Rujukan Tuan/Puan</div>
            <div class="col-lg-8">{{ $eminit->rujukan_tp ?? '-' }}</div>
          </div> -->

          <div class="row mt-3">
                <div class="col-lg-4 label">Uploaded Document</div>
                <div class="col-lg-8">
                    @if(!empty($eminit->eminit_file))
                        @foreach($eminit->eminit_file as $file)
                            <a href="{{ route('eminit.view.file', basename($file['stored'])) }}"
                              target="_blank"
                              class="btn btn-primary btn-sm mb-2">
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

        {{-- ====== INFO (read-only) ====== --}}
        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; background-color: #1F4E78;">
           E-Memo Information (Director/Assistant Director)
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
                <div class="col-lg-4 label">Action From</div>
                  <div class="col-lg-8">
                      @if(!empty($tindakan_labels))
                          {{ implode(', ', $tindakan_labels) }}
                      @else
                          -
                      @endif
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

        {{-- ====== Action INFO (read-only) ====== --}}
        @if($showActionInfo && $relatedAction)
          {{-- ====== Action INFO (read-only) ====== --}}
          <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
              <h5 class="card-title text-center text-white p-2" style="background-color: #1F4E78;">
                E-Memo Action Information
              </h5>

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
                      <div class="col-lg-8">
                          {{ $relatedAction->no_rujukan ?? '-' }}
                      </div>
                  </div>

                  {{-- Tindakan Dokumen --}}
                      <div class="row mt-3">
                          <div class="col-lg-4 label">Action Document</div>
                          <div class="col-lg-8">
                              @if(!empty($relatedAction->tindakan_file) && count($relatedAction->tindakan_file) > 0)
                                  <ul class="list-unstyled">
                                      @foreach($relatedAction->tindakan_file as $file)
                                          @php
                                              $stored = $file['stored'] ?? basename($file['path'] ?? '');
                                          @endphp
                                          <li>
                                              <i class="bi bi-file-earmark-fill me-1" style="color: #0d6efd;"></i>
                                              <a href="{{ route('eminit.view.tindakan', $stored) }}"
                                                target="_blank">
                                                  {{ $file['original'] ?? $stored }}
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
                      <div class="col-lg-8">
                          {{ $relatedAction->catatan ?? '-' }}
                      </div>
                  </div>

                  {{-- Tindakan Diperlukan --}}
                  <div class="row mt-3">
                      <div class="col-lg-4 label">Action To</div>
                      <div class="col-lg-8">
                          @if(!empty($relatedTindakanLabels))
                              <ul>
                                  @foreach($relatedTindakanLabels as $kod)
                                      <li>{{ $kod }}</li>
                                  @endforeach
                              </ul>
                          @else
                              -
                          @endif
                      </div>
                  </div>

                  {{-- Jenis Tindakan --}}
                  <div class="row mt-3">
                      <div class="col-lg-4 label">Action Type</div>
                      <div class="col-lg-8">
                          @if(!empty($relatedJenisLabels))
                              <ul>
                                  @foreach($relatedJenisLabels as $label)
                                      <li>{{ $label }}</li>
                                  @endforeach
                              </ul>
                          @else
                              -
                          @endif
                      </div>
                  </div>
              </div>
          </div>
          {{-- ====== END Action INFO ====== --}}
      @endif

        {{-- ====== TINDAKAN (editable form) ====== --}}
        <div class="col profile-overview mt-4" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; background-color: #1F4E78;">Action</h5>

          {{-- Show validation errors for this form too --}}
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('eminit.eminit.updateeminitaction', $eminitaction->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            

          {{-- No. Rujukan --}}
            <div class="row" hidden>
                <label class="col-lg-4 label">Reference No</label>
                <div class="col-lg-8">
                    <input type="text" 
                          name="no_rujukan" 
                          class="form-control"
                          value="{{ old('no_rujukan', $eminitaction->no_rujukan) }}">
                </div>
            </div>

                 <!-- Tindakan Dokumen -->
                 <div class="row form-group mb-3">
                  <label class="col-lg-4 label">Action Document</label>

                  <div class="col-lg-8">
                      {{-- Show existing uploaded files --}}
                      @if(!empty($eminitaction->tindakan_file) && count($eminitaction->tindakan_file) > 0)
                            <ul class="list-unstyled mb-3">
                                @foreach($eminitaction->tindakan_file as $file)
                                    <li>
                                        <i class="bi bi-file-earmark-fill me-1" style="color: #0d6efd;"></i>
                                        <a href="{{ $file['url'] ?? asset('storage/' . ($file['path'] ?? '')) }}"
                                          target="_blank">{{ $file['original'] ?? basename($file['path'] ?? '') }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted mb-3">No action documents uploaded.</p>
                        @endif

                      {{-- File upload input section --}}
                      <div id="fileRows">
                          <div class="input-group mb-2 file-row">
                              <input type="file" name="tindakan_file[]" class="form-control">
                              <button type="button" class="btn btn-outline-danger ms-2 remove-row" disabled>Remove</button>
                          </div>
                      </div>

                      <button type="button" id="addFileRow" class="btn btn-outline-secondary mt-2">+ Add file</button>
                  </div>
              </div>

              <script>
              document.addEventListener('DOMContentLoaded', function () {
                  const container = document.getElementById('fileRows');
                  const addBtn = document.getElementById('addFileRow');

                  function updateState() {
                      const rows = container.querySelectorAll('.file-row');
                      rows.forEach((row, idx) => {
                          const remove = row.querySelector('.remove-row');
                          remove.disabled = (rows.length === 1);
                      });
                  }

                  addBtn.addEventListener('click', function () {
                      const row = document.createElement('div');
                      row.className = 'input-group mb-2 file-row';
                      row.innerHTML = `
                          <input type="file" name="tindakan_file[]" class="form-control">
                          <button type="button" class="btn btn-outline-danger ms-2 remove-row">Remove</button>
                      `;
                      container.appendChild(row);
                      updateState();
                  });

                  container.addEventListener('click', function (e) {
                      if (e.target.classList.contains('remove-row')) {
                          const row = e.target.closest('.file-row');
                          if (row) {
                              row.remove();
                              updateState();
                          }
                      }
                  });

                  updateState();
              });
              </script>

            {{-- Catatan --}}
            <div class="row">
                <label class="col-lg-4 label">Remarks</label>
                <div class="col-lg-8">
                    <textarea class="form-control" name="catatan" style="height: 100px;">{{ old('catatan', $eminitaction->catatan) }}</textarea>
                </div>
            </div>

            {{-- Tindakan Diperlukan --}}
            <div class="row">
                <label class="col-lg-4 label">Action To</label>
                <div class="col-lg-8">
                    <select class="form-control select2"
                            id="tindakanDiperlukanSelect"
                            name="tindakan_diperlukan[]"
                            multiple
                            data-placeholder="Select action">
                        @foreach($tindakans as $tindakan)
                            <option value="{{ $tindakan->id }}"
                                {{ (collect(old('tindakan_diperlukan', json_decode($eminitaction->tindakan_diperlukan) ?? []))->contains($tindakan->id)) ? 'selected' : '' }}>
                                {{ $tindakan->kod }}
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first('tindakan_diperlukan', '<p class="help-block text-danger">:message</p>') !!}
                </div>
            </div>

            {{-- Jenis Tindakan --}}
            <div class="row">
                <label class="col-lg-4 label">Action Type</label>
                <div class="col-lg-8">
                    <select class="form-control select2"
                            id="jenisTindakanSelect"
                            name="jenis_tindakan[]"
                            multiple
                            data-placeholder="Select type">
                        @foreach($jenistindakans as $jenis)
                            <option value="{{ $jenis->id }}"
                                {{ (collect(old('jenis_tindakan', json_decode($eminitaction->jenis_tindakan) ?? []))->contains($jenis->id)) ? 'selected' : '' }}>
                                {{ $jenis->label }}
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first('jenis_tindakan', '<p class="help-block text-danger">:message</p>') !!}
                </div>
            </div>

                @php
                    // Get the status from the related eminit_admin
                    $adminStatus = optional($eminitadmin)->status ?? null;
                @endphp

                {{-- Selesai Checkbox --}}
                <div class="row mt-3">
                    <label class="col-lg-4 label">Completed</label>
                    <div class="col-lg-8">
                        <div class="form-check">
                            <input class="form-check-input"
                                  type="checkbox"
                                  name="status"
                                  id="selesai"
                                  value="selesai"
                                  @if(old('status', $adminStatus) === 'selesai') checked @endif>
                            <label class="form-check-label" for="selesai">
                                Memo response has been completed
                            </label>
                        </div>
                    </div>
                </div>








             

            <div class="text-center mt-4">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
      $('#myselect').select2({
      width: '100%',
      placeholder: "",
      allowClear: true
    });
    $('#jenisTindakanSelect').select2({
      width: '100%',
      placeholder: "Select Action Type",
      allowClear: true
    });

    $('#tindakanDiperlukanSelect').select2({
      width: '100%',
      placeholder: "Select action",
      allowClear: true
    });
</script>

<script>
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
    });
  </script>


 



          </section>

@endsection