<?php

namespace App\Http\Controllers;

use App\Models\QuizQuestion;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class QuizController extends Controller
{
    public function index(): View
    {
        $subjects = QuizQuestion::query()
            ->selectRaw('subject_slug, subject_name, COUNT(*) as questions_count')
            ->groupBy('subject_slug', 'subject_name')
            ->orderBy('subject_name')
            ->get();

        return view('quizzes.index', compact('subjects'));
    }

    public function show(string $subject): View
    {
        $questions = $this->questionsFor($subject);

        return view('quizzes.show', [
            'questions' => $questions,
            'subjectSlug' => $subject,
            'subjectName' => $questions->first()->subject_name,
        ]);
    }

    public function submit(Request $request, string $subject): View
    {
        $questions = $this->questionsFor($subject);
        $rules = ['answers' => ['required', 'array']];

        foreach ($questions as $question) {
            $rules['answers.'.$question->id] = [
                'required',
                Rule::in(array_keys($question->choices)),
            ];
        }

        $answers = $request->validate($rules)['answers'];
        $results = [];
        $correctCount = 0;

        foreach ($questions as $question) {
            $selected = $answers[$question->id];
            $isCorrect = $selected === $question->correct_answer;
            $correctCount += $isCorrect ? 1 : 0;
            $results[] = [
                'question' => $question,
                'selected' => $selected,
                'isCorrect' => $isCorrect,
            ];
        }

        return view('quizzes.result', [
            'results' => $results,
            'subjectSlug' => $subject,
            'subjectName' => $questions->first()->subject_name,
            'correctCount' => $correctCount,
            'totalQuestions' => $questions->count(),
            'score' => (int) round($correctCount / $questions->count() * 100),
        ]);
    }

    private function questionsFor(string $subject): Collection
    {
        $questions = QuizQuestion::query()
            ->where('subject_slug', $subject)
            ->orderBy('question_number')
            ->get();

        abort_if($questions->isEmpty(), 404);

        return $questions;
    }
}
