<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProfilController extends Controller
{
    // GET /api/profil/{warga_id}
    public function getProfile($warga_id)
    {
        $warga = Warga::with('user')->find($warga_id);

        if (!$warga) {
            return response()->json([
                'message' => 'Data warga tidak ditemukan.'
            ], 404);
        }

        $user = $warga->user;

        if (!$user) {
            return response()->json([
                'message' => 'Data user tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'user' => [
                'id' => $user->id,
                'nama' => $user->nama,
                'nik' => $user->nik,
                'email' => $user->email,
                'no_telepon' => $user->no_telepon,
                'no_whatsapp' => $user->no_whatsapp,
                'alamat' => $user->alamat,
                'foto_diri' => $user->foto_diri
                    ? url('uploads/foto_user/' . $user->foto_diri)
                    : url('uploads/foto_user/default-profile.jpg'),
                'akses' => $user->akses,
            ],
            'warga' => [
                'id' => $warga->id,
                'no_rumah' => $warga->no_rumah,
                'foto_ktp' => $warga->foto_ktp
                    ? url('uploads/foto_ktp/' . $warga->foto_ktp)
                    : null,
            ]
        ]);
    }

    // POST /api/upload-foto (upload foto profil user)
    public function uploadFoto(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'foto' => 'required|image|max:2048',
        ]);

        $user = User::find($request->user_id);

        $file = $request->file('foto');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $path = public_path('uploads/foto_user');

        // Pastikan folder tujuan ada
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        // Simpan file baru
        $file->move($path, $filename);

        // Hapus foto lama jika ada dan bukan default profile
        if ($user->foto_diri && $user->foto_diri !== 'default-profile.jpg' && File::exists($path . '/' . $user->foto_diri)) {
            File::delete($path . '/' . $user->foto_diri);
        }

        $user->foto_diri = $filename;
        $user->save();

        return response()->json([
            'message' => 'Foto profil berhasil diunggah.',
            'url' => url('uploads/foto_user/' . $filename),
        ]);
    }

    // POST /api/upload-ktp (upload foto KTP warga)
    public function uploadKtp(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'ktp' => 'required|image|max:4096',
        ]);

        $warga = Warga::find($request->warga_id);

        $file = $request->file('ktp');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $path = public_path('uploads/foto_ktp');

        // Pastikan folder tujuan ada
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $file->move($path, $filename);

        // Hapus foto KTP lama jika ada
        if ($warga->foto_ktp && File::exists($path . '/' . $warga->foto_ktp)) {
            File::delete($path . '/' . $warga->foto_ktp);
        }

        $warga->foto_ktp = $filename;
        $warga->save();

        return response()->json([
            'message' => 'Foto KTP berhasil diunggah.',
            'url' => url('uploads/foto_ktp/' . $filename),
        ]);
    }
}
