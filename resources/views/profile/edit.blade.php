@extends('layouts.student')

@section('title', 'Profil saya')

@push('styles')
<style>
    .profile-hero { position: relative; display: flex; overflow: hidden; align-items: center; gap: 18px; margin-bottom: 17px; padding: 22px 25px; border: 1px solid #e8e5ff; border-radius: 17px; background: linear-gradient(110deg, #f1efff, #fbfaff 65%, #fff8f1); }
    .profile-hero:after { position: absolute; content: ""; width: 170px; height: 170px; right: 50px; top: -90px; border: 1px solid #7968e714; border-radius: 50%; box-shadow: 0 0 0 22px #7968e708, 0 0 0 43px #7968e706; }
    .profile-avatar-large { position: relative; z-index: 1; width: 65px; height: 65px; flex: 0 0 auto; display: grid; place-items: center; border: 4px solid white; border-radius: 22px; color: white; background: linear-gradient(145deg, #a899ff, #6454e5); box-shadow: 0 7px 18px #7666f52b; font-size: 23px; font-weight: 800; }
    .profile-hero-copy { position: relative; z-index: 1; min-width: 0; }
    .profile-hero-copy h2 { overflow: hidden; margin: 5px 0 4px; color: #292840; font-size: 18px; text-overflow: ellipsis; white-space: nowrap; }
    .profile-hero-copy p { margin: 0; color: #77778c; font-size: 11px; line-height: 1.65; }
    .profile-badge { margin-left: auto; padding: 8px 11px; border: 1px solid #e6e2ff; border-radius: 9px; color: #6254dc; background: #ffffffb8; font-size: 9px; font-weight: 750; white-space: nowrap; }
    .profile-grid { display: grid; grid-template-columns: 1fr; align-items: start; gap: 15px; }
    .profile-panel { min-width: 0; overflow: hidden; border: 1px solid var(--line); border-radius: 15px; background: white; box-shadow: 0 5px 18px #22204405; }
    .profile-panel-head { display: flex; align-items: center; gap: 11px; padding: 17px 19px; border-bottom: 1px solid #f0f0f5; }
    .profile-panel-icon { width: 34px; height: 34px; display: grid; place-items: center; border-radius: 11px; color: #6254dc; background: #f0eeff; font-size: 14px; }
    .profile-panel-head h3 { margin: 0; color: #33334a; font-size: 12px; }
    .profile-panel-head p { margin: 3px 0 0; color: #9292a4; font-size: 9px; }
    .profile-form { padding: 18px 19px; }
    .profile-field { margin-bottom: 13px; }
    .profile-label { display: block; margin-bottom: 6px; color: #5e5f74; font-size: 9px; font-weight: 750; letter-spacing: .4px; }
    .profile-input { width: 100%; min-height: 39px; padding: 9px 11px; border: 1px solid #e7e7ef; border-radius: 9px; outline: none; color: #44455a; background: #fcfcfe; font: inherit; font-size: 11px; transition: border-color .16s, box-shadow .16s; }
    textarea.profile-input { min-height: 82px; resize: vertical; line-height: 1.6; }
    .profile-input:focus { border-color: #9c91f1; box-shadow: 0 0 0 3px #7564e815; }
    .profile-help { margin: 6px 1px 0; color: #9999a9; font-size: 9px; line-height: 1.5; }
    .profile-submit { min-height: 39px; display: inline-flex; align-items: center; justify-content: center; gap: 7px; padding: 0 14px; border: 0; border-radius: 9px; color: white; background: #6858e8; font-size: 10px; font-weight: 750; cursor: pointer; transition: background .16s; }
    .profile-submit:hover { background: #4c3fd2; }
    .profile-submit-muted { color: #5f50d7; background: #f0eeff; }
    .profile-submit-muted:hover { background: #e8e4ff; }
    .profile-alert { margin: 14px 19px 0; padding: 10px 12px; border-radius: 9px; font-size: 10px; line-height: 1.55; }
    .profile-alert-success { color: #287c5b; background: #e9f8f0; }
    .profile-alert-error { color: #aa4b4b; background: #fff0ef; }
    .profile-alert ul { margin: 4px 0 0; padding-left: 17px; }
    .security-note { display: flex; gap: 10px; margin: 0 19px 18px; padding: 12px; border: 1px solid #eeecff; border-radius: 10px; color: #77778c; background: #f8f7ff; font-size: 9px; line-height: 1.6; }
    .security-note strong { color: #4e477e; }
    .profile-facts { display: grid; gap: 0; padding: 5px 19px 15px; }
    .profile-fact { display: flex; justify-content: space-between; gap: 12px; padding: 11px 0; border-bottom: 1px solid #f0f0f5; font-size: 9px; }
    .profile-fact:last-child { border-bottom: 0; }
    .profile-fact span:first-child { color: #8c8c9f; }
    .profile-fact span:last-child { color: #46465e; font-weight: 700; text-align: right; }
    @media (max-width: 880px) { .profile-grid { grid-template-columns: 1fr; } }
    @media (max-width: 560px) { .profile-hero { align-items: flex-start; flex-wrap: wrap; padding: 18px; } .profile-avatar-large { width: 55px; height: 55px; border-radius: 18px; } .profile-badge { margin-left: 73px; margin-top: -7px; } .profile-form { padding: 16px; } .profile-alert { margin-right: 16px; margin-left: 16px; } .security-note { margin-right: 16px; margin-left: 16px; } }
</style>
@endpush

@section('content')
<div class="page-heading">
    <div>
        <span class="eyebrow">Akun Belajar</span>
        <h1>Profil saya</h1>
        <p>Lengkapi identitas akademik dan minatmu dalam satu tempat.</p>
    </div>
    <a class="date-chip" href="{{ route('dashboard') }}">← Kembali ke dashboard</a>
</div>

<section class="profile-hero">
    <div class="profile-avatar-large">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
    <div class="profile-hero-copy">
        <span class="eyebrow">Belajar.id member</span>
        <h2>{{ $user->name }}</h2>
        <p>{{ $user->email }}<br>
            {{ $user->nim ?: 'NIM belum diisi' }}
            @if ($user->faculty || $user->major)
                · {{ $user->faculty ?: 'Fakultas belum diisi' }} · {{ $user->major ?: 'Jurusan belum diisi' }}
            @endif
        </p>
    </div>
    <span class="profile-badge">Profil mahasiswa</span>
</section>

<div class="profile-grid">
    <section class="profile-panel">
        <header class="profile-panel-head">
            <span class="profile-panel-icon">◉</span>
            <div>
                <h3>Data diri & akademik</h3>
                <p>Isi informasi mu biar aku hack</p>
            </div>
        </header>

        @if (session('success'))
            <div class="profile-alert profile-alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->has('name') || $errors->has('email') || $errors->has('nim') || $errors->has('faculty') || $errors->has('major') || $errors->has('interests'))
            <div class="profile-alert profile-alert-error">
                Data diri belum tersimpan.
                <ul>
                    @foreach ($errors->get('name') as $error)<li>{{ $error }}</li>@endforeach
                    @foreach ($errors->get('email') as $error)<li>{{ $error }}</li>@endforeach
                    @foreach ($errors->get('nim') as $error)<li>{{ $error }}</li>@endforeach
                    @foreach ($errors->get('faculty') as $error)<li>{{ $error }}</li>@endforeach
                    @foreach ($errors->get('major') as $error)<li>{{ $error }}</li>@endforeach
                    @foreach ($errors->get('interests') as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form class="profile-form" method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')
            <div class="profile-field">
                <label class="profile-label" for="name">NAMA LENGKAP</label>
                <input class="profile-input" id="name" name="name" value="{{ old('name', $user->name) }}" maxlength="255" autocomplete="name" required>
            </div>
            <div class="profile-field">
                <label class="profile-label" for="email">ALAMAT EMAIL</label>
                <input class="profile-input" id="email" type="email" name="email" value="{{ old('email', $user->email) }}" maxlength="255" autocomplete="email" required>
                <p class="profile-help">Email digunakan untuk masuk ke akun RuangKelas.</p>
            </div>
            <div class="profile-field">
                <label class="profile-label" for="nim">NOMOR INDUK MAHASISWA (NIM)</label>
                <input class="profile-input" id="nim" name="nim" value="{{ old('nim', $user->nim) }}" maxlength="30" autocomplete="off" placeholder="Contoh: 241000123">
            </div>
            <div class="profile-field">
                <label class="profile-label" for="faculty">FAKULTAS</label>
                <input class="profile-input" id="faculty" name="faculty" value="{{ old('faculty', $user->faculty) }}" maxlength="150" autocomplete="organization" placeholder="Nama fakultas">
            </div>
            <div class="profile-field">
                <label class="profile-label" for="major">PROGRAM STUDI</label>
                <input class="profile-input" id="major" name="major" value="{{ old('major', $user->major) }}" maxlength="150" placeholder="Nama jurusan atau program studi">
            </div>
            <div class="profile-field">
                <label class="profile-label" for="interests">HOBI ATAU MINAT</label>
                <textarea class="profile-input" id="interests" name="interests" maxlength="1000" rows="3" placeholder="Ceritakan hobi atau bidang yang kamu minati">{{ old('interests', $user->interests) }}</textarea>
                <p class="profile-help">Maksimal 1.000 karakter.</p>
            </div>
            <button class="profile-submit" type="submit">Simpan perubahan <span>→</span></button>
        </form>

        <div class="profile-facts">
            <div class="profile-fact"><span>Status akun</span><span>Aktif</span></div>
            <div class="profile-fact"><span>Bergabung sejak</span><span>{{ $user->created_at->format('d M Y') }}</span></div>
        </div>
    </section>

    <section class="profile-panel">
        <header class="profile-panel-head">
            <span class="profile-panel-icon">⌑</span>
            <div>
                <h3>Keamanan akun</h3>
                <p>Ganti kata sandi secara berkala.</p>
            </div>
        </header>

        @if (session('password_success'))
            <div class="profile-alert profile-alert-success">{{ session('password_success') }}</div>
        @endif
        @if ($errors->has('current_password') || $errors->has('password'))
            <div class="profile-alert profile-alert-error">
                Kata sandi belum diubah.
                <ul>
                    @foreach ($errors->get('current_password') as $error)<li>{{ $error }}</li>@endforeach
                    @foreach ($errors->get('password') as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form class="profile-form" method="POST" action="{{ route('profile.password') }}">
            @csrf
            @method('PUT')
            <div class="profile-field">
                <label class="profile-label" for="current_password">KATA SANDI SAAT INI</label>
                <input class="profile-input" id="current_password" type="password" name="current_password" autocomplete="current-password" required>
            </div>
            <div class="profile-field">
                <label class="profile-label" for="password">KATA SANDI BARU</label>
                <input class="profile-input" id="password" type="password" name="password" autocomplete="new-password" minlength="8" required>
                <p class="profile-help">Gunakan minimal 8 karakter.</p>
            </div>
            <div class="profile-field">
                <label class="profile-label" for="password_confirmation">ULANGI KATA SANDI BARU</label>
                <input class="profile-input" id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" minlength="8" required>
            </div>
            <button class="profile-submit profile-submit-muted" type="submit">Perbarui kata sandi <span>→</span></button>
        </form>

        <div class="security-note">
            <span aria-hidden="true"></span>
            <span><strong>Tips keamanan.</strong> Jangan gunakan kata sandi yang sama dengan akun lain dan jangan membagikannya kepada siapa pun.</span>
        </div>
    </section>
</div>
@endsection
