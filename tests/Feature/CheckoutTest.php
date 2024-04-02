<?php

namespace Tests\Feature;

use Tests\TestCase;

class CheckoutTest extends TestCase
{
    /**
     * Checkout test with correct data
     */
    public function test_checkout_calculations_success(): void
    {
        $testCases = [
            [
                'basket' => 'FR1,SR1,FR1,FR1,CF1',
                'totalPrice' => 22.45
            ],
            [
                'basket' => 'FR1,FR1',
                'totalPrice' => 3.11
            ],
            [
                'basket' => 'SR1,SR1,FR1,SR1',
                'totalPrice' => 16.61
            ],
            [
                'basket' => 'INVALID_CODE',
                'totalPrice' => 0
            ]
        ];

        foreach ($testCases as $testCase) {
            $response = $this->post('/api/checkout', [
                'basket' => $testCase ['basket']
            ]);

            $response
                ->assertStatus(200)
                ->assertJson([
                    'totalPrice' => $testCase ['totalPrice'],
                ]);
        }
    }
}
