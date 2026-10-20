@extends('layouts.app')
@section('title', 'Jenis Permohonan')

@section('content')
    <a class="btn btn-ghost" href="{{ route('perumahan.list', $jenis) }}" style="align-self:flex-start">&larr; {{ $cfg['title'] }}</a>

    <div>
        <h6>Rekod Baharu</h6>
        <h1 style="font-size:34px">Jenis Permohonan</h1>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:14px">
        @foreach ($cfg['jenis_permohonan'] as $label => $note)
            <a class="card pad lift" style="text-decoration:none;color:var(--ink);padding:20px;gap:6px"
               href="{{ route('perumahan.create', [$jenis, 'jenis_permohonan' => $label]) }}">
                <span class="kicker">Borang baharu</span>
                <span class="h" style="font-size:22px">{{ $label }}</span>
                <p class="muted" style="margin:0;font-size:14px">{{ $note }}</p>
            </a>
        @endforeach
    </div>
@endsection
