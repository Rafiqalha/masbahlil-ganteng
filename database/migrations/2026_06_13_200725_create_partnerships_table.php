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
        Schema::create('partnerships', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('procurement_request_id')->constrained('procurement_requests')->cascadeOnDelete();
            $table->foreignUuid('supplier_id')->constrained('suppliers')->cascadeOnDelete();
            $table->enum('status', ['PENDING', 'ACTIVE', 'REJECTED', 'EXPIRED'])->default('PENDING');
            $table->text('catatan_penolakan')->nullable();
            $table->dateTime('requested_at')->useCurrent();
            $table->dateTime('responded_at')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->timestamps();

            $table->unique(['procurement_request_id', 'supplier_id']);
            $table->index('procurement_request_id');
            $table->index('supplier_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partnerships');
    }
};
