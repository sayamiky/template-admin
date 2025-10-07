<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat datang kembali, ") }} {{ Auth::user()->name }}!
                </div>
            </div>

            <!-- Placeholder untuk Widget/Statistik -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700">Total Pengguna</h3>
                        <p class="mt-2 text-3xl font-bold text-gray-900">1</p>
                        <p class="mt-1 text-sm text-gray-500">Pengguna terdaftar</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700">Menu Aktif</h3>
                        <p class="mt-2 text-3xl font-bold text-gray-900">5</p>
                        <p class="mt-1 text-sm text-gray-500">Contoh statistik</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700">Laporan Masuk</h3>
                        <p class="mt-2 text-3xl font-bold text-gray-900">0</p>
                        <p class="mt-1 text-sm text-gray-500">Contoh statistik</p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700">Aktivitas Hari Ini</h3>
                        <p class="mt-2 text-3xl font-bold text-gray-900">10</p>
                        <p class="mt-1 text-sm text-gray-500">Contoh statistik</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>