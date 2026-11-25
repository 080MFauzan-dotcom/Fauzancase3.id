@extends('layouts.student')

@section('title', 'Tambah tugas')

@push('styles')
<style>
    .create-layout { display: grid; grid-template-columns: minmax(0, 1fr) 260px; align-items: start; gap: 15px; }
    .form-panel { padding: 21px; }
    .form-panel-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; margin-bottom: 17px; }
    .form-panel-head h2 { margin: 5px 0 4px; font-size: 15px; }
    .form-panel-head p { margin: 0; color: var(--muted); font-size: 10px; }
    .form-field { margin-bottom: 13px; }
    .form-label { display: block; margin-bottom: 6px; color: #595a70; font-size: 10px; font-weight: 750; }
    .form-control { width: 100%; min-height: 39px; padding: 9px 11px; border: 1px solid #e8e8ef; border-radius: 9px; outline: none; color: #44455a; background: #fcfcfe; font-size: 11px; }
    .form-control:focus { border-color: #9c91f1; box-shadow: 0 0 0 3px #7564e815; }
    textarea.form-control { min-height: 90px; resize: vertical; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .form-actions { display: flex; align-items: center; gap: 9px; margin-top: 5px; }
    .submit-button, .cancel-button { min-height: 40px; display: inline-flex; align-items: center; justify-content: center; padding: 0 15px; border: 0; border-radius: 9px; color: white; background: #6858e8; font-size: 10px; font-weight: 750; cursor: pointer; }
    .submit-button:hover { background: #4c3fd2; }
    .cancel-button { border: 1px solid #e8e8ef; color: #737489; background: white; }
    .tip-panel { padding: 18px; }
    .tip-panel h3 { margin: 5px 0 8px; font-size: 13px; }
    .tip-panel p { margin: 0; color: #85869a; font-size: 10px; line-height: 1.7; }
    .tip-item { display: flex; gap: 9px; margin-top: 14px; color: #77788c; font-size: 10px; line-height: 1.55; }
    .tip-check { width: 19px; height: 19px; flex: 0 0 auto; display: grid; place-items: center; border-radius: 6px; color: #6254dc; background: #f0eeff; font-size: 10px; font-weight: 800; }
    .error-panel { margin-bottom: 13px; padding: 11px 14px; border-radius: 10px; color: #aa4b4b; background: #fff0ef; font-size: 10px; }
    .error-panel ul { margin: 6px 0 0; padding-left: 17px; }
    @media (max-width: 860px) { .create-layout { grid-template-columns: 1fr; } .tip-panel { display: none; } }
    @media (max-width: 560px) { .form-panel { padding: 16px; } .form-grid { grid-template-columns: 1fr; gap: 0; } .form-actions { align-items: stretch; flex-direction: column; } }
</style>
@endpush

@section('content')
<div class="page-heading">
    <div>
        <span class="eyebrow">Rencana semester</span>
        <h1>Tambah tugas</h1>
        <p>Catat detail pekerjaan agar tidak ada tenggat yang terlewat.</p>
    </div>
    <a class="date-chip" href="{{ route('tasks.index') }}">← Daftar tugas</a>
</div>

@if ($errors->any())
    <div class="error-panel">
        <strong>Periksa data berikut:</strong>
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

<div class="create-layout">
    <section class="panel form-panel">
        <div class="form-panel-head">
            <div>
                <span class="eyebrow">Catat pekerjaan</span>
                <h2>Informasi tugas</h2>
                <p>Bisa diperbarui kapan saja.</p>
            </div>
            <span class="quick-mark" aria-hidden="true">＋</span>
        </div>

        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div class="form-field">
                <label class="form-label" for="title">NAMA TUGAS</label>
                <input class="form-control" id="title" name="title" value="{{ old('title') }}" maxlength="255" required autofocus placeholder="Contoh: Laporan praktikum rangkaian listrik">
            </div>
            <div class="form-grid">
                <div class="form-field">
                    <label class="form-label" for="course">MATA KULIAH</label>
                    <input class="form-control" id="course" name="course" value="{{ old('course') }}" maxlength="150" required placeholder="Contoh: Fisika Teknik">
                </div>
                <div class="form-field">
                    <label class="form-label" for="assignment_type">JENIS PEKERJAAN</label>
                    <select class="form-control" id="assignment_type" name="assignment_type" required>
                        <option value="assignment" @selected(old('assignment_type', 'assignment') === 'assignment')>Tugas</option>
                        <option value="exam" @selected(old('assignment_type') === 'exam')>Ujian</option>
                        <option value="project" @selected(old('assignment_type') === 'project')>Proyek</option>
                        <option value="presentation" @selected(old('assignment_type') === 'presentation')>Presentasi</option>
                        <option value="reading" @selected(old('assignment_type') === 'reading')>Bacaan</option>
                        <option value="quiz" @selected(old('assignment_type') === 'quiz')>Kuis</option>
                        <option value="lab" @selected(old('assignment_type') === 'lab')>Praktikum</option>
                        <option value="other" @selected(old('assignment_type') === 'other')>Lainnya</option>
                    </select>
                </div>
            </div>
            <div class="form-field">
                <label class="form-label" for="description">CATATAN / INSTRUKSI</label>
                <textarea class="form-control" id="description" name="description" maxlength="5000" placeholder="Tuliskan detail, instruksi, atau bahan yang perlu disiapkan (opsional)">{{ old('description') }}</textarea>
            </div>
            <div class="form-grid">
                <div class="form-field">
                    <label class="form-label" for="due_date">TENGGAT PENGUMPULAN</label>
                    <input class="form-control" id="due_date" type="date" name="due_date" value="{{ old('due_date') }}">
                </div>
                <div class="form-field">
                    <label class="form-label" for="priority">TINGKAT PRIORITAS</label>
                    <select class="form-control" id="priority" name="priority" required>
                        <option value="low" @selected(old('priority') === 'low')>Rendah</option>
                        <option value="medium" @selected(old('priority', 'medium') === 'medium')>Sedang</option>
                        <option value="high" @selected(old('priority') === 'high')>Tinggi</option>
                    </select>
                </div>
            </div>
            <div class="form-field">
                <label class="form-label" for="status">STATUS AWAL</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pending" @selected(old('status', 'pending') === 'pending')>Belum dimulai</option>
                    <option value="in_progress" @selected(old('status') === 'in_progress')>Sedang dikerjakan</option>
                    <option value="completed" @selected(old('status') === 'completed')>Selesai</option>
                </select>
            </div>
            <div class="form-actions">
                <button class="submit-button" type="submit">Simpan tugas</button>
                <a class="cancel-button" href="{{ route('tasks.index') }}">Batal</a>
            </div>
        </form>
    </section>

    <aside class="panel tip-panel">
        <span class="eyebrow">Tips produktif dari gua</span>
        <h3>Rencanakan dengan ringan.</h3>
        <div class="tip-item"><span class="tip-check">1</span><span>Gunakan nama tugas yang jelas supaya mudah dicari.</span></div>
        <div class="tip-item"><span class="tip-check">2</span><span>Tambahkan tanggal tenggat untuk melihatnya di dashboard.</span></div>
        <div class="tip-item"><span class="tip-check">3</span><span>Pilih prioritas yang realistis, lalu kerjakan satu per satu.</span></div>
         <div class="tip-item"><span class="tip-check">4</span><span>Hidup yang tidak dipertaruhkan, tidak akan pernah dimenangkan</span>
</div>
@endsection
