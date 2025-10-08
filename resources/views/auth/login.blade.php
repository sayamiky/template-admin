<x-blank-layout>
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-4">
                <a href="{{ url('/') }}" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo">
                        {{-- LOGO DIUBAH DI SINI --}}
                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d2/Lambang_Kabupaten_Badung.png"
                            alt="Logo Kabupaten Badung" style="height: 70px;">
                    </span>
                </a>
            </div>
            <!-- /Logo -->

            <!-- Menampilkan pesan error validasi umum -->
            @if ($errors->any())
                <div class="alert alert-danger pb-0">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <!-- Menampilkan status sesi (misal: setelah reset password) -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="Masukkan email Anda" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                <small>Lupa Password?</small>
                            </a>
                        @endif
                    </div>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" required />
                        <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                    </div>
                </div>

                {{-- Remember Me --}}
                <!-- <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
                        <label class="form-check-label" for="remember-me">
                            Ingat Saya
                        </label>
                    </div>
                </div> -->

                <!-- Google reCaptcha -->
                <div class="mb-3">
                    {!! NoCaptcha::display() !!}
                </div>

                {{-- Tombol Submit --}}
                <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Card -->
</x-blank-layout>

