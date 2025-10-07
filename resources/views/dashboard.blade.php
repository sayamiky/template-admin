    <x-admin-layout>
        <x-slot name="title">
            Halaman Dashboard
        </x-slot>

        <!-- Breadcrumb Start -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-semibold text-black dark:text-white">
                Dashboard
            </h2>

            <nav>
                <ol class="flex items-center gap-2">
                    <li><a href="{{ route('dashboard') }}">Dashboard /</a></li>
                    <li class="text-primary">Halaman Utama</li>
                </ol>
            </nav>
        </div>
        <!-- Breadcrumb End -->

        <!-- Isi konten dasbor dari src/partials/top-card-group.html dan lainnya -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
            <!-- Card Item Start -->
            <div class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                <h4 class="text-title-md font-bold text-black dark:text-white">Total Pengguna</h4>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">1</h4>
                        <span class="text-sm font-medium">Pengguna Terdaftar</span>
                    </div>
                </div>
            </div>
            <!-- Card Item End -->
        </div>

    </x-admin-layout>