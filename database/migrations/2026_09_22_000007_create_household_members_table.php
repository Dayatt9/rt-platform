<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('household_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->restrictOnDelete();
            $table->foreignId('household_id')->constrained()->restrictOnDelete();
            $table->foreignId('resident_id')->constrained()->restrictOnDelete();
            $table->string('family_role', 30);
            $table->string('status', 20)->default('active')->index();
            $table->date('joined_at');
            $table->date('left_at')->nullable();
            $table->timestamps();

            $table->index(['tenant_id', 'household_id']);
            $table->index(['tenant_id', 'resident_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('household_members');
    }
};
