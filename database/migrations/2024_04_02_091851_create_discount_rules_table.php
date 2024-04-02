<?php

use App\Enums\DiscountRuleType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discount_rules', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default(DiscountRuleType::BulkPurchase->value);
            $table->foreignId('product_id')->unique();
            $table->integer('min_quantity')->default(2);
            $table->decimal('discounted_price', 8, 2, true)->default(0);
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discount_rules');
    }
};
