@extends('layouts.housing2')
@section('title', 'Jenis Permohonan')

@php $t = fn ($s) => \App\Support\Housing2Lang::t($s); @endphp

@section('content')
    <a class="btn btn-ghost" href="{{ route('housing2.list', $jenis) }}" style="align-self:flex-start">&larr; {{ $t($cfg['title']) }}</a>

    <div>
        <h6>{{ $t('Rekod Baharu') }}</h6>
        <h1 style="font-size:34px">{{ $t('Jenis Permohonan') }}</h1>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:14px">
        @foreach ($cfg['jenis_permohonan'] as $label => $note)
            <a class="card pad lift" style="text-decoration:none;color:var(--ink);padding:20px;gap:6px"
               href="{{ route('housing2.create', [$jenis, 'jenis_permohonan' => $label]) }}">
                <span class="kicker">{{ $t('Borang bharu') }}</span>
                <span class="h" style="font-size:22px">{{ $t($label) }}</span>
                <p class="muted" style="margin:0;font-size:14px">{{ $t($note) }}</p>
            </a>
        @endforeach
    </div>
@endsection
