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
        Schema::create('inventory_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_id')->constrained('inventories');
            $table->string('variation_id');
            $table->string('variation_name');
            $table->integer('actual_quantity');
            $table->integer('system_quantity');
            $table->integer('deviation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_details');
    }
};
