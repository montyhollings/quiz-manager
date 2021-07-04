<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizQuestion extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'quiz_id',
        'order',
    ];
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
    public function answers()
    {
        return $this->hasMany(QuizQuestionAnswer::class, 'question_id');
    }
}
