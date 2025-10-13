<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Diskominfo Kabupaten Badung</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

</head>

<body class="antialiased bg-gray-50 text-gray-800">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center">
                        <!-- Logo dengan warna merah -->
                        <img src="https://diskominfo.badungkab.go.id/theme/neonlight/assets/images/favicon.png" alt="" srcset="">
                        <span class="ml-3 font-bold text-xl text-gray-700">Diskominfo Badung</span>
                    </div>
                    <nav class="hidden md:flex space-x-8">
                        <a href="#" class="font-medium text-gray-600 hover:text-primary">Beranda</a>
                        <a href="#layanan" class="font-medium text-gray-600 hover:text-primary">Layanan</a>
                        <a href="#tentang" class="font-medium text-gray-600 hover:text-primary">Tentang</a>
                        <a href="#kontak" class="font-medium text-gray-600 hover:text-primary">Kontak</a>
                    </nav>
                    <div>
                        @if (Route::has('login'))
                        @auth
                        <a href="{{ url('/dashboard') }}"
                            class="rounded-md px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">Dashboard</a>
                        @else
                        <a href="{{ route('login') }}"
                            class="rounded-md px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">Login</a>
                        @endauth
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            <!-- Hero Section -->
            <section class="bg-white">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        <div class="text-center lg:text-left">
                            <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight">
                                Mewujudkan <span class="text-primary">Badung Smart City</span> Melalui Transformasi Digital
                            </h1>
                            <p class="mt-6 text-lg text-gray-600 max-w-xl mx-auto lg:mx-0">
                                Dinas Komunikasi dan Informatika Kabupaten Badung berkomitmen untuk memberikan pelayanan publik yang
                                transparan, efisien, dan inovatif berbasis teknologi informasi.
                            </p>
                            <div class="mt-8 flex justify-center lg:justify-start">
                                <a href="#layanan"
                                    class="rounded-md px-6 py-3 text-base font-medium text-white bg-primary hover:bg-primary-700">
                                    Jelajahi Layanan Kami
                                </a>
                            </div>
                        </div>
                        <div class="hidden lg:block">
                            <!-- Ganti dengan gambar yang relevan -->
                            <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=2070&auto=format&fit=crop"
                                alt="Government Technology" class="rounded-lg shadow-xl">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Services Section -->
            <section id="layanan" class="py-20 lg:py-24">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-3xl font-extrabold text-gray-900">Layanan Unggulan Kami</h2>
                        <p class="mt-4 text-lg text-gray-600">Menyediakan solusi digital terintegrasi untuk masyarakat dan
                            pemerintahan.</p>
                    </div>
                    <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                        <!-- Service 1 -->
                        <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                            <div
                                class="flex items-center justify-center h-12 w-12 rounded-full bg-primary-100 text-primary mx-auto mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-center">Pengembangan Aplikasi</h3>
                            <p class="mt-2 text-gray-600 text-center">Membangun aplikasi web dan mobile untuk mendukung efektivitas
                                pelayanan publik.</p>
                        </div>
                        <!-- Service 2 -->
                        <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                            <div
                                class="flex items-center justify-center h-12 w-12 rounded-full bg-primary-100 text-primary mx-auto mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-center">Infrastruktur Jaringan</h3>
                            <p class="mt-2 text-gray-600 text-center">Menyediakan dan mengelola infrastruktur jaringan internet yang
                                andal dan aman.</p>
                        </div>
                        <!-- Service 3 -->
                        <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                            <div
                                class="flex items-center justify-center h-12 w-12 rounded-full bg-primary-100 text-primary mx-auto mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-center">Keamanan Informasi</h3>
                            <p class="mt-2 text-gray-600 text-center">Melindungi aset data dan informasi pemerintah daerah dari ancaman
                                siber.</p>
                        </div>
                        <!-- Service 4 -->
                        <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                            <div
                                class="flex items-center justify-center h-12 w-12 rounded-full bg-primary-100 text-primary mx-auto mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-center">Layanan Publik Digital</h3>
                            <p class="mt-2 text-gray-600 text-center">Mengelola portal resmi dan pusat informasi terpadu untuk
                                masyarakat Badung.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- About Section -->
            <section id="tentang" class="bg-white py-20 lg:py-24">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        <div>
                            <img
                                src="https://assets.badungkab.go.id/webp/1920x1080_dengan_latar_foto_bupati_dan_wakil_bupati_di_tengah.webp"
                                alt="Puspem Badung" class="rounded-lg shadow-xl">
                        </div>
                        <div>
                            <h2 class="text-3xl font-extrabold text-gray-900">Tentang Diskominfo Badung</h2>
                            <p class="mt-4 text-lg text-gray-600">
                                Dinas Komunikasi dan Informatika (Diskominfo) Kabupaten Badung adalah perangkat daerah yang memiliki
                                tugas pokok melaksanakan urusan pemerintahan di bidang komunikasi, informatika, statistik, dan
                                persandian.
                            </p>
                            <p class="mt-4 text-gray-600">
                                Visi kami adalah terwujudnya masyarakat informasi Kabupaten Badung yang maju dan berdaya saing melalui
                                pemanfaatan teknologi informasi dan komunikasi yang terintegrasi dan berkelanjutan.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <!-- Footer -->
    <footer id="kontak" class="bg-gray-800 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold">Diskominfo Kabupaten Badung</h3>
                    <p class="mt-2 text-gray-400">
                        Pusat Pemerintahan Kabupaten Badung "Mangupraja Mandala", Jl. Raya Sempidi, Mengwi, Badung, Bali.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Kontak Kami</h3>
                    <ul class="mt-2 space-y-2 text-gray-400">
                        <li>Email: <a href="mailto:diskominfo@badungkab.go.id"
                                class="hover:text-white">diskominfo@badungkab.go.id</a></li>
                        <li>Telepon: (0361) 123-456</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Ikuti Kami</h3>
                    <div class="flex mt-2 space-x-4">
                        {{-- Ganti '#' dengan link sosial media yang relevan --}}
                        <a href="#" class="text-gray-400 hover:text-white">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.012-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.345 2.525c.636-.247 1.363-.416 2.427-.465C9.795 2.013 10.148 2 12.315 2zm-1.163 1.943c-1.049.048-1.688.211-2.227.427a3.022 3.022 0 00-1.17 1.17c-.216.539-.379 1.178-.427 2.227-.049 1.024-.06 1.358-.06 3.633s.011 2.609.06 3.633c.048 1.049.211 1.688.427 2.227a3.022 3.022 0 001.17 1.17c.539.216 1.178.379 2.227.427 1.024.049 1.358.06 3.633.06s2.609-.011 3.633-.06c1.049-.048 1.688-.211 2.227-.427a3.022 3.022 0 001.17-1.17c.216-.539.379-1.178.427-2.227.049-1.024.06-1.358.06-3.633s-.011-2.609-.06-3.633c-.048-1.049-.211-1.688-.427-2.227a3.022 3.022 0 00-1.17-1.17c-.539-.216-1.178-.379-2.227-.427C15.228 3.953 14.887 3.943 12.685 3.943h-1.534zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zM12 15a3 3 0 100-6 3 3 0 000 6z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.71v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-700 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Dinas Komunikasi dan Informatika Kabupaten Badung. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>