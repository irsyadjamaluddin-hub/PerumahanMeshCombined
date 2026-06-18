@extends('layouts.app-all')

@section('title', 'Edit CDD Inventory')

@section('content')

<style>
  /* Make the main card container full width */
  .card.pt-3 {
    width: 100%;
    margin: 0 auto;
    padding: 20px;
  }

  .profile-overview {
    padding-left: 20px !important;
    padding-right: 20px !important;
  }

  /* Table layout fixed for neat columns and wrapping */
  #tableprestasi1 {
    table-layout: fixed;
    width: 100%;
    word-wrap: break-word;
  }

  #tableprestasi1 th, #tableprestasi1 td {
    padding: 8px 5px;
    vertical-align: middle;
    text-align: center;
    border: 1px solid #ddd;
    overflow-wrap: break-word;
    white-space: normal;
  }

  /* Set column widths */
  #tableprestasi1 th:nth-child(1), #tableprestasi1 td:nth-child(1) { width: 10%; }
  #tableprestasi1 th:nth-child(2), #tableprestasi1 td:nth-child(2) { width: 15%; }
  #tableprestasi1 th:nth-child(3), #tableprestasi1 td:nth-child(3) { width: 15%; }
  #tableprestasi1 th:nth-child(4), #tableprestasi1 td:nth-child(4) { width: 15%; }
  #tableprestasi1 th:nth-child(5), #tableprestasi1 td:nth-child(5) { width: 18%; }
  #tableprestasi1 th:nth-child(6), #tableprestasi1 td:nth-child(6) { width: 18%; }
  #tableprestasi1 th:nth-child(7), #tableprestasi1 td:nth-child(7) { width: 18%; }
  #tableprestasi1 th:nth-child(8), #tableprestasi1 td:nth-child(8) { width: 20%; }
  #tableprestasi1 th:nth-child(9), #tableprestasi1 td:nth-child(9) { width: 10.5%; }
  #tableprestasi1 th:nth-child(10), #tableprestasi1 td:nth-child(10) { width: 39%; white-space: nowrap; }

  .table-responsive {
    overflow-x: auto;
    max-height: 500px;
  }
</style>

<?php $pagename = "Cddinventory"; ?>

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

  <a href="{{ route('cddinventory.cddinventory.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="container-fluid">
    <div class="card pt-3">
      <div class="card-body profile-overview">

        <form method="post" action="{{ route('cddinventory.cddinventory.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
              <h5 class="card-title text-center text-white p-2" style="background-color: #1F4E78; border-radius: 0;">
                BORANG PERMOHONAN BAHAN-BAHAN KURIKULUM <br>BAGI SEKOLAH-SEKOLAH KERAJAAN
              </h5>
              <br>

              <div class="d-flex justify-content-between mb-3">
                  <div>
                      <label>No Rujukan:</label>
                      <input type="text" class="bg-gray-200 form-control form-control-sm" style="width: 220px;" value="{{ \Carbon\Carbon::parse($inventory->created_at)->format('Y') }}/SP/BBK-{{ $inventory->id }}" readonly>
                  </div>

                  <div>
                      <label>Date:</label>
                      <input type="text" class="bg-gray-200 form-control form-control-sm" style="width: 220px;" value="{{ $inventory->created_at }}" readonly>
                  </div>
              </div>

              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th colspan="2" class="text-center text-white" style="background-color: #72A0C1;">Maklumat Sekolah</th>
                    <th colspan="3" class="text-center text-white" style="background-color: #72A0C1;">Maklumat Pemohon</th>
                  </tr>
                  <tr>
                    <th scope="row">Nama Sekolah</th>
                    <td><input type="text" value="{{$inventory->nama_sch}}" class="form-control" readonly></td>

                    <th scope="row">No. Kad Pengenalan Pemohon</th>
                    <td><input type="text" value="{{$inventory->ic_no}}" class="form-control" readonly></td>
                  </tr>
                  <tr>
                    <th scope="row">Kluster</th>
                    <td><input type="text" value="{{$inventory->kluster}}" class="form-control" readonly></td>

                    <th scope="row">Nama Pemohon</th>
                    <td><input type="text" value="{{$inventory->nama}}" class="form-control" readonly></td>
                  </tr>
                  <tr>
                    <th scope="row">No Tel Sekolah</th>
                    <td><input type="text" value="{{$inventory->no_tel}}" class="form-control" readonly></td>

                    <th scope="row">Emel Pemohon</th>
                    <td><input type="text" value="{{$inventory->emel}}" class="form-control" readonly></td>
                  </tr>
                  <tr>
                   <th colspan="4" class="text-center text-white" style="background-color: #72A0C1;">Keterangan Guru Besar/Pengetua</th>
                  </tr>
                  <tr>
                      <th scope="row">Nama Guru Besar/Pengetua</th>
                      <td><input type="text" value="{{$inventory->kgp_nama}}" class="form-control" readonly></td>

                      <th scope="row">No. Kad Pengenalan</th>
                      <td><input type="text" value="{{$inventory->kgp_ic_no}}" class="form-control" readonly></td>
                  </tr>
                  <tr>
                  <th scope="row">Emel Guru Besar/Pengetua</th>
                  <td><input type="text" value="{{$inventory->kgp_emel}}" class="form-control" readonly></td>

                  <th scope="row">No. Tel Guru Besar/Pengetua</th>
                  <td><input type="text" value="{{$inventory->kgp_phone_number}}" class="form-control" readonly></td>
              </tr>

                  <tr>
                   <th colspan="4" class="text-center text-white" style="background-color: #72A0C1;">Bahan - Bahan Kurikulum</th>
                  </tr>   
                </tbody>
              </table>

            @unless(Auth::user()->ic_no === $inventory->kgp_ic_no)
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                @if($inventory->kgp_status != "Approve")
                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn2">
                  <i class="bi bi-plus-lg"></i>
                </button>
                @endif
            </div>
            @endunless

              <input type="hidden" name="inventory_id" value="{{$inventory->id}}">

              <div class="table-responsive">
                <table class="table-achiev" id="tableprestasi1">
                  <thead>
                    <tr>
                      <th>ISBN No.</th>
                      <th>Mata Pelajaran</th>
                      <th>Judul Bahan</th>
                      <th>Pengarang/Penerbit</th>
                      <th>Kuantiti Dipohonkan</th>
                      <th>Kuantiti Sebutharga</th>
                      <th>Kuantiti Pengeluaran</th>
                      <th>Sebab Permohonan</th>
                      <th>Action</th>
                      <th style="background-color:#018749; color: white;">Status Permohonan</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($inventorybbk) == 0)
                      <tr class="text-center">
                        <td colspan="11"><h5>No records found</h5></td>
                      </tr>
                    @else
                      @foreach($inventorybbk as $item)
                        <tr class="text-center">
                          <td>{{$item->isbn}}</td>
                          <td>{{$item->matapelajaran}}</td>
                          <td>{{$item->judulbahan}}</td>
                          <td>{{$item->pengarang_penerbit}}</td>
                          <td>{{$item->qty_dipohonkan}}</td>
                          <td>{{$item->kuantiti_sebutharga ?? '-'}}</td>
                          <td>{{$item->cdd_qty_diluluskan ?? '-'}}</td>
                          <td>
                            <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#SebabPermohonanModal{{ $item->id }}"></button>

                            <div class="modal fade" id="SebabPermohonanModal{{ $item->id }}" tabindex="-1">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Sebab Permohonan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>
                                  <div class="modal-body">{{ $item->sebab_permohonan }}</div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            @if($inventory->kgp_status == "Approve")
                              <button class="btn btn-primary text-right" disabled><i class="bi bi-pencil-fill"></i></button>
                            @else
                              <a href="{{ route('cddinventory.cddinventory.editcddinfo', $item->id ) }}" class="btn btn-primary text-right"><i class="bi bi-pencil-fill"></i></a>
                            @endif
                          </td>
                          <td>
                            @if($item->cdd_status)
                              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#CddStatus{{ $item->id }}">
                                {{$item->cdd_status}}
                              </button>
                              <div class="modal fade" id="CddStatus{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Status Catatan</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">{{ $item->cdd_catatan }}</div>
                                  </div>
                                </div>
                              </div>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
              </div>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function () {
    var preloadedData = <?php echo json_encode($allBooks); ?>;

    function fetchAdditionalInfo(isbn, row) {
        var bookData = preloadedData.find(function (book) { return book.isbn === isbn; });
        if (bookData) {
            row.querySelector('.matapelajaran').value = bookData.kategori;
            row.querySelector('.judulbahan').value = bookData.judul;
            row.querySelector('.pengarang_penerbit').value = bookData.pengarang;
        }
    }

    function addRow() {
        var tbody = document.querySelector('#tableprestasi1 tbody');
        var row = tbody.insertRow();
        row.innerHTML = `
          <td>
            <input list="isbn-options" class="form-control isbn-select" name="isbn[]" required style="width: 100%; height: 36px;">
            <datalist id="isbn-options"></datalist>
          </td>
          <td><input type="text" class="form-control matapelajaran" name="matapelajaran[]" placeholder="Matapelajaran" style="width: 100%;"/></td>
          <td><input type="text" class="form-control judulbahan" name="judulbahan[]" placeholder="Judul Bahan" style="width: 100%;"/></td>
          <td><input type="text" class="form-control pengarang_penerbit" name="pengarang_penerbit[]" placeholder="Pengarang/Penerbit" style="width: 100%;"/></td>
          <td><input type="text" class="form-control" name="qty_dipohonkan[]" placeholder="Kuantiti" required style="width: 100%;"/></td>
          <td><input type="text" class="form-control" name="kuantiti_sebutharga[]" placeholder="Kuantiti Sebutharga" style="width: 100%;"/></td>
          <td><input type="text" class="form-control" name="cdd_qty_diluluskan[]" placeholder="Kuantiti Pengeluaran" style="width: 100%;"/></td>
          <td><input type="text" class="form-control" name="sebab_permohonan[]" placeholder="Sebab Permohonan" required style="width: 100%;"/></td>
          <td><button class="removeDeclare btn btn-danger btn-sm" type="button">Remove</button></td>
        `;
        var datalist = row.querySelector('#isbn-options');
        preloadedData.forEach(function (book) {
            var option = document.createElement('option');
            option.value = book.isbn;
            datalist.appendChild(option);
        });

        row.querySelector('.isbn-select').addEventListener('change', function () {
            fetchAdditionalInfo(this.value, row);
        });
    }

    document.getElementById('addbtn2').addEventListener('click', addRow);

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('removeDeclare')) {
            event.target.closest('tr').remove();
        }
    });
});
</script>

          <!-- Application Status (only for Pengetua) -->
@if(Auth::user()->ic_no === $inventory->kgp_ic_no && $inventory->kgp_status !== 'Approve')
<div class="d-flex align-items-center mt-3 mb-3">
    <label class="me-3 fw-bold">Application Status:</label>
    <input type="hidden" name="kgp_status" id="kgp_status" value="{{ $inventory->kgp_status }}">
    <input type="hidden" name="kgp_amendmentreasons" id="amendments_reason" value="{{ $inventory->kgp_amendmentreasons ?? '' }}">

    <div style="flex: 1;">
        <div style="display: flex; justify-content: flex-start;">
            @if($inventory->kgp_status == null || $inventory->kgp_status == "Waiting for Approval")
                <div style="padding: 0 5px;">
                    <button type="button" class="btn btn-outline-success" onclick="submitStatus('Approve')">Approve</button>
                </div>
                <div style="padding: 0 5px;">
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#amendmentsModal">Need Amendments</button>
                </div>
            @elseif($inventory->kgp_status == "Need Amendments")
                <div style="padding: 0 5px;">
                    <button type="button" class="btn btn-outline-success" onclick="submitStatus('Approve')">Approve</button>
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
                          <h5 class="modal-title">Reason for Amendments</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <textarea id="amendmentsReason" class="form-control" rows="4" placeholder="Enter the reason for amendments here...">{{ $inventory->kgp_amendmentreasons ?? '' }}</textarea>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" onclick="submitAmendments()">Submit</button>
                      </div>
                  </div>
              </div>
          </div>

          <script>
          function submitAmendments() {
              const reason = document.getElementById('amendmentsReason').value;
              document.getElementById('kgp_status').value = 'Need Amendments';
              document.getElementById('amendments_reason').value = reason;
              document.forms[0].submit();
          }

          function submitStatus(status) {
              document.getElementById('kgp_status').value = status;
              if (status === 'Approve') {
                  // Clear the amendments reason when approving
                  document.getElementById('amendments_reason').value = '';
              }
              document.forms[0].submit();
          }
          </script>
          @endif

          <!-- Show saved amendment reasons only when status is "Need Amendments" -->
          @if(!empty($inventory->kgp_amendmentreasons) && $inventory->kgp_status == "Need Amendments")
          <div class="alert alert-warning mt-3">
              <strong>Reasons for Amendment:</strong>
              <p class="mb-0">{{ $inventory->kgp_amendmentreasons }}</p>
          </div>
          
          <!-- Add notification button for applicant to notify principal -->
          @if(Auth::user()->ic_no === $inventory->ic_no)
          <div class="mt-3">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#notifyAmendmentsModal">
                  <i class="bi bi-bell"></i> Notify Principal - Amendments Completed
              </button>
          </div>
          @endif
          @endif

        </form>
        <!-- MAIN FORM ENDS HERE -->

      </div>
    </div>
  </div>
</section>

<!-- Notification Modal - OUTSIDE THE MAIN FORM -->
@if(!empty($inventory->kgp_amendmentreasons) && $inventory->kgp_status == "Need Amendments" && Auth::user()->ic_no === $inventory->ic_no)
<div class="modal fade" id="notifyAmendmentsModal" tabindex="-1" role="dialog" aria-labelledby="notifyAmendmentsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0 shadow-sm">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Notify Principal of Completed Amendments</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('cddinventory.notifyAmendments', $inventory->id) }}">
                @csrf
                <div class="modal-body">
                    <p>The principal requested the following amendments:</p>
                    <div class="alert alert-secondary">
                        {{ $inventory->kgp_amendmentreasons }}
                    </div>
                    <div class="form-group mt-3">
                        <label for="amendmentResponse">Your Response (Optional):</label>
                        <textarea id="amendmentResponse" name="response_message" class="form-control" rows="4" placeholder="Describe what amendments you have made..."></textarea>
                    </div>
                    <div class="alert alert-light mt-3 text-muted">
                        <small><i class="bi bi-info-circle"></i> This will send an email notification to the Principal ({{ $inventory->kgp_nama }}) informing them that the requested amendments have been completed.</small>
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