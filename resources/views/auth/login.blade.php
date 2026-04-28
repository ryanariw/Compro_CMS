<x-guest-layout>
    <div class="auth-card">
        <span class="auth-badge">ADMIN ACCESS</span>

        <h2 class="auth-title">Welcome back</h2>

        <p class="auth-desc">
            Masuk ke dashboard untuk mengelola konten company profile kamu.
        </p>

        @if (session('status'))
            <div class="alert-auth alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-auth alert-danger">
                Email atau password belum sesuai. Silakan cek kembali data login kamu.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>

                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       autocomplete="username"
                       placeholder="admin@example.com"
                       class="form-control-auth">

                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-row">
                    <label for="password" class="form-label">Password</label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="auth-link">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <input id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="current-password"
                       placeholder="Masukkan password"
                       class="form-control-auth">

                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="check-row">
                    <input type="checkbox" name="remember">
                    <span>Ingat saya di perangkat ini</span>
                </label>
            </div>

            <button type="submit" class="auth-button">
                Masuk Dashboard
            </button>
        </form>

        @if (Route::has('register'))
            <p class="auth-footer">
                Belum punya akun?
                <a href="{{ route('register') }}" class="auth-link">Daftar sekarang</a>
            </p>
        @endif
    </div>
</x-guest-layout>