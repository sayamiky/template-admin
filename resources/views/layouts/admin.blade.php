@php
// Mengambil variabel dari file config/variables.php yang baru kita tambahkan
$container = $container ?? 'container-fluid';
$containerNav = $containerNav ?? 'container-fluid';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{url('/')}}" data-framework="laravel" data-template="vertical-menu-laravel-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="SIM Instansi Pemerintah" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Memanggil Styles -->
    @include('layouts.sections.styles')

    <!-- =========================================================================================
  * Kunci utama ada di sini! Skrip ini menginisialisasi 'helpers.js'
  * yang menangani layout, tema (light/dark), dan fungsionalitas inti lainnya.
  * Harus dimuat di <head> untuk mencegah FOUC (flash of unstyled content).
  ========================================================================================== -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            {{-- Termasuk Sidebar Menu --}}
            @include('layouts.sections.menu.verticalMenu')

            <!-- Layout container -->
            <div class="layout-page">

                {{-- Termasuk Navbar --}}
                @include('layouts.sections.navbar.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="{{ $container }}">
                        {{-- INI ADALAH TEMPAT KONTEN DINAMIS ANDA AKAN MUNCUL --}}
                        {{ $slot }}
                    </div>
                    <!-- / Content -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Memanggil Scripts -->
    @include('layouts.sections.scripts')

</body>

</html>