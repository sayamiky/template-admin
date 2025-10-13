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
{{-- @php
    // Detect if user is admin
    $isAdmin = auth()->user()->hasRole('admin');
@endphp
@foreach ($menus as $menu)
    @if ($menu->is_header)
        <li class="menu-header">
            <span class="menu-header-text">{{ $menu->name }}</span>
        </li>
    @else
        @if ($menu->children->count() > 0)
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
                        @php
                            // Remove "admin" prefix if user is not admin
                            $childRoute = $isAdmin ? $child->route : str_replace('admin.', '', $child->route);
                        @endphp
                        <li class="menu-item {{ request()->routeIs($childRoute) ? 'active' : '' }}">
                            <a href="{{ route($childRoute) }}" class="menu-link">
                                <div>{{ $child->name }}</div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @else
            <li class="menu-item {{ request()->routeIs($menu->route) ? 'active' : '' }}">
                <a href="{{ route($menu->route) }}" class="menu-link">
                    <i class="menu-icon tf-icons {{ $menu->icon }}"></i>
                    <div>{{ $menu->name }}</div>
                </a>
            </li>
        @endif
    @endif
@endforeach --}}


{{-- @php
    $isAdmin = auth()->user()->hasRole('admin');
@endphp

@foreach ($menus as $menu)
    @if ($menu->is_header)
        <li class="menu-header">
            <span class="menu-header-text">{{ $menu->name }}</span>
        </li>
    @else
        @php
            // Check if menu is viewable based on permission or if it's public
            $canViewMenu = !$menu->permission_name || auth()->user()->can($menu->permission_name);
        @endphp

        @if ($canViewMenu)
            @if ($menu->children->count() > 0)
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
                            @php
                                $childRoute = $isAdmin ? $child->route : str_replace('admin.', '', $child->route);
                                $canViewChild =
                                    !$child->permission_name || auth()->user()->can($child->permission_name);
                            @endphp
                            @if ($canViewChild)
                                <li class="menu-item {{ request()->routeIs($childRoute) ? 'active' : '' }}">
                                    <a href="{{ route($childRoute) }}" class="menu-link">
                                        <div>{{ $child->name }}</div>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="menu-item {{ request()->routeIs($menu->route) ? 'active' : '' }}">
                    <a href="{{ route($menu->route) }}" class="menu-link">
                        <i class="menu-icon tf-icons {{ $menu->icon }}"></i>
                        <div>{{ $menu->name }}</div>
                    </a>
                </li>
            @endif
        @endif
    @endif
@endforeach --}}


@php
    use Illuminate\Support\Str;

    $isAdmin = auth()->user()->hasRole('admin');
    $user = auth()->user();
@endphp

@foreach ($menus as $menu)
    @if ($menu->is_header)
        <li class="menu-header">
            <span class="menu-header-text">{{ $menu->name }}</span>
        </li>
    @else
        @php
            // Filter child menus based on permission
            $filteredChildren = $menu->children->filter(function ($child) use ($user) {
                // if menu has no permission, always show
                if (!$child->permission_name) {
                    return true;
                }
                return $user->can($child->permission_name);
            });

            // Check parent menu permission
            $canViewParent = !$menu->permission_name || $user->can($menu->permission_name);
        @endphp

        @if ($canViewParent && ($filteredChildren->count() > 0 || !$menu->children->count()))
            @if ($filteredChildren->count() > 0)
                @php
                    $isOpen = $filteredChildren->contains(function ($child) {
                        return request()->routeIs($child->route);
                    });
                @endphp
                <li class="menu-item {{ $isOpen ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons {{ $menu->icon }}"></i>
                        <div>{{ $menu->name }}</div>
                    </a>
                    <ul class="menu-sub">
                        @foreach ($filteredChildren as $child)
                            @php
                                $childRoute = $isAdmin ? $child->route : str_replace('admin.', '', $child->route);
                            @endphp
                            @if (Route::has($childRoute))
                                <li class="menu-item {{ request()->routeIs($childRoute) ? 'active' : '' }}">
                                    <a href="{{ route($childRoute) }}" class="menu-link">
                                        <div>{{ $child->name }}</div>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @else
                @php
                    $menuRoute = $isAdmin ? $menu->route : str_replace('admin.', '', $menu->route);
                @endphp
                @if (Route::has($menuRoute))
                    <li class="menu-item {{ request()->routeIs($menuRoute) ? 'active' : '' }}">
                        <a href="{{ route($menuRoute) }}" class="menu-link">
                            <i class="menu-icon tf-icons {{ $menu->icon }}"></i>
                            <div>{{ $menu->name }}</div>
                        </a>
                    </li>
                @endif
            @endif
        @endif
    @endif
@endforeach
