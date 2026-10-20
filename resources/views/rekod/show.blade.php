@extends('layouts.app')
@section('title', $rekod->tajuk())

@section('content')
    <a class="btn btn-ghost" href="{{ route('perumahan.list', $jenis) }}" style="align-self:flex-start">&larr; {{ $cfg['title'] }}</a>

    <div class="row" style="align-items:flex-end">
        <div style="margin-right:auto">
            <h6>{{ $rekod->jenis_permohonan ?? $cfg['kicker'] }}</h6>
            <h1 style="font-size:34px">{{ $rekod->tajuk() }}</h1>
        </div>
        <span class="tag">{{ $rekod->status ?? '—' }}</span>
        <a class="btn" href="{{ route('perumahan.edit', [$jenis, $rekod]) }}">Sunting</a>
    </div>

    @foreach ($cfg['sections'] as $section)
        <section style="display:flex;flex-direction:column;gap:10px">
            <h6 style="color:var(--accent-700)">{{ $section['title'] }}</h6>
            <div class="definition">
                @foreach ($section['fields'] as $field)
                    <div>
                        <span class="muted" style="font-size:11px">{{ $field['label'] }}</span>
                        <span style="font-size:15px">{{ $rekod->field($field['label']) }}</span>
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach
@endsection
