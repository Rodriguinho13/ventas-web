<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dni' => $this->faker->postcode(), //crea datos aleatorios para un carnet pero usando codigo postal que estara representando el codigo postal
            'full_name' => $this->faker->firstName() . ' ' . $this->faker->lastName(), //concatenando nombre y apellido de manera aleatoria
            'cell_phone' => $this->faker->phoneNumber(),//celular aleatorio
            'address' => $this->faker->address(),//dirección aleatoria
        ];
    }
}
