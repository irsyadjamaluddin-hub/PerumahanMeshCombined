@extends('layouts.housing2')
@section('title', $staffMember->exists ? 'Sunting Kakitangan' : 'Kakitangan Baharu')

@php $t = fn ($s) => \App\Support\Housing2Lang::t($s); @endphp

@section('content')
    <a class="btn btn-ghost" href="{{ route('housing2.staff.index') }}" style="align-self:flex-start">&larr; {{ $t('Senarai Kakitangan, Kod dan Tugas') }}</a>

    <div>
        <h6>{{ $staffMember->exists ? $t('Sunting rekod') : $t('Rekod baharu') }}</h6>
        <h1>{{ $staffMember->nama ?: $t('Kakitangan') }}</h1>
    </div>

    @if ($errors->any())
        <div class="errors">
            <strong>{{ $t('Sila lengkapkan ruangan berikut:') }}</strong>
            <ul style="margin:6px 0 0;padding-left:18px">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ $staffMember->exists ? route('housing2.staff.update', $staffMember) : route('housing2.staff.store') }}"
          style="display:flex;flex-direction:column;gap:20px">
        @csrf
        @if ($staffMember->exists)
            @method('PUT')
        @endif

        <section class="card" style="padding:0">
            <div class="section-head">
                <span style="font-size:12px;letter-spacing:.1em">01</span>
                <span>{{ $t('Maklumat Kakitangan') }}</span>
            </div>
            <div class="form-grid" style="padding:16px">
                <div class="field" style="grid-column:span 2">
                    <label for="kod">{{ $t('Kod') }}</label>
                    <input class="input" id="kod" type="text" name="kod" value="{{ old('kod', $staffMember->kod) }}" placeholder="AKR1">
                </div>
                <div class="field" style="grid-column:span 4">
                    <label for="nama">{{ $t('Nama') }}</label>
                    <input class="input" id="nama" type="text" name="nama" value="{{ old('nama', $staffMember->nama) }}">
                </div>
                <div class="field" style="grid-column:span 2">
                    <label for="no_kpp">No. KPP</label>
                    <input class="input" id="no_kpp" type="text" name="no_kpp" value="{{ old('no_kpp', $staffMember->no_kpp) }}" placeholder="00-123456">
                </div>
                <div class="field" style="grid-column:span 6">
                    <label for="tugas">{{ $t('Tugas') }}</label>
                    <textarea class="input" id="tugas" name="tugas" rows="3">{{ old('tugas', $staffMember->tugas) }}</textarea>
                </div>
            </div>
        </section>

        <div class="row">
            <button class="btn btn-primary" type="submit" style="padding:12px 30px;font-size:15px">{{ $t('Simpan') }}</button>
            <a class="btn" href="{{ route('housing2.staff.index') }}" style="padding:12px 20px">{{ $t('Batal') }}</a>
        </div>
    </form>
@endsection
