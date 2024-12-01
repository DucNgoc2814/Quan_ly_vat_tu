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
        Schema::create('permission_employees', function (Blueprint $table) {
            $table->foreignId('permission_id')->constrained('permissions');
            $table->foreignId('employee_id')->constrained('employees');
            $table->primary(['permission_id', 'employee_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_employees');
    }
};