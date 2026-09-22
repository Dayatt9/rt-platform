<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('tenant_id')->nullable()->after('id')->constrained()->restrictOnDelete();
            $table->index('tenant_id');
            $table->string('role', 30)->default('resident')->after('password')->index();
            $table->string('position', 30)->nullable()->after('role');
            $table->string('status', 20)->default('active')->after('position')->index();
            $table->timestamp('last_login_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
            $table->dropIndex(['tenant_id']);
            $table->dropIndex(['role']);
            $table->dropIndex(['status']);
            $table->dropColumn(['tenant_id', 'role', 'position', 'status', 'last_login_at']);
        });
    }
};
