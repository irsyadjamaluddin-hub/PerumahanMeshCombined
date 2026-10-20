<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HRIDS</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js Mask Plugin (MUST come before Alpine core) -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Alpine.js Core -->
    <script defer src="{{ asset('vendor/alpinejs/alpine.min.js') }}"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #ffffff;
            font-family: 'Nunito', sans-serif;
            padding-top: 80px; /* Space for fixed header */
        }

        .lato {
            font-family: 'Lato', sans-serif;
        }

       
        
        [x-cloak] { 
            display: none !important; 
        }
    </style>
    {{-- #========== NEWLY ADDED ============ --}}
    {{-- English / Malay switch: keeps the page hidden for a moment when BM is saved, so it doesn't flash English --}}
    @include('inc.lang-head')
    {{-- #================================ --}}
</head>
<body>
    {{-- #========== NEWLY ADDED ============ --}}
    {{-- English / Malay switch (floating, bottom left) -- this layout has no MESH v4 header to hold it --}}
    @include('inc.lang-float')
    {{-- #================================ --}}
    {{-- Navbar --}}
    <div class="fixed top-0 left-0 z-50 w-full px-10 py-4 flex items-center justify-between bg-white border-b">
        
        <div class="flex items-center gap-10">
            {{-- Logo --}}
            <div class="lato">
                <a href="{{ route('pj.landingpage') }}">
                    <p class="text-2xl font-bold text-rose-600">HRIDS</p>
                </a>
            </div>
            
            {{-- Links --}}
            <div class="flex items-center gap-10 text-gray-400">
                
                <div class="flex items-center gap-2">
                    <p>Jawatan</p>
                </div>

                <div class="flex items-center gap-2">
                    <p>Pemegang Jawatan</p>
                </div>

            </div>
        </div>

        {{-- Right --}}
        <div></div>

    </div>

    <div class="container-fluid py-4">
        @yield('content')
    </div>

    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- MESH Smart Bot --}}
    {{-- @include('inc.smartbot') --}} {{-- SmartBot disabled temporarily --}}

    {{-- #========== NEWLY ADDED ============ --}}
    {{-- English / Malay switch: swaps the page text to Malay when BM is picked (word list inside the file) --}}
    <script src="{{ asset('js/mesh-lang.js') }}?v={{ filemtime(public_path('js/mesh-lang.js')) }}"></script>
    {{-- #================================ --}}

</body>
</html>