<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->can_edit)
        {
            $recent_attempts = QuizAttempt::with('quiz.questions.answers', 'user')->get()->sortBy('created_at');
        }else{
            $recent_attempts = QuizAttempt::with('quiz.questions.answers', 'user')->where('user_id', '=', Auth::user()->id)->get()->sortBy('created_at');

        }
        return view('home', compact('recent_attempts'));
    }
}
