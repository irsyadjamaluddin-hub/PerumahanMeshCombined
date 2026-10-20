@if(Session::has('success_message'))
<div class="modal fade" id="successMessageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Rekod Berjaya Disimpan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {!! session('success_message') !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var successModalEl = document.getElementById('successMessageModal');
    if (successModalEl) {
      new bootstrap.Modal(successModalEl).show();
    }
  });
</script>
@endif
