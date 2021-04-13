<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->sentence($this->faker->numberBetween(5, 255)),
            'user_id' => $this->faker->numberBetween(1, 5),
            'session_id' => 1,//$this->faker->numberBetween(1, 5),
            'type_id' => 1
        ];
    }
}
