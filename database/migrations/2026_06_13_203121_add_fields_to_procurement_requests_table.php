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
        Schema::table('procurement_requests', function (Blueprint $table) {
            $table->decimal('harga_maksimal', 15, 2)->after('jumlah_kebutuhan')->nullable();
            $table->date('tanggal_mulai')->after('radius_km')->nullable();
            $table->date('tanggal_selesai')->after('tanggal_mulai')->nullable();
            
            // Satuan default to 'Porsi' if not provided
            $table->string('satuan', 50)->default('Porsi')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('procurement_requests', function (Blueprint $table) {
            $table->dropColumn(['harga_maksimal', 'tanggal_mulai', 'tanggal_selesai']);
        });
    }
};
