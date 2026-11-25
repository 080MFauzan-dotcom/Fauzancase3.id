@extends('layouts.student')

@section('title', 'Daftar tugas')

@push('styles')
<style>
    .list-toolbar { display: flex; align-items: flex-end; justify-content: space-between; gap: 14px; margin-bottom: 16px; }
    .filter-panel { margin-bottom: 14px; padding: 15px; }
    .filter-form { display: grid; grid-template-columns: minmax(150px, 1fr) minmax(130px, .7fr) minmax(130px, .7fr) auto auto; align-items: end; gap: 9px; }
    .filter-field label { display: block; margin: 0 0 5px 2px; color: #77788c; font-size: 9px; font-weight: 750; }
    .filter-input { width: 100%; height: 38px; padding: 0 10px; border: 1px solid #e8e8ef; border-radius: 9px; outline: none; color: #46475c; background: #fcfcfe; font-size: 10px; }
    .filter-input:focus { border-color: #9c91f1; box-shadow: 0 0 0 3px #7564e815; }
    .filter-submit, .clear-filter, .add-task-link { height: 38px; display: inline-flex; align-items: center; justify-content: center; padding: 0 13px; border: 0; border-radius: 9px; color: white; background: #6858e8; font-size: 10px; font-weight: 750; cursor: pointer; white-space: nowrap; }
    .filter-submit:hover, .add-task-link:hover { background: #4c3fd2; }
    .clear-filter { border: 1px solid #e8e8ef; color: #77788c; background: white; }
    .clear-filter:hover { background: #f7f6ff; }
    .add-task-link { gap: 7px; }
    .panel { min-width: 0; overflow: hidden; border: 1px solid var(--line); border-radius: 16px; background: white; box-shadow: 0 5px 18px #22204405; }
    .panel-head { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 18px 20px 14px; }
    .panel-title { margin: 0; font-size: 15px; font-weight: 750; }
    .panel-subtitle { margin: 4px 0 0; color: var(--muted); font-size: 10px; }
    .count-chip { padding: 6px 9px; border-radius: 8px; color: #6356dd; background: #f0eeff; font-size: 10px; font-weight: 750; white-space: nowrap; }
    .task-table-wrap { overflow-x: auto; }
    .task-table { width: 100%; border-collapse: collapse; text-align: left; }
    .task-table th { padding: 11px 15px; border-top: 1px solid #f0f0f5; border-bottom: 1px solid #f0f0f5; color: #9494a6; background: #fcfcfe; font-size: 9px; font-weight: 750; letter-spacing: .55px; text-transform: uppercase; white-space: nowrap; }
    .task-table td { padding: 13px 15px; border-bottom: 1px solid #f2f2f6; color: #65667a; font-size: 10px; vertical-align: middle; }
    .task-table tbody tr:last-child td { border-bottom: 0; }
    .task-table tbody tr:hover { background: #fdfdff; }
    .task-name { max-width: 270px; color: #303149; font-size: 11px; font-weight: 750; }
    .task-description { max-width: 280px; overflow: hidden; margin-top: 4px; color: #9b9bab; font-size: 9px; text-overflow: ellipsis; white-space: nowrap; }
    .type-tag { display: inline-flex; padding: 5px 7px; border-radius: 7px; color: #6e61cc; background: #f2f0ff; font-size: 9px; font-weight: 700; white-space: nowrap; }
    .status-tag, .priority-tag { display: inline-flex; padding: 5px 7px; border-radius: 7px; font-size: 9px; font-weight: 700; white-space: nowrap; }
    .status-pending { color: #ae7a27; background: #fff6e8; }
    .status-in_progress { color: #4d73c7; background: #edf3ff; }
    .status-completed { color: #328567; background: #eaf8f1; }
    .priority-high { color: #c4605b; background: #fff0ef; }
    .priority-medium { color: #bd8a38; background: #fff7e8; }
    .priority-low { color: #77788b; background: #f2f2f6; }
    .task-actions { display: flex; align-items: center; gap: 5px; }
    .task-actions form { margin: 0; }
    .action-link, .action-button { padding: 6px 8px; border: 0; border-radius: 7px; color: #6254dc; background: #f0eeff; font-size: 9px; font-weight: 700; cursor: pointer; }
    .action-button { color: #bd6262; background: #fff0ef; }
    .table-empty { padding: 43px 18px; color: #85869a; text-align: center; font-size: 11px; line-height: 1.7; }
    .pagination-nav { display: flex; align-items: center; justify-content: space-between; gap: 10px; padding: 12px 17px; border-top: 1px solid #f0f0f5; color: #85869a; font-size: 10px; }
    .pagination-nav a { color: #6254dc; font-weight: 700; }
    .pagination-nav span { color: #c0c0cb; }
    .flash { margin-bottom: 13px; padding: 11px 14px; border-radius: 10px; color: #287c5b; background: #e9f8f0; font-size: 11px; }
    @media (max-width: 850px) { .filter-form { grid-template-columns: 1fr 1fr; } .filter-submit, .clear-filter { width: 100%; } }
    @media (max-width: 560px) { .list-toolbar { align-items: flex-start; flex-direction: column; } .add-task-link { width: 100%; } .filter-form { grid-template-columns: 1fr; } .task-table { min-width: 760px; } }
</style>
@endpush

@section('content')
<div class="page-heading">
    <div>
        <span class="eyebrow">Kelola pekerjaanmu</span>
        <h1>Daftar tugas</h1>
        <p>Semua tugas dan tenggat kuliahmu, tersusun rapi.</p>
    </div>
    <a class="add-task-link" href="{{ route('tasks.create') }}">＋ Tambah tugas</a>
</div>

@if (session('success'))
    <div class="flash">{{ session('success') }}</div>
@endif

<section class="panel filter-panel">
    <form class="filter-form" method="GET" action="{{ route('tasks.index') }}">
        <div class="filter-field">
            <label for="search">CARI TUGAS</label>
            <input class="filter-input" id="search" name="search" value="{{ request('search') }}" placeholder="Nama tugas...">
        </div>
        <div class="filter-field">
            <label for="course">MATA KULIAH</label>
            <select class="filter-input" id="course" name="course">
                <option value="">Semua mata kuliah</option>
                @foreach ($courses as $course)
                    <option value="{{ $course }}" @selected(request('course') === $course)>{{ $course }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-field">
            <label for="status">STATUS</label>
            <select class="filter-input" id="status" name="status">
                <option value="">Semua status</option>
                <option value="pending" @selected(request('status') === 'pending')>Belum dimulai</option>
                <option value="in_progress" @selected(request('status') === 'in_progress')>Dikerjakan</option>
                <option value="completed" @selected(request('status') === 'completed')>Selesai</option>
            </select>
        </div>
        <button class="filter-submit" type="submit">Terapkan filter</button>
        @if (request()->hasAny(['search', 'status', 'course']))
            <a class="clear-filter" href="{{ route('tasks.index') }}">Reset</a>
        @endif
    </form>
</section>

<section class="panel">
    <div class="panel-head">
        <div>
            <h2 class="panel-title">Semua pekerjaan</h2>
            <p class="panel-subtitle">Diurutkan berdasarkan tenggat terdekat.</p>
        </div>
        <span class="count-chip">{{ $tasks->total() }} tugas</span>
    </div>
    <div class="task-table-wrap">
        <table class="task-table">
            <thead>
                <tr><th>Tugas</th><th>Mata kuliah</th><th>Jenis</th><th>Status</th><th>Prioritas</th><th>Tenggat</th><th>Aksi</th></tr>
            </thead>
            <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>
                        <div class="task-name">{{ $task->title }}</div>
                        @if ($task->description)<div class="task-description">{{ $task->description }}</div>@endif
                    </td>
                    <td>{{ $task->course }}</td>
                    <td><span class="type-tag">{{ ['assignment' => 'Tugas', 'exam' => 'Ujian', 'project' => 'Proyek', 'presentation' => 'Presentasi', 'reading' => 'Bacaan', 'quiz' => 'Kuis', 'lab' => 'Praktikum', 'other' => 'Lainnya'][$task->assignment_type] }}</span></td>
                    <td><span class="status-tag status-{{ $task->status }}">{{ ['pending' => 'Belum dimulai', 'in_progress' => 'Dikerjakan', 'completed' => 'Selesai'][$task->status] }}</span></td>
                    <td><span class="priority-tag priority-{{ $task->priority }}">{{ ['low' => 'Rendah', 'medium' => 'Sedang', 'high' => 'Tinggi'][$task->priority] }}</span></td>
                    <td>{{ $task->due_date?->format('d M Y') ?? '—' }}</td>
                    <td>
                        <div class="task-actions">
                            <a class="action-link" href="{{ route('tasks.edit', $task) }}">Edit</a>
                            <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Pindahkan tugas ini ke sampah?')">
                                @csrf
                                @method('DELETE')
                                <button class="action-button" type="submit">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td class="table-empty" colspan="7">
                    @if (request()->hasAny(['search', 'status', 'course']))
                        Tidak ada tugas yang cocok dengan filter. Coba ubah kata pencarian atau pilih reset.
                    @else
                        Belum ada tugas. Tambahkan tugas pertamamu untuk mulai menyusun semester.
                    @endif
                </td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if ($tasks->hasPages())
        <nav class="pagination-nav" aria-label="Navigasi halaman">
            @if ($tasks->onFirstPage())<span>← Sebelumnya</span>@else<a href="{{ $tasks->previousPageUrl() }}">← Sebelumnya</a>@endif
            <div>Halaman {{ $tasks->currentPage() }} dari {{ $tasks->lastPage() }}</div>
            @if ($tasks->hasMorePages())<a href="{{ $tasks->nextPageUrl() }}">Berikutnya →</a>@else<span>Berikutnya →</span>@endif
        </nav>
    @endif
</section>
@endsection
