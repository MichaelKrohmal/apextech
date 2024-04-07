<?php

namespace App\Services;

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
                    $this->total += $discountRule->calculateSubtotal($quantity);
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
