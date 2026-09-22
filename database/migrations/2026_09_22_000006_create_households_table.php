<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('households', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->restrictOnDelete();
            $table->foreignId('house_id')->nullable()->constrained()->restrictOnDelete();
            $table->string('kk_number', 16);
            $table->string('status', 20)->default('active')->index();
            $table->timestamps();

            $table->unique(['tenant_id', 'kk_number']);
            $table->index(['tenant_id', 'house_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('households');
    }
};
