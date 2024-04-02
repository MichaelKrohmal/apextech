<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        #Task #1
        $this->call(ProductsTableSeeder::class);
        $this->call(DiscountRulesTableSeeder::class);
        #Task #2
        $this->call(MySQLTestSeeder::class);
    }
}
