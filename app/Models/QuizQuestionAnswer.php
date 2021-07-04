<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\QuizQuestionAnswer
 *
 * @property int $id
 * @property int $question_id
 * @property string $answer
 * @property int $order
 * @property int $correct
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\QuizQuestion $question
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestionAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestionAnswer newQuery()
 * @method static \Illuminate\Database\Query\Builder|QuizQuestionAnswer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestionAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestionAnswer whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestionAnswer whereCorrect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestionAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestionAnswer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestionAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestionAnswer whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestionAnswer whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestionAnswer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|QuizQuestionAnswer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|QuizQuestionAnswer withoutTrashed()
 * @mixin \Eloquent
 */
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
