<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if nav-collapsed -->
    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="app-brand-link">

            <span class="app-brand-logo demo">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d2/Lambang_Kabupaten_Badung.png"
                    alt="Logo Kabupaten Badung" style="height: 40px;">
            </span>
            <span class="app-brand-text demo menu-text fw-bold">DISKOMINFO</span>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @include('layouts.sections.partials._sidebar-menu')
    </ul>

</aside>