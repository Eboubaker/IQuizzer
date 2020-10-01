<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_quiz', function (Blueprint $table) {
            $table->id();
            $table->string('quiz_id', 10);
            $table->foreignId('user_id');
            $table->addColumn('longtext', 'answers');
            $table->float('point');
//            $table->timestamp('started_at');
            $table->timestamps();

            $table->unique(['user_id', 'quiz_id']);
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('quiz_id')->references('id')->on('quizzes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_quiz');
    }
}
