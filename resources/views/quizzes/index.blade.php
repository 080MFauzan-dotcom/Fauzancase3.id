@extends('layouts.student')

@section('title', 'Latihan soal')

@push('styles')
<style>
    .quiz-hero { position: relative; overflow: hidden; padding: 27px 31px; border-radius: 18px; color: white; background: linear-gradient(115deg, #30304f, #4e477e 65%, #7161e6); }
    .quiz-hero:after { position: absolute; content: ""; width: 190px; height: 190px; right: 45px; top: -85px; border: 1px solid #ffffff24; border-radius: 50%; box-shadow: 0 0 0 25px #ffffff08, 0 0 0 52px #ffffff06; }
    .quiz-hero-copy { position: relative; z-index: 1; max-width: 520px; }
    .quiz-hero .eyebrow { color: #c9c2ff; }
    .quiz-hero h2 { margin: 9px 0 7px; font-size: 25px; letter-spacing: -.6px; }
    .quiz-hero p { margin: 0; color: #dedcff; font-size: 12px; line-height: 1.7; }
    .subject-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 14px; margin-top: 18px; }
    .subject-card { position: relative; overflow: hidden; min-height: 177px; padding: 17px; border: 1px solid var(--line); border-radius: 15px; background: white; box-shadow: 0 5px 16px #22204405; transition: transform .18s, box-shadow .18s, border-color .18s; }
    .subject-card:hover { transform: translateY(-3px); border-color: #d7d2ff; box-shadow: 0 12px 25px #39335e10; }
    .subject-card-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 8px; }
    .subject-index { width: 37px; height: 37px; display: grid; place-items: center; border-radius: 12px; color: #6558dc; background: #f0eeff; font-size: 11px; font-weight: 800; }
    .subject-card:nth-child(3n + 2) .subject-index { color: #33876d; background: #eaf8f1; }
    .subject-card:nth-child(3n) .subject-index { color: #bf8244; background: #fff3e8; }
    .subject-count { color: #9292a4; font-size: 9px; font-weight: 700; }
    .subject-card h3 { max-width: 240px; min-height: 39px; margin: 13px 0 5px; font-size: 13px; line-height: 1.5; }
    .subject-card p { margin: 0; color: #9696a8; font-size: 10px; }
    .subject-start { display: inline-flex; align-items: center; gap: 7px; margin-top: 14px; color: #6153dc; font-size: 10px; font-weight: 750; }
    .subject-start span { transition: transform .18s; }
    .subject-card:hover .subject-start span { transform: translateX(4px); }
    .quiz-note { display: flex; align-items: flex-start; gap: 11px; margin-top: 16px; padding: 13px 15px; border: 1px solid #ebe9ff; border-radius: 12px; color: #73738b; background: #f4f2ff; font-size: 10px; line-height: 1.6; }
    .quiz-note strong { color: #4d477e; }
    @media (max-width: 850px) { .subject-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
    @media (max-width: 520px) { .subject-grid { grid-template-columns: 1fr; } .quiz-hero { padding: 23px; } .quiz-hero:after { right: -105px; } }
</style>
@endpush

@section('content')
<div class="page-heading">
    <div>
        <span class="eyebrow">Belajar aktif</span>
        <h1>Latihan soal</h1>
        <p>Asah pemahaman materi lewat kuis singkat dan pembahasan langsung.</p>
    </div>
    <span class="date-chip">{{ $subjects->count() }} mata kuliah</span>
</div>

<section class="quiz-hero">
    <div class="quiz-hero-copy">
        <span class="eyebrow">Practice makes progress</span>
        <h2>Uji pemahamanmu, satu topik sekali waktu.</h2>
        <p>Pilih mata kuliah untuk mulai. Setiap latihan berisi lima soal pilihan ganda dengan pembahasan setelah selesai.</p>
    </div>
</section>

<section class="subject-grid" aria-label="Daftar mata kuliah latihan soal">
    @foreach ($subjects as $index => $subject)
        <a class="subject-card" href="{{ route('quizzes.show', $subject->subject_slug) }}">
            <div class="subject-card-top">
                <span class="subject-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                <span class="subject-count">{{ $subject->questions_count }} SOAL</span>
            </div>
            <h3>{{ $subject->subject_name }}</h3>
            <p>Latihan pilihan ganda · Pembahasan tersedia</p>
            <span class="subject-start">Mulai latihan <span>→</span></span>
        </a>
    @endforeach
</section>

<div class="quiz-note">
    <span aria-hidden="true"></span>
    <div><strong>GOGOGOGO</strong> Belajar yang benar dek </div>
</div>
@endsection
