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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('nama_usaha', 200);
            $table->text('alamat');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('kategori_produk', 100);
            $table->decimal('kapasitas_harian', 10, 2)->default(0);
            $table->string('satuan_kapasitas', 50)->default('kg');
            $table->text('deskripsi')->nullable();
            $table->enum('status_verifikasi', ['PENDING', 'PENDING_REVIEW', 'APPROVED', 'REJECTED'])->default('PENDING');
            $table->text('catatan_verifikasi')->nullable();
            $table->dateTime('verified_at')->nullable();
            $table->foreignUuid('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('status_verifikasi');
            $table->index('kategori_produk');
            $table->index(['latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
