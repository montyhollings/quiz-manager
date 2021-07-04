<?php
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizQuestionController;

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
    Route::post('/edit/{quiz_id}', [QuizController::class, 'submit_edit'])->name('submit_edit');

    Route::get('/delete/{quiz_id}', [QuizController::class, 'delete'])->name('delete');

    Route::group(['prefix' => '/questions/{quiz_id}', 'as' => 'questions.'], function(){
        Route::get('/process', [QuizQuestionController::class, 'process'])->name('process');

        Route::get('/new_question', [QuizQuestionController::class, 'new_question'])->name('new_question');
        Route::post('/submit_question', [QuizQuestionController::class, 'submit_question'])->name('submit_new_question');
        Route::get('/edit/{question}', [QuizQuestionController::class, 'edit'])->name('edit');
        Route::get('/delete/{question}', [QuizQuestionController::class, 'delete'])->name('delete');

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
