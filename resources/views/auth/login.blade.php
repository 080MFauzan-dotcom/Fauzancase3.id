@extends('auth.layout')

@section('title', 'Masuk')

@section('content')
<main class="auth-card">
    <button class="auth-theme-toggle" type="button" aria-label="Aktifkan mode gelap" title="Ganti tema">
        <span aria-hidden="true">☾</span>
    </button>
    <h1>Selamat datang</h1>
    <p class="subtitle">Masuk untuk mengelola tugas kuliahmu.</p>

    @if ($errors->any())
        <div class="alert">
            @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <label for="email">Email</label>
        <div class="input-icon-wrap">
            <svg class="input-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <rect x="3.5" y="5" width="17" height="14" rx="3" stroke="currentColor" stroke-width="1.8"/>
                <path d="m5 7 7 5.5L19 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
        </div>
        <label for="password">Kata sandi</label>
        <div class="input-icon-wrap password-wrap">
            <svg class="input-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <rect x="4.5" y="10" width="15" height="11" rx="2.5" stroke="currentColor" stroke-width="1.8"/>
                <path d="M8 10V7a4 4 0 0 1 8 0v3m-4 5v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
            <input id="password" type="password" name="password" autocomplete="current-password" required>
            <button class="password-toggle" type="button" aria-label="Tampilkan kata sandi" aria-controls="password">
                <svg class="eye-open" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M2.5 12s3.3-6 9.5-6 9.5 6 9.5 6-3.3 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                    <circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.8"/>
                </svg>
                <svg class="eye-closed" viewBox="0 0 24 24" fill="none" aria-hidden="true" hidden>
                    <path d="m3 3 18 18M10.6 6.2A9.8 9.8 0 0 1 12 6c6.2 0 9.5 6 9.5 6a15 15 0 0 1-3.1 3.8M6.2 6.3C3.8 8 2.5 12 2.5 12s3.3 6 9.5 6c1.2 0 2.3-.2 3.2-.6M9.9 9.9a3 3 0 0 0 4.2 4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        <label class="remember"><input type="checkbox" name="remember" value="1"> Ingat saya</label>
        <button class="primary" type="submit">Masuk</button>
    </form>

    <p class="foot">Belum punya akun? <a class="link" href="{{ route('register') }}">Daftar</a></p>
</main>
@endsection
