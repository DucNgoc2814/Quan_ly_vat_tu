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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->foreignId('status_id')->constrained('order_statuses');
            $table->foreignId('contract_id')->nullable()->constrained('contracts');
            $table->foreignId('employee_id')->nullable()->constrained('employees');
            $table->string('slug', 255);
            $table->string('customer_name', 255);
            $table->string('email', 255);
            $table->string('number_phone', 11);
            $table->string('province', 255)->nullable();
            $table->string('district', 255)->nullable();
            $table->string('ward', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->integer('total_amount');
            $table->integer('paid_amount')->nullable();
            $table->text('cancel_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
