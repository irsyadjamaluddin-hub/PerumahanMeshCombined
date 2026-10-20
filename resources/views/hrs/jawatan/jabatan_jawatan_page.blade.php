@extends('hrs.layouts.landing')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid py-4" x-data="staffManager()">
    
    <!-- Status Jawatan - Lama Button (Top Right) -->
    <div class="d-flex justify-content-end mb-3">
        <button type="button"
                class="btn btn-info" 
                title="Status Jawatan - Lama Report"
                onclick="promptJawatanReport()">
            <i class="bi bi-file-earmark-text"></i> Status Jawatan - Lama
        </button>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Status Jawatan - Senarai Pemegang Jawatan (Non-Teaching)</h4>
        </div>
        <div class="card-body">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    <strong>Validation Errors:</strong>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Record Navigation -->
            <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light border rounded">
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('pj.nonteaching.jawatan', ['record' => 'first']) }}" 
                       class="btn btn-sm btn-outline-secondary" 
                       title="First Record">
                        <i class="bi bi-chevron-bar-left"></i>
                    </a>
                    <a href="{{ route('pj.nonteaching.jawatan', ['record' => 'prev', 'current' => $currentPosition]) }}" 
                       class="btn btn-sm btn-outline-secondary {{ $currentPosition <= 1 ? 'disabled' : '' }}" 
                       title="Previous">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                    <span class="mx-3">
                        <strong>Record:</strong> 
                        <input type="number" 
                               id="recordNumber"
                               class="form-control form-control-sm d-inline-block text-center" 
                               style="width: 60px;" 
                               value="{{ $currentPosition }}" 
                               min="1" 
                               max="{{ $totalRecords }}"
                               onchange="navigateToRecord(this.value)">
                        <span class="mx-1">of</span>
                        <strong>{{ $totalRecords }}</strong>
                    </span>
                    <a href="{{ route('pj.nonteaching.jawatan', ['record' => 'next', 'current' => $currentPosition]) }}" 
                       class="btn btn-sm btn-outline-secondary {{ $currentPosition >= $totalRecords ? 'disabled' : '' }}" 
                       title="Next">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                    <a href="{{ route('pj.nonteaching.jawatan', ['record' => 'last']) }}" 
                       class="btn btn-sm btn-outline-secondary" 
                       title="Last Record">
                        <i class="bi bi-chevron-bar-right"></i>
                    </a>
                    
                    <!-- Divider -->
                    <div style="width: 2px; height: 30px; background-color: #dee2e6; margin: 0 8px;"></div>
                    
                    <!-- New Record Button -->
                    <a href="{{ route('pj.nonteaching.jawatan.create') }}" 
                       class="btn btn-sm btn-success" 
                       title="Create New Record">
                        <i class="bi bi-plus-circle"></i> New Record
                    </a>
                    
                    @if($positionInfo)
                    <!-- Edit Record Button -->
                    <a href="{{ route('pj.nonteaching.jawatan.edit', ['kod_jawatan' => $positionInfo->Kod_Jawatan]) }}" 
                       class="btn btn-sm btn-primary" 
                       title="Edit This Record">
                        <i class="bi bi-pencil"></i> Edit Record
                    </a>
                    
                    <!-- Delete Record Button -->
                    <button type="button"
                            class="btn btn-sm btn-danger" 
                            title="Delete This Record"
                            onclick="if(confirm('Are you sure you want to DELETE this entire record (Kod Jawatan: {{ $positionInfo->Kod_Jawatan }})? This will remove the position and all associated staff!')) { document.getElementById('delete-record-form').submit(); }">
                        <i class="bi bi-trash"></i> Delete Record
                    </button>
                    @endif
                </div>
                
                <div class="d-flex align-items-center gap-2">
                    <input type="text" 
                           id="searchInput"
                           class="form-control form-control-sm" 
                           style="width: 200px;" 
                           placeholder="Search Kod Jawatan"
                           value="{{ request('kod_jawatan') }}">
                    <button type="button" class="btn btn-sm btn-primary" onclick="searchRecord()">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </div>

            @if(!isset($isCreateMode) || !$isCreateMode)
            <!-- Simple Filter Form -->
            <form method="{{ isset($isEditMode) && $isEditMode ? 'POST' : 'GET' }}" 
                  action="{{ isset($isEditMode) && $isEditMode ? route('pj.nonteaching.jawatan.update', ['kod_jawatan' => $positionInfo->Kod_Jawatan]) : route('pj.nonteaching.jawatan') }}" 
                  id="filterForm">
                
                @if(isset($isEditMode) && $isEditMode)
                    @csrf
                    @method('PUT')
                    <div class="alert alert-warning mb-3">
                        <i class="bi bi-pencil-square"></i> <strong>Edit Mode:</strong> You can now edit all fields below. Click "Save Changes" when done.
                    </div>
                @endif
                
               
                
                <div class="row mb-3">
                    <!-- Code Jawatan -->
                    <div class="col-md-2">
                        <label for="kod_jawatan" class="form-label fw-bold">Code Jawatan:</label>
                        <input type="text" 
                               class="form-control {{ isset($isEditMode) && $isEditMode ? '' : 'bg-light' }}" 
                               id="kod_jawatan" 
                               name="kod_jawatan" 
                               value="{{ $positionInfo->Kod_Jawatan ?? '' }}"
                               {{ isset($isEditMode) && $isEditMode ? '' : 'readonly' }}>
                    </div>

                    <!-- Kod Jabatan -->
                    <div class="col-md-2">
                        <label for="kod_jabatan" class="form-label fw-bold">Kod Jabatan:</label>
                        <input type="text" 
                               class="form-control {{ isset($isEditMode) && $isEditMode ? '' : 'bg-light' }}" 
                               id="kod_jabatan" 
                               name="kod_jabatan" 
                               value="{{ $positionInfo->Kod_Jabatan ?? '' }}"
                               {{ isset($isEditMode) && $isEditMode ? '' : 'readonly' }}>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Jabatan Dropdown -->
                    <div class="col-md-12">
                        <label for="jabatan" class="form-label fw-bold">Jabatan:</label>
                        <select class="form-select {{ isset($isEditMode) && $isEditMode ? '' : 'bg-light' }}" 
                                id="jabatan" 
                                name="jabatan"
                                {{ isset($isEditMode) && $isEditMode ? '' : 'disabled' }}>
                            <option value="">Pilih Jabatan</option>
                            @foreach($jabatanOptions as $jabatan)
                                <option value="{{ $jabatan }}" {{ ($positionInfo->Text183 ?? '') == $jabatan ? 'selected' : '' }}>
                                    {{ $jabatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Bahagian Dropdown -->
                    <div class="col-md-12">
                        <label for="bahagian" class="form-label fw-bold">Bahagian:</label>
                        <select class="form-select {{ isset($isEditMode) && $isEditMode ? '' : 'bg-light' }}" 
                                id="bahagian" 
                                name="bahagian"
                                {{ isset($isEditMode) && $isEditMode ? '' : 'disabled' }}>
                            <option value="">Pilih Bahagian</option>
                            @foreach($bahagianOptions as $bahagian)
                                <option value="{{ $bahagian }}" {{ ($positionInfo->Jawatan_Bahagian ?? '') == $bahagian ? 'selected' : '' }}>
                                    {{ $bahagian }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Unit Dropdown -->
                    <div class="col-md-12">
                        <label for="unit" class="form-label fw-bold">Unit:</label>
                        <select class="form-select {{ isset($isEditMode) && $isEditMode ? '' : 'bg-light' }}" 
                                id="unit" 
                                name="unit"
                                {{ isset($isEditMode) && $isEditMode ? '' : 'disabled' }}>
                            <option value="">Pilih Unit</option>
                            @foreach($unitOptions as $unit)
                                <option value="{{ $unit }}" {{ ($positionInfo->Unit ?? '') == $unit ? 'selected' : '' }}>
                                    {{ $unit }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Jawatan Display -->
                    <div class="col-md-12">
                        <label for="jawatan" class="form-label fw-bold">Jawatan:</label>
                        <input type="text" 
                               class="form-control {{ isset($isEditMode) && $isEditMode ? '' : 'bg-light' }}" 
                               id="jawatan"
                               name="jawatan" 
                               value="{{ $positionInfo->Jawatan ?? '' }}"
                               {{ isset($isEditMode) && $isEditMode ? '' : 'readonly' }}>
                    </div>
                </div>

                <div class="row mb-4">
                    <!-- Tanggagaji Display -->
                    <div class="col-md-12">
                        <label for="tanggagaji" class="form-label fw-bold">Tanggagaji:</label>
                        <input type="text" 
                               class="form-control {{ isset($isEditMode) && $isEditMode ? '' : 'bg-light' }}" 
                               id="tanggagaji"
                               name="tanggagaji" 
                               value="{{ $positionInfo->Tanggagaji ?? '' }}"
                               {{ isset($isEditMode) && $isEditMode ? '' : 'readonly' }}>
                    </div>
                </div>

                <!-- Budget Summary Section -->
                <div class="row mb-3 align-items-end">
                    <div class="col-auto">
                        <label class="form-label fw-bold mb-1">PERUNTUKAN</label>
                        <input type="number" 
                               class="form-control text-center {{ isset($isEditMode) && $isEditMode ? '' : 'bg-light' }}" 
                               style="width: 80px;"
                               name="peruntukan_baru"
                               value="{{ $positionInfo->Peruntukan_Baru ?? '0' }}"
                               {{ isset($isEditMode) && $isEditMode ? '' : 'readonly' }}>
                    </div>
                    <div class="col-auto">
                        <label class="form-label fw-bold mb-1">KOSONG</label>
                        <input type="number" 
                               class="form-control text-center {{ isset($isEditMode) && $isEditMode ? '' : 'bg-light' }}" 
                               style="width: 80px;"
                               name="kosong"
                               value="{{ $positionInfo->Kosong ?? '0' }}"
                               {{ isset($isEditMode) && $isEditMode ? '' : 'readonly' }}>
                    </div>
                    <div class="col-auto">
                        <label class="form-label fw-bold mb-1">PENUH</label>
                        <input type="number" 
                               class="form-control text-center {{ isset($isEditMode) && $isEditMode ? '' : 'bg-light' }}" 
                               style="width: 80px;"
                               name="penuh"
                               value="{{ $positionInfo->Penuh ?? '0' }}"
                               {{ isset($isEditMode) && $isEditMode ? '' : 'readonly' }}>
                    </div>
                    <div class="col-auto">
                        <label class="form-label fw-bold mb-1">NOTA</label>
                        <input type="text" 
                               class="form-control {{ isset($isEditMode) && $isEditMode ? '' : 'bg-light' }}" 
                               style="width: 150px;"
                               name="nota"
                               value="{{ $positionInfo->Nota ?? '' }}"
                               {{ isset($isEditMode) && $isEditMode ? '' : 'readonly' }}>
                    </div>
                    <div class="col-auto">
                        <label class="form-label fw-bold mb-1">JENIS JAWATAN</label>
                        <input type="text" 
                               class="form-control {{ isset($isEditMode) && $isEditMode ? '' : 'bg-light' }}" 
                               style="width: 180px;"
                               name="jenis_jawatan"
                               value="{{ $positionInfo->Jenis_Jawatan ?? '' }}"
                               {{ isset($isEditMode) && $isEditMode ? '' : 'readonly' }}>
                    </div>
                </div>

                <!-- Peniadaan Display -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="d-flex align-items-center gap-2">
                            <label class="form-label fw-bold mb-0">Peniadaan:</label>
                            <input type="text" 
                                   class="form-control {{ isset($isEditMode) && $isEditMode ? '' : 'bg-light' }}" 
                                   name="peniadaan"
                                   value="{{ $positionInfo->Peniadaan ?? '' }}"
                                   {{ isset($isEditMode) && $isEditMode ? '' : 'readonly' }}>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <p class="text-danger fst-italic mb-0" style="font-size: 0.9rem;">
                            hanya di isi apabila jawatan kosong...
                        </p>
                    </div>
                </div>
                
                @if(isset($isEditMode) && $isEditMode)
                <!-- Save/Cancel Buttons for Edit Mode -->
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="p-3 bg-light border rounded">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-save"></i> Save Changes
                            </button>
                            <a href="{{ route('pj.nonteaching.jawatan', ['kod_jawatan' => $positionInfo->Kod_Jawatan]) }}" 
                               class="btn btn-secondary btn-lg">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </form>
            @endif

            <!-- Staff List Table -->
            @if(isset($isCreateMode) && $isCreateMode)
                <!-- Create Mode: Show form to create new jawatan record -->
                <form method="POST" action="{{ route('pj.nonteaching.jawatan.store.record') }}">
                    @csrf
                    
                    <div class="alert alert-info mb-3">
                        <i class="bi bi-info-circle"></i> <strong>Create New Record Mode:</strong> Fill in the fields below to create a new status jawatan record.
                    </div>
                    
                    <!-- Kod Jawatan and Kod Jabatan -->
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Kod Jawatan: <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="kod_jawatan" 
                                   class="form-control" 
                                   placeholder="e.g., 1402"
                                   required
                                   value="{{ old('kod_jawatan') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Kod Jabatan:</label>
                            <input type="text" 
                                   name="kod_jabatan" 
                                   class="form-control" 
                                   placeholder="e.g., DA"
                                   value="{{ old('kod_jabatan') }}">
                        </div>
                    </div>
                    
                    <!-- Jabatan Dropdown -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="jabatan_create" class="form-label fw-bold">Jabatan:</label>
                            <select class="form-select" id="jabatan_create" name="jabatan">
                                <option value="">Pilih Jabatan</option>
                                @foreach($jabatanOptions as $jabatan)
                                    <option value="{{ $jabatan }}" {{ old('jabatan') == $jabatan ? 'selected' : '' }}>
                                        {{ $jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <!-- Bahagian Dropdown -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="bahagian_create" class="form-label fw-bold">Bahagian:</label>
                            <select class="form-select" id="bahagian_create" name="bahagian">
                                <option value="">Pilih Bahagian</option>
                                @foreach($bahagianOptions as $bahagian)
                                    <option value="{{ $bahagian }}" {{ old('bahagian') == $bahagian ? 'selected' : '' }}>
                                        {{ $bahagian }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <!-- Unit Dropdown -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="unit_create" class="form-label fw-bold">Unit:</label>
                            <select class="form-select" id="unit_create" name="unit">
                                <option value="">Pilih Unit</option>
                                @foreach($unitOptions as $unit)
                                    <option value="{{ $unit }}" {{ old('unit') == $unit ? 'selected' : '' }}>
                                        {{ $unit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <!-- Jawatan -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Jawatan:</label>
                            <input type="text" 
                                   name="jawatan" 
                                   class="form-control" 
                                   placeholder="e.g., Menteri Kaunselor"
                                   value="{{ old('jawatan') }}">
                        </div>
                    </div>
                    
                    <!-- Tanggagaji -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Tanggagaji:</label>
                            <input type="text" 
                                   name="tanggagaji" 
                                   class="form-control" 
                                   placeholder="e.g., Kumpulan 2"
                                   value="{{ old('tanggagaji') }}">
                        </div>
                    </div>
                    
                    <!-- Budget Summary -->
                    <div class="row mb-3 align-items-end">
                        <div class="col-auto">
                            <label class="form-label fw-bold mb-1">PERUNTUKAN</label>
                            <input type="number" 
                                   name="peruntukan_baru" 
                                   class="form-control text-center" 
                                   style="width: 80px;"
                                   value="{{ old('peruntukan_baru', 0) }}">
                        </div>
                        <div class="col-auto">
                            <label class="form-label fw-bold mb-1">KOSONG</label>
                            <input type="number" 
                                   name="kosong" 
                                   class="form-control text-center" 
                                   style="width: 80px;"
                                   value="{{ old('kosong', 0) }}">
                        </div>
                        <div class="col-auto">
                            <label class="form-label fw-bold mb-1">PENUH</label>
                            <input type="number" 
                                   name="penuh" 
                                   class="form-control text-center" 
                                   style="width: 80px;"
                                   value="{{ old('penuh', 0) }}">
                        </div>
                        <div class="col-auto">
                            <label class="form-label fw-bold mb-1">NOTA</label>
                            <input type="text" 
                                   name="nota" 
                                   class="form-control" 
                                   style="width: 150px;"
                                   placeholder="e.g., PINJAM"
                                   value="{{ old('nota') }}">
                        </div>
                        <div class="col-auto">
                            <label class="form-label fw-bold mb-1">JENIS JAWATAN</label>
                            <input type="text" 
                                   name="jenis_jawatan" 
                                   class="form-control" 
                                   style="width: 180px;"
                                   placeholder="e.g., BUKAN GUNASAMA"
                                   value="{{ old('jenis_jawatan') }}">
                        </div>
                    </div>
                    
                    <!-- Kosong and Peniadaan Display -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Peniadaan:</label>
                            <input type="text" 
                                   name="peniadaan" 
                                   class="form-control" 
                                   placeholder="Hanya diisi apabila jawatan kosong"
                                   value="{{ old('peniadaan') }}">
                        </div>
                    </div>
                    
                    <div class="mt-3 p-3 bg-light border rounded">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-save"></i> Create New Record
                        </button>
                        <a href="{{ route('pj.nonteaching.jawatan') }}" class="btn btn-secondary btn-lg">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                    </div>
                </form>
            @else
                <!-- Normal Mode: Show staff list with add/delete -->
                <form method="POST" action="{{ route('pj.nonteaching.jawatan.store') }}">
                @csrf
                <input type="hidden" name="kod_jawatan" value="{{ $positionInfo->Kod_Jawatan ?? '' }}">
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">Bil</th>
                                <th style="width: 150px;">No Kad Pintar</th>
                                <th>Nama</th>
                                <th style="width: 150px;">Tarikh Jawatan Sekarang</th>
                                <th>Sekolah Tempat Bertugas</th>
                                <th>Jabatan Tempat Bertugas</th>
                                <th style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Existing Staff Rows -->
                            @foreach($staffList as $index => $staff)
                                <tr>
                                    <td class="text-center">{{ $staff->Kod_Jawatan ?? '-' }}</td>
                                    <td>
                                        @if(isset($staff->id))
                                            <a href="{{ route('pj.show', ['id' => $staff->id]) }}" 
                                               class="text-primary text-decoration-none">
                                                {{ $staff->No_Kad_Pintar ?? '-' }}
                                            </a>
                                        @else
                                            {{ $staff->No_Kad_Pintar ?? '-' }}
                                        @endif
                                    </td>
                                    <td>{{ $staff->Nama ?? '-' }}</td>
                                    <td class="text-center">{{ $staff->Tarikh_Jawatan_Sekarang ?? '-' }}</td>
                                    <td>{{ $staff->Sekolah_Tempat_Bertugas ?? '-' }}</td>
                                    <td>{{ $staff->Jabatan_Tempat_Bertugas ?? '-' }}</td>
                                    <td class="text-center">
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a href="{{ route('pj.show', ['id' => $staff->id ?? 0]) }}" 
                                               class="btn btn-sm btn-info"
                                               title="View Profile">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <button type="button"
                                                    class="btn btn-sm btn-danger"
                                                    title="Delete Staff"
                                                    onclick="if(confirm('Are you sure you want to delete {{ addslashes($staff->Nama) }}?')) { document.getElementById('delete-form-{{ $staff->id ?? 0 }}').submit(); }">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            
                            <!-- New Staff Rows (Alpine.js) -->
                            <template x-for="(row, index) in newRows" :key="index">
                                <tr class="table-warning">
                                    <td class="text-center">
                                        <!-- Hidden input for form submission -->
                                        <input type="hidden" 
                                               :name="'new_staff[' + index + '][kod_jawatan]'" 
                                               :value="row.kod_jawatan">
                                        <!-- Visible display using x-text -->
                                        <span class="fw-bold" x-text="row.kod_jawatan"></span>
                                    </td>
                                    <td>
                                        <input type="text" 
                                               :name="'new_staff[' + index + '][no_kad_pintar]'" 
                                               x-model="row.no_kad_pintar" 
                                               class="form-control form-control-sm"
                                               placeholder="00-123456(K)"
                                               required>
                                    </td>
                                    <td>
                                        <input type="text" 
                                               :name="'new_staff[' + index + '][nama]'" 
                                               x-model="row.nama" 
                                               class="form-control form-control-sm"
                                               placeholder="Nama Penuh"
                                               required>
                                    </td>
                                    <td>
                                        <input type="date" 
                                               :name="'new_staff[' + index + '][tarikh_jawatan]'" 
                                               x-model="row.tarikh_jawatan" 
                                               class="form-control form-control-sm">
                                    </td>
                                    <td>
                                        <input type="text" 
                                               :name="'new_staff[' + index + '][sekolah]'" 
                                               x-model="row.sekolah" 
                                               class="form-control form-control-sm"
                                               placeholder="Sekolah/Tempat Bertugas">
                                    </td>
                                    <td>
                                        <input type="text" 
                                               :name="'new_staff[' + index + '][jabatan]'" 
                                               x-model="row.jabatan" 
                                               class="form-control form-control-sm"
                                               placeholder="Jabatan">
                                    </td>
                                    <td class="text-center">
                                        <button type="button" 
                                                @click="removeRow(index)" 
                                                class="btn btn-sm btn-danger"
                                                title="Delete Row">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                            
                            <!-- Empty State (only if no existing AND no new rows) -->
                            <tr x-show="!hasExistingStaff && newRows.length === 0">
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">
                                        @if(isset($positionInfo))
                                            <span class="text-danger fst-italic fw-bold">* {{ $positionInfo->Kod_Jawatan }}</span>
                                            <br>
                                            <span>{{ $positionInfo->Jawatan ?? 'Tiada maklumat jawatan' }}</span>
                                            <br>
                                            <small class="text-muted">Tiada pemegang jawatan bagi kod ini</small>
                                        @else
                                            Tiada data. Sila gunakan navigasi untuk melihat rekod.
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Action Buttons -->
                <div class="mt-3 d-flex gap-2 align-items-center">
                    <button type="button" 
                            @click="addNewRow()" 
                            class="btn btn-success btn-sm">
                        <i class="bi bi-plus-circle"></i> Add New Staff
                    </button>
                    
                    <button type="submit" 
                            class="btn btn-primary btn-sm"
                            x-show="newRows.length > 0"
                            @click="console.log('Submitting form with', newRows.length, 'rows'); console.log('Data:', newRows)"
                            x-cloak>
                        <i class="bi bi-save"></i> Save New Staff (<span x-text="newRows.length"></span>)
                    </button>
                    
                    <span class="text-muted ms-3" x-show="newRows.length > 0" x-cloak>
                        <i class="bi bi-info-circle"></i> 
                        <span x-text="newRows.length"></span> new staff will be added
                    </span>
                </div>
            </form>

            <!-- Hidden Delete Forms (outside main form to avoid nesting) -->
            @foreach($staffList as $staff)
                <form id="delete-form-{{ $staff->id ?? 0 }}" 
                      method="POST" 
                      action="{{ route('pj.nonteaching.jawatan.delete', ['id' => $staff->id ?? 0]) }}"
                      style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
            
            <!-- Hidden form to delete entire record -->
            @if($positionInfo)
                <form id="delete-record-form" 
                      method="POST" 
                      action="{{ route('pj.nonteaching.jawatan.delete.record', ['kod_jawatan' => $positionInfo->Kod_Jawatan]) }}"
                      style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endif

            @if(isset($staffList) && $staffList->count() > 0)
                <div class="mt-3">
                    <p class="text-muted mb-0">
                        <i class="bi bi-info-circle"></i> 
                        Jumlah pemegang jawatan: <strong>{{ $staffList->count() }}</strong>
                    </p>
                </div>
            @endif
            
            @endif {{-- Close the create mode if statement --}}
        </div>
    </div>
</div>

<style>
.form-label.fw-bold {
    font-weight: 600;
    font-size: 0.95rem;
}

.table-responsive {
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    margin-top: 1rem;
}

.table {
    margin-bottom: 0;
}

.table thead th {
    background-color: #e9ecef;
    font-weight: 600;
    text-align: center;
    vertical-align: middle;
    border-bottom: 2px solid #dee2e6;
    font-size: 0.9rem;
}

.table tbody td {
    vertical-align: middle;
    font-size: 0.9rem;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

.card-header {
    padding: 1rem 1.25rem;
}

.bg-light {
    background-color: #f8f9fa !important;
}

/* Navigation styles */
.btn-outline-secondary:hover {
    background-color: #6c757d;
    color: white;
}

.btn-outline-secondary:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* New row highlighting */
.table-warning {
    background-color: #fff3cd !important;
}

.table-warning input {
    background-color: #ffffff;
}

/* Alpine.js cloak */
[x-cloak] {
    display: none !important;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script defer src="{{ asset('vendor/alpinejs/alpine.min.js') }}"></script>

<script>
function staffManager() {
    return {
        newRows: [],
        kodJawatan: {!! json_encode($positionInfo->Kod_Jawatan ?? '') !!},
        hasExistingStaff: {{ $staffList->count() > 0 ? 'true' : 'false' }},
        
        init() {
            // Debug: Log the kod jawatan value
            console.log('Kod Jawatan:', this.kodJawatan);
            console.log('Type:', typeof this.kodJawatan);
        },
        
        addNewRow() {
            this.newRows.push({
                kod_jawatan: String(this.kodJawatan),
                no_kad_pintar: '',
                nama: '',
                tarikh_jawatan: '',
                sekolah: '',
                jabatan: ''
            });
            console.log('Added new row with Kod Jawatan:', this.kodJawatan);
        },
        
        removeRow(index) {
            if (confirm('Are you sure you want to remove this row?')) {
                this.newRows.splice(index, 1);
            }
        }
    }
}

function navigateToRecord(recordNum) {
    const num = parseInt(recordNum);
    const totalRecords = {{ $totalRecords }};
    
    if (num >= 1 && num <= totalRecords) {
        window.location.href = "{{ route('pj.nonteaching.jawatan') }}?position=" + num;
    } else {
        alert('Sila masukkan nombor rekod antara 1 dan ' + totalRecords);
        document.getElementById('recordNumber').value = {{ $currentPosition }};
    }
}

function searchRecord() {
    const searchValue = document.getElementById('searchInput').value.trim();
    if (searchValue) {
        window.location.href = "{{ route('pj.nonteaching.jawatan') }}?kod_jawatan=" + encodeURIComponent(searchValue);
    } else {
        alert('Sila masukkan Kod Jawatan untuk mencari');
    }
}

// Allow Enter key in search
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        searchRecord();
    }
});

// Allow Enter key in record number
document.getElementById('recordNumber').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        navigateToRecord(this.value);
    }
});

// Function to prompt for Jawatan name and redirect to report
function promptJawatanReport() {
    const jawatan = prompt('Masukkan Nama Jawatan (contoh: Kerani):');
    
    if (jawatan && jawatan.trim() !== '') {
        // Redirect to the status jawatan report page
        window.location.href = '{{ route("pj.nonteaching.jawatan.status.lama") }}?jawatan=' + encodeURIComponent(jawatan.trim());
    }
}
</script>

@endsection