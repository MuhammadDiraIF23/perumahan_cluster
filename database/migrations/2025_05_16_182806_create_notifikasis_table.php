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
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('satpam_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('warga_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('pesan');
            $table->enum('status', ['terbaca', 'belum terbaca'])->default('belum terbaca');
            $table->enum('tipe_notifikasi', ['Tamu', 'Pengaduan', 'SuratPengajuan'])->default('Tamu'); // ← Ini harus ada!
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};
