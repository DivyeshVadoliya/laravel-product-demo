<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'image' => $this->faker->randomElement(['bluetooth.jpg', 'laptop.jpg', 'mobileimage.jpg']),
            'user_id' => 2,
        ];
    }
}
