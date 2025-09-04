<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->words(3, true);

        return [
            'category_id'       => Category::inRandomOrder()->first()?->id ?? 1,
            'name'              => $name,
            'slug'              => Str::slug($name) . '-' . Str::random(5),
            'deskripsi'         => $this->faker->paragraph(4),
            'deskripsi_singkat' => $this->faker->sentence(),
            'harga'             => $this->faker->numberBetween(50000, 500000),
            'harga_jual'        => $this->faker->numberBetween(40000, 450000),
            'sku'               => strtoupper(Str::random(8)),
            'stock_kuantitas'   => $this->faker->numberBetween(0, 100),
            'berat'             => $this->faker->randomFloat(2, 0.1, 2),
            'dimensi'           => json_encode([
                'p' => $this->faker->numberBetween(10, 50),
                'l' => $this->faker->numberBetween(10, 50),
                't' => $this->faker->numberBetween(1, 20),
            ]),
            'ukuran'            => $this->faker->randomElement(['s', 'm', 'l', 'xl']),
            'status'            => $this->faker->randomElement(['active', 'inactive', 'out_of_stock']),
            'is_featured'       => $this->faker->boolean(),
            'rating_rata'       => $this->faker->randomFloat(2, 0, 5),
            'total_reviews'     => $this->faker->numberBetween(0, 200),
            'total_penjualan'   => $this->faker->numberBetween(0, 500),
            'meta_data'         => json_encode(['warna' => $this->faker->safeColorName()]),
        ];
    }
}
