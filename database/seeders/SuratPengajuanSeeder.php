<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuratPengajuan;

class SuratPengajuanSeeder extends Seeder
{
    public function run()
    {
        // Domisili
        SuratPengajuan::create([
            'warga_id' => 1,
            'jenis_surat' => 'Surat Pengantar Domisili',
            'keterangan' => 'Diperlukan untuk pindah alamat',
            'status' => 'Menunggu Persetujuan',
            'tanggal_pengajuan' => now(),
            'tanggal_persetujuan' => null,
            'alasan_penolakan' => null,
            'file_surat_pengantar' => 'uploads/surat/domisili_001.pdf'
        ]);

        // Nikah
        SuratPengajuan::create([
            'warga_id' => 2,
            'jenis_surat' => 'Surat Pengantar Nikah',
            'keterangan' => 'Persyaratan administrasi nikah',
            'status' => 'Disetujui',
            'tanggal_pengajuan' => now()->subDays(3),
            'tanggal_persetujuan' => now(),
            'alasan_penolakan' => null,
            'file_surat_pengantar' => 'uploads/surat/nikah_002.pdf'
        ]);
    }
}
