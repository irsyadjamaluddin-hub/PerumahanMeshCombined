@extends('layouts.housing2')
@section('title', $zoneMukim->exists ? 'Sunting Mukim' : 'Mukim Baharu')

@php $t = fn ($s) => \App\Support\Housing2Lang::t($s); @endphp

@section('content')
    <a class="btn btn-ghost" href="{{ route('housing2.zon.index') }}" style="align-self:flex-start">&larr; {{ $t('Senarai Zone mengikut Mukim dan Kakitangan Bertanggungjawab') }}</a>

    <div>
        <h6>{{ $zoneMukim->exists ? $t('Sunting rekod') : $t('Rekod baharu') }}</h6>
        <h1>{{ $zoneMukim->mukim ?: $t('Mukim') }}</h1>
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
          action="{{ $zoneMukim->exists ? route('housing2.zon.mukim.update', $zoneMukim) : route('housing2.zon.mukim.store') }}"
          style="display:flex;flex-direction:column;gap:20px">
        @csrf
        @if ($zoneMukim->exists)
            @method('PUT')
        @endif

        <section class="card" style="padding:0">
            <div class="section-head">
                <span style="font-size:12px;letter-spacing:.1em">01</span>
                <span>{{ $t('Zon dan Mukim') }}</span>
            </div>
            <div class="form-grid" style="padding:16px">
                <div class="field" style="grid-column:span 3">
                    <label for="zone_id">{{ $t('Zon') }}</label>
                    <select class="input" id="zone_id" name="zone_id">
                        <option value="">{{ $t('--Pilih ') }}{{ $t('Zon') }}--</option>
                        @foreach ($zones as $zone)
                            <option value="{{ $zone->id }}" {{ old('zone_id', $zoneMukim->zone_id) == $zone->id ? 'selected' : '' }}>{{ $zone->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field" style="grid-column:span 3">
                    <label for="daerah">{{ $t('Daerah') }}</label>
                    <select class="input" id="daerah" name="daerah">
                        <option value="">{{ $t('--Pilih ') }}{{ $t('Daerah') }}--</option>
                        @foreach (['Brunei dan Muara', 'Tutong', 'Belait', 'Temburong'] as $option)
                            <option value="{{ $option }}" {{ old('daerah', $zoneMukim->daerah) === $option ? 'selected' : '' }}>{{ $t($option) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field" style="grid-column:span 6">
                    <label for="mukim">{{ $t('Mukim') }}</label>
                    <input class="input" id="mukim" type="text" name="mukim" value="{{ old('mukim', $zoneMukim->mukim) }}" placeholder="{{ $t('Isi ') }}{{ strtolower($t('Mukim')) }}">
                </div>
            </div>
        </section>

        <section class="card" style="padding:0">
            <div class="section-head">
                <span style="font-size:12px;letter-spacing:.1em">02</span>
                <span>{{ $t('Kakitangan Bertanggungjawab') }}</span>
            </div>
            <div class="form-grid" style="padding:16px">
                <div class="field" style="grid-column:span 3">
                    <label for="rs_staff_id">{{ $t('Rumah sewa') }}</label>
                    <select class="input" id="rs_staff_id" name="rs_staff_id">
                        <option value="">{{ $t('--Pilih ') }}{{ $t('Kakitangan') }}--</option>
                        @foreach ($staff as $person)
                            <option value="{{ $person->id }}" {{ old('rs_staff_id', $zoneMukim->rs_staff_id) == $person->id ? 'selected' : '' }}>{{ $person->kod }} — {{ $person->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field" style="grid-column:span 3">
                    <label for="iq_staff_id">IQ</label>
                    <select class="input" id="iq_staff_id" name="iq_staff_id">
                        <option value="">{{ $t('--Pilih ') }}{{ $t('Kakitangan') }}--</option>
                        @foreach ($staff as $person)
                            <option value="{{ $person->id }}" {{ old('iq_staff_id', $zoneMukim->iq_staff_id) == $person->id ? 'selected' : '' }}>{{ $person->kod }} — {{ $person->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </section>

        <div class="row">
            <button class="btn btn-primary" type="submit" style="padding:12px 30px;font-size:15px">{{ $t('Simpan') }}</button>
            <a class="btn" href="{{ route('housing2.zon.index') }}" style="padding:12px 20px">{{ $t('Batal') }}</a>
        </div>
    </form>
@endsection
