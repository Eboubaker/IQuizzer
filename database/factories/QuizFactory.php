<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Quiz;
use App\Models\Module;
use App\Models\Teacher;
use App\Models\User;
use App\Question;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use stdClass;

class QuizFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quiz::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $questions = [];
        foreach(range(0, 20) as $i){
            array_push($questions, new Question($this->faker->sentence, $this->faker->sentences(3), [0], 1));
        }
        return [
//            'id' => Str::random(10),
            'title' => $this->faker->sentence(2),
            'time'  =>  (new Carbon())->addDays(rand(0, 10))->addHours(rand(1, 24)),
            'questions' => $questions,
            'duration' => rand(15, 120),
            'total_points' => 20,
        ];
    }
}
