<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Sale;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(UserSeeder::class);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $products = Product::factory(50)->create(); // Debemos usar el MODELO Producto, seguidamente de la cantidad y la función CREAR, con esto registraremos 50 productos de manera aleatoria

        Client::factory(20)->create();//Debemos usar el Modelo cliente, seguidamente de la cantidad y la función CREAR, con esto registraremos 50 productos de manera aleatoria

        $sales = Sale::factory(10)->create();//Debemos usar el Modelo Sale, seguidamente de la cantidad y la función CREAR, con esto registraremos 50 productos de manera aleatoria

        $products->each(function ($product) use ($sales) {
            $product->sales()->attach($sales->random()->id, ['sale_price' => 10, 'quantity' => 2]);
        });
    }
}
