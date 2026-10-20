{{-- =============== NISAH =============== --}}
{{-- NEW HOMEPAGE (Sept 2026, "Option C v3"): greeting + the user's name, then the services in their sections --}}
{{-- (same cards/popups as servicesdashboard.blade.php). Announcements are in the header bell, which now lives in --}}
{{-- layouts/app-all.blade.php (inc/announcement-bell*.blade.php) so it works on every page, not just here. --}}
{{-- The previous homepage is kept as home-oldver-2025-2026septver.blade.php (rename it back to roll back). --}}
{{-- =============================================== --}}
@extends('layouts.app-all')

@section('title', 'MOE MESH - Home')

{{-- #============= ORI CODE ============== --}}
{{-- =============== NISAH =============== --}}
{{-- Opts this page into dark mode: shows the sun/moon switch in the header and turns on the dark styles. --}}
{{-- @section('mesh_dark_ready', '1') --}}
{{-- =============================================== --}}
{{-- #================================ --}}
{{-- No longer needed: every page now supports dark mode (layouts add the mesh-dark-ready body class). --}}
{{-- A page that must stay light declares @section('mesh_dark_off', '1') instead. --}}
{{-- #================================ --}}

@section('content')

  <?php
    // pagename drives the header title and the sidebar active-state check in app-all.blade.php
    $pagename = "";
  ?>

    @if(session('success'))
    <div class="alert alert-success" style="margin-top: 20px">
        {{ session('success') }}
    </div>
    @endif

    {{-- =============== NISAH =============== --}}
    {{-- Greeting and services now live in partials (29 Sept 2026) so PDMS Home (pdmshome.blade.php) shows the same --}}
    {{-- content. Old single-file version: home-oldver-29sept2026.blade.php. --}}
    @include('inc.home-greeting')

    @include('inc.home-services')
    {{-- =============================================== --}}

@endsection
