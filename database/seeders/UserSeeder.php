<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new user();
        $user->name = "Victor";
        $user->email = "victor@gmail.com";
        $user->password = bcrypt('Admin123');
        $user->status = true;
        $user->save();
    }
}
