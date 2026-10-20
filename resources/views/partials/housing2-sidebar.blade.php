@php
    $types = config('housing2.types');
    $groups = config('housing2.groups');
    $active = request()->route('jenis');
    $housing2ViewMode = session('housing2_view_mode', 'user');
@endphp

<nav class="sidebar">
    <div class="sidebar-particles" id="housing2Particles"></div>
    <div class="sidebar-content">
    @if ($housing2ViewMode !== 'user')
        <a class="btn btn-gold" href="{{ route('housing2.choose', 'pemohon') }}">{{ \App\Support\Housing2Lang::t('+ Rekod Baharu') }}</a>
    @endif

    @if ($housing2ViewMode === 'user')
        <div class="group">
            <h6>{{ \App\Support\Housing2Lang::t('Papan Utama') }}</h6>
            <a class="item {{ $active === 'pemohon' ? 'active' : '' }}" href="{{ route('housing2.list', 'pemohon') }}">
                <span>{{ \App\Support\Housing2Lang::t($types['pemohon']['title']) }}</span>
                <span>{{ \App\Models\Housing2Rekod::jenis('pemohon')->count() }}</span>
            </a>
            <a class="item {{ $active === 'penghuni-rs' ? 'active' : '' }}" href="{{ route('housing2.list', 'penghuni-rs') }}">
                <span>{{ \App\Support\Housing2Lang::t($types['penghuni-rs']['title']) }}</span>
                <span>{{ \App\Models\Housing2Rekod::jenis('penghuni-rs')->count() }}</span>
            </a>
            <a class="item {{ $active === 'penghuni-iq' ? 'active' : '' }}" href="{{ route('housing2.list', 'penghuni-iq') }}">
                <span>{{ \App\Support\Housing2Lang::t($types['penghuni-iq']['title']) }}</span>
                <span>{{ \App\Models\Housing2Rekod::jenis('penghuni-iq')->count() }}</span>
            </a>
            <a class="item {{ $active === 'arkib' ? 'active' : '' }}" href="{{ route('housing2.list', 'arkib') }}">
                <span>{{ \App\Support\Housing2Lang::t($types['arkib']['title']) }}</span>
                <span>{{ \App\Models\Housing2Rekod::jenis('arkib')->count() }}</span>
            </a>
        </div>
    @else

    <div class="group">
        <h6>{{ \App\Support\Housing2Lang::t('Papan Utama') }}</h6>
        <a class="item {{ request()->routeIs('housing2.index') ? 'active' : '' }}" href="{{ route('housing2.index') }}">
            <span>{{ \App\Support\Housing2Lang::t('Utama') }}</span><span></span>
        </a>
    </div>

    @foreach ($groups as $groupTitle => $keys)
        <div class="group">
            <h6>{{ \App\Support\Housing2Lang::t($groupTitle) }}</h6>
            @foreach ($keys as $key)
                <a class="item {{ $active === $key ? 'active' : '' }}" href="{{ route('housing2.list', $key) }}">
                    <span>{{ \App\Support\Housing2Lang::t($types[$key]['title']) }}</span>
                    <span>{{ \App\Models\Housing2Rekod::jenis($key)->count() }}</span>
                </a>
            @endforeach
        </div>
    @endforeach

    <div class="group">
        <h6>{{ \App\Support\Housing2Lang::t('Kekosongan') }}</h6>
        <a class="item {{ request()->routeIs('housing2.list') && $active === 'pemilik-rs' && request()->query('status') === 'Kosong' ? 'active' : '' }}"
           href="{{ route('housing2.list', 'pemilik-rs') }}?status=Kosong">
            <span>{{ \App\Support\Housing2Lang::t('Senarai RS Kosong') }}</span>
            <span>{{ \App\Models\Housing2Rekod::jenis('pemilik-rs')->where('status', 'Kosong')->count() }}</span>
        </a>
        <a class="item {{ request()->routeIs('housing2.list') && $active === 'iq' && request()->query('status') === 'Kosong' ? 'active' : '' }}"
           href="{{ route('housing2.list', 'iq') }}?status=Kosong">
            <span>{{ \App\Support\Housing2Lang::t('Senarai IQ Kosong') }}</span>
            <span>{{ \App\Models\Housing2Rekod::jenis('iq')->where('status', 'Kosong')->count() }}</span>
        </a>
    </div>

    <div class="group">
        <h6>{{ \App\Support\Housing2Lang::t('Zon') }}</h6>
        <a class="item {{ request()->routeIs('housing2.zon.*') ? 'active' : '' }}" href="{{ route('housing2.zon.index') }}">
            <span>{{ \App\Support\Housing2Lang::t('Senarai Zone mengikut Mukim dan Kakitangan Bertanggungjawab') }}</span><span></span>
        </a>
        <a class="item {{ request()->routeIs('housing2.staff.*') ? 'active' : '' }}" href="{{ route('housing2.staff.index') }}">
            <span>{{ \App\Support\Housing2Lang::t('Senarai Kakitangan') }}</span>
            <span>{{ \App\Models\Housing2Staff::count() }}</span>
        </a>
    </div>
    @endif
    </div>
</nav>
