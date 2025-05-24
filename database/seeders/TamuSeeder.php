<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tamu;
use App\Models\Warga;
use App\Models\Satpam;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TamuSeeder extends Seeder
{
    public function run(): void
    {
        $warga = Warga::inRandomOrder()->first();
        $satpam = Satpam::inRandomOrder()->first();

        for ($i = 1; $i <= 3; $i++) {
            Tamu::create([
                'nama' => "Tamu Masuk $i",
                'nik_tamu' => '32100' . rand(10000000, 99999999),
                'alamat' => "Jl. Contoh Masuk $i",
                'warga_id' => $warga->id ?? 1,
                'satpam_id' => $satpam->id ?? 1,
                'alasan_kunjungan' => 'Silaturahmi',
                'waktu_masuk' => Carbon::now()->subHours(rand(1, 5)),
                'estimasi_waktu_keluar' => Carbon::now()->addHours(rand(1, 3)),
                'waktu_keluar' => null,
                'status_kunjungan' => 'Masuk',
                'nama_warga_tujuan' => $warga->nama ?? 'Warga Contoh',
                'alamat_warga_tujuan' => $warga->alamat ?? 'Jl. Rumah Contoh',
                'no_rumah_tujuan' => 'A' . $i,
                'foto_ktp_tamu' => 'ktp_tamu_masuk_' . $i . '.jpg',
            ]);
        }

        for ($i = 1; $i <= 2; $i++) {
            $masuk = Carbon::now()->subHours(rand(3, 6));
            $keluar = (clone $masuk)->addHours(rand(1, 2));

            Tamu::create([
                'nama' => "Tamu Selesai $i",
                'nik_tamu' => '32100' . rand(10000000, 99999999),
                'alamat' => "Jl. Contoh Keluar $i",
                'warga_id' => $warga->id ?? 1,
                'satpam_id' => $satpam->id ?? 1,
                'alasan_kunjungan' => 'Keperluan Acara',
                'waktu_masuk' => $masuk,
                'estimasi_waktu_keluar' => $keluar,
                'waktu_keluar' => $keluar,
                'status_kunjungan' => 'Keluar',
                'nama_warga_tujuan' => $warga->nama ?? 'Warga Contoh',
                'alamat_warga_tujuan' => $warga->alamat ?? 'Jl. Rumah Contoh',
                'no_rumah_tujuan' => 'B' . $i,
                'foto_ktp_tamu' => 'ktp_tamu_selesai_' . $i . '.jpg',
            ]);
        }
    }
}
