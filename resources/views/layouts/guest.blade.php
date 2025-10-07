<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login | SIM Pemerintah</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body class="font-sans text-gray-900 antialiased">
    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!-- ===== Main Content Start ===== -->
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    {{ $slot }}
                </div>
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
</body>

</html>