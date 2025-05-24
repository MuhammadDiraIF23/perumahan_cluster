<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RiwayatAktivitas;
use App\Models\SuratPengajuan;
use App\Models\PengaduanAspirasi;

class RiwayatAktivitasSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan sudah ada minimal 1 data SuratPengajuan dan PengaduanAspirasi
        $surat = SuratPengajuan::first();
        $pengaduan = PengaduanAspirasi::first();

        if ($surat) {
            RiwayatAktivitas::create([
                'warga_id' => $surat->warga_id,
                'jenis_aktivitas' => 'Surat Pengajuan',
                'aktivitas_id' => $surat->id,
                'tanggal_aktivitas' => now(),
                'status' => $surat->status,
            ]);
        }

        if ($pengaduan) {
            RiwayatAktivitas::create([
                'warga_id' => $pengaduan->warga_id,
                'jenis_aktivitas' => 'Pengaduan & Aspirasi',
                'aktivitas_id' => $pengaduan->id,
                'tanggal_aktivitas' => now(),
                'status' => $pengaduan->status,
            ]);
        }
    }
}
