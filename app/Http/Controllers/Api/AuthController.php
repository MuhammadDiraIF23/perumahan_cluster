<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Warga;
use App\Models\Satpam;
use App\Models\UserRole;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    // ===================== REGISTER =====================
    public function register(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'nama' => 'required|string|max:255',
        'nik' => 'required|string|unique:users,nik',
        'email' => 'required|email|unique:users,email',
        'no_whatsapp' => 'required|unique:users,no_whatsapp|string|max:15',
        'no_telepon' => 'nullable|string|max:15',
        'alamat' => 'required|string',
        'password' => 'required|string|min:6|confirmed',
        'foto_file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    // Upload foto jika ada
    $filename = null;
    if ($request->hasFile('foto_file')) {
        $filename = $request->input('foto'); // nama dari frontend
        $request->file('foto_file')->move(public_path('uploads/foto_user'), $filename);
    }

    DB::beginTransaction();
    try {
        // Simpan user
        $user = User::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'email' => $request->email,
            'no_whatsapp' => $request->no_whatsapp,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'foto_diri' => $filename,
            'akses' => 'off', // default akses
        ]);

        if (!$user) {
            throw new \Exception('Gagal membuat user');
        }

        // Tambahkan role warga
        $role = Role::where('name', 'warga')->first();
        if (!$role) {
            throw new \Exception('Role warga tidak ditemukan');
        }

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);

        // Tambahkan ke tabel warga
        $warga = Warga::create([
            'user_id' => $user->id,
            'no_rumah' => null,
            'foto_ktp' => null,
        ]);

        if (!$warga) {
            throw new \Exception('Gagal menyimpan data warga');
        }

        DB::commit();

        $user->foto_url = $filename ? url('uploads/foto_user/' . $filename) : null;

        return response()->json([
            'status' => true,
            'message' => 'Registrasi berhasil',
            'user' => $user,
            'warga_id' => $warga->id
        ], 201);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'status' => false,
            'message' => 'Registrasi gagal',
            'error' => $e->getMessage()
        ], 500);
    }
}



    // ===================== LOGIN =====================
    public function login(Request $request)
{
    $user = User::where('nik', $request->nik)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'NIK atau password salah'], 401);
    }

    // Ambil role user dengan join tabel user_roles dan roles
    $role = DB::table('user_roles')
        ->join('roles', 'user_roles.role_id', '=', 'roles.id')
        ->where('user_roles.user_id', $user->id)
        ->select('roles.name as role')
        ->first();

    if (!$role) {
        return response()->json(['message' => 'Role tidak ditemukan'], 404);
    }

    $extraId = null;
    if ($role->role === 'warga') {
        // Ambil id dari tabel wargas
        $warga = DB::table('wargas')->where('user_id', $user->id)->first();
        $extraId = $warga ? $warga->id : null;
    } elseif ($role->role === 'satpam') {
        // Ambil id dari tabel satpams
        $satpam = DB::table('satpams')->where('user_id', $user->id)->first();
        $extraId = $satpam ? $satpam->id : null;
    }

    return response()->json([
        'status' => true,
        'message' => 'Login berhasil',
        'akses' => $user->akses,
        'role' => $role->role,
        'user' => $user,
        'warga_id' => $role->role === 'warga' ? $extraId : null,
        'satpam_id' => $role->role === 'satpam' ? $extraId : null,
    ]);
}



    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $token = Str::random(60);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        $resetLink = "http://localhost:8100/reset-password?token={$token}";

        Mail::raw("Klik link berikut untuk reset password Anda: $resetLink", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Reset Password Akun Clustro');
        });

        return response()->json(['message' => 'Link reset password telah dikirim.']);
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $record = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$record) {
            return response()->json(['message' => 'Token tidak valid'], 400);
        }

        $user = User::where('email', $record->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where('email', $record->email)->delete();

        return response()->json(['message' => 'Password berhasil diubah']);
    }
}
