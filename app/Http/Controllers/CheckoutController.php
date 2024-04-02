<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\DiscountRule;
use App\Models\Product;
use App\Services\Checkout;

class CheckoutController extends Controller
{
    /**
     * Generates total price for the order.
     */
    public function checkout(CheckoutRequest $request)
    {
        $productCodes = collect(explode(',', $request['basket']));
        $checkout = new Checkout(DiscountRule::all());
        foreach ($productCodes as $productCode) {
            if ($item = Product::whereCode($productCode)->first()) {
                $checkout->scan($item);
            }
        }

        return response()->json([
            'totalPrice' => $checkout->calculateTotalPrice()
        ]);
    }
}
