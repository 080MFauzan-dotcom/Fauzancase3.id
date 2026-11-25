<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->string('subject_slug', 100);
            $table->string('subject_name', 180);
            $table->unsignedTinyInteger('question_number');
            $table->text('prompt');
            $table->json('choices');
            $table->char('correct_answer', 1);
            $table->text('explanation');
            $table->timestamps();

            $table->unique(['subject_slug', 'question_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};
