    <!-- Kode HTML untuk Sidebar dari template TailAdmin akan saya letakkan di sini -->
    <!-- Saya akan mengambil dari src/partials/sidebar.html -->
    <aside
        @click.outside="sidebarToggle = false"
        :class="{ 'translate-x-0': sidebarToggle }"
        class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0 -translate-x-full">
        <!-- SIDEBAR HEADER -->
        <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo/logo.svg') }}" alt="Logo" />
            </a>

            <button @click.stop="sidebarToggle = !sidebarToggle" class="block lg:hidden">
                <!-- Tombol close sidebar -->
            </button>
        </div>
        <!-- SIDEBAR HEADER -->

        <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
            <!-- Sidebar Menu -->
            <nav class="mt-5 py-4 px-4 lg:mt-9 lg:px-6">
                <!-- Menu Group -->
                <div>
                    <h3 class="mb-4 ml-4 text-sm font-semibold text-bodydark2">MENU</h3>
                    <ul class="mb-6 flex flex-col gap-1.5">
                        <!-- Menu Item Dashboard -->
                        <li>
                            <a
                                href="{{ route('dashboard') }}"
                                class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                :class="page === 'dashboard' && 'bg-graydark dark:bg-meta-4'">
                                Dashboard
                            </a>
                        </li>
                        <!-- Menu Item Lainnya akan ditambahkan di sini -->

                    </ul>
                </div>
            </nav>
            <!-- Sidebar Menu -->
        </div>
    </aside>