<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = [
        'subject_slug',
        'subject_name',
        'question_number',
        'prompt',
        'choices',
        'correct_answer',
        'explanation',
    ];

    protected $casts = [
        'question_number' => 'integer',
        'choices' => 'array',
    ];
}
