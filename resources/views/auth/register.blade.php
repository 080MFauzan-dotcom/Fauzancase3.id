@extends('auth.layout')

@section('title', 'Daftar')

@section('content')
<main class="auth-card">
    <h1>Buat akun mahasiswa</h1>
    <p class="subtitle">Simpan tugas setiap mata kuliah dalam satu tempat.</p>

    @if ($errors->any())
        <div class="alert">
            @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <label for="name">Nama</label>
        <input id="name" name="name" value="{{ old('name') }}" autocomplete="name" maxlength="255" required autofocus>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
        <label for="password">Kata sandi (minimal 8 karakter)</label>
        <input id="password" type="password" name="password" autocomplete="new-password" required>
        <label for="password_confirmation">Ulangi kata sandi</label>
        <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" required>
        <button class="primary" type="submit">Buat akun</button>
    </form>

    <p class="foot">Sudah punya akun? <a class="link" href="{{ route('login') }}">Masuk</a></p>
</main>
@endsection
