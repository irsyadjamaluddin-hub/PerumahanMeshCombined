<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> @isset($pagename) {{ $pagename }} @endisset</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        {{-- Styles --}}
        <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

        {{-- Favicon --}}
        <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}"/>

        {{-- AOS --}}
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        {{-- Jquery UI (date-picker) --}}
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

        {{-- Slick CSS --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}"/>

    </head>

    <body class="bg-gray-100">

    {{-- Side Nav-Bar --}}
    @include('inc.sideNavBar')

    <div id="topNavAndContent" class="ml-0 lg:ml-60 transition-400">

        {{-- Top Nav-Bar --}}
        @include('inc.topNavBar')

        {{-- Content --}}
        <div class="overflow-x-hidden">

            @yield('content')
            
        </div>
    
    </div>

    @if(Auth::user()->hasRole('ROLE_CLAIMANT'))
    {{-- Custom Javascript --}}
    <script src="{{ asset('js/claimant-navbar.js') }}"></script>
    @endif

    @if(Auth::user()->hasRole('ROLE_ADMIN'))
    {{-- Custom Javascript --}}
    <script src="{{ asset('js/admin-navbar.js') }}"></script>
    @endif
	
	@if(Auth::user()->hasRole('ROLE_HOD'))
    {{-- Custom Javascript --}}
    <script src="{{ asset('js/hod-navbar.js') }}"></script>
    @endif
	
	@if(Auth::user()->hasRole('ROLE_DA'))
    {{-- Custom Javascript --}}
    <script src="{{ asset('js/da-navbar.js') }}"></script>
    @endif

	@if(Auth::user()->hasRole('ROLE_MAW'))
    {{-- Custom Javascript --}}
    <script src="{{ asset('js/maw-navbar.js') }}"></script>
    @endif
	
	@if(Auth::user()->hasRole('ROLE_MAW_SECOND'))
    {{-- Custom Javascript --}}
    <script src="{{ asset('js/mawsecond-navbar.js') }}"></script>
    @endif

    @if(Auth::user()->hasRole('ROLE_ENDORSER'))
    {{-- Custom Javascript --}}
    <script src="{{ asset('js/endorser-navbar.js') }}"></script>
    @endif

    @if(Auth::user()->hasRole('ROLE_MAW_ENDORSER'))
    {{-- Custom Javascript --}}
    <script src="{{ asset('js/mawendorser-navbar.js') }}"></script>
    @endif

    {{-- AOS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    {{-- Initialize AOS --}}
    <script> AOS.init(); </script>


</body>
</html>



