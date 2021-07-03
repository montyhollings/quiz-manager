<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizCreateRequest;
use Auth;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\QuizRequest;
use Session;

class QuizController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $quizzes = Quiz::all();
        return view('quiz.index', compact('quizzes'));
    }
    public function create(Request $request)
    {
        $form_url = route('quizzes.submit_create');
        $Quiz = null;
        return view('quiz.add_edit', compact('Quiz', 'form_url'));
    }

    public function submit_create(QuizCreateRequest $request)
    {
        Quiz::create($request->except('_token') + ['created_by' => Auth::id()]);

        $request->session()->flash('message', 'Quiz Created!');
        $request->session()->flash('alert-class', 'alert-success');

        return redirect()->route('home');
    }

    public function edit(Request $request, $QuizID)
    {
        $Quiz = Quiz::findOrFail($QuizID);
        $form_url = route('quizzes.submit_edit', $QuizID);
        return view('quiz.add_edit', compact('Quiz', 'form_url'));
    }

    public function submit_edit(QuizCreateRequest $request, $QuizID)
    {
        $Quiz = Quiz::findOrFail($QuizID);
        $Quiz->update($request->all());
        $request->session()->flash('message', 'Quiz Updated!');
        $request->session()->flash('alert-class', 'alert-success');
        return redirect()->route('home');
    }

    public function delete(Request $request, $QuizID)
    {
        $Quiz = Quiz::findOrFail($QuizID);
        $Quiz->delete();
        $request->session()->flash('message', 'Quiz Deleted!');
        $request->session()->flash('alert-class', 'alert-danger');
        return redirect()->route('home');
    }
}
