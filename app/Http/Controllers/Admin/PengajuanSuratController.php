<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratPengajuan;
use App\Models\Notifikasi;
use App\Models\NotifikasiSuratPengajuan;
use App\Models\RiwayatAktivitas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengajuanSuratController extends Controller
{
    public function index()
    {
        $pengajuanSurats = SuratPengajuan::with('warga.user')->get();
        return view('admin.pengajuan-surat', compact('pengajuanSurats'));
    }

    public function updateStatus(Request $request, $id)
    {
        $surat = SuratPengajuan::findOrFail($id);
        $surat->status = $request->input('status');
        $surat->tanggal_persetujuan = ($request->input('status') === 'Disetujui') ? Carbon::now() : null;
        $surat->alasan_penolakan = ($request->input('status') === 'Ditolak') ? $request->input('alasan_penolakan') : null;
        $surat->save();

        // **1️⃣ Update atau Buat Riwayat Aktivitas**
        $riwayat = RiwayatAktivitas::where('warga_id', $surat->warga_id)
            ->where('jenis_aktivitas', 'Surat Pengajuan')
            ->first();

        if ($riwayat) {
            // Jika sudah ada, update saja
            $riwayat->update([
                'aktivitas_id' => $surat->id,
                'status' => "Status pengajuan  {$surat->status}",
            ]);
        } else {
            // Jika belum ada, insert baru
            RiwayatAktivitas::create([
                'aktivitas_id' => $surat->id,
                'warga_id' => $surat->warga_id,
                'status' => "Status pengajuan {$surat->status}",
                'jenis_aktivitas' => 'Surat Pengajuan',
            ]);
        }

        // **2️⃣ Update atau Buat Notifikasi**
        $notifikasi = Notifikasi::where('warga_id', $surat->warga_id)
            ->where('tipe_notifikasi', 'SuratPengajuan')
            ->first();

        if ($notifikasi) {
            // Jika sudah ada, update saja
            $notifikasi->update([
                'pesan' => "Pengajuan Surat Anda telah diubah menjadi {$surat->status}",
                'status' => 'belum terbaca',
            ]);
        } else {
            // Jika belum ada, insert baru
            $notifikasi = Notifikasi::create([
                'warga_id' => $surat->warga_id,
                'tipe_notifikasi' => 'SuratPengajuan',
                'pesan' => "Pengajuan Surat Anda telah diubah menjadi {$surat->status}",
                'status' => 'belum terbaca',
            ]);
        }

        // **3️⃣ Update atau Buat Notifikasi Surat Pengajuan**
        $notifikasiSuratPengajuan = NotifikasiSuratPengajuan::where('surat_pengajuan_id', $surat->id)->first();

        if ($notifikasiSuratPengajuan) {
            // Update ID notifikasi jika berubah
            $notifikasiSuratPengajuan->update([
                'notifikasi_id' => $notifikasi->id
            ]);
        } else {
            // Jika belum ada, insert baru
            NotifikasiSuratPengajuan::create([
                'notifikasi_id' => $notifikasi->id,
                'surat_pengajuan_id' => $surat->id
            ]);
        }

        return back()->with('success', 'Status pengajuan surat berhasil diperbarui.');
    }
}
