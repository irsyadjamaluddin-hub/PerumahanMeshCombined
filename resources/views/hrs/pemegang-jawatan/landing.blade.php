@extends('hrs.layouts.landing')

@section('title') HRIDS Landing @endsection

@section('content')

<style>
/* Tailwind utility classes for search components */
.w-full { width: 100%; }
.flex { display: flex; }
.justify-center { justify-content: center; }
.mt-10 { margin-top: 2.5rem; }
.max-w-xl { max-width: 36rem; }
.relative { position: relative; }
.z-10 { z-index: 10; }
.z-20 { z-index: 20; }
.z-50 { z-index: 50; }
.mb-6 { margin-bottom: 1.5rem; }
.mx-auto { margin-left: auto; margin-right: auto; }
.w-72 { width: 18rem; }
.max-w-full { max-width: 100%; }
.h-auto { height: auto; }
.object-contain { object-fit: contain; }
.flex-col { flex-direction: column; }
.gap-2 { gap: 0.5rem; }
.gap-4 { gap: 1rem; }
.gap-32 { gap: 8rem; }
.border { border-width: 1px; }
.border-gray-300 { border-color: #d1d5db; }
.border-gray-200 { border-color: #e5e7eb; }
.px-4 { padding-left: 1rem; padding-right: 1rem; }
.px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
.py-3 { padding-top: 0.75rem; padding-bottom: 0.75rem; }
.rounded-lg { border-radius: 0.5rem; }
.rounded-md { border-radius: 0.375rem; }
.text-gray-700 { color: #374151; }
.text-gray-500 { color: #6b7280; }
.placeholder-gray-400::placeholder { color: #9ca3af; }
.focus\:outline-none:focus { outline: 2px solid transparent; outline-offset: 2px; }
.focus\:ring-2:focus { box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.5); }
.focus\:ring-red-500:focus { --tw-ring-color: #ef4444; }
.focus\:border-red-500:focus { border-color: #ef4444; }
.transition { transition-property: all; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 150ms; }
.mt-2 { margin-top: 0.5rem; }
.mt-4 { margin-top: 1rem; }
.mt-12 { margin-top: 3rem; }
.mb-10 { margin-bottom: 2.5rem; }
.mb-16 { margin-bottom: 4rem; }
.shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
.shadow-md { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
.bg-white { background-color: #ffffff; }
.hover\:bg-red-50:hover { background-color: #fef2f2; }
.cursor-pointer { cursor: pointer; }
.justify-between { justify-content: space-between; }
.justify-center { justify-content: center; }
.items-center { align-items: center; }
.items-start { align-items: flex-start; }
.ml-2 { margin-left: 0.5rem; }
.text-sm { font-size: 0.875rem; line-height: 1.25rem; }
.text-center { text-align: center; }
.flex-wrap { flex-wrap: wrap; }
.block { display: block; }
.leading-tight { line-height: 1.25; }
.min-w-\[200px\] { min-width: 200px; }
.absolute { position: absolute; }
.top-full { top: 100%; }
.w-max { width: max-content; }

/* Alpine.js transition utilities */
.opacity-0 { opacity: 0; }
.opacity-100 { opacity: 1; }
.translate-y-2 { transform: translateY(0.5rem); }
.translate-y-0 { transform: translateY(0); }
.scale-95 { transform: scale(0.95); }
.scale-100 { transform: scale(1); }

/* Alpine x-cloak */
[x-cloak] { display: none !important; }
</style>

<div class="fullscreen-container">

    <!-- Background Image + Overlay -->
    <div class="background-gradient"></div>

    <!-- Tech Vibe Animated Background -->
    <canvas id="tech-bg" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2;"></canvas>

    <!-- Main Content Wrapper -->
    <div class="content-wrapper">
        <div class="w-full flex justify-center mt-10">
            <div x-data="searchData()" class="w-full max-w-xl relative z-20">

                {{-- Image Above Search Bar --}}
                <div class="mb-6 relative z-20">
                    <img src="{{ asset('assets/image-removebg-preview.png') }}" 
                         alt="Logo" 
                         class="mx-auto w-72 max-w-full h-auto object-contain">
                </div>

                {{-- Search Input Container --}}
                <div class="flex flex-col gap-2 relative w-full">
                    <input 
                        type="text" 
                        x-model.debounce.300ms="query" 
                        placeholder="Cari Nama, No Kad Pintar, No Telefon..." 
                        class="border border-gray-300 px-4 py-3 rounded-lg w-full text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
                    >

                    {{-- Search Results --}}
                    <template x-if="filteredDatas.length > 0">
                        <ul class="mt-2 border border-gray-200 rounded-lg shadow-lg bg-white w-full z-50"
                            style="max-height: calc(4 * 3rem); overflow-y: auto;">
                            <template x-for="(data, index) in filteredDatas" :key="`${data.source}-${data.noKadPintar}-${index}`">
                                <li 
                                    class="px-4 py-3 hover:bg-red-50 cursor-pointer transition flex justify-between items-center"
                                    @click="goToDetail(data)">
                                    <span x-text="data.displayName || data.nama || 'Empty'"></span>
                                    <span class="ml-2 text-sm text-gray-500" x-text="data.source === 'teach' ? '(Teaching)' : '(Non-Teaching)'"></span>
                                </li>
                            </template>
                        </ul>
                    </template>

                    {{-- No results --}}
                    <template x-if="query && filteredDatas.length === 0">
                        <p class="text-gray-500 mt-2 text-center text-sm">No result found.</p>
                    </template>
                </div>
            </div>
        </div>

        <!-- Title -->
        <h1 class="title z-10 relative">HRIDS</h1>

        <!-- Subtitle -->
        <p class="subtitle z-10 relative mb-10">
            Human Resources Integrated Database System. <br>Select your category to continue.
        </p>

        <!-- Buttons Section -->
        <div x-data="{ selected: null }" 
             class="relative flex flex-wrap items-start justify-center gap-32 w-full mt-12 mb-16">

            <!-- Teaching Button + Submenu -->
            <div class="relative flex flex-col items-center">
                <button
                    @click="selected = (selected === 'teaching') ? null : 'teaching'"
                    class="landing-btn-main">
                    <span class="block leading-tight">Teaching Staff</span>
                    <span class="block leading-tight">Tenaga Pengajar</span>
                </button>

                <div 
                    x-show="selected === 'teaching'"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                    class="absolute top-full mt-4 flex gap-4 justify-center z-20 w-max"
                    x-cloak>
                    <a href="{{ route('status-jawatan.show') }}"
                       class="landing-btn px-6 py-3 min-w-[200px] text-center rounded-md shadow-md transition">
                       Jawatan 
                    </a>
                    <a href="{{ route('pj.teaching.list') }}"
                       class="landing-btn px-6 py-3 min-w-[200px] text-center rounded-md shadow-md transition">
                       Pemegang Jawatan
                    </a>
                </div>
            </div>

            <!-- Non-Teaching Button + Submenu -->
            <div class="relative flex flex-col items-center">
                <button 
                    @click="selected = (selected === 'nonteaching') ? null : 'nonteaching'"
                    class="landing-btn-main">
                    <span class="block leading-tight">Non-Teaching Staff</span>
                    <span class="block leading-tight">Bukan Tenaga Pengajar</span>
                </button>

                <div 
                    x-show="selected === 'nonteaching'"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                    class="absolute top-full mt-4 flex gap-4 justify-center z-20 w-max"
                    x-cloak>
                    <a href="{{ route('status-jawatan.show') }}"
                       class="landing-btn px-6 py-3 min-w-[200px] text-center rounded-md shadow-md transition">
                       Jawatan 
                    </a>
                    <a href="{{ route('pj.show.list') }}"
                       class="landing-btn px-6 py-3 min-w-[200px] text-center rounded-md shadow-md transition">
                       Pemegang Jawatan 
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <p class="footer z-10 relative">
            Ministry Of Education @ {{ date('Y') }} All Rights Reserved. Powered by DevOps ICT.
        </p>
    </div>
</div>

<script src="//unpkg.com/alpinejs" defer></script>

<script>
function searchData() {
    return {
        query: '',
        datas: @json($datas ?? []),
        get filteredDatas() {
            if (!this.query || this.query.trim() === '') {
                return [];
            }
            
            const searchTerm = this.query.toLowerCase().trim();
            console.log('Searching for:', searchTerm);
            console.log('Total data items:', this.datas.length);
            console.log('Teaching items:', this.datas.filter(d => d.source === 'teach').length);
            
            const results = this.datas.filter(item => {
                if (item.source === 'teach') {
                    console.log('Testing teaching item:', {
                        nama: item.nama,
                        noKadPintar: item.noKadPintar,
                        noTelefon: item.noTelefon,
                        source: item.source
                    });
                }
                
                if (item.nama && String(item.nama).toLowerCase().includes(searchTerm)) {
                    console.log('✅ Found by name:', item.nama, 'Source:', item.source);
                    return true;
                }
                
                if (item.noKadPintar) {
                    const cleanIC = String(item.noKadPintar).replace(/[\s\-()]/g, '').toLowerCase();
                    const cleanSearchIC = searchTerm.replace(/[\s\-()]/g, '');
                    if (cleanIC.includes(cleanSearchIC)) {
                        console.log('✅ Found by IC:', item.noKadPintar, 'Source:', item.source);
                        return true;
                    }
                }
                
                if (item.noTelefon) {
                    const cleanPhone = String(item.noTelefon).replace(/[\s\-()\/]/g, '').toLowerCase();
                    const cleanSearchPhone = searchTerm.replace(/[\s\-()\/]/g, '');
                    if (cleanPhone.includes(cleanSearchPhone)) {
                        console.log('✅ Found by phone:', item.noTelefon, 'Source:', item.source);
                        return true;
                    }
                }
                
                if (item.email && String(item.email).toLowerCase().includes(searchTerm)) {
                    console.log('✅ Found by email:', item.email, 'Source:', item.source);
                    return true;
                }
                
                return false;
            });
            
            console.log('Total results found:', results.length);
            console.log('Teaching results:', results.filter(r => r.source === 'teach').length);
            console.log('Non-teaching results:', results.filter(r => r.source === 'spjs').length);
            
            return results.slice(0, 10);
        },

        goToDetail(data) {
            console.log('Navigating to:', data);
            if (data.source === 'teach') {
                window.location.href = `/pemegang-jawatan/teaching/showTeaching/${data.noKadPintar}`;
            } else if (data.source === 'spjs') {
                window.location.href = `/pemegang-jawatan/show/${data.id}`;
            }
        }
    }
}
</script>

<script>
// Tech Vibe Background Animation
const canvas = document.getElementById('tech-bg');
const ctx = canvas.getContext('2d');
let particles = [];
let width, height;

function initCanvas() {
    width = canvas.width = window.innerWidth;
    height = canvas.height = window.innerHeight;
}

function initParticles() {
    particles = [];
    for (let i = 0; i < 120; i++) {
        particles.push(new Particle());
    }
}

class Particle {
    constructor() {
        this.x = Math.random() * width;
        this.y = Math.random() * height;
        this.vx = (Math.random() - 0.5) * 0.5;
        this.vy = (Math.random() - 0.5) * 0.5;
        this.size = Math.random() * 2 + 1;
    }
    update() {
        this.x += this.vx;
        this.y += this.vy;
        if (this.x < 0 || this.x > width) this.vx *= -1;
        if (this.y < 0 || this.y > height) this.vy *= -1;
    }
    draw() {
        ctx.fillStyle = 'rgba(153,27,27,0.4)';
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fill();
    }
}

function animate() {
    ctx.clearRect(0, 0, width, height);
    particles.forEach(p => { p.update(); p.draw(); });

    for (let i = 0; i < particles.length; i++) {
        for (let j = i+1; j < particles.length; j++) {
            let dx = particles[i].x - particles[j].x;
            let dy = particles[i].y - particles[j].y;
            let dist = Math.sqrt(dx*dx + dy*dy);
            if (dist < 120) {
                ctx.strokeStyle = `rgba(153,27,27,${1 - dist/120})`; 
                ctx.lineWidth = 1;
                ctx.beginPath();
                ctx.moveTo(particles[i].x, particles[i].y);
                ctx.lineTo(particles[j].x, particles[j].y);
                ctx.stroke();
            }
        }
    }

    requestAnimationFrame(animate);
}

// Initialize canvas and particles
initCanvas();
initParticles();
animate();

// Handle window resize and zoom
window.addEventListener('resize', () => {
    initCanvas();
    initParticles(); // Reinitialize particles with new dimensions
});

// Handle zoom changes
window.addEventListener('wheel', (e) => {
    if (e.ctrlKey) {
        setTimeout(() => {
            initCanvas();
        }, 100);
    }
});
</script>

<style>
html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    font-family: 'Inter', sans-serif;
    box-sizing: border-box;
    overflow-x: hidden; /* Prevent horizontal scroll */
}

.fullscreen-container {
    position: relative;
    width: 100vw;
    min-height: 100vh; /* Changed from height to min-height */
    display: flex;
    flex-direction: column;
    justify-content: flex-start; /* Changed from center */
    align-items: center;
    text-align: center;
    color: #111827;
    padding: 20px 0; /* Add padding for breathing room */
}

/* New wrapper for content */
.content-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 40px;
    width: 100%;
    max-width: 1400px;
    padding: 20px;
}

/* Background Image + Overlay */
.background-gradient {
    position: fixed; /* Changed from absolute to fixed */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    z-index: -3;
}
.background-gradient::after {
    content: "";
    position: absolute;
    top:0; left:0;
    width:100%;
    height:100%;
    background: rgba(255,248,247,0.6);
    z-index: -2;
}

/* Title & Subtitle */
.title { 
    font-size: 68px; 
    font-weight: 900; 
    color: #991B1B; 
    text-shadow: 0 0 12px rgba(153,27,27,0.3);
    margin: 20px 0; 
}
.subtitle { 
    font-size: 22px; 
    max-width: 750px; 
    line-height: 1.8; 
    color: #6B4B4B;
    margin: 0 20px; 
}

/* Buttons */
.landing-btn-main {
    width: 280px; /* Fixed width for consistent size */
    height: 110px; /* Fixed height */
    padding: 16px 20px;
    background: linear-gradient(135deg, #FCA5A5, #991B1B); 
    color: white; 
    font-size: 20px; 
    font-weight: 600; 
    border-radius: 28px; 
    text-decoration: none; 
    display: flex; 
    flex-direction: column;
    justify-content: center; 
    align-items: center;
    gap: 6px; /* Space between lines */
    transition: transform 0.3s ease, box-shadow 0.3s ease; 
    box-shadow: 0 8px 20px rgba(153,27,27,0.3); 
    border: none;
    cursor: pointer;
    position: relative;
    z-index: 10;
}

.landing-btn { 
    background: linear-gradient(135deg, #FCA5A5, #991B1B); 
    color: white; 
    font-size: 20px; 
    font-weight: 600; 
    border-radius: 28px; 
    text-decoration: none; 
    display: flex; 
    justify-content: center; 
    align-items: center; 
    transition: transform 0.3s ease, box-shadow 0.3s ease; 
    box-shadow: 0 8px 20px rgba(153,27,27,0.3); 
    border: none;
    cursor: pointer;
}
.landing-btn-main:hover,
.landing-btn:hover { 
    transform: translateY(-6px) scale(1.02); 
    box-shadow: 0 18px 35px rgba(153,27,27,0.5); 
}

/* Footer */
.footer { 
    color: #A36B6B; 
    font-size: 14px; 
    margin-top: 40px;
    margin-bottom: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    .title { font-size: 52px; }
    .subtitle { font-size: 18px; max-width: 90%; }
    .landing-btn { font-size: 18px; padding: 18px 0; min-width: 200px; }
    .landing-btn-main { 
        width: 240px; 
        height: 100px; 
        font-size: 18px; 
    }
    .content-wrapper { gap: 30px; }
}
@media (max-height: 700px) {
    .title { font-size: 48px; }
    .subtitle { font-size: 16px; max-width: 85%; }
}
</style>

@endsection