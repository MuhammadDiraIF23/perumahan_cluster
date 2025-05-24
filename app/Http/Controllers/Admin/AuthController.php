<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AuthController extends Controller
{
    /**
     * Tampilkan form login admin.
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Proses login admin.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cek admin berdasarkan username
        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            // Login berhasil
            Auth::guard('admin')->login($admin);

            // Redirect ke dashboard admin dengan pesan sukses
            return redirect()->route('admin.login')->with('login_success', true);
        }

        // Login gagal
        return back()->with('error', 'Username atau password salah.');
    }

    /**
     * Logout admin.
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')
            ->with('success', 'Anda telah logout.');
    }
}
