<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClassroomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Classroom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->generateClassName(),
            'bio' => $this->faker->paragraph(rand(0,50)),
            'fk_user_id' => 1,
        ];
    }

    protected function generateClassName(){

        $names = ["Geschiedenis", "Biologie", "Wiskunde", "Scheikunde", "Techniek .1", "Koken", "Schilderen"];

        return $names[array_rand($names, 1)];
    }


}
