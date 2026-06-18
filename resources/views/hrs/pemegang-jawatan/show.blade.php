@extends('hrs.layouts.app-minimal')

@section('title') Profil - {{ $spj->nama }} @endsection

@section('content')

<style>
body {
    background-color: #f3f5ffff !important; /* Tailwind blue-50 */
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
    <!-- {{-- Error Message --}}
    <div class="fixed z-50 right-0 top-0 check text-sm">
        <p>Please check your fields!</p>
    </div> -->
   
    <div x-data="{ activeTab: 1 }">

       {{-- Short Info --}}
<div class="bg-white p-5 rounded-2xl shadow flex flex-col gap-5">

    <div>
        <p class="text-xs">Nama</p>
        <p>{{ $spj->nama }}</p>
    </div>

    <div class="flex items-center gap-10">
        <div>
            <p class="text-xs">No Kad Pintar</p>
            <p class="uppercase">{{ $spj->noKadPintar }}</p>
        </div>

        <div>
            <p class="text-xs">Kod SJ</p>
            <p>{{ $spj->kodSJ }}</p>
        </div>

        {{-- Click to go to Jawatan Page --}}
        <div>
            <p class="text-xs">Kod Jawatan</p>
            <p>{{ $spj->kodSJ }}/01-{{ $totalPost }}/A</p>
        </div>
    </div>

</div>


      
        {{-- Tabs and Contents --}}
        <div class="mt-10">

            {{-- Tabs --}}
            <div class="relative">

                {{-- Tabs --}}
                <div class="overflow-x-auto select-none whitespace-nowrap hidden-scrollbar" x-data="{ isDragging: false, startX: 0, scrollLeft: 0 }" 
                    x-on:mousedown="isDragging = true; startX = $event.pageX; scrollLeft = $el.scrollLeft"
                    x-on:mousemove="if(isDragging) { $el.scrollLeft = scrollLeft - ($event.pageX - startX) }"
                    x-on:mouseup="isDragging = false"
                    x-on:mouseleave="isDragging = false"
                >
                    <div class="flex items-center text-gray-400 cursor-pointer">
                        
                        {{-- Tab 1: Peribadi --}}
<div x-on:click="activeTab = 1" 
     class="tab-item flex items-center gap-2 px-5 py-2 border-b-2 duration-300 hover:border-rose-600 hover:text-rose-600"
     :class="{'active border-rose-600 text-rose-600': activeTab === 1, 'border-gray-100': activeTab !== 1}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
    </svg>
    <p>Peribadi</p>
</div>

{{-- Tab 2: Pekerjaan --}}
<div x-on:click="activeTab = 2" 
     class="tab-item flex items-center gap-2 px-5 py-2 border-b-2 duration-300 hover:border-rose-600 hover:text-rose-600"
     :class="{'active border-rose-600 text-rose-600': activeTab === 2, 'border-gray-100': activeTab !== 2}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
    </svg>
    <p>Pekerjaan</p>
</div>

{{-- Tab 3: Jawatan Utama --}}
<div x-on:click="activeTab = 3" 
     class="tab-item flex items-center gap-2 px-5 py-2 border-b-2 duration-300 hover:border-rose-600 hover:text-rose-600"
     :class="{'active border-rose-600 text-rose-600': activeTab === 3, 'border-gray-100': activeTab !== 3}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
    </svg>
    <p>Jawatan Utama</p>
</div>

{{-- Tab 4: Melapor --}}
<div x-on:click="activeTab = 4" 
     class="tab-item flex items-center gap-2 px-5 py-2 border-b-2 duration-300 hover:border-rose-600 hover:text-rose-600"
     :class="{'active border-rose-600 text-rose-600': activeTab === 4, 'border-gray-100': activeTab !== 4}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
    </svg>
    <p>Melapor</p>
</div>

{{-- Tab 5: Kelulusan --}}
<div x-on:click="activeTab = 5" 
     class="tab-item flex items-center gap-2 px-5 py-2 border-b-2 duration-300 hover:border-rose-600 hover:text-rose-600"
     :class="{'active border-rose-600 text-rose-600': activeTab === 5, 'border-gray-100': activeTab !== 5}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
    </svg>
    <p>Kelulusan</p>
</div>

{{-- Tab 6: Budget --}}
<div x-on:click="activeTab = 6" 
     class="tab-item flex items-center gap-2 px-5 py-2 border-b-2 duration-300 hover:border-rose-600 hover:text-rose-600"
     :class="{'active border-rose-600 text-rose-600': activeTab === 6, 'border-gray-100': activeTab !== 6}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V13.5Zm0 2.25h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V18Zm2.498-6.75h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V13.5Zm0 2.25h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V18Zm2.504-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5Zm0 2.25h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V18Zm2.498-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5ZM8.25 6h7.5v2.25h-7.5V6ZM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0 0 12 2.25Z" />
</svg>

    <p>Budget</p>
</div>

{{-- Tab 7: Kenaikan Gaji --}}
<div x-on:click="activeTab = 7" 
     class="tab-item flex items-center gap-2 px-5 py-2 border-b-2 duration-300 hover:border-rose-600 hover:text-rose-600"
     :class="{'active border-rose-600 text-rose-600': activeTab === 7, 'border-gray-100': activeTab !== 7}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
    <p>Kenaikan Gaji</p>
</div>

{{-- Tab 8: Cuti --}}
<div x-on:click="activeTab = 8" 
     class="tab-item flex items-center gap-2 px-5 py-2 border-b-2 duration-300 hover:border-rose-600 hover:text-rose-600"
     :class="{'active border-rose-600 text-rose-600': activeTab === 8, 'border-gray-100': activeTab !== 8}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
    </svg>
    <p>Cuti</p>
</div>

{{-- Tab 9: Bersara/Menamatkan --}}
<div x-on:click="activeTab = 9" 
     class="tab-item flex items-center gap-2 px-5 py-2 border-b-2 duration-300 hover:border-rose-600 hover:text-rose-600"
     :class="{'active border-rose-600 text-rose-600': activeTab === 9, 'border-gray-100': activeTab !== 9}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008ZM14.25 15h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008ZM16.5 15h.008v.008H16.5V15Zm0 2.25h.008v.008H16.5v-.008Z" />
    </svg>
    <p>Bersara / Menamatkan</p>
</div>

{{-- Tab 10: SPG --}}
<div x-on:click="activeTab = 10" 
     class="tab-item flex items-center gap-2 px-5 py-2 border-b-2 duration-300 hover:border-rose-600 hover:text-rose-600"
     :class="{'active border-rose-600 text-rose-600': activeTab === 10, 'border-gray-100': activeTab !== 10}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
    </svg>
    <p>SPG</p>
</div>

{{-- Tab 11: Kursus --}}
<div x-on:click="activeTab = 11" 
     class="tab-item flex items-center gap-2 px-5 py-2 border-b-2 duration-300 hover:border-rose-600 hover:text-rose-600"
     :class="{'active border-rose-600 text-rose-600': activeTab === 11, 'border-gray-100': activeTab !== 11}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
    </svg>
    <p>Kursus</p>
</div>

{{-- Tab 12: Prestasi --}}
<div x-on:click="activeTab = 12" 
     class="tab-item flex items-center gap-2 px-5 py-2 border-b-2 duration-300 hover:border-rose-600 hover:text-rose-600"
     :class="{'active border-rose-600 text-rose-600': activeTab === 12, 'border-gray-100': activeTab !== 12}">
     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
</svg>
    <p>Prestasi</p>
</div>

{{-- Tab 13: Anugerah --}}
<div x-on:click="activeTab = 13" 
     class="tab-item flex items-center gap-2 px-5 py-2 border-b-2 duration-300 hover:border-rose-600 hover:text-rose-600"
     :class="{'active border-rose-600 text-rose-600': activeTab === 13, 'border-gray-100': activeTab !== 13}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.228a25.928 25.928 0 0 1 2.916.52 6.003 6.003 0 0 1-4.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0C14.23 12.172 16.22 11.65 18 10.75" />
    </svg>
    <p>Anugerah</p>
</div>


                        @for ($i=0; $i <= 10; $i++)
                            <div class="flex items-center gap-2 px-5 py-2 border-b-2 duration-300 border-gray-100 hover:border-rose-600 hover:text-rose-600 hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                </svg>                                                     
                                
                                <p>Others</p>
                            </div>
                        @endfor

                    </div>

                </div>

            </div>
            
           <form action="{{ route('pj.save.peribadi', ['id' => $id]) }}" method="POST" 
    x-cloak x-show="activeTab === 1" class="tab-content-wrapper">

    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-5">

<!-- Peribadi tab -->
 
    {{-- Nama --}}
    <div class="lg:col-span-2 flex flex-col gap-2">
        <p class="text-sm">Nama</p>
        <input type="text" name="nama" value="{{ $spj->nama }}"
            class="border px-4 py-2 rounded-md w-full placeholder:text-gray-200">
        @error('nama')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
    </div>

    {{-- No. Kad Pintar --}}
    <div class="flex flex-col gap-2">
        <p class="text-sm">No. Kad Pintar</p>
        <input type="text" name="noKadPintar" x-mask="99-999999" value="{{ $spj->noKadPintar }}"
            class="border px-4 py-2 rounded-md w-full placeholder:text-gray-200">
        @error('noKadPintar')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
    </div>

    {{-- Jantina --}}
    <div class="flex flex-col gap-2" x-data="{ dropDown: false, selected: '{{ $spj->jantina ?? '' }}' }">
        <p class="text-sm">Jantina</p>
        <div @click="dropDown = !dropDown" class="border rounded-md cursor-pointer relative">
            <p class="px-4 py-2" x-text="selected || 'Pilih'"></p>
            <div x-show="dropDown" @click.away="dropDown = false" class="absolute bg-white w-full border mt-1 z-10">
                <div class="px-4 py-2 hover:bg-gray-100" @click="selected='Lelaki'; dropDown=false">Lelaki</div>
                <div class="px-4 py-2 hover:bg-gray-100" @click="selected='Perempuan'; dropDown=false">Perempuan</div>
            </div>
            <input type="hidden" name="jantina" :value="selected">
        </div>
        @error('jantina')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
    </div>

    {{-- Tarikh Lahir --}}
    <div class="flex flex-col gap-2" x-data="{ date: '{{ $spj->tarikhLahir ? \Carbon\Carbon::parse($spj->tarikhLahir)->format('Y-m-d') : '' }}' }" 
         x-init="flatpickr($refs.datepicker, { altInput:true, altFormat:'j-M-Y', dateFormat:'Y-m-d', defaultDate:date })">
        <p class="text-sm">Tarikh Lahir</p>
        <input type="text" x-ref="datepicker" x-model="date" name="tarikhLahir"
            class="border px-4 py-2 rounded-md w-full cursor-pointer" placeholder="Pilih" readonly>
        @error('tarikhLahir')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
    </div>

    {{-- Umur --}}
    <div class="flex flex-col gap-2">
        <p class="text-sm">Umur</p>
        @php
            try {
                $age = $spj->tarikhLahir ? \Carbon\Carbon::parse($spj->tarikhLahir)->diff(\Carbon\Carbon::now()) : null;
            } catch (\Exception $e) { $age = null; }
        @endphp
        <input type="text" disabled 
            value="{{ $age ? $age->y . ' Tahun ' . $age->m . ' Bulan' : '' }}"
            class="border px-4 py-2 rounded-md w-full text-gray-500">
    </div>

    {{-- Alamat --}}
    <div class="lg:col-span-2 flex flex-col gap-2">
        <p class="text-sm">Alamat</p>
        <input type="text" name="alamat" value="{{ $spj->alamat }}"
            class="border px-4 py-2 rounded-md w-full placeholder:text-gray-200">
        @error('alamat')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
    </div>

    <!-- {{-- Bank Info --}}
<div class="lg:col-span-2 grid grid-cols-2 gap-5 mt-5">
    <p class="lg:col-span-2 font-semibold">Maklumat Bank</p>

    {{-- Nama Bank --}}
    <div class="flex flex-col gap-2">
        <p class="text-sm">Nama Bank</p>
        {{-- Select & Dropdown --}}
        <div class="relative" x-data="{ dropDown: false, selected: '{{ $spj->namaBank }}' }">
            {{-- Select --}}
            <div 
                x-on:click="dropDown = !dropDown" 
                x-on:click.away="dropDown = false" 
                class="flex items-center justify-between gap-2 cursor-pointer rounded-md w-full overflow-hidden border px-4 py-2"
            >
                <span x-text="selected" class="placeholder:text-gray-200"></span>
                <div class="mr-2 px-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
            </div>
            {{-- Dropdown --}}
            <div x-cloak x-show="dropDown" class="absolute w-full border mt-1 bg-white max-h-[10em] overflow-y-scroll z-10">
                <template x-for="bank in [
                    'Bank Islam Brunei Darussalam', 
                    'BIBD At-Tamwil', 
                    'Baiduri Bank', 
                    'Baiduri Finance', 
                    'Tabung Amanah Islam Brunei', 
                    'HSBC', 
                    'Standard Chartered Bank', 
                    'United Overseas Bank', 
                    'Citibank', 
                    'Maybank', 
                    'RHB Bank', 
                    'Bank of China'
                ]" :key="bank">
                    <div class="hover:bg-gray-50 px-2 py-2 cursor-pointer" x-on:click="selected = bank; dropDown = false">
                        <p x-text="bank"></p>
                    </div>
                </template>
            </div>
            <input type="hidden" :value="selected" name="namaBank">
        </div>
        @error('namaBank')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- No. Akaun Buku Bank --}}
    <div class="flex flex-col gap-2">
        <p class="text-sm">No. Akaun Buku Bank</p>
        <input type="text" name="noAkaunBukuBank" value="{{ $spj->noAkaunBukuBank }}"
            class="border px-4 py-2 rounded-md w-full placeholder:text-gray-200">
    </div>

    {{-- Tarikh Buku Bank Aktif --}}
    <div class="flex flex-col gap-2" x-data="{ date: '{{ old('tarikhBukuBankActive', $spj->tarikhBukuBankActive_formatted ?? '') }}' }"
         x-init="flatpickr($refs.datepickerBank, { altInput:true, altFormat:'j-M-Y', dateFormat:'Y-m-d', defaultDate:date })">
        <p class="text-sm">Tarikh Buku Bank Aktif</p>
        <input type="text" x-ref="datepickerBank" x-model="date" name="tarikhBukuBankActive"
            class="border px-4 py-2 rounded-md w-full cursor-pointer" placeholder="Pilih" readonly>
    </div>

    {{-- Cawangan Bank --}}
    <div class="flex flex-col gap-2">
        <p class="text-sm">Cawangan Bank</p>
        <input type="text" name="cawanganBank" value="{{ $spj->cawanganBank }}"
            class="border px-4 py-2 rounded-md w-full placeholder:text-gray-200">
    </div>
</div> -->

    {{-- Contact Info --}}
    <div class="lg:col-span-2 grid grid-cols-2 gap-5 mt-5">
        <p class="lg:col-span-2 font-semibold">Butiran Kontak</p>

        <div class="flex flex-col gap-2">
            <p class="text-sm">Emel Peribadi</p>
            <input type="text" name="emelPeribadi" value="{{ $spj->emelPeribadi }}"
                class="border px-4 py-2 rounded-md w-full placeholder:text-gray-200">
        </div>

        <div class="flex flex-col gap-2">
            <p class="text-sm">Emel Kerja</p>
            <input type="text" name="emel" value="{{ $spj->emel }}"
                class="border px-4 py-2 rounded-md w-full placeholder:text-gray-200">
        </div>

        <div class="flex flex-col gap-2">
            <p class="text-sm">No. Telefon</p>
            <div class="border rounded-md w-full flex items-center">
                <span class="text-gray-200 pl-2">+673</span>
                <input type="text" x-mask="999 9999" name="noTelefon" value="{{ $spj->noTelefon }}"
                    class="py-2 focus:outline-none w-full">
            </div>
        </div>

        <div class="flex flex-col gap-2">
            <p class="text-sm">No. Telefon Bimbit</p>
            <div class="border rounded-md w-full flex items-center">
                <span class="text-gray-200 pl-2">+673</span>
                <input type="text" x-mask="999 9999" name="noMobile" value="{{ $spj->noMobile }}"
                    class="py-2 focus:outline-none w-full">
            </div>
        </div>
    </div>

    </div>

  {{-- Submit Button --}}
<div x-show="activeTab === 1" class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
    <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
        </svg>
        <p>Save Peribadi</p>
    </button>
</div>

</form>


                   {{-- Tab content wrapper Pekerjaan Tab --}}
<form action="{{ route('pj.save.pekerjaan', ['id' => $id]) }}" method="POST" 
    x-cloak x-show="activeTab === 2" class="tab-content-wrapper">

    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-5">

    {{-- Fail Rujukan --}}
    <div class="lg:col-span-2 flex flex-col gap-2">
        <p class="text-sm">Fail Rujukan</p>
        <input type="text" name="failRujukan" value="{{ old('failRujukan', $spj->rujukanFile ?? '') }}"
            class="border px-4 py-2 rounded-md w-full focus:outline-none placeholder:text-gray-200"
            placeholder="Kosong">
        @error('failRujukan')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <!-- {{-- Tarikh Meminjam Fail - FIXED --}}
    <div class="lg:col-span-2 flex flex-col gap-2">
        <p class="text-sm">Tarikh Meminjam Fail</p>
        <div x-data="{ 
            date: '{{ old('tarikhMeminjamFail', $spj->tarikhMinjamFail_formatted ?? '') }}',
            dateClicked: false 
        }"
        x-init="
            const fp = flatpickr($refs.datePinjam, { 
                altInput: true, 
                altFormat: 'j-M-Y', 
                dateFormat: 'Y-m-d', 
                defaultDate: date || null,
                allowInput: false,
                onChange: (selectedDates, dateStr) => { 
                    date = dateStr; 
                    dateClicked = false; 
                }
            });
            $watch('dateClicked', value => { if (value) fp.open(); });
        "
        x-on:click.away="dateClicked = false"
        class="flex items-center border rounded-md cursor-pointer overflow-hidden w-full"
        x-on:click="dateClicked = true">
            <input type="text" x-model="date" x-ref="datePinjam" name="tarikhMeminjamFail"
                placeholder="Pilih" readonly
                class="px-4 py-2 w-full focus:outline-none cursor-pointer placeholder:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
            </svg>
        </div>
        @error('tarikhMeminjamFail')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div> -->

    {{-- Jawatan --}}
    <div class="flex flex-col gap-2">
        <p class="text-sm">Jawatan</p>
        <input type="text" name="jawatanoption" value="{{ old('jawatanoption', $spj->Text224 ?? '') }}" 
            class="border px-4 py-2 rounded-md w-full focus:outline-none placeholder:text-gray-200"
            placeholder="Kosong">
        @error('jawatanoption')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Jawatan sebenar --}}
    <div class="lg:col-span-2 flex flex-col gap-2">
        <p class="text-sm">Jawatan sebenar</p>
        <input type="text" name="jawatanSebenar" value="{{ old('jawatanSebenar', $spj->Text242 ?? '') }}"
            placeholder="Kosong" class="border px-4 py-2 rounded-md focus:outline-none w-full placeholder:text-gray-200">
        @error('jawatanSebenar')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tanggagaji sebenar --}}
    <div class="lg:col-span-2 flex flex-col gap-2">
        <p class="text-sm">Tanggagaji sebenar</p>
        <input type="text" name="tanggagajiSebenar" value="{{ old('tanggagajiSebenar', $spj->tanggagajiSebenar ?? '') }}"
            placeholder="Kosong" class="border px-4 py-2 rounded-md focus:outline-none w-full placeholder:text-gray-200">
        @error('tanggagajiSebenar')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Divisyen --}}
    <div class="lg:col-span-2 flex flex-col gap-2">
        <p class="text-sm">Divisyen</p>
        <input type="text" name="divisyen" value="{{ old('divisyen', $spj->Text236 ?? '') }}" 
            placeholder="Kosong" class="border px-4 py-2 rounded-md focus:outline-none w-full placeholder:text-gray-200">
        @error('divisyen')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tanggagaji buku budget --}}
    <div class="lg:col-span-2 flex flex-col gap-2">
        <p class="text-sm">Tanggagaji (seperti dalam buku budget)</p>
        <input type="text" name="Text228" value="{{ old('Text228', $spj->Text228 ?? '') }}" 
            placeholder="Kosong" class="border px-4 py-2 rounded-md focus:outline-none w-full placeholder:text-gray-200">
        @error('Text228')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Jenis Tanggagaji --}}
    <div class="lg:col-span-2 flex flex-col gap-2">
        <p class="text-sm">Jenis tanggagaji</p>
        <input type="text" name="jenisTanggagaji" value="{{ old('jenisTanggagaji', $spj->jenisTanggagaji ?? '') }}" 
            placeholder="Kosong" class="border px-4 py-2 rounded-md focus:outline-none w-full placeholder:text-gray-200">
        @error('jenisTanggagaji')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tarikh mula berkhidmat - FIXED --}}
    <div class="lg:col-span-2 flex flex-col gap-2">
        <p class="text-sm">Tarikh mula berkhidmat</p>
        <div x-data="{ 
            date: '{{ old('tarikhMulaBerkhidmat', $spj->tarikhMulaBerkhidmat_formatted ?? '') }}',
            dateClicked: false 
        }"
        x-init="
            const fp = flatpickr($refs.datepicker, { 
                altInput: true, 
                altFormat: 'j-M-Y', 
                dateFormat: 'Y-m-d', 
                defaultDate: date || null,
                onChange: (selectedDates, dateStr) => { 
                    date = dateStr; 
                    dateClicked = false; 
                }
            });
            $watch('dateClicked', value => { if (value) fp.open(); });
        "
        x-on:click.away="dateClicked = false"
        class="flex items-center border rounded-md cursor-pointer overflow-hidden w-full"
        x-on:click="dateClicked = true">
            <input type="text" x-model="date" x-ref="datepicker" name="tarikhMulaBerkhidmat"
                placeholder="Pilih" readonly
                class="px-4 py-2 w-full focus:outline-none cursor-pointer placeholder:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
            </svg>
        </div>
        @error('tarikhMulaBerkhidmat')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- TAP / SCP --}}
<div class="lg:col-span-4 flex items-center gap-6 mt-2">
    <label class="flex items-center gap-2">
        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="tap" value="1" 
            {{ old('tap', $spj->tap == 1 || $spj->tap === true) ? 'checked' : '' }}>
        <span class="text-sm">TAP</span>
    </label>
    <label class="flex items-center gap-2">
        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="scp" value="1" 
            {{ old('scp', $spj->scp == 1 || $spj->scp === true) ? 'checked' : '' }}>
        <span class="text-sm">SCP</span>
    </label>
</div>

    {{-- Tarikh jawatan sekarang - FIXED --}}
    <div class="lg:col-span-2 flex flex-col gap-2 mt-4">
        <p class="text-sm">Tarikh jawatan sekarang</p>
        <div x-data="{ 
            date: '{{ old('tarikhJawatanSekarang', $spj->tarikhJawatanSekarang_formatted ?? '') }}',
            dateClicked: false 
        }"
        x-init="
            const fp = flatpickr($refs.dateSekarang, { 
                altInput: true, 
                altFormat: 'j-M-Y', 
                dateFormat: 'Y-m-d', 
                defaultDate: date || null,
                onChange: (selectedDates, dateStr) => { 
                    date = dateStr; 
                    dateClicked = false; 
                }
            });
            $watch('dateClicked', value => { if (value) fp.open(); });
        "
        x-on:click.away="dateClicked = false"
        class="flex items-center border rounded-md cursor-pointer overflow-hidden w-full"
        x-on:click="dateClicked = true">
            <input type="text" x-model="date" x-ref="dateSekarang" name="tarikhJawatanSekarang"
                placeholder="Pilih" readonly
                class="px-4 py-2 w-full focus:outline-none cursor-pointer placeholder:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
            </svg>
        </div>
        @error('tarikhJawatanSekarang')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tarikh lantikan KBT - FIXED --}}
    <div class="lg:col-span-2 flex flex-col gap-2 mt-4">
        <p class="text-sm">Tarikh lantikan KBT</p>
        <div x-data="{ 
            date: '{{ old('tarikhLantikanKBT', $spj->tarikhLantikanKBT_formatted ?? '') }}',
            dateClicked: false 
        }"
        x-init="
            const fp = flatpickr($refs.dateKBT, { 
                altInput: true, 
                altFormat: 'j-M-Y', 
                dateFormat: 'Y-m-d', 
                defaultDate: date || null,
                onChange: (selectedDates, dateStr) => { 
                    date = dateStr; 
                    dateClicked = false; 
                }
            });
            $watch('dateClicked', value => { if (value) fp.open(); });
        "
        x-on:click.away="dateClicked = false"
        class="flex items-center border rounded-md cursor-pointer overflow-hidden w-full"
        x-on:click="dateClicked = true">
            <input type="text" x-model="date" x-ref="dateKBT" name="tarikhLantikanKBT"
                placeholder="Pilih" readonly
                class="px-4 py-2 w-full focus:outline-none cursor-pointer placeholder:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
            </svg>
        </div>
        @error('tarikhLantikanKBT')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Jenis Perkhidmatan --}}
    <div class="lg:col-span-2 flex flex-col gap-2 mt-4">
        <p class="text-sm">Jenis Perkhidmatan</p>
        <select name="jenisPerkhidmatan" class="border px-4 py-2 rounded-md focus:outline-none w-full">
            <option value="">Pilih</option>
            <option value="Tetap" {{ old('jenisPerkhidmatan', $spj->Combo230) == 'Tetap' ? 'selected' : '' }}>Tetap</option>
            <option value="Percubaan" {{ old('jenisPerkhidmatan', $spj->Combo230) == 'Percubaan' ? 'selected' : '' }}>Percubaan</option>
            <option value="Kontrek" {{ old('jenisPerkhidmatan', $spj->Combo230) == 'Kontrek' ? 'selected' : '' }}>Kontrek</option>
            <option value="Sebulan ke Sebulan" {{ old('jenisPerkhidmatan', $spj->Combo230) == 'Sebulan ke Sebulan' ? 'selected' : '' }}>Sebulan ke Sebulan</option>
            <option value="Bergaji Hari" {{ old('jenisPerkhidmatan', $spj->Combo230) == 'Bergaji Hari' ? 'selected' : '' }}>Bergaji Hari</option>
        </select>
        @error('jenisPerkhidmatan')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Jawatan di Sekolah --}}
    <div class="lg:col-span-2 flex flex-col gap-2 mt-4">
        <p class="text-sm">Jawatan di Sekolah</p>
        <input type="text" name="jawatanSekolah" value="{{ old('jawatanSekolah', $spj->jawatanDiSekolah ?? '') }}"
            placeholder="Kosong" class="border px-4 py-2 rounded-md focus:outline-none w-full placeholder:text-gray-200">
        @error('jawatanSekolah')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tarikh Diatur Tempat Bertugas Sekarang - FIXED --}}
    <div class="lg:col-span-2 flex flex-col gap-2 mt-4">
        <p class="text-sm">Tarikh Diatur Tempat Bertugas Sekarang</p>
        <div x-data="{ 
            date: '{{ old('tarikhDiaturBertugasSekarang', $spj->tarikhDiaturBertugasSekarang_formatted ?? '') }}',
            dateClicked: false 
        }"
        x-init="
            const fp = flatpickr($refs.dateAtur, { 
                altInput: true, 
                altFormat: 'j-M-Y', 
                dateFormat: 'Y-m-d', 
                defaultDate: date || null,
                onChange: (selectedDates, dateStr) => { 
                    date = dateStr; 
                    dateClicked = false; 
                }
            });
            $watch('dateClicked', value => { if (value) fp.open(); });
        "
        x-on:click.away="dateClicked = false"
        class="flex items-center border rounded-md cursor-pointer overflow-hidden w-full"
        x-on:click="dateClicked = true">
            <input type="text" x-model="date" x-ref="dateAtur" name="tarikhDiaturBertugasSekarang"
                placeholder="Pilih" readonly
                class="px-4 py-2 w-full focus:outline-none cursor-pointer placeholder:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
            </svg>
        </div>
        @error('tarikhDiaturBertugasSekarang')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Daerah --}}
    <div class="lg:col-span-2 flex flex-col gap-2 mt-4">
        <p class="text-sm">Daerah</p>
        <select name="daerah" class="border px-4 py-2 rounded-md focus:outline-none w-full">
            <option value="">Pilih Daerah</option>
            <option value="Brunei Muara" {{ old('daerah', $spj->daerah) === 'Brunei Muara' ? 'selected' : '' }}>Brunei Muara</option>
            <option value="Tutong" {{ old('daerah', $spj->daerah) === 'Tutong' ? 'selected' : '' }}>Tutong</option>
            <option value="Kuala Belait" {{ old('daerah', $spj->daerah) === 'Kuala Belait' ? 'selected' : '' }}>Kuala Belait</option>
            <option value="Temburong" {{ old('daerah', $spj->daerah) === 'Temburong' ? 'selected' : '' }}>Temburong</option>
        </select>
        @error('daerah')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Section: Jika bertugas di sekolah/maktab --}}
    <div class="lg:col-span-4 pt-6">
        <p class="text-sm text-red-600 font-semibold">Jika bertugas di sekolah/maktab:</p>
    </div>

    {{-- Sekolah / Maktab --}}
    <div class="lg:col-span-2 flex flex-col gap-2">
        <p class="text-sm">Sekolah / Maktab</p>
        <select name="sekolahMaktab" class="border px-4 py-2 rounded-md focus:outline-none w-full">
            <option value="">Pilih Sekolah / Maktab</option>
            @foreach($sekolahOptions as $option)
                <option value="{{ $option }}" {{ old('sekolahMaktab', $spj->lainLainHal) == $option ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
        @error('sekolahMaktab')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Jenis Sekolah Tempat Bertugas --}}
    <div class="lg:col-span-2 flex flex-col gap-2">
        <p class="text-sm">Jenis Sekolah Tempat Bertugas</p>
        <select name="jenisSekolah" class="border px-4 py-2 rounded-md focus:outline-none w-full">
            <option value="">Pilih Jenis Sekolah</option>
            @foreach($jenisSekolahOptions as $option)
                <option value="{{ $option }}" {{ old('jenisSekolah', $spj->Combo317) == $option ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
        @error('jenisSekolah')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Section: Jika bertugas di pejabat --}}
    <div class="lg:col-span-4 pt-6">
        <p class="text-sm text-red-600 font-semibold">Jika bertugas di pejabat:</p>
    </div>

    {{-- Jabatan --}}
<div class="lg:col-span-2 flex flex-col gap-2">
    <p class="text-sm">Jabatan</p>
    <select name="jabatan" class="border px-4 py-2 rounded-md focus:outline-none w-full">
        <option value="">Pilih Jabatan</option>
        @foreach($jabatanOptions as $option)
            <option value="{{ $option }}" {{ old('jabatan', $spj->jabatanTempatBertugas) == $option ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>
    @error('jabatan')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>

    <!-- {{-- Section Code --}}
    <div class="lg:col-span-1 flex flex-col gap-2">
        <p class="text-sm">Section Code</p>
        <input type="text" name="sectionCode" value="{{ old('sectionCode', $spj->sectionCode ?? '') }}"
            placeholder="Kod" class="border px-3 py-2 rounded-md focus:outline-none w-full placeholder:text-gray-200">
        @error('sectionCode')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div> -->

    {{-- Bahagian --}}
<div class="lg:col-span-2 flex flex-col gap-2">
    <p class="text-sm">Bahagian</p>
    <select name="bahagian" class="border px-4 py-2 rounded-md focus:outline-none w-full">
        <option value="">Pilih Bahagian</option>
        @foreach($bahagianOptions as $option)
            <option value="{{ $option }}" {{ old('bahagian', $spj->bahagianTempatBertugas) == $option ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>
    @error('bahagian')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>

    {{-- Unit --}}
    <div class="lg:col-span-2 flex flex-col gap-2 mt-4">
        <p class="text-sm">Unit</p>
        <select name="unit" class="border px-4 py-2 rounded-md focus:outline-none w-full">
            <option value="">Pilih Unit</option>
            @foreach($unitOptions as $option)
                <option value="{{ $option }}" {{ old('unit', $spj->unitTempatBertugas) == $option ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
        @error('unit')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    </div>

    {{-- Submit Button --}}
    <div x-show="activeTab === 2" class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
        <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
            </svg>
            <p>Save Pekerjaan</p>
        </button>
    </div>
</form>

{{-- Tab content wrapper Jawatan Utama Tab --}}
<div x-cloak 
     x-show="activeTab === 3" 
     class="tab-content-wrapper overflow-y-auto relative"
     style="max-height: calc(100vh - 200px);">

    <form id="jawatan-utama-form"
          action="{{ route('pj.save.jawatan', ['id' => $id]) }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="grid grid-cols-1 lg:grid-cols-4 gap-5 pb-40">
        @csrf
        @method('PUT')

       {{-- Gambar (Passport Sized) --}}
<div class="lg:col-span-1 flex flex-col gap-2" 
     x-data="{ photoPreview: '{{ $spj->gambar ? asset('storage/' . $spj->gambar) : '' }}' }">
    <p class="text-sm font-semibold">Gambar</p>
    <div class="w-32 h-40 border rounded-md overflow-hidden flex items-center justify-center bg-gray-100 relative">
        
        {{-- File input --}}
        <input type="file" name="gambar" accept="image/*"
               class="absolute w-full h-full opacity-0 cursor-pointer"
               @change="
                    photoPreview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : '';
                    $refs.removeGambar.value = '0';
               ">

        {{-- Preview (only if photoPreview exists) --}}
        <template x-if="photoPreview">
            <img :src="photoPreview" class="w-full h-full object-cover" />
        </template>

        {{-- Placeholder (only if no photoPreview) --}}
        <template x-if="!photoPreview">
            <span class="text-gray-400 text-center text-sm pointer-events-none">
                Upload
            </span>
        </template>

        {{-- Hidden remove flag --}}
        <input type="hidden" name="remove_gambar" x-ref="removeGambar" value="0">
    </div>

    {{-- Remove button --}}
    <button type="button" 
            @click="
                photoPreview = '';
                $refs.removeGambar.value = '1';
                $el.querySelector('input[type=file]').value = '';
            " 
            class="mt-2 text-gray-600 text-sm font-semibold">
        Remove Picture
    </button>
</div>

        {{-- Summarize + Dropdown --}}
        <div class="lg:col-span-4 flex items-center gap-4 pt-2">
            <p class="text-red-600 font-semibold whitespace-nowrap">Summarize (untuk bahagian I):</p>
            <p class="font-bold text-yellow-600 whitespace-nowrap">Select YES if acting and confirm Bahagian I</p>
            <select name="summarize_bahagian1" 
                    class="border px-4 py-2 rounded-md focus:outline-none w-32">
                <option value="">YES/NO</option>
                <option value="YES" {{ strtoupper($spj->Text260) === 'YES' ? 'selected' : '' }}>YES</option>
                <option value="NO" {{ strtoupper($spj->Text260) === 'NO' ? 'selected' : '' }}>NO</option>
            </select>
        </div>

        {{-- Tarikh Mulai Memangku & Jawatan di Sekolah --}}
        <div class="lg:col-span-4 grid grid-cols-1 lg:grid-cols-2 gap-4 pt-2">
            <div class="flex flex-col gap-2">
                <p class="text-sm">Tarikh Mulai Memangku</p>
                <div 
                    x-data="{ date: '{{ old('tarikhMulaiMemangku', $tarikhMemangku) }}', dateClicked: false }"
                    x-init="
                        const fp = flatpickr($refs.dateMemangku, { 
                            altInput: true, 
                            altFormat: 'j-M-Y', 
                            dateFormat: 'Y-m-d',
                            defaultDate: date || null
                        });
                        $watch('date', value => { fp.setDate(value, true); });
                        $watch('dateClicked', value => { if (value) fp.open(); });
                    "
                    x-on:click.away="dateClicked = false"
                    class="flex items-center border rounded-md cursor-pointer overflow-hidden w-full"
                    x-on:click="dateClicked = true"
                >
                    <input type="text" 
                           x-ref="dateMemangku" 
                           x-model="date" 
                           readonly
                           placeholder="Pilih" 
                           class="px-4 py-2 w-full focus:outline-none cursor-pointer placeholder:text-gray-200"
                           name="tarikhMulaiMemangku">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mx-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Keputusan EDPMMO & CEP --}}
        <div class="lg:col-span-4 flex gap-4 pt-2">
            <div class="flex-1 flex flex-col gap-2">
                <p class="text-sm">Keputusan EDPMMO</p>
                <input 
                    type="text" 
                    name="keputusanEDPMMO" 
                    placeholder="Kosong" 
                    value="{{ old('keputusanEDPMMO', $spj->teach ?? '') }}" 
                    class="border px-4 py-2 rounded-md focus:outline-none w-full placeholder:text-gray-200">
            </div>

            <div class="flex-1 flex flex-col gap-2">
                <p class="text-sm">Keputusan EDP/CEP</p>
                <input 
                    type="text" 
                    name="keputusanCEP" 
                    placeholder="Kosong" 
                    value="{{ old('keputusanCEP', $spj->GO ?? '') }}" 
                    class="border px-4 py-2 rounded-md focus:outline-none w-full placeholder:text-gray-200">
            </div>
        </div>

       {{-- Dua Kertas Kerja Projek --}}
<div class="lg:col-span-4 flex flex-col gap-2 pt-4">
    <p class="text-sm font-semibold">Dua Kertas Kerja Projek</p>
    <textarea 
        name="duaKertasKerjaProjek" 
        placeholder="Kosong" 
        class="border px-4 py-2 rounded-md focus:outline-none w-full h-40 resize-y placeholder:text-gray-200"
    >{{ old('duaKertasKerjaProjek', $spj->duaKertasKerjaProjek ?? '') }}</textarea>
</div>

  {{-- Matrix Table --}}
<div class="lg:col-span-4 pt-4 overflow-x-auto">
    <p class="text-red-600 font-semibold mb-2">Matrix (untuk jawatan Bahagian I - IV):</p>
    
    <div id="matrix-container-{{ $id }}"></div>
    
    <button type="button" 
        id="add-row-btn-{{ $id }}"
        class="mt-2 px-4 py-2 rounded-md hover:bg-blue-600" 
        style="background-color:#3B82F6; color:white;">
        Add Row
    </button>
    
    

<script>
(function() {
    let uniqueCounter = Date.now();
    let existingRows = {!! $matrixRows->toJson() !!};
    let rows = existingRows.map((row) => ({
        uniqueKey: 'existing-' + (row.id || uniqueCounter++) + '-' + Math.random(),
        id: row.id || null,
        jawatan: row.jawatan || '',
        peruntukan: row.peruntukan || '',
        sebab: row.sebab || '',
        mulai: row.mulai || '',
        hingga: row.hingga || ''
    }));
    let deletedIds = [];
    let isAdding = false;

    function render() {
        const container = document.getElementById('matrix-container-{{ $id }}');
        if (!container) return;

        let html = `
            ${deletedIds.map(id => `<input type="hidden" name="deleted_ids[]" value="${id}">`).join('')}
            
            <table class="min-w-full border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">Jawatan yang dipangku</th>
                        <th class="border px-4 py-2 text-left">Peruntukan Jabatan</th>
                        <th class="border px-4 py-2 text-left">Memangku disebabkan</th>
                        <th class="border px-4 py-2 text-left">Mulai</th>
                        <th class="border px-4 py-2 text-left">Hingga</th>
                        <th class="border px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    ${rows.map((row, index) => `
                        <tr>
                            ${row.id ? `<input type="hidden" name="matrix_rows[${index}][id]" value="${row.id}">` : ''}
                            <td class="border px-4 py-2">
                                <input type="text" value="${row.jawatan}" 
                                       name="matrix_rows[${index}][jawatan]"
                                       data-index="${index}" data-field="jawatan"
                                       class="matrix-input border px-2 py-1 w-full rounded-md focus:outline-none" 
                                       placeholder="Jawatan">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" value="${row.peruntukan}"
                                       name="matrix_rows[${index}][peruntukan]"
                                       data-index="${index}" data-field="peruntukan"
                                       class="matrix-input border px-2 py-1 w-full rounded-md focus:outline-none" 
                                       placeholder="Peruntukan">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" value="${row.sebab}"
                                       name="matrix_rows[${index}][sebab]"
                                       data-index="${index}" data-field="sebab"
                                       class="matrix-input border px-2 py-1 w-full rounded-md focus:outline-none" 
                                       placeholder="Sebab">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" value="${row.mulai}"
                                       name="matrix_rows[${index}][mulai]"
                                       data-index="${index}" data-field="mulai"
                                       class="matrix-input border px-2 py-1 w-full rounded-md focus:outline-none">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" value="${row.hingga}"
                                       name="matrix_rows[${index}][hingga]"
                                       data-index="${index}" data-field="hingga"
                                       class="matrix-input border px-2 py-1 w-full rounded-md focus:outline-none">
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button type="button" data-remove-index="${index}"
                                        class="remove-row-btn text-red-600 font-bold hover:text-red-800 px-2 py-1">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    `).join('')}
                </tbody>
            </table>
        `;
        
        container.innerHTML = html;

        // Attach event listeners
        container.querySelectorAll('.matrix-input').forEach(input => {
            input.addEventListener('input', function(e) {
                const index = parseInt(this.dataset.index);
                const field = this.dataset.field;
                rows[index][field] = this.value;
            });
        });

        container.querySelectorAll('.remove-row-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const index = parseInt(this.dataset.removeIndex);
                if (rows[index] && rows[index].id) {
                    deletedIds.push(rows[index].id);
                    console.log('Marked for deletion:', rows[index].id);
                }
                rows.splice(index, 1);
                console.log('Remaining rows:', rows.length);
                render();
            });
        });
    }

    function addRow() {
        if (isAdding) {
            console.log('Already adding, prevented duplicate');
            return;
        }
        isAdding = true;
        console.log('ADD ROW CALLED');
        
        uniqueCounter++;
        const newRow = { 
            uniqueKey: 'new-' + uniqueCounter + '-' + Math.random(),
            id: null, 
            jawatan: '', 
            peruntukan: '', 
            sebab: '', 
            mulai: '', 
            hingga: '' 
        };
        rows.push(newRow);
        console.log('Row added. Total rows:', rows.length);
        render();
        
        setTimeout(() => { isAdding = false; }, 500);
    }

    document.addEventListener('DOMContentLoaded', function() {
        render();
        
        const addBtn = document.getElementById('add-row-btn-{{ $id }}');
        if (addBtn) {
            addBtn.addEventListener('click', addRow);
        }

        const debugBtn = document.getElementById('debug-btn-{{ $id }}');
        if (debugBtn) {
            debugBtn.addEventListener('click', function() {
                console.log('Current rows:', JSON.stringify(rows, null, 2));
            });
        }
    });
})();
</script>
</div>

        {{-- Fixed Submit Button for Jawatan Utama --}}
        <div x-show="activeTab === 3" class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Jawatan Utama</p>
            </button>
        </div>
    </form>
</div>

<script>
function matrixTable_{{ $id }}() {
    let uniqueCounter = Date.now();
    let existingRows = {!! $matrixRows->toJson() !!};
    
    return {rows: existingRows.map((row) => ({
            uniqueKey: 'existing-' + (row.id || uniqueCounter++) + '-' + Math.random(),
            id: row.id || null,
            jawatan: row.jawatan || '',
            peruntukan: row.peruntukan || '',
            sebab: row.sebab || '',
            mulai: row.mulai || '',
            hingga: row.hingga || ''
        })),
        deletedIds: [],
        
        addRow() {
            uniqueCounter++;
            const newRow = { 
                uniqueKey: 'new-' + uniqueCounter + '-' + Math.random(),
                id: null, 
                jawatan: '', 
                peruntukan: '', 
                sebab: '', 
                mulai: '', 
                hingga: '' 
            };
            this.rows.push(newRow);
            console.log('Row added. Total rows:', this.rows.length);
        },
        
        removeRow(index) {
            console.log('Removing row at index:', index);
            
            if (this.rows[index] && this.rows[index].id) {
                this.deletedIds.push(this.rows[index].id);
                console.log('Marked for deletion:', this.rows[index].id);
            }
            
            this.rows.splice(index, 1);
            console.log('Remaining rows:', this.rows.length);
        }
    }
}

// Form submission logger
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('jawatan-utama-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            console.log('=== FORM SUBMISSION DEBUG ===');
            const formData = new FormData(this);
            let matrixData = {};
            
            for (let [key, value] of formData.entries()) {
                if (key.includes('matrix_rows')) {
                    matrixData[key] = value;
                }
            }
            
            console.log('Matrix data being submitted:', matrixData);
            console.log('Total matrix fields:', Object.keys(matrixData).length);
        });
    }
});
</script>

{{-- Melapor Tab Content --}}
<div x-show="activeTab === 4" class="tab-content-wrapper overflow-auto" x-cloak>

    <form action="{{ route('pj.save.melapor', ['id' => $id]) }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="grid grid-cols-1 lg:grid-cols-4 gap-5">
        @csrf
        @method('PUT')

    {{-- Tempat Bertugas Sekarang --}}
    <div class="lg:col-span-2 flex flex-col gap-4 mt-4">
        <p class="text-sm font-semibold">Tempat Bertugas Sekarang</p>
        <input type="text" 
               name="tempatBertugasSekarang" 
               value="{{ old('tempatBertugasSekarang', Str::replaceFirst('Tempat Bertugas Sekarang:', '', $spj->Text171)) }}" 
               placeholder="Kosong"
               class="border px-4 py-2 rounded-md focus:outline-none w-full placeholder:text-gray-200">
    </div>

<div class="lg:col-span-4 pt-4 overflow-x-auto" x-data="tempatBertugasTable()">
    
    <table class="min-w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left">Tarikh Mula Diatur</th>
                <th class="border px-4 py-2 text-left">Tempat Bertugas</th>
                <th class="border px-4 py-2 text-left">Tarikh Hingga</th>
                <th class="border px-4 py-2 text-left">Action</th>
            </tr>
        </thead>
       <tbody>
    {{-- Display saved rows from tempat_bertugas table --}}
    @if(isset($tempatBertugasRows) && $tempatBertugasRows->count() > 0)
        @foreach($tempatBertugasRows as $row)
        <tr>
            <td class="border px-4 py-2">
                <input type="text" value="{{ $row->tarikh_mula_diatur ? $row->tarikh_mula_diatur->format('Y-m-d') : '' }}" 
                    class="border px-2 py-1 w-full rounded-md focus:outline-none"
                    x-init="flatpickr($el, {altInput:true, altFormat:'j-M-Y', dateFormat:'Y-m-d'})"
                    name="tarikhMulaDiatur[]">
            </td>
            <td class="border px-4 py-2">
                <input type="text" value="{{ $row->tempat_bertugas }}" 
                    class="border px-2 py-1 w-full rounded-md focus:outline-none"
                    name="tempatBertugas[]">
            </td>
            <td class="border px-4 py-2">
                <input type="text" value="{{ $row->tarikh_hingga ? $row->tarikh_hingga->format('Y-m-d') : '' }}" 
                    class="border px-2 py-1 w-full rounded-md focus:outline-none"
                    x-init="flatpickr($el, {altInput:true, altFormat:'j-M-Y', dateFormat:'Y-m-d'})"
                    name="tarikhHingga[]">
            </td>
            <td class="border px-4 py-2 text-center">
                <button type="button" class="text-red-600 font-bold" @click="$el.closest('tr').remove()">Remove</button>
            </td>
        </tr>
        @endforeach
    @else
        {{-- Fallback: show old single row from SPJ table if no records in tempat_bertugas --}}
        @php
            $tarikhMulaRaw = $spj->Text172 ?? '';
            $tarikhMulaDate = '';
            if (!empty($tarikhMulaRaw)) {
                $tarikhMulaRaw = trim(preg_replace('/^Tarikh Diatur Tempat Bertugas Sekarang:\s*/i', '', $tarikhMulaRaw));
                try { $tarikhMulaDate = \Carbon\Carbon::createFromFormat('m/d/Y', $tarikhMulaRaw)->format('Y-m-d'); } 
                catch (\Exception $e) { $tarikhMulaDate = $tarikhMulaRaw; }
            }

            $hinggaYmd = '';
            if (!empty($spj->tarikhJawatanSekarang)) {
                try { $hinggaYmd = \Carbon\Carbon::createFromFormat('d-M-y', trim($spj->tarikhJawatanSekarang))->format('Y-m-d'); } 
                catch (\Exception $e) { $hinggaYmd = $spj->tarikhJawatanSekarang; }
            }

            $tempatVal = trim(preg_replace('/^Tempat Bertugas( Sekarang)?:/i', '', $spj->Text170 ?? ''));
        @endphp

        <tr>
            <td class="border px-4 py-2">
                <input type="text" value="{{ $tarikhMulaDate }}" 
                    class="border px-2 py-1 w-full rounded-md focus:outline-none"
                    x-init="flatpickr($el, {altInput:true, altFormat:'j-M-Y', dateFormat:'Y-m-d'})"
                    name="tarikhMulaDiatur[]">
            </td>
            <td class="border px-4 py-2">
                <input type="text" value="{{ $tempatVal }}" 
                    class="border px-2 py-1 w-full rounded-md focus:outline-none"
                    name="tempatBertugas[]">
            </td>
            <td class="border px-4 py-2">
                <input type="text" value="{{ $hinggaYmd }}" 
                    class="border px-2 py-1 w-full rounded-md focus:outline-none"
                    x-init="flatpickr($el, {altInput:true, altFormat:'j-M-Y', dateFormat:'Y-m-d'})"
                    name="tarikhHingga[]">
            </td>
            <td class="border px-4 py-2 text-center">
                <button type="button" class="text-red-600 font-bold" @click="$el.closest('tr').remove()">Remove</button>
            </td>
        </tr>
    @endif

    {{-- New rows added dynamically via Alpine.js --}}
    <template x-for="(row, index) in rows" :key="index">
        <tr>
            <td class="border px-4 py-2">
                <input type="text" x-model="row.mulai" 
                    class="border px-2 py-1 w-full rounded-md focus:outline-none"
                    x-init="flatpickr($el, {altInput:true, altFormat:'j-M-Y', dateFormat:'Y-m-d'})"
                    name="tarikhMulaDiatur[]">
            </td>
            <td class="border px-4 py-2">
                <input type="text" x-model="row.tempat" 
                    class="border px-2 py-1 w-full rounded-md focus:outline-none"
                    name="tempatBertugas[]">
            </td>
            <td class="border px-4 py-2">
                <input type="text" x-model="row.hingga" 
                    class="border px-2 py-1 w-full rounded-md focus:outline-none"
                    x-init="flatpickr($el, {altInput:true, altFormat:'j-M-Y', dateFormat:'Y-m-d'})"
                    name="tarikhHingga[]">
            </td>
            <td class="border px-4 py-2 text-center">
                <button type="button" class="text-red-600 font-bold" @click="removeRow(index)">Remove</button>
            </td>
        </tr>
    </template>
</tbody>
    </table>

    <button type="button" 
        @click="addRow()" 
        class="mt-2 px-4 py-2 rounded-md hover:bg-blue-600" 
        style="background-color:#3B82F6; color:white;">
        Add Row
    </button>

    <script>
    function tempatBertugasTable() {
        return {
            rows: [],
            addRow() {
                this.rows.push({ mulai: '', tempat: '', hingga: '' });
            },
            removeRow(index) {
                this.rows.splice(index, 1);
            }
        }
    }
    </script>
</div>

<!-- {{-- Tarikh Hingga (bottom field) --}}
<div class="lg:col-span-2 flex flex-col gap-2 mt-4">
    <p class="text-sm font-semibold">Tarikh Hingga</p>

    <div 
        x-data="{
            date: '{{ old('tarikhHinggaSingle', $spj->tarikhJawatanSekarang_formatted ?? '') }}',
            dateClicked: false
        }"
        x-init="
            const fp = flatpickr($refs.dateHingga, { 
                altInput: true, 
                altFormat: 'j-M-Y', 
                dateFormat: 'Y-m-d', 
                defaultDate: date,
                onChange: (selectedDates, dateStr) => { date = dateStr; dateClicked = false; }
            });
            $watch('dateClicked', value => { if (value) fp.open(); });
        "
        x-on:click.away="dateClicked = false"
        class="flex items-center border rounded-md cursor-pointer overflow-hidden w-full"
        x-on:click="dateClicked = true"
    >
        <input 
            type="text" 
            x-model="date" 
            x-ref="dateHingga" 
            placeholder="Pilih" 
            class="px-4 py-2 w-full focus:outline-none cursor-pointer placeholder:text-gray-200"
            readonly
            name="tarikhHinggaSingle"
        >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mx-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
        </svg>
    </div>
    @error('tarikhHinggaSingle')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div> -->

{{-- Submit Button for Melapor --}}
<div x-show="activeTab === 4" class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
    <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
        </svg>
        <p>Save Melapor</p>
    </button>
</div>

    </form>
</div>

{{-- Kelulusan Tab Content --}}
<div x-cloak 
     x-show="activeTab === 5" 
     class="tab-content-wrapper overflow-y-auto relative">

    <form action="{{ route('pj.save.kelulusan', ['id' => $id]) }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="grid grid-cols-1 gap-5">
        @csrf
        @method('PUT')

        {{-- Kelulusan Tertinggi --}}
        <div class="flex flex-col gap-2">
            <p class="text-sm font-bold">Kelulusan Tertinggi</p>
            <input 
                type="text" 
                name="kelulusanTertinggi" 
                placeholder="Kosong" 
                value="{{ old('kelulusanTertinggi', $spj->kelulusanTertinggi ?? '') }}"
                class="border px-4 py-2 rounded-md focus:outline-none w-full placeholder:text-gray-200"
            >
        </div>

        {{-- Sijil Guru --}}
        <div class="flex flex-col gap-2">
            <p class="text-sm">Sijil Guru</p>
            <input 
                type="text" 
                name="sijilGuru" 
                placeholder="Kosong" 
                value="{{ old('sijilGuru', $spj->sijilGuru ?? '') }}"
                class="border px-4 py-2 rounded-md focus:outline-none w-full placeholder:text-gray-200"
            >
        </div>

        {{-- Sijil Kerani --}}
        <div class="flex flex-col gap-2">
            <p class="text-sm">Sijil Kerani</p>
            <input 
                type="text" 
                name="sijilKerani" 
                placeholder="Kosong" 
                value="{{ old('sijilKerani', $spj->sijilKerani ?? '') }}"
                class="border px-4 py-2 rounded-md focus:outline-none w-full placeholder:text-gray-200"
            >
        </div>

        {{-- Kursus IPA --}}
        <div class="flex flex-col gap-2">
            <p class="text-sm">Kursus IPA</p>
            <input 
                type="text" 
                name="kursusIPA" 
                placeholder="Kosong" 
                value="{{ old('kursusIPA', $spj->kursusIPA ?? '') }}"
                class="border px-4 py-2 rounded-md focus:outline-none w-full placeholder:text-gray-200"
            >
        </div>

        {{-- GO & FR on one line --}}
        <div class="overflow-x-auto w-full">
            <div class="flex gap-4 min-w-[400px]">
                <div class="flex-1 flex flex-col gap-2 min-w-[180px]">
                    <p class="text-sm">GO</p>
                    <input type="text" name="GO" placeholder="Kosong" 
                           value="{{ old('GO', $spj->GO ?? '') }}"
                           class="border px-4 py-2 rounded-md focus:outline-none w-full placeholder:text-gray-200">
                </div>

                <div class="flex-1 flex flex-col gap-2 min-w-[180px]">
                    <p class="text-sm">FR</p>
                    <input type="text" name="FR" placeholder="Kosong" 
                           value="{{ old('FR', $spj->FR ?? '') }}"
                           class="border px-4 py-2 rounded-md focus:outline-none w-full placeholder:text-gray-200">
                </div>
            </div>
        </div>

        {{-- Fixed Submit Button --}}
        <div x-show="activeTab === 5" class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Kelulusan</p>
            </button>
        </div>
    </form>
</div>

<script>
function previewFile(event, type) {
    const input = event.target;
    const preview = document.getElementById(`preview-${type}`);
    if (input.files && input.files[0]) {
        preview.textContent = input.files[0].name; // show filename
    } else {
        preview.textContent = '';
    }
}
</script>

{{-- Budget Tab --}}
<div x-show="activeTab === 6" class="tab-content-wrapper overflow-y-auto" x-cloak>
    <form action="{{ route('pj.save.budget', ['id' => $id]) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="relative border rounded-md bg-gray-50 p-4 shadow-sm">
            <p class="absolute -top-3 left-4 bg-gray-50 px-2 font-bold text-black">Gaji Sekarang</p>
            <div class="flex flex-wrap gap-6 items-start mt-6">
                <div class="flex flex-col w-1/3">
                    <label class="text-sm font-semibold text-red-600 mt-4">Gaji Sekarang</label>
                    <div class="mt-2 flex items-center border rounded-md overflow-hidden">
                        <span class="px-3 bg-gray-100 text-gray-600">$</span>
                        <input type="text" name="gaji_sekarang" placeholder="0.00"
                               value="{{ old('gaji_sekarang', $spj->gajiSekarang ?? '') }}"
                               class="px-4 py-2 w-full focus:outline-none placeholder:text-gray-400">
                    </div>
                </div>

                <div class="flex flex-col w-1/3">
                    <label class="text-sm font-semibold text-gray-800 mt-4">Tarikh Update</label>
                    <div class="mt-2 flex items-center border rounded-md cursor-pointer overflow-hidden"
                         x-data="{ date: '{{ old('tarikhUpdate', $spj->tarikhUpdate_formatted ?? '') }}', dateClicked: false }"
                         x-init="const fp = flatpickr($refs.tarikhGaji, { altInput: true, altFormat: 'd-M-y', dateFormat: 'Y-m-d', defaultDate: date, onChange: (selectedDates, dateStr) => { date = dateStr; dateClicked = false; }}); $watch('dateClicked', value => { if (value) fp.open(); });"
                         x-on:click.away="dateClicked = false" x-on:click="dateClicked = true">
                        <input type="text" x-model="date" x-ref="tarikhGaji" placeholder="Tarikh Update"
                               class="px-4 py-2 w-full focus:outline-none cursor-pointer placeholder:text-gray-400"
                               readonly name="tarikhUpdate">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mx-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative border rounded-md bg-gray-50 p-4 shadow-sm mt-6">
            <p class="absolute -top-3 left-4 bg-gray-50 px-2 font-bold text-black">Programme and Performance Budgeting (PPB)</p>
            <div class="flex flex-col gap-4 mt-8">
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-red-600">Program</label>
                    <input type="text" name="program" placeholder="Kosong" value="{{ $spj->program ?? '' }}"
                           class="mt-2 px-4 py-2 border rounded-md focus:outline-none w-full placeholder:text-gray-400">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-red-600">Kod Program</label>
                    <input type="text" name="kod_program" placeholder="Kosong" value="{{ $spj->kodProgram ?? '' }}"
                           class="mt-2 px-4 py-2 border rounded-md focus:outline-none w-full placeholder:text-gray-400">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-red-600">Aktiviti</label>
                    <input type="text" name="aktiviti" placeholder="Kosong" value="{{ $spj->aktivitiJabatanJawatan ?? '' }}"
                           class="mt-2 px-4 py-2 border rounded-md focus:outline-none w-full placeholder:text-gray-400">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-red-600">Kod Aktiviti</label>
                    <input type="text" name="kod_aktiviti" placeholder="Kosong" value="{{ $spj->kodAktivitiJabatanJawatan ?? '' }}"
                           class="mt-2 px-4 py-2 border rounded-md focus:outline-none w-full placeholder:text-gray-400">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-red-600">Fungsi Jawatan</label>
                    <input type="text" name="fungsi_jawatan" placeholder="Kosong" value="{{ $spj->fungsiJawatan ?? '' }}"
                           class="mt-2 px-4 py-2 border rounded-md focus:outline-none w-full placeholder:text-gray-400">
                </div>
            </div>
        </div>

        <div class="relative border rounded-md bg-gray-50 p-4 shadow-sm mt-6">
            <p class="absolute -top-3 left-4 bg-gray-50 px-2 font-bold text-black">Peruntukan</p>
            <div class="flex flex-col gap-4 mt-8">
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-red-600">Jabatan</label>
                    <input type="text" name="jabatan" placeholder="Kosong" value="{{ $spj->text322 ?? '' }}"
                           class="mt-2 px-4 py-2 border rounded-md focus:outline-none w-full placeholder:text-gray-400">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-red-600">Bahagian</label>
                    <input type="text" name="bahagian" placeholder="Kosong" value="{{ $spj->bahagianTempatBertugas ?? '' }}"
                           class="mt-2 px-4 py-2 border rounded-md focus:outline-none w-full placeholder:text-gray-400">
                </div>
            </div>
        </div>

        {{-- Fixed Submit Button --}}
        <div x-show="activeTab === 6" class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Budget</p>
            </button>
        </div>
    </form>
</div>

{{-- Kenaikan Gaji Tab Content --}}
<div x-show="activeTab === 7" class="tab-content-wrapper overflow-y-auto" x-cloak>

    <form action="{{ route('pj.save.kenaikan', ['id' => $id]) }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="grid grid-cols-1 lg:grid-cols-4 gap-5">
        @csrf
        @method('PUT')

    {{-- Kenaikan Gaji --}}
    <div class="lg:col-span-2 flex flex-col gap-4 mt-4">
        <p class="text-sm font-semibold">Kenaikan Gaji</p>
    </div>

<div class="lg:col-span-4 pt-4 overflow-x-auto" x-data="kenaikanGajiTable()">
    
    <table class="min-w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left">Tahun</th>
                <th class="border px-4 py-2 text-left">Tarikh Kenaikan</th>
                <th class="border px-4 py-2 text-left">Gaji</th>
                <th class="border px-4 py-2 text-left">Markah Prestasi</th>
                <th class="border px-4 py-2 text-left">Gred Prestasi</th>
                <th class="border px-4 py-2 text-left">Lain-lain</th>
                <th class="border px-4 py-2 text-left">Catatan</th>
                <th class="border px-4 py-2 text-left">Action</th>
            </tr>
        </thead>
       <tbody>
    {{-- Display saved rows from kenaikan_gaji table --}}
    @php
        $hasData = isset($kenaikanGajiRows) && $kenaikanGajiRows->count() > 0;
    @endphp

    @if($hasData)
        @foreach($kenaikanGajiRows as $row)
        <tr>
            <td class="border px-4 py-2">
                <input type="hidden" name="id[]" value="{{ $row->id }}">
                <input type="number" value="{{ $row->tahun }}" name="tahun[]" placeholder="Year" class="border px-2 py-1 w-full rounded-md">
            </td>

            <td class="border px-4 py-2">
                <input type="text"
                    name="tarikhKenaikan[]"
                    class="w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2 text-sm"
                    x-init="flatpickr($el,{
                        altInput: true,
                        altFormat: 'm/d/Y',
                        dateFormat: 'Y-m-d',
                        defaultDate: '{{ $row->tarikh_kenaikan ? $row->tarikh_kenaikan->format('Y-m-d') : '' }}',
                        onReady: function(selectedDates, dateStr, instance) {
                            instance.altInput.placeholder = 'mm/dd/yyyy';
                        }
                    })">
            </td>

            <td class="border px-4 py-2">
                <input type="text" value="{{ $row->gaji }}" name="gaji[]" placeholder="Gaji" class="border px-2 py-1 w-full rounded-md">
            </td>

            <td class="border px-4 py-2">
                <input type="text" value="{{ $row->markah_prestasi }}" placeholder="Markah" name="markahPrestasi[]" class="border px-2 py-1 w-full rounded-md">
            </td>

            <td class="border px-4 py-2">
                <input type="text" value="{{ $row->gred_prestasi }}" placeholder="Gred" name="gredPrestasi[]" class="border px-2 py-1 w-full rounded-md">
            </td>

            <td class="border px-4 py-2">
                <input type="text" value="{{ $row->lain_lain }}" placeholder="Lain-lain" name="lainLain[]" class="border px-2 py-1 w-full rounded-md">
            </td>

            <td class="border px-4 py-2">
                <textarea name="catatan[]" placeholder="Catatan" class="border px-2 py-1 w-full rounded-md">{{ $row->catatan }}</textarea>
            </td>

            <td class="border px-4 py-2 text-center">
                <button type="button" class="text-red-600" @click="$el.closest('tr').remove()">Remove</button>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td class="border px-4 py-2">
                <input type="hidden" name="id[]" value="">
                <input type="number" name="tahun[]" placeholder="Year" class="border px-2 py-1 w-full rounded-md">
            </td>

            <td class="border px-4 py-2">
                <input type="text"
                    name="tarikhKenaikan[]"
                    class="w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2 text-sm"
                    x-init="flatpickr($el,{
                        altInput: true,
                        altFormat: 'm/d/Y',
                        dateFormat: 'Y-m-d',
                        onReady: function(selectedDates, dateStr, instance) {
                            instance.altInput.placeholder = 'mm/dd/yyyy';
                        }
                    })">
            </td>

            <td class="border px-4 py-2">
                <input type="text" name="gaji[]" placeholder="Gaji" class="border px-2 py-1 w-full rounded-md">
            </td>

            <td class="border px-4 py-2">
                <input type="text" name="markahPrestasi[]" placeholder="Markah" class="border px-2 py-1 w-full rounded-md">
            </td>

            <td class="border px-4 py-2">
                <input type="text" name="gredPrestasi[]" placeholder="Gred" class="border px-2 py-1 w-full rounded-md">
            </td>

            <td class="border px-4 py-2">
                <input type="text" name="lainLain[]" placeholder="Lain-lain" class="border px-2 py-1 w-full rounded-md">
            </td>

            <td class="border px-4 py-2">
                <textarea name="catatan[]" placeholder="Catatan" class="border px-2 py-1 w-full rounded-md"></textarea>
            </td>

            <td class="border px-4 py-2 text-center">
                <button type="button" class="text-red-600" @click="$el.closest('tr').remove()">Remove</button>
            </td>
        </tr>
        @endif


    {{-- New rows added dynamically via Alpine.js --}}
    <template x-for="(row, index) in rows" :key="index">
        <tr>
            <td class="border px-4 py-2">
                <input type="hidden" name="id[]" :value="row.id || ''">
                <input type="number" x-model="row.tahun" name="tahun[]" placeholder="Year" class="border px-2 py-1 w-full rounded-md">
            </td>

            <td class="border px-4 py-2">
                <input type="text"
                        name="tarikhKenaikan[]" x-model="row.tarikh"
                        class="border px-2 py-1 w-full rounded-md"
                        x-init="flatpickr($el,{
                            altInput: true,
                            altFormat: 'm/d/Y',
                            dateFormat: 'Y-m-d',
                            defaultDate: row.tarikh || null,
                            onChange: function(selectedDates, dateStr) {
                                row.tarikh = dateStr; // store Y-m-d
                            },
                            onReady: function(selectedDates, dateStr, instance) {
                                instance.altInput.placeholder = 'mm/dd/yyyy';
                            }
                        })">
            </td>

            <td class="border px-4 py-2">
                <input type="text" x-model="row.gaji" name="gaji[]" placeholder="Gaji" class="border px-2 py-1 w-full rounded-md">
            </td>

            <td class="border px-4 py-2">
                <input type="text" x-model="row.markah" name="markahPrestasi[]" placeholder="Markah" class="border px-2 py-1 w-full rounded-md">
            </td>

            <td class="border px-4 py-2">
                <input type="text" x-model="row.gred" name="gredPrestasi[]" placeholder="Gred" class="border px-2 py-1 w-full rounded-md">
            </td>

            <td class="border px-4 py-2">
                <input type="text" x-model="row.lain" name="lainLain[]" placeholder="Lain-lain" class="border px-2 py-1 w-full rounded-md">
            </td>

            <td class="border px-4 py-2">
                <textarea x-model="row.catatan" name="catatan[]" placeholder="Catatan" class="border px-2 py-1 w-full rounded-md"></textarea>
            </td>

            <td class="border px-4 py-2 text-center">
                <button type="button" @click="removeRow(index)" class="text-red-600">Remove</button>
            </td>
        </tr>
    </template>
</tbody>
    </table>

    <button type="button" 
        @click="addRow()" 
        class="mt-2 px-4 py-2 rounded-md hover:bg-blue-600" 
        style="background-color:#3B82F6; color:white;">
        Add Row
    </button>

    <script>
    function kenaikanGajiTable() {
        return {
            rows: [],
            addRow() {
                this.rows.push({ id: '', tahun: '', tarikh: '', gaji: '', markah: '', gred: '', lain: '', catatan: '' });
            },
            removeRow(index) {
                this.rows.splice(index, 1);
            }
        }
    }
    </script>
</div>

{{-- Submit Button for Kenaikan Gaji --}}
<div x-show="activeTab === 7" class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
    <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
        </svg>
        <p>Save Kenaikan Gaji</p>
    </button>
</div>
</form>
</div>


{{-- Cuti Tab Content --}}
<div x-show="activeTab === 8" class="tab-content-wrapper overflow-y-auto" x-cloak>

    <form action="{{ route('pj.save.cuti', ['id' => $id]) }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="grid grid-cols-1 lg:grid-cols-4 gap-5">
        @csrf
        @method('PUT')

    {{-- Cuti Khas --}}
    <div class="lg:col-span-2 flex flex-col gap-4 mt-4">
        <p class="text-sm font-semibold">Cuti Khas</p>
    </div>

<div class="lg:col-span-4 pt-4 overflow-x-auto" x-data="cutiKhasTable()">

    <table class="min-w-full border border-gray-300">
    <thead class="bg-gray-100">
    <tr>
        <th class="border px-4 py-2">Tarikh Mula</th>
        <th class="border px-4 py-2">Tarikh Tamat</th>
        <th class="border px-4 py-2">Jumlah</th>
        <th class="border px-4 py-2">Sebab</th>
        <th class="border px-4 py-2">Kategori</th>
        <th class="border px-4 py-2">Catatan</th>
        <th class="border px-4 py-2">Tarikh Lapor</th>
        <th class="border px-4 py-2">Action</th>
    </tr>
    </thead>

    <tbody>
    @php
        $cutiKhasData = (isset($cutiKhasRows) && $cutiKhasRows->count())
            ? $cutiKhasRows
            : [null];
    @endphp

    @foreach($cutiKhasData as $row)
    <tr>
        <td class="border px-4 py-2"><input type="text"
            name="ck_tarikh_mula[]"
            value="{{ $row->tarikh_mula ?? '' }}"
            class="border px-2 py-1 w-full rounded-md"
            x-init="flatpickr($el,{
                altInput: true,
                altFormat: 'm/d/Y',
                dateFormat: 'Y-m-d',
                defaultDate: '{{ $row->tarikh_mula ?? '' }}',
                onChange: function(selectedDates, dateStr, instance) {
                    let tr = instance.element.closest('tr');
                    calculateJumlahDOM(tr,
                        'ck_tarikh_mula[]',
                        'ck_tarikh_tamat[]',
                        'ck_jumlah[]');
                },
                onReady: function(_,__,instance) {
                    instance.altInput.placeholder = 'mm/dd/yyyy';
                }
            })"></td>
        <td class="border px-4 py-2"><input type="text" 
            name="ck_tarikh_tamat[]" 
            value="{{ $row->tarikh_tamat ?? '' }}" 
            class="border px-2 py-1 w-full rounded-md" 
            x-init="flatpickr($el,{
                altInput: true,
                altFormat: 'm/d/Y',
                dateFormat:'Y-m-d',
                defaultDate: '{{ $row->tarikh_tamat ?? '' }}',
                onChange: function(selectedDates, dateStr, instance) {
                    let tr = instance.element.closest('tr');
                    calculateJumlahDOM(tr,
                        'ck_tarikh_mula[]',
                        'ck_tarikh_tamat[]',
                        'ck_jumlah[]');
                },
                onReady: function(_,__,instance) {
                    instance.altInput.placeholder = 'mm/dd/yyyy';
                }
            })"></td>
        <td class="border px-4 py-2"><input type="text" name="ck_jumlah[]" value="{{ $row->jumlah ?? '' }}" placeholder="Jumlah" readonly class="border px-2 py-1 w-full rounded-md"></td>
        <td class="border px-4 py-2"><textarea name="ck_sebab[]" rows="2" placeholder="Sebab" class="border px-2 py-1 w-full rounded-md">{{ $row->sebab ?? '' }}</textarea></td>
        <td class="border px-4 py-2"><input type="text" name="ck_kategori[]" value="{{ $row->kategori ?? '' }}" placeholder="Kategori" class="border px-2 py-1 w-full rounded-md"></td>
        <td class="border px-4 py-2"><textarea name="ck_catatan[]" rows="2" placeholder="Catatan" class="border px-2 py-1 w-full rounded-md">{{ $row->catatan ?? '' }}</textarea></td>
        <td class="border px-4 py-2"><input type="text" 
            name="ck_tarikh_lapor[]" 
            value="{{ $row->tarikh_lapor ?? '' }}" 
            class="border px-2 py-1 w-full rounded-md" 
            x-init="flatpickr($el,{
                altInput: true,
                altFormat: 'm/d/Y',
                dateFormat:'Y-m-d',
                defaultDate: '{{ $row->tarikh_lapor ?? '' }}',
                onReady: function(selectedDates, dateStr, instance) {
                    instance.altInput.placeholder = 'mm/dd/yyyy';
                }
            })"></td>
        <td class="border px-4 py-2 text-center">
            <button type="button" @click="$el.closest('tr').remove()" class="text-red-600">Remove</button>
        </td>
    </tr>
    @endforeach

    <template x-for="(row,index) in rows" :key="index">
    <tr>
        <td class="border px-4 py-2"><input type="text"
                        name="ck_tarikh_mula[]" x-model="row.mula"
                        class="border px-2 py-1 w-full rounded-md"
                        x-init="flatpickr($el,{
                            altInput: true,
                            altFormat: 'm/d/Y',
                            dateFormat: 'Y-m-d',
                            defaultDate: row.mula || null,
                            onChange: function(selectedDates, dateStr) {
                                row.mula = dateStr;
                                $nextTick(() => $data.calculateJumlah(row));
                            },
                            onReady: function(_,__,instance){
                                instance.altInput.placeholder = 'mm/dd/yyyy';
                            }
                        })"></td>
        <td class="border px-4 py-2"><input type="text"
                        name="ck_tarikh_tamat[]" x-model="row.tamat"
                        class="border px-2 py-1 w-full rounded-md"
                        x-init="flatpickr($el,{
                            altInput: true,
                            altFormat: 'm/d/Y',
                            dateFormat: 'Y-m-d',
                            defaultDate: row.tamat || null,
                            onChange: function(selectedDates, dateStr) {
                                row.tamat = dateStr;
                                $nextTick(() => $data.calculateJumlah(row));
                            },
                            onReady: function(_,__,instance){
                                instance.altInput.placeholder = 'mm/dd/yyyy';
                            }
                        })"></td>
        <td class="border px-4 py-2"><input type="text" x-model="row.jumlah" readonly name="ck_jumlah[]" placeholder="Jumlah" class="border px-2 py-1 w-full rounded-md"></td>
        <td class="border px-4 py-2"><textarea x-model="row.sebab" rows="2" placeholder="Sebab" class="border px-2 py-1 w-full rounded-md"></textarea></td>
        <td class="border px-4 py-2"><input type="text" x-model="row.kategori" name="ck_kategori[]" placeholder="Kategori" class="border px-2 py-1 w-full rounded-md"></td>
        <td class="border px-4 py-2"><textarea x-model="row.catatan" rows="2" placeholder="Catatan" class="border px-2 py-1 w-full rounded-md"></textarea></td>
        <td class="border px-4 py-2"><input type="text"
                        name="ck_tarikh_lapor[]" x-model="row.lapor"
                        class="border px-2 py-1 w-full rounded-md"
                        x-init="flatpickr($el,{
                            altInput: true,
                            altFormat: 'm/d/Y',
                            dateFormat: 'Y-m-d',
                            defaultDate: row.lapor || null,
                            onChange: function(selectedDates, dateStr) {
                                row.lapor = dateStr; // store Y-m-d
                            },
                            onReady: function(selectedDates, dateStr, instance) {
                                instance.altInput.placeholder = 'mm/dd/yyyy';
                            }
                        })"></td>
        <td class="border px-4 py-2 text-center">
            <button type="button" @click="removeRow(index)" class="text-red-600">Remove</button>
        </td>
    </tr>
    </template>
    </tbody>
    </table>

    <button type="button" @click="addRow()" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Add Row</button>
    </div>

        {{-- Cuti Tanpa Gaji--}}
        <div class="lg:col-span-2 flex flex-col gap-4 mt-4">
            <p class="text-sm font-semibold">Cuti Tanpa Gaji</p>
        </div>

    <div class="lg:col-span-4 pt-4 overflow-x-auto" x-data="cutiTanpaGajiTable()">
    
    <table class="min-w-full border border-gray-300">
    <thead class="bg-gray-100">
    <tr>
        <th class="border px-4 py-2">Tarikh Mula</th>
        <th class="border px-4 py-2">Tarikh Tamat</th>
        <th class="border px-4 py-2">Jumlah</th>
        <th class="border px-4 py-2">Sebab</th>
        <th class="border px-4 py-2">Kategori</th>
        <th class="border px-4 py-2">Catatan</th>
        <th class="border px-4 py-2">Tarikh Lapor</th>
        <th class="border px-4 py-2">Action</th>
    </tr>
    </thead>

    <tbody>
    @php
        $cutiTanpaGajiData = (isset($cutiTanpaGajiRows) && $cutiTanpaGajiRows->count())
            ? $cutiTanpaGajiRows
            : [null];
    @endphp

    @foreach($cutiTanpaGajiData as $row)
    <tr>
    <td class="border px-4 py-2"><input type="text"
            name="ctg_tarikh_mula[]"
            value="{{ $row->tarikh_mula ?? '' }}"
            class="border px-2 py-1 w-full rounded-md"
            x-init="flatpickr($el,{
                altInput: true,
                altFormat: 'm/d/Y',
                dateFormat: 'Y-m-d',
                defaultDate: '{{ $row->tarikh_mula ?? '' }}',
                onChange: function(selectedDates, dateStr, instance) {
                    let tr = instance.element.closest('tr');
                    calculateJumlahDOM(tr,
                        'ctg_tarikh_mula[]',
                        'ctg_tarikh_tamat[]',
                        'ctg_jumlah[]');
                },
                onReady: function(_,__,instance) {
                    instance.altInput.placeholder = 'mm/dd/yyyy';
                }
            })"></td>
        <td class="border px-4 py-2"><input type="text" 
            name="ctg_tarikh_tamat[]" 
            value="{{ $row->tarikh_tamat ?? '' }}" 
            class="border px-2 py-1 w-full rounded-md" 
            x-init="flatpickr($el,{
                altInput: true,
                altFormat: 'm/d/Y',
                dateFormat:'Y-m-d',
                defaultDate: '{{ $row->tarikh_tamat ?? '' }}',
                onChange: function(selectedDates, dateStr, instance) {
                    let tr = instance.element.closest('tr');
                    calculateJumlahDOM(tr,
                        'ctg_tarikh_mula[]',
                        'ctg_tarikh_tamat[]',
                        'ctg_jumlah[]');
                },
                onReady: function(_,__,instance) {
                    instance.altInput.placeholder = 'mm/dd/yyyy';
                }
            })"></td>
        <td class="border px-4 py-2"><input type="text" name="ctg_jumlah[]" value="{{ $row->jumlah ?? '' }}" placeholder="Jumlah" readonly class="border px-2 py-1 w-full rounded-md"></td>
        <td class="border px-4 py-2"><textarea name="ctg_sebab[]" rows="2" placeholder="Sebab" class="border px-2 py-1 w-full rounded-md">{{ $row->sebab ?? '' }}</textarea></td>
        <td class="border px-4 py-2"><input type="text" name="ctg_kategori[]" value="{{ $row->kategori ?? '' }}" placeholder="Kategori" class="border px-2 py-1 w-full rounded-md"></td>
        <td class="border px-4 py-2"><textarea name="ctg_catatan[]" rows="2" placeholder="Catatan" class="border px-2 py-1 w-full rounded-md">{{ $row->catatan ?? '' }}</textarea></td>
        <td class="border px-4 py-2"><input type="text" 
            name="ctg_tarikh_lapor[]" 
            value="{{ $row->tarikh_lapor ?? '' }}" 
            class="border px-2 py-1 w-full rounded-md" 
            x-init="flatpickr($el,{
                altInput: true,
                altFormat: 'm/d/Y',
                dateFormat:'Y-m-d',
                defaultDate: '{{ $row->tarikh_lapor ?? '' }}',
                onReady: function(selectedDates, dateStr, instance) {
                    instance.altInput.placeholder = 'mm/dd/yyyy';
                }
            })"></td>
        <td class="border px-4 py-2 text-center">
            <button type="button" @click="$el.closest('tr').remove()" class="text-red-600">Remove</button>
        </td>
    </tr>
    @endforeach

    <template x-for="(row,index) in rows" :key="index">
    <tr>
        <td class="border px-4 py-2"><input type="text"
                        name="ctg_tarikh_mula[]" x-model="row.mula"
                        class="border px-2 py-1 w-full rounded-md"
                        x-init="flatpickr($el,{
                            altInput: true,
                            altFormat: 'm/d/Y',
                            dateFormat: 'Y-m-d',
                            defaultDate: row.mula || null,
                            onChange: function(selectedDates, dateStr) {
                                row.mula = dateStr;
                                $nextTick(() => $data.calculateJumlah(row));
                            },
                            onReady: function(_,__,instance){
                                instance.altInput.placeholder = 'mm/dd/yyyy';
                            }
                        })"></td>
        <td class="border px-4 py-2"><input type="text"
                        name="ctg_tarikh_tamat[]" x-model="row.tamat"
                        class="border px-2 py-1 w-full rounded-md"
                        x-init="flatpickr($el,{
                            altInput: true,
                            altFormat: 'm/d/Y',
                            dateFormat: 'Y-m-d',
                            defaultDate: row.tamat || null,
                            onChange: function(selectedDates, dateStr) {
                                row.tamat = dateStr;
                                $nextTick(() => $data.calculateJumlah(row));
                            },
                            onReady: function(_,__,instance){
                                instance.altInput.placeholder = 'mm/dd/yyyy';
                            }
                        })"></td>
        <td class="border px-4 py-2"><input type="text" x-model="row.jumlah" readonly name="ctg_jumlah[]" placeholder="Jumlah" class="border px-2 py-1 w-full rounded-md"></td>
        <td class="border px-4 py-2"><textarea x-model="row.sebab" rows="2" placeholder="Sebab" class="border px-2 py-1 w-full rounded-md"></textarea></td>
        <td class="border px-4 py-2"><input type="text" x-model="row.kategori" name="ctg_kategori[]" placeholder="Kategori" class="border px-2 py-1 w-full rounded-md"></td>
        <td class="border px-4 py-2"><textarea x-model="row.catatan" rows="2" placeholder="Catatan" class="border px-2 py-1 w-full rounded-md"></textarea></td>
        <td class="border px-4 py-2"><input type="text"
                        name="ctg_tarikh_lapor[]" x-model="row.lapor"
                        class="border px-2 py-1 w-full rounded-md"
                        x-init="flatpickr($el,{
                            altInput: true,
                            altFormat: 'm/d/Y',
                            dateFormat: 'Y-m-d',
                            defaultDate: row.lapor || null,
                            onChange: function(selectedDates, dateStr) {
                                row.lapor = dateStr; // store Y-m-d
                            },
                            onReady: function(selectedDates, dateStr, instance) {
                                instance.altInput.placeholder = 'mm/dd/yyyy';
                            }
                        })"></td>
        <td class="border px-4 py-2 text-center">
            <button type="button" @click="removeRow(index)" class="text-red-600">Remove</button>
        </td>
    </tr>
    </template>
    </tbody>
    </table>

    <button type="button" @click="addRow()" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Add Row</button>
    </div>

    <script>
    function cutiKhasTable() {
        return {
            rows: [],

            addRow() {
                this.rows.push({
                    mula:'', tamat:'', jumlah:'',
                    sebab:'', kategori:'', catatan:'', lapor:''
                });
            },

            removeRow(i){
                this.rows.splice(i,1);
            },

            calculateJumlah(row) {
                if (row.mula && row.tamat) {
                    let start = new Date(row.mula);
                    let end = new Date(row.tamat);

                    if (!isNaN(start) && !isNaN(end) && end >= start) {
                        let diff = (end - start) / (1000 * 60 * 60 * 24) + 1;
                        row.jumlah = diff;
                    } else {
                        row.jumlah = '';
                    }
                }
            }
        }
    }

    function cutiTanpaGajiTable() {
        return {
            rows: [],

            addRow() {
                this.rows.push({
                    mula:'', tamat:'', jumlah:'',
                    sebab:'', kategori:'', catatan:'', lapor:''
                });
            },

            removeRow(i){
                this.rows.splice(i,1);
            },

            calculateJumlah(row) {
                if (row.mula && row.tamat) {
                    let start = new Date(row.mula);
                    let end = new Date(row.tamat);

                    if (!isNaN(start) && !isNaN(end) && end >= start) {
                        let diff = (end - start) / (1000 * 60 * 60 * 24) + 1;
                        row.jumlah = diff;
                    } else {
                        row.jumlah = '';
                    }
                }
            }
        }
    }
    </script>
</div>

{{-- Submit Button for Cuti --}}
<div x-show="activeTab === 8" class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
    <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
        </svg>
        <p>Save Cuti</p>
    </button>
</div>
</form>
</div>


{{-- Bersara / Menamatkan Tab --}}
<div x-show="activeTab === 9" class="tab-content-wrapper overflow-y-auto" x-cloak>

    <form action="{{ route('pj.save.bersara', ['id' => $id]) }}" 
          method="POST" 
          class="space-y-6">
        @csrf
        @method('PUT')

   <!-- PERUNTUKAN (Red Frame) -->
<div class="relative border-2 border-red-600 rounded-md bg-red-50 p-4 shadow-sm">
    <p class="absolute -top-3 left-4 bg-red-50 px-2 font-bold text-red-700">PERUNTUKAN</p>
    <div class="flex flex-col mt-6">
        <input type="text" name="peruntukan" placeholder="Kosong"
               value="{{ str_replace('Peruntukan:', '', $spj->Text169 ?? '') }}"
               class="px-4 py-2 border rounded-md focus:outline-none w-full placeholder:text-gray-400">
    </div>
</div>

<!-- Jawatan -->
<div class="flex flex-col mt-4">
    <label class="text-sm font-semibold text-gray-800">Jawatan</label>
    <input type="text" name="jawatan" placeholder="Kosong"
           value="{{ $spj->Text242 ?? '' }}"
           class="mt-2 px-4 py-2 border rounded-md focus:outline-none w-full placeholder:text-gray-400">
</div>

<!-- Bersara / Tamat Kontrak (Blue Frame) -->
<div class="relative border-2 border-blue-600 rounded-md bg-blue-50 p-4 shadow-sm mt-6">

    <div class="flex flex-col gap-4 mt-6">

        <!-- Filter Bersara -->
        <div class="flex flex-col w-1/3">
            <label class="text-sm font-semibold text-blue-700">Filter Bersara</label>
            <select name="filter_bersara" class="mt-2 px-4 py-2 border rounded-md focus:outline-none w-full">
                <option value="">-- Pilih --</option>
                @php
                    $options = [
                        'BERSARA',
                        'MENAMATKAN PERKHIDMATAN',
                        'MENINGGAL DUNIA',
                        'TAMAT KONTRAK',
                        'TATATERTIB',
                        'DI BUANG KERJA',
                        'NAIK PANGKAT',
                        'NAIK PANGKAT/PINDAH'
                    ];
                @endphp
                @foreach($options as $option)
                    <option value="{{ $option }}" {{ ($spj->Combo251 ?? '') === $option ? 'selected' : '' }}>
                        {{ $option }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Peruntukan Bersara/Tamat -->
        <div class="flex flex-col w-1/3">
            <label class="text-sm font-semibold text-blue-700">Peruntukan Bersara/Tamat</label>
            <input type="text" name="peruntukan_bersara" placeholder="Kosong"
                   value="{{ $spj->peruntukanBersara ?? '' }}"
                   class="mt-2 px-4 py-2 border rounded-md focus:outline-none w-full placeholder:text-gray-400">
        </div>

        <!-- Jawatan Bersara/Tamat -->
        <div class="flex flex-col w-1/3">
            <label class="text-sm font-semibold text-blue-700">Jawatan Bersara/Tamat</label>
            <input type="text" name="jawatan_bersara" placeholder="Kosong"
                   value="{{ $spj->jawatanBersara ?? '' }}"
                   class="mt-2 px-4 py-2 border rounded-md focus:outline-none w-full placeholder:text-gray-400">
        </div>

       <!-- Tarikh Bersara & Tatatertib -->
<div class="flex flex-col w-1/3"
     x-data="{
         tatatertibChecked: {{ ($spj->tatatertib ?? 0) ? 'true' : 'false' }},
         tarikhBersara: '{{ $spj->tarikhBersara ?? $spj->tarikhBersara_formatted ?? '' }}',
         tarikhBersaraOverride: '{{ $spj->tarikhBersara ?? '' }}',
         catatanTatatertib: '{{ addslashes($spj->catatanTatatertib ?? '') }}'
     }">
    <label class="text-sm font-semibold text-blue-700">Tarikh Bersara</label>
    <input type="text"
           name="tarikhBersara"
           x-model="tarikhBersara"
           class="mt-2 px-4 py-2 border rounded-md w-52 placeholder:text-gray-400"
           readonly>

    <div class="flex flex-col gap-2 mt-2">
        <label class="flex items-center gap-2">
            <input type="checkbox"
                   class="form-checkbox h-5 w-5 text-blue-600"
                   name="tatatertib"
                   value="1"
                   x-model="tatatertibChecked"
                   :checked="tatatertibChecked">
            <span class="text-sm">Tatatertib</span>
        </label>

        <!-- Shown only if Tatatertib is checked -->
        <div x-show="tatatertibChecked" class="flex flex-col gap-2 mt-2">
            <input type="date"
                   name="tarikhBersaraOverride"
                   x-model="tarikhBersaraOverride"
                   class="border px-4 py-2 rounded-md"
                   x-on:input="tarikhBersara = $event.target.value">

            <textarea name="catatanTatatertib"
                      rows="3"
                      placeholder="Catatan Tatatertib..."
                      x-model="catatanTatatertib"
                      class="border px-4 py-2 rounded-md"></textarea>
        </div>
    </div>
</div>

        <!-- Tarikh Cuti Bersara -->
<div class="flex flex-col w-1/3" 
     x-data="{ date: '{{ old('tarikh_cuti', $spj->tarikhCutiBersara ?? '') }}', dateClicked: false }"
     x-init="
         const fp1 = flatpickr($refs.tarikhCuti, { 
             altInput: true, 
             altFormat: 'j-M-Y', 
             dateFormat: 'd-m-Y', 
             mode: 'range',
             defaultDate: date ? date : null,
             onChange: (selectedDates, dateStr) => { date = dateStr; dateClicked = false; }
         });
         $watch('dateClicked', value => { if (value) fp1.open(); });
     "
     x-on:click.away="dateClicked = false"
     x-on:click="dateClicked = true"
>
    <label class="text-sm font-semibold text-blue-700">Tarikh Cuti Bersara</label>
    <input type="text" x-model="date" x-ref="tarikhCuti" placeholder="Tarikh Cuti Bersara"
           class="mt-2 px-4 py-2 border rounded-md focus:outline-none cursor-pointer w-full placeholder:text-gray-400" 
           readonly 
           name="tarikh_cuti">
</div>

        <!-- Tarikh Tamat Kontrak / Berhenti -->
        <div class="flex flex-col w-1/3"
             x-data="{ 
                 date: '{{ old('tarikh_tamat', $spj->tarikhTamatKontrak_formatted ?? '') }}', 
                 dateClicked: false 
             }"
             x-init="
                 const fp2 = flatpickr($refs.tarikhTamat, { 
                     altInput: true, 
                     altFormat: 'j-M-Y', 
                     dateFormat: 'Y-m-d', 
                     defaultDate: date ? date : null,
                     onChange: (selectedDates, dateStr) => { date = dateStr; dateClicked = false; }
                 });
                 $watch('dateClicked', value => { if (value) fp2.open(); });
             "
             x-on:click.away="dateClicked = false"
             x-on:click="dateClicked = true"
        >
            <label class="text-sm font-semibold text-blue-700">Tarikh Tamat Kontrak / Berhenti</label>
            <input type="text" 
                   x-model="date" 
                   x-ref="tarikhTamat" 
                   placeholder="Tarikh Tamat Kontrak / Berhenti"
                   class="mt-2 px-4 py-2 border rounded-md focus:outline-none cursor-pointer w-full placeholder:text-gray-400" 
                   readonly 
                   name="tarikh_tamat">
        </div>

    </div>

</div>

<!-- ULASAN Section -->
<div class="relative border-2 border-gray-600 rounded-md bg-gray-100 p-6 shadow-md mt-6" x-data="ulasanTable()">
    <p class="absolute -top-3 left-4 bg-gray-100 px-2 font-bold text-gray-800">Ulasan</p>

    {{-- Display saved ulasan from database --}}
    @if(isset($ulasanBersaraRows) && $ulasanBersaraRows->count() > 0)
        @foreach($ulasanBersaraRows as $row)
        <div class="mt-8 border-b pb-6 last:border-b-0">
            <div class="flex flex-col md:flex-row gap-4 items-start">
                <div class="flex flex-col w-1/3">
                    <label class="text-sm font-semibold text-gray-800">Tarikh</label>
                    <div class="mt-2 flex items-center border rounded-md cursor-pointer overflow-hidden"
                         x-data="{ date: '{{ $row->tarikh ? $row->tarikh->format('Y-m-d') : '' }}', dateClicked: false }"
                         x-init="flatpickr($refs.dateInput, { 
                             altInput: true, 
                             altFormat: 'j-M-Y', 
                             dateFormat: 'Y-m-d', 
                             defaultDate: date ? date : null,
                             onChange: (selectedDates, dateStr) => { date = dateStr; dateClicked = false; } 
                         })"
                         x-on:click.away="dateClicked = false"
                         x-on:click="dateClicked = true"
                    >
                        <input type="text" 
                               name="ulasan_date[]"
                               x-model="date" 
                               x-ref="dateInput" 
                               placeholder="Pilih Tarikh"
                               class="px-4 py-2 w-full focus:outline-none cursor-pointer placeholder:text-gray-400" 
                               readonly>
                    </div>
                </div>

                <div class="flex-1 flex flex-col">
                    <label class="text-sm font-semibold text-gray-800">Ulasan</label>
                    <textarea name="ulasan_text[]"
                              placeholder="Tulis ulasan di sini..."
                              class="mt-2 w-full h-32 px-4 py-3 border rounded-md focus:outline-none resize-y placeholder:text-gray-400">{{ $row->ulasan_text }}</textarea>
                </div>

                <div class="flex items-center mt-6 md:mt-0">
                    <button type="button" onclick="this.closest('.mt-8').remove()" 
                            class="text-red-600 font-bold px-2 py-1 rounded-md border border-red-600 hover:bg-red-600 hover:text-white">
                        Remove
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    @endif

    {{-- Container for new rows added dynamically via Alpine.js --}}
    <div id="dynamic-rows-container">
        <template x-for="(row, index) in rows" :key="index">
            <div class="mt-8 border-b pb-6 last:border-b-0">
                <div class="flex flex-col md:flex-row gap-4 items-start">
                    <div class="flex flex-col w-1/3">
                        <label class="text-sm font-semibold text-gray-800">Tarikh</label>
                        <div class="mt-2 flex items-center border rounded-md cursor-pointer overflow-hidden"
                             x-data="{ dateClicked: false }"
                             x-init="flatpickr($refs.dateInput, { 
                                 altInput: true, 
                                 altFormat: 'j-M-Y', 
                                 dateFormat: 'Y-m-d', 
                                 defaultDate: row.date ? row.date : null,
                                 onChange: (selectedDates, dateStr) => { row.date = dateStr; dateClicked = false; } 
                             })"
                             x-on:click.away="dateClicked = false"
                             x-on:click="dateClicked = true"
                        >
                            <input type="text" 
                                   name="ulasan_date[]"
                                   x-model="row.date" 
                                   x-ref="dateInput" 
                                   placeholder="Pilih Tarikh"
                                   class="px-4 py-2 w-full focus:outline-none cursor-pointer placeholder:text-gray-400" 
                                   readonly>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-col">
                        <label class="text-sm font-semibold text-gray-800">Ulasan</label>
                        <textarea x-model="row.text" 
                                  name="ulasan_text[]"
                                  placeholder="Tulis ulasan di sini..."
                                  class="mt-2 w-full h-32 px-4 py-3 border rounded-md focus:outline-none resize-y placeholder:text-gray-400"></textarea>
                    </div>

                    <div class="flex items-center mt-6 md:mt-0">
                        <button type="button" @click="removeRow(index)" 
                                class="text-red-600 font-bold px-2 py-1 rounded-md border border-red-600 hover:bg-red-600 hover:text-white">
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Add button -->
    <div class="mt-4">
        <button type="button" @click="addRow()" 
                class="px-4 py-2 rounded-md text-white font-semibold shadow"
                style="background-color: #2563EB;">
            Tambah Ulasan
        </button>
    </div>
</div>

<script>
function ulasanTable() {
    return {
        rows: [],
        addRow() {
            this.rows.push({ text: '', date: null });
        },
        removeRow(index) {
            this.rows.splice(index, 1);
        }
    }
}
</script>

{{-- Fixed Submit Button for Bersara/Menamatkan --}}
<div x-show="activeTab === 9" class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
    <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
        </svg>
        <p>Save Bersara/Menamatkan</p>
    </button>
</div>

    </form>
</div>

{{-- SPG Tab --}}
<div x-show="activeTab === 10" class="tab-content-wrapper" x-cloak>
    <form action="{{ route('pj.save.spg', ['id' => $id]) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="relative border rounded-md p-4">
            <p class="absolute -top-3 left-4 bg-white px-2 font-bold text-black">SPG</p>

            <div class="flex flex-wrap gap-6 mt-6">
                <div class="flex flex-col w-1/3">
                    <label class="text-sm font-semibold text-gray-800 mt-4">Tarikh Mula Berkhidmat</label>
                    <div class="mt-2 flex items-center border rounded-md cursor-pointer overflow-hidden"
                         x-data="{ date: '{{ old('tarikh_mula', $spj->tarikhMulaBerkhidmat_formatted ?? '') }}', dateClicked: false }"
                         x-init="const fp = flatpickr($refs.tarikhMula, { altInput: true, altFormat: 'j-M-Y', dateFormat: 'Y-m-d', defaultDate: date, allowInput: true, onChange: (selectedDates, dateStr) => { date = dateStr; dateClicked = false; }}); $watch('dateClicked', value => { if (value) fp.open(); });"
                         x-on:click.away="dateClicked = false" x-on:click="dateClicked = true">
                        <input type="text" x-model="date" x-ref="tarikhMula" placeholder="Tarikh Mula Berkhidmat"
                               class="px-4 py-2 w-full focus:outline-none cursor-pointer placeholder:text-gray-400"
                               readonly name="tarikh_mula">
                    </div>
                </div>

                <div class="flex flex-col w-1/3">
                    <label class="text-sm font-semibold text-gray-800 mt-4">Tarikh Jawatan Sekarang</label>
                    <div class="mt-2 flex items-center border rounded-md cursor-pointer overflow-hidden"
                         x-data="{ date2: '{{ old('tarikh_jawatan', $spj->tarikhJawatanSekarang_formatted ?? '') }}', dateClicked2: false }"
                         x-init="const fp2 = flatpickr($refs.tarikhJawatan, { altInput: true, altFormat: 'j-M-Y', dateFormat: 'Y-m-d', defaultDate: date2 ? date2 : null, onChange: (selectedDates, dateStr) => { date2 = dateStr; dateClicked2 = false; }}); $watch('dateClicked2', value => { if (value) fp2.open(); });"
                         x-on:click.away="dateClicked2 = false" x-on:click="dateClicked2 = true">
                        <input type="text" x-model="date2" x-ref="tarikhJawatan" placeholder="Tarikh Jawatan Sekarang"
                               class="px-4 py-2 w-full focus:outline-none cursor-pointer placeholder:text-gray-400" 
                               readonly name="tarikh_jawatan">
                    </div>
                </div>

                <div class="flex flex-col w-1/3">
                    <label class="text-sm font-semibold text-gray-800 mt-4">Jenis Perkhidmatan</label>
                    <select name="jenisPerkhidmatan" class="mt-2 px-4 py-2 border rounded-md focus:outline-none w-full">
                        <option value="">Pilih Jenis Perkhidmatan</option>
                        <option value="Tetap" {{ $spj->jenisPerkhidmatan == 'Tetap' ? 'selected' : '' }}>Tetap</option>
                        <option value="Percubaan" {{ $spj->jenisPerkhidmatan == 'Percubaan' ? 'selected' : '' }}>Percubaan</option>
                        <option value="Kontrek" {{ $spj->jenisPerkhidmatan == 'Kontrek' ? 'selected' : '' }}>Kontrek</option>
                        <option value="Sebulan ke Sebulan" {{ $spj->jenisPerkhidmatan == 'Sebulan ke Sebulan' ? 'selected' : '' }}>Sebulan ke Sebulan</option>
                        <option value="Bergaji Hari" {{ $spj->jenisPerkhidmatan == 'Bergaji Hari' ? 'selected' : '' }}>Bergaji Hari</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col w-1/3 mt-6">
                <label class="text-sm font-semibold text-red-600">Sekolah/Maktab</label>
                <select name="sekolah_maktab" class="mt-2 px-4 py-2 border rounded-md focus:outline-none w-full">
                    <option value="">Pilih Sekolah/Maktab</option>
                    @foreach($sekolahOptions as $option)
                        <option value="{{ $option }}" {{ $spj->Combo244 == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col gap-4 mt-6">
                <label class="text-sm font-semibold text-gray-800">Status Perkhidmatan</label>
                <div class="flex flex-col gap-3">
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="tap" value="1" class="rounded border-gray-300 focus:ring-2 focus:ring-blue-500"
                               {{ strtoupper(trim($spj->tap ?? 'FALSE')) === 'TRUE' ? 'checked' : '' }}>
                        <span>TAP</span>
                    </label>

                    <div class="flex items-center gap-8">
                        <label class="inline-flex items-center gap-2">
                            <input type="checkbox" name="berpencen" value="1" class="rounded border-gray-300 focus:ring-2 focus:ring-blue-500"
                                   {{ strtoupper(trim($spj->Berpencen ?? 'FALSE')) === 'TRUE' ? 'checked' : '' }}>
                            <span>Berpencen</span>
                        </label>
                    </div>

                    <div class="flex items-center gap-2">
                        <label class="text-gray-800">Gaji SPG:</label>
                        <input type="text" name="gaji_spg" placeholder="0.00" value="{{ $spj->Text186 ?? '' }}"
                               class="px-4 py-2 border rounded-md focus:outline-none placeholder:text-gray-400 w-32">
                    </div>
                </div>
            </div>

            <div class="flex flex-col mt-4">
                <label class="text-sm font-semibold text-black">Memo DS SPG</label>
                <input type="text" name="memo_ds_spg" placeholder="Kosong" value="{{ $spj->{'Memo DS SPG'} ?? '' }}"
                       class="mt-2 px-4 py-2 border rounded-md focus:outline-none w-full placeholder:text-gray-400">
            </div>
        </div>

        {{-- Fixed Submit Button --}}
        <div x-show="activeTab === 10" class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save SPG</p>
            </button>
        </div>
    </form>
</div>

{{-- Kursus Tab --}}
<div x-show="activeTab === 11" class="tab-content-wrapper" x-cloak>
    
    <form action="{{ route('pj.kursus.store', ['id' => $id]) }}" 
          method="POST">
        @csrf

        <div x-data="kursusTable({{ json_encode($kursusRows) }})" x-init="init()" class="mt-4">

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
                                <input type="text" 
                                       x-model="row.code" 
                                       :name="'kursus[' + index + '][Code Kursus]'"
                                       placeholder="Code"
                                       class="px-2 py-1 border rounded-md w-full focus:outline-none">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-model="row.nama" 
                                       :name="'kursus[' + index + '][Nama Kursus]'"
                                       placeholder="Nama Kursus"
                                       class="px-2 py-1 border rounded-md w-full focus:outline-none">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-model="row.mulai" 
                                       :name="'kursus[' + index + '][Mulai]'"
                                       placeholder="Mulai"
                                       class="px-2 py-1 border rounded-md w-full focus:outline-none">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="date" 
                                       x-model="row.hingga" 
                                       :name="'kursus[' + index + '][Hingga]'"
                                       placeholder="Hingga"
                                       class="px-2 py-1 border rounded-md w-full focus:outline-none">
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" 
                                       x-model="row.tempat" 
                                       :name="'kursus[' + index + '][Tempat Kursus]'"
                                       placeholder="Tempat Kursus"
                                       class="px-2 py-1 border rounded-md w-full focus:outline-none">
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button type="button" 
                                        @click="removeRow(index)" 
                                        class="text-red-600 font-bold hover:text-red-800 disabled:opacity-50 disabled:cursor-not-allowed"
                                        :disabled="row.deleting || isDeleting">
                                    <span x-show="!row.deleting">Remove</span>
                                    <span x-show="row.deleting">Deleting...</span>
                                </button>
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
        <div x-show="activeTab === 11" class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Kursus</p>
            </button>
        </div>

    </form>
</div>

<script>
function kursusTable(initialRows = []) {
    return {
        rows: [],

        isDeleting: false,

        init() {
            // normalize DB data
            if (initialRows && initialRows.length > 0) {
                this.rows = initialRows.map(item => ({
                    code: item.code || '',
                    nama: item.nama || '',
                    mulai: item.mulai || '',
                    hingga: item.hingga || '',
                    tempat: item.tempat || '',
                    isFromDatabase: true,
                    deleting: false
                }));
            }

            // IMPORTANT: always ensure at least 1 row
            if (this.rows.length === 0) {
                this.addRow();
            }
        },

        addRow() {
            this.rows.push({
                code: '',
                nama: '',
                mulai: '',
                hingga: '',
                tempat: '',
                isFromDatabase: false,
                deleting: false
            });
        },

        async removeRow(index) {
            if (this.isDeleting) return;

            const row = this.rows[index];
            if (!row) return;

            if (row.isFromDatabase && row.nama) {
                if (!confirm('Delete "' + row.nama + '" from database?')) return;

                this.isDeleting = true;
                row.deleting = true;

                try {
                    const response = await fetch('/pj/{{ $id }}/kursus/delete', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            code_kursus: row.code,
                            nama_kursus: row.nama
                        })
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        window.location.reload();
                    } else {
                        alert(data.message || 'Error deleting.');
                        row.deleting = false;
                        this.isDeleting = false;
                    }
                } catch (e) {
                    alert(e.message);
                    row.deleting = false;
                    this.isDeleting = false;
                }
            } else {
                this.rows.splice(index, 1);
            }
        }
    }
}
</script>

{{-- Prestasi Tab --}}
<div x-show="activeTab === 12" class="tab-content-wrapper" x-cloak>
    
    <form action="{{ route('pj.save.prestasi', ['id' => $id]) }}" 
          method="POST" 
          id="prestasiForm">
        @csrf

        <div class="mt-4">
            <table class="min-w-full border border-gray-300" id="prestasiTable">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">Tahun</th>
                        <th class="border px-4 py-2 text-left">Gred</th>
                        <th class="border px-4 py-2 text-left">Percentage</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="prestasiTableBody">
                    @forelse($prestasiRows as $index => $row)
                    <tr class="prestasi-row">
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="prestasi[{{ $index }}][Tahun]" 
                                   value="{{ $row->tahun }}"
                                   placeholder="YYYY"
                                   maxlength="4"
                                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="prestasi[{{ $index }}][Gred]" 
                                   value="{{ $row->gred }}"
                                   placeholder="Gred"
                                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="prestasi[{{ $index }}][Percentage]" 
                                   value="{{ $row->percentage }}"
                                   placeholder="%"
                                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="removePrestasiRow(this)"
                                    class="text-red-600 font-bold hover:text-red-800">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr class="prestasi-row">
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="prestasi[0][Tahun]" 
                                   value=""
                                   placeholder="YYYY"
                                   maxlength="4"
                                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="prestasi[0][Gred]" 
                                   value=""
                                   placeholder="Gred"
                                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="prestasi[0][Percentage]" 
                                   value=""
                                   placeholder="%"
                                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="removePrestasiRow(this)"
                                    class="text-red-600 font-bold hover:text-red-800">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <button type="button"
                onclick="addPrestasiRow()"
                class="mt-2 px-4 py-2 rounded-md text-white"
                style="background-color:#3B82F6;">
                Add Row
            </button>
        </div>

        {{-- Fixed Submit Button --}}
        <div x-show="activeTab === 12" class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Prestasi</p>
            </button>
        </div>
    </form>
</div>

<script>
let prestasiRowCounter = {{ count($prestasiRows) > 0 ? count($prestasiRows) : 1 }};

function addPrestasiRow() {
    const tbody = document.getElementById('prestasiTableBody');
    const newRow = document.createElement('tr');
    newRow.className = 'prestasi-row';
    newRow.innerHTML = `
        <td class="border px-4 py-2">
            <input type="text" 
                   name="prestasi[${prestasiRowCounter}][Tahun]" 
                   value=""
                   placeholder="YYYY"
                   maxlength="4"
                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
        </td>
        <td class="border px-4 py-2">
            <input type="text" 
                   name="prestasi[${prestasiRowCounter}][Gred]" 
                   value=""
                   placeholder="Gred"
                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
        </td>
        <td class="border px-4 py-2">
            <input type="text" 
                   name="prestasi[${prestasiRowCounter}][Percentage]" 
                   value=""
                   placeholder="%"
                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
        </td>
        <td class="border px-4 py-2 text-center">
            <button type="button" 
                    onclick="removePrestasiRow(this)"
                    class="text-red-600 font-bold hover:text-red-800">
                Remove
            </button>
        </td>
    `;
    tbody.appendChild(newRow);
    prestasiRowCounter++;
    console.log('Row added. Total rows:', tbody.querySelectorAll('.prestasi-row').length);
}

function removePrestasiRow(button) {
    const tbody = document.getElementById('prestasiTableBody');
    const rows = tbody.querySelectorAll('.prestasi-row');
    
    if (rows.length > 1) {
        if (confirm('Adakah anda pasti mahu membuang baris ini?')) {
            button.closest('tr').remove();
            console.log('Row removed. Remaining rows:', tbody.querySelectorAll('.prestasi-row').length);
        }
    } else {
        alert('Sekurang-kurangnya satu baris diperlukan.');
    }
}

// Debug: Log form data before submit
document.getElementById('prestasiForm').addEventListener('submit', function(e) {
    console.log('=== FORM SUBMITTING ===');
    const formData = new FormData(this);
    for (let [key, value] of formData.entries()) {
        console.log(key + ': ' + value);
    }
});
</script>

{{-- Anugerah Tab --}}
<div x-show="activeTab === 13" class="tab-content-wrapper" x-cloak>
    
    <form action="{{ route('pj.save.anugerah', ['id' => $id]) }}" 
          method="POST" 
          id="anugerahForm">
        @csrf

        <div class="mt-4">
            <table class="min-w-full border border-gray-300" id="anugerahTable">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">Tahun</th>
                        <th class="border px-4 py-2 text-left">Nama Anugerah</th>
                        <th class="border px-4 py-2 text-left">Peringkat</th>
                        <th class="border px-4 py-2 text-left">Penganjur</th>
                        <th class="border px-4 py-2 text-left">Catatan</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="anugerahTableBody">
                    @forelse($anugerahRows as $index => $row)
                    <tr class="anugerah-row">
                        <td class="border px-4 py-2">
                            <input type="text" name="anugerah[{{ $index }}][tahun]"
                                value="{{ $row->tahun }}"
                                class="px-2 py-1 border rounded-md w-full">
                        </td>

                        <td class="border px-4 py-2">
                            <input type="text" name="anugerah[{{ $index }}][nama_anugerah]"
                                value="{{ $row->nama_anugerah }}"
                                class="px-2 py-1 border rounded-md w-full">
                        </td>

                        <td class="border px-4 py-2">
                            <input type="text" name="anugerah[{{ $index }}][peringkat]"
                                value="{{ $row->peringkat }}"
                                class="px-2 py-1 border rounded-md w-full">
                        </td>

                        <td class="border px-4 py-2">
                            <input type="text" name="anugerah[{{ $index }}][penganjur]"
                                value="{{ $row->penganjur }}"
                                class="px-2 py-1 border rounded-md w-full">
                        </td>

                        <td class="border px-4 py-2">
                            <input type="text" name="anugerah[{{ $index }}][catatan]"
                                value="{{ $row->catatan }}"
                                class="px-2 py-1 border rounded-md w-full">
                        </td>

                        <td class="border px-4 py-2 text-center">
                            <button type="button" onclick="removeAnugerahRow(this)"
                                class="text-red-600 font-bold hover:text-red-800">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr class="anugerah-row">
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="anugerah[0][tahun]" 
                                   value=""
                                   placeholder="YYYY"
                                   maxlength="4"
                                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="anugerah[0][nama_anugerah]" 
                                   value=""
                                   placeholder="Nama Anugerah"
                                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="anugerah[0][peringkat]" 
                                   value=""
                                   placeholder="Sekolah / Negeri / Kebangsaan"
                                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="anugerah[0][penganjur]" 
                                   value=""
                                   placeholder="Penganjur"
                                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" 
                                   name="anugerah[0][catatan]" 
                                   value=""
                                   placeholder="Catatan"
                                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button type="button" 
                                    onclick="removeAnugerahRow(this)"
                                    class="text-red-600 font-bold hover:text-red-800">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <button type="button"
                onclick="addAnugerahRow()"
                class="mt-2 px-4 py-2 rounded-md text-white"
                style="background-color:#3B82F6;">
                Add Row
            </button>
        </div>

        {{-- Fixed Submit Button --}}
        <div x-show="activeTab === 13" class="fixed left-0 bottom-0 right-0 w-screen flex justify-end px-10 py-5 bg-gradient-to-t from-white via-white/90 to-transparent z-50">
            <button type="submit" class="px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-300 text-white rounded-md flex items-center gap-2 hover:scale-105 duration-300 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>
                <p>Save Anugerah</p>
            </button>
        </div>
    </form>
</div>

<script>
let anugerahRowCounter = {{ count($anugerahRows) > 0 ? count($anugerahRows) : 1 }};

function addAnugerahRow() {
    const tbody = document.getElementById('anugerahTableBody');
    const newRow = document.createElement('tr');
    newRow.className = 'anugerah-row';
    newRow.innerHTML = `
        <td class="border px-4 py-2">
            <input type="text" 
                   name="anugerah[${anugerahRowCounter}][tahun]" 
                   value=""
                   placeholder="YYYY"
                   maxlength="4"
                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
        </td>
        <td class="border px-4 py-2">
            <input type="text" 
                   name="anugerah[${anugerahRowCounter}][nama_anugerah]" 
                   value=""
                   placeholder="Nama Anugerah"
                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
        </td>
        <td class="border px-4 py-2">
            <input type="text" 
                   name="anugerah[${anugerahRowCounter}][peringkat]" 
                   value=""
                   placeholder="Sekolah / Negeri / Kebangsaan"
                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
        </td>
        <td class="border px-4 py-2">
            <input type="text" 
                   name="anugerah[${anugerahRowCounter}][penganjur]" 
                   value=""
                   placeholder="Penganjur"
                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
        </td>
        <td class="border px-4 py-2">
            <input type="text" 
                   name="anugerah[${anugerahRowCounter}][catatan]" 
                   value=""
                   placeholder="Catatan"
                   class="px-2 py-1 border rounded-md w-full focus:outline-none">
        </td>
        <td class="border px-4 py-2 text-center">
            <button type="button" 
                    onclick="removeAnugerahRow(this)"
                    class="text-red-600 font-bold hover:text-red-800">
                Remove
            </button>
        </td>
    `;
    tbody.appendChild(newRow);
    anugerahRowCounter++;
    console.log('Row added. Total rows:', tbody.querySelectorAll('.anugerah-row').length);
}

function removeAnugerahRow(button) {
    const tbody = document.getElementById('anugerahTableBody');
    const rows = tbody.querySelectorAll('.anugerah-row');
    
    if (rows.length > 1) {
        if (confirm('Adakah anda pasti mahu membuang baris ini?')) {
            button.closest('tr').remove();
            console.log('Row removed. Remaining rows:', tbody.querySelectorAll('.anugerah-row').length);
        }
    } else {
        alert('Sekurang-kurangnya satu baris diperlukan.');
    }
}

// Debug: Log form data before submit
document.getElementById('anugerahForm').addEventListener('submit', function(e) {
    console.log('=== FORM SUBMITTING ===');
    const formData = new FormData(this);
    for (let [key, value] of formData.entries()) {
        console.log(key + ': ' + value);
    }
});
</script>

<!-- Flatpickr CSS/JS if not included yet -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
function calculateJumlahDOM(tr, mulaName, tamatName, jumlahName) {
    let mula = tr.querySelector(`input[name="${mulaName}"]`)?.value;
    let tamat = tr.querySelector(`input[name="${tamatName}"]`)?.value;
    let jumlahInput = tr.querySelector(`input[name="${jumlahName}"]`);

    if (!jumlahInput) return;

    if (mula && tamat) {
        let start = new Date(mula);
        let end = new Date(tamat);

        if (!isNaN(start) && !isNaN(end) && end >= start) {
            let diff = (end - start) / (1000 * 60 * 60 * 24) + 1;
            jumlahInput.value = diff;
        } else {
            jumlahInput.value = '';
        }
    }
}
</script>

    </div>

</div>

<!-- Footer -->
<footer class="w-full text-center text-gray-500 mt-10 mb-4 text-sm z-10 relative">
    Ministry Of Education @ {{ date('Y') }} All Rights Reserved. Powered by DevOps ICT.
</footer>
@endsection