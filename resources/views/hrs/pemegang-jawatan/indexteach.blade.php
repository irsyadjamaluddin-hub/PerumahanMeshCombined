@extends('hrs.layouts.app-minimal')

@section('title', 'Teaching Staff List')

@push('styles')
<style>
    body {
        background: linear-gradient(to bottom right, #fef2f2, #fee2e2) !important;
        min-height: 100vh;
    }
</style>
@endpush

@section('content')

<div class="py-8 px-4" x-data="{
    query: '',
    datas: @js($teachers),
    itemsPerPage: 20,
    currentPage: 1,
    sortBy: 'Nama',
    sortOrder: 'asc',
    showExportModal: false,
    exportJawatan: 'no_filter',
    exportJantina: 'no_filter',
    exportTempatBertugas: 'no_filter',
    exportDaerah: 'no_filter',
    exportKelulusan: 'no_filter',
    exportStatus: 'no_filter',
    get filteredDatas() {
        let data = this.datas || [];

        if (this.query !== '') {
            const searchTerms = this.query.toLowerCase().split(' ');
            data = data.filter(item => {
                return searchTerms.every(term => {
                    return (
                        (item.Nama && String(item.Nama).toLowerCase().includes(term)) ||
                        (item.noKadPintar && String(item.noKadPintar).toLowerCase().includes(term)) ||
                        (item.noTelefon && String(item.noTelefon).toLowerCase().includes(term)) ||
                        (item.email && String(item.email).toLowerCase().includes(term))
                    );
                });
            });
        }

        return data.sort((a, b) => {
            const aVal = a[this.sortBy] || '';
            const bVal = b[this.sortBy] || '';
            
            if (this.sortOrder === 'asc') {
                return aVal > bVal ? 1 : -1;
            } else {
                return aVal < bVal ? 1 : -1;
            }
        });
    },
    
    get paginatedData() {
        const start = (this.currentPage - 1) * this.itemsPerPage;
        const end = this.currentPage * this.itemsPerPage;
        return this.filteredDatas.slice(start, end);
    },

    get totalPages() {
        return Math.ceil(this.filteredDatas.length / this.itemsPerPage);
    },
    
    get jawatanOptions() {
    const jawatans = [...new Set(this.datas.map(item => {
        if (item.jawatan) {
            const val = item.jawatan.trim().toLowerCase();
            if (val === 'gb' || val.includes('guru besar')) {
                return 'Guru Besar';
            }
            return item.jawatan.trim();
        }
        return null;
    }).filter(j => j))];
    return jawatans.sort();
},

    
    get jantinaOptions() {
        return ['Lelaki', 'Perempuan'];
    },
    
    get tempatBertugasOptions() {
        const tempat = [...new Set(this.datas.map(item => item.tempatBertugas).filter(t => t && t.trim() !== ''))];
        return tempat.sort();
    },
    
    get daerahOptions() {
        // ✅ ONLY CHANGE: Standardized to 4 districts for export filtering
        return ['Brunei Muara', 'Tutong', 'Kuala Belait', 'Temburong'];
    },
    
    get kelulusanOptions() {
        // ✅ Standardized kelulusan categories (matches non-teaching side)
        return ['PhD', 'PGCE', 'Master', 'Degree', 'Higher Diploma', 'BTEC', 'Diploma', 'ND', 'Certificate', 'O Level', 'A Level'];
    },
    get statusOptions() {
    return ['Active', 'Retired', 'Inactive'];
    },
    toggleSort(column) {
        if (this.sortBy === column) {
            this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            this.sortBy = column;
            this.sortOrder = 'asc';
        }
    },

    get pageRange() {
        const startPage = Math.max(1, this.currentPage - 2);
        const endPage = Math.min(this.totalPages, this.currentPage + 2);
        return Array.from({ length: endPage - startPage + 1 }, (_, index) => startPage + index);
    },

    goToPage(page) {
        if (page >= 1 && page <= this.totalPages) {
            this.currentPage = page;
        }
    },
    
    openExportModal() {
        this.showExportModal = true;
    },
    
    closeExportModal() {
        this.showExportModal = false;
        this.exportJawatan = 'no_filter';
        this.exportJantina = 'no_filter';
        this.exportTempatBertugas = 'no_filter';
        this.exportDaerah = 'no_filter';
        this.exportKelulusan = 'no_filter';
        this.exportStatus = 'no_filter';
    },
    
    // Add this TEMPORARILY to your blade file's exportExcel() function
// Add it right before the window.location.href line

exportExcel() {
    let exportUrl = '{{ route("pj.teachers.export") }}';
    let params = new URLSearchParams();
    
    // Fix: Check !== 'no_filter' only, not &&
    if (this.exportJawatan !== 'no_filter') {
        params.append('jawatan', this.exportJawatan === '' ? 'all' : this.exportJawatan);
    }
    
    if (this.exportJantina !== 'no_filter') {
        params.append('jantina', this.exportJantina === '' ? 'all' : this.exportJantina);
    }
    
    if (this.exportTempatBertugas !== 'no_filter') {
        params.append('tempat_bertugas', this.exportTempatBertugas === '' ? 'all' : this.exportTempatBertugas);
    }
    
    if (this.exportDaerah !== 'no_filter') {
        params.append('daerah', this.exportDaerah === '' ? 'all' : this.exportDaerah);
    }
    
    if (this.exportKelulusan !== 'no_filter') {
        params.append('kelulusan', this.exportKelulusan === '' ? 'all' : this.exportKelulusan);
    }
    
    if (this.exportStatus !== 'no_filter') {
        params.append('status', this.exportStatus === '' ? 'all' : this.exportStatus);
    }
    
    if (params.toString()) {
        exportUrl += '?' + params.toString();
    }
    
    
    
    window.location.href = exportUrl;
    this.closeExportModal();
},
    
    get exportSummary() {
    let filters = [];
    if (this.exportJawatan && this.exportJawatan !== 'no_filter') {
        filters.push('Jawatan: ' + (this.exportJawatan === '' ? 'All' : this.exportJawatan));
    }
    if (this.exportJantina && this.exportJantina !== 'no_filter') {
        filters.push('Jantina: ' + (this.exportJantina === '' ? 'All' : this.exportJantina));
    }
    if (this.exportTempatBertugas && this.exportTempatBertugas !== 'no_filter') {
        filters.push('Tempat Bertugas: ' + (this.exportTempatBertugas === '' ? 'All' : this.exportTempatBertugas));
    }
    if (this.exportDaerah && this.exportDaerah !== 'no_filter') {
        filters.push('Daerah: ' + (this.exportDaerah === '' ? 'All' : this.exportDaerah));
    }
    if (this.exportKelulusan && this.exportKelulusan !== 'no_filter') {
        filters.push('Kelulusan: ' + (this.exportKelulusan === '' ? 'All' : this.exportKelulusan));
    }
    if (this.exportStatus && this.exportStatus !== 'no_filter') {
        filters.push('Status: ' + (this.exportStatus === '' ? 'All' : this.exportStatus));
    }
    if (filters.length === 0) {
        return 'Export basic teaching staff data (No, Nama, No Kad Pintar, No Telefon, Email only)';
    }
    
    return 'Export staff with ' + filters.join(', ');
    }
}">
{{-- Header with Export Button --}}
<div class="text-center mb-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-2">Teaching</h1>
    <div class="w-24 h-1 bg-red-600 mx-auto rounded-full"></div>
</div>

{{-- Dashboard Report / Export Excel Buttons --}}
<div class="flex justify-end gap-2 mb-4">
    <a
        href="{{ route('pj.teaching.report') }}"
        class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">
        Dashboard Report
    </a>
    <button
        @click="openExportModal()"
        class="px-4 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700 transition">
        Export Excel
    </button>
</div>


    {{-- Search and Top Page Numbers --}}
<div class="flex items-center justify-center gap-4 w-full mb-6">



    {{-- Search --}}
    <div class="flex flex-col gap-4 text-center w-1/2">
        <div class="text-center">
            <p class="text-xs text-gray-700">Cari Melalui</p>
            <p class="text-sm text-gray-700">Nama, No Kad Pintar, Kod SJ, dan No Telefon</p>
        </div>
        <input type="text" x-model.debounce.300ms="query" placeholder="Cari" class="border border-gray-300 px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-red-500 rounded-md bg-white shadow-sm">
    </div>

</div>

{{-- Pagination (Bottom with Prev and Next) --}}
<div class="flex place-self-end items-center justify-between gap-4 mb-5 w-full">

    <!-- Page Number Buttons -->
    <div class="flex gap-2">
        <template x-for="page in pageRange" :key="page">
            <button 
                :class="{'bg-red-600 text-white': currentPage === page, 'bg-white text-gray-700 hover:bg-red-50': currentPage !== page}"
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
            :class="currentPage === 1 || filteredDatas.length === 0 ? 'text-gray-300 cursor-not-allowed' : 'text-red-600 hover:text-red-800 duration-300'" 
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
            :class="currentPage === totalPages || filteredDatas.length === 0 ? 'text-gray-300 cursor-not-allowed' : 'text-red-600 hover:text-red-800 duration-300'" 
            x-on:click="goToPage(currentPage + 1)" 
            class="px-4 py-2 rounded flex items-center gap-2 bg-white shadow-sm">
            <p>Next</p>    
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>                                    
        </button>
    </div>

</div>

    {{-- Export Modal --}}
    <div x-show="showExportModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-start justify-center pt-10" 
         style="display: none;">
        
        <div class="relative mx-auto p-6 border w-96 max-w-md shadow-lg rounded-md bg-white mb-10">
            <div class="mt-3">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Export Excel Options</h3>
                
                {{-- Filter by Jawatan --}}
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Jawatan (Optional):</label>
    <select x-model="exportJawatan" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
        <option value="no_filter">No Jawatan Filtered</option>
        <option value="">All Jawatan</option>
        <template x-for="jawatan in jawatanOptions" :key="jawatan">
            <option :value="jawatan" x-text="jawatan"></option>
        </template>
    </select>
</div>

{{-- Filter by Jantina --}}
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Jantina (Optional):</label>
    <select x-model="exportJantina" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
        <option value="no_filter">No Jantina Filtered</option>
        <option value="">All Jantina</option>
        <template x-for="jantina in jantinaOptions" :key="jantina">
            <option :value="jantina" x-text="jantina"></option>
        </template>
    </select>
</div>

{{-- Filter by Tempat Bertugas --}}
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Tempat Bertugas (Optional):</label>
    <select x-model="exportTempatBertugas" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
        <option value="no_filter">No Tempat Bertugas Filtered</option>
        <option value="">All Tempat Bertugas</option>
        <template x-for="tempat in tempatBertugasOptions" :key="tempat">
            <option :value="tempat" x-text="tempat"></option>
        </template>
    </select>
</div>

{{-- Filter by Daerah --}}
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Daerah (Optional):</label>
    <select x-model="exportDaerah" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
        <option value="no_filter">No Daerah Filtered</option>
        <option value="">All Daerah</option>
        <template x-for="daerah in daerahOptions" :key="daerah">
            <option :value="daerah" x-text="daerah"></option>
        </template>
    </select>
</div>

{{-- Filter by Kelulusan --}}
<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Kelulusan (Optional):</label>
    <select x-model="exportKelulusan" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
        <option value="no_filter">No Kelulusan Filtered</option>
        <option value="">All Kelulusan</option>
        <template x-for="kelulusan in kelulusanOptions" :key="kelulusan">
            <option :value="kelulusan" x-text="kelulusan"></option>
        </template>
    </select>
</div>

<!-- Status -->
<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Status (Optional):</label>
    <select x-model="exportStatus" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
        <option value="no_filter">No Status Filtered</option>
        <option value="">All Status</option>
        <option value="Active">Active</option>
        <option value="Retired">Retired</option>
        <option value="Inactive">Inactive (Tatatertib)</option>
    </select>
</div>
                {{-- Export Info --}}
                <div class="mb-6 p-3 bg-red-50 rounded-md">
                    <p class="text-sm text-red-800" x-text="exportSummary"></p>
                </div>
                
                {{-- Modal Buttons --}}
                <div class="flex items-center gap-3 justify-end">
                    <button @click="closeExportModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-300">
                        Cancel
                    </button>
                    <button @click="exportExcel()" 
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-300 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Export
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- List --}}
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <table class="min-w-full border border-gray-300">

            <thead class="bg-red-600 text-white">
                <tr class="*:border *:border-red-500 *:px-4 *:py-2 *:whitespace-nowrap *:font-semibold">
                    
                    <th @click="toggleSort('Nama')">
                        <div class="flex items-center gap-2 cursor-pointer">
                            <p>Nama</p>
                        
                            <div 
                            x-show="sortBy === 'Nama'" 
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

                    <th @click="toggleSort('noTelefon')">
                        <div class="flex items-center gap-2 cursor-pointer">
                            <p>No. Telefon</p>
                        
                            <div x-show="sortBy === 'noTelefon'" :class="{'rotate-180': sortOrder === 'desc'}" class="duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                </svg>    
                            </div>     
                        </div>      
                    </th>

                    <th @click="toggleSort('email')">
                        <div class="flex items-center gap-2 cursor-pointer">
                            <p>E-Mel</p>
                        
                            <div x-show="sortBy === 'email'" :class="{'rotate-180': sortOrder === 'desc'}" class="duration-300">
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

            <tbody class="bg-red-50">

                {{-- If search result found --}}
                <template x-for="(data, index) in paginatedData" :key="index">
                    
                    <tr class="*:border *:border-gray-300 *:px-4 *:py-2 hover:bg-red-100 cursor-pointer transition bg-red-50">
                        {{-- Nama --}}
                        <td @click="window.location.href = '{{ url('/pemegang-jawatan/teaching/showTeaching') }}/' + data.noKadPintar">
                            <template x-if="data.Nama && data.Nama.trim() !== ''">
                                <p x-text="data.Nama" class="capitalize"></p>
                            </template>
                            <template x-if="!data.Nama || data.Nama.trim() === ''">
                                <p class="text-gray-300 uppercase">Empty</p>
                            </template>
                        </td>
                        {{-- No Kad Pintar --}}
                        <td @click="window.location.href = '{{ url('/pemegang-jawatan/teaching/showTeaching') }}/' + data.noKadPintar">
                            <template x-if="data.noKadPintar && data.noKadPintar.trim() !== ''">
                                <p x-text="data.noKadPintar" class=""></p>
                            </template>
                            <template x-if="!data.noKadPintar || data.noKadPintar.trim() === ''">
                                <p class="text-gray-300 uppercase">Empty</p>
                            </template>
                        </td>
                        {{-- No Telefon --}}
                        <td @click="window.location.href = '{{ url('/pemegang-jawatan/teaching/showTeaching') }}/' + data.noKadPintar">
                            <template x-if="data.noTelefon && data.noTelefon.trim() !== ''">
                                <p x-text="data.noTelefon" class=""></p>
                            </template>
                            <template x-if="!data.noTelefon || data.noTelefon.trim() === ''">
                                <p class="text-gray-300 uppercase">Empty</p>
                            </template>
                        </td>
                        {{-- Email --}}
                        <td @click="window.location.href = '{{ url('/pemegang-jawatan/teaching/showTeaching') }}/' + data.noKadPintar">
                            <template x-if="data.email && data.email.trim() !== ''">
                                <template x-for="email in data.email.split(';')" :key="email.trim()">
                                    <p x-text="email.trim()" class=""></p>
                                </template>
                            </template>
                            <template x-if="!data.email || data.email.trim() === ''">
                                <p class="text-gray-300 uppercase">Empty</p>
                            </template>
                        </td>
                       {{-- Status --}}
<td @click="window.location.href = '{{ url('/pemegang-jawatan/teaching/showTeaching') }}/' + data.noKadPintar">
    <div x-data="{ 
        getStatus() {
            // Get tatatertib value (might be 'tatatertib' or stored differently)
            const tatatertib = data.tatatertib;
            const overrideDate = data.tarikhBersaraOverride;
            const umur = data.umur;
            
            // Debug log
            console.log('Status check for:', {
                nama: data.Nama,
                tatatertib: tatatertib,
                tarikhBersaraOverride: overrideDate,
                umur: umur
            });
            
            // Check if age data exists
            if (umur === null || umur === undefined) {
                return { text: 'Unknown', color: 'text-gray-300 uppercase' };
            }
            
            // Priority 1: Check tatatertib override first
            if (tatatertib == 1 && overrideDate) {
                const override = new Date(overrideDate);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                override.setHours(0, 0, 0, 0);
                
                console.log('Tatatertib date check:', {
                    override: override.toISOString(),
                    today: today.toISOString(),
                    isInactive: override <= today
                });
                
                if (override <= today) {
                    return { 
                        text: 'Inactive (tatatertib)', 
                        color: 'px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium' 
                    };
                }
            }
            
            // Priority 2: Check age-based retirement
            if (umur >= 60) {
                return { 
                    text: 'Retired', 
                    color: 'px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium' 
                };
            }
            
            // Default: Active
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
                
            </tbody>

        </table>
    </div>

    {{-- Pagination (Bottom) --}}
    <div class="flex place-self-end items-center justify-between gap-4 mt-5 w-full">

        <!-- Page Number Buttons -->
        <div class="flex gap-2">
            <template x-for="page in pageRange" :key="page">
                <button 
                    :class="{'bg-red-600 text-white': currentPage === page, 'bg-white text-gray-700 hover:bg-red-50': currentPage !== page}"
                    @click="goToPage(page)"
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
            :class="currentPage === 1 || filteredDatas.length === 0 ? 'text-gray-300 cursor-not-allowed' : 'text-red-600 hover:text-red-800 duration-300' " 
            @click="goToPage(currentPage - 1)" 
            class="px-4 py-2 rounded flex items-center gap-2 bg-white shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>    
                <p>Prev</p>                  
            </button>

            {{-- Next --}}
            <button 
            :disabled="currentPage === totalPages || filteredDatas.length === 0" 
            :class="currentPage === totalPages || filteredDatas.length === 0 ? 'text-gray-300 cursor-not-allowed' : 'text-red-600 hover:text-red-800 duration-300' " 
            @click="goToPage(currentPage + 1)" 
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

@endsection