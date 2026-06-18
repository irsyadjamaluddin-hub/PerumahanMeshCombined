<?php $pagename = "Cddinventory"; ?>

@extends('layouts.app-all')

@section('title', 'Notify Inventory')

@section('content')
<section class="section profile">

  <!-- Back button top-left -->
  <a href="{{ route('cddinventory.cddinventory.editcddinfoadmin', $inventory->id) }}" class="btn btn-secondary mb-3">
    &laquo; Back
  </a>

  @if(session('success_message'))
    <div class="alert alert-success">
      {{ session('success_message') }}
    </div>
  @endif

  <div class="card">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Notify Inventory</h4>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('cddinventory.sendNotification', $inventory->id) }}">
        @csrf

        <!-- Hidden fields for admin status updates -->
        <input type="hidden" name="cdd_status" value="{{ old('cdd_status', $inventorybbk->cdd_status ?? '') }}">
        <input type="hidden" name="cdd_qty_diluluskan" value="{{ old('cdd_qty_diluluskan', $inventorybbk->cdd_qty_diluluskan ?? '') }}">
        <input type="hidden" name="kqty_pengeluaran" value="{{ old('kqty_pengeluaran', $inventorybbk->kqty_pengeluaran ?? '') }}">
        <input type="hidden" name="kqty_sebutharga" value="{{ old('kqty_sebutharga', $inventorybbk->kqty_sebutharga ?? '') }}">
        <input type="hidden" name="cdd_catatan" value="{{ old('cdd_catatan', $inventorybbk->cdd_catatan ?? '') }}">

        <div class="form-check mb-3 mt-4"> 
          <input class="form-check-input" type="checkbox" id="send_email" name="send_email" value="1">
          <label class="form-check-label" for="send_email">
            Send email to pemohon
          </label>
        </div>

        <div class="mb-4" id="message-container" style="display:none;">
          <label for="message" class="form-label">Message (paste Excel link here)</label>
          <textarea id="message" name="message" class="form-control" rows="5" placeholder="Paste your Excel link here..."></textarea>
        </div>

        <div>
          <button type="submit" class="btn btn-primary">Done</button>
        </div>
      </form>
    </div>
  </div>

</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const sendEmailCheckbox = document.getElementById('send_email');
    const messageContainer = document.getElementById('message-container');
    const messageTextarea = document.getElementById('message');

    function toggleMessage() {
      if (sendEmailCheckbox.checked) {
        messageContainer.style.display = '';
        messageTextarea.setAttribute('required', 'required');
      } else {
        messageContainer.style.display = 'none';
        messageTextarea.removeAttribute('required');
        messageTextarea.value = '';
      }
    }

    sendEmailCheckbox.addEventListener('change', toggleMessage);
    toggleMessage();
  });
</script>
@endsection
