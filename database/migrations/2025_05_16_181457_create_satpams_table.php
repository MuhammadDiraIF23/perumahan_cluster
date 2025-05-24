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
        Schema::create('satpams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('pos_jaga')->nullable();
            $table->string('jadwal_jaga')->nullable();
            $table->string('shift')->nullable();
            $table->string('area_patrol')->nullable();
            $table->enum('status_tugas', ['Bertugas', 'Tidak Bertugas'])->default('Tidak Bertugas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satpams');
    }
};
