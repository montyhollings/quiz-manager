<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionAnswer;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class QuizQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function process(Request $request, $quiz_id)
    {
        $Quiz = Quiz::with('questions.answers')->findorfail($quiz_id);

        return view('quiz.questions.process_questions', compact('Quiz'));

    }

    public function new_question(Request $request, $quiz_id)
    {
        $Quiz = Quiz::with('questions.answers')->findorfail($quiz_id);
        $Question = null;
        $form_url = route('quizzes.questions.submit_new_question', [$quiz_id]);

        return view('quiz.questions.add_edit', compact('Quiz', 'Question', 'form_url'));
    }
    public function edit(Request $request, $quiz_id, $question_id)
    {
        $Quiz = Quiz::with('questions.answers')->findorfail($quiz_id);
        $Question = QuizQuestion::with('answers')->findorfail($question_id);
        $form_url = route('quizzes.questions.submit_new_question', [$quiz_id]);

        return view('quiz.questions.add_edit', compact('Quiz', 'Question', 'form_url'));
    }

    public function submit_question(Request $request, $quiz_id)
    {
        $Quiz = Quiz::with('questions.answers')->findorfail($quiz_id);
        $validator = Validator::make($request->all(), [
            'question' => 'required|min:4',
            'number_of_answers' => 'required',
            'correct_select' => 'required',
        ]);

        $questions = [
            'answer_1' => 'required',
            'answer_2' => 'required',
            'answer_3' => 'required',
            'answer_4' => 'required',
        ];
        $questions = array_slice($questions, 0, $request->input('number_of_answers'));
        $validator->addRules($questions);

        if ($validator->fails()) {
            return redirect()->route('quizzes.questions.process', $Quiz)
                ->withErrors($validator)
                ->withInput();
        }
        $correct_answer = $request->input('correct_select');

        $question = new QuizQuestion();
        $question->question = trim($request->input('question'));
        $question->quiz_id = $Quiz->id;
        $question->order = ($Quiz->questions->count() + 1 ) ?? 1;
        $question->save();

        $answer1 = new QuizQuestionAnswer();
        $answer1->answer = trim($request->input('answer_1'));
        $answer1->question_id = $question->id;
        $answer1->order = 1;
        $answer1->save();

        $answer2 = new QuizQuestionAnswer();
        $answer2->answer = trim($request->input('answer_2'));
        $answer2->question_id = $question->id;
        $answer2->order = 2;
        $answer2->save();

        if(in_array($request->input('number_of_answers'), [3,4]))
        {
            $answer3 = new QuizQuestionAnswer();
            $answer3->answer = trim($request->input('answer_3'));
            $answer3->question_id = $question->id;
            $answer3->order = 3;
            $answer3->save();
        }
        if($request->input('number_of_answers') == 4)
        {
            $answer4 = new QuizQuestionAnswer();
            $answer4->answer = trim($request->input('answer_3'));
            $answer4->question_id = $question->id;
            $answer4->order = 4;
            $answer4->save();
        }
        switch($correct_answer)
        {
            case 1:
                $answer1->correct = true;
                $answer1->save();
                break;
            case 2:
                $answer2->correct = true;
                $answer2->save();
                break;
            case 3:
                $answer3->correct = true;
                $answer3->save();
                break;
            case 4:
                $answer4->correct = true;
                $answer4->save();
                break;
        }
        Session::flash('message', 'Quiz Question Created!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('quizzes.questions.process', [$Quiz->id]);
    }

    public function delete(Request $request, $quiz_id, $question_id)
    {
        $Question = QuizQuestion::with('answers', 'quiz')->findorfail($question_id);
        $Question->delete();

        Session::flash('message', 'Question Deleted');
        Session::flash('alert-class', 'alert-danger');
        return redirect()->route('quizzes.questions.process', [$quiz_id]);
    }
}
