@extends('layouts.app-all')

@section('title', 'E-Memo Form')

@section('content')

<?php
$pagename = "e-minit";
?>

<style>
.label {
    color: #1F4E78;
    font-weight: 500; /* optional for clearer visibility */
}

</style>
<section class="section profile">

  <a href="{{ route('eminit.eminit.indexeminit') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">

      <div class="card-body">
        <form method="post" action="{{ route('eminit.eminit.storeeminit') }}" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
              </div>
            @endif

            

            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

              <!-- Daripada (Dihantar oleh) -->
              <div class="row mb-3 justify-content-end">
                  <div class="col-lg-6 col-md-8 col-sm-12 d-flex justify-content-end align-items-center">
                  <label class="col-form-label me-2 text-end label">
                      from Department:
                  </label>

                      <div class="flex-grow-1">
                          @foreach($employments as $employment)
                              <input type="text" class="form-control mb-2 w-100" 
                                    value="{{ optional($employment->department)->label }}" readonly>
                              <input type="hidden" name="daripada" 
                                    value="{{ $employment->department_id }}">
                          @endforeach
                      </div>
                  </div>
              </div>
              <!-- Daripada (Dihantar oleh) -->
            
            


     
                
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; background-color: #1F4E78;">E-Memo Form</h5>
                <br>

                <!-- Jenis -->
                <div class="row">
                  <label class="col-lg-4 label">Category <i style="color:red;">*</i></label>
                  <div class="col-lg-8">
                    @php $jenisSelected = (string) old('jenis', $dispatch->jenis ?? ''); @endphp
                    <select class="form-select" name="jenis" required>
                      {{-- must be truly empty and selected only when nothing chosen --}}
                      <option value="" {{ $jenisSelected === '' ? 'selected' : '' }}>-- Select Category --</option>
                      @foreach ($jenis as $key => $value)
                        <option value="{{ $key }}" {{ $jenisSelected === (string) $key ? 'selected' : '' }}>
                          {{ $value }}
                        </option>
                      @endforeach
                    </select>
                    {!! $errors->first('jenis', '<div class="text-danger small mt-1">:message</div>') !!}
                  </div>
                </div>

           

                <!-- Memo Daripada (Choose from any Department) -->
                <div class="row">
                    <label class="col-lg-4 label">Memo From <i style="color:red;">*</i></label>
                    <div class="col-lg-8">
                        <select class="form-control select2" id="memoDaripadaSelect" name="memo_daripada" required style="width: 100%;">
                            <option value="">-- Select Memo From --</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}">
                                    {{ $dept->label }}
                                </option>
                            @endforeach
                        </select>
                        {!! $errors->first('memo_daripada', '<div class="text-danger small mt-1">:message</div>') !!}
                    </div>
                </div>
                

            <!-- Kepada -->
            <div class="row">
                <div class="col-lg-4 label">To <i style="color:red;">*</i></div>
                <div class="col-lg-8">
                  @foreach($employments as $employment)
                    <input type="text" class="form-control" 
                          value="{{ optional($employment->department)->label }}" 
                          readonly>
                    <input type="hidden" name="kpd[]" value="{{ $employment->department_id }}">
                  @endforeach
                </div>
                </div>
              <!-- Kepada old code which works for multiple, Puan Hjh instruction to change this 30/10/2025 -->
              <!-- <div class="row">
                <div class="col-lg-4 label">Kepada <i style="color:red;">*</i></div>
                <div class="col-lg-8">
                  <select class="form-control select2" id="myselect" name="kpd[]" multiple="multiple" data-placeholder="Pilih Kepada">
                    @foreach ($kepada as $key => $value)
                      <option value="{{ $key }}" {{ in_array((string)$key, old('kpd', $dispatch->kpd ?? [])) ? 'selected' : '' }}>
                        {{ $value }}
                      </option>
                    @endforeach
                  </select>

                  {!! $errors->first('kpd', '<div class="text-danger small mt-1">:message</div>') !!}
                </div>
              </div> -->



                <!-- Untuk Perhatian -->
                <div class="row" hidden>
                    <label class="col-lg-4 label">For Attention</label>
                    <div class="col-lg-8">
                         <select class="form-select" name="untukperhatian">
                            <option value="">-- Select FA --</option>
                            @foreach ($Eminit_Untukperhatian as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>

               <!-- Perkara -->
                  <div class="row">
                      <label class="col-lg-4 label">Subject<i style="color:red;">*</i></label>
                      <div class="col-lg-8">
                          <input type="text" name="perkara" class="form-control" required 
                                style="font-weight: bold; text-transform: uppercase;">
                      </div>
                  </div>

                <!-- Rujukan Tuan/Puan -->
                <div class="row">
                    <label class="col-lg-4 label"> No Reference (Memo Recieved)</label>
                    <div class="col-lg-8">
                        <input type="text" name="rujukan_tp" class="form-control">
                    </div>
                </div>

                <!-- e-Minit Dokumen -->
                <div class="row form-group mb-3">
                <label class="col-lg-4 label">e-Memo Document <i style="color:red;">*</i></label>

                <div class="col-lg-8">
                    <div id="fileRows">
                    <div class="input-group mb-2 file-row">
                        <input type="file" name="eminit_file[]" class="form-control" required>
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
      const input = row.querySelector('input[type="file"]');
      const remove = row.querySelector('.remove-row');
      // First row must be required, others optional
      input.required = (idx === 0);
      // Disable remove if only one row exists
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

                <!-- Catatan -->
                <div class="row">
                    <label class="col-lg-4 label">Remarks<i style="color:red;">*</i></label>
                    <div class="col-lg-8">
                        <textarea class="form-control" name="catatan" placeholder = "e.g.: Memo received on DD-MM-YY"  style="height: 100px;" required></textarea>
                    </div>
                </div>

                <!-- Salinan -->
                <div class="row">
                    <label class="col-lg-4 label">CC To</label>
                    <div class="col-lg-8">
                         <select class="form-select2" id="salinanSelect" name="salinan_kepada[]" multiple="multiple">
                            <option value="">-- Select CC Dept --</option>
                            @foreach ($kepada as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <!-- Salinan Persuratan Luar -->
                <div class="row">
                    <label class="col-lg-4 label">CC External</label>
                    <div class="col-lg-8">
                        <input type="text" name="salinan" class="form-control">
                    </div>
                </div>

                <!-- Salinan Dokumen -->
                <div class="row form-group mb-3">
                    <label class="col-lg-4 label">CC Document</label>
                    <div class="col-lg-8">
                        <input type="file" name="salinan_dokumen[]" class="form-control" multiple>
                    </div>
                </div>

                <!-- No Rujukan -->
                <div class="row">
                    <label class="col-lg-4 label">Department Reference<i style="color:red;">*</i></label>
                    <div class="col-lg-8">
                        <input type="text" name="no_rujukan" class="form-control" required>
                    </div>
                </div>

                <!-- Hidden IC -->
                <input type="hidden" name="ic_no" value="{{ Auth::user()->ic_no }}">

            </div>

            <br>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

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
    $('#salinanSelect').select2({
      width: '100%',
      placeholder: "Select recipient copy",
      allowClear: true
    });

    $('#tindakanSelect').select2({
      width: '100%',
      placeholder: "Select action",
      allowClear: true
    });

    $('#memoDaripadaSelect').select2({
      width: '100%',
      placeholder: "Select memo from",
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
<script>
document.addEventListener('DOMContentLoaded', function () {
  // 1) Init Select2
  if (window.jQuery && $.fn.select2) {
    $('#myselect').select2({ placeholder: 'Select To', allowClear: true, width: '100%' });
  }

  const form      = document.querySelector('form');
  const jenisSel  = document.querySelector('select[name="jenis"]');
  const kpdSel    = document.getElementById('myselect');
  const kpdProxy  = document.getElementById('kpd_proxy');

  // Keep the proxy's "required" state in sync with selection
  function syncKpdValidity() {
    const vals = (window.jQuery && $(kpdSel).val()) || Array.from(kpdSel.selectedOptions).map(o => o.value);
    const hasSelection = !!(vals && vals.length);
    // If no selection, proxy is required (so browser shows bubble). If has selection, proxy not required.
    kpdProxy.required = !hasSelection;
    kpdProxy.value = hasSelection ? 'ok' : ''; // any non-empty value passes
    return hasSelection;
  }

  // On change, resync
  if (window.jQuery) $('#myselect').on('change', syncKpdValidity);
  else kpdSel.addEventListener('change', syncKpdValidity);
  syncKpdValidity(); // initial

  // 2) On submit, let browser native validation run.
  form.addEventListener('submit', function (e) {
    // Ensure Jenis placeholder is truly empty so 'required' triggers
    if (!jenisSel.value) {
      // Let native required bubble show on the select
      jenisSel.reportValidity();
      e.preventDefault();
      return;
    }

    // For Kepada, trigger bubble on the proxy if empty
    if (!syncKpdValidity()) {
      kpdProxy.reportValidity(); // shows "Please fill out this field."
      // Try to focus the Select2 UI for user convenience
      if (window.jQuery) $(kpdSel).next('.select2').find('.select2-selection').focus();
      e.preventDefault();
    }
  });
});
</script>


</section>
@endsection