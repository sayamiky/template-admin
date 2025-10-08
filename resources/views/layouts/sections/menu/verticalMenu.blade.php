<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
    @if (!isset($navbarFull))
        <div class="app-brand demo">
            <a href="{{ url('/') }}" class="app-brand-link">
                <span class="app-brand-logo demo">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/d2/Lambang_Kabupaten_Badung.png"
                        alt="Logo Kabupaten Badung" style="height: 32px;">
                </span>
                <span class="app-brand-text demo menu-text fw-bold ms-2">{{ config('app.name', 'Laravel') }}</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                <i class="ri-close-line d-block d-xl-none"></i>
            </a>
        </div>
    @endif


    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @foreach ($menuData[0]->menu as $menu)
            {{-- adding menu headers --}}
            @if (isset($menu->menuHeader))
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">{{ $menu->menuHeader }}</span>
                </li>
            @else
                {{-- active menu method --}}
                @php
                    // Logika disederhanakan: akan aktif jika URL saat ini diawali dengan URL menu
                    $activeClass = isset($menu->url) && Request::is(ltrim($menu->url, '/') . '*') ? 'active' : '';
                @endphp

                {{-- main menu --}}
                <li class="menu-item {{ $activeClass }}">
                    <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}"
                        class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}"
                        @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>
                        @if (isset($menu->icon))
                            <i class="{{ $menu->icon }} me-3"></i>
                        @endif
                        <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
                    </a>

                    {{-- submenu --}}
                    @if (isset($menu->submenu))
                        @include('layouts.sections.menu.submenu', ['menu' => $menu->submenu])
                    @endif
                </li>
            @endif
        @endforeach
    </ul>

</aside>

