@extends('layouts.student')

@section('title', 'Edit tugas')

@push('styles')
<style>
    .edit-panel { max-width: 760px; padding: 23px; }
    .edit-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .form-actions { display: flex; gap: 9px; margin-top: 5px; }
    .form-actions .submit-button { width: auto; padding: 0 20px; }
    .cancel-button { min-height: 41px; padding: 0 15px; border: 1px solid var(--line); border-radius: 10px; color: #65667a; background: white; font-size: 11px; font-weight: 700; cursor: pointer; }
    .cancel-button:hover { background: #f7f6ff; }
    @media (max-width: 580px) { .edit-form-grid { grid-template-columns: 1fr; gap: 0; } .edit-panel { padding: 17px; } }
</style>
@endpush

@section('content')
<div class="page-heading">
    <div>
        <span class="eyebrow">Ruang belajarmu</span>
        <h1>Edit tugas</h1>
        <p>Perbarui detail dan atur langkah berikutnya.</p>
    </div>
    <a class="date-chip" href="{{ route('tasks.index') }}">← Kembali ke dashboard</a>
</div>

@if ($errors->any())
    <div class="flash flash-error">
        <strong>Ada data yang perlu diperiksa.</strong>
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

<section class="panel edit-panel">
    <div class="quick-heading">
        <div>
            <h2 class="panel-title">{{ $task->title }}</h2>
            <p class="panel-subtitle">Mata kuliah: {{ $task->course }}</p>
        </div>
        <span class="quick-mark" aria-hidden="true">✎</span>
    </div>

    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @csrf
        @method('PUT')
        <div class="form-field">
            <label class="form-label" for="title">Nama tugas</label>
            <input class="form-control" id="title" name="title" value="{{ old('title', $task->title) }}" maxlength="255" required>
        </div>
        <div class="edit-form-grid">
            <div class="form-field">
                <label class="form-label" for="course">Mata kuliah</label>
                <input class="form-control" id="course" name="course" value="{{ old('course', $task->course) }}" maxlength="150" required>
            </div>
            <div class="form-field">
                <label class="form-label" for="assignment_type">Jenis tugas</label>
                <select class="form-control" id="assignment_type" name="assignment_type" required>
                    <option value="assignment" @selected(old('assignment_type', $task->assignment_type) === 'assignment')>Tugas</option>
                    <option value="exam" @selected(old('assignment_type', $task->assignment_type) === 'exam')>Ujian</option>
                    <option value="project" @selected(old('assignment_type', $task->assignment_type) === 'project')>Proyek</option>
                    <option value="presentation" @selected(old('assignment_type', $task->assignment_type) === 'presentation')>Presentasi</option>
                    <option value="reading" @selected(old('assignment_type', $task->assignment_type) === 'reading')>Bacaan</option>
                    <option value="quiz" @selected(old('assignment_type', $task->assignment_type) === 'quiz')>Kuis</option>
                    <option value="lab" @selected(old('assignment_type', $task->assignment_type) === 'lab')>Praktikum</option>
                    <option value="other" @selected(old('assignment_type', $task->assignment_type) === 'other')>Lainnya</option>
                </select>
            </div>
        </div>
        <div class="form-field">
            <label class="form-label" for="description">Catatan</label>
            <textarea class="form-control" id="description" name="description" maxlength="5000">{{ old('description', $task->description) }}</textarea>
        </div>
        <div class="edit-form-grid">
            <div class="form-field">
                <label class="form-label" for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pending" @selected(old('status', $task->status) === 'pending')>Belum dimulai</option>
                    <option value="in_progress" @selected(old('status', $task->status) === 'in_progress')>Sedang dikerjakan</option>
                    <option value="completed" @selected(old('status', $task->status) === 'completed')>Selesai</option>
                </select>
            </div>
            <div class="form-field">
                <label class="form-label" for="priority">Prioritas</label>
                <select class="form-control" id="priority" name="priority" required>
                    <option value="low" @selected(old('priority', $task->priority) === 'low')>Rendah</option>
                    <option value="medium" @selected(old('priority', $task->priority) === 'medium')>Sedang</option>
                    <option value="high" @selected(old('priority', $task->priority) === 'high')>Tinggi</option>
                </select>
            </div>
        </div>
        <div class="form-field">
            <label class="form-label" for="due_date">Tenggat waktu</label>
            <input class="form-control" id="due_date" type="date" name="due_date" value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}">
        </div>
        <div class="form-actions">
            <button class="submit-button" type="submit">Simpan perubahan</button>
            <a class="cancel-button" href="{{ route('tasks.index') }}" style="display: grid; place-items: center; text-decoration: none">Batal</a>
        </div>
    </form>
</section>
@endsection
