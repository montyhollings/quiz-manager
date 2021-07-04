<?php
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizQuestionController;
use App\Http\Controllers\QuizTakingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['prefix' => '/quizzes', 'as' => 'quizzes.'], function(){
    Route::get('/index', [QuizController::class, 'index'])->name('index');

    Route::get('/create', [QuizController::class, 'create'])->name('create');
    Route::post('/create', [QuizController::class, 'submit_create'])->name('submit_create');

    Route::get('/edit/{quiz_id}', [QuizController::class, 'edit'])->name('edit');
    Route::get('/view/{quiz_id}', [QuizController::class, 'view'])->name('view');
    Route::post('/edit/{quiz_id}', [QuizController::class, 'submit_edit'])->name('submit_edit');

    Route::get('/delete/{quiz_id}', [QuizController::class, 'delete'])->name('delete');

    Route::group(['prefix' => '/questions/{quiz_id}', 'as' => 'questions.'], function(){
        Route::get('/process', [QuizQuestionController::class, 'process'])->name('process');

        Route::get('/new_question', [QuizQuestionController::class, 'new_question'])->name('new_question');
        Route::post('/submit_question', [QuizQuestionController::class, 'submit_question'])->name('submit_new_question');
        Route::get('/edit/{question}', [QuizQuestionController::class, 'edit'])->name('edit');
        Route::get('/view/{question}', [QuizQuestionController::class, 'view_question'])->name('view');
        Route::get('/delete/{question}', [QuizQuestionController::class, 'delete'])->name('delete');

    });
    Route::group(['prefix' => '/take/{quiz_id}', 'as' => 'take.'], function(){
        Route::get('/initialise', [QuizTakingController::class, 'initialise_quiz'])->name('init');
        Route::get('/initialise/submit', [QuizTakingController::class, 'submit_init'])->name('submit_init');

        Route::get('/take-quiz/{attempt_id}', [QuizTakingController::class, 'take_quiz'])->name('take_quiz');
        Route::post('/take-quiz/get-next-question/{attempt_id}', [QuizTakingController::class, 'get_next_question'])->name('get_next_question');
        Route::post('/take-quiz/save-answer/{attempt_id}', [QuizTakingController::class, 'save_answer'])->name('save_answer');

        Route::get('/take-quiz/summary/{attempt_id}', [QuizTakingController::class, 'summary'])->name('summary');
        Route::get('/attempts', [QuizTakingController::class, 'view_attempts'])->name('view_attempts');


    });

});
Route::group(['prefix' => '/users', 'as' => 'users.'], function(){
    Route::get('/index', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/create', [UserController::class, 'submit_create'])->name('submit_create');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::post('/edit/{user}', [UserController::class, 'submit_edit'])->name('submit_edit');
    Route::get('/delete/{user}', [UserController::class, 'delete'])->name('delete');


});
