<?php
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

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

Route::get('/create', 'QuizController@create')->name('createQuiz');
Route::post('/quiz/create', 'QuizController@submitCreate')->name('submitCreateQuiz');
Route::get('/home/edit/{quizid}', 'QuizController@edit')->name('editQuiz');
Route::post('/quiz/edit/{quizid}', 'QuizController@submitEdit')->name('submitEditQuiz');
Route::get('/quiz/delete/{quizid}', 'QuizController@delete')->name('deleteQuiz');


Route::group(['prefix' => '/quizzes', 'as' => 'quizzes.'], function(){
    Route::get('/index', [QuizController::class, 'index'])->name('index');

    Route::get('/create', [QuizController::class, 'create'])->name('create');
    Route::post('/create', [QuizController::class, 'submit_create'])->name('submit_create');

    Route::get('/edit/{quizid}', [QuizController::class, 'edit'])->name('edit');
    Route::post('/edit/{quizid}', [QuizController::class, 'submit_edit'])->name('submit_edit');

    Route::get('/delete/{quizid}', [QuizController::class, 'delete'])->name('delete');
});
