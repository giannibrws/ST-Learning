<?php

namespace Database\Factories;

use App\Models\Messages;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessagesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Messages::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $i = 1;
        return [
                'user_id' => $i++,
                'classroom_id' => rand(1, 1),
                'body' => $this->faker->paragraph(rand(0, 20))
        ];
    }
}
