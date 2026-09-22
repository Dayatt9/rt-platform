<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->restrictOnDelete();
            $table->string('nik', 16);
            $table->string('name');
            $table->string('gender', 20)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('status', 20)->default('active')->index();
            $table->timestamps();

            $table->index('tenant_id');
            $table->unique(['tenant_id', 'nik']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
