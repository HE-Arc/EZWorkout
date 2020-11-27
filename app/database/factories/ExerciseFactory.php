<?php

namespace Database\Factories;

use App\Models\Exercise;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExerciseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exercise::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'comment' => "bla bla",
            'nbSerie' => 5,
            'repMin' => 5,
            'repMax' => 10,
            'pauseSerie' => 200,
            'pauseExercise' => 150,
        ];
    }
}
