@extends('layouts.student')

@section('title', 'Hasil latihan '.$subjectName)

@push('styles')
<style>
    .result-hero { display: flex; align-items: center; justify-content: space-between; gap: 20px; margin-bottom: 17px; padding: 22px 24px; border-radius: 16px; color: white; background: linear-gradient(115deg, #5549d5, #7666eb); }
    .result-hero .eyebrow { color: #dedaff; }
    .result-hero h2 { margin: 7px 0 5px; font-size: 21px; }
    .result-hero p { margin: 0; color: #e1deff; font-size: 11px; }
    .score-circle { width: 74px; height: 74px; flex: 0 0 auto; display: grid; place-items: center; border: 1px solid #ffffff60; border-radius: 50%; background: #ffffff19; font-size: 19px; font-weight: 800; }
    .review-heading { margin: 20px 0 11px; font-size: 15px; }
    .review-card { margin-bottom: 10px; padding: 15px 17px; border: 1px solid var(--line); border-left: 4px solid #57b892; border-radius: 12px; background: white; }
    .review-card.incorrect { border-left-color: #df837c; }
    .review-question { margin: 0 0 9px; font-size: 11px; font-weight: 750; line-height: 1.6; }
    .review-answer, .review-explanation { margin-top: 5px; color: #737489; font-size: 10px; line-height: 1.6; }
    .review-answer strong { color: #38866d; }
    .review-card.incorrect .review-answer strong { color: #c05d5d; }
    .result-actions { display: flex; flex-wrap: wrap; gap: 9px; margin-top: 17px; }
    .result-link { min-height: 39px; display: inline-flex; align-items: center; justify-content: center; padding: 0 14px; border: 1px solid var(--line); border-radius: 9px; color: #5f50d7; background: white; font-size: 10px; font-weight: 750; }
    .result-link.primary-link { border-color: #6858e8; color: white; background: #6858e8; }
    @media (max-width: 560px) { .result-hero { align-items: flex-start; } .score-circle { width: 61px; height: 61px; font-size: 16px; } }
</style>
@endpush

@section('content')
<div class="page-heading">
    <div>
        <span class="eyebrow">Hasil latihan</span>
        <h1>{{ $subjectName }}</h1>
        <p>Gunakan pembahasan untuk menentukan materi yang ingin kamu ulang.</p>
    </div>
    <a class="date-chip" href="{{ route('quizzes.index') }}">← Semua mata kuliah</a>
</div>

<section class="result-hero">
    <div>
        <span class="eyebrow">Skor latihan</span>
        <h2>
            @if ($score === 100)
                Hebat, semua benar!
            @elseif ($score >= 60)
                Bagus, terus tingkatkan!
            @else
                Tetap semangat belajar!
            @endif
        </h2>
        <p>Jawaban benar {{ $correctCount }} / {{ $totalQuestions }} soal.</p>
    </div>
    <div class="score-circle">{{ $score }}%</div>
</section>

<h2 class="review-heading">Pembahasan jawaban</h2>
@foreach ($results as $index => $result)
    <article class="review-card {{ $result['isCorrect'] ? '' : 'incorrect' }}">
        <p class="review-question">{{ $index + 1 }}. {{ $result['question']->prompt }}</p>
        <div class="review-answer">
            <strong>{{ $result['isCorrect'] ? 'Benar' : 'Belum tepat' }}.</strong>
            Jawabanmu: {{ $result['selected'] }}. {{ $result['question']->choices[$result['selected']] }}
            @if (! $result['isCorrect'])
                <br>Jawaban yang tepat: {{ $result['question']->correct_answer }}. {{ $result['question']->choices[$result['question']->correct_answer] }}
            @endif
        </div>
        <div class="review-explanation">{{ $result['question']->explanation }}</div>
    </article>
@endforeach

<div class="result-actions">
    <a class="result-link primary-link" href="{{ route('quizzes.show', $subjectSlug) }}">Coba lagi</a>
    <a class="result-link" href="{{ route('quizzes.index') }}">Pilih mata kuliah lain</a>
    <a class="result-link" href="{{ route('tasks.index') }}">Kembali ke dashboard</a>
</div>
@endsection
