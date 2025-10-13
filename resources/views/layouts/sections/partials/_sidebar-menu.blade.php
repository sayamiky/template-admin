{{-- Dashboard --}}
<li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <a href="{{ route('admin.dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons ri-home-smile-line"></i>
        <div>Dasbor</div>
    </a>
</li>

{{-- Header Manajemen --}}
<li class="menu-header">
    <span class="menu-header-text">Manajemen</span>
</li>

{{-- Grup Manajemen Sistem --}}
@php
    $isManajemenOpen =
        request()->routeIs('admin.users.*') ||
        request()->routeIs('admin.roles.*') ||
        request()->routeIs('admin.permissions.*') ||
        request()->routeIs('admin.menus.*');
@endphp
{{-- <li class="menu-item {{ $isManajemenOpen ? 'open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ri-shield-user-line"></i>
        <div>Manajemen Sistem</div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}" class="menu-link">
                <div>Pengguna</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
            <a href="{{ route('admin.roles.index') }}" class="menu-link">
                <div>Role</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
            <a href="{{ route('admin.permissions.index') }}" class="menu-link">
                <div>Izin Akses</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
            <a href="{{ route('admin.menus.index') }}" class="menu-link">
                <div>Menu</div>
            </a>
        </li>
    </ul>
</li> --}}
@foreach ($menus as $menu)
    {{-- Header --}}
    @if ($menu->is_header)
        <li class="menu-header">
            <span class="menu-header-text">{{ $menu->name }}</span>
        </li>
    @else
        @if ($menu->children->count() > 0)
            {{-- Parent menu with submenus --}}
            @php
                $isOpen = collect($menu->children)->contains(function ($child) {
                    return request()->routeIs($child->route);
                });
            @endphp
            <li class="menu-item {{ $isOpen ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons {{ $menu->icon }}"></i>
                    <div>{{ $menu->name }}</div>
                </a>
                <ul class="menu-sub">
                    @foreach ($menu->children as $child)
                        <li class="menu-item {{ request()->routeIs($child->route) ? 'active' : '' }}">
                            <a href="{{ route($child->route) }}" class="menu-link">
                                <div>{{ $child->name }}</div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @else
            {{-- Single menu item --}}
            <li class="menu-item {{ request()->routeIs($menu->route) ? 'active' : '' }}">
                <a href="{{ route($menu->route) }}" class="menu-link">
                    <i class="menu-icon tf-icons {{ $menu->icon }}"></i>
                    <div>{{ $menu->name }}</div>
                </a>
            </li>
        @endif
    @endif
@endforeach
