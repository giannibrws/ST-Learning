<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'member_count' => rand(1,10),
            'created_by' => $this->randomName(),
            'fk_user_id' => 1,
        ];
    }

    protected function generateClassName(){
        $names = ["Photoshop", "Webhosting", "Adobe After effects", "Wiskunde", "PHP introductie", "Javascript 2.", "Javascript 1.", "Koken", "Programmeren arduino"];
        return $names[array_rand($names, 1)];
    }

    protected function randomName(){
        $names = ["Willem", "Sarah", "Thomas", "Jason", "Philip", "Lenny", "Wendy", "John Doe"];
        return $names[array_rand($names, 1)];
    }
}
