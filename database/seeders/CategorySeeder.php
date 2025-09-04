<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['name' => 'T-Shirt', 'slug' => 't-shirt', 'deskripsi' => 'Kategori kaos'],
            ['name' => 'Hoodie', 'slug' => 'hoodie', 'deskripsi' => 'Kategori hoodie'],
            ['name' => 'Shoes', 'slug' => 'shoes', 'deskripsi' => 'Kategori sepatu'],
        ]);
    }
}
