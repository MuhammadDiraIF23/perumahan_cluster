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
        Schema::create('surat_pengantar_nikahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_pengajuan_id')->constrained('surat_pengajuans')->onDelete('cascade');
            $table->string('status_hubungan');
            $table->string('nama_lengkap_pemohon');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat_ktp');
            $table->string('nik');
            $table->string('agama');
            $table->enum('status_pernikahan', ['Lajang', 'Duda', 'Janda']);
            $table->string('pekerjaan');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('fotokopi_ktp')->nullable();  // Upload file KTP
            $table->string('fotokopi_kk')->nullable();   // Upload file Kartu Keluarga
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pengantar_nikahs');
    }
};
