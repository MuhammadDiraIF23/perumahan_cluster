<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaduanAspirasi;  // ganti dengan model yang sesuai

class LaporanController extends Controller
{
    public function index()
    {
        // Ambil data terbaru dari pengaduanapresiasis
        $laporans = PengaduanAspirasi::latest()->get();

        // Kirim data ke view admin.laporan
        return view('admin.laporan', compact('laporans'));
    }
}
