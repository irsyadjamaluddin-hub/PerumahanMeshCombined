@extends('layouts.app-all')

@section('title', 'Permohonan Sokongan Admin')

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" sections; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
<div class="mesh-home-theme">
{{-- #================================ --}}

<?php $pagename = "SupportCenter"; ?>

<div class="pagetitle">
  <h1>DevOps Service</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Utama</a></li>
      <li class="breadcrumb-item">Admin</li>
      <li class="breadcrumb-item active">DevOps Service Desk</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">

  {{-- ✅ Back button kekal English --}}
  <a href="{{ route('support-center.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i> Back
  </a>

  <div class="col-12">
    <div class="card recent-sales">
      <div class="card-body">
        <div class="profile-overview pt-3" style="padding:18px;">

          {{-- #============= ORI CODE ============== --}}
          {{-- <h4>Butiran Permohonan Sokongan</h4> --}}
          {{-- #================================ --}}
          {{-- Title centred; gold in dark mode (mesh-gold-title, public/css/mesh-dark.css) --}}
          <h4 class="mesh-gold-title" style="text-align: center;">Butiran Permohonan Sokongan</h4>
          {{-- #================================ --}}
          <hr>

          {{-- TICKET ID --}}
          <div class="row">
            <div class="col-lg-4 label">ID Tiket:</div>
            <div class="col-lg-8">
              <strong>{{ $supportRequest->ticket_id }}</strong>
            </div>
          </div>

          {{-- DETAILS --}}
          <div class="row"><div class="col-lg-4 label">Nama:</div><div class="col-lg-8">{{ $supportRequest->name }}</div></div>
          <div class="row"><div class="col-lg-4 label">Emel:</div><div class="col-lg-8">{{ $supportRequest->email }}</div></div>
          <div class="row"><div class="col-lg-4 label">No. Telefon:</div><div class="col-lg-8">{{ $supportRequest->contact }}</div></div>
          <div class="row"><div class="col-lg-4 label">Jabatan:</div><div class="col-lg-8">{{ $supportRequest->department }}</div></div>
          <div class="row"><div class="col-lg-4 label">Unit:</div><div class="col-lg-8">{{ $supportRequest->unit }}</div></div>
          <div class="row">
            <div class="col-lg-4 label">Perkara:</div>
            <div class="col-lg-8">{{ $supportRequest->perkara }}</div>
          </div>
          <div class="row">
            <div class="col-lg-4 label">Huraian:</div>
            <div class="col-lg-8" style="white-space: pre-line">{{ $supportRequest->huraian }}</div>
          </div>

          {{-- Kepentingan (BM) --}}
          <div class="row">
            <div class="col-lg-4 label">Kepentingan:</div>
            <div class="col-lg-8">
              @php
                $prio = $supportRequest->priority;
                $badge = match ($prio) {
                  'Tinggi' => 'danger',
                  'Sederhana' => 'warning',
                  'Rendah' => 'success',
                  default => 'secondary',
                };
              @endphp
              <span class="badge bg-{{ $badge }}">{{ $supportRequest->priority_label }}</span>
            </div>
          </div>

          {{-- Status Semasa (BM) --}}
          <div class="row">
            <div class="col-lg-4 label">Status:</div>
            <div class="col-lg-8">
              <span class="badge bg-{{ $supportRequest->getStatusBadgeClass() }}">
                {{ $supportRequest->status_label }}
              </span>
            </div>
          </div>

          {{-- Lampiran --}}
          <div class="row mt-2">
            <div class="col-lg-4 label">Lampiran:</div>
            <div class="col-lg-8">
              @if(count($attachments) > 0)
                <ul class="mb-0">
                  @foreach ($attachments as $file)
                    <li>
                      <a href="{{ route('support-center.attachments.download', $file->id) }}">
                        {{ $file->file_name }}
                      </a>
                    </li>
                  @endforeach
                </ul>
              @else
                <p class="mb-0">Tiada Lampiran</p>
              @endif
            </div>
          </div>

          <br><hr><br>

          {{-- FLASH --}}
          @if(session('success'))
            <div class="alert alert-success">
              <i class="fas fa-fw fa-check"></i> {!! session('success') !!}
            </div>
          @endif

          {{-- VALIDATION ERRORS --}}
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          {{-- REMARKS TABLE --}}
          <div class="row">
            <div class="col-lg-4 label">Catatan:</div>
            <div class="col-12">
              <table class="table table-bordered mt-3">
                <thead>
                  <tr>
                    <th scope="col">Catatan</th>
                    <th scope="col">Masa</th>
                    <th scope="col" style="width: 90px;">Tindakan</th>
                  </tr>
                </thead>
                <tbody>
                  @if($supportRequest->remarks->count() === 0)
                    <tr class="text-center">
                      <td colspan="3">
                        <h5 class="mt-3 mb-3">Tiada rekod</h5>
                      </td>
                    </tr>
                  @else
                    @foreach($supportRequest->remarks as $r)
                      <tr>
                        <td style="white-space: pre-line">{{ $r->remark }}</td>
                        <td>{{ $r->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                          <form method="POST" action="{{ route('support-center.remarks.delete', $r->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger"
                                    onclick="return confirm('Padam catatan ini?')">
                              <i class="bi bi-trash-fill"></i>
                            </button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>

          <br><hr><br>

          {{-- UPDATE FORM (status only triggers email) --}}
          <form action="{{ route('support-center.update', $supportRequest->id) }}" method="POST">
            @csrf
            @method('PATCH')

            {{-- STATUS (BM) --}}
            <div class="row mb-3">
              <div class="col-lg-4 label">Status:</div>
              <div class="col-sm-8">
                <select class="form-select" name="status" required>
                  <option hidden>Pilih Status</option>
                  @foreach (\App\Models\DevopsSupportRequest::STATUS_ALLOWED as $statusBm)
                    <option value="{{ $statusBm }}" {{ old('status', $supportRequest->status) === $statusBm ? 'selected' : '' }}>
                      {{ $statusBm }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            {{-- ADD NEW REMARK(S) --}}
            <button type="button" id="add-remark" class="btn btn-primary">Tambah Catatan</button>

            <div id="remarks-container">
              <div class="remark-form"></div>
            </div>

            <script>
              document.addEventListener('DOMContentLoaded', function() {
                const container = document.getElementById('remarks-container');
                const addButton = document.getElementById('add-remark');
                let remarkCount = 0;

                addButton.addEventListener('click', function() {
                  const newRemark = document.createElement('div');
                  newRemark.className = 'remark-form';
                  newRemark.innerHTML = `
                    <br>
                    <div class="row mb-3">
                      <label class="col-sm-4 col-form-label">Catatan ${remarkCount + 1}:</label>
                      <div class="col-sm-8">
                        <textarea name="remarks[${remarkCount}][remark]" class="form-control" style="height:100px"></textarea>
                        <button type="button" class="btn btn-primary remove-remark mt-1">Buang</button>
                      </div>
                    </div>
                  `;
                  container.appendChild(newRemark);
                  remarkCount++;
                });

                container.addEventListener('click', function(e) {
                  if (e.target.classList.contains('remove-remark')) {
                    e.target.closest('.remark-form').remove();
                  }
                });
              });
            </script>

            <br>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Kemaskini</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

</section>
{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
@endsection
