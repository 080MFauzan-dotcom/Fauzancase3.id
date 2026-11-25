@extends('layouts.student')

@section('title', 'Sampah tugas')

@push('styles')
<style>
    .trash-row { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 16px 21px; border-top: 1px solid #f0f0f5; }
    .trash-name { color: var(--ink); font-size: 12px; font-weight: 750; }
    .trash-meta { margin-top: 5px; color: var(--muted); font-size: 10px; }
    .trash-actions { display: flex; align-items: center; gap: 7px; }
    .trash-actions form { margin: 0; }
    .trash-button { min-height: 34px; padding: 0 11px; border: 0; border-radius: 8px; color: #4c856e; background: #eaf8f1; font-size: 10px; font-weight: 700; cursor: pointer; }
    .trash-button:hover { background: #dff3e9; }
    .trash-button-danger { color: #b75858; background: #fff0ef; }
    .trash-button-danger:hover { background: #ffe4e2; }
    @media (max-width: 580px) { .trash-row { align-items: flex-start; flex-direction: column; padding: 15px; } }
</style>
@endpush

@section('content')
<div class="page-heading">
    <div>
        <span class="eyebrow">Arsip sementara</span>
        <h1>Tempat sampah</h1>
        <p>Pulihkan tugas yang masih dibutuhkan atau hapus secara permanen.</p>
    </div>
    <span class="date-chip">{{ $tasks->total() }} tugas tersimpan</span>
</div>

@if (session('success'))
    <div class="flash flash-success">{{ session('success') }}</div>
@endif

<section class="panel">
    <div class="panel-head">
        <div>
            <h2 class="panel-title">Tugas yang dihapus</h2>
            <p class="panel-subtitle">Tugas di sini tidak akan muncul di dashboard aktif.</p>
        </div>
        <span class="quick-mark" aria-hidden="true">⌑</span>
    </div>

    @forelse ($tasks as $task)
        <article class="trash-row">
            <div>
                <div class="trash-name">{{ $task->title }}</div>
                <div class="trash-meta">{{ $task->course ?? 'Mata kuliah belum diatur' }} · Dihapus {{ $task->deleted_at->format('d M Y, H:i') }}</div>
            </div>
            <div class="trash-actions">
                <form method="POST" action="{{ route('tasks.restore', $task->id) }}">
                    @csrf
                    <button class="trash-button" type="submit">Pulihkan</button>
                </form>
                <form method="POST" action="{{ route('tasks.force-delete', $task->id) }}" onsubmit="return confirm('Hapus tugas ini secara permanen? Tindakan ini tidak dapat dibatalkan.')">
                    @csrf
                    @method('DELETE')
                    <button class="trash-button trash-button-danger" type="submit">Hapus permanen</button>
                </form>
            </div>
        </article>
    @empty
        <div class="task-empty" style="padding: 48px 20px">
            <div style="font-size: 27px; margin-bottom: 9px"></div>
            Tempat sampahmu kosong. Semua tugas aman JOSS!
        </div>
    @endforelse

    @if ($tasks->hasPages())
        <nav class="pagination-nav" aria-label="Navigasi halaman">
            @if ($tasks->onFirstPage())
                <span class="page-disabled">← Sebelumnya</span>
            @else
                <a href="{{ $tasks->previousPageUrl() }}">← Sebelumnya</a>
            @endif
            <span>Halaman {{ $tasks->currentPage() }} dari {{ $tasks->lastPage() }}</span>
            @if ($tasks->hasMorePages())
                <a href="{{ $tasks->nextPageUrl() }}">Berikutnya →</a>
            @else
                <span class="page-disabled">Berikutnya →</span>
            @endif
        </nav>
    @endif
</section>
@endsection
