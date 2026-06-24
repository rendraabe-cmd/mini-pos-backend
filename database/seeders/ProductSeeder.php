<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Makanan - category_id: 1
            [
                'category_id' => 1,
                'name'        => 'Nasi Goreng',
                'slug'        => 'nasi-goreng',
                'description' => 'Nasi goreng spesial',
                'price'       => 15000,
                'stock'       => 100,
                'is_active'   => true,
            ],
            [
                'category_id' => 1,
                'name'        => 'Mie Goreng',
                'slug'        => 'mie-goreng',
                'description' => 'Mie goreng spesial',
                'price'       => 12000,
                'stock'       => 100,
                'is_active'   => true,
            ],
            [
                'category_id' => 1,
                'name'        => 'Ayam Goreng',
                'slug'        => 'ayam-goreng',
                'description' => 'Ayam goreng crispy',
                'price'       => 18000,
                'stock'       => 50,
                'is_active'   => true,
            ],

            // Minuman - category_id: 2
            [
                'category_id' => 2,
                'name'        => 'Es Teh Manis',
                'slug'        => 'es-teh-manis',
                'description' => 'Es teh manis segar',
                'price'       => 5000,
                'stock'       => 200,
                'is_active'   => true,
            ],
            [
                'category_id' => 2,
                'name'        => 'Es Jeruk',
                'slug'        => 'es-jeruk',
                'description' => 'Es jeruk segar',
                'price'       => 6000,
                'stock'       => 200,
                'is_active'   => true,
            ],
            [
                'category_id' => 2,
                'name'        => 'Air Mineral',
                'slug'        => 'air-mineral',
                'description' => 'Air mineral 600ml',
                'price'       => 4000,
                'stock'       => 300,
                'is_active'   => true,
            ],

            // Snack - category_id: 3
            [
                'category_id' => 3,
                'name'        => 'Chitato',
                'slug'        => 'chitato',
                'description' => 'Chitato rasa sapi panggang',
                'price'       => 8000,
                'stock'       => 150,
                'is_active'   => true,
            ],
            [
                'category_id' => 3,
                'name'        => 'Oreo',
                'slug'        => 'oreo',
                'description' => 'Oreo original',
                'price'       => 7000,
                'stock'       => 150,
                'is_active'   => true,
            ],

            // Rokok - category_id: 4
            [
                'category_id' => 4,
                'name'        => 'Gudang Garam Merah',
                'slug'        => 'gudang-garam-merah',
                'description' => 'Rokok Gudang Garam Merah 12',
                'price'       => 23000,
                'stock'       => 100,
                'is_active'   => true,
            ],
            [
                'category_id' => 4,
                'name'        => 'Sampoerna Mild',
                'slug'        => 'sampoerna-mild',
                'description' => 'Rokok Sampoerna Mild 16',
                'price'       => 28000,
                'stock'       => 100,
                'is_active'   => true,
            ],

            // Sembako - category_id: 5
            [
                'category_id' => 5,
                'name'        => 'Beras 5kg',
                'slug'        => 'beras-5kg',
                'description' => 'Beras putih 5kg',
                'price'       => 65000,
                'stock'       => 50,
                'is_active'   => true,
            ],
            [
                'category_id' => 5,
                'name'        => 'Minyak Goreng 1L',
                'slug'        => 'minyak-goreng-1l',
                'description' => 'Minyak goreng 1 liter',
                'price'       => 18000,
                'stock'       => 80,
                'is_active'   => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
