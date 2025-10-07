    <!-- Kode HTML untuk Header dari template TailAdmin akan saya letakkan di sini -->
    <!-- Saya akan mengambil dari src/partials/header.html -->
    <header class="sticky top-0 z-999 flex w-full bg-white drop-shadow-1 dark:bg-boxdark dark:drop-shadow-none">
        <div class="flex flex-grow items-center justify-between py-4 px-4 shadow-2 md:px-6 2xl:px-11">
            <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
                <!-- Hamburger Toggle BTN -->
                <button
                    @click.stop="sidebarToggle = !sidebarToggle"
                    class="z-99999 block rounded-sm border border-stroke bg-white p-1.5 shadow-sm dark:border-strokedark dark:bg-boxdark lg:hidden">
                    <span class="relative block h-5.5 w-5.5 cursor-pointer">
                        <span class="du-block absolute right-0 h-full w-full">
                            <span
                                class="relative top-0 left-0 my-1 block h-0.5 w-full rounded-sm bg-black delay-[0] duration-200 ease-in-out dark:bg-white"
                                :class="{ 'rotate-45': sidebarToggle }"></span>
                            <span
                                class="relative top-0 left-0 my-1 block h-0.5 w-full rounded-sm bg-black delay-150 duration-200 ease-in-out dark:bg-white"
                                :class="{ 'opacity-0': sidebarToggle }"></span>
                            <span
                                class="relative top-0 left-0 my-1 block h-0.5 w-full rounded-sm bg-black delay-200 duration-200 ease-in-out dark:bg-white"
                                :class="{ '-rotate-45': sidebarToggle }"></span>
                        </span>
                    </span>
                </button>
                <!-- Hamburger Toggle BTN -->
            </div>

            <div class="hidden sm:block">
                <!-- Konten header kiri (jika ada) -->
            </div>

            <div class="flex items-center gap-3 2xsm:gap-7">
                <ul class="flex items-center gap-2 2xsm:gap-4">
                    <!-- Dark Mode Toggler -->
                    <li>
                        <label
                            class="relative m-0 block h-7.5 w-14 rounded-full"
                            :class="darkMode ? 'bg-primary' : 'bg-stroke'">
                            <input type="checkbox" :value="darkMode" @change="darkMode = !darkMode" class="absolute top-0 z-50 m-0 h-full w-full cursor-pointer opacity-0" />
                            <span
                                class="absolute top-1/2 left-1 flex h-6 w-6 -translate-y-1/2 translate-x-0 items-center justify-center rounded-full bg-white shadow-switcher duration-75 ease-linear"
                                :class="{ 'translate-x-full': darkMode }"></span>
                        </label>
                    </li>
                </ul>

                <!-- User Area -->
                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    <a @click.prevent="open = !open" class="flex items-center gap-4" href="#">
                        <span class="hidden text-right lg:block">
                            <span class="block text-sm font-medium text-black dark:text-white">{{ Auth::user()->name }}</span>
                            <span class="block text-xs">Admin</span>
                        </span>
                        <span class="h-12 w-12 rounded-full">
                            <img src="{{ asset('images/user/user-01.jpg') }}" alt="User" />
                        </span>
                    </a>

                    <!-- Dropdown Start -->
                    <div x-show="open" class="absolute right-0 mt-4 flex w-62.5 flex-col rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                        <ul class="flex flex-col gap-5 border-b border-stroke px-6 py-7.5 dark:border-strokedark">
                            <li>
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base">
                                    Profile
                                </a>
                            </li>
                        </ul>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="flex items-center gap-3.5 py-4 px-6 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base">
                                Log Out
                            </button>
                        </form>
                    </div>
                    <!-- Dropdown End -->
                </div>
                <!-- User Area -->
            </div>
        </div>
    </header>