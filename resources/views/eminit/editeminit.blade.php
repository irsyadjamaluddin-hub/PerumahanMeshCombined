@extends('layouts.app-all')

@section('title', 'Edit E-Memo')

@section('content')
<?php $pagename = "e-minit"; ?>

<section class="section profile">

  <a href="{{ route('eminit.eminit.indexeminit') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  @foreach($eminits as $eminit)
  <div class="col-12">
    <div class="card pt-3">
      <div class="card-body">

        {{-- Errors --}}
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('eminit.eminit.updateeminit', $eminit->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

          <!-- Daripada (Dihantar oleh) -->
          <div class="row mb-3 justify-content-end">
              <div class="col-lg-6 col-md-8 col-sm-12 d-flex justify-content-end align-items-center">
                  <label class="col-form-label me-2 text-end label">
                      from Department:
                  </label>
                  <div class="flex-grow-1">
                      @foreach($employments as $employment)
                          <input type="text" 
                                class="form-control mb-2 w-100" 
                                value="{{ optional($employment->department)->label }}" 
                                readonly>
                          <input type="hidden" 
                                name="daripada" 
                                value="{{ old('daripada', $employment->department_id ?? $eminit->daripada) }}">
                      @endforeach
                  </div>
              </div>
          </div>
          <!-- Daripada (Dihantar oleh) -->

            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; background-color: #1F4E78;">Edit E-Memo</h5>
            <br>

            {{-- Jenis --}}
            <div class="row">
              <label class="col-lg-4 label">Category</label>
              <div class="col-lg-8">
                <select class="form-select" name="jenis">
                  <option value="">-- Select Category --</option>
                  @foreach ($jenis as $key => $value)
                    <option value="{{ $key }}" {{ (string)old('jenis', $eminit->jenis) === (string)$key ? 'selected' : '' }}>
                      {{ $value }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

          

            {{-- Memo Daripada --}}
            <div class="row">
              <label class="col-lg-4 label">Memo From <i style="color:red;">*</i></label>
              <div class="col-lg-8">
                <select class="form-select" name="memo_daripada" required>
                  <option value="">-- Select Memo From --</option>
                  @foreach ($departments as $dept)
                    <option value="{{ $dept->id }}" {{ (string)old('memo_daripada', $eminit->memo_daripada) === (string)$dept->id ? 'selected' : '' }}>
                      {{ $dept->label }}
                    </option>
                  @endforeach
                </select>
                {!! $errors->first('memo_daripada', '<div class="text-danger small mt-1">:message</div>') !!}
              </div>
            </div>

            {{-- Kepada --}}
            <div class="row">
              <div class="col-lg-4 label">To <i style="color:red;">*</i></div>
              <div class="col-lg-8">
                @php
                  $selectedKpd = old('kpd', (array)($eminit->kpd ?? []));
                @endphp
                <select class="form-control select2" id="myselect" name="kpd[]" multiple="multiple" required>
                  <option></option>
                  @foreach ($kepada as $key => $value)
                    <option value="{{ $key }}" {{ in_array((string)$key, array_map('strval', $selectedKpd), true) ? 'selected' : '' }}>
                      {{ $value }}
                    </option>
                  @endforeach
                </select>
                {!! $errors->first('kpd', '<p class="help-block text-danger">:message</p>') !!}
              </div>
            </div>

            {{-- Untuk Perhatian --}}
            <div class="row">
              <label class="col-lg-4 label">For Attention</label>
              <div class="col-lg-8">
                <select class="form-select" name="untukperhatian">
                  <option value="">-- Select FA --</option>
                  @foreach ($Eminit_Untukperhatian as $value)
                    <option value="{{ $value }}" {{ old('untukperhatian', $eminit->untukperhatian) === $value ? 'selected' : '' }}>
                      {{ $value }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            {{-- Perkara --}}
              <div class="row">
                <label class="col-lg-4 label">Subject <i style="color:red;">*</i></label>
                <div class="col-lg-8">
                  <input type="text" name="perkara" class="form-control" 
                        value="{{ old('perkara', $eminit->perkara) }}"
                        style="font-weight: bold; text-transform: uppercase;">
                </div>
              </div>

            {{-- Rujukan Tuan/Puan --}}
            <div class="row">
              <label class="col-lg-4 label">No Reference (Memo Recieved)</label>
              <div class="col-lg-8">
                <input type="text" name="rujukan_tp" class="form-control" value="{{ old('rujukan_tp', $eminit->rujukan_tp) }}">
              </div>
            </div>

            {{-- E-Memo Dokumen (Sedia Ada) --}}
<div class="row form-group mb-2">
    <label class="col-lg-4 label">e-Memo Document (Existing)</label>
    <div class="col-lg-8">
        @php $existingFiles = (array)($eminit->eminit_file ?? []); @endphp

        @if(count($existingFiles))
            <ul class="mb-2 list-unstyled">
                @foreach ($existingFiles as $f)
                    @php
                        $stored = $f['stored'] ?? null;
                        $label  = $f['original'] ?? $stored ?? 'Document';
                        // Use controller route to open inline
                        $url = $stored ? route('ememo.view', ['filename' => $stored]) : null;
                    @endphp
                    <li class="d-flex align-items-center mb-1">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="checkbox" name="delete_existing[]" value="{{ $stored }}">
                        </div>
                        <div>
                            @if($url)
                                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer">{{ $label }}</a>
                            @else
                                {{ $label }}
                            @endif
                            <small class="text-muted ms-2">(mark to remove)</small>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <em>No existing documents.</em>
        @endif

        <small class="text-muted d-block">
            At least 1 document must exist (either keep an existing one or add a new one).
        </small>
    </div>
</div>

{{-- E-Memo Dokumen (tambah baru, satu demi satu) --}}
<div class="row form-group mb-3">
  <label class="col-lg-4 label">Add e-Memo Document</label>
  <div class="col-lg-8">
    <div id="fileRows" data-has-existing="{{ count($existingFiles) ? '1' : '0' }}">
      <div class="input-group mb-2 file-row">
        {{-- If no existing files, make first input required; else optional --}}
        <input type="file" name="eminit_file[]" class="form-control" {{ count($existingFiles) ? '' : 'required' }}>
        <button type="button" class="btn btn-outline-danger ms-2 remove-row" disabled>Remove</button>
      </div>
    </div>

    <button type="button" id="addFileRow" class="btn btn-outline-secondary mt-2">+ Add file</button>
    <small class="text-muted d-block mt-1">Leave empty if not adding a new document.</small>

    @error('eminit_file')   <div class="text-danger mt-1">{{ $message }}</div> @enderror
    @error('eminit_file.*') <div class="text-danger mt-1">{{ $message }}</div> @enderror
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const container = document.getElementById('fileRows');
  const addBtn = document.getElementById('addFileRow');

  function updateState() {
    const rows = container.querySelectorAll('.file-row');
    rows.forEach((row, idx) => {
      const input = row.querySelector('input[type="file"]');
      const remove = row.querySelector('.remove-row');
      // First row "required" only if there were no existing files at render
      const hadExisting = container.getAttribute('data-has-existing') === '1';
      input.required = (!hadExisting && idx === 0);
      remove.disabled = (rows.length === 1);
    });
  }

  addBtn.addEventListener('click', function () {
    const row = document.createElement('div');
    row.className = 'input-group mb-2 file-row';
    row.innerHTML = `
      <input type="file" name="eminit_file[]" class="form-control">
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
                <textarea class="form-control" name="catatan" style="height: 100px;">{{ old('catatan', $eminit->catatan) }}</textarea>
              </div>
            </div>

            {{-- Salinan Kepada --}}
            <div class="row">
              <label class="col-lg-4 label">CC To</label>
              <div class="col-lg-8">
                @php
                  $selectedSalinan = old('salinan_kepada', (array)($eminit->salinan_kepada ?? []));
                @endphp
                <select class="form-select2" id="salinanSelect" name="salinan_kepada[]" multiple="multiple">
                  <option value="">-- Select CC Dept --</option>
                  @foreach ($kepada as $key => $value)
                    <option value="{{ $key }}" {{ in_array((string)$key, array_map('strval', $selectedSalinan), true) ? 'selected' : '' }}>
                      {{ $value }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            {{-- Salinan Persuratan Luar --}}
            <div class="row">
              <label class="col-lg-4 label">CC External</label>
              <div class="col-lg-8">
                <input type="text" name="salinan" class="form-control" value="{{ old('salinan', $eminit->salinan) }}">
              </div>
            </div>

            {{-- Salinan Dokumen (existing) --}}
            <div class="row form-group mb-2">
              <label class="col-lg-4 label">CC Document (Existing)</label>
              <div class="col-lg-8">
                @php $existingSalinanDocs = (array)($eminit->salinan_dokumen ?? []); @endphp
                @if(count($existingSalinanDocs))
                  <ul class="mb-2">
                    @foreach ($existingSalinanDocs as $f)
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
                  <em>No existing documents.</em>
                @endif
              </div>
            </div>

            {{-- Salinan Dokumen (tambah baru) --}}
            <div class="row form-group mb-3">
              <label class="col-lg-4 label">Add CC Document</label>
              <div class="col-lg-8">
                <input type="file" name="salinan_dokumen[]" class="form-control" multiple>
                <small class="text-muted">Leave empty if there is no new document.</small>
              </div>
            </div>

            {{-- No Rujukan --}}
            <div class="row">
              <label class="col-lg-4 label">Department Reference</label>
              <div class="col-lg-8">
                <input type="text" name="no_rujukan" class="form-control" value="{{ old('no_rujukan', $eminit->no_rujukan) }}">
              </div>
            </div>

            {{-- Hidden IC --}}
            <input type="hidden" name="ic_no" value="{{ old('ic_no', $eminit->ic_no) }}">

          </div>

          <br>
          @if(auth()->check() && $eminit->ic_no === auth()->user()->ic_no)
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
          @endif
        </form>
@endforeach
      </div>
    </div>
  </div>

  {{-- Select2 --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    $('#myselect').select2({ width: '100%', placeholder: "", allowClear: true });
    $('#salinanSelect').select2({ width: '100%', placeholder: "Select recipient copy", allowClear: true });
  </script>
</section>
@endsection
