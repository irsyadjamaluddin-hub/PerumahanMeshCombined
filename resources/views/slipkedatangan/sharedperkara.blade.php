{{-- ====== NEW FILE ======== --}}


{{-- ====== NEWLY ADDED ======== --}}



{{-- Share Perkara by IC No. feature — recipient's view. Lists every Perkara whose
     shared_with contains the logged-in user's IC No. (SKController@sharedWithMe). --}}
{{-- ====== ========. --}}
@extends('layouts.app-all')

@section('title', 'Shared With Me')

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" sections; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
<style>
  /* Status text (set inline as green / red): softer shades in dark mode */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-home-theme td[style*="green"] { color: #6ee7b7 !important; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-home-theme td[style*="red"] { color: #fca5a5 !important; }
</style>
<div class="mesh-home-theme">
{{-- #================================ --}}

<?php
$pagename = "Slip Kehadiran";
?>

<div class="pagetitle">
    <h1>Shared With Me</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('sk.slipkedatangan.indexadmin') }}">Hadir @MOEBN</a></li>
            <li class="breadcrumb-item active">Shared With Me</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <!----- Back out Button  ----->
    <div class="col-md-1 text-left">
        <a href="{{ route('sk.slipkedatangan.indexadmin') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem;">
        <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div>

    <div class="col-12">
      <div class="card recent-sales">
        <div class="card-body overflow-auto">

            <table class="table table-borderless datatable mt-3">
              <thead>
                <tr>
                  <th scope="col">Jabatan</th>
                  <th scope="col">Perkara</th>
                  <th scope="col">Tarikh Bermula</th>
                  <th scope="col">Tarikh Berakhir</th>
                  <th scope="col">Status</th>
                  <th scope="col">Tindakan</th>
                </tr>
              </thead>
              <tbody>

              @if(count($sharedPerkaras) == 0)

                <tr class="text-center">
                    <td colspan="6">
                        <h5>No Perkara have been shared with you</h5>
                    </td>
                </tr>

              @else

              @foreach($sharedPerkaras as $skperkara)
              <tr>
                <td>{{ $skperkara['jabatan'] }}</td>
                <td>{{ $skperkara['label'] }}</td>
                <td>{{ $skperkara['tarikh_bermula'] }}</td>
                <td>{{ $skperkara['tarikh_berakhir'] }}</td>
                <td style="color: {{ $skperkara['status'] == 'active' ? 'green' : ($skperkara['status'] == 'inactive' ? 'red' : 'inherit') }}">
                    {{ $skperkara['status'] }}
                </td>
                <td>
                    <form method="get" action="{{ route('sk.slipkedatangan.showslip', $skperkara['id']) }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </form>
                </td>
              </tr>
              @endforeach
              @endif

              </tbody>
            </table>

        </div>
      </div>
    </div>

</section>
{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
@endsection
