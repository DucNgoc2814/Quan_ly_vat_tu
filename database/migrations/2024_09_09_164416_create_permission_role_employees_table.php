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
        Schema::create('permission_role_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permisson_id')->constrained('permissions');
            $table->foreignId('role_employee_id')->constrained('role_employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_role_employees');
    }
};
