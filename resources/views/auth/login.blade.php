<x-guest-layout>
    <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="flex flex-wrap items-center">
            <div class="hidden w-full xl:block xl:w-1/2">
                <div class="py-17.5 px-26 text-center">
                    <a class="mb-5.5 inline-block" href="/">
                        <img class="hidden dark:block" src="{{ asset('images/logo/logo.svg') }}" alt="Logo" />
                        <img class="dark:hidden" src="{{ asset('images/logo/logo-dark.svg') }}" alt="Logo" />
                    </a>

                    <p class="2xl:px-20">Sistem Informasi Manajemen Instansi Pemerintah</p>

                    <span class="mt-15 inline-block">
                        <img src="{{ asset('images/illustration/illustration-03.svg') }}" alt="illustration" />
                    </span>
                </div>
            </div>

            <div class="w-full border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2">
                <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
                    <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                        Sign In SIM Pemerintah
                    </h2>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="mb-2.5 block font-medium text-black dark:text-white">Email</label>
                            <div class="relative">
                                <input name="email" type="email" placeholder="Enter your email" :value="old('email')" required autofocus
                                    class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="mb-2.5 block font-medium text-black dark:text-white">Password</label>
                            <div class="relative">
                                <input name="password" type="password" placeholder="Enter your password" required
                                    class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>

                        <!-- reCAPTCHA -->
                        <div class="mb-5">
                            {!! NoCaptcha::display() !!}
                            @if ($errors->has('g-recaptcha-response'))
                            <span class="text-sm text-red-600 dark:text-red-400">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="mb-5">
                            <input type="submit" value="Sign In"
                                class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 text-white transition hover:bg-opacity-90" />
                        </div>

                        @if (Route::has('password.request'))
                        <div class="mt-6 text-center">
                            <p>
                                <a href="{{ route('password.request') }}" class="text-primary">Forgot password?</a>
                            </p>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>