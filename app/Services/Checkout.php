<?php

namespace App\Services;

use App\Enums\DiscountRuleType;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class Checkout
{
    private Collection $discountRules;
    private array $products = [];
    public float $total = 0;

    /**
     * Create a new Checkout instance
     *
     * @return void
     */
    public function __construct(Collection $discountRules)
    {
        $this->discountRules = $discountRules;
    }

    public function scan(Product $product): void
    {
        if (isset($this->products[$product->code])) {
            $this->products[$product->code] += 1;
        } else {
            $this->products[$product->code] = 1;
        }
    }

    public function calculateTotalPrice(): float
    {
        foreach ($this->products as $code => $quantity) {
            foreach ($this->discountRules as $discountRule) {
                if ($discountRule->product->code == $code) {
                    if ($discountRule->type == DiscountRuleType::BulkPurchase
                        and $discountRule->min_quantity <= $quantity
                    ) {
                        $this->total += $discountRule->discounted_price * $quantity;
                    } else if (
                        $discountRule->type == DiscountRuleType::BueOneGetOneFree
                        and 2 <= $quantity
                    ) {
                        $this->total += ($discountRule->product->price * intdiv($quantity, 2)) +
                                $discountRule->product->price * ($quantity % 2);
                    } else {
                        $this->total += $quantity * $discountRule->product->price;
                    }
                }
            }

            if ($product = Product::whereCode($code)->first()
                and !$product->discount_rule
            ) {
                $this->total += $quantity * $product->price;
            }
        }

        return round($this->total, 2);
    }
}
