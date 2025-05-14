<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(), //crea aleatoriamente nombre ficticio
            'sale_price' => $this->faker->randomFloat(2, 0,500), //crea de manera aleatoria un precio ficticio de dos digitos desde 0 hasta 500
            'quantity' => $this->faker->numberBetween(1, 100), //crea de manera aleatoria cantidades de 1 a 200
            'status' => $this->faker->randomElement(['Activo', 'Descontinuado']), //crea aleatoriamente si esta activo o descontinuado
            'category_id' => Category::all()->random()->id, //crea aleatoriamente en base a los id que tenemos creado de las categorias

        ];
    }
}
