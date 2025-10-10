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
$isManajemenOpen = request()->routeIs('admin.users.*') || request()->routeIs('admin.roles.*') || request()->routeIs('admin.permissions.*') || request()->routeIs('admin.menus.*');
@endphp
<li class="menu-item {{ $isManajemenOpen ? 'open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ri-shield-user-line"></i>
        <div>Manajemen Sistem</div>
    </a>
    <ul class="menu-sub">
        {{-- Pengguna --}}
        <li class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}" class="menu-link">
                <div>Pengguna</div>
            </a>
        </li>
        {{-- Roles --}}
        <li class="menu-item {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
            <a href="{{ route('admin.roles.index') }}" class="menu-link">
                <div>Role</div>
            </a>
        </li>
        {{-- Permissions --}}
        <li class="menu-item {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
            <a href="{{ route('admin.permissions.index') }}" class="menu-link">
                <div>Izin Akses</div>
            </a>
        </li>
        {{-- Menu (BARU) --}}
        <li class="menu-item {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
            <a href="{{ route('admin.menus.index') }}" class="menu-link">
                <div>Menu</div>
            </a>
        </li>
    </ul>
</li>