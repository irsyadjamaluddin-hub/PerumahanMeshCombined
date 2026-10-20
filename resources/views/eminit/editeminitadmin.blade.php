{{-- resources/views/eminit/editeminitadmin.blade.php --}}
@extends('layouts.app-all')

@section('title', 'Edit E-Memo Admin')

@push('styles')
  {{-- Select2 CSS (load once) --}}
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
<?php $pagename = "e-minit"; ?>

@php
  // Lock condition for the Info banner only
  $isLocked = !is_null($eminit->updated_at);

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
  $tarikhDiterima = optional($eminit->created_at)->format('d/m/Y');
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
          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; background-color: #1F4E78;">E-Memo Information</h5>

@forelse ($eminits as $eminit)
          <div class="row mt-3">
            <div class="col-lg-4 label">Date Received</div>
            <div class="col-lg-8">{{ $eminit->created_at}}</div>
          </div>
@empty
<div class="col-lg-8">{{'-' }}</div>
          </div>
@endforelse

          <div class="row mt-3">
            <div class="col-lg-4 label">Category</div>
            <div class="col-lg-8">{{ $jenisLabel }}</div>
          </div>

          <div class="row mt-3" hidden>
            <div class="col-lg-4 label">From</div>
            <div class="col-lg-8">{{ $deptLabel }}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">Memo From</div>
            <div class="col-lg-8">{{ $eminit->memoDepartment->label ?? '-' }}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">To</div>
            <div class="col-lg-8">{!! $kepadaNames !== '' ? $kepadaNames : '-' !!}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">For Attention</div>
            <div class="col-lg-8">{{ $eminit->untukperhatian ?? '-' }}</div>
          </div>

          <div class="row mt-3">
              <div class="col-lg-4 label">Subject</div>
              <div class="col-lg-8" style="font-weight: bold; text-transform: uppercase;">
                  {{ $eminit->perkara ?? '-' }}
              </div>
          </div>

          <div class="row mt-3" hidden>
            <div class="col-lg-4 label">Correspondence Reference</div>
            <div class="col-lg-8">{{ $eminit->rujukan_persuratan ?? '-' }}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">No Reference (Memo Recieved)</div>
            <div class="col-lg-8">{{ $eminit->rujukan_tp ?? '-' }}</div>
          </div>

          <div class="row mt-3">
              <div class="col-lg-4 label">Uploaded Document</div>
              <div class="col-lg-8">
                  @if(count($eminitFiles))
                      @foreach ($eminitFiles as $f)
                          @if(!empty($f['url']))
                              <a href="{{ $f['url'] }}" target="_blank" class="btn btn-primary btn-sm mb-2" title="View Document">
                                  <i class="bi bi-file-earmark"></i>
                                  {{ $f['original'] ?? $f['stored'] ?? 'Document' }}
                              </a><br>
                          @else
                              <span class="text-muted">{{ $f['original'] ?? $f['stored'] ?? 'Document' }}</span><br>
                          @endif
                      @endforeach
                  @else
                      -
                  @endif
              </div>
          </div>


          <div class="row mt-3">
            <div class="col-lg-4 label">Remarks</div>
            <div class="col-lg-8">{{ $eminit->catatan ?? '-' }}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">CC To</div>
            <div class="col-lg-8">{!! $salinanNames !== '' ? $salinanNames : '-' !!}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">CC External</div>
            <div class="col-lg-8">{{ $eminit->salinan ?? '-' }}</div>
          </div>

          <div class="row mt-3">
            <div class="col-lg-4 label">Uploaded CC External Document</div>
            <div class="col-lg-8">
              @if(count($salinanFiles))
                <ul class="mb-0">
                  @foreach ($salinanFiles as $f)
                    <li>
                      @if(!empty($f['url']))
                        <a href="{{ $f['url'] }}" target="_blank">{{ $f['original'] ?? $f['stored'] ?? 'Document' }}</a>
                      @else
                        {{ $f['original'] ?? $f['stored'] ?? 'Document' }}
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
            <div class="col-lg-4 label">Department Reference</div>
            <div class="col-lg-8">{{ $eminit->no_rujukan ?? '-' }}</div>
          </div>
        </div>
{{-- ====== TINDAKAN (editable form) ====== --}}
<div class="col profile-overview mt-4" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
  <h5 class="card-title" style="text-align: center; color: white; padding: 10px; background-color: #1F4E78;">Action</h5>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('eminit.eminit.updateeminitadmin', $eminit->id) }}">
    @csrf
    @method('PUT')

    {{-- No. Rujukan --}}
    <div class="row mb-3" hidden>
      <label class="col-lg-4 label">Reference No</label>
      <div class="col-lg-8">
        <input
          type="text"
          name="no_rujukan"
          class="form-control"
          value="{{ old('no_rujukan', optional($prefill ?? null)->no_rujukan) }}">
      </div>
    </div>

    <input type="hidden" name="eminit_admin_id" 
    value="{{ $prefill->id ?? '' }}">


    {{-- Catatan --}}
    <div class="row mb-3">
      <label class="col-lg-4 label">Remarks</label>
      <div class="col-lg-8">
        <textarea class="form-control" name="catatan" style="height: 100px;">{{ old('catatan', optional($prefill ?? null)->catatan) }}</textarea>
      </div>
    </div>

    @php
      // Selected values for Tindakan Diperlukan
      $selectedTd = old('tindakan_diperlukan', optional($prefill ?? null)->tindakan_diperlukan ?? []);
      if (!is_array($selectedTd)) {
          $decoded = json_decode($selectedTd, true);
          $selectedTd = is_array($decoded) ? $decoded : array_filter(array_map('trim', explode(',', (string) $selectedTd)));
      }
      $selectedTd = array_map('strval', $selectedTd);

      // Selected values for Jenis Tindakan
      $selectedJenis = old('jenis_tindakan', optional($prefill ?? null)->jenis_tindakan ?? []);
      if (!is_array($selectedJenis)) {
          $decoded = json_decode($selectedJenis, true);
          $selectedJenis = is_array($decoded) ? $decoded : array_filter(array_map('trim', explode(',', (string) $selectedJenis)));
      }
      $selectedJenis = array_map('strval', $selectedJenis);
    @endphp

    <!-- Tindakan Diperlukan -->
    <div class="row mb-3">
      <label class="col-lg-4 label">Action To</label>
      <div class="col-lg-8">
        <select class="form-control select2" id="myselect" name="tindakan_diperlukan[]" multiple required>
          @foreach (($eminit_Tindakandiperlukan ?? []) as $key => $value)
            @php $keyStr = (string) $key; @endphp
            <option value="{{ $keyStr }}" {{ in_array($keyStr, $selectedTd, true) ? 'selected' : '' }}>
              {{ $value }}
            </option>
          @endforeach
        </select>
        {!! $errors->first('tindakan_diperlukan', '<p class="help-block text-danger">:message</p>') !!}
      </div>
    </div>

    <!-- Jenis Tindakan -->
    <div class="row mb-3">
      <label class="col-lg-4 label">Action Type</label>
      <div class="col-lg-8">
        <select class="form-control select2" id="jenisTindakanSelect" name="jenis_tindakan[]" multiple>
          @foreach (($tindakan ?? []) as $key => $value)
            @php $keyStr = (string) $key; @endphp
            <option value="{{ $keyStr }}" {{ in_array($keyStr, $selectedJenis, true) ? 'selected' : '' }}>
              {{ $value }}
            </option>
          @endforeach
        </select>
        {!! $errors->first('jenis_tindakan', '<p class="help-block text-danger">:message</p>') !!}
      </div>
    </div>

       <!-- Hidden IC -->
       <input type="hidden" name="created_by" value="{{ Auth::user()->ic_no }}">

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

    $('#tindakanSelect').select2({
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


  <script>
  
   $(document).ready(function(){

       // Initialize select2
       $("#myselection").select2();

       // Read selected option
       $('#but_read').click(function(){
       var username = $('#myselection option:selected').text();
       var userid = $('#myselection').val();

       $('#result').html("id : " + userid + ", name : " + username);

       });
       });
</script>

<script>
            var submitButton = document.getElementById('submit-button');
            var form = document.getElementById('mecmedfile_form');
            
           

            var form = document.getElementById('pdf_form');

            $(document).ready(function() {
                // Add new file input field when the "Add" button is clicked
                $(document).on("click", ".add-file-input", function() {
                    var fileInputContainer = $(this).closest("#file-input-container"); // Get the closest file input container
                    var clonedFileInput = fileInputContainer.find(".pdf-file-input").first().clone(); // Clone the first file input field
                    var removeButton = "<button type='button' class='btn btn-primary remove-file-input'>Remove</button>"; // Create the remove button
                    var newRow = $("<div class='row mb-3'><div class='col-md-6'>" + clonedFileInput[0].outerHTML + "</div><div class='col-md-6'>" + removeButton + "</div></div>"); // Create the new row with the cloned file input and remove button
                    newRow.appendTo(fileInputContainer); // Append the new row to the file input container
                });

                // Remove file input field when the "Remove" button is clicked
                $(document).on("click", ".remove-file-input", function() {
                    $(this).closest(".row.mb-3").remove(); // Remove the closest file input container
                });
            });

            $(document).ready(function() {
                // Add new file input field when the "Add" button is clicked
                $(document).on("click", ".add-lampfile-input", function() {
                    var fileInputContainer = $(this).closest("#lampfile-input-container"); // Get the closest file input container
                    var clonedFileInput = fileInputContainer.find(".pdf-lampfile-input").first().clone(); // Clone the first file input field
                    var removeButton = "<button type='button' class='btn btn-primary remove-lampfile-input'>Remove</button>"; // Create the remove button
                    var newRow = $("<div class='row mb-3'><div class='col-md-6'>" + clonedFileInput[0].outerHTML + "</div><div class='col-md-6'>" + removeButton + "</div></div>"); // Create the new row with the cloned file input and remove button
                    newRow.appendTo(fileInputContainer); // Append the new row to the file input container
                });

                // Remove file input field when the "Remove" button is clicked
                $(document).on("click", ".remove-lampfile-input", function() {
                    $(this).closest(".row.mb-3").remove(); // Remove the closest file input container
                });
            });
        </script>

          </section>
@endsection
