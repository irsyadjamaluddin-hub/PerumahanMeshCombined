<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borang Status Jawatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('vendor/alpinejs/alpine.min.js') }}" defer></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        input[readonly] {
            background-color: #f3f4f6;
        }
        .section-header {
            background-color: #1e40af;
            color: white;
            padding: 0.75rem 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.2s;
        }
        .section-header:hover {
            background-color: #1e3a8a;
        }
        .section-content {
            border: 1px solid #d1d5db;
            border-top: none;
        }
        .form-row {
            display: grid;
            grid-template-columns: 200px 1fr;
            border-bottom: 1px solid #e5e7eb;
        }
        .form-row:last-child {
            border-bottom: none;
        }
        .form-label {
            padding: 0.75rem 1rem;
            background-color: #f9fafb;
            font-weight: 600;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
        }
        .form-input {
            padding: 0.75rem 1rem;
        }
        .form-input input,
        .form-input select,
        .form-input textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            padding: 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
        }
        .form-input input:focus,
        .form-input select:focus,
        .form-input textarea:focus {
            outline: none;
            ring: 2px;
            ring-color: #3b82f6;
        }
        .table-responsive {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th,
        table td {
            border: 1px solid #d1d5db;
            padding: 0.5rem;
            font-size: 0.875rem;
        }
        table th {
            background-color: #bfdbfe;
            font-weight: 600;
            text-align: left;
        }
        table input {
            width: 100%;
            border: none;
            padding: 0.25rem;
            background: transparent;
        }
        table input:focus {
            outline: 2px solid #3b82f6;
        }
        .chevron {
            transition: transform 0.3s;
        }
        .chevron.rotate {
            transform: rotate(180deg);
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6 max-w-7xl" x-data="{ 
        openSections: {
            kodPPB: true,
            kodJabatan: true,
            jabatan: true,
            jawatan: true,
            gaji: true,
            jumlah: true,
            status: false,
            kekosongan: false,
            templateJPA: false,
            spg: false,
            templatePPK: false,
            llh: false
        },
        searchQuery: '',
        toggleSection(section) {
            this.openSections[section] = !this.openSections[section];
        },
        searchRecord() {
            if (this.searchQuery.trim()) {
                document.getElementById('searchForm').submit();
            }
        }
    }">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-6 py-4">
                <h1 class="text-2xl font-bold">STATUS JAWATAN DI KEMENTERIAN PENDIDIKAN</h1>
                <p class="text-sm text-blue-100 mt-1">Borang Pengurusan Status Jawatan</p>
            </div>

            <!-- Navigation Bar -->
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b-2 border-blue-200">
                @if($totalRecords > 0 || ($totalRecords == 0 && !$record && request()->routeIs('status-jawatan.create')))
                <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                    <!-- Record Counter & Navigation -->
                    <div class="flex items-center gap-4">
                        <!-- Record Counter Badge -->
                        @if($totalRecords > 0)
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-xl shadow-lg">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <div>
                                    <div class="text-xs font-medium opacity-90">Record</div>
                                    <div class="text-lg font-bold">{{ $currentPosition }} <span class="text-sm font-normal opacity-75">of {{ $totalRecords }}</span></div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-3 rounded-xl shadow-lg">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <div>
                                    <div class="text-xs font-medium opacity-90">Mode</div>
                                    <div class="text-lg font-bold">New Record</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Back to Records Button (only in create mode) -->
                        <a href="{{ route('status-jawatan.show') }}" 
                           class="group relative px-6 py-3 bg-white border-2 border-blue-500 text-blue-600 rounded-xl hover:bg-blue-50 transition-all duration-200 shadow-md hover:shadow-lg font-semibold text-sm">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
                                </svg>
                                <span>Back to Records</span>
                            </div>
                        </a>
                        @endif
                        
                        <!-- Navigation Buttons (only show in edit mode with records) -->
                        @if($totalRecords > 0)
                        <div class="flex items-center gap-2 bg-white rounded-xl shadow-md p-2">
                            <!-- First Button -->
                            <a href="{{ $firstKodJawatan ? route('status-jawatan.show', ['kod_jawatan' => $firstKodJawatan]) : '#' }}" 
                               class="group relative px-4 py-2.5 rounded-lg transition-all duration-200 {{ !$prevKodJawatan ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white hover:shadow-lg hover:scale-105' }}" 
                               title="First Record"
                               {{ !$firstKodJawatan ? 'onclick="return false;"' : '' }}>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                                </svg>
                                <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">First</span>
                            </a>
                            
                            <!-- Previous Button -->
                            <a href="{{ $prevKodJawatan ? route('status-jawatan.show', ['kod_jawatan' => $prevKodJawatan]) : '#' }}" 
                               class="group relative px-4 py-2.5 rounded-lg transition-all duration-200 {{ !$prevKodJawatan ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white hover:shadow-lg hover:scale-105' }}" 
                               title="Previous Record"
                               {{ !$prevKodJawatan ? 'onclick="return false;"' : '' }}>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Previous</span>
                            </a>
                            
                            <!-- Divider -->
                            <div class="w-px h-8 bg-gray-200"></div>
                            
                            <!-- Next Button -->
                            <a href="{{ $nextKodJawatan ? route('status-jawatan.show', ['kod_jawatan' => $nextKodJawatan]) : '#' }}" 
                               class="group relative px-4 py-2.5 rounded-lg transition-all duration-200 {{ !$nextKodJawatan ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white hover:shadow-lg hover:scale-105' }}" 
                               title="Next Record"
                               {{ !$nextKodJawatan ? 'onclick="return false;"' : '' }}>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Next</span>
                            </a>
                            
                            <!-- Last Button -->
                            <a href="{{ $lastKodJawatan ? route('status-jawatan.show', ['kod_jawatan' => $lastKodJawatan]) : '#' }}" 
                               class="group relative px-4 py-2.5 rounded-lg transition-all duration-200 {{ !$nextKodJawatan ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white hover:shadow-lg hover:scale-105' }}" 
                               title="Last Record"
                               {{ !$lastKodJawatan ? 'onclick="return false;"' : '' }}>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                </svg>
                                <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Last</span>
                            </a>
                            
                            <!-- Divider -->
                            <div class="w-px h-8 bg-gray-200"></div>
                            
                            <!-- New Record Button -->
                            <a href="{{ route('status-jawatan.create') }}" 
                               class="group relative px-4 py-2.5 rounded-lg transition-all duration-200 bg-gradient-to-r from-green-50 to-emerald-50 text-green-600 hover:from-green-500 hover:to-emerald-500 hover:text-white hover:shadow-lg hover:scale-105" 
                               title="Create New Record">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">New Record</span>
                            </a>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Search Form (show in both modes) -->
                    @if($totalRecords > 0)
                    <form id="searchForm" action="{{ route('status-jawatan.search') }}" method="GET" class="flex items-center gap-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="search_query" 
                                   x-model="searchQuery" 
                                   placeholder="Search by Kod Jawatan or Jawatan..." 
                                   class="pl-11 pr-4 py-3 w-80 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 text-sm bg-white shadow-sm">
                        </div>
                        <button type="submit" 
                                class="group relative px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105 font-semibold text-sm">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span>Search</span>
                            </div>
                        </button>
                    </form>
                    @endif
                </div>
                @else
                <div class="text-center py-6">
                    <div class="inline-flex items-center gap-3 bg-yellow-50 text-yellow-800 px-6 py-4 rounded-xl shadow-md">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div class="text-left">
                            <p class="font-semibold">Tiada rekod dijumpai dalam database</p>
                            <p class="text-sm text-yellow-600 mt-1">Sila tambah rekod baru terlebih dahulu</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            @if($totalRecords > 0 && $record)
            <form action="{{ route('status-jawatan.update', ['kod_jawatan' => $record->Kod_Jawatan]) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
            @elseif($totalRecords == 0 && !$record)
            <!-- Blank form for new record -->
            <form action="{{ route('status-jawatan.store') }}" method="POST" class="p-6">
                @csrf
            @else
            <div class="p-6">
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Tiada rekod dalam database. Sila tambah rekod dalam table <strong>status_jawatan_form</strong> terlebih dahulu.
                            </p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('status-jawatan.index') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 inline-block">
                    Kembali ke Senarai
                </a>
            </div>
            @endif
            
            @if(($totalRecords > 0 && $record) || ($totalRecords == 0 && !$record))
                
                <!-- Section 1: KOD PPB -->
                <div class="mb-4">
                    <div class="section-header" @click="toggleSection('kodPPB')">
                        <span>KOD PPB</span>
                        <svg class="w-5 h-5 chevron" :class="openSections.kodPPB ? 'rotate' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div x-show="openSections.kodPPB" x-collapse class="section-content">
                        <div class="form-row">
                            <div class="form-label">Kod Program</div>
                            <div class="form-input">
                                <input type="text" name="kod_program" value="{{ $record->Kod_Program ?? '' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Program</div>
                            <div class="form-input">
                                <input type="text" name="program" value="{{ $record->Text155 ?? '' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Aktiviti</div>
                            <div class="form-input">
                                <input type="text" name="aktiviti" value="{{ $record->Aktiviti ?? '' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Kod Aktiviti</div>
                            <div class="form-input">
                                <input type="text" name="kod_aktiviti" value="{{ $record->Kod_Aktiviti ?? '' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Fungsi Jawatan</div>
                            <div class="form-input">
                                <input type="text" name="fungsi_jawatan" value="{{ $record->Fungsi_Jawatan ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: KOD Jabatan -->
                <div class="mb-4">
                    <div class="section-header" @click="toggleSection('kodJabatan')">
                        <span>KOD JABATAN</span>
                        <svg class="w-5 h-5 chevron" :class="openSections.kodJabatan ? 'rotate' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div x-show="openSections.kodJabatan" x-collapse class="section-content">
                        <div class="form-row">
                            <div class="form-label">Kod Jawatan</div>
                            <div class="form-input">
                                <input type="text" name="kod_jawatan_kod" value="{{ $record->Kod_Jawatan ?? '' }}" {{ $record ? 'readonly' : '' }} placeholder="Masukkan Kod Jawatan">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Kod Jabatan</div>
                            <div class="form-input">
                                <input type="text" name="kod_jabatan" value="{{ $record->Kod_Jabatan ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: JABATAN -->
                <div class="mb-4">
                    <div class="section-header" @click="toggleSection('jabatan')">
                        <span>JABATAN</span>
                        <svg class="w-5 h-5 chevron" :class="openSections.jabatan ? 'rotate' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div x-show="openSections.jabatan" x-collapse class="section-content">
                        <div class="bg-yellow-50 px-4 py-2 text-xs italic text-gray-600 border-b border-gray-300">
                            <strong>Nota:</strong> {{ $record->Nota ?? '' }}
                        </div>
                        <div class="form-row">
                            <div class="form-label">Jabatan</div>
                            <div class="form-input">
                                <input type="text" name="jabatan" value="{{ $record->Text183 ?? '' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Bahagian</div>
                            <div class="form-input">
                                <input type="text" name="bahagian" value="{{ $record->Jabatan_Bahagian ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 4: JAWATAN -->
                <div class="mb-4">
                    <div class="section-header" @click="toggleSection('jawatan')">
                        <span>JAWATAN</span>
                        <svg class="w-5 h-5 chevron" :class="openSections.jawatan ? 'rotate' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div x-show="openSections.jawatan" x-collapse class="section-content">
                        <div class="form-row">
                            <div class="form-label">Jawatan</div>
                            <div class="form-input">
                                <input type="text" name="jawatan" value="{{ $record->Jawatan ?? '' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Tangggaji</div>
                            <div class="form-input">
                                <input type="text" name="tangggaji" value="{{ $record->Tanggagaji ?? '' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Divisyen</div>
                            <div class="form-input">
                                <input type="text" name="divisyen" value="{{ $record->Jawatan_Bahagian ?? '' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Status Jawatan</div>
                            <div class="form-input">
                                <input type="text" name="status_jawatan" value="{{ $record->Nota ?? '' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Jenis Jawatan *</div>
                            <div class="form-input bg-gray-50">
                                <input type="text" name="jenis_jawatan" value="{{ $record->Jenis_Jawatan ?? '' }}">
                                <p class="text-xs text-gray-500 mt-1 italic">* Hanya diisi apabila jawatan kosong</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 5: GAJI DAN PERUNTUKAN -->
                <div class="mb-4">
                    <div class="section-header" @click="toggleSection('gaji')">
                        <span>GAJI DAN PERUNTUKAN</span>
                        <svg class="w-5 h-5 chevron" :class="openSections.gaji ? 'rotate' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div x-show="openSections.gaji" x-collapse class="section-content">
                        <div class="form-row">
                            <div class="form-label">Starting Gaji</div>
                            <div class="form-input">
                                <input type="text" name="starting_gaji" value="{{ $record->Jumlah_Gaji ?? '' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Peruntukan **</div>
                            <div class="form-input">
                                <input type="text" name="peruntukan" value="{{ $record->Budget ?? '' }}">
                                <p class="text-xs text-gray-500 mt-1 italic">** Hanya diisi apabila jawatan bukan SF/IA</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 6: JUMLAH -->
                <div class="mb-4">
                    <div class="section-header" @click="toggleSection('jumlah')">
                        <span>JUMLAH PERUNTUKAN</span>
                        <svg class="w-5 h-5 chevron" :class="openSections.jumlah ? 'rotate' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div x-show="openSections.jumlah" x-collapse class="section-content">
                        <div class="table-responsive p-4">
                            <table>
                                <thead>
                                    <tr class="bg-yellow-400">
                                        <th class="text-center">Peruntukan Lama</th>
                                        <th class="text-center">Peruntukan Baru</th>
                                        <th class="text-center">Kosong ***</th>
                                        <th class="text-center">Penuh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            <input type="number" name="peruntukan_lama" value="{{ $record->Peruntukan_Lama ?? 0 }}" class="text-center">
                                        </td>
                                        <td class="text-center">
                                            <input type="number" name="peruntukan_baru" value="{{ $record->Peruntukan_Baru ?? 0 }}" class="text-center">
                                        </td>
                                        <td class="text-center bg-gray-100">
                                            <input type="number" name="kosong" value="{{ $record->Kosong ?? 0 }}" class="text-center" readonly>
                                            <p class="text-xs text-gray-600 mt-1">*** Auto update</p>
                                        </td>
                                        <td class="text-center">
                                            <input type="number" name="penuh" value="{{ $record->Penuh ?? 0 }}" class="text-center">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Section 7: STATUS -->
                <div class="mb-4">
                    <div class="section-header" @click="toggleSection('status')">
                        <span>STATUS</span>
                        <svg class="w-5 h-5 chevron" :class="openSections.status ? 'rotate' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div x-show="openSections.status" x-collapse class="section-content p-4">
                        <textarea name="status_content" rows="12" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Masukkan maklumat status...">{{ $record->Keterangan ?? '' }}</textarea>
                    </div>
                </div>

                <!-- Section 8: KEKOSONGAN DISEBABKAN -->
                <div class="mb-4">
                    <div class="section-header" @click="toggleSection('kekosongan')">
                        <span>KEKOSONGAN DISEBABKAN</span>
                        <svg class="w-5 h-5 chevron" :class="openSections.kekosongan ? 'rotate' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div x-show="openSections.kekosongan" x-collapse class="section-content p-4">
                        <textarea name="kekosongan_content" rows="12" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Masukkan sebab kekosongan...">{{ $record->Sebab_Kekosongan ?? '' }}</textarea>
                    </div>
                </div>

                <!-- Section 9: TEMPLATE JPA -->
                <div class="mb-4">
                    <div class="section-header" @click="toggleSection('templateJPA')">
                        <span>TEMPLATE JPA</span>
                        <svg class="w-5 h-5 chevron" :class="openSections.templateJPA ? 'rotate' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div x-show="openSections.templateJPA" x-collapse class="section-content">
                        <div class="p-4 space-y-4">
                            <div class="form-row">
                                <div class="form-label">KOD JPA</div>
                                <div class="form-input">
                                    <input type="text" name="kod_jpa" value="{{ $record->Kod_JPA ?? '' }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label">Tarikh Mulai Kosong</div>
                                <div class="form-input">
                                    <input type="text" name="tarikh_mulai_kosong" value="{{ $record->Tarikh_mulai_kosong ?? '' }}" placeholder="DD.MM.YYYY">
                                </div>
                            </div>
                            <div>
                                <label class="block font-semibold mb-2 text-sm px-4">Summarize</label>
                                <textarea name="summarize" rows="6" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm mx-4" style="width: calc(100% - 2rem);">{{ $record->Status_JPA ?? '' }}</textarea>
                            </div>
                        </div>

                        <!-- KOD Reference Table -->
                        <div class="p-4">
                            <div class="bg-blue-100 px-4 py-2 font-bold text-sm mb-2">
                                *KOD RUJUKAN
                            </div>
                            <div class="table-responsive">
                                <table class="text-xs">
                                    <tbody>
                                        <tr>
                                            <td class="font-bold bg-gray-50" style="width: 60px;">A</td>
                                            <td style="width: 20px;">-</td>
                                            <td>Telah dihadapkan ke SPA untuk diklankan pada ......</td>
                                        </tr>
                                        <tr>
                                            <td class="font-bold bg-gray-50">B</td>
                                            <td>-</td>
                                            <td>Telah diklankan menurut Bab 7(a). Tarikh tutup iklan:.....</td>
                                        </tr>
                                        <tr>
                                            <td class="font-bold bg-gray-50">C</td>
                                            <td>-</td>
                                            <td>Telah diklankan menurut Bab 38(a). Tarikh tutup iklan:.....</td>
                                        </tr>
                                        <tr>
                                            <td class="font-bold bg-gray-50">D</td>
                                            <td>-</td>
                                            <td>Telah diklankan menurut Bab 38(b). Tarikh tutup iklan:.....</td>
                                        </tr>
                                        <tr>
                                            <td class="font-bold bg-gray-50">E</td>
                                            <td>-</td>
                                            <td>Sesi ujian bertulis diadakan pada:...</td>
                                        </tr>
                                        <tr>
                                            <td class="font-bold bg-gray-50">F</td>
                                            <td>-</td>
                                            <td>Sesi temuduga telah diadakan pada:...</td>
                                        </tr>
                                        <tr>
                                            <td class="font-bold bg-gray-50">G</td>
                                            <td>-</td>
                                            <td>Lantikan sudah ada dan perjawatan/kakitangan berkenaan belum melapor</td>
                                        </tr>
                                        <tr>
                                            <td class="font-bold bg-gray-50">H</td>
                                            <td>-</td>
                                            <td>Skrin perkhidmatan dalam penelitian dan dihadapkan ke....</td>
                                        </tr>
                                        <tr>
                                            <td class="font-bold bg-gray-50">I</td>
                                            <td>-</td>
                                            <td>Di isikan secara bergaji hari (secara sementara), sejak...</td>
                                        </tr>
                                        <tr>
                                            <td class="font-bold bg-gray-50">J</td>
                                            <td>-</td>
                                            <td>Jawatan "trade off"</td>
                                        </tr>
                                        <tr>
                                            <td class="font-bold bg-gray-50">K</td>
                                            <td>-</td>
                                            <td>Untuk di tukar gelaran jawatan, jika sudah diproses, nyatakan kepihak mana anya dihadapkan dan tarikh dihadapkan</td>
                                        </tr>
                                        <tr>
                                            <td class="font-bold bg-gray-50">L</td>
                                            <td>-</td>
                                            <td>Dalam proses sokongan kenaikan pangkat, dihadapkan pada....</td>
                                        </tr>
                                        <tr>
                                            <td class="font-bold bg-gray-50">M</td>
                                            <td>-</td>
                                            <td>Lain-lain sila nyatakan...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 10: SPG -->
                <div class="mb-4">
                    <div class="section-header" @click="toggleSection('spg')">
                        <span>SPG (SURAT PERSETUJUAN GAJI)</span>
                        <svg class="w-5 h-5 chevron" :class="openSections.spg ? 'rotate' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div x-show="openSections.spg" x-collapse class="section-content p-4">
                        <!-- First Table -->
                        <div class="mb-6">
                            <h3 class="font-semibold mb-2 text-sm">Maklumat Jawatan</h3>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="width: 30px;">*</th>
                                            <th>Jawatan</th>
                                            <th>Tangggaji</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                            <th>Dalam Budget</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">*</td>
                                            <td><input type="text" name="spg_jawatan_1" value="{{ $record->spg_jawatan_1 ?? '' }}"></td>
                                            <td><input type="text" name="spg_tangggaji_1" value="{{ $record->spg_tangggaji_1 ?? '' }}"></td>
                                            <td><input type="text" name="spg_jumlah_1" value="{{ $record->spg_jumlah_1 ?? '' }}"></td>
                                            <td><input type="text" name="spg_status_1" value="{{ $record->spg_status_1 ?? '' }}"></td>
                                            <td><input type="text" name="spg_budget_1" value="{{ $record->spg_budget_1 ?? '' }}"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input type="text" name="spg_jawatan_2" value="{{ $record->spg_jawatan_2 ?? '' }}"></td>
                                            <td><input type="text" name="spg_tangggaji_2" value="{{ $record->spg_tangggaji_2 ?? '' }}"></td>
                                            <td><input type="text" name="spg_jumlah_2" value="{{ $record->spg_jumlah_2 ?? '' }}"></td>
                                            <td><input type="text" name="spg_status_2" value="{{ $record->spg_status_2 ?? '' }}"></td>
                                            <td><input type="text" name="spg_budget_2" value="{{ $record->spg_budget_2 ?? '' }}"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input type="text" name="spg_jawatan_3" value="{{ $record->spg_jawatan_3 ?? '' }}"></td>
                                            <td><input type="text" name="spg_tangggaji_3" value="{{ $record->spg_tangggaji_3 ?? '' }}"></td>
                                            <td><input type="text" name="spg_jumlah_3" value="{{ $record->spg_jumlah_3 ?? '' }}"></td>
                                            <td><input type="text" name="spg_status_3" value="{{ $record->spg_status_3 ?? '' }}"></td>
                                            <td><input type="text" name="spg_budget_3" value="{{ $record->spg_budget_3 ?? '' }}"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input type="text" name="spg_jawatan_4" value="{{ $record->spg_jawatan_4 ?? '' }}"></td>
                                            <td><input type="text" name="spg_tangggaji_4" value="{{ $record->spg_tangggaji_4 ?? '' }}"></td>
                                            <td><input type="text" name="spg_jumlah_4" value="{{ $record->spg_jumlah_4 ?? '' }}"></td>
                                            <td><input type="text" name="spg_status_4" value="{{ $record->spg_status_4 ?? '' }}"></td>
                                            <td><input type="text" name="spg_budget_4" value="{{ $record->spg_budget_4 ?? '' }}"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Second Table -->
                        <div>
                            <h3 class="font-semibold mb-2 text-sm">Maklumat Pegawai</h3>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="width: 30px;">*</th>
                                            <th>Nama</th>
                                            <th>Bil Waran Lulus</th>
                                            <th>No Kad Pintar</th>
                                            <th>Ruj Memo SPA SPG</th>
                                            <th>Tarikh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">*</td>
                                            <td><input type="text" name="spg_nama_1" value="{{ $record->spg_nama_1 ?? '' }}"></td>
                                            <td><input type="text" name="spg_bil_waran_1" value="{{ $record->spg_bil_waran_1 ?? '' }}"></td>
                                            <td><input type="text" name="spg_kad_pintar_1" value="{{ $record->spg_kad_pintar_1 ?? '' }}"></td>
                                            <td><input type="text" name="spg_ruj_memo_1" value="{{ $record->spg_ruj_memo_1 ?? '' }}"></td>
                                            <td><input type="text" name="spg_tarikh_1" value="{{ $record->spg_tarikh_1 ?? '' }}"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 11: TEMPLATE PPK -->
                <div class="mb-4">
                    <div class="section-header" @click="toggleSection('templatePPK')">
                        <span>TEMPLATE PPK</span>
                        <svg class="w-5 h-5 chevron" :class="openSections.templatePPK ? 'rotate' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div x-show="openSections.templatePPK" x-collapse class="section-content p-4">
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium mb-1">Link SPA</label>
                                <input type="text" name="link_spa" value="{{ $record->Link_SPA ?? '' }}" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Tarikh DA ke SPA</label>
                                <input type="text" name="tarikh_da_spa" value="{{ $record->Tarikh_DA_ke_SPA ?? '' }}" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Tarikh Tutup Iklan</label>
                                <input type="text" name="tarikh_tutup_iklan" value="{{ $record->Tarikh_Tutup_Iklan ?? '' }}" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Tarikh Ujian Bertulis</label>
                                <input type="text" name="tarikh_ujian" value="{{ $record->Tarikh_Ujian_Bertulis ?? '' }}" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Tarikh Temuduga</label>
                                <input type="text" name="tarikh_temuduga" value="{{ $record->Tarikh_Temuduga ?? '' }}" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Tarikh Jawatan Disikan</label>
                                <input type="text" name="tarikh_disikan" value="{{ $record->Tarikh_Jawatan_Disikan ?? '' }}" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 12: LLH -->
                <div class="mb-4">
                    <div class="section-header" @click="toggleSection('llh')">
                        <span>LLH (LAPORAN LAIN-LAIN)</span>
                        <svg class="w-5 h-5 chevron" :class="openSections.llh ? 'rotate' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div x-show="openSections.llh" x-collapse class="section-content p-4">
                        <div class="mb-4">
                            <label class="block font-semibold mb-2 text-sm">Status dalam Buku Budget:</label>
                            <textarea name="status_buku_budget" rows="6" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">{{ $record->{'Lain_Lain_Hal_SF01'} ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block font-semibold mb-2 text-sm">Tindakan Lama:</label>
                            <textarea name="tindakan_lama" rows="6" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">{{ $record->Tindakan_Lama ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex flex-wrap gap-4 p-6 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl border border-gray-200">
                    <!-- Submit Button -->
                    <button type="submit" class="group relative bg-gradient-to-r from-blue-600 to-blue-700 text-white px-10 py-4 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl hover:scale-105 text-sm overflow-hidden">
                        <!-- Animated background effect -->
                        <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-200"></div>
                        <div class="relative flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                            </svg>
                            @if($record)
                                <span>Kemaskini Data</span>
                            @else
                                <span>Simpan Rekod Baru</span>
                            @endif
                        </div>
                    </button>

                    <!-- Reset Button -->
                    <button type="reset" class="group relative bg-gradient-to-r from-gray-600 to-gray-700 text-white px-10 py-4 rounded-xl hover:from-gray-700 hover:to-gray-800 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl hover:scale-105 text-sm overflow-hidden">
                        <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-200"></div>
                        <div class="relative flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span>Reset Form</span>
                        </div>
                    </button>

                    @if($record)
                    <!-- Delete Button (only in edit mode) -->
                    <button type="button" 
                            onclick="confirmDelete('{{ $record->Kod_Jawatan }}')"
                            class="group relative bg-gradient-to-r from-red-600 to-red-700 text-white px-10 py-4 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl hover:scale-105 text-sm overflow-hidden">
                        <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-200"></div>
                        <div class="relative flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            <span>Padam Rekod</span>
                        </div>
                    </button>
                    @endif

                    @if(!$record)
                    <!-- Cancel Button (only in create mode) -->
                    <a href="{{ route('status-jawatan.show') }}" class="group relative bg-white border-2 border-red-300 text-red-600 px-10 py-4 rounded-xl hover:border-red-400 hover:bg-red-50 transition-all duration-200 font-semibold shadow-md hover:shadow-lg hover:scale-105 inline-block text-center text-sm">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span>Batal</span>
                        </div>
                    </a>
                    @endif
                </div>
            </form>

            <!-- Hidden Delete Form (outside main form) -->
            @if($record)
            <form id="delete-form-{{ $record->Kod_Jawatan }}" 
                  action="{{ route('status-jawatan.destroy', ['kod_jawatan' => $record->Kod_Jawatan]) }}" 
                  method="POST" 
                  style="display: none;">
                @csrf
                @method('DELETE')
            </form>

            <script>
            function confirmDelete(kodJawatan) {
                if (confirm('Adakah anda pasti mahu memadam rekod Kod Jawatan: ' + kodJawatan + '?\n\nTindakan ini tidak boleh dibatalkan!')) {
                    document.getElementById('delete-form-' + kodJawatan).submit();
                }
            }
            </script>
            @endif
            @endif
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in">
        ✓ {{ session('success') }}
    </div>
    <script>
        setTimeout(function() {
            const successMsg = document.querySelector('.bg-green-500');
            if(successMsg) successMsg.style.display = 'none';
        }, 3000);
    </script>
    @endif

    @if($errors->any())
    <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 max-w-md">
        <div class="font-bold mb-2">⚠ Terdapat ralat:</div>
        <ul class="list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <script>
        setTimeout(function() {
            const errorMsg = document.querySelector('.bg-red-500');
            if(errorMsg) errorMsg.style.display = 'none';
        }, 5000);
    </script>
    @endif

    <!-- Footer -->
    <footer class="text-center text-gray-500 mt-8 mb-4 text-sm">
        Ministry Of Education @ {{ date('Y') }} All Rights Reserved. Powered by DevOps ICT.
    </footer>
</body>
</html>