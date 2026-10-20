@php
    $types = config('perumahan.types');
    $groups = config('perumahan.groups');
    $active = request()->route('jenis');
@endphp

<nav class="sidebar">
    <a class="btn btn-gold" href="{{ route('perumahan.choose', 'pemohon') }}">+ Rekod Baharu</a>

    <div class="group">
        <h6>Papan Utama</h6>
        <a class="item {{ request()->routeIs('perumahan.index') ? 'active' : '' }}" href="{{ route('perumahan.index') }}">
            <span>Utama</span><span></span>
        </a>
    </div>

    @foreach ($groups as $groupTitle => $keys)
        <div class="group">
            <h6>{{ $groupTitle }}</h6>
            @foreach ($keys as $key)
                <a class="item {{ $active === $key ? 'active' : '' }}" href="{{ route('perumahan.list', $key) }}">
                    <span>{{ $types[$key]['title'] }}</span>
                    <span>{{ \App\Models\Rekod::jenis($key)->count() }}</span>
                </a>
            @endforeach
        </div>
    @endforeach
</nav>
