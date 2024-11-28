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
        Schema::create('variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->string('sku', 255);
            $table->string('name', 255);
            $table->integer('stock')->default(0);
            $table->integer('retail_price')->default(0);
            $table->integer('avgImportPrice')->default(0);
            $table->integer('latestImportPrice')->default(0);
            $table->boolean('is_active')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variations');
    }
};
