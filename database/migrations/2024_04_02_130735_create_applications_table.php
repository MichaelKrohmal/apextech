<?php

use App\Enums\ApplicationStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->foreignId('broker_id')->nullable();
            $table->foreignId('credit_product_id');
            $table->unsignedDecimal('loan_amount', 8,2);
            //@TODO - this is a calculated value, should be triggered in Model
            $table->unsignedDecimal('monthly_payment', 8,2);
            //@TODO - this should be resolved via EnumClass statuses to provide easier extending
            //$table->string('status')->default(ApplicationStatus::NEW->value);
            $table->enum('status', ['NEW', 'PROCESSING', 'APPROVED', 'DECLINED', 'COMPLETED', 'CANCELLED']);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('restrict');

            $table->foreign('broker_id')
                ->references('id')
                ->on('brokers')
                ->onDelete('restrict');

            $table->foreign('credit_product_id')
                ->references('id')
                ->on('credit_products')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
