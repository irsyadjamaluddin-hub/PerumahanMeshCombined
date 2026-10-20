{{-- =============== NISAH =============== --}}
{{-- PDMS HOMEPAGE (29 Sept 2026): same content as the MESH homepage (greeting + all MESH services, shared through --}}
{{-- inc/home-greeting and inc/home-services), just inside the PDMS layout (layouts/app-pdms, PDMS sidebar). --}}
{{-- The PDMS links (Cuti / Service Records, PDMS Admin) are in the PDMS sidebar, so no separate PDMS cards here. --}}
{{-- Previous PDMS-cards-only version: pdmshome-oldver-29sept2026.blade.php. 2025 design: pdmshome-oldver-2025-2026septver.blade.php. --}}
{{-- =============================================== --}}
@extends('layouts.app-pdms')

@section('title', 'MOE MESH - PDMS Home')

@section('content')

  <?php
    // pagename drives the header title and the sidebar active-state check in app-pdms.blade.php
    // (was " PDMS Home" with a leading space, which the sidebar's 'pdmshome' check never matched)
    $pagename = "PDMS Home";
  ?>

    @if(session('success'))
    <div class="alert alert-success" style="margin-top: 20px">
        {{ session('success') }}
    </div>
    @endif

    @include('inc.home-greeting')

    @include('inc.home-services')

@endsection
