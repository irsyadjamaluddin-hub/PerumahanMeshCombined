@extends('hrs.layouts.app-minimal')

@section('title', 'Non-Teaching Staff List')

@push('styles')
<style>
    body {
        background: linear-gradient(to bottom right, #eff6ff, #dbeafe) !important;
        min-height: 100vh;
    }
</style>
@endpush

@section('content')

    <div class="py-8 px-4" x-data="{
    query: '',
    datas: {{ json_encode($spjs) }},
    itemsPerPage: 20,
    currentPage: 1,
    sortBy: 'nama',
    sortOrder: 'asc',

    // 🔹 Export Modal States - UPDATED WITH NO_FILTER
    showExportModal: false,
    exportJawatan: 'no_filter',
    exportJantina: 'no_filter',
    exportDivisyen: 'no_filter',
    exportJenisTanggagaji: 'no_filter',
    exportTanggagajiSebenar: 'no_filter',
    exportUmurMin: '',
    exportUmurMax: '',
    exportTarikhBersaraFrom: '',
    exportTarikhBersaraTo: '',
    exportCawanganDaerah: 'no_filter',
    exportKelulusan: 'no_filter',
    exportJabatan: 'no_filter',
    exportStatus: 'no_filter',
    
    // 🔹 Open Export Modal
    openExportModal() {
        this.showExportModal = true;
    },

    // 🔹 Close Export Modal - UPDATED TO RESET TO NO_FILTER
    closeExportModal() {
        this.showExportModal = false;
        this.exportJawatan = 'no_filter';
        this.exportJantina = 'no_filter';
        this.exportDivisyen = 'no_filter';
        this.exportJenisTanggagaji = 'no_filter';
        this.exportTanggagajiSebenar = 'no_filter';
        this.exportUmurMin = '';
        this.exportUmurMax = '';
        this.exportTarikhBersaraFrom = '';
        this.exportTarikhBersaraTo = '';
        this.exportCawanganDaerah = 'no_filter';
        this.exportKelulusan = 'no_filter';
        this.exportJabatan = 'no_filter';
        this.exportStatus = 'no_filter';
    },

    // 🔹 Trigger Export - UPDATED LOGIC
    exportExcel() {
        let exportUrl = '{{ route('pj.spj.export') }}';
        let params = new URLSearchParams();
        
        // Convert empty string to 'all', skip 'no_filter'
        if (this.exportJawatan !== 'no_filter') {
            params.append('jawatan', this.exportJawatan === '' ? 'all' : this.exportJawatan);
        }
        if (this.exportJantina !== 'no_filter') {
            params.append('jantina', this.exportJantina === '' ? 'all' : this.exportJantina);
        }
        if (this.exportDivisyen !== 'no_filter') {
            params.append('divisyen', this.exportDivisyen === '' ? 'all' : this.exportDivisyen);
        }
        if (this.exportJenisTanggagaji !== 'no_filter') {
            params.append('jenisTanggagaji', this.exportJenisTanggagaji === '' ? 'all' : this.exportJenisTanggagaji);
        }
        if (this.exportTanggagajiSebenar !== 'no_filter') {
            params.append('tanggagajiSebenar', this.exportTanggagajiSebenar === '' ? 'all' : this.exportTanggagajiSebenar);
        }
        if (this.exportCawanganDaerah !== 'no_filter') {
            params.append('cawanganDaerah', this.exportCawanganDaerah === '' ? 'all' : this.exportCawanganDaerah);
        }
        if (this.exportKelulusan !== 'no_filter') {
            params.append('kelulusan', this.exportKelulusan === '' ? 'all' : this.exportKelulusan);
        }
        if (this.exportJabatan !== 'no_filter') {
            params.append('jabatan', this.exportJabatan === '' ? 'all' : this.exportJabatan);
        }
        if (this.exportStatus !== 'no_filter') {
            params.append('status', this.exportStatus === '' ? 'all' : this.exportStatus);
        }
        
        // Keep umur and tarikh as-is (no change)
        if (this.exportUmurMin) params.append('umurMin', this.exportUmurMin);
        if (this.exportUmurMax) params.append('umurMax', this.exportUmurMax);
        if (this.exportTarikhBersaraFrom) params.append('tarikhBersaraFrom', this.exportTarikhBersaraFrom);
        if (this.exportTarikhBersaraTo) params.append('tarikhBersaraTo', this.exportTarikhBersaraTo);
        
        if (params.toString()) {
            exportUrl += '?' + params.toString();
        }

        window.location.href = exportUrl;
        this.closeExportModal();
    },
    
    get statusOptions() {
        return ['Active', 'Retired', 'Inactive'];
    },
    
    // 🔹 Export Summary - UPDATED
    get exportSummary() {
        let filters = [];
        if (this.exportJawatan && this.exportJawatan !== 'no_filter') {
            filters.push('Jawatan: ' + (this.exportJawatan === '' ? 'All' : this.exportJawatan));
        }
        if (this.exportJantina && this.exportJantina !== 'no_filter') {
            filters.push('Jantina: ' + (this.exportJantina === '' ? 'All' : this.exportJantina));
        }
        if (this.exportDivisyen && this.exportDivisyen !== 'no_filter') {
            filters.push('Divisyen: ' + (this.exportDivisyen === '' ? 'All' : this.exportDivisyen));
        }
        if (this.exportJenisTanggagaji && this.exportJenisTanggagaji !== 'no_filter') {
            filters.push('Jenis Tanggagaji: ' + (this.exportJenisTanggagaji === '' ? 'All' : this.exportJenisTanggagaji));
        }
        if (this.exportTanggagajiSebenar && this.exportTanggagajiSebenar !== 'no_filter') {
            filters.push('Tanggagaji Sebenar: ' + (this.exportTanggagajiSebenar === '' ? 'All' : this.exportTanggagajiSebenar));
        }
        if (this.exportCawanganDaerah && this.exportCawanganDaerah !== 'no_filter') {
            filters.push('Cawangan Daerah: ' + (this.exportCawanganDaerah === '' ? 'All' : this.exportCawanganDaerah));
        }
        if (this.exportKelulusan && this.exportKelulusan !== 'no_filter') {
            filters.push('Kelulusan: ' + (this.exportKelulusan === '' ? 'All' : this.exportKelulusan));
        }
        if (this.exportJabatan && this.exportJabatan !== 'no_filter') {
            filters.push('Jabatan: ' + (this.exportJabatan === '' ? 'All' : this.exportJabatan));
        }
        if (this.exportStatus && this.exportStatus !== 'no_filter') {
            filters.push('Status: ' + (this.exportStatus === '' ? 'All' : this.exportStatus));
        }
        if (this.exportUmurMin) filters.push('Min Age: ' + this.exportUmurMin);
        if (this.exportUmurMax) filters.push('Max Age: ' + this.exportUmurMax);
        if (this.exportTarikhBersaraFrom) filters.push('Bersara From: ' + this.exportTarikhBersaraFrom);
        
        if (filters.length === 0) {
            return 'Export basic non-teaching staff data (No, Nama, No Kad Pintar, Kod SJ, No Telefon, Email only)';
        }
        
        return 'Export staff with ' + filters.join(', ');
    },
    
    // 🔹 Filtering
    get filteredDatas() {
        let data = this.datas;

        if (this.query !== '') {
            const searchTerms = this.query.toLowerCase().split(' ');
            data = data.filter(data => {
                return searchTerms.every(term => {
                    return (
                        String(data.nama).toLowerCase().includes(term) ||
                        String(data.noKadPintar).toLowerCase().includes(term) ||
                        String(data.kodSJ).toString().toLowerCase().includes(term) ||
                        String(data.noMobile).toLowerCase().includes(term) ||
                        String(data.emel).toLowerCase().includes(term)
                    );
                });
            });
        }

        // Sorting
        data = data.sort((a, b) => {
            if (this.sortOrder === 'asc') {
                return a[this.sortBy] > b[this.sortBy] ? 1 : -1;
            } else {
                return a[this.sortBy] < b[this.sortBy] ? 1 : -1;
            }
        });

        return data;
    },

    // 🔹 Pagination
    get paginatedData() {
        const start = (this.currentPage - 1) * this.itemsPerPage;
        const end = this.currentPage * this.itemsPerPage;
        return this.filteredDatas.slice(start, end);
    },

    get totalPages() {
        return Math.ceil(this.filteredDatas.length / this.itemsPerPage);
    },

    // 🔹 Sorting
    toggleSort(column) {
        if (this.sortBy === column) {
            this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            this.sortBy = column;
            this.sortOrder = 'asc';
        }
    },

    // 🔹 Page Navigation
    get pageRange() {
        const startPage = Math.max(1, this.currentPage - 2);
        const endPage = Math.min(this.totalPages, this.currentPage + 2);
        return Array.from({ length: endPage - startPage + 1 }, (_, index) => startPage + index);
    },

    goToPage(page) {
        if (page >= 1 && page <= this.totalPages) {
            this.currentPage = page;
        }
    }
}">

<!-- 🔹 Page Header -->
<div class="text-center mb-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-2">Non-Teaching</h1>
    <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full"></div>
</div>

<!-- 🔹 Export / Report Buttons -->
<div class="flex justify-end gap-2 mb-4">
    <a
        href="{{ route('pj.nonteaching.report') }}"
        class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">
        Dashboard Report
    </a>
    <button
        @click="openExportModal()"
        class="px-4 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700 transition">
        Export Excel
    </button>
</div>

<!-- 🔹 Export Modal -->
<div 
    x-show="showExportModal" 
    class="fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center pt-10 z-50 overflow-y-auto" 
    x-cloak>
    
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl my-8 mx-4">
        <h2 class="text-lg font-semibold mb-4">Export Options</h2>

        <div class="space-y-4">
         <!-- Jawatan -->
<div>
    <label class="block text-sm font-medium mb-1">Filter by Jawatan (optional):</label>
    <select x-model="exportJawatan" class="w-full border rounded-md px-3 py-2">
        <option value="no_filter">No Jawatan Filtered</option>
        <option value="">All Jawatan</option>
        @php
            // Deduplicate and standardize jawatan options
            $uniqueJawatan = collect($jawatanOptions)
                ->map(function($option) {
                    $val = trim(\Illuminate\Support\Str::after($option, 'Jawatan Sekarang:'));
                    $valLower = strtolower($val);

                    // Skip anything that looks like a date (dd-MMM-yy or dd/MM/yyyy)
                    if (preg_match('/^\d{2}[-\/][A-Za-z]{3}[-\/]\d{2,4}$/', $val) ||
                        preg_match('/^\d{2}[-\/]\d{2}[-\/]\d{2,4}$/', $val)) {
                        return null;
                    }

                    // Map keywords to standard categories
                    $mapping = [
                        'guru' => 'Guru',
                        'pegawai' => 'Pegawai',
                        'kerani' => 'Kerani',
                        'buruh' => 'Buruh',
                        'juru ukur bahan' => 'Juru Ukur Bahan',
                        'pembantu' => 'Pembantu',
                        'pengajar' => 'Pengajar',
                        'penolong' => 'Penolong',
                        'tukang kayu' => 'Tukang Kayu',
                        'tukang kebun' => 'Tukang Kebun',
                        'jurutera' => 'Jurutera',
                        'open vote' => 'Open Vote',
                        'operator telefon' => 'Operator Telefon',
                        'penjaga keselamatan' => 'Penjaga Keselamatan',
                        'sebulan ke sebulan' => 'Sebulan Ke Sebulan',
                        'pengawas' => 'Pengawas',
                        'pemandu' => 'Pemandu',
                        'pengarah' => 'Pengarah',
                        'pengetua' => 'Pengetua',
                        'penyelenggara' => 'Penyelenggara',
                        'timbalan pengetua' => 'Timbalan Pengetua',
                        'setiausaha' => 'Setiausaha',
                        'penyelia' => 'Penyelia',
                        'tukang masak' => 'Tukang Masak',
                        'ketua tukang masak' => 'Ketua Tukang Masak',
                    ];

                    foreach ($mapping as $keyword => $standard) {
                        if (str_contains($valLower, $keyword)) return $standard;
                    }

                    return ucwords($val); // fallback for unmapped text
                })
                ->filter()   // remove null/empty
                ->unique()   // remove duplicates
                ->sort();    // optional: alphabetical
        @endphp

        @foreach($uniqueJawatan as $option)
            <option value="{{ $option }}">{{ $option }}</option>
        @endforeach
    </select>
</div>

            <!-- Jantina -->
            <div>
                <label class="block text-sm font-medium mb-1">Filter by Jantina (optional):</label>
                <select x-model="exportJantina" class="w-full border rounded-md px-3 py-2">
                    <option value="no_filter">No Jantina Filtered</option>
                    <option value="">All Jantina</option>
                    <option value="LELAKI">Lelaki</option>
                    <option value="PEREMPUAN">Perempuan</option>
                </select>
            </div>

           <!-- Divisyen -->
<div>
    <label class="block text-sm font-medium mb-1">Filter by Divisyen (optional):</label>
    <select x-model="exportDivisyen" class="w-full border rounded-md px-3 py-2">
        <option value="no_filter">No Divisyen Filtered</option>
        <option value="">All Divisyen</option>
        @foreach(['I','II','III','IV','V'] as $option)
            <option value="{{ $option }}">{{ $option }}</option>
        @endforeach
    </select>
</div>

            <!-- Jenis Tanggagaji -->
            <div>
                <label class="block text-sm font-medium mb-1">Filter by Jenis Tanggagaji (optional):</label>
                <select x-model="exportJenisTanggagaji" class="w-full border rounded-md px-3 py-2">
                    <option value="no_filter">No Jenis Tanggagaji Filtered</option>
                    <option value="">All Jenis Tanggagaji</option>
                    @foreach($jenisTanggagajiOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggagaji Sebenar -->
            <div>
                <label class="block text-sm font-medium mb-1">Filter by Tanggagaji Sebenar (optional):</label>
                <select x-model="exportTanggagajiSebenar" class="w-full border rounded-md px-3 py-2">
                    <option value="no_filter">No Tanggagaji Sebenar Filtered</option>
                    <option value="">All Tanggagaji Sebenar</option>
                    @foreach($tanggagajiSebenarOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Umur Range -->
            <div>
                <label class="block text-sm font-medium mb-1">Filter by Umur Range (optional):</label>
                <div class="flex gap-2">
                    <input type="number" x-model="exportUmurMin" placeholder="Min Age" class="w-1/2 border rounded-md px-3 py-2">
                    <input type="number" x-model="exportUmurMax" placeholder="Max Age" class="w-1/2 border rounded-md px-3 py-2">
                </div>
            </div>

            <!-- Tarikh Bersara -->
<div>
    <label class="block text-sm font-medium mb-1">Filter by Tarikh Bersara (optional):</label>
    <input type="date" x-model="exportTarikhBersaraFrom" class="w-full border rounded-md px-3 py-2">
</div>

            <!-- Cawangan Daerah -->
            <div>
                <label class="block text-sm font-medium mb-1">Filter by Cawangan Daerah (optional):</label>
                <select x-model="exportCawanganDaerah" class="w-full border rounded-md px-3 py-2">
                    <option value="no_filter">No Cawangan Daerah Filtered</option>
                    <option value="">All Cawangan Daerah</option>
                    @foreach($daerahOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Kelulusan -->
            <div>
                <label class="block text-sm font-medium mb-1">Filter by Kelulusan (optional):</label>
                <select x-model="exportKelulusan" class="w-full border rounded-md px-3 py-2">
                    <option value="no_filter">No Kelulusan Filtered</option>
                    <option value="">All Kelulusan</option>
                    @foreach($kelulusanOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Jabatan -->
            <div>
                <label class="block text-sm font-medium mb-1">Filter by Jabatan (optional):</label>
                <select x-model="exportJabatan" class="w-full border rounded-md px-3 py-2">
                    <option value="no_filter">No Jabatan Filtered</option>
                    <option value="">All Jabatan</option>
                    @foreach($jabatanOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
<!-- Status -->
<div>
    <label class="block text-sm font-medium mb-1">Filter by Status (optional):</label>
    <select x-model="exportStatus" class="w-full border rounded-md px-3 py-2">
        <option value="no_filter">No Status Filtered</option>
        <option value="">All Status</option>
        <option value="Active">Active</option>
        <option value="Retired">Retired</option>
        <option value="Inactive">Inactive (Tatatertib)</option>
    </select>
</div>

        <!-- Export Info -->
<div class="mt-4 p-3 bg-blue-50 rounded-md">
    <p class="text-sm text-blue-800" x-text="exportSummary"></p>
</div>

        <!-- Buttons -->
        <div class="flex justify-end gap-2 mt-4">
            <button @click="closeExportModal()" 
                    class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">
                Cancel
            </button>
            <button @click="exportExcel()" 
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Export
            </button>
        </div>
    </div>
</div>

        {{-- Search and Pagination --}}
        <div class="flex items-center justify-center gap-4 w-full mb-6">

            <!-- Page Number Buttons -->
            <div class="flex gap-2 hidden">
                <template x-for="page in pageRange" :key="page">
                    <button 
                        :class="{'bg-rose-50 text-rose-500': currentPage === page, 'bg-gray-50 text-black': currentPage !== page}"
                        x-on:click="goToPage(page)"
                        class="px-4 py-2 rounded">
                        <span x-text="page"></span>
                    </button>
                </template>
            </div>

            {{-- Search --}}
            <div class="flex flex-col gap-4 text-center w-1/2">
                <div class="text-center">
                    <p class="text-xs text-gray-700">Cari Melalui</p>
                    <p class="text-sm text-gray-700">Nama, No Kad Pintar, Kod SJ, dan No Telefon</p>
                </div>
                <input type="text" x-model.debounce.300ms="query" placeholder="Cari" class="border border-gray-300 px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md bg-white shadow-sm">
            </div>

            {{-- Prev and Next --}}
            <div class="flex items-center gap-4 hidden">
                {{-- Prev --}}
                <button 
                :disabled="currentPage === 1 || filteredDatas.length === 0"
                :class="currentPage === 1 || filteredDatas.length === 0  ? 'text-gray-200' : 'hover:text-rose-500 duration-300' " 
                x-on:click="goToPage(currentPage - 1)" 
                class="px-4 py-2 rounded flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>    
                    <p>Prev</p>                  
                </button>

                {{-- Next --}}
                <button 
                :disabled="currentPage === totalPages || filteredDatas.length === 0" 
                :class="currentPage === totalPages || filteredDatas.length === 0 ? 'text-gray-200' : 'hover:text-rose-500 duration-300' " 
                x-on:click="goToPage(currentPage + 1)" 
                class="px-4 py-2 rounded flex items-center gap-2">
                    <p>Next</p>    
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>                                    
                </button>
            </div>

        </div>

        {{-- Pagination --}}
        <div class="flex place-self-end items-center justify-between gap-4 mb-5 w-full">

            <!-- Page Number Buttons -->
            <div class="flex gap-2">
                <template x-for="page in pageRange" :key="page">
                    <button 
                        :class="{'bg-blue-600 text-white': currentPage === page, 'bg-white text-gray-700 hover:bg-blue-50': currentPage !== page}"
                        x-on:click="goToPage(page)"
                        class="px-4 py-2 rounded shadow-sm transition">
                        <span x-text="page"></span>
                    </button>
                </template>
            </div>

            {{-- Prev and Next --}}
            <div class="flex items-center gap-4">
                {{-- Prev --}}
                <button 
                :disabled="currentPage === 1 || filteredDatas.length === 0" 
                :class="currentPage === 1 || filteredDatas.length === 0 ? 'text-gray-300 cursor-not-allowed' : 'text-blue-600 hover:text-blue-800 duration-300' " 
                x-on:click="goToPage(currentPage - 1)" 
                class="px-4 py-2 rounded flex items-center gap-2 bg-white shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>    
                    <p>Prev</p>                  
                </button>

                {{-- Next --}}
                <button 
                :disabled="currentPage === totalPages || filteredDatas.length === 0" 
                :class="currentPage === totalPages || filteredDatas.length === 0 ? 'text-gray-300 cursor-not-allowed' : 'text-blue-600 hover:text-blue-800 duration-300' " 
                x-on:click="goToPage(currentPage + 1)" 
                class="px-4 py-2 rounded flex items-center gap-2 bg-white shadow-sm">
                    <p>Next</p>    
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>                                    
                </button>
            </div>

        </div>

        {{-- List --}}
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="min-w-full border border-gray-300">

                <thead class="bg-blue-600 text-white">
                    <tr class="*:border *:border-blue-500 *:px-4 *:py-2 *:whitespace-nowrap *:font-semibold">
                        
                        <th @click="toggleSort('nama')">
                            <div class="flex items-center gap-2 cursor-pointer">
                                <p>Nama</p>
                            
                                <div 
                                x-show="sortBy === 'nama'" 
                                :class="sortOrder === 'desc' ? 'rotate-180':''" 
                                class="duration-300 text-xs font-thin">
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                    </svg>   

                                </div>     
                            </div>                     
                        </th>

                        <th @click="toggleSort('noKadPintar')">
                            <div class="flex items-center gap-2 cursor-pointer">
                                <p>No Kad Pintar</p>
                            
                                <div x-show="sortBy === 'noKadPintar'" :class="{'rotate-180': sortOrder === 'desc'}" class="duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                    </svg>    
                                </div>     
                            </div>            
                        </th>

                        <th @click="toggleSort('kodSJ')">
                            <div class="flex items-center gap-2 cursor-pointer">
                                <p>Kod SJ</p>
                            
                                <div x-show="sortBy === 'kodSJ'" :class="{'rotate-180': sortOrder === 'desc'}" class="duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                    </svg>    
                                </div>     
                            </div>          
                        </th>

                        <th @click="toggleSort('noMobile')">
                            <div class="flex items-center gap-2 cursor-pointer">
                                <p>No. Telefon</p>
                            
                                <div x-show="sortBy === 'noMobile'" :class="{'rotate-180': sortOrder === 'desc'}" class="duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                    </svg>    
                                </div>     
                            </div>      
                        </th>

                        <th @click="toggleSort('emel')">
                            <div class="flex items-center gap-2 cursor-pointer">
                                <p>E-Mel</p>
                            
                                <div x-show="sortBy === 'emel'" :class="{'rotate-180': sortOrder === 'desc'}" class="duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                    </svg>    
                                </div>     
                            </div>     
                        </th>

                        <th @click="toggleSort('umur')">
                            <div class="flex items-center gap-2 cursor-pointer">
                                <p>Status</p>
                            
                                <div x-show="sortBy === 'umur'" :class="{'rotate-180': sortOrder === 'desc'}" class="duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                    </svg>    
                                </div>     
                            </div>     
                        </th>
                        
                    </tr>
                </thead>

                <tbody class="bg-blue-50">

                    {{-- If search result found --}}
                    <template x-for="data in paginatedData" :key="data.id">
                        
                    <tr 
@click="
    console.log('Row clicked!');
    console.log('Data ID:', data.id);
    let url = '/pemegang-jawatan/show/' + data.id;
    console.log('Full URL:', url);
    window.location.href = url;
"
class="*:border *:border-gray-300 *:px-4 *:py-2 hover:bg-blue-100 cursor-pointer transition bg-blue-50">
                            {{-- Nama --}}
                            <td>
                                <template x-if="data.nama && data.nama.trim() !== ''">
                                    <p x-text="data.nama" class="capitalize"></p>
                                </template>
                                <template x-if="!data.nama || data.nama.trim() === ''">
                                    <p class="text-gray-300 uppercase">Empty</p>
                                </template>
                            </td>
                            {{-- No Kad Pintar --}}
                            <td>
                                <template x-if="data.noKadPintar && data.noKadPintar.trim() !== ''">
                                    <p x-text="data.noKadPintar" class=""></p>
                                </template>
                                <template x-if="!data.noKadPintar || data.noKadPintar.trim() === ''">
                                    <p class="text-gray-300 uppercase">Empty</p>
                                </template>
                            </td>
                            {{-- Kod SJ --}}
                            <td>
                                <template x-if="String(data.kodSJ).trim() !== ''">
                                    <p x-text="String(data.kodSJ)" class=""></p>
                                </template>
                                <template x-if="String(data.kodSJ).trim() === ''">
                                    <p class="text-gray-300 uppercase">Empty</p>
                                </template>
                            </td>
                            {{-- No Mobile --}}
                            <td>
                                <template x-if="data.noMobile && data.noMobile.trim() !== ''">
                                    <p x-text="data.noMobile" class=""></p>
                                </template>
                                <template x-if="!data.noMobile || data.noMobile.trim() === ''">
                                    <p class="text-gray-300 uppercase">Empty</p>
                                </template>
                            </td>
                            {{-- Emel --}}
                            <td>
                                <template x-if="data.emel && data.emel.trim() !== ''">
                                    <template x-for="email in data.emel.split(';')" :key="email.trim()">
                                        <p x-text="email.trim()" class=""></p>
                                    </template>
                                </template>
                                <template x-if="!data.emel || data.emel.trim() === ''">
                                    <p class="text-gray-300 uppercase">Empty</p>
                                </template>
                            </td>
                            {{-- Status --}}
<td>
    <div x-data="{ 
        getStatus() {
            const tatatertib = data.tatatertib;
            const tarikhBersara = data.tarikhBersara;
            const umur = data.umur;
            
            // Check if age data exists
            if (umur === null || umur === undefined) {
                return { text: 'Unknown', color: 'text-gray-300 uppercase' };
            }
            
            // Priority 1: Check tatatertib override first
            if (tatatertib == 1 && tarikhBersara) {
                const bersaraDate = new Date(tarikhBersara);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                bersaraDate.setHours(0, 0, 0, 0);
                
                if (bersaraDate <= today) {
                    return { 
                        text: 'Inactive (Tatatertib)', 
                        color: 'px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium' 
                    };
                }
            }
            
            // Priority 2: Check age-based retirement (YOUR ORIGINAL LOGIC)
            if (umur >= 60) {
                return { 
                    text: 'Retired', 
                    color: 'px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium' 
                };
            }
            
            // Default: Active (YOUR ORIGINAL LOGIC)
            return { 
                text: 'Active', 
                color: 'px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium' 
            };
        }
    }">
        <span :class="getStatus().color" x-text="getStatus().text"></span>
    </div>
</td>
                        </tr>

                    </template>

                    {{-- If no result found --}}
                    <template x-if="filteredDatas.length === 0">

                        <tr class="*:border *:border-gray-300 *:px-4 *:py-2">
                            <td colspan="6">
                                <div class="flex items-center justify-center">
                                    <p>No Result Found.</p>
                                </div>
                            </td>
                        </tr>

                    </template>
                    
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        <div class="flex place-self-end items-center justify-between gap-4 mt-5 w-full">

            <!-- Page Number Buttons -->
            <div class="flex gap-2">
                <template x-for="page in pageRange" :key="page">
                    <button 
                        :class="{'bg-blue-600 text-white': currentPage === page, 'bg-white text-gray-700 hover:bg-blue-50': currentPage !== page}"
                        x-on:click="goToPage(page)"
                        class="px-4 py-2 rounded shadow-sm transition">
                        <span x-text="page"></span>
                    </button>
                </template>
            </div>

            {{-- Prev and Next --}}
            <div class="flex items-center gap-4">
                {{-- Prev --}}
                <button 
                :disabled="currentPage === 1 || filteredDatas.length === 0" 
                :class="currentPage === 1 || filteredDatas.length === 0 ? 'text-gray-300 cursor-not-allowed' : 'text-blue-600 hover:text-blue-800 duration-300' " 
                x-on:click="goToPage(currentPage - 1)" 
                class="px-4 py-2 rounded flex items-center gap-2 bg-white shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>    
                    <p>Prev</p>                  
                </button>

                {{-- Next --}}
                <button 
                :disabled="currentPage === totalPages || filteredDatas.length === 0" 
                :class="currentPage === totalPages || filteredDatas.length === 0 ? 'text-gray-300 cursor-not-allowed' : 'text-blue-600 hover:text-blue-800 duration-300' " 
                x-on:click="goToPage(currentPage + 1)" 
                class="px-4 py-2 rounded flex items-center gap-2 bg-white shadow-sm">
                    <p>Next</p>    
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>                                    
                </button>
            </div>

        </div>

    </div>
    <p class="footer text-center text-gray-500 mt-10 mb-4 text-sm">
    Ministry Of Education @ {{ date('Y') }} All Rights Reserved. Powered by DevOps ICT.
</p>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data('exportModal', () => ({
            jabatanSelectInitialized: false,

            // Override your existing openExportModal
            openExportModal() {
                this.showExportModal = true;

                // Initialize Tom Select only once
                if (!this.jabatanSelectInitialized) {
                    new TomSelect("#jabatanSelect", {
                        allowEmptyOption: true,
                        create: false,
                        sortField: { field: "text", direction: "asc" }
                    });
                    this.jabatanSelectInitialized = true;
                }
            }
        }));
    });
</script>


@endsection