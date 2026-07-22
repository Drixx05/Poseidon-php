<?php

namespace Database\Factories;

use App\Models\Employe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employe>
 */
class EmployeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "prenom" => fake()->firstName(),
            'nom' => fake()->lastName(),
            'sexe' => fake()->randomElement(['m', 'f']),
            'service' => fake()->randomElement([
                'direction',
                'commercial',
                'production',
                'secretariat',
                'comptabilite',
                'informatique',
                'juridique',
                'assistant'
            ]),
            'date_embauche' => fake()->date(),
            'salaire' => fake()->numberBetween(1800,4500)
        ];
    }
}
