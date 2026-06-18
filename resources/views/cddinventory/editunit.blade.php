@extends('layouts.app-all')

@section('title', 'Edit CDD Inventory')

@section('content')

<?php
$pagename = "Cddinventory";
?>

@if(session('success_message'))
    <div class="alert alert-success">
        {{ session('success_message') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<section class="section profile">

  <a href="{{ route('cddinventory.cddinventory.index') }}?tab=unit" 
    class="btn btn-primary mb-2" style="background-color: blue;">
      <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">
      <div class="card-body">

        <form method="post" action="{{ route('cddinventory.cddinventory.update') }}" enctype="multipart/form-data">
          @csrf

          <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">
              BORANG PERMOHONAN BAHAN-BAHAN KURIKULUM <br>BAGI UNIT-UNIT JABATAN PERKEMBANGAN KURIKULUM 
            </h5>
            <br>

            <div style="display: flex; align-items: center; float: right; margin-top: 10px;">
              <label style="margin-right: 10px;">Date:</label>
              <input type="text" class="bg-gray-200 form-control form-control-sm" style="width: 200px;" 
                     value="{{ $inventoryunit->created_at ?? '' }}" readonly>
            </div>

            <br><br>

            <table class="table table-bordered">
              <tbody>
                <tr>
                  <th colspan="4" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Maklumat Pemohon</th>
                </tr>
                <tr>
                  <th scope="row">Unit</th>
                  <td><input type="text" value="{{ $inventoryunit->unit ?? '' }}" class="form-control" readonly></td>
                  <th scope="row">No. Kad Pengenalan Pemohon</th>
                  <td><input type="text" value="{{ $inventoryunit->ic_no ?? '' }}" class="form-control" readonly></td>
                </tr>
                <tr>
                  <th scope="row">Jabatan</th>
                  <td><input type="text" value="{{ optional($inventoryunit->Department)->label ?? '' }}" class="form-control" readonly></td>
                  <th scope="row">Nama Pemohon</th>
                  <td><input type="text" value="{{ $inventoryunit->nama ?? '' }}" class="form-control" readonly></td>
                </tr>
                <tr>
                  <th scope="row">Emel Pemohon</th>
                  <td><input type="text" value="{{ $inventoryunit->emel ?? '' }}" class="form-control" readonly></td>
                </tr>
                <tr></tr>
                <tr>
                  <th colspan="4" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Keterangan Penolong Pengarah Kurikulum</th>
                </tr>
                <tr>
                  <th scope="row">Nama PPKs</th>
                  <td>
                    <input type="text" name="kgp_nama" class="form-control" value="{{ $inventoryunit->ppk_nama ?? '' }}" readonly>
                  </td>
                  <th scope="row">No. Kad Pengenalan</th>
                  <td>
                    <input type="text" name="kgp_ic_no" class="form-control" value="{{ $inventoryunit->ppk_ic_no ?? '' }}" readonly>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Emel PPKs</th>
                  <td>
                    <input type="email" name="kgp_emel" class="form-control" value="{{ $inventoryunit->ppk_emel ?? '' }}" readonly>
                  </td>
                  <th scope="row">No. Tel PPKs</th>
                  <td>
                    <input type="text" name="kgp_phone_number" class="form-control" value="{{ $inventoryunit->ppk_phone_number ?? '' }}" readonly>
                  </td>
                </tr>
                <tr>
                  <th colspan="4" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #72A0C1;">Bahan - Bahan Kurikulum</th>
                </tr>
              </tbody>
            </table>

            @unless(Auth::user()->ic_no === $inventoryunit->kgp_ic_no)
            <div class="d-grid gap-2 d-md-flex justify-content-md-end"></div>
            @endunless

            <input type="text" name="inventory_id" class="bg-gray-200 form-control" value="{{ $inventoryunit->id ?? '' }}" hidden>

            {{-- Bahan-Bahan Kurikulum Table --}}
            <table class="table-achiev" id="tableprestasi1">
              <thead>
                <tr>
                  <th class="text-center">Mata Pelajaran</th>
                  <th class="text-center">Judul Bahan</th>
                  <th class="text-center">ISBN No.</th>
                  <th class="text-center">Pengarang/Penerbit</th>
                  <th class="text-center">Kuantiti Dipohonkan</th>
                  <th class="text-center">Kuantiti Sebutharga</th>
                  <th class="text-center">Kuantiti Pengeluaran</th>
                  <th class="text-center">Sebab Permohonan</th>
                  <th class="text-center">Action</th>
                  <th class="text-center" style="background-color:#018749; color: white;">Status Permohonan</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @if(count($inventorybbk) == 0)
                  <tr class="text-center">
                    <td colspan="11"><h5>No records found</h5></td>
                  </tr>
                @else
                  @foreach($inventorybbk as $inventorybbk)
                  <tr class="text-center">
                    <td>{{ $inventorybbk->matapelajaran }}</td>
                    <td>{{ $inventorybbk->judulbahan }}</td>
                    <td>{{ $inventorybbk->isbn }}</td>
                    <td>{{ $inventorybbk->pengarang_penerbit }}</td>
                    <td>{{ $inventorybbk->qty_dipohonkan }}</td>
                    <td>{{ $inventorybbk->kuantiti_sebutharga ?? '-' }}</td>
                    <td>{{ $inventorybbk->cdd_qty_diluluskan ?? '-' }}</td>
                    <td>
                      <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#SebabPermohonanModal{{ $inventorybbk->id }}"></button>

                      <div class="modal fade" id="SebabPermohonanModal{{ $inventorybbk->id }}" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Sebab Permohonan</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">{{ $inventorybbk->sebab_permohonan }}</div>
                          </div>
                        </div>
                      </div>
                    </td>

                    <td>
                    @if($inventoryunit->kgp_status == "Approve")
                              <button class="btn btn-primary text-right" disabled><i class="bi bi-pencil-fill"></i></button>
                            @else
                      <a href="{{ route('cddinventory.cddinventory.editcddinfo', $inventorybbk->id ) }}" class="btn btn-primary text-right"><i class="bi bi-pencil-fill"></i></a>
                      @endif
                    </td>

                    <td>{{ $inventorybbk->cdd_status }}</td>
                  </tr>
                  @endforeach
                @endif
              </tbody>
            </table>

            <script type="text/javascript">
              $(document).ready(function() {
                $('#addbtn2').off().on('click', function() {
                  var html = '';
                  html += '<tr>';
                  html += '<td><input type="text" class="form-control" name="matapelajaran[]" autofocus></td>';
                  html += '<td><input type="text" class="form-control" name="judulbahan[]" autofocus></td>';
                  html += '<td><input type="text" class="form-control" name="isbn[]" autofocus></td>';
                  html += '<td><input type="text" class="form-control" name="pengarang_penerbit[]" autofocus></td>';
                  html += '<td><input type="text" class="form-control" name="qty_dipohonkan[]" autofocus></td>';
                  html += '<td><input type="text" class="form-control" name="kuantiti_sebutharga[]" autofocus></td>';
                  html += '<td><input type="text" class="form-control" name="cdd_qty_diluluskan[]" autofocus></td>';
                  html += '<td><textarea class="form-control" name="sebab_permohonan[]"></textarea></td>';
                  html += '<td><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td>';
                  html += '</tr>';
                  $('#tableprestasi1').append(html);
                });

                $(document).on('click', '.removeDeclare', function() {
                  $(this).parents('tr').remove();
                });
              });
            </script>

{{-- Application Status only for PPK user and only if not yet approved --}}
@if(Auth::user()->ic_no === $inventoryunit->ppk_ic_no && $inventoryunit->kgp_status != "Approve")

    <input type="text" name="id" class="bg-gray-200 form-control" value="{{$inventoryunit->id}}" hidden>
    <div style="display: flex; align-items: center; margin-top: 10px;">
        <label style="margin-right: 10px; font-weight: bold;">Application Status:</label>
        <input type="hidden" name="kgp_status" id="kgp_status" value="{{$inventoryunit->kgp_status}}">
        <input type="hidden" name="kgp_amendmentreasons" id="amendments_reason" value="{{ $inventoryunit->kgp_amendmentreasons ?? '' }}">

        <div style="flex: 1;">
            <div style="display: flex; justify-content: flex-start;">
                @if($inventoryunit->kgp_status == null || $inventoryunit->kgp_status == "Waiting for Approval")
                    <div style="padding: 0 5px;">
                        <button type="button" class="btn btn-outline-success" onclick="setStatus('Approve')">Approve</button>
                    </div>
                    <div style="padding: 0 5px;">
                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#amendmentsModal">Need Amendments</button>
                    </div>
                @elseif($inventoryunit->kgp_status == "Need Amendments")
                    <div style="padding: 0 5px;">
                        <button type="button" class="btn btn-outline-success" onclick="setStatus('Approve')">Approve</button>
                    </div>
                    <div style="padding: 0 5px;">
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#amendmentsModal">Need Amendments</button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Amendments Modal -->
    <div class="modal fade" id="amendmentsModal" tabindex="-1" role="dialog" aria-labelledby="amendmentsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="amendmentsModalLabel">Reason for Amendments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea id="amendmentsReason" class="form-control" rows="4" placeholder="Enter the reason for amendments here...">{{ $inventoryunit->kgp_amendmentreasons ?? '' }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitAmendments()">Submit</button>
                </div>
            </div>
        </div>
    </div>

@endif

<!-- Show saved amendment reasons only when status is "Need Amendments" -->
@if(!empty($inventoryunit->kgp_amendmentreasons) && $inventoryunit->kgp_status == "Need Amendments")
<div class="alert alert-warning mt-3">
    <strong>Reasons for Amendment:</strong>
    <p class="mb-0">{{ $inventoryunit->kgp_amendmentreasons }}</p>
</div>

<!-- Add notification button for applicant to notify PPK -->
@if(Auth::user()->ic_no === $inventoryunit->ic_no)
<div class="mt-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#notifyAmendmentsModal">
        <i class="bi bi-bell"></i> Notify PPK - Amendments Completed
    </button>
</div>
@endif
@endif

<script>
function submitAmendments() {
    const reason = document.getElementById('amendmentsReason').value;
    document.getElementById('kgp_status').value = 'Need Amendments';
    document.getElementById('amendments_reason').value = reason;
    document.forms[0].submit();
}

function setStatus(status) {
    document.getElementById('kgp_status').value = status;
    if (status === 'Approve') {
        // Clear the amendments reason when approving
        document.getElementById('amendments_reason').value = '';
    }
    document.forms[0].submit();
}
</script>

          </div>
        </form>
        <!-- MAIN FORM ENDS HERE -->

      </div>
    </div>
  </div>
</section>

<!-- Notification Modal - OUTSIDE THE MAIN FORM -->
@if(!empty($inventoryunit->kgp_amendmentreasons) && $inventoryunit->kgp_status == "Need Amendments" && Auth::user()->ic_no === $inventoryunit->ic_no)
<div class="modal fade" id="notifyAmendmentsModal" tabindex="-1" role="dialog" aria-labelledby="notifyAmendmentsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0 shadow-sm">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Notify PPK of Completed Amendments</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('cddinventory.notifyAmendments', $inventoryunit->id) }}">
                @csrf
                <div class="modal-body">
                    <p>The PPK requested the following amendments:</p>
                    <div class="alert alert-secondary">
                        {{ $inventoryunit->kgp_amendmentreasons }}
                    </div>
                    <div class="form-group mt-3">
                        <label for="amendmentResponse">Your Response (Optional):</label>
                        <textarea id="amendmentResponse" name="response_message" class="form-control" rows="4" placeholder="Describe what amendments you have made..."></textarea>
                    </div>
                    <div class="alert alert-light mt-3 text-muted">
                        <small><i class="bi bi-info-circle"></i> This will send an email notification to the PPK ({{ $inventoryunit->ppk_nama }}) informing them that the requested amendments have been completed.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send"></i> Send Notification
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection