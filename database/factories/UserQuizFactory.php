<?php

namespace Database\Factories;

use App\Models\UserQuiz;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserQuizFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserQuiz::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $answers = [];
        $point = 0;
        foreach(range(0, 29) as $i){
            array_push($answers, $this->faker->sentence);
            if(rand(0,100)>50){
                $point++;
            }
        }
        return [
            'answers' => $answers,
            'point' => $point,
        ];
    }
}
