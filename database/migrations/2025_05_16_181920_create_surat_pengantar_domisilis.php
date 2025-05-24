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
        Schema::create('surat_pengantar_domisilis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_pengajuan_id')->constrained('surat_pengajuans')->onDelete('cascade');
            $table->string('status_hubungan');
            $table->string('nama_pemohon');
            $table->string('nik');
            $table->text('alamat');
            $table->string('no_telepon')->nullable();
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->enum('status_perkawinan', ['Belum Menikah', 'Menikah', 'Cerai']);
            $table->string('foto_ktp_pemohon')->nullable(); // Kolom untuk upload KTP
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pengantar_domisilis');
    }
};
