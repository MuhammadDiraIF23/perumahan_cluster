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
        Schema::create('pengaduan_aspirasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('wargas')->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi');
            $table->enum('kategori', ['Keluhan', 'Laporan Gangguan', 'Aspirasi']);
            $table->enum('status', ['Diajukan', 'Diproses', 'Selesai'])->default('Diajukan');
            $table->timestamp('tanggal_pengaduan')->useCurrent();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->string('foto_pengaduan_1')->nullable(); // Direktori foto pertama
            $table->string('foto_pengaduan_2')->nullable(); // Direktori foto kedua
            $table->string('foto_pengaduan_3')->nullable(); // Direktori foto ketiga
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan_aspirasis');
    }
};
