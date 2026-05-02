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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'hr', 'manager', 'employee'])->default('employee')->after('email');
            $table->boolean('is_active')->default(true)->after('role');
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete()->after('is_active');
            $table->foreignId('manager_id')->nullable()->constrained('users')->nullOnDelete()->after('department_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['manager_id']);
            $table->dropColumn(['role', 'is_active', 'department_id', 'manager_id']);
        });
    }
};
