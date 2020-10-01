<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\UserQuiz;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void!
     */
    public function run()
    {
        $quizzes = [];
        foreach(range(2, 0) as $i){
            $user = User::factory()->create();
            $quizzes[] = Quiz::factory()->create(['author_id' => $user->id]);
        }
        $b = $quizzes[0]->getKey();
        foreach(range(20, 0) as $i){
            $user = User::factory()->create();
            UserQuiz::factory()->create(['user_id' => $user->id, 'quiz_id' => $quizzes[rand(0, 1)]->id]);
        }
    }
}
