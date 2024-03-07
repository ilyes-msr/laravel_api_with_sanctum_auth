<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{

    public function definition(): array
    {
        $type = $this->faker->randomElement(['B', 'I']);
        $name = $type == 'B' ? $this->faker->company() : $this->faker->name();
        return [
            'name' => $name,
            'type' => $type,
            'address' => $this->faker->streetAddress(),
            'email' => $this->faker->email(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'postal_code' => $this->faker->postCode()
        ];
    }
}
