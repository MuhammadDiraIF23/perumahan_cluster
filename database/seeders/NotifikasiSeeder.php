<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notifikasi;
use App\Models\NotifikasiTamu;
use App\Models\NotifikasiPengaduan;
use App\Models\NotifikasiSuratPengajuan;
use App\Models\Warga;
use App\Models\Satpam;
use App\Models\Tamu;
use App\Models\PengaduanAspirasi;
use App\Models\SuratPengajuan;

class NotifikasiSeeder extends Seeder
{
    public function run(): void
    {
        $warga = Warga::inRandomOrder()->first();
        $satpam = Satpam::inRandomOrder()->first();

        // 1. Notifikasi Tamu
        $tamu = Tamu::inRandomOrder()->first();
        if ($tamu) {
            $notifikasiTamu = Notifikasi::create([
                'warga_id' => $tamu->warga_id,
                'satpam_id' => $tamu->satpam_id,
                'tipe_notifikasi' => 'Tamu',
                'pesan' => 'Ada tamu masuk untuk rumah ' . $tamu->nama_warga_tujuan,
                'status' => 'belum terbaca',
            ]);

            NotifikasiTamu::create([
                'notifikasi_id' => $notifikasiTamu->id,
                'tamu_id' => $tamu->id,
            ]);
        }

        // 2. Notifikasi Pengaduan
        $pengaduan = PengaduanAspirasi::inRandomOrder()->first();
        if ($pengaduan) {
            $notifikasiPengaduan = Notifikasi::create([
                'warga_id' => $pengaduan->warga_id,
                'satpam_id' => $satpam->id ?? null,
                'tipe_notifikasi' => 'Pengaduan',
                'pesan' => 'Pengaduan baru: ' . $pengaduan->judul,
                'status' => 'belum terbaca',
            ]);

            NotifikasiPengaduan::create([
                'notifikasi_id' => $notifikasiPengaduan->id,
                'pengaduan_aspirasi_id' => $pengaduan->id,
            ]);
        }

        // 3. Notifikasi Surat Pengajuan
        $surat = SuratPengajuan::inRandomOrder()->first();
        if ($surat) {
            $notifikasiSurat = Notifikasi::create([
                'warga_id' => $surat->warga_id,
                'satpam_id' => null,
                'tipe_notifikasi' => 'SuratPengajuan',
                'pesan' => 'Ada pengajuan surat: ' . $surat->jenis_surat,
                'status' => 'belum terbaca',
            ]);

            NotifikasiSuratPengajuan::create([
                'notifikasi_id' => $notifikasiSurat->id,
                'surat_pengajuan_id' => $surat->id,
            ]);
        }
    }
}
