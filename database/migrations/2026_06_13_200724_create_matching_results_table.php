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
        Schema::create('matching_results', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('procurement_request_id')->constrained('procurement_requests')->cascadeOnDelete();
            $table->foreignUuid('supplier_id')->constrained('suppliers')->cascadeOnDelete();
            $table->decimal('distance_km', 8, 3);
            $table->decimal('distance_score', 5, 4);
            $table->decimal('capacity_score', 5, 4);
            $table->decimal('document_score', 5, 4);
            $table->decimal('history_score', 5, 4);
            $table->decimal('total_score', 5, 4);
            $table->integer('ranking');
            $table->timestamps();

            $table->unique(['procurement_request_id', 'supplier_id']);
            $table->index('procurement_request_id');
            $table->index(['procurement_request_id', 'total_score']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matching_results');
    }
};
