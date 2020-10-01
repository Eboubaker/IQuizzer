<?php

namespace App\Observers;

use App\Models\Quiz;

class QuizObserver
{
    /**
     * Handle the quiz "created" event.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return void
     */
    public function created(Quiz $quiz)
    {
        dd($quiz);
    }

    /**
     * Handle the quiz "updated" event.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return void
     */
    public function updated(Quiz $quiz)
    {
        //
    }

    /**
     * Handle the quiz "deleted" event.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return void
     */
    public function deleted(Quiz $quiz)
    {
        //
    }

    /**
     * Handle the quiz "restored" event.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return void
     */
    public function restored(Quiz $quiz)
    {
        //
    }

    /**
     * Handle the quiz "force deleted" event.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return void
     */
    public function forceDeleted(Quiz $quiz)
    {
        //
    }
}
