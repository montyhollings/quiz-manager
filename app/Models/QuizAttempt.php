<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizAttempt extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'quiz_id',
        'quiz_start_time',
        'quiz_end_time'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'quiz_start',
        'quiz_end'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function quiz_attempt_answers()
    {
        return $this->hasMany(QuizAttemptAnswer::class, 'quiz_attempt_id');
    }
    public function getCreatedAtDateDisplayAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }

    public function getCorrectQuestionsCountAttribute()
    {
        $correct_count = 0;

        foreach ($this->quiz_attempt_answers as $quiz_attempt_answer) {
            if ($quiz_attempt_answer->answer->correct) {
                $correct_count++;
            }
        }

        return $correct_count;
    }


    public function getTimeTakenAttribute()
    {
        return $this->quiz_start->diffAsCarbonInterval($this->quiz_end)->forHumans();

    }
}
