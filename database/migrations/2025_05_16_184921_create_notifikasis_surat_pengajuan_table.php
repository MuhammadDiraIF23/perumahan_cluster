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
        Schema::create('notifikasi_surat_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notifikasi_id')->constrained('notifikasis')->onDelete('cascade');
            $table->foreignId('surat_pengajuan_id')->constrained('surat_pengajuans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis_surat_pengajuan');
    }
};
