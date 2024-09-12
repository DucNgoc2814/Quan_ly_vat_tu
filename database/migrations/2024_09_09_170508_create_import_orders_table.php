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
        Schema::create('import_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained('payments');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->string('slug', 255);
            $table->string('customer_name', 255);
            $table->string('email', 255);
            $table->string('number_phone', 11);
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
        Schema::dropIfExists('import_orders');
    }
};
