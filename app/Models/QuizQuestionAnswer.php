<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizQuestionAnswer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'question_id',
        'answer',
        'order',
        'correct',
    ];
    public function question()
    {
        return $this->belongsTo(QuizQuestion::class, 'question_id');
    }
}
