<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_question_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id');
            $table->text('answer');
            $table->integer('order')->unsigned();
            $table->boolean('correct')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('question_id')->references('id')->on('quiz_questions');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_question_answers');
    }
}
