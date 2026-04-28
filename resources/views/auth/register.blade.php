<x-guest-layout>
    <div class="auth-card">
        <span class="auth-badge">CREATE ACCOUNT</span>

        <h2 class="auth-title">Create admin account</h2>

        <p class="auth-desc">
            Buat akun baru untuk mulai mengelola website company profile.
        </p>

        @if ($errors->any())
            <div class="alert-auth alert-danger">
                Registrasi belum berhasil. Silakan periksa kembali data yang kamu masukkan.
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap</label>

                <input id="name"
                       type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       autofocus
                       autocomplete="name"
                       placeholder="Nama kamu"
                       class="form-control-auth">

                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>

                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autocomplete="username"
                       placeholder="admin@example.com"
                       class="form-control-auth">

                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>

                <input id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="new-password"
                       placeholder="Minimal 8 karakter"
                       class="form-control-auth">

                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>

                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       placeholder="Ulangi password"
                       class="form-control-auth">

                @error('password_confirmation')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="auth-button">
                Buat Akun
            </button>
        </form>

        <p class="auth-footer">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="auth-link">Login sekarang</a>
        </p>
    </div>
</x-guest-layout>