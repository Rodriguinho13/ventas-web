<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //Debemos importar la libreria DB

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->insert(['dni' => '123456', 'full_name' => "Juan Carlos Cardona"]); //insertamos nuevo cliente sacando los datos de las migraciones
        DB::table('clients')->insert(['dni' => '222333', 'full_name' => "Martha Diaz", 'cell_phone' => '789545135']);
    }
}
