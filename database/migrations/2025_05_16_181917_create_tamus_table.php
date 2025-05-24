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
        Schema::create('tamus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik_tamu', 16)->unique();
            $table->text('alamat');
            $table->foreignId('warga_id')->constrained('wargas')->onDelete('cascade');
            $table->foreignId('satpam_id')->constrained('satpams')->onDelete('cascade'); // Relasi ke tabel Satpam
            $table->string('alasan_kunjungan');
            $table->timestamp('waktu_masuk');
            $table->timestamp('estimasi_waktu_keluar');
            $table->timestamp('waktu_keluar')->nullable();
            $table->enum('status_kunjungan', ['Masuk', 'Keluar'])->default('Masuk');
            $table->string('nama_warga_tujuan')->nullable();
            $table->text('alamat_warga_tujuan')->nullable();
            $table->string('no_rumah_tujuan')->nullable();
            $table->string('foto_ktp_tamu')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamus');
    }
};
