<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\Tamu;
use App\Models\Laporan;
use App\Models\PengaduanAspirasi;
use App\Models\SuratPengajuan;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahPengajuan = SuratPengajuan::count();
        $jumlahTamu = Tamu::count();
        $jumlahLaporan = PengaduanAspirasi::count();

        return view('admin.dashboard', compact('jumlahPengajuan', 'jumlahTamu', 'jumlahLaporan'));
    }
}
