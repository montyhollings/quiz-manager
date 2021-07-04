<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizAttemptAnswer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [

        'quiz_attempt_id',
        'question_id',
        'answer_id',
        'question_answer_time'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'question_time'
    ];

    public function quiz_attempt()
    {
        return $this->belongsTo(QuizAttempt::class, 'quiz_attempt_id');
    }

    public function question()
    {
        return $this->belongsTo(QuizQuestion::class, 'question_id');
    }

    public function answer()
    {
        return $this->belongsTo(QuizQuestionAnswer::class, 'answer_id');
    }
}
