<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizAttemptAnswer;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionAnswer;
use Auth;
use Illuminate\Http\Request;
use Response;

class QuizTakingController extends Controller
{
    public function initialise_quiz(request $request, $quiz_id)
    {
        $Quiz = Quiz::with('questions.answers')->findorfail($quiz_id);

        return view('quiz.taking.init', compact('Quiz'));

    }
    public function submit_init(request $request, $QuizID)
    {
        $Quiz = Quiz::findOrFail($QuizID);

        $QuizAttempt = new QuizAttempt;
        $QuizAttempt->quiz_id = $Quiz->id;
        $QuizAttempt->user_id = Auth::id();
        $QuizAttempt->quiz_start = \Carbon\Carbon::now('Europe/London');
        $QuizAttempt->save();

        return redirect()->route('quizzes.take.take_quiz', [$Quiz->id, $QuizAttempt->id]);
    }

    public function take_quiz(request $request, $quiz_id, $attempt_id)
    {
        $Quiz = Quiz::with('questions')->findOrFail($quiz_id);
        $QuizAttempt = QuizAttempt::findOrFail($attempt_id);

        return view('quiz.taking.take', compact('Quiz', 'QuizAttempt'));

    }
    public function get_next_question(request $request, $quiz_id, $attempt_id)
    {
        $Quiz = Quiz::with('questions.answers')->findOrFail($quiz_id);
        $QuizAttempt = QuizAttempt::with('quiz_attempt_answers')->findOrFail($attempt_id);

        if ($QuizAttempt->quiz_attempt_answers->count() > 0) {
            $QuestionIDs = $QuizAttempt->quiz_attempt_answers->pluck('question_id')->toArray();

            $NextQuestion = $Quiz->questions->whereNotIn('id', $QuestionIDs)->first();
        } else {
            $NextQuestion = $Quiz->questions->first();
        }
        return Response::json([
            'question' => $NextQuestion->toJson(),
        ], 200);
    }
    public function save_answer(request $request, $quiz_id, $attempt_id)
    {
        $Quiz = Quiz::with('questions.answers')->findOrFail($quiz_id);
        $QuizAttempt = QuizAttempt::findOrFail($attempt_id);

        $Question = QuizQuestion::findOrFail($request->input('question_id'));
        $Answer = QuizQuestionAnswer::findOrFail($request->input('answer_id'));

        $QuizAttemptAnswer = new QuizAttemptAnswer;
        $QuizAttemptAnswer->quiz_attempt_id = $QuizAttempt->id;
        $QuizAttemptAnswer->question_id = $Question->id;
        $QuizAttemptAnswer->answer_id = $Answer->id;
        $QuizAttemptAnswer->question_time = \Carbon\Carbon::now('Europe/London');
        $QuizAttemptAnswer->save();

        $QuizAttempt->load('quiz_attempt_answers');

        $QuizFinished = ($QuizAttempt->quiz_attempt_answers->count() >= $Quiz->questions->count())  ? true : false;

        if ($QuizFinished) {
            $QuizAttempt->quiz_end = \Carbon\Carbon::now('Europe/London');
            $QuizAttempt->save();
        }

        return Response::json([
            'quiz_finished' => $QuizFinished,
        ], 200);
    }
    public function summary(request $request, $quiz_id, $attempt_id)
    {
        $Quiz = Quiz::with('questions.answers')->findOrFail($quiz_id);
        $QuizAttempt = QuizAttempt::with('quiz_attempt_answers')->findOrFail($attempt_id);

        return view('quiz.summary', compact('Quiz', 'QuizAttempt'));
    }

    public function view_attempts(request $request, $quiz_id)
    {
        if(Auth::user()->can_edit)
        {
            $Quiz = Quiz::with('attempts')->findorfail($quiz_id);
        }else{
            $Quiz = Quiz::whereHas('attempts', function ($query) {
                return $query->where('user_id', '=', Auth::user());
            })->findorfail($quiz_id);

        }

        return view('quiz.attempts', compact('Quiz'));
    }
}
