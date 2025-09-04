<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImages;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::factory(10) // buat 10 produk
            ->create()
            ->each(function ($product) {
                // generate 3 gambar per produk
                ProductImages::factory()
                    ->count(3)
                    ->create([
                        'product_id' => $product->id,
                    ]);

                // jadikan salah satu gambar sebagai primary
                $product->images()->inRandomOrder()->first()?->update(['is_primary' => true]);
            });
    }
}
