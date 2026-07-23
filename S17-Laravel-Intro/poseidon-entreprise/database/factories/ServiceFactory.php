<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom' => $this->faker->jobTitle(),
            'responsable' => $this->faker->name(),
            'telephone' => $this->faker->phoneNumber(),
        ];
    }
}