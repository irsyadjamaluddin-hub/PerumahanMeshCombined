@extends('layouts.kkk')

@section('title', 'Pemeriksaan Kunci Kira-Kira')

@section('content')
@php
    $t = fn ($s) => \App\Support\KkkLang::t($s);
    $role = session('kkk_role');
    $locale = \App\Support\KkkLang::locale();
@endphp

<div class="kkk-page-head">
    <h1>{{ $t('Pemeriksaan Kunci Kira-Kira') }}</h1>
    <p>{{ $t('Satu rekod bagi setiap sekolah, tempoh dan kategori') }}</p>
</div>

<div class="kkk-grid cols-2" style="align-items:start">
    <div>
        <form method="GET" action="{{ route('kkk.pemeriksaan') }}" class="kkk-card" style="display:flex;gap:14px;flex-wrap:wrap;align-items:flex-end">
            <div class="kkk-field" style="margin:0">
                <label>{{ $t('Tahun kewangan') }}</label>
                <select name="tahun_kewangan" class="kkk-input" onchange="this.form.submit()">
                    @foreach ($tahunPilihan as $y)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div class="kkk-field" style="margin:0">
                <label>{{ $t('Penggal') }}</label>
                <select name="penggal" class="kkk-input" onchange="this.form.submit()">
                    <option value="">{{ $t('Semua') }}</option>
                    <option value="1" {{ $penggal == '1' ? 'selected' : '' }}>{{ $t('Penggal 1 · Jan-Jun') }}</option>
                    <option value="2" {{ $penggal == '2' ? 'selected' : '' }}>{{ $t('Penggal 2 · Jul-Dis') }}</option>
                </select>
            </div>
            <div class="kkk-field" style="margin:0">
                <label>{{ $t('Kategori') }}</label>
                <select name="kategori" class="kkk-input" onchange="this.form.submit()">
                    <option value="">{{ $t('Semua') }}</option>
                    @foreach (['Kantin', 'Yuran', 'Rampaian'] as $k)
                        <option value="{{ $k }}" {{ $kategori === $k ? 'selected' : '' }}>{{ $t($k) }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <div>
        @if ($selected)
            @php $m = $selected->meta($locale); $terakhirKuiri = $selected->kuiri->last(); $kuiriTerbuka = $terakhirKuiri && ! $terakhirKuiri->tarikh_jawapan; @endphp
            <div class="kkk-card">
                <h2>{{ $selected->sekolah->nama }}</h2>
                <p class="kkk-muted" style="margin:-8px 0 12px">{{ $t($selected->kategori) }} · {{ $t('Penggal') }} {{ $selected->penggal }} · {{ $selected->tahun_kewangan }}</p>
                <span class="kkk-badge" style="background:{{ $m['bg'] }};color:{{ $m['fg'] }}"><span class="dot" style="background:{{ $m['dot'] }}"></span>{{ $m['label'] }}</span>
                @if ($selected->locked)
                    <span class="kkk-badge" style="background:#ECEBF2;color:#4A4766;margin-left:6px">{{ $t('Dikunci') }}</span>
                @endif

                <div class="kkk-timeline" style="margin-top:16px">
                    <div class="step {{ $selected->tarikh_diterima ? 'done' : '' }}">
                        <span class="pt"></span>
                        <span><span class="lbl">{{ $t('Diterima') }}</span> — <span class="dt">{{ $selected->tarikh_diterima?->format('d/m/Y') ?? '—' }}</span></span>
                    </div>
                    @foreach ($selected->kuiri as $k)
                        <div class="step done">
                            <span class="pt"></span>
                            <span><span class="lbl">{{ $t('Dalam kuiri') }} #{{ $k->pusingan }}</span> — <span class="dt">{{ $k->tarikh_dihadapkan->format('d/m/Y') }}</span></span>
                        </div>
                        @if ($k->tarikh_jawapan)
                            <div class="step done">
                                <span class="pt"></span>
                                <span><span class="lbl">{{ $t('Jawapan diterima') }} #{{ $k->pusingan }}</span> — <span class="dt">{{ $k->tarikh_jawapan->format('d/m/Y') }}</span></span>
                            </div>
                        @endif
                    @endforeach
                    <div class="step {{ $selected->tarikh_tfv ? 'done' : '' }}">
                        <span class="pt"></span>
                        <span><span class="lbl">{{ $t('True & Fair View') }}</span> — <span class="dt">{{ $selected->tarikh_tfv?->format('d/m/Y') ?? '—' }}</span></span>
                    </div>
                </div>

                @if (! $selected->tarikh_diterima)
                    <form method="POST" action="{{ route('kkk.pemeriksaan.terima', $selected) }}" style="margin-top:14px;border-top:1px solid var(--kkk-border);padding-top:14px">
                        @csrf
                        <div class="kkk-field">
                            <label>{{ $t('Tarikh diterima') }}</label>
                            <input type="date" name="tarikh_diterima" class="kkk-input" max="{{ now()->toDateString() }}" required>
                        </div>
                        <button type="submit" class="kkk-btn kkk-btn-primary">{{ $t('KKK diterima') }}</button>
                    </form>
                @endif

                @if ($selected->tarikh_diterima && ! $selected->locked && ! $kuiriTerbuka && $selected->kuiri->count() < 3)
                    <form method="POST" action="{{ route('kkk.pemeriksaan.kuiri', $selected) }}" style="margin-top:14px;border-top:1px solid var(--kkk-border);padding-top:14px">
                        @csrf
                        <div class="kkk-field">
                            <label>{{ $t('Tarikh tindakan') }} ({{ $t('Dalam kuiri') }} #{{ ($terakhirKuiri->pusingan ?? 0) + 1 }})</label>
                            <input type="date" name="tarikh_dihadapkan" class="kkk-input" max="{{ now()->toDateString() }}" required>
                        </div>
                        <div class="kkk-field">
                            <label>{{ $t('Catatan') }}</label>
                            <textarea name="keterangan" class="kkk-input" placeholder="{{ $t('Keterangan untuk makluman dan peringatan') }}"></textarea>
                        </div>
                        <button type="submit" class="kkk-btn kkk-btn-primary">{{ $t('Dalam kuiri') }}</button>
                    </form>
                @endif

                @if ($kuiriTerbuka)
                    <form method="POST" action="{{ route('kkk.pemeriksaan.jawapan', $selected) }}" style="margin-top:14px;border-top:1px solid var(--kkk-border);padding-top:14px">
                        @csrf
                        <div class="kkk-field">
                            <label>{{ $t('Tarikh tindakan') }} ({{ $t('Jawapan diterima') }} #{{ $terakhirKuiri->pusingan }})</label>
                            <input type="date" name="tarikh_jawapan" class="kkk-input" max="{{ now()->toDateString() }}" required>
                        </div>
                        <button type="submit" class="kkk-btn kkk-btn-primary">{{ $t('Jawapan diterima') }}</button>
                    </form>
                @endif

                @if ($selected->tarikh_diterima && ! $selected->locked && ! $kuiriTerbuka)
                    <form method="POST" action="{{ route('kkk.pemeriksaan.tfv', $selected) }}" style="margin-top:14px;border-top:1px solid var(--kkk-border);padding-top:14px">
                        @csrf
                        <div class="kkk-field">
                            <label>{{ $t('Tarikh tindakan') }} ({{ $t('True & Fair View') }})</label>
                            <input type="date" name="tarikh_tfv" class="kkk-input" max="{{ now()->toDateString() }}" required>
                        </div>
                        <button type="submit" class="kkk-btn kkk-btn-accent">{{ $t('True & Fair View') }}</button>
                    </form>
                @endif

                @if ($role === 'ketua_sub' && $selected->locked)
                    <form method="POST" action="{{ route('kkk.pemeriksaan.reopen', $selected) }}" style="margin-top:14px;border-top:1px solid var(--kkk-border);padding-top:14px">
                        @csrf
                        <div class="kkk-field">
                            <label>{{ $t('Sebab buka semula (wajib)') }}</label>
                            <textarea name="sebab" class="kkk-input" placeholder="{{ $t('cth. pembetulan tarikh TFV') }}" required></textarea>
                        </div>
                        <button type="submit" class="kkk-btn kkk-btn-danger">{{ $t('Buka semula rekod') }}</button>
                    </form>
                @endif

                <form method="POST" action="{{ route('kkk.pemeriksaan.catatan', $selected) }}" style="margin-top:14px;border-top:1px solid var(--kkk-border);padding-top:14px">
                    @csrf
                    <div class="kkk-field">
                        <label>{{ $t('Catatan') }}</label>
                        <textarea name="catatan" class="kkk-input" placeholder="{{ $t('Keterangan untuk makluman dan peringatan') }}">{{ $selected->catatan }}</textarea>
                    </div>
                    <button type="submit" class="kkk-btn kkk-btn-ghost">{{ $t('Simpan') }}</button>
                </form>
            </div>
        @else
            <form method="POST" action="{{ route('kkk.pemeriksaan.jana') }}" class="kkk-card">
                @csrf
                <h2>{{ $t('Jana akaun dijangka') }}</h2>
                <p class="kkk-muted" style="margin:-6px 0 12px;font-size:12.5px">{{ $t('Cipta rekod Tidak diterima bagi setiap sekolah aktif dan setiap kategori yang belum ada.') }}</p>
                <div class="kkk-grid cols-2">
                    <div class="kkk-field">
                        <label>{{ $t('Tahun kewangan') }}</label>
                        <select name="tahun_kewangan" class="kkk-input">
                            @foreach ($tahunPilihan as $y)
                                <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="kkk-field">
                        <label>{{ $t('Penggal') }}</label>
                        <select name="penggal" class="kkk-input" required>
                            <option value="1">{{ $t('Penggal 1 · Jan-Jun') }}</option>
                            <option value="2">{{ $t('Penggal 2 · Jul-Dis') }}</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="kkk-btn kkk-btn-primary">{{ $t('Jana') }}</button>
            </form>
        @endif
    </div>
</div>

<div class="kkk-card" style="padding:0;max-width:960px;margin:20px auto 0">
    @if ($rekods->isEmpty())
        <div class="kkk-empty">{{ $t('Tiada rekod bagi tempoh ini.') }}</div>
    @else
        <table class="kkk-table">
            <thead>
                <tr>
                    <th>{{ $t('Sekolah') }}</th>
                    <th>{{ $t('Kluster') }}</th>
                    <th>{{ $t('Kategori') }}</th>
                    <th>{{ $t('Tempoh') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rekods as $r)
                    <tr class="clickable {{ $selected && $selected->id === $r->id ? 'is-selected' : '' }}"
                        onclick="window.location='{{ route('kkk.pemeriksaan', array_filter(['tahun_kewangan' => $tahun, 'penggal' => $penggal, 'kategori' => $kategori, 'pilih' => $r->id])) }}'">
                        <td>{{ $r->sekolah->nama }}</td>
                        <td>{{ $r->sekolah->kluster }}</td>
                        <td>{{ $t($r->kategori) }}</td>
                        <td>{{ $t('Penggal') }} {{ $r->penggal }} · {{ $r->tahun_kewangan }}</td>
                        <td>
                            @php $m = $r->meta($locale); @endphp
                            <span class="kkk-badge" style="background:{{ $m['bg'] }};color:{{ $m['fg'] }}"><span class="dot" style="background:{{ $m['dot'] }}"></span>{{ $m['label'] }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<form method="POST" action="{{ route('kkk.pemeriksaan.store') }}" class="kkk-card" style="max-width:960px;margin:20px auto 0">
    @csrf
    <h2>{{ $t('+ Daftar KKK diterima') }}</h2>
    <div class="kkk-grid cols-2">
        <div class="kkk-field">
            <label>{{ $t('Sekolah') }}</label>
            <select name="sekolah_id" class="kkk-input" required>
                @foreach ($sekolahs as $s)
                    <option value="{{ $s->id }}">{{ $s->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="kkk-field">
            <label>{{ $t('Tarikh diterima') }} ({{ $t('kosongkan jika belum diterima') }})</label>
            <input type="date" name="tarikh_diterima" class="kkk-input" max="{{ now()->toDateString() }}">
        </div>
        <div class="kkk-field">
            <label>{{ $t('Tahun kewangan') }}</label>
            <select name="tahun_kewangan" class="kkk-input">
                @foreach ($tahunPilihan as $y)
                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
            </select>
        </div>
        <div class="kkk-field">
            <label>{{ $t('Penggal') }}</label>
            <select name="penggal" class="kkk-input" required>
                <option value="1">{{ $t('Penggal 1 · Jan-Jun') }}</option>
                <option value="2">{{ $t('Penggal 2 · Jul-Dis') }}</option>
            </select>
        </div>
        <div class="kkk-field">
            <label>{{ $t('Kategori') }}</label>
            <select name="kategori" class="kkk-input" required>
                <option value="Kantin">{{ $t('Kantin') }}</option>
                <option value="Yuran">{{ $t('Yuran') }}</option>
                <option value="Rampaian">{{ $t('Rampaian') }}</option>
            </select>
        </div>
    </div>
    <button type="submit" class="kkk-btn kkk-btn-primary">{{ $t('Simpan') }}</button>
</form>
@endsection
