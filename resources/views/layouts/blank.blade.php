<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style customizer-hide" dir="ltr"
    data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <link rel="shortcut icon" href="https://diskominfo.badungkab.go.id/badung.png" type="image/x-icon">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    <meta name="description" content="SIM Instansi Pemerintah" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://diskominfo.badungkab.go.id/badung.png" />
    <link rel="shortcut icon" href="https://diskominfo.badungkab.go.id/badung.png" />
    <link rel="apple-touch-icon" href="https://diskominfo.badungkab.go.id/badung.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/remixicon/remixicon.css') }}" />

    {{-- Aset dari Vite --}}
    @vite([
    'resources/assets/vendor/scss/core.scss',
    'resources/assets/vendor/scss/theme-default.scss',
    'resources/assets/vendor/scss/pages/page-auth.scss'
    ])

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- reCaptcha Script -->
    {!! NoCaptcha::renderJs() !!}
</head>

<body>
    <!-- Content -->
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            {{-- Slot untuk konten (form login, dll.) akan dimasukkan di sini --}}
            {{ $slot }}
        </div>
    </div>
    <!-- / Content -->

    {{-- Core JS --}}
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
</body>

</html>