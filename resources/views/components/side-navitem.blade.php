@props(['route', 'icon', 'itemname'])

<li class="nav-item">
    <a class="nav-link {{ request()->is(Str::lower($itemname) . '*') ? 'active' : '' }} " href="{{ route($route) }}">
        <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
            <i class="{{ $icon }} text-sm {{ request()->is(Str::lower($itemname) . '*') ? 'text-white' : 'text-dark' }}"></i>
        </div>
        <span class="nav-link-text ms-1">{{ $itemname }}</span>
    </a>
</li>