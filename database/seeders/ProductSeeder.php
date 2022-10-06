<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::factory()
            ->count(5)
            ->create()
            ->each(fn ($p)
            => $p->categories()->attach(Category::query()->get()->random(rand(1, 3))));
    }
}
