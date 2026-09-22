<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('letter_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->restrictOnDelete();
            $table->foreignId('letter_type_id')->constrained()->restrictOnDelete();
            $table->foreignId('resident_id')->constrained()->restrictOnDelete();
            $table->string('status', 20)->default('pending')->index();
            $table->string('letter_number', 100)->nullable()->unique();
            $table->timestamp('requested_at');
            $table->timestamp('processed_at')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('rejection_reason')->nullable();
            $table->jsonb('request_data')->nullable();
            $table->string('snapshot_type_code', 50);
            $table->string('snapshot_type_name', 255);
            $table->jsonb('snapshot_fields')->nullable();
            $table->string('generated_document_path', 500)->nullable();
            $table->timestamps();

            $table->index(['tenant_id', 'status']);
            $table->index(['tenant_id', 'resident_id']);
            $table->index(['tenant_id', 'letter_type_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('letter_requests');
    }
};
