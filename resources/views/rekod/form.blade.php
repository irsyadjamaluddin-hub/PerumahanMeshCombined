@extends('layouts.app')
@section('title', $rekod->exists ? 'Sunting Rekod' : 'Rekod Baharu')

@section('content')
    <a class="btn btn-ghost" href="{{ route('perumahan.list', $jenis) }}" style="align-self:flex-start">&larr; {{ $cfg['title'] }}</a>

    <div>
        <h6>{{ $rekod->exists ? 'Sunting rekod' : 'Rekod baharu' }}</h6>
        <h1>{{ $rekod->jenis_permohonan ?? $cfg['short'] }}</h1>
    </div>

    @if ($errors->any())
        <div class="errors">
            <strong>Sila lengkapkan ruangan berikut:</strong>
            <ul style="margin:6px 0 0;padding-left:18px">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ $rekod->exists ? route('perumahan.update', [$jenis, $rekod]) : route('perumahan.store', $jenis) }}"
          style="display:flex;flex-direction:column;gap:20px">
        @csrf
        @if ($rekod->exists)
            @method('PUT')
        @endif
        <input type="hidden" name="jenis_permohonan" value="{{ $rekod->jenis_permohonan }}">

        @foreach ($cfg['sections'] as $section)
            <section class="card" style="padding:0">
                <div class="section-head">
                    <span style="font-size:12px;letter-spacing:.1em">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <span>{{ $section['title'] }}</span>
                </div>
                <div class="form-grid" style="padding:16px">
                    @foreach ($section['fields'] as $field)
                        @php
                            $name = \Illuminate\Support\Str::slug($field['label'], '_');
                            $type = $field['type'] ?? 'text';
                            $value = old("fields.$name", $rekod->data[$name] ?? '');
                        @endphp
                        <div class="field" style="grid-column:span {{ $field['span'] }}">
                            <label for="{{ $name }}">{{ $field['label'] }}</label>
                            @if ($type === 'file')
                                <div style="display:flex;gap:8px">
                                    <input class="input" id="{{ $name }}" type="text" name="fields[{{ $name }}]"
                                           value="{{ $value }}" placeholder="Tiada fail dipilih">
                                    <button class="btn btn-ghost" type="button">Pilih Fail</button>
                                </div>
                            @else
                                <input class="input" id="{{ $name }}"
                                       type="{{ $type === 'date' ? 'date' : ($type === 'number' ? 'number' : 'text') }}"
                                       name="fields[{{ $name }}]" value="{{ $value }}"
                                       placeholder="Isi {{ strtolower($field['label']) }}">
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach

        <div class="field" style="max-width:260px">
            <label for="status">Status Rekod</label>
            <select class="input" id="status" name="status">
                @foreach (config('perumahan.statuses') as $status)
                    <option value="{{ $status }}" {{ old('status', $rekod->status) === $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <button class="btn btn-primary" type="submit" style="padding:12px 30px;font-size:15px">Simpan</button>
            <a class="btn" href="{{ route('perumahan.list', $jenis) }}" style="padding:12px 20px">Batal</a>
        </div>
    </form>
@endsection
