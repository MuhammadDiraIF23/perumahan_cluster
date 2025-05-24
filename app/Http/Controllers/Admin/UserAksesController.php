<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Warga;
use App\Models\Satpam;
use Illuminate\Http\Request;

class UserAksesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = User::with('roles');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhereHas('roles', function($q2) use ($search) {
                      $q2->where('name', 'like', "%$search%");
                  });
            });
        }

        $users = $query->orderByRaw("akses = 'on' ASC")
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('admin.dataUsers', compact('users'));
    }

    public function toggleAkses($id_user)
    {
        $user = User::findOrFail($id_user);
        $user->akses = $user->akses === 'on' ? 'off' : 'on';
        $user->save();

        return back()->with('success', 'Akses pengguna berhasil diperbarui.');
    }

    public function changeRole($id_user)
    {
        $user = User::with('roles')->findOrFail($id_user);

        $roleWarga = Role::where('name', 'warga')->first();
        $roleSatpam = Role::where('name', 'satpam')->first();

        if (!$roleWarga || !$roleSatpam) {
            return back()->with('error', 'Role warga atau satpam tidak ditemukan.');
        }

        $currentRole = $user->roles->first();

        if ($currentRole && $currentRole->name === 'warga') {
            // Ganti ke satpam
            $user->roles()->sync([$roleSatpam->id]);

            // Hapus data warga jika ada
            Warga::where('user_id', $user->id)->delete();

            // Tambah data satpam jika belum ada
            Satpam::firstOrCreate(['user_id' => $user->id]);
        } else {
            // Ganti ke warga
            $user->roles()->sync([$roleWarga->id]);

            // Hapus data satpam jika ada
            Satpam::where('user_id', $user->id)->delete();

            // Tambah data warga jika belum ada
            Warga::firstOrCreate(['user_id' => $user->id]);
        }

        return back()->with('success', 'Role pengguna berhasil diperbarui.');
    }
}
