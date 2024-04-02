<?php

namespace App\Enums;

enum DiscountRuleType: string
{
    case BulkPurchase = 'bp';
    case BueOneGetOneFree = 'b1g1f';

    public function readableText(): string
    {
        return match ($this) {
            DiscountRuleType::BulkPurchase => 'Bulk Purchase',
            DiscountRuleType::BueOneGetOneFree => 'Bue One Get One Free',
        };
    }
}
