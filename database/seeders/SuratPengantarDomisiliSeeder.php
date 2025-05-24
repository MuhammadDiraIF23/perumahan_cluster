<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuratPengantarDomisili;

class SuratPengantarDomisiliSeeder extends Seeder
{
    public function run()
    {
        SuratPengantarDomisili::create([
            'surat_pengajuan_id' => 1,
            'status_hubungan'=> 'anak kandung',
            'nama_pemohon' => 'Ahmad Fauzi',
            'nik' => '3276020102930001',
            'alamat' => 'Jl. Melati No. 21, Jakarta Selatan',
            'no_telepon' => '081234567890',
            'tanggal_lahir' => '1993-02-10',
            'tempat_lahir' => 'Jakarta',
            'status_perkawinan' => 'Menikah',
            'foto_ktp_pemohon' => 'uploads/ktp/ahmad_fauzi.jpg',
        ]);
    }
}
