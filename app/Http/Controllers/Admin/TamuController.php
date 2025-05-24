<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tamu;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TamuController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();

        // Ambil semua tamu sesuai pencarian
        $search = $request->input('search');
        $semuaTamu = Tamu::with(['satpam.user', 'warga'])
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', '%' . $search . '%')
                      ->orWhere('nik_tamu', 'like', '%' . $search . '%');
            })
            ->orderByDesc('created_at')
            ->get();

        // Tamu belum keluar
        $tamuBelumKeluar = Tamu::with(['satpam.user', 'warga'])
            ->where('status_kunjungan', 'Masuk')
            ->whereNull('waktu_keluar')
            ->get();

        // Tamu sudah keluar
        $tamuSudahKeluar = Tamu::with(['satpam.user', 'warga'])
            ->where('status_kunjungan', 'Keluar')
            ->get();

        // Tamu telat keluar
        $tamuTelat = Tamu::with(['satpam.user', 'warga'])
            ->where('status_kunjungan', 'Masuk')
            ->whereNull('waktu_keluar')
            ->where('estimasi_waktu_keluar', '<', $now)
            ->get();

        return view('admin.monitoring', compact(
            'semuaTamu',
            'tamuBelumKeluar',
            'tamuSudahKeluar',
            'tamuTelat'
        ));
    }

    public function destroy($id)
    {
        $tamu = Tamu::findOrFail($id);
        $tamu->delete();

        return redirect()->back()->with('success', 'Data tamu berhasil dihapus.');
    }
}
