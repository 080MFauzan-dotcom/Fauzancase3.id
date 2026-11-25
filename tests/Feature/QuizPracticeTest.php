<?php

namespace Tests\Feature;

use App\Models\QuizQuestion;
use App\Models\User;
use Database\Seeders\QuizSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuizPracticeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
        app(QuizSeeder::class)->run();
    }

    public function test_seeded_question_bank_has_nine_subjects_with_five_questions_each(): void
    {
        $this->assertSame(45, QuizQuestion::count());
        $this->assertSame(9, QuizQuestion::query()->distinct()->count('subject_slug'));

        $this->assertSame(
            [5],
            QuizQuestion::query()
                ->selectRaw('COUNT(*) as total')
                ->groupBy('subject_slug')
                ->pluck('total')
                ->unique()
                ->values()
                ->all()
        );
    }

    public function test_student_can_open_a_subject_and_submit_answers(): void
    {
        $questions = QuizQuestion::query()
            ->where('subject_slug', 'kalkulus')
            ->orderBy('question_number')
            ->get();
        $answers = $questions->mapWithKeys(fn (QuizQuestion $question) => [
            $question->id => $question->correct_answer,
        ])->all();

        $this->get('/latihan-soal')
            ->assertOk()
            ->assertSee('Dasar Komputer dan Pemrograman')
            ->assertSee('Laboratorium Fisika Dasar');

        $this->get('/latihan-soal/kalkulus')
            ->assertOk()
            ->assertSee('Kalkulus')
            ->assertSee($questions->first()->prompt);

        $this->post('/latihan-soal/kalkulus', ['answers' => $answers])
            ->assertOk()
            ->assertSee('5 / 5 soal')
            ->assertSee('Hebat, semua benar!');
    }

    public function test_student_must_answer_every_question(): void
    {
        $this->from('/latihan-soal/kalkulus')
            ->post('/latihan-soal/kalkulus', ['answers' => []])
            ->assertRedirect('/latihan-soal/kalkulus')
            ->assertSessionHasErrors();
    }
}
