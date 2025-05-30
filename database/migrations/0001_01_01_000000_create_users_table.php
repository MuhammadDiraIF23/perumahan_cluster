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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->char('nik', 16)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_whatsapp');
            $table->string('no_telepon')->nullable();
            $table->text('alamat');
            $table->string('foto_diri')->nullable();
            $table->enum('akses', ['on', 'off'])->default('off');
            $table->timestamps();
        });
    }
    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
