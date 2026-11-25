@extends('layouts.student')

@section('title', 'Dashboard')

@push('styles')
<style>
    .dashboard-heading { display: flex; align-items: flex-end; justify-content: space-between; gap: 16px; margin-bottom: 20px; }
    .dashboard-heading h1 { margin: 6px 0 4px; font-size: clamp(26px, 3vw, 34px); letter-spacing: -1.2px; }
    .dashboard-heading p { margin: 0; color: var(--muted); font-size: 13px; }
    .welcome-banner { position: relative; display: flex; min-height: 184px; overflow: hidden; align-items: center; justify-content: space-between; gap: 22px; padding: 27px 30px; border: 1px solid #ffffff25; border-radius: 20px; color: white; background: linear-gradient(112deg, #4237ac 0%, #6555df 62%, #8778ed 100%); box-shadow: 0 14px 34px #6256dc20; }
    .welcome-banner:before { position: absolute; content: ""; width: 250px; height: 250px; right: 180px; top: -125px; border: 1px solid #ffffff25; border-radius: 50%; box-shadow: 0 0 0 28px #ffffff08, 0 0 0 56px #ffffff06; }
    .welcome-copy { position: relative; z-index: 1; max-width: 470px; }
    .welcome-copy .eyebrow { color: #eeebff; font-size: 10px; font-weight: 800; }
    .welcome-copy h2 { margin: 10px 0 8px; font-size: clamp(24px, 3vw, 31px); letter-spacing: -.8px; }
    .welcome-copy p { margin: 0; color: #f3f1ff; font-size: 12px; font-weight: 500; line-height: 1.65; }
    .focus-card { position: relative; z-index: 1; width: min(100%, 270px); flex: 0 0 auto; padding: 15px; border: 1px solid #ffffff50; border-radius: 15px; background: #ffffff19; box-shadow: 0 12px 25px #29207120; backdrop-filter: blur(8px); }
    .focus-card-head { display: flex; align-items: center; gap: 7px; color: #eeebff; font-size: 9px; font-weight: 800; letter-spacing: .8px; text-transform: uppercase; }
    .focus-pulse { width: 7px; height: 7px; border-radius: 50%; background: #b7ffdb; box-shadow: 0 0 0 4px #b7ffdb20; }
    .focus-title { overflow: hidden; margin: 12px 0 4px; color: white; font-size: 14px; font-weight: 750; text-overflow: ellipsis; white-space: nowrap; }
    .focus-course { overflow: hidden; color: #e6e2ff; font-size: 10px; font-weight: 550; text-overflow: ellipsis; white-space: nowrap; }
    .focus-bottom { display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-top: 13px; padding-top: 11px; border-top: 1px solid #ffffff2c; }
    .focus-caption { color: #e6e2ff; font-size: 9px; }
    .focus-due { padding: 5px 8px; border-radius: 7px; color: #473411; background: #ffe2a8; font-size: 9px; font-weight: 800; white-space: nowrap; }
    .focus-empty { position: relative; z-index: 1; width: min(100%, 250px); padding: 17px; border: 1px solid #ffffff40; border-radius: 15px; color: #f0edff; background: #ffffff15; font-size: 11px; line-height: 1.6; }
    .focus-empty a { display: inline-flex; margin-top: 9px; color: white; font-weight: 750; }
    .stats-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); grid-template-rows: repeat(2, minmax(142px, auto)); gap: 12px; margin: 15px 0 19px; }
    .stat-card { min-width: 0; padding: 17px; border: 1px solid var(--line); border-radius: 15px; color: var(--ink); background: var(--paper); box-shadow: 0 5px 16px #22204405; transition: transform .18s, border-color .18s, box-shadow .18s; }
    .stat-card:hover { transform: translateY(-2px); border-color: #d3cff3; box-shadow: 0 10px 25px #2220440b; }
    .stat-total { grid-column: span 2; grid-row: span 2; display: flex; flex-direction: column; justify-content: space-between; }
    .stat-pending { grid-column: 3; grid-row: 1; }
    .stat-progressing { grid-column: 4; grid-row: 1; }
    .stat-completed { grid-column: 3 / span 2; grid-row: 2; display: flex; align-items: center; justify-content: space-between; gap: 12px; }
    .stat-top { display: flex; align-items: center; justify-content: space-between; gap: 8px; }
    .stat-label { color: var(--muted); font-size: 11px; font-weight: 700; }
    .stat-icon { width: 30px; height: 30px; display: grid; place-items: center; border-radius: 10px; font-size: 14px; }
    .stat-violet { color: #6254dc; background: #f0eeff; }
    .stat-blue { color: #3478b7; background: #eaf5ff; }
    .stat-green { color: #287b60; background: #e8f7f1; }
    .stat-orange { color: #ac6727; background: #fff3e8; }
    .stat-number { margin-top: 11px; color: var(--ink); font-size: 29px; font-weight: 800; letter-spacing: -1.2px; }
    .stat-small .stat-number { margin-top: 17px; font-size: 25px; }
    .stat-foot { margin-top: 4px; color: var(--muted); font-size: 10px; font-weight: 550; }
    .weekly-chart { margin-top: 17px; padding-top: 13px; border-top: 1px solid var(--line); }
    .weekly-chart-head { display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 8px; }
    .weekly-chart-title { color: var(--ink); font-size: 10px; font-weight: 750; }
    .weekly-chart-caption { color: var(--muted); font-size: 9px; }
    .weekly-bars { height: 72px; display: grid; grid-template-columns: repeat(7, 1fr); align-items: end; gap: 8px; }
    .weekly-bar-item { height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: flex-end; gap: 5px; }
    .weekly-bar { width: min(100%, 17px); height: var(--bar-height); min-height: 5px; border-radius: 5px 5px 2px 2px; background: #ddd9fb; transition: height .25s, background .18s; }
    .weekly-bar.today { background: #6a5be4; }
    .weekly-bar-label { color: var(--muted); font-size: 8px; font-weight: 650; }
    .complete-copy { min-width: 0; }
    .complete-ring { width: 76px; height: 76px; flex: 0 0 auto; }
    .complete-ring circle { fill: none; stroke-width: 7; }
    .complete-ring .ring-track { stroke: #eceaf8; }
    .complete-ring .ring-value { stroke: #5b4ed4; stroke-linecap: round; transform: rotate(-90deg); transform-origin: 50% 50%; transition: stroke-dashoffset .4s; }
    .complete-ring text { fill: var(--ink); font-size: 14px; font-weight: 800; text-anchor: middle; dominant-baseline: central; }
    .dashboard-columns { display: grid; grid-template-columns: minmax(0, 1.45fr) minmax(250px, .75fr); align-items: start; gap: 14px; }
    .panel { min-width: 0; overflow: hidden; border: 1px solid var(--line); border-radius: 15px; background: var(--paper); box-shadow: 0 5px 18px #22204405; }
    .panel-head { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 17px 18px 13px; }
    .panel-title { margin: 0; color: var(--ink); font-size: 14px; font-weight: 750; letter-spacing: -.2px; }
    .panel-subtitle { margin: 4px 0 0; color: var(--muted); font-size: 10px; }
    .count-chip { padding: 6px 9px; border-radius: 8px; color: #584bc8; background: #f0eeff; font-size: 9px; font-weight: 750; white-space: nowrap; }
    .upcoming-row { display: grid; grid-template-columns: 35px minmax(0, 1fr) auto; align-items: center; gap: 10px; padding: 12px 18px; border-top: 1px solid var(--line); transition: background .16s; }
    .upcoming-row:hover { background: #f8f7ff; }
    .calendar-mark { width: 34px; height: 36px; display: grid; place-items: center; border-radius: 10px; color: #5447c5; background: #f0eeff; font-size: 11px; font-weight: 800; }
    .upcoming-title { overflow: hidden; color: var(--ink); font-size: 11px; font-weight: 750; text-overflow: ellipsis; white-space: nowrap; }
    .upcoming-meta { display: flex; flex-wrap: wrap; align-items: center; gap: 7px; margin-top: 5px; }
    .course-tag { max-width: 170px; overflow: hidden; padding: 3px 7px; border-radius: 6px; font-size: 9px; font-weight: 750; text-overflow: ellipsis; white-space: nowrap; }
    .course-color-0 { color: #5143bd; background: #eeebff; }
    .course-color-1 { color: #23755b; background: #e8f7f0; }
    .course-color-2 { color: #9a5d19; background: #fff2df; }
    .course-color-3 { color: #3472a8; background: #eaf4ff; }
    .course-color-4 { color: #a34a58; background: #fff0f2; }
    .status-text { color: var(--muted); font-size: 9px; font-weight: 600; }
    .upcoming-date { color: var(--muted); font-size: 9px; font-weight: 600; white-space: nowrap; }
    .due-badge { display: inline-flex; margin-top: 5px; padding: 4px 7px; border-radius: 6px; color: #3d765f; background: #eaf8f1; font-size: 9px; font-weight: 800; white-space: nowrap; }
    .due-badge.soon { color: #8d5c11; background: #fff4dc; }
    .due-badge.today, .due-badge.overdue { color: #a34545; background: #fff0ef; }
    .empty-state { padding: 28px 18px; color: var(--muted); text-align: center; font-size: 11px; line-height: 1.7; }
    .quick-links { display: grid; gap: 8px; padding: 3px 15px 15px; }
    .quick-link { display: flex; align-items: center; gap: 10px; padding: 10px; border: 1px solid var(--line); border-radius: 10px; transition: transform .16s, background .16s, border-color .16s; }
    .quick-link:hover { transform: translateX(2px); border-color: #d4cff7; background: #fbfaff; }
    .quick-link-icon { width: 32px; height: 32px; display: grid; place-items: center; border-radius: 9px; color: #5548c7; background: #f0eeff; }
    .quick-link-text { color: var(--ink); font-size: 10px; font-weight: 750; }
    .quick-link-sub { margin-top: 3px; color: var(--muted); font-size: 9px; }
    .quick-arrow { margin-left: auto; color: #6459a3; font-size: 15px; }
    .flash { margin-bottom: 13px; padding: 11px 14px; border: 1px solid #ccebdc; border-radius: 10px; color: #287c5b; background: #e9f8f0; font-size: 11px; }
    .dashboard-heading p { color: var(--ink); font-size: 14px; font-weight: 600; }
    .welcome-copy p { color: #fff; font-size: 13px; font-weight: 650; }
    .focus-card-head, .focus-caption { color: #fff; font-weight: 750; }
    .focus-course { color: #f3f1ff; font-size: 11px; font-weight: 650; }
    .stat-label { color: var(--ink); font-size: 12px; font-weight: 800; }
    .stat-foot, .weekly-chart-caption, .panel-subtitle, .status-text, .upcoming-date {
        color: var(--muted);
        font-size: 11px;
        font-weight: 650;
    }
    .weekly-chart-title, .upcoming-title, .quick-link-text, .panel-title { font-weight: 800; }
    .weekly-bar-label { color: var(--ink); font-size: 9px; font-weight: 750; }
    .course-tag, .due-badge, .count-chip { font-size: 10px; font-weight: 800; }
    .quick-link-sub { color: var(--muted); font-size: 10px; font-weight: 650; }
    .empty-state { color: var(--muted); font-size: 12px; font-weight: 600; }
    body[data-theme="dark"] .stat-label,
    body[data-theme="dark"] .weekly-chart-title,
    body[data-theme="dark"] .weekly-bar-label,
    body[data-theme="dark"] .status-text,
    body[data-theme="dark"] .upcoming-date,
    body[data-theme="dark"] .stat-foot,
    body[data-theme="dark"] .weekly-chart-caption,
    body[data-theme="dark"] .panel-subtitle,
    body[data-theme="dark"] .quick-link-sub,
    body[data-theme="dark"] .empty-state { color: #d0cfe0; }
    body[data-theme="dark"] .stat-card,
    body[data-theme="dark"] .panel { border-color: var(--line); background: var(--paper); }
    body[data-theme="dark"] .upcoming-row:hover,
    body[data-theme="dark"] .quick-link:hover { background: #2b2a43; }
    body[data-theme="dark"] .complete-ring .ring-track { stroke: #414158; }
    body[data-theme="dark"] .weekly-bar { background: #454260; }
    body[data-theme="dark"] .weekly-bar.today { background: #9689ff; }
    body[data-theme="dark"] .calendar-mark,
    body[data-theme="dark"] .quick-link-icon { color: #d3ceff; background: #383451; }
    body[data-theme="dark"] .count-chip { color: #d6d1ff; background: #383451; }
    @media (max-width: 1050px) {
        .stats-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); grid-template-rows: repeat(2, minmax(130px, auto)); }
        .dashboard-columns { grid-template-columns: minmax(0, 1.2fr) minmax(230px, .8fr); }
    }
    @media (max-width: 850px) {
        .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); grid-template-rows: auto; }
        .stat-total { grid-column: span 2; grid-row: auto; min-height: 215px; }
        .stat-pending { grid-column: 1; grid-row: auto; }
        .stat-progressing { grid-column: 2; grid-row: auto; }
        .stat-completed { grid-column: span 2; grid-row: auto; min-height: 120px; }
        .dashboard-columns { grid-template-columns: 1fr; }
    }
    @media (max-width: 560px) {
        .dashboard-heading { margin-bottom: 16px; }
        .welcome-banner { min-height: 0; align-items: stretch; flex-direction: column; padding: 22px; }
        .welcome-banner:before { right: -80px; }
        .focus-card, .focus-empty { width: 100%; }
        .stats-grid { gap: 9px; margin-top: 11px; }
        .stat-card { padding: 13px; }
        .stat-total { min-height: 205px; }
        .weekly-bars { height: 60px; gap: 5px; }
        .stat-completed { min-height: 105px; }
        .complete-ring { width: 66px; height: 66px; }
        .upcoming-row { grid-template-columns: 34px minmax(0, 1fr) auto; gap: 8px; padding: 11px 12px; }
        .course-tag { max-width: 130px; }
    }
</style>
@endpush

@section('content')
<div class="dashboard-heading">
    <div>
        <span class="eyebrow">Area akademik</span>
        <h1>Dashboard</h1>
        <p>Ringkasan aktivitas kuliahmu.</p>
    </div>
</div>

@if (session('success'))
    <div class="flash">{{ session('success') }}</div>
@endif

<section class="welcome-banner">
    <div class="welcome-copy">
        <span class="eyebrow">Ruang belajar pribadimu</span>
        <h2>Satu langkah kecil,<br>progres besar.</h2>
        <p>
            @if ((int) $summary->total === 0)
                Tambahkan tugas pertamamu dan mulai bangun kebiasaan belajar yang konsisten.
            @else
                Kamu sudah menuntaskan {{ $summary->completed }} dari {{ $summary->total }} tugas. Ada {{ $summary->due_soon }} tenggat dalam 7 hari.
            @endif
        </p>
    </div>
    @if ($upcomingTasks->isNotEmpty())
        @php
            $focusTask = $upcomingTasks->first();
            $focusDaysLeft = (int) now()->startOfDay()->diffInDays($focusTask->due_date->copy()->startOfDay(), false);
        @endphp
        <aside class="focus-card" aria-label="Tugas fokus terdekat">
            <div class="focus-card-head"><span class="focus-pulse"></span>Fokus berikutnya</div>
            <div class="focus-title">{{ $focusTask->title }}</div>
            <div class="focus-course">{{ $focusTask->course }}</div>
            <div class="focus-bottom">
                <span class="focus-caption">Tenggat {{ $focusTask->due_date->format('d M Y') }}</span>
                <span class="focus-due">
                    @if ($focusTask->due_date->isToday())
                        Hari ini
                    @elseif ($focusDaysLeft > 0)
                        H-{{ $focusDaysLeft }}
                    @else
                        Terlambat
                    @endif
                </span>
            </div>
        </aside>
    @else
        <aside class="focus-empty">
            Belum ada tugas bertenggat. Catat tugasmu agar mudah menentukan fokus.
            <a href="{{ route('tasks.create') }}">＋ Tambah tugas</a>
        </aside>
    @endif
</section>

<section class="stats-grid" aria-label="Ringkasan tugas">
    <article class="stat-card stat-total">
        <div>
            <div class="stat-top">
                <span class="stat-label">Total tugas</span>
                <span class="stat-icon stat-violet">▤</span>
            </div>
            <div class="stat-number">{{ $summary->total }}</div>
            <div class="stat-foot">Tugas dari {{ $courseCount }} mata kuliah</div>
        </div>
        <div class="weekly-chart">
            <div class="weekly-chart-head">
                <span class="weekly-chart-title">Aktivitas minggu ini</span>
                <span class="weekly-chart-caption">Tugas dicatat per hari</span>
            </div>
            <div class="weekly-bars" aria-label="Grafik tugas yang dicatat minggu ini">
                @php($maxWeeklyCount = max(1, $weeklyActivity->max('count')))
                @foreach ($weeklyActivity as $day)
                    @php($barHeight = $day['count'] > 0 ? max(15, (int) round($day['count'] / $maxWeeklyCount * 100)) : 8)
                    <div class="weekly-bar-item" title="{{ $day['count'] }} tugas">
                        <span class="weekly-bar {{ $day['date']->isToday() ? 'today' : '' }}" style="--bar-height: {{ $barHeight }}%"></span>
                        <span class="weekly-bar-label">{{ $day['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </article>

    <article class="stat-card stat-small stat-pending">
        <div class="stat-top"><span class="stat-label">Belum dimulai</span><span class="stat-icon stat-orange">◷</span></div>
        <div class="stat-number">{{ $summary->pending }}</div>
        <div class="stat-foot">Siap masuk daftar fokusmu</div>
    </article>
    <article class="stat-card stat-small stat-progressing">
        <div class="stat-top"><span class="stat-label">Sedang dikerjakan</span><span class="stat-icon stat-blue">↗</span></div>
        <div class="stat-number">{{ $summary->in_progress }}</div>
        <div class="stat-foot">Tetap jaga progresnya</div>
    </article>
    <article class="stat-card stat-completed">
        <div class="complete-copy">
            <div class="stat-label">Progres selesai</div>
            <div class="stat-number">{{ $summary->completed }}<span style="font-size: 14px; letter-spacing: 0"> tugas</span></div>
            <div class="stat-foot">Dari {{ $summary->total }} tugas keseluruhan</div>
        </div>
        <svg class="complete-ring" viewBox="0 0 80 80" role="img" aria-label="Progres selesai {{ $summary->completion_rate }} persen">
            <circle class="ring-track" cx="40" cy="40" r="34"></circle>
            <circle class="ring-value" cx="40" cy="40" r="34" stroke-dasharray="213.63" stroke-dashoffset="{{ 213.63 - (213.63 * (int) $summary->completion_rate / 100) }}"></circle>
            <text x="40" y="40">{{ $summary->completion_rate }}%</text>
        </svg>
    </article>
</section>

<div class="dashboard-columns">
    <section class="panel">
        <div class="panel-head">
            <div>
                <h2 class="panel-title">Tenggat berikutnya</h2>
                <p class="panel-subtitle">Tugas yang perlu kamu siapkan.</p>
            </div>
            <a class="count-chip" href="{{ route('tasks.index') }}">Lihat semua →</a>
        </div>
        @forelse ($upcomingTasks as $task)
            @php($daysLeft = (int) now()->startOfDay()->diffInDays($task->due_date->copy()->startOfDay(), false))
            <article class="upcoming-row">
                <span class="calendar-mark">{{ $task->due_date->format('d') }}</span>
                <div>
                    <div class="upcoming-title">{{ $task->title }}</div>
                    <div class="upcoming-meta">
                        <span class="course-tag course-color-{{ abs(crc32($task->course)) % 5 }}">{{ $task->course }}</span>
                        <span class="status-text">{{ ['pending' => 'Belum dimulai', 'in_progress' => 'Sedang dikerjakan'][$task->status] }}</span>
                    </div>
                </div>
                <div class="upcoming-date">
                    {{ $task->due_date->format('M Y') }}
                    <div class="due-badge {{ $task->due_date->isToday() ? 'today' : ($daysLeft < 0 ? 'overdue' : ($daysLeft <= 2 ? 'soon' : '')) }}">
                        @if ($task->due_date->isToday())
                            Hari ini
                        @elseif ($daysLeft > 0)
                            H-{{ $daysLeft }}
                        @else
                            Terlambat
                        @endif
                    </div>
                </div>
            </article>
        @empty
            <div class="empty-state">Belum ada tenggat aktif.<br>Tambahkan tugas dengan tanggal pengumpulan untuk melihatnya di sini.</div>
        @endforelse
    </section>

    <aside class="panel">
        <div class="panel-head">
            <div>
                <h2 class="panel-title">Akses cepat</h2>
                <p class="panel-subtitle">Lanjutkan aktivitas belajarmu.</p>
            </div>
        </div>
        <nav class="quick-links">
            <a class="quick-link" href="{{ route('tasks.index') }}">
                <span class="quick-link-icon">▤</span>
                <span><span class="quick-link-text">Daftar tugas</span><span class="quick-link-sub">{{ $summary->total }} tugas · {{ $courseCount }} mata kuliah</span></span>
                <span class="quick-arrow">→</span>
            </a>
            <a class="quick-link" href="{{ route('tasks.create') }}">
                <span class="quick-link-icon">＋</span>
                <span><span class="quick-link-text">Tambah tugas</span><span class="quick-link-sub">Catat pekerjaan baru</span></span>
                <span class="quick-arrow">→</span>
            </a>
            <a class="quick-link" href="{{ route('quizzes.index') }}">
                <span class="quick-link-icon">✎</span>
                <span><span class="quick-link-text">Latihan soal</span><span class="quick-link-sub">Asah pemahaman materi</span></span>
                <span class="quick-arrow">→</span>
            </a>
        </nav>
    </aside>
</div>
@endsection
