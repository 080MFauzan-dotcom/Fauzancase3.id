@extends('layouts.student')

@section('title', 'Latihan '.$subjectName)

@push('styles')
<style>
    .quiz-intro { display: flex; align-items: center; justify-content: space-between; gap: 15px; margin-bottom: 16px; padding: 20px 22px; border: 1px solid var(--line); border-radius: 15px; background: white; }
    .quiz-intro h2 { margin: 6px 0 4px; font-size: 18px; }
    .quiz-intro p { margin: 0; color: var(--muted); font-size: 11px; }
    .question-card { margin-bottom: 12px; padding: 17px 19px; border: 1px solid var(--line); border-radius: 14px; background: white; }
    .question-top { display: flex; align-items: center; gap: 9px; margin-bottom: 11px; }
    .question-number { width: 27px; height: 27px; display: grid; place-items: center; border-radius: 9px; color: #6254dc; background: #f0eeff; font-size: 10px; font-weight: 800; }
    .question-label { color: #8c8c9f; font-size: 9px; font-weight: 750; letter-spacing: .9px; text-transform: uppercase; }
    .question-prompt { margin: 0 0 13px; font-size: 12px; font-weight: 700; line-height: 1.65; }
    .choice-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 7px; }
    .choice-option { display: flex; align-items: flex-start; gap: 8px; min-height: 37px; padding: 9px 10px; border: 1px solid #eeedf4; border-radius: 9px; color: #696a7e; background: #fdfdff; font-size: 10px; line-height: 1.5; cursor: pointer; transition: border-color .15s, background .15s; }
    .choice-option:hover { border-color: #cbc5ff; background: #f8f7ff; }
    .choice-option input { margin: 2px 0 0; accent-color: #6858e8; }
    .choice-letter { flex: 0 0 auto; color: #6153dc; font-weight: 800; }
    .submit-quiz { display: flex; align-items: center; justify-content: space-between; gap: 15px; margin-top: 17px; padding: 16px 19px; border: 1px solid var(--line); border-radius: 13px; background: white; }
    .submit-quiz p { margin: 0; color: #838398; font-size: 10px; }
    .submit-quiz button { min-height: 39px; padding: 0 16px; border: 0; border-radius: 9px; color: white; background: #6858e8; font-size: 10px; font-weight: 750; cursor: pointer; }
    .submit-quiz button:hover { background: #4c3fd2; }
    @media (max-width: 560px) { .choice-grid { grid-template-columns: 1fr; } .quiz-intro, .submit-quiz { align-items: flex-start; flex-direction: column; } .submit-quiz button { width: 100%; } }
</style>
@endpush

@section('content')
<div class="page-heading">
    <div>
        <span class="eyebrow">Latihan soal</span>
        <h1>{{ $subjectName }}</h1>
        <p>Kerjakan dengan santai. Pembahasan akan muncul setelah jawaban dikirim.</p>
    </div>
    <a class="date-chip" href="{{ route('quizzes.index') }}">← Semua mata kuliah</a>
</div>

<form method="POST" action="{{ route('quizzes.submit', $subjectSlug) }}">
    @csrf
    @if ($errors->any())
        <div class="flash flash-error">Pilih satu jawaban pada setiap soal sebelum melihat hasil.</div>
    @endif

    <div class="quiz-intro">
        <div>
            <span class="eyebrow">Fokus satu topik</span>
            <h2>Siap menguji pemahaman?</h2>
            <p>{{ $questions->count() }} soal · Pilih satu jawaban terbaik untuk setiap soal.</p>
        </div>
        <span class="count-chip">LATIHAN</span>
    </div>

    @foreach ($questions as $question)
        <fieldset class="question-card" style="border-width: 1px">
            <legend class="question-top">
                <span class="question-number">{{ str_pad($question->question_number, 2, '0', STR_PAD_LEFT) }}</span>
                <span class="question-label">Pertanyaan {{ $question->question_number }}</span>
            </legend>
            <p class="question-prompt">{{ $question->prompt }}</p>
            <div class="choice-grid">
                @foreach ($question->choices as $letter => $choice)
                    <label class="choice-option">
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $letter }}" @checked(old('answers.'.$question->id) === $letter) required>
                        <span class="choice-letter">{{ $letter }}.</span>
                        <span>{{ $choice }}</span>
                    </label>
                @endforeach
            </div>
        </fieldset>
    @endforeach

    <div class="submit-quiz">
        <p>Jawab semua {{ $questions->count() }} soal. Kamu akan langsung melihat skor dan pembahasannya.</p>
        <button type="submit">Lihat hasil latihan →</button>
    </div>
</form>
@endsection
