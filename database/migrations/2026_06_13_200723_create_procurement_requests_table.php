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
        Schema::create('procurement_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sppg_id')->constrained('sppg')->cascadeOnDelete();
            $table->string('kategori_produk', 100);
            $table->decimal('jumlah_kebutuhan', 10, 2);
            $table->string('satuan', 50);
            $table->decimal('radius_km', 6, 2)->default(50);
            $table->text('deskripsi_kebutuhan')->nullable();
            $table->enum('status', ['OPEN', 'IN_PROGRESS', 'CLOSED'])->default('OPEN');
            $table->timestamps();

            $table->index('sppg_id');
            $table->index('status');
            $table->index('kategori_produk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procurement_requests');
    }
};
