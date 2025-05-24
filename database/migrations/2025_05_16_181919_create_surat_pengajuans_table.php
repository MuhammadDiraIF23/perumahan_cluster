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
        Schema::create('surat_pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('wargas')->onDelete('cascade');
            $table->enum('jenis_surat', ['Surat Pengantar Domisili', 'Surat Pengantar Nikah']);
            $table->text('keterangan')->nullable();
            $table->enum('status', ['Menunggu Persetujuan', 'Disetujui', 'Ditolak'])->default('Menunggu Persetujuan');
            $table->timestamp('tanggal_pengajuan')->useCurrent();
            $table->timestamp('tanggal_persetujuan')->nullable();
            $table->text('alasan_penolakan')->nullable();
            $table->string('file_surat_pengantar')->nullable(); // Upload file surat pengantar
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pengajuans');
    }
};
