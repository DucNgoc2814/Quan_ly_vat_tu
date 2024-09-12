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
            $table->foreignId('payment_id')->constrained('payments');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('status_id')->constrained('order_status');
            $table->string('slug', 255);
            $table->string('customer_name', 255);
            $table->string('email', 255);
            $table->integer('number_phone');
            $table->string('address', 255);
            $table->integer('total_amount');
            $table->integer('paid_amount');
            $table->integer('payable_amount');
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
