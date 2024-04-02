<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        $productsData = json_decode(file_get_contents(database_path('seeders/data/products.json')), true);

        foreach ($productsData as $productData) {
            Product::create($productData);
        }
    }
}
