<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->default(null);
            $table->foreignId('quiz_id')->nullable()->default(null);
            $table->datetime('quiz_start')->nullable()->default(null);
            $table->datetime('quiz_end')->nullable()->default(null);

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('quiz_id')->references('id')->on('quizzes');
        });

        Schema::create('quiz_attempt_answers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('quiz_attempt_id')->nullable()->default(null);
            $table->foreignId('question_id')->nullable()->default(null);
            $table->foreignId('answer_id')->nullable()->default(null);
            $table->datetime('question_time')->nullable()->default(null);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('quiz_attempt_id')->references('id')->on('quiz_attempts');
            $table->foreign('question_id')->references('id')->on('quiz_questions');
            $table->foreign('answer_id')->references('id')->on('quiz_question_answers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_attempts');
    }
}
