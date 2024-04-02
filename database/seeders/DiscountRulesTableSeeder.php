<?php

namespace Database\Seeders;

use App\Models\DiscountRule;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DiscountRulesTableSeeder extends Seeder
{
    public function run(): void
    {
        $discountRulesData = json_decode(file_get_contents(database_path('seeders/data/discount_rules.json')), true);

        foreach ($discountRulesData as $discountRuleData) {
            if ($productId = Product::whereCode($discountRuleData['product_code'])->first()?->id) {
                DiscountRule::create([
                    'type' => $discountRuleData['type'],
                    'product_id' => $productId,
                    'min_quantity' => $discountRuleData['min_quantity'],
                    'discounted_price' => $discountRuleData['discounted_price'],
                ]);
            }
        }
    }
}
