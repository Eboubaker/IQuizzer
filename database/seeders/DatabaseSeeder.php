<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\UserQuiz;
use App\Models\User;
use App\Models\UserSettings;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void!
     */
    public function run()
    {
        print "Seeding DataBase\n";
        $quizzes = [];
        User::factory()->create();
        User::factory()->create([
            'name' => "Eboubaker Bekkouche",
            'email' => "gpscrambor.4862500@gmail.com",
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make("0677719abkabk")
        ]);
        UserSettings::create([
            'id' => 1
        ]);
        UserSettings::create([
            'id' => 2
        ]);
        $quizzes[] = Quiz::factory()->create(['author_id' => 1]);
        $quizzes[] = Quiz::factory()->create(['author_id' => 2]);
        $b = $quizzes[0]->getKey();
        foreach(range(20, 0) as $i){
            $quiz = Quiz::find($quizzes[rand(0, 1)]->id);
            $user = User::factory()->create();
            $answers=[];
            $point = 0;
            foreach ($quiz->questions as $question)
            {
                if(rand(0, 100) > 50)
                {
                    $point += $question->point;
                    $answers[] = $question->choices[$question->correctChoices[0]];
                }else{
                    $answers[] = $question->choices[rand(0, 2)];
                }
            }
            UserQuiz::factory()->create([
                'user_id' => $user->id,
                'quiz_id' => $quiz->id,
                'point' => $point,
                'answers' => $answers
            ]);
        }
    }
}
