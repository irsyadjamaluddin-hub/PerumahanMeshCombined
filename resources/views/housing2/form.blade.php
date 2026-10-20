@extends('layouts.housing2')
@section('title', $rekod->exists ? 'Sunting Rekod' : 'Rekod Baharu')

@php $t = fn ($s) => \App\Support\Housing2Lang::t($s); @endphp

@section('content')
    <a class="btn btn-ghost" href="{{ route('housing2.list', $jenis) }}" style="align-self:flex-start">&larr; {{ $t($cfg['title']) }}</a>

    <div>
        <h6>{{ $rekod->exists ? $t('Sunting rekod') : $t('Rekod baharu') }}</h6>
        <h1>{{ $t($rekod->jenis_permohonan) ?? $t($cfg['short']) }}</h1>
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

    <form method="POST" enctype="multipart/form-data"
          action="{{ $rekod->exists ? route('housing2.update', [$jenis, $rekod]) : route('housing2.store', $jenis) }}"
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
                    <span>{{ $t($section['title']) }}</span>
                </div>
                <div class="form-grid" style="padding:16px">
                    @foreach ($section['fields'] as $field)
                        @php
                            $name = \Illuminate\Support\Str::slug($field['label'], '_');
                            $type = $field['type'] ?? 'text';
                            $default = $field['default'] ?? null;
                            $defaultValue = $default === 'today' ? now()->format('Y-m-d') : ($default ?? '');
                            $fallback = $rekod->data[$name]
                                ?? (! $rekod->exists ? $defaultValue : '');
                            $value = old("fields.$name", $fallback);
                            $labelText = $t($field['label']);
                        @endphp
                        <div class="field" style="grid-column:span {{ $field['span'] }}">
                            <label for="{{ $name }}">{{ $labelText }}</label>
                            @if ($type === 'file')
                                <input class="input" id="{{ $name }}" type="file" name="files[{{ $name }}]">
                                @if ($value)
                                    <span class="muted" style="font-size:12px">
                                        {{ $t('Fail semasa:') }}
                                        <a href="{{ \Illuminate\Support\Facades\Storage::url($value) }}" target="_blank">{{ basename($value) }}</a>
                                    </span>
                                @endif
                            @elseif ($type === 'select')
                                @php $isOther = ($field['other'] ?? false) && $value !== '' && ! in_array($value, $field['options'], true); @endphp
                                <select class="input" id="{{ $name }}"
                                        name="{{ $isOther ? '' : "fields[$name]" }}"
                                        @if ($field['other'] ?? false) data-other-for="{{ $name }}_other" data-field-name="fields[{{ $name }}]" @endif>
                                    <option value="">{{ $t('--Pilih ') }}{{ $labelText }}--</option>
                                    @foreach ($field['options'] as $option)
                                        <option value="{{ $option }}" {{ $value === $option ? 'selected' : '' }}>{{ $t($option) }}</option>
                                    @endforeach
                                    @if ($field['other'] ?? false)
                                        <option value="__lain__" {{ $isOther ? 'selected' : '' }}>{{ $t('Lain-lain') }}</option>
                                    @endif
                                </select>
                                @if ($field['other'] ?? false)
                                    <input class="input" type="text" id="{{ $name }}_other"
                                           name="{{ $isOther ? "fields[$name]" : '' }}"
                                           value="{{ $isOther ? $value : '' }}"
                                           placeholder="{{ $t('Nyatakan ') }}{{ strtolower($labelText) }}"
                                           style="margin-top:6px;{{ $isOther ? '' : 'display:none' }}">
                                @endif
                            @elseif ($type === 'area')
                                <textarea class="input" id="{{ $name }}" name="fields[{{ $name }}]" rows="3"
                                          placeholder="{{ $t('Isi ') }}{{ strtolower($labelText) }}">{{ $value }}</textarea>
                            @else
                                <input class="input" id="{{ $name }}"
                                       type="{{ $type === 'date' ? 'date' : ($type === 'number' ? 'number' : 'text') }}"
                                       name="fields[{{ $name }}]" value="{{ $value }}"
                                       placeholder="{{ $field['placeholder'] ?? $t('Isi ').strtolower($labelText) }}"
                                       @if (($field['rule'] ?? null) === 'digits') inputmode="numeric" pattern="[0-9]*" oninput="this.value=this.value.replace(/[^0-9]/g,'')" @endif>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach

        @php $statusOptions = $cfg['statuses'] ?? config('housing2.statuses'); @endphp
        <div class="field" style="max-width:260px">
            <label>{{ $t('Status Rekod') }}</label>
            @if (count($statusOptions) === 1)
                <input type="hidden" name="status" value="{{ $statusOptions[0] }}">
                <span style="font-size:15px">{{ $t($statusOptions[0]) }}</span>
            @else
                <select class="input" id="status" name="status">
                    @foreach ($statusOptions as $status)
                        <option value="{{ $status }}" {{ old('status', $rekod->status) === $status ? 'selected' : '' }}>{{ $t($status) }}</option>
                    @endforeach
                </select>
            @endif
        </div>

        <div class="row">
            <button class="btn btn-primary" type="submit" style="padding:12px 30px;font-size:15px">{{ $t('Simpan') }}</button>
            <a class="btn" href="{{ route('housing2.list', $jenis) }}" style="padding:12px 20px">{{ $t('Batal') }}</a>
        </div>
    </form>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('select[data-other-for]').forEach((select) => {
                    const other = document.getElementById(select.dataset.otherFor);
                    const fieldName = select.dataset.fieldName;

                    const sync = () => {
                        const isOther = select.value === '__lain__';
                        other.style.display = isOther ? '' : 'none';
                        select.name = isOther ? '' : fieldName;
                        other.name = isOther ? fieldName : '';
                        if (isOther) {
                            other.focus();
                        }
                    };

                    select.addEventListener('change', sync);
                });

                const wireKppWarna = (warnaId, kppId) => {
                    const warna = document.getElementById(warnaId);
                    const kpp = document.getElementById(kppId);
                    if (! warna || ! kpp) {
                        return;
                    }
                    const kppLengthByWarna = { Kuning: 8, Merah: 12, Hijau: 12 };
                    const kppPlaceholderByWarna = { Kuning: '00123456', Merah: '001234567891', Hijau: '001234567891' };
                    const defaultPlaceholder = kpp.getAttribute('placeholder');
                    const syncKppLength = () => {
                        const required = kppLengthByWarna[warna.value];
                        if (required) {
                            kpp.setAttribute('maxlength', String(required));
                            if (kpp.value.length > required) {
                                kpp.value = kpp.value.slice(0, required);
                            }
                        } else {
                            kpp.removeAttribute('maxlength');
                        }
                        kpp.setAttribute('placeholder', kppPlaceholderByWarna[warna.value] ?? defaultPlaceholder);
                    };
                    warna.addEventListener('change', () => {
                        kpp.value = '';
                        syncKppLength();
                    });
                    syncKppLength();
                };

                wireKppWarna('warna', 'no_kpp_pemohon');
                wireKppWarna('warna', 'no_kpp_pemilik');
                wireKppWarna('warna', 'no_kpp_penghuni');
                wireKppWarna('warna_kpp_pasangan', 'no_kpp_pasangan');
            });
        </script>
    @endpush
@endsection
