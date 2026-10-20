<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{-- Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Google Font: Lato --}}
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Orbitron:wght@400..900&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- FlatPickr: Custom Date Picker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    {{-- Alpine.js Component Functions - MUST load before Alpine --}}
    <script>
        // Gaji Matrix Table Component
        window.gajiMatrixTable = function() {
            return {
                newRows: [],
                
                addRow() {
                    this.newRows.push({});
                    console.log('Row added. Total new rows:', this.newRows.length);
                },
                
                removeNewRow(index) {
                    this.newRows.splice(index, 1);
                    console.log('Row removed. Remaining new rows:', this.newRows.length);
                }
            }
        }
    </script>

    {{-- Alpine JS Plugins (MUST load before Alpine core) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>
    
    {{-- Alpine JS Core (MUST load last) --}}
    <script defer src="{{ asset('vendor/alpinejs/alpine.min.js') }}"></script>
    {{-- #========== NEWLY ADDED ============ --}}
    {{-- English / Malay switch: keeps the page hidden for a moment when BM is saved, so it doesn't flash English --}}
    @include('inc.lang-head')
    {{-- #================================ --}}
</head>
<body class="relative">
    {{-- #========== NEWLY ADDED ============ --}}
    {{-- English / Malay switch (floating, bottom left) -- this layout has no MESH v4 header to hold it --}}
    @include('inc.lang-float')
    {{-- #================================ --}}

    @include('hrs.layouts.nav')

    {{-- Buffer --}}
    <div class="mt-14"></div>

    {{-- Content --}}
    <div class="p-10">
        @yield('content')
    </div>
    {{-- MESH Smart Bot --}}
    {{-- @include('inc.smartbot') --}} {{-- SmartBot disabled temporarily --}}

    {{-- #========== NEWLY ADDED ============ --}}
    {{-- English / Malay switch: swaps the page text to Malay when BM is picked (word list inside the file) --}}
    <script src="{{ asset('js/mesh-lang.js') }}?v={{ filemtime(public_path('js/mesh-lang.js')) }}"></script>
    {{-- #================================ --}}

</body>
</html>
