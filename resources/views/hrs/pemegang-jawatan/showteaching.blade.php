@extends('hrs.layouts.app-minimal')

@section('title') Teaching Staff Profile - {{ $teacher->Nama }} @endsection

@section('content')

<style>
body {
    background-color: #fff8f8ff !important; /* Tailwind blue-50 */
    min-height: 100vh;
}

/* Professional tab content styling */
.tab-content-wrapper {
    background-color: white;
    border-radius: 0.75rem;
    box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
    margin-top: 1.5rem;
    padding: 2rem;
    min-height: 400px;
}

/* Enhanced tab styling */
.tab-item {
    position: relative;
    transition: all 0.3s ease;
}

.tab-item::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(to right, #e11d48, #fb7185);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.tab-item.active::after {
    transform: scaleX(1);
}

/* Smooth scrolling for tab content */
.tab-content-wrapper {
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>


@if ($errors->any())
    <p>There is an error</p>
@endif

{{-- Success Message --}}
@if(session('success'))
<div style="margin: 1.5rem 0 0.5rem 0; width: 100%;">
    <div style="
        display: flex; 
        align-items: center; 
        gap: 0.75rem; 
        background: linear-gradient(to right, #d1fae5, #a7f3d0); 
        border: 1px solid #34d399; 
        color: #065f46; 
        padding: 0.75rem 1rem; 
        border-radius: 0.5rem; 
        width: 100%; 
        box-shadow: 0 4px 12px rgba(0,0,0,0.1), 0 0 8px rgba(34,197,94,0.3); 
        font-family: sans-serif;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    " 
    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(0,0,0,0.15), 0 0 12px rgba(34,197,94,0.35)';" 
    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1), 0 0 8px rgba(34,197,94,0.3)';">
        <svg style="width: 1.25rem; height: 1.25rem; flex-shrink: 0; stroke: #065f46;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span style="font-size: 0.95rem; font-weight: 600;">{{ session('success') }}</span>
        <button onclick="this.parentElement.parentElement.remove()" style="margin-left:auto; font-weight:bold; color:#065f46; background:none; border:none; cursor:pointer; font-size: 1.1rem;">&times;</button>
    </div>
</div>
@endif

{{-- Failure Message --}}
@if(session('failure'))
<div style="margin: 1.5rem 0 0.5rem 0; width: 100%;">
    <div style="
        display: flex; 
        align-items: center; 
        gap: 0.75rem; 
        background: linear-gradient(to right, #fee2e2, #fecaca); 
        border: 1px solid #f87171; 
        color: #991b1b; 
        padding: 0.75rem 1rem; 
        border-radius: 0.5rem; 
        width: 100%; 
        box-shadow: 0 4px 12px rgba(0,0,0,0.1), 0 0 8px rgba(239,68,68,0.3); 
        font-family: sans-serif;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    " 
    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(0,0,0,0.15), 0 0 12px rgba(239,68,68,0.35)';" 
    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1), 0 0 8px rgba(239,68,68,0.3)';">
        <svg style="width: 1.25rem; height: 1.25rem; flex-shrink: 0; stroke: #991b1b;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <span style="font-size: 0.95rem; font-weight: 600;">{{ session('failure') }}</span>
        <button onclick="this.parentElement.parentElement.remove()" style="margin-left:auto; font-weight:bold; color:#991b1b; background:none; border:none; cursor:pointer; font-size: 1.1rem;">&times;</button>
    </div>
</div>
@endif

</form>
        </div>
</div>

<div x-data="{ activeTab: 1, showFullProfile: false }">

{{-- Name, IC, and Kod Jawatan Display with Toggle Button --}}
<div class="mb-4 bg-white p-6 rounded-2xl shadow">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
        <div>
            <p class="text-xs text-gray-500 mb-1">Nama</p>
            <p class="text-xl font-bold text-gray-800">{{ $teacher->Nama ?? 'N/A' }}</p>
        </div>
        <div>
            <p class="text-xs text-gray-500 mb-1">No Kad Pintar</p>
            <p class="text-lg font-semibold text-gray-700 uppercase">{{ $teacher->{'No Kad Pintar'} ?? 'N/A' }}</p>
        </div>
        <div class="flex flex-col md:flex-row md:items-end gap-3">
            <div class="flex-grow">
                <p class="text-xs text-gray-500 mb-1">Kod Jawatan</p>
                <p class="text-lg font-semibold text-gray-700">{{ $teacher->{'Kod Tempat Bertugas'} ?? 'N/A' }}</p>
            </div>
            <button type="button" 
                    @click="showFullProfile = !showFullProfile"
                    class="px-3 py-2 bg-gradient-to-r from-rose-600 to-rose-400 text-white rounded-lg shadow-md flex items-center gap-2 hover:scale-105 transition duration-300 whitespace-nowrap text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                <span x-text="showFullProfile ? 'Hide' : 'Show'" class="hidden sm:inline"></span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 transition-transform duration-300" :class="showFullProfile ? 'rotate-180' : ''">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
        </div>
    </div>
</div>

   {{-- Short Info (Hidden by default) --}}
<div x-show="showFullProfile" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform -translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform -translate-y-4"
     x-cloak>
        
        <div class="relative flex flex-col gap-5 bg-white p-5 rounded-2xl shadow">
            <form action="{{ route('pj.saveProfile', $teacher->{'No Kad Pintar'}) }}" method="POST">
                @csrf
                @method('PUT')

            {{-- Save Button (Top Right) --}}
            <button type="submit"
                class="absolute top-1 right-4 bg-gradient-to-r from-rose-600 to-rose-300 text-white text-sm px-4 py-2 rounded-lg shadow-md flex items-center gap-1 hover:scale-105 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <span>Save Profile</span>
            </button>

            {{-- Basic Info --}}
            <div>
                <label class="text-xs">Nama</label>
                <input type="text" name="Nama" 
                       value="{{ $teacher->Nama ?? '' }}"
                       class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>

            <div class="flex flex-wrap gap-6">
                <div>
                    <label class="text-xs">No Kad Pintar</label>
                    <input type="text" name="NoKadPintar" 
                           value="{{ $teacher->{'No Kad Pintar'} ?? '' }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm uppercase" readonly>
                </div>

                <div>
                    <label class="text-xs">Kod Tempat Bertugas</label>
                    <input type="text" name="KodTempatBertugas" 
                           value="{{ $teacher->{'Kod Tempat Bertugas'} ?? '' }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>
            </div>

            {{-- Jantina --}}
            <div class="flex flex-col gap-2" x-data="{ dropDown: false, selected: '{{ $teacher->Jantina ?? '' }}' }">
                <p class="text-sm">Jantina</p>
                <div @click="dropDown = !dropDown" class="border rounded-md cursor-pointer relative">
                    <p class="px-4 py-2" x-text="selected || 'Pilih'"></p>
                    <div x-show="dropDown" @click.away="dropDown = false" class="absolute bg-white w-full border mt-1 z-10">
                        <div class="px-4 py-2 hover:bg-gray-100" @click="selected='Lelaki'; dropDown=false">Lelaki</div>
                        <div class="px-4 py-2 hover:bg-gray-100" @click="selected='Perempuan'; dropDown=false">Perempuan</div>
                    </div>
                    <input type="hidden" name="Jantina" :value="selected">
                </div>
                @error('Jantina') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Extended Info --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">

                <div>
                    <label class="text-xs">Tangga Gaji Sebenar</label>
                    <input type="text" name="TanggaGajiSebenar" 
                           value="{{ $teacher->{'Tanggagaji Sebenar'} ?? '' }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>

                {{-- Tarikh Lahir (from database: 9/16/1972 format) --}}
                <div class="flex flex-col gap-2">
                    <label class="text-xs">Tarikh Lahir</label>
                    @php
                        $tarikhLahirValue = '';
                        if (!empty($teacher->{'Tarikh Lahir'})) {
                            try {
                                // Parse date in M/d/Y format (9/16/1972)
                                $tarikhLahirValue = \Carbon\Carbon::parse($teacher->{'Tarikh Lahir'})->format('Y-m-d');
                            } catch (\Exception $e) {
                                \Log::warning('Could not parse Tarikh Lahir: ' . $teacher->{'Tarikh Lahir'});
                                $tarikhLahirValue = '';
                            }
                        }
                    @endphp
                    <input type="date" name="TarikhLahir"
                        value="{{ $tarikhLahirValue }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm">
                    
                    @if(!empty($teacher->{'Tarikh Lahir'}))
                        <p class="text-xs text-gray-400">DB: {{ $teacher->{'Tarikh Lahir'} }}</p>
                    @endif
                </div>


                {{-- Umur --}}
                @php
                    try {
                        $age = $teacher->{'Tarikh Lahir'} ? \Carbon\Carbon::parse($teacher->{'Tarikh Lahir'})->diff(\Carbon\Carbon::now()) : null;
                    } catch (\Exception $e) {
                        $age = null;
                    }
                @endphp
                <div class="flex flex-col gap-2">
                    <p class="text-sm">Umur</p>
                    <input type="text" disabled 
                           value="{{ $age ? $age->y . ' Tahun ' . $age->m . ' Bulan' : '' }}"
                           class="border px-4 py-2 rounded-md w-full text-gray-500">
                </div>

                {{-- Tarikh Tamat Kontrak / Berhenti --}}
<div>
    <label class="text-xs">Tarikh Tamat Kontrak / Berhenti</label>
    
    @php
        $tarikhTamatKontrakValue = '';
        
        if (!empty($teacher->{'Tarikh Tamat Kontrak'})) {
            try {
                // Try to parse the date - Carbon should handle d-M-y format
                $parsedDate = \Carbon\Carbon::parse($teacher->{'Tarikh Tamat Kontrak'});
                
                // If the parsed year is in the past (< 2000), it probably means 2-digit year was misinterpreted
                // Example: "08-Nov-25" might be parsed as 1925 instead of 2025
                if ($parsedDate->year < 2000) {
                    // Add 100 years to correct it
                    $parsedDate->addYears(100);
                }
                
                $tarikhTamatKontrakValue = $parsedDate->format('Y-m-d');
                
            } catch (\Exception $e) {
                \Log::warning('Could not parse Tarikh Tamat Kontrak: ' . $teacher->{'Tarikh Tamat Kontrak'});
                
                // Fallback: Try to calculate from birthday
                if (!empty($teacher->{'Tarikh Lahir'})) {
                    try {
                        $tarikhTamatKontrakValue = \Carbon\Carbon::parse($teacher->{'Tarikh Lahir'})->addYears(60)->format('Y-m-d');
                    } catch (\Exception $e2) {
                        $tarikhTamatKontrakValue = '';
                    }
                }
            }
        } elseif (!empty($teacher->{'Tarikh Lahir'})) {
            // Auto-calculate from birthday if no Tarikh Tamat Kontrak exists
            try {
                $tarikhTamatKontrakValue = \Carbon\Carbon::parse($teacher->{'Tarikh Lahir'})->addYears(60)->format('Y-m-d');
            } catch (\Exception $e) {
                $tarikhTamatKontrakValue = '';
            }
        }
    @endphp
    
    <div class="flex gap-2 items-center">
        <input type="date" 
               name="TarikhTamatKontrak"
               value="{{ $tarikhTamatKontrakValue }}"
               class="w-full border rounded-lg px-3 py-2 text-sm"
               title="Calculated: Birthday + 60 years (editable)">
        
        <button type="button" 
                onclick="recalculateRetirement()"
                class="px-3 py-2 bg-blue-500 text-white rounded-lg text-xs hover:bg-blue-600 whitespace-nowrap flex-shrink-0"
                title="Recalculate from birthday">
            🔄 Auto
        </button>
    </div>
    
    
    
    <p class="text-xs text-gray-500 mt-1">
        💡 Auto: Hari Lahir + 60 tahun | Anda boleh mengedit tarikh ini secara manual
    </p>
</div>

                {{-- Tarikh Mula Berkhidmat --}}
<div>
    <label class="text-xs">Tarikh Mula Berkhidmat</label>
    @php
        $tarikhMulaBerkhidmatValue = '';
        if (!empty($teacher->{'Tarikh Mula Berkhidmat'})) {
            try {
                $tarikhMulaBerkhidmatValue = \Carbon\Carbon::parse($teacher->{'Tarikh Mula Berkhidmat'})->format('Y-m-d');
            } catch (\Exception $e) {
                $tarikhMulaBerkhidmatValue = '';
            }
        }
    @endphp
    <input type="date" name="TarikhMulaBerkhidmat"
           value="{{ $tarikhMulaBerkhidmatValue }}"
           class="w-full border rounded-lg px-3 py-2 text-sm">
</div>

{{-- Tarikh Jawatan Sekarang --}}
<div>
    <label class="text-xs">Tarikh Jawatan Sekarang</label>
    @php
        $tarikhJawatanSekarangValue = '';
        if (!empty($teacher->{'Tarikh Jawatan Sekarang'})) {
            try {
                $tarikhJawatanSekarangValue = \Carbon\Carbon::parse($teacher->{'Tarikh Jawatan Sekarang'})->format('Y-m-d');
            } catch (\Exception $e) {
                $tarikhJawatanSekarangValue = '';
            }
        }
    @endphp
    <input type="date" name="TarikhJawatanSekarang"
           value="{{ $tarikhJawatanSekarangValue }}"
           class="w-full border rounded-lg px-3 py-2 text-sm">
</div>

{{-- Tarikh Diatur Bertugas Sekarang --}}
{{-- Tarikh Diatur Bertugas Sekarang (from database: 11/15/2010 format) --}}
<div>
    <label class="text-xs">Tarikh Diatur Bertugas Sekarang</label>
    @php
        $tarikhDiaturBertugasSekarangValue = '';
        if (!empty($teacher->{'Tarikh diatur bertugas sekarang'})) {
            try {
                // Parse date in M/d/Y format (11/15/2010)
                $tarikhDiaturBertugasSekarangValue = \Carbon\Carbon::parse($teacher->{'Tarikh diatur bertugas sekarang'})->format('Y-m-d');
            } catch (\Exception $e) {
                \Log::warning('Could not parse Tarikh diatur bertugas sekarang: ' . $teacher->{'Tarikh diatur bertugas sekarang'});
                $tarikhDiaturBertugasSekarangValue = '';
            }
        }
    @endphp
    <input type="date" name="TarikhDiaturBertugasSekarang"
           value="{{ $tarikhDiaturBertugasSekarangValue }}"
           class="w-full border rounded-lg px-3 py-2 text-sm">
    
    @if(!empty($teacher->{'Tarikh diatur bertugas sekarang'}))
        <p class="text-xs text-gray-400">DB: {{ $teacher->{'Tarikh diatur bertugas sekarang'} }}</p>
    @endif
</div>

{{-- Tarikh Gaji Bulan --}}
<div>
    <label class="text-xs">Tarikh Gaji Bulan</label>
    @php
        $tarikhGajiBulanValue = '';
        if (!empty($teacher->{'Tarikh Gaji Bulan'})) {
            try {
                $tarikhGajiBulanValue = \Carbon\Carbon::parse($teacher->{'Tarikh Gaji Bulan'})->format('Y-m-d');
            } catch (\Exception $e) {
                $tarikhGajiBulanValue = '';
            }
        }
    @endphp
    <input type="date" name="TarikhGajiBulan"
           value="{{ $tarikhGajiBulanValue }}"
           class="w-full border rounded-lg px-3 py-2 text-sm">
</div>

{{-- Tarikh Penetapan --}}
<div>
    <label class="text-xs">Tarikh Penetapan</label>
    @php
        $tarikhPenetapanValue = '';
        if (!empty($teacher->{'tarikhpenetapan'})) {
            try {
                $tarikhPenetapanValue = \Carbon\Carbon::parse($teacher->{'tarikhpenetapan'})->format('Y-m-d');
            } catch (\Exception $e) {
                $tarikhPenetapanValue = '';
            }
        }
    @endphp
    <input type="date" name="TarikhPenetapan"
           value="{{ $tarikhPenetapanValue }}"
           class="w-full border rounded-lg px-3 py-2 text-sm">
</div>

{{-- Tarikh Kenaikan --}}
{{-- Tarikh Kenaikan (from database: 01 MAC format) - Display as text only --}}
<div>
    <label class="text-xs">Tarikh Kenaikan</label>
    <input type="text" 
           name="TarikhKenaikan"
           value="{{ $teacher->{'TarikhKenaikan'} ?? '' }}"
           placeholder="e.g., 01 MAC"
           class="w-full border rounded-lg px-3 py-2 text-sm">
    <!-- <p class="text-xs text-gray-500 mt-1">Format: DD MMM (e.g., 01 MAC, 15 JUN)</p> -->
</div>
</div>
    

</form>
        </div>
</div>


    {{-- Tabs --}}
<div class="mt-10">
    <div class="overflow-x-auto select-none whitespace-nowrap hidden-scrollbar" 
         x-data="{ isDragging: false, startX: 0, scrollLeft: 0 }" 
         x-on:mousedown="isDragging = true; startX = $event.pageX; scrollLeft = $el.scrollLeft"
         x-on:mousemove="if(isDragging) { $el.scrollLeft = scrollLeft - ($event.pageX - startX) }"
         x-on:mouseup="isDragging = false"
         x-on:mouseleave="isDragging = false">

        <div class="flex items-center text-gray-400 cursor-pointer">

           @php
    $tabs = [
        1 => ['label' => 'Peribadi', 'icon' => 'M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z'],
        2 => ['label' => 'Prestasi', 'icon' => 'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z'],
        3 => ['label' => 'TPA', 'icon' => 'M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z'],
        4 => ['label' => 'Kenaikan Gaji', 'icon' => 'M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'],
        5 => ['label' => 'Cuti', 'icon' => 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5'],
        6 => ['label' => 'Penyambungan', 'icon' => 'M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z'],
        7 => ['label' => 'Penempatan Bertugas', 'icon' => 'M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75'],
        8 => ['label' => 'Kursus', 'icon' => 'M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25'],
        9 => ['label' => 'Kelulusan', 'icon' => 'M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5'],
        10 => ['label' => 'History Jawatan', 'icon' => 'm20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z'],
        11 => ['label' => 'Anugerah', 'icon' => 'M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0'],
        12 => ['label' => 'Peruntukan/Bersara', 'icon' => 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008ZM14.25 15h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008ZM16.5 15h.008v.008H16.5V15Zm0 2.25h.008v.008H16.5v-.008Z'],
        13 => ['label' => 'Lain-Lain Hal', 'icon' => 'M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75'],
       // 9 => ['label' => 'Kursus', 'icon' => 'M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25'],
        //10 => ['label' => 'Prestasi', 'icon' => 'M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.228a25.928 25.928 0 0 1 2.916.52 6.003 6.003 0 0 1-4.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.350m0 0C14.23 12.172 16.22 11.65 18 10.75']
    ];
@endphp

            @foreach($tabs as $key => $tab)
                <div x-on:click="activeTab = {{ $key }}" 
                     class="tab-item flex items-center gap-2 px-5 py-2 border-b-2 duration-300 hover:border-rose-600 hover:text-rose-600"
                     :class="{'active border-rose-600 text-rose-600': activeTab === {{ $key }}, 'border-gray-100': activeTab !== {{ $key }}}">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $tab['icon'] }}" />
                    </svg>

                    <p>{{ $tab['label'] }}</p>
                </div>
            @endforeach

        </div>
    </div>
</div>


     {{-- Tab Contents --}}
<div x-cloak x-show="activeTab === 1" class="tab-content-wrapper">
    <form action="{{ route('pj.savePeribadiTeach', $teacher->{'No Kad Pintar'}) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Success Message (Tab-Specific) --}}
        @if(session('success') && request()->query('tab') === 'peribadi')
        <div class="mb-5">
            <div style="
                display: flex; 
                align-items: center; 
                gap: 0.75rem; 
                background: linear-gradient(to right, #d1fae5, #a7f3d0); 
                border: 1px solid #34d399; 
                color: #065f46; 
                padding: 0.75rem 1rem; 
                border-radius: 0.5rem; 
                width: 100%; 
                box-shadow: 0 4px 12px rgba(0,0,0,0.1), 0 0 8px rgba(34,197,94,0.3); 
                font-family: sans-serif;
            ">
                <svg style="width: 1.25rem; height: 1.25rem; flex-shrink: 0; stroke: #065f46;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span style="font-size: 0.95rem; font-weight: 600;">{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.parentElement.remove()" style="margin-left:auto; font-weight:bold; color:#065f46; background:none; border:none; cursor:pointer; font-size: 1.1rem;">&times;</button>
            </div>
        </div>
        @endif

        {{-- Failure Message (Tab-Specific) --}}
        @if(session('failure') && request()->query('tab') === 'peribadi')
        <div class="mb-5">
            <div style="
                display: flex; 
                align-items: center; 
                gap: 0.75rem; 
                background: linear-gradient(to right, #fee2e2, #fecaca); 
                border: 1px solid #f87171; 
                color: #991b1b; 
                padding: 0.75rem 1rem; 
                border-radius: 0.5rem; 
                width: 100%; 
                box-shadow: 0 4px 12px rgba(0,0,0,0.1), 0 0 8px rgba(239,68,68,0.3); 
                font-family: sans-serif;
            ">
                <svg style="width: 1.25rem; height: 1.25rem; flex-shrink: 0; stroke: #991b1b;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span style="font-size: 0.95rem; font-weight: 600;">{{ session('failure') }}</span>
                <button type="button" onclick="this.parentElement.parentElement.remove()" style="margin-left:auto; font-weight:bold; color:#991b1b; background:none; border:none; cursor:pointer; font-size: 1.1rem;">&times;</button>
            </div>
        </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
        <div class="mb-5">
            <div style="
                display: flex; 
                flex-direction: column;
                gap: 0.5rem; 
                background: linear-gradient(to right, #fee2e2, #fecaca); 
                border: 1px solid #f87171; 
                color: #991b1b; 
                padding: 0.75rem 1rem; 
                border-radius: 0.5rem; 
                width: 100%; 
                box-shadow: 0 4px 12px rgba(0,0,0,0.1), 0 0 8px rgba(239,68,68,0.3); 
                font-family: sans-serif;
            ">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <svg style="width: 1.25rem; height: 1.25rem; flex-shrink: 0; stroke: #991b1b;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span style="font-size: 0.95rem; font-weight: 600;">Sila betulkan ralat berikut:</span>
                    <button type="button" onclick="this.parentElement.parentElement.parentElement.remove()" style="margin-left:auto; font-weight:bold; color:#991b1b; background:none; border:none; cursor:pointer; font-size: 1.1rem;">&times;</button>
                </div>
                <ul style="list-style: disc; margin-left: 2.5rem; font-size: 0.875rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- Section Title --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-rose-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                Maklumat Peribadi
            </h3>
            <p class="text-sm text-gray-500 mt-1">Kemaskini maklumat peribadi dan butiran hubungan</p>
        </div>

        {{-- Personal Info Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-5">
            {{-- Alamat --}}
            <div class="lg:col-span-4 flex flex-col gap-2">
                <label for="alamat" class="text-sm font-semibold text-gray-700">
                    Alamat <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="alamat"
                    name="alamat" 
                    rows="3"
                    placeholder="Masukkan alamat penuh"
                    class="border border-gray-300 px-4 py-2 rounded-md w-full placeholder:text-gray-400 focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition @error('alamat') border-red-500 @enderror"
                >{{ old('alamat', $teacher->Alamat ?? '') }}</textarea>
                @error('alamat') 
                    <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        {{-- Butiran Kontak Section --}}
        <div class="mt-8 mb-4">
            <h4 class="font-semibold text-gray-800 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-rose-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
                Butiran Kontak
            </h4>
            <p class="text-xs text-gray-500 mt-1">Pastikan maklumat hubungan adalah terkini</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mt-2">
            {{-- Emel Peribadi --}}
            <div class="flex flex-col gap-2">
                <label for="emelPeribadi" class="text-sm font-semibold text-gray-700">
                    Emel Peribadi
                </label>
                <input 
                    type="email" 
                    id="emelPeribadi"
                    name="emelPeribadi" 
                    value="{{ old('emelPeribadi', $teacher->{'Personal Email'} ?? '') }}"
                    placeholder="contoh@email.com"
                    class="border border-gray-300 px-4 py-2 rounded-md w-full placeholder:text-gray-400 focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition @error('emelPeribadi') border-red-500 @enderror">
                @error('emelPeribadi') 
                    <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Emel Kerja --}}
            <div class="flex flex-col gap-2">
                <label for="emel" class="text-sm font-semibold text-gray-700">
                    Emel Kerja
                </label>
                <input 
                    type="email" 
                    id="emel"
                    name="emel" 
                    value="{{ old('emel', $teacher->Email ?? '') }}"
                    placeholder="nama@moe.gov.bn"
                    class="border border-gray-300 px-4 py-2 rounded-md w-full placeholder:text-gray-400 focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition @error('emel') border-red-500 @enderror">
                @error('emel') 
                    <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- No. Telefon --}}
            <div class="flex flex-col gap-2">
                <label for="noTelefon" class="text-sm font-semibold text-gray-700">
                    No. Telefon
                </label>
                <div class="border border-gray-300 rounded-md w-full flex items-center focus-within:border-rose-500 focus-within:ring-1 focus-within:ring-rose-500 transition @error('noTelefon') border-red-500 @enderror">
                    <span class="text-gray-500 pl-3 pr-1 font-medium">+673</span>
                    <input 
                        type="text" 
                        id="noTelefon"
                        x-mask="999 9999" 
                        name="noTelefon" 
                        value="{{ old('noTelefon', $teacher->{'No Telefon'} ?? '') }}"
                        placeholder="222 3333"
                        class="py-2 px-2 focus:outline-none w-full rounded-r-md placeholder:text-gray-400">
                </div>
                @error('noTelefon') 
                    <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- No. Telefon Bimbit --}}
            <!-- <div class="flex flex-col gap-2">
                <label for="noMobile" class="text-sm font-semibold text-gray-700">
                    No. Telefon Bimbit
                </label>
                <div class="border border-gray-300 rounded-md w-full flex items-center focus-within:border-rose-500 focus-within:ring-1 focus-within:ring-rose-500 transition @error('noMobile') border-red-500 @enderror">
                    <span class="text-gray-500 pl-3 pr-1 font-medium">+673</span>
                    <input 
                        type="text" 
                        id="noMobile"
                        x-mask="999 9999" 
                        name="noMobile" 
                        value="{{ old('noMobile', $teacher->{'No mobile'} ?? '') }}"
                        placeholder="888 9999"
                        class="py-2 px-2 focus:outline-none w-full rounded-r-md placeholder:text-gray-400">
                </div>
                @error('noMobile') 
                    <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div> -->

        {{-- Info Box --}}
        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
                <div>
                    <p class="text-sm font-semibold text-blue-900">Nota Penting</p>
                    <p class="text-xs text-blue-800 mt-1">
                        • Pastikan alamat dan nombor telefon adalah betul dan terkini<br>
                        • Emel kerja akan digunakan untuk komunikasi rasmi<br>
                        • Maklumat ini adalah sulit dan hanya boleh diakses oleh pihak berwajib
                    </p>
                </div>
            </div>
        </div>

        {{-- Buffer for button --}}
        <div class="mb-20"></div>

        {{-- Fixed Submit Button (EXACTLY AS SPECIFIED) --}}
        <div class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Peribadi</p>
            </button>
        </div>
    </form>
</div>
</div>

{{-- 2. Prestasi --}}
<div x-cloak x-show="activeTab === 2" class="tab-content-wrapper pointer-events-none opacity-50">
    
    <form action="{{ route('pj.savePrestasiGaji', $teacher->{'No Kad Pintar'}) }}" method="POST">
        @csrf
        @method('PUT')
        
        {{-- Section Title --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800">Prestasi</h3>
            <p class="text-sm text-gray-500 mt-1">Kemaskini maklumat prestasi</p>
        </div>

        {{-- Matrix Table - SIMPLIFIED WITH INLINE ALPINE --}}
        <div class="overflow-x-auto border-2 border-gray-300 rounded-lg p-4 shadow-sm bg-gray-100" 
             x-data="{ 
                newRows: [],
                addRow() { 
                    this.newRows.push({}); 
                    console.log('Added row, total:', this.newRows.length);
                },
                removeNewRow(index) { 
                    this.newRows.splice(index, 1); 
                }
             }">
            
            <p class="text-red-600 font-semibold mb-4 text-lg">Matrix Gaji / Kenaikan</p>
            
            <table class="min-w-full border border-gray-300 bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left">Tahun</th>
                        <th class="border px-4 py-2 text-left">Tarikh Kenaikan</th>
                        <th class="border px-4 py-2 text-left">Gaji</th>
                        <th class="border px-4 py-2 text-left">Percentage</th>
                        <th class="border px-4 py-2 text-left">Tahap</th>
                        <th class="border px-4 py-2 text-left">Lain-lain</th>
                        <th class="border px-4 py-2 text-left">Subjek</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Load existing records from database --}}
                    @forelse($teacher->gajiMatrixRecords as $index => $record)
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][tahun]"
                                   value="{{ $record->tahun }}"
                                   placeholder="Year"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="gaji_matrix[{{ $index }}][tarikh_kenaikan]"
                                   value="{{ $record->tarikh_kenaikan ? $record->tarikh_kenaikan->format('Y-m-d') : '' }}"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][gaji]"
                                   value="{{ $record->gaji }}"
                                   placeholder="Gaji"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][percentage]"
                                   value="{{ $record->percentage }}"
                                   placeholder="%"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][tahap]"
                                   value="{{ $record->tahap }}"
                                   placeholder="Tahap"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][lain]"
                                   value="{{ $record->lain }}"
                                   placeholder="Lain-lain"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][subjek]"
                                   value="{{ $record->subjek }}"
                                   placeholder="Subjek"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                    {{-- Default empty row if no records --}}
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][tahun]"
                                   placeholder="Year"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="gaji_matrix[0][tarikh_kenaikan]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][gaji]"
                                   placeholder="Gaji"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][percentage]"
                                   placeholder="%"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][tahap]"
                                   placeholder="Tahap"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][lain]"
                                   placeholder="Lain-lain"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][subjek]"
                                   placeholder="Subjek"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @endforelse
                    
                    {{-- Dynamic rows will be added here --}}
                    <template x-for="(row, index) in newRows" :key="index">
                        <tr>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][tahun]'"
                                       placeholder="Year"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][tarikh_kenaikan]'"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][gaji]'"
                                       placeholder="Gaji"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][percentage]'"
                                       placeholder="%"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][tahap]'"
                                       placeholder="Tahap"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][lain]'"
                                       placeholder="Lain-lain"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][subjek]'"
                                       placeholder="Subjek"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button type="button" 
                                        @click="removeNewRow(index)" 
                                        class="text-red-600 font-bold hover:underline">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <button type="button" 
                    @click="addRow()" 
                    class="mt-3 px-5 py-2 rounded-md hover:bg-green-700 transition text-white font-medium" 
                    style="background-color:#10B981;">
                Tambah Baris
            </button>
            
            {{-- Debug info --}}
            <p class="mt-2 text-xs text-gray-500" x-text="'New rows: ' + newRows.length"></p>
        </div>

        {{-- Buffer for button --}}
        <div class="mb-20"></div>

        {{-- SUBMIT BUTTON --}}
        <div class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Prestasi</p>
            </button>
        </div>
        
    </form>
    
</div>

{{-- 3. TPA --}}
<div x-cloak x-show="activeTab === 3" class="tab-content-wrapper pointer-events-none opacity-50">
    
    <form action="{{ route('pj.savePrestasiGaji', $teacher->{'No Kad Pintar'}) }}" method="POST">
        @csrf
        @method('PUT')
        
        {{-- Section Title --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800">TPA</h3>
            <p class="text-sm text-gray-500 mt-1">Kemaskini maklumat TPA</p>
        </div>

        {{-- Matrix Table - SIMPLIFIED WITH INLINE ALPINE --}}
        <div class="overflow-x-auto border-2 border-gray-300 rounded-lg p-4 shadow-sm bg-gray-100" 
             x-data="{ 
                newRows: [],
                addRow() { 
                    this.newRows.push({}); 
                    console.log('Added row, total:', this.newRows.length);
                },
                removeNewRow(index) { 
                    this.newRows.splice(index, 1); 
                }
             }">
            
            <p class="text-red-600 font-semibold mb-4 text-lg">Matrix Gaji / Kenaikan</p>
            
            <table class="min-w-full border border-gray-300 bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left">Tahun</th>
                        <th class="border px-4 py-2 text-left">Tarikh Kenaikan</th>
                        <th class="border px-4 py-2 text-left">Gaji</th>
                        <th class="border px-4 py-2 text-left">Percentage</th>
                        <th class="border px-4 py-2 text-left">Tahap</th>
                        <th class="border px-4 py-2 text-left">Lain-lain</th>
                        <th class="border px-4 py-2 text-left">Subjek</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Load existing records from database --}}
                    @forelse($teacher->gajiMatrixRecords as $index => $record)
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][tahun]"
                                   value="{{ $record->tahun }}"
                                   placeholder="Year"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="gaji_matrix[{{ $index }}][tarikh_kenaikan]"
                                   value="{{ $record->tarikh_kenaikan ? $record->tarikh_kenaikan->format('Y-m-d') : '' }}"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][gaji]"
                                   value="{{ $record->gaji }}"
                                   placeholder="Gaji"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][percentage]"
                                   value="{{ $record->percentage }}"
                                   placeholder="%"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][tahap]"
                                   value="{{ $record->tahap }}"
                                   placeholder="Tahap"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][lain]"
                                   value="{{ $record->lain }}"
                                   placeholder="Lain-lain"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][subjek]"
                                   value="{{ $record->subjek }}"
                                   placeholder="Subjek"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                    {{-- Default empty row if no records --}}
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][tahun]"
                                   placeholder="Year"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="gaji_matrix[0][tarikh_kenaikan]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][gaji]"
                                   placeholder="Gaji"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][percentage]"
                                   placeholder="%"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][tahap]"
                                   placeholder="Tahap"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][lain]"
                                   placeholder="Lain-lain"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][subjek]"
                                   placeholder="Subjek"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @endforelse
                    
                    {{-- Dynamic rows will be added here --}}
                    <template x-for="(row, index) in newRows" :key="index">
                        <tr>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][tahun]'"
                                       placeholder="Year"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][tarikh_kenaikan]'"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][gaji]'"
                                       placeholder="Gaji"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][percentage]'"
                                       placeholder="%"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][tahap]'"
                                       placeholder="Tahap"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][lain]'"
                                       placeholder="Lain-lain"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][subjek]'"
                                       placeholder="Subjek"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button type="button" 
                                        @click="removeNewRow(index)" 
                                        class="text-red-600 font-bold hover:underline">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <button type="button" 
                    @click="addRow()" 
                    class="mt-3 px-5 py-2 rounded-md hover:bg-green-700 transition text-white font-medium" 
                    style="background-color:#10B981;">
                Tambah Baris
            </button>
            
            {{-- Debug info --}}
            <p class="mt-2 text-xs text-gray-500" x-text="'New rows: ' + newRows.length"></p>
        </div>

        {{-- Buffer for button --}}
        <div class="mb-20"></div>

        {{-- SUBMIT BUTTON --}}
        <div class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save TPA</p>
            </button>
        </div>
        
    </form>
    
</div>

{{-- 4. Kenaikan Gaji --}}
<div x-cloak x-show="activeTab === 4" class="tab-content-wrapper">
    
    <form action="{{ route('pj.savePrestasiGaji', $teacher->{'No Kad Pintar'}) }}" method="POST">
        @csrf
        @method('PUT')
        
        {{-- Section Title --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800">Kenaikan Gaji</h3>
            <p class="text-sm text-gray-500 mt-1">Kemaskini maklumat gaji dan kenaikan pangkat</p>
        </div>

        {{-- Matrix Table - SIMPLIFIED WITH INLINE ALPINE --}}
        <div class="overflow-x-auto border-2 border-gray-300 rounded-lg p-4 shadow-sm bg-gray-100" 
             x-data="{ 
                newRows: [],
                addRow() { 
                    this.newRows.push({}); 
                    console.log('Added row, total:', this.newRows.length);
                },
                removeNewRow(index) { 
                    this.newRows.splice(index, 1); 
                }
             }">
            
            <p class="text-red-600 font-semibold mb-4 text-lg">Matrix Gaji / Kenaikan</p>
            
            <table class="min-w-full border border-gray-300 bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left">Tahun</th>
                        <th class="border px-4 py-2 text-left">Tarikh Kenaikan</th>
                        <th class="border px-4 py-2 text-left">Gaji</th>
                        <th class="border px-4 py-2 text-left">Percentage</th>
                        <th class="border px-4 py-2 text-left">Tahap</th>
                        <th class="border px-4 py-2 text-left">Lain-lain</th>
                        <th class="border px-4 py-2 text-left">Subjek</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Load existing records from database --}}
                    @forelse($teacher->gajiMatrixRecords as $index => $record)
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][tahun]"
                                   value="{{ $record->tahun }}"
                                   placeholder="Year"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="gaji_matrix[{{ $index }}][tarikh_kenaikan]"
                                   value="{{ $record->tarikh_kenaikan ? $record->tarikh_kenaikan->format('Y-m-d') : '' }}"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][gaji]"
                                   value="{{ $record->gaji }}"
                                   placeholder="Gaji"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][percentage]"
                                   value="{{ $record->percentage }}"
                                   placeholder="%"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][tahap]"
                                   value="{{ $record->tahap }}"
                                   placeholder="Tahap"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][lain]"
                                   value="{{ $record->lain }}"
                                   placeholder="Lain-lain"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[{{ $index }}][subjek]"
                                   value="{{ $record->subjek }}"
                                   placeholder="Subjek"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                    {{-- Default empty row if no records --}}
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][tahun]"
                                   placeholder="Year"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="gaji_matrix[0][tarikh_kenaikan]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][gaji]"
                                   placeholder="Gaji"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][percentage]"
                                   placeholder="%"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][tahap]"
                                   placeholder="Tahap"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][lain]"
                                   placeholder="Lain-lain"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="gaji_matrix[0][subjek]"
                                   placeholder="Subjek"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @endforelse
                    
                    {{-- Dynamic rows will be added here --}}
                    <template x-for="(row, index) in newRows" :key="index">
                        <tr>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][tahun]'"
                                       placeholder="Year"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][tarikh_kenaikan]'"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][gaji]'"
                                       placeholder="Gaji"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][percentage]'"
                                       placeholder="%"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][tahap]'"
                                       placeholder="Tahap"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][lain]'"
                                       placeholder="Lain-lain"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'gaji_matrix[' + ({{ $teacher->gajiMatrixRecords->count() }} + index) + '][subjek]'"
                                       placeholder="Subjek"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button type="button" 
                                        @click="removeNewRow(index)" 
                                        class="text-red-600 font-bold hover:underline">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <button type="button" 
                    @click="addRow()" 
                    class="mt-3 px-5 py-2 rounded-md hover:bg-green-700 transition text-white font-medium" 
                    style="background-color:#10B981;">
                Tambah Baris
            </button>
            
            {{-- Debug info --}}
            <p class="mt-2 text-xs text-gray-500" x-text="'New rows: ' + newRows.length"></p>
        </div>

        {{-- Buffer for button --}}
        <div class="mb-20"></div>

        {{-- SUBMIT BUTTON --}}
        <div class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Kenaikan Gaji</p>
            </button>
        </div>
        
    </form>
    
</div>

{{-- 5. Cuti --}}
<div x-cloak x-show="activeTab === 5" class="tab-content-wrapper">
    
    <form action="{{ route('pj.saveCuti', $teacher->{'No Kad Pintar'}) }}" method="POST">
        @csrf
        @method('PUT')
        
        {{-- Section Title --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800">Cuti</h3>
            <p class="text-sm text-gray-500 mt-1">Kemaskini maklumat cuti</p>
        </div>

        {{-- Maklumat Cuti Khas --}}
        @php
        $khasCount = $teacher->cutiRecords->whereNotNull('tarikh_mula_khas')->count();
        @endphp
        <div class="overflow-x-auto border-2 border-gray-300 rounded-lg p-4 shadow-sm bg-gray-100" 
                x-data="{
                    khasRows: [],
                    
                    addKhas(){
                        this.khasRows.push({
                            id: Date.now() + Math.random(),
                            start: '',
                            end: '',
                            jumlah: ''
                        })
                    },

                    removeKhas(index){
                        this.khasRows.splice(index,1)
                    },

                    calc(row){
                        if(!row.start || !row.end){
                            row.jumlah = ''
                            return
                        }

                        let s = new Date(row.start)
                        let e = new Date(row.end)

                        let diff = Math.floor((e - s)/(1000*60*60*24)) + 1

                        row.jumlah = diff > 0 ? diff : ''
                    }
                }">
            
            <p class="text-red-600 font-semibold mb-4 text-lg">Cuti Khas</p>

            <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left">Tarikh Mula</th>
                        <th class="border px-4 py-2 text-left">Tarikh Berakhir</th>
                        <th class="border px-4 py-2 text-left">Jumlah</th>
                        <th class="border px-4 py-2 text-left">Justifikasi</th>
                        <th class="border px-4 py-2 text-left">Kategori</th>
                        <th class="border px-4 py-2 text-left">Status</th>
                        <th class="border px-4 py-2 text-left">Melapor Diri</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Load existing records from database --}}
                    @forelse($teacher->cutiRecords->whereNotNull('tarikh_mula_khas') as $index => $record)
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="date"
                                    x-ref="start_{{ $index }}"
                                    x-on:change="
                                    let start=$event.target.value
                                    let end=$refs.end_{{ $index }}?.value
                                    if(start && end){
                                        let s=new Date(start)
                                        let e=new Date(end)
                                        let diff=Math.floor((e-s)/(1000*60*60*24))+1
                                        $refs.jumlah_{{ $index }}.value=diff>0?diff:''
                                    }"
                                    name="cuti_khas[{{ $index }}][tarikh_mula_khas]"
                                    value="{{ $record->tarikh_mula_khas? $record->tarikh_mula_khas->format('Y-m-d') : '' }}"
                                    class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date"
                                    x-ref="end_{{ $index }}"
                                    x-on:change="
                                    let start=$refs.start_{{ $index }}?.value
                                    let end=$event.target.value
                                    if(start && end){
                                        let s=new Date(start)
                                        let e=new Date(end)
                                        let diff=Math.floor((e-s)/(1000*60*60*24))+1
                                        $refs.jumlah_{{ $index }}.value=diff>0?diff:''
                                    }"
                                    name="cuti_khas[{{ $index }}][tarikh_hingga_khas]"
                                    value="{{ $record->tarikh_hingga_khas? $record->tarikh_hingga_khas->format('Y-m-d') : '' }}"
                                    class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text"
                                    x-ref="jumlah_{{ $index }}"
                                    readonly
                                    name="cuti_khas[{{ $index }}][jumlah_khas]"
                                    value="{{ $record->jumlah_khas }}"
                                    class="border px-2 py-1 w-full rounded-md bg-gray-100">
                        </td>
                        <td class="border px-4 py-2">
                            <textarea name="cuti_khas[{{ $index }}][justifikasi_khas]"
                                    rows="2"
                                    class="border px-2 py-1 w-full rounded-md">{{ $record->justifikasi_khas }}</textarea>
                        </td>
                        <td class="border px-4 py-2">
                            <select name="cuti_khas[{{ $index }}][kategori_khas]"
                                    class="border px-2 py-1 w-full rounded-md">
                                <option value="">Pilih</option>
                                <option value="Cuti Khas menemani suami" 
                                    {{ $record->kategori_khas == 'Cuti Khas menemani suami' ? 'selected' : '' }}>
                                    Cuti Khas menemani suami
                                </option>
                                <option value="Cuti Khas menemani isteri" 
                                    {{ $record->kategori_khas == 'Cuti Khas menemani isteri' ? 'selected' : '' }}>
                                    Cuti Khas menemani isteri
                                </option>
                            </select>
                        </td>
                        <td class="border px-4 py-2">
                            <textarea name="cuti_khas[{{ $index }}][status_khas]"
                                    rows="2"
                                    class="border px-2 py-1 w-full rounded-md">{{ $record->status_khas }}</textarea>
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date"
                                    name="cuti_khas[{{ $index }}][tarikh_melapor_khas]"
                                    value="{{ $record->tarikh_melapor_khas ? $record->tarikh_melapor_khas->format('Y-m-d') : '' }}"
                                    class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                    {{-- Default empty row if no records --}}
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="date"
                                    x-ref="start_default"
                                    x-on:change="
                                    let start=$event.target.value
                                    let end=$refs.end_default?.value

                                    if(start && end){
                                    let s=new Date(start)
                                    let e=new Date(end)
                                    let diff=Math.floor((e-s)/(1000*60*60*24))+1
                                    $refs.jumlah_default.value=diff>0?diff:''
                                    }
                                    "
                                    name="cuti_khas[0][tarikh_mula_khas]"
                                    class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date"
                                    x-ref="end_default"
                                    x-on:change="
                                    let start=$refs.start_default?.value
                                    let end=$event.target.value

                                    if(start && end){
                                    let s=new Date(start)
                                    let e=new Date(end)
                                    let diff=Math.floor((e-s)/(1000*60*60*24))+1
                                    $refs.jumlah_default.value=diff>0?diff:''
                                    }
                                    "
                                    name="cuti_khas[0][tarikh_hingga_khas]"
                                    class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text"
                                    x-ref="jumlah_default"
                                    readonly
                                    name="cuti_khas[0][jumlah_khas]"
                                    class="border px-2 py-1 w-full rounded-md bg-gray-100">
                        </td>
                        <td class="border px-4 py-2">
                            <textarea
                                    name="cuti_khas[0][justifikasi_khas]"
                                    rows="2"
                                    class="border px-2 py-1 w-full rounded-md"></textarea>
                        </td>
                        <td class="border px-4 py-2">
                            <select name="cuti_khas[0][kategori_khas]"
                                    class="border px-2 py-1 w-full rounded-md">
                                    <option value="">Pilih</option>
                                    <option value="Cuti Khas menemani suami">Cuti Khas menemani suami</option>
                                    <option value="Cuti Khas menemani isteri">Cuti Khas menemani isteri</option>
                                    </select>
                        </td>
                        <td class="border px-4 py-2">
                            <textarea
                                    name="cuti_khas[0][status_khas]"
                                    rows="2"
                                    class="border px-2 py-1 w-full rounded-md"></textarea>
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="cuti_khas[0][tarikh_melapor_khas]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @endforelse
                    
                    {{-- Dynamic rows will be added here --}}
                    <template x-for="(row,index) in khasRows" :key="row.id">
                        <tr>

                        <td class="border px-4 py-2">
                        <input type="date"
                            x-model="row.start"
                            @change="calc(row)"
                            :name="'cuti_khas['+index+'][tarikh_mula_khas]'"
                            class="border px-2 py-1 w-full rounded-md">
                        </td>

                        <td class="border px-4 py-2">
                        <input type="date"
                            x-model="row.end"
                            @change="calc(row)"
                            :name="'cuti_khas['+index+'][tarikh_hingga_khas]'"
                            class="border px-2 py-1 w-full rounded-md">
                        </td>

                        <td class="border px-4 py-2">
                        <input type="text"
                            x-model="row.jumlah"
                            readonly
                            :name="'cuti_khas['+index+'][jumlah_khas]'"
                            class="border px-2 py-1 w-full rounded-md bg-gray-100">
                        </td>

                        <td class="border px-4 py-2">
                        <textarea
                            :name="'cuti_khas['+index+'][justifikasi_khas]'"
                            rows="2"
                            class="border px-2 py-1 w-full rounded-md"></textarea>
                        </td>

                        <td class="border px-4 py-2">
                        <select
                                :name="'cuti_khas['+index+'][kategori_khas]'"
                                class="border px-2 py-1 w-full rounded-md">

                        <option value="">Pilih</option>
                        <option value="Cuti Khas menemani suami">Cuti Khas menemani suami</option>
                        <option value="Cuti Khas menemani isteri">Cuti Khas menemani isteri</option>

                        </select>
                        </td>

                        <td class="border px-4 py-2">
                        <textarea
                                :name="'cuti_khas['+index+'][status_khas]'"
                                rows="2"
                                class="border px-2 py-1 w-full rounded-md"></textarea>
                        </td>

                        <td class="border px-4 py-2">
                        <input type="date"
                            :name="'cuti_khas['+index+'][tarikh_melapor_khas]'"
                            class="border px-2 py-1 w-full rounded-md">
                        </td>

                        <td class="border px-4 py-2 text-center">
                        <button type="button"
                                @click="removeKhas(index)"
                                class="text-red-600 font-bold hover:underline">
                        Remove
                        </button>
                        </td>

                        </tr>
                        </template>
                </tbody>
            </table>

            <button type="button" 
                    @click="addKhas()"
                    class="mt-3 px-5 py-2 rounded-md hover:bg-green-700 transition text-white font-medium" 
                    style="background-color:#10B981;">
                Tambah Baris
            </button>
            
            {{-- Debug info --}}
            <p class="mt-2 text-xs text-gray-500" x-text="'New rows: ' + khasRows.length"></p>
            </div>
        </div>
        <br>

        {{-- Maklumat Cuti Tanpa Gaji --}}
        @php
        $ctgCount = $teacher->cutiRecords->whereNotNull('tarikh_mula_ctg')->count();
        @endphp
        <div class="overflow-x-auto border-2 border-gray-300 rounded-lg p-4 shadow-sm bg-gray-100" 
                    x-data="{
                    ctgRows: [],

                    addCtg() {
                        this.ctgRows.push({
                            id: Date.now() + Math.random(),
                            start: '',
                            end: '',
                            jumlah: '',
                            justifikasi: '',
                            kategori: '',
                            status: '',
                            melapor: ''
                        });
                    },

                    removeCtg(index) {
                        this.ctgRows.splice(index, 1);
                    },

                    calc(row) {
                        if(!row.start || !row.end) {
                            row.jumlah = '';
                            return;
                        }
                        let s = new Date(row.start);
                        let e = new Date(row.end);
                        let diff = Math.floor((e - s)/(1000*60*60*24)) + 1;
                        row.jumlah = diff > 0 ? diff : '';
                    }
                }">
            
            <p class="text-red-600 font-semibold mb-4 text-lg">Cuti Tanpa Gaji</p>

            <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left">Tarikh Mula</th>
                        <th class="border px-4 py-2 text-left">Tarikh Berakhir</th>
                        <th class="border px-4 py-2 text-left">Jumlah</th>
                        <th class="border px-4 py-2 text-left">Justifikasi</th>
                        <th class="border px-4 py-2 text-left">Kategori</th>
                        <th class="border px-4 py-2 text-left">Status</th>
                        <th class="border px-4 py-2 text-left">Melapor Diri</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Load existing records from database --}}
                    @forelse($teacher->cutiRecords->whereNotNull('tarikh_mula_ctg') as $index => $record)
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="date"
                                    x-ref="start_{{ $index }}"
                                    x-on:change="
                                            let start = $event.target.value
                                            let end = $refs.end_{{ $index }}?.value
                                            if(start && end){
                                                let s = new Date(start)
                                                let e = new Date(end)
                                                let diff = Math.floor((e - s)/(1000*60*60*24)) + 1
                                                $refs.jumlah_{{ $index }}.value = diff>0 ? diff : ''
                                            }
                                    "
                                    name="ctg[{{ $index }}][tarikh_mula_ctg]"
                                    value="{{ $record->tarikh_mula_ctg ? $record->tarikh_mula_ctg->format('Y-m-d') : '' }}"
                                    class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date"
                                    x-ref="end_{{ $index }}"
                                    x-on:change="
                                            let start = $refs.start_{{ $index }}?.value
                                            let end = $event.target.value
                                            if(start && end){
                                                let s = new Date(start)
                                                let e = new Date(end)
                                                let diff = Math.floor((e - s)/(1000*60*60*24)) + 1
                                                $refs.jumlah_{{ $index }}.value = diff>0 ? diff : ''
                                            }
                                    "
                                    name="ctg[{{ $index }}][tarikh_hingga_ctg]"
                                    value="{{ $record->tarikh_hingga_ctg ? $record->tarikh_hingga_ctg->format('Y-m-d') : '' }}"
                                    class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text"
                                    x-ref="jumlah_{{ $index }}"
                                    name="ctg[{{ $index }}][jumlah_ctg]"
                                    value="{{ $record->jumlah_ctg }}"
                                    readonly
                                    class="border px-2 py-1 w-full rounded-md bg-gray-100">
                        </td>
                        <td class="border px-4 py-2">
                            <textarea name="ctg[{{ $index }}][justifikasi_ctg]"
                                  rows="2"
                                  class="border px-2 py-1 w-full rounded-md">{{ $record->justifikasi_ctg }}</textarea>
                        </td>
                        <td class="border px-4 py-2">
                            <select name="ctg[{{ $index }}][kategori_ctg]" class="border px-2 py-1 w-full rounded-md">
                                <option value="">Pilih</option>
                                <option {{ $record->kategori_ctg == 'Menemani/ melawat suami/isteri (warganegara) bertugas di luar negeri' ? 'selected' : '' }}>Menemani/ melawat suami/isteri (warganegara) bertugas di luar negeri</option>
                                <option {{ $record->kategori_ctg == 'Menemani/ melawat suami/isteri (bukan warganegara) bertugas di luar negeri' ? 'selected' : '' }}>Menemani/ melawat suami/isteri (bukan warganegara) bertugas di luar negeri</option>
                                <option {{ $record->kategori_ctg == 'Menemani suami / isteri / anak melanjutkan pelajaran / kursus / mesyuarat / pertandingan di luar negara' ? 'selected' : '' }}>Menemani suami / isteri / anak melanjutkan pelajaran / kursus / mesyuarat / pertandingan di luar negara</option>
                                <option {{ $record->kategori_ctg == 'Menghadiri Majlis Konvokesyen / Graduasi di luar negeri' ? 'selected' : '' }}>Menghadiri Majlis Konvokesyen / Graduasi di luar negeri</option>
                                <option {{ $record->kategori_ctg == 'Menghadiri majlis perkahwinan  di luar negeri' ? 'selected' : '' }}>Menghadiri majlis perkahwinan  di luar negeri</option>
                                <option {{ $record->kategori_ctg == 'Menjaga anak kerana ketiadaan pembantu rumah / mengurus persekolahan anak' ? 'selected' : '' }}>Menjaga anak kerana ketiadaan pembantu rumah / mengurus persekolahan anak</option>
                                <option {{ $record->kategori_ctg == 'Urusan peribadi / keluarga' ? 'selected' : '' }}>Urusan peribadi / keluarga</option>
                                <option {{ $record->kategori_ctg == 'Meziarahi keluarga  kembali kerahmatullah / sakit / sakit tenat di luar negeri' ? 'selected' : '' }}>Meziarahi keluarga  kembali kerahmatullah / sakit / sakit tenat di luar negeri</option>
                                <option {{ $record->kategori_ctg == 'Menemani / menjaga ahli keluarga sakit di hospital / rumah' ? 'selected' : '' }}>Menemani / menjaga ahli keluarga sakit di hospital / rumah</option>
                                <option {{ $record->kategori_ctg == 'Menemani pesakit / mendapatkan rawatan / perjanjian doktor di luar negeri' ? 'selected' : '' }}>Menemani pesakit / mendapatkan rawatan / perjanjian doktor di luar negeri</option>
                                <option {{ $record->kategori_ctg == 'Masalah kesihatan' ? 'selected' : '' }}>Masalah kesihatan</option>
                                <option {{ $record->kategori_ctg == 'Mengikuti kursus / pertandingan atas perbelanjaan sendiri / sponsor' ? 'selected' : '' }}>Mengikuti kursus / pertandingan atas perbelanjaan sendiri / sponsor</option>
                                <option {{ $record->kategori_ctg == 'Menunaikan  haji atas perbelanjaan sendiri / umrah' ? 'selected' : '' }}>Menunaikan  haji atas perbelanjaan sendiri / umrah</option>
                                <option {{ $record->kategori_ctg == 'Menunggu proses menamatkan perkhidmatan' ? 'selected' : '' }}>Menunggu proses menamatkan perkhidmatan</option>
                                <option {{ $record->kategori_ctg == 'CSDS berlebihan semasa penggal persekolahan / baki cuti tidak mencukupi' ? 'selected' : '' }}>CSDS berlebihan semasa penggal persekolahan / baki cuti tidak mencukupi</option>
                            </select>
                        </td>
                        <td class="border px-4 py-2">
                            <textarea name="ctg[{{ $index }}][status_ctg]"
                                    rows="2"
                                    class="border px-2 py-1 w-full rounded-md">{{ $record->status_ctg }}</textarea>
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date"
                                    name="ctg[{{ $index }}][tarikh_melapor_ctg]"
                                    value="{{ $record->tarikh_melapor_ctg ? $record->tarikh_melapor_ctg->format('Y-m-d') : '' }}"
                                    class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                    {{-- Default empty row if no records --}}
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="date"
                                    x-ref="start_ctg_default"
                                    x-on:change="
                                        let start=$event.target.value
                                        let end=$refs.end_ctg_default?.value
                                        if(start && end){
                                            let s=new Date(start)
                                            let e=new Date(end)
                                            let diff=Math.floor((e-s)/(1000*60*60*24))+1
                                            $refs.jumlah_ctg_default.value=diff>0?diff:''
                                        }
                                    "
                                    name="ctg[0][tarikh_mula_ctg]"
                                    class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date"
                                    x-ref="end_ctg_default"
                                    x-on:change="
                                        let start=$refs.start_ctg_default?.value
                                        let end=$event.target.value
                                        if(start && end){
                                            let s=new Date(start)
                                            let e=new Date(end)
                                            let diff=Math.floor((e-s)/(1000*60*60*24))+1
                                            $refs.jumlah_ctg_default.value=diff>0?diff:''
                                        }
                                    "
                                    name="ctg[0][tarikh_hingga_ctg]"
                                    class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text"
                                    x-ref="jumlah_ctg_default"
                                    readonly
                                    name="ctg[0][jumlah_ctg]"
                                    class="border px-2 py-1 w-full rounded-md bg-gray-100">
                        </td>
                        <td class="border px-4 py-2">
                            <textarea name="ctg[0][justifikasi_ctg]" rows="2" class="border px-2 py-1 w-full rounded-md"></textarea>
                        </td>
                        <td class="border px-4 py-2">
                            <select name="ctg[0][kategori_ctg]" class="border px-2 py-1 w-full rounded-md">
                                    <option value="">Pilih</option>
                                    <option>Menemani/ melawat suami/isteri (warganegara) bertugas di luar negeri</option>
                                    <option>Menemani/ melawat suami/isteri (bukan warganegara) bertugas di luar negeri</option>
                                    <option>Menemani suami / isteri / anak melanjutkan pelajaran / kursus / mesyuarat / pertandingan di luar negara</option>
                                    <option>Menghadiri Majlis Konvokesyen / Graduasi di luar negeri</option>
                                    <option>Menghadiri majlis perkahwinan  di luar negeri</option>
                                    <option>Menjaga anak kerana ketiadaan pembantu rumah / mengurus persekolahan anak</option>
                                    <option>Urusan peribadi / keluarga</option>
                                    <option>Meziarahi keluarga  kembali kerahmatullah / sakit / sakit tenat di luar negeri</option>
                                    <option>Menemani / menjaga ahli keluarga sakit di hospital / rumah</option>
                                    <option>Menemani pesakit / mendapatkan rawatan / perjanjian doktor di luar negeri</option>
                                    <option>Masalah kesihatan</option>
                                    <option>Mengikuti kursus / pertandingan atas perbelanjaan sendiri / sponsor</option>
                                    <option>Menunaikan  haji atas perbelanjaan sendiri / umrah</option>
                                    <option>Menunggu proses menamatkan perkhidmatan</option>
                                    <option>CSDS berlebihan semasa penggal persekolahan / baki cuti tidak mencukupi</option>
                            </select>
                        </td>
                        <td class="border px-4 py-2">
                            <textarea name="ctg[0][status_ctg]" rows="2" class="border px-2 py-1 w-full rounded-md"></textarea>
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" name="ctg[0][tarikh_melapor_ctg]" class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @endforelse
                    
                    {{-- Dynamic rows will be added here --}}
                    <template x-for="(row, index) in ctgRows" :key="row.id">
                        <tr>
                            <td class="border px-4 py-2">
                                <input type="date" x-model="row.start" @change="calc(row)" :name="'ctg[' + ({{ $teacher->cutiRecords->count() }} + index) + '][tarikh_mula_ctg]'" class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" x-model="row.end" @change="calc(row)" :name="'ctg[' + ({{ $teacher->cutiRecords->count() }} + index) + '][tarikh_hingga_ctg]'" class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                            <input type="text" x-model="row.jumlah" readonly :name="'ctg[' + ({{ $teacher->cutiRecords->count() }} + index) + '][jumlah_ctg]'" class="border px-2 py-1 w-full rounded-md bg-gray-100">
                            </td>
                            <td class="border px-4 py-2">
                                <textarea x-model="row.justifikasi" :name="'ctg[' + ({{ $teacher->cutiRecords->count() }} + index) + '][justifikasi_ctg]'" rows="2" class="border px-2 py-1 w-full rounded-md"></textarea>
                            </td>
                            <td class="border px-4 py-2">
                                <select x-model="row.kategori" :name="'ctg[' + ({{ $teacher->cutiRecords->count() }} + index) + '][kategori_ctg]'" class="border px-2 py-1 w-full rounded-md">
                                    <option value="">Pilih</option>
                                    <option>Menemani/ melawat suami/isteri (warganegara) bertugas di luar negeri</option>
                                    <option>Menemani/ melawat suami/isteri (bukan warganegara) bertugas di luar negeri</option>
                                    <option>Menemani suami / isteri / anak melanjutkan pelajaran / kursus / mesyuarat / pertandingan di luar negara</option>
                                    <option>Menghadiri Majlis Konvokesyen / Graduasi di luar negeri</option>
                                    <option>Menghadiri majlis perkahwinan  di luar negeri</option>
                                    <option>Menjaga anak kerana ketiadaan pembantu rumah / mengurus persekolahan anak</option>
                                    <option>Urusan peribadi / keluarga</option>
                                    <option>Meziarahi keluarga  kembali kerahmatullah / sakit / sakit tenat di luar negeri</option>
                                    <option>Menemani / menjaga ahli keluarga sakit di hospital / rumah</option>
                                    <option>Menemani pesakit / mendapatkan rawatan / perjanjian doktor di luar negeri</option>
                                    <option>Masalah kesihatan</option>
                                    <option>Mengikuti kursus / pertandingan atas perbelanjaan sendiri / sponsor</option>
                                    <option>Menunaikan  haji atas perbelanjaan sendiri / umrah</option>
                                    <option>Menunggu proses menamatkan perkhidmatan</option>
                                    <option>CSDS berlebihan semasa penggal persekolahan / baki cuti tidak mencukupi</option>
                                </select>
                            </td>
                            <td class="border px-4 py-2">
                                <textarea x-model="row.status" :name="'ctg[' + ({{ $teacher->cutiRecords->count() }} + index) + '][status_ctg]'" rows="2" class="border px-2 py-1 w-full rounded-md"></textarea>
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" :name="'ctg[' + ({{ $teacher->cutiRecords->count() }} + index) + '][tarikh_melapor_ctg]'" class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button type="button" 
                                        @click="removeCtg(index)" 
                                        class="text-red-600 font-bold hover:underline">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <button type="button" 
                    @click="addCtg()" 
                    class="mt-3 px-5 py-2 rounded-md hover:bg-green-700 transition text-white font-medium" 
                    style="background-color:#10B981;">
                Tambah Baris
            </button>
            
            {{-- Debug info --}}
            <p class="mt-2 text-xs text-gray-500" x-text="'New rows: ' + ctgRows.length"></p>
            </div>
        </div>
        

        {{-- Buffer for button --}}
        <div class="mb-20"></div>

        {{-- SUBMIT BUTTON --}}
        <div class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Cuti</p>
            </button>
        </div>
        
    </form>
    
</div>

{{-- 6. Penyambungan Tab --}}
<div x-cloak x-show="activeTab === 6" class="tab-content-wrapper">

    <form action="{{ route('pj.savePenyambungan', $teacher->{'No Kad Pintar'}) }}" method="POST">
        @csrf
        @method('PUT')

        
        {{-- Section Title --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800">Penyambungan</h3>
            <p class="text-sm text-gray-500 mt-1">Kemaskini maklumat penyambungan perkhidmatan</p>
        </div>

        {{-- Matrix Table for Penyambungan --}}
        <div class="overflow-x-auto border-2 border-gray-300 rounded-lg p-4 shadow-sm bg-gray-100" 
             x-data="{ 
                newRows: [],
                addRow() { 
                    this.newRows.push({}); 
                    console.log('Added row, total:', this.newRows.length);
                },
                removeNewRow(index) { 
                    this.newRows.splice(index, 1); 
                }
             }">
            
            <p class="text-red-600 font-semibold mb-4 text-lg">Penyambungan Subform</p>
            
            <table class="min-w-full border border-gray-300 bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left">Tarikh Mula</th>
                        <th class="border px-4 py-2 text-left">Tarikh Hingga</th>
                        <th class="border px-4 py-2 text-left">Lain-lain</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Load existing records from database --}}
                    @forelse($teacher->penyambunganRecords as $index => $record)
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="penyambungan[{{ $index }}][tarikh_mula]"
                                   value="{{ $record->tarikh_mula ? $record->tarikh_mula->format('Y-m-d') : '' }}"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="penyambungan[{{ $index }}][tarikh_hingga]"
                                   value="{{ $record->tarikh_hingga ? $record->tarikh_hingga->format('Y-m-d') : '' }}"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="penyambungan[{{ $index }}][lain]"
                                   value="{{ $record->lain }}"
                                   placeholder="Lain-lain"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                    {{-- Default empty row if no records --}}
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="penyambungan[0][tarikh_mula]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="penyambungan[0][tarikh_hingga]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="penyambungan[0][lain]"
                                   placeholder="Lain-lain"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @endforelse
                    
                    {{-- Dynamic rows will be added here --}}
                    <template x-for="(row, index) in newRows" :key="index">
                        <tr>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-bind:name="'penyambungan[' + ({{ $teacher->penyambunganRecords->count() }} + index) + '][tarikh_mula]'"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-bind:name="'penyambungan[' + ({{ $teacher->penyambunganRecords->count() }} + index) + '][tarikh_hingga]'"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'penyambungan[' + ({{ $teacher->penyambunganRecords->count() }} + index) + '][lain]'"
                                       placeholder="Lain-lain"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button type="button" 
                                        @click="removeNewRow(index)" 
                                        class="text-red-600 font-bold hover:underline">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <button type="button" 
                    @click="addRow()" 
                    class="mt-3 px-5 py-2 rounded-md hover:bg-green-700 transition text-white font-medium" 
                    style="background-color:#10B981;">
                Tambah Baris
            </button>
            
            {{-- Debug info --}}
            <p class="mt-2 text-xs text-gray-500" x-text="'New rows: ' + newRows.length"></p>
        </div>

        {{-- Buffer for button --}}
        <div class="mb-20"></div>

        {{-- Fixed Submit Button --}}
        <div class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Penyambungan</p>
            </button>
        </div>
    </form>
</div>

{{-- 7. Penempatan Bertugas --}}
<div x-cloak x-show="activeTab === 7" class="tab-content-wrapper">

    <form action="{{ route('pj.saveTempatBertugas', $teacher->{'No Kad Pintar'}) }}" method="POST">
        @csrf
        @method('PUT')


        {{-- Section Title --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800">Penempatan Bertugas</h3>
            <p class="text-sm text-gray-500 mt-1">Kemaskini maklumat tempat bertugas</p>
        </div>

        {{-- Maklumat Tempat Bertugas --}}
        <div class="w-full border-2 border-gray-400 rounded-md bg-gray-50 p-6 shadow-sm relative mb-6">
            
            <h2 class="text-black-700 font-bold text-sm md:text-base mb-4 -mt-8 inline-block bg-gray-50 px-2">
                Maklumat Tempat Bertugas
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <!-- Jenis Tempat Bertugas -->
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-gray-800 mb-2">Jenis Tempat Bertugas</label>
                    <input type="text" name="jenis_tempat_bertugas"
                           value="{{ $teacher->{'Jenis Sekolah Tempat Bertugas'} ?? '' }}"
                           class="px-4 py-2 border rounded-md w-full placeholder:text-gray-400
                                  focus:outline-none focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
                </div>

                <!-- Daerah -->
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-gray-800 mb-2">Daerah</label>
                    <input type="text" name="daerah"
                           value="{{ $teacher->{'Daerah'} ?? '' }}"
                           class="px-4 py-2 border rounded-md w-full placeholder:text-gray-400
                                  focus:outline-none focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
                </div>

                <!-- Jawatan -->
                <div class="flex flex-col lg:col-span-2">
                    <label class="text-sm font-semibold text-gray-800 mb-2">Jawatan</label>
                    <input type="text" name="jawatan_sekolah"
                           value="{{ $teacher->{'Jawatan disekolah'} ?? '' }}"
                           class="px-4 py-2 border rounded-md w-full placeholder:text-gray-400
                                  focus:outline-none focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
                </div>
            </div>
        </div>

        {{-- Tempat Bertugas Sekarang Table --}}
        <div class="overflow-x-auto border-2 border-gray-300 rounded-lg p-4 shadow-sm bg-gray-100" 
             x-data="{ 
                newRows: [],
                addRow() { 
                    this.newRows.push({}); 
                },
                removeNewRow(index) { 
                    this.newRows.splice(index, 1); 
                }
             }">
            
            <p class="text-red-600 font-semibold mb-4 text-lg">Tempat Bertugas Sekarang</p>
            
            <table class="min-w-full border border-gray-300 bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left">Tarikh Mula</th>
                        <th class="border px-4 py-2 text-left">Tempat Bertugas</th>
                        <th class="border px-4 py-2 text-left">Tarikh Hingga</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Load existing records from database --}}
                    @forelse($teacher->tempatBertugasRecords as $index => $record)
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="tempat_bertugas_records[{{ $index }}][tarikh_mula]"
                                   value="{{ $record->tarikh_mula ? $record->tarikh_mula->format('Y-m-d') : '' }}"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="tempat_bertugas_records[{{ $index }}][tempat_bertugas]"
                                   value="{{ $record->tempat_bertugas }}"
                                   placeholder="Tempat Bertugas"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="tempat_bertugas_records[{{ $index }}][tarikh_hingga]"
                                   value="{{ $record->tarikh_hingga ? $record->tarikh_hingga->format('Y-m-d') : '' }}"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                    {{-- Default empty row if no records --}}
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="tempat_bertugas_records[0][tarikh_mula]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="tempat_bertugas_records[0][tempat_bertugas]"
                                   placeholder="Tempat Bertugas"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="tempat_bertugas_records[0][tarikh_hingga]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @endforelse
                    
                    {{-- Dynamic rows --}}
                    <template x-for="(row, index) in newRows" :key="index">
                        <tr>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-bind:name="'tempat_bertugas_records[' + ({{ $teacher->tempatBertugasRecords->count() }} + index) + '][tarikh_mula]'"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'tempat_bertugas_records[' + ({{ $teacher->tempatBertugasRecords->count() }} + index) + '][tempat_bertugas]'"
                                       placeholder="Tempat Bertugas"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-bind:name="'tempat_bertugas_records[' + ({{ $teacher->tempatBertugasRecords->count() }} + index) + '][tarikh_hingga]'"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button type="button" 
                                        @click="removeNewRow(index)" 
                                        class="text-red-600 font-bold hover:underline">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <button type="button" 
                    @click="addRow()" 
                    class="mt-3 px-5 py-2 rounded-md hover:bg-green-700 transition text-white font-medium" 
                    style="background-color:#10B981;">
                Tambah Baris
            </button>
            
            <p class="mt-2 text-xs text-gray-500" x-text="'New rows: ' + newRows.length"></p>
        </div>

        {{-- Buffer for button --}}
        <div class="mb-20"></div>

        {{-- Fixed Submit Button --}}
        <div class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Penempatan Bertugas</p>
            </button>
        </div>
    </form>
</div>

{{-- 8. Kursus --}}
<div x-cloak x-show="activeTab === 8" class="tab-content-wrapper">

    <form action="{{ route('pj.saveKursus', $teacher->{'No Kad Pintar'}) }}" method="POST">
        @csrf
        @method('PUT')


        {{-- Section Title --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800">Kursus</h3>
            <p class="text-sm text-gray-500 mt-1">Kemaskini maklumat program kursus dan latihan</p>
        </div>

        {{-- Maklumat Program Latihan Jangka Pendek --}}
        @php
        $pendekCount = $teacher->kursusRecords->whereNotNull('nama_kursus')->count();
        @endphp
        <div class="overflow-x-auto border-2 border-gray-300 rounded-lg p-4 shadow-sm bg-gray-100" 
                x-data="{ 
                pendekRows: [],
                addPendek() { 
                    this.pendekRows.push({ id: Date.now() + Math.random() });  
                },
                removePendek(index) { 
                    this.pendekRows.splice(index, 1); 
                }
            }">
            
            <p class="text-red-600 font-semibold mb-4 text-lg">Program Latihan Jangka Pendek</p>

            <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left">Nama Kursus</th>
                        <th class="border px-4 py-2 text-left">Nama Penganjur/Institusi</th>
                        <th class="border px-4 py-2 text-left">Negeri</th>
                        <th class="border px-4 py-2 text-left">Tarikh Mula</th>
                        <th class="border px-4 py-2 text-left">Tarikh Hingga</th>
                        <th class="border px-4 py-2 text-left">Mod Latihan</th>
                        <th class="border px-4 py-2 text-left">Kaedah Peruntukan</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Load existing records from database --}}
                    @forelse($teacher->kursusRecords->whereNotNull('nama_kursus') as $index => $record)
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_pendek_records[{{ $index }}][nama_kursus]"
                                   value="{{ $record->nama_kursus }}"
                                   placeholder="Nama Kursus"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_pendek_records[{{ $index }}][nama_penganjur]"
                                   value="{{ $record->nama_penganjur }}"
                                   placeholder="Nama Penganjur/Institusi"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_pendek_records[{{ $index }}][negeri]"
                                   value="{{ $record->negeri }}"
                                   placeholder="Negeri"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="kursus_pendek_records[{{ $index }}][tarikh_mula_pendek]"
                                   value="{{ $record->tarikh_mula_pendek ? $record->tarikh_mula_pendek->format('Y-m-d') : '' }}"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="kursus_pendek_records[{{ $index }}][tarikh_hingga_pendek]"
                                   value="{{ $record->tarikh_hingga_pendek ? $record->tarikh_hingga_pendek->format('Y-m-d') : '' }}"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <select name="kursus_pendek_records[{{ $index }}][mod_latihan]"
                                    class="border px-2 py-1 w-full rounded-md">

                                <option value="">Pilih</option>

                                <option value="Bersemuka"
                                {{ $record->mod_latihan == 'Bersemuka' ? 'selected' : '' }}>
                                Bersemuka
                                </option>

                                <option value="Online"
                                {{ $record->mod_latihan == 'Online' ? 'selected' : '' }}>
                                Online
                                </option>

                            </select>
                        </td>
                        <td class="border px-4 py-2">
                            <select name="kursus_pendek_records[{{ $index }}][kaedah_peruntukan]"
                                    class="border px-2 py-1 w-full rounded-md">

                                <option value="">Pilih</option>

                                <option value="Peruntukan jabatan"
                                {{ $record->kaedah_peruntukan == 'Peruntukan jabatan' ? 'selected' : '' }}>
                                Peruntukan jabatan
                                </option>

                                <option value="Percuma"
                                {{ $record->kaedah_peruntukan == 'Percuma' ? 'selected' : '' }}>
                                Percuma
                                </option>

                                <option value="Ditaja oleh penganjur"
                                {{ $record->kaedah_peruntukan == 'Ditaja oleh penganjur' ? 'selected' : '' }}>
                                Ditaja oleh penganjur
                                </option>

                            </select>
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                    {{-- Default empty row if no records --}}
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_pendek_records[0][nama_kursus]"
                                   placeholder="Nama Kursus"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_pendek_records[0][nama_penganjur]"
                                   placeholder="Nama Penganjur/Institusi"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_pendek_records[0][negeri]"
                                   placeholder="Negeri"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="kursus_pendek_records[0][tarikh_mula_pendek]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="kursus_pendek_records[0][tarikh_hingga_pendek]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <select name="kursus_pendek_records[0][mod_latihan]"
                                    class="border px-2 py-1 w-full rounded-md">

                                <option value="">Pilih</option>
                                <option value="Bersemuka">Bersemuka</option>
                                <option value="Online">Online</option>

                            </select>
                        </td>

                        <td class="border px-4 py-2">
                            <select name="kursus_pendek_records[0][kaedah_peruntukan]"
                                    class="border px-2 py-1 w-full rounded-md">

                                <option value="">Pilih</option>
                                <option value="Peruntukan jabatan">Peruntukan jabatan</option>
                                <option value="Percuma">Percuma</option>
                                <option value="Ditaja oleh penganjur">Ditaja oleh penganjur</option>

                            </select>
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @endforelse
                    
                    {{-- Dynamic rows --}}
                    <template x-for="(row, index) in pendekRows" :key="row.id">
                        <tr>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'kursus_pendek_records[' + ({{ $pendekCount }} + index) + '][nama_kursus]'"
                                       placeholder="Nama Kursus"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'kursus_pendek_records[' + ({{ $pendekCount }} + index) + '][nama_penganjur]'"
                                       placeholder="Nama Penganjur/Institusi"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'kursus_pendek_records[' + ({{ $pendekCount }} + index) + '][negeri]'"
                                       placeholder="Negeri"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-bind:name="'kursus_pendek_records[' + ({{ $pendekCount }} + index) + '][tarikh_mula_pendek]'"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-bind:name="'kursus_pendek_records[' + ({{ $pendekCount }} + index) + '][tarikh_hingga_pendek]'"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <select 
                                    x-bind:name="'kursus_pendek_records[' + ({{ $pendekCount }} + index) + '][mod_latihan]'"
                                    class="border px-2 py-1 w-full rounded-md">

                                    <option value="">Pilih Mod Latihan</option>
                                    <option value="Bersemuka">Bersemuka</option>
                                    <option value="Online">Online</option>

                                </select>
                            </td>

                            <td class="border px-4 py-2">
                                <select 
                                    x-bind:name="'kursus_pendek_records[' + ({{ $pendekCount }} + index) + '][kaedah_peruntukan]'"
                                    class="border px-2 py-1 w-full rounded-md">

                                    <option value="">Pilih Kaedah Peruntukan</option>
                                    <option value="Peruntukan jabatan">Peruntukan jabatan</option>
                                    <option value="Percuma">Percuma</option>
                                    <option value="Ditaja oleh penganjur">Ditaja oleh penganjur</option>

                                </select>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button type="button" 
                                        @click="removePendek(index)"
                                        class="text-red-600 font-bold hover:underline">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <button type="button" 
                    @click="addPendek()"
                    class="mt-3 px-5 py-2 rounded-md hover:bg-green-700 transition text-white font-medium" 
                    style="background-color:#10B981;">
                Tambah Kursus
            </button>
            
            <p class="mt-2 text-xs text-gray-500" x-text="'New rows: ' + pendekRows.length"></p>
            </div>
        </div>
        <br>

        {{-- Maklumat Program Latihan Jangka Panjang --}}
        @php
        $panjangCount = $teacher->kursusRecords->whereNotNull('peringkat')->count();
        @endphp
        <div class="overflow-x-auto border-2 border-gray-300 rounded-lg p-4 shadow-sm bg-gray-100" 
                    x-data="{ 
                    panjangRows: [],
                    addPanjang() { 
                         this.panjangRows.push({ id: Date.now() + Math.random() });
                    },
                    removePanjang(index) { 
                        this.panjangRows.splice(index, 1); 
                    }
                }">
            
            <p class="text-red-600 font-semibold mb-4 text-lg">Program Latihan Jangka Panjang</p>

            <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left">Peringkat</th>
                        <th class="border px-4 py-2 text-left">Bidang/Pengkhususan</th>
                        <th class="border px-4 py-2 text-left">Nama Institusi</th>
                        <th class="border px-4 py-2 text-left">Tarikh Mula</th>
                        <th class="border px-4 py-2 text-left">Tarikh Hingga</th>
                        <th class="border px-4 py-2 text-left">Jenis LDP</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Load existing records from database --}}
                    @forelse($teacher->kursusRecords->whereNotNull('peringkat') as $index => $record)
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_panjang_records[{{ $index }}][peringkat]"
                                   value="{{ $record->peringkat }}"
                                   placeholder="Peringkat"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_panjang_records[{{ $index }}][bidang]"
                                   value="{{ $record->bidang }}"
                                   placeholder="Bidang/Pengkhususan"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_panjang_records[{{ $index }}][nama_institusi]"
                                   value="{{ $record->nama_institusi }}"
                                   placeholder="Nama Institusi"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="kursus_panjang_records[{{ $index }}][tarikh_mula_panjang]"
                                   value="{{ $record->tarikh_mula_panjang ? $record->tarikh_mula_panjang->format('Y-m-d') : '' }}"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="kursus_panjang_records[{{ $index }}][tarikh_hingga_panjang]"
                                   value="{{ $record->tarikh_hingga_panjang ? $record->tarikh_hingga_panjang->format('Y-m-d') : '' }}"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <select name="kursus_panjang_records[{{ $index }}][jenis_ldp]"
                                    class="border px-2 py-1 w-full rounded-md">

                                <option value="">Pilih</option>

                                <option value="Sepenuh Masa"
                                {{ $record->jenis_ldp == 'Sepenuh Masa' ? 'selected' : '' }}>
                                Sepenuh Masa
                                </option>

                                <option value="Separuh Masa"
                                {{ $record->jenis_ldp == 'Separuh Masa' ? 'selected' : '' }}>
                                Separuh Masa
                                </option>

                                <option value="Separuh Masa dengan Kemudahan"
                                {{ $record->jenis_ldp == 'Separuh Masa dengan Kemudahan' ? 'selected' : '' }}>
                                Separuh Masa dengan Kemudahan
                                </option>

                                <option value="Biayai Sendiri"
                                {{ $record->jenis_ldp == 'Biayai Sendiri' ? 'selected' : '' }}>
                                Biayai Sendiri
                                </option>

                            </select>
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                    {{-- Default empty row if no records --}}
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_panjang_records[0][peringkat]"
                                   placeholder="Peringkat"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_panjang_records[0][bidang]"
                                   placeholder="Bidang/Pengkhususan"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_panjang_records[0][nama_institusi]"
                                   placeholder="Nama Institusi"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="kursus_panjang_records[0][tarikh_mula_panjang]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="kursus_panjang_records[0][tarikh_hingga_panjang]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <select name="kursus_panjang_records[0][jenis_ldp]"
                                    class="border px-2 py-1 w-full rounded-md">

                                <option value="">Pilih</option>
                                <option value="Sepenuh Masa">Sepenuh Masa</option>
                                <option value="Separuh Masa">Separuh Masa</option>
                                <option value="Separuh Masa dengan Kemudahan">Separuh Masa dengan Kemudahan</option>
                                <option value="Biayai Sendiri">Biayai Sendiri</option>

                            </select>
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @endforelse
                    
                    {{-- Dynamic rows --}}
                    <template x-for="(row, index) in panjangRows" :key="row.id">
                        <tr>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'kursus_panjang_records[' + ({{ $panjangCount }} + index) + '][peringkat]'"
                                       placeholder="Peringkat"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'kursus_panjang_records[' + ({{ $panjangCount }} + index) + '][bidang]'"
                                       placeholder="Bidang/Pengkhususan"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'kursus_panjang_records[' + ({{ $panjangCount }} + index) + '][nama_institusi]'"
                                       placeholder="Nama Institusi"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-bind:name="'kursus_panjang_records[' + ({{ $panjangCount }} + index) + '][tarikh_mula_panjang]'"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-bind:name="'kursus_panjang_records[' + ({{ $panjangCount }} + index) + '][tarikh_hingga_panjang]'"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <select
                                    x-bind:name="'kursus_panjang_records[' + ({{ $panjangCount }} + index) + '][jenis_ldp]'"
                                    class="border px-2 py-1 w-full rounded-md">

                                    <option value="">Pilih</option>
                                    <option value="Sepenuh Masa">Sepenuh Masa</option>
                                    <option value="Separuh Masa">Separuh Masa</option>
                                    <option value="Separuh Masa dengan Kemudahan">Separuh Masa dengan Kemudahan</option>
                                    <option value="Biayai Sendiri">Biayai Sendiri</option>

                                </select>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button type="button" 
                                        @click="removePanjang(index)" 
                                        class="text-red-600 font-bold hover:underline">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <button type="button" 
                    @click="addPanjang()" 
                    class="mt-3 px-5 py-2 rounded-md hover:bg-green-700 transition text-white font-medium" 
                    style="background-color:#10B981;">
                Tambah Kursus
            </button>
            
            <p class="mt-2 text-xs text-gray-500" x-text="'New rows: ' + panjangRows.length"></p>
            </div>
        </div>
        <br>

        {{-- Maklumat Program Mentoring --}}
        @php
        $mentoringCount = $teacher->kursusRecords->whereNotNull('nama_mentor')->count();
        @endphp
        <div class="overflow-x-auto border-2 border-gray-300 rounded-lg p-4 shadow-sm bg-gray-100" 
                x-data="{ 
                mentoringRows: [],
                addMentoring() { 
                    this.mentoringRows.push({ id: Date.now() + Math.random() }); 
                },
                removeMentoring(index) { 
                    this.mentoringRows.splice(index, 1); 
                }
            }">
            
            <p class="text-red-600 font-semibold mb-4 text-lg">Program Mentoring</p>

            <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left">Nama Mentor</th>
                        <th class="border px-4 py-2 text-left">Nama Sekolah</th>
                        <th class="border px-4 py-2 text-left">Tarikh Mula</th>
                        <th class="border px-4 py-2 text-left">Tarikh Hingga</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Load existing records from database --}}
                    @forelse($teacher->kursusRecords->whereNotNull('nama_mentor') as $index => $record)
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_mentoring_records[{{ $index }}][nama_mentor]"
                                   value="{{ $record->nama_mentor }}"
                                   placeholder="Nama Mentor"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_mentoring_records[{{ $index }}][nama_sekolah]"
                                   value="{{ $record->nama_sekolah }}"
                                   placeholder="Nama Sekolah"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="kursus_mentoring_records[{{ $index }}][tarikh_mula_mentoring]"
                                   value="{{ $record->tarikh_mula_mentoring ? $record->tarikh_mula_mentoring->format('Y-m-d') : '' }}"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="kursus_mentoring_records[{{ $index }}][tarikh_hingga_mentoring]"
                                   value="{{ $record->tarikh_hingga_mentoring ? $record->tarikh_hingga_mentoring->format('Y-m-d') : '' }}"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                    {{-- Default empty row if no records --}}
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_mentoring_records[0][nama_mentor]"
                                   placeholder="Nama Mentor"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_mentoring_records[0][nama_sekolah]"
                                   placeholder="Nama Sekolah"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="kursus_mentoring_records[0][tarikh_mula_mentoring]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="kursus_mentoring_records[0][tarikh_hingga_mentoring]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @endforelse
                    
                    {{-- Dynamic rows --}}
                    <template x-for="(row, index) in mentoringRows" :key="row.id">
                        <tr>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'kursus_mentoring_records[' + ({{ $mentoringCount }} + index) + '][nama_mentor]'"
                                       placeholder="Nama Mentor"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'kursus_mentoring_records[' + ({{ $mentoringCount }} + index) + '][nama_sekolah]'"
                                       placeholder="Nama Sekolah"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-bind:name="'kursus_mentoring_records[' + ({{ $mentoringCount }} + index) + '][tarikh_mula_mentoring]'"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-bind:name="'kursus_mentoring_records[' + ({{ $mentoringCount }} + index) + '][tarikh_hingga_mentoring]'"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button type="button" 
                                        @click="removeMentoring(index)" 
                                        class="text-red-600 font-bold hover:underline">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <button type="button" 
                    @click="addMentoring()" 
                    class="mt-3 px-5 py-2 rounded-md hover:bg-green-700 transition text-white font-medium" 
                    style="background-color:#10B981;">
                Tambah Kursus
            </button>
            
            <p class="mt-2 text-xs text-gray-500" x-text="'New rows: ' + mentoringRows.length"></p>
            </div>
        </div>
        <br>

        {{-- Maklumat Program Latihan Kepimpinan --}}
        @php
        $kepimpinanCount = $teacher->kursusRecords->whereNotNull('siri')->count();
        @endphp
        <div class="overflow-x-auto border-2 border-gray-300 rounded-lg p-4 shadow-sm bg-gray-100" 
                    x-data="{ 
                    kepimpinanRows: [],
                    addKepimpinan() { 
                        this.kepimpinanRows.push({ id: Date.now() + Math.random() }); 
                    },
                    removeKepimpinan(index) { 
                        this.kepimpinanRows.splice(index, 1); 
                    }
                }">
            
            <p class="text-red-600 font-semibold mb-4 text-lg">Program Latihan Kepimpinan</p>

            <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left">Siri</th>
                        <th class="border px-4 py-2 text-left">Modul</th>
                        <th class="border px-4 py-2 text-left">Tarikh</th>
                        <th class="border px-4 py-2 text-left">Sesi</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Load existing records from database --}}
                    @forelse($teacher->kursusRecords->whereNotNull('siri') as $index => $record)
                    <tr>
                        <td class="border px-4 py-2">
                            <select name="kursus_latihan_records[{{ $index }}][siri]"
                                    class="border px-2 py-1 w-full rounded-md">
                                <option value="">Pilih</option>
                                <option value="Modular" {{ $record->siri == 'Modular' ? 'selected' : '' }}>Modular</option>
                                <option value="Bespoke" {{ $record->siri == 'Bespoke' ? 'selected' : '' }}>Bespoke</option>
                                <option value="Toolbox" {{ $record->siri == 'Toolbox' ? 'selected' : '' }}>Toolbox</option>
                                <option value="Signature" {{ $record->siri == 'Signature' ? 'selected' : '' }}>Signature</option>
                            </select>
                        </td>

                        <td class="border px-4 py-2">
                            <select name="kursus_latihan_records[{{ $index }}][modul]"
                                    class="border px-2 py-1 w-full rounded-md">
                                <option value="">Pilih</option>
                                @foreach([
                                    'CE101 Global Citizenship',
                                    'CM103 Project Management',
                                    'CM301 Change Management',
                                    'CO202 Speaking to Persuade',
                                    'DL202 Data Visualisation and Presentation',
                                    'DM302 Dynamic Decision Making Group 1',
                                    'DM302 Dynamic Decision Making Group 2',
                                    'HRM301 Human Resource Management',
                                    'IL101 Instructional Practices',
                                    'IL102 Classroom Assessment Practices',
                                    'IL105 Unpacking & Repacking Curriculum using TPACK',
                                    'IL113 Effective Use Of Student Assessment Data',
                                    'IL402 Using Data to Make Instructional Decision and Actions',
                                    'IL403 Growth Through Evaluations',
                                    'IL404 Leading Data-Driven Schools in a VUCA World',
                                    'NC201 Negotiation for Win-Win Outcome',
                                    'PHASE 1 ASEAN EDUCATION WORKPLAN 2025',
                                    'SP101 Introduction to Strategic Planning',
                                    'SP102 Key Performance Indicators and Critical Issue',
                                    'TB301 From Prompt to Practice: Gen AI For Leaders',
                                    'TB302 Thinking with GenAI: Exploring Gemini and NotebookLM',
                                    'TIER 1 SIGNATURE 2025',
                                    'TIER 3 SIGNATURE 2026',
                                    'VI101 Personal Mastery'
                                ] as $modul)
                                    <option value="{{ $modul }}" {{ $record->modul == $modul ? 'selected' : '' }}>
                                        {{ $modul }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="kursus_latihan_records[{{ $index }}][tarikh]"
                                   value="{{ $record->tarikh ? $record->tarikh->format('Y-m-d') : '' }}"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_latihan_records[{{ $index }}][sesi]"
                                   value="{{ $record->sesi }}"
                                   placeholder="Sesi"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                    {{-- Default empty row if no records --}}
                    <tr>
                        <td class="border px-4 py-2">
                            <select name="kursus_latihan_records[0][siri]" class="border px-2 py-1 w-full rounded-md">
                                <option value="">Pilih</option>
                                <option value="Modular">Modular</option>
                                <option value="Bespoke">Bespoke</option>
                                <option value="Toolbox">Toolbox</option>
                                <option value="Signature">Signature</option>
                            </select>
                        </td>

                        <td class="border px-4 py-2">
                            <select name="kursus_latihan_records[0][modul]" class="border px-2 py-1 w-full rounded-md">
                                <option value="">Pilih</option>
                                @foreach([
                                    'CE101 Global Citizenship',
                                    'CM103 Project Management',
                                    'CM301 Change Management',
                                    'CO202 Speaking to Persuade',
                                    'DL202 Data Visualisation and Presentation',
                                    'DM302 Dynamic Decision Making Group 1',
                                    'DM302 Dynamic Decision Making Group 2',
                                    'HRM301 Human Resource Management',
                                    'IL101 Instructional Practices',
                                    'IL102 Classroom Assessment Practices',
                                    'IL105 Unpacking & Repacking Curriculum using TPACK',
                                    'IL113 Effective Use Of Student Assessment Data',
                                    'IL402 Using Data to Make Instructional Decision and Actions',
                                    'IL403 Growth Through Evaluations',
                                    'IL404 Leading Data-Driven Schools in a VUCA World',
                                    'NC201 Negotiation for Win-Win Outcome',
                                    'PHASE 1 ASEAN EDUCATION WORKPLAN 2025',
                                    'SP101 Introduction to Strategic Planning',
                                    'SP102 Key Performance Indicators and Critical Issue',
                                    'TB301 From Prompt to Practice: Gen AI For Leaders',
                                    'TB302 Thinking with GenAI: Exploring Gemini and NotebookLM',
                                    'TIER 1 SIGNATURE 2025',
                                    'TIER 3 SIGNATURE 2026',
                                    'VI101 Personal Mastery'
                                ] as $modul)
                                    <option value="{{ $modul }}">{{ $modul }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="kursus_latihan_records[0][tarikh]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="kursus_latihan_records[0][sesi]"
                                   placeholder="Sesi"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @endforelse
                    
                    {{-- Dynamic rows --}}
                    <template x-for="(row, index) in kepimpinanRows" :key="row.id">
                        <tr>
                            <td class="border px-4 py-2">
                                <select x-bind:name="'kursus_latihan_records[' + ({{ $kepimpinanCount }} + index) + '][siri]'"
                                        class="border px-2 py-1 w-full rounded-md">
                                    <option value="">Pilih</option>
                                    <option value="Modular">Modular</option>
                                    <option value="Bespoke">Bespoke</option>
                                    <option value="Toolbox">Toolbox</option>
                                    <option value="Signature">Signature</option>
                                </select>
                            </td>

                            <td class="border px-4 py-2">
                                <select x-bind:name="'kursus_latihan_records[' + ({{ $kepimpinanCount }} + index) + '][modul]'"
                                        class="border px-2 py-1 w-full rounded-md">
                                    <option value="">Pilih</option>
                                    @foreach([
                                        'CE101 Global Citizenship',
                                        'CM103 Project Management',
                                        'CM301 Change Management',
                                        'CO202 Speaking to Persuade',
                                        'DL202 Data Visualisation and Presentation',
                                        'DM302 Dynamic Decision Making Group 1',
                                        'DM302 Dynamic Decision Making Group 2',
                                        'HRM301 Human Resource Management',
                                        'IL101 Instructional Practices',
                                        'IL102 Classroom Assessment Practices',
                                        'IL105 Unpacking & Repacking Curriculum using TPACK',
                                        'IL113 Effective Use Of Student Assessment Data',
                                        'IL402 Using Data to Make Instructional Decision and Actions',
                                        'IL403 Growth Through Evaluations',
                                        'IL404 Leading Data-Driven Schools in a VUCA World',
                                        'NC201 Negotiation for Win-Win Outcome',
                                        'PHASE 1 ASEAN EDUCATION WORKPLAN 2025',
                                        'SP101 Introduction to Strategic Planning',
                                        'SP102 Key Performance Indicators and Critical Issue',
                                        'TB301 From Prompt to Practice: Gen AI For Leaders',
                                        'TB302 Thinking with GenAI: Exploring Gemini and NotebookLM',
                                        'TIER 1 SIGNATURE 2025',
                                        'TIER 3 SIGNATURE 2026',
                                        'VI101 Personal Mastery'
                                    ] as $modul)
                                        <option value="{{ $modul }}">{{ $modul }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-bind:name="'kursus_latihan_records[' + ({{ $kepimpinanCount }} + index) + '][tarikh]'"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'kursus_latihan_records[' + ({{ $kepimpinanCount }} + index) + '][sesi]'"
                                       placeholder="Sesi"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button type="button" 
                                        @click="removeKepimpinan(index)"
                                        class="text-red-600 font-bold hover:underline">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <button type="button" 
                    @click="addKepimpinan()" 
                    class="mt-3 px-5 py-2 rounded-md hover:bg-green-700 transition text-white font-medium" 
                    style="background-color:#10B981;">
                Tambah Kursus
            </button>
            
            <p class="mt-2 text-xs text-gray-500" x-text="'New rows: ' + kepimpinanRows.length"></p>
            </div>
        </div>
        <br>

        {{-- Buffer for button --}}
        <div class="mb-20"></div>

        {{-- Fixed Submit Button --}}
        <div class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Kursus</p>
            </button>
        </div>
    </form>
</div>

{{-- 9. Kelulusan --}}
<div x-cloak x-show="activeTab === 9" class="tab-content-wrapper">

    <form action="{{ route('pj.saveKelulusan', $teacher->{'No Kad Pintar'}) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Section Title --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800">Kelulusan</h3>
            <p class="text-sm text-gray-500 mt-1">Kemaskini maklumat kelulusan akademik</p>
        </div>

        {{-- Kelulusan Tertinggi Frame --}}
        <div class="relative w-full border-2 border-gray-400 rounded-md bg-gray-50 p-6 shadow-sm">

            {{-- Section Title --}}
            <h2 class="text-black-700 font-bold text-sm md:text-base mb-4 -mt-8 inline-block bg-gray-50 px-2">
                Maklumat Kelulusan
            </h2>

            <!-- Kelulusan Tertinggi -->
            <div class="flex flex-col mb-4">
                <label class="text-sm font-semibold text-gray-800 mb-2">Kelulusan Tertinggi</label>
                <input type="text"
                       name="kelulusanTertinggi"
                       placeholder="Kosong"
                       value="{{ old('kelulusanTertinggi', $teacher->{'Kelulusan Tertnggi'} ?? '') }}"
                       class="px-4 py-2 border rounded-md w-full placeholder:text-gray-400
                              focus:outline-none focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
            </div>

            <!-- Filter Kelulusan & Tarikh Lulus -->
            <div class="flex flex-col md:flex-row gap-4 mb-4">
                <!-- Filter Kelulusan -->
                <div class="flex flex-col w-full md:w-1/2">
                    <label class="text-sm font-semibold text-gray-800 mb-2">Filter Kelulusan</label>
                    <input type="text"
                           name="filterkelulusan"
                           placeholder="Kosong"
                           value="{{ old('filterkelulusan', $teacher->{'filterkelulusan'} ?? '') }}"
                           class="px-4 py-2 border rounded-md w-full placeholder:text-gray-400
                                  focus:outline-none focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
                </div>

                <!-- Tarikh Lulus -->
<div class="flex flex-col w-full md:w-1/2">
    <label class="text-sm font-semibold text-gray-800 mb-2">Tarikh Lulus</label>
    @php
        $tarikhLulusValue = '';
        if (old('tarikhLulus')) {
            $tarikhLulusValue = old('tarikhLulus');
        } elseif (!empty($teacher->{'tarikh lulus'})) {
            try {
                $tarikhLulusValue = \Carbon\Carbon::parse($teacher->{'tarikh lulus'})->format('Y-m-d');
            } catch (\Exception $e) {
                // If parsing fails, leave empty
                $tarikhLulusValue = '';
            }
        }
    @endphp
    <input type="date"
           name="tarikhLulus"
           value="{{ $tarikhLulusValue }}"
           class="px-4 py-2 border rounded-md w-full placeholder:text-gray-400
                  focus:outline-none focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
</div>
            </div>

            <!-- Sijil Guru -->
            <div class="flex flex-col mb-4">
                <label class="text-sm font-semibold text-gray-800 mb-2">Sijil Perguruan</label>
                <input type="text"
                       name="sijilGuru"
                       placeholder="Kosong"
                       value="{{ old('sijilGuru', $teacher->{'Sijil Guru'} ?? '') }}"
                       class="px-4 py-2 border rounded-md w-full placeholder:text-gray-400
                              focus:outline-none focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
                <!-- <input type="file" 
                       name="sijilGuruFile" 
                       class="mt-2 text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100" 
                       accept="image/*"> -->
            </div>

            <!-- Bidang & Mengajar -->
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Bidang -->
                <div class="flex flex-col w-full md:w-1/2">
                    <label class="text-sm font-semibold text-gray-800 mb-2">Bidang</label>
                    <input type="text"
                           name="bidang"
                           placeholder="Kosong"
                           value="{{ old('bidang', $teacher->{'Bidang'} ?? '') }}"
                           class="px-4 py-2 border rounded-md w-full placeholder:text-gray-400
                                  focus:outline-none focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
                </div>

                <!-- Mengajar -->
                <div class="flex flex-col w-full md:w-1/2">
                    <label class="text-sm font-semibold text-gray-800 mb-2">Mengajar</label>
                    <input type="text"
                           name="mengajar"
                           placeholder="Kosong"
                           value="{{ old('mengajar', $teacher->{'Mengajar'} ?? '') }}"
                           class="px-4 py-2 border rounded-md w-full placeholder:text-gray-400
                                  focus:outline-none focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
                </div>
            </div>
        </div>

        {{-- Buffer for button --}}
        <div class="mb-20"></div>

        {{-- Save Button --}}
        <div class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Kelulusan</p>
            </button>
        </div>
    </form>
</div>

{{-- 10. History Jawatan Tab --}}
<div x-cloak x-show="activeTab === 10" class="tab-content-wrapper">

    <form action="{{ route('pj.saveHistoryJawatan', $teacher->{'No Kad Pintar'}) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Section Title --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800">History Jawatan</h3>
            <p class="text-sm text-gray-500 mt-1">Kemaskini sejarah jawatan dan rujukan</p>
        </div>

        {{-- Rujukan SPG Section --}}
        <div class="relative border-2 border-gray-400 rounded-md bg-gray-50 p-6 shadow-sm mb-6">
            <h2 class="text-black-700 font-bold text-sm md:text-base mb-4 -mt-8 inline-block bg-gray-50 px-2">
                Rujukan SPG
            </h2>
            <div class="flex flex-col">
                <label class="text-sm font-semibold text-gray-800 mb-2">Ruj SPG</label>
                <input type="text" 
                       name="ruj_spg"
                       value="{{ old('ruj_spg', $teacher->{'Ruj Memo SPA SPG'} ?? '') }}"
                       placeholder="Kosong"
                       class="px-4 py-2 border rounded-md focus:outline-none w-full placeholder:text-gray-400
                              focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
            </div>
        </div>

        {{-- Sejarah Jawatan Table --}}
        <div class="overflow-x-auto border-2 border-gray-300 rounded-lg p-4 shadow-sm bg-gray-100" 
             x-data="{ 
                newRows: [],
                addRow() { 
                    this.newRows.push({}); 
                },
                removeNewRow(index) { 
                    this.newRows.splice(index, 1); 
                }
             }">
            
            <p class="text-red-600 font-semibold mb-4 text-lg">Sejarah Jawatan</p>
            
            <table class="min-w-full border border-gray-300 bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left">Jawatan</th>
                        <th class="border px-4 py-2 text-left">Tarikh Lantikan</th>
                        <th class="border px-4 py-2 text-left">Peruntukan</th>
                        <th class="border px-4 py-2 text-left">Tempat Bertugas</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Load existing records from database --}}
                    @forelse($teacher->sejarahJawatanRecords as $index => $record)
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="sejarah_jawatan[{{ $index }}][jawatan]"
                                   value="{{ $record->jawatan }}"
                                   placeholder="Jawatan"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="sejarah_jawatan[{{ $index }}][tarikh_lantikan]"
                                   value="{{ $record->tarikh_lantikan ? $record->tarikh_lantikan->format('Y-m-d') : '' }}"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="sejarah_jawatan[{{ $index }}][peruntukan]"
                                   value="{{ $record->peruntukan }}"
                                   placeholder="Peruntukan"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="sejarah_jawatan[{{ $index }}][tempat_bertugas]"
                                   value="{{ $record->tempat_bertugas }}"
                                   placeholder="Tempat Bertugas"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                    {{-- Default empty row if no records --}}
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="sejarah_jawatan[0][jawatan]"
                                   placeholder="Jawatan"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="sejarah_jawatan[0][tarikh_lantikan]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="sejarah_jawatan[0][peruntukan]"
                                   placeholder="Peruntukan"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="sejarah_jawatan[0][tempat_bertugas]"
                                   placeholder="Tempat Bertugas"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @endforelse
                    
                    {{-- Dynamic rows --}}
                    <template x-for="(row, index) in newRows" :key="index">
                        <tr>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'sejarah_jawatan[' + ({{ $teacher->sejarahJawatanRecords->count() }} + index) + '][jawatan]'"
                                       placeholder="Jawatan"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-bind:name="'sejarah_jawatan[' + ({{ $teacher->sejarahJawatanRecords->count() }} + index) + '][tarikh_lantikan]'"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'sejarah_jawatan[' + ({{ $teacher->sejarahJawatanRecords->count() }} + index) + '][peruntukan]'"
                                       placeholder="Peruntukan"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'sejarah_jawatan[' + ({{ $teacher->sejarahJawatanRecords->count() }} + index) + '][tempat_bertugas]'"
                                       placeholder="Tempat Bertugas"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button type="button" 
                                        @click="removeNewRow(index)" 
                                        class="text-red-600 font-bold hover:underline">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <button type="button" 
                    @click="addRow()" 
                    class="mt-3 px-5 py-2 rounded-md hover:bg-green-700 transition text-white font-medium" 
                    style="background-color:#10B981;">
                Tambah Baris
            </button>
            
            <p class="mt-2 text-xs text-gray-500" x-text="'New rows: ' + newRows.length"></p>
        </div>

        {{-- Buffer for button --}}
        <div class="mb-20"></div>

        {{-- Fixed Submit Button --}}
        <div class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save History Jawatan</p>
            </button>
        </div>
    </form>
</div>

{{-- 11. Anugerah --}}
<div x-cloak x-show="activeTab === 11" class="tab-content-wrapper pointer-events-none opacity-50">

    <form action="{{ route('pj.saveHistoryJawatan', $teacher->{'No Kad Pintar'}) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Section Title --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800">Anugerah</h3>
            <p class="text-sm text-gray-500 mt-1">Kemaskini maklumat anugerah</p>
        </div>

        {{-- Rujukan SPG Section --}}
        <div class="relative border-2 border-gray-400 rounded-md bg-gray-50 p-6 shadow-sm mb-6">
            <h2 class="text-black-700 font-bold text-sm md:text-base mb-4 -mt-8 inline-block bg-gray-50 px-2">
                Rujukan SPG
            </h2>
            <div class="flex flex-col">
                <label class="text-sm font-semibold text-gray-800 mb-2">Ruj SPG</label>
                <input type="text" 
                       name="ruj_spg"
                       value="{{ old('ruj_spg', $teacher->{'Ruj Memo SPA SPG'} ?? '') }}"
                       placeholder="Kosong"
                       class="px-4 py-2 border rounded-md focus:outline-none w-full placeholder:text-gray-400
                              focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
            </div>
        </div>

        {{-- Sejarah Jawatan Table --}}
        <div class="overflow-x-auto border-2 border-gray-300 rounded-lg p-4 shadow-sm bg-gray-100" 
             x-data="{ 
                newRows: [],
                addRow() { 
                    this.newRows.push({}); 
                },
                removeNewRow(index) { 
                    this.newRows.splice(index, 1); 
                }
             }">
            
            <p class="text-red-600 font-semibold mb-4 text-lg">Sejarah Jawatan</p>
            
            <table class="min-w-full border border-gray-300 bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left">Jawatan</th>
                        <th class="border px-4 py-2 text-left">Tarikh Lantikan</th>
                        <th class="border px-4 py-2 text-left">Peruntukan</th>
                        <th class="border px-4 py-2 text-left">Tempat Bertugas</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Load existing records from database --}}
                    @forelse($teacher->sejarahJawatanRecords as $index => $record)
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="sejarah_jawatan[{{ $index }}][jawatan]"
                                   value="{{ $record->jawatan }}"
                                   placeholder="Jawatan"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="sejarah_jawatan[{{ $index }}][tarikh_lantikan]"
                                   value="{{ $record->tarikh_lantikan ? $record->tarikh_lantikan->format('Y-m-d') : '' }}"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="sejarah_jawatan[{{ $index }}][peruntukan]"
                                   value="{{ $record->peruntukan }}"
                                   placeholder="Peruntukan"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="sejarah_jawatan[{{ $index }}][tempat_bertugas]"
                                   value="{{ $record->tempat_bertugas }}"
                                   placeholder="Tempat Bertugas"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                    {{-- Default empty row if no records --}}
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="sejarah_jawatan[0][jawatan]"
                                   placeholder="Jawatan"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" 
                                   name="sejarah_jawatan[0][tarikh_lantikan]"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="sejarah_jawatan[0][peruntukan]"
                                   placeholder="Peruntukan"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="sejarah_jawatan[0][tempat_bertugas]"
                                   placeholder="Tempat Bertugas"
                                   class="border px-2 py-1 w-full rounded-md">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="this.closest('tr').remove()" 
                                    class="text-red-600 font-bold hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @endforelse
                    
                    {{-- Dynamic rows --}}
                    <template x-for="(row, index) in newRows" :key="index">
                        <tr>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'sejarah_jawatan[' + ({{ $teacher->sejarahJawatanRecords->count() }} + index) + '][jawatan]'"
                                       placeholder="Jawatan"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-bind:name="'sejarah_jawatan[' + ({{ $teacher->sejarahJawatanRecords->count() }} + index) + '][tarikh_lantikan]'"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'sejarah_jawatan[' + ({{ $teacher->sejarahJawatanRecords->count() }} + index) + '][peruntukan]'"
                                       placeholder="Peruntukan"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-bind:name="'sejarah_jawatan[' + ({{ $teacher->sejarahJawatanRecords->count() }} + index) + '][tempat_bertugas]'"
                                       placeholder="Tempat Bertugas"
                                       class="border px-2 py-1 w-full rounded-md">
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button type="button" 
                                        @click="removeNewRow(index)" 
                                        class="text-red-600 font-bold hover:underline">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <button type="button" 
                    @click="addRow()" 
                    class="mt-3 px-5 py-2 rounded-md hover:bg-green-700 transition text-white font-medium" 
                    style="background-color:#10B981;">
                Tambah Baris
            </button>
            
            <p class="mt-2 text-xs text-gray-500" x-text="'New rows: ' + newRows.length"></p>
        </div>

        {{-- Buffer for button --}}
        <div class="mb-20"></div>

        {{-- Fixed Submit Button --}}
        <div class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Anugerah</p>
            </button>
        </div>
    </form>
</div>

{{-- 12. Bersara Tab --}}
<div x-cloak x-show="activeTab === 12" class="tab-content-wrapper">

    <form action="{{ route('pj.saveBersara', $teacher->{'No Kad Pintar'}) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Section Title --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800">Peruntukan / Bersara</h3>
            <p class="text-sm text-gray-500 mt-1">Kemaskini maklumat peruntukan dan persaraan</p>
        </div>

        {{-- PERUNTUKAN Bersara Frame --}}
        <div class="relative border-2 border-gray-400 rounded-md bg-gray-50 p-6 shadow-sm mb-6">
            <h2 class="text-black-700 font-bold text-sm md:text-base mb-4 -mt-8 inline-block bg-gray-50 px-2">
                Peruntukan Bersara
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <!-- Peruntukan Bersara -->
                <div class="flex flex-col lg:col-span-2">
                    <label class="text-sm font-semibold text-gray-800 mb-2">Peruntukan Bersara</label>
                    <input type="text" name="peruntukanBersara"
                           value="{{ old('peruntukanBersara', $teacher->{'Peruntukan Bersara'}) }}"
                           class="px-4 py-2 border rounded-md w-full placeholder:text-gray-400 
                                  focus:outline-none focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
                </div>

                <!-- Jabatan -->
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-gray-800 mb-2">Jabatan</label>
                    <input type="text" name="jabatanTempatBertugas"
                           value="{{ old('jabatanTempatBertugas', $teacher->{'Jabatan Tempat Bertugas'}) }}"
                           class="px-4 py-2 border rounded-md w-full placeholder:text-gray-400 
                                  focus:outline-none focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
                </div>

                <!-- Bahagian -->
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-gray-800 mb-2">Bahagian</label>
                    <input type="text" name="bahagianTempatBertugas"
                           value="{{ old('bahagianTempatBertugas', $teacher->{'Bahagian Tempat Bertugas'}) }}"
                           class="px-4 py-2 border rounded-md w-full placeholder:text-gray-400 
                                  focus:outline-none focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
                </div>

                <!-- Jawatan -->
                <div class="flex flex-col lg:col-span-2">
                    <label class="text-sm font-semibold text-gray-800 mb-2">Jawatan</label>
                    <input type="text" name="jawatanSekolah"
                           value="{{ old('jawatanSekolah', $teacher->{'Jawatan disekolah'} ?? $teacher->{'Jawatan di Sekolah'}) }}"
                           class="px-4 py-2 border rounded-md w-full placeholder:text-gray-400 
                                  focus:outline-none focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
                </div>
            </div>
        </div>

        {{-- Bersara / Tamat Kontrak Frame --}}
        <div class="relative border-2 border-gray-400 rounded-md bg-gray-50 p-6 shadow-sm">
            <h2 class="text-black-700 font-bold text-sm md:text-base mb-4 -mt-8 inline-block bg-gray-50 px-2">
                BERSARA / TAMAT KONTRAK
            </h2>

            <!-- Filter Bersara -->
            <div class="flex flex-col mb-4">
                <label class="text-sm font-semibold text-gray-800 mb-2">Filter Bersara</label>
                <select name="filterBersara"
                        class="px-4 py-2 border rounded-md w-full focus:outline-none focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
                    <option value="">-- Pilih --</option>
                    @php
                        $options = [
                            'BERSARA','MENAMATKAN PERKHIDMATAN','MENINGGAL DUNIA',
                            'TAMAT KONTRAK','TATATERTIB','DI BUANG KERJA',
                            'NAIK PANGKAT','NAIK PANGKAT/PINDAH'
                        ];
                    @endphp
                    @foreach($options as $option)
                        <option value="{{ $option }}" {{ (old('filterBersara', $teacher->{'Filter Bersara'} ?? '') === $option) ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Jawatan Bersara/Tamat -->
            <div class="flex flex-col mb-4">
                <label class="text-sm font-semibold text-gray-800 mb-2">Jawatan Bersara/Tamat</label>
                <input type="text" name="jawatanBersara"
                       value="{{ old('jawatanBersara', $teacher->{'Jawatan Bersara'}) }}"
                       class="px-4 py-2 border rounded-md w-full placeholder:text-gray-400
                              focus:outline-none focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
            </div>

           <!-- Tarikh Bersara & Tatatertib Section -->
<div class="flex flex-col mb-4" 
     x-data="{ 
        tatatertibChecked: {{ old('tatatertib', $teacher->tatatertib ?? 0) ? 'true' : 'false' }}, 
        tarikhBersara: '{{ $teacher->tatatertib && $teacher->tarikhBersaraOverride ? $teacher->tarikhBersaraOverride : $teacher->defaultTarikhTamat }}',
        tarikhBersaraOverride: '{{ old('tarikhBersaraOverride', $teacher->tarikhBersaraOverride ?? '') }}',
        catatanTatatertib: '{{ old('catatanTatatertib', addslashes($teacher->catatan_tatatertib ?? '')) }}',
        defaultTarikhBersara: '{{ $teacher->defaultTarikhTamat }}'
     }"
     x-init="
        $watch('tatatertibChecked', value => {
            if (!value) {
                tarikhBersara = defaultTarikhBersara;
                tarikhBersaraOverride = '';
            } else if (tarikhBersaraOverride) {
                tarikhBersara = tarikhBersaraOverride;
            }
        })
     ">

    <label class="text-sm font-semibold text-gray-800 mb-2">Tarikh Bersara (Auto: 60 Tahun)</label>
    <input type="text"
           x-model="tarikhBersara"
           class="px-4 py-2 border rounded-md w-64 bg-gray-100 placeholder:text-gray-400"
           readonly>

    <div class="flex flex-col gap-2 mt-4">
        <label class="flex items-center gap-2">
            <input type="checkbox"
                   class="form-checkbox h-5 w-5 text-rose-600"
                   name="tatatertib"
                   value="1"
                   x-model="tatatertibChecked"
                   :checked="tatatertibChecked">
            <span class="text-sm font-semibold">Tatatertib (Override Tarikh)</span>
        </label>

        <!-- Shown only when Tatatertib is checked -->
        <div x-show="tatatertibChecked" 
             x-transition
             class="flex flex-col gap-2 mt-2 p-4 bg-yellow-50 border border-yellow-200 rounded-md">
            <label class="text-sm font-semibold text-gray-800">Tarikh Bersara Override</label>
            <input type="date"
                   name="tarikhBersaraOverride"
                   x-model="tarikhBersaraOverride"
                   class="border px-4 py-2 rounded-md focus:outline-none focus:ring-1 focus:ring-rose-500"
                   @input="tarikhBersara = $event.target.value">

            <label class="text-sm font-semibold text-gray-800 mt-2">Catatan Tatatertib</label>
            <textarea name="catatanTatatertib"
                      rows="3"
                      placeholder="Catatan Tatatertib..."
                      x-model="catatanTatatertib"
                      class="border px-4 py-2 rounded-md focus:outline-none focus:ring-1 focus:ring-rose-500"></textarea>
        </div>
    </div>
</div>
            <!-- Tarikh Cuti Bersara -->
            <div class="flex flex-col mb-4">
                <label class="text-sm font-semibold text-gray-800 mb-2">Tarikh Cuti Bersara</label>
                @php
                    $tarikhCutiBersaraValue = old('tarikhCutiBersara');
                    if (!$tarikhCutiBersaraValue && !empty($teacher->{'Tarikh Cuti Bersara'})) {
                        try {
                            $tarikhCutiBersaraValue = \Carbon\Carbon::parse($teacher->{'Tarikh Cuti Bersara'})->format('Y-m-d');
                        } catch (\Exception $e) {
                            $tarikhCutiBersaraValue = '';
                        }
                    }
                @endphp
                <input type="date" name="tarikhCutiBersara"
                       value="{{ $tarikhCutiBersaraValue }}"
                       class="px-4 py-2 border rounded-md w-full placeholder:text-gray-400
                              focus:outline-none focus:ring-1 focus:ring-rose-500 focus:border-rose-500">
            </div>

           {{-- Tarikh Tamat Kontrak / Berhenti (Auto-calculated from birthday, but editable) --}}
<div>
    <label class="text-xs">Tarikh Tamat Kontrak / Berhenti</label>
    
    @php
        // Get the stored value and convert it to Y-m-d format for the input
        $tarikhTamatKontrakValue = '';
        
        if (!empty($teacher->{'Tarikh Tamat Kontrak'})) {
            try {
                // Parse the stored date (could be in various formats)
                $tarikhTamatKontrakValue = \Carbon\Carbon::parse($teacher->{'Tarikh Tamat Kontrak'})->format('Y-m-d');
            } catch (\Exception $e) {
                // If no manual date, calculate from birthday
                if (!empty($teacher->{'Tarikh Lahir'})) {
                    try {
                        $tarikhTamatKontrakValue = \Carbon\Carbon::parse($teacher->{'Tarikh Lahir'})->addYears(60)->format('Y-m-d');
                    } catch (\Exception $e2) {
                        $tarikhTamatKontrakValue = '';
                    }
                }
            }
        } elseif (!empty($teacher->{'Tarikh Lahir'})) {
            // No Tarikh Tamat Kontrak set, auto-calculate from birthday
            try {
                $tarikhTamatKontrakValue = \Carbon\Carbon::parse($teacher->{'Tarikh Lahir'})->addYears(60)->format('Y-m-d');
            } catch (\Exception $e) {
                $tarikhTamatKontrakValue = '';
            }
        }
    @endphp
    
    <div class="flex gap-2 items-center">
        <input type="date" 
               name="TarikhTamatKontrak"
               value="{{ $tarikhTamatKontrakValue }}"
               class="w-full border rounded-lg px-3 py-2 text-sm"
               title="Calculated: Birthday + 60 years (editable)">
        
        <button type="button" 
                onclick="recalculateRetirement()"
                class="px-3 py-2 bg-blue-500 text-white rounded-lg text-xs hover:bg-blue-600 whitespace-nowrap flex-shrink-0"
                title="Recalculate from birthday">
            🔄 Auto
        </button>
    </div>
    
    <p class="text-xs text-gray-500 mt-1">
        💡 Auto: Hari Lahir + 60 tahun | Anda boleh mengedit tarikh ini secara manual
    </p>
</div>

{{-- JavaScript for recalculation --}}
<script>
function recalculateRetirement() {
    // Get the birthday input
    const tarikhLahirInput = document.querySelector('input[name="TarikhLahir"]');
    const tarikhTamatInput = document.querySelector('input[name="TarikhTamatKontrak"]');
    
    if (tarikhLahirInput && tarikhLahirInput.value && tarikhTamatInput) {
        try {
            // Parse the birthday
            const birthDate = new Date(tarikhLahirInput.value);
            
            // Add 60 years
            const retireDate = new Date(birthDate);
            retireDate.setFullYear(birthDate.getFullYear() + 60);
            
            // Format as YYYY-MM-DD for date input
            const year = retireDate.getFullYear();
            const month = String(retireDate.getMonth() + 1).padStart(2, '0');
            const day = String(retireDate.getDate()).padStart(2, '0');
            
            tarikhTamatInput.value = `${year}-${month}-${day}`;
            
            // Show notification
            alert('✓ Tarikh Tamat Kontrak dikira semula dari Tarikh Lahir + 60 tahun');
        } catch (e) {
            alert('❌ Error: Sila pastikan Tarikh Lahir diisi dengan betul');
            console.error('Error calculating retirement date:', e);
        }
    } else {
        alert('⚠️ Sila isi Tarikh Lahir terlebih dahulu');
    }
}

// Auto-calculate when birthday changes
document.addEventListener('DOMContentLoaded', function() {
    const tarikhLahirInput = document.querySelector('input[name="TarikhLahir"]');
    const tarikhTamatInput = document.querySelector('input[name="TarikhTamatKontrak"]');
    
    if (tarikhLahirInput && tarikhTamatInput) {
        tarikhLahirInput.addEventListener('change', function() {
            // Only auto-calculate if Tarikh Tamat is empty
            if (!tarikhTamatInput.value) {
                recalculateRetirement();
            }
        });
    }
});
</script>
        {{-- Buffer for button --}}
        <div class="mb-20"></div>

        {{-- Save Button --}}
        <div class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Peruntukan/Bersara</p>
            </button>
        </div>
    </form>
</div>
</div>
{{-- 13. Lain-lain hal Tab --}}
<div x-show="activeTab === 13" class="tab-content-wrapper" x-cloak>
    <form action="{{ route('pj.saveLainLainHal', $teacher->{'No Kad Pintar'}) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Catatan Tambahan Textarea -->
        <div class="mt-8 border-2 border-gray-300 rounded-lg p-4 shadow-sm bg-gray-50">
            <label class="text-sm font-semibold text-gray-800 mb-2 block">Catatan / Nota Tambahan</label>
            <textarea 
                name="catatan_tambahan" 
                placeholder="Tulis di sini..."
                class="w-full h-64 p-4 border border-gray-300 rounded-md focus:outline-none resize-none bg-white text-gray-800 placeholder-gray-400"
            >{{ old('catatan_tambahan', $teacher->{'Catatan Tambahan'} ?? '') }}</textarea>
        </div>

        {{-- Save Button --}}
        <div class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Lain-lain hal</p>
            </button>
        </div>
    </form>
</div>


<!-- {{-- 9. Kursus Tab --}}
<div x-show="activeTab === 8" class="mt-6" x-cloak>
    <div x-data="kursusTable([])" class="mt-4">
        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">Code Kursus</th>
                    <th class="border px-4 py-2 text-left">Nama Kursus</th>
                    <th class="border px-4 py-2 text-left">Mulai</th>
                    <th class="border px-4 py-2 text-left">Hingga</th>
                    <th class="border px-4 py-2 text-left">Tempat Kursus</th>
                    <th class="border px-4 py-2 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(row, index) in rows" :key="index">
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" x-model="row.code" placeholder="Code"
                                class="px-2 py-1 border rounded-md w-full focus:outline-none">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" x-model="row.nama" placeholder="Nama Kursus"
                                class="px-2 py-1 border rounded-md w-full focus:outline-none">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" x-model="row.mulai" placeholder="Mulai"
                                class="px-2 py-1 border rounded-md w-full focus:outline-none">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="date" x-model="row.hingga" placeholder="Hingga"
                                class="px-2 py-1 border rounded-md w-full focus:outline-none">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" x-model="row.tempat" placeholder="Tempat Kursus"
                                class="px-2 py-1 border rounded-md w-full focus:outline-none">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" @click="removeRow(index)" class="text-red-600 font-bold">Remove</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>

        <button type="button"
            @click="addRow()"
            class="mt-2 px-4 py-2 rounded-md text-white"
            style="background-color:#3B82F6;">
            Add Row
        </button>
    </div>

    {{-- Fixed Submit Button --}}
    <div class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent">
        <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
            </svg>
            <p>Save Kursus</p>
        </button>
    </div>
</div>

{{-- 10. Prestasi Tab --}}
<div x-show="activeTab === 10" x-data="prestasiTable([])" class="mt-6 space-y-4" x-cloak>
    <form method="POST" action="{{ route('prestasi.save') }}">
        @csrf
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">Tahun</th>
                        <th class="border px-4 py-2 text-left">Gred</th>
                        <th class="border px-4 py-2 text-left">Percentage</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(row, index) in rows" :key="index">
                        <tr>
                            <td class="border px-4 py-2">
                                <input type="text" x-model="row.tahun" :name="`rows[${index}][tahun]`" placeholder="YYYY"
                                       class="px-2 py-1 border rounded-md w-full focus:outline-none">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" x-model="row.gred" :name="`rows[${index}][gred]`" placeholder="Gred"
                                       class="px-2 py-1 border rounded-md w-full focus:outline-none">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" x-model="row.percentage" :name="`rows[${index}][percentage]`" placeholder="%"
                                       class="px-2 py-1 border rounded-md w-full focus:outline-none">
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button type="button" @click="removeRow(index)" class="text-red-600 font-bold">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <button type="button" @click="addRow()"
            class="mt-2 px-4 py-2 rounded-md hover:bg-blue-600 text-white"
            style="background-color:#3B82F6;">
            Add Row
        </button>

        {{-- Fixed Submit Button --}}
        <div class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Prestasi</p>
            </button>
        </div>
        
    </form>
</div> -->

<script>
function jawatanTable(initialRows = []) {
    return {
        rows: initialRows.length 
            ? initialRows 
            : [{ jawatan: '', tarikhLantikan: '', peruntukan: '', tempatBertugas: '' }],
        addRow() {
            this.rows.push({ jawatan: '', tarikhLantikan: '', peruntukan: '', tempatBertugas: '' });
        },
        removeRow(index) {
            this.rows.splice(index, 1);
        }
    }
}

function kursusTable(initialRows = []) {
    return {
        rows: initialRows.map(item => ({
            code: item.code || '',
            nama: item.nama || '',
            mulai: item.mulai || '',
            hingga: item.hingga || '',
            tempat: item.tempat || ''
        })),
        addRow() {
            this.rows.push({ code: '', nama: '', mulai: '', hingga: '', tempat: '' });
        },
        removeRow(index) {
            this.rows.splice(index, 1);
        }
    }
}

function prestasiTable(existingRows = []) {
    return {
        rows: existingRows.length ? existingRows : [],
        addRow() {
            this.rows.push({ tahun: '', gred: '', percentage: '' });
        },
        removeRow(index) {
            this.rows.splice(index, 1);
        }
    }
}
</script>


</div>
<!-- Footer -->
<footer class="w-full text-center text-gray-500 mt-10 mb-4 text-sm z-10 relative">
    Ministry Of Education @ {{ date('Y') }} All Rights Reserved. Powered by DevOps ICT.
</footer>

@endsection
