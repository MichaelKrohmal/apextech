<?php

namespace App\Models;

use App\Enums\DiscountRuleType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiscountRule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type', 'product_id', 'min_quantity', 'discounted_price'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, mixed>
     */
    protected $casts = [
        'type' => DiscountRuleType::class
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function calculateSubtotal(int $quantity): float
    {
        return match ($this->type) {
            DiscountRuleType::BueOneGetOneFree => $this->product->price * (intdiv($quantity, 2) + ($quantity % 2)),
            DiscountRuleType::BulkPurchase => ($this->min_quantity <= $quantity) ? $this->discounted_price * $quantity : $this->product->price * $quantity,
            default => $this->product->price * $quantity,
        };
    }
}
