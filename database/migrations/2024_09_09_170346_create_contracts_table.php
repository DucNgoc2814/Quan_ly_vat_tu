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
            $table->foreignId('employee_id')->constrained('employees');
            $table->string('contract_number', 255);
            $table->string('customer_name', 255);
            $table->string('customer_phone', 10);
            $table->string('customer_email', 255);
            $table->integer('total_amount');
            $table->string('file')->nullable();
            $table->string('verification_token')->nullable();
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
