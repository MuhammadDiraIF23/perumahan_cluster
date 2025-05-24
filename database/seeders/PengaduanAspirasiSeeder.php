<?php

namespace Database\Seeders;

use App\Models\PengaduanAspirasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengaduanAspirasiSeeder extends Seeder
{
    public function run(): void
    {
        // Contoh warga_id, pastikan kamu punya data Warga dengan ID 1
        PengaduanAspirasi::create([
            'warga_id' => 1,
            'judul' => 'Jalan Rusak di Blok C',
            'deskripsi' => 'Mohon perbaikan jalan yang rusak dan berlubang di depan rumah blok C3. Sering menyebabkan kecelakaan.',
            'kategori' => 'Keluhan',
            'status' => 'Diajukan',
            'tanggal_pengaduan' => now(),
            'tanggal_selesai' => null,
            'foto_pengaduan_1' => 'uploads/pengaduan/jalan_rusak1.jpg',
            'foto_pengaduan_2' => 'uploads/jalan_rusak2.jpg',
            'foto_pengaduan_3' => 'uploads/jalan_rusak3.jpg',
        ]);
    }
}
