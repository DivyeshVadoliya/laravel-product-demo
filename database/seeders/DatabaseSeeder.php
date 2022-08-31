<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user[] =[
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'roll' => 'admin',
            'status' => 'active',
        ];
        $user2[] =[
            'name' => 'seller',
            'email' => 'seller@gmail.com',
            'password' => bcrypt('12345678'),
            'roll' => 'seller',
            'status' => 'active',
        ];
        User::insert($user);
        User::insert($user2);
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
