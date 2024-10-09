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
        Schema::create('attribute_value_variation', function (Blueprint $table) {
            $table->foreignId('variation_id')->constrained('variations');
            $table->foreignId('attribute_value_id')->constrained('attribute_values');
            $table->primary(['variation_id', 'attribute_value_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_value_variation');
    }
};
