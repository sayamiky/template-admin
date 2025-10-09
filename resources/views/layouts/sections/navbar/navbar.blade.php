@php
    $containerNav = $containerNav ?? 'container-xxl';
    $navbarDetached = $navbarDetached ?? '';
@endphp

<!-- Navbar -->
@if (isset($navbarDetached) && $navbarDetached == 'navbar-detached')
    <nav class="layout-navbar {{ $containerNav }} navbar navbar-expand-xl {{ $navbarDetached }} align-items-center bg-navbar-theme"
        id="layout-navbar">
@endif
@if (isset($navbarDetached) && $navbarDetached == '')
    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
@endif

<!-- ! Toggle untuk Mobile -->
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="ri-menu-fill ri-22px"></i>
    </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

    <!-- ! Toggle untuk Desktop -->
    <div class="navbar-nav align-items-center">
        <a class="nav-link layout-menu-toggle d-none d-xl-block" href="javascript:void(0);">
            <i class='ri-menu-2-line ri-22px'></i>
        </a>
    </div>

    <ul class="navbar-nav flex-row align-items-center ms-auto">

        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow px-7" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                    <img src="https://placehold.co/40x40/7367F0/FFFFFF?text={{ substr(Auth::user()->name, 0, 1) }}" alt
                        class="w-px-40 h-auto rounded-circle">
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar avatar-online">
                                    <img src="https://placehold.co/40x40/7367F0/FFFFFF?text={{ substr(Auth::user()->name, 0, 1) }}"
                                        alt class="w-px-40 h-auto rounded-circle">
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="fw-medium d-block">{{ Auth::user()->name }}</span>
                                <small class="text-muted">{{ Auth::user()->getRoleNames()->first() ?? 'User' }}</small>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="ri-user-3-line me-2"></i>
                        <span class="align-middle">My Profile</span>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <!-- Tombol Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class='ri-logout-box-r-line me-2'></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </form>
                </li>
            </ul>
        </li>
        <!--/ User -->

    </ul>
</div>
</nav>
<!-- / Navbar -->

