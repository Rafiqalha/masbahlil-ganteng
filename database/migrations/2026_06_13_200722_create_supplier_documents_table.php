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
        Schema::create('supplier_documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('supplier_id')->constrained('suppliers')->cascadeOnDelete();
            $table->enum('document_type', ['NIB', 'SIUP', 'SERTIFIKAT_HALAL', 'LAINNYA']);
            $table->string('document_name', 255);
            $table->text('file_path');
            $table->integer('file_size_bytes')->nullable();
            $table->string('mime_type', 100)->nullable();
            $table->enum('verification_status', ['PENDING', 'VERIFIED', 'REJECTED'])->default('PENDING');
            $table->text('catatan_dokumen')->nullable();
            $table->dateTime('uploaded_at')->useCurrent();
            $table->dateTime('verified_at')->nullable();
            $table->timestamps();

            $table->index('verification_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_documents');
    }
};
