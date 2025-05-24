<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuratPengantarNikah;

class SuratPengantarNikahSeeder extends Seeder
{
    public function run()
    {
        SuratPengantarNikah::create([
            'surat_pengajuan_id' => 2,
            'status_hubungan'=> 'anak kandung',
            'nama_lengkap_pemohon' => 'Siti Aminah',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1995-08-25',
            'alamat_ktp' => 'Jl. Kenanga No. 15, Bandung',
            'nik' => '3276022508950002',
            'agama' => 'Islam',
            'status_pernikahan' => 'Lajang',
            'pekerjaan' => 'Guru',
            'nama_ayah' => 'Hadi Prasetyo',
            'nama_ibu' => 'Rina Sari',
            'fotokopi_ktp' => 'uploads/ktp/siti_aminah.jpg',
            'fotokopi_kk' => 'uploads/kk/siti_aminah.jpg',
        ]);
    }
}

