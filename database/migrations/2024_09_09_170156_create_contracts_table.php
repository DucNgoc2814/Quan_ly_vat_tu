<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_status_id')->constrained('contract_statuses')->default('1');
            $table->string('contract_number', 255);
            $table->string('customer_name', 255);
            $table->string('customer_email', 255);
            $table->string('number_phone', 10);
            $table->decimal('total_amount', 15, 2); 
            $table->string('file', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
