<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductImagesFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(), // fallback kalau dipanggil sendiri
            'image_path' => 'products/images/' . $this->faker->image('storage/app/public/products/images', 640, 480, null, false),
            'alt_text'   => $this->faker->sentence(),
            'is_primary' => false,
            'sort_order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
