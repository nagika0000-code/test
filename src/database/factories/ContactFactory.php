<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->locale('ja_JP');
        
        return [
        'first_name' => $this->faker->firstName,
        'last_name' => $this->faker->lastName,
        'gender' => $this->faker->numberBetween(1, 3),
        'email' => $this->faker->safeEmail,
        'tel' => $this->faker->numerify('#####'),
        'address' => $this->faker->address,
        'building' => $this->faker->optional()->word,
        'category_id' => $this->faker->numberBetween(1, 5),
        'detail' => $this->faker->realText(100),
        ];
    }
}
