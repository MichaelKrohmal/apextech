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
        Schema::create('application_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id');
            //@TODO - this should be resolved via EnumClass statuses to provide easier extending
            //$table->string('old_status')->default(ApplicationStatus::NEW->value);
            //$table->string('new_status')->default(ApplicationStatus::NEW->value);
            $table->enum('old_status', ['NEW', 'PROCESSING', 'APPROVED', 'DECLINED', 'COMPLETED', 'CANCELLED']);
            $table->enum('new_status', ['NEW', 'PROCESSING', 'APPROVED', 'DECLINED', 'COMPLETED', 'CANCELLED']);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('application_id')
                ->references('id')
                ->on('applications')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_status_histories');
    }
};
